"""
Script Python para controlar LED con Raspberry Pi GPIO
Proyecto: Indicador de estado de impresión 3D
"""

import RPi.GPIO as GPIO
import time

# Configuración
LED_VERDE = 17  # GPIO 17 - Impresión OK
LED_ROJO = 27   # GPIO 27 - Error
LED_AZUL = 22   # GPIO 22 - Imprimiendo

def setup():
    """Configurar pines GPIO"""
    GPIO.setmode(GPIO.BCM)
    GPIO.setup(LED_VERDE, GPIO.OUT)
    GPIO.setup(LED_ROJO, GPIO.OUT)
    GPIO.setup(LED_AZUL, GPIO.OUT)
    
    # Apagar todos los LEDs al inicio
    GPIO.output(LED_VERDE, GPIO.LOW)
    GPIO.output(LED_ROJO, GPIO.LOW)
    GPIO.output(LED_AZUL, GPIO.LOW)

def led_imprimiendo():
    """LED azul parpadeando - impresión en curso"""
    GPIO.output(LED_AZUL, GPIO.HIGH)
    time.sleep(0.5)
    GPIO.output(LED_AZUL, GPIO.LOW)
    time.sleep(0.5)

def led_completado():
    """LED verde encendido - impresión completa"""
    GPIO.output(LED_AZUL, GPIO.LOW)
    GPIO.output(LED_ROJO, GPIO.LOW)
    GPIO.output(LED_VERDE, GPIO.HIGH)

def led_error():
    """LED rojo parpadeando - error en impresión"""
    GPIO.output(LED_VERDE, GPIO.LOW)
    GPIO.output(LED_AZUL, GPIO.LOW)
    for _ in range(5):
        GPIO.output(LED_ROJO, GPIO.HIGH)
        time.sleep(0.2)
        GPIO.output(LED_ROJO, GPIO.LOW)
        time.sleep(0.2)

def cleanup():
    """Limpiar configuración GPIO"""
    GPIO.cleanup()

if __name__ == "__main__":
    try:
        setup()
        print("Sistema de indicadores iniciado")
        
        # Simular secuencia de impresión
        print("Imprimiendo...")
        for _ in range(10):
            led_imprimiendo()
        
        print("Impresión completada!")
        led_completado()
        time.sleep(5)
        
    except KeyboardInterrupt:
        print("\nInterrumpido por usuario")
    except Exception as e:
        print(f"Error: {e}")
        led_error()
    finally:
        cleanup()
        print("GPIO limpiado")
