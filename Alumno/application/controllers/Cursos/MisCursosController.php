<?php

class MisCursosController extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper('form');       
		$this->load->helper('url_helper');
		$this->load->model('Inscrito_modal');
		$this->load->model('Categoria_modal');
    }

	public function load_MisCursos()
	{
		$this->load->view('Cursos/MisCursos');
	}

	public function ConsultarCursosTodosTemasUsuarios()
	{
			session_start();
			$varsesion = $_SESSION['usuario'];
					
			$Inscrito = $this->Categoria_modal->ConsultarCursosTodosTemasUsuarios($varsesion);

			foreach ($Inscrito as $inclito) {
				echo '<a id="Temas"  onclick="filtrarTemas('.$inclito['categoria'].')" class="dropdown-item">'.$inclito['descripcion'].'</a>';
			}
	}

	public function ConsultarCursosUsuarios()
	{		
		session_start();
		$varsesion = $_SESSION['usuario'];
		$tipo = $this->input->get('tipo');

		/*
			1 - todos
			2 - AZ
			3 - ZA
			4 - Mayor
			5 - Menor
			6 - Tema
		*/
		
		if($tipo == 1)
			$Inscrito = $this->Inscrito_modal->ConsultarCursosUsuarios($varsesion);
		else if($tipo == 2)
			$Inscrito = $this->Inscrito_modal->ConsultarCursosAlfaMayor($varsesion);
		else if($tipo == 3)
			$Inscrito = $this->Inscrito_modal->ConsultarCursosAlfaMenor($varsesion);
		else if($tipo == 4)
			$Inscrito = $this->Inscrito_modal->ConsultarCursosMayor($varsesion);
		else if($tipo == 5)
			$Inscrito = $this->Inscrito_modal->ConsultarCursosMenor($varsesion);
		else if($tipo == 6)
			$Inscrito = $this->Inscrito_modal->ConsultarCursosTemasUsuario($varsesion);
		        
		foreach ($Inscrito as $inclito) {
			
			if($inclito['avance'] > 99){$avance = "Completos";}
			if($inclito['avance'] >= 1 && $inclito['avance'] <=99){$avance = "EnCurso";}
			if($inclito['avance'] < 1){$avance = "SinEmpezar";}
			
		echo $Cursos =	
			'<div class="card-deck" style="margin-left: 20px;">
				<div class="filterDiv '.$avance.'">
				<a href="'.site_url().'/Material?curso='.$inclito['clave'].'" style="text-decoration:none ">
					<div class="card" style="width: 250px; min-height: 450px; max-height: 450px; ">
						<img class="card-img-top" style="max-height: 250px;"  src="data:image/jpg;base64,'. $inclito['foto'].'" alt="Card image cap">
						<div class="card-body">
						<ul class="list-group list-group-flush" style="margin-top: -15px;">
							<li class="list-group-item">'.$inclito['nombre'].'</li>
						</ul>
						<div class="Porcentaje" style="margin-top: 10px;">'.$inclito['avance'].'%<div class="progress"><div class="bar" style="width: '.$inclito['avance'].'%"></div></div> </div> 
							<p class="card-text" style="margin-top: 10px;">'.$inclito['descripcion'].'</p>
						</div>
					</div>
				</a>
			</div>';
		}
	}


}
