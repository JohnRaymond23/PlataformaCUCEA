<header class="header">
<div class="flex">
    <a href="home.php"><img src="img/logo-cucea.png" alt="CUCEA" width="230"></a>

    <nav class="navbar">
        <a href="home.php">Inicio</a>
        <a href="schedule.php">Horario</a>
        <a href="trayectoria.php#">Mi trayectoria</a>
        <a href="#">Trámites</a>
        <a href="#">Pagos</a>
        <a href="#">Servicios</a>
        <a href="#">Eventos</a>
    </nav>

    <form>
        <button type="submit">Search</button>
        <input type="search" placeholder="Buscar">
    </form>

    <div class="icons">
        <div id="menu-btn" class="fas fa-bars"></div>
        <div class="fa-regular fa-circle-question"></div>
        <div class="fa-regular fa-bell"></div>
        <div id="user-btn" class="fa-regular fa-user"></div>
    </div>

    <div class="account-box">
        <p>Nombre : <span><?php echo  $_SESSION['student_name']; ?></span></p>
        <p>Código : <span><?php echo  $_SESSION['student_code']; ?></span></p>
        <a href="logout.php" class="delete-btn text-decoration-none">Salir</a>
    </div>

</div>
</header>