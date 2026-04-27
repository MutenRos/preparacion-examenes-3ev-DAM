#!/usr/bin/env python3
# -*- coding: utf-8 -*-

import json
import re
from pathlib import Path
from typing import Any, Dict, List, Optional, Tuple

import requests
import torch
from diffusers import StableDiffusionPipeline

# ==========================================================
# CONFIGURACIÓN
# ==========================================================

# Puedes poner UNA o VARIAS carpetas con JSON
INPUT_JSON_FOLDERS = [
    Path("/var/www/html/dam2526/Segundo/Proyecto Intermodular II/009-Proyectos segundo trimestre/010-descripciones con IA/web/productos/jocarsa-lightsalmon"),
    Path("/var/www/html/dam2526/Segundo/Proyecto Intermodular II/009-Proyectos segundo trimestre/010-descripciones con IA/web/productos/jocarsa-darkorange"),
    Path("/var/www/html/dam2526/Segundo/Proyecto Intermodular II/009-Proyectos segundo trimestre/010-descripciones con IA/web/productos/jocarsa-aqua"),
    Path("/var/www/html/dam2526/Segundo/Proyecto Intermodular II/009-Proyectos segundo trimestre/010-descripciones con IA/web/productos/jocarsa-lightgoldenrodyellow"),
    Path("/var/www/html/dam2526/Segundo/Proyecto Intermodular II/009-Proyectos segundo trimestre/010-descripciones con IA/web/productos/jocarsa-firebrick"),
    Path("/var/www/html/dam2526/Segundo/Proyecto Intermodular II/009-Proyectos segundo trimestre/010-descripciones con IA/web/productos/jocarsa-khaki"),
    Path("/var/www/html/dam2526/Segundo/Proyecto Intermodular II/009-Proyectos segundo trimestre/010-descripciones con IA/web/productos/jocarsa-orange"),
]

# Ollama
OLLAMA_URL = "http://127.0.0.1:11434/api/generate"
OLLAMA_MODEL = "llama3:latest"
OLLAMA_TIMEOUT = 300

# Stable Diffusion (diffusers)
MODEL_ID = "runwayml/stable-diffusion-v1-5"  # puede requerir acceso HF según tu entorno
STEPS = 30
GUIDANCE = 7.5
WIDTH = 1024
HEIGHT = 576  # 16:9 para banners web
SEED_BASE = 12345

# Formato de salida de imagen
OUTPUT_EXT = ".png"  # ".png" recomendado

# Si TRUE: si el @src termina en .jpg/.png/etc, lo respeta;
# si FALSE: fuerza OUTPUT_EXT
RESPECT_SRC_EXTENSION = True

# ---- Switch CPU/GPU (sin CLI) ----
# None = auto (CUDA si existe, si no CPU)
# "cpu" = fuerza CPU
# "cuda" = fuerza GPU
FORCE_DEVICE: Optional[str] = None
# FORCE_DEVICE = "cpu"
# FORCE_DEVICE = "cuda"
FORCE_DEVICE = "cpu"

# ==========================================================
# UTILIDADES JSON
# ==========================================================

def slugify(s: str, maxlen: int = 80) -> str:
    s = (s or "").strip().lower()
    s = re.sub(r"[^\w\s-]", "", s, flags=re.UNICODE)
    s = re.sub(r"[\s_-]+", "-", s)
    s = s.strip("-")
    return (s or "image")[:maxlen]


def looks_like_image_path(p: str) -> bool:
    p = (p or "").strip().lower()
    return any(p.endswith(ext) for ext in [".jpg", ".jpeg", ".png", ".webp", ".gif"])


def extract_images_with_context(data: Any) -> List[Dict[str, str]]:
    """
    Recorre recursivamente un JSON y extrae nodos de imagen.
    Detecta:
      - {"@src": "...", "@alt": "..."}  (caso ideal)
      - {"@src": "..."}                (sin alt)
    Devuelve lista de dicts: {src, alt, section_guess}
    """
    results: List[Dict[str, str]] = []

    def walk(node: Any, path: List[str]) -> None:
        if isinstance(node, dict):
            if "@src" in node and isinstance(node["@src"], str):
                src = node["@src"].strip()
                alt = ""
                if "@alt" in node and isinstance(node["@alt"], str):
                    alt = node["@alt"].strip()

                section_guess = "section"
                joined = "/".join(path).lower()
                for key in [
                    "hero", "problem", "solution", "keyfeatures", "features", "audience",
                    "usecases", "benefits", "integrations", "trust", "finalcta", "faq", "gallery"
                ]:
                    if key in joined:
                        section_guess = key
                        break

                results.append({"src": src, "alt": alt, "section": section_guess})

            for k, v in node.items():
                walk(v, path + [str(k)])

        elif isinstance(node, list):
            for i, it in enumerate(node):
                walk(it, path + [str(i)])

    walk(data, [])
    return results


