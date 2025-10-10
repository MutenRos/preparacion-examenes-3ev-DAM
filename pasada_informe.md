# Informe de pasada — ingests y backups

Fecha: 2025-10-05

Resumen ejecutivo
- Se ha realizado un escaneo completo de los directorios `entregas/**/ingested_backups_*` y de los informes JSON (`ingest_report.json`, `lesson_mapping_report.json`).
- Resultado: la mayoría de los ficheros encontrados en `ingested_backups_*` ya están marcados como `incorporated_to_submission` en `ingest_report.json`.
- Acciones realizadas: se eliminó el backup agregado `entregas/Segundo/ingested_backups_1759664344/submission.md` y su directorio quedó también borrado (estaba vacío). `lesson_mapping_report.json` contiene la entrada `archived` apuntando a ese aggregate para trazabilidad.

Estado de los informes
- `entregas/ingest_report.json`: 7 entradas; todas las mencionadas en este informe están marcadas `incorporated_to_submission`.
- `entregas/lesson_mapping_report.json`: JSON válido; incluye la entrada archivada para el aggregate que fue eliminado.

Detalle por directorio `ingested_backups_*`

1) /home/dlc/Escritorio/DAM2527/dam2526/entregas/Primero/Proyecto intermodular/001-Búsqueda de información/ingested_backups_1759664493
- Contenido: vacío
- Recomendación: eliminar el directorio (no hay ficheros que preservar).

2) /home/dlc/Escritorio/DAM2527/dam2526/entregas/Primero/Proyecto intermodular/001-Búsqueda de información/ingested_backups_1759664723
- Contenido: vacío
- Recomendación: eliminar el directorio.

3) /home/dlc/Escritorio/DAM2527/dam2526/entregas/Primero/Lenguajes de marcas y sistemas de gestión de información/001-Reconocimiento de las características de lenguajes de marcas/001-Clasificación/entregas/ingested_backups_1759665015
- Ficheros:
  - Lección dam2526PrimeroLenguajes de marcas y sistemas de gestión de información001-Reconocimiento de las características de lenguajes de marcas001-Clasificación.txt
  - Estado: ya incorporado (`incorporated_to_submission`), aparece en `ingest_report.json` con ruta destino:
    `/home/dlc/Escritorio/DAM2527/dam2526/entregas/Primero/Lenguajes de marcas y sistemas de gestión de información/001-Reconocimiento de las características de lenguajes de marcas/001-Clasificación/submission.md`
- Recomendación: eliminar el directorio `ingested_backups_1759665015` si no necesita conservarse la copia individual (los ficheros fuente ya están en `ingest_report.json` y en el submission.md destino). Alternativa: comprimir y archivar fuera del árbol `entregas/`.

4) /home/dlc/Escritorio/DAM2527/dam2526/entregas/Primero/Entornos de desarrollo/001-Desarrollo de software/ingested_backups_1759664790
- Contenido: vacío
- Recomendación: eliminar el directorio.

5) /home/dlc/Escritorio/DAM2527/dam2526/entregas/Primero/Entornos de desarrollo/001-Concepto de programa informático/entregas/ingested_backups_1759665015
- Ficheros:
  - Lección dam2526PrimeroEntornos de desarrollo001-Desarrollo de software001-Concepto de programa informático.txt
  - Estado: incorporado (`incorporated_to_submission`) a:
    `/home/dlc/Escritorio/DAM2527/dam2526/entregas/Primero/Entornos de desarrollo/001-Desarrollo de software/submission.md`
- Recomendación: borrar el directorio `ingested_backups_1759665015` si no se desea conservar la copia.

6) /home/dlc/Escritorio/DAM2527/dam2526/entregas/Primero/Bases de datos/entregas/ingested_backups_1759665015
- Ficheros:
  - Lección dam2526PrimeroBases de datos001-Almacenamiento de la información004-Bases de datos centralizadas y bases de datos distribuidas. Técnicas de fragmentación.txt
  - Estado: incorporado (`incorporated_to_submission`) a:
    `/home/dlc/Escritorio/DAM2527/dam2526/entregas/Primero/Bases de datos/001-Almacenamiento de la información/submission.md`
- Recomendación: eliminar el directorio si se considera redundante.

