//Cargar pop up con la lista de productos que han sido actualizados por el administrador. 
if(  $('.producto_aprobado').length > 0){	
	if (sessionStorage.getItem('advertOnce') !== 'true') {
		$("#aprobadosModal").on("shown.bs.modal", function () { }).modal('show');
		sessionStorage.setItem('advertOnce','true');
	}

	$('#cerrar').on('click',function(){
		sessionStorage.setItem('advertOnce','');
	});
}

//$("#aprobadosModal").on("shown.bs.modal", function () { }).modal('show');
$(document).ready(function() {

  cargar_datatable();

  $('input[name="daterange"]').daterangepicker({
    opens: 'left'
	  	}, function(start, end, label) {
	    	console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });


	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
	});


 $('#form-add').submit(function(e){

 	    var	id_rfc = $('#rfc').val();
 		e.preventDefault();
		var inputFileImage = document.getElementById("factura-xml");
		var file = inputFileImage.files[0];
		var data = new FormData();
		data.append("factura-xml",file);
		data.append("id_rfc", id_rfc);
 	$.ajax({
//		url: window.location.protocol+'//'+window.location.host+'/pisaftp/public/validacion',
			url: window.location.protocol+'//'+window.location.host+'/pisaftp/public/validacion',
			type: 'POST',
			dataType: 'json',
			data:data,
			enctype: 'multipart/form-data',
			cache: false,
		    contentType: false,
		    processData: false,
		    success: function(respuesta){	

		    	if(respuesta.factura != null && respuesta.success == true){
					var row = '<tr id="facturaRow" class="factura">\
		                <td>' + respuesta.factura[0]['folio']  + '</td>\
		                <td>$ ' + respuesta.factura[0]['total']  + '</td>\
		                <td>' + respuesta.factura[0]['receptor']  + ' </td>\
						<td><a class="btn btn-primary" style="background: #2a91d6; margin-right: 3px; href="'+  window.location.href.replace('/home', '') +'/factura_info/' + respuesta.factura[0]['id']  + '/1'  + '"><span class="glyphicon glyphicon-list"></span></a><a class="btn btn-primary" style="background: #2a91d6;" href="'+  window.location.href.replace('/home', '') +'/factura_info/' + respuesta.factura[0]['id']  + '/2'  + '"><span class="glyphicon glyphicon-usd"></span></a> ' + respuesta.factura[0]['fecha']  + '</td>\
		             </tr>';

	 				$('#factura tr:last').after(row);
	 				$('#mensajes').html('');

					//Se agregan los registros en la tabla de productos.
						for (var i in respuesta.xml_info) {
							var inv = '<tr>\
							                <td>' + respuesta.xml_info[i]['no_identificacion'] + '</td>\
							                <td>' + respuesta.factura[0]['folio']+ '</td>\
							                <td>' + respuesta.xml_info[i]['unidad']  + '</td>\
							                <td>' + respuesta.xml_info[i]['descripcion']  + '</td>\
							                <td>' + respuesta.xml_info[i]['cantidad']  + '</td>\
							                <td>$ ' + respuesta.xml_info[i]['importe']  + '</td>\
							           </tr>';

							    $('#pendientes tr:last').after(inv); 
						}
					$('#mensajes').html('<div class="alert alert-success"> Su factura con folio '+ respuesta.factura[0]['folio'] +' se cargo con éxito!</div>'); 

 				}

 				if(respuesta.success == false){
 					$.each( respuesta.errors, function( key, value ) {
						$('#mensajes').html('<div class="alert alert-danger">'+ value +'</div>'); 
					});
 				}

 				if(respuesta.success == 'invalida'){
 					$('#mensajes').html('<div class="alert alert-danger">'+ respuesta.errors +'</div>'); 
 				}

			},
			statusCode: {
			    500: function() {
			      $('#mensajes').html('<div class="alert alert-danger">XML INVALIDO</div>'); 
			    }
			  }
		});
	});	


