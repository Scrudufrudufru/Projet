<?php
  session_start();

  $login = "dave";
  $mdp = "K12deU45nH";
  $base = "projet";
  $co = mysqli_connect("localhost",$login,$mdp,$base);
  mysqli_set_charset($co,"utf8");
  
  if (!$co) {
    echo("Echec de la connexion : ".mysqli_connect_error($co));
  }

  function close ($co) {
    mysqli_close($co);
  }

  function safeDB ($co, $var) { //Renvoie le string traité pour proteger la base de donnee
    $var = htmlentities($var);
    $var = mysqli_real_escape_string($co,$var);
    return trim($var);
  }

  function safehtml ($var) { //Renvoie le string traité pour proteger laffichage html
    $var = htmlentities($var);
    return trim($var);
  }

  function safefromDB ($var) {
    return html_entity_decode($var);
  }

?>
