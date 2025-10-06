<?php

include 'config.php';
session_start();
$student_id = $_SESSION['student_id'];

if(!isset($student_id)){
    header('location:login.php');
}

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

    <title>Trayectoria</title>
    
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
  </head>

<body>

<?php include 'user_header.php'; ?>




<!-- 
<header class="encabezado-body">
  <h1>Trayectoria Académica<br/><span>Tecnologías de la Información</span></h1>
  <link rel="stylesheet" href="css/dragula.min.css">
</header>

<script src='https://cdnjs.cloudflare.com/ajax/libs/dragula/$VERSION/dragula.min.js'></script>

<div class="add-task-container">
  <input type="text" maxlength="12" id="taskText" placeholder="New Task..." onkeydown="if (event.keyCode == 13)
                        document.getElementById('add').click()">
  <button id="add" class="button add-button" onclick="addTask()">Add New Task</button>
</div>
 -->

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


<div class="main-container position">
  <ul class="columns">
    <li class="column primero-column">
      <div class="column-header">
        <h4>2020-A</h4>
      </div>
      <ul class="task-list" id="primero">
        <li class="task">
          <p><a href="#modal1">Matemáticas I</a></p>
          <div id="modal1">
            <button class="btn btn-primary"><a href="#">Cerrar</a></button>
            Información de la materia
            <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br>Matemáticas I</td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:<br>Métodos Cuantitativos</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:<br>Básica Común Obligatoria</td>
                    </tr>
                    <tr>
                      <td>Clave: I0868</td>
                      <td>Créditos: 8</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario: Sí</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos: N/A</td>
                    </tr>
                  </tbody>
                </table>
            </div>
          </div>
        </li>
        <li class="task">
          <p><a href="#modal2">Tecnologías de la Información</a></p>
          <div id="modal2"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
        </li>
        <li class="task">
          <p><a href="#modal3">Contabilidad General</a></p>
          <div id="modal3"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br>Contabilidad General</td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:<br>Contabilidad</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:<br>Básica Común Obligatoria</td>
                    </tr>
                    <tr>
                      <td>Clave: I5086</td>
                      <td>Créditos: 8</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario: Sí</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos: N/A</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
        </li>
        <li class="task">
          <p><a href="#modal4">Economía I</a></p>
          <div id="modal4"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
        </li>
        <li class="task">
          <p><a href="#modal5">Administración I</a></p>
          <div id="modal5"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
        </li>
        <li class="task">
          <p><a href="#modal6">Universidad y Siglo XXI</a></p>
          <div id="modal6"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
        </li>
        <li class="task">
          <p><a href="#modal7">Inglés I</a></p>
          <div id="modal7"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
        </li>
      </ul>
    </li>

    <li class="column segundo-column">
      <div class="column-header">
        <h4>2020-B</h4>
      </div>
      <ul class="task-list" id="segundo">
        <li class="task">
          <p><a href="#modal8">Matemáticas Discretas</a></p>
          <div id="modal8"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
        </li>
        <li class="task">
          <p><a href="#modal9">Plataformas Operativas</a></p>
          <div id="modal9"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
        </li>
        <li class="task">
          <p><a href="#modal10">Fundamentos de Programación</a></p>
          <div id="modal10"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
        </li>
        <li class="task">
          <p><a href="#modal11">Conceptos Jurídicos Fundamentales</a></p>
          <div id="modal11"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
        </li>
        <li class="task">
          <p><a href="#modal12">Desarrollo e Innovación Tecnológica</a></p>
          <div id="modal12"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
        </li>
        <li class="task">
          <p><a href="#modal13">Expresión Oral y Escrita</a></p>
          <div id="modal13"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>  
        </div>
        </li>
        <li class="task">
          <p><a href="#modal14">Inglés II</a></p>
          <div id="modal14"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
        </li>
      </ul>
    </li>

    <li class="column tercero-column">
      <div class="column-header">
        <h4>2021-A</h4>
      </div>
      <ul class="task-list" id="tercero">
        <li class="task">
          <p><a href="#modal15">Estadística I</a></p>
          <div id="modal15"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
        </li>
        <li class="task">
          <p><a href="#modal16">Análisis y Diseño de Sistemas de Información</a></p>
          <div id="modal16"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
        </li>
        <li class="task">
          <p><a href="#modal17">Estructura de Datos</a></p>
          <div id="modal17"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
        </li>
        <li class="task">
          <p><a href="#modal18">Sistemas de Bases de Datos I</a></p>
          <div id="modal18"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
        </li>
        <li class="task">
          <p><a href="#modal19">Arquitectura de Computadoras</a></p>
          <div id="modal19"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
        </li>
        <li class="task">
          <p><a href="#modal20">Ética Profesional</a></p>
          <div id="modal20"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
        </li>
        <li class="task">
          <p><a href="#modal21">Inglés III</a></p>
          <div id="modal21"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
        </li>
      </ul>
    </li>

    <li class="column cuarto-column">
      <div class="column-header">
        <h4>2021-B</h4>
      </div>
      <ul class="task-list" id="cuarto">
        <li class="task">
          <p><a href="#modal22">Estadística II</a></p>
          <div id="modal22"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
        </li>
        <li class="task">
          <p><a href="#modal23">Gestión de Servicios y Procesos de TI I</a></p>
          <div id="modal23"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
        </li>
        <li class="task">
          <p><a href="#modal24">Fundamentos de Redes</a></p>
          <div id="modal24"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
        </li>
        <li class="task">
          <p><a href="#modal25">Sistemas de Bases de Datos II</a></p>
          <div id="modal25"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
        </li>
        <li class="task">
          <p><a href="#modal26">Marco Jurídico en Materia de Informática</a></p>
          <div id="modal26"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
        </li>
        <li class="task">
          <p><a href="#modal27">Diseño Organizacional</a></p>
          <div id="modal27"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>          
        </li>
        <li class="task">
          <p><a href="#modal28">Inglés IV</a></p>
          <div id="modal28"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>          
        </li>
      </ul>
    </li>

    <li class="column quinto-column">
      <div class="column-header">
        <h4>2022-A</h4>
      </div>
      <ul class="task-list" id="quinto">
        <li class="task">
          <p><a href="#modal29">Investigación de Operaciones</a></p>
          <div id="modal29"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>          
        </li>
        <li class="task">
          <p><a href="#modal30">Gestión de Servicios y Procesos de TI II</a></p>
          <div id="modal30"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>          
        </li>
        <li class="task">
          <p><a href="#modal31">Ingeniería de Software</a></p>
          <div id="modal31"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>          
        </li>
        <li class="task">
          <p><a href="#modal32">Programación Orientada a Objetos</a></p>
          <div id="modal32"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>          
        </li>
        <li class="task">
          <p><a href="#modal33">Software Especializado</a></p>
          <div id="modal33"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>          
        </li>
        <li class="task">
          <p><a href="#modal34">Sistemas de Información Empresarial</a></p>
          <div id="modal34"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>          
        </li>
        <li class="task">
          <p><a href="#modal35">Administración Financiera</a></p>
          <div id="modal35"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br>Administración Financiera</td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:<br>Finanzas</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:<br>Básica Particular Obligatoria</td>
                    </tr>
                    <tr>
                      <td>Clave: I5099</td>
                      <td>Créditos: 8</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario: Sí</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos: N/A</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>          
        </li>
      </ul>
    </li>

    <li class="column sexto-column">
      <div class="column-header">
        <h4>2022-B</h4>
      </div>
      <ul class="task-list" id="sexto">
        <li class="task">
          <p><a href="#modal36">Administración de Proyectos de TI</a></p>
          <div id="modal36"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>          
        </li>
        <li class="task">
          <p><a href="#modal37">Especializante Selectiva I</a></p>
          <div id="modal37"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>          
        </li>
        <li class="task">
          <p><a href="#modal38">Seguridad en TI</a></p>
          <div id="modal38"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>          
        </li>
        <li class="task">
          <p><a href="#modal39">Programación Web</a></p>
          <div id="modal39"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>          
        </li>
        <li class="task">
          <p><a href="#modal40">Administración Estratégica</a></p>
          <div id="modal40"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>          
        </li>
        <li class="task">
          <p><a href="#modal41">Inteligencia de Negocios</a></p>
          <div id="modal41"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>          
        </li>
      </ul>
    </li>

    <li class="column septimo-column">
      <div class="column-header">
        <h4>2023-A</h4>
      </div>
      <ul class="task-list" id="septimo">
      <li class="task">
          <p><a href="#modal42">Auditoría de Sistemas</a></p>
          <div id="modal42"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>          
        </li>
        <li class="task">
          <p><a href="#modal43">Especializante Selectiva II</a></p>
          <div id="modal43"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>          
        </li>
        <li class="task">
          <p><a href="#modal44">Optativa Abierta I</a></p>
          <div id="modal44"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>          
        </li>
        <li class="task">
          <p><a href="#modal45">Prácticas Profesionales</a></p>
          <div id="modal45"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>          
        </li>
        <li class="task">
          <p><a href="#modal46">Liderazgo y Habilidades Directivas</a></p>
          <div id="modal46"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>          
        </li>
        <li class="task">
          <p><a href="#modal47">Metodología y Práctica de la Investigación</a></p>
          <div id="modal47"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>          
        </li>
      </ul>
    </li>

    <li class="column octavo-column">
      <div class="column-header">
        <h4>2023-B</h4>
      </div>
      <ul class="task-list" id="octavo">
        <li class="task">
          <p><a href="#modal48">Optativa Abierta II</a></p>
          <div id="modal48"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
        </li>
        <li class="task">
          <p><a href="#modal49">Especializante Selectiva III</a></p>
          <div id="modal49"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
        </li>
        <li class="task">
          <p><a href="#modal50">Optativa Abierta III</a></p>
          <div id="modal50"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
        </li>
        <li class="task">
          <p><a href="#modal51">Desarrollo Multimedia</a></p>
          <div id="modal51"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
        </li>
        <li class="task">
          <p><a href="#modal52">Desarrollo de Emprendedores</a></p>
          <div id="modal52"><button class="btn btn-primary"><a href="#">Cerrar</a></button>
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
        </li>
        <li class="task">
          <p><a href="#modal53">Seminario de Titulación</a></p>
          <div id="modal53"><button class="btn btn-primary"><a href="#">Cerrar</a></button> 
          Información de la materia
          <div class="border border-secondary container-sm mt-4">
                <table class="table">
                  <tbody>
                    <tr>
                      <td colspan="2">Materia:<br></td>
                    </tr>
                    <tr>
                      <td colspan="2">Departamento:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Área de formación:</td>
                    </tr>
                    <tr>
                      <td>Clave:</td>
                      <td>Créditos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Extraordinario:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Prerrequsitos:</td>
                    </tr>
                    <tr>
                      <td colspan="2">Centros Universitarios:</td>
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
        </li>
      </ul>
    </li>
  <!-- <li class="column trash-column">
      <div class="column-header">
        <h4>Trash</h4>
      </div>
      <ul class="task-list" id="trash">
        <li class="task">
          <p>Interviews</p>
        </li>
        <li class="task">
          <p>Research</p>
        </li>

      </ul>
      <div class="column-button">
        <button class="button delete-button" onclick="emptyTrash()">Delete</button>
      </div>
    </li> -->
  </ul>
