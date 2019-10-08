<?php 
error_reporting(0);
session_start();

$varsesion = $_SESSION['usuario'];
if($varsesion == null|| $varsesion == '')
{
	header("location:../../../index.php");
}
$_SESSION["newsession"]=$value;
echo $_SESSION["newsession"];

class ConfiguracionController extends CI_Controller {

	var $nombre_curso;
	var $clave_curso_global;

	public function __construct() {
		parent::__construct();
			$this->load->helper('url_helper');
			$this->load->model('configuracion_model');
			$this->load->model('Preguntas_Model');
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->library('user_agent');
			$this->load->helper(array('form', 'url'));
    }

	// MÉTODOS ENCARGADOS DE LAS VISTAS
	public function cargarInicio() {
		$this->load->view('Configuracion/TodosCursos');
	}

	public function index()
	{
		//$this->load->view('Configuracion/TodosCursos');	
		$this->load->view('Configuracion/CursoNuevo');
	}

	public function nuevo_curso() 
	{
		$this->load->view('Configuracion/CursoNuevo');
	}

	public function cargarVistaLecciones() {
		$this->load->view('Configuracion/Lecciones');
	}

	public function cargarVistaTema() {

		$id_tema = $this->input->get('id_tema');

		$this->load->view('Configuracion/Temas');
		//header('Location:'.base_url().'/index.php/cursos/nuevo_curso/contenido_tema?id_tema='.$id_tema);
	}
	
	// MÉTODOS ENCARGADOS DE LOS MODELOS
	public function getCursos() {
		
		$data = $this->configuracion_model->getCursos();
 
		echo json_encode($data);	
	}

	public function agregarCurso() {

		$clave = $this->input->post('clave');
		$nombre = $this->input->post('nombre');
		$categoria = $this->input->post('categoria');
		$clave_carrera = $this->input->post('carrera');
		$descripcion = $this->input->post('descripcion');
		//$foto = $this->input->post('foto');

		$foto = base64_encode(file_get_contents($_FILES['foto']['tmp_name']));


		$result = $this->configuracion_model->agregarCurso($clave, $nombre, $categoria, $clave_carrera, $descripcion, $foto);

		$_SESSION['nombre_curso'] = $nombre;
		$_SESSION['clave_curso'] = $clave;

		if(is_null($result))
			echo 'No se inscribió al curso';
		else {
			$this->load->view('Configuracion/Lecciones');
			header('Location:'.base_url().'index.php/cursos/nuevo_curso/lecciones?nombre='.$_SESSION['nombre_curso'].'&clave_curso='.$_SESSION['clave_curso']);
			echo $_SESSION['nombre_curso'];
			echo $_SESSION['clave_curso'];
		}
	}

	public function getLeccionesPorCurso() {

		$clave_curso = $this->input->get('clave_curso');
		$data = $this->configuracion_model->getLeccionesPorCurso($clave_curso);

		echo json_encode($data);
	}

	public function getLeccionesCount() {

		$clave_curso = $this->input->get('clave_curso');
		$data = $this->configuracion_model->getLeccionesCount($clave_curso);

		echo json_encode($data);
	}

	public function agregarLeccion() {

		$nombre = $this->input->post('nombre_leccion');
		$secuencia = $this->input->post('secuencia_leccion');
		$clave_curso = $this->input->post('clave_curso');
		$descripcion = $this->input->post('descripcion_leccion');

		$resultado = $this->configuracion_model->agregarLeccion($nombre, $secuencia, $clave_curso, $descripcion);

		if(is_null($resultado)) {
			echo 'no jaló';
		}
		else {
			header('Location:'.$_SERVER['HTTP_REFERER']);
		}
	}

	public function getTemasPorLeccion() {

		$id_leccion = $this->input->get('id_leccion');
		$data = $this->configuracion_model->getTemasPorLeccion($id_leccion);

		echo json_encode($data);
	}

	public function agregarTema() {

		$nombre = $this->input->post('nombre_tema');
		$secuencia = $this->input->post('secuencia_tema');
		$id_leccion = $this->input->post('id_leccion');
		$descripcionTema = $this->input->post('descripcion_tema');

		$resultado = $this->configuracion_model->agregarTema($nombre, $secuencia, $id_leccion, $descripcionTema);

		if(is_null($resultado)) {
			echo 'No jaló';
		}else {
			echo 'Se agregó tema';
			header('Location:'.$_SERVER['HTTP_REFERER']);
		}
	}

