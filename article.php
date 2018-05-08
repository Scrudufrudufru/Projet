<?php

  function affichearticlecourt ($titre,$nom,$prenom,$date,$cat,$resume) { //Renvoie une division avec un article
      echo("<div class=\"header\">
        <h2>".$titre."</h2>
        <p>".$prenom." ".$nom."<br>".$date."<br>".$cat."</p>
        <div class=\"corps\">".$resume."</div>
      </div>");
  }

  function listearticle ($res){ //Affiche une liste des articles de la requete sql
    $ligne = mysqli_fetch_assoc($res);
    while($ligne = mysqli_fetch_assoc($res)) {
      affichearticlecourt(safehtml($ligne["titre"]),safehtml($ligne["nom"]),safehtml($ligne["prenom"]),safehtml($ligne["timecreation"]),safehtml($ligne["catnom"]),safehtml($ligne["resume"]));
    }
  }

//Il faut preciser la requete pour ne prendre que les colonnes necessaires
  function requeteCat ($catid) { //Renvoie la requete pour les articles d'une categorie
    $var = "SELECT titre, nom, prenom, timecreation, cat, resume FROM categorie, users, articles WHERE (user == userid) AND (cat == catid) AND (cat == ".$catid.") ORDER BY timecreation";
    return $var;
  }

?>
