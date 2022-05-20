CREATE DATABASE IF NOT EXISTS laravel_chatapp;
USE laravel_chatapp;

CREATE TABLE IF NOT EXISTS users(
id int(255) auto_increment not null,
role varchar(20),
name varchar(100),
surname varchar(150),
description varchar(100),
nick varchar(30),
email varchar(100) unique,
password varchar(255),
image varchar(255),
created_at datetime,
updated_at datetime,
remember_token varchar(255),
CONSTRAINT pk_users PRIMARY KEY (id)
)ENGINE= InnoDB;

INSERT INTO users VALUES(NULL,'user','Adrian','Abad','Hey!','faroliwi','adri@adri','password','default.jpg',CURTIME(),CURTIME(),NULL);
INSERT INTO users VALUES(NULL,'user','Juan','Lopez','Hey!','juanlo','juan@juan','password','default.jpg',CURTIME(),CURTIME(),NULL);
INSERT INTO users VALUES(NULL,'user','Arturo','Herraz','Hey!','arthur','arthur@arthur','password','default.jpg',CURTIME(),CURTIME(),NULL);

CREATE TABLE IF NOT EXISTS images(
id int(255) auto_increment not null,
user_id int(255),
image_path varchar(255),
description text,
created_at datetime,
updated_at datetime,
CONSTRAINT pk_images PRIMARY KEY (id),
CONSTRAINT fk_images_users FOREIGN KEY (user_id) REFERENCES users(id)
)ENGINE= InnoDB;

INSERT INTO images VALUES(NULL,1,'test1.jpg','Descripcion de prueba 1',CURTIME(),CURTIME());
INSERT INTO images VALUES(NULL,2,'test2.jpg','Descripcion de prueba 2',CURTIME(),CURTIME());
INSERT INTO images VALUES(NULL,3,'test3.jpg','Descripcion de prueba 3',CURTIME(),CURTIME());
INSERT INTO images VALUES(NULL,3,'test4.jpg','Descripcion de prueba 4',CURTIME(),CURTIME());

CREATE TABLE IF NOT EXISTS comments(
id int(255) auto_increment not null,
user_id int(255),
image_id int(255),
content text,
created_at datetime,
updated_at datetime,
CONSTRAINT pk_comments PRIMARY KEY (id),
CONSTRAINT fk_comments_users FOREIGN KEY (user_id) REFERENCES users(id),
CONSTRAINT fk_comments_images FOREIGN KEY (image_id) REFERENCES images(id)
)ENGINE= InnoDB;

INSERT INTO comments VALUES(NULL,1,4,'Esto es un comentario de prueba',CURTIME(),CURTIME());
INSERT INTO comments VALUES(NULL,2,1,'Esto es un comentario de prueba2',CURTIME(),CURTIME());
INSERT INTO comments VALUES(NULL,2,4,'Esto es un comentario de prueba3',CURTIME(),CURTIME());


CREATE TABLE IF NOT EXISTS likes(
id int(255) auto_increment not null,
user_id int(255),
image_id int(255),
created_at datetime,
updated_at datetime,
CONSTRAINT pk_likes PRIMARY KEY (id),
CONSTRAINT fk_likes_users FOREIGN KEY (user_id) REFERENCES users(id),
CONSTRAINT fk_likes_images FOREIGN KEY (image_id) REFERENCES images(id)
)ENGINE= InnoDB;

INSERT INTO likes VALUES(NULL,1,4,CURTIME(),CURTIME());
INSERT INTO likes VALUES(NULL,2,4,CURTIME(),CURTIME());
INSERT INTO likes VALUES(NULL,3,1,CURTIME(),CURTIME());
INSERT INTO likes VALUES(NULL,3,2,CURTIME(),CURTIME());
INSERT INTO likes VALUES(NULL,2,1,CURTIME(),CURTIME());


