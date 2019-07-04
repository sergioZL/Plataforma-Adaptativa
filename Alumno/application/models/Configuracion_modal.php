<?php

class Configuracion_modal extends CI_Model{
    private $table;
    public function __construct()
    {
        $this->table = "configuracion";
        parent::__construct();
        $this->load->database();
    }

    public function Limite()
    {
        $this->db->select($this->table.'.numpregunta');
        $this->db->from( $this->table);
        $this->db->limit(1);

        $query = $this->db->get();

        return $query->row();
    } 
}