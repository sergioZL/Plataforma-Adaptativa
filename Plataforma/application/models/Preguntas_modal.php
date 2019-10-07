<?php

class Preguntas_modal extends CI_Model{
    private $table;
    public function __construct()
    {
        $this->table = "preguntas";
        parent::__construct();
        $this->load->database();
    }

    public function InsertPreguntas($id_pregunta,$id_evaluacion,$id_alumno)
    {
        $data = array('id_pregunta' => $id_pregunta,'id_alumno' => $id_alumno, 
                    'id_evaluacion' => $id_evaluacion);

        $this->db->insert($this->table,$data);  
        
        $insertId = $this->db->insert_id();
        return $insertId;    
    } 
}

