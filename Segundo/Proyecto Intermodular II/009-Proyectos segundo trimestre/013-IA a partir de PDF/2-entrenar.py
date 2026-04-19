#!/usr/bin/env python3
# -*- coding: utf-8 -*-

"""
train_qwen_lora_from_pretraining_outputs_masked_gpu_8gb_safe.py

LoRA SFT (masked) on GPU with settings tuned to fit ~8GB VRAM.

Key changes vs your previous version (to avoid OOM on 8GB):
- Uses bitsandbytes 4-bit (preferred) or 8-bit quantized base model when available
- Disables logits/prediction storage in eval (prediction_loss_only=True) + eval_accumulation_steps
- Evaluates only at end of each epoch (eval_strategy="epoch") to avoid step-eval spikes
- Uses default_data_collator (no MLM collator)
- Enables gradient checkpointing + disables KV cache
- Uses shorter MAX_LENGTH default (384) + padding to max_length (stable memory)
- Uses paged_adamw_8bit optimizer (when bitsandbytes is present) to reduce memory

Requirements:
  pip install torch datasets transformers peft
Optional but strongly recommended (for 4-bit/8-bit):
  pip install bitsandbytes

Run:
  python3 train_qwen_lora_from_pretraining_outputs_masked_gpu_8gb_safe.py
"""

import os
import json
import glob
import hashlib
import platform
from datetime import datetime
from typing import List, Dict, Tuple, Optional

import torch
from datasets import Dataset
from transformers import (
    AutoTokenizer,
    AutoModelForCausalLM,
    Trainer,
    TrainingArguments,
    default_data_collator,
)
from peft import LoraConfig, get_peft_model


# -------------------------------------------------------------------
# CONFIG
# -------------------------------------------------------------------

DATA_GLOB = "outputs/jsonl/**/*.jsonl"
OUTPUT_DIR = "./qwen25-05b-jvc-lora"

MODEL_NAME = "Qwen/Qwen2.5-0.5B-Instruct"

# Memory-safe defaults for 8GB VRAM
MAX_LENGTH = 384            # was 512; 384 is much safer on 8GB
NUM_EPOCHS = 3
LR = 2e-4
BATCH_SIZE = 1
GRAD_ACCUM = 4

# Dataset options
SHUFFLE = True
SEED = 42
TRAIN_RATIO = 0.95

# Dedupe options
DEDUPLICATE_BY_QA = True
DEDUPLICATE_BY_Q_ONLY = True
DROP_CONFLICTING_Q = True

SYSTEM_PROMPT = (
    "Eres un asistente educativo en español que responde de forma clara, "
    "precisa y concisa a preguntas técnicas."
)

UNKNOWN_SENTENCE = "No dispongo de esa información en el material de formación con el que fui entrenado."


# -------------------------------------------------------------------
# REPORT (kept from your script; trimmed slightly)
# -------------------------------------------------------------------

