
          function editno2(i){
            var ok = document.getElementById("okboton" + i);
            var edito = document.getElementById("editarboton" + i);
            ok.style.display='none';
            edito.style.display='block';

            }

            function eliminar(id) {
                if (window.confirm("Aviso:\n Desea eliminar el registro seleccionado?")) {
                    window.location = "delete.php?action=del&tabla=peliculas&id="+id;  
                }
            }

        function editar(i){
            var ok = document.getElementById("okboton" + i);
            var edito = document.getElementById("editarboton" + i);
            var nombinp = document.getElementById("nombre"+i);
            var sinoinp = document.getElementById("sinopsis"+i);
            var anioinp= document.getElementById('anio'+i);
            var geninp= document.getElementById('genero'+i);
            geninp.style.display='block';
            anioinp.style.display='block';
            sinoinp.style.display='block';
            nombinp.style.display='block';
            ok.style.display='block';
            edito.style.display='none';
            document.getElementById('divgen'+i).style.display='none';
            document.getElementById('divanio'+i).style.display='none';
            document.getElementById('editablenom'+i).style.display='none';
            document.getElementById('divsinopsis'+i).style.display='none';
            
        }


        function MostrarOcultar(id){
            var puntoContraible = document.getElementById("punto"+id);
            var puntoCorto = document.getElementById("puntoCorto" + id);

            if (puntoContraible.style.display == 'none'){ 
                puntoContraible.style.display = 'block'; 
                puntoCorto.style.display = 'none'; 
            }else{ 
                puntoContraible.style.display = 'none'; 
                puntoCorto.style.display = 'block'; 
            } 
            }
       
 function validar22(f) {
  var vacios=false;
  var ok = true;
  var msg1 = "";
  var msg0 = "";
  var num = /^[0-9]+$/;
  var validaanio= "";
  var validasinop= "";
  var validanombre= "";

  if(f.ingresosinop.value == ""){
    msg1 += "Campo sinopsis. ";
    vacios = true;
  }
  if (f.ingresoanio.value == ""){
    msg1 += "Campo año. ";
    vacios = true;
  }
  if (f.ingresonombre.value == ""){
    msg1 += "Campo nombre. ";
    vacios = true;
  }
  if(f.inputgen.value=="vacio"){
    msg1+= "Campo Genero . ";
    vacios=true;
  }
  if (vacios == true){
    msg0 = "Debes completar los siguientes campos: ";
    ok = false;
  }

  if ((!f.ingresoanio.value.match(num)) || (f.ingresoanio.value.length!=4)){
    validaanio= "Debe ingresar un numero de 4 digitos en el año.";
    ok=false;
  }
  
  if(f.ingresosinop.value.length > 850){
    validasinop= " Debe ingresar 850 caracteres en la sinopsis como máximo.";
    ok=false;
  }
  
  if(f.ingresonombre.value.length > 255){
    validanombre= " Debe ingresar 255 cacracteres en el nombre como máximo.";
    ok=false;
  }
  
  if(!validarimagen("formagrego","imagen2")){
    msg1="Verifica el formato de tu IMAGEN";
    ok=false;
  }
  
  if(ok == false){
    // var mensajeError = document.getElementById('insertHere2');
    alert(msg0 + msg1 + validaanio + validasinop + validanombre);
    // mensajeError.innerHTML ='<div class="alert alert-danger">' + msg0 + msg1 + validaanio + validasinop + validanombre '</div>';
  }

return ok;
}


 function validar33(f) {
  var vacios=false;
  var ok = true;
  var msg1 = "";
  var msg0 = "";
  var num = /^[0-9]+$/;
  var validaanio= "";
  var validasinop= "";
  var validanombre= "";

  if(f.sinopsisnueva.value == ""){
    msg1 += "Campo sinopsis. ";
    vacios = true;
  }
   
  if (f.anionuevo.value == ""){
    msg1 += "Campo año. ";
    vacios = true;
  }
  
  if (f.nombrenuevo.value == ""){
    msg1 += "Campo nombre. ";
    vacios = true;
  }
  
  if(f.gennue.value==""){
    msg1+= "Campo Genero. ";
    vacios=true;
  }
  
  if (vacios == true){
    msg0 = "Debes completar los siguientes campos: ";
    ok = false;
  }

  if ((!f.anionuevo.value.match(num)) || (f.anionuevo.value.length!=4)){  
    validaanio= "Debe ingresar un numero de 4 digitos en el año.";
    ok=false;
  }
  
  if(f.sinopsisnueva.value.length > 850){
    validasinop= " Debe ingresar 850 caracteres en la sinopsis como maximo.";
    ok=false;
  }
  
  if(f.nombrenuevo.value.length > 255){
    validanombre= " Debe ingresar 255 cacracteres en el nombre como maximo.";
    ok=false;
  }
  if(ok == false){
    // var mensajeError = document.getElementById('insertHere2');
    alert(msg0 + msg1 + validaanio + validasinop + validanombre);
    // mensajeError.innerHTML ='<div class="alert alert-danger">' + msg0 + msg1 + validaanio + validasinop + validanombre '</div>';
  }

  return ok;
}

function validarimagen(nom,j){
  var OK = true;
  var frm = document.forms[nom];
  var f = frm.elements[j];
  if(!f.value.match(/.(jpg)|(png)|(jpeg)$/) ){
    //document.getElementById("msg").innerHTML = "Extension debe ser jpg, jpeg, gif o png";
    OK = false;
  }
  return OK;
}

function validoimage(){
  formimagen1
  var OK = true;
  var frm = document.forms["formimagen1"];
  var f = frm.elements["imagen"];
  if(f.value==""){
    alert("Seleccione una imagen");
  }
  else {
    if( !f.value.match(/.(jpg)|(png)|(jpeg)$/) ){
      alert("Extension incorrecta de imagen.");
      OK = false;
    }
  }
  return OK;
}