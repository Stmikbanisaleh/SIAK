<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Biodata_karyawan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('payroll/model_karyawan');
	}

	function render_view($data)
	{
		$this->template->load('templatepayroll', $data); //Display Page
	}

	public function index()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {

			$my_jabatan = $this->model_karyawan->view('msjabatan')->result_array();
			$my_pembayaran = $this->model_karyawan->view('jnspembayaran')->result_array();
			$mspendidikan = $this->model_karyawan->view('mspendidikan')->result_array();
			$myagama = $this->model_karyawan->view('tbagama')->result_array();
			$myunit = $this->model_karyawan->viewOrdering('sekolah','deskripsi','asc')->result_array();

			$data = array(
				'page_content' 	=> '../pagepayroll/biodata_karyawan/view',
				'ribbon' 		=> '<li class="active">Master Biodata Karyawan</li>',
				'page_name' 	=> 'Master Biodata Karyawan',
				'js' 			=> 'js_file',
				'my_jabatan' 	=> $my_jabatan,
				'my_pembayaran'	=> $my_pembayaran,
				'my_pendidikan'	=> $mspendidikan,
				'myagama'	=> $myagama,
				'myunit' => $myunit
			);
			$this->render_view($data); //Memanggil function render_view
		} else {
			$this->load->view('pagepayroll/login'); //Redirect login
		}
	}


	public function tampil()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$my_data = $this->model_karyawan->view_karyawan()->result_array();
			echo json_encode($my_data);
		} else {
			$this->load->view('pagepayroll/login'); //Redirect login
		}
	}

	public function simpan()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$data = array(
				'nik'  => $this->input->post('nik'),
				'nip'  => $this->input->post('nip'),
				'npwp'  => $this->input->post('npwp'),
				'nama'  => $this->input->post('nama'),
				'jabatan'  => $this->input->post('jabatan'),
				'jenis_kelamin'  => $this->input->post('jenis_kelamin'),
				'agama'  => $this->input->post('agama'),
				'email' => $this->input->post('email'),
				'no_telp'  => $this->input->post('telp'),
				'alamat'  => $this->input->post('alamat'),
				'pendidikan'  => $this->input->post('pendidikan_terakhir'),
				'tgl_lhr'  => $this->input->post('tgl_lahir'),
				'status' => $this->input->post('status'),
				'unit_kerja' => $this->input->post('unit_kerja'),
				'tgl_mulai_kerja'  => $this->input->post('tgl_mulai'),
				'createdAt' => date('Y-m-d H:i:s')
			);
			$count_id = $this->model_karyawan->view_count('biodata_karyawan', $data['nik']);
			if ($count_id < 1) {
				$result = $this->model_karyawan->insert($data, 'biodata_karyawan');
				if ($result) {
					echo $result;
				} else {
					echo 'insert gagal';
				}
			} else {
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
			$my_data = $this->model_karyawan->view_karyawan_where($data)->result();
			echo json_encode($my_data);
		} else {
			$this->load->view('pagepayroll/login'); //Redirect login
		}
	}

	public function tampil_byidtarif()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$data = array(
				'id'  => $this->input->post('id'),
			);
			$my_data = $this->model_karyawan->view_tarif_where($data)->result();
			echo json_encode($my_data);
		} else {
			$this->load->view('pagepayroll/login'); //Redirect login
		}
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

	public function delete()
	{
		$data_id = array(
			'id_karyawan'  => $this->input->post('id')
		);
		$data_id2 = array(
			'nip'  => $this->input->post('id')
		);
		$action = $this->model_karyawan->delete($data_id, 'tarifkaryawan');
		if ($action) {
			$action2 = $this->model_karyawan->delete($data_id2, 'biodata_karyawan');
			echo json_encode($action);
		}
	}
}
