<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kehadiran_karyawan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('payroll/model_kehadirankaryawan');
	}

	function render_view($data)
	{
		$this->template->load('templatepayroll', $data); //Display Page
	}

	public function index()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$my_karyawan = $this->model_kehadirankaryawan->view('biodata_karyawan')->result_array();
			$data = array(
				'page_content' 	=> '../pagepayroll/kehadiran_karyawan/view',
				'ribbon' 		=> '<li class="active">Laporan Kehadiran Karyawan</li>',
				'page_name' 	=> 'Kehadiran Karyawan',
				'js' 			=> 'js_file',
				'my_karyawan'	=> $my_karyawan
			);
			$this->render_view($data); //Memanggil function render_view
		} else {
			$this->load->view('pagepayroll/login'); //Memanggil function render_view
		}
	}

	public function laporan()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$type = $this->input->post('type');
			if ($type == 'xls') {
				set_include_path(APPPATH . 'third_party/PHPExcel/Classes/');
				include 'PHPExcel/IOFactory.php';
				$objPHPExcel = new PHPExcel();
				$tahun = $this->input->post('tahun');
				$blnawal = $this->input->post('blnawal');
				$blnakhir = $this->input->post('blnakhir');
				$karyawan = $this->input->post('karyawan');
				$data = $this->model_kehadirankaryawan->view_kehadirankaryawan($tahun, $blnawal, $blnakhir, $karyawan)->result_array();
				$no = 1;
				$row = 2;
				if (count($data) > 0) {
					if ($data) {
						$key = array_keys($data[0]);
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'No');
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'NIP');
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'Nama');
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'Tanggal');
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', 'Hari');
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', 'Jam Masuk');
						$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', 'Jam Keluar');

						foreach ($data as $dataExcel) {
							$nip = $dataExcel['id_karyawan'];
							$nama = $dataExcel['nama'];
							$tanggal = $dataExcel['tanggal'];
							$hari = $dataExcel['hari'];
							$jam_masuk = $dataExcel['jam_masuk'];
							$jam_keluar = $dataExcel['jam_keluar'];


							$objPHPExcel->getActiveSheet(0)->getStyle('A' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
							$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('A' . $row, $no, PHPExcel_Cell_DataType::TYPE_STRING);
							$objPHPExcel->getActiveSheet(0)->getColumnDimension('A')->setAutoSize(true);

							$objPHPExcel->getActiveSheet(0)->getStyle('B' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
							$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('B' . $row, $nip, PHPExcel_Cell_DataType::TYPE_STRING);
							$objPHPExcel->getActiveSheet(0)->getColumnDimension('B')->setAutoSize(true);

							$objPHPExcel->getActiveSheet(0)->getStyle('C' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
							$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('C' . $row, $nama, PHPExcel_Cell_DataType::TYPE_STRING);
							$objPHPExcel->getActiveSheet(0)->getColumnDimension('C')->setAutoSize(true);

							$objPHPExcel->getActiveSheet(0)->getStyle('D' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
							$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('D' . $row, $tanggal, PHPExcel_Cell_DataType::TYPE_STRING);
							$objPHPExcel->getActiveSheet(0)->getColumnDimension('D')->setAutoSize(true);

							$objPHPExcel->getActiveSheet(0)->getStyle('E' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
							$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('E' . $row, $hari, PHPExcel_Cell_DataType::TYPE_STRING);
							$objPHPExcel->getActiveSheet(0)->getColumnDimension('E')->setAutoSize(true);

							$objPHPExcel->getActiveSheet(0)->getStyle('F' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
							$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('F' . $row, $jam_masuk, PHPExcel_Cell_DataType::TYPE_STRING);
							$objPHPExcel->getActiveSheet(0)->getColumnDimension('F')->setAutoSize(true);

							$objPHPExcel->getActiveSheet(0)->getStyle('G' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
							$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('G' . $row, $jam_keluar, PHPExcel_Cell_DataType::TYPE_STRING);
							$objPHPExcel->getActiveSheet(0)->getColumnDimension('G')->setAutoSize(true);
							$row++;
							$no++;
						}

						header('Content-Type: application/vnd.ms-excel; charset=utf-8');
						header('Content-Disposition: attachment; filename=report.xls');
						header('Cache-Control: max-age=0');
						ob_end_clean();
						ob_start();
						$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
						$filename = 'LaporanPotongan' . 'csv';
						$objWriter->save('php://output');
					}
				} else {
					echo json_encode('Tidak Ada data Yang di generate');
				}
			} else {
				//type pdf
			}
		} else {
			$this->load->view('pagepayroll/login'); //Memanggil function render_view
		}
	}
}
