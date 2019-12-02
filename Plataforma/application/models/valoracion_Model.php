<?php
class valoracion_Model extends CI_Model{

    private $table;
    public function __construct()
    {
        $this->table = "valoracion";
        parent::__construct();
        $this->load->database();
    }
/**
 * ==========================================================================================================================
 *          Regresa las categorias de las preguntas de valoración 
 * ==========================================================================================================================
 */
    public function getCategorias(){
        $this->db->select();
        $this->db->from('categoria-valoracion');
        $query = $this->db->get();

        return $query->result_array();
    }
/**
 * ==========================================================================================================================
 *      Regresa las preguntas pertenecientes a cada una de las categorias de valoración
 * ==========================================================================================================================
 */
    public function getPreguntas($categoria){
        $this->db->select();
        $this->db->from('preguntas-valoracion');
        $this->db->where('preguntas-valoracion.idcategoriavaloracion',$categoria);
        $query = $this->db->get();

        return $query->result_array();
    }
/**
 * ==========================================================================================================================
 *              Inserta la valoración dada por el usuario
 * ==========================================================================================================================
 *  Recibe un array de objetos con los siguientes datos
 *   {
 *      idinscrito: idAlumno,                      El id del alumno que esta realizando la valoración
 *      idpv: idpregunta,                          El id de la pregunta que se esta valorando
 *      valoracion: pregunta.valoracion || 0,      La valoración dada por el usuario
 *      idmaterial: claveMaterial                  Clave del material al que pertenece la valoración
 *  }
 * 
 */
    public function setValoracion( $dataarray ){
        foreach ($dataarray as $data) {
            $this->db->insert( $this->table, $data);
        }
        return $this->db->insert_id();
    }
/**
 * ============================================================================================================================
 *                    Regresa la valoración que dio un usuario a una determinada pregunta de determinado material
 * ============================================================================================================================
 */
    public function getValoracion($idUsuario , $idPregunta, $material){
        
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where($this->table.'.idinscrito', $idUsuario);
        $this->db->where($this->table.'.idpv', $idPregunta);
        $this->db->where($this->table.'.idmaterial', $material);
        $query = $this->db->get();

        return $query->result_array();
    }
/**
 * =============================================================================================================================
 *                      Regresa la valoración de un material dada por un usuario
 * =============================================================================================================================
 */
    public function getValoracionMaterial( $idUsuario, $material){
        
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where($this->table.'.idmaterial', $material);
        $this->db->where($this->table.'.idinscrito', $idUsuario);
        $query = $this->db->get();

        return $query->result_array();
    }
/**
 * ==============================================================================================================================
 *                      Obtiene el material mejor valorador de determinado tema por cada usuario
 * ==============================================================================================================================
 */
    public function gerMejorValorado($idTema){

        $IdUsuarios = $this->getUsuariosValoracionTema($idTema);

        $MejoresValoraciones = $this->getMejoresValoradosUsuarioTema( $idTema, $IdUsuarios );

        $ajustados = $this->AjustarParametros($MejoresValoraciones);
        return $ajustados;
    }    
// ==============================================================================================================================
//      Obtiene los usuarios que han valorado materiales de determinado tema
// ==============================================================================================================================

    function getUsuariosValoracionTema($idTema){

        $this-> db ->select( 'idinscrito' );
        $this-> db ->from( $this->table );
        $this-> db ->join( 'alumnos', $this->table.'.idinscrito = alumnos.clave', 'RIGHT' );
        $this-> db ->join( 'material', $this->table.'.idmaterial = material.id', 'RIGHT' );
        $this-> db ->where( 'material.id_temas',$idTema);
        $this-> db ->group_by("idinscrito");
        $query = $this-> db ->get();

        return $query->result_array();

    }

// ================================================================================================================================
//  Regresa la valoración de los materiales de determinado usuario en determinado tema
// ================================================================================================================================

    function getValoracionPorUsuarioTema(   $idUsuario,  $idTema){
        
        $this-> db ->select(  'sum(valoracion) as valoracion, idmaterial, id_temas, alumnos.eavisual, alumnos.eaauditivo, alumnos.eacinestesico' );
        $this-> db ->from( $this->table );
        $this-> db ->join( 'alumnos', $this->table.'.idinscrito = alumnos.clave' );
        $this-> db ->join( 'material', $this->table.'.idmaterial = material.id' );
        $this-> db ->where( 'material.id_temas', $idTema );
        $this-> db ->where( 'alumnos.clave', $idUsuario );
        $this-> db ->group_by("idmaterial");

        $query = $this-> db ->get();

        return $query->result_array();

    }
// ==================================================================================================================================
//   Optine el material mejor valorado por cada usuario en un determinado tema
// ==================================================================================================================================

