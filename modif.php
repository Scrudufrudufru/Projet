<?php
require_once("connect.php");
if (isset($_SESSION["username"])) {//Verification d'une correction ouverte (englobe tout sauf le dernier else qui print que l'on est pas connecté)

  //Recuperation des données actuelles de l'utilisateur
  $req = "SELECT * FROM users WHERE username=\"".safeDB($co,$_SESSION["username"])."\";";
  $res = mysqli_query($co,$req);
  $ligne = mysqli_fetch_assoc($res);
  $userid = safefromDB($ligne["userid"]);
  //cas ou l'utilisateur a validé le formulaire pour les données autre que le mot de passe
    if (isset($_POST["username"]) && !empty($_POST["username"]) && safehtml($_POST["username"])!=safehtml($ligne["username"])) {//Variable est definie et differente de la valeur actuelle
      $req ="UPDATE users SET username=\"".safeDB($co,$_POST["username"])."\" WHERE userid=\"".safeDB($co,$ligne["userid"])."\";";//Requete
      $changeuser = mysqli_query($co,$req);//Execution de la requete et boolean pour confirmation
      if ($changeuser) $_SESSION["username"] = safehtml($_POST["username"]);//Changement de la variable de session
    }
    if (isset($_POST["nom"]) && !empty($_POST["nom"]) && safehtml($_POST["nom"])!=safehtml(safefromDB($ligne["nom"]))) {//Variable est definie et differente de la valeur actuelle
      $req ="UPDATE users SET nom=\"".safeDB($co,$_POST["nom"])."\" WHERE userid=\"".safeDB($co,$ligne["userid"])."\";";//Requete
      $changenom = mysqli_query($co,$req);//Execution de la requete et boolean pour confirmation
    }
    if (isset($_POST["prenom"]) && !empty($_POST["prenom"]) && safehtml($_POST["prenom"])!=safehtml($ligne["prenom"])) { //Variable est definie et differente de la valeur actuelle
      $req ="UPDATE users SET prenom=\"".safeDB($co,$_POST["prenom"])."\" WHERE userid=\"".$ligne["userid"]."\";";//Requete
      $changeprenom = mysqli_query($co,$req);//Execution de la requete et boolean pour confirmation
    }
    if (isset($_POST["email"]) && !empty($_POST["email"]) && safehtml($_POST["email"])!=safehtml(safefromDB($ligne["email"]))) {//Variable est definie et differente de la valeur actuelle
      $req = "UPDATE users SET email=\"".safeDB($co,$_POST["email"])."\" WHERE userid=\"".$ligne["userid"]."\";";//Requete
      $changeemail= mysqli_query($co,$req);//Execution de la requete et boolean pour confirmation
    }

  //cas ou lutilisateur a valide le formulaire pour les mots de passe
  //Les variables sont definies et non nulles et les mots de passe sont identiques
    if (isset($_POST["oldpw"]) && isset($_POST["password"]) && isset($_POST["passwordcheck"]) &&
    !empty($_POST["oldpw"]) && !empty($_POST["password"]) && !empty($_POST["passwordcheck"]) && safehtml($_POST["password"]) == safehtml($_POST["passwordcheck"])) {

    $x = $ligne['password'];//recuperation du mot de passe (requete deja passe)
      if (password_verify(safehtml($_POST['oldpw']), $x)) { //Verification du vieux mot de passe
        $password = safeDB($co,$_POST["password"]); //Traitement pour DB
        $password = password_hash($password,PASSWORD_DEFAULT); //hashage
        if (!password_verify(safehtml($_POST['password']), $x)) {
          $req ="UPDATE users SET password=\"".$password."\" WHERE userid=\"".$ligne["userid"]."\";";
          $changepassword= mysqli_query($co,$req);//Requete executee et boolean
        }
      }
    }
  //Suite sera executée si lutilisateur est connecté
  //Messages de confirmation et d'erreur pour les changements
  //password
  if (isset($changepassword) && $changepassword) echo ("<span style=\"color: red;\">Changement de mot de passe enregistré.</span>");
  else if (isset($changepassword) && !$changepassword) echo ("<span style=\"color: red;\">Le changement de mot de passe a échoué.</span>");
  //autres
  //if ((isset($changenom) || isset($changeuser) || isset($changeemail) || isset($changeprenom)) && (!$changenom || !$changeuser || !$changeemail || !$changeprenom)) echo ("Une erreur a été rencontré lors de la mise à jour des de vos données!");

  echo("<div class=\"formulaire\"><form action=\"main.php?page=modif\" method=\"POST\"><div class=\"input\">Nom d'utilisateur<br><input type=\"text\" size=\"40\" name=\"username\"");
    if (isset($_POST["username"]) && !empty($_POST["username"])) echo ("value=\"".safehtml($_POST["username"])."\"><br>");
    else if (isset($ligne["username"])) echo ("value=\"".safefromDB($ligne["username"])."\"><br>");
    else echo("><br>");
  echo("</div><div class=\"input\">Nom<br><input type=\"text\" size=\"40\"  name=\"nom\"");
    if (isset($_POST["nom"]) && !empty($_POST["nom"])) echo ("value=\"".safehtml($_POST["nom"])."\"><br>");
    else if (isset($ligne["nom"])) echo ("value=\"".safefromDB($ligne["nom"])."\"><br>");
    else echo ("><br>");
  echo("</div><div class=\"input\">Prénom<br><input type=\"text\" size=\"40\"  name=\"prenom\"");
    if (isset($_POST["prenom"]) && !empty($_POST["prenom"])) echo ("value=\"".safehtml($_POST["prenom"])."\"><br>");
    else if (isset($ligne["prenom"])) echo ("value=\"".safefromDB($ligne["prenom"])."\"><br>");
    else echo("><br>");
  echo("</div><div class=\"input\">Adresse mail<br><input type=\"email\" size=\"40\"  name=\"email\"");
    if (isset($_POST["email"]) && !empty($_POST["email"])) echo ("value=\"".safehtml($_POST["email"])."\"><br>");
    else echo("><br>");
    echo("</div><br><div class=\"input\"><input type=\"submit\" value=\"Valider un changement\"></div></form></div>");

    echo("<br><br>");

    if (isset($_POST["password"]) && !empty($_POST["password"]) && isset($_POST["passwordcheck"]) && !empty($_POST["passwordcheck"]) && safehtml($_POST["password"]) != safehtml($_POST["passwordcheck"])) echo("<span style=\"color:red;\">Les mots de passe ne correspondent pas!</span>");
    echo("<div class=\"formulaire\"><form action=\"main.php?page=modif\" method=\"POST\">
      <div class=\"input\">Votre mot de passe actuel<br><input type=\"password\" size=\"40\" name=\"oldpw\"><br></div>
      <div class=\"input\">Choisissez un nouveau mot de passe<br><input type=\"password\" size=\"40\" name=\"password\"><br></div>
      <div class=\"input\">Confirmez votre nouveau mot de passe<br><input type=\"password\" size=\"40\" name=\"passwordcheck\"><br></div>
      <br><div class=\"input\"><input type=\"submit\" value=\"Changer votre mot de passe\"></div>
    </form>
    </div>");
    echo("<br><br>Choisissez une photo de profil: <br>");
    if (isset($_POST["submit"]) && $_POST["submit"]==="Upload Image") {
      require_once("upload.php");
    }

    echo('<form action="main.php?page=modif" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
    </form>');

} else {
  echo("Vous n'êtes pas connecté. <a href=\"main.php?page=modif\">Rejoingnez la communauté</a>");
}

?>
