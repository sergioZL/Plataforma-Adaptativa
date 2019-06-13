<?php

class MaterialController extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper('url_helper');
	$this->load->model('Cursos_modal');
	$this->load->model('Inscrito_modal');
	$this->load->model('Lecciones_modal');
	$this->load->model('Aprendizaje_modal');
	$this->load->model('Temas_modal');	
    }

    public function load_Material()
    {
        $this->load->view('Material/Material');
    }

    public function ConsultarTodosLeccionPorIDCursos()
    {	
        $id = $this->input->get('IdCurso');
	$leccion = $this->Lecciones_modal->ConsultarTodosLeccionesCursos($id);
        
        echo json_encode($leccion);
    }
}
