create database cirkuits;
use cirkuits;

CREATE TABLE usuarios (id_usuario INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
	nombre_usuario text, apellido_usuario text, alter_usuario text, password_usuario text, 
    email_usuario text, tel_usuario text, cel_usuario text, nacimiento_usuario date, estatus_usuario integer, isAdmin integer, fecha_registro date, fecha_actualizacion date, avatar_usuario text);
    
/*CREATE TABLE plastic (id_tarjeta INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
	nombre_tarjeta text, ap_tarjeta text, numero_tarjeta text, mes_tarjeta text,
    anio_tarjeta text, cvc_tarjeta text, id_usuario INTEGER not null, foreign key(id_usuario)references usuarios(id_usuario));*/

CREATE TABLE cat_tipo_pago(id_tipo INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT, tipo text);

CREATE TABLE cat_precios (id_precio INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
	precio text);
    
CREATE TABLE pago (id_pago INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT, id_usuario integer not null, 
	id_tipo integer not null, fecha date, foreign key(id_usuario)references usuarios(id_usuario),
    foreign key(id_tipo)references cat_tipo_pago(id_tipo));
    
CREATE TABLE cat_videogames(id_videogame INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
	nombre text);
    
CREATE TABLE videogame_progress (id_progress INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	id_videogame integer not null, id_usuario integer not null, nivel integer, score integer, foreign key(id_videogame)references cat_videogames(id_videogame), foreign key(id_usuario)references usuarios(id_usuario));
    
CREATE TABLE leaderboard (id_leaderboard INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	id_videogame integer not null, id_usuario integer not null, high_score integer,
    foreign key(id_videogame)references cat_videogames(id_videogame),
    foreign key(id_usuario)references usuarios(id_usuario));
    
    show tables;
    
    desc usuarios;
    
    select * from usuarios;
    update usuarios set estatus_usuario = 2 where id_usuario = 2;
    
INSERT INTO usuarios (nombre_usuario, apellido_usuario, alter_usuario, password_usuario,
      email_usuario, nacimiento_usuario, estatus_usuario, isAdmin, tel_usuario, cel_usuario, fecha_registro, fecha_actualizacion, avatar_usuario)  VALUES ('Marco','Fuentes','mfuentes','des2tramp2dos2','markfuentes1992@hotmail.com','2015-04-02',1,1,'1777340','7775006083',NOW(), NOW(), 'creator')