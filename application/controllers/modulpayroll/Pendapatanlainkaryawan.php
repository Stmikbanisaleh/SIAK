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
						array_push($empty_message, "No at row "  . $keys . " NIP harus di isi");
					}
					if (empty($value[2])) {
						array_push($empty_message, "No at row "  . $keys . " Pendapatan Lain harus di isi, Tulis 0 jika tidak ada ");
					}
					if (empty($value[3])) {
						array_push($empty_message, "No at row "  . $keys . " Tunjangan Lembur harus di isi, Tulis 0 jika tidak ada");
					}
					if (empty($value[4])) {
						array_push($empty_message, "No at row "  . $keys . "THR harus di isi, Tulis 0 jika tidak ada");
					}
					if ($value[6] == "") {
						array_push($empty_message, "No at row "  . $keys . "Nominal Tunjangan Khusus 1 harus di isi, Tulis 0 jika tidak ada");
					}
					if ($value[8] == "") {
						array_push($empty_message, "No at row "  . $keys . "Nominal Tunjangan Khusus 2 harus di isi, Tulis 0 jika tidak ada");
					}
					if ($value[10] == "") {
						array_push($empty_message, "No at row "  . $keys . "Nominal Tunjangan Khusus 3 harus di isi, Tulis 0 jika tidak ada");
					}
					if ($value[12] == "") {
						array_push($empty_message, "No at row "  . $keys . "Nominal Tunjangan Khusus 4 harus di isi, Tulis 0 jika tidak ada");
					}
					if ($value[14] == "") {
						array_push($empty_message, "No at row "  . $keys . "Nominal Tunjangan Khusus 5 harus di isi, Tulis 0 jika tidak ada");
					}
					if (!empty($empty_message)) {
						$ret['msg'] = $empty_message;
						$this->session->set_flashdata('message', '' . json_encode($ret['msg']));
						$result = 2;
					} else {
						$getid = $this->model_pendapatanlainkaryawan->getnip($value[0]);
						$arrayCustomerQuote = array(
							'nip' => $getid[0]['id_biodata'],
							'lain' => $value[2],
							'tj_malam_lembur' => $value[3],
							'thr' => $value[4],
							'ket_tunj_khusus1' => $value[5],
							'tunj_khusus1' => $value[6],
							'ket_tunj_khusus2' => $value[7],
							'tunj_khusus2' => $value[8],
							'ket_tunj_khusus3' => $value[9],
							'tunj_khusus3' => $value[10],
							'ket_tunj_khusus4' => $value[11],
							'tunj_khusus4' => $value[12],
							'ket_tunj_khusus5' => $value[13],
							'tunj_khusus5' => $value[14],
							'createdAt' => date('Y-m-d H:i:s'),
							'isdeleted' => 0,
						);
						$data_id = array(
							'nip' => $value[0]
						);
						$cek = $this->model_pendapatanlainkaryawan->view_count('tbpendapatanlainkaryawan',$getid[0]['id_biodata']);
						if($cek > 0 ){
							$result = $this->model_pendapatanlainkaryawan->update($data_id, $arrayCustomerQuote, 'tbpendapatanlainkaryawan');
						} else {
							$result = $this->model_pendapatanlainkaryawan->insert($arrayCustomerQuote, 'tbpendapatanlainkaryawan');
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

	public function downloadsample()
	{
		set_include_path(APPPATH . 'third_party/PHPExcel/Classes/');
		include 'PHPExcel/IOFactory.php';
		$objPHPExcel = new PHPExcel();
		$idtarif = $this->model_pendapatanlainkaryawan->getformat()->result_array();
		$data = $idtarif;
		$no = 1;
		$row = 2;
		if (count($data) > 0) {
			if ($data) {
				$key = array_keys($data[0]);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'NIP');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'Nama Karyawan');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'Tunjangan Lain');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'Tunjangan Malam / Lembur');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', 'THR');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', 'Keterangan Tunj Khusus 1');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', 'Nominal Khusus 1');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1', 'Keterangan Tunj Khusus 2');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1', 'Nominal Khusus 2');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J1', 'Keterangan Tunj Khusus 3');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K1', 'Nominal Khusus 3');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L1', 'Keterangan Tunj Khusus 4');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M1', 'Nominal Khusus 4');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N1', 'Keterangan Tunj Khusus 5');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O1', 'Nominal Khusus 5');

				foreach ($data as $dataExcel) {
					
					$objPHPExcel->getActiveSheet(0)->getStyle('A' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('A' . $row, $dataExcel['nip'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('A')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('B' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('B' . $row, $dataExcel['nama'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('B')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('C' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('C' . $row, $dataExcel['lain'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('C')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('D' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('D' . $row, $dataExcel['tj_malam_lembur'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('D')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('E' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('E' . $row, $dataExcel['thr'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('E')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('F' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('F' . $row, $dataExcel['ket_tunj_khusus1'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('F')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('G' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('G' . $row, $dataExcel['tunj_khusus1'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('G')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('H' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('H' . $row, $dataExcel['ket_tunj_khusus2'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('H')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('I' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('I' . $row, $dataExcel['tunj_khusus2'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('I')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('J' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('J' . $row, $dataExcel['ket_tunj_khusus3'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('J')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('K' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('K' . $row, $dataExcel['tunj_khusus3'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('K')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('L' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('L' . $row, $dataExcel['ket_tunj_khusus4'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('L')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('M' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('M' . $row, $dataExcel['tunj_khusus4'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('M')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('N' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('N' . $row, $dataExcel['ket_tunj_khusus5'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('N')->setAutoSize(true);


					$objPHPExcel->getActiveSheet(0)->getStyle('O' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('O' . $row, $dataExcel['tunj_khusus5'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('O')->setAutoSize(true);

					$row++;
					$no++;
				}
				header('Content-Type: application/vnd.ms-excel; charset=utf-8');
				header('Content-Disposition: attachment; filename=template_pendapatanlain_karyawan.xls');
				header('Cache-Control: max-age=0');
				ob_end_clean();
				ob_start();
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$objWriter->save('php://output');
			}
		}
	}
}
