<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('model_guru');
		$this->load->model('model_jabatan');
	}

	function render_view($data)
	{
		$this->template->load('template', $data); //Display Page
	}

	public function index()
	{
		if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {

			$my_data = $this->model_guru->view('tbps')->result_array();
			$myagama = $this->model_guru->view('tbagama')->result_array();
			$mypendidikan = $this->model_guru->view('mspendidikan')->result_array();
			$data = array(
				'page_content' 	=> '/guru/index',
				'ribbon' 		=> '<li class="active">Dashboard</li><li>Master Guru</li>',
				'page_name' 	=> 'Master Guru',
				'js' 			=> 'js_file',
				'myprogram' 	=> $my_data,
				'myagama'		=> $myagama,
				'mypendidikan' 	=> $mypendidikan
			);
			$this->render_view($data); //Memanggil function render_view
		} else {
			$this->load->view('page/login'); //Memanggil function render_view
		}
	}

	public function simpan()
	{
		if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {

			$data = array(
				'IdGuru'  => $this->input->post('IdGuru'),
				'GuruNoDapodik'  => $this->input->post('GuruNoDapodik'),
				'GuruNama'  => $this->input->post('nama'),
				'GuruTelp'  => $this->input->post('telepon'),
				'GuruAlamat'  => $this->input->post('alamat'),
				'GuruBase' => $this->input->post('program_sekolah'),
				// 'GuruWaktu'  => $this->input->post('alamat'),
				'GuruJeniskelamin'  => $this->input->post('jenis_kelamin'),
				'GuruPendidikanAkhir'  => $this->input->post('pendidikan_terakhir'),
				'GuruAgama'  => $this->input->post('agama'),
				'GuruEmail' => $this->input->post('email'),
				'GuruTglLahir'  => $this->input->post('tgl_lahir'),
				'GuruTempatLahir'  => $this->input->post('tempat_lahir'),
				'GuruStatus'  => $this->input->post('status'),
				'createdAt' => date('Y-m-d H:i:s')
			);
			$count_id = $this->model_guru->view_count('TBGURU', $data['IdGuru']);
			if ($count_id < 1) {
				$result = $this->model_guru->insert($data, 'TBGURU');
				if ($result) {
					echo $result;
				} else {
					echo 'insert gagal';
				}
			} else {
				echo json_encode(401);
			}
		} else {
			$this->load->view('page/login'); //Memanggil function render_view
		}
	}

	public function tampil_byid()
	{
		if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {

			$data = array(
				'id'  => $this->input->post('id'),
			);
			$my_data = $this->model_guru->view_where_v2('TBGURU', $data)->result();
			echo json_encode($my_data);
		} else {
			$this->load->view('page/login'); //Memanggil function render_view
		}
	}

	public function import()
	{
		if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
			$files = $_FILES;
			$file = $files['file'];
			$fname = $file['tmp_name'];
			// if ($file['type'] == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' || $file['type'] == 'application/vnd.ms-excel') {
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
			$data_success = [];
			$data_error   = [];
			$empty_message = [];
			foreach ($data_exist as $key => $value) {
				if ($value[1] == 'Total') {
					break;
				} else {
					if ($key == '0') {
						continue;
					} else {
						$all_message = "";
						$status = '';
						$keys = $key - 4;
						// // Validation Data Transaction Header
						if (!$value[0]) {
							array_push($empty_message, "Kode Guru at row "  . $keys . " has wrong format/need to be filled");
						}

						if (!$value[1]){
							array_push($empty_message, '"Kode Dapodik " at row ' . $keys . ' has wrong format/need to be filled');
						}

						if (!$value[2]){
							array_push($empty_message, '"Nama" at row ' . $keys . ' has wrong format/need to be filled');
						}

						if (!$value[3]){
							array_push($empty_message, '"Telephone' . $keys . ' has wrong format/need to be filled');
						}

						if (!$value[4]) {
							array_push($empty_message, '"Alamat ' . $keys . ' has wrong format/need to be filled');
						}

						if (!$value[5]) {
							array_push($empty_message, '"Program Sekolah ' . $keys . ' has wrong format/need to be filled');
						}

						if (!$value[6]) {
							array_push($empty_message, '"Jenis Kelamin ' . $keys . ' has wrong format/need to be filled');
						}

						if (!$value[7]) {
							array_push($empty_message, '"Pendidikan Akhir' . $keys . ' has wrong format/need to be filled');
						}

						if (!$value[8]) {
							array_push($empty_message, '"Agama' . $keys . ' has wrong format/need to be filled');
						}

						if (!$value[9]) {
							array_push($empty_message, '"Email" at row ' . $keys . ' has wrong format/need to be filled');
						}
						if (!$value[12]) {
							array_push($empty_message, '"Tangal lahir" at row ' . $keys . ' null');
						}

						if (!$value[13]) {
							array_push($empty_message, '"Tempat Lahir" at row ' . $keys . ' has wrong format/need to be filled');
						}

						$validated_data = array(
							'row_no' => $key + 1,
							'fullname' => $value[2],
							'id_nationality_number' => $value[3],
							'birthdate' => $value[4],
							'address' => $value[5],
							'handphone' => $value[6],
							'email' => $value[7],
							'date_of_loan_disbusement' => $value[8],
							'end_date_of_loan_repayment' => $value[9],
							'tenor_calculation' => $value[10],
							'tenor' => $value[11],
							'disbursed_loan_amount' => str_replace(',', '', $value[12]),
							'contribute_rate' => $value[13],
							'amount_contribution' => str_replace(',', '', $value[14]),
						);
						if ($status == 'failed') {
							array_push($data_error, $validated_data);
						} else {
							array_push($data_success, $validated_data);
						}
					}
				}
			}
			if (!empty($empty_message)) {
				$ret['msg'] = $empty_message;
				$this->session->set_flashdata('message', ''.json_encode($ret['msg']));
				redirect(base_url('guru/index'));
			}
			// print_r($allDataInSheet);exit;
			// $data = new Spreadsheet_Excel_Reader($temp);
			// $hasildata = $data->rowcount($sheet_index = 0);
			// print_r($data);
			// $sukses = $gagal = 0;
			// 			for ($i = 2; $i <= $hasildata; $i++) {
			// 				$kode = $data->val($i, 1);
			// 				print_r($kode);
			// 				exit;
			// 				$dapodik = $data->val($i, 2);
			// 				$nama = $data->val($i, 3);
			// 				$telp = $data->val($i, 4);
			// 				$alamat = $data->val($i, 5);
			// 				$programsekolah = $data->val($i, 6);
			// 				$jeniskelamin = $data->val($i, 7);
			// 				$pendidikanterakhir = $data->val($i, 8);
			// 				$agama = $data->val($i, 9);
			// 				$email = $data->val($i, 10);
			// 				$tanggallahir = $data->val($i, 11);
			// 				$tempatlahir = $data->val($i, 12);
			// 				$sqlbimbing = "INSERT INTO TBGURU 
			// (IdGuru,GuruNoDapodik,GuruNama,GuruTelp,GuruAlamat,GuruJeniskelamin,
			// GuruPendidikanAkhir,GuruAgama,GuruEmail,GuruTglLahir,GuruTempatLahir,GuruStatus,GuruBase) 
			// VALUES('" . $kode . "','" . $dapodik . "','" . $nama . "','" . $telp . "','" . $alamat . "','" . $jeniskelamin . "','" . $pendidikanterakhir . "','" . $agama . "','" . $email . "','" . $tanggallahir . "','" . $tempatlahir . "','" . T . "','" . $programsekolah . "')";
			// 			}
		} else {
			$this->load->view('page/login'); //Memanggil function render_view
		}
		// }
	}

	public function tampil()
	{
		if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {

			$my_data = $this->model_guru->view_guru('TBGURU')->result_array();
			echo json_encode($my_data);
		} else {
			$this->load->view('page/login'); //Memanggil function render_view
		}
	}

	public function update()
	{
		if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {

			$data_id = array(
				'id'  => $this->input->post('e_id')
			);
			$data = array(
				'IdGuru'  => $this->input->post('e_IdGuru'),
				'GuruNoDapodik'  => $this->input->post('e_GuruNoDapodik'),
				'GuruNama'  => $this->input->post('e_nama'),
				'GuruTelp'  => $this->input->post('e_telepon'),
				'GuruAlamat'  => $this->input->post('e_alamat'),
				'GuruBase' => $this->input->post('e_program_sekolah'),
				// 'GuruWaktu'  => $this->input->post('alamat'),
				'GuruJeniskelamin'  => $this->input->post('e_jenis_kelamin'),
				'GuruPendidikanAkhir'  => $this->input->post('e_pendidikan_terakhir'),
				'GuruAgama'  => $this->input->post('e_agama'),
				'GuruEmail' => $this->input->post('e_email'),
				'GuruTglLahir'  => $this->input->post('e_tgl_lahir'),
				'GuruTempatLahir'  => $this->input->post('e_tempat_lahir'),
				'GuruStatus'  => $this->input->post('e_status'),
				'updatedAt' => date('Y-m-d H:i:s')
			);
			$action = $this->model_guru->update($data_id, $data, 'TBGURU');
			echo json_encode($action);
		} else {
			$this->load->view('page/login'); //Memanggil function render_view
		}
	}

	public function delete()
	{
		if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {

			$data_id = array(
				'id'  => $this->input->post('id')
			);
			$data = array(
				'isdeleted'  => 1,
			);
			$action = $this->model_guru->update($data_id, $data, 'TBGURU');
			echo json_encode($action);
		} else {
			$this->load->view('page/login'); //Memanggil function render_view
		}
	}
}