	public function getTemasCount() {

		$id_leccion = $this->input->get('id_leccion');
		$data = $this->configuracion_model->getTemasCount($id_leccion);
		//intval($data);

		echo $data;
	}

	public function getCategorias() {
		
		$data = $this->configuracion_model->getCategorias();

		echo json_encode($data);
	}

	public function getCarreras() {

		$data = $this->configuracion_model->getCarreras();

		echo json_encode($data);
	}
 
	public function getCategoriasPorCarrera() {

		$clave_carrera = $this->input->get('clave_carrera');
		$data = $this->configuracion_model->getCategoriasPorCarrera($clave_carrera);

		echo json_encode($data);
	}

	public function getMaterialPorTema() {

		$id_tema = $this->input->get('id_tema');
		$data = $this->configuracion_model->getMaterialPorTema($id_tema);

		echo json_encode($data);
	}

	public function agregarMaterial() {

		$tipo_material = $this->input->get('tipo_material');
		$descripcion_material = $this->input->get('descripcion_material');
		$id_temas = $this->input->get('id_tema');

		$resultado = $this->configuracion_model->agregarMaterial($tipo_material, $descripcion_material, $id_temas);

		if(is_null($resultado)) {
			echo '<script type="text/javascript">alert("no jaló");</script>';
		}else {
			header('Location:'.$_SERVER['HTTP_REFERER']);
		}
	}

	public function getArbolData() {

		$id_tema = $this->input->get('id_tema');

		$id_leccion = $this->configuracion_model->getLeccion($id_tema);
		$clave_curso = $this->configuracion_model->getCurso($id_leccion);

		$data = array(
			'id_tema' => $id_tema,
			'id_leccion' => $id_leccion,
			'id_curso' => $clave_curso
		);

		$this->load->view('Configuracion/Temas',$data);
		//header('Location:'.base_url().'/index.php/cursos/nuevo_curso/contenido_tema?clave_curso='.$clave_curso.'&id_leccion='.$id_leccion.'&id_tema='.$id_tema);
	}

	public function getNombres() {

		$id_tema = $this->input->get('id_tema');
		$id_leccion = $this->input->get('id_leccion');
		$clave_curso = $this->input->get('clave_curso');

		$nombre_tema = $this->configuracion_model->getNombreTema($id_tema);
		$nombre_leccion = $this->configuracion_model->getNombreLeccion($id_leccion);
		$nombre_curso = $this->configuracion_model->getNombreCurso($clave_curso);

		$data = array(
			'nombre_tema' => $nombre_tema, 
			'nombre_leccion' => $nombre_leccion,
			'nombre_curso' => $nombre_curso
		);

		echo json_encode($data);
	}

	function do_upload() {

		$clave_curso = $this->input->post('clave_curso');
		$id_leccion = $this->input->post('id_leccion');
		$id_tema = $this->input->post('id_tema');
		$nombre = $this->input->post('descripcion_material');

        $path = './Material/';
        if (!is_dir($path.$clave_curso)) {
            mkdir($path.$clave_curso);
        }
        $path.= $clave_curso.'/';
        if(!is_dir($path.$id_leccion)) {
            mkdir($path.$id_leccion);
        }
		$path.= $id_leccion.'/';
		if(!is_dir($path.$id_tema)) {
			mkdir($path.$id_tema);
		}
		$path.= $id_tema.'/';

        $this->load->helper(array('form','url'));

		$config['upload_path'] 		= $path;
		//$config['allowed_types']	= 'png|jpg|mp3|mp4|pdf|doc|docx|mpeg|mwv ';
		$config['allowed_types']	= '*';
		$config['max_size']    		= 34096000;
		$config['remove_spaces'] 	= TRUE;
		$config['file_name']		= $nombre;

        $this->load->library('upload', $config);
 
		if (!$this->upload->do_upload()) 
		{
            print_r($this->upload->display_errors());
        }
        else{
			print_r($this->upload->data());

			$tipo_material = $this->input->post('tipo_material');
			$descripcion_material = $this->input->post('descripcion_material');

			$resultado = $this->configuracion_model->agregarMaterial($tipo_material, $descripcion_material, $id_tema, $clave_curso);

			$result = $this->configuracion_model->agregarRuta($path);

			echo $path;

			if(is_null($resultado) && is_null($result)) {
				echo '<script type="text/javascript">alert("no jaló");</script>';
				
			}else if(is_null($resultado) || is_null($result)) {
				echo '<script type="text/javascript">alert("uno de los dos no jaló");</script>';
			}else{
				echo '<script type="text/javascript">alert("sí jaló");</script>';
			}
        }
	}
	
