/*
	Copyright (c) 2009 Hermann Schimpf (http://gschimpf.com/)
	Bajo licencia MIT y GPL.
	
	.: AllowChars v0.1 :.
	Probado en jQuery 1.3.2
	Fecha: 2009-06-30
	
	Modo de uso:
		simple:
			permite letras, numeros, y espacios
			$('selector').allowChars();
		personalizado:
			$('selector').allowChars({
				letras: [boolean],
				numeros: [boolean],
				espacios: [boolean],
				caracteres: [string],	// ejemplo: caracteres: '.-@/+'
				setfocus: [boolean]		// pone el foco sobre el objeto
			});
		otros:
			Si el formulario donde se utiliza esta ordenado con las propiedades 'tabindex' de cada elemento,
			se le puede pasar como parametro 'enter' en true o false para que al presionar la tecla enter
			automaticamente pase al siguiente campo.
			Asi como tambien la cantidad de campos que existen. Por defecto es 20.
			Este parametro hace que al llegar al ultimo campo y presionar la tecla enter,
			se envie el foco al primer campo.
			No hay problema en poner una cantidad mayor a la que existiere en el formulario.
			La funcion detectara que ya no existen mas campos y volvera al inicial
			
			$('selector').allowChars({
				enter: true,
				maxFields: 15
			});
*/
	
(function($) {
	$.fn.allowChars = function(options) {
		options = $.extend({}, $.fn.allowChars.defaults, options);
		options.tabindex = $(this).attr('tabindex');
		$(this).bind('keydown',function(event) {
			options.event = event;
			return $.fn.allowChars.eventInput(options);
		});
		if (options.setfocus)
			$(this).focus();
	}
	$.fn.allowChars.defaults = {
		/*
			valores por defecto
			permite letras, numeros y espacios
		*/
		letras: true,
		numeros: true,
		espacios: true,
		caracteres: false,
		event: false,
		setfocus: false,
		enter: false,
		maxFields: 20,
		name: $(this).attr('name')
	}
	$.fn.allowChars.charOfKeyCode = function(caracter) {
		var keyCodes = new Array('! 49','" 222','$ 52','% 53','& 55','/ 191','( 57',') 48','= 61','? 191','* 56','; 59',': 59','> 190','\\ 220','| 220','@ 50','# 51','~ 192','{ 219','[ 219','] 221','} 221','< 188','/ 111','- 109','+ 107','. 110',', 188','_ 109','. 190');
		var item;
		var retorno = '';
		for (var i in keyCodes) {
			item = keyCodes[i].split(' ');
			if (item[0] == caracter) {
				retorno += item[1] + ' ';
			}
		}
		retorno = retorno.substring(0,(retorno.length - 1));
		return retorno;
	}
	$.fn.allowChars.eventInput = function(params) {
		/* obtenemos el keycode desde el evento which */
		var key = params.event.which;
		/* creamos un array donde guardaremos todos los keycode permitidos */
		var arrayKeys = new Array();
		/* Agregamos los keycode correspondientes a las funciones de teclado comunes */
		/* (33-36) RePag, AvPag, Fin, Inicio */
		/* (37-40) Flechas de navegacion	 */
		for (var i=33;i<=40;i++)
			arrayKeys[i] = i;
		arrayKeys[8] = 8;	/* backspace */
		arrayKeys[9] = 9;	/* tabulador */
		arrayKeys[27] = 27;	/* tabulador */
		arrayKeys[46] = 46;	/* suprimir	 */
		/* teclas F -> F1, F2, F3.. */
		for (var i=112;i<=123;i++)
			arrayKeys[i] = i;
		
		/* Verificamos si se permiten letras */
		if (params.letras === true)
			/* si se permiten letras, agregamos los keycode */
			for (var i=65;i<=90;i++)
				arrayKeys[i] = i;
		/* Verificamos si se permiten numeros */
		if (params.numeros === true) {
			/* si se permiten numeros, agregamos los keycode */
			for (var i=48;i<=57;i++)
				arrayKeys[i] = i;	/* Numeros encima del teclado */
			for (var i=96;i<=105;i++)
				arrayKeys[i] = i;	/* Teclado numerico */
		}
		/* verificamos si se permiten espacios */
		if (params.espacios === true)
			arrayKeys[32] = 32;
		/* Verificamos si se permiten otros caracteres */
		if (params.caracteres === true) {
			/* permite ingresar todo menos espacios */
			for (var i=0;i<=31;i++)
				arrayKeys[i] = i;
			for (var i=33;i<=255;i++)
				arrayKeys[i] = i;
		} else if (params.caracteres !== false) {
			/* si se permiten otros caracteres descomponemos la cadena y agregamos los keycode */
			var indice;
			var permitidos = new Array;
			//alert(params.caracteres);
			permitidos = params.caracteres.split('');
			for (var l in permitidos) {
				/* recorro el array y agrelo los keycode de cada caracter */
				indice = $.fn.allowChars.charOfKeyCode(permitidos[l]);
				if (isNaN(indice)) {
					indice = indice.split(' ');
					for (var t in indice)
						arrayKeys[indice[t]] = indice[t];
				} else
					arrayKeys[indice] = indice;
			}
		}
		if (!params.event.shiftKey && !params.event.ctrlKey) {
			/* recorremos el array para preguntar por el key presionado */
			for (var i in arrayKeys) {
				if (arrayKeys[i] == key) {
					/* si el key presionado esta dentro del array retornamos True */
					return true;
				} else if (key == 13 && params.enter === true) {
					if (typeof params.name == 'undefined') {
						alert('Falta el parametro con el nombre del campo');
						return false;
					}
					if (typeof params.tabindex == 'undefined') {
						alert('El campo no tiene la etiqueta \'tabindex\'');
						return false;
					}
					if (params.maxFields >= 100) {
						alert('La cantidad maxima de campos es mayor a 100\nSe limito esta cantidad puesto que puede generar el bloqueo del navegador');
						return false;
					}
					params.tabindex++;
					while ($("[tabindex='" + params.tabindex + "']").attr('disabled') != false) {
						params.tabindex++;
						if (params.tabindex > params.maxFields) {
							params.tabindex = 1;
							break;
						}
					}
					$("[tabindex='" + params.tabindex + "']").focus();
					return false;
				}
			}
		} else {
			/* verifico si presiona la tecla shift */
			if (params.event.shiftKey) {
				/* permito las flechas de navegacion, inicio, fin, avpag, repag y tabulador */
				for (var i = 33; i <= 40; i++)
					if (i == key || key == 9)
						return true;
				/* si se permiten letras, acepto las mayusculas */
				if (params.letras)
					for (var i = 65; i <= 90; i++)
						if (i == key)
							return true;
				if (params.caracteres !== false) {
					/* si se permiten otros caracteres descomponemos la cadena y agregamos los keycode */
					var indice;
					var permitidos = new Array;
					//alert(params.caracteres);
					permitidos = params.caracteres.split('');
					for (var l in permitidos) {
						/* recorro el array y agrelo los keycode de cada caracter */
						indice = $.fn.allowChars.charOfKeyCode(permitidos[l]);
						if (isNaN(indice)) {
							indice = indice.split(' ');
							for (var t in indice)
								if (indice[t] == key)
									return true;
						} else
							if (indice == key)
								return true;
					}
				}
			}
		}
		/* si llego aqui es porque el keycode no esta permitido, retorno false */
		return false;
	}
})(jQuery);
