$(buscarCurso());

function buscarCurso(curso){
	
	$.ajax({
		url: 'skHome.php',
		type: 'POST',
		dataType: 'html',
		data: { curso: curso }, 
	})
	.done(function(respuesta){
		$("#cursos").html(respuesta)
	})
	.fail(function(){
            alert('Error al cargar el formulario');
            console.log("error");
	})
}

$('#btnSkCurso').on('click', function(){
	busqueda = $('#edSkCurso').val();
    buscarCurso(busqueda);
});

