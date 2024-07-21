DROP DATABASE IF EXISTS factura;

CREATE DATABASE factura;

USE factura;

-- Crear tabla users
CREATE TABLE users (
    id int(11) NOT NULL AUTO_INCREMENT,
    username varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    last_login DATETIME DEFAULT NULL,
    login_attempts INT DEFAULT 0,
    role INT DEFAULT 1,
    PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

DROP TABLE IF EXISTS claves;

CREATE TABLE claves (
    clave CHAR(4) PRIMARY KEY,
    descripcion VARCHAR(255),
    cuota FLOAT NOT NULL
);

INSERT INTO
    claves (clave, descripcion, cuota)
VALUES (
        'A001',
        'ACREDITACION, CERT. Y CONVALIDACION DE ESTUDIOS',
        100.00
    ),
    (
        'A002',
        'EXPEDICION Y OTORGAMIENTO DE DOC. OFICIALES',
        150.00
    ),
    ('A003', 'EXAMENES', 200.00),
    (
        'A004',
        'DEPOSITOS CHEQUE 1643 Y 1644 POR SUBSIDIO FEDERAL',
        250.00
    ),
    (
        'B001',
        'CUOTAS DE COOP. VOLUNTARIA',
        300.00
    ),
    (
        'B002',
        'APORTACIONES, COOP. Y DON. AL PLANTEL',
        350.00
    ),
    ('B003', 'BENEFICIOS', 400.00),
    ('C006', 'OTROS', 450.00);

DROP TABLE IF EXISTS facturaDatos;

CREATE TABLE facturaDatos (
    ur INT NOT NULL,
    numRecibo INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    fecha DATETIME NOT NULL,
    entidadFederativa VARCHAR(50) NOT NULL,
    apPaterno VARCHAR(50) NOT NULL,
    apMaterno VARCHAR(50) NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    matricula CHAR(9) NOT NULL,
    direccion VARCHAR(500) NOT NULL,
    grado INT NOT NULL,
    area CHAR(5) NOT NULL,
    turno CHAR(1) NOT NULL,
    clave CHAR(4) NOT NULL,
    cuota FLOAT NOT NULL, -- No hay Cantidad
    clave2 CHAR(4),
    cuota2 FLOAT,
    clave3 CHAR(4),
    cuota3 FLOAT,
    importe FLOAT NOT NULL,
    FOREIGN KEY (clave) REFERENCES claves (clave),
    FOREIGN KEY (clave2) REFERENCES claves (clave),
    FOREIGN KEY (clave3) REFERENCES claves (clave)
);

-- Agrega más inserts según sea necesario, asegurando que las claves (clave, clave2, clave3) sean válidas en la tabla claves.

DROP TABLE IF EXISTS logMovimientos;

CREATE TABLE logMovimientos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tabla VARCHAR(50),
    tipoMovimiento VARCHAR(10),
    datosPrevios TEXT,
    datosNuevos TEXT,
    fechaMovimiento DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;