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
		$this->load->model('Material_Model');
		$this->load->model('Avance_modal');	
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
		$idCurso = $this->input->post('Curso');
        $idUsuario = $this->input->post('Usuario');

		$Tema = $this->Temas_modal->ConsultarTemasCursos($id);

		$duracion = $this->Avance_modal->ConsultarDuracion($idCurso,$idUsuario);

		foreach ($Tema as $item) {
			$material = $this->cargarMaterial($item['id']);
			$avance = $this->Avance_modal->ConsultarAvance($duracion['id'],$item['id']);
            $carga = "";
            foreach ($material as $mat){
				if( !$mat['idavance'] || !$avance || $mat['idavance'] == $avance->id ){
					$dur = $mat['duracion'];
					$ava = $mat['avance'];
					if($ava > 0)$porcent = $ava*100/$dur;
					if(!$avance) {
						$porcent = 0;
						$ava = 0;
					} 
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
				$carga = $carga.'<button style="width: 100%;" class="btn btn-link" onclick="mostrar('.$ruta.','.$tipo.','.$ava.','.$mat['id'].');"><p class="h6 pull-left">
				<span  class="'.$icono.' "></span>
				 &nbsp &nbsp'.$mat['descripcion_material'].'</p>
				 </button><br>';
			}
			}
			$badage = 'badge-primary';
			$avanceTema = '';
			if($avance) $avanceTema = $avance->avance.'%';
			if($avance['avance'] == 100){
				$avanceTema = '<i class="fas fa-check"></i>';
				$badage = 'badge-success';
			} 
			echo $nose ='<div class="card rounded-0">
                <h5 class="card-header">
                    <a data-toggle="collapse" href="#content'. $item['id'] .'" aria-expanded="true"
                        aria-controls="content'. $item['id'] .'" id="Tema'. $item['id'] .'" class="d-block">
                        <i class="fa fa-chevron-down pull-right"></i>
                        <p class="font-weight-bold temas"> Tema '. $item['secuencia'].': '.$item['nombre'].'<span class="pull-right badge '.$badage.' badge-pill">'.$avanceTema.'</span><p>
                    </a>
                </h5>
                <div id="content'. $item['id'] .'" class="collapse carta-body" aria-labelledby="Tema'. $item['id'] .'">
                    <div class="card-body carta-body">
                        '.$carga.'
                    </div>
                </div>
			</div>';
		}
		
		// foreach ($Tema as $item) {

		// 	echo $nose ='<div class="card rounded-0">
        //         <h5 class="card-header">
        //             <a data-toggle="collapse" href="#contenido'. $item['secuencia'] .'" aria-expanded="true"
        //                 aria-controls="contenido'. $item['id'] .'" id="leccion'. $item['id'] .'" class="d-block">
        //                 <i class="fa fa-chevron-down pull-right"></i>
        //                 Tema #'. $item['secuencia'] .'
        //             </a>
        //         </h5>
        //         <div id="contenido'. $item['secuencia'] .'" class="collapse" aria-labelledby="leccion'. $item['id_leccion'] .'">
        //             <div class="card-body">
        //                 <h6>Este es el contenido del Tema: '. $item['nombre'] .'</h6>
        //                 <p>'. $item['descripcionTema'] .'</p>
        //             </div>
        //         </div>
        //     </div>';
			
		// }
	}
    public function cargarMaterial($id){
        //$material = $this->Material_Model->encontrarMaterial($id);
		$material = $this->Avance_modal->getavanceMaterialTema($id);
		return $material;
    }
	
}
