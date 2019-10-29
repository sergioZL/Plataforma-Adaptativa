<?php

class TemarioController extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->helper('url_helper');
		$this->load->model('Inscrito_modal');
		$this->load->model('Cursos_modal');
    }

	public function load_Temario()
	{
		$this->load->view('Cursos/Temario');
	}

	public function ConsultarPorIDCursos()
	{	
		session_start();
		$id = $_SESSION['usuario'];
		$curso =$this->input->get('IdCurso');
		$Curso = $this->Inscrito_modal->ConsultarCursosTemario($id,$curso);
        
        echo json_encode($Curso);
	}

	
}
