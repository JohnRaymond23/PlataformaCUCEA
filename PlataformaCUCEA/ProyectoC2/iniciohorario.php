<!DOCTYPE html>

<?php
include_once 'horario.php';

$horario = new horario();

$cursos = $horario->consultacurso();
$horas = $horario->consultahoras();

?>

<style>

th, .table-light td {
    font-size: 14px;
}

</style>    


<html>
    <head>
        <meta charset="UTF-8">
        <title>Creador de Horarios</title>
    </head>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
        <title></title>
        <!-- Font awesome CDN  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!-- Accordion -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Buscador -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> 

        <!-- JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

        <!-- CSS -->
        <link rel="stylesheet" href="css/estilos_user.css">
    </head>
    <body>

    <?php include 'user_header.php'; ?>

        <div class="container w-100 separate">
            <h1></h1>
            <div class="row">
                <div class="col-lg-10">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="table-primary">
                                <th></th>
                                <th style="font-size:14px">Lunes</th>
                                <th style="font-size:14px">Martes</th>
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
                                                <td id="td<?php echo $hora['idhora'] . $c; ?>" class="dropzone" idhora="<?php echo $hora['idhora']; ?>" iddia="<?php echo $c ?>" idhorario="<?php echo $value['idhorariocurso'] ?>"><?php echo $value['nombre'] ?><a style='margin-left:4px;' href='javascript:void(0)' onclick="eliminarhorario('td<?php echo $hora['idhora'] . $c; ?>')"><i class='fa fa-trash-o'></i>Eliminar</a> </td>
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
                <div class="col-lg-2">
                        <!-- Inicio - Buscador Test -->
                        <div class="container">
                            <h2 class="mb-3">Buscador</h2>
                        <form method="POST">
                                <div class="input-group mb-3 w-100">
                                    <input type="text" name="Buscar" class="form-control" placeholder="Buscar" autocomplete="off">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn-outline-primary input-group-text h-100">Buscar</button>
                                    </div>
                                </div>
                        </form>

                        <?php 
                        require 'conexion.php';
                        $conexion=conexion();

                        if (!empty($_POST['Buscar'])) {
                            $Buscar=$_POST['Buscar'];
                            $sql="SELECT * FROM curso WHERE nombre LIKE '%$Buscar%'";

                        }else{
                            $sql = "SELECT * FROM curso";
                        }
                        ?>

                        <table class="table w-100">
                        <thead>
                            <th>Nombre de la materia</th>
                        </thead> 

                        <?php 
                        $query=mysqli_query($conexion,$sql);
                        if ($query) {
                            while ($data=mysqli_fetch_assoc($query)) {
                        ?>
                        <tbody>
                            <td>    
                                    <!-- Inicio - Accordion  -->
                                    <div class="container">
                                        <div class="accordion" id="accordionExample">

                                        <?php 

                                        $query=mysqli_query($conexion,$sql);
                                        $i=0;

                                        while($data=mysqli_fetch_array($query))     
                                        {
                                            if($i==0)
                                            {
                                            ?>
                                            <div class="accordion-item"> 
                                                <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    <div idcurso="<?php echo $data['idcurso'] ?>" draggable="true" ondragstart="event.dataTransfer.setData('text/plain',null)" style="width: 100%; border: none;margin-bottom: 2px;padding: 5px;border-radius:4px;"><?php echo $data['nombre']; ?></div>
                                                </button>
                                                </h2>
                                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <?php echo $data['descripcion'];?>                    
                                                </div>
                                                </div>
                                            </div>

                                            <?php } else {?>

                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="heading<?php echo $data['idcurso'];?>">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $data['idcurso'];?>" aria-expanded="false" aria-controls="collapse<?php echo $data['idcurso'];?>">
                                                    <div idcurso="<?php echo $data['idcurso'] ?>" draggable="true" ondragstart="event.dataTransfer.setData('text/plain',null)" style="width: 100%; border: none;margin-bottom: 2px;padding: 5px;border-radius:4px;"><?php echo $data['nombre']; ?></div>
                                                </button>
                                                </h2>
                                                <div id="collapse<?php echo $data['idcurso'];?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $data['idcurso'];?>" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <?php echo $data['descripcion'];?>
                                                </div>
                                                </div>
                                            </div>
                                
                                            <?php } $i++;} ?> 

                                            </div>
                                    </div>
                                    <!-- Fin - Accordion  --> 
                            </td>
                        </tbody>
            
                        <?php
                            }
                        }else{
                        ?>
                        <!-- <td colspan="4">No hay resultados</td>  -->
                        <?php
                        }
                        ?>
                        </table>
                        </div>
                        <!-- Fin - Buscador Test -->
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <a href="schedule.php" class="btn btn-primary btn-lg">Ir a mi horario</a>
            </div>
         
        </div>

        <script>
            crearmovimiento();
            function crearmovimiento() {
                var dragged;
                var copia;
                var idcurso;
                // Eventos activados sobre el objeto arrastrable 
                document.addEventListener("drag", function (event) {

                }, false);

                document.addEventListener("dragstart", function (event) {
                    // Almacenar una referencia sobre el elemento arrastrado
                    dragged = event.target;
                    // Mitad transparente
                    event.target.style.opacity = .5;

                    idcurso = event.target.getAttribute("idcurso");

                    copia = "<div>" + dragged.innerHTML + "<a style='margin-left:4px;' href='javascript:void(0)'><i class='fa fa-trash-o'></i>Eliminar</a>" + "</div>";

                    event.dataTransfer.setData('Text', copia);

                }, false);

                document.addEventListener("dragend", function (event) {
                    // Reiniciar transparencia
                    event.target.style.opacity = "";
                }, false);

                // Eventos ejecutados al momento de soltar los elementos 
                document.addEventListener("dragover", function (event) {
                    // Prevenir el valor predeterminado para permitir soltar los elementos
                    event.preventDefault();
                }, false);

                document.addEventListener("dragenter", function (event) {
                    // Resaltar el objetivo de colocacion potencial cuando el elemento arrastrable ingrese en el
                    if (event.target.className == "dropzone") {
                        event.target.style.background = "#EAF0E7";
                    }

                }, false);

                document.addEventListener("dragleave", function (event) {
                    // Reestablecer el fondo del objetivo de colocacion potencial cuando el elemento arrastrable lo deja
                    if (event.target.className == "dropzone") {
                        event.target.style.background = "";
                    }

                }, false);

                document.addEventListener("drop", function (event) {
                    // Evitar accion por default (abrir algunos elementos como enlaces/links)
                    event.preventDefault();
                    // Mover el elemento arrastrado al espacio seleccionado o elegido para colocar dicho elemento
                    if (event.target.className == "dropzone") {
                        event.target.style.background = "";

                        event.target.innerHTML = event.dataTransfer.getData("Text");
                        var hora = event.target.getAttribute("idhora");
                        var dia = event.target.getAttribute("iddia");
                        var idtd = event.target.getAttribute("id");
                        var idhorario = event.target.getAttribute("idhorario");
                        var curso = idcurso;

                        $("#" + idtd + " > div > a").click(function () {
                            eliminarhorario(idtd);
                        });

                        guardarhorario(hora, dia, curso, idtd);


                        event.target.style.height = "auto";

                    }

                }, true);
            }
            function guardarhorario(hora, dia, curso, idtd) {
                var data = {hora: hora, dia: dia, curso: curso};
                var url = "guardar.php";
                $.ajax({
                    type: "POST",
                    url: url,
                    data: data,
                    success: function (r) {
                        var d = JSON.parse(r);
                        $('#' + idtd).attr('idhorario', d['id']);
                        swal({
                            title: '',
                            text: d['msj'],
                            icon: d['icon']
                        });
                    }
                });
            }
            function eliminarhorario(idtd) {
                var data = {horario: $('#' + idtd).attr('idhorario')};
                var url = "eliminar.php";
                $.ajax({
                    type: "POST",
                    url: url,
                    data: data,
                    success: function (r) {
                        var d = JSON.parse(r);
                        $("#" + idtd).empty();
                        $("#" + idtd).css("height", "50px");
                        swal({
                            title: '',
                            text: d['msj'],
                            icon: d['icon']
                        });
                    }
                });
            }
        </script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </body>
</html>