def compact_context_from_json(data: Any) -> Dict[str, Any]:
    """
    Intenta construir un contexto "comercial" compacto a partir del JSON,
    sin depender de una estructura exacta.
    """
    def find_first(obj: Any, keys: Tuple[str, ...]) -> Optional[str]:
        found = None

        def w(n: Any):
            nonlocal found
            if found is not None:
                return
            if isinstance(n, dict):
                for k, v in n.items():
                    if k in keys and isinstance(v, str) and v.strip():
                        found = v.strip()
                        return
                    w(v)
            elif isinstance(n, list):
                for it in n:
                    w(it)

        w(obj)
        return found

    def find_many(obj: Any, keys: Tuple[str, ...], max_items: int = 8) -> List[str]:
        items: List[str] = []

        def w(n: Any):
            if len(items) >= max_items:
                return
            if isinstance(n, dict):
                for k, v in n.items():
                    if k in keys:
                        if isinstance(v, str) and v.strip():
                            items.append(v.strip())
                        elif isinstance(v, list):
                            for it in v:
                                if isinstance(it, str) and it.strip():
                                    items.append(it.strip())
                        elif isinstance(v, dict):
                            for kk in ["item", "text", "value", "name", "benefit"]:
                                if kk in v and isinstance(v[kk], str) and v[kk].strip():
                                    items.append(v[kk].strip())
                    w(v)
            elif isinstance(n, list):
                for it in n:
                    w(it)

        w(obj)
        out: List[str] = []
        seen = set()
        for x in items:
            if x not in seen:
                out.append(x)
                seen.add(x)
        return out[:max_items]

    title = find_first(data, ("title", "name", "productName"))
    slug = find_first(data, ("slug",))
    category = find_first(data, ("category", "type"))
    value_prop = find_first(data, ("valueProposition", "value_proposition", "headline", "claim"))
    subtitle = find_first(data, ("subtitle", "tagline", "subheadline", "description"))

    problems = find_many(data, ("problem", "pain", "pains", "issue", "issues", "challenges", "problemas", "dolores"), 8)
    benefits = find_many(data, ("benefit", "benefits", "advantages", "ventajas", "beneficios"), 8)
    features = find_many(data, ("feature", "features", "keyFeatures", "funcionalidades", "caracteristicas"), 10)

    return {
        "slug": slug or "",
        "title": title or "",
        "category": category or "",
        "valueProposition": value_prop or "",
        "subtitle": subtitle or "",
        "problems": problems,
        "benefits": benefits,
        "features": features,
        "style": {
            "look": "apple-like, clean, modern SaaS, minimal, premium",
            "avoid": "text, letters, logos, watermarks, readable UI text",
            "colors": "neutral, soft gradients, subtle lighting, professional",
        }
    }


# ==========================================================
# OLLAMA PROMPTS
# ==========================================================

def ollama_generate_json(system: str, user: str) -> dict:
    """
    Pide a Ollama JSON estricto. Intenta:
      1) con format=json (si lo soporta tu versión)
      2) reintentos con temperatura baja
      3) extracción y reparación mínima
    Si todo falla: devuelve {} para que el caller haga fallback.
    """
    def extract_json_block(t: str) -> str:
        t = (t or "").strip()
        start = t.find("{")
        end = t.rfind("}")
        if start != -1 and end != -1 and end > start:
            return t[start:end + 1]
        return t

    def try_parse(js_text: str) -> Optional[dict]:
        js_text = (js_text or "").strip()
        if not js_text:
            return None
        try:
            return json.loads(js_text)
        except Exception:
            return None

    def repair_common_json_issues(s: str) -> str:
        s = (s or "")
        s = s.replace("“", '"').replace("”", '"').replace("’", "'").replace("‘", "'")
        s = re.sub(r",\s*([}\]])", r"\1", s)  # trailing commas
        return s

    attempts = [
        {"temperature": 0.4, "force_only_json": False},
        {"temperature": 0.2, "force_only_json": True},
        {"temperature": 0.0, "force_only_json": True},
    ]

    last_text = ""

    for a_i, cfg in enumerate(attempts, start=1):
        prompt = user
        sysmsg = system
        if cfg["force_only_json"]:
            sysmsg = system + "\nReturn ONLY valid JSON. No prose. No code fences."
            prompt = user + "\n\nRETURN ONLY JSON. DO NOT ADD ANY OTHER TEXT."

        payload = {
            "model": OLLAMA_MODEL,
            "prompt": prompt,
            "system": sysmsg,
            "stream": False,
            "format": "json",
            "options": {"temperature": cfg["temperature"]},
        }

        try:
            r = requests.post(OLLAMA_URL, json=payload, timeout=OLLAMA_TIMEOUT)
            r.raise_for_status()
            resp = r.json()
            last_text = (resp.get("response") or "").strip()

            parsed = try_parse(last_text)
            if parsed is not None:
                return parsed

            block = extract_json_block(last_text)
            parsed = try_parse(block)
            if parsed is not None:
                return parsed

            fixed = repair_common_json_issues(block)
            parsed = try_parse(fixed)
            if parsed is not None:
                return parsed

        except Exception as e:
            print(f"  ⚠️  Ollama intento {a_i} falló: {e}")

    print("  ⚠️  Ollama no devolvió JSON válido. Se usará fallback de prompts.")
    # Path("ollama_bad_response.txt").write_text(last_text, encoding="utf-8")
    return {}