7) /home/dlc/Escritorio/DAM2527/dam2526/entregas/Primero/Bases de datos/001-Almacenamiento de la información/ingested_backups_1759664790
- Ficheros:
  - Lección dam2526PrimeroBases de datos001-Almacenamiento de la información001-Ficheros (planos, indexados, acceso directo, entre otros).txt
  - Lección dam2526PrimeroBases de datos001-Almacenamiento de la información006-Big Data introducción, análisis de datos, inteligencia de negocios.txt
  - Estado: ambas entradas están marcadas `incorporated_to_submission` y su destino es:
    `/home/dlc/Escritorio/DAM2527/dam2526/entregas/Primero/Bases de datos/001-Almacenamiento de la información/submission.md`
- Recomendación: eliminar el directorio `ingested_backups_1759664790` (o comprimirlo fuera del árbol `entregas/`).

8) /home/dlc/Escritorio/DAM2527/dam2526/entregas/Primero/Bases de datos/001-Almacenamiento de la información/005-Legislación sobre protección de datos/entregas/ingested_backups_1759665015
- Ficheros:
  - Lección dam2526PrimeroBases de datos001-Almacenamiento de la información005-Legislación sobre protección de datos.txt
  - Estado: incorporado (`incorporated_to_submission`) al submission.md de la lección.
- Recomendación: eliminar el directorio si no se requiere conservar la copia.

9) /home/dlc/Escritorio/DAM2527/dam2526/entregas/Primero/Bases de datos/001-Almacenamiento de la información/003-Sistemas gestores de base de datos Funciones, componentes y tipos/entregas/ingested_backups_1759665015
- Ficheros:
  - Lección dam2526PrimeroBases de datos001-Almacenamiento de la información003-Sistemas gestores de base de datos Funciones, componentes y tipos.txt
  - Estado: incorporado (`incorporated_to_submission`).
- Recomendación: eliminar el directorio si se desea limpiar.

10) /home/dlc/Escritorio/DAM2527/dam2526/entregas/Segundo/Sistemas de gestión empresarial/.../ingested_backups_1759664672 (y otras rutas dentro de `entregas/entregas_backup_1759664029`)
- Contenido: varios directorios vacíos o sin ficheros relevantes.
- Recomendación: se pueden eliminar sin pérdida.

Acciones tomadas durante la pasada
- Eliminado: `/home/dlc/Escritorio/DAM2527/dam2526/entregas/Segundo/ingested_backups_1759664344/submission.md` y su directorio padre (quedó vacío y fue borrado).
- No se han modificado ni eliminado `ingest_report.json` ni `lesson_mapping_report.json`; solo se validaron y se conservaron como fuente de verdad.

Recomendaciones finales y próxima acción propuesta
1. Si quieres que limpie el árbol y elimine los `ingested_backups_*` ya redundantes, puedo hacerlo ahora. Propuesta segura: crear un archivo comprimido (tar.gz) con todos los `ingested_backups_*` antes de borrarlos, y luego eliminar los directorios.
2. Alternativa conservadora: borrar únicamente los directorios vacíos y los aggregate (ya detectados), y dejar las subcarpetas con ficheros durante un ciclo de verificación manual.

Comandos sugeridos (ejecutar en la raíz del repo si confirmas la limpieza)
```bash
# crear backup comprimido de los ingested_backups que se van a borrar
tar -czvf entregas/ingested_backups_backup_$(date +%s).tar.gz $(find entregas -type d -name 'ingested_backups_*')

# eliminar todos los directorios ingested_backups vacíos y aquellos previamente marcados como seguros (recomendado solo si confirmas)
find entregas -type d -name 'ingested_backups_*' -empty -print -exec rm -r {} +

# (opcional) eliminar directorios ingested_backups cuyos ficheros aparezcan todos como incorporated_to_submission según ingest_report.json
# Esta operación es conservadora: revisa primero el informe antes de ejecutar.
```

Si quieres que proceda con la limpieza automática (crear tar.gz y borrar los directorios seguros), dime "ejecuta limpieza" y lo haré. Si prefieres revisar manualmente, puedo generar una lista exacta de rutas a eliminar para tu aprobación.

---
Fin del informe