    function getMejoresValoradosUsuarioTema( $idTema, $IdUsuarios ){
        
        $valoraciones = array();

        foreach ($IdUsuarios as $Idusuario) {
            
            $valorados = $this->getValoracionPorUsuarioTema( $Idusuario['idinscrito'], $idTema );
            
            
            $MejorValorado = null;
            foreach ( $valorados as $valorado ) {
                if( $MejorValorado == null){
                    $MejorValorado = $valorado;
                } else if( $MejorValorado['valoracion'] < $valorado['valoracion']){
                    $MejorValorado = $valorado;
                }
            }
            if($MejorValorado != null) array_push($valoraciones, $MejorValorado);
            
        }
        
        return $valoraciones;
    }

// ==================================================================================================================================
//   Regresa los parametros de aprendizaje ajustados a a la siguiente estructura [ auditivo, cinestesico, visual ] = [ 0, 0, 1]
// ==================================================================================================================================
    function AjustarParametros( $Valoraciones ){
        
        $AjustValoraciones = array();

        

        foreach ( $Valoraciones as $valoracion ) {
            $mayoritario = false;

            if( $valoracion['eaauditivo'] > 28 ){

                if( $valoracion['eaauditivo'] > 49 ){

                    if( $valoracion['eacinestesico'] > 39 ){
                        
                        $valoracion['eaauditivo'] = 2;
                        $valoracion['eacinestesico'] = 1;
                        $valoracion['eavisual'] = 0;
                    
                    } else if( $valoracion['eavisual'] > 39){

                        $valoracion['eaauditivo'] = 2;
                        $valoracion['eacinestesico'] = 0;
                        $valoracion['eavisual'] = 1;
                    
                    } else {

                        $valoracion['eaauditivo'] = 1;
                        $valoracion['eacinestesico'] = 0;
                        $valoracion['eavisual'] = 0; 

                        $mayoritario = true;

                    }
                } else if( $valoracion['eaauditivo'] > 36)  $valoracion['eaauditivo'] = 2;
                    else $valoracion['eaauditivo'] = 1;

            } else $valoracion['eaauditivo'] = 0;

            if( $valoracion['eacinestesico'] > 28 && $mayoritario == false ){

                if( $valoracion['eacinestesico'] > 49 ){

                    if( $valoracion['eaauditivo'] > 39 ){

                        $valoracion['eaauditivo'] = 1;
                        $valoracion['eacinestesico'] = 2;
                        $valoracion['eavisual'] = 0;

                    } else if( $valoracion['eavisual'] > 39 ){

                        $valoracion['eaauditivo'] = 0;
                        $valoracion['eacinestesico'] = 2;
                        $valoracion['eavisual'] = 1;

                    } else {

                        $valoracion['eaauditivo'] = 0;
                        $valoracion['eacinestesico'] = 1;
                        $valoracion['eavisual'] = 0; 

                        $mayoritario = true;

                    }

                } else if ( $valoracion['eacinestesico'] > 36 ) $valoracion['eacinestesico'] = 2;
                else $valoracion['eacinestesico'] = 1;
            } else $valoracion['eacinestesico'] = 0;

            if( $valoracion['eavisual'] > 28 && $mayoritario == false){

                if( $valoracion['eavisual'] > 49 ){

                    if( $valoracion['eacinestesico'] > 39 ){
                        
                        $valoracion['eaauditivo'] = 0;
                        $valoracion['eacinestesico'] = 1;
                        $valoracion['eavisual'] = 2;
                    
                    } else if( $valoracion['eaauditivo'] > 39){

                        $valoracion['eaauditivo'] = 1;
                        $valoracion['eacinestesico'] = 0;
                        $valoracion['eavisual'] = 2;
                    
                    } else {

                        $valoracion['eaauditivo'] = 0;
                        $valoracion['eacinestesico'] = 0;
                        $valoracion['eavisual'] = 1; 

                        $mayoritario = true;

                    }

                }else if ( $valoracion['eavisual'] > 36 ) $valoracion['eavisual'] = 2;
                else $valoracion['eavisual'] = 1;

            } else $valoracion['eavisual'] = 0;
            
            array_push( $AjustValoraciones, $valoracion );
        }

        return $AjustValoraciones;
    }
}
?>