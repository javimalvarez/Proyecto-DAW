DROP DATABASE IF EXISTS events_db;
CREATE DATABASE events_db;
SHOW DATABASES;
USE events_db;

CREATE TABLE IF NOT EXISTS tipo_eventos(
    id_tipo INT NOT NULL AUTO_INCREMENT,
    categoria_evento VARCHAR(200) NOT NULL,
    PRIMARY KEY (id_tipo)    
);
INSERT INTO tipo_eventos (categoria_evento)VALUES('Concierto'),('Teatro'),('Cine'),('Ferias'),('Otros');

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
  nombre_grupo VARCHAR(45) NOT NULL,
  id_genero INT NOT NULL,
  web_grupo VARCHAR(100) NULL,
  info_grupo VARCHAR(400) NULL,
  PRIMARY KEY (id_grupo),
  FOREIGN KEY (id_genero) REFERENCES generos (id_genero) ON DELETE CASCADE ON UPDATE CASCADE);

INSERT INTO grupos (nombre_grupo, id_genero, web_grupo, info_grupo) VALUES ('Depeche Mode', 1, 'https://www.depechemode.com/', NULL);
  
  CREATE TABLE IF NOT EXISTS festivales(
  id_festival INT NOT NULL AUTO_INCREMENT,
  nombre_festival VARCHAR(45) NOT NULL,
  fecha_inicio DATE NOT NULL,
  fecha_fin DATE NOT NULL,
  web_festival VARCHAR(100) NULL,
  imagen_festival VARCHAR(100) NULL,
  info_festival VARCHAR(400) NULL,
  PRIMARY KEY (id_festival));

INSERT INTO festivales (nombre_festival, fecha_inicio, fecha_fin, web_festival, imagen_festival, info_festival) VALUES ('Sonar 2024', '2024-07-01', '2024-07-31', 'https://sonar.es/es', NULL, NULL);

CREATE TABLE IF NOT EXISTS usuarios(
    id_usuario INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(150) NOT NULL,
    apellidos VARCHAR(200) NOT NULL,
    id_provincia INT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    contraseña VARCHAR(100) NOT NULL,
    tipo INT DEFAULT 1 NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY (id_usuario),
    FOREIGN KEY (id_provincia) REFERENCES provincias (id_provincia) ON DELETE CASCADE ON UPDATE CASCADE);

-- Tipos de usuario 0=Administrador 1=Default  2=Alta eventos--
-- El alta de usuarios administradores se gestionara desde el alta de panel de administrador --
INSERT INTO usuarios (nombre, apellidos, id_provincia, email, contraseña, tipo)
VALUES
('Aranzazu', 'Ordoyo', NULL, 'aordoyo@msn.com','$2y$10$.8TAwmU4N//7rhOHH0CuvOMmWgftarZ4J.jlYZ.Schiwn3Rl2i2Gy',0),
('Itziar', 'Esteban', 48, 'iesteban@yahoo.com', '$2y$10$VqwC6kYzHmjZOCUtt83GJ.lfnb2vOm0OALJWeDzKhO6wj7BJcnVB2',2),
('Javier', 'Martinez', 24, 'jmartinez@mediavida.com', '$2y$10$oE54WkAyfFfj/uMmnC7PFebyVGK7V9rlSno1uHs6vX3ONuypJsZPu',1),
('David', 'Rodriguez', 08, 'drgz@hotmail.com', '$2y$10$laQFvGyIM1m7yw1FgLxmj.vHlzPRcNXuziaa5EBpYTliJmFd31UpS',1);
SELECT * FROM usuarios;

CREATE TABLE IF NOT EXISTS eventos(
    id_evento INT NOT NULL AUTO_INCREMENT,
    evento VARCHAR(200) NOT NULL,
    id_tipo INT NOT NULL, -- 1 = Festival, 2 = Conciertos, 3 = Otros, ...
    id_grupo INT NULL,
    id_festival INT NULL,
    id_provincia INT NOT NULL,
    ubicacion VARCHAR(200) NOT NULL,
    fecha_inicio DATETIME NOT NULL,
    fecha_fin DATE NULL,
    precio DECIMAL(10,2) NOT NULL DEFAULT 0,
    web_evento VARCHAR(100) NULL,
    imagen_evento VARCHAR(100) NULL,
    info_evento VARCHAR(400) NULL,
    id_usuario INT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY (id_evento),
    FOREIGN KEY (id_tipo) REFERENCES tipo_eventos (id_tipo) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_provincia) REFERENCES provincias (id_provincia) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_festival) REFERENCES festivales (id_festival)ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_grupo) REFERENCES grupos (id_grupo)ON DELETE CASCADE ON UPDATE CASCADE);

INSERT INTO eventos (evento, id_tipo, id_grupo, id_festival, id_provincia, ubicacion, fecha_comienzo, fecha_fin, precio, web_evento, imagen_evento, info_evento, id_usuario)
VALUES
('Al aire', 3, NULL, NULL, 8, '{"lat": 41.4114, "lng": 2.225}', '2024-07-04 19:00:00', NULL, 0,'https://cinedeverano.es/entrada', NULL, 'Cine de verano (al aire libre) todos los Jueves de Julio a Agosto. Entradas limitadas', 2),
('Vermut', 5, NULL, NULL, 20, '{"lat": 43.32554, "lng": -1.98662}', '2024-05-26 11:30:00', NULL, 0,NULL, NULL, 'Quedada para tomar unos Vermuts.', 2),
('Concierto Depeche Mode', 1, 1, NULL, 28, '{"lat": 40.42406, "lng": -3.67176}', '2024-03-12 21:00:00', NULL, 48,'https://www.ticketmaster.es/event/depeche-mode-memento-mori-tour-entradas/36505', NULL, 'Concierto Depeche Mode en el WizInk Arena', 1),
('Alvaro Casares - Check un show bien', 2, NULL, NULL, 24, '{"lat": 42.59501, "lng": -5.57092}', '2024-04-12 21:00:00', NULL, 35, 'https://alvarocasares.es/',NULL,' 2º pase. Teatro San Francisco C/Corredera 1 (León)', 1);

CREATE TABLE usuarios_eventos (
    id_usuario INT NOT NULL,
    id_evento INT NOT NULL,
    PRIMARY KEY (id_usuario, id_evento),
    FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario),
    FOREIGN KEY (id_evento) REFERENCES eventos (id_evento)
);

INSERT INTO usuarios_eventos (id_usuario, id_evento) VALUES
(2, 1),
(2, 2),
(2, 3),
(3, 2),
(3, 4),
(4, 2),
(4, 3),
(4, 4);

CREATE TABLE IF NOT EXISTS noticias (
    id_noticia INT NOT NULL AUTO_INCREMENT,
    titular VARCHAR(200) NULL,
    texto VARCHAR(1000) NULL,
    fecha_publicacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    id_usuario INT NOT NULL,
    PRIMARY KEY (id_noticia),
    FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario)
);

select * from usuarios_eventos;

SELECT u.id_usuario, u.nombre, e.id_evento, e.evento, e.id_tipo, e.ubicacion, e.fecha_comienzo, e.fecha_fin, e.info_evento
FROM usuarios u
JOIN usuarios_eventos ue ON u.id_usuario = ue.id_usuario
JOIN eventos e ON ue.id_evento = e.id_evento
WHERE u.id_usuario = 2;

select * from usuarios;
select * from eventos;