<?php
  require_once("connect.php");
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>Home - La Collab UP7D</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="main.css" type="text/css">
  </head>

  <body>
    <a href="main.php"><img class="logo" src="logo.png" alt="Le Scope"></a>
    <div class="categories">
      <table><tr>
      <?php //Creation d'une table avec les liens vers les categories
        $req = "SELECT * FROM categorie ORDER BY catid;";
        $res = mysqli_query($co, $req);
        //$ligne= mysqli_fetch_assoc($res); //N'est pas necessaire empeche laffichae de la categorie 1
        while ($ligne = mysqli_fetch_assoc($res)) {
          echo("<th><a href=\"main.php?cat=".safehtml($ligne["catid"])."\">".safehtml($ligne["catnom"])."</a></th>");
        }
      ?>
    </tr></table>
    </div>
    <hr>

    <div class="main">
      <div class="contenu">
        <?php
        if (!isset($_GET["page"]) || (isset($_GET["page"]) && $_GET["page"] == "article")) {
          require_once("article.php");
        }
        if (isset($_GET["page"])) {
          if ($_GET["page"] == "creation") {
            require_once("creation.php");
          }
          if ($_GET["page"] == "inscription") {
            require_once("inscription.php");
          }
        }

            ?>
      </div>

      <div class="login">
        <?php
        if (isset($_GET["page"]) && $_GET["page"] == "inscription") echo("Créez votre compte pour rejoindre notre communauté.");
        else  require_once("login.php");
        ?>
      </div>
    </div>
  </body>
