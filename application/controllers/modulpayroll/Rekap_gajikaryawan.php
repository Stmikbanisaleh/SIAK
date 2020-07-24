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

		// echo $tahun;exit;

		$this->load->model('model_biodata');
		$my_data = $this->model_biodata->viewOrdering('sys_config', 'id', 'asc')->row();

		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'GAJI PEGAWAI '.strtoupper($my_data->name_school));
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'Periode '.$bln_awal.' - '.$bln_akhir.' '.$tahun);
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'Unit ');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E2', "'016506990407000");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B3', 'Alamat');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E3', 'Pejuang Jaya Blok B No. 30 RT. 014  RW. 011 Pejuang Bekasi');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B4', 'Masa Pajak');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E4', 'Mar-2020');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B5', 'Bulan');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D5', 'MARET');
		//*****************************************************************************************************//
										//-------------------Header Page---------------------//
		//*****************************************************************************************************//

		//*******************************************************************************************************//
									//------------------Header Content-------------------//
		//*******************************************************************************************************//


		//***************************************************//
		//------------------Style Header---------------------//
		$objPHPExcel->getActiveSheet()->getStyle('B7:AW11')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('B7:AW11')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('B7:AW11')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle('B7:AW11')->getFill()->getStartColor()->setARGB('C0C0C0C0');
		$objPHPExcel->getActiveSheet()->getStyle('B7:AW11')->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(6);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(24);
		$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(18);
		$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(18);
		$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(16);
		$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(16);
		$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(16);
		$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(18);
		//------------------End Style Hider-----------------//
		//***************************************************//

		//--------------Header Content No. Urut-------------//
		$objPHPExcel->getActiveSheet()->getStyle('B7:B10')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('B7:B10')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('B7:B10')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('B7:B10')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('B7:B10');
		$objPHPExcel->getActiveSheet()->setCellValue('B7', 'No. Urut');

		$objPHPExcel->getActiveSheet()->getStyle('B11')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('B11')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('B11')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('B11')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue('B11', '1');
		//-----------End Header Content No. Urut-------------//

		//--------------Header Content No. Register-------------//
		$objPHPExcel->getActiveSheet()->getStyle('C7:C10')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('C7:C10')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('C7:C10')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('C7:C10')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C7:C10');
		$objPHPExcel->getActiveSheet()->setCellValue('C7', 'No. Register');

		$objPHPExcel->getActiveSheet()->getStyle('C11')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('C11')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('C11')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('C11')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue('C11', '2');
		//-----------End Header Content No. Register-------------//

		//--------------Header Content Nama Pegawai-------------//
		$objPHPExcel->getActiveSheet()->getStyle('D7:D10')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('D7:D10')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('D7:D10')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('D7:D10')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('D7:D10');
		$objPHPExcel->getActiveSheet()->setCellValue('D7', 'Nama Pegawai');

		$objPHPExcel->getActiveSheet()->getStyle('D11')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('D11')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('D11')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('D11')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue('D11', '3');
		//-----------End Header Content No. Urut-------------//

		//--------------Header Content NPWP-------------//
		$objPHPExcel->getActiveSheet()->getStyle('E7:E10')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('E7:E10')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('E7:E10')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('E7:E10')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('E7:E10');
		$objPHPExcel->getActiveSheet()->setCellValue('E7', 'NPWP');

		$objPHPExcel->getActiveSheet()->getStyle('E11')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('E11')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('E11')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('E11')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue('E11', '4');
		//-----------End Header Content NPWP-------------//

		//--------------Header Content Jabatan-------------//
		$objPHPExcel->getActiveSheet()->getStyle('F7:F10')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('F7:F10')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('F7:F10')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('F7:F10')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('F7:F10');
		$objPHPExcel->getActiveSheet()->setCellValue('F7', 'Jabatan');

		$objPHPExcel->getActiveSheet()->getStyle('F11')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('F11')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('F11')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('F11')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue('F11', '5');
		//-----------End Header Content Jabatan-------------//

		//--------------Header Content Status-------------//
		$objPHPExcel->getActiveSheet()->getStyle('G7:G10')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('G7:G10')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('G7:G10')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('G7:G10')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('G7:G10');
		$objPHPExcel->getActiveSheet()->setCellValue('G7', 'Status');

		$objPHPExcel->getActiveSheet()->getStyle('G11')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('G11')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('G11')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('G11')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue('G11', '6');
		//-----------End Header Content Status-------------//

		//--------------Header Content Mulai Kerja Bulan Ke-------------//
		$objPHPExcel->getActiveSheet()->getStyle('H7:H10')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('H7:H10')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('H7:H10')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('H7:H10')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('H7:H10');
		$objPHPExcel->getActiveSheet()->setCellValue('H7', 'Mulai Kerja Bulan Ke');

		$objPHPExcel->getActiveSheet()->getStyle('H11')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('H11')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('H11')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('H11')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue('H11', '7');
		//-----------End Header Content Mulai Kerja Bulan Ke-------------//

		//--------------Header Content Akhir Kerja Bulan Ke-------------//
		$objPHPExcel->getActiveSheet()->getStyle('I7:I10')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('I7:I10')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('I7:I10')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('I7:I10')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('I7:I10');
		$objPHPExcel->getActiveSheet()->setCellValue('I7', 'Akhir Kerja Bulan Ke');

		$objPHPExcel->getActiveSheet()->getStyle('I11')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('I11')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('I11')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('I11')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue('I11', '8');
		//-----------End Header Content Akhir Kerja Bulan Ke-------------//


		//***************************************************************************************************//
							//---------------Header Content Penghasilan Bruto------------//
		//***************************************************************************************************//
		$objPHPExcel->getActiveSheet()->getStyle('J7:AH7')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('J7:AH7')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('J7:AH7')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('J7:AH7')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('J7:AH7');
		$objPHPExcel->getActiveSheet()->setCellValue('J7', 'Penghasilan Bruto');


		//--------------Header Content Gaji-------------//
		$objPHPExcel->getActiveSheet()->getStyle('J8:J10')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('J8:J10')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('J8:J10')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('J8:J10')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('J8:J10');
		$objPHPExcel->getActiveSheet()->setCellValue('J8', 'Status');

		$objPHPExcel->getActiveSheet()->getStyle('J11')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('J11')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('J11')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('J11')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue('J11', '9');
		//-----------End Header Content Gaji-------------//

		//--------------Header Content Rapel-------------//
		$objPHPExcel->getActiveSheet()->getStyle('K8:K10')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('K8:K10')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('K8:K10')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('K8:K10')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('K8:K10');
		$objPHPExcel->getActiveSheet()->setCellValue('K8', 'Rapel');

		$objPHPExcel->getActiveSheet()->getStyle('K11')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('K11')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('K11')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('K11')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue('K11', '10');
		//-----------End Header Content Rapel-------------//

		//--------------Header Content Premi-------------//
		$objPHPExcel->getActiveSheet()->getStyle('L8:L10')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('L8:L10')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('L8:L10')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('L8:L10')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('L8:L10');
		$objPHPExcel->getActiveSheet()->setCellValue('L8', 'Premi');

		$objPHPExcel->getActiveSheet()->getStyle('L11')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('L11')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('L11')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('L11')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue('L11', '11');
		//-----------End Header Content Premi-------------//

		//--------------Header Content Jumlah Gaji-------------//
		$objPHPExcel->getActiveSheet()->getStyle('M8:M10')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle('M8:M10')->getFill()->getStartColor()->setARGB('CCCCCFFF');

		$objPHPExcel->getActiveSheet()->getStyle('M8:M10')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('M8:M10')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('M8:M10')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('M8:M10')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('M8:M10');
		$objPHPExcel->getActiveSheet()->setCellValue('M8', 'Jumlah Gaji');

		$objPHPExcel->getActiveSheet()->getStyle('M11')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('M11')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('M11')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('M11')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue('M11', '12');
		//-----------End Header Content Jumlah Gaji-------------//

		//***************************************************************************************************//
		//--------------Header Content Tunjangan-------------//
		$objPHPExcel->getActiveSheet()->getStyle('N8:V8')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('N8:V8')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('N8:V8')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('N8:V8')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('N8:V8');
		$objPHPExcel->getActiveSheet()->setCellValue('N8', 'Tunjangan');
		//-----------End Header Content Tunjangan-------------//

		//--------------Header Content Pajak-------------//
		$objPHPExcel->getActiveSheet()->getStyle('N9:N10')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('N9:N10')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('N9:N10')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('N9:N10')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('N9:N10');
		$objPHPExcel->getActiveSheet()->setCellValue('N9', 'Pajak');

		$objPHPExcel->getActiveSheet()->getStyle('N11')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('N11')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('N11')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('N11')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue('N11', '13');
		//-----------End Header Content Pajak-------------//

		//--------------Header Content Sansos-------------//
		$objPHPExcel->getActiveSheet()->getStyle('O9:O10')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('O9:O10')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('O9:O10')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('O9:O10')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('O9:O10');
		$objPHPExcel->getActiveSheet()->setCellValue('O9', 'Sansos');

		$objPHPExcel->getActiveSheet()->getStyle('O11')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('O11')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('O11')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('O11')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue('O11', '14');
		//-----------End Header Content Sansos-------------//

		//--------------Header Content Jabatan-------------//
		$objPHPExcel->getActiveSheet()->getStyle('P9:P10')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('P9:P10')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('P9:P10')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('P9:P10')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('P9:P10');
		$objPHPExcel->getActiveSheet()->setCellValue('P9', 'Sansos');

		$objPHPExcel->getActiveSheet()->getStyle('P11')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('P11')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('P11')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('P11')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue('P11', '15');
		//-----------End Header Content Jabatan-------------//

		//--------------Header Content Struktural/Khusus-------------//
		$objPHPExcel->getActiveSheet()->getStyle('Q9:Q10')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('Q9:Q10')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('Q9:Q10')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('Q9:Q10')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('Q9:Q10');
		$objPHPExcel->getActiveSheet()->setCellValue('Q9', 'Struktural/Khusus');

		$objPHPExcel->getActiveSheet()->getStyle('Q11')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('Q11')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('Q11')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle('Q11')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue('Q11', '16');
		//-----------End Header Content Struktural/Khusus-------------//

		//--------------Header Content Transport-------------//
		$var_a = 'R9:R10';
		$var_b = 'R9';
		$var_c = 'Transport';
		$var_d = 'R11';
		$var_e = '17';
		//---------------Variable---------------//
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells($var_a);
		$objPHPExcel->getActiveSheet()->setCellValue($var_b, $var_c);

		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);
		//-----------End Header Content Transport-------------//

		//--------------Header Content Tetap-------------//
		$var_a = 'S9:S10';
		$var_b = 'S9';
		$var_c = 'Tetap';
		$var_d = 'S11';
		$var_e = '18';
		//---------------Variable---------------//
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells($var_a);
		$objPHPExcel->getActiveSheet()->setCellValue($var_b, $var_c);

		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);
		//-----------End Header Content Tetap-------------//

		//--------------Header Content Peralihan-------------//
		$var_a = 'T9:T10';
		$var_b = 'T9';
		$var_c = 'Peralihan';
		$var_d = 'T11';
		$var_e = '19';
		//---------------Variable---------------//
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells($var_a);
		$objPHPExcel->getActiveSheet()->setCellValue($var_b, $var_c);

		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);
		//-----------End Header Content Peralihan-------------//

		//--------------Header Content Utiliti-------------//
		$var_a = 'U9:U10';
		$var_b = 'U9';
		$var_c = 'Utiliti';
		$var_d = 'U11';
		$var_e = '20';
		//---------------Variable---------------//
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells($var_a);
		$objPHPExcel->getActiveSheet()->setCellValue($var_b, $var_c);

		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);
		//-----------End Header Content Utiliti-------------//

		//--------------Header Content Lain-lain-------------//
		$var_a = 'V9:V10';
		$var_b = 'V9';
		$var_c = 'Lain-lain';
		$var_d = 'V11';
		$var_e = '21';
		//---------------Variable---------------//
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells($var_a);
		$objPHPExcel->getActiveSheet()->setCellValue($var_b, $var_c);

		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);
		//-----------End Header Content Lain-lain-------------//
		//****************************************************************************************************/

		//--------------Header Content Lain-lain-------------//
		$var_a = 'W8:W10';
		$var_b = 'W8';
		$var_c = 'Jumlah Tunjangan';
		$var_d = 'W11';
		$var_e = '22';
		//---------------Variable---------------//
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getFill()->getStartColor()->setARGB('CCCCCFFF');

		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells($var_a);
		$objPHPExcel->getActiveSheet()->setCellValue($var_b, $var_c);

		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);
		//-----------End Header Content Lain-lain-------------//

		//--------------Header Content Honorarium dan Imb. Sejenis-------------//
		$var_a = 'X8:X10';
		$var_b = 'X8';
		$var_c = 'Honorarium dan Imb. Sejenis';
		$var_d = 'X11';
		$var_e = '23';
		//---------------Variable---------------//
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells($var_a);
		$objPHPExcel->getActiveSheet()->setCellValue($var_b, $var_c);

		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);
		//-----------End Header Content Honorarium dan Imb. Sejenis-------------//

		//**************************************************************************************************/
		//--------------Header Content Asuransi Dibayar Perusahaan-------------//
		$var_a = 'Y8:Z8';
		$var_b = 'Y8';
		$var_c = 'Asuransi Dibayar Perusahaan';
		//---------------Variable---------------//
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells($var_a);
		$objPHPExcel->getActiveSheet()->setCellValue($var_b, $var_c);
		//-----------End Header Content Asuransi Dibayar Perusahaan-------------//

		//--------------Header Content Jamsostek-------------//
		$var_a = 'Y9:Y10';
		$var_b = 'Y9';
		$var_c = 'Jamsostek';
		$var_d = 'Y11';
		$var_e = '24';
		//---------------Variable---------------//
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells($var_a);
		$objPHPExcel->getActiveSheet()->setCellValue($var_b, $var_c);

		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);
		//-----------End Header Content Jamsostek-------------//

		//--------------Header Content Jamsostek-------------//
		$var_a = 'Z9:Z10';
		$var_b = 'Z9';
		$var_c = 'Asuransi Lainnya';
		$var_d = 'Z11';
		$var_e = '25';
		//---------------Variable---------------//
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells($var_a);
		$objPHPExcel->getActiveSheet()->setCellValue($var_b, $var_c);

		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);
		//-----------End Header Content Jamsostek-------------//
		//**************************************************************************************************/

		//--------------Header Content Jumlah Asuransi-------------//
		$var_a = 'AA8:AA10';
		$var_b = 'AA8';
		$var_c = 'Jumlah Asuransi';
		$var_d = 'AA11';
		$var_e = '26';
		//---------------Variable---------------//
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getFill()->getStartColor()->setARGB('CCCCCFFF');

		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells($var_a);
		$objPHPExcel->getActiveSheet()->setCellValue($var_b, $var_c);

		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);
		//-----------End Header Content Jumlah Asuransi-------------//

		//--------------Header Content Natura Objek PPh 21-------------//
		$var_a = 'AB8:AB10';
		$var_b = 'AB8';
		$var_c = 'Natura Objek PPh 21';
		$var_d = 'AB11';
		$var_e = '27';
		//---------------Variable---------------//
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells($var_a);
		$objPHPExcel->getActiveSheet()->setCellValue($var_b, $var_c);

		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);
		//-----------End Header Content Natura Objek PPh 21-------------//

		//--------------Header Content Jumlah Penghasilan-------------//
		$var_a = 'AC8:AC10';
		$var_b = 'AC8';
		$var_c = 'Jumlah Penghasilan';
		$var_d = 'AC11';
		$var_e = '28';
		//---------------Variable---------------//
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getFill()->getStartColor()->setARGB('CCCCCFFF');

		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells($var_a);
		$objPHPExcel->getActiveSheet()->setCellValue($var_b, $var_c);

		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);
		//-----------End Header Content Jumlah Penghasilan-------------//

		//--------------Header Penghasilan Tidak Teratur-------------//
		$var_a = 'AD8:AF8';
		$var_b = 'AD8';
		$var_c = 'Penghasilan Tidak Teratur';
		//---------------Variable---------------//
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells($var_a);
		$objPHPExcel->getActiveSheet()->setCellValue($var_b, $var_c);
		//-----------End Header Content Penghasilan Tidak Teratur-------------//

		//--------------Header Content Bonus/Tantiem-------------//
		$var_a = 'AD9:AD10';
		$var_b = 'AD9';
		$var_c = 'Bonus/Tantiem';
		$var_d = 'AD11';
		$var_e = '29';
		//---------------Variable---------------//
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells($var_a);
		$objPHPExcel->getActiveSheet()->setCellValue($var_b, $var_c);

		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);
		//-----------End Header Content Bonus/Tantiem-------------//

		//--------------Header Content THR-------------//
		$var_a = 'AE9:AE10';
		$var_b = 'AE9';
		$var_c = 'THR';
		$var_d = 'AE11';
		$var_e = '30';
		//---------------Variable---------------//
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells($var_a);
		$objPHPExcel->getActiveSheet()->setCellValue($var_b, $var_c);

		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);
		//-----------End Header Content THR-------------//

		//--------------Header Content Cuti/Jubelium-------------//
		$var_a = 'AF9:AF10';
		$var_b = 'AF9';
		$var_c = 'Cuti/Jubelium';
		$var_d = 'AF11';
		$var_e = '31';
		//---------------Variable---------------//
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells($var_a);
		$objPHPExcel->getActiveSheet()->setCellValue($var_b, $var_c);

		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);
		//-----------End Header Content Cuti/Jubelium-------------//
		
		//--------------Header Content Jml Penghasilan Tdk-------------//
		$var_a = 'AG8:AG10';
		$var_b = 'AG8';
		$var_c = 'Jml Penghasilan Tdk';
		$var_d = 'AG11';
		$var_e = '32';
		//---------------Variable---------------//
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getFill()->getStartColor()->setARGB('CCCCCFFF');

		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells($var_a);
		$objPHPExcel->getActiveSheet()->setCellValue($var_b, $var_c);

		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);
		//-----------End Header Content Jml Penghasilan Tdk-------------//

		//--------------Header Content Jumlah-------------//
		$var_a = 'AH8:AH10';
		$var_b = 'AH8';
		$var_c = 'Jumlah';
		$var_d = 'AH11';
		$var_e = '33';
		//---------------Variable---------------//
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getFill()->getStartColor()->setARGB('CCCCCFFF');

		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells($var_a);
		$objPHPExcel->getActiveSheet()->setCellValue($var_b, $var_c);

		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);
		//-----------End Header Content Jumlah-------------//

		//--------------Header Content By Jabatan/By Pensiun atas angka 27-------------//
		$var_a = 'AI7:AN7';
		$var_b = 'AI7';
		$var_c = 'Pengurangan';
		//---------------Variable---------------//
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells($var_a);
		$objPHPExcel->getActiveSheet()->setCellValue($var_b, $var_c);
		//-----------End Header Content By Jabatan/By Pensiun atas angka 27-------------//

		//--------------Header Content By Jabatan/By Pensiun atas angka 27-------------//
		$var_a = 'AI8:AI10';
		$var_b = 'AI8';
		$var_c = 'By Jabatan/By Pensiun atas angka 27';
		$var_d = 'AI11';
		$var_e = '34';
		//---------------Variable---------------//
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getFill()->getStartColor()->setARGB('CCCCCFFF');

		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells($var_a);
		$objPHPExcel->getActiveSheet()->setCellValue($var_b, $var_c);

		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);
		//-----------End Header Content By Jabatan/By Pensiun atas angka 27-------------//

		//--------------Header Content By Jabatan/By Pensiun atas angka 27-------------//
		$var_a = 'AJ8:AJ10';
		$var_b = 'AJ8';
		$var_c = 'By Jabatan/By Pensiun atas angka 32';
		$var_d = 'AJ11';
		$var_e = '35';
		//---------------Variable---------------//
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getFill()->getStartColor()->setARGB('CCCCCFFF');

		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells($var_a);
		$objPHPExcel->getActiveSheet()->setCellValue($var_b, $var_c);

		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);
		//-----------End Header Content By Jabatan/By Pensiun atas angka 32-------------//

		//***************************************************************************************************/
		//--------------Header Content By Potongan Asuransi yang Dibayar Pribadi dan Perusahaan-------------//
		$var_a = 'AK8:AL9';
		$var_b = 'AK8';
		$var_c = 'Potongan Asuransi yang Dibayar Pribadi dan Perusahaan';
		//---------------Variable---------------//
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells($var_a);
		$objPHPExcel->getActiveSheet()->setCellValue($var_b, $var_c);
		//-----------End Header Content Potongan Asuransi yang Dibayar Pribadi dan Perusahaan-------------//

		//--------------Header Content Iuran Pensiun-------------//
		$var_a = 'AK10:AK10';
		$var_b = 'AK10';
		$var_c = 'Iuran Pensiun';
		$var_d = 'AK11';
		$var_e = '36';
		//---------------Variable---------------//
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells($var_a);
		$objPHPExcel->getActiveSheet()->setCellValue($var_b, $var_c);

		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);
		//-----------End Header Content Iuran Pensiun-------------//

		//--------------Header Content Iuran JHT-------------//
		$var_a = 'AL10:AL10';
		$var_b = 'AL10';
		$var_c = 'JHT';
		$var_d = 'AL11';
		$var_e = '37';
		//---------------Variable---------------//
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells($var_a);
		$objPHPExcel->getActiveSheet()->setCellValue($var_b, $var_c);

		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);
		//-----------End Header Content Iuran JHT-------------//
		//***************************************************************************************************/

		//--------------Header Content Jumlah Asuransi-------------//
		$var_a = 'AM8:AM10';
		$var_b = 'AM8';
		$var_c = 'Jumlah Asuransi';
		$var_d = 'AM11';
		$var_e = '38';
		//---------------Variable---------------//
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getFill()->getStartColor()->setARGB('CCCCCFFF');

		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells($var_a);
		$objPHPExcel->getActiveSheet()->setCellValue($var_b, $var_c);

		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);
		//-----------End Header Content Jummlah Asuransi-------------//

		//--------------Header Content Jumlah Pengurang-------------//
		$var_a = 'AN8:AN10';
		$var_b = 'AN8';
		$var_c = 'Jumlah Pengurang';
		$var_d = 'AN11';
		$var_e = '39';
		//---------------Variable---------------//
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getFill()->getStartColor()->setARGB('CCCCCFFF');

		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells($var_a);
		$objPHPExcel->getActiveSheet()->setCellValue($var_b, $var_c);

		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);
		//-----------End Header Content Iuran Jummlah Pengurang-------------//


		//***************************************************************************************************//
							//------------End Header Content Penghasilan Bruto-----------//
		//***************************************************************************************************//



		//--------------Header Content Jumlah Ph Neto Setahun/Disetahunkan-------------//
		$var_a = 'AO7:AO10';
		$var_b = 'AO7';
		$var_c = 'Jumlah Ph Neto Setahun/Disetahunkan';
		$var_d = 'AO11';
		$var_e = '40';
		//---------------Variable---------------//
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getFill()->getStartColor()->setARGB('CCCCCFFF');

		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells($var_a);
		$objPHPExcel->getActiveSheet()->setCellValue($var_b, $var_c);

		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);
		//-----------End Header Content Jumlah Ph Neto Setahun/Disetahunkan-------------//

		//--------------Header Content PTKP-------------//
		$var_a = 'AP7:AP10';
		$var_b = 'AP7';
		$var_c = 'PTKP';
		$var_d = 'AP11';
		$var_e = '41';
		//---------------Variable---------------//
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getFill()->getStartColor()->setARGB('CCCCCFFF');

		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells($var_a);
		$objPHPExcel->getActiveSheet()->setCellValue($var_b, $var_c);

		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);
		//-----------End Header Content PTKP-------------//

		//--------------Header Content PKP Setahun/Disetahunkan-------------//
		$var_a = 'AQ7:AQ10';
		$var_b = 'AQ7';
		$var_c = 'Header Content PKP Setahun/Disetahunkan';
		$var_d = 'AQ11';
		$var_e = '42';
		//---------------Variable---------------//
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getFill()->getStartColor()->setARGB('CCCCCFFF');

		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells($var_a);
		$objPHPExcel->getActiveSheet()->setCellValue($var_b, $var_c);

		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);
		//-----------End Header Content Header Content PKP Setahun/Disetahunkan-------------//

		//--------------Header Content PKP Setahun/Disetahunkan-------------//
		$var_a = 'AR7:AU10';
		$var_b = 'AR7';
		$var_c = 'Tambahan Perhitungan Jika Ada Penghasilan Tidak Teratur/Belum Tentu Ada Setiap Bulannya Seperti THR';
		$var_d = 'AR11';
		$var_e = '43';
		//---------------Variable---------------//
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getFill()->getStartColor()->setARGB('CCCCCFFF');

		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells($var_a);
		$objPHPExcel->getActiveSheet()->setCellValue($var_b, $var_c);

		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);
		//-----------End Header Content Header Content PKP Setahun/Disetahunkan-------------//

		//--------------Header Content Tambahan-------------//
		$var_d = 'AS11';
		$var_e = '44';
		//---------------Variable---------------//
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);
		//-----------End Header Content Tambahan-------------//

		//--------------Header Content Tambahan-------------//
		$var_d = 'AT11';
		$var_e = '45';
		//---------------Variable---------------//
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);
		//-----------End Header Content Tambahan-------------//

		//--------------Header Content Tambahan-------------//
		$var_d = 'AU11';
		$var_e = '46';
		//---------------Variable---------------//
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);
		//-----------End Header Content Tambahan-------------//

		//--------------Header Content Tambahan-------------//
		$var_d = 'AV11';
		$var_e = '47';
		//---------------Variable---------------//
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);
		//-----------End Header Content Tambahan-------------//

		//--------------Header Content PKP Setahun/Disetahunkan-------------//
		$var_a = 'AV7:AV10';
		//---------------Variable---------------//
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getFill()->getStartColor()->setARGB('CCCCCFFF');

		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells($var_a);
		//-----------End Header Content Header Content PKP Setahun/Disetahunkan-------------//

		//--------------Header Content Header PPh 21 Sebulan-------------//
		$var_a = 'AW7:AW10';
		$var_b = 'AW7';
		$var_c = 'PPh 21 Sebulan';
		$var_d = 'AW11';
		$var_e = '48';
		//---------------Variable---------------//
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getFill()->getStartColor()->setARGB('CCCCCFFF');

		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($var_a)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells($var_a);
		$objPHPExcel->getActiveSheet()->setCellValue($var_b, $var_c);

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
		$baris = 12;
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
			$var_e = $row['employee_number'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Nama Pegawai
			$var_d = 'D'.$baris;
			$var_e = $row['nama'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//NPWP
			$var_d = 'E'.$baris;
			$var_e = "'".$row['npwp'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Jabatan
			$var_d = 'F'.$baris;
			$var_e = $row['jabatan'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Status
			$var_d = 'G'.$baris;
			$var_e = $row['status'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Mulai kerja
			$var_d = 'H'.$baris;
			$var_e = $row['bulan_awal'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Akhir Kerja Bulan Ke
			$var_d = 'I'.$baris;
			$var_e = $row['bulan_akhir'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Gaji
			$var_d = 'J'.$baris;
			$var_e = $row['gaji'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Rapel
			$var_d = 'K'.$baris;
			$var_e = $row['rapel'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Premi
			$var_d = 'L'.$baris;
			$var_e = $row['premi'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Jumlah Gaji
			$var_d = 'M'.$baris;
			$var_e = $row['gaji']+$row['rapel']+$row['premi'];
			$jumlah_gaji = $var_e;
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Pajak
			$var_d = 'N'.$baris;
			$var_e = $row['tunj_pajak'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Sansos
			$var_d = 'O'.$baris;
			$var_e = $row['tunj_sansos'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Jabatan
			$var_d = 'P'.$baris;
			$var_e = $row['tunj_jabatan'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Struktural / Khusus
			$var_d = 'Q'.$baris;
			$var_e = $row['tunj_struktural_khusus'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Transport
			$var_d = 'R'.$baris;
			$var_e = $row['tunj_transport'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Tetap
			$var_d = 'S'.$baris;
			$var_e = $row['tunj_tetap'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Peralihan
			$var_d = 'T'.$baris;
			$var_e = $row['tunj_peralihan'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Utility
			$var_d = 'U'.$baris;
			$var_e = $row['tunj_utility'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Lain - lain
			$var_d = 'V'.$baris;
			$var_e = $row['tunj_lain'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Jumlah Tunjangan
			$var_d = 'W'.$baris;
			$var_e = $row['tunj_pajak']+$row['tunj_sansos']+$row['tunj_jabatan']+$row['tunj_struktural_khusus']+$row['tunj_transport']+$row['tunj_tetap']+$row['tunj_peralihan']+$row['tunj_utility']+$row['tunj_lain'];
			$jumlah_tunjangan = $var_e;
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Honorarium & IMB Sejenis
			$var_d = 'X'.$baris;
			$var_e = $row['honorarium_imb'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Jamsostek
			$var_d = 'Y'.$baris;
			$var_e = $row['asuransi_jamsostek'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Asuransi Lainnya
			$var_d = 'Z'.$baris;
			$var_e = $row['asuransi_lainnya'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Jumlah Asuransi
			$var_d = 'AA'.$baris;
			$var_e = $row['asuransi_jamsostek']+$row['asuransi_lainnya'];
			$jumlah_asuransi = $var_e;
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Natura yg Objek PPh 21
			$var_d = 'AB'.$baris;
			$var_e = $row['natura_obj_pph21'];
			$objek_naturapph21 = $var_e;
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Jumlah Penghasilan
			$var_d = 'AC'.$baris;
			$var_e = $row['natura_obj_pph21']+$jumlah_asuransi+$jumlah_tunjangan+$jumlah_gaji;
			$jum_pengh_teratur = $var_e;
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Bonus/Tantiem
			$var_d = 'AD'.$baris;
			$var_e = $row['bonus'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//THR
			$var_d = 'AE'.$baris;
			$var_e = $row['thr'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Cuti / Jubelium
			$var_d = 'AF'.$baris;
			$var_e = $row['cuti_jubelium'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Jml Penghasilan Tidak teratur
			$var_d = 'AG'.$baris;
			$var_e = $row['bonus']+$row['thr']+$row['cuti_jubelium'];
			$jum_pengh_t_teratur = $var_e;
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Jumlah
			$var_d = 'AH'.$baris;
			$var_e = $jum_pengh_teratur+$jum_pengh_t_teratur;
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//By Jabatan / By Pensiun atas angka 27
			$var_d = 'AI'.$baris;
			$var_e = $row['pot_pensiun_27'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//By Jabatan / By Pensiun atas angka 32
			$var_d = 'AJ'.$baris;
			$var_e = $row['pot_pensiun_32'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Iuran Pensiun
			$var_d = 'AK'.$baris;
			$var_e = $row['pot_iuran_pensiun'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//JHT
			$var_d = 'AL'.$baris;
			$var_e = $row['pot_iuran_jht'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Jumlah Asuransi
			$var_d = 'AM'.$baris;
			$var_e = $row['pot_iuran_jht']+$row['pot_iuran_pensiun'];
			$jumlah_asuransi = $var_e;
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Jumlah Pengurang
			$var_d = 'AN'.$baris;
			$var_e = $row['pot_pensiun_27']+$row['pot_pensiun_32']+$jumlah_asuransi;
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Jumlah PH Neto Setahun / Disetahunkan
			$var_d = 'AO'.$baris;
			$var_e = $row['ph_neto_setahun'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//PTKP
			$var_d = 'AP'.$baris;
			$var_e = $row['ptkp'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//PTKP Setahun/ Disetahunkan
			$var_d = 'AQ'.$baris;
			$var_e = $row['ptkp_setahun'];
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->setCellValue($var_d, $var_e);

			//Just Border
			$var_d = 'AR'.$baris;
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

			$var_d = 'AS'.$baris;
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

			$var_d = 'AT'.$baris;
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

			$var_d = 'AU'.$baris;
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

			$var_d = 'AV'.$baris;
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle($var_d)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);			

			//PPH21
			$var_d = 'AW'.$baris;
			$var_e = $row['pph21_bulanan'];
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
