---
slug: modelos-generativos-gans-vaes
title: Modelos generativos: GANs y VAEs (comoprogramar.es)
description: Aprende cómo funcionan los modelos generativos basados en redes neuronales. Comprende y aplica GANs y VAEs para generar imágenes y datos continuos, entendiendo su teoría, entrenamiento y limitaciones reales.
keywords:
  - modelos generativos
  - gans
  - vae
  - generacion de imagenes
  - deep learning generativo
  - ia generativa fundamentos
level: Intermedio–Avanzado
duration_estimate: "40-60 horas"
prerequisites:
  - "Deep Learning con Python"
  - "Redes neuronales desde cero"
  - "Álgebra lineal aplicada a IA"
  - "Probabilidad y estadística para IA"
audience:
  - "Estudiantes de IA"
  - "Científicos de datos"
  - "Ingenieros de Deep Learning"
  - "Autodidactas avanzados"
updated: 2025-12-26
---

# Modelos generativos: GANs y VAEs

## Objetivos del curso

## Cómo usar este curso

## Aprender la distribución, no las etiquetas

---

# Unidad 1 — Qué es un modelo generativo

## 1.1 — Modelos discriminativos vs generativos

### Lección 1.1.1 — Clasificar frente a generar
### Lección 1.1.2 — Aprender la distribución de los datos
### Lección 1.1.3 — Casos de uso reales

## 1.2 — Datos continuos y latentes

### Lección 1.2.1 — Espacios de alta dimensión
### Lección 1.2.2 — Variables latentes
### Lección 1.2.3 — Intuición geométrica

---

# Unidad 2 — Introducción a los Autoencoders

## 2.1 — Autoencoder clásico

### Lección 2.1.1 — Encoder y decoder
### Lección 2.1.2 — Compresión y reconstrucción
### Lección 2.1.3 — Qué aprende realmente

## 2.2 — Limitaciones del autoencoder estándar

### Lección 2.2.1 — Espacio latente no continuo
### Lección 2.2.2 — No es realmente generativo
### Lección 2.2.3 — Problemas de interpolación

---

# Unidad 3 — Variational Autoencoders (VAE)

## 3.1 — Idea clave del VAE

### Lección 3.1.1 — Distribuciones en lugar de puntos
### Lección 3.1.2 — Regularización del espacio latente
### Lección 3.1.3 — Generación desde ruido

## 3.2 — Fundamentos probabilísticos

### Lección 3.2.1 — Inferencia variacional
### Lección 3.2.2 — ELBO
### Lección 3.2.3 — Trade-off reconstrucción–regularización

---

# Unidad 4 — Arquitectura y entrenamiento de VAEs

## 4.1 — Arquitectura típica

### Lección 4.1.1 — Encoder probabilístico
### Lección 4.1.2 — Reparameterization trick
### Lección 4.1.3 — Decoder generativo

## 4.2 — Entrenamiento práctico

### Lección 4.2.1 — Función de pérdida
### Lección 4.2.2 — Estabilidad del entrenamiento
### Lección 4.2.3 — Calidad vs diversidad

---

# Unidad 5 — Espacio latente en VAEs

## 5.1 — Interpretabilidad del espacio latente

### Lección 5.1.1 — Interpolaciones suaves
### Lección 5.1.2 — Atributos continuos
### Lección 5.1.3 — Visualización

## 5.2 — Limitaciones de VAEs

### Lección 5.2.1 — Imágenes borrosas
### Lección 5.2.2 — Capacidad limitada
### Lección 5.2.3 — Compromisos inevitables

---

# Unidad 6 — Introducción a GANs

## 6.1 — Idea adversarial

### Lección 6.1.1 — Generador y discriminador
### Lección 6.1.2 — Juego minimax
### Lección 6.1.3 — Intuición del entrenamiento

## 6.2 — Qué hace especiales a las GANs

### Lección 6.2.1 — Imágenes nítidas
### Lección 6.2.2 — Generación realista
### Lección 6.2.3 — Falta de control explícito

---

# Unidad 7 — Entrenamiento de GANs

## 7.1 — Proceso adversarial

### Lección 7.1.1 — Alternancia de entrenamiento
### Lección 7.1.2 — Equilibrio generador–discriminador
### Lección 7.1.3 — Dificultades prácticas

## 7.2 — Problemas clásicos

### Lección 7.2.1 — Mode collapse
### Lección 7.2.2 — Inestabilidad
### Lección 7.2.3 — Sensibilidad a hiperparámetros

---

# Unidad 8 — Variantes importantes de GANs

## 8.1 — DCGAN

### Lección 8.1.1 — Convoluciones en GANs
### Lección 8.1.2 — Arquitectura estándar
### Lección 8.1.3 — Buenas prácticas

## 8.2 — GANs avanzadas

### Lección 8.2.1 — Conditional GAN
### Lección 8.2.2 — CycleGAN
### Lección 8.2.3 — StyleGAN (visión conceptual)

---

# Unidad 9 — Comparación VAEs vs GANs

## 9.1 — Diferencias fundamentales

### Lección 9.1.1 — Probabilístico vs adversarial
### Lección 9.1.2 — Calidad visual vs estructura
### Lección 9.1.3 — Control del espacio latente

## 9.2 — Cuándo usar cada uno

### Lección 9.2.1 — Generación controlada
### Lección 9.2.2 — Realismo visual
### Lección 9.2.3 — Coste de entrenamiento

---

# Unidad 10 — Evaluación de modelos generativos

## 10.1 — Métricas automáticas

### Lección 10.1.1 — Reconstruction error
### Lección 10.1.2 — Inception Score
### Lección 10.1.3 — FID

## 10.2 — Evaluación humana

### Lección 10.2.1 — Realismo percibido
### Lección 10.2.2 — Diversidad
### Lección 10.2.3 — Sesgos visuales

---

# Unidad 11 — Riesgos y ética en modelos generativos

## 11.1 — Riesgos técnicos

### Lección 11.1.1 — Overfitting visual
### Lección 11.1.2 — Memorización
### Lección 11.1.3 — Uso indebido

## 11.2 — Implicaciones éticas

### Lección 11.2.1 — Deepfakes
### Lección 11.2.2 — Derechos de imagen
### Lección 11.2.3 — Uso responsable

---

# Unidad 12 — Mini-proyecto generativo

## 12.1 — Proyecto guiado completo

### Lección 12.1.1 — Selección del dataset
### Lección 12.1.2 — Implementación de un VAE o GAN
### Lección 12.1.3 — Entrenamiento y ajuste
### Lección 12.1.4 — Evaluación visual
### Lección 12.1.5 — Análisis crítico

---

# Unidad 13 — Siguientes pasos

## 13.1 — Qué aprender después

### Lección 13.1.1 — Modelos de difusión
### Lección 13.1.2 — Generación multimodal
### Lección 13.1.3 — IA generativa avanzada

## 13.2 — Ruta recomendada en comoprogramar.es

### Lección 13.2.1 — Introducción a la IA generativa
### Lección 13.2.2 — Modelos de difusión
### Lección 13.2.3 — Generación de imágenes con IA

---

## Recursos recomendados

## Glosario (opcional)

## Créditos

> Última actualización: **2025-12-26**

