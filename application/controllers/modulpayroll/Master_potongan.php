<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_potongan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('payroll/model_mastpotongan');
	}

	function render_view($data)
	{
		$this->template->load('templatepayroll', $data); //Display Page
	}

	public function index()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {

			$mykaryawan = $this->model_mastpotongan->view('biodata_karyawan')->result_array();
			$data = array(
				'page_content' 	=> '../pagepayroll/master_potongan/view',
				'ribbon' 		=> '<li class="active">Master Potongan Karyawan</li>',
				'page_name' 	=> 'Master Potongan Karyawan',
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
		$my_data = $this->model_mastpotongan->view_potongan()->result_array();
		echo json_encode($my_data);
	}

	public function simpan()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$data = array(
				'id_karyawan'  => $this->input->post('id_karyawan'),
				'infaq_masjid'  => $this->input->post('infaq_masjid_v'),
				'anggota_koperasi'  => $this->input->post('anggota_koperasi_v'),
				'kas_bon' => $this->input->post('kas_bon_v'),
				'ijin_telat' => $this->input->post('ijin_telat_v'),
				'koperasi' => $this->input->post('koperasi_v'),
				'bmt' => $this->input->post('bmt_v'),
				'inval'  => $this->input->post('inval_v'),
				'toko' => $this->input->post('toko_v'),
				'tawun'  => $this->input->post('tawun_v'),
				'ltq'  => $this->input->post('ltq_v'),
				'bpjs'  => $this->input->post('bpjs_v'),
				'pph21'  => $this->input->post('pph21_v'),
				'ket_lain1' => $this->input->post('ket_lain'),
				'ket_lain2'  => $this->input->post('ket_lain2'),
				'ket_lain3'  => $this->input->post('ket_lain3'),
				'lain1' => $this->input->post('lain_v'),
				'lain2'  => $this->input->post('lain2_v'),
				'lain3'  => $this->input->post('lain3_v'),
				'createdAt' => date('Y-m-d H:i:s')
			);

			$hasil = $this->model_mastpotongan->cek_karyawan($this->input->post('id_karyawan'), $this->input->post('periode'))->num_rows();
			if ($hasil > 0) {
				echo 401;
			} else {
				$result = $this->model_mastpotongan->insert($data, 'tbkaryawanpot');
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
			$my_data = $this->model_mastpotongan->view_where('tbkaryawanpot', $data)->result();
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
				'jht'  => $this->input->post('e_jht_v'),
				'pph21'  => $this->input->post('e_pph21_v'),
				'bpjs'  => $this->input->post('e_bpjs_v'),
				'ltq'  => $this->input->post('e_ltq_v'),
				'ket_lain1' => $this->input->post('e_ket_lain1'),
				'ket_lain2'  => $this->input->post('e_ket_lain2'),
				'ket_lain3'  => $this->input->post('e_ket_lain3'),
				'lain1' => $this->input->post('e_lain_v'),
				'lain2'  => $this->input->post('e_lain2_v'),
				'lain3'  => $this->input->post('e_lain3_v'),
				'periode'  => $this->input->post('e_periode'),
			);

			$my_data = $this->model_mastpotongan->update($data, $dataupdate, 'tbkaryawanpot');
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
		$action = $this->model_mastpotongan->delete($data_id, 'tbkaryawanpot');
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
					if (empty($value[2])) {
						array_push($empty_message, "No at row "  . $keys . " Infaq harus di isi, Tulis 0 jika tidak ada ");
					}
					if (empty($value[3])) {
						array_push($empty_message, "No at row "  . $keys . "Anggota koperasi harus di isi, Tulis 0 jika tidak ada");
					}
					if (empty($value[4])) {
						array_push($empty_message, "No at row "  . $keys . "Kas Bon harus di isi, Tulis 0 jika tidak ada");
					}
					if (empty($value[5])) {
						array_push($empty_message, "No at row "  . $keys . "Ijin Telat harus di isi, Tulis 0 jika tidak ada");
					}
					if (empty($value[6])) {
						array_push($empty_message, "No at row "  . $keys . "Pinjaman Koperasi / BMT harus di isi, Tulis 0 jika tidak ada");
					}
					if (empty($value[7])) {
						array_push($empty_message, "No at row "  . $keys . "Gemart / Koperasi harus di isi, Tulis 0 jika tidak ada");
					}
					if (empty($value[8])) {
						array_push($empty_message, "No at row "  . $keys . "Inval harus di isi, Tulis 0 jika tidak ada");
					}
					if (empty($value[9])) {
						array_push($empty_message, "No at row "  . $keys . "Toko al Hamra harus di isi, Tulis 0 jika tidak ada ");
					}
					if (empty($value[10])) {
						array_push($empty_message, "No at row "  . $keys . "Ta'wun harus di isi, Tulis 0 jika tidak ada ");
					}
					if (empty($value[11])) {
						array_push($empty_message, "No at row "  . $keys . "BPJS harus di isi, Tulis 0 jika tidak ada ");
					}
					if (empty($value[12])) {
						array_push($empty_message, "No at row "  . $keys . "LTQ harus di isi, Tulis 0 jika tidak ada ");
					}
					if (empty($value[13])) {
						array_push($empty_message, "No at row "  . $keys . "Lain 1 harus di isi, Tulis 0 jika tidak ada ");
					}
					if (empty($value[16])) {
						array_push($empty_message, "No at row "  . $keys . "Lain 2 harus di isi, Tulis 0 jika tidak ada ");
					}
					if (empty($value[18])) {
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
							'infaq_masjid' => $value[2],
							'anggota_koperasi' => $value[3],
							'kas_bon' => $value[4],
							'ijin_telat' => $value[5],
							'bmt' => $value[6],
							'koperasi' => $value[7],
							'inval' => $value[8],
							'toko' => $value[9],
							'tawun' => $value[10],
							'bpjs' => $value[11],
							'ltq' => $value[12],
							'ket_lain1' => $value[13],
							'lain1' => $value[14],
							'ket_lain2' => $value[15],
							'lain2' => $value[16],
							'ket_lain3' => $value[17],
							'lain3' => $value[18],
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
