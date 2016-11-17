// JavaScript Document<script language="javascript">
function isMail(Cadena) {

	Punto = Cadena.substring(Cadena.lastIndexOf('.') + 1, Cadena.length)			// Cadena del .com
	Dominio = Cadena.substring(Cadena.lastIndexOf('@') + 1, Cadena.lastIndexOf('.')) 	// Dominio @lala.com
	Usuario = Cadena.substring(0, Cadena.lastIndexOf('@'))					// Cadena lalala@
	Reserv = "@/º\"\'+*{}\\<>?¿[]áéíóú#·¡!^*;,:"						// Letras Reservadas
	
	// Añadida por El Codigo para poder emitir un alert en funcion de si email valido o no
	valido = true
	
	// verifica qie el Usuario no tenga un caracter especial
	for (var Cont=0; Cont<Usuario.length; Cont++) {
		X = Usuario.substring(Cont,Cont+1)
		if (Reserv.indexOf(X)!=-1)
                	valido = false
	}

	// verifica qie el Punto no tenga un caracter especial
	for (var Cont=0; Cont<Punto.length; Cont++) {
		X=Punto.substring(Cont,Cont+1)
		if (Reserv.indexOf(X)!=-1)
			valido = false
	}
                        
	// verifica qie el Dominio no tenga un caracter especial
	for (var Cont=0; Cont<Dominio.length; Cont++) {
		X=Dominio.substring(Cont,Cont+1)
		if (Reserv.indexOf(X)!=-1)
			valido = false
		}

	// Verifica la sintaxis básica.....
	if (Punto.length<2 || Dominio <1 || Cadena.lastIndexOf('.')<0 || Cadena.lastIndexOf('@')<0 || Usuario<1) {
		valido = false
	}
	
	// Añadido por El Código para que emita un alert de aviso indicando si email válido o no
	if (valido==false) {
		alert('Email  no válido.')
		return false;	//cambiar por return true para hacer el submit del formulario en caso de validacion correcta
	} else {
		return true;
	}
}

function valida_envia(){
    //valido el nombre
    if (document.fvalida.name.value.length==0){
       alert("Tiene que escribir su nombre");
       document.fvalida.name.focus();
       return false;
    }
	   //valido el apellido
    if (document.fvalida.surname.value.length==0){
       alert("Tiene que escribir sus apellidos");
       document.fvalida.surname.focus();
       return false;
    }
	   //valido la dirección
    if (document.fvalida.address.value.length==0){
       alert("Tiene que escribir la dirección de envio del pedido");
       document.fvalida.address.focus();
       return false;
    }
	
		   //valido la dirección
    if (document.fvalida.address.value.length==0){
       alert("Tiene que escribir la dirección de envio del pedido");
       document.fvalida.address.focus();
       return false;
    }
   //valido Ciudad
    if (document.fvalida.city.value.length==0){
       alert("Tiene que escribir una ciudad de destino");
       document.fvalida.city.focus();
       return false;
    }
			   //valido la Provincia
    if (document.fvalida.state.value.length==0){
       alert("Tiene que escribir su provincia");
       document.fvalida.state.focus();
       return false;
    }
				   //valido lael código postal
    if (document.fvalida.zip.value.length==0){
       alert("Tiene que escribir su código postal");
       document.fvalida.zip.focus();
       return false;
    }
  
 			   //validoel país
    if (document.fvalida.country.value.length==0){
       alert("Tiene que escribir su país");
       document.fvalida.country.focus();
       return false;
    }
  		   //validoel telf y movil
    if (document.fvalida.telf.value.length<9 &&  document.fvalida.celular.value.length<9){
       alert("Tiene que escribir almenos un teléfono de contacto válido");
       document.fvalida.telf.focus();
       return false;
    }

			   //validoel mail
    if (document.fvalida.email.value.length==0){
       alert("Tiene que escribir su Email");
       document.fvalida.email.focus();
       return false;
    }
	
	if ( !isMail(document.fvalida.email.value) )
  	return false;
  else
	{
    //el formulario se envia
    return true;
	}
} 