$('#rfc').change(function(){
	var select = $(this);
	var form = select.closest('form');// alert( form.attr('action') );
	$('#form_rfc').closest('form').submit();
});


/*
$('#rfc').change(function(){

	var id = $(this).val();
    if( id == 0 ){
        location.reload();
    }else{
        
	$('.factura').html('');
	$('.aprobados, .pendientes, .no_aprobados').html('');
		$.ajax({
			//url: window.location.protocol+'//'+window.location.host+'/pisaftp/public/filtro-rfc',
			url: window.location.protocol+'//'+window.location.host+'/pisaftp/public/filtro-rfc',
			type: 'POST',
			dataType: 'json',
			data: {'id' : id},
		    success: function(respuesta){
		    	var pisapesos = respuesta.pisapesos;
		    	var total = 0;
				$('#pisapesos').html(pisapesos);

		    	//$('#factura, #no_aprobados, #aprobados, #pendientes, #a_validar').DataTable();
			   	if(respuesta.facturas != null){
			   	//	console.log( respuesta.facturas );
					for (var j in respuesta.facturas) {
						total = parseInt(respuesta.facturas[j]['total']);
						var row = '<tr id="facturaRow' + respuesta.facturas[j]['id'] + '"' + 'class="factura">\
					                <td>' + respuesta.facturas[j]['folio']  + '</td>\
					                <td>$ ' + total  + '</td>\
					                <td>' + respuesta.facturas[j]['receptor']  + '</td>\
					                <td><a class="btn btn-primary" style="background: #2a91d6; margin-right: 3px;" href="'+  window.location.href.replace('/home', '') +'/factura_info/' + respuesta.facturas[j]['id']  + '/1' + '"><span class="glyphicon glyphicon-list"></span></a><a class="btn btn-primary" style="background: #2a91d6; margin-right: 3px;" href="'+  window.location.href.replace('/home', '') +'/factura_info/' + respuesta.facturas[j]['id']  + '/2' + '"><span class="glyphicon glyphicon-usd"></span></a>' + respuesta.facturas[j]['fecha']  + '</td>\
					               </tr>';
					             $('#factura tr:last').after(row);
					             /*   {{ App::make("url")->to('/')}}/factura_info/{{ respuesta.facturas[j]["id"] }}   */
				/*	}
				}

				if(respuesta.productos != null){
					//Se agregan los registros en la tabla de productos con estatus APROBADO.
					for (var i in respuesta.productos) {
						if( (typeof respuesta.productos[i]['estatus'] !== 'undefined') &&  (respuesta.productos[i]['estatus'] == 'APROBADO') ){
							// $('#aprobados').DataTable();
							var inv = '<tr class="aprobados">\
							                <td>' + respuesta.productos[i]['no_identificacion']  + '</td>\
							                <td>' + respuesta.productos[i]['folio_factura'] + '</td>\
							                <td>' + respuesta.productos[i]['unidad']  + '</td>\
							                <td>' + respuesta.productos[i]['descripcion']  + '</td>\
							                <td>' + respuesta.productos[i]['cantidad']  + '</td>\
							                <td>$ ' + respuesta.productos[i]['importe']  + '</td>\
							           </tr>';
							    $('#aprobados tr:last').after(inv); 
						}
					}
					//Se agregan los registros en la tabla de productos con estatus PENDIENTES.
					for (var i in respuesta.productos) {
						if( (typeof respuesta.productos[i]['estatus'] !== 'undefined') && (respuesta.productos[i]['estatus'] == 'PENDIENTE') ){
							var inv = '<tr class="pendientes">\
							                <td>' + respuesta.productos[i]['no_identificacion']  + '</td>\
							                <td>' + respuesta.productos[i]['folio_factura'] + '</td>\
							                <td>' + respuesta.productos[i]['unidad']  + '</td>\
							                <td>' + respuesta.productos[i]['descripcion']  + '</td>\
							                <td>' + respuesta.productos[i]['cantidad']  + '</td>\
							                <td>$ ' + respuesta.productos[i]['importe']  + '</td>\
							           </tr>';
							    $('#pendientes tr:last').after(inv); 
						}
					}
					//Se agregan los registros en la tabla de productos.
					for (var i in respuesta.productos) {
						if(  (typeof respuesta.productos[i]['estatus'] !== 'undefined') && (respuesta.productos[i]['estatus'] == 'NO APROBADO')  && (respuesta.productos[i]['estatus_cliente'] !== 'DESHABILITADO') ){
							var inv = '<tr class="no_aprobados">\
							                <td>' + respuesta.productos[i]['no_identificacion']  + '</td>\
							                <td>' + respuesta.productos[i]['folio_factura']+ '</td>\
							                <td>' + respuesta.productos[i]['unidad']  + '</td>\
							                <td>' + respuesta.productos[i]['descripcion']  + '</td>\
							                <td>' + respuesta.productos[i]['cantidad']  + '</td>\
							                <td>$ ' + respuesta.productos[i]['importe']  + '</td>\
							                <td>';


									if(respuesta.productos[i]['validacion'] !== "SI"){
										inv += '<a class="btn btn-primary" id="mail_modal" style="background: #2a91d6; margin-right: 3px;" data-toggle="modal" data-target="#mailModal" onclick="send_mail( ' +  respuesta.productos[i]['id'] + ' )">SOLICITAR REVISIÓN</a>';
									}else if(respuesta.productos[i]['validacion'] == "SI"){
										inv += '<a class="btn btn-success" id="mail_button"  style="margin-right: 3px;" name="mail_button" disabled>EN REVISIÓN...</a>';
									}                                              
		
							inv += '<a class="btn btn-danger" id="delete_modal" data-toggle="modal" data-target="#deleteModal" onclick="deshabilitar_registro( ' +  respuesta.productos[i]['id'] + ' )"><span class="glyphicon glyphicon-remove"></span></a></td>\
								</tr>';

							    
							$('#no_aprobados tr:last').after(inv); 
						}
					}

	 			}
		    }
		});
    }
});*/



	$('table .validar-producto').click(function(){
		var id = $(this).attr('data-id');
		var estatus = $(this).val();
			data = { 
				'id' : id,
				'estatus' : estatus 
			};
			
				$.ajax({
					//url: window.location.protocol+'//'+window.location.host+'/pisaftp/public/validacion-producto',
					url: window.location.protocol+'//'+window.location.host+'/pisaftp/public/validacion-producto',
					type: 'POST',
					dataType: 'json',
					data: data,
				    success: function(respuesta){

				    	console.log(respuesta);
				    	/*if(respuesta.success){
							location.reload();
						    $('#mensaje').html('<div class="alert alert-success">'+ respuesta.message +'</div>');
				    	}*/
				    } 				   
				});
		//aceptar_validacion(id);
		//$('#aceptar_validacion').attr('data-dismiss', "modal");
	});

