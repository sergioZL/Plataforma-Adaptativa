<?php

class EvaluacionController extends CI_Controller {

	private $idEvaluacion;
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
		$this->load->view('Cursos/Evaluacion');
		
		//if($this->$idEvaluacion == null || $this->$idEvaluacion == "")
		//{
			self::Evaluacion('diagnostico',$this->input->get('curso'));
		//}
	}

	public function ConsultarPorIDCursos()
	{	
		session_start();
		$id = $_SESSION['usuario'];
		$curso =$this->input->get('IdCurso');

		$Curso = $this->Inscrito_modal->ConsultarCursosTemario($id,$curso);
        
        echo json_encode($Curso);
	}

	public function Evaluacion($TipoEvaluacion,$clave_curso)
	{	
		session_start();
		$clave_alumno = $_SESSION['usuario'];

		$this->$idEvaluacion = $this->Evaluacion_modal->InsertEvaluacion($TipoEvaluacion,$clave_alumno,$clave_curso);
		
		echo '<input id="idEvaluacion" type="hidden" value="'.$this->$idEvaluacion. '">';
	}

	public function EvaluacionPregunta()
	{	
		session_start();
		$id_alumno = $_SESSION['usuario'];
		$id_pregunta =$this->input->get('id_pregunta');

		$Curso = $this->Preguntas_modal->InsertPreguntas($id_pregunta,$this->$idEvaluacion,$id_alumno);
	}

	public function EvaluacionRespuestas()
	{	
		session_start();
		$id_alumno = $_SESSION['usuario'];
		$id_pregunta =$this->input->get('id_pregunta');

		$Curso = $this->Respuesta_modal->InsertRespuestas($id_opcion,$id_pregunta,$id_evaluacion);
	}
	
	public function ConsultarPregunta()
	{
		//$idTema = $this->input->get('IdTema');
		$Curso = $this->input->get('Curso');
		
		$i = 1;
		$limit = $this->Configuracion_modal->Limite();


		$Tema = $this->Lecciones_modal->ConsultarLeccionesPorCurso($Curso);
		foreach ($Tema as $tema)
		{
			$Pregunta = $this->BancoPreguntas_modal->ConsultarPreguntas($tema['id'],$limit->numpregunta);
			
			foreach ($Pregunta as $pregunta) 
			{
				$p='<div id="pregresp" class="pregresp">
					<div id="pregunta" class="pregunta">'.$i.'. '.$pregunta['enunciado'].'<br/></div>
					<input id="Npregunta" type="hidden" value="'.$pregunta['id']. '">
					<div id="respuestas" class="respuestas">';

				if($pregunta['imagen']!=null)
					$p = $p.'<div >
					<button id="VerImg" type="button" class="btn btn-primary" onclick="abrir()" data-target="#ModalImagen" data-toggle="modal" > Ver Imagen</button>
					</div><br/>';

					//'.$pregunta['imagen'].'
					//					<!--<img style="display:none" width="300px" height="375px" src="data:image/jpg;base64,'.$pregunta['imagen'].'" alt="">-->


				$PreguntasExamen = $this->Opciones_modal->ConsultarOpciones($pregunta['id']);
				if($PreguntasExamen!=null)
				{
					$porcentaje = 1;
					/*
					1- solo una pregunta
					2- mas de una pregunta
					*/
					$radio="";
					$check = "";
					foreach ($PreguntasExamen as $item) 
					{
						if($item['imagen']!=null)
						{
							$check=$check.'<div">
							<label">
								<input id="resp" type="checkbox" name="preg'.$i.'" value="'.$item['id_opciones'].'">
								<img src="data:image/jpg;base64,'.$item['imagen'].'"/>
							</label></div><br>';

							$radio=$radio.'<div>
							<label>
								<input id="resp" type="radio" name="preg'.$i.'" value="'.$item['id_opciones'].'">
								<img class="imgresp" src="data:image/jpg;base64,'.$item['imagen'].'"/>
							</label></div><br>';
						}else{

							$radio = $radio.'<input id="resp" type="radio" name="preg'.$i.'" value="'.$item['id_opciones'].'"/> '.$item['enunciado'].'<br/>';
							$check = $check.'<input id="resp" type="checkbox" name="preg'.$i.'" value="'.$item['id_opciones'].'"/> '.$item['enunciado'].'<br/>';
						}

						if($item['porcentaje']<=99 && $porcentaje==1)
						{
							if($item['porcentaje']>0)
								$porcentaje = 0;
						}
					}
						
					if($porcentaje==1)
						$p = $p.$radio;
					else
						$p = $p.$check;	
				}
				$i++;
				echo $p = $p.'</div></div>';
			}
		}
	}

	public function ConsultarRespuestaCorrecta()
	{
		$Curso = $this->input->get('Curso');
		$id_evaluacion = $this->input->get('id_evaluacion');
		
		$i = 1;
		$mala  = ' <i class="fas fa-times"></i>';
		$buena = ' <i class="fas fa-check"></i>';
		$respuesta= "";

		//$Evaluacion = $this->Respuesta_modal->ConsultarRespuestas($this->$idEvaluacion);
		$Evaluacion = $this->Respuesta_modal->ConsultarRespuestas($id_evaluacion);
	
		//$NPregunta = $this->Respuesta_modal->ConsultarPreguntasNRespuesta($this->$idEvaluacion);

		$NPregunta = $this->Respuesta_modal->ConsultarPreguntasNRespuesta($id_evaluacion);

		foreach($NPregunta as $npreguntas)
		{
			$Pregunta = $this->BancoPreguntas_modal->ConsultarPreguntasRespuesta($npreguntas['id_pregunta']);
					
			foreach ($Pregunta as $pregunta) 
			{
				$p='<div class="pregresp">
					<div class="pregunta">'.$i.'. '.$pregunta['enunciado'].'<br/></div>
					<div class="respuestas">';

				if($pregunta['imagen']!=null)
					$p = $p.'<div >
					<button id="VerImg" type="button" class="btn btn-primary" onclick="abrir()" data-target="#ModalImagen" data-toggle="modal" > Ver Imagen</button>
					</div><br/>';

					//'.$pregunta['imagen'].'
					//					<!--<img style="display:none" width="300px" height="375px" src="data:image/jpg;base64,'.$pregunta['imagen'].'" alt="">-->


				$PreguntasExamen = $this->Opciones_modal->ConsultarOpcionesRespuestas($npreguntas['id_pregunta']);
				
				if($PreguntasExamen!=null)
				{
					$porcentaje = 1;
					/*
					1- solo una pregunta
					2- mas de una pregunta
					*/
					$radio="";
					$check = "";

					foreach ($PreguntasExamen as $item) 
					{
						if($item['porcentaje'] > 0 && $item['id_opciones'] != $item['id_opcion'])
						{
							$respuesta = $respuesta.$item['enunciado'];
							if($item['imagen']!=null)
							{
								$respuesta = $respuesta.$item['imagen'];
							}
						}

						if($item['porcentaje'] > 0 && $item['id_opciones'] == $item['id_opcion'])
						{
							if($item['imagen']!=null)
							{
								$check=$check.'<div">
								<label">
									<input type="checkbox" name="preg'.$i.'" value="'.$item['id_opciones'].'" disabled checked>
									<img src="data:image/jpg;base64,'.$item['imagen'].'"/>
								</label>'.$buena.'</div><br>';

								$radio=$radio.'<div>
								<label>
									<input type="radio" name="preg'.$i.'" value="'.$item['id_opciones'].'" disabled checked>
									<img class="imgresp" src="data:image/jpg;base64,'.$item['imagen'].'"/>
								</label>'.$buena.'</div><br>';
							}else{

								$radio = $radio.'<input type="radio" name="preg'.$i.'" value="'.$item['id_opciones'].'" disabled checked/> '.$item['enunciado'].$buena.'<br>';
								$check = $check.'<input type="checkbox" name="preg'.$i.'" value="'.$item['id_opciones'].'" disabled checked/> '.$item['enunciado'].$buena.'<br>';
							}
						}else if($item['porcentaje'] == 0 && $item['id_opciones'] == $item['id_opcion'])
						{
							if($item['imagen']!=null)
							{
								$check=$check.'<div">
								<label">
									<input type="checkbox" name="preg'.$i.'" value="'.$item['id_opciones'].'" disabled checked>
									<img src="data:image/jpg;base64,'.$item['imagen'].'"/>
								</label>'.$mala.'</div><br>';

								$radio=$radio.'<div>
								<label>
									<input type="radio" name="preg'.$i.'" value="'.$item['id_opciones'].'" disabled checked> 
									<img class="imgresp" src="data:image/jpg;base64,'.$item['imagen'].'"/>
								</label>'.$mala.'</div><br>';
							}else{
								$radio = $radio.'<input type="radio" name="preg'.$i.'" value="'.$item['id_opciones'].'" disabled checked/> '.$item['enunciado'].$mala.'<br/>';
								$check = $check.'<input type="checkbox" name="preg'.$i.'" value="'.$item['id_opciones'].'" disabled checked/> '.$item['enunciado'].$mala.'<br/>';
							}
						}else if($item['id_opciones'] != $item['id_opcion'])
						{
							if($item['imagen']!=null)
							{
								$check=$check.'<div">
								<label">
									<input type="checkbox" name="preg'.$i.'" value="'.$item['id_opciones'].'" disabled>
									<img src="data:image/jpg;base64,'.$item['imagen'].'"/>
								</label></div><br>';

								$radio=$radio.'<div>
								<label>
									<input type="radio" name="preg'.$i.'" value="'.$item['id_opciones'].'" disabled>
									<img class="imgresp" src="data:image/jpg;base64,'.$item['imagen'].'"/>
								</label></div><br>';
							}else{

								$radio = $radio.'<input type="radio" name="preg'.$i.'" value="'.$item['id_opciones'].'" disabled/> '.$item['enunciado'].'<br/>';
								$check = $check.'<input type="checkbox" name="preg'.$i.'" value="'.$item['id_opciones'].'" disabled/> '.$item['enunciado'].'<br/>';
							}
						}
						
						if($item['porcentaje']<=99 && $porcentaje==1)
						{
							if($item['porcentaje']>0)
								$porcentaje = 0;
						}
					}

						
					if($porcentaje==1)
						$p = $p.$radio;
					else
						$p = $p.$check;	

				}
				$i++;
				
				if($respuesta != "")
					$p = $p.'<br></b>'.$respuesta.'</b>';

				//					$p = $p.'<br><!--<span style="background-color: #7DA5E0; width: 100%;">--></b>'.$respuesta.'</b><!--</span>-->';

				echo $p = $p.'</div></div>';
			}
		}
	}

	public function InsertRespuestas()
	{
		$id_opcion = $this->input->get('id_opcion');
		$id_pregunta = $this->input->get('id_pregunta');
		$id_evaluacion = $this->input->get('id_evaluacion');


		$respuesta = $this->Respuesta_modal->InsertRespuestas($id_opcion,$id_pregunta,$id_evaluacion);	

		//$respuesta = $this->Respuesta_modal->InsertRespuestas($id_opcion,$id_pregunta,$this->$idEvaluacion);	
	}

}