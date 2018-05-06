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
  require_once(connect.php)
  if (isset($_POST["titre"]) && isset($_POST["cat"]) && isset($_POST["text"]) && !isempty($_POST["titre"]) && !isempty($_POST["cat"]) && !isempty($_POST["text"]) && $_POST["text"] == "<p>Hello,+World!</p>") {
    $titre = safeDB($_POST["titre"]);
    $cat = safeDB($_POST["cat"]);
    $text = safeDB($_POST["text"]);
    $req = "INSERT INTO articles (user,cat,titre,timecreation,texte) VALUES (/*userid*/,$cat,$titre,$text,date("Y-m-d H:i:s"))";
    mysqli_query($co,$req);
    echo ("Article enregistré et en attente de validation");
  } else {
    if (isset($_POST[""]))
  }
?>
<form method="post" action="creation.php">
  Titre : <input type="text" name=titre><br>

  <select name="cat">
      <option value=x>Catégorie</option>
  </select>

  <textarea id="mytextarea" name="text">Hello, World!</textarea>
  <input type="submit" value="Enregistrer">
</form>
