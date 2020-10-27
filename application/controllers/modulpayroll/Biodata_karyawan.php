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

	public function import()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$files = $_FILES;
			$file = $files['file'];
			$fname = $file['tmp_name'];
			$file = $_FILES['file']['name'];
			$fname = $_FILES['file']['tmp_name'];
			$ext = explode('.', $file);
			/** Include path **/
			set_include_path(APPPATH . 'third_party/PHPExcel/Classes/');
			/** PHPExcel_IOFactory */
			include 'PHPExcel/IOFactory.php';
			$objPHPExcel = PHPExcel_IOFactory::load($fname);
			$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, false, true);
			$data_exist = [];

			foreach ($allDataInSheet as $ads) {
				if (array_filter($ads)) {
					array_push($data_exist, $ads);
				}
			}
			foreach ($data_exist as $key => $value) {
				if ($key == '0') {
					continue;
				} else {
					$arrayCustomerQuote = array(
						'nip' => $value[0],
						'nik' => $value[1],
						'npwp' => $value[2],
						'nama' => $value[3],
						'jabatan' => $value[4],
						'jenis_kelamin' => $value[5],
						'agama' => $value[6],
						'email' => $value[7],
						'no_telp' => $value[8],
						'unit_kerja' => $value[9],
						'alamat' => $value[10],
						'pendidikan' => $value[11],
						'status' => $value[12],
						'tgl_mulai_kerja' => $value[13],
						'tgl_lhr' => $value[14],
						'tmp_lhr' => $value[15],
						'createdAt'	=> date('Y-m-d H:i:s')
					);
					$data = array(
						"nip" => $value[0],
					);
					$cek = $this->model_karyawan->cek($value[0])->num_rows();
					if ($cek > 0) {
						$result = $this->model_karyawan->update($data,  $arrayCustomerQuote, 'biodata_karyawan');
					} else {
						$result = $this->model_karyawan->insert($arrayCustomerQuote, 'biodata_karyawan');
					}
				}
			}
			if ($result) {
				$result = 1;
			}
			echo json_encode($result);
		} else {
			echo json_encode(500);
		}
	}

	public function index()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {

			$my_jabatan = $this->model_karyawan->view('msjabatan')->result_array();
			$my_pembayaran = $this->model_karyawan->view('jnspembayaran')->result_array();
			$mspendidikan = $this->model_karyawan->view('mspendidikan')->result_array();
			$myagama = $this->model_karyawan->view('tbagama')->result_array();
			$myunit = $this->model_karyawan->viewOrdering('sekolah', 'deskripsi', 'asc')->result_array();

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
			$result = $this->model_karyawan->insert($data, 'biodata_karyawan');
			if ($result) {
				echo $result;
			} else {
				echo 'insert gagal';
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
