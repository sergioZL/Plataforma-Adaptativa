<?php

class Temas_modal extends CI_Model{
    private $table;
    public function __construct()
    {
        $this->table = "temas";
        parent::__construct();
        $this->load->database();
    }

    public function ConsultarLeccionesCursos($id)
    {
        $this->db->select('lecciones.*,'.$this->table.'.id, '.$this->table.'.secuencia as secuenciaTema ,'.$this->table.'.id_leccion,temas.nombre as nombreTema');
        $this->db->from($this->table);
        $this->db->join('lecciones', $this->table.'.id_leccion = lecciones.clave','right');
        $this->db->where('lecciones.clave_curso',$id);
        $this->db->order_by('lecciones.secuencia', "ASC");
        $query = $this->db->get();

        return $query->result_array();
    } 

    /*public function ConsultarTemasCursos($id)
    {
        $this->db->select($this->table.'.secuencia as secuenciaTema,temas.*,lecciones.*');
        $this->db->from($this->table);
        $this->db->join('lecciones', $this->table.'.id_leccion = lecciones.clave','inner');
        $this->db->where('lecciones.clave_curso',$id);
        $this->db->order_by($this->table.'.secuencia', "ASC");
        $query = $this->db->get();

        return $query->result_array();
    }*/
    
    public function ConsultarTemasCursos($id)
    {
        $this->db->select($this->table.'.*');
        $this->db->from($this->table);
        $this->db->where($this->table.'.id_leccion',$id);
        $this->db->order_by($this->table.'.secuencia', "ASC");
        $query = $this->db->get();

        return $query->result_array();
    } 
}