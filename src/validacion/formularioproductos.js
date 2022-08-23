const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');

const expresiones = {
	descripcionproducto: /^[a-zA-Z0-9\_\-]{1,50}$/, // Letras, numeros, guion y guion_bajo
	cantidad:  /^\d{1,14}$/, // 1 a 14 numeros.
    modelo: /^[a-zA-Z0-9\_\-]{1,30}$/, // Letras, numeros, guion y guion_bajo
    serie:  /^[a-zA-Z0-9\_\-]{1,30}$/,
	precio:  /^\d{1,14}$/, // Letras, numeros, guion y guion_bajo
}

const campos = {
	descripcionproducto: false,
	cantidad: false,
    modelo: false,
	serie: false,
	precio :false
}

const validarFormulario = (e) => {
	switch (e.target.name) {
		case "descripcionproducto":
			validarCampo(expresiones.descripcionproducto, e.target, 'descripcionproducto');
		break;
		case "cantidad":
			validarCampo(expresiones.cantidad, e.target, 'cantidad');
		break;
        case "modelo":
			validarCampo(expresiones.modelo, e.target, 'modelo');
		break;
		case "serie":
			validarCampo(expresiones.serie, e.target, 'serie');
		break;
		case "precio":
			validarCampo(expresiones.precio, e.target, 'precio');
		break;
       
		
	}
}

const validarCampo = (expresion, input, campo) => {
	if(expresion.test(input.value)){
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos[campo] = true;
	} else {
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos[campo] = false;
	}
}



inputs.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);

});