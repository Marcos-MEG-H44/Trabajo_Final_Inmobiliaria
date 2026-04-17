-- =============================================
-- TICKET_001: RELEVAMIENTO Y DISEÑO DE BD
-- PROYECTO: GESTIÓN INMOBILIARIA
-- ESTADO: LISTO PARA ENTREGA
-- =============================================

IF NOT EXISTS (SELECT * FROM sys.databases WHERE name = 'GestionInmobiliaria')
BEGIN
    CREATE DATABASE GestionInmobiliaria;
END
GO

USE GestionInmobiliaria;
GO

-- 1. TABLAS MAESTRAS (Cumplimiento de 3FN)
CREATE TABLE Tipos_Inmueble (
    id_tipo INT IDENTITY(1,1) PRIMARY KEY,
    descripcion VARCHAR(50) NOT NULL -- Casa, Departamento, etc.
);

CREATE TABLE Zonas (
    id_zona INT IDENTITY(1,1) PRIMARY KEY,
    nombre_barrio VARCHAR(100) NOT NULL,
    ciudad VARCHAR(100) DEFAULT 'Coronel Pringles'
);

CREATE TABLE Tipos_Ajuste (
    id_ajuste INT IDENTITY(1,1) PRIMARY KEY,
    descripcion VARCHAR(50) NOT NULL -- Trimestral, Cuatrimestral, etc.
);

-- 2. TABLA DE PERSONAS (Inquilinos y Propietarios)
CREATE TABLE Personas (
    id_persona INT IDENTITY(1,1) PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    dni VARCHAR(20) UNIQUE NOT NULL,
    cuil_cuit VARCHAR(20),
    telefono VARCHAR(50),
    email VARCHAR(100),
    cbu_alias VARCHAR(100), -- Visto en formulario relevado
    fecha_alta_sistema DATETIME DEFAULT GETDATE()
);

-- 3. TABLA DE USUARIOS Y ROLES (Seguridad)
CREATE TABLE Usuarios (
    id_usuario INT IDENTITY(1,1) PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    perfil VARCHAR(20) CHECK (perfil IN ('Administrador', 'Secretariado', 'Profesional')),
    id_persona INT FOREIGN KEY REFERENCES Personas(id_persona)
);

-- 4. TABLA DE PROPIEDADES
CREATE TABLE Propiedades (
    id_propiedad INT IDENTITY(1,1) PRIMARY KEY,
    direccion VARCHAR(200) NOT NULL,
    id_propietario INT NOT NULL,
    id_tipo INT NOT NULL,
    id_zona INT NOT NULL,
    FOREIGN KEY (id_propietario) REFERENCES Personas(id_persona),
    FOREIGN KEY (id_tipo) REFERENCES Tipos_Inmueble(id_tipo),
    FOREIGN KEY (id_zona) REFERENCES Zonas(id_zona)
);

-- 5. TABLA DE CONTRATOS
CREATE TABLE Contratos (
    id_contrato INT IDENTITY(1,1) PRIMARY KEY,
    id_inquilino INT NOT NULL,
    id_propiedad INT NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE NOT NULL,
    valor_inicial DECIMAL(18, 2) NOT NULL,
    id_tipo_ajuste INT NOT NULL,
    estado VARCHAR(20) DEFAULT 'Activo',
    FOREIGN KEY (id_inquilino) REFERENCES Personas(id_persona),
    FOREIGN KEY (id_propiedad) REFERENCES Propiedades(id_propiedad),
    FOREIGN KEY (id_tipo_ajuste) REFERENCES Tipos_Ajuste(id_ajuste)
);

-- 6. TABLA DE OBLIGACIONES (Para seguimiento de ABL, Gas, Ajustes)
CREATE TABLE Obligaciones (
    id_obligacion INT IDENTITY(1,1) PRIMARY KEY,
    id_contrato INT NOT NULL,
    descripcion VARCHAR(100) NOT NULL, 
    importe_referencia DECIMAL(18, 2),
    pagado_por_inquilino BIT DEFAULT 0,
    FOREIGN KEY (id_contrato) REFERENCES Contratos(id_contrato)
);

-- 7. SISTEMA DE LOGS (Auditoría avanzada según ejemplo Clínica)
CREATE TABLE Auditoria_Logs (
    id_log INT IDENTITY(1,1) PRIMARY KEY,
    fecha DATETIME DEFAULT GETDATE(),
    usuario VARCHAR(50),
    nivel_log VARCHAR(10) CHECK (nivel_log IN ('INFO', 'DEBUG', 'ERROR')),
    accion VARCHAR(20), 
    tabla_afectada VARCHAR(50),
    descripcion_error VARCHAR(MAX)
);

GO

-- 8. CARGA DE DATOS DE PRUEBA (Mínimo 5 registros por tabla)
-- Tipos y Zonas
INSERT INTO Tipos_Inmueble (descripcion) VALUES ('Casa'), ('Departamento'), ('Local'), ('Cochera'), ('Lote');
INSERT INTO Tipos_Ajuste (descripcion) VALUES ('Trimestral'), ('Cuatrimestral'), ('Semestral');
INSERT INTO Zonas (nombre_barrio) VALUES ('Centro'), ('Norte'), ('Sur'), ('Este'), ('Oeste');

-- Personas
INSERT INTO Personas (nombre, apellido, dni, email) VALUES  
('Lalo', 'Landa', '10100100', 'lalolanda@mail.com'), 
('Moe', 'Sislak', '20200200', 'tabernademoe@mail.com'),
('Apu', 'Nazajame', '30300300', 'apu@mail.com'),
('Malcon', 'Delmedio', '40400400', 'malcon@mail.com'),
('Dexter', 'Morgan', '50500500', 'carniceria@mail.com');

-- Usuario Admin vinculado a Persona 1
INSERT INTO Usuarios (username, password_hash, perfil, id_persona) 
VALUES ('admin', '0123', 'Administrador', 1);

-- Propiedades basadas en Excel inmobiliaria
INSERT INTO Propiedades (direccion, id_propietario, id_tipo, id_zona) VALUES 
('Alvear 729 B', 1, 2, 1),
('Francia 3', 2, 2, 1),
('Francia 4', 2, 2, 1),
('Alvear 744', 3, 1, 2),
('Villegas 100', 4, 3, 1);

-- Contratos (Basados en fechas y valores reales de tus fotos)
INSERT INTO Contratos (id_inquilino, id_propiedad, fecha_inicio, fecha_fin, valor_inicial, id_tipo_ajuste) VALUES 
(5, 1, '2023-01-01', '2025-01-01', 320000.00, 2),
(1, 2, '2023-06-01', '2025-06-01', 282000.00, 1),
(3, 3, '2024-01-01', '2026-01-01', 140000.00, 2),
(2, 4, '2023-03-01', '2025-03-01', 426000.00, 3),
(4, 5, '2024-05-01', '2026-05-01', 500000.00, 1);

-- Obligaciones de prueba
INSERT INTO Obligaciones (id_contrato, descripcion, importe_referencia) VALUES
(1, 'ABL Mensual', 4500.50),
(1, 'Gas Bimestral', 8900.00),
(2, 'Expensas', 25000.00);

PRINT 'Script ejecutado con éxito. Base de Datos GestionInmobiliaria lista.';
