<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'Cursos/MisCursosController/load_MisCursos';
$route['404_override'] = '';


$route['alumno/MisCursos'] = 'Cursos/MisCursosController/load_MisCursos';
$route['alumno/Encuesta'] = 'Cursos/EncuestaController/load_Encuesta';
$route['Cursos/NuevosCursos'] = 'Cursos/NuevoCursosController/load_NuevosCursos';
$route['Cursos/Preview'] = 'Cursos/PreviewController/load_Preview';
$route['Cursos/Pregunta'] = 'Cursos/PreguntasController/load_Preguntas';
$route['Cursos/Temario'] = 'Cursos/TemarioController/load_Temario';
$route['Cursos/Buscar']='Cursos/BuscarController/Load_Buscar';
$route['Cursos/Evaluacion']='Cursos/EvaluacionController/load_Evaluacion';

$route['Cursos/Resultado']='Cursos/EvaluacionController/load_Resultado';



$route['cursos/todos'] = 'ConfiguracionController/cargarInicio';
$route['cursos/nuevo_curso'] = 'ConfiguracionController/index';
$route['cursos/nuevo_curso/lecciones'] = 'ConfiguracionController/cargarVistaLecciones';
$route['cursos/nuevo_curso/contenido_tema'] = 'ConfiguracionController/cargarVistaTema';




$route['Material'] = 'Material/MaterialController/load_Material';


$route['Material/Video'] = 'Material/MaterialController/load_Material';

$route['alumno/'] = 'welcome/index';


/*<video id="hearstPlayer-eb287947-5809-42d1-8536-05569d1865cb-7_html5_api" class="vjs-tech" playsinline="playsinline" tabindex="-1" preload="false" poster="https://hips.hearstapps.com/vidthumb/images/alita-angel-de-combate-1542126792.jpg?crop=0.941xw%3A1.00xh%3B0.0304xw%2C0&amp;resize=960%3A540" aria-labelledby="vjs-dock-title-13" aria-describedby="vjs-dock-description-14" src="blob:https://www.fotogramas.es/d7364750-ca83-4dee-8725-0ca9ccd2b9fd"></video> */