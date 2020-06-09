<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_potongan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('payroll/model_mastpotongan');
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
		$my_guru = $this->model_mastpotongan->view('tbguru')->result_array();
		$data = array(
			'page_content' 	=> '../pagepayroll/master_potongan/view',
			'ribbon' 		=> '<li class="active">Master Potongan</li><li>Potongan</li>',
			'page_name' 	=> 'Potongan',
			'js' 			=> 'js_file',
			'my_guru'		=> $my_guru
		);
		$this->render_view($data); 
	}

	public function tampil()
	{
		$my_data = $this->model_mastpotongan->view_potongan()->result_array();
		echo json_encode($my_data);
	}

}
