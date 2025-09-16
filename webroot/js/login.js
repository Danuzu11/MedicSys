



function validar(){
	var form = document.formulario;

	if(form.user.value == 0){
		alert("Campo usuario de invitacion no puede estar vacio");
		form.user.value= "";
		form.user.focus();
		event.preventDefault();
	}

	if(form.password.value == 0){
		alert("Campo contraseña no puede estar vacio");
		form.password.value= "";
		form.password.focus();
		event.preventDefault();
	}

}


