<?php

$salida = "
<nav class=\"navbar navbar-expand-md bg-light navbar-light\">
            <!-- Brand -->
            <a class=\"navbar-brand\" href=\"index.php\">
             <img class=\"login-img text-left\" src=\"img/logo.png\" style=\"width: 50%; margin: 0;\">
         </a>

            <!-- Toggler/collapsibe Button -->
            <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#collapsibleNavbar\">
                <span class=\"navbar-toggler-icon\"></span>
            </button>

            <!-- Navbar links -->
            <div class=\"collapse navbar-collapse\" id=\"collapsibleNavbar\">";
            if ($_SERVER['PHP_SELF'] == "/Plataforma/home.php"){
              $salida = $salida ."
                <form class=\"form-inline my-2 my-md-0\">
                    <div class=\"input-group\">
                        <input id=\"edSkCurso\" type=\"search\" class=\"buscar form-control\" placeholder=\"Buscar Curso\">
                        <div class=\"input-group-append\">
                            <button id=\"btnSkCurso\" class=\"bustcar btn btn-outline-info\" type=\"button\">
                                <span class=\"fa fa-search form-control-feedback\"></span>
                            </button>
                        </div>
                    </div>
                </form>";
              }
              $salida = $salida . "
                <ul class=\"navbar-nav offset-lg-1 offset-xl-3\">";
                if ($_SERVER['PHP_SELF'] == "/Plataforma/configuracion.php"){
                    $salida = $salida . "<li class=\"nav-item\" style=\"color: white; padding-left: 20px;\">
                  <a class=\"nav-link\" href=\"#\"><i class=\"fas fa-bars\" id=\"sidebarCollapse\"></i></a>
                        </li>";
                    }
                    $salida = $salida."
                    <li class=\"dropdown\">
                        <a href=\"\" class=\"btn navA\" data-toggle=\"dropdown\" >
                            <span class=\"far fa-bell fa-2x\" style=\"color: #07ad90;\" title=\"Notificaciones\"></span>
                        </a>
                        <ul class=\"dropdown-menu\">

                        </ul>
                    </li>
                    <li class=\"dropdown\">
                        <a href=\"\" class=\"btn navA\" data-toggle=\"dropdown\" >
                            <span class=\"far fa-user fa-2x\" style=\"color: #07ad90;\"  title=\"Perfil\"></span>
                        </a>
                        <ul class=\"dropdown-menu\">
                           <li>
                               <a class=\"navA\" href=\"index.php\"><button class=\"btn btn-light col-12 text-left\">  <span class=\"fas fa-user-circle fa-5x\" style=\"color: #07ad90;font-size: 40px;\"></span> Nombre de usuario</button></a>
                           </li>
                           <li>
                               <a class=\"navA\" href=\"home.php\"><button class=\"btn btn-light col-12 text-left\">  <span class=\"far fa-folder pull-left \" style=\"color: #07ad90;font-size: 16px;\"></span> Cursos</button></a>
                           </li>
                           <li>
                                <a class=\"navA\" href=\"configuracion.php\"><button class=\"btn btn-light col-12 text-left\"> <span class=\"fa fa-plus pull-left \" style=\"color: #07ad90;\"></span> Nuevo curso   </button></a>
                           </li>
                           <li>
                               <a class=\"navA\" href=\"#\"><button class=\"btn btn-light col-12 text-left\"><span class=\"fas  fa-info-circle  pull-left\" style=\"color: #07ad90;\"></span> Ayuda</button></a>
                           </li>
                           <li>
                               <a class=\"navA\" href=\"cerrar_sesion.php\"><button class=\"btn btn-light col-12 text-left\"> <span class=\" fas fa-sign-out-alt  pull-left\" style=\"color: #07ad90;\"></span> Salir </button></a>
                           </li>
                        </ul>
                    </li>
                    <!--li class=\"nav-item\">
                        <a class=\"nav-link\" href=\"#\" data-toggle=\"modal\" data-target=\"#exampleModal\"><i class=\"fa fa-key\"></i> Cambiar Contraseña</a>
                    </li-->
                </ul>
            </div>
        </nav>"; 
echo $salida;    
?>