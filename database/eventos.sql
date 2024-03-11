DROP DATABASE IF EXISTS events_db;
CREATE DATABASE events_db;
SHOW DATABASES;
USE events_db;

CREATE TABLE IF NOT EXISTS usuarios(
    id_usuario INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(150) NOT NULL,
    apellidos VARCHAR(200) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    contraseña VARCHAR(100) NOT NULL,
    tipo INT DEFAULT 1,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY (id_usuario)
);

-- Tipos de usuario 0=Administrador 1=Default --
-- El alta de usuarios administradores se gestionara desde el alta de panel de administrador --
INSERT INTO usuarios (nombre, apellidos, email, contraseña, tipo)
VALUES
('Aranzazu', 'Ordoyo', 'aordoyo@msn.com', '$2y$10$.8TAwmU4N//7rhOHH0CuvOMmWgftarZ4J.jlYZ.Schiwn3Rl2i2Gy',0),
('Itizar', 'Esteban', 'iesteban@yahoo.com', '$2y$10$VqwC6kYzHmjZOCUtt83GJ.lfnb2vOm0OALJWeDzKhO6wj7BJcnVB2',0),
('Javier', 'Martinez', 'jmartinez@mediavida.com', '$2y$10$oE54WkAyfFfj/uMmnC7PFebyVGK7V9rlSno1uHs6vX3ONuypJsZPu',0),
('David', 'Rodriguez', 'drgz@hotmail.com', '$2y$10$laQFvGyIM1m7yw1FgLxmj.vHlzPRcNXuziaa5EBpYTliJmFd31UpS',0);
SELECT * FROM usuarios;

CREATE TABLE IF NOT EXISTS tipo_eventos(
    id_tipo INT NOT NULL AUTO_INCREMENT,
    categoria_evento VARCHAR(200) NOT NULL,
    PRIMARY KEY (id_tipo)    
);
INSERT INTO tipo_eventos (categoria_evento)VALUES('Concierto/Festival'),('Teatro'),('Cine'),('Ferias'),('Otros');

CREATE TABLE IF NOT EXISTS provincias(
    id_provincia INT NOT NULL,
    provincia  VARCHAR(80) DEFAULT NULL,
    PRIMARY KEY (id_provincia));
    
INSERT INTO provincias (id_provincia, provincia)
VALUES
(2, 'Albacete'),
(3, 'Alicante/Alacant'),
(4, 'Almería'),
(1, 'Araba/Álava'),
(33, 'Asturias'),
(5, 'Ávila'),
(6, 'Badajoz'),
(7, 'Balears, Illes'),
(8, 'Barcelona'),
(48, 'Bizkaia'),
(9, 'Burgos'),
(10, 'Cáceres'),
(11, 'Cádiz'),
(39, 'Cantabria'),
(12, 'Castellón/Castelló'),
(51, 'Ceuta'),
(13, 'Ciudad Real'),
(14, 'Córdoba'),
(15, 'Coruña, A'),
(16, 'Cuenca'),
(20, 'Gipuzkoa'),
(17, 'Girona'),
(18, 'Granada'),
(19, 'Guadalajara'),
(21, 'Huelva'),
(22, 'Huesca'),
(23, 'Jaén'),
(24, 'León'),
(27, 'Lugo'),
(25, 'Lleida'),
(28, 'Madrid'),
(29, 'Málaga'),
(52, 'Melilla'),
(30, 'Murcia'),
(31, 'Navarra'),
(32, 'Ourense'),
(34, 'Palencia'),
(35, 'Palmas, Las'),
(36, 'Pontevedra'),
(26, 'Rioja, La'),
(37, 'Salamanca'),
(38, 'Santa Cruz de Tenerife'),
(40, 'Segovia'),
(41, 'Sevilla'),
(42, 'Soria'),
(43, 'Tarragona'),
(44, 'Teruel'),
(45, 'Toledo'),
(46, 'Valencia/València'),
(47, 'Valladolid'),
(49, 'Zamora'),
(50, 'Zaragoza');

