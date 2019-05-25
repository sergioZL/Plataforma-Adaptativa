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

    public function ConsultarCursosMenor($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('cursos', $this->table.'.clave_curso = Cursos.clave','RIGHT');
        $this->db->where($this->table.'.clave_alumno',$id);
        $this->db->order_by($this->table.'.avance', "ASC");
        $query = $this->db->get();

        return $query->result_array();
    } 

    public function ConsultarCursosMayor($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);   
        $this->db->join('cursos', $this->table.'.clave_curso = Cursos.clave','RIGHT');
        $this->db->where($this->table.'.clave_alumno',$id);
        $this->db->order_by($this->table.".avance", "DESC");
        $query = $this->db->get();

        return $query->result_array();
    } 

    public function ConsultarCursosAlfaMenor($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('cursos', $this->table.'.clave_curso = Cursos.clave','RIGHT');
        $this->db->where($this->table.'.clave_alumno',$id);
        $this->db->order_by('nombre', "DESC");
        $query = $this->db->get();

        return $query->result_array();
    } 

    public function ConsultarCursosAlfaMayor($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);   
        $this->db->join('cursos', $this->table.'.clave_curso = Cursos.clave','RIGHT');
        $this->db->where($this->table.'.clave_alumno',$id);
        $this->db->order_by('nombre', "ASC");
        $query = $this->db->get();

        return $query->result_array();
    } 
}