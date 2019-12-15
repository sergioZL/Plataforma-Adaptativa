<?php
class EvaluacionDController extends CI_Controller {
	private $idEvaluacion;
	private $numpregunta;
	public function __construct() {
        parent::__construct();
		$this->load->helper('url_helper');
		$this->load->model('Cursos_modal');
		$this->load->model('BancoPreguntas_modal');
		$this->load->model('Opciones_modal');
		$this->load->model('Configuracion_modal');
		$this->load->model('Lecciones_modal');
		$this->load->model('Evaluacion_modal');
		$this->load->model('Respuesta_modal');
        $this->load->model('Preguntas_modal');
        $this->load->model('Avance_modal');
        $this->load->model('Inscrito_modal');
	}


	public function load_Evaluacion()
	{
		$this->load->view('Cursos/EvaluacionD');
		
	}

    public function CargarPreguntas(){
        
        $Curso = $this->input->get('Curso');

        $limit = $this->Configuracion_modal->Limite();
        $limit = json_encode($limit);
        $limit = json_decode($limit);

        $TemasLecciones = $this->Lecciones_modal->ConsultarLeccionesPorCurso($Curso);
        $let = 0;
        foreach ($TemasLecciones as $tema) {
            $Preguntas = $this->BancoPreguntas_modal->ConsultarPreguntas($tema['id'],$limit->numpregunta);
            foreach ($Preguntas as $pregunta) {
                $let = $let+1;
                $Question = new stdClass;
                $Question -> enunciado = $pregunta['enunciado'];
                $Question -> id = $pregunta['id'];
                $Question -> id_tema = $pregunta['id_tema'];
                $Question -> imagen = $pregunta['imagen'];
                $Opciones = $this->Opciones_modal->ConsultarOpciones($pregunta['id']);
                $Question -> opciones = $Opciones;
                $porcent = 0;
                foreach ($Opciones as $item) {
                    $porcent = $porcent + $item['porcentaje'];
                }

                if($porcent == 100) $Questions[] = $Question;
            }
        }        
        echo json_encode($Questions);

    }
    public function Evaluar(){
        
        $clave_curso =$this->input->post('IdCurso');
        $id_alumno   =$this->input->post('id_alumno');
        $TipoEvaluacion =$this->input->post('TipoEvaluacion');
        $respuestas = $this->input->post('Respuestas');
        $respuestas = json_encode($respuestas);
        $respuestas = json_decode($respuestas);

        $idEvaluacion = $this->Evaluacion_modal->InsertEvaluacion( $TipoEvaluacion, $id_alumno, $clave_curso);
        
        $duracion = $this->Avance_modal->ConsultarDuracion($clave_curso,$id_alumno );
        
        $cantidadTema = 1;
        $totalPorcentajeTema = 0;
        $tema = '';
        foreach ($respuestas as $respuesta) {
            //$this->Preguntas_modal->InsertPreguntas( $respuesta -> idPregunta, $idEvaluacion, $id_alumno);

            if($tema != $respuesta -> tema){
                $tema = $respuesta -> tema;
                $totalPorcentajeTema = 0;
                $cantidadTema = 1;
            }
            else {
               $cantidadTema = $cantidadTema + 1;
            }
            
            $totalPorcentajeTema = $totalPorcentajeTema + $respuesta -> porcentaje;

            $avance = $this->Avance_modal->ConsultarAvance( $duracion->id, $respuesta -> tema );

            if($avance == null){

                if($totalPorcentajeTema > 0 )$prcAvance = $totalPorcentajeTema /  $cantidadTema;
                    else $prcAvance = 0;

                    if( $prcAvance < 100 ) $prcAvance = 0;

                $data = array( //Estos datos son para insertarse en la tabla avance
                    'avance'      => $prcAvance,
                    'revisado'    => 0,
                    'id_duracion' => $duracion->id,
                    'id_tema'     => $respuesta -> tema,
                    'evaluadoEn'  => 1
                );

                $this->Avance_modal->InsertarAvance($data);

            } else {

                if($totalPorcentajeTema > 0 )$prcAvance = $totalPorcentajeTema /  $cantidadTema;
                else $prcAvance = 0;

                if( $prcAvance < 100 ) $prcAvance = 0;

                $data = array( //Estos datos son para insertarse en la tabla avance
                    'avance'      => $prcAvance,
                    'revisado'    => 0,
                    'id_duracion' => $duracion->id,
                    'id_tema'     => $respuesta -> tema,
                    'evaluadoEn'  => 1
                );

                $this->Avance_modal->ActualizaAvance( $avance->id , $data);

            }

            $this->Respuesta_modal->InsertRespuestas( $respuesta -> opcion, $respuesta -> idPregunta, $idEvaluacion);
        }
            $avancePromedio = $this->actualizarInscripcion( $id_alumno, $clave_curso, null, $duracion);
        echo $avancePromedio;
    }

