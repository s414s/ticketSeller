<?php
      include_once "objetos.php";

      $verification = new Verification("seguridad.txt");

      if ($verification->isLogged(@$_COOKIE["log"])) {
        Redirect::goToPage("gestion.php");
      }

      if( isset($_POST["user"]) && isset($_POST["password"]) ){

        if( empty($_POST["user"]) || empty($_POST["password"]) ){
          echo "<div class='alert alert-warning text-center mt-5 mx-auto w-25 alert-dismissable p-0'>
          Rellena todos los campos
          <button class='btn btn-close' data-bs-dismiss='alert'></button>
          </div>";
        }else{

          if($verification->pwdCorrect($_POST["user"], $_POST["password"])){
            $verification->createCookie(1);
            $verification->updateLog();
            header("Location: gestion.php", TRUE, 301);
          }else{
            echo "<div class='alert alert-danger text-center mt-5 mx-auto w-25 alert-dismissable p-0'>
            El usuario o contraseña no son correctos
            <button class='btn btn-close' data-bs-dismiss='alert'></button>
            </div>";
          }
        }
      }
    ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  <link href="css/login.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <title>Basílica del Pilar</title>
</head>
<body>
    
  <section class="container login-form">

    <h2 class="text-center">BASÍLICA DEL PILAR</h2>
    <h2 class="text-center">LOGIN EMPLEADO</h2>
      
    <form method="POST" class="p-5 w-50 mx-auto login-form-container" action="">
      <label>Usuario:</label>
      <input type="text" name="user" class="form-control">
      <label class="mt-4">Contraseña:</label>
      <input type="password" name="password" class="form-control">
      <button type="submit" class="btn btn-info form-control">Enviar</button>
    </form>


  </section>
</body>