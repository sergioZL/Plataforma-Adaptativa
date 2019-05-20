/*-- Buscar la forma a presentar --*/
function buscar_datos(consulta){
	$.ajax({
		url: 'formas.php',
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

function buscarCurso(consulta){
	$.ajax({
		url: 'skCurso.php',
		type: 'POST',
		dataType: 'html',
		data: { curso: curso }, 
	})
	.done(function(respuesta){
		$("#formularios").html(respuesta)
	})
	.fail(function(){
            alert('Error al cargar el formulario');
            console.log("error");
	})
}

$('#lecciones').on('click', function(){
    buscar_datos('lecciones');
});

$('#temas').on('click', function(){
    buscar_datos('temas');
});

$('#evaluacion').on('click', function(){
    buscar_datos('evaluacion');
});

$('#curso').on('click', function(){
    buscar_datos('curso');
});

$('#preguntas').on('click', function(){
    buscar_datos('preguntas');
});

$('#recursos').on('click', function(){
    buscar_datos('recursos');
});

$('#btnSkCurso').on('click'), function(){
	curso = $('#edSkCurso').val();
	buscarCurso(curso);
}