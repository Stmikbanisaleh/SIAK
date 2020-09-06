<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendapatanlainkaryawan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('payroll/model_pendapatanlainkaryawan');
	}

	function render_view($data)
	{
		$this->template->load('templatepayroll', $data); //Display Page
	}

	public function index()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {

			$mykaryawan = $this->model_pendapatanlainkaryawan->viewOrdering('biodata_karyawan', 'nama', 'asc')->result_array();
			$data = array(
				'page_content' 	=> '../pagepayroll/pendapatanlainkaryawan/view',
				'ribbon' 		=> '<li class="active">Master Pendapatan Lain Karyawan </li>',
				'page_name' 	=> 'Master Pendapatan Lain Karyawan',
				'js' 			=> 'js_file',
				'mykaryawan'		=> $mykaryawan
			);
			$this->render_view($data);
		} else {
			$this->load->view('pagepayroll/login'); //Redirect login
		}
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
			if ($hasil < 1) {
				$periode = date("m", strtotime($this->input->post('periode')));
				$data = array(
					'nip'  => $this->input->post('nip'),
					'thr'  => $this->input->post('thr_v'),
					'lain' => $this->input->post('tjlain_v'),
					'tj_malam_lembur' => $this->input->post('tj_malam_lembur_v'),
					'tunj_khusus1' => $this->input->post('tunj_khusus1_v'),
					'tunj_khusus2' => $this->input->post('tunj_khusus2_v'),
					'tunj_khusus3' => $this->input->post('tunj_khusus3_v'),
					'tunj_khusus4' => $this->input->post('tunj_khusus4_v'),
					'tunj_khusus5' => $this->input->post('tunj_khusus5_v'),
					'ket_tunj_khusus1' => $this->input->post('ket_tunj_khusus1'),
					'ket_tunj_khusus2' => $this->input->post('ket_tunj_khusus2'),
					'ket_tunj_khusus3' => $this->input->post('ket_tunj_khusus3'),
					'ket_tunj_khusus4' => $this->input->post('ket_tunj_khusus4'),
					'ket_tunj_khusus5' => $this->input->post('ket_tunj_khusus5'),
					// 'periode' => $this->input->post('periode'),
					'createdAt' => date('Y-m-d H:i:s')
				);
				$hasil = $this->model_pendapatanlainkaryawan->cek_karyawan($this->input->post('nip'), $periode)->num_rows();
				if ($hasil > 0) {
					echo 401;
				} else {
					$result = $this->model_pendapatanlainkaryawan->insert($data, 'tbpendapatanlainkaryawan');
					if ($result) {
						echo $result;
					}
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
			$my_data = $this->model_pendapatanlainkaryawan->view_where('tbpendapatanlainkaryawan', $data)->result();
			echo json_encode($my_data);
		} else {
			$this->load->view('pagepayroll/login'); //Memanggil function render_view
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
			'tunj_khusus3' => $this->input->post('e_tunj_khusus3_v'),
			'tunj_khusus4' => $this->input->post('e_tunj_khusus4_v'),
			'tunj_khusus5' => $this->input->post('e_tunj_khusus5_v'),
			'ket_tunj_khusus1' => $this->input->post('e_ket_tunj_khusus1'),
			'ket_tunj_khusus2' => $this->input->post('e_ket_tunj_khusus2'),
			'ket_tunj_khusus3' => $this->input->post('e_ket_tunj_khusus3'),
			'ket_tunj_khusus4' => $this->input->post('e_ket_tunj_khusus4'),
			'ket_tunj_khusus5' => $this->input->post('e_ket_tunj_khusus5'),
			'updatedAt' => date('Y-m-d H:i:s')
		);
		$action = $this->model_pendapatanlainkaryawan->update($data_id, $data, 'tbpendapatanlainkaryawan');
		echo json_encode($action);
	}

	public function delete()
	{
		$data_id = array(
			'id'  => $this->input->post('id')
		);
		$action = $this->model_pendapatanlainkaryawan->delete($data_id, 'tbpendapatanlainkaryawan');
		if ($action) {
			echo json_encode($action);
		}
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
			$empty_message = [];
			foreach ($allDataInSheet as $ads) {
				if (array_filter($ads)) {
					array_push($data_exist, $ads);
				}
			}
			foreach ($data_exist as $keys => $value) {
				if ($keys == '0') {
					continue;
				} else {
					if (empty($value[0])) {
						array_push($empty_message, "No at row "  . $keys . " Kode Karyawan harus di isi");
					}
					if (empty($value[1])) {
						array_push($empty_message, "No at row "  . $keys . " Infaq harus di isi, Tulis 0 jika tidak ada ");
					}
					if (empty($value[2])) {
						array_push($empty_message, "No at row "  . $keys . "Anggota koperasi harus di isi, Tulis 0 jika tidak ada");
					}
					if (empty($value[3])) {
						array_push($empty_message, "No at row "  . $keys . "Kas Bon harus di isi, Tulis 0 jika tidak ada");
					}
					if (empty($value[4])) {
						array_push($empty_message, "No at row "  . $keys . "Ijin Telat harus di isi, Tulis 0 jika tidak ada");
					}
					if (empty($value[5])) {
						array_push($empty_message, "No at row "  . $keys . "Pinjaman Koperasi / BMT harus di isi, Tulis 0 jika tidak ada");
					}
					if (empty($value[6])) {
						array_push($empty_message, "No at row "  . $keys . "Gemart / Koperasi harus di isi, Tulis 0 jika tidak ada");
					}
					if (empty($value[7])) {
						array_push($empty_message, "No at row "  . $keys . "Inval harus di isi, Tulis 0 jika tidak ada");
					}
					if (empty($value[8])) {
						array_push($empty_message, "No at row "  . $keys . "Toko al Hamra harus di isi, Tulis 0 jika tidak ada ");
					}
					if (empty($value[9])) {
						array_push($empty_message, "No at row "  . $keys . "Ta'wun harus di isi, Tulis 0 jika tidak ada ");
					}
					if (empty($value[10])) {
						array_push($empty_message, "No at row "  . $keys . "BPJS harus di isi, Tulis 0 jika tidak ada ");
					}
					if (empty($value[11])) {
						array_push($empty_message, "No at row "  . $keys . "LTQ harus di isi, Tulis 0 jika tidak ada ");
					}
					if (empty($value[13])) {
						array_push($empty_message, "No at row "  . $keys . "Lain 1 harus di isi, Tulis 0 jika tidak ada ");
					}
					if (empty($value[15])) {
						array_push($empty_message, "No at row "  . $keys . "Lain 2 harus di isi, Tulis 0 jika tidak ada ");
					}
					if (empty($value[17])) {
						array_push($empty_message, "No at row "  . $keys . "Lain 3 harus di isi, Tulis 0 jika tidak ada ");
					}
					if (!empty($empty_message)) {
						$ret['msg'] = $empty_message;
						$this->session->set_flashdata('message', '' . json_encode($ret['msg']));
						$result = 2;
					} else {
						$getid = $this->model_mastpotongan->getnip($value[0]);
						$arrayCustomerQuote = array(
							'id_karyawan' => $getid[0]['id_biodata'],
							'infaq_masjid' => $value[1],
							'anggota_koperasi' => $value[2],
							'kas_bon' => $value[3],
							'ijin_telat' => $value[4],
							'bmt' => $value[5],
							'koperasi' => $value[6],
							'inval' => $value[7],
							'toko' => $value[8],
							'tawun' => $value[9],
							'bpjs' => $value[10],
							'ltq' => $value[11],
							'ket_lain1' => $value[12],
							'lain1' => $value[13],
							'ket_lain2' => $value[14],
							'lain2' => $value[15],
							'ket_lain3' => $value[16],
							'lain3' => $value[17],
							'jht' => 0,
							'pph21' => 0,
						);
						$data_id = array(
							'id_karyawan' => $value[0]
						);
						$cek = $this->model_mastpotongan->view_count('tbkaryawanpot',$getid[0]['id_biodata']);
						if($cek > 0 ){
							$result = $this->model_mastpotongan->update($data_id, $arrayCustomerQuote, 'tbkaryawanpot');
						} else {
							$result = $this->model_mastpotongan->insert($arrayCustomerQuote, 'tbkaryawanpot');
						}
						$result = 1;

					}
				}
			}
			echo json_encode($result);
		} else {
			$result = 0;
			echo json_encode($result);
		}
	}
}
