<?php

class Opciones_modal extends CI_Model{
    private $table;
    public function __construct()
    {
        $this->table = "opciones";
        parent::__construct();
        $this->load->database();
    }

    public function ConsultarOpciones($idBancoPregunta)
    {
        $this->db->select($this->table.'.*');
        $this->db->from( $this->table);
        $this->db->where($this->table.'.id_pregunta',$idBancoPregunta);
        $this->db->order_by('rand()');
        $query = $this->db->get();

        return $query->result_array();
    } 

    public function ConsultarOpcionesRespuesta($idBancoPregunta)
    {
        $this->db->select($this->table.'.*');
        $this->db->from( $this->table);
        $this->db->where($this->table.'.id_pregunta',$idBancoPregunta);
        $query = $this->db->get();

        return $query->result_array();
    }
}