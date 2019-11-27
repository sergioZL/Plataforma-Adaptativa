<?php
class valoracion_Model extends CI_Model{

    private $table;
    public function __construct()
    {
        $this->table = "valoracion";
        parent::__construct();
        $this->load->database();
    }

    public function getCategorias(){
        $this->db->select();
        $this->db->from('categoria-valoracion');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getPreguntas($categoria){
        $this->db->select();
        $this->db->from('preguntas-valoracion');
        $this->db->where('preguntas-valoracion.idcategoriavaloracion',$categoria);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function setValoracion( $dataarray ){
        foreach ($dataarray as $data) {
            $this->db->insert( $this->table, $data);
        }
        return $this->db->insert_id();
    }

    public function getValoracion($idUsuario , $idPregunta, $material){
        
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where($this->table.'.idinscrito', $idUsuario);
        $this->db->where($this->table.'.idpv', $idPregunta);
        $this->db->where($this->table.'.idmaterial', $material);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getValoracionMaterial( $idUsuario, $material){
        
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where($this->table.'.idmaterial', $material);
        $this->db->where($this->table.'.idinscrito', $idUsuario);
        $query = $this->db->get();

        return $query->result_array();
    }
}
?>