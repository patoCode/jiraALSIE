/*
alsiemodulo4
mail: denis_design@live.cl
pass:
http://localhost
*/
$(document).ready(function($) {
	$('.modal').modal();

	$(".btnbtn").on('click', function(event) {
		event.preventDefault();
		var issue_key = $(this).attr("data-id");
		var horas = $("input[name='horas"+issue_key+"']").val();
		var minutos = $("input[name='minutos"+issue_key+"']").val();
		$.ajax({
			url: 'php/jiraissue.php',
			data: {"horas" : horas, "min" : minutos,"id":issue_key},
			type: "POST",
			dataType: "json",
			success: function(respuesta) {
				if(respuesta.result === 1){
					$("#mensaje_rest_ok").text("");
					$("#mensaje_rest_ok").text(respuesta.mensajes);
					$("#modalOK").modal('open');
				}else{
					$("#mensaje_rest").text("");
					$("#mensaje_rest").text(respuesta.mensajes);
					$("#modalNOK").modal('open');
				}
			},
			error: function() {
		        console.log("No se ha podido obtener la información");
		    }
		});
	});


});

