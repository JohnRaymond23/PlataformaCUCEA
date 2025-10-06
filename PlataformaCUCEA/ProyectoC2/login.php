<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

  $code = mysqli_real_escape_string($conn, $_POST['code']);
  $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

  $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE code = '$code' AND password = '$pass'") 
  or die('query failed');

  if(mysqli_num_rows($select_users) > 0){

    $row = mysqli_fetch_assoc($select_users);

    if($row['user_type'] == 'student') {
        $_SESSION['student_name'] = $row['name'];
        $_SESSION['student_code'] = $row['code'];
        $_SESSION['student_id'] = $row['id'];
        header('location:home.php');
    }
    
 /* elseif($row['user_type'] == 'prof'){
        $_SESSION['prof_name'] = $row['name'];
        $_SESSION['prof_code'] = $row['code'];
        $_SESSION['prof_id'] = $row['id'];
        header('location:prof_page.php');
    } 
 */

   }else{
      $message[] = 'Codigo o contrasena incorrecta!'; 
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

    <title>Login</title>

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

      <div><img src="img/logo-cucea.png" alt="CUCEA" width="400"></div>
      <p></p>

      <h3>CUCEA SMART DP</h3>
      <input type="text" name="code" placeholder="Ingresa tu código" required class="box">
      <input type="password" name="password" placeholder="Ingresa tu contraseña" required class="box">
      
      <div class="textlog"> Recuperar NIP </div>

      <div class="d-grid mb-2">
      <input type="submit" name="submit" value="Iniciar sesión" class="btn">
      </div>

      <div class="textlog"> o <div>

      <div class="d-grid mb-2">
      <a class="botong" href="/users/googleauth" role="button" style="text-transform:none">
      <img width="20px" style="margin-bottom:3px; margin-right:5px" alt="Google sign-in" src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />
      Iniciar sesión con Google</a> </div>
      
      <p>¿No tienes cuenta?&nbsp<a href="register.php">Crear cuenta</a></p>
   </form>
</div> 

</body>
</html>

