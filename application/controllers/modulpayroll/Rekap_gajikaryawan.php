<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekap_gajikaryawan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {

		} else {
			$this->load->view('pagepayroll/login'); //Memanggil function render_view
		}
	}

	function render_view($data)
	{
		$this->template->load('templatepayroll', $data); //Display Page
	}

	public function index()
	{
		$data = array(
			'page_content' 	=> '../pagepayroll/rekap_gajikaryawan/view',
			'ribbon' 		=> '<li class="active">Rekap Gaji Karyawan</li><li>Rekap Gaji Karyawan</li>',
			'page_name' 	=> 'Rekap Gaji Karyawan',
			'js' 			=> 'js_file'
		);
		$this->render_view($data); //Memanggil function render_view
	}

	public function laporan()
	{
		set_include_path(APPPATH . 'third_party/PHPExcel/Classes/');
		include 'PHPExcel/IOFactory.php';
		$objPHPExcel = new PHPExcel();
		$idtarif = $this->model_imppembayaran->getidtarif()->result_array();
		$data = $idtarif;
		$no = 1;
		$row = 2;
		if (count($data) > 0) {
			if ($data) {
				$key = array_keys($data[0]);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'NIS');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'NOREG');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'NAMA');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'KELAS');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', 'TANGGAL TERIMA');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', 'KODE SEKOLAH');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', 'TAHUN PENDIDIKAN');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1', 'KODE PEMBAYARAN');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1', 'ID TARIF');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J1', 'NOMINAL');

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', '2019011012');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B2', '2019011012');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C2', 'IMAM SATRIANTA');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D2', '5');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E2', '2019-1-20 (YYYY-MM-DD)');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F2', '18');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G2', '2019/2020');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H2', 'SPP');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I2', '32');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J2', '735000');

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', '2019011013');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B3', '2019011013');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', 'KRESNO');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D3', '5');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E3', '2019-1-20 (YYYY-MM-DD)');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F3', '18');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G3', '2019/2020');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H3', 'SPP');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I3', '32');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J3', '735000');

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A4', '2019011014');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B4', '2019011014');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', 'GUGI');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D4', '5');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E4', '2019-1-20 (YYYY-MM-DD)');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F4', '18');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G4', '2019/2020');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H4', 'SPP');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I4', '32');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J4', '735000');

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O1', 'ID TARIF');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P1', 'KODE PEMBAYARAN');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q1', 'NAMA JENIS BAYAR');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('R1', 'SEKOLAH');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('S1', 'JURUSAN');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('T1', 'TAHUN MASUK');
				// foreach ($data as $dataExcel) {
				// 	$idtarif = $dataExcel['idtarif'];
				// 	$ThnMasuk = $dataExcel['ThnMasuk'];
				// 	$kodejnsbayar = $dataExcel['kodejnsbayar'];
				// 	$DESCRTBPS = $dataExcel['DESCRTBPS'];
				// 	$DESCRTBJS = $dataExcel['DESCRTBJS'];
				// 	$namajenisbayar = $dataExcel['namajenisbayar'];




				// 	$objPHPExcel->getActiveSheet(0)->getStyle('O' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
				// 	$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('O' . $row, $idtarif, PHPExcel_Cell_DataType::TYPE_STRING);
				// 	$objPHPExcel->getActiveSheet(0)->getColumnDimension('O')->setAutoSize(true);

				// 	$objPHPExcel->getActiveSheet(0)->getStyle('P' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
				// 	$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('P' . $row, $kodejnsbayar, PHPExcel_Cell_DataType::TYPE_STRING);
				// 	$objPHPExcel->getActiveSheet(0)->getColumnDimension('P')->setAutoSize(true);

				// 	$objPHPExcel->getActiveSheet(0)->getStyle('Q' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
				// 	$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('Q' . $row, $namajenisbayar, PHPExcel_Cell_DataType::TYPE_STRING);
				// 	$objPHPExcel->getActiveSheet(0)->getColumnDimension('Q')->setAutoSize(true);

				// 	$objPHPExcel->getActiveSheet(0)->getStyle('R' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
				// 	$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('R' . $row, $DESCRTBPS, PHPExcel_Cell_DataType::TYPE_STRING);
				// 	$objPHPExcel->getActiveSheet(0)->getColumnDimension('R')->setAutoSize(true);

				// 	$objPHPExcel->getActiveSheet(0)->getStyle('S' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
				// 	$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('S' . $row, $DESCRTBJS, PHPExcel_Cell_DataType::TYPE_STRING);
				// 	$objPHPExcel->getActiveSheet(0)->getColumnDimension('S')->setAutoSize(true);

				// 	$objPHPExcel->getActiveSheet(0)->getStyle('T' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
				// 	$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('T' . $row, $ThnMasuk, PHPExcel_Cell_DataType::TYPE_STRING);
				// 	$objPHPExcel->getActiveSheet(0)->getColumnDimension('T')->setAutoSize(true);
				// 	$row++;
				// 	$no++;
				// }
				header('Content-Type: application/vnd.ms-excel; charset=utf-8');
				header('Content-Disposition: attachment; filename=report.xls');
				header('Cache-Control: max-age=0');
				ob_end_clean();
				ob_start();
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$filename = 'Sample' . 'csv';
				$objWriter->save('php://output');
			}
		}
	}

}
