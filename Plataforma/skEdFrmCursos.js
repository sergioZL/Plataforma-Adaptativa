/*-- Buscar la forma a presentar --*/
function buscar_datos(consulta){
	$.ajax({
		url: 'skEdFrmCursos.php',
		type: 'POST',
		dataType: 'html',
		data: { consulta: consulta }, 
	})
	.done(function(respuesta){
		$("#formularios").html(respuesta)
	})
	.fail(function(){
            alert('Error al cargar el formulario');
            console.log("error");
	})
}

function verLista(Lecciones, clave){
	var parametros = {
                "fecha1" : Lecciones,
                "fecha2" : clave
        };
    $.ajax({
		url: 'skRepFinanzas.php',
		type: 'POST',
		data: parametros
	})
	.done(function(respuesta){
		$("#datos").html(respuesta)
	})
	.fail(function(){
            alert('Error al cargar Finanzas');
            console.log("error");
	})
}