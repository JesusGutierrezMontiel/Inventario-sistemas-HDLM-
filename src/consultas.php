<?php include_once "includes/header.php"; ?>
    <h4 class="text-center">Consultas</h4>
	
	<label>Fecha </label>
		<form class="form-inline" method="POST" action="">
			<label> Desde <--</label>
			&nbsp; 
			<input type="date" class="form-control" placeholder="Start"  name="date1"/>
			&nbsp; 
			<label>Hasta --></label>
			&nbsp; 
			<input type="date" class="form-control" placeholder="End"  name="date2"/>
			&nbsp; 
			<button class="btn btn-primary" name="search"><i class="fas fa-search"></i></button>
		    &nbsp;    &nbsp; 
			<a href="consultas.php" type="button" class="btn btn-success"><i class="fas fa-retweet"></i>	</a>
		
		</form>
		<br /><br />
		<div class="table-responsive">	
			<table class="table table-striped table-bordered" id="tbl">
            <thead class="thead-dark">
					<tr>
						<th>ID</th>
						<th>Nombre Cliente</th>
						<th>Salon</th>
                        <th>Producto</th>
                        <th>Usuario Prestamo</th>
						<th>Fecha de Prestamo</th>
						<th>Estado</th>
						<th></th>

					</tr>
				</thead>
				<tbody>
					<?php include 'busquedadefecha.php'?>	
				</tbody>
			</table>
		</div>	
	
 <?php include_once "includes/footer.php"; ?>
