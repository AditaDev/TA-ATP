$(document).ready(function () {
	$('#mytable').DataTable({
		"language": {
			"decimal": "",
			"emptyTable": "No hay información",
			"info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
			"infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
			"infoFiltered": "(Filtrado de _MAX_ total entradas)",
			"infoPostFix": "",
			"thousands": ",",
			"lengthMenu": "Mostrar _MENU_ Entradas",
			"loadingRecords": "Cargando...",
			"processing": "Procesando...",
			"search": "Buscar:",
			"zeroRecords": "Sin resultados encontrados",
			"paginate": {
				"first": "Primero",
				"last": "Ultimo",
				"next": "Siguiente",
				"previous": "Anterior"
			}
		}
	});
});

$(document).ready(function () {
	$('#mytable1').DataTable({
		"language": {
			"decimal": "",
			"emptyTable": "No hay información",
			"info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
			"infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
			"infoFiltered": "(Filtrado de _MAX_ total entradas)",
			"infoPostFix": "",
			"thousands": ",",
			"lengthMenu": "Mostrar _MENU_ Entradas",
			"loadingRecords": "Cargando...",
			"processing": "Procesando...",
			"search": "Buscar:",
			"zeroRecords": "Sin resultados encontrados",
			"paginate": {
				"first": "Primero",
				"last": "Ultimo",
				"next": "Siguiente",
				"previous": "Anterior"
			}
		}
	});
});

function verpass() {
	const passwordInput = document.getElementById('password');
	const eyeIcon = document.getElementById('vpass');
	if (passwordInput.type === 'password') {
		passwordInput.type = 'text';
		eyeIcon.classList.remove('fa-eye');
		eyeIcon.classList.add('fa-eye-slash');
	} else if (passwordInput.type === 'text') {
		passwordInput.type = 'password';
		eyeIcon.classList.remove('fa-eye-slash');
		eyeIcon.classList.add('fa-eye');
	}
}


function solonum(e) {
	key = e.keyCode || e.which;
	teclado = String.fromCharCode(key);
	numeros = "0123456789";
	var especiales = ["8", "45"];
	teclado_especial = false;
	for (var i in especiales) {
		if (key == especiales[i]) {
			teclado_especial = true;
		}
	}
	if (numeros.indexOf(teclado) == -1 && !teclado_especial) {
		return false;
	}
}

function NumDecimal(e) {
    var key = e.keyCode || e.which;
    var tecla = String.fromCharCode(key);

    var teclasEspeciales = ["8", "9", "37", "39", "46"];
    if (teclasEspeciales.indexOf(key) !== -1) return true;

    var regex = /^[0-9]$/;
    var valorActual = e.target.value;

    if (tecla === '.' && valorActual.indexOf('.') !== -1) return false;

	if (valorActual.indexOf('.') !== -1) {
        var parteDecimal = valorActual.split('.')[1];
        if (parteDecimal && parteDecimal.length >= 2) return false;
    }    
    if (!regex.test(tecla) && tecla !== '.') return false;
    
	return true;
}


function sololet(f) {
	key = f.keyCode || f.which;
	teclado = String.fromCharCode(key);
	letras = " abcdefghijklmnñopqrstuvwxyzáéíóú" + " ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚ";
	especiales = "8-37-38-46";
	teclado_especial = false;
	for (var u in especiales) {
		if (key == especiales[u]) {
			teclado_especial = true;
		}
	}
	if (letras.indexOf(teclado) == -1 && !teclado_especial) {
		return false;
	}
}

//----------Formato------------

function ocultarseccion(sec, des){
	const seccion = document.getElementById(sec);
	const desplega = document.getElementById(des);

	if (seccion.style.visibility === "hidden") {
		desplega.className = "fa-solid fa-caret-right"
        seccion.style.visibility = "visible";
        seccion.style.height = seccion.scrollHeight + "px";
        seccion.style.transition = "height 0.5s ease, visibility 0s linear 0s";
    } else {
		desplega.className = "fa-solid fa-caret-down"
        seccion.style.height = "0px";
        seccion.style.visibility = "hidden";
        seccion.style.transition = "height 0.5s ease, visibility 0s linear 0.5s";
    }
}