CREATE TABLE IF NOT EXISTS generos(
  id_genero INT NOT NULL AUTO_INCREMENT,
  genero VARCHAR(45) NOT NULL,
  PRIMARY KEY (id_genero));

  INSERT INTO generos (genero) VALUES ('Rock'), ('Pop'), ('Clasica'), ('Jazz'), ('Latino'), ('Rap/hiphop'), ('Reggae'), ('Folk'), ('Heavy Metal'), ('Electronica'), ('Dance'), ('Funk'), ('Blues'), ('Soul'), ('Ska'), ('Punk'), ('House'), ('Urbano/trap'), ("Reggaeton"), ('Otro');

CREATE TABLE IF NOT EXISTS grupos(
  id_grupo INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(45) NOT NULL,
  id_genero INT NOT NULL,
  web VARCHAR(45) NULL,
  imagen BLOB NULL,
  otra_info VARCHAR(100) NULL,
  PRIMARY KEY (id_grupo),
  FOREIGN KEY (id_genero) REFERENCES generos (id_genero));

INSERT INTO grupos (nombre, id_genero, web, imagen, otra_info) VALUES ('Depeche Mode', 1, 'https://www.depechemode.com/', NULL, NULL);
  
  CREATE TABLE IF NOT EXISTS festivales(
  id_festival INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(45) NOT NULL,
  fecha_inicio DATE NOT NULL,
  fecha_fin DATE NOT NULL,
  web VARCHAR(45) NULL,
  imagen BLOB NULL,
  otra_info VARCHAR(100) NULL,
  PRIMARY KEY (id_festival));

INSERT INTO festivales (nombre, fecha_inicio, fecha_fin, web, imagen, otra_info) VALUES ('Sonar 2024', '2024-07-01', '2024-07-31', 'https://sonar.es/es', NULL, NULL);

CREATE TABLE IF NOT EXISTS eventos(
    id_evento INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(200) NOT NULL,
    id_tipo INT NOT NULL, -- 1 = Festival, 2 = Conciertos, 3 = Otros, ...
    ubicacion VARCHAR(200) NOT NULL,
    id_provincia INT NOT NULL,
    fecha_comienzo DATETIME NOT NULL,
    fecha_fin DATE NULL,
    id_grupo INT NULL,
    id_festival INT NULL,
    otra_info VARCHAR(400) NULL,
    link VARCHAR(100) NULL,
    id_usuario_creador INT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    FOREIGN KEY (id_tipo) REFERENCES tipo_eventos (id_tipo),
    FOREIGN KEY (id_provincia) REFERENCES provincias (id_provincia),
    FOREIGN KEY (id_usuario_creador) REFERENCES usuarios (id_usuario),
    FOREIGN KEY (id_festival) REFERENCES festivales (id_festival),
    FOREIGN KEY (id_grupo) REFERENCES grupos (id_grupo),
    PRIMARY KEY (id_evento));

INSERT INTO eventos (nombre, id_tipo, ubicacion, id_provincia, fecha_comienzo, fecha_fin, id_grupo, id_festival, otra_info, link, id_usuario_creador)
VALUES
('Al aire', 3, '{"lat": 41.4114, "lng": 2.225}', 8, '2024-07-04 19:00:00', NULL, NULL, NULL, 'Cine de verano (al aire libre) todos los Jueves de Julio a Agosto. Entradas limitadas', 'https://cinedeverano.es/entrada', 1),
('Vermut', 5, '{"lat": 43.32554, "lng": -1.98662}', 20, '2024-05-26 11:30:00', NULL, NULL, NULL, 'Quedada para tomar unos Vermuts.', NULL, 2),
('Concierto Depeche Mode', 1, '{"lat": 40.42406, "lng": -3.67176}', 28, '2024-03-12 21:00:00', NULL, 1, NULL, 'Concierto Depeche Mode en el WizInk Arena', 'https://www.ticketmaster.es/event/depeche-mode-memento-mori-tour-entradas/36505', 3),
('Alvaro Casares - Check un show bien', 2, '{"lat": 42.59501, "lng": -5.57092}', 24, '2024-04-12 21:00:00', NULL, NULL, 1,' 2º pase. Teatro San Francisco C/Corredera 1 (León)', 'https://alvarocasares.es/', 4);