def generate_markdown_report(
    *,
    start_dt: datetime,
    end_dt: datetime,
    device: str,
    jsonl_files: List[str],
    per_file_counts: List[Dict],
    dataset_size: int,
    train_size: int,
    eval_size: int,
    training_args: TrainingArguments,
    train_metrics: Optional[Dict],
    quant_mode: str,
) -> str:
    duration = end_dt - start_dt
    epoch = int(end_dt.timestamp())
    timestamp_str = end_dt.strftime("%Y%m%d_%H%M%S")
    report_name = f"reporte_entrenamiento_{timestamp_str}_{epoch}.md"
    report_path = os.path.join(OUTPUT_DIR, report_name)

    try:
        import transformers
    except ImportError:
        transformers = None
    try:
        import peft as peft_mod
    except ImportError:
        peft_mod = None
    try:
        import bitsandbytes as bnb_mod
    except ImportError:
        bnb_mod = None

    system_info = {
        "Sistema operativo": platform.system(),
        "Versión del sistema": platform.version(),
        "Plataforma": platform.platform(),
        "Máquina": platform.machine(),
        "Procesador": platform.processor(),
        "Python": platform.python_version(),
        "PyTorch": torch.__version__,
        "Transformers": getattr(transformers, "__version__", "desconocido") if transformers else "no instalado",
        "PEFT": getattr(peft_mod, "__version__", "desconocido") if peft_mod else "no instalado",
        "bitsandbytes": getattr(bnb_mod, "__version__", "desconocido") if bnb_mod else "no instalado",
        "CUDA disponible": torch.cuda.is_available(),
        "Dispositivo de entrenamiento": device,
        "Modo cuantización": quant_mode,
        "Directorio de trabajo": os.getcwd(),
    }

    lines: List[str] = []
    lines.append("# Informe de entrenamiento (LoRA) con Q/A JSONL\n")
    lines.append("## Resumen\n")
    lines.append(f"- **Inicio:** {start_dt.strftime('%Y-%m-%d %H:%M:%S')}")
    lines.append(f"- **Fin:** {end_dt.strftime('%Y-%m-%d %H:%M:%S')}")
    lines.append(f"- **Duración:** {duration}")
    lines.append(f"- **Modelo base:** `{MODEL_NAME}`")
    lines.append(f"- **Output:** `{OUTPUT_DIR}`")
    lines.append(f"- **Patrón de datos:** `{DATA_GLOB}`")
    lines.append(f"- **Ficheros JSONL:** {len(jsonl_files)}")
    lines.append(f"- **Dataset final:** {dataset_size} ejemplos")
    lines.append(f"- **Train/Eval:** {train_size}/{eval_size} (ratio {TRAIN_RATIO})")
    lines.append(f"- **Dispositivo:** {device}")
    lines.append(f"- **Cuantización:** {quant_mode}")
    lines.append("")

    lines.append("## Parámetros de entrenamiento\n")
    lines.append(f"- **NUM_EPOCHS:** {NUM_EPOCHS}")
    lines.append(f"- **LR:** {LR}")
    lines.append(f"- **BATCH_SIZE:** {BATCH_SIZE}")
    lines.append(f"- **GRAD_ACCUM:** {GRAD_ACCUM}")
    lines.append(f"- **MAX_LENGTH:** {MAX_LENGTH}")
    lines.append(f"- **DEDUPLICATE_BY_QA:** {DEDUPLICATE_BY_QA}")
    lines.append(f"- **DEDUPLICATE_BY_Q_ONLY:** {DEDUPLICATE_BY_Q_ONLY}")
    lines.append(f"- **DROP_CONFLICTING_Q:** {DROP_CONFLICTING_Q}")
    lines.append("")

    lines.append("### TrainingArguments efectivos\n")
    for k, v in sorted(training_args.to_dict().items()):
        lines.append(f"- **{k}:** {v}")
    lines.append("")

    lines.append("## Métricas\n")
    if train_metrics:
        for k, v in train_metrics.items():
            lines.append(f"- **{k}:** {v}")
    else:
        lines.append("- No se recibieron métricas desde `Trainer.train()`.")
    lines.append("")

    lines.append("## Entorno\n")
    for k, v in system_info.items():
        lines.append(f"- **{k}:** {v}")
    lines.append("")

    lines.append("## Recuento por fichero JSONL\n")
    for idx, info in enumerate(per_file_counts, start=1):
        base = os.path.basename(info["file"])
        lines.append(f"- [Archivo {idx}: `{base}`](#archivo-jsonl-{idx})")
    lines.append("")

    for idx, info in enumerate(per_file_counts, start=1):
        lines.append(f"<a name=\"archivo-jsonl-{idx}\"></a>")
        lines.append(f"### Archivo JSONL {idx}\n")
        lines.append(f"- **Ruta:** `{info['file']}`")
        lines.append(f"- **Líneas no vacías:** {info.get('lines_nonempty')}")
        lines.append(f"- **Ejemplos válidos (question+answer):** {info.get('valid_examples')}")
        lines.append(f"- **Ejemplos descartados:** {info.get('dropped')}")
        if info.get("conflicts"):
            lines.append(f"- **Conflictos (misma pregunta, distinta respuesta):** {info.get('conflicts')}")
        if info.get("error"):
            lines.append(f"- **Error:** `{info['error']}`")
        lines.append("")

    os.makedirs(OUTPUT_DIR, exist_ok=True)
    with open(report_path, "w", encoding="utf-8") as f:
        f.write("\n".join(lines))

    print(f"📝 Informe de entrenamiento generado en: {report_path}")
    return report_path


# -------------------------------------------------------------------
# DATA LOADING
# -------------------------------------------------------------------

def _norm(s: str) -> str:
    return " ".join(str(s).strip().lower().split())


