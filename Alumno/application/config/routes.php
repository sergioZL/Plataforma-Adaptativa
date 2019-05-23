<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'Cursos/MisCursosController/load_MisCursos';
$route['404_override'] = '';

$route['alumno/MisCursos'] = 'Cursos/MisCursosController/load_MisCursos';
$route['Cursos/NuevosCursos'] = 'Cursos/NuevoCursosController/load_NuevosCursos';
$route['Cursos/Preview'] = 'Cursos/PreviewController/load_Preview';
$route['Cursos/Pregunta'] = 'Cursos/PreguntasController/load_Preguntas';
$route['Cursos/Temario'] = 'Cursos/TemarioController/load_Temario';


$route['Material'] = 'Material/MaterialController/load_Material';


$route['Material/Video'] = 'Material/MaterialController/load_Material';

$route['alumno/'] = 'welcome/index';
