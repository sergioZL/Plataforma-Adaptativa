<?php

require 'vendor/autoload.php';
use Phpml\Classification\KNearestNeighbors;

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
        $this->load->model('valoracion_Model');
        $this->load->model('Evaluacion_modal');
    }

    // ===================================================================================================================================
    //   Utiliza un algoritmo de regresión lineal (KNN) el cual recibe como parametro los materiales mejor valorados por los usuarios
    //   En un determinado tema (parametro ingresado en $labels) y las caracteristicas de aprendizaje de los usuarios que valoraron este 
    //   Material ( parametro ingresado en $samples ) y mediante las caracteristicas de aprendizaje del usuario actual predice cual 
    //   podria ser el material del agrado de dicho usuario
    // ===================================================================================================================================

    public function RecomendacionesTema( $idAlumno, $idTema ){
        
        $alumno = $this->Inscrito_modal->obtenerAlumno( $idAlumno );
        $MejorValorados = $this->valoracion_Model->gerMejorValorado( $idTema );
        

        $Usuario = $this->AjustarParametrosUsuario($alumno);

        $samples = array();

        $labels = array();

        foreach ($MejorValorados as $Mv ) {

            array_push( $samples, [ $Mv['eaauditivo'], $Mv['eacinestesico'], $Mv['eavisual'] ]);

            array_push( $labels, $Mv['idmaterial'] );
        }

        $classifier = new KNearestNeighbors(); 

        $classifier->train($samples, $labels);

        return  $classifier->predict([ $Usuario->eaauditivo, $Usuario->eacinestesico, $Usuario->eavisual ]);
        
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

                $recomendacion = $this->RecomendacionesTema($idUsuario ,$topic['id']);

				$total = $this->Preguntas_Model->getTotalPreguntasPorTema($topic['id']);

				$porcentResp = $this->Respuesta_modal->getRespuestasUsuarioTema($idUsuario,$topic['id']);
				$porcentRespF = $this->Respuesta_modal->getRespuestasUsuarioTemaF($idUsuario,$topic['id']);

				$tema = new stdClass;
				
				if($total != null){ 
					$tema->evaluado = array('total' => $total[0]->total, 'porcentaje' => $porcentResp[0]->porc);
					$tema->evaluadoF = array('total' => $total[0]->total, 'porcentaje' => $porcentRespF[0]->porc);
				}

                $tema -> recomendado = $recomendacion;
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

                            for ($j=0; $j < sizeof( $materiales2 ); $j++) { 
                                $mat  = json_encode($materiales1[$i]);
                                $mat2 = json_encode($materiales2[$j]);
                                $mat  = json_decode($mat);
                                $mat2 = json_decode($mat2);
                                if($mat->id == $mat2->id){
                                    $materiales1[$i]  = $materiales2[$j];
                                    $mat = json_encode($materiales1[$i]);
                                    $mat = json_decode($mat);
                                    $valorado = $this->Avance_modal->getValoracionMaterial($ATipo->primero,$mat->id);
                                    if($valorado)  $valorado = $this->Avance_modal->getValoracionMaterial($ATipo->segundo,$mat->id);
                                    $mat -> valoracion = $valorado[0];
                                    $materiales1[$i] = $mat;
                                } else {
                                    $mat = json_encode($materiales1[$i]);
                                    $mat = json_decode($mat);
                                    $valorado = $this->Avance_modal->getValoracionMaterial($ATipo->primero,$mat->id);
                                    if($valorado)  $valorado = $this->Avance_modal->getValoracionMaterial($ATipo->segundo,$mat->id);
                                    $mat -> valoracion = $valorado[0];
                                    $materiales1[$i] = $mat;
                                }
                            }

 
                            array_push($materiales,$materiales1[$i]);
                        }

                    }
                    $tema -> avance = $avance -> avance;
                    $tema -> evaluadoEn = $avance -> evaluadoEn;
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
    }

    public function EvaluarTema(){

        $clave_curso =$this->input->post('IdCurso');
        $id_alumno   =$this->input->post('id_alumno');
        $TipoEvaluacion =$this->input->post('TipoEvaluacion');
        $respuestas = $this->input->post('Respuestas');
        $tema       = $this->input->post('IdTema');
        $respuestas = json_encode($respuestas);
        $respuestas = json_decode($respuestas);

        $idEvaluacion = $this->Evaluacion_modal->InsertEvaluacion( $TipoEvaluacion, $id_alumno, $clave_curso);

        $duracion = $this->Avance_modal->ConsultarDuracion($clave_curso,$id_alumno );

        $avance = $this->Avance_modal->ConsultarAvance( $duracion->id, $tema );

        foreach ($respuestas as $respuesta) {
            $this->Respuesta_modal->InsertRespuestas( $respuesta -> opcion, $respuesta -> idPregunta, $idEvaluacion);
        }

        $avance = json_encode($avance);
        $avance = json_decode($avance);
        $avance->evaluadoEn = 2;

        $this->Avance_modal->ActualizaAvance( $avance->id , $avance);

        echo json_encode($avance);
    }

    public function cargarEvaluacionTema(){
        $tema =$this->input->get('IdTema');
        
        $preguntas = $this->Preguntas_Model->getPreguntasPorTema($tema);
        
        $Questions = array();

        foreach ($preguntas as $pregunta) {
            $Question = new stdClass();
            $Question = $pregunta;
            $opciones =  $this->Preguntas_Model->getOpcionesPorPregunta($pregunta->id);
            $Question->opciones = $opciones;
            array_push( $Questions, $Question);
        }

        echo json_encode($Questions);
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
		
	}

	public function cargarMaterial($id){
        //$material = $this->Material_Model->encontrarMaterial($id);
		$material = $this->Avance_modal->getavanceMaterialTema($id);
		return $material;
    }

    // ==================================================================================================================================
    //   Regresa los parametros de aprendizaje ajustados a a la siguiente estructura [ auditivo, cinestesico, visual ] = [ 0, 0, 1]
    // ==================================================================================================================================

    function AjustarParametrosUsuario( $Usuario ){

        $mayoritario = false;

        if( $Usuario->eaauditivo > 28 ){

            if( $Usuario->eaauditivo > 49 ){

                if( $Usuario->eacinestesico > 39 ){
                    
                    $Usuario->eaauditivo = 2;
                    $Usuario->eacinestesico = 1;
                    $Usuario->eavisual = 0;
                
                } else if( $Usuario->eavisual > 39){

                    $Usuario->eaauditivo = 2;
                    $Usuario->eacinestesico = 0;
                    $Usuario->eavisual = 1;
                
                } else {

                    $Usuario->eaauditivo = 1;
                    $Usuario->eacinestesico = 0;
                    $Usuario->eavisual = 0; 

                    $mayoritario = true;

                }
            } else if( $Usuario->eaauditivo > 36)  $Usuario->eaauditivo = 2;
                else $Usuario->eaauditivo = 1;

        } else $Usuario->eaauditivo = 0;

        if( $Usuario->eacinestesico > 28 && $mayoritario == false ){

            if( $Usuario->eacinestesico > 49 ){

                if( $Usuario->eaauditivo  > 39 ){

                    $Usuario->eaauditivo  = 1;
                    $Usuario->eacinestesico = 2;
                    $Usuario->eavisual = 0;

                } else if( $Usuario->eavisual > 39 ){

                    $Usuario->eaauditivo  = 0;
                    $Usuario->eacinestesico = 2;
                    $Usuario->eavisual = 1;

                } else {

                    $Usuario->eaauditivo = 0;
                    $Usuario->eacinestesico = 1;
                    $Usuario->eavisual = 0; 

                    $mayoritario = true;

                }

            } else if ( $Usuario->eacinestesico> 36 ) $Usuario->eacinestesico = 2;
            else $Usuario->eacinestesico = 1;
        } else $Usuario->eacinestesico = 0;

        if( $Usuario->eavisual > 28 && $mayoritario == false){

            if( $Usuario->eavisual > 49 ){

                if( $Usuario->eacinestesico > 39 ){
                    
                    $Usuario->eaauditivo = 0;
                    $Usuario->eacinestesico = 1;
                    $Usuario->eavisual = 2;
                
                } else if( $Usuario->eaauditivo > 39){

                    $Usuario->eaauditivo = 1;
                    $Usuario->eacinestesico = 0;
                    $Usuario->eavisual = 2;
                
                } else {

                    $Usuario->eaauditivo= 0;
                    $Usuario->eacinestesico = 0;
                    $Usuario->eavisual = 1; 

                    $mayoritario = true;

                }

            }else if ( $Usuario->eavisual > 36 ) $Usuario->eavisual = 2;
            else $Usuario->eavisual = 1;

        } else $Usuario->eavisual = 0;
        
        return $Usuario;
    }

}
