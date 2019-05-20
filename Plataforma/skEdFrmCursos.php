<?php
session_start();
$frm = $_POST['consulta'];

switch ($frm) {
    case 'recursos':
        recursos();
        break;
    case 'preguntas':
        preguntas();
        break;
    case 'lecciones':
        lecciones();
        break;
    case 'temas':
        temas();
        break;
    case 'evaluacion':
        evaluacion();
        break;
    case 'curso':
        curso();
        break;
    default:
        # code...
        break;
}

#------------------------------    
function curso() {
    $validar = 0;
    #buscar el curso a mostrar
    $clave = $_SESSION["u_curso"];
    require("connect_db.php");
    $sqlCurso = "SELECT * FROM Cursos WHERE clave = ".$clave;
    $st = mysql_query($sqlCurso);
    if ($st == false) {
        $validar ++;
        $msj =  "<script>alert('Error al buscar curso');</script>";
    }

    if ($validar == 0) {
        $rsC = mysql_fetch_array($st);
        if ($rsC == false) {
            $validar ++;
            echo "<script>alert('Error al recuperar datos.');</script>";
        }
    }
    
    if ($validar == 0) {
        $salida = "";
        $salida = "
            <form enctype=\"multipart/form-data\" method=\"POST\" action=\"insert/addCurso.php\">
                <div class=\"form-group col-md-6\">
                    <h2>Curso</h2>
                </div>
                <div class=\"form-group col-md-6\">
                    <label for=\"clave\">Clave:</label>
                    <input type=\"text\" class=\"form-control\" id=\"clave\" name=\"clave\" placeholder=\"Clave del curso\" value=\"".$rsC['clave']."\" readonly>
                </div>
                <div class=\"form-group col-md-6\">
                    <label for=\"nombre\">Nombre:</label>
                    <input type=\"text\" class=\"form-control\" id=\"nombre\" name=\"nombre\" placeholder=\"Nombre del curso\"  value=\"".$rsC['nombre']."\">
                </div>
                <div class=\"form-group col-md-6\">
                    <label for=\"descripcion\">Descripción:</label><br>
                    <textarea rows=\"5\" id=\"descripcion\" name=\"descripcion\">".$rsC['descripcion']."</textarea>
                </div>
                <div class=\"form-group col-md-6\">
                    <label for=\"campoarchivo\">Imagen:</label>
                    <i class=\"fas fa-upload\"></i>
                        <input id=\"campoarchivo\" name=\"campoarchivo\" type=\"file\" >
                </div>";
                $salida = $salida."<div class=\"form-group col-md-6\">
                                    <label for=\"clave_carrera\">Clave de Carrera:</label>";
                    $sql= mysql_query("SELECT * FROM Carrera");
                    if ($sql == false) {
                                    $saldia=$salida."<input type=\"text\" class=\"form-control\" id=\"cve\" name=\"cve\" placeholder=\"No hay carreras registradas\" readonly required>";
                    }else{
                        $salida=$salida."<br>
                        <select id=\"clave_carrera\" name=\"clave_carrera\">";
                                        while($rs = mysql_fetch_array($sql)){
                                            $salida = $salida."<option value=\"".$rs['clave']."\">".$rs['nombre']."</option>";
                                        }
                        $salida = $salida."</select>";
                        mysql_close($link);
                    }
                    $salida = $salida."</div>";
                $salida = $salida."<button type=\"submit\" class=\"btn btn-success\">Actualizar</button>
                                    <button type=\"button\" class=\"btn btn-dark\" onclick=\"verLista('Lecciones', ".$rsC['clave']."')\">Ver Lecciones</button>
            </form>";
        echo $salida;
    }
}

