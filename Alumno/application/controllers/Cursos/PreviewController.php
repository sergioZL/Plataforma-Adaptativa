<?php

class PreviewController extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->helper('url_helper');
        $this->load->helper('form');       
		$this->load->model('Cursos_modal');
		$this->load->model('Inscrito_modal');
		$this->load->model('Lecciones_modal');
		$this->load->model('Aprendizaje_modal');
		$this->load->model('Temas_modal');		
    }

	public function load_Preview()
	{
		$this->load->view('Cursos/Preview');
	}

	public function ConsultarPorIDCursos()
	{	
		$id = $this->input->get('IdCurso');
		$Curso = $this->Cursos_modal->ConsultarPorIDCursos($id);
        
        echo json_encode($Curso);
	}

	public function ConsultarTodosLeccionPorIDCursos()
	{	
		$id = $this->input->get('IdCurso');
		$leccion = $this->Lecciones_modal->ConsultarTodosLeccionesCursos($id);
        
        echo json_encode($leccion);
	}
	
	public function ConsultarLeccionPorIDCursos()
	{	
		$id = $this->input->get('IdCurso');
		$leccion = $this->Lecciones_modal->ConsultarLeccionesCursos($id);
        
        echo json_encode($leccion);
	}


	public function ConsultarAprendizajeIDCursos()
	{	
		session_start();
		$idUsuario = $_SESSION['usuario'];
		$idCurso = $this->input->get('IdCurso');
		
		$Aprendizaje = $this->Aprendizaje_modal->ConsultarAprendizajeCurso($idUsuario,$idCurso);
		
		foreach($Aprendizaje as $row)
		{
			echo '<div class="col-md-6">
				<i class="fas fa-check"></i> <span>'. $row['aprendizaje'] .'</span><br><br>
			</div>';
		}
	}

	public function ConsultarTemasCursos()
	{	
		$id = $this->input->get('IdLeccion');
		$Tema = $this->Temas_modal->ConsultarTemasCursos($id);
		
		foreach ($Tema as $item) {

			echo $nose ='<div class="card rounded-0">
                <h5 class="card-header">
                    <a data-toggle="collapse" href="#contenido'. $item['id'] .'" aria-expanded="true"
                        aria-controls="contenido'. $item['id'] .'" id="leccion'. $item['id'] .'" class="d-block">
                        <i class="fa fa-chevron-down pull-right"></i>
                        Tema #'. $item['secuencia'] .'
                    </a>
                </h5>
                <div id="contenido'. $item['secuencia'] .'" class="collapse" aria-labelledby="leccion'. $item['id_leccion'] .'">
                    <div class="card-body">
                        <h6>Este es el contenido del Tema: '. $item['nombre'] .'</h6>
                        <p>'. $item['descripcionTema'] .'</p>
                    </div>
                </div>
            </div>';
			
		}
	}

	
}
