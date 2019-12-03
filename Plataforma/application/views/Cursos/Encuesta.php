<?php
    error_reporting(0);
    session_start();
    $varsesion = $_SESSION['usuario'];
    if($varsesion == null|| $varsesion == '')
    {
        header("location:../../../index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="<?php echo base_url();?>app-assets/js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>app-assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>app-assets/css/estilos.css">

    <!--iconos-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">    
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.6.3/css/all.css' integrity='sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/' crossorigin='anonymous'>                            
   
    <style>
        hr.style2 {
	        border-top: 10px double #8c8b8b;
        }
    </style>

    <title>Estilo de aprendizaje</title>
</head>
<body>
    <div class="container m-5">
        <h3 class="font-weight-bold ">TEST ESTILO DE APRENDIZAJE</h3>
        <hr class="style2">
        <br>
        <div class="alert alert-primary" role="alert">
            <strong>Bienvenido!</strong> completa este test de estilo aprendizaje para comenzar
        </div>
        <br>
            <!-- recibe las preguntas por medio de html set -->
        <div id="contenedroPreguntas" class="row">
        
        </div>
        <br>
        <center><button type="button" id="anterior" class="btn btn-primary" onclick="cargarPreguntas(-10)">Anterior</button> <button type="button" id="sigiente" class="btn btn-primary" onclick="cargarPreguntas(10)">Sigiente</button></center>
        <br>
        <center><button type="button" id="Evaluar" class="btn btn-primary d-none">Enviar</button></center>
    </div>
    <script>
        let totalPreguntas = 0;
        let inicio     = 0;
        let preguntas;
        $.getJSON("<?php echo base_url();?>app-assets/js/preguntas.json",
            function (data) {
                preguntas = data;
                cargarPreguntas(inicio);
            }
        );
        function cargarPreguntas(init){

            actualizarAvance();

            let preguntass = '';
                inicio = inicio+init;

            if( inicio < 40 && inicio > -1 ){
                for (let index = inicio; index < (inicio+10); index++) {
                    const element = preguntas[index];
                    let a = '';
                    let b = '';
                    let c = '';
                    if(element.A.isCheked) a = 'checked';
                    if(element.B.isCheked) b = 'checked';
                    if(element.C.isCheked) c = 'checked';
                    preguntass +='<div id="pregresp" class="pregresp col-sm-10">'+
                                    '<br>'+
                                    '<div id="pregunta" class="pregunta">'+
                                        element.numero+'. '+element.enunciado+
                                    '</div>'+
                                    '<div id="respuestas" numero="'+index+'" class="respuestas">'+
                                        '<input insiso="a" id="resp" type="radio" name="resp'+element.numero+'" value="'+element.A.estilo+'" '+`${a}`+' > a) '+element.A.enunciado+'<br>'+
                                        '<input insiso="b" id="resp" type="radio" name="resp'+element.numero+'" value="'+element.B.estilo+'" '+`${b}`+'> b) '+element.B.enunciado+'<br>'+
                                        '<input insiso="c" id="resp" type="radio" name="resp'+element.numero+'" value="'+element.C.estilo+'" '+`${c}`+'> c) '+element.C.enunciado+'<br>'+
                                    '</div>'+
                                '</div>';
                }
                $('#contenedroPreguntas').html(preguntass);
                if(inicio == 30){ 
                    $('#Evaluar').removeClass('d-none');
                    $('#sigiente').addClass('d-none');
                } else {
                    $('#sigiente').removeClass('d-none');
                    $('#Evaluar').addClass('d-none');
                }

                if(inicio == 0){ 
                    $('#anterior').addClass('d-none');
                } else {
                    $('#anterior').removeClass('d-none');
                }

            }else alert('ya no hay mas preguntas');
            document.querySelector('#contenedroPreguntas').scrollIntoView();
        }
        var usuario = '<?php echo $varsesion; ?>';
        var visual = 0;
        var auditivo = 0;
        var cinestesico = 0;
        $('#Evaluar').click(function(){
            actualizarAvance();
            preguntas.forEach(element => {
                let valor = ''
                console.log(element.A.isCheked);
                if(element.A.isCheked){
                    valor = element.A.estilo;
                }else if(element.B.isCheked){
                    valor = element.B.estilo;
                }else if(element.C.isCheked){
                    valor = element.C.estilo;
                }
                switch (valor) {
                    case "AUDITIVO":
                        auditivo++;
                        totalPreguntas++;
                        break;
                    case "VISUAL":
                        visual++;
                        totalPreguntas++;
                        break;
                    case "CINESTÉSICO":
                        cinestesico++;
                        totalPreguntas++;
                        break;
                    default:
                        break;
                }
            });
            visual      = (visual * 100)/40;
            auditivo    = (auditivo * 100)/40;
            cinestesico = (cinestesico * 100)/40;
            console.log(totalPreguntas);
            if(totalPreguntas == 40){
            $.ajax({
                type: "post",
                url: "<?php echo site_url('Cursos/EncuestaController/actualizarEstilo'); ?>",
                data: {alumno:usuario,eavisual:visual,eaauditivo:auditivo,eacinestesico:cinestesico},
                success: function (response) {
                    console.log(response);
                    window.location.replace("<?php echo site_url('alumno/MisCursos'); ?>");
                }
            });
            }else{
                alert('¡ups dejaste algunas preguntas sin contestar!');

                visual      = 0;
                auditivo    = 0; 
                cinestesico = 0; 

            }
            totalPreguntas = 0;
            console.log("visual "+visual+'%');
            console.log("auditivo "+auditivo+'%');
            console.log("cinestesico "+cinestesico+'%');
        });
        function actualizarAvance(){
            $("#contenedroPreguntas #pregresp").each(function(){
                $(this).find('#respuestas').each(function(){
                    let numero = $(this).attr('numero');
                    $(this).find('#resp:checked').each(function(){
                        let insiso = $(this).attr('insiso');
                        switch (insiso) {
                            case 'a':
                                preguntas[numero].A.isCheked = true;
                                preguntas[numero].B.isCheked = false;
                                preguntas[numero].C.isCheked = false;
                                break;
                            case 'b':
                                preguntas[numero].A.isCheked = false;
                                preguntas[numero].B.isCheked = true
                                preguntas[numero].C.isCheked = false;
                                break;
                            case 'c':
                                preguntas[numero].A.isCheked = false;
                                preguntas[numero].B.isCheked = false
                                preguntas[numero].C.isCheked = true;
                                break;
                        }
                    });
                });
            });
        }
    </script>
</body>
</html>