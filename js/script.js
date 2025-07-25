// ---------- Permisos -----------

document.getElementById("fecfin").addEventListener("change", validarFormulario);
document.getElementById("fecini").addEventListener("change", function() {
    validarFormulario();
    actualizarMinMax();
});

function validarFormulario() {
    const feciniInput = document.getElementById("fecini");
    const fecfinInput = document.getElementById("fecfin");
    
    const submitBtn = document.getElementById("btns");

    submitBtn.disabled = true;
    
    let feciniValido = true
    let fecfinValido = true

    if(feciniInput.value){
        feciniValido = validarHora(feciniInput);
    }
    
    if(fecfinInput.value){
        fecfinValido = validarHora(fecfinInput);
    }

    if (feciniValido && fecfinValido) {
        submitBtn.disabled = false;
    }
}

function validarHora(input) {
    const fecini = new Date(document.getElementById("fecini").value);
    const fecfin = new Date(document.getElementById("fecfin").value);
    const selectedDate = new Date(input.value);
    const horaini = fecini.getHours();
    const horafin = fecfin.getHours();
    const minini = fecini.getMinutes();
    const minfin = fecfin.getMinutes();
    const hora = selectedDate.getHours();
    const minutos = selectedDate.getMinutes();

    let errorMessageId = (input.id === "fecini") ? "error-message-fecini" : "error-message-fecfin";
    const errorMessage = document.getElementById(errorMessageId);

    // Validar que la hora esté entre 8:00 AM y 5:30 PM
    if (hora < 8 || (hora === 17 && minutos > 30) || hora > 17) {
        mostrarError(input, errorMessage, "La hora debe estar entre las 8:00 AM y las 5:30 PM.")
        return false;
    }

    // Validar que la hora esté en intervalos 15 minutos
    if (minutos % 15 !== 0) {
        mostrarError(input, errorMessage, "La hora debe estar en intervalos de 15 minutos.");
        return false;
    }

    // Validar que fecfin no sea menor que fecini
    if (fecfin.getTime() < fecini.getTime()) {
        mostrarError(input, errorMessage, "La fecha final no puede ser menor que la fecha inicial.");
        return false;
    } else if (fecfin.getTime() === fecini.getTime()){
        mostrarError(input, errorMessage, "Las fechas no pueden ser iguales.");
        return false;
    }

    if ((hora === 13 && (minutos > 0 && minutos <= 59))) {
        mostrarError(input, errorMessage, "Es hora de almuerzo (1:00 PM - 2:00 PM).");
        return false;
    }

    // Verificar si es hora de almuerzo (entre 1:00 PM y 2:00 PM)
    if ((horaini === 13 && (minini>=0 && minini<=59)) && ((horafin === 14 && minfin === 0) || (horafin === 13 && minfin>=0 && minfin<=59))) {
        mostrarError(input, errorMessage, "Es hora de almuerzo (1:00 PM - 2:00 PM).");
        return false;
    }


    
    // Validar jornada laboral
    const diffMs = fecfin - fecini; // Diferencia en milisegundos
    const diffHrs = Math.floor(diffMs / 3600000); // Horas
    const diffMins = Math.floor((diffMs % 3600000) / 60000); // Minutos
    const diffMinutes = Math.floor(diffMs / 60000); // Convertir a minutos

    let totalMinutes = (diffHrs * 60 + diffMins);
    
     // Valida si la diferencia es menor a 60 minutos (1 hora)
    if (diffMinutes < 60) {
        mostrarError(input, errorMessage, "La duración debe ser de al menos 1 hora.");
        return false;
    }
    
    // Restar 1 hora si se aplica
    if (hora < 13 || hora > 14) {
        totalMinutes -= 60; // Restar 1 hora
    }

    // Validar si la duración total supera las 8 horas y 30 minutos
    if (totalMinutes > (8 * 60 + 30)) { // 8 horas y 30 minutos en minutos
        mostrarError(input, errorMessage, "El permiso no puede ser mayor a la jornada laboral.");
        return false;
    }

    input.style.borderColor = "";
    errorMessage.style.display = "none";
    return true;    
}

function mostrarError(input, errorMessage, mensaje) {
    const submitBtn = document.getElementById("btns");

    input.style.borderColor = "red";
    errorMessage.textContent = mensaje;
    errorMessage.style.display = "block";
    submitBtn.disabled = true;
}


