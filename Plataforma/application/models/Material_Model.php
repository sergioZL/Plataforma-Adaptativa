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
        /**
         * Devuelve el primer material del curso ordenado como estan configuradas las 
         * lecciones y los temas
         */
        public function encontrarPrimerMaterialDeCurso($claveCurso){
            $this->db->select('material.id as `id`,material.clave_curso, lecciones.clave as `leccion`,temas.id as `tema`, descripcion_material as `Descripcion`, tipo_material as `tipo`');
            $this->db->from($this->table);
            $this->db->join('temas',$this->table.'.id_temas = temas.id','INNER');
            $this->db->join('lecciones','lecciones.clave = id_leccion','INNER');
            $this->db->where(' material.clave_curso',$claveCurso);
            $this->db->order_by('lecciones.secuencia',);
            $this->db->limit(1);
            $query = $this->db->get();

            return $query->row();
        }
        public function encontrarUltimoMaterialDeCurso($claveCurso,$claveAlumnno){
           $this->db->select("inscrito.ultimo as 'id', material.descripcion_material as 'Descripcion',
           material.clave_curso as 'clave_curso', temas.id_leccion as 'leccion', temas.id as 'tema',
           material.tipo_material as 'tipo',avance_material.avance as 'avance'");
           $this->db->from('inscrito');
           $this->db->join('avance_material','inscrito.ultimo = avance_material.idmaterial','INNER');
           $this->db->join('material','avance_material.idmaterial = material.id','INNER');
           $this->db->join('temas','material.id_temas = temas.id','INNER');
           $this->db->join('lecciones','temas.id_leccion = lecciones.clave');
           $this->db->where('inscrito.clave_alumno',$claveAlumnno);
           $this->db->where('inscrito.clave_curso',$claveCurso);
           $query = $this->db->get();

           return $query->row();
        }
        public function guardarUltimoMaterialDeCurso($claveCurso,$claveAlumnno,$idMaterial){

        }
    }
?>