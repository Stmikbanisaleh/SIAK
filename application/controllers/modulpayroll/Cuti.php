<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cuti extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('payroll/model_cuti');
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			// continue;
		} else {
			$this->load->view('pagepayroll/login'); //Redirect login
		}
	}

	function render_view($data)
	{
		$this->template->load('templatepayroll', $data); //Display Page
	}

	public function index()
	{
		$my_karyawan = $this->model_cuti->view('tbpengawas')->result_array();
		$data = array(
			'page_content' 	=> '../pagepayroll/cuti/view',
			'ribbon' 		=> '<li class="active">Cuti</li><li>Cuti</li>',
			'page_name' 	=> 'Cuti',
			'js' 			=> 'js_file',
			'my_karyawan'	=> $my_karyawan
		);
		$this->render_view($data);
	}

}
