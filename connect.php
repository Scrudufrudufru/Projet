<?php
  $login = "dave";
  $mdp = "K12deU45nH";
  $base = "projet";
  $co = mysqli_connect("localhost",$login,$mdp,$base);
  if (!$co) {
    echo("Echec de la connexion : ".mysqli_connect_error($co));
  } else echo ("Connexion reussie");
  
  function close ($co) {
    mysqli_close($co);
  }

?>