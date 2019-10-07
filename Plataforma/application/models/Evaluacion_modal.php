<?php

class Evaluacion_modal extends CI_Model{
    private $table;
    public function __construct()
    {
        $this->table = "evaluacion";
        parent::__construct();
        $this->load->database();
    }

    public function InsertEvaluacion($tipo,$clave_alumno,$clave_curso)
    {
        $data = array('tipo' => $tipo,'clave_alumno' => $clave_alumno,'clave_curso' => $clave_curso);

        $this->db->insert($this->table,$data);  
        
        $insertId = $this->db->insert_id();
        return $insertId;    
    } 
}

