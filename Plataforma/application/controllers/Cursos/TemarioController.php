<?php

class TemarioController extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->helper('url_helper'); 
		$this->load->model('Lecciones_modal');
		$this->load->model('Temas_modal');
		$this->load->model('Inscrito_modal');
		$this->load->model('Avance_modal');
		$this->load->model('Cursos_modal');
		$this->load->model('Material_Model');
		$this->load->model('Preguntas_Model');
		$this->load->model('Respuesta_modal');
    }

	public function load_Temario()
	{
		$this->load->view('Cursos/Temario');
	}
	//Optiene las lecciones por curso con sus respectivos temas y materiales
	//para la ventana de temario 
    public function Temario(){
        $id = $this ->  input -> get( 'IdCurso' );
        $idUsuario = $this -> input -> post( 'Usuario' );
        $duracion = $this->Avance_modal->ConsultarDuracion(  $id, $idUsuario);
        $lecciones = $this-> Lecciones_modal -> ConsultarTodosLeccionesCursos(   $id );
        $alumno = $this->Inscrito_modal->obtenerAlumno( $idUsuario );
        
        $ATipo = new stdClass;
        $ATipo->primero = 'eavisual';
        if($alumno->eavisual > $alumno->eaauditivo && $alumno->eavisual > $alumno->eacinestesico){
            $ATipo->primero = 'eavisual';
            if($alumno->eaauditivo > $alumno->eacinestesico){
                $ATipo->segundo = 'eaauditivo';
            }else  $ATipo->segundo = 'eacinestesico';
        }else if($alumno->eaauditivo > $alumno->eavisual && $alumno->eaauditivo > $alumno->eacinestesico){
            $ATipo->primero = 'eaauditivo';
            if($alumno->eavisual > $alumno->eacinestesico){
                $ATipo->segundo = 'eavisual';
            }else  $ATipo->segundo = 'eacinestesico';
        }else if($alumno->eacinestesico > $alumno->eavisual && $alumno->eacinestesico > $alumno->eaauditivo){
            $ATipo->primero = 'eacinestesico';
            if($alumno->eaauditivo >  $alumno->eavisual ){
                $ATipo->segundo = 'eaauditivo';
            }else  $ATipo->segundo = 'eavisual';
        }
        foreach ( $lecciones as $leccion ) {
            $lec = new stdClass;
            $lec -> clave = $leccion['clave'];
            $lec -> secuencia = $leccion['secuencia'];
            $lec -> descripcion = $leccion['descripcion'];
            $lec -> nombre = $leccion['nombre'];
            
            $topics = $this->Temas_modal->ConsultarTemasCursos($lec -> clave);
            foreach ( $topics as $topic ) {

				$total = $this->Preguntas_Model->getTotalPreguntasPorTema($topic['id']);

				$porcentResp = $this->Respuesta_modal->getRespuestasUsuarioTema($idUsuario,$topic['id']);

				$tema = new stdClass;
				
				if($total != null){ 
					$tema->evaluado = array('total' => $total[0]->total, 'porcentaje' => $porcentResp[0]->porc);
				}

                $tema -> id = $topic['id'];
                $tema -> nombre = $topic['nombre'];
                $tema -> secuencia = $topic['secuencia'];
                $tema -> descripcionTema = $topic['descripcionTema'];

                $avance = $this->Avance_modal->ConsultarAvance( $duracion->id, $tema-> id );
                if($avance == null){
                     $materiales = $this->Material_Model->encontrarMaterial( $tema-> id );
                     $i = 0;
                     foreach ($materiales as $mater) {
                         $mat = json_encode($mater);
                         $mat = json_decode($mat);
                         $valorado = $this->Avance_modal->getValoracionMaterial($ATipo->primero,$mat->id);
                         if($valorado)  $valorado = $this->Avance_modal->getValoracionMaterial($ATipo->segundo,$mat->id);
                         $mat -> valoracion = $valorado[0];
                         $materiales[$i] = $mat;
                         $i++;
                     }
                     $tema -> avance = 0;
                }
                else{
                    $materiales1 = $this->Material_Model->encontrarMaterial( $tema-> id );
                    $materiales2 = $this -> Avance_modal ->getAvanceMaterial( $tema-> id, $avance->id );
                    if( sizeof($materiales1) == sizeof($materiales2)){
                        $i = 0;
                        foreach ($materiales2 as $mater) {
                            $mat = json_encode($mater);
                            $mat = json_decode($mat);
                            $valorado = $this->Avance_modal->getValoracionMaterial($ATipo->primero,$mat->id);
                            if($valorado)  $valorado = $this->Avance_modal->getValoracionMaterial($ATipo->segundo,$mat->id);
                            $mat -> valoracion = $valorado[0];
                            $materiales2[$i] = $mat;
                            $i++;
                        }

                        $materiales = $materiales2;
                    }else{ 
                        $materiales = array();
                        for ($i=0; $i < sizeof( $materiales1 ); $i++) { 
                            if ( sizeof( $materiales2 ) > $i) {

                                $mat = json_encode($materiales2[$i]);
                                $mat = json_decode($mat);
                                $valorado = $this->Avance_modal->getValoracionMaterial($ATipo->primero,$mat->id);
                                if($valorado)  $valorado = $this->Avance_modal->getValoracionMaterial($ATipo->segundo,$mat->id);
                                $mat -> valoracion = $valorado[0];
                                $materiales2[$i] = $mat;

                                array_push($materiales,$materiales2[$i]);

                            }else{ 
                                $mat = json_encode($materiales1[$i]);
                                $mat = json_decode($mat);
                                $valorado = $this->Avance_modal->getValoracionMaterial($ATipo->primero,$mat->id);
                                if($valorado)  $valorado = $this->Avance_modal->getValoracionMaterial($ATipo->segundo,$mat->id);
                                $mat -> valoracion = $valorado[0];
                                $materiales1[$i] = $mat;

                                array_push($materiales,$materiales1[$i]);
                            }
                        }
                        //$materiales = $materiales1;
                    }
                    $tema -> avance = $avance -> avance;
                }
                $tema -> materials = $materiales;
                $temas[] = $tema;
            }
            $lec -> temas  = $temas;
            unset($temas);
            $temas = array();  
            $vec [] = $lec;
        }

        echo json_encode(  $vec );
        // $id = $this ->  input -> get( 'IdCurso' );
        // $idUsuario = $this -> input -> post( 'Usuario' );
        // $duracion = $this->Avance_modal->ConsultarDuracion($id,$idUsuario);
        // $lecciones = $this-> Lecciones_modal -> ConsultarTodosLeccionesCursos(  $id );
        // foreach ( $lecciones as $leccion ) {
        //     $lec = new stdClass;
        //     $lec -> clave = $leccion['clave'];
        //     $lec -> secuencia = $leccion['secuencia'];
        //     $lec -> descripcion = $leccion['descripcion'];
        //     $lec -> nombre = $leccion['nombre'];
            
        //     $topics = $this->Temas_modal->ConsultarTemasCursos($lec -> clave);
        //     foreach ( $topics as $topic ) {

		// 		$total = $this->Preguntas_Model->getTotalPreguntasPorTema($topic['id']);

		// 		$porcentResp = $this->Respuesta_modal->getRespuestasUsuarioTema($idUsuario,$topic['id']);

		// 		$tema = new stdClass;
				
		// 		if($total != null){ 
		// 			$tema->evaluado = array('total' => $total[0]->total, 'porcentaje' => $porcentResp[0]->porc);
		// 		}

        //         $tema -> id = $topic['id'];
        //         $tema -> nombre = $topic['nombre'];
        //         $tema -> secuencia = $topic['secuencia'];
        //         $tema -> descripcionTema = $topic['descripcionTema'];

        //         $avance = $this->Avance_modal->ConsultarAvance( $duracion->id, $tema-> id );
        //         if($avance == null){
        //              $materiales = $this->Material_Model->encontrarMaterial( $tema-> id );
        //              $tema -> avance = 0;
        //         }
        //         else{
        //             $materiales1 = $this->Material_Model->encontrarMaterial( $tema-> id );
        //             $materiales2 = $this -> Avance_modal ->getAvanceMaterial( $tema-> id, $avance->id );
        //             if( sizeof($materiales1) == sizeof($materiales2)){
        //                 $materiales = $materiales2;
        //             }else{ 
        //                 $materiales = array();
        //                 for ($i=0; $i < sizeof( $materiales1 ); $i++) { 
        //                     if ( sizeof( $materiales2 ) > $i) {
        //                         array_push($materiales,$materiales2[$i]);
        //                     }else array_push($materiales,$materiales1[$i]);
        //                 }
        //                 //$materiales = $materiales1;
        //             }
        //             $tema -> avance = $avance -> avance;
        //         }
        //         $tema -> materials = $materiales;
        //         $temas[] = $tema;
        //     }
        //     $lec -> temas  = $temas;
        //     unset($temas);
        //     $temas = array();  
        //     $vec [] = $lec;
        // }

        // echo json_encode($vec);

    }
	public function ConsultarPorIDCursos()
	{	
		session_start();
		$id = $_SESSION['usuario'];
		$curso =$this->input->get('IdCurso');
		$Curso = $this->Inscrito_modal->ConsultarCursosTemario($id,$curso);
        
        echo json_encode($Curso);
	}

	public function ConsultarLeccionPorIDCursos()
	{	
		$id = $this->input->get('IdCurso');
		$leccion = $this->Lecciones_modal->ConsultarLeccionesCursos($id);
        
        echo json_encode($leccion);
	}

	public function ConsultarTodosLeccionPorIDCursos()
	{	
		$id = $this->input->get('IdCurso');
		$leccion = $this->Lecciones_modal->ConsultarTodosLeccionesCursos($id);
        
        echo json_encode($leccion);
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
			$avance = $this->Avance_modal->ConsultarAvance($duracion->id,$item['id']);
            $carga = "";
            foreach ($material as $mat){
				if( !$mat['idavance'] || !$avance || $mat['idavance'] == $avance->id ){
					$dur = $mat['duracion'];
					$ava = $mat['avance'];
					$porcent = $ava*100/$dur;
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
				 <div class="progress" style="height:3px; width: 100%;">
				 <div class="progress-bar  bg-dark" role="progressbar" style="width: '.$porcent.'%; height:5px;" aria-valuenow="'.$porcent.'" aria-valuemin="0" aria-valuemax="100"></div>
			 	 </div>
				 </button><br>';
			}
			}
			$badage = 'badge-primary';
			if($avance) $avanceTema = $avance->avance.'%';
			if($avance->avance == 100){
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