def ask_ollama_for_prompts(context: dict, images: List[Dict[str, str]]) -> List[Dict[str, str]]:
    system = (
        "You generate Stable Diffusion prompts for SaaS marketing images.\n"
        "Return ONLY valid JSON.\n"
        "Style: Apple-like minimal premium SaaS visuals, clean, modern, subtle lighting.\n"
        "STRICTLY avoid any text, letters, logos, watermarks, brand names.\n"
        "No UI screenshots with readable text.\n"
    )

    req = []
    for i, it in enumerate(images, 1):
        req.append({
            "id": i,
            "section": it.get("section", "section"),
            "alt": it.get("alt", ""),
            "original_src": it.get("src", ""),
        })

    user = (
        "Product context:\n"
        f"{json.dumps(context, ensure_ascii=False, indent=2)}\n\n"
        "Generate one English prompt per image request.\n"
        "Return JSON exactly as:\n"
        "{\n"
        '  "images": [\n'
        '    {"id": 1, "prompt": "...", "negative_prompt": "..."},\n'
        "    ...\n"
        "  ]\n"
        "}\n\n"
        "Image list:\n"
        f"{json.dumps(req, ensure_ascii=False, indent=2)}\n\n"
        "Rules:\n"
        "- Prompts in English.\n"
        "- Strong negative_prompt to block text/logos/watermarks.\n"
        "- Keep consistent aesthetic across all images.\n"
        "- Use distinct visual metaphors per section.\n"
    )

    data = ollama_generate_json(system=system, user=user)
    out = data.get("images") if isinstance(data, dict) else None

    if not isinstance(out, list) or len(out) == 0:
        neg_default = "text, letters, words, watermark, logo, brand, low quality, blurry, jpeg artifacts"
        prompts: List[Dict[str, str]] = []
        for i, it in enumerate(images, 1):
            section = it.get("section", "section")
            alt = it.get("alt", "")
            base_map = {
                "hero": "clean minimal premium SaaS concept, modern workspace, soft light, cinematic, ultra detailed",
                "problem": "minimal conceptual scene showing chaos to order transition, soft light, premium, ultra detailed",
                "solution": "minimal conceptual scene showing clarity and organization, premium lighting, ultra detailed",
                "benefits": "minimal symbolic scene showing efficiency and calm, soft gradients, premium, ultra detailed",
                "features": "minimal 3D render of modular blocks fitting together, premium studio light, ultra detailed",
                "audience": "minimal modern team collaboration concept, premium, soft light, ultra detailed",
                "usecases": "minimal modern office workflow concept, premium, soft light, ultra detailed",
                "integrations": "minimal connected nodes/network concept, premium, soft gradients, ultra detailed",
                "trust": "minimal secure vault/shield concept, premium, soft light, ultra detailed",
                "cta": "minimal aspirational modern scene, premium, soft light, ultra detailed",
                "faq": "minimal clean abstract scene, premium studio light, ultra detailed",
            }
            prompt = base_map.get(section, base_map["hero"])
            if alt:
                prompt = f"{prompt}, concept: {section}, {alt}"
            else:
                prompt = f"{prompt}, concept: {section}"
            prompts.append({"id": str(i), "prompt": prompt, "negative_prompt": neg_default})
        return prompts

    by_id = {x.get("id"): x for x in out if isinstance(x, dict)}
    results: List[Dict[str, str]] = []
    for i in range(1, len(images) + 1):
        x = by_id.get(i, {})
        prompt = (x.get("prompt") or "").strip()
        neg = (x.get("negative_prompt") or "").strip()
        if not prompt:
            prompt = "minimal premium SaaS concept render, clean modern workspace, soft light, cinematic, ultra detailed"
        if not neg:
            neg = "text, letters, words, watermark, logo, brand, low quality, blurry, jpeg artifacts"
        results.append({"id": str(i), "prompt": prompt, "negative_prompt": neg})

    return results


