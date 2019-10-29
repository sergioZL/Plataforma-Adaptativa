<?php

class Lecciones_modal extends CI_Model{
    private $table;
    public function __construct()
    {
        $this->table = "lecciones";
        parent::__construct();
        $this->load->database();
    }

    public function ConsultarLeccionesCursos($id)
    {
        $this->db->select($this->table.'.*,temas.id, temas.secuencia as secuenciaTema ,temas.id_leccion,temas.nombre as nombreTema');
        $this->db->from($this->table);
        $this->db->join('temas', $this->table.'.clave = temas.id_leccion','right');
        $this->db->where($this->table.'.clave_curso',$id);
        $this->db->order_by($this->table.'.secuencia', "ASC");
        $query = $this->db->get();

        return $query->result_array();
    } 

    public function ConsultarLeccionesPorCurso($id)
    {
        $this->db->select($this->table.'.*,temas.id, temas.secuencia as secuenciaTema ,temas.id_leccion,temas.nombre as nombreTema');
        $this->db->from($this->table);
        $this->db->join('temas', $this->table.'.clave = temas.id_leccion','right');
        $this->db->where($this->table.'.clave_curso',$id);
        $this->db->order_by($this->table.'.secuencia', "ASC");
        $query = $this->db->get();

        return $query->result_array();
    } 

    public function ConsultarTodosLeccionesCursos($id)
    {
        $this->db->select($this->table.'.*');
        $this->db->from($this->table);
        $this->db->where($this->table.'.clave_curso',$id);
        $this->db->order_by($this->table.'.secuencia', "ASC");
        $query = $this->db->get();

        return $query->result_array();
    } 
}