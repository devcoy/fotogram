CREATE DATABASE IF NOT EXISTS fotogram;

USE fotogram;


CREATE TABLE IF NOT EXISTS Users(
  id int(255) not null auto_increment,
  role varchar(20),
  name varchar(50),
  surname varchar(100),
  nick varchar(50),
  email varchar(50),
  password varchar(255),
  image varchar(255),
  created_at datetime,
  updated_at datetime,  
  remember_token varchar(255),

  CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=InnoDb;


CREATE TABLE IF NOT EXISTS Images(
  id int(255) NOT NULL auto_increment,
  user_id int(255),
  image_path varchar(255),
  description text,
  created_at datetime,
  updated_at datetime,  

  CONSTRAINT pk_images PRIMARY KEY (id),
  CONSTRAINT fk_images_users FOREIGN KEY (user_id) REFERENCES Users (id)
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS Comments(
  id int(255) NOT NULL auto_increment,
  user_id int(255),
  image_id int(255),
  content text,
  created_at datetime,
  updated_at datetime,

CONSTRAINT pk_comments PRIMARY KEY (id),
CONSTRAINT fk_comments_users FOREIGN KEY (user_id) REFERENCES Users (id),
CONSTRAINT fk_comments_images FOREIGN KEY (image_id) REFERENCES Images (id)
)ENGINE=InnoDb;


CREATE TABLE IF NOT EXISTS Likes(
  id int(255) NOT NULL auto_increment,
  user_id int(255),
  image_id int(255),
  created_at datetime,
  updated_at datetime,

  CONSTRAINT pk_likes PRIMARY KEY (id),
  CONSTRAINT fk_likes_users FOREIGN KEY (user_id) REFERENCES Users (id),
  CONSTRAINT fk_likes_images FOREIGN KEY (image_id) REFERENCES Images (id)
)ENGINE=InnoDb;


/**
 * Datos dummy que podrás usar
*/
INSERT INTO Users VALUES (null, 'ROLE_USER', 'Jorge', 'Devcoy', 'devcoy', 'jorge@email.com', 'jorge123', null, CURTIME(), CURTIME(), null);
INSERT INTO Users VALUES (null, 'ROLE_USER', 'Alan', 'Mozo', 'alanm', 'alan@email.com', 'alan123', null, CURTIME(), CURTIME(), null);

INSERT INTO images VALUES(null, 1, 'test.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',CURTIME(), CURTIME());
INSERT INTO images VALUES(null, 1, 'test2.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',CURTIME(), CURTIME());
INSERT INTO images VALUES(null, 1, 'test3.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',CURTIME(), CURTIME());
INSERT INTO images VALUES(null, 2, 'test4.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',CURTIME(), CURTIME());

INSERT INTO Comments VALUES(null, 1, 1, 'Soy un comentario de la foto 1', CURTIME(), CURTIME());
INSERT INTO Comments VALUES(null, 2, 2, 'Soy un comentario de la foto 2', CURTIME(), CURTIME());
INSERT INTO Comments VALUES(null, 2, 3, 'Soy un comentario de la foto 3', CURTIME(), CURTIME());
INSERT INTO Comments VALUES(null, 1, 4, 'Soy un comentario de la foto 4', CURTIME(), CURTIME());
INSERT INTO Comments VALUES(null, 1, 4, 'Soy un comentario de la foto 4', CURTIME(), CURTIME());

INSERT INTO Likes VALUES(null, 1, 1, CURTIME(), CURTIME());
INSERT INTO Likes VALUES(null, 1, 2, CURTIME(), CURTIME());
INSERT INTO Likes VALUES(null, 1, 2, CURTIME(), CURTIME());
INSERT INTO Likes VALUES(null, 1, 3, CURTIME(), CURTIME());
INSERT INTO Likes VALUES(null, 2, 1, CURTIME(), CURTIME());
INSERT INTO Likes VALUES(null, 2, 3, CURTIME(), CURTIME());
INSERT INTO Likes VALUES(null, 2, 4, CURTIME(), CURTIME());