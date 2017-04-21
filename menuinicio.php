
<nav class="navbar navbar-inverse">
		  <div class="container-fluid">
		    <div class="navbar-header" align="center">
		    	<h1 class="titulop">PHP</h1>
		    </div>
		    <div>
		    	<a href="index.php" class="btn btn-danger navbar-btn">Inicio</a>
		    	<a href="registro.php" class="btn btn-danger navbar-btn">Registrarse</a>
		    	<a href="iniciarsesion.php" class="btn btn-danger navbar-btn">Iniciar sesion</a>
		    	<?php if($_SERVER["REQUEST_URI"] == "/tallerphp/index.php") { ?>
		    		<button type="button" class="btn btn-danger navbar-btn">Ordenar</button>
		    	<?php } ?>
		    </div>
		  </div>
	</nav>