function recursos() {
    $salida = "
        
        <form enctype=\"multipart/form-data\" method=\"post\" action=\"addRecursos.php\">
            <div class=\"form-group\">
                <h2>Lección</h2>
            </div>
            <div class=\"form-group\">
                <label for=\"archivo\">Material:</label>
                <input name=\"campoarchivo\" type=\"file\" >
            </div>
            <div class=\"form-group\">
                <label for=\"descripcion\">Descripción:</label><br>
                <textarea rows=\"5\" id=\"descripcion\" name=\"descripcion\">
                </textarea>
            </div>";
            $salida = $salida."<div class=\"form-group\">
                                <label for=\"id_tema\">Clave del Tema:</label>";
                require("connect_db.php");
                $sql= mysql_query("SELECT * FROM Temas");
                if ($sql == false) {
                                $saldia=$salida."<input type=\"text\" class=\"form-control\" id=\"id_tema\" name=\"id_tema\" placeholder=\"No hay carreras registradas\" readonly required>";
                }else{
                    $salida=$salida."<br>
                    <select id=\"id_tema\" name=\"id_tema\">";
                                    while($rs = mysql_fetch_array($sql)){
                                        $salida = $salida."<option value=\"".$rs['id']."\">".$rs['nombre']."</option>";
                                    }
                    $salida = $salida."</select>";
                    mysql_close($link);
                }
                $salida = $salida."</div>
            <button type=\"submit\" class=\"btn btn-primary\">Guardar</button>
            <button type=\"button\" class=\"btn btn-default\">Guardar</button>
        </form>";
    echo $salida;
}

function lecciones() {
    $salida = "
        
        <form method=\"post\" action=\"insert/addLecciones.php\">
            <div class=\"form-group\">
                <h2>Lecciones</h2>
            </div>
            <div class=\"form-group\">
                <label for=\"nombre\">Nombre:</label>
                <input type=\"text\" class=\"form-control\" id=\"nombre\" name=\"nombre\" placeholder=\"Nombre de la leccion\">
            </div>
            <div class=\"form-group\">
                <div class=\"col-md-8\">
                    <label for=\"clave_curso\">Curso:</label>";
            require("connect_db.php");
                $sql= mysql_query("SELECT * FROM Cursos");
                if ($sql == false) {
$saldia=$salida."<input type=\"text\" class=\"form-control\" id=\"clave_curso\" name=\"clave_curso\" placeholder=\"No hay carreras registradas\" readonly required>";
                }else{
                    $salida=$salida."<br>
                    <select id=\"clave_tcurso\" name=\"clave_tcurso\">";
                                    while($rs = mysql_fetch_array($sql)){
                                        if (isset($_SESSION["u_curso"])) {
                                            $clave_cur = $_SESSION["u_curso"];
                                        }else{
                                            $clave_cur = '';
                                        }
                                        if ($rs['clave'] == $clave_cur) {
                                            $salida = $salida."<option value=\"".$rs['clave']."\" selected>".$rs['clave']."</option>";
                                        }else{
                                            $salida = $salida."<option value=\"".$rs['clave']."\">".$rs['clave']."</option>";
                                        }
                                    }
                    $salida = $salida."</select>";
                    mysql_close($link);
                }
$salida = $salida ."</div>
                </div>
            <button type=\"submit\" class=\"btn btn-primary\">Guardar</button><br><br>
            <input type=\"button\" class=\"btn btn-secondary\" value=\"Editar orden\">
        </form>";
    echo $salida;
}
#------------------------------

function temas() {
    $salida = "
        
        <form method=\"post\" action=\"insert/addTemas.php\">
            <div class=\"form-group\">
                <h2>Temas</h2>
            </div>
            <div class=\"form-group\">
                <label for=\"nombre\">Nombre:</label>
                <input type=\"text\" class=\"form-control\" id=\"nombre\" name=\"nombre\" placeholder=\"Nombre del tema\">
            </div>
            <div class=\"form-group\">
                <div class=\"col-md-8\">
                    <label for=\"clave_leccion\">Clave de Leccion:</label>";
            require("connect_db.php");
                $sql= mysql_query("SELECT * FROM Lecciones");
                if ($sql == false) {
$saldia=$salida."<input type=\"text\" class=\"form-control\" id=\"clave_leccion\" name=\"clave_leccion\" placeholder=\"No hay carreras registradas\" readonly required>";
                }else{
                    $salida=$salida."<br>
                    <select id=\"clave_leccion\" name=\"clave_leccion\">";
                                    while($rs = mysql_fetch_array($sql)){
                                        if (isset($_SESSION["u_leccion"])) {
                                            $clave_leccion = $_SESSION["u_leccion"];
                                        }else{
                                            $clave_leccion = '';
                                        }
                                        if ($rs['clave'] == $clave_leccion) {
                                            $salida = $salida."<option value=\"".$rs['clave']."\" selected>".$rs['nombre']."</option>";
                                        }else{
                                            $salida = $salida."<option value=\"".$rs['clave']."\">".$rs['nombre']."</option>";
                                        }
                                    }
                    $salida = $salida."</select>";
                    mysql_close($link);
                }
$salida = $salida ."</div>
                </div>
            <button type=\"submit\" class=\"btn btn-primary\">Guardar</button>
        </form>";
    echo $salida;
}

