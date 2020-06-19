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
		$my_jabatan = $this->model_karyawan->view('msjabatan')->result_array();
		$my_pembayaran = $this->model_karyawan->view('jnspembayaran')->result_array();

		$data = array(
			'page_content' 	=> '../pagepayroll/biodata_karyawan/view',
			'ribbon' 		=> '<li class="active">Dashboard</li><li>Master Biodata Karyawan</li>',
			'page_name' 	=> 'Master Biodata Karyawan',
			'js' 			=> 'js_file',
			'my_jabatan' 	=> $my_jabatan,
			'my_pembayaran'		=> $my_pembayaran,
		);
		$this->render_view($data); //Memanggil function render_view
	}

	public function tampil()
	{
		$my_data = $this->model_karyawan->view_karyawan()->result_array();
		echo json_encode($my_data);
	}

	public function simpan()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$data = array(
				'nik'  => $this->input->post('nik'),
				'nama'  => $this->input->post('nama'),
				'jabatan'  => $this->input->post('jabatan'),
				'jenis_kelamin'  => $this->input->post('jenis_kelamin'),
				'agama'  => $this->input->post('agama'),
				'email' => $this->input->post('email'),
				'no_telp'  => hash('sha512',md5($this->input->post('telp'))),
				'alamat'  => $this->input->post('alamat'),
				'pendidikan'  => $this->input->post('pendidikan_terakhir'),
				'tgl_lhr'  => $this->input->post('tgl_lahir'),
				'status' => $this->input->post('status'),
				'tgl_mulai_kerja'  => $this->input->post('tgl_mulai'),
				'createdAt' => date('Y-m-d H:i:s')
			);
			$datatarif = array(
				'id_pengawas' => $this->input->post('nik'),
				'jabatan' => $this->input->post('jabatan'),
				'infak_masjid'  => $this->input->post('infak_v'),
				'potongan'  => $this->input->post('potongan_v'),
				'koperasi'  => $this->input->post('koperasi_v'),
				'anggota_koperasi'  => $this->input->post('anggota_koperasi_v'),
				'TARIF'  => $this->input->post('tarif_v'),
				'ijin_telat' => $this->input->post('ijin_telat_v'),
				'bmt'  => $this->input->post('bmt_v'),
				'diinval'  => $this->input->post('diinval_v'),
				
				'nama_pembayaran'  => $this->input->post('nama_pembayaran'),
				'createdAt' => date('Y-m-d H:i:s')
			);

			$count_id = $this->model_karyawan->view_count('biodata_karyawan', $data['nik']);
			if ($count_id < 1) {
				$result = $this->model_karyawan->insert($data, 'biodata_karyawan');
				$result2 = $this->model_karyawan->insert($datatarif , 'tarif_karyawan');
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

}
