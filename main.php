<?php
  require_once("connect.php");
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>Home - Le Scope UP7D</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="main.css" type="text/css">
  </head>

  <body>
    <a href="main.php"><img class="logo" src="logo.png" alt="Le Scope"></a>
    <div class="categories">
      <table><tr>
      <?php //Creation d'une table avec les liens vers les categories
        $req = "SELECT * FROM categorie ORDER BY catid";
        $res = mysqli_query($co, $req);
        //$ligne= mysqli_fetch_assoc($res); //N'est pas necessaire empeche laffichae de la categorie 1
        while ($ligne = mysqli_fetch_assoc($res)) {
          echo("<th style=\"width:".(100/(mysqli_num_rows($res)+1))."%\"><a href=\"main.php?cat=".safefromDB($ligne["catid"])."\">".safefromDB($ligne["catnom"])."</a></th>");
        }
      ?>
    </tr></table>
    </div>
    <hr>

    <div class="main">
      <div class="contenu">
        <?php
        if (!isset($_GET["page"]) || (isset($_GET["page"]) && safehtml($_GET["page"]) == "article")) {
          require_once("article.php");
          if (isset($_GET["cat"])) listearticle($co,requeteCat(safehtml($_GET["cat"])));
          else if (isset($_GET["page"]) && safehtml($_GET["page"]) == "article" && isset($_GET["id"])) affichearticleentier($co,safehtml($_GET["id"]));
          else listearticle($co,"SELECT * FROM categorie, users, articles WHERE (user = userid) AND (cat = catid) ORDER BY timecreation DESC LIMIT 10");
        }
        if (isset($_GET["page"])) {
        switch (safehtml($_GET["page"])) {
            case "creation" : require_once("creation.php"); break;
            case "inscription" : require_once("inscription.php"); break;
            case "validation" : require_once("article.php"); break;
                                articlenonvalidehasard($co); break;
            case "profil" : require_once("profil.php"); break;
            case "modif" : require_once("modif.php"); break;
          }
        }
            ?>
      </div>

      <div class="login">
        <?php
        if (isset($_GET["page"]) && safehtml($_GET["page"]) == "inscription") echo("Créez votre compte pour rejoindre notre communauté.");
        else  require_once("login.php");

        ?>
      </div>
    </div>
  </body>