$(document).ready(function () {
	// Escucha el evento cuando se selecciona una opción del autocompletado
	$(document).on("autocompleteselect", ".custom-combobox1-input", function (event, ui) {
		let value = ui.item.option.value; // El valor real del <option>
		console.log("Valor seleccionado:", value);
		recNivel(value); // Aquí llamas tu función con el valor correcto
	});

	// También puedes enganchar el cambio manual (por si alguien escribe a mano)
	$(document).on("autocompletechange", ".custom-combobox1-input", function (event, ui) {
		let selectedOption = $(this).closest(".custom-combobox1").prev("select").val(); // lee el <select> oculto
		console.log("Valor escrito o cambiado:", selectedOption);
		recNivel(selectedOption);
	});
});

function recFormato(value) {
	if (value === "") {
    	$("#recFormato").html(""); // Limpia si no se selecciona nada
    	return;
  	}

	$.ajax({
		type: 'post',
		url: 'views/vajax.php',
		data: { valor: value, pag: 'for' },
		success: function (response) {
			$("#recFormato").html(response);
		},
		error: function() {
    		$("#recFormato").html("<p style='color: red'>Error al cargar, formulario no encontrado.</p>");
    	}
	});
}

function recNivel(value) {
	if (value === "") {
		$("#nivel").val("");
		$("#nivel").removeAttr("min");
		return;
	}

	$.ajax({
		type: 'POST',
		url: 'views/vajax.php',
		data: { valor: value, pag: 'per' },
		success: function (response) {
			let nivelMinimo = parseInt(response);

			if (!isNaN(nivelMinimo)) {
				$("#nivel").val(nivelMinimo);        // Establece el valor actual
				$("#nivel").attr("min", nivelMinimo); // Establece el mínimo permitido
			} else {
				$("#nivel").val("");
				$("#nivel").removeAttr("min");
			}
		},
		error: function () {
			$("#nivel").val("");
			$("#nivel").removeAttr("min");
		}
	});
}


function eliminar(nom) {
	let v = confirm("¿Está seguro de eliminar este registro?\n\n- " + nom);
	return v;
}


function confirmar(nom, url) {
	if (confirm(nom)) {
		window.open(url, '_blank');
		setTimeout(() => location.reload(), 1000);
	}
}

function confirmarEnvio() {
    return confirm('¿Está seguro de enviar esta evaluación?\n\nUna vez enviada, no podrá ser modificada');
}

function pdf(idpdf, arc, nom, pg) {
	var w = window.innerWidth * 0.8;
	var h = window.innerHeight * 0.8;
	var l = (window.innerWidth - w) / 2;
	var t = (window.innerHeight - h) / 2;

	// Agregamos el valor de 'pg' al pdfPath
	var pdfPath = 'pdf.php?id=' + idpdf + '&arc=' + arc + '&pg=' + pg;

	// Abrimos la ventana con el archivo PDF
	var windownom = window.open(pdfPath, nom, 'width=' + w + ',height=' + h + ',left=' + l + ',top=' + t);
	windownom.document.title = nom;
}


$('ul li').on('click', function () {
	$('li').removeClass('active');
	$(this).addClass('active');
});



//-----------Menu----------

document.addEventListener("DOMContentLoaded", function (event) {

	const showNavbar = (toggleId, navId, bodyId, headerId) => {
		const toggle = document.getElementById(toggleId),
			nav = document.getElementById(navId),
			bodypd = document.getElementById(bodyId),
			headerpd = document.getElementById(headerId)

		// Validate that all variables exist
		if (toggle && nav && bodypd && headerpd) {
			toggle.addEventListener('click', () => {
				// show navbar
				nav.classList.toggle('showcabe')
				// change icon
				toggle.classList.toggle('bx-x')
				// add padding to body
				bodypd.classList.toggle('body-pd')
				// add padding to header
				headerpd.classList.toggle('body-pd')
			})
		}
	}

	showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')

	/*===== LINK ACTIVE =====*/
	const linkColor = document.querySelectorAll('.nav_link')

	function colorLink() {
		if (linkColor) {
			linkColor.forEach(l => l.classList.remove('active'))
			this.classList.add('active')
		}
	}
	linkColor.forEach(l => l.addEventListener('click', colorLink))

});


//menu desplegable

// function initDropdown() {
//     const dropdownTrigger = document.querySelector(".dropdown-trigger");
//     const nav = document.querySelector(".nav");

//     dropdownTrigger.addEventListener("click", function (e) {
//       e.preventDefault();
//       nav.classList.toggle("active");
//     });
//   }

//   document.addEventListener("DOMContentLoaded", initDropdown);


//----------Menu------------

