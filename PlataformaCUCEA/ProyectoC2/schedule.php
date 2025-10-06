<?php

include 'config.php';

session_start();

$student_id = $_SESSION['student_id'];

if(!isset($student_id)){
    header('location:login.php');
}

include_once 'horario.php';
$horario = new horario();
$cursos = $horario->consultacurso();
$horas = $horario->consultahoras();

// Conexion Profile
require 'conexion.php';
$_SESSION["id"] = 1; // Sesión del usuario
$sessionId = $_SESSION["id"];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_user WHERE id = $sessionId"));

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Horario</title>
    
    <!-- Font awesome CDN  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> 

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="css/estilos_user.css">
    <link rel="stylesheet" href="css/estilos_trayectoria.css">

    <!-- JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

</head>
<body>

<?php include 'user_header.php'; ?>

<!-- Inicio - Cuadro de información del alumno -->
<div class="container border border-secondary mt-4 bg-white mw-100"> 
  <table class="w-100 mt-3 mb-3">
    <tr>
      <td rowspan="4">
              <form class="form border-0" id = "form" action="" enctype="multipart/form-data" method="post">
              <div class="upload">
                <?php
                $id = $user["id"];
                $name = $user["name"];
                $image = $user["image"];
                ?>
                <img src="img/<?php echo $image; ?>" width = 125 height = 125 title="<?php echo $image; ?>">
                <div class="round">
                  <input type="hidden" name="id" value="<?php echo $id; ?>">
                  <input type="hidden" name="name" value="<?php echo $name; ?>">
                  <input type="file" name="image" id = "image" accept=".jpg, .jpeg, .png">
                  <i class = "fa fa-camera" style = "color: #fff;"></i>
                </div>
              </div>
            </form>
            <script type="text/javascript">
              document.getElementById("image").onchange = function(){
                  document.getElementById("form").submit();
              };
            </script>
            <?php
            if(isset($_FILES["image"]["name"])){
              $id = $_POST["id"];
              $name = $_POST["name"];

              $imageName = $_FILES["image"]["name"];
              $imageSize = $_FILES["image"]["size"];
              $tmpName = $_FILES["image"]["tmp_name"];

              // Validacion de las imagenes
              $validImageExtension = ['jpg', 'jpeg', 'png'];
              $imageExtension = explode('.', $imageName);
              $imageExtension = strtolower(end($imageExtension));
              if (!in_array($imageExtension, $validImageExtension)){
                echo
                "
                <script>
                  alert('Invalid Image Extension');
                  document.location.href = '../ProyectoC2';
                </script>
                ";
              }
              elseif ($imageSize > 1200000){
                echo
                "
                <script>
                  alert('Image Size Is Too Large');
                  document.location.href = '../ProyectoC2';
                </script>
                ";
              }
              else{
                date_default_timezone_set('America/Chihuahua');
                $newImageName = $name . " - " . date("Y.m.d") . " - " . date("h.i.sa"); // Generar nuevo nombre de imagen
                $newImageName .= '.' . $imageExtension;
                $query = "UPDATE tb_user SET image = '$newImageName' WHERE id = $id";
                mysqli_query($conn, $query);
                move_uploaded_file($tmpName, 'img/' . $newImageName);
                echo
                "
                <script>
                document.location.href = '../ProyectoC2';
                </script>
                ";
              }
            }
            ?>
      </td>
      <td><p><?php echo  $_SESSION['student_name']; ?></p></td>
      <td>Promedio: 92</td>
    </tr>
    <tr>
      <td><p><?php echo  $_SESSION['student_code']; ?></p></td>
      <td>Mi progreso estudiantil:</td>
    </tr>
    <tr>
      <td>
        Semestre: 2 <br>
        <br>Tecnologías de la Información
      </td>
      <td>
        <div class="progress">
          <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
        </div>
      </td>  
    </tr>
    <tr>
      <td><br>Activo</td>
      <td>Créditos: 110/440</td>
    </tr>
  </table>
</div>
<!-- Fin - Cuadro de información del alumno -->

<div class="container">
  <h1></h1>
  <div class="row">
    <div class="table-responsive">
      <table class="table table-bordered table-hover"> 
        <thead>
          <tr class="table-success">
              <th></th>
              <th>Lunes</th>
              <th>Martes</th>
              <th>Miercoles</th>
              <th>Jueves</th>
              <th>Viernes</th>
              <th>Sabado</th>
              <th>Domingo</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($horas as $hora) { ?>
              <tr class="table-light">
                  <td><?php echo $hora['inicio'] . ' - ' . $hora['fin']; ?></td>
                  <?php
                  for ($c = 1; $c <= 7; $c++) {
                      $datoscursos = $horario->consultahorarioCurso($c, $hora['idhora']);
                      if (count($datoscursos) > 0) {
                          foreach ($datoscursos as $value) {
                              ?>
                              <td id="td<?php echo $hora['idhora'] . $c; ?>" class="dropzone" idhora="<?php echo $hora['idhora']; ?>" iddia="<?php echo $c ?>" idhorario="<?php echo $value['idhorariocurso'] ?>"><a style='margin-left:4px;' href='javascript:void(0)' onclick="eliminarhorario('td<?php echo $hora['idhora'] . $c; ?>')"><i class='fa fa-trash-o'></i>              </a><?php echo $value['nombre'] ?></td>
                              <?php
                          }
                      } else {
                          ?>
                          <td id="td<?php echo $hora['idhora'] . $c; ?>" class="dropzone" idhora="<?php echo $hora['idhora']; ?>" iddia="<?php echo $c ?>" idhorario=""></td>
                          <?php
                      }
                  }
                  ?>
              </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

  <center>
      <a href="creador_horario.php"><button type="button" class="btn btn-primary">Ir a creador de horarios</button></a>
  </center>

</div>

<!-- archivo js -->
<script src="js/user_script.js"></script>

</body>
</html>

