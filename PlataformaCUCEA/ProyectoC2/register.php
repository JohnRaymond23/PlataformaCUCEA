<?php

include 'config.php';

if(isset($_POST['submit'])){

  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $code = mysqli_real_escape_string($conn, $_POST['code']);
  $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
  $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
  
  $user_type = $_POST['user_type'];

  $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE code = '$code' AND password = '$pass'") 
  or die('query failed');

  if(mysqli_num_rows($select_users) > 0){
      $message[] = 'user already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "INSERT INTO `users`(name, code, password, user_type) 
         VALUES('$name', '$code', '$cpass', '$user_type')") or die('query failed');
         $message[] = 'registered successfully!';
         header('location:login.php');
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registro</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> 

    <!-- Font awesome CDN  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="css/estilos.css">
   </head>

<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<div class="form-container">
   <form action="" method="post">
      <h3>Regístrate ahora</h3>
      <input type="text" name="name" placeholder="Ingresa tu nombre" required class="box">
      <input type="text" name="code" placeholder="Ingresa tu código" required class="box">
      <input type="password" name="password" placeholder="Ingresa tu contraseña" required class="box">
      <input type="password" name="cpassword" placeholder="Confirma tu contraseña" required class="box">

      <select name="user_type" class="box">
         <option value="student">Student</option>
         <!-- <option value="prof">Professor</option> -->
      </select>

      <input type="submit" name="submit" value="Regístrate" class="btn">
      <p>¿Ya tienes cuenta?&nbsp<a href="login.php">Iniciar sesión</a></p>
   </form>
</div>

</body>
</html>