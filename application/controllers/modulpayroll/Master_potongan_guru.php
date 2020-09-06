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
				'ket_khusus1'  => $this->input->post('ket_khusus1'),
				'tunj_khusus1'  => $this->input->post('tunj_khusus1_v'),
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
						array_push($empty_message, "No at row "  . $keys . " Kode Guru harus di isi");
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
					
					if (!empty($empty_message)) {
						$ret['msg'] = $empty_message;
						$this->session->set_flashdata('message', '' . json_encode($ret['msg']));
						$result = 2;
					} else {
						
						$arrayCustomerQuote = array(
							'IdGuru' => $value[0],
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
							'ket_khusus1' => $value[12],
							'tunj_khusus1' => $value[13],
							'pph21' => 0,
						);
						$data_id = array(
							'IdGuru' => $value[0]
						);
						$cek = $this->model_masterpotongan_guru->view_count('tbgurupot',$value[0]);
						if($cek > 0 ){
							$result = $this->model_masterpotongan_guru->update($data_id, $arrayCustomerQuote, 'tbgurupot');
						} else {
							$result = $this->model_masterpotongan_guru->insert($arrayCustomerQuote, 'tbgurupot');
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
				'ket_khusus1'  => $this->input->post('e_ket_khusus1'),
				'tunj_khusus1'  => $this->input->post('e_tunj_khusus1_v'),
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