def _sha1(s: str) -> str:
    return hashlib.sha1(s.encode("utf-8")).hexdigest()


def load_qa_from_jsonl_files(jsonl_files: List[str]) -> Tuple[Dataset, List[Dict]]:
    all_q: List[str] = []
    all_a: List[str] = []
    seen_qa = set()
    per_file_counts: List[Dict] = []

    for path in sorted(jsonl_files):
        stats = {
            "file": path,
            "lines_nonempty": 0,
            "valid_examples": 0,
            "dropped": 0,
            "conflicts": 0,
            "error": None,
        }
        q_to_a_norm: Dict[str, str] = {}

        try:
            with open(path, "r", encoding="utf-8", errors="ignore") as f:
                for line in f:
                    line = line.strip()
                    if not line:
                        continue
                    stats["lines_nonempty"] += 1

                    if not (line.startswith("{") and line.endswith("}")):
                        if "{" in line and "}" in line:
                            line = line[line.find("{"): line.rfind("}") + 1]
                        else:
                            stats["dropped"] += 1
                            continue

                    try:
                        obj = json.loads(line)
                    except Exception:
                        stats["dropped"] += 1
                        continue

                    q = obj.get("question", "")
                    a = obj.get("answer", "")
                    if not isinstance(q, str) or not isinstance(a, str):
                        stats["dropped"] += 1
                        continue

                    q = q.strip()
                    a = a.strip()
                    if not q or not a:
                        stats["dropped"] += 1
                        continue

                    qn = _norm(q)
                    an = _norm(a)

                    if DEDUPLICATE_BY_Q_ONLY:
                        prev = q_to_a_norm.get(qn)
                        if prev is not None and prev != an:
                            stats["conflicts"] += 1
                        else:
                            q_to_a_norm[qn] = an

                    if DEDUPLICATE_BY_QA:
                        key = _sha1(qn + "\n" + an)
                        if key in seen_qa:
                            stats["dropped"] += 1
                            continue
                        seen_qa.add(key)

                    all_q.append(q)
                    all_a.append(a)
                    stats["valid_examples"] += 1

        except Exception as e:
            stats["error"] = str(e)

        per_file_counts.append(stats)

    if DEDUPLICATE_BY_Q_ONLY:
        q_map: Dict[str, List[str]] = {}
        for q, a in zip(all_q, all_a):
            qn = _norm(q)
            q_map.setdefault(qn, []).append(a)

        filtered_q: List[str] = []
        filtered_a: List[str] = []

        for qn, answers in q_map.items():
            uniq_norm = list({_norm(x) for x in answers})
            if DROP_CONFLICTING_Q and len(uniq_norm) > 1:
                continue
            chosen = answers[0]
            filtered_q.append(qn)
            filtered_a.append(chosen.strip())

        ds = Dataset.from_dict({"question": filtered_q, "answer": filtered_a})
    else:
        ds = Dataset.from_dict({"question": all_q, "answer": all_a})

    if SHUFFLE and len(ds) > 1:
        ds = ds.shuffle(seed=SEED)

    return ds, per_file_counts


# -------------------------------------------------------------------
# MASKED SFT BUILD
# -------------------------------------------------------------------

def build_prompt_and_full(tokenizer, question: str, answer: str) -> Tuple[str, str]:
    conv_prompt = [
        {"role": "system", "content": SYSTEM_PROMPT},
        {"role": "user", "content": question},
    ]
    conv_full = [
        {"role": "system", "content": SYSTEM_PROMPT},
        {"role": "user", "content": question},
        {"role": "assistant", "content": answer},
    ]

    try:
        prompt_text = tokenizer.apply_chat_template(
            conv_prompt, tokenize=False, add_generation_prompt=True
        )
        full_text = tokenizer.apply_chat_template(
            conv_full, tokenize=False, add_generation_prompt=False
        )
    except Exception:
        prompt_text = f"Sistema: {SYSTEM_PROMPT}\nUsuario: {question}\nAsistente:"
        full_text = f"Sistema: {SYSTEM_PROMPT}\nUsuario: {question}\nAsistente: {answer}\n"

    return prompt_text, full_text


