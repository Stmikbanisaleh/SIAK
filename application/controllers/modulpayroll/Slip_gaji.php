<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Slip_gaji extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('payroll/model_slipgaji');
		$this->load->library('mainfunction');
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
		$my_karyawan = $this->model_slipgaji->view('biodata_karyawan')->result_array();
		$data = array(
			'page_content' 	=> '../pagepayroll/slip_gaji/view',
			'ribbon' 		=> '<li class="active">Slip Gaji</li><li>Slip Gaji</li>',
			'page_name' 	=> 'Slip Gaji',
			'js' 			=> 'js_file',
			'my_karyawan'	=> $my_karyawan
		);
		$this->render_view($data); //Memanggil function render_view
		
	}

	public function laporan(){
		$tgl = $this->mainfunction->tgl_indo(date('Y-m-d'));
		$bulan = $this->mainfunction->periode_bulan(date('m'));
		$tahun = $this->input->post('tahun');
		if($this->input->post('employee') == 'none'){
			$my_gaji = $this->model_slipgaji->view_gaji('tb_pendapatan_guru',
														$this->input->post('blnawal'),
														$this->input->post('blnakhir'),
														$this->input->post('tahun'),
													);
		}else{
			$where = array(
				'employee_number'	=> $this->input->post('employee'),
			);
			$my_gaji = $this->model_slipgaji->view_gaji_byemp('tb_pendapatan_guru',
															$this->input->post('blnawal'),
															$this->input->post('blnakhir'),
															$this->input->post('employee'),
															$this->input->post('tahun'),
														);
		}

		if($this->input->post('tipe_laporan') == 'P'){
			if($this->input->post('tipe_gaji') == 'K'){
				$this->laporan_pdf_karyawan($my_gaji, $bulan, $tahun);
			}else{
				$this->laporan_pdf_guru($my_gaji, $bulan, $tahun);
			}
		}else{
			if($this->input->post('tipe_gaji') == 'K'){
				$this->laporan_excel_karyawan($my_gaji, $bulan, $tahun);
			}else{
				$this->laporan_excel_guru($my_gaji, $bulan, $tahun);
			}
		}
		
	}
	
	public function laporan_pdf_karyawan($my_gaji, $bulan, $tahun){
        
		$this->load->library('pdf');
		
		$data = array(
			'mygaji'      	=> $my_gaji,
			'bulan'		=> $bulan,
			'tahun'		=> $tahun,
			'ket'		=> 'K'
		);
		$this->pdf->setPaper('FOLIO', 'potrait');
		// $customPaper = array(0,0,254,396);
		// $this->pdf->set_paper($customPaper);
		// $this->pdf->filename = "Slip Gaji ".$tgl.".pdf";
		$this->pdf->load_view('pagepayroll/slip_gaji/laporan', $data);

		// $this->template->load('pagepayroll/slip_gaji/laporan_excel', $data);
	}

	public function laporan_pdf_guru($my_gaji, $bulan, $tahun){
		$tgl = $this->mainfunction->tgl_indo(date('Y-m-d'));
		$this->load->library('pdf');
		
		$data = array(
			'mygaji'      	=> $my_gaji,
			'bulan'		=> $bulan,
			'tahun'		=> $tahun,
			'ket'		=> 'G'
		);
		$this->pdf->setPaper('FOLIO', 'potrait');
		$this->pdf->load_view('pagepayroll/slip_gaji/laporan', $data);
	}

	public function laporan_excel_karyawan($my_gaji, $bulan, $tahun){
		
		$data = array(
			'mygaji'      	=> $my_gaji,
			'bulan'		=> $bulan,
			'tahun'		=> $tahun,
			'ket'		=> 'K'
		);
		$this->template->load('pagepayroll/slip_gaji/laporan_excel', $data);
	}

	public function laporan_excel_guru($my_gaji, $bulan, $tahun){
		$data = array(
			'mygaji'      	=> $my_gaji,
			'bulan'		=> $bulan,
			'tahun'		=> $tahun,
			'ket'		=> 'G'
		);

		$this->template->load('pagepayroll/slip_gaji/laporan_excel', $data);
	}

}