function ocul(mos = 0, est = 0) {
	if (mos == 1) {
		if (est == 1) {
			document.getElementById("frmins").style.display = "inherit";
			document.getElementById("mas").style.display = "none";
			document.getElementById("menos").style.display = "inherit";
		} else {
			document.getElementById("frmins").style.display = "none";
			document.getElementById("mas").style.display = "inherit";
			document.getElementById("menos").style.display = "none";
		}
	} else if (mos == 2) {
		document.getElementById("frmins").style.display = "inherit";
		document.getElementById("mas").style.display = "none";
		document.getElementById("menos").style.display = "none";
	} else {
		document.getElementById("frmins").style.display = "none";
		document.getElementById("mas").style.display = "none";
		document.getElementById("menos").style.display = "none";
	}
}

function asig(mos = 1, est = 1) {
	if (mos == 1) {
		if (est == 1) {
			document.getElementById("frmins").style.display = "inherit";
			return
		} else {
			document.getElementById("frmins").style.display = "none";
		}
	}
}

function err(mess = "") {
	if (mess) {
		mess = "<strong>Error:</strong> ¡" + mess + "!";
		document.getElementById("err").innerHTML = mess;
		document.getElementById("err").style.display = "inline-block";
	} else {
		document.getElementById("err").innerHTML = "";
		document.getElementById("err").style.display = "none";
	}

}

function satf(mess = "") {
	if (mess) {
		mess = "¡" + mess + "!";
		document.getElementById("satf").innerHTML = mess;
		document.getElementById("satf").style.display = "inline-block";
	} else {
		document.getElementById("satf").innerHTML = "";
		document.getElementById("satf").style.display = "none";
	}

}

function cpass(mess = "") {
	if (mess) {
		mess = "<strong>¡Bienvenido a nuestra app!</strong><br>" + mess;
		document.getElementById("cpass").innerHTML = mess;
		document.getElementById("cpass").style.display = "inline-block";
	} else {
		document.getElementById("cpass").innerHTML = "";
		document.getElementById("cpass").style.display = "none";
	}

}

// combobox1 JQeuryUI
$(function () {
	$.widget("custom.combobox1", {
		_create: function () {
			this.wrapper = $("<span>")
				.addClass("custom-combobox1")
				.insertAfter(this.element);

			this.element.hide();
			this._createAutocomplete();
			this._createShowAllButton();
		},

		_createAutocomplete: function () {
			var selected = this.element.children(":selected"),
				value = selected.val() ? selected.text().trim() : "";

			this.input = $("<input>")
				.appendTo(this.wrapper)
				.val(value)
				.attr("title", "")
				.attr("required", this.element.attr('required') ? 'required' : null) // Sync 'required'
				.prop("disabled", this.element.prop('disabled')) // Sync 'disabled'
				.addClass("custom-combobox1-input ui-widget ui-widget-content ui-state-default ui-corner-left")
				.autocomplete({
					delay: 0,
					minLength: 0,
					source: this._source.bind(this)
				})
				.tooltip({
					classes: {
						"ui-tooltip": "ui-state-highlight"
					}
				});

			this._on(this.input, {
				autocompleteselect: function (event, ui) {
					ui.item.option.selected = true;
					this._trigger("select", event, {
						item: ui.item.option
					});
				},
				autocompletechange: "_removeIfInvalid"
			});
		},

		_createShowAllButton: function () {
			var input = this.input,
				wasOpen = false;

			$("<a>")
				.attr("tabIndex", -1)
				.attr("title", "Show All Items")
				.tooltip()
				.appendTo(this.wrapper)
				.button({
					icons: {
						primary: "ui-icon-triangle-1-s"
					},
					text: false
				})
				.removeClass("ui-corner-all")
				.addClass("custom-combobox1-toggle ui-corner-right")
				.on("mousedown", function () {
					wasOpen = input.autocomplete("widget").is(":visible");
				})
				.on("click", function () {
					input.trigger("focus");

					// Close if already visible
					if (wasOpen) {
						return;
					}

					// Pass empty string as value to search for, displaying all results
					input.autocomplete("search", "");
				});
		},

		_source: function (request, response) {
			var matcher = new RegExp($.ui.autocomplete.escapeRegex(request.term), "i");
			response(this.element.children("option").map(function () {
				var text = $(this).text().trim();
				if (this.value && (!request.term || matcher.test(text)))
					return {
						label: text,
						value: text,
						option: this
					};
			}));
		},

		_removeIfInvalid: function (event, ui) {
			// Selected an item, nothing to do
			if (ui.item) {
				return;
			}

			// Search for a match (case-insensitive)
			var value = this.input.val().trim(),
				valueLowerCase = value.toLowerCase(),
				valid = false;
			this.element.children("option").each(function () {
				if ($(this).text().trim().toLowerCase() === valueLowerCase) {
					this.selected = valid = true;
					return false;
				}
			});

			// Found a match, nothing to do
			if (valid) {
				return;
			}

			// Remove invalid value
			this.input
				.val("")
				.attr("title", value + " didn't match any item")
				.tooltip("open");
			this.element.val("");
			this._delay(function () {
				this.input.tooltip("close").attr("title", "");
			}, 2500);
			this.input.autocomplete("instance").term = "";
		},

		_destroy: function () {
			this.wrapper.remove();
			this.element.show();
		}
	});

	$("#combobox1").combobox1();
	$("#toggle").on("click", function () {
		$("#combobox1").toggle();
	});
});

