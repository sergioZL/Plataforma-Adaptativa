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

    <title>Document</title>
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
        <div id="contenedroPreguntas" class="row">
                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    1. ¿Cuál de las siguientes actividades disfrutas más?
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp2" value="AUDITIVO">a) Escuchar música<br>
                        <input id="resp" type="radio" name="resp2" value="VISUAL">b) Ver películas<br>
                        <input id="resp" type="radio" name="resp2" value="CINESTÉSICO">c) Bailar con buena música<br>
                    </div>
                </div>
                
                <br>

                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    2. ¿Qué programa de televisión prefieres?
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp" value="VISUAL">    a) Reportajes de descubrimientos y lugares<br>
                        <input id="resp" type="radio" name="resp" value="CINESTÉSICO">      b) Cómico y de entretenimiento<br>
                        <input id="resp" type="radio" name="resp" value="AUDITIVO"> c) Noticias del mundo<br>
                    </div>
                </div>

                <br>

                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    3. Cuando conversas con otra persona, tú:
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp3" value="AUDITIVO">    a) La escuchas atentamente<br>
                        <input id="resp" type="radio" name="resp3" value="VISUAL">b) La observas<br>
                        <input id="resp" type="radio" name="resp3" value="CINESTÉSICO"> c) Tiendes a tocarla<br>
                    </div>
                </div>
                
                <br>

                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    4. Si pudieras adquirir uno de los siguientes artículos, ¿cuál
                    elegirías?  
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp4" value="CINESTÉSICO">   a) Un jacuzzi    <br>
                        <input id="resp" type="radio" name="resp4" value="AUDITIVO">     b) Un estéreo    <br>
                        <input id="resp" type="radio" name="resp4" value="VISUAL">c) Un televisor <br>
                    </div>
                </div>

                <br>

                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                      5. ¿Qué prefieres hacer un sábado por la tarde?   
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp5" value="CINESTÉSICO"> a) Quedarte en casa   <br>
                        <input id="resp" type="radio" name="resp5" value="AUDITIVO">    b) Ir a un concierto  <br>
                        <input id="resp" type="radio" name="resp5" value="VISUAL">      c) Ir al cine        <br>
                    </div>
                </div>
                <br>
                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    6. ¿Qué tipo de exámenes se te facilitan más?   
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp6" value="AUDITIVO"> a) Examen oral               <br>
                        <input id="resp" type="radio" name="resp6" value="VISUAL">    b) Examen escrito            <br>
                        <input id="resp" type="radio" name="resp6" value="CINESTÉSICO">      c) Examen de opción múltiple<br>
                    </div>
                </div>
                <br>
                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    7. ¿Cómo te orientas más fácilmente?
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp7" value="VISUAL">   a) Mediante el uso de un mapa  <br>
                        <input id="resp" type="radio" name="resp7" value="AUDITIVO">     b) Pidiendo indicaciones       <br>
                        <input id="resp" type="radio" name="resp7" value="CINESTÉSICO">c) A través de la intuición   <br>
                    </div>
                </div>
                <br>
                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    8. ¿En qué prefieres ocupar tu tiempo en un lugar de descanso?
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp8" value="AUDITIVO">     a) Pensar                        <br>
                        <input id="resp" type="radio" name="resp8" value="VISUAL">   b) Caminar por los alrededores   <br>
                        <input id="resp" type="radio" name="resp8" value="CINESTÉSICO">c) Descansar                    <br>
                    </div>
                </div>
                <br>
                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    9. ¿Qué te halaga más?
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp9" value="VISUAL">     a) Que te digan que tienes buen aspecto                    <br>
                        <input id="resp" type="radio" name="resp9" value="CINESTÉSICO">       b) Que te digan que tienes un trato muy agradable          <br>
                        <input id="resp" type="radio" name="resp9" value="AUDITIVO">  c) Que te digan que tienes una conversación interesante   <br>
                    </div>
                </div>
                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    10. ¿Cuál de estos ambientes te atrae más?          
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp10" value="CINESTÉSICO">     a) Uno en el que se sienta un clima agradable   <br>
                        <input id="resp" type="radio" name="resp10" value="AUDITIVO">b) Uno en el que se escuchen las olas del mar   <br>
                        <input id="resp" type="radio" name="resp10" value="VISUAL">   c) Uno con una hermosa vista al océano         <br>
                    </div>
                </div>
                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    11. ¿De qué manera se te facilita aprender algo?         
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp11" value="AUDITIVO"> a) Repitiendo en voz alta              <br>
                        <input id="resp" type="radio" name="resp11" value="VISUAL">    b) Escribiéndolo varias veces          <br>
                        <input id="resp" type="radio" name="resp11" value="CINESTÉSICO">      c) Relacionándolo con algo divertido  <br>
                    </div>
                </div>
                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    12. ¿A qué evento preferirías asistir?  
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp12" value="CINESTÉSICO">   a) A una reunión social       <br>
                        <input id="resp" type="radio" name="resp12" value="VISUAL">     b) A una exposición de arte   <br>
                        <input id="resp" type="radio" name="resp12" value="AUDITIVO">c) A una conferencia         <br>
                    </div>
                </div>
                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    13. ¿De qué manera te formas una opinión de otras personas?    
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp13" value="AUDITIVO">a) Por la sinceridad en su voz              <br>
                        <input id="resp" type="radio" name="resp13" value="CINESTÉSICO">     b) Por la forma de estrecharte la mano   <br>
                        <input id="resp" type="radio" name="resp13" value="VISUAL">   c) Por su aspecto                       <br>
                    </div>
                </div>
                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    14. ¿Cómo te consideras?       
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp14" value="VISUAL">   a) Atlético   <br>
                        <input id="resp" type="radio" name="resp14" value="AUDITIVO">b) Intelectual  <br>
                        <input id="resp" type="radio" name="resp14" value="CINESTÉSICO">     c) Sociable   <br>
                    </div>
                </div>
                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    15. ¿Qué tipo de películas te gustan más?       
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp15" value="AUDITIVO">     a) Clásicas <br>
                        <input id="resp" type="radio" name="resp15" value="VISUAL">   b) De acción  <br>
                        <input id="resp" type="radio" name="resp15" value="CINESTÉSICO">c) De amor  <br>
                    </div>
                </div>
                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    16. ¿Cómo prefieres mantenerte en contacto con otra persona?
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp16" value="VISUAL">   a) por correo electrónico<br>
                        <input id="resp" type="radio" name="resp16" value="CINESTÉSICO">     b) Tomando un café juntos  <br>
                        <input id="resp" type="radio" name="resp16" value="AUDITIVO">c) Por teléfono          <br>
                    </div>
                </div>
                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    17. ¿Cuál de las siguientes frases se identifican más contigo?
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp17" value="CINESTÉSICO">      a) Me gusta que mi coche se sienta bien al conducirlo           <br>
                        <input id="resp" type="radio" name="resp17" value="AUDITIVO"> b) Percibo hasta el mas ligero ruido que hace mi coche            <br>
                        <input id="resp" type="radio" name="resp17" value="VISUAL">    c) Es importante que mi coche esté limpio por fuera y por dentro<br>
                    </div>
                </div>
                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    18. ¿Cómo prefieres pasar el tiempo con tu novia o novio?    

                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp18" value="AUDITIVO">a) Conversando        <br>
                        <input id="resp" type="radio" name="resp18" value="CINESTÉSICO">   b) Acariciándose        <br>
                        <input id="resp" type="radio" name="resp18" value="VISUAL">     c) Mirando algo juntos<br>
                    </div>
                </div>
                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    19. Si no encuentras las llaves en una bolsa
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp19" value="VISUAL">   a) La buscas mirando                 <br>
                        <input id="resp" type="radio" name="resp19" value="AUDITIVO">b) Sacudes la bolsa para oír el ruido  <br>
                        <input id="resp" type="radio" name="resp19" value="CINESTÉSICO">     c) Buscas al tacto                   <br>
                    </div>
                </div>
                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    20. Cuando tratas de recordar algo, ¿cómo lo haces?
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp20" value="VISUAL">     a) A través de imágenes <br>
                        <input id="resp" type="radio" name="resp20" value="CINESTÉSICO">   b) A través de emociones  <br>
                        <input id="resp" type="radio" name="resp20" value="AUDITIVO">c) A través de sonidos  <br>
                    </div>
                </div>
                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    21. Si tuvieras dinero, ¿qué harías?  
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp21" value="CINESTÉSICO">     a) Comprar una casa                <br>
                        <input id="resp" type="radio" name="resp21" value="VISUAL">b) Viajar y conocer el mundo         <br>
                        <input id="resp" type="radio" name="resp21" value="AUDITIVO">   c) Adquirir un estudio de grabación<br>
                    </div>
                </div>
                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    22. ¿Con qué frase te identificas más?
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp22" value="AUDITIVO">a) Reconozco a las personas por su voz              <br>
                        <input id="resp" type="radio" name="resp22" value="CINESTÉSICO">     b) No recuerdo el aspecto de la gente                 <br>
                        <input id="resp" type="radio" name="resp22" value="VISUAL">   c) Recuerdo el aspecto de alguien, pero no su nombre<br>
                    </div>
                </div>
                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    23. Si tuvieras que quedarte en una isla desierta, ¿qué
                        preferirías llevar contigo?  
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp23" value="VISUAL">   a) Algunos buenos libros               <br>
                        <input id="resp" type="radio" name="resp23" value="AUDITIVO">b) Un radio portátil de alta frecuencia  <br>
                        <input id="resp" type="radio" name="resp23" value="CINESTÉSICO">     c) Golosinas y comida enlatada         <br>
                    </div>
                </div>
                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    24. ¿Cuál de los siguientes entretenimientos prefieres?    
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp24" value="AUDITIVO">     a) Tocar un instrumento musical<br>
                        <input id="resp" type="radio" name="resp24" value="VISUAL">   b) Sacar fotografías             <br>
                        <input id="resp" type="radio" name="resp24" value="CINESTÉSICO">c) Actividades manuales        <br>
                    </div>
                </div>
                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    25. ¿Cómo es tu forma de vestir?  
    
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp25" value="VISUAL">   a) Impecable   <br>
                        <input id="resp" type="radio" name="resp25" value="AUDITIVO">     b) Informal      <br>
                        <input id="resp" type="radio" name="resp25" value="CINESTÉSICO">c) Muy informal<br>
                    </div>
                </div>
                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    26. ¿Qué es lo que más te gusta de una fogata nocturna?  
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp26" value="CINESTÉSICO">     a) El calor del fuego y los bombones asados <br>
                        <input id="resp" type="radio" name="resp26" value="AUDITIVO">   b) El sonido del fuego quemando la leña        <br>
                        <input id="resp" type="radio" name="resp26" value="VISUAL">c) Mirar el fuego y las estrellas          <br>
                    </div>
                </div>
                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    27. ¿Cómo se te facilita entender algo? 
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp27" value="AUDITIVO">a) Cuando te lo explican verbalmente              <br>
                        <input id="resp" type="radio" name="resp27" value="VISUAL">   b) Cuando utilizan medios visuales               <br>
                        <input id="resp" type="radio" name="resp27" value="CINESTÉSICO">     c) Cuando se realiza a través de alguna actividad<br>
                    </div>
                </div>
                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    28. ¿Por qué te distingues?   
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp28" value="CINESTÉSICO">a) Por tener una gran intuición <br>
                        <input id="resp" type="radio" name="resp28" value="AUDITIVO">   b) Por ser un buen conversador <br>
                        <input id="resp" type="radio" name="resp28" value="VISUAL">     c) Por ser un buen observador  <br>
                    </div>
                </div>
                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    29. ¿Qué es lo que más disfrutas de un amanecer?     
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp29" value="CINESTÉSICO">a) La emoción de vivir un nuevo día <br>
                        <input id="resp" type="radio" name="resp29" value="VISUAL">   b) Las tonalidades del cielo       <br>
                        <input id="resp" type="radio" name="resp29" value="AUDITIVO">     c) El canto de las aves            <br>
                    </div>
                </div>
                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    30. Si pudieras elegir ¿qué preferirías ser?     
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp30" value="CINESTÉSICO">a) Un gran médico <br>
                        <input id="resp" type="radio" name="resp30" value="AUDITIVO">     b) Un gran músico<br>
                        <input id="resp" type="radio" name="resp30" value="VISUAL">   c) Un gran pintor<br>
                    </div>
                </div>
                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    31. Cuando eliges tu ropa, ¿qué es lo más importante para ti?     
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp31" value="AUDITIVO">a) Que sea adecuada  <br>
                        <input id="resp" type="radio" name="resp31" value="VISUAL">   b) Que luzca bien   <br>
                        <input id="resp" type="radio" name="resp31" value="CINESTÉSICO">     c) Que sea cómoda   <br>
                    </div>
                </div>
                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    32. ¿Qué es lo que más disfrutas de una habitación?           
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp32" value="AUDITIVO">   a) Que sea silenciosa          <br>
                        <input id="resp" type="radio" name="resp32" value="CINESTÉSICO">     b) Que sea confortable        <br>
                        <input id="resp" type="radio" name="resp32" value="VISUAL">c) Que esté limpia y ordenada <br>
                    </div>
                </div>
                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    33. ¿Qué es más sexy para ti?           
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp33" value="VISUAL">   a) Una iluminación tenue  <br>
                        <input id="resp" type="radio" name="resp33" value="CINESTÉSICO">b) El perfume            <br>
                        <input id="resp" type="radio" name="resp33" value="AUDITIVO">     c) Cierto tipo de música <br>
                    </div>
                </div>
                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    34. ¿A qué tipo de espectáculo preferirías asistir?       
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp34" value="AUDITIVO">     a) A un concierto de música      <br>
                        <input id="resp" type="radio" name="resp34" value="VISUAL">b) A un espectáculo de magia    <br>
                        <input id="resp" type="radio" name="resp34" value="CINESTÉSICO">   c) A una muestra gastronómica   <br>
                    </div>
                </div>
                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    35. ¿Qué te atrae más de una persona?
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp35" value="CINESTÉSICO">      a) Su trato y forma de ser       <br>
                        <input id="resp" type="radio" name="resp35" value="VISUAL">        b) Su aspecto físico            <br>
                        <input id="resp" type="radio" name="resp35" value="AUDITIVO">   c) Su conversación             <br>
                    </div>
                </div>
                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    36. Cuando vas de compras, ¿en dónde pasas mucho tiempo?    
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp36" value="VISUAL">a) En una librería               <br>
                        <input id="resp" type="radio" name="resp36" value="CINESTÉSICO">     b) En una perfumería         <br>
                        <input id="resp" type="radio" name="resp36" value="AUDITIVO">   c) En una tienda de discos<br>
                    </div>
                </div>
                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    37. ¿Cuáles tu idea de una noche romántica?    
    
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp37" value="VISUAL">       a) A la luz de las velas        <br>
                        <input id="resp" type="radio" name="resp37" value="AUDITIVO">     b) Con música romántica     <br>
                        <input id="resp" type="radio" name="resp37" value="CINESTÉSICO">  c) Bailando tranquilamente<br>
                    </div>
                </div>
                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    38. ¿Qué es lo que más disfrutas de viajar?           
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp38" value="CINESTÉSICO">       a) Conocer personas y hacer nuevos amigos      <br>
                        <input id="resp" type="radio" name="resp38" value="VISUAL">     b) Conocer lugares nuevos                  <br>
                        <input id="resp" type="radio" name="resp38" value="AUDITIVO">  c) Aprender sobre otras costumbres       <br>
                    </div>
                </div>
                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    39. Cuando estás en la ciudad, ¿qué es lo que más hechas de
                        menos del campo?  
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp39" value="CINESTÉSICO">a) El aire limpio y refrescante      <br>
                        <input id="resp" type="radio" name="resp39" value="VISUAL">     b) Los paisajes                  <br>
                        <input id="resp" type="radio" name="resp39" value="AUDITIVO">   c) La tranquilidad             <br>
                    </div>
                </div>
                <div id="pregresp" class="pregresp col-sm-6">
                <br>
                    <div id="pregunta" class="pregunta">
                    40. Si te ofrecieran uno de los siguientes empleos, ¿cuál
                        elegirías?
                    </div>
                    <div id="respuestas" class="respuestas">
                        <input id="resp" type="radio" name="resp40" value="AUDITIVO">a) Director de una estación de radio      <br>
                        <input id="resp" type="radio" name="resp40" value="CINESTÉSICO">     b) Director de un club deportivo      <br>
                        <input id="resp" type="radio" name="resp40" value="VISUAL">   c) Director de una revista          <br>
                    </div>
                </div>
        </div>
        <center><button type="button" id="Evaluar" class="btn btn-primary">Enviar</button></center>
    </div>
    <script>
        var usuario = '<?php echo $varsesion; ?>';
        var visual = 0;
        var auditivo = 0;
        var cinestesico = 0;
        $('#Evaluar').click(function(){
            $("#contenedroPreguntas #pregresp").each(function(){
                $(this).find('#respuestas').each(function(){
                    $(this).find('#resp:checked').each(function(){
                        var valor = $(this).val();
                        switch (valor) {
                            case 'VISUAL':
                                visual++;
                                break;
                            case 'CINESTÉSICO':
                                cinestesico++;
                                break;
                            case 'AUDITIVO':
                                auditivo++;
                                break;
                        }
                    });
                });
            });
            visual = (visual * 100)/40;
            auditivo = (auditivo * 100)/40;
            cinestesico = (cinestesico * 100)/40;
            $.ajax({
                type: "post",
                url: "<?php echo site_url('Cursos/EncuestaController/actualizarEstilo'); ?>",
                data: {alumno:usuario,eavisual:visual,eaauditivo:auditivo,eacinestesico:cinestesico},
                success: function (response) {
                    console.log(response);
                    window.location.replace("<?php echo site_url('alumno/MisCursos'); ?>");
                }
            });
            console.log("visual "+visual+'%');
            console.log("auditivo "+auditivo+'%');
            console.log("cinestesico "+cinestesico+'%');
        });
    </script>
</body>
</html>