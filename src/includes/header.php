<?php 
session_start();
if (empty($_SESSION['active'])) {
    header('location: ../');
}

class Conectar {
	protected $dbh;
		protected function Conexion(){
			try {
				$conectar = $this->dbh = new PDO("mysql:local=localhost;dbname=sis_inventario","root","JGM.122300");
				
				return $conectar;	
			} catch (Exception $e) {
				print "¡Error BD!: " . $e->getMessage() . "<br/>";
				die();	
			}
		}
	}

class Menu extends Conectar {
public function get_menu(){
    $conectar= parent::conexion();
    $sql="SELECT * FROM cat_menu WHERE estatus=1 order by id_orden";
    $sql=$conectar->prepare($sql);
    $sql->execute();
    return $resultado=$sql->fetchAll();
}
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
    
    <link href="../assets/css/STYlES.css" rel="stylesheet" />
    <link href="../assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link rel="stylesheet" href="../assets/js/jquery-ui/jquery-ui.min.css">
    <script src="../assets/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
       <center> <a class="navbar-brand" href="index.php">HDLM   </a> </center>
        
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <h4>     <?php echo $_SESSION['nombre'];?> <?php echo $_SESSION['apellidoP'];?> <?php echo $_SESSION['apellidoM'];?> </h4>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#nuevo_pass">Perfil</a>
                    <div class="dropdown-divider"></div>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">

                    <?php
    
    $menu = new Menu();
    $menx = $menu ->get_menu();
?>
                    <?php
            for($i=0; $i<sizeof($menx);$i++){
        ?>
  <!-- creacion y diseño del menu dinamico, direccionado a STYLES-->
<br>
 
        
                <a class="btm btn-menu" href="<?php echo $menx[$i]["men_ruta"]?>">
                <i class="<?php echo $menx[$i]["men_icon"]?>"></i>
                <span ><?php echo $menx[$i]["descripcion"]?></span></a>
            </span>
            
        <?php
            }
        ?>

                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid mt-2">