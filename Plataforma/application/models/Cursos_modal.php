<?php

class Cursos_modal extends CI_Model{
    private $table;
    public function __construct()
    {
        $this->table = "cursos";
        parent::__construct();
        $this->load->database();
    }

    public function ConsultarCursos()
    {
        $this->db->select($this->table.'.*');
        $this->db->from($this->table);
        $query = $this->db->get();

        return $query->result_array();
    } 

    public function ConsultarPorIDCursos($id)
    {
        $this->db->select($this->table.'.*');
        $this->db->from($this->table);
        $this->db->where($this->table.'.clave',$id);
        $query = $this->db->get();

        return $query->result_array();
    } 

    public function ConsultarBuscarCursos($nombre)
    {
        $this->db->select($this->table.'.*');
        $this->db->from($this->table);
        $this->db->like($this->table.'.nombre', $nombre, 'both');
        $query = $this->db->get();

        return $query->result_array();
    } 
}