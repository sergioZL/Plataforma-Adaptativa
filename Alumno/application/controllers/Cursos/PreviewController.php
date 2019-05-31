<?php

class PreviewController extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->helper('url_helper');
        $this->load->helper('form');       
		$this->load->model('Cursos_modal');
		$this->load->model('Inscrito_modal');
		$this->load->model('Lecciones_modal');
		
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
}