//Busqueda de cliente
$("#buscar").on("input", function(){
	$.ajax({
		url: window.location.protocol+'//'+window.location.host+'/pisaftp/public/clientes',
		type: 'POST',
		dataType: 'json',
		cache: false,
		data: { key: $(this).val() }

		})
		.done(function( msg ) {
			var allsearch=msg;
	    	var extraclass="scrollsearch";
	    	var contenido="";
	    	console.log(allsearch);
	    	 if(allsearch.length>0){
                   $("#res-search").css("display","block");
                    if(allsearch.length>=5){
                        extraclass="scrollsearch";
                        $("#res-search").addClass(extraclass);
                    }else{
                        $("#res-search").removeClass(extraclass);
                    }
              
				for(var i=0; i<allsearch.length; i++ ){
					contenido+="<div data-value='"+allsearch[i].id+"' data-link='"+allsearch[i].name+"' class='cont-reg'><div class='labelSeccion'>"+allsearch[i].name+"</div></div>";
				}
			}else{
               $("#res-search").css("display","none");
           }

			$("#res-search").html(contenido);
			if($("#buscar").val()==""){
               $("#res-search").css("display","none");
            }

	    });

	     $("#buscar").html("");


	});

/*$("#reporte_general").click(function(){
	if( $(this).val() == ''){
		$('#mensajes').html('<div class="alert alert-danger">Nombre de cliente obligatorio.</div>');
	}
});*/



