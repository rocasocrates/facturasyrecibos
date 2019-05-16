 $(document).ready (function () {


		 	$('#nuevo').on('click', function()
		 	{
		 		var padre = document.getElementById('lista');
		 		var lista = document.createElement('li');
		 		var descripcion = document.createElement('textarea');

		 		descripcion.setAttribute('cols', '100');
		 		descripcion.setAttribute('rows', '2');

		 		/* mirar mas tarde esto por ahora no funciona 
		 		var atributouno = document.createAttribute('cols');
		 			atributouno.value = '100';
		 			descripcion.setNamedItem(atributouno);*/
		 		var label = document.createElement('label');

		 		label.setAttribute('for', 'importe');

		 		elimporte = document.createTextNode('Importe :');

		 		label.appendChild(elimporte);


		 		var precio = document.createElement('input');
		 		 var checkbox = document.createElement('input');

		 		precio.setAttribute('name', 'importe');
		 		precio.setAttribute('id', 'importe');

		 		checkbox.setAttribute('type', 'checkbox');


		 		lista.appendChild(checkbox);



		 		lista.appendChild(descripcion);

		 		lista.appendChild(label);
		 		lista.appendChild(precio);

		 		padre.appendChild(lista);

		 		
		 	});

		 	$('#cerrar').on('click', function()
		 	{
		 		window.close();
		 		
		 	});

		 	$('#borrar').on('click', function()
		 	{
		 			
		 		$("input:checkbox:checked").each(function() {
             $(this).parent().remove();
        });


		 		//var padre = $('#lista');
		 		//padre.removeChild(lista);


		 	})

		 	$('#guardar').on('click', function()
		 	{
                  dni = $('#dni').val().trim();
                  nombre = $('#nombre').val().trim();
                  apellidos = $('#apellidos').val().trim();
                  direccion = $('#direccion').val().trim();
                  cp = $('#cp').val().trim();

                  siniestro = $('#siniestro').val();

                  idparte = $('#idparte').val();

                   numero = $('#numero').val().trim();
                   fecha = $('#fecha').val().trim();

                     importe = $('#lista input:last-child');

                     descripcion =  $('#lista textarea');

                     descripcionSinImporte =  $('#sinImporte').val();

                      alert("Direccion : "+direccion+" CP : "+cp);

                      lafactura = [dni, nombre, apellidos, direccion, cp, numero, fecha, baseimponible, iva, importeivados, total];
                      
                      lafactura.push(descripcionSinImporte);

                     

                     for (var i = 0; i < importe.length; i++) {

                     	

                     	lafactura.push(descripcion[i].value);
                     	lafactura.push(importe[i].value);
                     
                     }

                     lafactura.push(siniestro);
                     lafactura.push(idparte);

                    

                  // descripcion = $('#lista textarea:nth-of-type(1)').val();
                  // importe = $('#lista input').val();

                 
                 
              
                  //lafactura.push(descripcion);
                  //lafactura.push(importe);
                  
            
                  $.ajax({
                type: 'POST',
                url: 'generar.php?crear=si',
                async: true,
                data: {accion: JSON.stringify(lafactura)},
                dataType: 'json',
                 success: function(result){

                 	//alert(result);

                 	//window.open(url);

                 	$('#numero').val(result);
                 
                 }
            }); 

            //stringfactura = lafactura.toString();

            			// window.location = 'generarfactura.php?accion='+stringfactura;  

            			alert("FACTURA GUARDADA");
		 	})


		 	$('#lista').on('blur', 'li input', calcular);
		 	//cuando aga un cambio en el select
		 	$('#iva').on('blur', calcular);

		 	// fin cuando aga un cambio en el select

           function calcular(){

		 		valor = 0;

		 		var todolosinput = $('#lista li input:last-child');

		 		

		 		for (var i = 0; i < todolosinput.length; i++) 

		 		{
		 			valorinput = todolosinput[i].value;
		 			//primer paso: fuera puntos
						valorinput = valorinput.replace(".","");
						//cambiamos la coma por un punto
						valorinput = valorinput.replace(",",".");
						//listo
		 			 valorinput = parseFloat(valorinput);
		 			if(isNaN(valorinput))
		 			{
		 				valor = valor + parseFloat(0);

		 			}else
		 			{
		 				valor = valor + parseFloat(valorinput);
		 			}
		 		}
                //var node = document.createTextNode(valor);
               
               //setCookie('valor', valor);

              // base = getCookie('valor');

              //formatear numero
              var formatNumber = {
									 separador: ".", // separador para los miles
									 sepDecimal: ',', // separador para los decimales
									 formatear:function (num){
									 num +='';
									 var splitStr = num.split('.');
									 var splitLeft = splitStr[0];
									 var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
									 var regx = /(\d+)(\d{3})/;
									 while (regx.test(splitLeft)) {
									 splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
									 }
									 return this.simbol + splitLeft +splitRight;
									 },
									 new:function(num, simbol){
									 this.simbol = simbol ||'';
									 return this.formatear(num);
									 }
									}

            //fin de formatear 
              	function redondeo(numero, decimales)
					{
						var flotante = parseFloat(numero);
						var resultado = Math.round(flotante*Math.pow(10,decimales))/Math.pow(10,decimales);
						return resultado;
					}
                       valor = redondeo(valor, 2);
             // baseimponible = valor.toFixed(2);
             baseimponible = valor;

              baseimponible = formatNumber.new(baseimponible);
              /*formatear el numero a mano */
              contadorbase = baseimponible.split(',')
		 	
		 	 if(contadorbase[1] != undefined)
            {
		 	if (contadorbase[1].length == 1) {

		 		baseimponible = baseimponible+'0';
		 		document.getElementsByTagName('td')[0].innerHTML = baseimponible;
		 		
		 	}else
		 	if (contadorbase[1].length > 1) {

		 		document.getElementsByTagName('td')[0].innerHTML = baseimponible;
		 		
		 		
		 	}
        }else
           
            {
            	baseimponible = baseimponible+',00';
            	document.getElementsByTagName('td')[0].innerHTML = baseimponible;
		 		
		 	}
              
        	//document.getElementsByTagName('td')[0].innerHTML = baseimponible;

		 		iva = $('#iva').val();

		 	importeiva = parseFloat(valor) * parseFloat($('#iva').val());

		 	importeivados = redondeo(importeiva, 2);


		 	importeivados = formatNumber.new(importeivados);

		 	 contadoriva = importeivados.split(',')
		 	
		 	 if(contadoriva[1] != undefined)
            {
		 	if (contadoriva[1].length == 1) {
		 		importeivados = importeivados+'0';
		 		document.getElementsByTagName('td')[2].innerHTML = importeivados;
		 		
		 	}else
		 	if (contadoriva[1].length > 1) {

		 		document.getElementsByTagName('td')[2].innerHTML = importeivados;
		 		
		 		
		 	}
        }else
           
            {
            	importeivados = importeivados+',00';
            	document.getElementsByTagName('td')[2].innerHTML = importeivados;
		 		
		 	}

		 	//document.getElementsByTagName('td')[2].innerHTML = importeivados;

		 	total = parseFloat(valor) + importeiva;
            total = redondeo(total, 2);
		 	

		 	total = formatNumber.new(total);

		 	contador = total.split(',')

		 	
            if(contador[1] != undefined)
            {
		 	if (contador[1].length == 1) {

		 		total = total+'0';
		 		document.getElementsByTagName('td')[3].innerHTML = total;
		 		document.getElementById('suma').innerHTML = total;
		 	}else
		 	if (contador[1].length > 1) {

		 		document.getElementsByTagName('td')[3].innerHTML = total;
		 		document.getElementById('suma').innerHTML = total;
		 		
		 	}
        }else
           
            {
            	total = total+',00';
            	document.getElementsByTagName('td')[3].innerHTML = total;
		 		document.getElementById('suma').innerHTML = total;
		 		
		 	}
		 	//document.getElementsByTagName('td')[3].innerHTML = total;

		 	//document.getElementById('suma').innerHTML = total;

		 	}


		 });
