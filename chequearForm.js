function valida(f) {
  var ok = true;
  var msg = "";
  var msg1 = "";
  var validaPass = "";
  var vacios = true;
  var validaNombre = "";
  var validaApellido = "";
  var validaNU = "";
  var validaFP = "";
  var validaLP = "";
  var letras = /^[A-Za-z]+$/;
  var alfanum = /^[a-zA-Z0-9]+$/;
  var passV = /^(?=.*[0-9!@#\$%\^\&*\)\(+=._-])(?=.*[a-z])(?=.*[A-Z])([a-zA-Z0-9!@#\$%\^\&*\)\(+=._-])+$/;

  if(f.nombre.value == "")
  {
    msg += "Campo 'Nombre'. ";
    vacios = false;
  }

  if(f.apellido.value == "")
  {
    msg += "Campo 'Apellido'. ";
    vacios = false;
  }

  if(f.nomUsuario.value == "")
  {
    msg += "Campo 'Usuario'. ";
    vacios = false;
  }

  if(f.email.value == "")
  {
    msg += "Campo 'E-mail'. ";
    vacios = false;
  }

  if(f.pass.value == "")
  {
    msg += "Campo 'Contraseña'. ";
  	vacios = false;
  }

  if(f.passRepe.value == "")
  {
    msg += "Campo 'Repetir contraseña'. ";
    vacios = false;
  }

  if (vacios == false){
  	msg1 = "Debes completar los siguientes campos: ";
  	ok = false;
  }

  if(!f.pass.value.match(passV)){
  	validaFP = "La contraseña debe contener al menos un número o símbolo y letras mayúsculas y minúsculas."
  	ok = false;
  }

  if((f.passRepe.value!="") && (f.pass.value!="") && (f.pass.value != f.passRepe.value)){
  	validaPass = "Las contraseñas ingresadas deben ser iguales. ";
  	ok = false;
  }

  if(f.pass.value.length < 6){
  	validaLP = "La contraseña debe tener 6 o más caracteres. ";
  	ok = false;
  }

  if ((!f.nombre.value.match(letras)) && (f.nombre.value != "")){
  	validaNombre = "El nombre debe contener sólamente caracteres alfabéticos. ";
  	ok = false;
  }

  if ((!f.apellido.value.match(letras)) && (f.apellido.value != "")){
  	validaApellido = "El apellido debe contener sólamente caracteres alfabéticos. ";
  	ok = false;
  }

  if(f.nomUsuario.value.length < 6){
  	validaNU = "El nombre de usuario debe contener 6 o más caracteres. ";
  	ok = false;
  }

  if(!f.nomUsuario.value.match(alfanum)){
  	validaNU = "El nombre de usuario debe contener caracteres alfanuméricos. ";
  	ok = false;
  }

  if(ok == false)
    //alert(msg);
	var mensajeError = document.getElementById('insertHere');
	mensajeError.innerHTML ='<div class="alert alert-danger">' + msg1 + msg + validaPass + validaNombre + validaApellido + validaNU + validaLP + validaFP + '</div>';
  return ok;
}