<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekap_gajikaryawan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('payroll/model_rekapgkar');
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
		$my_sekolah = $this->model_rekapgkar->view_sekolah()->result_array();
		$data = array(
			'page_content' 	=> '../pagepayroll/rekap_gajikaryawan/view',
			'ribbon' 		=> '<li class="active">Rekap Gaji Karyawan</li><li>Rekap Gaji Karyawan</li>',
			'page_name' 	=> 'Rekap Gaji Karyawan',
			'js' 			=> 'js_file',
			'my_sekolah'	=> $my_sekolah
		);
		$this->render_view($data); //Memanggil function render_view
	}

	public function laporan()
	{
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
		$my_sekolah = $this->model_rekapgkar->view_sekolah_one($this->input->post('unit'))->row();
		if(!empty($my_sekolah)){
			$desc_sekolah = $my_sekolah->deskripsi;
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
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D4', 'Jl. Raya Kaliabang Tengah No.75B, RT.003/RW.006, Kaliabang Tengah, Kec. Bekasi Utara, Kota Bks, Jawa Barat 17125');
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
		$var_e = "T. PAJAK";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Tunjangan Khusus
		$var_d = 'H'.$baris;
		$var_e = "T. JABATAN";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Transport
		$var_d = 'I'.$baris;
		$var_e = "SANSOS";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Tambahan
		$var_d = 'J'.$baris;
		$var_e = "STRUKTURAL/KHUSUS";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//BPJS
		$var_d = 'K'.$baris;
		$var_e = "TRANSPORTASI";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Piket Malam
		$var_d = 'L'.$baris;
		$var_e = "T. TETAP";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Jumlah Gaji
		$var_d = 'M'.$baris;
		$jumlah_gaji = "PERALIHAN";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Pajak
		$var_d = 'N'.$baris;
		$var_e = "UTILITY";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Sansos
		$var_d = 'O'.$baris;
		$var_e = "HONORARIUM";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Jabatan
		$var_d = 'P'.$baris;
		$var_e = "ASURANSI PERUSAHAAN";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Struktural / Khusus
		$var_d = 'Q'.$baris;
		$var_e = "BONUS";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Transport
		$var_d = 'R'.$baris;
		$var_e = "THR";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Tetap
		$var_d = 'S'.$baris;
		$var_e = "CUTI";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Peralihan
		$var_d = 'T'.$baris;
		$var_e = "T. BPJS";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Utility
		$var_d = 'U'.$baris;
		$var_e = "T. KHUSUS";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Lain - lain
		$var_d = 'V'.$baris;
		$var_e = "T. KHUSUS";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Jumlah Tunjangan
		$var_d = 'W'.$baris;
		$jumlah_tunjangan = "LAIN-LAIN";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Honorarium & IMB Sejenis
		$var_d = 'X'.$baris;
		$var_e = "INFAQ";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Jamsostek
		$var_d = 'Y'.$baris;
		$var_e = "POT. KOPERASI";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Asuransi Lainnya
		$var_d = 'Z'.$baris;
		$var_e = "KAS BON";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Jumlah Asuransi
		$var_d = 'AA'.$baris;
		$jumlah_asuransi = "IZIN/TELAT";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Natura yg Objek PPh 21
		$var_d = 'AB'.$baris;
		$var_e = "KOPERASI";
		$objek_naturapph21 = $var_e;
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Jumlah Penghasilan
		$var_d = 'AC'.$baris;
		$jum_pengh_teratur = "BMT";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Bonus/Tantiem
		$var_d = 'AD'.$baris;
		$var_e = "TAAWUN";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//THR
		$var_d = 'AE'.$baris;
		$var_e = "PPH21";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Cuti / Jubelium
		$var_d = 'AF'.$baris;
		$var_e = "POT. BPJS";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Jml Penghasilan Tidak teratur
		$var_d = 'AG'.$baris;
		$jum_pengh_t_teratur = "LTQ";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//Jumlah
		$var_d = 'AH'.$baris;
		$var_e = "LAIN-LAIN";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//By Jabatan / By Pensiun atas angka 27
		$var_d = 'AI'.$baris;
		$var_e = "GAJI KOTOR";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//By Jabatan / By Pensiun atas angka 32
		$var_d = 'AJ'.$baris;
		$var_e = "GAJI BERSIH";
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

		//-----------End Header Content Header PPh 21 Sebulan-------------//

		//=======================================================//
		//---------------------- Body ---------------------------//
		//=======================================================//
		$bulan_awal = $this->input->post('blnawal');
		$bulan_akhir = $this->input->post('blnakhir');
		$tahun = $this->input->post('tahun');
		$my_data = $this->model_rekapgkar->view_rekapkaryawan($tahun, $bulan_awal, $bulan_akhir)->result_array();
		$no = 1;
		$baris = 8;
		foreach($my_data as $row){
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
			$var_e = $row['gaji']+$row['rapel']+$row['premi'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Status
			$var_d = 'G'.$baris;
			$var_e = $row['tunj_pajak'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Mulai kerja
			$var_d = 'H'.$baris;
			$var_e = $row['tunj_jabatan'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Mulai kerja
			$var_d = 'I'.$baris;
			$var_e = $row['tunj_sansos'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Akhir Kerja Bulan Ke
			$var_d = 'J'.$baris;
			$var_e = $row['tunj_struktural_khusus'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Gaji
			$var_d = 'K'.$baris;
			$var_e = $row['tunj_transport'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Rapel
			$var_d = 'L'.$baris;
			$var_e = $row['tunj_tetap'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Premi
			$var_d = 'M'.$baris;
			$var_e = $row['tunj_peralihan'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Jumlah Gaji
			$var_d = 'N'.$baris;
			$var_e = $row['tunj_utility'];
			$jumlah_gaji = $var_e;
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Pajak
			$var_d = 'O'.$baris;
			$var_e = $row['honorarium_imb'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Sansos
			$var_d = 'P'.$baris;
			$var_e = $row['asuransi_jamsostek']+$row['asuransi_lainnya'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Jabatan
			$var_d = 'Q'.$baris;
			$var_e = $row['bonus'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Struktural / Khusus
			$var_d = 'R'.$baris;
			$var_e = $row['thr'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Transport
			$var_d = 'S'.$baris;
			$var_e = $row['cuti_jubelium'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Tetap
			$var_d = 'T'.$baris;
			$var_e = $row['tunj_bpjs'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Peralihan
			$var_d = 'U'.$baris;
			$var_e = "Khusus";
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Utility
			$var_d = 'V'.$baris;
			$var_e = "khusus2";
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Peralihan
			$var_d = 'W'.$baris;
			$var_e = $row['tunj_lain'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Utility
			$var_d = 'X'.$baris;
			$var_e = $row['pot_infaq_masjid'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Lain - lain
			$var_d = 'Y'.$baris;
			$var_e = $row['pot_anggota_koperasi'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Jumlah Tunjangan
			$var_d = 'Z'.$baris;
			$jumlah_tunjangan = $row['pot_kas_bon'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Honorarium & IMB Sejenis
			$var_d = 'AA'.$baris;
			$var_e = $row['pot_ijin_telat'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Jamsostek
			$var_d = 'AB'.$baris;
			$var_e = $row['pot_koperasi'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Asuransi Lainnya
			$var_d = 'AC'.$baris;
			$var_e = $row['pot_bmt'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Jumlah Asuransi
			$var_d = 'AD'.$baris;
			$jumlah_asuransi = $row['pot_tawun'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Natura yg Objek PPh 21
			$var_d = 'AE'.$baris;
			$var_e = $row['pph21_bulanan'];
			$objek_naturapph21 = $var_e;
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Jumlah Penghasilan
			$var_d = 'AF'.$baris;
			$jum_pengh_teratur = $row['pot_bpjs'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Bonus/Tantiem
			$var_d = 'AG'.$baris;
			$var_e = $row['pot_ltq'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//THR
			$var_d = 'AH'.$baris;
			$var_e = $row['pot_lain'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Cuti / Jubelium
			$var_d = 'AI'.$baris;
			$gaji_kotor = $pend_gaji_pokok+$pend_pajak+$pend_tunjabatan+$pend_tunjsansos+$pend_strukturalkhusus+$pend_transportasi+$pend_pegawai_tetap+$pend_peralihan+$pend_utility+$pend_honorarium+$pend_asuransi+$pend_bonus+$pend_thr+$pend_cuti+$tunj_bpjs+$pend_lain;
			$var_e = $gaji_kotor;
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Jml Penghasilan Tidak teratur
			$var_d = 'AJ'.$baris;
			$potongan = $pot_infaq_masjid+$pot_anggota_koperasi+$pot_kas_bon+$pot_ijin_telat+$pot_koperasi+$pot_bmt+$pot_tawun+$pot_pph21+$pot_bpjs+$pot_ltq+$pot_lain;
			$var_e = $gaji_kotor-$potongan;
			$jum_pengh_t_teratur = $var_e;
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			$baris++;
			$no++;
	    }
		
		//======================================================//
		//-------------------- End Body ------------------------//
		//======================================================//
		date_default_timezone_set("Asia/Bangkok");
		header('Content-Type: application/vnd.ms-excel; charset=utf-8');
		header('Content-Disposition: attachment; filename=Laporan rekap gaji karyawan '.date("dmY-his").'.xls');
		header('Cache-Control: max-age=0');
		ob_end_clean();
		ob_start();
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$filename = 'Sample' . 'csv';
		$objWriter->save('php://output');
	}

}
