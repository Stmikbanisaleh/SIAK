<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendapatan extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == NULL && $this->session->userdata('level') != 'AKUNTING') {
            $this->session->set_flashdata('category_error', 'Silahkan masukan username dan password');
            redirect('modulakunting/login');
        }
    }

	function render_view($data) {
        $this->template->load('templateakunting', $data); //Display Page
    }

	public function index() {
        $data = array(
        			'page_content' 	=> '../pageakunting/pendapatan/view',
        			'ribbon' 		=> '<li class="active">Penerimaan Pendapatan</li><li>Sample</li>',
					'page_name' 	=> 'Penerimaan Pendapatan',
        		);
        $this->render_view($data); //Memanggil function render_view
    }
}