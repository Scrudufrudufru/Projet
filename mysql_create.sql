DROP TABLE IF EXISTS images;
DROP TABLE IF EXISTS validation;
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
  media VARCHAR(20),
  mediadescription VARCHAR(255),
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

CREATE TABLE IF NOT EXISTS images (
  image_id BIGINT AUTO_INCREMENT,
  image_path VARCHAR(20) NOT NULL UNIQUE,
  article_id_img BIGINT,
  PRIMARY KEY (image_id),
  FOREIGN KEY (article_id_img) REFERENCES articles(article_id)
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

INSERT INTO articles (user, cat, titre, resume, timecreation, texte)
VALUES
('1','1','Vestibulum et dui libero. Sed.','Praesent blandit nibh dolor, vel aliquam dolor malesuada vel. Aliquam nec viverra quam. Nunc molestie lacus eu ex hendrerit, ac laoreet nisi accumsan.','2018-05-08 11:34:34','<p>Mauris pretium odio lobortis mi cursus placerat. Morbi non elit varius, iaculis lectus sed, ultrices nisl. Nulla facilisi. Phasellus magna dui, vehicula in congue eget, rhoncus id nisl. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Pellentesque sit amet lectus velit. Fusce iaculis augue ipsum, at tristique tortor dictum nec. Aenean enim urna, placerat in orci at, finibus volutpat libero. Nullam placerat facilisis est, id lobortis purus. Nunc felis tortor, condimentum at cursus quis, pulvinar ut justo. Quisque et finibus urna, nec pretium orci.</p><p>Praesent vulputate efficitur bibendum. Cras non viverra justo. Aenean a egestas diam. Sed mollis imperdiet ante id euismod. Mauris molestie in ex ut iaculis. Curabitur molestie, lacus sed facilisis iaculis, lorem enim lacinia elit, a mollis augue mauris quis nibh. Maecenas ante sem, venenatis vel dictum et, accumsan ut libero. Pellentesque consectetur dignissim nulla sit amet lobortis. Nulla non ipsum id justo tincidunt rhoncus. Nam faucibus magna rutrum orci viverra, ac finibus justo varius. Integer et diam facilisis, semper sem sed, fringilla ligula. Integer urna ligula, molestie elementum enim eget, congue hendrerit lectus. Etiam nec porta urna, a lacinia est. Fusce iaculis ac nibh vel elementum.</p>'),
('1','2','Mauris nunc sapien, quis consectetur.','Aliquam at fermentum augue, in interdum nibh. Praesent elementum lectus eget nunc varius, sit amet placerat urna pharetra. Quisque nec sodales neque. Ut.','2018-04-13 21:23:56','<p>Donec interdum efficitur elit ac mollis. Praesent elit nisl, rhoncus non faucibus vitae, condimentum nec quam. Nam molestie dolor et euismod luctus. Fusce id justo luctus, finibus ex eu, tristique est. Maecenas sodales enim vitae ullamcorper tincidunt. Donec quis laoreet justo. Curabitur eget semper ipsum. Sed eu ante velit.</p><p>Nulla facilisi. Curabitur lobortis justo ut euismod ornare. Nulla viverra nunc id mi eleifend venenatis. Mauris eu lacus ut ligula eleifend ornare sed cursus elit. Donec posuere lectus in enim vulputate malesuada. Pellentesque ac nunc ullamcorper, semper mi et, venenatis nulla. Etiam eleifend blandit mauris, ac vehicula enim sollicitudin id. Donec porttitor lorem fringilla commodo sodales. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum elit nulla, posuere eu sagittis convallis, tincidunt a lectus.</p>'),
('2','3','Quisque porta pellentesque sollicitudin','Maecenas commodo metus lorem, ac malesuada ligula interdum lacinia. Duis eget accumsan mauris, in.','2018-03-24 11:27:21','<p>Pellentesque et dui at risus vulputate convallis a et orci. Nulla rutrum tincidunt tempus. Morbi ultricies massa ac egestas pulvinar. Phasellus sed lobortis urna, vel auctor lacus. Vestibulum bibendum varius libero, non efficitur est semper nec. Nam vel augue quis eros semper elementum. Integer iaculis augue turpis, in varius purus commodo sit amet. Pellentesque sodales purus ut orci scelerisque maximus. Curabitur sodales arcu ut dolor mattis congue. Sed nulla elit, placerat vel felis a, ultrices hendrerit purus.</p><p>Cras iaculis est tortor, eu consequat risus varius ut. Etiam et magna in nunc rhoncus condimentum. Vivamus et porta sapien. Vivamus pulvinar tortor ac sem elementum, eget viverra est rutrum. Integer mattis tellus leo, in maximus neque volutpat sit amet. Vivamus rhoncus augue sed libero auctor scelerisque. Fusce luctus luctus enim quis ornare.</p><p>Mauris eget vulputate dui. Aenean sodales quis est et ultricies. Donec nec tincidunt lectus. Pellentesque a elit at nulla efficitur sollicitudin. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse non nibh euismod, interdum elit quis, sollicitudin velit. Proin quis sapien nec diam mattis sollicitudin. Vivamus elementum tellus vel felis euismod porttitor egestas id magna. Integer vehicula non erat ut varius. Aenean dolor risus, scelerisque quis elementum sit amet, vulputate sed erat. Nulla consectetur ultricies pellentesque. Vestibulum sit amet arcu non neque pharetra eleifend at in nisl.</p>'),
('3','5','In hac habitasse platea dictumst.',' Aliquam eleifend porta libero, eu maximus quam semper at. Integer interdum sodales nullam.','2018-05-02 19:53:17','<p>Morbi et tellus eget libero mollis iaculis non vel justo. Nullam arcu lorem, fermentum eget suscipit eget, pretium sed metus. Etiam euismod mauris ultrices, efficitur turpis a, interdum purus. Vestibulum dictum, urna sed interdum mattis, erat massa laoreet enim, vitae scelerisque est neque quis lectus. Pellentesque aliquam volutpat odio sodales lacinia. Sed vitae odio rutrum, interdum leo nec, finibus velit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla pretium tortor velit, ac lacinia urna eleifend ut. Integer pulvinar augue eget dui ullamcorper, sed fermentum tellus hendrerit. Ut dictum nec neque a imperdiet. Vivamus bibendum luctus sem. Quisque tempor purus non dolor lobortis, sit amet scelerisque urna luctus. Aliquam erat volutpat. In pretium turpis nec libero aliquam, vitae vulputate nunc porttitor. Nunc eget felis fermentum nunc blandit consectetur in sed nibh.</p><p>Integer blandit porta nisl semper consectetur. Nam eget arcu lacinia, tincidunt turpis ut, aliquet nisi. Suspendisse eget elementum nisl. Mauris ipsum quam, tincidunt sit amet tellus id, porttitor tincidunt tortor. Nunc finibus sem fermentum ipsum consequat porttitor. Ut porttitor malesuada mi non fringilla. Curabitur malesuada turpis at velit eleifend, eu rhoncus tortor sollicitudin. Sed finibus risus turpis, at vulputate urna pellentesque nec. Ut luctus felis in sagittis porta.</p><p>Quisque ac massa sed mauris facilisis cursus. Donec laoreet metus enim, vitae pharetra odio rhoncus sit amet. Sed sit amet metus et ex semper fermentum. Morbi vitae leo vel metus malesuada hendrerit. Nulla tempus commodo lacinia. Duis eget tellus ullamcorper mi varius elementum. Morbi in elit quis ex rhoncus sodales vel a velit. Aliquam ut ligula dui. Integer et massa vel tellus egestas ultrices eget laoreet ipsum. Integer aliquam ultrices posuere. Integer elementum a eros sed rhoncus. Cras vitae est vitae lorem egestas dictum ut rutrum tortor. Pellentesque ultricies, nibh id sollicitudin aliquam, mi nisi lobortis ante, sit amet fermentum ligula nulla at nisi. Cras in rhoncus metus, eget placerat mauris. Pellentesque sodales quis libero nec sagittis. In eget nibh blandit, aliquam sem ut, ultricies nulla.<p></p>Vivamus et orci eu nibh tempor mattis. Maecenas leo purus, fermentum eget feugiat in, fermentum ac tellus. Sed porttitor aliquet nulla eu tempor. Cras lacinia mi id placerat sagittis. Proin ullamcorper lacus in justo auctor laoreet. Sed fringilla molestie orci ut varius. Proin et faucibus dui. Aliquam erat volutpat. Integer arcu magna, cursus quis ornare sed, viverra vitae risus. Proin placerat justo neque, in tincidunt turpis condimentum ultrices. Sed cursus, urna sit amet lacinia convallis, massa sapien tincidunt dolor, sed dignissim neque ex nec leo. Donec sagittis porttitor est, vel fermentum lacus tristique quis. Vivamus sapien neque, faucibus eget risus at, viverra blandit tortor. Curabitur ut libero lectus.</p><p>Vestibulum in metus lectus. Aliquam eleifend commodo finibus. Nullam leo velit, luctus vitae hendrerit sit amet, pretium vitae odio. Morbi vestibulum nec augue ut dictum. Maecenas eu finibus eros. Quisque euismod libero non dictum rhoncus. Nullam non arcu at neque pulvinar egestas. Duis hendrerit, enim sed commodo bibendum, est sapien facilisis massa, in efficitur justo nulla quis diam. Ut dignissim erat non commodo facilisis. In libero magna, bibendum nec lacus non, molestie porta ipsum. Aliquam erat volutpat.</p>');
