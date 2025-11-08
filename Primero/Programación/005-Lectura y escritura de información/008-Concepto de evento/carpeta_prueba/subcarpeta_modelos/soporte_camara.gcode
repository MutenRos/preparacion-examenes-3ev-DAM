; Archivo GCODE generado por Cura 5.0
; Modelo: soporte_camara_v2.stl
; Material: PLA
; Filamento usado: 5.2m
; Peso: 15g
; Tiempo estimado: 2h 30min

M140 S60 ; Calentar cama a 60°C
M104 S210 ; Calentar extrusor a 210°C
M190 S60 ; Esperar cama
M109 S210 ; Esperar extrusor
G28 ; Home all axes
G1 Z15.0 F6000 ; Levantar nozzle
M117 Imprimiendo... ; Mensaje LCD

; Layer 1 de 150
G0 F6000 X50 Y50 Z0.2
G1 F1200 E0.0
G1 F1200 X60 Y50 E0.5
G1 F1200 X60 Y60 E1.0
; ... más comandos G-code ...

M104 S0 ; Apagar extrusor
M140 S0 ; Apagar cama
G28 X0 Y0 ; Home X e Y
M84 ; Apagar motores
M117 Impresión completa
