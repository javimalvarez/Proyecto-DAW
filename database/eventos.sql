DROP DATABASE IF EXISTS events_db;
CREATE DATABASE events_db;
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

INSERT INTO `grupos` (`nombre_grupo`, `id_genero`, `web_grupo`, `info_grupo`) VALUES
('Depeche Mode', 1, 'https://www.depechemode.com/', NULL),
('Arde Bogota', 1, 'https://www.sonymusic.es/artista/arde-bogota/', NULL),
('Akazie', 10, 'https://workonsunday.es/artista/akazie/', NULL),
('Sevdaliza', 10, 'https://sevdaliza.com/', NULL),
('Arcade Fire', 1, 'https://www.arcadefire.com/', NULL);
  
  CREATE TABLE IF NOT EXISTS festivales(
  id_festival INT NOT NULL AUTO_INCREMENT,
  nombre_festival VARCHAR(45) NOT NULL,
  fecha_inicio DATETIME NOT NULL,
  fecha_fin DATE NOT NULL,
  abono DECIMAL(10,2) NOT NULL DEFAULT 0,
  web_festival VARCHAR(100) NULL,
  imagen_festival VARCHAR(100) NULL,
  info_festival VARCHAR(400) NULL,
  PRIMARY KEY (id_festival));

INSERT INTO `festivales` (`nombre_festival`, `fecha_inicio`, `fecha_fin`, `abono`, `web_festival`, `imagen_festival`, `info_festival`) VALUES
('Sonar 2024', '2024-06-13 10:30:00', '2024-06-15', 210.00, 'https://sonar.es/es', 'https://i.pinimg.com/736x/47/f3/c2/47f3c2c49e0219b3f60b4d09511bd496.jpg', NULL),
('BBK live 2024', '2024-07-11 10:00:00', '2024-07-13', 175.00, 'https://bilbaobbklive.com/', 'https://bilbaobbklive.com/wp-content/uploads/2024/03/1800X1800_BBL24-100-1024x1024.jpg', NULL);

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
INSERT INTO `usuarios` (`nombre`, `apellidos`, `id_provincia`, `email`, `contraseña`, `tipo`, `created_at`) VALUES
('Aranzazu', 'Ordoyo', NULL, 'aordoyo@msn.com', '$2y$10$.8TAwmU4N//7rhOHH0CuvOMmWgftarZ4J.jlYZ.Schiwn3Rl2i2Gy', 0, '2024-05-14 05:21:55'),
('Itziar', 'Esteban', 48, 'iesteban@yahoo.com', '$2y$10$VqwC6kYzHmjZOCUtt83GJ.lfnb2vOm0OALJWeDzKhO6wj7BJcnVB2', 2, '2024-05-14 05:21:55'),
('Javier', 'Martinez', 24, 'jmartinez@mediavida.com', '$2y$10$oE54WkAyfFfj/uMmnC7PFebyVGK7V9rlSno1uHs6vX3ONuypJsZPu', 1, '2024-05-14 05:21:55'),
('David', 'Rodriguez', 8, 'drgz@hotmail.com', '$2y$10$laQFvGyIM1m7yw1FgLxmj.vHlzPRcNXuziaa5EBpYTliJmFd31UpS', 1, '2024-05-14 05:21:55'),
('Julio', 'Santos', 24, 'jsantos@aytoleon.es', '$2y$10$kxgMhv39eXAXW.xdBr2TMOnE6x6Vj//S539RIohGgWF3nCyh9yfcG', 2, '2024-05-20 17:05:58'),
('Carla', 'Ruiz', 14, 'c.ruiz@gmail.com', '$2y$10$c7lW2nG6sYyEtyP1e3xuPuVZQjpI9NmOMA6v4RGdUILmt5e.4zIkm', 2, '2024-05-20 17:21:26');
SELECT * FROM usuarios;

