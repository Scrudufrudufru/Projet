CREATE TABLE IF NOT EXISTS users(
  userid BIGINT AUTO_INCREMENT,
  username VARCHAR(20) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  nom VARCHAR(20) NOT NULL,
  prenom VARCHAR(20) NOT NULL,
  email VARCHAR(40) NOT NULL UNIQUE,
  points INT NOT NULL DEFAULT -1,
  photo VARCHAR(20),
  PRIMARY KEY (userid)
) CHARSET=utf8;

CREATE TABLE IF NOT EXISTS  categorie (
  catid INT AUTO_INCREMENT,
  catnom VARCHAR(20) NOT NULL UNIQUE,
  PRIMARY KEY (catid)
) CHARSET=utf8;

CREATE TABLE IF NOT EXISTS articles(
  article_id BIGINT AUTO_INCREMENT,
  user BIGINT,
  cat INT,
  titre VARCHAR(40) NOT NULL,
  resume VARCHAR(255),
  timecreation DATETIME NOT NULL,
  texte TEXT NOT NULL,
  note INT NOT NULL DEFAULT 0,
  image VARCHAR(20),
  imgdescription VARCHAR(255),
  son VARCHAR(20),
  sondescription VARCHAR(255),
  video VARCHAR(20),
  videodescription VARCHAR(255),
  PRIMARY KEY (article_id),
  FOREIGN KEY (user) REFERENCES users(userid),
  FOREIGN KEY (cat) REFERENCES categorie(catid)
) CHARSET=utf8;

INSERT INTO categorie (catnom) VALUES ('Actualités Fac'),('International'),('Politique'),('Culture'),('Sciences');
