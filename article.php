<?php
  require_once("connect.php");

  function affichearticlecourt ($titre,$nom,$prenom,$date,$cat,$resume,$id,$img) { //Renvoie une division avec un article
      echo("<div class=\"court\"><a href=\"main.php?page=article&id=".$id."\">");
      if (!empty($img)) {
        echo("<div class=\"image\"><img src=\"$img\"></div>");
      }
      echo("<div class=\"header\"><h3>".$titre."</h3>".$date." | ".$cat."</div>
        <div class=\"corps\"><p>".$resume."</p></div></a></div>");
  }

  function affichearticleentier ($co, $id) {
      $req = "SELECT articles.titre, articles.resume, articles.timecreation, articles.texte, articles.user, categorie.catnom, users.nom, users.prenom FROM users, categorie, articles WHERE (user = userid) AND (cat = catid) AND (article_id=\"".$id."\")";
      $res = mysqli_query($co,$req);
      $ligne = mysqli_fetch_assoc($res);
      $text = safefromDB($ligne["texte"]);
      echo("<div class=\"article\">
        <h2>".safefromDB($ligne["titre"])."</h2>
        <p>".safefromDB($ligne["resume"])."</p>
        ".safefromDB($ligne["timecreation"])."<br><a href=main.php?page=profil&id=".safefromDB($ligne["user"]).">".safefromDB($ligne["prenom"])." ".safefromDB($ligne["nom"])."</a><br>
        ");
        echo $text;
        echo("
      </div>");
  }

  function listearticle ($co,$req){ //Affiche une liste des articles de la requete sql
    //$req = safeDB($co,$req); NAFFICHE PLUS RIEN
    $res = mysqli_query($co,$req);
    if (!$res) echo ("erreur : ");
    else {
      while($ligne = mysqli_fetch_assoc($res)) {
        affichearticlecourt(safefromDB($ligne["titre"]),safefromDB($ligne["nom"]),safefromDB($ligne["prenom"]),safefromDB($ligne["timecreation"]),safefromDB($ligne["catnom"]),safefromDB($ligne["resume"]),safefromDB($ligne["article_id"]),safefromDB($ligne["image"]));
      }
    }
  }

    function listearticle_res ($res){ //Affiche une liste des articles sans requete
        while($ligne = mysqli_fetch_assoc($res)) {
        affichearticlecourt(safefromDB($ligne["titre"]),safefromDB($ligne["nom"]),safefromDB($ligne["prenom"]),safefromDB($ligne["timecreation"]),safefromDB($ligne["cat"]),safefromDB($ligne["resume"]),safefromDB($ligne["article_id"]),safefromDB($ligne["image"]));
      }
    }

//Il faut preciser la requete pour ne prendre que les colonnes necessaires
  function requeteCat ($co,$catid) { //Renvoie la requete pour les articles d'une categorie pas besoin de proteger le catid

    $var = "SELECT articles.titre, users.nom, users.prenom, articles.timecreation, categorie.catnom, articles.resume, articles.article_id, articles.image FROM categorie, users, articles WHERE (user = userid) AND (cat = catid) AND (cat = \"".safeDB($co,$catid)."\") ORDER BY timecreation DESC";
    return $var;
  }

  function articlenonvalidehasard ($co) {//Revoie l'id d'un article non validé
    $req ="SELECT articles.article_id FROM articles,users,validation WHERE articles.note < \"100\" AND \"".safefromDB($_SESSION["username"])."\"=username AND user_id<>userid AND user<>userid ORDER BY RAND() LIMIT 1;";
    $res = mysqli_query($co,$req);
    if (!$res) echo ("rerror");
    echo(safefromDB($ligne["article_id"]));
  }
?>