CREATE TABLE IF NOT EXISTS eventos(
    id_evento INT NOT NULL AUTO_INCREMENT,
    nombre_evento VARCHAR(200) NOT NULL,
    id_tipo INT NOT NULL, -- 1 = Festival, 2 = Conciertos, 3 = Otros, ...
    id_grupo INT NULL,
    id_festival INT NULL,
    id_provincia INT NOT NULL,
    ubicacion VARCHAR(200) NOT NULL,
    fecha_inicio DATETIME NOT NULL,
    fecha_fin DATE NULL,
    duracion VARCHAR(200) NULL,
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

INSERT INTO `eventos` (`nombre_evento`, `id_tipo`, `id_grupo`, `id_festival`, `id_provincia`, `ubicacion`, `fecha_inicio`, `fecha_fin`, `duracion`, `precio`, `web_evento`, `imagen_evento`, `info_evento`, `id_usuario`, `created_at`) VALUES
('Cine de verano al aire libre', 3, NULL, NULL, 8, '{lat:41.38384,  lng:2.16680}', '2024-07-04 19:00:00', NULL, NULL, 0.00, 'https://cinedeverano.es/entrada', 'https://fabricandoeventos.com/wp-content/uploads/2021/09/cine-al-aire-libre.jpg', 'Cine de verano (al aire libre) todos los Jueves de Julio a Agosto. Entradas limitadas', 2, '2024-05-14 05:21:56'),
('KALERKI 2024', 2, NULL, NULL, 20, '{lat:43.28577, lng:-2.17490}', '2024-07-01 11:30:00', NULL, NULL, 0.00, 'https://www.artekale.org/es/socio/kalerki/', 'https://www.artezblai.com/wp-content/uploads/2021/06/Ulterior-bidaia.jpg', 'Teatro callejero. Pendiente de confirmación de fechas. Julio', 2, '2024-05-14 05:21:56'),
('Concierto Depeche Mode', 1, 1, NULL, 28, '{lat: 40.42406, lng: -3.67176}', '2024-03-12 21:00:00', NULL, '90 minutos', 48.00, 'https://www.ticketmaster.es/event/depeche-mode-memento-mori-tour-entradas/36505', 'https://dynamic.appronet.es/eventos/6/20230705130936-evento.png', 'Concierto Depeche Mode en el WizInk Arena', 1, '2024-05-14 05:21:56'),
('Alvaro Casares - Check un show bien', 2, NULL, NULL, 24, '{lat: 42.59501, lng: -5.57092}', '2024-04-12 21:00:00', NULL, '120 minutos', 35.00, 'https://alvarocasares.es/', 'https://www.entradas.com/obj/media/ES-eventim/galery/222x222/x/xec_222x222.jpg', ' 2º pase. Teatro San Francisco C/Corredera 1 (León)', 1, '2024-05-14 05:21:56'),
('Arde Bogota', 1, 2, NULL, 8, '{lat: 41.36251, lng:2.15202}', '2024-12-27 21:00:00', NULL, '90 minutos', 28.00, 'https://proticketing.com/clippersmusicalevents/es_ES/entradas/evento/33070/session/1923030/select?vi', 'https://www.sala-apolo.com/uploads/media/default/0001/05/thumb_4646_default_wide.jpeg', 'Palau Sant Jordi. Concierto fin de gira', 1, '2024-05-14 05:56:24'),
('Sonar 2024-Concierto Akazie', 1, 3, 1, 8, '{lat:41.37507, lng:2.15022}', '2024-06-13 15:45:00', NULL, '90 minutos', 210.00, 'https://sonar.es/es/tickets', NULL, 'Concierto festival Sonar 2024', 1, '2024-05-14 08:49:38'),
('Sonar 2024-Concierto Sevdaliza', 1, 4, 1, 8, '{lat:41.37507, lng:2.15022}', '2024-06-13 18:45:00', NULL, '90 minutos', 210.00, 'https://sonar.es/es/tickets', NULL, 'Concierto festival Sonar 2024', 1, '2024-05-20 17:03:34'),
('Tour turístico de León', 5, NULL, NULL, 24, '{lat:42.59213, lng:-5.57395}', '2024-07-01 10:00:00', '2024-12-23', NULL, 5.00, 'https://leon.es/experiencias/rutas-por-la-ciudad/tren-turistico/', 'https://www.visitaleon.com/fotos/tren-turistico.jpg', 'Ruta en tren turístico por León para conocer los principales monumentos de la ciudad', 5, '2024-05-20 17:21:57'),
('Visita guiada por Córdoba', 5, NULL, NULL, 14, '{lat: 37.88085, lng:-4.85371}', '2024-07-01 09:00:00', '2024-07-31', NULL, 0.00, NULL, 'https://www.ahoracordoba.es/wp-content/uploads/2021/11/Cordoba-1.jpg', 'Servicio de guía en cordoba para más info puedes consultar por WhatsApp 761234582', 6, '2024-05-20 17:21:57'),
('BBK Live 2024-Concierto Arcade Fire', 1, 5, 2, 48, '{lat:43.25845, lng:-2.96423}', '2024-07-11 23:00:00', NULL, '90 minutos', 175.00, 'https://bilbaobbklive.com/tickets/', NULL, 'Concierto festival BBK Live', 1, '2024-05-20 17:38:01'),
('Metropoli Gijón 2024', 4, NULL, NULL, 33, '{lat:43.53894, lng:-5.63603}', '2024-07-04 11:00:00', '2024-07-07', NULL, 5.00, 'https://metropoligijon.com/', 'https://metropoligijon.com/wp-content/uploads/2024/03/CARTEL-METROPOLI-2024.jpg', 'Metropoli Gijón 2024. Recinto Ferial de Gijón', 2, '2024-05-20 17:47:21');

CREATE TABLE usuarios_eventos (
    id_favorito INT NOT NULL AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    id_evento INT NULL,
    id_festival INT NULL,
    PRIMARY KEY (id_favorito),
    UNIQUE KEY clave_unica (id_usuario, id_evento),
    UNIQUE KEY clave_unica2 (id_usuario, id_festival),
    FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_evento) REFERENCES eventos (id_evento) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_festival) REFERENCES festivales (id_festival) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO usuarios_eventos (id_usuario, id_evento) VALUES