function evaluacion() {
    $salida = "
        
        <form action=\"action_page.php\">
            <div class=\"form-group\">
                <h2>Evaluación</h2>
            </div>
            <div class=\"form-group\">
                <label for=\"leccion\">Lección:</label>
                    <select id=\"leccion\" name=\"leccion\">
                        <option value=\"Leccion 1\">Lección 1</option>
                        <option value=\"leccion 2\">Lección 2</option>
                        <option value=\"leccion 3\">Lección 3</option>
                        <option value=\"leccion 4\">Lección 4</option>
                    </select>
            </div>
            <div class=\"form-group\">
                <label for=\"tema\">Tema:</label>
                    <select id=\"tema\" name=\"tema\">
                        <option value=\"tema 1\">Tema 1</option>
                        <option value=\"tema 2\">Tema 2</option>
                        <option value=\"tema 3\">Tema 3</option>
                        <option value=\"tema 4\">Tema 4</option>
                    </select>
            </div>
            <div class=\"form-group\">
                <label for=\"opciona\">Opción A:</label>
                <input type=\"text\" class=\"form-control\" id=\"opciona\" name=\"opciona\" placeholder=\"Pregunta A.\">
            </div>
            <div class=\"form-group\">
                <label for=\"opcionb\">Opción B:</label>
                <input type=\"text\" class=\"form-control\" id=\"opcionb\" name=\"opcionb\" placeholder=\"Pregunta B.\">
            </div>
            <div class=\"form-group\">
                <label for=\"opcionc\">Opción C:</label>
                <input type=\"text\" class=\"form-control\" id=\"opcionc\" name=\"opcionc\" placeholder=\"Pregunta C.\">
            </div>
            <div class=\"form-group\">
                <label for=\"opciond\">Opción D:</label>
                <input type=\"text\" class=\"form-control\" id=\"opciond\" name=\"opciond\" placeholder=\"Pregunta D.\">
            </div>
            <div class=\"form-group\">
                <label for=\"respuesta\">Respuesta Correcta:</label>
                    <select id=\"respuesta\" name=\"respuesta\">
                        <option value=\"opciona\">Respuesta A</option>
                        <option value=\"opcionb\">Respuesta B</option>
                        <option value=\"opcionc\">Respuesta C</option>
                        <option value=\"opciond\">Respuesta D</option>
                    </select>
            </div>
            <button type=\"submit\" class=\"btn btn-primary\">Guardar</button>
        </form>";
    echo $salida;
}

function preguntas() {
    $salida = "";
    $salida = "
        <form enctype=\"multipart/form-data\" method=\"POST\" action=\"insert/addPreguntas.php\">
            <div class=\"form-group\">
                <h2>Preguntas</h2>
            </div>
            <div class=\"form-group\">
                <label for=\"enunciado\">Pregunta:</label>
                <input type=\"text\" class=\"form-control\" id=\"enunciado\" name=\"enunciado\" placeholder=\"Pregunta del cuestionario\">
            </div>
            
            <div class=\"form-group\">
                <label for=\"campoarchivo\">Imagen:</label>
                <i class=\"fas fa-upload\"></i>
                    <input id=\"campoarchivo\" name=\"campoarchivo\" type=\"file\" >
            </div>";
            $salida = $salida."<div class=\"form-group\">
                                <label for=\"clave_temas\">Clave de Carrera:</label>";
                require("connect_db.php");
                $sql= mysql_query("SELECT * FROM Temas");
                if ($sql == false) {
                                $saldia=$salida."<input type=\"text\" class=\"form-control\" id=\"cve\" name=\"cve\" placeholder=\"No hay temas registrados\" readonly required>";
                }else{
                    $salida=$salida."<br>
                    <select id=\"clave_temas\" name=\"clave_temas\">";
                                    while($rs = mysql_fetch_array($sql)){
                                        $salida = $salida."<option value=\"".$rs['id']."\">".$rs['nombre']."</option>";
                                    }
                    $salida = $salida."</select>";
                    mysql_close($link);
                }
                $salida = $salida."</div>";
            $salida = $salida."<button type=\"submit\" class=\"btn btn-primary\">Guardar</button>
        </form>";
    echo $salida;
}
#------------------------------
#------------------------------    
?>