function validarPermiso() {
    const select = document.getElementById("idvtprm");
    const soporte = document.getElementById("arcspt");
    const msj = document.getElementById("soporte-requerido");
    const fecini = document.getElementById("fecini");
    const fecfin = document.getElementById("fecfin");
    const valor = select.value;
    
    const valorsoporte = ["2"];
    const hoy = new Date();
    const fechaMin = new Date(hoy);
    
    fechaMin.setDate(hoy.getDate() + (select.value == "1" ? 0 : 3)); // Sumar 0 días para hoy, 1 días para mañana
    const fechaMinString = fechaMin.toISOString().split("T")[0] + "T08:00"; // Formato YYYY-MM-DDT08:00

    // Establecer el mínimo en los inputs
    fecini.setAttribute("min", fechaMinString);
    fecfin.setAttribute("min", fechaMinString);

    // Validar si el permiso requiere soporte
    if (valorsoporte.includes(valor)) {
        soporte.setAttribute("required", "required");
        msj.style.display = "block";
    } else {
        soporte.removeAttribute("required");
        msj.style.display = "none";
    }
}

function actualizarMinMax() {
    const fecini = document.getElementById('fecini').value;
    const fecfin = document.getElementById('fecfin');

    if (fecini) {
        // Fijar el mínimo en fecfin al mismo valor que fecini
        fecfin.min = fecini;

        // Fijar el máximo para que sea el mismo día, pero hasta las 6:00 PM
        let maxDate = new Date(fecini);
        maxDate.setHours(17, 30, 0); // Fijar a las 5:30 PM
        fecfin.max = maxDate.toISOString().slice(0, 16); // Convertir a formato datetime-local
    }
}

function actMinMax() {
    const fecinib = document.getElementById('fecinib').value;
    const fecfinb = document.getElementById('fecfinb');

    if (fecinib){
        fecfinb.min = fecinib;
    }
}

function enter(event, id) {
    // Verificar si la tecla presionada es "Enter"
    if (event.key === 'Enter') {
        // Enviar el formulario
        document.getElementById(id).form.submit();
        return false; // Evitar que se agregue un salto de línea al presionar "Enter"
    }
    return true;
}

function contar() {
    const textarea = document.getElementById('desprm');
    const boton = document.getElementById('btns');
    const mensaje = document.getElementById('error-message-des');
    const content = textarea.value;

    const regex = /^(?!\s|0)(?!.*\s{2,}$)(?!\s*$|0$|null$).{20,}$/;

    if (!regex.test(content)) {
        textarea.style.borderColor = "red";
        mensaje.textContent = "La justificación debe ser mas larga.";
        mensaje.style.display = "block";
        boton.disabled = true;
    } else {
        textarea.style.borderColor = "";
        mensaje.style.display = "none";
        boton.disabled = false;
    }
}

// ---------- Contraseña -----------
function comparar(id) {
    const pass = document.getElementById('pasper'+id);
    const pass1 = document.getElementById('newpasper'+id);
    const mensaje = document.getElementById('error-message'+id);
    const boton = document.getElementById('btncon'+id);
    
    const regex = /^(?!\s|0|null$)(?!.*\bnull\b)(?=(.*[a-z]))(?=(.*[A-Z]))(?=(.*\d))(?=(.*[\W_])).{6,}$/;

    if (!regex.test(pass.value)) {
        mensaje.innerHTML = "La contraseña debe tener al menos 6 caracteres y contener:<li>Una letra mayúscula.</li><li>Una letra minúscula.</li><li>Un número.</li><li>Un carácter especial,</li>";
        mensaje.style.display = "block";
        mensaje.style.color = "black";
        mensaje.style.opacity = "0.8";
        boton.disabled = true;
        return; // Detener ejecución si alguna contraseña no es válida
    }

    if (pass.value !== pass1.value ) {
        pass1.style.borderColor = "red";
        mensaje.textContent = "Las contraseñas no coinciden.";
        mensaje.style.display = "block";
        mensaje.style.color = "red";
        mensaje.style.opacity = "1";
        boton.disabled = true;
        return;
    } else {
        pass1.style.borderColor = "";
        mensaje.style.display = "none";
        boton.disabled = false;
    }
}

