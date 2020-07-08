<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendapatanlain extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('payroll/model_pendapatanlain');
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
		$myguru = $this->model_pendapatanlain->viewOrdering('tbguru','GuruNama','asc')->result_array();
		$data = array(
			'page_content' 	=> '../pagepayroll/pendapatanlain/view',
			'ribbon' 		=> '<li class="active">Master Pendapatan Lain Guru </li>',
			'page_name' 	=> 'Master Pendapatan Lain Guru',
			'js' 			=> 'js_file',
			'myguru'		=> $myguru
		);
		$this->render_view($data);
	}

	public function tampil()
	{
		$my_data = $this->model_pendapatanlain->view_pendapatanlain()->result_array();
		echo json_encode($my_data);
	}

	public function simpan()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$periode = date("m",strtotime($this->input->post('periode')));
			$data = array(
				'IdGuru'  => $this->input->post('id_guru'),
				'thr'  => $this->input->post('thr_v'),
				'tunjangan'  => $this->input->post('tjkinerja_v'),
				'lain' => $this->input->post('tjlain_v'),
				'periode' => $this->input->post('periode'),
				'createdAt' => date('Y-m-d H:i:s')
			);
			$hasil = $this->model_pendapatanlain->cek_guru($this->input->post('id_guru'), $periode)->num_rows();
			if($hasil>0){
				echo 401;
			}else{
				$result = $this->model_pendapatanlain->insert($data, 'tbpendapatanlainguru');
				if ($result) {
					echo $result;
				} 
			}
		} else {
			$this->load->view('pagepayroll/login'); //Redirect login
		}
	}

	public function delete()
    {
        $data_id = array(
            'id'  => $this->input->post('id')
		);
		$action = $this->model_pendapatanlain->delete($data_id, 'tbpendapatanlainguru');
		if($action){
			echo json_encode($action);
		}
	}
}
