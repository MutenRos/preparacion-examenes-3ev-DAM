# Proyecto Intermodular · 3ª Evaluación

Estructurado en tres carpetas para distinguir orígenes:

| Carpeta                                              | Contenido                                                                             |
| ---------------------------------------------------- | ------------------------------------------------------------------------------------- |
| [`1-originales-jocarsa/`](./1-originales-jocarsa/)   | Repos originales del profesor (clonar de github.com/jocarsa).                         |
| [`2-mis-proyectos/`](./2-mis-proyectos/)             | Código real de cada proyecto con mis mejoras (PHP, Python, Flask, HTML…).             |
| [`3-mockups-pages/`](./3-mockups-pages/)             | Páginas estáticas de demo subidas a GitHub Pages (capturas de pantalla, sin backend). |

## Estado de sincronización (13-05-2026)

- Cobertura por número de proyecto en las tres variantes: `001` a `037`.
- Total actual por carpeta:
  - `1-originales-jocarsa`: 37 proyectos
  - `2-mis-proyectos`: 37 proyectos
  - `3-mockups-pages`: 37 proyectos
- Criterio de verificación: igualdad por identificador `NNN` aunque cambie el nombre (slug/capitalización/tildes).

## Orden recomendado para grabación y capturas

1. `1-originales-jocarsa`: enseñar base/origen.
2. `2-mis-proyectos`: enseñar mejoras funcionales.
3. `3-mockups-pages`: enseñar demo visual desplegable en Pages.

Así se demuestra en cada proyecto el flujo completo: original -> versión mejorada -> mockup demostrable.

## Stack del intermodular final

```
Flask (Python) ←→ MySQL ←→ HTML/CSS/JS
     ↑
  app_flask.py
```

## Checklist de preparación

- [ ] Base de datos `Examen` creada con tablas Proyectos y Categorias
- [ ] Script CRUD consola funcionando (`portfolio_crud.py`)
- [ ] App Flask corriendo en puerto 5000
- [ ] Web accesible en http://192.168.1.80:5000/
- [ ] API JSON en http://192.168.1.80:5000/api/proyectos
