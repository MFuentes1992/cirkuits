#////////////////////////////////////////////// FINISH BUILDING DATABASE //////////////////////////////////////////////////////////////////////////
create database cirkuits;
use cirkuits;

CREATE TABLE usuarios (id_usuario INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
	nombre_usuario text, apellido_usuario text, alter_usuario text, password_usuario text, 
    email_usuario text, tel_usuario text, cel_usuario text, nacimiento_usuario date, 
    estatus_usuario integer, isAdmin integer, fecha_registro date, fecha_actualizacion date, avatar_usuario text);
    
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
	nombre text, icono text, url text);
	#////////////////////////////// GAME LOGIC /////////////////////////////////////
	CREATE TABLE cat_levels (id_level INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT, 
	nombre TEXT);

	CREATE TABLE videogame_level(id_videogame_level INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
	id_videogame INTEGER NOT NULL, id_level INTEGER NOT NULL, id_usuario INTEGER NOT NULL, IsLocked INTEGER,
	 FOREIGN KEY(id_videogame) REFERENCES cat_videogames, FOREIGN KEY(id_level) REFERENCES cat_levels, FOREIGN KEY(id_usuario) REFERENCES  usuarios);

	CREATE TABLE level_progress(id_progress INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
	id_videogame_level INTEGER, score INTEGER, high_score INTEGER, estrellas INTEGER, FOREIGN KEY(id_videogame_level) REFERENCES videogame_level);
	
    CREATE TABLE tbl_relatedMaterials (id_relatedmateria INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT, video text, material text);
    #////////////////////////////// GAME LOGIC /////////////////////////////////////    
    
    show tables;
    #////////////////////////////////////////////// FINISH BUILDING DATABASE //////////////////////////////////////////////////////////////////////////
    desc usuarios;
    desc cat_videogames;
    desc level_progress;
    desc 
    insert into cat_videogames (nombre, icono, url) values ('Tense Master: To be', 'fas fa-street-view', '#');
    insert into cat_levels (nombre) values ('Nivel 10');
    insert into videogame_level (id_videogame, id_level, id_usuario, isLocked) values (1,1,1,0);
    insert into videogame_level (id_videogame, id_level, id_usuario, isLocked) values (1,2,1,1);
    insert into videogame_level (id_videogame, id_level, id_usuario, isLocked) values (1,3,1,1);
    INSERT INTO leaderboard (id_progress, high_score) values (1,0);
    insert into tbl_relatedMaterials (video, material) values ('video_8162020.mp4', 'lecture_001.pdf');
    insert into tbl_relatedMaterials (video, material) values ('video_8162020.mp4', 'lecture_002.pdf');
    insert into tbl_relatedMaterials (video, material) values ('video_8172020.mp4', 'lecture_003.pdf');
    insert into tbl_relatedMaterials (video, material) values ('video_8182020.mp4', 'lecture_004.pdf');
    
    select * from tbl_relatedMaterials where video = 'video_8162020.mp4';
    select * from usuarios;
    select * from cat_videogames;
    select * from cat_levels;
    select * from videogame_level where id_usuario = 1 and id_videogame = 1;
    select * from level_progress where id_videogame_level = 1;
    select count(*) as total from level_progress where id_videogame_level = 8;
    desc videogame_level;
    desc level_progress;
    SELECT count(*) as levels FROM videogame_level WHERE id_usuario = 1 AND isLocked = 0 AND id_videogame = 2;
    update cat_videogames set icono = 'fas fa-street-view' where id_videogame = 10;

    update usuarios set estatus_usuario = 2 where id_usuario = 1;
    
    SELECT count(*) as levels FROM  videogame_level WHERE id_usuario = 1 AND isLocked = 0 AND id_videogame = 2;
    
    
    SELECT cat_levels.id_level, cat_levels.nombre FROM cat_levels 
		INNER JOIN videogame_level 
			ON videogame_level.id_level =  cat_levels.id_level 
				WHERE id_usuario = 1 AND id_videogame = 1;
    
	################## Get the Score and High Score from table #########################
    SELECT high_score, nombre_usuario, avatar_usuario FROM level_progress 
		INNER JOIN videogame_level 
			ON level_progress.id_videogame_level = videogame_level.id_videogame_level
            INNER JOIN usuarios ON videogame_level.id_usuario = usuarios.id_usuario
            WHERE id_videogame = 1 AND id_level = 1 AND high_score > 100 ORDER BY high_score DESC LIMIT 1;
    ################## Get the Score and High Score from table #########################
    
    
    SELECT id_videogame_level FROM videogame_level WHERE id_level = 1 AND id_usuario = 1 AND id_videogame = 1;
    SELECT count(*) AS total FROM level_progress WHERE id_videogame_level = 1;
    SELECT estrellas, high_score FROM level_progress WHERE id_videogame_level = 1;
    
    UPDATE videogame_level SET isLocked = 1 WHERE id_videogame = 1 AND id_usuario = 1 AND id_level = 2;
    INSERT INTO level_progress (id_videogame_level, score, high_score, estrellas) VALUES (1, 30, 30, 3);
    
INSERT INTO usuarios (nombre_usuario, apellido_usuario, alter_usuario, password_usuario,
      email_usuario, nacimiento_usuario, estatus_usuario, isAdmin, tel_usuario, cel_usuario, fecha_registro, fecha_actualizacion, avatar_usuario)  VALUES ('Marco','Fuentes','mfuentes','des2tramp2dos2','markfuentes2991@gmail.com','2015-04-02',1,1,'1777340','7775006083',NOW(), NOW(), 'creator')