def tokenize_with_prompt_masking(tokenizer, prompt_text: str, full_text: str) -> Dict:
    # Full sequence (padded to max_length)
    full = tokenizer(
        full_text,
        truncation=True,
        max_length=MAX_LENGTH,
        padding="max_length",
    )

    # Prompt tokenization WITHOUT padding => exact length
    prompt = tokenizer(
        prompt_text,
        truncation=True,
        max_length=MAX_LENGTH,
        padding=False,
    )

    input_ids = full["input_ids"]
    labels = input_ids.copy()

    prompt_len = len(prompt["input_ids"])
    for i in range(min(prompt_len, len(labels))):
        labels[i] = -100

    full["labels"] = labels
    return full


# -------------------------------------------------------------------
# MODEL LOADING (8GB-safe)
# -------------------------------------------------------------------

def load_model_8gb_safe(model_name: str):
    """
    Prefer 4-bit (bnb) -> 8-bit (bnb) -> fp16.
    Returns (model, quant_mode_str)
    """
    device = "cuda" if torch.cuda.is_available() else "cpu"
    if device != "cuda":
        raise RuntimeError("CUDA no disponible. Este script está pensado para GPU.")

    torch.backends.cuda.matmul.allow_tf32 = True

    # Try bitsandbytes 4-bit/8-bit
    try:
        import bitsandbytes  # noqa: F401

        # 4-bit is usually the safest on 8GB
        model = AutoModelForCausalLM.from_pretrained(
            model_name,
            load_in_4bit=True,
            device_map={"": 0},
        )
        return model, "bnb-4bit"
    except Exception as e4:
        print(f"⚠️  4-bit load failed: {e4}")

    try:
        import bitsandbytes  # noqa: F401
        model = AutoModelForCausalLM.from_pretrained(
            model_name,
            load_in_8bit=True,
            device_map={"": 0},
        )
        return model, "bnb-8bit"
    except Exception as e8:
        print(f"⚠️  8-bit load failed: {e8}")

    # Fallback fp16 (may still fit on 8GB for 0.5B, but less safe)
    model = AutoModelForCausalLM.from_pretrained(
        model_name,
        torch_dtype=torch.float16,
        device_map={"": 0},
    )
    return model, "fp16"


# -------------------------------------------------------------------
# MAIN
# -------------------------------------------------------------------

