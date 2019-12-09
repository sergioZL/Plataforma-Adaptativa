<?php

class BancoPreguntas_modal extends CI_Model{
    private $table;
    public function __construct()
    {
        $this->table = "banco_preguntas";
        parent::__construct();
        $this->load->database();
    }

    public function ConsultarPreguntas($idTema,$limit)
    {
        $this->db->select($this->table.'.*');
        $this->db->from( $this->table);
        $this->db->join('temas', $this->table.'.id_tema  = temas.id','INNER');
        $this->db->where('temas.id',$idTema);
        $this->db->order_by('rand()');
        $this->db->limit($limit);
        $query = $this->db->get();
        

        return $query->result_array();
    } 

    public function ConsultarPreguntasNRespuesta($idpregunta)
    {
        $this->db->distinct();
        $this->db->select($this->table.'.*');
        $this->db->from( $this->table);
        $this->db->where( $this->table.'.id',$idpregunta);
        $query = $this->db->get();
        
        return $query->result_array();
    }

    public function ConsultarPreguntasRespuesta($idpregunta)
    {
        $this->db->select($this->table.'.*');
        $this->db->from( $this->table);
        $this->db->where( $this->table.'.id',$idpregunta);
        $query = $this->db->get();
        
        return $query->result_array();
    }

    // ========================================================================================================
    //      Actualiza la una pregunta
    // ========================================================================================================

    public function updatePreguntas($id,$data){
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }

    // ========================================================================================================
    //      Actualiza la una opción
    // ========================================================================================================

    public function updateOpcion($id,$data){
        $this->db->where('id_opciones', $id);
        $this->db->update('opciones', $data);
    }

    // ========================================================================================================
    //      Elimina la pregunta 
    // ========================================================================================================
    public function deletePregunta($id){
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }
}

