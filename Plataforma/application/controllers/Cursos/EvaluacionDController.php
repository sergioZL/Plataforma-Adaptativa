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
	}


	public function load_Evaluacion()
	{
		$this->load->view('Cursos/EvaluacionD');
		
	}

    public function CargarPreguntas(){
        
        $Curso = $this->input->get('Curso');

        $limit = $this->Configuracion_modal->Limite();

        $TemasLecciones = $this->Lecciones_modal->ConsultarLeccionesPorCurso($Curso);
        $let = 0;
        foreach ($TemasLecciones as $tema) {
            $Preguntas = $this->BancoPreguntas_modal->ConsultarPreguntas($tema['id'],10);
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

        foreach ($respuestas as $respuesta) {
            //$this->Preguntas_modal->InsertPreguntas( $respuesta -> idPregunta, $idEvaluacion, $id_alumno);
            
            $this->Respuesta_modal->InsertRespuestas( $respuesta -> opcion, $respuesta -> idPregunta, $idEvaluacion);
        }
        echo json_encode($idEvaluacion);
    }
}
?>