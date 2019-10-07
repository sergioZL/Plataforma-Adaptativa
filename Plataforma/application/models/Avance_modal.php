<?php 
    public class Avance_modal extends CI_Model{
        private $table;
        public function __construct()
        {
            $this->table = "avance";
            parent::__construct();
            $this->load->database();
        }
    }
?>