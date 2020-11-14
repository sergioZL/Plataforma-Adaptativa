<?php

class Configuracion_modal extends CI_Model{
    private $table;
    public function __construct()
    {
        $this->table = "configuracion";
        parent::__construct();
        $this->load->database();
    }

    // ===========================================================================================================
    //      Regresa la cantidad de preguntas que se mostraran en el examen diagnostico 
    // ===========================================================================================================  
    public function Limite()
    {
        $this->db->select($this->table.'.numpregunta');
        $this->db->from( $this->table);
        $this->db->limit(1);

        $query = $this->db->get();

        return $query->row();
    }

    // ===========================================================================================================
    //      Regresa la cantidad de preguntas que se mostraran en la prueba por tema
    // ===========================================================================================================  
    public function LimiteTema()
    {
        $this->db->select($this->table.'.numpreguntaTema');
        $this->db->from( $this->table);
        $this->db->limit(1);

        $query = $this->db->get();

        return $query->row();
    }

    // ===========================================================================================================
    //      Regresa la cantidad de preguntas que se mostraran en el examen global
    // ===========================================================================================================  
    public function LimiteGlobal()
    {
        $this->db->select($this->table.'.numpreguntaGlobal');
        $this->db->from( $this->table);
        $this->db->limit(1);

        $query = $this->db->get();

        return $query->row();
    }
    
    // ===========================================================================================================
    //      Actualiza el numero de preguntas que se mostararan en el usuario en el examen diagnostico
    // ===========================================================================================================

    public function ActualizarNumPreguntas($numPreguntas) {
        $this->db->set('numpregunta',$numPreguntas);
        $this->db->update($this->table);
    }

    // ===========================================================================================================
    //      Actualiza el numero de preguntas que se mostararan en el usuario en el examen por tema
    // ===========================================================================================================

    public function ActualizarNumPreguntasTema($numPreguntas) {
        $this->db->set('numpreguntaTema',$numPreguntas);
        $this->db->update($this->table);
    }

    // ===========================================================================================================
    //      Actualiza el numero de preguntas que se mostararan en el usuario en el examen global
    // ===========================================================================================================

    public function ActualizarNumPreguntasGlobal($numPreguntas) {
        $this->db->set('numpreguntaGlobal',$numPreguntas);
        $this->db->update($this->table);
    }

    // ===========================================================================================================
    //   Regresa la ruta en la que se estan subiendo los archivos
    // ===========================================================================================================

    public function Ruta() {
        $this->db->select($this->table.'.ruta');
        $this->db->from( $this->table );
        $this->db->limit(1);

        $query = $this->db->get();

        return $query->row();
    }


}