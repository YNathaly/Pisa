$.ajax({
		url: '/public/imprimir-reporte',
		global: false,
		type: 'POST',
		//dataType: 'json',
		data: data,
	    }).done(function (data, textStatus, jqXHR) {
            var nombreLogico = "PISA_REPORTE";

            //alert( "'data:application/pdf," + escape(data) + "'" );
            //var parametros = "dependent=yes,locationbar=no,scrollbars=yes,menubar=yes,resizable,screenX=50,screenY=50,width=850,height=1050";
            var htmlText = "<embed width=100% height=100% type='application/pdf' http-equiv='Content-Type' content='text/html; charset=utf-8' src='data:application/pdf," + escape(data) + "'></embed>";
            var detailWindow = window.open();
			
			/*var detailWindow = window.open("", nombreLogico, parametros);
            var detailWindow = window.open("data:application/pdf," + escape(data)); */

            detailWindow.document.write();
            detailWindow.document.close();
    }).fail(function (jqXHR, textStatus, errorThrown) {
        alert("error\njqXHR=" + jqXHR + "\nstatus=" + textStatus + "\nerror=" + errorThrown);
    }).always(function(dataORjqXHR, textStatus, jqXHR_ORerrorThrown) {
        //alert( "complete" );
    });









//Funcional
    $('.imprimir_reporte').click(function(){
 		//e.preventDefault();

		var estatus = $('#daterange').val();
		var id = $('#estatus_reporte').val();

		data = {
			'estatus' : estatus,
			'id' : id
		};
		//$(this).attr('href', $(this).attr('href')+'?estatus='+estatus+'&id='+id);
			$.ajax({
					url: '/public/imprimir-reporte',
					global: false,
					type: 'POST',
					//dataType: 'json',
					data: data,
		    }).done(function (data, textStatus, jqXHR) {
                var nombreLogico = "PISA_REPORTE";

                //alert( "'data:application/pdf," + escape(data) + "'" );
                //var parametros = "dependent=yes,locationbar=no,scrollbars=yes,menubar=yes,resizable,screenX=50,screenY=50,width=850,height=1050";
                var htmlText = "<embed width=100% height=100% type='application/pdf' http-equiv='Content-Type' content='text/html; charset=utf-8'src='data:application/pdf," + escape(data) + "'></embed>";
				//var detailWindow = window.open("", nombreLogico, parametros);
                var detailWindow = window.open();
                detailWindow.document.write(htmlText);
                detailWindow.document.close();
	        }).fail(function (jqXHR, textStatus, errorThrown) {
	            alert("error\njqXHR=" + jqXHR + "\nstatus=" + textStatus + "\nerror=" + errorThrown);
	        }).always(function(dataORjqXHR, textStatus, jqXHR_ORerrorThrown) {
	            //alert( "complete" );
	        });
		
			
});