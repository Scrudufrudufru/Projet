<?php
  require_once("connect.php");
  if (isset($_SESSION["username"])) { //Cas ou l'on est connecté
    $req = "SELECT nom,prenom FROM users WHERE username =\"".$_SESSION["username"]."\";";
    $res = mysqli_query($co,$req);
    $ligne = mysqli_fetch_assoc($res);
    echo("Bonjour".$ligne["prenom"]." ".$ligne["nom"]."<br><a href=\"profile.php\">Profile</a><br><a href=\"main.php?page=creation>Nouvel article</a><br><a href=\"main.php?page=validation\"");
  } else if (!isset($_SESSION["username"])) { //Cas ou non connecté
    if (isset($_POST["username"]) && !empty($_POST["username"]) && isset($_POST["password"]) && !empty($_POST["password"])) {
      $req = "SELECT username, password FROM users WHERE username=\"".$_POST["username"]."\"";
      $res = mysqli_query($co, $req);
      $x;
      if ($res) {
        $ligne = mysqli_fetch_assoc($res);
        $x = $ligne['password'];
      }
      if (password_verify($_POST['password'], $x)) {
        $_SESSION['username'] = htmlspecialchars($_POST['username']);
        header('Location: main.php');
        exit();
      } else {
        $err = 'Mot de passe incorrect<br>';
      }
    } else {
      echo("<form action=\"main.php\" method=\"post\">
      Identifiant<br>
      <input type=\"text\" name=\"username\"");
      //On garde le nom dutilisateur dans le formulaire
      if (isset($_POST["username"]) && !empty($_POST["username"])) echo (" value=\"".$_POST["username"]."\"");
      echo("><br>
      Mot de passe<br>
      <input type=\"password\" name=\"password\"><br><br>
      <input type=\"submit\" value=\"Valider\">
      </form>
      <p>Vous ne possédez pas encore de compte ? <a href=\"main.php?page=inscription\">Cr&eacute;ez-en un !</a></p>
      ");
    }
  }

?>
