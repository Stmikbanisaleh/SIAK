<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tentang extends CI_Controller {
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
        			'page_content' 	=> '../pageakunting/tentang/view',
        			'ribbon' 		=> '<li class="active">Tentang Aplikasi</li><li>Sample</li>',
					'page_name' 	=> 'Tentang Aplikasi',
        		);
        $this->render_view($data); //Memanggil function render_view
    }
}