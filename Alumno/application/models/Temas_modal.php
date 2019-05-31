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
}