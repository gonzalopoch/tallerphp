
<nav class="navbar navbar-inverse">
		  <div class="container-fluid">
		    <div class="navbar-header" align="center">
		    	<h1 class="titulop">PHP</h1>
		    </div>
		    <div>
		      	<a href="index.php" class="btn btn-danger navbar-btn">Inicio</a>
		    	<?php 
		    	session_start();  
				if ((isset($_SESSION['tipoUsuario'])) && ($_SESSION['tipoUsuario'] == 'admin')){
		    		echo '<a href="pelismod.php" class="btn btn-danger navbar-btn">Administrar</a>';
		    	}
		    	if ((isset($_SESSION['usuario'])) && (!empty($_SESSION['usuario']))){
		    		echo '<a href="cerrarsesion.php" class="btn btn-danger navbar-btn">Cerrar sesion</a>';
		    	}
		    	else{
		    			echo '<a href="registro.php" class="btn btn-danger navbar-btn">Registrarse</a>';
		    		echo '<a href="iniciarsesion.php" class="btn btn-danger navbar-btn">Iniciar sesion</a>';
		    	}
		    	?>
		    </div>
		  </div>
	</nav>