(2, 2),
(2, 3),
(3, 2),
(3, 4),
(4, 3),
(4, 4);

INSERT INTO usuarios_eventos (id_usuario, id_festival) VALUES
(2,1),
(2,2),
(4,2);

CREATE TABLE IF NOT EXISTS noticias (
    id_noticia INT NOT NULL AUTO_INCREMENT,
    titular VARCHAR(200) NULL,
    texto VARCHAR(1000) NULL,
    fecha_publicacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    id_usuario INT NOT NULL,
    PRIMARY KEY (id_noticia),
    FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario)
);

INSERT INTO `noticias` ( `titular`, `texto`, `fecha_publicacion`, `id_usuario`) VALUES
('Concierto Taylor Swift en Barcelona', '<p>Proximamente saldran a la venta la entradas para el concierto de Taylor Swift en Barcelona.</p>\r\n\r\n<p>El concierto se celebrar&aacute; en el Palau Sant Jordi posiblemente en Abril de 2025.</p>\r\n\r\n<p>Estamos a la espera de noticias. Os mantendremos informados</p>\r\n\r\n<p><img alt=\"\" src=\"https://e00-elmundo.uecdn.es/assets/multimedia/imagenes/2024/05/10/17153480329165.jpg\" style=\"height:300px; width:450px\" /></p>\r\n', '2024-05-19 13:05:55', 1);

select * from usuarios_eventos;

SELECT u.id_usuario, u.nombre, e.id_evento, e.nombre_evento, e.id_tipo, e.ubicacion, e.fecha_inicio, e.fecha_fin, e.info_evento
FROM usuarios u
JOIN usuarios_eventos ue ON u.id_usuario = ue.id_usuario
JOIN eventos e ON ue.id_evento = e.id_evento
WHERE u.id_usuario = 2;

select * from usuarios;
select * from eventos;