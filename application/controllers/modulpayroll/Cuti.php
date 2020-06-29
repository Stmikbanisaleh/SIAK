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
		$my_karyawan = $this->model_cuti->view('biodata_karyawan')->result_array();
		$data = array(
			'page_content' 	=> '../pagepayroll/cuti/view',
			'ribbon' 		=> '<li class="active">Master Cuti</li>',
			'page_name' 	=> 'Master Cuti',
			'js' 			=> 'js_file',
			'my_karyawan'	=> $my_karyawan
		);
		$this->render_view($data);
	}

	public function simpan()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$data = array(
				'pin'  =>  $this->input->post('id_karyawan'),
				'tanggal'  => $this->input->post('tanggal'),
				'status'  => $this->input->post('keterangan'),
				'createdAt' => date('Y-m-d H:i:s')
			);
			$result = $this->model_cuti->insert($data, 'tbkehadiran');
			if ($result) {
				echo $result;
			} 
		} else {
			$this->load->view('pagepayroll/login'); //Redirect login
		}
	}

	public function tampil()
	{
		$my_data = $this->model_cuti->view_cuti()->result_array();
		echo json_encode($my_data);
	}

	public function delete()
    {
        $data_id = array(
            'id'  => $this->input->post('id')
		);
		$action = $this->model_cuti->delete($data_id, 'tbkehadiran');
		if($action){
			echo json_encode($action);
		}
	}

}
