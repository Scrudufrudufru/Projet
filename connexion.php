<?php
session_start();
include 'projet/connect.php';
function login($co) {
  $req = 'select nickname, password from users where nickname=\''.$_POST['nickname'].'\'';
  $res = mysqli_query($co, $req);
  $x;
  if ($res) {
    while ($ligne = mysqli_fetch_assoc($res)) {
      $x = $ligne['password'];
    }
  }
  if (password_verify($_POST['password'], $x)) {
    $_SESSION['nickname'] = htmlspecialchars($_POST['nickname']);
    header('Location: index.php?page=compte');
    exit();
  } else {
    $err = 'Mot de passe incorrect<br>';
  }
}

if (isset($_POST['nickname'], $_POST['password'])) {
  login(connect());
  header('Location: ' . $_SERVER['REQUEST_URI']);
  exit();
}

?>
<!DOCTYPE html>

<html>

<head>

  <meta charset="utf-8">
  <title>Connexion&nbsp;-&nbsp;Benalia.fr</title>
  <link rel="stylesheet" href="Style/global_style.css">

</head>

<body>

  <?php

  include 'projet/main.php';

  ?>

  <div id='content'>
    <div id='maincontent'>
      <h2>Connexion</h2>
      <?php
      if (isset($_SESSION['nickname'])) echo '<p>Vous &ecirc;tes connect&eacute; !<br><a href=main.php>Retour &agrave; l\'accueil</a></p>';
      else echo '
      <form action="main.php?page=connexion" method="post">
      Identifiant<br>
      <input type="text" name="nickname"><br>
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
