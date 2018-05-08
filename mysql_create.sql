DROP TABLE IF EXISTS articles;
DROP TABLE IF EXISTS categorie;
DROP TABLE IF EXISTS users;


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
) ;

CREATE TABLE IF NOT EXISTS  categorie (
  catid INT AUTO_INCREMENT,
  catnom VARCHAR(20) NOT NULL UNIQUE,
  PRIMARY KEY (catid)
);

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
);

CREATE TABLE IF NOT EXISTS validation (
  valid_id BIGINT AUTO_INCREMENT,
  user_id BIGINT,
  articleid BIGINT,
  PRIMARY KEY (valid_id),
  FOREIGN KEY (user_id) REFERENCES users(userid),
  FOREIGN KEY (articleid) REFERENCES articles(article_id)
);

INSERT INTO users(username, password,nom,prenom,email)
VALUES  ('user1','$2y$10$OB8OsgNmfAhNP6wsRnWQgezQ43Vm9YuiiC6aWGC6iz2Qeez3C6qWq','Nomu1','Prenomu1','email1@mail.com'),
        ('user2','$2y$10$/LBNbUZtcXo1x9jfTFbno.UHBVQgUFWWsEwPMl2e/VIkktTWDQ66C','Nomu2','Prenomu2','email2@mail.com'),
        ('user3','$2y$10$gkTti9Io/fucg/vBevUs.O7PcJ4DabVeuJnOQj/Urmpj1gjIghy4G','Nomu3','Prenomu3','email3@mail.com'),
        ('user4','$2y$10$OB8OsgNmfAhNP6wsRnWQgezQ43Vm9YuiiC6aWGC6iz2Qeez3C6qWq','Nomu4','Prenomu4','email4@mail.com'),
        ('user5','$2y$10$/LBNbUZtcXo1x9jfTFbno.UHBVQgUFWWsEwPMl2e/VIkktTWDQ66C','Nomu5','Prenomu5','email5@mail.com'),
        ('user6','$2y$10$gkTti9Io/fucg/vBevUs.O7PcJ4DabVeuJnOQj/Urmpj1gjIghy4G','Nomu6','Prenomu6','email6@mail.com'),
        ('user7','$2y$10$OB8OsgNmfAhNP6wsRnWQgezQ43Vm9YuiiC6aWGC6iz2Qeez3C6qWq','Nomu7','Prenomu7','email7@mail.com'),
        ('user8','$2y$10$/LBNbUZtcXo1x9jfTFbno.UHBVQgUFWWsEwPMl2e/VIkktTWDQ66C','Nomu8','Prenomu8','email8@mail.com'),
        ('user9','$2y$10$gkTti9Io/fucg/vBevUs.O7PcJ4DabVeuJnOQj/Urmpj1gjIghy4G','Nomu9','Prenomu9','email9@mail.com');


INSERT INTO categorie (catnom)
VALUES  ('Actualités Fac'),
        ('International'),
        ('Politique'),
        ('Société'),
        ('Culture'),
        ('Sciences'),
        ('Opinion');
