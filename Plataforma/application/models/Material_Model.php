<?php
    class Material_Model extends CI_Model {
        private $table;
        public function __construct()
        {
            $this->table = "material";
            parent::__construct();
            $this->load->database();
        }

        public function encontrarMaterial($idTema){
            $this->db->select();
            $this->db->from($this->table);
            $this->db->where($this->table.'.id_temas',$idTema);
            $query = $this->db->get();

            return $query->result_array();
        }

    }
?>