<?php

class Preguntas_Model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getPreguntasPorTema($id_tema) {

        $this->db->select('banco_preguntas.*');
        $this->db->from('banco_preguntas');
        $this->db->where('banco_preguntas.id_tema', $id_tema);

        $query = $this->db->get();
        return $query->result();
    }

    public function getTotalPreguntasPorTema($id_tema) {

        $this->db->select('count(id) as total');
        $this->db->from('banco_preguntas');
        $this->db->where('banco_preguntas.id_tema', $id_tema);

        $query = $this->db->get();
        return $query->result();
    }

    public function getOpcionesPorPregunta($id_pregunta){

        $this->db->select('opciones.*');
        $this->db->from('opciones');
        $this->db->where('opciones.id_pregunta', $id_pregunta);

        $query = $this->db->get();
        return $query->result();
    }
    public function insertPregunta($data){
        $this->db->insert('banco_preguntas',$data);
        return $this->db->insert_id();
    }
    public function insertarOpciones($data){
        $this->db->insert('opciones',$data);
        return $this->db->insert_id();
    }


}
?>