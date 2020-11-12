<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendapatanguru extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('payroll/model_pendapatan_guru');
		// $this->load->model('payroll/model_karyawan');
	}

	function render_view($data)
	{
		$this->template->load('templatepayroll', $data); //Display Page
	}

	public function index()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {

			$my_jabatan = $this->model_pendapatan_guru->view('msjabatan')->result_array();
			$my_pembayaran = $this->model_pendapatan_guru->view('jnspembayaran')->result_array();
			$mspendidikan = $this->model_pendapatan_guru->view('mspendidikan')->result_array();
			$myagama = $this->model_pendapatan_guru->view('tbagama')->result_array();
			$myunit = $this->model_pendapatan_guru->viewOrdering('sekolah', 'deskripsi', 'asc')->result_array();
			$myguru = $this->model_pendapatan_guru->viewOrdering('tbguru', 'GuruNama', 'asc')->result_array();

			$data = array(
				'page_content' 	=> '../pagepayroll/pendapatan_guru/view',
				'ribbon' 		=> '<li class="active">Edit Pendapatan Guru</li>',
				'page_name' 	=> 'Edit Pendapatan Guru',
				'js' 			=> 'js_file',
				'my_jabatan' 	=> $my_jabatan,
				'my_pembayaran'	=> $my_pembayaran,
				'my_pendidikan'	=> $mspendidikan,
				'myagama'		=> $myagama,
				'myunit' 		=> $myunit,
				'myguru'		=> $myguru
			);
			$this->render_view($data); //Memanggil function render_view
		} else {
			$this->load->view('pagepayroll/login'); //Redirect login
		}
	}

	public function tampil()
	{
		// echo json_encode($this->input->post());exit;
		$where = array(
			'status'	=> $this->input->post('unit'),
			'employee_number'	=> $this->input->post('guru')
		);
		$my_data = $this->model_pendapatan_guru->viewWhereOrderingPendGuru('tb_pendapatan_guru', $where, $this->input->post('tgl_awal'), $this->input->post('tgl_akhir'), 'id_pendapatan', 'ASC')->result_array();
		// echo $this->db->last_query();exit;
		echo json_encode($my_data);
	}

	public function tampil_byid()
	{
		$where = array(
			'id_pendapatan'	=> $this->input->post('id'),
		);
		$my_data = $this->model_pendapatan_guru->viewWhereOrdering('tb_pendapatan_guru', $where, 'id_pendapatan', 'ASC')->result_array();
		echo json_encode($my_data);
	}

	public function updatebiodata()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$data = array(
				'id_biodata'  => $this->input->post('e_id'),
			);

			$dataupdate = array(
				'nik'  => $this->input->post('e_nik'),
				'nama'  => $this->input->post('e_nama'),
				'jabatan'  => $this->input->post('e_jabatan'),
				'jenis_kelamin'  => $this->input->post('e_jenis_kelamin'),
				'agama'  => $this->input->post('e_agama'),
				'nip'  => $this->input->post('e_nip'),
				'email'  => $this->input->post('e_email'),
				'npwp'  => $this->input->post('e_npwp'),
				'no_telp'  => $this->input->post('e_telp'),
				'alamat'  => $this->input->post('e_alamat'),
				'alamat'  => $this->input->post('e_alamat'),
				'unit_kerja' => $this->input->post('e_unit_kerja'),
				'pendidikan'  => $this->input->post('e_pendidikan_terakhir'),
				'tgl_lhr'  => $this->input->post('e_tgl_lahir'),
				'tgl_mulai_kerja'  => $this->input->post('e_tgl_mulai'),
				'status'  => $this->input->post('e_status')
			);

			$my_data = $this->model_karyawan->update($data, $dataupdate, 'biodata_karyawan');
			echo json_encode($my_data);
		} else {
			$this->load->view('pagepayroll/login'); //Redirect login
		}
	}
}
