<?php
session_start();
include 'connect.php';
function login($co) {
  $req = 'select username, password from users where username=\''.$_POST['username'].'\'';
  $res = mysqli_query($co, $req);
  $x;
  if ($res) {
    $ligne = mysqli_fetch_assoc($res);
    $x = $ligne['password'];
  }
  if (password_verify($_POST['password'], $x)) {
    $_SESSION['username'] = htmlspecialchars($_POST['username']);
    header('Location: index.php?page=compte');
    exit();
  } else {
    $err = 'Mot de passe incorrect<br>';
  }
}

if (isset($_POST['username'], $_POST['password'])) {
  login(connect());
  header('Location: ' . $_SERVER['REQUEST_URI']);
  exit();
}

?>
<!DOCTYPE html>

<html>

<head>

  <meta charset="utf-8">
  <title>Connexion&nbsp;-&nbsp;fghfgh.fr</title>
  <link rel="stylesheet" href="main.css">

</head>

<body>

  <?php

  include 'main.php';

  ?>

  <div id='content'>
    <div id='maincontent'>
      <h2>Connexion</h2>
      <?php
      if (isset($_SESSION['username'])) echo '<p>Vous &ecirc;tes connect&eacute; !<br><a href=main.php>Retour &agrave; l\'accueil</a></p>';
      else echo '
      <form action="connexion.php" method="post">
      Identifiant<br>
      <input type="text" name="username"><br>
      Mot de passe<br>
      <input type="password" name="password"><br><br>
      <input type="submit" value="Valider">
      </form>
      <p>Vous ne possédez pas encore de compte ? <a href="main.php?page=inscription">Cr&eacute;ez-en un !</a></p>
      ';
      ?>
    </div>
    <div class="clear"></div>
  </div>

</body>

</html>
