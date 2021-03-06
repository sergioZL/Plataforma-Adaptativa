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


    public function ConsultarOpcionesRespuestas($idBancoPregunta,$idevaluacion)
    {
        $this->db->select('*');
        $this->db->from( $this->table);
        $this->db->join('respuestas', $this->table.'.id_pregunta  = respuestas.id_pregunta','LEFT');
        $this->db->where($this->table.'.id_pregunta',$idBancoPregunta);
        $this->db->where('id_evaluacion',$idevaluacion);

        $query = $this->db->get();
        return $query->result_array();
    } 

    public function ConsultarResultadoRespuestas($idevaluacion,$npreguntas)
    {
        $this->db->select(' ROUND(sum(porcentaje) / count(distinct opciones.id_pregunta) / 10, 2) as cal');
        $this->db->from( $this->table);
        $this->db->join('respuestas', $this->table.'.id_opciones  = respuestas.id_opcion','LEFT');
        $this->db->where('respuestas.id_evaluacion',$idevaluacion);
        $query = $this->db->get();

        return $query->row();
    }


    public function ConsultarResultadoRespuestasBuenas($idevaluacion,$npreguntas)
    {
        $sql = 'Select * from opciones where `opciones`.`id_pregunta` = "'.$npreguntas.'" and id_opciones in (select id_opcion from respuestas where `respuestas`.`id_pregunta` = "'.$npreguntas.'" and id_evaluacion = "'.$idevaluacion.'" and id_opcion = id_opciones) ;';
        
        return $this->db->query($sql)->result_array();
    }

    public function ConsultarResultadoRespuestasMalas($idevaluacion,$npreguntas)
    {
        $sql = 'Select * from opciones where `opciones`.`id_pregunta` = "'.$npreguntas.'" and id_opciones not in (select id_opcion from respuestas where `respuestas`.`id_pregunta` = "'.$npreguntas.'" and id_evaluacion = "'.$idevaluacion.'" and id_opcion = id_opciones) ;';
        
       return $this->db->query($sql)->result_array();
    }
    
}