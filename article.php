<?php
  require_once("connect.php");

  function affichearticlecourt ($titre,$nom,$prenom,$date,$cat,$resume,$id) { //Renvoie une division avec un article
      echo("<div class=\"header\"><a href=\"main.php?page=article&id=".$id."\">
        <h2>".$titre."</h2>
        ".$date."<br>".$cat."
        <div class=\"corps\">".$resume."</div></a>
      </div>");
  }

  function affichearticleentier ($co, $id) {
      $req = "SELECT articles.titre, articles.resume, articles.timecreation, articles.texte, categorie.catnom, users.nom, users.prenom FROM users, categorie, articles WHERE (user = userid) AND (cat = catid) AND (article_id=\"".$id."\")";
      $res = mysqli_query($co,$req);
      $ligne = mysqli_fetch_assoc($res);
      $text = $ligne["texte"];
      echo("<div class=\"article\">
        <h2>".$ligne["titre"]."</h2>
        <p>".$ligne["resume"]."</p>
        ".$ligne["timecreation"]."<br>".$ligne["prenom"]." ".$ligne["nom"]."<br>
        ");
        echo $text;
        echo("
      </div>");
  }

  function listearticle ($co,$req){ //Affiche une liste des articles de la requete sql
    $res = mysqli_query($co,$req);
    if (!$res) echo ("erreur : ");
    else {
      while($ligne = mysqli_fetch_assoc($res)) {
        affichearticlecourt(safehtml($ligne["titre"]),safehtml($ligne["nom"]),safehtml($ligne["prenom"]),safehtml($ligne["timecreation"]),safehtml($ligne["catnom"]),safehtml($ligne["resume"]),safehtml($ligne["article_id"]));
      }
    }
  }

//Il faut preciser la requete pour ne prendre que les colonnes necessaires
  function requeteCat ($catid) { //Renvoie la requete pour les articles d'une categorie
    $var = "SELECT articles.titre, users.nom, users.prenom, articles.timecreation, categorie.catnom, articles.resume, articles.article_id FROM categorie, users, articles WHERE (user = userid) AND (cat = catid) AND (cat = \"".$catid."\") ORDER BY timecreation";
    return $var;
  }

  if (isset($_GET["cat"])) {
    listearticle($co,requeteCat($_GET["cat"]));
  } else if (isset($_GET["page"]) && $_GET["page"] == "article") {
    affichearticleentier($co,$_GET["id"]);
    echo("dfe");
  }
?>
