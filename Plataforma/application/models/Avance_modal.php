<?php 
    class Avance_modal extends CI_Model{
        private $table;
        public function __construct()
        {
            $this->table = "avance";
            parent::__construct();
            $this->load->database();
        }

        /**
         * Inserta un nuevo avance en la tabla avance 
         * los datos recibidos deberan contener la siguiente estructura
         * 
         *$data = array( //Estos datos son para insertarse en la tabla avance
         *          'avance'      => corresponde al porcentaje de avance del tema
         *          'revisado'    => corresponde a el numero de revisiones de los materiales del tema
         *          'id_duracion' => corresponde al id de la tabla duracion a la que pertenece este avance
         *          'id_tema'     => corresponde al id del tema al que pertenece este avance
         *        );
         */
        public function InsertarAvance($data){
            $this->db->insert($this->table,$data);
            return $this->db->insert_id();
        }
        /**
         * Actualiza la tabla avance modificando el porcentaje del avance que se tiene en el tema 
         * y el numero de reviciones que tiene el tema 
         */
        public function updateAvance($idAvance,$avance){
            $this->db->set('avance',$avance);
            $this->db->set('revisado','revisado + 1');
            $this->db->where('id',$idAvance);
            $this->db->update('avance');
        }
         /**
         * Inserta un nuevo avance en la tabla avance_material
         * los datos recibidos deberan contener la siguiente estructura
         * 
         *  $datos = array(//Estos datos son para insertar en la tabla avance_material
         *            'idavance'   => es el id de la tabla avance
         *            'idmaterial' => es el id del material al que pertenece el avance
         *            'avance'     => es la cantidad de avance que se optubo
         *            'completado' => es una variable booleanda que indica si el curso a sido completado
         *            'revisiones' => son el numero de veces que el material a sido revisado 
         *            'tiempo_promedio' => es el tiempo promedio que el usuario a estado revisando el tema
         *            'repeticiones' => es el numero de veses que el usuario a revisado el material
         *        );
         */
        public function InsertarAvanceMaterial($data){
            $this->db->insert('avance_material',$data);
            return $this->db->insert_id();
        }
        /**
         * Regresa el avanceMaterial opteniendo como argumeno el id del Avance por tema 
         * y el id del material
         */
        public function ConsultarAvanceMaterial($idavance,$idmaterial){
            $this->db->select();
            $this->db->from('avance_material');
            $this->db->where('avance_material.idavance',$idavance);
            $this->db->where('avance_material.idmaterial',$idmaterial);
            $query = $this->db->get();

            return $query->result_array();
        }
        /**
         * Regresa el id de la tabla duración que corresponde a el curso y al usuario
         * dados como argumentos
         */
        public function ConsultarDuracion($idCurso,$idUsuario){
            $this->db->select('id');
            $this->db->from('duracion');
            $this->db->where('duracion.clave_inscrito',$idUsuario);
            $this->db->where('duracion.clave_curso',$idCurso);
            $query = $this->db->get();
            
            return $query->row();
        }
        /**
         * Regresa el avance correspondiente al tema y el id duracion deados como
         * argumentos
         */
        public function ConsultarAvance($idDuracion,$IdTema){
            $this->db->select();
            $this->db->from($this->table);
            $this->db->where($this->table.'.id_duracion',$idDuracion);
            $this->db->where($this->table.'.id_tema',$IdTema);
            $query = $this->db->get();
            
            return $query->row();
        }
        /**
         * Regresa el avance de los materiales correspondientes al id de tema 
         * proporcionado en el argumento
         */
        public function getavanceMaterialTema($idTema){
            $this->db->select();
            $this->db->from('avance_material');
            $this->db->join('material','avance_material.idmaterial = material.id','right outer');
            $this->db->where('material.id_temas',$idTema);
            $query = $this->db->get();

            return $query->result_array();
        }
    }
?>