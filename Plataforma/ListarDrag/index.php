<?php
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Listar Cursos - Arrastar y soltar</title>
    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="assets/css/sticky-footer-navbar.css" rel="stylesheet">
<style>
ul{
padding: 0px;
margin: 0px;
}
#mi_lista li{
color: #fff;
background-color: #007bff;
border-color: #007bff;
margin: 0 0 3px;
padding: 10px;
list-style: none;
cursor:pointer;
}
</style>
  </head>

  <body>

    <header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">BaulPHP</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Inicio <span class="sr-only">(current)</span></a>
            </li>
         
          </ul>
          <form class="form-inline mt-2 mt-md-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Buscar" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Busqueda</button>
          </form>
        </div>
      </nav>
    </header>

    <!-- Begin page content -->

<div class="container">
 <h1 class="mt-5">Listar Cursos - Arrastar y soltar</h1>
 <hr>
<div class="row">
  <div class="col-12 col-md-6">
   <!-- Contenido --> 
   
   
<div id="mensaje"></div>
<ul id="mi_lista">
			<?php
      require("../connect_db.php");
			$resultado_cursos = "SELECT * FROM Temas ORDER BY secuencia ASC";
			$resultado_cursos = mysql_query($resultado_cursos);
			while($registro_cursos = mysql_fetch_array($resultado_cursos)){
				?>
				<li id="miorden_<?php echo $registro_cursos['id']; ?>">
					<?php
					echo $registro_cursos['id'] . " - ";
					echo $registro_cursos['nombre'];
					?>
				</li>
				<?php
			}
			?>
		</ul>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
$(document).ready(function () {
    $(function () {
                    $("#mi_lista").sortable({update: function () {
							var ordem_atual = $(this).sortable("serialize");
							$.post("proceso_orden.php", ordem_atual, function (retorno) {
								//Imprimir resultado 
								$("#mensaje").html(retorno);
								//Muestra mensaje
								$("#mensaje").slideDown('slow');
								RetirarMensaje();
							});
						}
                    });
                });
				
// Elimina mensajes despues de un determiando periodo de tiempo 1900 milissegundos
	function RetirarMensaje(){
					setTimeout( function (){
						$("#mensaje").slideUp('slow', function(){});
					}, 1900);
				}
            });
		</script>


 <!-- Fin Contenido --> 
</div>
</div><!-- Fin row -->
</div><!-- Fin container -->
    <footer class="footer">
      <div class="container">
        <span class="text-muted"><p>Códigos <a href="https://www.baulphp.com/" target="_blank">BaulPHP</a></p></span>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   
  </body>
</html>