// combobox2 JQeuryUI
$(function () {
	$.widget("custom.combobox2", {
		_create: function () {
			this.wrapper = $("<span>")
				.addClass("custom-combobox2")
				.insertAfter(this.element);

			this.element.hide();
			this._createAutocomplete();
			this._createShowAllButton();
		},

		_createAutocomplete: function () {
			var selected = this.element.children(":selected"),
				value = selected.val() ? selected.text().trim() : "";

			this.input = $("<input>")
				.appendTo(this.wrapper)
				.val(value)
				.attr("title", "")
				.attr("required", this.element.attr('required') ? 'required' : null)
				.prop("disabled", this.element.prop('disabled'))
				.addClass("custom-combobox2-input ui-widget ui-widget-content ui-state-default ui-corner-left")
				.autocomplete({
					delay: 0,
					minLength: 0,
					source: this._source.bind(this)
				})
				.tooltip({
					classes: {
						"ui-tooltip": "ui-state-highlight"
					}
				});

			this._on(this.input, {
				autocompleteselect: function (event, ui) {
					ui.item.option.selected = true;
					this._trigger("select", event, {
						item: ui.item.option
					});
				},

				autocompletechange: "_removeIfInvalid"
			});
		},

		_createShowAllButton: function () {
			var input = this.input,
				wasOpen = false;

			$("<a>")
				.attr("tabIndex", -1)
				.attr("title", "Show All Items")
				.tooltip()
				.appendTo(this.wrapper)
				.button({
					icons: {
						primary: "ui-icon-triangle-1-s"
					},
					text: false
				})
				.removeClass("ui-corner-all")
				.addClass("custom-combobox2-toggle ui-corner-right")
				.on("mousedown", function () {
					wasOpen = input.autocomplete("widget").is(":visible");
				})
				.on("click", function () {
					input.trigger("focus");

					// Close if already visible
					if (wasOpen) {
						return;
					}

					// Pass empty string as value to search for, displaying all results
					input.autocomplete("search", "");
				});
		},

		_source: function (request, response) {
			var matcher = new RegExp($.ui.autocomplete.escapeRegex(request.term), "i");
			response(this.element.children("option").map(function () {
				var text = $(this).text().trim();
				if (this.value && (!request.term || matcher.test(text)))
					return {
						label: text,
						value: text,
						option: this
					};
			}));
		},

		_removeIfInvalid: function (event, ui) {

			// Selected an item, nothing to do
			if (ui.item) {
				return;
			}

			// Search for a match (case-insensitive)
			var value = this.input.val().trim(),
				valueLowerCase = value.toLowerCase(),
				valid = false;
			this.element.children("option").each(function () {
				if ($(this).text().trim().toLowerCase() === valueLowerCase) {
					this.selected = valid = true;
					return false;
				}
			});

			// Found a match, nothing to do
			if (valid) {
				return;
			}

			// Remove invalid value
			this.input
				.val("")
				.attr("title", value + " didn't match any item")
				.tooltip("open");
			this.element.val("");
			this._delay(function () {
				this.input.tooltip("close").attr("title", "");
			}, 2500);
			this.input.autocomplete("instance").term = "";
		},

		_destroy: function () {
			this.wrapper.remove();
			this.element.show();
		}
	});

	$("#combobox2").combobox2();
	$("#toggle").on("click", function () {
		$("#combobox2").toggle();
	});
});

