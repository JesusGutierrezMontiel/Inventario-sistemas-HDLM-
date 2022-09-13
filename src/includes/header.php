<?php 
session_start();
if (empty($_SESSION['active'])) {
    header('location: ../');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Panel de Administración</title>
    
    <link href="../assets/css/stYLE.css" rel="stylesheet" />
    <link href="../assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link rel="stylesheet" href="../assets/js/jquery-ui/jquery-ui.min.css">
    <script src="../assets/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
       <center> <a class="navbar-brand" href="index.php">HDLM   </a> </center>
        
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <h4>     <?php echo $_SESSION['nombre'];?> <?php echo $_SESSION['apellidoP'];?> <?php echo $_SESSION['apellidoM'];?> </h4>
       
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">

    

<br>
<div  class="wrapper" >
    <a class="button" href="prestamo.php" color=green>
<i class="fas fa-regular fa-address-card"></i>&nbsp
Prestamo</a>
</div>

<div class="wrapper">
<a class="button"  href="clientes.php">
<i class="fas fa-solid fa-users"></i>&nbsp
Clientes</a>
</div>


<div class="wrapper">
<a class="button" href="usuarios.php">
<i class="fas fa-solid fa-user-tie"></i>&nbsp
    Usuarios</a>
</div>   

<div class="wrapper">
<a class="button"href="productos.php">
<i class="fas fa-solid fa-parking"></i>&nbsp
Productos</a>
</div>

<div class="wrapper">
<a class="button" href="proveedor.php">
<i class="fas fa-key"></i>&nbsp
    Proveedor</a>
</div>

<div class="wrapper">
<a class="button" href="consultas.php">
<i class="fas fa-address-book"></i>&nbsp
    Consultas</a>
</div>

<div class="wrapper">
<a class="button" href="salir.php">
<i class="fas fa-solid fa-power-off"></i>&nbsp
    Cerrar sesion</a>
</div>
<!-- Filter: https://css-tricks.com/gooey-effect/ -->
<svg style="visibility: hidden; position: absolute;" width="0" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1">
    <defs>
        <filter id="goo"><feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />    
            <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo" />
            <feComposite in="SourceGraphic" in2="goo" operator="atop"/>
        </filter>
    </defs>
</svg>


                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid mt-2">