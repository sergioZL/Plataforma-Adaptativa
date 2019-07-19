<?php

class Respuesta_modal extends CI_Model{
    private $table;
    public function __construct()
    {
        $this->table = "respuestas";
        parent::__construct();
        $this->load->database();
    }

    public function InsertRespuestas($id_opcion,$id_pregunta,$id_evaluacion)
    {
        $data = array('id_opcion' => $id_opcion,'id_pregunta' => $id_pregunta, 
                    'id_evaluacion' => $id_evaluacion);

        $this->db->insert($this->table,$data);  
        
        $insertId = $this->db->insert_id();
        return $insertId;    
    } 

    public function ConsultarPreguntasNRespuesta($id_evaluacion)
    {
        $this->db->distinct();
        $this->db->select('id_pregunta');
        $this->db->from( $this->table);
        $this->db->where( $this->table.'.id_evaluacion',$id_evaluacion);
        $query = $this->db->get();
        
        return $query->result_array();
    }

    public function ConsultarRespuestas($id)
    {
        $this->db->select($this->table.'.*');
        $this->db->from( $this->table);
        $this->db->where($this->table.'.id_evaluacion',$id);
        $query = $this->db->get();

        return $query->result_array();
    } 

    public function ConsultarResultadoRespuestas($idevaluacion,$npreguntas)
    {
        $this->db->select('sum(porcentaje)');
        $this->db->from( $this->table);
        $this->db->join('respuestas', $this->table.'.id_pregunta  = respuestas.id_pregunta','LEFT');
        $this->db->where($this->table.'.id_evaluacion',$idevaluacion);
        $query = $this->db->get();

        return $query->row();
    }


}

