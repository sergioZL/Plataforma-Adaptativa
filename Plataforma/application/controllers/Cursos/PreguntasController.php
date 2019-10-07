<?php

class PreguntasController extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model('Inscrito_modal');
		$this->load->model('Temas_modal');
        $this->load->helper('url_helper');
    }

	public function load_Preguntas()
	{
		$this->load->view('Cursos/Preguntas');
	}

	public function IncribirAlumno()
	{	
		$id = $this->input->get('IdCurso');
		$idUsuario = $this->input->get('idUsuario');
		
		$Curso = $this->Inscrito_modal->IncribirAlumno($id,$idUsuario);

		$duracion = $this->Temas_modal->ConsultarTemasPorCursos($id);

		$data = array(
			'duracion' => $duracion,
			'clave_inscrito' => $idUsuario,
			'clave_curso' => $id
		);

		$dur = $this->Inscrito_modal->insertarDuracion($data);
		
		//if($Curso ==True)
			echo 'Se inscribio al curso';
		/*else
			echo 'No inscribio al curso';
		*/
	}
}
