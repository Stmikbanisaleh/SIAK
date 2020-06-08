<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Biodata_karyawan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('payroll/model_karyawan');
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
		// $my_data = $this->model_guru->view('sekolah')->result_array();
		// $myagama = $this->model_guru->view('tbagama')->result_array();
		// $mypendidikan = $this->model_guru->view('mspendidikan')->result_array();

		$data = array(
			'page_content' 	=> '../pagepayroll/biodata_karyawan/view',
			'ribbon' 		=> '<li class="active">Dashboard</li><li>Master Biodata Karyawan</li>',
			'page_name' 	=> 'Master Biodata Karyawan',
			'js' 			=> 'js_file',
			// 'myprogram' 	=> $my_data,
			// 'myagama'		=> $myagama,
			// 'mypendidikan' 	=> $mypendidikan
		);
		$this->render_view($data); //Memanggil function render_view
	}

	public function tampil()
	{
		$my_data = $this->model_karyawan->view_karyawan()->result_array();
		echo json_encode($my_data);
	}

}
