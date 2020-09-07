<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendapatanlain extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('payroll/model_pendapatanlain');
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
					// if ($value[0] == "") {
					// 	array_push($empty_message, "No at row "  . $keys . " Id Guru harus di isi");
					// }
					// if ($value[1] == "") {
					// 	array_push($empty_message, "No at row "  . $keys . " Lain Lain harus di isi, Tulis 0 jika tidak ada ");
					// }
					// if ($value[2] == "") {
					// 	array_push($empty_message, "No at row "  . $keys . "Tunjangan Penilaian Kinerja harus di isi, Tulis 0 jika tidak ada");
					// }
					// if ($value[3] == "") {
					// 	array_push($empty_message, "No at row "  . $keys . "THR harus di isi, Tulis 0 jika tidak ada");
					// }
					// if ($value[4] == "") {
					// 	array_push($empty_message, "No at row "  . $keys . "Inval harus di isi, Tulis 0 jika tidak ada");
					// }
					// if ($value[6] == "") {
					// 	array_push($empty_message, "No at row "  . $keys . "Nilai Tunj Khusus 1 harus di isi, Tulis 0 jika tidak ada");
					// }
					// if ($value[8] == "") {
					// 	array_push($empty_message, "No at row "  . $keys . "Nilai Tunj Khusus 2 harus di isi, Tulis 0 jika tidak ada");
					// }
					// if ($value[9] == "") {
					// 	array_push($empty_message, "No at row "  . $keys . "Jumlah Jam 1 harus di isi, Tulis 0 jika tidak ada");
					// }
					// if ($value[10] == "") {
					// 	array_push($empty_message, "No at row "  . $keys . "Nominal Tambahan 1 harus di isi, Tulis 0 jika tidak ada ");
					// }
					// if ($value[11] == "") {
					// 	array_push($empty_message, "No at row "  . $keys . "Jumlah Jam 2 harus di isi, Tulis 0 jika tidak ada ");
					// }
					// if ($value[12] == "") {
					// 	array_push($empty_message, "No at row "  . $keys . "Nominal Tambahan 2, Tulis 0 jika tidak ada ");
					// }
					// if ($value[13] == "") {
					// 	array_push($empty_message, "No at row "  . $keys . "Jumlah Jam 3, Tulis 0 jika tidak ada ");
					// }
					// if ($value[14] == "") {
					// 	array_push($empty_message, "No at row "  . $keys . "Nominal Tambahan 3 harus di isi, Tulis 0 jika tidak ada ");
					// }
					// if ($value[15] == "") {
					// 	array_push($empty_message, "No at row "  . $keys . "Jumlah Jam 4, Tulis 0 jika tidak ada ");
					// }
					// if ($value[16] == "") {
					// 	array_push($empty_message, "No at row "  . $keys . "Nominal Tambahan 4 harus di isi, Tulis 0 jika tidak ada ");
					// }
					if (!empty($empty_message)) {
						$ret['msg'] = $empty_message;
						$this->session->set_flashdata('message', '' . json_encode($ret['msg']));
						$result = 2;
					} else {
						$arrayCustomerQuote = array(
							'IdGuru' => $value[0],
							'lain' => $value[1],
							'tunjangan' => $value[2],
							'thr' => $value[3],
							'inval' => $value[4],
							'ket_tunj_khusus1' => $value[5],
							'tunj_khusus1' => $value[6],
							'ket_tunj_khusus2' => $value[7],
							'tunj_khusus2' => $value[8],
							'jam1' => $value[9],
							'tarif1' => $value[10],
							'jam2' => $value[11],
							'tarif2' => $value[12],
							'jam3' => $value[13],
							'tarif3' => $value[14],
							'jam4' => $value[15],
							'tarif4' => $value[16],
							'createdAt' => date('Y-m-d H:i:s'),
							'isdeleted' => 0
						);
						$data_id = array(
							'IdGuru' => $value[0]
						);
						$cek = $this->model_pendapatanlain->view_count('tbpendapatanlainguru',$value[0]);
						if($cek > 0 ){
							$result = $this->model_pendapatanlain->update($data_id, $arrayCustomerQuote, 'tbpendapatanlainguru');
						} else {
							$result = $this->model_pendapatanlain->insert($arrayCustomerQuote, 'tbpendapatanlainguru');
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

	public function index()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$myguru = $this->model_pendapatanlain->viewOrdering('tbguru', 'GuruNama', 'asc')->result_array();
			$data = array(
				'page_content' 	=> '../pagepayroll/pendapatanlain/view',
				'ribbon' 		=> '<li class="active">Master Pendapatan Lain Guru </li>',
				'page_name' 	=> 'Master Pendapatan Lain Guru',
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
			if ($hasil > 0) {
				echo 401;
			} else {
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
		if ($action) {
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