function verpass(idinp, idbtn, id) {
    const passwordInput = document.getElementById(idinp+id);
    const eyeIcon = document.getElementById(idbtn+id);
  
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');  
    } else if (passwordInput.type === 'text'){
        passwordInput.type = 'password';
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
    }
  }

// ---------- Evaluaciones -----------
function sumporcent(){
    const tipfor = document.getElementById("tipfor");
    const porjef = document.getElementById("porjef");
    const porpar = document.getElementById("porpar");
    const poraut = document.getElementById("poraut");
    const porsub = document.getElementById("porsub");
    const error= document.getElementById('porcent');
    const boton = document.getElementById('btns');

    let sum = (parseInt(porjef.value) || 0) + (parseInt(porpar.value) || 0) + (parseInt(poraut.value) || 0) + (parseInt(porsub.value) || 0);

    if (tipfor.value === "57" || tipfor.value === "58" || tipfor.value === "59") {
        document.getElementById("porjef").required = true;
        document.getElementById("porpar").required = true;
        document.getElementById("poraut").required = true;

        if (tipfor.value === "57") document.getElementById("porsub").required = true;
        else document.getElementById("porsub").required = false;
        
        if (sum !== 100) {
            error.textContent = "La suma de todos los porcentajes debe ser 100.";
            error.style.display = "block";
            error.style.color = "red";
            error.style.opacity = "1";
            boton.disabled = true;
            return;
        } else {
            error.style.borderColor = "";
            error.style.display = "none";
            boton.disabled = false;
        }
        
    } else {
        document.getElementById("porjef").required = false;
        document.getElementById("porpar").required = false;
        document.getElementById("poraut").required = false;
        document.getElementById("porsub").required = false;
    }
}

function valNum(id, i){
    const res = parseFloat(document.getElementById(id+i).value);
    const error= document.getElementById('msjerror'+i);

    if (res < 0.0 || res > 5.0){
        error.textContent = "Ingrese un valor entre 0 y 5";
        error.style.display = "block";
        return;
    } else {
        error.style.display = "none";
    }
}

function validarCampos() {
    let campos = [];
    
    for (let i = 1; i <= 25; i++) {
        const campo = document.getElementById("res" + i);
        if (campo && campo.value.trim() !== "") {
            campos.push(campo);
        }
    }

    let todosValidos = campos.every(campo => {
        let valor = parseFloat(campo.value.trim()); 
        return !isNaN(valor) && valor >= 0 && valor <= 5;
    });

    const boton = document.getElementById("btns");
    boton.disabled = !todosValidos; 
}

function TipoEvaluacion(select) {
    const tipo = select.options[select.selectedIndex].getAttribute('data-tipo');
    document.getElementById('tipeva').value = tipo;
}

function valNomSec(baseNomSec, sec) {
    const nombre = document.getElementById(baseNomSec + sec);
    const error = document.getElementById("msjerror" + sec);
    const btnEnviar = document.getElementById("btnEnviar");

    let tieneRespuesta = false;
    for (let i = 1; i <= 5; i++) {
        const idx = (sec - 1) * 5 + i;
        const preInput = document.getElementById("pre" + idx);
        if (preInput && preInput.value.trim() !== "") {
            tieneRespuesta = true;
            break;
        }
    }

    if (tieneRespuesta && nombre.value.trim() === "") {
        error.innerText = "Ingrese el nombre de la sección.";
        error.style.display = "block";
    } else {
        error.innerText = "";
        error.style.display = "none";
    }

    // Verifica si hay errores visibles
    const errores = document.querySelectorAll('small[id^="msjerror"]');
    const hayErrores = Array.from(errores).some(e => e.style.display === "block");
    btnEnviar.disabled = hayErrores;
}


// ---------- Persona -----------

function valNivel() {
    const input = document.getElementById('nivel');
    const valor = parseFloat(input.value);
    const min = parseFloat(input.getAttribute('min'));
    const error = document.getElementById('msjerror');
    const boton = document.getElementById('btns');

    if (isNaN(valor) || valor < min) {
        mostrarError(input, error, "Ingrese un número mayor o igual a " + min);
        return; 
    } else {
        input.style.borderColor = ""
        error.style.display = "none";
        boton.disabled = false;
    }
}

window.onload = function() {
    validarPermiso();
    actualizarMinMax(); // Asegurarse de que los límites min/max se actualicen al cargar
    actMinMax();
    contar();
    comparar();
    validarCampos();
};