<?php

class Inscrito_Modal extends CI_Model{
    private $table;
    public function __construct()
    {
        $this->table = "inscrito";
        parent::__construct();
        $this->load->database();
    }

    public function ConsultarCursosUsuarios($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('cursos', $this->table.'.clave_curso = Cursos.clave','RIGHT');
        $this->db->where($this->table.'.clave_alumno',$id);
        $query = $this->db->get();

        return $query->result_array();
    }  
}