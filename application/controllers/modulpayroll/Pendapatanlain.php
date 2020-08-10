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
			$periode = $this->input->post('id_guru');
			$data = array(
				'IdGuru'  => $this->input->post('id_guru'),
				'thr'  => $this->input->post('thr_v'),
				'tunjangan'  => $this->input->post('tjkinerja_v'),
				'lain' => $this->input->post('tjlain_v'),
				'jam1' => $this->input->post('jam1'),
				'tarif1' => $this->input->post('tarif1_v'),
				'jam2' => $this->input->post('jam2'),
				'inval' => $this->input->post('inval_v'),
				'tarif2' => $this->input->post('tarif2_v'),
				'jam3' => $this->input->post('jam3'),
				'tarif3' => $this->input->post('tarif3_v'),
				'jam4' => $this->input->post('jam4'),
				'tarif4' => $this->input->post('tarif4_v'),
				'ket_tunj_khusus1' => $this->input->post('ket_tunj_khusus1'),
				'tunj_khusus1' => $this->input->post('tunj_khusus1_v'),
				'ket_tunj_khusus2' => $this->input->post('ket_tunj_khusus2'),
				'tunj_khusus2' => $this->input->post('tunj_khusus2_v'),
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

	public function update()
	{
		$data_id = array(
			'id'  => $this->input->post('e_id')
		);
		$data = array(
				'thr'  => $this->input->post('e_thr_v'),
				'tunjangan'  => $this->input->post('e_tjkinerja_v'),
				'lain' => $this->input->post('e_tjlain_v'),
				'jam1' => $this->input->post('e_jam1'),
				'tarif1' => $this->input->post('e_tarif1_v'),
				'jam2' => $this->input->post('e_jam2'),
				'tarif2' => $this->input->post('e_tarif2_v'),
				'jam3' => $this->input->post('e_jam3'),
				'tarif3' => $this->input->post('e_tarif3_v'),
				'jam4' => $this->input->post('e_jam4'),
				'tarif4' => $this->input->post('e_tarif4_v'),
				'ket_tunj_khusus1' => $this->input->post('e_ket_tunj_khusus1'),
				'tunj_khusus1' => $this->input->post('e_tunj_khusus1_v'),
				'ket_tunj_khusus2' => $this->input->post('e_ket_tunj_khusus2'),
				'tunj_khusus2' => $this->input->post('e_tunj_khusus2_v'),
				'updatedAt' => date('Y-m-d H:i:s')
		);
		$action = $this->model_pendapatanlain->update($data_id, $data, 'tbpendapatanlainguru');
		echo json_encode($action);
	}

	public function tampil_byid()
    {
        if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {

            $data = array(
                'id'  => $this->input->post('id'),
            );
            $my_data = $this->model_pendapatanlain->view_where('tbpendapatanlainguru', $data)->result();
            echo json_encode($my_data);
        } else {
            $this->load->view('pagepayroll/login'); //Memanggil function render_view
        }
	}
}
