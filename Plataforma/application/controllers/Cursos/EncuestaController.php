<?php
    class EncuestaController extends CI_Controller {
        public function __construct() {
            parent::__construct();
            $this->load->helper('url_helper');
            $this->load->model('Inscrito_modal');
        }
        public function load_Encuesta() {
            $this->load->view('Cursos/Encuesta');
        }
        public function actualizarEstilo(){
            $usuario = $this->input->post('alumno');
            $visial = $this->input->post('eavisual');
            $cinestesico = $this->input->post('eacinestesico');
            $auditivo = $this->input->post('eaauditivo');
            $this->Inscrito_modal->ActualizarAlumno($usuario,$visial,$auditivo,$cinestesico);
            echo 'actualizado';
        }
        public function obtenerAlumno(){
            $varusuario = $this->input->get('varusuario');

            $alumno = $this->Inscrito_modal->obtenerAlumno($varusuario);

            echo json_encode($alumno);
        }
    }
?>