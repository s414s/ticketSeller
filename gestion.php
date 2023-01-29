<?php
  include_once "objetos.php";

  $verification = new Verification("seguridad.txt");

  if ($verification->isLogged(@$_COOKIE["log"]) === false) {
    Redirect::goToPage("index.php");
  } else {
    $nameEmployee = $verification->getUserName(@$_COOKIE["log"]);
  }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href = "css/gestion.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <title>Datos personales</title>
</head>
<body>
  
  <div class="d-flex justify-content-between mx-3 mt-3">
    <p><?php echo "Empleado: ".strtoupper($nameEmployee); ?></p>
    <a href="logout.php"><button class="btn btn-outline-danger me-2" type="button">Log Out</button></a>
  </div>

  <section class="container">

    <form method="POST" class="data-form rounded p-5 w-50 mx-auto" action="entrada.php">
      <h2 class="text-center">Datos Cliente</h2>
      <label class="mt-2">Nombre</label>
      <input type="text" name="name" class="form-control" maxlength="15">

      <label class="mt-2">Apellidos</label>
      <input type="text" name="surname" class="form-control" maxlength="20">

      <label class="mt-2">DNI</label>
      <input type="text" name="dni" class="form-control" maxlength="9">
      
      <label class="mt-2">Edad</label>
      <input type="number" name="age" class="form-control" maxlength="2">

      <label class="mt-2">País de residencia</label>
      <select name="country" class="form-control">
        <option value="españa">España</option>
        <option value="francia">Francia</option>
        <option value="alemania">Alemania</option>
        <option value="rusia">Rusia</option>
      </select>

      <p class="mt-2 mb-0">Sexo</p>
      <input type="radio" name="sex" value="hombre">
      <label for="html">Hombre</label>
      <input type="radio" name="sex" value="mujer">
      <label for="css">Mujer</label><br>

      <label class="mt-2">Discapacidad</label>
      <select name="disability" class="form-control">
        <option value="ninguna">Ninguna</option>
        <option value="visual">Visual</option>
        <option value="auditiva">Auditiva</option>
      </select>

      <button type="submit" class="btn btn-info form-control">Enviar</button>

    </form>
  </section>
</body>