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
		$mykaryawan = $this->model_mastpotongan->view('biodata_karyawan')->result_array();
		$data = array(
			'page_content' 	=> '../pagepayroll/master_potongan/view',
			'ribbon' 		=> '<li class="active">Master Potongan</li><li>Potongan</li>',
			'page_name' 	=> 'Master Potongan',
			'js' 			=> 'js_file',
			'mykaryawan'		=> $mykaryawan
		);
		$this->render_view($data);
	}

	public function tampil()
	{
		$my_data = $this->model_mastpotongan->view_potongan()->result_array();
		echo json_encode($my_data);
	}

	public function simpan()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$data = array(
				'id_karyawan'  => $this->input->post('id_karyawan'),
				'infaq_masjid'  => $this->input->post('infaq_masjid_v'),
				'potong_nama'  => $this->input->post('PotonganNama'),
				'potong_periode'  => $this->input->post('potong_periode'),
				'potong_status'  => $this->input->post('potong_status'),
				'createdAt' => date('Y-m-d H:i:s')
			);
			$result = $this->model_mastpotongan->insert($data, 'tbkaryawanpot');
			if ($result) {
				echo $result;
			} else {
				echo 'insert gagal';
			}
		} else {
			$this->load->view('pagepayroll/login'); //Redirect login
		}
	}
}