</div>

<!-- 
<footer>
  <p>Built with <a href="https://github.com/bevacqua/dragula" target="_blank">Dragula</a> and Vanilla JS by <a href="http://nikkipantony.com" target="_blank">Nikki Pantony</a></p>
</footer> -->

<script src="js/dragula.min.js">
<script src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-2c7831bb44f98c1391d6a4ffda0e1fd302503391ca806e7fcc7b9b87197aec26.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/dragula/$VERSION/dragula.min.js'></script>
<script id="rendered-js">

// Custom Dragula JS 

dragula([
  document.getElementById("primero"),
  document.getElementById("segundo"),
  document.getElementById("tercero"),
  document.getElementById("cuarto"),
  document.getElementById("quinto"),
  document.getElementById("sexto"),
  document.getElementById("septimo"),
  document.getElementById("octavo"),
  document.getElementById("trash")
]);
removeOnSpill: false
  .on("drag", function(el) {
    el.className.replace("ex-moved", "");
  })
  .on("drop", function(el) {
    el.className += "ex-moved";
  })
  .on("over", function(el, container) {
    container.className += "ex-over";
  })
  .on("out", function(el, container) {
    container.className.replace("ex-over", "");
  });


// Vanilla JS para agregar una nueva tarea/task 

function addTask() {
  // Obtener el texto de la tarea del input/entrada 
  var inputTask = document.getElementById("taskText").value;
  // Agregar tarea a la columna "To Do" 
  document.getElementById("primero").innerHTML +=
    "<li class='task'><p>" + inputTask + "</p></li>";
  // Quitar el texto de la tarea del input/entrada después de añadir otro task 
  document.getElementById("taskText").value = "";
}

// Vanilla JS para eliminar tasks en la columna 'Trash' 

function emptyTrash() {
  // Borrar tasks de la columna 'Trash' 
  document.getElementById("trash").innerHTML = "";
}
</script>

<!-- Archivo JS -->
<script src="js/user_script.js"></script>

</body>
</html>
