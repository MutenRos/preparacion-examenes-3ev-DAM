# Rubrica checklists

Carpeta para almacenar extractos de rúbricas (criterios) en formato JSON. Cada archivo JSON representa la rúbrica de una unidad didáctica y contiene los criterios detectados en el archivo `Criterios de evaluacion.md` original.

Formato de un fichero JSON:

- `unidad`: ruta relativa de la unidad.
- `archivo_origen`: ruta del md original donde se extrajeron los criterios.
- `criterios`: lista con objetos `{ id, texto, peso }`. Si no hay pesos explícitos, `peso` es `null`.

Uso propuesto:

1. Se puede implementar un script que convierta estos JSON a checklists automatizados.
2. Integrar en CI para validar entregas frente a criterios (presencia de evidencias, tests, documentación).
