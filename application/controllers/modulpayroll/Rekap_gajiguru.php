<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekap_gajiguru extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('payroll/model_rekapgguru');
		$this->load->model('payroll/model_rekapgkar');
	}

	function render_view($data)
	{
		$this->template->load('templatepayroll', $data); //Display Page
	}

	public function index()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			
			$my_sekolah = $this->model_rekapgkar->view_sekolah()->result_array();
			$data = array(
				'page_content' 	=> '../pagepayroll/rekap_gajiguru/view',
				'ribbon' 		=> '<li class="active">Rekap Gaji Guru</li><li>Rekap Gaji Guru</li>',
				'page_name' 	=> 'Rekap Gaji Guru',
				'js' 			=> 'js_file',
				'my_sekolah'	=> $my_sekolah
			);
			$this->render_view($data); //Memanggil function render_view
		} else {
			$this->load->view('pagepayroll/login'); //Memanggil function render_view
		}
	}

	public function laporan()
	{
		$bulan_awal = $this->input->post('blnawal');
		$bulan_akhir = $this->input->post('blnakhir');
		$tahun = $this->input->post('tahun');
		$unit = $this->input->post('unit');
		$my_data = $this->model_rekapgguru->view_rekapguru($tahun, $bulan_awal, $bulan_akhir, $unit)->result_array();
		set_include_path(APPPATH . 'third_party/PHPExcel/Classes/');
		include 'PHPExcel/IOFactory.php';
		$objPHPExcel = new PHPExcel();
		$no = 1;
		$row = 2;
		
		// $key = array_keys($data[0]);
		
		//******************************************************************************************************//
									//-------------------Header Page---------------------//
		//***************************************************************************************************** //
		$this->load->library('mainfunction');
		$bln_awal = $this->mainfunction->periode_bulan($this->input->post('blnawal'));
		$bln_akhir = $this->mainfunction->periode_bulan($this->input->post('blnakhir'));
		$tahun = $this->input->post('tahun');

		$desc_sekolah = '';
		$desc_alamat = '';
		$my_sekolah = $this->model_rekapgkar->view_sekolah_one($this->input->post('unit'))->row();
		if(!empty($my_sekolah)){
			$desc_sekolah = $my_sekolah->deskripsi;
			$desc_alamat = $my_sekolah->address;
		}
		// print $desc_sekolah;exit;

		$this->load->model('model_biodata');
		$my_data = $this->model_biodata->viewOrdering('sys_config', 'id', 'asc')->row();

		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'GAJI PEGAWAI '.strtoupper($my_data->name_school));
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C2', 'Periode ');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D2', $bln_awal.' - '.$bln_akhir.' '.$tahun);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', 'Unit ');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D3', $desc_sekolah);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', 'Alamat ');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D4', $desc_alamat);
		//*****************************************************************************************************//
										//-------------------Header Page---------------------//
		//*****************************************************************************************************//

		//*******************************************************************************************************//
									//------------------Header Content-------------------//
		//*******************************************************************************************************//


		//***************************************************//
		//------------------Style Header---------------------//
		$baris = 7;
		//**************************************************/

		$var_d = 'B'.$baris;
		$var_e = 'NO';
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Nama
		$var_d = 'C'.$baris;
		$var_e = "NAMA";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//NIK
		$var_d = 'D'.$baris;
		$var_e = "NIK";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//No rekening
		$var_d = 'E'.$baris;
		$var_e = "No Rekening";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Honor
		$var_d = 'F'.$baris;
		$var_e = "HONOR";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Tunjangan Jabatan
		$var_d = 'G'.$baris;
		$var_e = "T. JABATAN";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Tunjangan Khusus
		$var_d = 'H'.$baris;
		$var_e = "T. TRANSPORT";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Transport
		$var_d = 'I'.$baris;
		$var_e = "T. TETAP";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Jumlah Gaji
		$var_d = 'J'.$baris;
		$var_e = "INVAL";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//BPJS
		$var_d = 'K'.$baris;
		$var_e = "T. BPJS";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//BPJS
		$var_d = 'L'.$baris;
		$var_e = "Honor Berkala";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Jumlah Gaji
		$var_d = 'M'.$baris;
		$var_e = "T. INTERNASIONAL";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Jumlah Gaji
		$var_d = 'N'.$baris;
		$var_e = "T. MASA KERJA";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Piket Malam
		$var_d = 'O'.$baris;
		$var_e = "T. KELUARGA";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Jumlah Gaji
		$var_d = 'P'.$baris;
		$var_e = "THR";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Transport
		$var_d = 'Q'.$baris;
		$var_e = "T. PENILAIAN KINERJA";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Jumlah Gaji
		$var_d = 'R'.$baris;
		$var_e = "T. AKSEL";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Jabatan
		$var_d = 'S'.$baris;
		$var_e = "T. LAIN";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Pajak
		$var_d = 'T'.$baris;
		$var_e = "T. KHUSUS 1";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Sansos
		$var_d = 'U'.$baris;
		$var_e = "T. KHUSUS 2";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Sansos
		$var_d = 'V'.$baris;
		$var_e = "TAMBAHAN";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Struktural / Khusus
		$var_d = 'W'.$baris;
		$var_e = "INFAQ";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Transport
		$var_d = 'X'.$baris;
		$var_e = "ANGGOTA KOPERASI";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Tetap
		$var_d = 'Y'.$baris;
		$var_e = "KAS BON";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Peralihan
		$var_d = 'Z'.$baris;
		$var_e = "IZIN / TELAT";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Utility
		$var_d = 'AA'.$baris;
		$var_e = "GEMART";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Jumlah Asuransi
		$var_d = 'AB'.$baris;
		$var_e = "BMT";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Lain - lain
		$var_d = 'AC'.$baris;
		$var_e = "POT. INVAL";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Jumlah Tunjangan
		$var_d = 'AD'.$baris;
		$var_e = "TOKO";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Honorarium & IMB Sejenis
		$var_d = 'AE'.$baris;
		$var_e = "TAAWUN";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Jamsostek
		$var_d = 'AF'.$baris;
		$var_e = "POT. BPJS";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Asuransi Lainnya
		$var_d = 'AG'.$baris;
		$var_e = "LTQ";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Natura yg Objek PPh 21
		$var_d = 'AH'.$baris;
		$var_e = "PPH21";
		$objek_naturapph21 = $var_e;
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Bonus/Tantiem
		$var_d = 'AI'.$baris;
		$var_e = "POT LAIN";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Bonus/Tantiem
		$var_d = 'AJ'.$baris;
		$var_e = "POT KHUSUS";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		$var_d = 'AK'.$baris;
		$var_e = "GAJI KOTOR";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		$var_d = 'AL'.$baris;
		$var_e = "GAJI BERSIH";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//-----------End Header Content Header PPh 21 Sebulan-------------//
		

		//-----------Add Variable ----------------//
		$jml_pend_gaji_pokok = 0;
		$jml_pend_tunjabatan = 0;
		$jml_pend_transportasi = 0;
		$jml_pend_pegawai_tetap = 0;
		$jml_pend_inval = 0;
		$jml_tunj_bpjs = 0;
		$jml_pend_honor_berkala = 0;
		$jml_pend_internasional = 0;
		$jml_pend_masa_kerja = 0;
		$jml_pend_keluarga = 0;
		$jml_pend_thr = 0;
		$jml_pend_penilaian_kinerja = 0;
		$jml_pend_aksel = 0;
		$jml_pend_lain = 0;
		$jml_pend_khusus1 = 0;
		$jml_pend_khusus2 = 0;
		$jml_pend_tambahan = 0;
		$jml_gaji_kotor = 0;


		$jml_pot_infaq_masjid = 0;
		$jml_pot_anggota_koperasi = 0;
		$jml_pot_kas_bon = 0;
		$jml_pot_ijin_telat = 0;
		$jml_pot_koperasi = 0;
		$jml_pot_bmt = 0;
		$jml_pot_inval = 0;
		$jml_pot_toko = 0;
		$jml_pot_tawun = 0;
		$jml_pot_bpjs = 0;
		$jml_pot_ltq = 0;
		$jml_pot_pph21 = 0;
		$jml_pot_lain = 0;
		$jml_pot_khusus= 0;
		$jml_jumlah_pot = 0;

		//=======================================================//
		//---------------------- Body ---------------------------//
		//=======================================================//
		$bulan_awal = $this->input->post('blnawal');
		$bulan_akhir = $this->input->post('blnakhir');
		$tahun = $this->input->post('tahun');
		$unit = $this->input->post('unit');
		$my_data = $this->model_rekapgguru->view_rekapguru($tahun, $bulan_awal, $bulan_akhir, $unit)->result_array();
		
		$no = 1;
		$baris = 8;
		foreach($my_data as $row){
			
			$var_d = 'B'.$baris;
			$var_e = $no;
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//No Register
			$var_d = 'C'.$baris;
			$var_e = $row['nama'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Nama Pegawai
			$var_d = 'D'.$baris;
			$var_e = $row['employee_number'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//NPWP
			$var_d = 'E'.$baris;
			$var_e = "'".$row['no_rekening'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Jabatan
			$var_d = 'F'.$baris;
			$var_e = $row['gaji'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Status
			$var_d = 'G'.$baris;
			$var_e = $row['tunj_jabatan'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Mulai kerja
			$var_d = 'H'.$baris;
			$var_e = $row['tunj_transport'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Mulai kerja
			$var_d = 'I'.$baris;
			$var_e = $row['tunj_tetap'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Mulai kerja
			$var_d = 'J'.$baris;
			$var_e = $row['inval'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);
			//Gaji
			$var_d = 'K'.$baris;
			$var_e = $row['tunj_bpjs'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);
			//Gaji
			$var_d = 'L'.$baris;
			$var_e = $row['honor_berkala'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Rapel
			$var_d = 'M'.$baris;
			$var_e = $row['tunj_international'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Rapel
			$var_d = 'N'.$baris;
			$var_e = $row['convert'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Premi
			$var_d = 'O'.$baris;
			$var_e = $row['tunj_keluarga'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Rapel
			$var_d = 'P'.$baris;
			$var_e = $row['thr'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Rapel
			$var_d = 'Q'.$baris;
			$var_e = $row['tunj_penilaian_kinerja'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Rapel
			$var_d = 'R'.$baris;
			$var_e = $row['tunj_aksel'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Sansos
			$var_d = 'S'.$baris;
			$var_e = $row['tunj_lain'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Jumlah Gaji
			$var_d = 'T'.$baris;
			$var_e = $row['tunj_khusus1'];
			$jumlah_gaji = $var_e;
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Pajak
			$var_d = 'U'.$baris;
			$var_e = $row['tunj_khusus2'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Tambahan
			$tambahan = ($row['attribute_1']*$row['attribute_2'])+($row['attribute_3']*$row['attribute_4'])+($row['attribute_5']*$row['attribute_6'])+($row['attribute_7']*$row['attribute_8']);
			$var_d = 'V'.$baris;
			$var_e = $tambahan;
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Jabatan
			$var_d = 'W'.$baris;
			$var_e = $row['pot_infaq_masjid'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Struktural / Khusus
			$var_d = 'X'.$baris; 
			$var_e = $row['pot_anggota_koperasi'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Transport
			$var_d = 'Y'.$baris;
			$var_e = $row['pot_kas_bon'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Tetap
			$var_d = 'Z'.$baris;
			$var_e = $row['pot_ijin_telat'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Peralihan
			$var_d = 'AA'.$baris;
			$var_e = $row['pot_koperasi'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Honorarium & IMB Sejenis
			$var_d = 'AB'.$baris;
			$var_e = $row['pot_bmt'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Utility
			$var_d = 'AC'.$baris;
			$var_e = $row['pot_inval'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Peralihan
			$var_d = 'AD'.$baris;
			$var_e = $row['pot_toko'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Utility
			$var_d = 'AE'.$baris;
			$var_e = $row['pot_tawun'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Lain - lain
			$var_d = 'AF'.$baris;
			$var_e = $row['pot_bpjs'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Jumlah Tunjangan
			$var_d = 'AG'.$baris;
			$var_e = $row['pot_ltq'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Jamsostek
			$var_d = 'AH'.$baris;
			$var_e = $row['pph21_bulanan'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Jumlah Asuransi
			$var_d = 'AI'.$baris;
			$var_e = $row['pot_lain'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Jumlah Asuransi
			$var_d = 'AJ'.$baris;
			$var_e = $row['pot_khusus'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);


			//Cuti / Jubelium
			$var_d = 'AK'.$baris;
			$pend_gaji_pokok = $row['gaji'];
			$pend_tunjabatan = $row['tunj_jabatan'];
			$pend_transportasi = $row['tunj_transport'];
			$pend_pegawai_tetap = $row['tunj_tetap'];
			$pend_inval = $row['inval'];
			$pend_bpjs = $row['tunj_bpjs'];
			$pend_honor_berkala = $row['honor_berkala'];
			$pend_internasional = $row['tunj_international'];
			$pend_masa_kerja = $row['convert'];
			$pend_keluarga = $row['tunj_keluarga'];
			$pend_thr = $row['thr'];
			$pend_penilaian_kinerja = $row['tunj_penilaian_kinerja'];
			$pend_aksel = $row['tunj_aksel'];
			$pend_lain = $row['tunj_lain'];
			$pend_khusus1 = $row['tunj_khusus1'];
			$pend_khusus2 = $row['tunj_khusus2'];
			$pend_tambahan = $tambahan;
			$gaji_kotor = 0;
			$gaji_kotor = $pend_gaji_pokok+$pend_tunjabatan+$pend_transportasi+$pend_pegawai_tetap+$pend_inval+$pend_bpjs+$pend_honor_berkala+$pend_thr+$pend_internasional+$pend_masa_kerja+$pend_keluarga+$pend_thr+$pend_penilaian_kinerja+$pend_aksel+$pend_lain+$pend_khusus1+$pend_khusus2+$pend_tambahan;
			
			$var_e = $gaji_kotor;
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Jml Penghasilan Tidak teratur
			$var_d = 'AL'.$baris;
			$pot_infaq_masjid = $row['pot_infaq_masjid'];
			$pot_anggota_koperasi = $row['pot_anggota_koperasi'];
			$pot_kas_bon = $row['pot_kas_bon'];
			$pot_ijin_telat = $row['pot_ijin_telat'];
			$pot_koperasi = $row['pot_koperasi'];
			$pot_inval = $row['pot_inval'];
			$pot_toko = $row['pot_toko'];
			$pot_taawun = $row['pot_tawun'];
			$pot_bpjs = $row['pot_bpjs'];
			$pot_ltq = $row['pot_ltq'];
			$pot_bmt = $row['pot_bmt'];
			$pot_pph21 = $row['pph21_bulanan'];
			$pot_lain = $row['pot_lain'];
			$pot_khusus = $row['pot_khusus'];
			$jumlah_pot = $pot_infaq_masjid+$pot_anggota_koperasi+$pot_kas_bon+$pot_ijin_telat+$pot_koperasi+$pot_inval+$pot_toko+$pot_taawun+$pot_bpjs+$pot_ltq+$pot_bmt+$pot_pph21+$pot_lain+$pot_khusus;
			$var_e = $gaji_kotor-$jumlah_pot;
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			$jml_pend_gaji_pokok = $jml_pend_gaji_pokok+$pend_gaji_pokok;
			$jml_pend_tunjabatan = $jml_pend_tunjabatan+$pend_tunjabatan;
			$jml_pend_transportasi = $jml_pend_transportasi+$pend_transportasi;
			$jml_pend_pegawai_tetap = $jml_pend_pegawai_tetap+$pend_pegawai_tetap;
			$jml_pend_inval = $jml_pend_inval+$pend_inval;
			$jml_tunj_bpjs = $jml_tunj_bpjs+$pend_bpjs;
			$jml_pend_honor_berkala = $jml_pend_honor_berkala+$pend_honor_berkala;
			$jml_pend_internasional = $jml_pend_internasional+$pend_internasional;
			$jml_pend_masa_kerja = $jml_pend_masa_kerja+$pend_masa_kerja;
			$jml_pend_keluarga = $jml_pend_keluarga+$pend_keluarga;
			$jml_pend_thr = $jml_pend_thr+$pend_thr;
			$jml_pend_penilaian_kinerja = $jml_pend_penilaian_kinerja+$pend_penilaian_kinerja;
			$jml_pend_aksel = $jml_pend_aksel+$pend_aksel;
			$jml_pend_lain = $jml_pend_lain+$pend_lain;
			$jml_pend_khusus1 = $jml_pend_khusus1+$pend_khusus1;
			$jml_pend_khusus2 = $jml_pend_khusus2+$pend_khusus2;
			$jml_gaji_kotor = $jml_gaji_kotor+$gaji_kotor;


			$jml_pot_infaq_masjid = $jml_pot_infaq_masjid+$pot_infaq_masjid;
			$jml_pot_anggota_koperasi = $jml_pot_anggota_koperasi+$pot_anggota_koperasi;
			$jml_pot_kas_bon = $jml_pot_kas_bon+$pot_kas_bon;
			$jml_pot_ijin_telat = $jml_pot_ijin_telat+$pot_ijin_telat;
			$jml_pot_koperasi = $jml_pot_koperasi+$pot_koperasi;
			$jml_pot_bmt = $jml_pot_bmt+$pot_bmt;
			$jml_pot_inval = $jml_pot_inval+$pot_inval;
			$jml_pot_toko = $jml_pot_toko+$pot_toko;
			$jml_pot_tawun = $jml_pot_tawun+$pot_taawun;
			$jml_pot_bpjs = $jml_pot_bpjs+$pot_bpjs;
			$jml_pot_ltq = $jml_pot_ltq+$pot_ltq;
			$jml_pot_pph21 = $jml_pot_pph21+$pot_pph21;
			$jml_pot_lain = $jml_pot_lain+$pot_lain;
			$jml_pot_khusus = $jml_pot_khusus+$pot_khusus;
			$jml_jumlah_pot = $jml_jumlah_pot+$jumlah_pot;

			$baris++;
			$no++;
		}
		
		//-------------------- Jumlah -------------------------//
		$no = 'Jumlah';
		$urutan = $baris;
		$baris = $urutan;

		//No
		$var_d = 'B'.$baris;
		$var_e = $no;
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//No Register
		$var_d = 'C'.$baris;
		$var_e = '';
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Nama Pegawai
		$var_d = 'D'.$baris;
		$var_e = '';
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//NPWP
		$var_d = 'E'.$baris;
		$var_e = '';
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Jabatan
		$var_d = 'F'.$baris;
		$var_e = $jml_pend_gaji_pokok;
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Status
		$var_d = 'G'.$baris;
		$var_e = $jml_pend_tunjabatan;
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Mulai kerja
		$var_d = 'H'.$baris;
		$var_e = $jml_pend_transportasi;
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Mulai kerja
		$var_d = 'I'.$baris;
		$var_e = $jml_pend_pegawai_tetap;
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		$var_d = 'J'.$baris;
		$var_e = $jml_pend_inval;
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Gaji
		$var_d = 'K'.$baris;
		$var_e = $jml_tunj_bpjs;
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Gaji
		$var_d = 'L'.$baris;
		$var_e = $jml_pend_honor_berkala;
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Rapel
		$var_d = 'M'.$baris;
		$var_e = $jml_pend_internasional;
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Rapel
		$var_d = 'N'.$baris;
		$var_e = $jml_pend_masa_kerja;
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Premi
		$var_d = 'O'.$baris;
		$var_e = $jml_pend_keluarga;
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Rapel
		$var_d = 'P'.$baris;
		$var_e = $jml_pend_thr;
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Rapel
		$var_d = 'Q'.$baris;
		$var_e = $jml_pend_penilaian_kinerja;
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Rapel
		$var_d = 'R'.$baris;
		$var_e = $jml_pend_aksel;
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Sansos
		$var_d = 'S'.$baris;
		$var_e = $jml_pend_lain;
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Jumlah Gaji
		$var_d = 'T'.$baris;
		$var_e = $jml_pend_khusus1;
		$jumlah_gaji = $var_e;
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Pajak
		$var_d = 'U'.$baris;
		$var_e = $jml_pend_khusus2;
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Sansos
		$var_d = 'V'.$baris;
		$var_e = $jml_pend_tambahan;
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Jabatan
		$var_d = 'W'.$baris;
		$var_e = $jml_pot_infaq_masjid;
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Struktural / Khusus
		$var_d = 'X'.$baris;
		$var_e = $jml_pot_anggota_koperasi;
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Transport
		$var_d = 'Y'.$baris;
		$var_e = $jml_pot_kas_bon;
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Tetap
		$var_d = 'Z'.$baris;
		$var_e = $jml_pot_ijin_telat;
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Peralihan
		$var_d = 'AA'.$baris;
		$var_e = $jml_pot_koperasi;
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Honorarium & IMB Sejenis
		$var_d = 'AB'.$baris;
		$var_e = $jml_pot_bmt;
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Utility
		$var_d = 'AC'.$baris;
		$var_e = $jml_pot_inval;
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Peralihan
		$var_d = 'AD'.$baris;
		$var_e = $jml_pot_toko;
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Utility
		$var_d = 'AE'.$baris;
		$var_e = $jml_pot_tawun;
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Lain - lain
		$var_d = 'AF'.$baris;
		$var_e = $jml_pot_bpjs;
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Jumlah Tunjangan
		$var_d = 'AG'.$baris;
		$var_e = $jml_pot_ltq;
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Jamsostek
		$var_d = 'AH'.$baris;
		$var_e = $jml_pot_pph21;
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		$var_d = 'AI'.$baris;
		$var_e = $jml_pot_lain;
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		$var_d = 'AJ'.$baris;
		$var_e = $jml_pot_khusus;
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Cuti / Jubelium
		$var_d = 'AK'.$baris;
		$var_e = $jml_gaji_kotor;
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Jml Penghasilan Tidak teratur
		$var_d = 'AL'.$baris;
		$var_e = $jml_gaji_kotor-$jml_jumlah_pot;
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);
		
		//======================================================//
		//-------------------- End Body ------------------------//
		//======================================================//
		date_default_timezone_set("Asia/Bangkok");
		header('Content-Type: application/vnd.ms-excel; charset=utf-8');
		header('Content-Disposition: attachment; filename=Laporan rekap gaji guru '.date("dmY-his").'.xls');
		header('Cache-Control: max-age=0');
		ob_end_clean();
		ob_start();
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$filename = 'Sample' . 'csv';
		$objWriter->save('php://output');
	}

}
