<?php

class Categoria_modal extends CI_Model{
    private $table;
    public function __construct()
    {
        $this->table = "categoria";
        parent::__construct();
        $this->load->database();
    }

    public function ConsultarCursosTodosTemasUsuarios($id)
    {
        $this->db->distinct();
        $this->db->select($this->table.'.descripcion,categoria');
        $this->db->from( $this->table);
        $this->db->join('cursos', $this->table.'.id = cursos.categoria','INNER');
        $this->db->join('inscrito','inscrito.clave_curso = cursos.clave','INNER');
        $this->db->where('inscrito.clave_alumno',$id);
        $query = $this->db->get();

        return $query->result_array();
    } 
}