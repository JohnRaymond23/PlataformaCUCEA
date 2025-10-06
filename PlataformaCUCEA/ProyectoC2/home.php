<?php

include 'config.php';

session_start();

$student_id = $_SESSION['student_id'];

if(!isset($student_id)){
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- User Panel -->
    <title>Inicio</title>
    
    <!-- Font awesome CDN  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> 

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="css/estilos_user.css">

</head>
<body>

<?php include 'user_header.php'; ?>


<!-- Carrusel -->
<div class="container">
  <br>  
  <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="img/banner-bienvenido.jpg" class="d-block w-100" alt="Bienvenido">
      </div>
      <div class="carousel-item">
        <img src="img/banner-evento.jpg" class="d-block w-100" alt="Evento">
      </div>
      <div class="carousel-item">
        <img src="img/banner-concierto.jpg" class="d-block w-100" alt="Concierto">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</div>
<!-- Fin Carrusel -->
<br>
<div class="container">
  <h2>Opciones del alumno</h2><br>
  <div  class="d-flex justify-content-between">
    <a href="schedule.php"><button type="button" class="btn btn-primary btn-lg" style="font-size: 26px">Horario</button></a>
    <a href="trayectoria.php"><button type="button" class="btn btn-primary btn-lg" style="font-size: 26px">Trayectoria</button></a>
    <a href="#"><button type="button" class="btn btn-primary btn-lg" style="font-size: 26px">Boleta</button></a>
    <a href="#"><button type="button" class="btn btn-primary btn-lg" style="font-size: 26px">Kárdex</button></a>
    <a href="#"><button type="button" class="btn btn-primary btn-lg" style="font-size: 26px">Encuestas</button></a>
    <a href="#"><button type="button" class="btn btn-primary btn-lg" style="font-size: 26px">Preregistro</button></a>
  </div>
  

</div>

<!-- archivo js -->
<script src="js/user_script.js"></script>

</body>
</html>