def main():
    start_dt = datetime.now()

    print("🚀 Starting training (masked SFT LoRA, 8GB VRAM safe)")
    print(f"📁 Data glob: {DATA_GLOB}")
    print(f"🧠 Base model: {MODEL_NAME}")
    print(f"📦 Output dir: {OUTPUT_DIR}")
    print("-" * 70)

    if not torch.cuda.is_available():
        raise RuntimeError("CUDA GPU no detectada. Este script es para entrenamiento en GPU.")

    # Reduce fragmentation within this run (does not affect system globally)
    os.environ.setdefault("PYTORCH_CUDA_ALLOC_CONF", "expandable_segments:True")

    # locate JSONL
    jsonl_files = [p for p in glob.glob(DATA_GLOB, recursive=True) if os.path.isfile(p)]
    if not jsonl_files:
        raise FileNotFoundError(
            f"No JSONL files found with pattern: {DATA_GLOB}\n"
            "Run the PDF pretraining script first (it should write into outputs/jsonl/)."
        )

    device = "cuda"
    print("💻 CUDA GPU detected. Training on GPU with memory-safe settings.")

    # dataset
    print("📥 Loading Q/A from JSONL files...")
    raw_dataset, per_file_counts = load_qa_from_jsonl_files(jsonl_files)
    if len(raw_dataset) == 0:
        raise RuntimeError("Dataset vacío: no se encontraron ejemplos válidos question/answer en los JSONL.")
    print(f"✅ Dataset ready with {len(raw_dataset)} examples.")

    # split train/eval
    if len(raw_dataset) >= 20 and 0.0 < TRAIN_RATIO < 1.0:
        split = raw_dataset.train_test_split(test_size=(1.0 - TRAIN_RATIO), seed=SEED, shuffle=SHUFFLE)
        train_ds = split["train"]
        eval_ds = split["test"]
    else:
        train_ds = raw_dataset
        eval_ds = None
    print(f"🧪 Split -> train: {len(train_ds)} | eval: {len(eval_ds) if eval_ds is not None else 0}")

    # tokenizer
    print("✅ Loading tokenizer...")
    tokenizer = AutoTokenizer.from_pretrained(MODEL_NAME, use_fast=True)
    if tokenizer.pad_token is None:
        tokenizer.pad_token = tokenizer.eos_token

    # model (8GB-safe)
    print("✅ Loading base model (8GB-safe)...")
    model, quant_mode = load_model_8gb_safe(MODEL_NAME)
    print(f"✅ Model loaded with mode: {quant_mode}")

    # Memory savers
    model.config.use_cache = False
    try:
        model.gradient_checkpointing_enable()
        print("✅ Gradient checkpointing enabled.")
    except Exception as e:
        print(f"⚠️  Could not enable gradient checkpointing: {e}")

    # LoRA
    print("✅ Wrapping model with LoRA...")
    lora_config = LoraConfig(
        r=8,
        lora_alpha=16,
        target_modules=[
            "q_proj", "k_proj", "v_proj", "o_proj",
            "gate_proj", "up_proj", "down_proj"
        ],
        lora_dropout=0.05,
        bias="none",
        task_type="CAUSAL_LM",
    )
    model = get_peft_model(model, lora_config)
    model.print_trainable_parameters()

    # build masked SFT dataset
    print("🧱 Building masked SFT features...")

    def to_features(example):
        q = str(example.get("question", "")).strip()
        a = str(example.get("answer", "")).strip()
        prompt_text, full_text = build_prompt_and_full(tokenizer, q, a)
        return tokenize_with_prompt_masking(tokenizer, prompt_text, full_text)

    train_tok = train_ds.map(to_features, remove_columns=train_ds.column_names)
    eval_tok = eval_ds.map(to_features, remove_columns=eval_ds.column_names) if eval_ds is not None else None

    # collator: do NOT use MLM collator; your labels are already provided
    data_collator = default_data_collator

    # TrainingArguments (avoid eval OOM)
    print("✅ Configuring TrainingArguments...")
    # If using bnb quant, use memory-friendly optimizer
    optim_name = "paged_adamw_8bit" if quant_mode.startswith("bnb-") else "adamw_torch"

    training_args = TrainingArguments(
        output_dir=OUTPUT_DIR,
        overwrite_output_dir=True,
        num_train_epochs=NUM_EPOCHS,
        per_device_train_batch_size=BATCH_SIZE,
        gradient_accumulation_steps=GRAD_ACCUM,
        learning_rate=LR,
        weight_decay=0.01,
        warmup_ratio=0.03,
        logging_steps=10,

        # Critical to avoid eval spikes on 8GB:
        eval_strategy="epoch" if eval_tok is not None else "no",
        save_strategy="epoch",
        prediction_loss_only=True,
        eval_accumulation_steps=1,
        per_device_eval_batch_size=1,

        # Mixed precision (only if not CPU)
        fp16=True,          # safe with 4-bit/8-bit base; compute still runs in fp16 where applicable
        bf16=False,

        # Reduce extra memory pressure
        dataloader_pin_memory=False,
        dataloader_num_workers=0,

        # Keep checkpoints small
        save_total_limit=1,

        # Optimizer
        optim=optim_name,

        report_to="none",
        max_grad_norm=1.0,
    )

    # Trainer
    print("✅ Creating Trainer...")
    trainer = Trainer(
        model=model,
        args=training_args,
        train_dataset=train_tok,
        eval_dataset=eval_tok,
        data_collator=data_collator,
        compute_metrics=None,
    )

    # Train
    print("🚂 Starting training...")
    train_output = trainer.train()
    print("🏁 Training finished.")

    # Save
    print("💾 Saving model (LoRA adapters) and tokenizer to", OUTPUT_DIR)
    trainer.save_model(OUTPUT_DIR)
    tokenizer.save_pretrained(OUTPUT_DIR)
    print("✅ Done.")

    # Report
    end_dt = datetime.now()
    train_metrics = getattr(train_output, "metrics", None) if train_output is not None else None

    generate_markdown_report(
        start_dt=start_dt,
        end_dt=end_dt,
        device=device,
        jsonl_files=jsonl_files,
        per_file_counts=per_file_counts,
        dataset_size=len(raw_dataset),
        train_size=len(train_ds),
        eval_size=(len(eval_ds) if eval_ds is not None else 0),
        training_args=training_args,
        train_metrics=train_metrics,
        quant_mode=quant_mode,
    )


if __name__ == "__main__":
    main()

