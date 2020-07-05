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
		$this->laporan_pdf_karyawan();
	}
	
	public function laporan_pdf_karyawan(){
		$tgl = $this->mainfunction->tgl_indo(date('Y-m-d'));
        $my_gaji = $this->model_slipgaji->view('tb_pendapatan');
		$this->load->library('pdf');
		
		$data = array(
			'mygaji'      	=> $my_gaji,
		);
		$this->pdf->setPaper('FOLIO', 'potrait');
		// $customPaper = array(0,0,254,396);
		// $this->pdf->set_paper($customPaper);
		// $this->pdf->filename = "Slip Gaji ".$tgl.".pdf";
		$this->pdf->load_view('pagepayroll/slip_gaji/laporan', $data);

		// $this->template->load('pagepayroll/slip_gaji/laporan_excel', $data);
	}

	public function laporan_pdf_guru(){
		$tgl = $this->mainfunction->tgl_indo(date('Y-m-d'));
        $my_gaji = $this->model_slipgaji->view('tb_pendapatan');
		$this->load->library('pdf');
		
		$data = array(
			'mygaji'      	=> $my_gaji,
		);
		$this->pdf->setPaper('FOLIO', 'potrait');
		// $customPaper = array(0,0,254,396);
		// $this->pdf->set_paper($customPaper);
		// $this->pdf->filename = "Slip Gaji ".$tgl.".pdf";
		$this->pdf->load_view('pagepayroll/slip_gaji/laporan', $data);

		// $this->template->load('pagepayroll/slip_gaji/laporan_excel', $data);
	}

}
