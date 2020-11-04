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
					if (!empty($empty_message)) {
						$ret['msg'] = $empty_message;
						$this->session->set_flashdata('message', '' . json_encode($ret['msg']));
						$result = 2;
					} else {
						$arrayCustomerQuote = array(
							'IdGuru' => $value[0],
							'lain' => $value[2],
							'tunjangan' => $value[3],
							'thr' => $value[4],
							'inval' => $value[5],
							'ket_tunj_khusus1' => $value[6],
							'tunj_khusus1' => $value[7],
							'ket_tunj_khusus2' => $value[8],
							'tunj_khusus2' => $value[9],
							'jam1' => $value[10],
							'tarif1' => $value[11],
							'jam2' => $value[12],
							'tarif2' => $value[13],
							'jam3' => $value[14],
							'tarif3' => $value[15],
							'jam4' => $value[16],
							'tarif4' => $value[17],
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
			'inval' => $this->input->post('e_inval_v'),
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

	public function downloadsample()
	{
		set_include_path(APPPATH . 'third_party/PHPExcel/Classes/');
		include 'PHPExcel/IOFactory.php';
		$objPHPExcel = new PHPExcel();
		$idtarif = $this->model_pendapatanlain->getformat()->result_array();
		$data = $idtarif;
		$no = 1;
		$row = 2;
		if (count($data) > 0) {
			if ($data) {
				$key = array_keys($data[0]);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'ID Guru');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'Nama Guru');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'Tunjangan Lain');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'Tunjangan Penilaian Kinerja');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', 'THR');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', 'Inval');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', 'Ket Khusus 1');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1', 'Nominal');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1', 'Ket Khusus 2');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J1', 'Nominal');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K1', 'Jam 1');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L1', 'Nominal 1');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M1', 'Jam 2');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N1', 'Nominal 2');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O1', 'Jam 3');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P1', 'Nominal 3');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q1', 'Jam 4');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('R1', 'Nominal 4');


				foreach ($data as $dataExcel) {
					
					$objPHPExcel->getActiveSheet(0)->getStyle('A' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('A' . $row, $dataExcel['IdGuru'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('A')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('B' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('B' . $row, $dataExcel['GuruNama'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('B')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('C' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('C' . $row, $dataExcel['lain'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('C')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('D' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('D' . $row, $dataExcel['tunjangan'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('D')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('E' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('E' . $row, $dataExcel['thr'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('E')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('F' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('F' . $row, $dataExcel['inval'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('F')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('G' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('G' . $row, $dataExcel['ket_tunj_khusus1'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('G')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('H' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('H' . $row, $dataExcel['tunj_khusus1'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('H')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('I' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('I' . $row, $dataExcel['ket_tunj_khusus2'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('I')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('J' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('J' . $row, $dataExcel['tunj_khusus2'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('J')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('K' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('K' . $row, $dataExcel['jam1'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('K')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('L' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('L' . $row, $dataExcel['tarif1'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('L')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('M' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('M' . $row, $dataExcel['jam2'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('M')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('N' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('N' . $row, $dataExcel['tarif2'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('N')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('O' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('O' . $row, $dataExcel['jam3'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('O')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('P' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('P' . $row, $dataExcel['tarif3'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('P')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('Q' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('Q' . $row, $dataExcel['jam4'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('Q')->setAutoSize(true);
					
					$objPHPExcel->getActiveSheet(0)->getStyle('R' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('R' . $row, $dataExcel['tarif4'], PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('R')->setAutoSize(true);

					$row++;
					$no++;
				}
				header('Content-Type: application/vnd.ms-excel; charset=utf-8');
				header('Content-Disposition: attachment; filename=template_pendapatanlain_guru.xls');
				header('Cache-Control: max-age=0');
				ob_end_clean();
				ob_start();
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$objWriter->save('php://output');
			}
		}
	}
}
