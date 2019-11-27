<?php

class Respuesta_modal extends CI_Model{
    private $table;
    public function __construct()
    {
        $this->table = "respuestas";
        parent::__construct();
        $this->load->database();
    }

    public function getRespuestasUsuarioTema($idUsuario,$Tema){
        $this->db->select('sum(porcentaje) as porc');
        $this->db->from( $this->table );
        $this->db->join('banco_preguntas',$this->table.'.id_pregunta = banco_preguntas.id','LEFT');
        $this->db->join('evaluacion',$this->table.'.id_evaluacion = evaluacion.id','LEFT');
        $this->db->join('opciones',$this->table.'.id_opcion = opciones.id_opciones','LEFT');
        $this->db->where('clave_alumno',$idUsuario);
        $this->db->where('banco_preguntas.id_tema',$Tema);
        $query = $this->db->get();
        return $query->result();
    }

    public function InsertRespuestas($id_opcion,$id_pregunta,$id_evaluacion)
    {
        $data = array('id_opcion' => $id_opcion,'id_pregunta' => $id_pregunta, 
                    'id_evaluacion' => $id_evaluacion);

        $this->db->insert($this->table,$data);  
        
        $insertId = $this->db->insert_id();
        return $insertId;    
    } 

    public function ConsultarPreguntasNRespuesta($id_evaluacion)
    {
        $this->db->distinct();
        $this->db->select('id_pregunta');
        $this->db->from( $this->table);
        $this->db->where( $this->table.'.id_evaluacion',$id_evaluacion);
        $query = $this->db->get();
        
        return $query->result_array();
    }

    public function ConsultarRespuestas($id)
    {
        $this->db->select($this->table.'.*');
        $this->db->from( $this->table);
        $this->db->where($this->table.'.id_evaluacion',$id);
        $query = $this->db->get();

        return $query->result_array();
    } 

    public function ConsultarResultadoRespuestas($idevaluacion,$npreguntas)
    {
        $this->db->select('sum(porcentaje)');
        $this->db->from( $this->table);
        $this->db->join('respuestas', $this->table.'.id_pregunta  = respuestas.id_pregunta','LEFT');
        $this->db->where($this->table.'.id_evaluacion',$idevaluacion);
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

