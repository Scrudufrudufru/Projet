<?php
  session_start();

  $login = "dave";
  $mdp = "K12deU45nH";
  $base = "projet";
  $co = mysqli_connect("localhost",$login,$mdp,$base);
  if (!$co) {
    echo("Echec de la connexion : ".mysqli_connect_error($co));
  }

  function close ($co) {
    mysqli_close($co);
  }

  function safeDB ($co, $var) { //Renvoie le string traité pour proteger la base de donnee
    $var = htmlspecialchars($var);
    $var = mysqli_real_escape_string($co,$var);
    return trim($var);
  }

  function safehtml ($var) { //Renvoie le string traité pour proteger laffichage html
    $var = htmlspecialchars($var);
    return trim($var);
  }

  function safefromDB ($var) {
    return htmlspecialchars_decode($var);
  }

?>
