PRAGMA foreign_keys = ON;

-- =========================================================
-- ELIMINACIÓN PREVIA
-- =========================================================

DROP TABLE IF EXISTS lineas_pedido;
DROP TABLE IF EXISTS pedidos;
DROP TABLE IF EXISTS productos;
DROP TABLE IF EXISTS clientes;

-- =========================================================
-- TABLAS
-- =========================================================

CREATE TABLE clientes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL,
    apellidos TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    telefono TEXT,
    direccion TEXT,
    ciudad TEXT,
    provincia TEXT,
    codigo_postal TEXT,
    pais TEXT DEFAULT 'España',
    fecha_alta TEXT NOT NULL,
    activo INTEGER NOT NULL DEFAULT 1
);

CREATE TABLE productos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nombre TEXT NOT NULL,
    descripcion TEXT,
    categoria TEXT NOT NULL,
    sku TEXT NOT NULL UNIQUE,
    precio REAL NOT NULL,
    stock INTEGER NOT NULL DEFAULT 0,
    activo INTEGER NOT NULL DEFAULT 1
);

CREATE TABLE pedidos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    cliente_id INTEGER NOT NULL,
    fecha_pedido TEXT NOT NULL,
    estado TEXT NOT NULL CHECK (estado IN ('pendiente','pagado','enviado','entregado','cancelado')),
    metodo_pago TEXT CHECK (metodo_pago IN ('tarjeta','transferencia','paypal','bizum','financiacion')),
    direccion_envio TEXT,
    ciudad_envio TEXT,
    provincia_envio TEXT,
    codigo_postal_envio TEXT,
    pais_envio TEXT DEFAULT 'España',
    subtotal REAL NOT NULL DEFAULT 0,
    impuestos REAL NOT NULL DEFAULT 0,
    gastos_envio REAL NOT NULL DEFAULT 0,
    total REAL NOT NULL DEFAULT 0,
    observaciones TEXT,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id)
);

CREATE TABLE lineas_pedido (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    pedido_id INTEGER NOT NULL,
    producto_id INTEGER NOT NULL,
    cantidad INTEGER NOT NULL CHECK (cantidad > 0),
    precio_unitario REAL NOT NULL,
    descuento REAL NOT NULL DEFAULT 0,
    total_linea REAL NOT NULL,
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE,
    FOREIGN KEY (producto_id) REFERENCES productos(id)
);