$(document).click(function() {
	if( $("#res-search").length) {
	    $("#res-search").hide();
	}
});

 $(document).on("click","#res-search > div", function(e){
 		$('#buscar').val($(this).attr("data-link"));
 		//alert($(this).attr("data-value"));
 		$('#cliente_id').val($(this).attr("data-value"));
});

});//ready document



function send_mail(product_id){
 $('#product_id').val(product_id);

	$('#enviar_mail').click(function(){
			product_id = $('#product_id').val();
			mensaje = $('#comentario').val();

			$.ajax({
				url: window.location.protocol+'//'+window.location.host+'/pisaftp/public/send_mail',
				type: 'POST',
				dataType: 'json',
				data: {'product_id' : product_id, 'mensaje' : mensaje},
				beforeSend: function(){
                    $('.before').append('<img align="center" src="./img/preloader/preloader.gif"/>');
                    $('#enviar_mail').attr('disabled', true);
                },
			    success: function(respuesta){
			    	if(respuesta == 1){
			    		$('.before').hide();
			    		$('#mail_modal').hide();
						location.reload(); 
					    alert("Mail enviado correctamente.");
			        }
			         
			    }
			});
		});
}

function deshabilitar_registro(id_registro){
		$('#id_registro').val(id_registro);

		$('#eliminar').click(function(){
			id_registro = $('#id_registro').val();

			$.ajax({
				url: window.location.protocol+'//'+window.location.host+'/pisaftp/public/eliminar',
				type: 'POST',
				dataType: 'json',
				data: {'id_registro' : id_registro},
				beforeSend: function(){
                    $('.before').append('<img align="center" src="./img/preloader/preloader.gif"/>');
                    $('#eliminar').attr('disabled', true);
                },
			    success: function(respuesta){
			    	if(respuesta){
			    		$('.before').hide();
						location.reload();
					    alert(respuesta.message);
			        } 
			    }
			});
		});
}