# ==========================================================
# STABLE DIFFUSION
# ==========================================================

def load_pipeline() -> Tuple[StableDiffusionPipeline, str]:
    # Switch CPU/GPU
    if FORCE_DEVICE in ("cpu", "cuda"):
        device = FORCE_DEVICE
    else:
        device = "cuda" if torch.cuda.is_available() else "cpu"

    dtype = torch.float16 if device == "cuda" else torch.float32

    pipe = StableDiffusionPipeline.from_pretrained(
        MODEL_ID,
        torch_dtype=dtype,
        safety_checker=None,
    ).to(device)

    if device == "cuda":
        try:
            pipe.enable_attention_slicing()
        except Exception:
            pass

    return pipe, device


def decide_output_path(json_dir: Path, src: str) -> Path:
    src_clean = (src or "").strip().lstrip("/")

    if src_clean.startswith("http://") or src_clean.startswith("https://"):
        fallback = f"img/{slugify(Path(src_clean).name)}{OUTPUT_EXT}"
        return (json_dir / fallback).resolve()

    p = (json_dir / src_clean)

    if RESPECT_SRC_EXTENSION and looks_like_image_path(src_clean):
        return p.resolve()

    if p.suffix:
        return p.with_suffix(OUTPUT_EXT).resolve()
    return Path(str(p) + OUTPUT_EXT).resolve()


def generate_one(pipe: StableDiffusionPipeline, prompt: str, negative: str, out_path: Path, seed: int) -> None:
    out_path.parent.mkdir(parents=True, exist_ok=True)

    # Generator compatible CPU/GPU
    g = torch.Generator(device=pipe.device).manual_seed(seed)

    result = pipe(
        prompt=prompt,
        negative_prompt=negative,
        num_inference_steps=STEPS,
        guidance_scale=GUIDANCE,
        height=HEIGHT,
        width=WIDTH,
        generator=g,
    )
    img = result.images[0]
    img.save(out_path)


# ==========================================================
# MAIN
# ==========================================================

def process_json_file(pipe: StableDiffusionPipeline, json_path: Path) -> None:
    print(f"\n📄 JSON: {json_path}")

    try:
        data = json.loads(json_path.read_text(encoding="utf-8"))
    except Exception as e:
        print(f"  ❌ Error leyendo JSON: {e}")
        return

    images = extract_images_with_context(data)
    if not images:
        print("  ⚠️  No se encontraron imágenes (@src)")
        return

    context = compact_context_from_json(data)

    print(f"  🧠 Context: title='{context.get('title','')}' slug='{context.get('slug','')}'")
    print(f"  🖼️  Imágenes encontradas: {len(images)}")
    print("  🤖 Pidiendo prompts a Ollama...")
    prompts = ask_ollama_for_prompts(context, images)

    json_dir = json_path.parent

    for idx, (img_info, pr) in enumerate(zip(images, prompts), start=1):
        src = img_info.get("src", "").strip()
        alt = img_info.get("alt", "").strip()
        section = img_info.get("section", "section")

        out_path = decide_output_path(json_dir, src)
        seed = SEED_BASE + idx

        if out_path.exists():
            print(f"  [{idx}/{len(images)}] ✅ SKIP existe: {out_path.relative_to(json_dir)}")
            continue

        prompt = pr["prompt"]
        negative = pr["negative_prompt"]

        if alt:
            prompt = f"{prompt}, concept: {section}, {alt}"
        else:
            prompt = f"{prompt}, concept: {section}"

        print(f"  [{idx}/{len(images)}] 🎨 GEN -> {out_path.relative_to(json_dir)}")
        try:
            generate_one(pipe, prompt, negative, out_path, seed)
        except Exception as e:
            print(f"     ❌ Error generando: {e}")


def main() -> None:
    folders = [p for p in INPUT_JSON_FOLDERS if p.exists()]
    if not folders:
        print("❌ No existe ninguna carpeta de INPUT_JSON_FOLDERS")
        return

    print("📂 Carpetas JSON:")
    for f in folders:
        print(f"   - {f}")

    print("\n🧱 Cargando Stable Diffusion pipeline (una sola vez)...")
    pipe, device = load_pipeline()
    print(f"✅ Device: {device}")

    for folder in folders:
        json_files = sorted(folder.glob("*.json"))
        if not json_files:
            print(f"\n⚠️  No hay JSON en: {folder}")
            continue

        print(f"\n📦 JSON encontrados en {folder}: {len(json_files)}")
        for jf in json_files:
            process_json_file(pipe, jf)

    print("\n✅ Done.")


if __name__ == "__main__":
    main()

