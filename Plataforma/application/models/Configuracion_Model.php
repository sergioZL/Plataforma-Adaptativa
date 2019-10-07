<?php

class Configuracion_Model extends CI_Model{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function agregarCurso($clave, $nombre, $categoria, $carrera, $descripcion, $foto) {

        $data = array(
                        'clave' => $clave,
                        'nombre' => $nombre,
                        'categoria' => $categoria,
                        'clave_carrera' => $carrera,
                        'descripcion' => $descripcion,
                        'foto' => $foto
                    );

        $this->db->insert('cursos', $data);

        return $this->db->insert_id();
    }

    public function getCursos() {

        //$query = $this->db->get('cursos');

        //$this->db->select('clave, nombre, descripcion, categoria, clave_carrera, fechaActualizado');
        //$this->db->from('cursos');
        $query = $this->db->get('cursos');

        if($query->num_rows() > 0) {
            return $query->result();
        }
        else {
            return false;
        }
    }

    public function agregarLeccion($nombre, $secuencia, $clave_curso, $descripcion) {

        $data = array(
                        'nombre' => $nombre,
                        'secuencia' => $secuencia,
                        'clave_curso' => $clave_curso,
                        'descripcion' => $descripcion,
                    );

        $this->db->insert('lecciones', $data);
        return $data;
    }

    public function getLeccionesPorCurso($clave_curso) {

        $this->db->select('lecciones.*');
        $this->db->from('lecciones');
        $this->db->where('lecciones.clave_curso', $clave_curso);
        $this->db->order_by('secuencia', 'asc');
        $query = $this->db->get();

        return $query->result();
    }

    public function getLeccionesCount($clave_curso) {

        $this->db->select('lecciones.*');
        $this->db->from('lecciones');
        $this->db->where('lecciones.clave_curso', $clave_curso);
        $this->db->order_by('secuencia', 'asc');
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function getTemasPorLeccion($id_leccion) {

        $this->db->select('temas.*');
        $this->db->from('temas');
        $this->db->where('temas.id_leccion', $id_leccion);
        $query = $this->db->get();
        
        return $query->result_array();
    }

    public function getTemasCount($id_leccion) {

        $this->db->select('temas.*');
        $this->db->from('temas');
        $this->db->where('temas.id_leccion', $id_leccion);
        $this->db->order_by('secuencia', 'asc');
        $query = $this->db->get();

        return $query->num_rows();
    }

    public function agregarTema($nombre, $secuencia, $id_leccion, $descripcion) {
        
        $data = array(
                        'nombre' => $nombre,
                        'secuencia' => $secuencia,
                        'id_leccion' => $id_leccion,
                        'descripcionTema' => $descripcion
                    );

        $this->db->insert('temas', $data);
        return $data;
    }

    public function getCategorias() {
        
        $query = $this->db->get('categoria');

        if($query->num_rows() > 0) {
            return $query->result();
        }
        else {
            return false;
        }
    }

    public function getCarreras() {

        $query = $this->db->get('carrera');

        if($query->num_rows() > 0) {
            return $query->result();
        }
        else {
            return false;
        }
    }
 
    public function getCategoriasPorCarrera($clave_carrera) {

        $this->db->select('categoria.*');
        $this->db->from('categoria');
        $this->db->where('categoria.clave', $clave_carrera);
        $query = $this->db->get();

        if($query->num_rows() > 0) {
            return $query->result();
        }
        else {
            return false;
        }
    }

    public function getLeccion($id_tema) {

        $this->db->select('temas.id_leccion');
        $this->db->from('temas');
        $this->db->where('temas.id', $id_tema);
        $query = $this->db->get();

        foreach($query->result() as $row) {
            return $row->id_leccion;
        }

        //return $query->result();
    }

    public function getCurso($id_leccion) {
        
        $this->db->select('lecciones.clave_curso');
        $this->db->from('lecciones');
        $this->db->where('lecciones.clave', $id_leccion);

        $query = $this->db->get();

        foreach($query->result() as $row) {
            return $row->clave_curso;
        }

        //return $query->result();
    }

    public function getNombreTema($id_tema) {

        $this->db->select('temas.nombre');
        $this->db->from('temas');
        $this->db->where('temas.id', $id_tema);

        $query = $this->db->get();

        foreach($query->result() as $row) {
            return $row->nombre;
        }
    }

    public function getNombreLeccion($id_leccion) {

        $this->db->select('lecciones.nombre');
        $this->db->from('lecciones');
        $this->db->where('lecciones.clave', $id_leccion);

        $query = $this->db->get();

        foreach($query->result() as $row) {
            return $row->nombre;
        }
    }

    public function getNombreCurso($clave_curso) {

        $this->db->select('cursos.nombre');
        $this->db->from('cursos');
        $this->db->where('cursos.clave', $clave_curso);

        $query = $this->db->get();

        foreach($query->result() as $row) {
            return $row->nombre;
        }
    }

    public function getMaterialPorTema($id_tema) {

        $this->db->select('material.*');
        $this->db->from('material');
        $this->db->where('material.id_temas', $id_tema);

        $query = $this->db->get();
        return $query->result();
    }

    public function agregarMaterial($tipo_material, $descripcion_material, $id_tema,$clave_curso) {

        $data = array(
            'tipo_material' => $tipo_material,
            'descripcion_material' => $descripcion_material,
            'id_temas' => $id_tema,
            'clave_curso' =>$clave_curso
        );

        $this->db->insert('material', $data);
        return $data;
    }

    public function agregarRuta($ruta) {

        $data = array(
            'ruta' => $ruta
        );

        $this->db->insert('configuracion', $data);
        return $data;
    }

    public function actualizarOrdenLecciones($items) {

        foreach($items as $item) {
            $this->db->where('lecciones.clave', $item);
            $this->db->update('lecciones.secuencia', $item);
        }
    }

    public function actualizarLecciones($total_items, $items) {

        for($item = 1; $item <= $total_items; $item++ ) {

            /*$data = array(
                    'clave' => $items[$item],
                    'secuencia' => $item
            );*/

            //$this->db->where('clave', $data['clave']);
            //$this->db->update('lecciones', $data['secuencia']);
            //$this->db->update('lecciones', array('secuencia' => $data['secuencia']));

            $sql = "UPDATE lecciones SET secuencia = ? WHERE clave = ?";
            $this->db->query($sql, array($items[$item], $item));
            
            return $this->db->last_query();
        }
    }

    public function actualizarOrdenLeccion($new_position, $item_id) {

        $this->db->set('secuencia', $new_position);
        $this->db->where('lecciones.clave', $item_id);
        return $this->db->update('lecciones');

    }

    public function actualziarOrdenTema($new_position, $item_id) {

        $this->db->set('secuencia', $new_position);
        $this->db->where('temas.id', $item_id);
        return $this->db->update('temas');
    }
} 