    public function EvaluarF(){
        
        $clave_curso =$this->input->post('IdCurso');
        $id_alumno   =$this->input->post('id_alumno');
        $TipoEvaluacion =$this->input->post('TipoEvaluacion');
        $respuestas = $this->input->post('Respuestas');
        $respuestas = json_encode($respuestas);
        $respuestas = json_decode($respuestas);

        $idEvaluacion = $this->Evaluacion_modal->InsertEvaluacion( $TipoEvaluacion, $id_alumno, $clave_curso);
        
        $duracion = $this->Avance_modal->ConsultarDuracion($clave_curso,$id_alumno );
        
        $cantidadTema = 1;
        $totalPorcentajeTema = 0;
        $tema = '';
        foreach ($respuestas as $respuesta) {
            //$this->Preguntas_modal->InsertPreguntas( $respuesta -> idPregunta, $idEvaluacion, $id_alumno);

            if($tema != $respuesta -> tema){
                $tema = $respuesta -> tema;
                $totalPorcentajeTema = 0;
                $cantidadTema = 1;
            }
            else {
               $cantidadTema = $cantidadTema + 1;
            }
            
            $totalPorcentajeTema = $totalPorcentajeTema + $respuesta -> porcentaje;

            $avance = $this->Avance_modal->ConsultarAvance( $duracion->id, $respuesta -> tema );

            if($avance == null){

                if($totalPorcentajeTema > 0 )$prcAvance = $totalPorcentajeTema /  $cantidadTema;
                    else $prcAvance = 0;

                    if( $prcAvance < 100 ) $prcAvance = 0;

                $data = array( //Estos datos son para insertarse en la tabla avance
                    'avance'      => $prcAvance,
                    'revisado'    => 0,
                    'id_duracion' => $duracion->id,
                    'id_tema'     => $respuesta -> tema
                );

                $this->Avance_modal->InsertarAvance($data);

            } else {

                if($totalPorcentajeTema > 0 )$prcAvance = $totalPorcentajeTema /  $cantidadTema;
                else $prcAvance = 0;

                if( $prcAvance < 100 ) $prcAvance = 0;

                $data = array( //Estos datos son para insertarse en la tabla avance
                    'avance'      => $prcAvance,
                    'revisado'    => 0,
                    'id_duracion' => $duracion->id,
                    'id_tema'     => $respuesta -> tema
                );

                $this->Avance_modal->ActualizaAvance( $avance->id , $data);

            }

            $this->Respuesta_modal->InsertRespuestas( $respuesta -> opcion, $respuesta -> idPregunta, $idEvaluacion);
        }
            $avancePromedio = $this->actualizarInscripcion( $id_alumno, $clave_curso, null, $duracion);
        echo $avancePromedio;
    }

    public function actualizarInscripcion($idUsuario,$idCurso,$ultimo,$Idduracion){
        $dur = $this->Avance_modal->getDuracion($Idduracion->id);
        $avances = $this->Avance_modal->ConsultarAvances($Idduracion->id);
        $ava = 0;
        foreach ($avances as $amt) {
            $obj = json_encode($amt);
            $jbo = json_decode($obj);
            $ava = $ava+$jbo->avance;
        }
        $avancePromedio = $ava/$dur->duracion;
        $this->Inscrito_modal->updateInscripcion($idUsuario,$idCurso,$ultimo,$avancePromedio);

        return $avancePromedio;
    }

}
?>