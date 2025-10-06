<?php

    function conexion() {

        $host='localhost';
        $user='root';
        $pass='';
        $db='horario';

        $conexion=mysqli_connect($host,$user,$pass,$db);

        return $conexion;

    }

    // Conexión Profile
    $conn = mysqli_connect("localhost", "root", "", "profile");
    // Conexión Profile

?>
