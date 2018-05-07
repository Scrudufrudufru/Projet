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
    <h1>La Collab UP7D</h1>
    <div id="categories">
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
    <div id="contenu">
      <?php
      if (!isset($_GET["page"])) {
        require_once("article.php");
        affichearticle("Article n*1","Bauer","David","Lundi 7 Mai 2018","Actualités","Local images can be uploaded to TinyMCE through the use of the new editor.uploadImages() function. This functionality is handled asynchronously, meaning that it is possible for users to save their content before all images have completed uploading. If this occurs, no server path to the remote image will be available and the images will be stored as Base 64. To avoid this situation, it is recommended that the editor.uploadImages() function be executed prior to submitting the editor contents to the server. Once all images have been uploaded, a success callback can be utilized to execute code. This success callback can be used to save the editor's content to the server through a POST.");
      }
      if ($_GET["page"] == "creation") {
        require_once("creation.php");
      }
          ?>
    </div>

    <div id="login">
      <?php
        if ($_GET["page"] == "connexion"){}
      ?>
    </div>

  </body>
