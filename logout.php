<?php
  include_once "objetos.php";

  $verification = new Verification("seguridad.txt");

  $verification->logOut("log");

  header("Location: index.php");
?>

