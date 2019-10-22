<?php

class BuscarController extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Cursos_modal');
		$this->load->model('configuracion_model');
        $this->load->helper('url_helper');
    }
	public function getCarreras() {

		$data = $this->configuracion_model->getCarreras();

		echo json_encode($data);
	}
	public function load_Buscar()
	{
		$this->load->view('Cursos/Buscar');
	}

	public function ConsultarBuscarCursos()
	{
		$nombre = $this->input->get('nombre');
		$Curso = $this->Cursos_modal->ConsultarBuscarCursos($nombre);
        
        foreach ($Curso as $row) {

			echo $Cursos = '
			<div class="card style="width: 250px; height:400px; margin-left: 20px;">
			<a href="Preview?curso='.$row['clave'].'">
				<div class="Img">
					<img class="card-img-top" style="width: 250px; height:250px;" id="IMGCurso" src="data:image/jpg;base64,'.$row['foto'].'" alt="Card image cap">
				</div>
				<div class="card-body">
					<h5 class="card-title text-center">'.$row['nombre'].'</h5>
					<p class="card-text text-center">'.$row['descripcion'].'</p>
				</div>
			</a>
		</div>';
		}
	}
}
