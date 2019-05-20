<?php

class PreviewController extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper('url_helper');
    }

	public function load_Preview()
	{
		$this->load->view('Cursos/Preview');
	}
}
