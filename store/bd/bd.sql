-- Active: 1727361839119@@127.0.0.1@3306@videoGames
-- DROP DATABASE videoGames;
CREATE DATABASE videoGames;

USE videoGames;

CREATE TABLE usuarios (
    idusuario INT PRIMARY KEY AUTO_INCREMENT,
    usuario VARCHAR(255) NOT NULL,
    clave TEXT NOT NULL,
    estado INT NOT NULL,
    tipo INT NOT NULL
);

INSERT INTO usuarios(usuario,clave,estado,tipo) VALUES ('admin','$2y$10$Smll0Ut0dnrpdI.qH/Xow.FPk2HFQXf.LvRRxLpoWbL6M/de27Cpm',1,1);


INSERT INTO usuarios (usuario, clave, estado, tipo)
VALUES
('Carlos', '$2y$10$Smll0Ut0dnrpdI.qH/Xow.FPk2HFQXf.LvRRxLpoWbL6M/de27Cpm', 1, 1),
('Laura', '$2y$10$Smll0Ut0dnrpdI.qH/Xow.FPk2HFQXf.LvRRxLpoWbL6M/de27Cpm', 1, 1),
('Miguel', '$2y$10$Smll0Ut0dnrpdI.qH/Xow.FPk2HFQXf.LvRRxLpoWbL6M/de27Cpm', 1, 1),
('Ana', '$2y$10$Smll0Ut0dnrpdI.qH/Xow.FPk2HFQXf.LvRRxLpoWbL6M/de27Cpm', 1, 1),
('David', '$2y$10$Smll0Ut0dnrpdI.qH/Xow.FPk2HFQXf.LvRRxLpoWbL6M/de27Cpm', 1, 1),
('Maria', '$2y$10$Smll0Ut0dnrpdI.qH/Xow.FPk2HFQXf.LvRRxLpoWbL6M/de27Cpm', 1, 1),
('Juan', '$2y$10$Smll0Ut0dnrpdI.qH/Xow.FPk2HFQXf.LvRRxLpoWbL6M/de27Cpm', 1, 1),
('Sofia', '$2y$10$Smll0Ut0dnrpdI.qH/Xow.FPk2HFQXf.LvRRxLpoWbL6M/de27Cpm', 1, 1),
('Luis', '$2y$10$Smll0Ut0dnrpdI.qH/Xow.FPk2HFQXf.LvRRxLpoWbL6M/de27Cpm', 1, 1),
('Valeria', '$2y$10$Smll0Ut0dnrpdI.qH/Xow.FPk2HFQXf.LvRRxLpoWbL6M/de27Cpm', 1, 1),
('Jose', '$2y$10$Smll0Ut0dnrpdI.qH/Xow.FPk2HFQXf.LvRRxLpoWbL6M/de27Cpm', 1, 1),
('Camila', '$2y$10$Smll0Ut0dnrpdI.qH/Xow.FPk2HFQXf.LvRRxLpoWbL6M/de27Cpm', 1, 1),
('Diego', '$2y$10$Smll0Ut0dnrpdI.qH/Xow.FPk2HFQXf.LvRRxLpoWbL6M/de27Cpm', 1, 1),
('Elena', '$2y$10$Smll0Ut0dnrpdI.qH/Xow.FPk2HFQXf.LvRRxLpoWbL6M/de27Cpm', 1, 1),
('Jorge', '$2y$10$Smll0Ut0dnrpdI.qH/Xow.FPk2HFQXf.LvRRxLpoWbL6M/de27Cpm', 1, 1),
('Patricia', '$2y$10$Smll0Ut0dnrpdI.qH/Xow.FPk2HFQXf.LvRRxLpoWbL6M/de27Cpm', 1, 1),
('Sergio', '$2y$10$Smll0Ut0dnrpdI.qH/Xow.FPk2HFQXf.LvRRxLpoWbL6M/de27Cpm', 1, 1),
('Lucia', '$2y$10$Smll0Ut0dnrpdI.qH/Xow.FPk2HFQXf.LvRRxLpoWbL6M/de27Cpm', 1, 1),
('Ricardo', '$2y$10$Smll0Ut0dnrpdI.qH/Xow.FPk2HFQXf.LvRRxLpoWbL6M/de27Cpm', 1, 1),
('Gabriela', '$2y$10$Smll0Ut0dnrpdI.qH/Xow.FPk2HFQXf.LvRRxLpoWbL6M/de27Cpm', 1, 1);
CREATE TABLE roles(
    idrol INT PRIMARY KEY AUTO_INCREMENT,
    rol VARCHAR(100) NOT NULL
);

INSERT INTO roles(rol) VALUES ('Administrador'),('Empleados'),('Cliente');

CREATE Table empleados(
     idusuario INT PRIMARY KEY AUTO_INCREMENT,
    usuario VARCHAR(255) NOT NULL,
    clave TEXT NOT NULL,
    estado INT NOT NULL,
    tipo INT NOT NULL
);
CREATE TABLE proveedores (
    idproveedor INT PRIMARY KEY AUTO_INCREMENT,
    proveedor VARCHAR(255) NOT NULL,
    contacto VARCHAR(100) NOT NULL,
    direccion TEXT NOT NULL,
    telefono VARCHAR(15) NOT NULL,
    email TEXT,
    estado INT,
    tipo TEXT
);
CREATE TABLE categorias(
    idcategoria INT PRIMARY KEY AUTO_INCREMENT,
    categoria VARCHAR(255) NOT NULL,
    estado INT
);
CREATE TABLE productos(
    idproducto INT PRIMARY KEY AUTO_INCREMENT,
    imagen VARCHAR(100) NOT NULL,
    nombre VARCHAR(255) NOT NULL, 
    detalle TEXT NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL,
    idproveedor INT,
    idcategoria INT,
    FOREIGN KEY (idproveedor) REFERENCES proveedores(idproveedor),
    FOREIGN KEY (idcategoria) REFERENCES categorias(idcategoria)
);