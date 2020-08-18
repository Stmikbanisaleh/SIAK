<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_potongan_guru extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('payroll/model_masterpotongan_guru');
	}

	function render_view($data)
	{
		$this->template->load('templatepayroll', $data); //Display Page
	}

	public function index()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$myguru = $this->model_masterpotongan_guru->viewOrdering('tbguru', 'GuruNama', 'asc')->result_array();
			$data = array(
				'page_content' 	=> '../pagepayroll/master_potongan_guru/view',
				'ribbon' 		=> '<li class="active">Master Potongan Guru</li>',
				'page_name' 	=> 'Master Potongan Guru',
				'js' 			=> 'js_file',
				'myguru'		=> $myguru
			);
			$this->render_view($data);
		} else {
			$this->load->view('pagepayroll/login'); //Redirect login
		}
	}

	public function tampil()
	{
		$my_data = $this->model_masterpotongan_guru->view_potongan()->result_array();
		echo json_encode($my_data);
	}

	public function simpan()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$data = array(
				'IdGUru'  => $this->input->post('id_guru'),
				'infaq_masjid'  => $this->input->post('infaq_masjid_v'),
				'anggota_koperasi'  => $this->input->post('anggota_koperasi_v'),
				'kas_bon' => $this->input->post('kas_bon_v'),
				'ijin_telat' => $this->input->post('ijin_telat_v'),
				'koperasi' => $this->input->post('koperasi_v'),
				'bmt' => $this->input->post('bmt_v'),
				'inval'  => $this->input->post('inval_v'),
				'toko' => $this->input->post('toko_v'),
				'lain' => $this->input->post('lain_v'),
				'tawun'  => $this->input->post('tawun_v'),
				'pph21'  => $this->input->post('pph21_v'),
				'ltq'  => $this->input->post('ltq_v'),
				'bpjs'  => $this->input->post('bpjs_v'),
			);
			$cek = $this->model_masterpotongan_guru->cek($data['IdGUru'])->num_rows();
			if ($cek > 0) {
				echo 401;
			} else {
				$result = $this->model_masterpotongan_guru->insert($data, 'tbgurupot');
				if ($result) {
					echo $result;
				}
			}
		} else {
			$this->load->view('pagepayroll/login'); //Redirect login
		}
	}

	public function tampil_byid()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$data = array(
				'id_potong'  => $this->input->post('id'),
			);
			$my_data = $this->model_masterpotongan_guru->view_where('tbgurupot', $data)->result();
			echo json_encode($my_data);
		} else {
			$this->load->view('pagekasir/login'); //Memanggil function render_view
		}
	}

	public function update()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$data = array(
				'id_potong'  => $this->input->post('e_id_potong'),
			);
			$dataupdate = array(
				'infaq_masjid'  => $this->input->post('e_infaq_masjid_v'),
				'anggota_koperasi'  => $this->input->post('e_anggota_koperasi_v'),
				'kas_bon'  => $this->input->post('e_kas_bon_v'),
				'ijin_telat'  => $this->input->post('e_ijin_telat_v'),
				'bmt'  => $this->input->post('e_bmt_v'),
				'koperasi'  => $this->input->post('e_koperasi_v'),
				'inval'  => $this->input->post('e_inval_v'),
				'tawun' => $this->input->post('e_tawun_v'),
				'toko'  => $this->input->post('e_toko_v'),
				'lain'  => $this->input->post('e_lain_v'),
				'pph21'  => $this->input->post('e_pph21_v'),
				'bpjs'  => $this->input->post('e_bpjs_v'),
				'ltq'  => $this->input->post('e_ltq_v'),
			);

			$my_data = $this->model_masterpotongan_guru->update($data, $dataupdate, 'tbgurupot');
			echo json_encode($my_data);
		} else {
			$this->load->view('pagepayroll/login'); //Redirect login
		}
	}

	public function delete()
	{
		$data_id = array(
			'id_potong'  => $this->input->post('id')
		);
		$action = $this->model_masterpotongan_guru->delete($data_id, 'tbgurupot');
		if ($action) {
			echo json_encode($action);
		}
	}
}
