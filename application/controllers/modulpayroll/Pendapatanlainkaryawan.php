<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendapatanlainkaryawan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('payroll/model_pendapatanlainkaryawan');
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
		$mykaryawan = $this->model_pendapatanlainkaryawan->viewOrdering('biodata_karyawan','nama','asc')->result_array();
		$data = array(
			'page_content' 	=> '../pagepayroll/pendapatanlainkaryawan/view',
			'ribbon' 		=> '<li class="active">Master Pendapatan Lain Karyawan </li>',
			'page_name' 	=> 'Master Pendapatan Lain Karyawan',
			'js' 			=> 'js_file',
			'mykaryawan'		=> $mykaryawan
		);
		$this->render_view($data);
	}

	public function tampil()
	{
		$my_data = $this->model_pendapatanlainkaryawan->view_pendapatanlain()->result_array();
		echo json_encode($my_data);
	}

	public function simpan()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$hasil = $this->model_pendapatanlainkaryawan->view_where('tbpendapatanlainkaryawan', ['nip' => $this->input->post('nip')])->num_rows();
			if($hasil<1){
				$periode = date("m",strtotime($this->input->post('periode')));
				$data = array(
					'nip'  => $this->input->post('nip'),
					'thr'  => $this->input->post('thr_v'),
					'lain' => $this->input->post('tjlain_v'),
					'tj_malam_lembur' => $this->input->post('tj_malam_lembur_v'),
					'tunj_khusus1' => $this->input->post('tunj_khusus1'),
					'tunj_khusus2' => $this->input->post('tjlain_v'),
					'ket_tunj_khusus1' => $this->input->post('ket_tunj_khusus1'),
					'ket_tunj_khusus2' => $this->input->post('ket_tunj_khusus2'),
					// 'periode' => $this->input->post('periode'),
					'createdAt' => date('Y-m-d H:i:s')
				);
				$hasil = $this->model_pendapatanlainkaryawan->cek_karyawan($this->input->post('nip'), $periode)->num_rows();
				if($hasil>0){
					echo 401;
				}else{
					$result = $this->model_pendapatanlainkaryawan->insert($data, 'tbpendapatanlainkaryawan');
					if ($result) {
						echo $result;
					} 
				}
			}else{
				echo json_encode(401);
			}
		} else {
			$this->load->view('pagepayroll/login'); //Redirect login
		}
	}

	public function tampil_byid()
    {
        if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {

            $data = array(
                'id'  => $this->input->post('id'),
            );
            $my_data = $this->model_pendapatanlainkaryawan->view_where('tbpendapatanlainkaryawan', $data)->result();
            echo json_encode($my_data);
        } else {
            $this->load->view('pagekasir/login'); //Memanggil function render_view
        }
	}

	public function update()
	{
		$data_id = array(
			'id'  => $this->input->post('e_id')
		);
		$data = array(
			'nip'  => $this->input->post('e_nip'),
			'thr'  => $this->input->post('e_thr_v'),
			'lain' => $this->input->post('e_tjlain_v'),
			'tj_malam_lembur' => $this->input->post('e_tj_malam_lembur_v'),
			'tunj_khusus1' => $this->input->post('e_tunj_khusus1_v'),
			'tunj_khusus2' => $this->input->post('e_tunj_khusus2_v'),
			'ket_tunj_khusus1' => $this->input->post('e_ket_tunj_khusus1'),
			'ket_tunj_khusus2' => $this->input->post('e_ket_tunj_khusus2'),
			'updatedAt' => date('Y-m-d H:i:s')
		);
		// echo json_encode($data);exit;
		$action = $this->model_pendapatanlainkaryawan->update($data_id, $data, 'tbpendapatanlainkaryawan');
		echo json_encode($action);
		
		
	}

	public function delete()
    {
        $data_id = array(
            'id'  => $this->input->post('id')
		);
		$action = $this->model_pendapatanlainkaryawan->delete($data_id, 'tbpendapatanlainkaryawan');
		if($action){
			echo json_encode($action);
		}
	}
}
