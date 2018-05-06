CREATE TABLE IF NOT EXISTS users(
  userid BIGINT PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(20) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  nom VARCHAR(20) NOT NULL,
  prenom VARCHAR(20) NOT NULL,
  email VARCHAR(40) NOT NULL UNIQUE,
  points INT NOT NULL DEFAULT -1,
  photo VARCHAR(20)
);

CREATE TABLE IF NOT EXISTS  categorie (
  catid INT PRIMARY KEY AUTO_INCREMENT,
  catnom VARCHAR(20) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS articles(
  article_id BIGINT PRIMARY KEY AUTO_INCREMENT,
  user INT FOREIGN KEY REFERENCES (users.userid),
  cat INT FOREIGN KEY REFERENCES (categorie.catid),
  titre VARCHAR(20) NOT NULL,
  resume VARCHAR(255),
  timecreation DATETIME NOT NULL,
  texte TEXT NOT NULL,
  note INT NOT NULL DEFAULT 0,
  image VARCHAR(20),
  imgdescription VARCHAR(255),
  son VARCHAR(20),
  sondescription(255),
  video VARCHAR(20),
  videodescription VARCHAR(255)
);
