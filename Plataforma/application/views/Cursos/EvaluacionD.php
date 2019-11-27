
<?php 

/**
 * Se creo este archivo para hacer pruebas y corregir errores encontrados en evaluacion 
 */

error_reporting(0);
session_start();
$varsesion = $_SESSION['usuario'];
$tipo = $_GET['tipo'];

if($varsesion == null|| $varsesion == '')
{
    header("location:../../../index.php");
}/*.site_url('alumno/MisCursos') */
if($curso =$_GET['curso'] == "")
{
    header('location:'.site_url('alumno/MisCursos'));   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluacion</title>
    
    <script src="<?php echo base_url();?>app-assets/js/jquery-3.3.1.min.js"></script>
    <!--estilos bootstrap-->
    <link rel="stylesheet" href="<?php echo base_url();?>app-assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>app-assets/css/estilos.css">   
    <!--iconos-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">    
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' crossorigin='anonymous'>                            
    <style>
        .pregresp 
        {
            border: 1px solid #7DA5E0;
            padding: 10px;
            margin: 10px;
            font-family: Arial, Verdana, Helvetica, sans-serif;
            font-size: 15px;
            font-weight: bold;
        }

        .pregunta 
        {
            color: #7DA5E0;
        }

        .respuestas 
        {
            color: #000000;
        }

        .fa-times
        {
            color: red;
        }

        .fa-check
        {
            color: greenyellow;
        }

        .imgresp
        {
            height: 50px;
            width:50px;
        }

    </style>
    <script defer src="https://use.fontawesome.com/releases/v5.11.2/js/all.js"></script> 
</head>
<body>
    <?php
        $this->load->view('Cursos/Nav');
    ?>
    <br><br>

    <div class="container">

    <table id="table" class="table  table-bordered">
        <tbody id="idTable">
            <tr>
                <td style="width:70px"><b>Evaluacion</b></td>
                <td id="tevaluacion" colspan="3"><?php echo $tipo; ?></td>
            </tr>
            <tr>
                <td  style="width:70px"><b>Alumno</b></td>
                <td id="nombreUsuario" colspan="3"><?php echo $varsesion ?></td>
            </tr>
        </tbody>
    </table>
    <center id="botonIr"></center>
    <br>
    <div id="contenedroPreguntas">
            
    </div>
    <br>
    <center><button type="button" id="Evaluar" class="btn btn-primary">Enviar</button></center>
    <br><br>
    

    <script>
        let preguntas;
        $(document).ready(function () {
            //optiene la clave de usuario actual
            let usuario = '<?php echo $varsesion; ?>';
        
            /**
            * Optiene los datos de alumno relacionados con este usuario
            */
            $.get( '<?php echo site_url();?>/Cursos/EncuestaController/obtenerAlumno', { varusuario: usuario} )
            .done(function( data ) {
                let obj = JSON.parse( data );// convierte los datos optenidos a un objeto de tipo json
                actualizarHeader(obj);
                
            });
            cargarPreguntas();
        });

        function actualizarHeader(data){
            $('#userName').html('<br>'+data.nombre+' '+data.app); // Coloca el nombre de usuario y apellido paterno en el navbar
            
            let inN = data.nombre.split( "", 1 );
            let inA = data.app.split( "", 1 );
            $('#inicial').html(inN+inA);
            $('#nombreUsuario').html(data.nombre+' '+data.app);
        }
        let cargarPreguntas = () => {
            $.get("<?php echo site_url();?>/Cursos/EvaluacionDController/CargarPreguntas", {Curso: '<?php echo $_GET['curso'];?>'}, (data) => {
                
                    preguntas = JSON.parse(data);
                    
                    mostrarPreguntas(preguntas);
                }
            );
        }
        let mostrarPreguntas = ( preguntas ) => {
            
            let i = 0;

            for ( const pregunta of preguntas ) {
                let imagen = '';
					if (pregunta.imagen != null) {
						let imagen = '<a data-toggle="modal" data-target="#modalPregunta"><img style="width: 200px; height:200px;" src="data:image/jpg;base64,'+pregunta.imagen+'"/></a>';
					}
                i++;
              $('#contenedroPreguntas').append('<div id="pregresp" class="pregresp">'+
			        			'<div id="pregunta" class="pregunta">'+i+'. '+pregunta.enunciado+'<br/></div>'+
			        			''+imagen+''+
			        			'<input id="Npregunta" type="hidden" value="'+pregunta.id+'">'+
			        			'<div id="respuestas'+pregunta.id+'" class="respuestas">');
                let tipo = 'checkbox';
                for (const opcion of pregunta.opciones) {
                    if(opcion.porcentaje === '100') tipo = 'radio';
                }
                let eschecado = '';
                let j = 0;
                
                for ( const opcion of pregunta.opciones ) {
                    if(opcion.checked) eschecado = 'checked';
                    if(opcion.imagen) $('#respuestas'+pregunta.id+'').append( '<div>'+
                                                                              `<input id="resp" type="${ tipo }" name="preg${pregunta.id}" value="${opcion.id_opciones}" onclick="checado( ${i-1}, ${j}, '${ tipo }' );">`+
                                                                              `<label data-toggle="modal" data-target="#modalPregunta"><img class="imgresp" src="data:image/jpg;base64,${opcion.imagen}" /></label></div><br>`);
                    else $('#respuestas'+pregunta.id+'').append(`<input id="resp" type="${ tipo }" name="preg${pregunta.id}" value="${opcion.id_opciones}" onclick="checado( ${i-1}, ${j}, '${ tipo }' ); ${ eschecado }"/> ${opcion.enunciado}<br/>`);
                 j++;
                }

            }
        }
        
        let checado = ( idxPregunta, idxOpcion , tipo ) => {
            for (let index = 0; index < preguntas[idxPregunta].opciones.length; index++) {
                if(index === idxOpcion || ( preguntas[idxPregunta].opciones[index].checked === true && tipo === 'checkbox' )) preguntas[idxPregunta].opciones[index].checked = true;
                    else preguntas[idxPregunta].opciones[index].checked = false;
            }
        }
        $('#Evaluar').click(function (e) { 
            e.preventDefault();
            $('#contenedroPreguntas').html('');
            let respuestas = [];  
            let total = 0;
            let aciertos = 0;          
            preguntas.forEach( ( pregunta, index) =>{
                
                let imagen = '';
					if (pregunta.imagen != null) {
						let imagen = `<a data-toggle="modal" data-target="#modalPregunta"><img style="width: 200px; height:200px;" src="data:image/jpg;base64,${pregunta.imagen}"/></a>`;
					} 
                $('#contenedroPreguntas').append('<div id="pregresp" class="pregresp">'+
			        			`<div id="pregunta" class="pregunta">${index + 1}.- ${pregunta.enunciado}<br/></div>`+
			        			`${imagen}`+
			        			`<input id="Npregunta" type="hidden" value="${pregunta.id}">`+
			        			`<div id="respuestas${pregunta.id}" class="respuestas">`);
                let tipo = 'checkbox';
                pregunta.opciones.forEach( ( opcion) => {
                    if(opcion.porcentaje === '100') tipo = 'radio';
                });
                let porcentaje = 0;                
                pregunta.opciones.forEach( ( opcion, j) => { 
                                       
                    let eschecado = '';
                    let icono   = '';
                    if((opcion.checked || false)){
                        eschecado = 'checked';
                        respuestas.push({
                            idPregunta: pregunta.id,
                            opcion: opcion.id_opciones
                        });
                        if( opcion.porcentaje != '0' ) {
                            porcentaje += parseInt( opcion.porcentaje, 10);
                            icono = '<i class="fas fa-check"></i>';
                        } else icono = '<i class="fas fa-times"></i>';
                    } else {
                        if( opcion.porcentaje != '0' ) icono = '<i class="fas fa-check"></i>';
                    }
                    if(opcion.imagen) $(`#respuestas${ pregunta.id }`).append( '<div>'+
                                                                              `<input id="resp" type="${ tipo }" name="preg${ pregunta.id }" value="${ opcion.id_opciones }" onclick="checado( ${ index + 1}, ${ j }, '${ tipo }' );" ${ eschecado }>`+
                                                                              `<label data-toggle="modal" data-target="#modalPregunta"> ${ icono } <img class="imgresp" src="data:image/jpg;base64,${opcion.imagen}" /></label></div><br>`);
                    else $('#respuestas'+pregunta.id+'').append(`<input id="resp" type="${ tipo }" name="preg${pregunta.id}" value="${opcion.id_opciones}" onclick="checado( ${index + 1}, ${j}, '${ tipo }' );" ${ eschecado }/>${ icono } ${ opcion.enunciado }<br/>`);
                    
                });
                aciertos += (porcentaje / 100);
                total = index;
            });
            total++;
            console.log(aciertos);
            let calificacion = ( aciertos * 10 ) / total;
            
            $('#idTable').append(`<tr>
                                    <td  style="width:70px"><b>Aciertos</b></td>
                                    <td>${ aciertos }</td>
                                    <td  style="width:70px"><b>Calificacion</b></td>
                                    <td>${ calificacion }</td>
                                 </tr>`);
            $('#Evaluar').addClass('d-none');
            $('#botonIr').html(`<button type="button" onclick="Terminar()" class="btn btn-primary">Terminar</button>`);
            $.ajax({
                type: "post",
                url: "<?php echo site_url();?>/Cursos/EvaluacionDController/Evaluar",
                data: { IdCurso:'<?php echo $_GET['curso']; ?>', id_alumno: '<?php echo $varsesion; ?>', TipoEvaluacion: '<?php echo $tipo; ?>', Respuestas:respuestas},
                success: function (response) {
                    console.log(response); 
                    
                }
            });

        });
        function Terminar() { 
            console.log('que pedo');
            window.location.href='Temario?curso=<?php echo $_GET['curso']; ?>';
        };
    </script>
</body>
</html>