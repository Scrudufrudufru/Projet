<!--Importation du java script pour l'editeur de texte-->
<script src="./tinymce/js/tinymce/tinymce.min.js"></script>
<!--Configuration de l'éditeur de texte-->
<script type="text/javascript"> tinymce.init({
    selector: '#mytextarea', //C'est l'id de l'element html qui sera remplace par l'editeur
    menubar: false, //retire le menubar (pour la creation de nouveaux fichiers donc inutlie)
    plugins: "media lists autolink contextmenu image link", //plugins a ajouter a lediteur
    toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright outdent indent | bullist numlist | link image media', //options pour lediteur
    branding: false, //Enleve le lien vers le site tinymce
    height: 500, //Taille de lediteur
    width: 800,
    contextmenu: "undo redo | copy cut paste | link image media" //Actions clique droit dans l'editeur

    //Pour uploader des fichiers
    //file_browser_callback: function(field_name, url, type, win) {win.document.getElementById(field_name).value = 'my browser value';}
}) </script>
<?php
  require_once("./connect.php");
  echo ("<p>Création d'un nouvel article</p>");
  //Traitement du formulaire
  if (isset($_POST["titre"]) && isset($_POST["cat"]) && isset($_POST["text"]) && !empty($_POST["titre"]) && !empty($_POST["cat"]) && !empty($_POST["text"]) && ($_POST["text"] != "<p>Hello,+World!</p>") && $_POST["titre"] != "Titre") {
    $titre = safeDB($co, $_POST["titre"]);
    $cat = safeDB($co, $_POST["cat"]);
    $text = safeDB($co, $_POST["text"]);

    $req = "SELECT userid FROM users WHERE username=\"".$_SESSION["username"]."\"";
    $res = mysqli_query($co,$req);
    $ligne = mysqli_fetch_assoc($res);
    $userid = $ligne["userid"];

    $req = "INSERT INTO articles (user,cat,titre,timecreation,texte) VALUES (\"".$userid."\",\"".$cat."\",\"".$titre."\",\"".date("Y-m-d H:i:s")."\",\"".$text."\")";
    mysqli_query($co,$req);
    echo ("Article enregistré et en attente de validation"); //Ajouter un preview de l'article
  } else { // Si tous les inputs ne sont pas remplis on affiche le formulaire en gardant les cases deja remplis
    //formulaire : case titre
    if (isset($_POST["titre"]) || isset($_POST["text"])) echo ("Vous n'avez pas correctement rempli le formulaire");
    echo("<form method=\"POST\" action=\"main.php?page=creation\"> Titre :");
    if (isset($_POST["titre"]) && !empty($_POST["titre"]) && $_POST["titre"] != "Titre") echo ("<input type=\"text\" name=\"titre\" value=\"".safehtml($_POST["titre"])."\"><br>");
    else echo("<input type=\"text\" name=\"titre\" value=\"Titre\" required><br>");

    //Choix de la categorie
    echo("<select name=\"cat\">");
    $req = "SELECT * FROM categorie ORDER BY catid;"; //requete pour les categories
    $res = mysqli_query($co, $req);
    while ($ligne = mysqli_fetch_assoc($res)) { //parcours la liste des categoires en les affichants
        echo("<option value=\"".safehtml($ligne["catid"])."\" ");
        if (isset($_POST["cat"]) && $ligne["catid"] == $_POST["cat"]) echo("selected"); // ajoute l'attribut selected sur la categorie choissie
        echo(">".safehtml($ligne["catnom"])."</option>");
    }
    echo("</select><br><br>");

    //editeur
    if (isset($_POST["text"]) && !empty($_POST["text"]) && $_POST["text"] != "<p>Hello,+World!</p>") echo ("<textarea id=\"mytextarea\" name=\"text\">".safehtml($_POST["text"])."</textarea>");
    else echo ("<textarea id=\"mytextarea\" name=\"text\">Hello, World!</textarea>");

    echo("<br><input type=\"submit\">");
  }
?>
