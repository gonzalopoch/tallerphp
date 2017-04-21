<html>
<head>
	<title>PHP</title>
		
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="style.css">
	<?php include ("menuinicio.php"); ?>
</head>
<h1> Crear nuevo usuario </h1>
<body>

	<div class="panel">

		<form>
		 <div class="form-group">
		    <label for="ejemplodeusuario">Usuario</label>
		    <input type="Usuario" class="form-control" id="exampleInputPassword1" placeholder="Usuario">
		  </div>
		  <div class="form-group">
		    <label for="ejemplodemail">Direccion de e-mail</label>
		    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
		  </div>
		  <div class="form-group">
		    <label for="ejemplodecontra">Contraseña</label>
		    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña">
		  </div>
		   <div class="form-group">
		    <label for="exampleInputPassword1"> Repita la contraseña</label>
		    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña">
		  </div>



		  <div class="form-group">
		    <label for="exampleInputFile">File input</label>
		    <input type="file" id="exampleInputFile">
		  </div>
		  <div class="checkbox">
		    <label>
		      <input type="checkbox"> Check me out
		    </label>
		  </div>
		  <button type="submit" class="btn btn-default">Submit</button>
		</form>
	</div>
</body>
</html>