//Edición de registro en perfil Administrador.
function editar_registro(id_registro, descripcion){
	$('#id_registro').val(id_registro);
	$('#descripcion').val(descripcion);

	$('#editar').click(function(){
			id_registro = $('#id_registro').val();
			descripcion = $('#descripcion').val();

			$.ajax({
				url: window.location.protocol+'//'+window.location.host+'/pisaftp/public/editar',
				type: 'POST',
				dataType: 'json',
				data: {'id_registro' : id_registro, 'descripcion' :  descripcion},//SPECTRUM CEFALEXINA 75MG 20TBS
				beforeSend: function(){
                    $('.before').append('<img align="center" src="./img/preloader/preloader.gif"/>');
                    $('#editar').attr('disabled', true);
                },
			    success: function(respuesta){
			    	if( respuesta.success == 'true' ){
			    		$('.before').hide();
			    		$('#mensajes').html('');
						location.reload();
			        }

			        if( respuesta.success == 'false' ){
			        	$(".before").empty();
						$('#mensajes').html('<div class="alert alert-danger">'+ respuesta.errors +'</div>');
						$('#editar').attr('disabled', false);
			        } 
			    }
			});
		});

}
function cargar_datatable(){
	//Generic function,  Init DataTable library in each table, administrator and Client role.  
	var tablas = ['a_validar', 'table-factura', 'table-aprobados', 'table-pendientes', 'table-no-aprobados'];
	var busqueda = ['busqueda', 'busqueda_receptor', 'busqueda_aprobados', 'busqueda_pendientes', 'busqueda_no_aprobados'];
		for (var i = 0; i < tablas.length; i++) {
			
			var columnas = 3;
			if(tablas[i] == 'table-factura' && busqueda[i] == 'busqueda_receptor'){
				columnas = 2;
			}else if(tablas[i] == 'a_validar' && busqueda[i] == 'busqueda'){
				columnas = 4;
			}
	   	    //DataTable init for client role.
	   	    
	   	    if(tablas[i] == 'a_validar' ){
    			var datatable = $('.'+tablas[i]).DataTable({
    		         dom: 'lBfrtip',
    		         "iDisplayLength": 10,
    		         "aLengthMenu": [[10, 25, 50, 100], [10, 25, 50,100, "All"]]
    		    });
	   	    }else{
	   	    
    			var datatable = $('.'+tablas[i]).DataTable({
    		         dom: 'lBfrtip',
    		         "iDisplayLength": 5,
    		         "aLengthMenu": [[5, 10, 25, 50, 100], [5, 10, 25, 50,100, "All"]]
    		    });
	   	   
	   	    }
		     //hidden search button native of DataTable library
		    $('#a_validar_filter, #no_aprobados_filter, #aprobados_filter, #factura_filter, #pendientes_filter').hide();
			// Apply the search for description column. Client and Administrator role inside of tables.
		   	datatable.columns(columnas).every(function(){
		    	var that = this;
		        $( '#'+busqueda[i] ).on('keyup change', function () {
		            if ( that.search() !== this.value ) {
		                that
		                    .search( this.value )
		                    .draw();
		            }
		        });
		    });
	}
}

/*function cargar_datatable(){
	//Generic function,  Init DataTable library in each table, administrator and Client role.  
	var tablas = ['a_validar', 'table-factura', 'table-aprobados', 'table-pendientes', 'table-no-aprobados'];
	var busqueda = ['busqueda', 'busqueda_receptor', 'busqueda_aprobados', 'busqueda_pendientes', 'busqueda_no_aprobados'];
		for (var i = 0; i < tablas.length; i++) {
			
			var columnas = 3;
			if(tablas[i] == 'table-factura' && busqueda[i] == 'busqueda_receptor'){
				columnas = 2;
			}else if(tablas[i] == 'a_validar' && busqueda[i] == 'busqueda'){
				columnas = 4;
			}
	   	    //DataTable init for client role.
			var datatable = $('.'+tablas[i]).DataTable({
		         dom: 'lBfrtip',
		         "iDisplayLength": 5,
		         "aLengthMenu": [[5, 10, 25, 50, 100], [5, 10, 25, 50,100, "All"]],
		         buttons: ['excel', 'pdf']
		    });

		     //hidden search button native of DataTable library
		    $('#a_validar_filter, #no_aprobados_filter, #aprobados_filter, #factura_filter, #pendientes_filter').hide();
			// Apply the search for description column. Client and Administrator role inside of tables.
		   	datatable.columns(columnas).every(function(){
		    	var that = this;
		        $( '#'+busqueda[i] ).on('keyup change', function () {
		            if ( that.search() !== this.value ) {
		                that
		                    .search( this.value )
		                    .draw();
		            }
		        });
		    });
	}
}*/

//Show file route path.
$('#factura-xml').change(function(e) {
    // Obtenemos la ruta temporal mediante el evento
    var TmpPath = e.target.files[0]['name'];
    // Mostramos la ruta temporal
    $('#path').html(TmpPath);
});


cropLetter=function(text, end){
    var x;
    for(x=end; x<text.length;x++){
       // console.log()
        if (text.charAt(x) === ' ') {
            break;
        }/////end if
    }

    return text.substring(0, x)+"...";
}/////end corp



