<?php

class NuevoCursosController extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->helper('url_helper');
        $this->load->helper('form');       
		$this->load->model('Cursos_modal');
    }

	public function load_NuevosCursos()
	{
		$this->load->view('Cursos/NuevosCursos');
	}

	public function ConsultarCursosUsuarios()
	{		
		$Curso = $this->Cursos_modal->ConsultarCursos();
        
		foreach ($Curso as $row) {

			echo $Cursos = '
			<div class="card" style="width: 250px; height:400px; margin-left: 20px;">
				<a href="Preview?curso='.$row['clave'].'">	
					<div class="Img">
						<img class="card-img-top" style="width: 250px; height:250px;" id="IMGCurso" src="data:image/jpg;base64,'.$row['foto'].'" alt="Card image cap">
					</div>
					<div class="card-body ">
						<h5 class="card-title text-center">'.$row['nombre'].'</h5>
						<p class="card-text text-center">'.$row['descripcion'].'</p>
					</div>
				</a>
			</div>';
	
		}
	}
}




