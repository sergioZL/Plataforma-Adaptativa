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
        public function encontrarPrimerMaterialDeCurso($claveCurso){
            $this->db->select('material.clave_curso, lecciones.clave as `leccion`,temas.id as `tema`, descripcion_material as `Descripcion`, tipo_material as `tipo`');
            $this->db->from($this->table);
            $this->db->join('temas',$this->table.'.id_temas = temas.id','INNER');
            $this->db->join('lecciones','lecciones.clave = id_leccion','INNER');
            $this->db->where(' material.clave_curso',$claveCurso);
            $this->db->order_by('lecciones.secuencia',);
            $this->db->limit(1);
            $query = $this->db->get();

            return $query->row();
        }

    }
?>