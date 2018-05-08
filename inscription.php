<?php
  require_once 'connect.php';
  echo("<h2>Inscription</h2>");

  //Traitement des données du formulaire d'inscription
  if (isset($_POST["username"]) && !empty($_POST["username"]) && isset($_POST["prenom"]) &&
            !empty($_POST["prenom"]) && isset($_POST["email"]) && !empty($_POST["email"])&&
            isset($_POST["nom"]) && !empty($_POST["nom"]) && isset($_POST["password"]) &&
            !empty($_POST["password"]) && isset($_POST["passwordcheck"]) && !empty($_POST["passwordcheck"]) &&
            $_POST["password"] == $_POST["passwordcheck"]) {
    $username = safeDB($co,$_POST["username"]);
    $password = safeDB($co,$_POST["password"]);
    $password = password_hash($password,PASSWORD_DEFAULT);
    $nom = safeDB($co,$_POST["nom"]);
    $prenom = safeDB($co,$_POST["prenom"]);
    $email = safeDB($co,$_POST["email"]);

    $req = "INSERT INTO users (username,password,nom,prenom,email) VALUES (\"".$username."\",\"".$password."\",\"".$nom."\",\"".$prenom."\",\"".$email."\")";
    $rel = mysqli_query($co,$req);
    if ($rel) {
      echo ("Inscription reussie, <a href=\"main.php\"> retour à l'acceuil");
      $_SESSION["username"] = $username;
    }

  } else {
    echo("<div id=\"formulaire\"><form action=\"inscription.php\" method=\"POST\"><div id=\"input\">Nom d'utilisateur<br><input type=\"text\" name=\"username\"");
      if (isset($_POST["username"]) && !empty($_POST["username"])) echo ("value=\"".$_POST["username"]."\"><br>");
      else echo("><br>");
    echo("</div><div id=\"input\">Nom<br><input type=\"text\" name=\"nom\"");
      if (isset($_POST["nom"]) && !empty($_POST["nom"])) echo ("value=\"".$_POST["nom"]."\"><br>");
      else echo ("><br>");
    echo("</div><div id=\"input\">Prénom<br><input type=\"text\" name=\"prenom\"");
      if (isset($_POST["prenom"]) && !empty($_POST["prenom"])) echo ("value=\"".$_POST["prenom"]."\"><br>");
      else echo("><br>");
    echo("</div><div id=\"input\">Adresse mail<br><input type=\"email\" name=\"email\"");
      if (isset($_POST["email"]) && !empty($_POST["email"])) echo ("value=\"".$_POST["email"]."\"><br>");
      else echo("><br>");
    if (isset($_POST["password"]) && !empty($_POST["password"]) && isset($_POST["passwordcheck"]) &&
      !empty($_POST["passwordcheck"]) && $_POST["password"] != $_POST["passwordcheck"]) echo("<span style=\"color:red;\">Les mots de passe ne correspondent pas!</span>");
    echo("</div>
        <div id=\"input\">Choisissez un mot de passe<br><input type=\"password\" name=\"password\"><br></div>
        <div id=\"input\">Confirmez votre mot de passe<br><input type=\"password\" name=\"passwordcheck\"><br></div>
        <div id=\"input\"><input type=\"submit\" value=\"Inscription\"></div>
      </form>
      </div>");
  }
?>
