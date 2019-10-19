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
        $this->load->model('Avance_modal');
        $this->load->model('Inscrito_modal');
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
        $idCurso = $this->input->post('Curso');
        $idUsuario = $this->input->post('Usuario');

        $duracion = $this->Avance_modal->ConsultarDuracion($idCurso,$idUsuario);
        
		$Tema = $this->Temas_modal->ConsultarTemasCursos($id);
		
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
                $carga = $carga.'<button style="width: 100%;" class="btn btn-link" onclick="mostrar('.$ruta.','.$tipo.','.$mat['id'].','. $ava.');"><p class="h6 pull-left"> 
                <span class="'.$icono.'"></span>
                '.$mat['descripcion_material'].'
                </p>
                <div class="progress" style="height:3px; width: 100%;">
                    <div class="progress-bar bg-info" role="progressbar" style="width: '.$porcent.'%; height:5px;" aria-valuenow="'.$porcent.'" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                 </button><br>';
            }
            }
            $avanceTema = 0;
            if($avance) $avanceTema = $avance->avance;
			echo $nose ='<div class="card rounded-0"  >
                <h5 class="card-header" style="height: 70px;">
                    <a data-toggle="collapse" href="#content'. $item['id'] .'" aria-expanded="true"
                        aria-controls="content'. $item['id'] .'" id="Tema'. $item['id'] .'" class="d-block">
                        <i class="fa fa-chevron-down pull-right"></i>
                        <p class="font-weight-bold temas"><small> <span class=" badge badge-primary badge-pill">'.$avanceTema.'%</span>Tema '. $item['secuencia'].': '.$item['nombre'].'</small><p>
                    </a>
                </h5>
                <div id="content'. $item['id'] .'" class="collapse carta-body" aria-labelledby="Tema'. $item['id'] .'">
                    <!--<div class="card-body carta-body" style="width: 100%;">

                    </div>-->
                    '.$carga.'
                </div>
            </div>';
			
        }
    }
    public function cargarMaterial($id){
        //$material = $this->Material_Model->encontrarMaterial($id);
        $material = $this->Avance_modal->getavanceMaterialTema($id);
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
    /**
     * Sirve para colocar el ultimo material consultado en la base de datos
     */
    public function setUltimo(){
        $utlimoMaterial = $this->input->post('ultimo');
        $idCurso = $this->input->post('Curso');
        $idUsuario = $this->input->post('Usuario');
        $ultimo = json_decode($utlimoMaterial);
        
        //Consultamos si ya existe un avance registrado en este curso
        $duracion = $this->Avance_modal->ConsultarDuracion($idCurso,$idUsuario);
        $avance = $this->Avance_modal->ConsultarAvance($duracion->id,$ultimo->tema);
        
        /**
         * Si existe un avance registrado con esta duracion pasamos a consultar si hay un 
         * avance material registrado sino registramos un nuevo avance
        */

        if($avance == null){//Si no hay avance en este tema se inserta un nuevo avance
            
            $revisado = 1;
            $av = 0;
            $data = array( //Estos datos son para insertarse en la tabla avance
                'avance'      => $av,
                'revisado'    => $revisado,
                'id_duracion' => $duracion->id,
                'id_tema'     => $ultimo->tema 
            );

            $idavance = $this->Avance_modal->InsertarAvance($data); //esta varialble tiene almacenado el id del avance registrado
                $comple = false;
                $revisiones = 1;
                $pro = 10;
                $rep = 1;
            $datos = array(//Estos datos son para insertar en la tabla avance_material
                'idavance'   => $idavance, 
                'idmaterial' => $ultimo->material,
                'avance'     => $ultimo->avance,
                'conpletado' => $comple,
                'revisiones' => $revisiones,
                'tiempo_promedio' => $pro,
                'repeticiones' => $rep,
                'duracion' => $ultimo->duracion
            );
            $this->Avance_modal->InsertarAvanceMaterial($datos);//Se inserta el avance en la tabla avance_material
            //Se actualisa la tabla avance con el nuevo avance 
            $this->actualizarAvance($idavance,$ultimo->tema);
        }else{
             $avanceMaterial = $this->Avance_modal->ConsultarAvanceMaterial($avance->id,$ultimo->material);
             if($avanceMaterial){//Si el material visitado por el usuario ya esta en la tabla se actualiza
                 $this->actualizarAvanceMaterial($avanceMaterial, $ultimo );
             }else{//sino se agrega el material 
                
                 $comple = false;
                 $revisiones = 1;
                 $pro = 10;
                 $rep = 1;
                 $datos = array(//Estos datos son para insertar en la tabla avance_material
                     'idavance'   => $avance->id, 
                     'idmaterial' => $ultimo->material,
                     'avance'     => $ultimo->avance,
                     'conpletado' => $comple,
                     'revisiones' => $revisiones,
                     'tiempo_promedio' => $pro,
                     'repeticiones' => $rep,
                     'duracion' => $ultimo->duracion
                 );

                $this->Avance_modal->InsertarAvanceMaterial($datos);//Se inserta el avance en la tabla avance_material
            }
             
            //Se actualiza el avance de este tema
            $this->actualizarAvance($avance->id,$ultimo->tema);   
        }
        // Finalmente se coloca el ultimo material visitado en la tabla inscrito
        $this->actualizarInscripcion($idUsuario,$idCurso,$ultimo->material,$duracion);   
    }
    /**
     * Actualiza la inscripcion
     */
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
    }
    /**
     * actualiza la tabla avance con el nuevo avance
     */
    public function actualizarAvance($idavance,$idTema){
        
        //se optiene el porcentaje promedio de los avances de cada material
        //consultando el total de avance material unido a los materiales que hay por tema
        $cantidad = 0;
        $porcentaje = 0;
        $porcentajePromedio = 0;
        $avanceMaterialTema = $this->Avance_modal->getavanceMaterialTema($idTema);
        $avance = $this->Avance_modal->getAvance($idavance);
        foreach ($avanceMaterialTema as $amt) {   
            $obj = json_encode($amt);
            $jbo = json_decode($obj);
            if( !$jbo->idavance || $jbo->idavance == $idavance ){    
                $cantidad = $cantidad + 1;
                $total = $jbo->duracion;
                $ava = $jbo->avance;
                $revisado = $avance->revisado+1;
                $prc = 0;
                if($total){
                    $prc = $ava * 100 / $total;
                    if($jbo->conpletado == 1) $prc = 100;
                }
                $porcentaje = $porcentaje+$prc;
                echo json_encode($avance); 
            }
        }
        $porcentajePromedio = $porcentaje / $cantidad;
        $psp = round( $porcentajePromedio );
        $this->Avance_modal->updateAvance( $idavance , $psp , $revisado);//Actualiza el avance del tema
    }
    /**
     * Actualiza la tabla avance_material 
     */
    public function actualizarAvanceMaterial( $datos, $last ){
         $data = json_decode(json_encode($datos[0]));
         $ultimo = json_decode(json_encode($last));
         $data->avance = $ultimo->avance; //Se coloca el nuevo avance
         if( $ultimo->avance > ($data->duracion - 5) ){
             $data->avance = $data->duracion;
             $data->conpletado = 1; //si el avance del material es mayor a el tiempo de duracion del material menos dos segundos se marca como completado
        }
         else $data->conpletado = 0;
         $data->revisiones = $data->revisiones+1; //se aumenta en uno el numero de revisiones del material
         $this->Avance_modal->updateAvanceMaterial($data);//Se actualiza el registro en la base de datos
    }
}
