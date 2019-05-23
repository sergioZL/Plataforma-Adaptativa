<?php

class TemarioController extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper('url_helper');
    }

	public function load_Temario()
	{
		$this->load->view('Cursos/Temario');
	}
}
