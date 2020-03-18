<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bayarlain extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('kasir/model_bayar');
	}
	
	function render_view($data) {
        $this->template->load('templatekasir', $data); //Display Page
    }

	public function index() {
		$mysiswa = $this->model_bayar->view('mssiswa')->result_array();
        $data = array(
        			'page_content' 	=> '../pagekasir/bayarlain/view',
        			'ribbon' 		=> '<li class="active">Pembayaran Lain-Lain</li><li>Sample</li>',
					'page_name' 	=> 'Pembayaran Lain-Lain',
					'mysiswa'		=> $mysiswa
        		);
        $this->render_view($data); //Memanggil function render_view
	}
	
	public function search()
    {
		$noreg = $this->input->post('nik');
		$result = $this->model_bayar->getsiswa($noreg)->result();
        echo json_encode($result);
	}
	
}