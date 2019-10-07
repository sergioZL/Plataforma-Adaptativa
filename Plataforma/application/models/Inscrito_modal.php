<?php

class Inscrito_Modal extends CI_Model{
    private $table;
    public function __construct()
    {
        $this->table = "inscrito";
        parent::__construct();
        $this->load->database();
    }

    public function IncribirAlumno($id,$clave_alumno)
    {
        $data = array('clave_alumno' => $clave_alumno,'clave_curso' => $id);

        $this->db->insert($this->table,$data);  
        
        $insertId = $this->db->insert_id();
        return $insertId; 
    }

    public function ConsultarCursosUsuarios($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('cursos', $this->table.'.clave_curso = cursos.clave','RIGHT');
        $this->db->where($this->table.'.clave_alumno',$id);
        $query = $this->db->get();

        return $query->result_array();
    }
    
    public function ConsultarCursosUsuariosCategoria($id,$categoria)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('cursos', $this->table.'.clave_curso = cursos.clave','RIGHT');
        $this->db->where($this->table.'.clave_alumno',$id);
        $this->db->where('cursos.categoria',$categoria);

        $query = $this->db->get();

        return $query->result_array();
    } 

    public function ConsultarCursosMenor($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('cursos', $this->table.'.clave_curso = cursos.clave','RIGHT');
        $this->db->where($this->table.'.clave_alumno',$id);
        $this->db->order_by($this->table.'.avance', "ASC");
        $query = $this->db->get();

        return $query->result_array();
    } 

    public function ConsultarCursosMayor($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);   
        $this->db->join('cursos', $this->table.'.clave_curso = cursos.clave','RIGHT');
        $this->db->where($this->table.'.clave_alumno',$id);
        $this->db->order_by($this->table.".avance", "DESC");
        $query = $this->db->get();

        return $query->result_array();
    } 

    public function ConsultarCursosAlfaMenor($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('cursos', $this->table.'.clave_curso = cursos.clave','RIGHT');
        $this->db->where($this->table.'.clave_alumno',$id);
        $this->db->order_by('nombre', "DESC");
        $query = $this->db->get();

        return $query->result_array();
    } 

    public function ConsultarCursosAlfaMayor($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);   
        $this->db->join('cursos', $this->table.'.clave_curso = cursos.clave','RIGHT');
        $this->db->where($this->table.'.clave_alumno',$id);
        $this->db->order_by('nombre', "ASC");
        $query = $this->db->get();

        return $query->result_array();
    } 

    public function ConsultarCursosTemario($id,$curso)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('cursos', $this->table.'.clave_curso = cursos.clave','RIGHT');
        $this->db->where($this->table.'.clave_alumno',$id);
        $this->db->where($this->table.'.clave_curso',$curso);
        $query = $this->db->get();

        return $query->result_array();
    } 
    public function insertarDuracion($data){
        $this->db->insert('duracion',$data);  
        
        $insertId = $this->db->insert_id();
        return $insertId; 
    }
    /*public function ConsultarCursosTemasUsuario($Tema)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('cursos', $this->table.'.clave_curso = cursos.clave','RIGHT');
        $this->db->where($this->table.'.tema',$Tema);
        $query = $this->db->get();

        return $query->result_array();
    }  

    public function ConsultarCursosTodosTemasUsuarios($id)
    {
        $this->db->select('DISTINCT categoria.descripcion');
        $this->db->from('categoria');
        $this->db->join('cursos', $this->table.'.clave_curso = cursos.clave','INNER');
        $this->db->join('inscrito','inscrito.clave_curso = cursos.clave','INNER');
        $this->db->where('inscrito.clave_alumno',$id);
        $query = $this->db->get();

        return $query->result_array();
    }  */
}