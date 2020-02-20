<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct()
    {
        parent::__construct();
        $this->load->model('guru/model_dashboard');
    }

	function render_view($data) {
        $this->template->load('templateguru', $data); //Display Page
    }

	public function index() {
		$my_data = $this->model_dashboard->view_visi('visimisi')->result_array();
		$my_data1 = $this->model_dashboard->view_misi('visimisi')->result_array();
        $data = array(
        			'page_content' 	=> 'dashboard',
        			'ribbon' 		=> '<li class="active">Dashboard</li><li>Sample</li>',
					'page_name' 	=> 'Dashboard',
					'myvisimisi'     => $my_data,
					'mymisi'     => $my_data1,
        		);
        $this->render_view($data); //Memanggil function render_view
    }
}