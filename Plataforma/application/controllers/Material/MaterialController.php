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

    public function ConsultarTemasCursosID()
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
                <div id="contenido'. $item['id'] .'" class="collapse" aria-labelledby="leccion'. $item['id_leccion'] .'">
                    <div class="card-body">
                        <a href=""><p class="h6"> <span class="fas fa-play-circle fa-2x"></span>   video sobre algun tema </p> </a><br>
                        <a href=""><p class="h6"> <span class="fas as fa-file-audio fa-2x"></span> video sobre algun tema   </p></a><br>
                        <a href=""><p class="h6"> <span class="fas far fa-file-pdf fa-2x"></span>  video sobre algun tema   </p></a><br>
                    
                    </div>
                </div>
            </div>';
			
        }
    }
    
    public function SiguienteVideo()
    {
        $id = $this->input->get('IdCurso');
        
        echo $material = $this->input->get('material');
    
           
    }

    public function SiguienteAudio()
    {
        $id = $this->input->get('IdCurso');
        
        echo $material = $this->input->get('material');
    
           
    }
}
