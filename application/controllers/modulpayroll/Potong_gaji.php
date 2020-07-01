<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Potong_gaji extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('payroll/model_potongan');
	}

	function render_view($data)
	{
		$this->template->load('templatepayroll', $data); //Display Page
	}

	public function index()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {

			$data = array(
				'page_content' 	=> '../pagepayroll/potong_gaji/view',
				'ribbon' 		=> '<li class="active">Laporan Potong Gaji</li>',
				'page_name' 	=> 'Laporan Potong Gaji',
				'js' 			=> 'js_file'
			);
			$this->render_view($data); //Memanggil function render_view
		} else {
			$this->load->view('pagepayroll/login'); //Memanggil function render_view
		}
	}

	public function laporan()
	{
		set_include_path(APPPATH . 'third_party/PHPExcel/Classes/');
		include 'PHPExcel/IOFactory.php';
		$objPHPExcel = new PHPExcel();
		$tahun = $this->input->post('tahun');
		$blnawal = $this->input->post('blnawal');
		$blnakhir = $this->input->post('blnakhir');
		$data = $this->model_potongan->view_potongankaryawan($tahun, $blnawal, $blnakhir)->result_array();
		$no = 1;
		$row = 2;
		if (count($data) > 0) {
			if ($data) {
				$key = array_keys($data[0]);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'NIP');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'NIP');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'Nama');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'Anggota Koperasi');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', 'Kas Bon');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', 'Ijin Telat');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', 'BMT');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1', 'Koperasi');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1', 'Inval');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J1', 'Toko');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K1', 'Lain - Lain');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L1', 'PPH 21');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M1', 'InfaQ Masjid');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N1', 'Periode');

				foreach ($data as $dataExcel) {
					$nip = $dataExcel['id_karyawan'];
					$nama = $dataExcel['nama'];
					$agtkoperasi = $dataExcel['anggota_koperasi'];
					$kas_bon = $dataExcel['kas_bon'];
					$ijin_telat = $dataExcel['ijin_telat'];
					$koperasi = $dataExcel['koperasi'];
					$bmt = $dataExcel['bmt'];
					$inval = $dataExcel['inval'];
					$toko = $dataExcel['toko'];
					$lain = $dataExcel['lain'];
					$pph21 = $dataExcel['pph21'];
					$periode = $dataExcel['periode'];
					$infaq_masjid = $dataExcel['infaq_masjid'];



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
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('D' . $row, $agtkoperasi, PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('D')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('E' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('E' . $row, $kas_bon, PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('E')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('F' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('F' . $row, $ijin_telat, PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('F')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('G' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('G' . $row, $bmt, PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('G')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('H' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('H' . $row, $koperasi, PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('H')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('I' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('I' . $row, $inval, PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('I')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('J' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('J' . $row, $toko, PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('J')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('K' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('K' . $row, $lain, PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('K')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('L' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('L' . $row, $pph21, PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('L')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('M' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('M' . $row, $infaq_masjid, PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('M')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('N' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('N' . $row, $periode, PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('N')->setAutoSize(true);

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
	}

}
