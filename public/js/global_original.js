$(document).ready(function() {

    $('#factura, #no_aprobados, #aprobados').DataTable();
	
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
	});

 $('#form-add').submit(function(e){
 		e.preventDefault();
		var inputFileImage = document.getElementById("factura-xml");
		var file = inputFileImage.files[0];
		var data = new FormData();
		data.append("factura-xml",file);

 	$.ajax({
			url: '/validacion',
			type: 'POST',
			dataType: 'json',
			data:data,
			enctype: 'multipart/form-data',
			cache: false,
		    contentType: false,
		    processData: false,
		    success: function(respuesta){	
		    	//console.log(respuesta.xml_info[0]['no_identificacion']);
		    	/*for (var i in respuesta.xml_info) {
				     console.log( i + " = " + respuesta.xml_info[i]['no_identificacion']  + "\n");
				     console.log( i + " = " + respuesta.xml_info[i]['unidad']  + "\n");
				     console.log( i + " = " + respuesta.xml_info[i]['descripcion']  + "\n");
				     console.log( i + " = " + respuesta.xml_info[i]['cantidad']  + "\n"); 
				     console.log( i + " = " + respuesta.xml_info[i]['importe']  + "\n");
			    }*/

		    	if(respuesta.factura != null && respuesta.success == true){
					var row = '<tr>\
		                <td>' + respuesta.factura[0]['folio']  + '</td>\
		                <td>$ ' + respuesta.factura[0]['total']  + '</td>\
		                <td> 3</td>\
		                <td><button class="btn btn-primary" style="width: 30%; background: #2a91d6;" href="">ver</button> ' + respuesta.factura[0]['fecha']  + '</td>\
		             </tr>';

	 				$('#factura tr:last').after(row);
	 				$('#errores').html('');

					//Se agregan los registros en la tabla de productos.
						for (var i in respuesta.xml_info) {
							var inv = '<tr>\
							                <td>' + respuesta.xml_info[i]['no_identificacion']  + '</td>\
							                <td>' + respuesta.xml_info[i]['id_factura'] + '</td>\
							                <td>' + respuesta.xml_info[i]['unidad']  + '</td>\
							                <td>' + respuesta.xml_info[i]['descripcion']  + '</td>\
							                <td>' + respuesta.xml_info[i]['cantidad']  + '</td>\
							                <td>$ ' + respuesta.xml_info[i]['importe']  + '</td>\
							           </tr>';

							    $('#aprobados tr:last').after(inv); 
							    $('#no_aprobados tr:last').after(inv);      
						}
 				}

 				if(respuesta.success == false){
 					$.each( respuesta.errors, function( key, value ) {
						$('#errores').html('<div class="alert alert-danger">'+ value +'</div>'); 
					});
 				}

 				if(respuesta.success == 'invalida'){
 					$('#errores').html('<div class="alert alert-danger">'+ respuesta.errors +'</div>'); 
 				}

			},
			statusCode: {
			    500: function() {
			      $('#errores').html('<div class="alert alert-danger">XML INVALIDO</div>'); 
			    }
			  }


		});



	});	

});