<?php

class EvaluacionController extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->helper('url_helper');
		$this->load->model('Cursos_modal');
		$this->load->model('BancoPreguntas_modal');
		$this->load->model('Opciones_modal');
		$this->load->model('Configuracion_modal');
		$this->load->model('Lecciones_modal');
    }

	public function load_Evaluacion()
	{
		$this->load->view('Cursos/Evaluacion');
	}

	public function ConsultarPorIDCursos()
	{	
		session_start();
		$id = $_SESSION['usuario'];
		$curso =$this->input->get('IdCurso');
		$Curso = $this->Inscrito_modal->ConsultarCursosTemario($id,$curso);
        
        echo json_encode($Curso);
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
				$p='<div class="pregresp">
					<div class="pregunta">'.$i.'. '.$pregunta['enunciado'].'<br/></div>
					<div class="respuestas">';

				if($pregunta['imagen']!=null)
					$p = $p.'<div >
					<button id="VerImg" type="button" class="btn btn-primary" onclick="abrir()" data-target="#ModalImagen" data-toggle="modal" > Ver Imagen</button>
					</div><br/>';


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
								<input type="checkbox" name="preg'.$i.'" value="'.$item['id_opciones'].'">
								<img src="data:image/jpg;base64,'.$item['imagen'].'"/>
							</label></div><br>';

							$radio=$radio.'<div>
							<label>
								<input type="radio" name="preg'.$i.'" value="'.$item['id_opciones'].'">
								<img class="imgresp" src="data:image/jpg;base64,'.$item['imagen'].'"/>
							</label></div><br>';
						}else{

							$radio = $radio.'<input type="radio" name="preg'.$i.'" value="'.$item['id_opciones'].'"/> '.$item['enunciado'].'<br/>';
							$check = $check.'<input type="checkbox" name="preg'.$i.'" value="'.$item['id_opciones'].'"/> '.$item['enunciado'].'<br/>';
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
}
