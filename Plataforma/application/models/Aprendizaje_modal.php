<?php

class Aprendizaje_modal extends CI_Model{
    private $table;
    public function __construct()
    {
        $this->table = "aprendizaje";
        parent::__construct();
        $this->load->database();
    }

    public function ConsultarAprendizajeCurso($idUsuario,$idCurso)
    {
        $this->db->select($this->table.'.aprendizaje');
        $this->db->from( $this->table);
        $this->db->join('cursos', $this->table.'.clave_curso = cursos.clave','INNER');
        //$this->db->join('inscrito','inscrito.clave_curso = cursos.clave','INNER');
        //$this->db->where('inscrito.clave_alumno',$idUsuario);
        $this->db->where('cursos.clave',$idCurso);
        $query = $this->db->get();

        return $query->result_array();
    } 
}