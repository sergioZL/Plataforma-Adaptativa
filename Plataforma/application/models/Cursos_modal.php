<?php

class Cursos_modal extends CI_Model{
    private $table;
    public function __construct()
    {
        $this->table = "cursos";
        parent::__construct();
        $this->load->database();
    }

    public function ConsultarCursosUsuarios($id)
    {
        $this->db->select('clave_curso');
        $this->db->from('inscrito');
        $this->db->join('cursos', 'inscrito'.'.clave_curso = cursos.clave','RIGHT');
        $this->db->where('inscrito'.'.clave_alumno',$id);
        $query = $this->db->get();
        return $query->result();
    }

    public function ConsultarCursosNoinscrito($usuario)
    {
        $query1 = $this->ConsultarCursosUsuarios($usuario);
        $id = array();

        foreach( $query1 as $row ){
            $id[] = $row->clave_curso;
        }

        $arrayids = implode("," , $id );
        $ids = explode(",",$arrayids);

        $this->db->select($this->table.'.*');
        $this->db->from($this->table);
        $this->db->where_not_in($this->table.'.clave',$ids);
        $query = $this->db->get();

        return $query->result_array();
    } 

    public function ConsultarCursos()
    {
        $this->db->select($this->table.'.*');
        $this->db->from($this->table);
        $query = $this->db->get();

        return $query->result_array();
    } 

    public function ConsultarPorIDCursos($id)
    {
        $this->db->select($this->table.'.*');
        $this->db->from($this->table);
        $this->db->where($this->table.'.clave',$id);
        $query = $this->db->get();

        return $query->result_array();
    } 

    public function ConsultarBuscarCursos($nombre)
    {
        $this->db->select($this->table.'.*');
        $this->db->from($this->table);
        $this->db->like($this->table.'.nombre', $nombre, 'both');
        $query = $this->db->get();

        return $query->result_array();
    } 
}