	public function actualizarOrdenLecciones() {

		$i = 0;
		foreach ($_GET['item'] as $value) {
			// Execute statement:
			// UPDATE [Table] SET [Position] = $i WHERE [EntityId] = $value
			print_r($value);
			$i++;
		}

		//$resultado = $this->configuracion_model->actualizarOrdenLecciones($_POST['item']);

		/*if(is_null($resultado)) {
			echo 'no jaló';
		}else {
			echo 'si jaló';
		}*/
	}

	public function actualizarLecciones() {
		
		$items = $this->input->post('order');
		$total_items = count($this->input->post('order'));

		for($item = 0; $item < $total_items; $item++) {

			$itemplus = $item + 1;
			$this->configuracion_model->actualizarOrdenLeccion($itemplus, $items[$item]); 

			echo 'clave: '.$items[$item].'     secuencia: '.$itemplus;
		}
	}

	public function actualizarTemas() {
		
		$items = $this->input->post('order');
		$total_items = count($this->input->post('order'));
		
		for($item = 0; $item < $total_items; $item++) {

			$itemplus = $item + 1;
			$this->configuracion_model->actualizarOrdenLeccion($itemplus, $items[$item]); 

			echo 'clave: '.$items[$item].'     secuencia: '.$itemplus;
		}
	}
	/**	Apartir de aqui son los controladores para la parte de preguntas por tema */
	public function Preguntas(){

		$id_tema = $this->input->get('id_tema');

		$id_leccion = $this->configuracion_model->getLeccion($id_tema);
		$clave_curso = $this->configuracion_model->getCurso($id_leccion);

		$data = array(
			'id_tema' => $id_tema,
			'id_leccion' => $id_leccion,
			'id_curso' => $clave_curso
		);
		
		$this->load->view('Configuracion/Preguntas',$data);
	}
	public function getPreguntasTema(){
		$id_tema = $this->input->get('id_tema');

		$data = $this->Preguntas_Model->getPreguntasPorTema($id_tema);

		echo json_encode($data);
	}
	public function geOpcionesPorPregunta(){
		$id = $this->input->get('id');
		$data  = $this->Preguntas_Model->getOpcionesPorPregunta($id);
		if($data != null) echo json_encode($data);
		else echo null;
	}
	public function cargarModal(){
		$id_tema = $this->input->post('tema');
		$id_pregunta = $this->input->post('pregunta');

		$data = array(
			'id_tema' => $id_tema,
			'id_pregunta' => $id_pregunta
		);

		echo $this->load->view('Configuracion/modalPreguntas',$data);
		//echo $id_tema;
	}
	public function agregarPreguntas(){
		$enunciado = $this->input->post('enunciado');
		$foto = base64_encode(file_get_contents($_FILES['userImage']['tmp_name']));
		$id_tema = $this->input->post('id_tema');

		$id_leccion = $this->configuracion_model->getLeccion($id_tema);
		$clave_curso = $this->configuracion_model->getCurso($id_leccion);

		$data = array(
			'id_tema' => $id_tema,
			'enunciado' => $enunciado,
			'imagen' => $foto		
		);
		$this->Preguntas_Model->insertPregunta($data);
		$datos = array(
			'id_tema' => $id_tema,
			'id_leccion' => $id_leccion,
			'id_curso' => $clave_curso
		);

		$this->load->view('Configuracion/Preguntas',$datos);
	}
	public function agregarOpciones(){
		$id_tema = $this->input->post('id_tema');
		$id_leccion = $this->configuracion_model->getLeccion($id_tema);
		$clave_curso = $this->configuracion_model->getCurso($id_leccion);
		
		$enunciado = $this->input->post('enunciado');
		$foto = base64_encode(file_get_contents($_FILES['userImage']['tmp_name']));
		$id_pregunta = $this->input->post('id_pregunta');
		$porcentaje = $this->input->post('porcentaje');
		
		$data = array(
			'porcentaje' => $porcentaje,
			'enunciado' => $enunciado,
			'imagen' => $foto,	
			'id_pregunta' => $id_pregunta		
		);
		$datos = array(
			'id_tema' => $id_tema,
			'id_leccion' => $id_leccion,
			'id_curso' => $clave_curso
		);
		$this->Preguntas_Model->insertarOpciones($data);

		$this->load->view('Configuracion/Preguntas',$datos);
	}
}
 