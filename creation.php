<script src="./tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript"> tinymce.init({
    selector: '#mytextarea',
    menubar: false,
    plugins: "media lists autolink contextmenu image link",
    toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright outdent indent | bullist numlist | link image media',
    branding: false,
    height: 500,
    width: 800,
    contextmenu: "undo redo | copy cut paste | link image media"

    //Pour uploader des fichiers
    //file_browser_callback: function(field_name, url, type, win) {win.document.getElementById(field_name).value = 'my browser value';}
}) </script>
<?php
  require_once("./connect.php");
  if (isset($_POST["titre"]) && isset($_POST["cat"]) && isset($_POST["text"]) && !empty($_POST["titre"]) && !empty($_POST["cat"]) && !empty($_POST["text"]) && $_POST["text"] == "<p>Hello,+World!</p>") {
    $titre = safeDB($_POST["titre"]);
    $cat = safeDB($_POST["cat"]);
    $text = safeDB($_POST["text"]);
    //$req = "INSERT INTO articles (user,cat,titre,timecreation,texte) VALUES (/*userid*/,$cat,$titre,$text,date("Y-m-d H:i:s"))";
    //mysqli_query($co,$req);
    echo ("Article enregistré et en attente de validation");
  } else {
    echo("<form method=\"POST\" action=\"creation.php\"> Titre :");

    if (isset($_POST["titre"]) && !empty($_POST["titre"])) echo ("<input type=\"text\" name=\"titre\" value=\"".safehtml($_POST["titre"])."\"><br>");
    else echo("<input type=\"text\" name=\"titre\"><br>");

    if (!isset($_POST["titre"]) || empty($_POST["titre"])) {
      echo ("<select name=\"cat\">
      <option value=\"x\">X</option>
    </select>");
    } else {echo ("<select name=\"cat\">
      <option value=\"x\"");if ($_POST["titre"] == "x") {echo("selected");} echo(">X</option>
    </select>"); }

    if (isset($_POST["text"]) && !empty($_POST["text"]) && $_POST["text"] != "<p>Hello,+World!</p>") echo ("<textarea id=\"mytextarea\" name=\"text\">".safehtml($_POST["text"])."</textarea>");
    else echo ("<textarea id=\"mytextarea\" name=\"text\">Hello, World!</textarea>");

    echo("<input type=\"submit\">");
  }
?>
