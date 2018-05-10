<?php
require_once('connect.php');
require_once('article.php');

if (!isset($_GET["id"]) && isset($_GET["page"]) && safehtml($_GET["page"]) == "profil" &&
                isset($_SESSION["username"])) $req = "SELECT * FROM users LEFT JOIN articles
                ON userid = user WHERE username=\"".safeDB($co,$_SESSION["username"])."\" ORDER BY timecreation DESC;";
else if (isset($_GET["id"]) && isset($_GET["page"]) && safehtml($_GET["page"]) == "profil") $req = "SELECT * FROM users LEFT JOIN articles ON userid = user WHERE user=\"".safeDB($co,$_GET["id"])."\" ORDER BY timecreation DESC;";

$res = mysqli_query($co,$req);
$ligne = mysqli_fetch_assoc($res);
echo ("<h2>".safefromDB($ligne["prenom"])." ".safefromDB($ligne["nom"])."</h2>");

mysqli_data_seek($res,0);//Pour remettre le pointeur sur la premiere ligne
if (isset($ligne["texte"])) {
  echo ("<hr><h3>Publications</h3>");
  listearticle_res($res);
}
else echo ("<hr><h3>Pas de publications à ce jour</h3>");
?>
