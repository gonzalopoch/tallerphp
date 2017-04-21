<html>
<head>
	<title>PHP</title>
		
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="style.css">
	<?php include ("menuinicio.php"); ?>
</head>
<body>

	<div class="panel">

		<form method="POST">
		 <div class="form-group">
		    <label class="inicios" for="ejemplodeusuario">Usuario</label>
		    <input type="Usuario" class="form-control" id="exampleInputPassword1" placeholder="Nombre de usuario deseado">
		  </div>
		  <div class="form-group">
		    <label class="inicios" for="ejemplodemail">Dirección de e-mail</label>
		    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Ingrese su dirección de Email">
		  </div>
		  <div class="form-group">
		    <label class="inicios" for="ejemplodecontra">Contraseña</label>
		    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Elija una contraseña">
		  </div>
		   <div class="form-group">
		    <label class="inicios" for="exampleInputPassword1">Repita la contraseña</label>
		    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Repita la contraseña elegida">
		  </div>
		  <button type="submit" class="btn btn-danger bderecha">Registrarse</button>
		</form>
	</div>
</body>
</html>