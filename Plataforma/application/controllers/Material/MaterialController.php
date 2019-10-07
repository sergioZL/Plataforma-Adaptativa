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
        $this->load->model('Material_Model');
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
            $material = $this->cargarMaterial($item['id']);
             $carga = "";
            foreach ($material as $mat){
                $ruta= '&quot Material/'.$mat['clave_curso'].'/'.$id.'/'.$mat['id_temas'].'/'.$mat['descripcion_material'].'&quot';
                $tipo = $mat['tipo_material'];
                $icono = '';
				switch ($tipo) {
					case 1:
						$icono = 'fas fa-play-circle fa-2x';
						break;
					case 2:
						$icono = 'fas fas fa-volume-up fa-2x';
						break;
					case 3:
						$icono = 'fas fa-file-pdf fa-2x';
						break;
					default:
						# code...
						break;
				}
                $carga = $carga.'<button class="btn btn-link" onclick="mostrar('.$ruta.','.$tipo.');"><p class="h6"> <span class="'.$icono.'"></span>'.$mat['descripcion_material'].'</p> </button><br>';

            }
			echo $nose ='<div class="card rounded-0">
                <h5 class="card-header">
                    <a data-toggle="collapse" href="#content'. $item['id'] .'" aria-expanded="true"
                        aria-controls="content'. $item['id'] .'" id="Tema'. $item['id'] .'" class="d-block">
                        <i class="fa fa-chevron-down pull-right"></i>
                        <p class="font-weight-bold temas"> Tema '. $item['secuencia'].': '.$item['nombre'].'<p>
                    </a>
                </h5>
                <div id="content'. $item['id'] .'" class="collapse carta-body" aria-labelledby="Tema'. $item['id'] .'">
                    <div class="card-body carta-body">
                        <!-- <a href=""><p class="h6"> <span class="fas fa-play-circle fa-2x"></span>   video sobre algun tema </p> </a><br>
                         <a href=""><p class="h6"> <span class="fas as fa-file-audio fa-2x"></span> video sobre algun tema   </p></a><br>
                         <a href=""><p class="h6"> <span class="fas far fa-file-pdf fa-2x"></span>  video sobre algun tema   </p></a><br> -->
                        '.$carga.'
                    </div>
                </div>
            </div>';
			
        }
    }
    public function cargarMaterial($id){
        $material = $this->Material_Model->encontrarMaterial($id);
        return $material;
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
