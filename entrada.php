<?php

  include_once "objetos.php";

  $verification = new Verification("seguridad.txt");
  $ticket = new Ticket($_POST);

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
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;900&display=swap" rel="stylesheet">
  <link href="css/ticket.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <title>Ticket de entrada</title>
</head>
<body>

  <div class="d-flex justify-content-between m-3">
    <p><?php echo "Empleado: ".strtoupper($nameEmployee); ?></p>
    <a href="logout.php"><button class="btn btn-outline-danger me-2" type="button">Log Out</button></a>
  </div>

  <section class="container">
    <h2 class="text-center mt-3">Ticket</h2>

    <?php

      if(!$ticket->isDataMissing() && $ticket->checkDni()){
        
        $ticket->saveJson("ticket-sold/", $nameEmployee);
        $information = $ticket->getInformation();

        include "scripts/entrance-template.php";

      }else{
        echo "<p class='text-center bg-warning form-control mt-5 mx-auto w-50 p-3'>
        Datos erroneos en el formulario, vuelva a intentarlo
        </p>";
        header("Refresh:2; url=gestion.php");
        exit();
      }
    ?>
  </section>
</body>