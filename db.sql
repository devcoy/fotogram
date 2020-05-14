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