<?php

require 'vendor/autoload.php';
use Phpml\Classification\KNearestNeighbors;

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
        $this->load->model('valoracion_Model');
        $this->load->model('Preguntas_Model');
        $this->load->model('Respuesta_modal');
    }

    public function load_Material()
    {
        $this->load->view('Material/Material');
    }
    
    
    public function testMl(){
        
        $samples = [[0,1,0],[1,0,1],[1,0,2],[1,0,2],[1,0,1]]; // Cáda uno de los datos en el arreglo representa el tipo de aprendizaje de los alumnos

        $labels = ['1','4','3','3','4']; // Aquí irán los id de los materiales
        
        $classifier = new KNearestNeighbors(); 

        $classifier->train($samples, $labels); // Se entrena el algoritmo con los resultados de la consulta 
        
        echo $classifier->predict([0,0,1]); // Se realiza la predicción con los datos del nuevo alumno
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

    //Optiene las lecciones por curso con sus respectivos temas y materiales
    public function TemarioLateral(){
       
        $id = $this ->  input -> get( 'IdCurso' );
        $idUsuario = $this -> input -> post( 'Usuario' );
        $duracion = $this->Avance_modal->ConsultarDuracion( $id, $idUsuario);
        $lecciones = $this-> Lecciones_modal -> ConsultarTodosLeccionesCursos(  $id );
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

				$tema = new stdClass;
				
				if($total != null){ 
					$tema->evaluado = array('total' => $total[0]->total, 'porcentaje' => $porcentResp[0]->porc);
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
                $rep = 1;
            $datos = array(//Estos datos son para insertar en la tabla avance_material
                'idavance'   => $idavance, 
                'idmaterial' => $ultimo->material,
                'avance'     => $ultimo->avance,
                'conpletado' => $comple,
                'revisiones' => $revisiones,
                'tiempo_promedio' => $ultimo->tiempo_promedio,
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
                     'tiempo_promedio' => $ultimo->tiempo_promedio,
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
         if( $data->avance != $ultimo->avance) $data->repeticiones = $data->repeticiones + 1; //si el nuevo avance es diferente se aumenta el numero de repeticiones del material
         $data->avance = $ultimo->avance; //Se coloca el nuevo avance
         if( $data->tiempo_promedio > 0 ) $data->tiempo_promedio = ($ultimo->tiempo_promedio + $data->tiempo_promedio)/2;
         else $data->tiempo_promedio = $ultimo->tiempo_promedio;
         if( $ultimo->avance > ($data->duracion - 5) ){
             $data->avance = $data->duracion;
             $data->conpletado = 1; //si el avance del material es mayor a el tiempo de duracion del material menos dos segundos se marca como completado
        }
         else $data->conpletado = 0;
         $data->revisiones = $data->revisiones+1; //se aumenta en uno el numero de revisiones del material
         $this->Avance_modal->updateAvanceMaterial($data);//Se actualiza el registro en la base de datos
         echo json_encode($data);
    }
    // ===========================================================
    //  Optiene las preguntas para la valoracion del material
    // ===========================================================
    public function optenerPreguntasValoracion(){
        $idUsuario = $this->input->get('usuario');
        $material=   $this->input->get('material');
        $valoracion = $this->valoracion_Model->getValoracionMaterial( $idUsuario, $material);
        if( !$valoracion ){
            $categorias = $this->valoracion_Model->getCategorias();
            foreach ($categorias as $categoria) {

                $paginaPreguntas = new stdClass;
                $paginaPreguntas->id = $categoria['id'];
                $paginaPreguntas->categoria = $categoria['categoria'];

                $preguntas = $this->valoracion_Model->getPreguntas( $categoria['id'] );

                $paginaPreguntas->preguntas = $preguntas;

                $paginas [] = $paginaPreguntas;
            }

            echo json_encode($paginas);
        }else echo 'valorado';
    }

    // ===========================================================
    //  Consulta si el usuario ha realizado una valoración antes
    // ===========================================================

    public function valorar(){
        $data = $this->input->post('valoracion');
        //$data = json_decode($data);
        $idInsertado = $this->valoracion_Model->setValoracion($data);
        echo $idInsertado;
    }

    // ===========================================================
    //  Consulta si el usuario ha realizado una valoración antes
    // ===========================================================
    function valorado( $idUsuario = '141340', $idPregunta='1', $material = '2'){
        $valoracion = $this->valoracion_Model->getValoracion( $idUsuario, $idPregunta, $material='2');

        if( !$valoracion){
            return false;
        }else return true;
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
