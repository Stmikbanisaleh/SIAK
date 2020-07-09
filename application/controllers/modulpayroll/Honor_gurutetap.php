<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Honor_gurutetap extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('payroll/model_honorguru');
		$this->load->library('mainfunction');
	}

	function render_view($data)
	{
		$this->template->load('templatepayroll', $data); //Display Page
	}

	public function index()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$myunit = $this->model_honorguru->view_unit();
			$data = array(
				'page_content' 	=> '../pagepayroll/honor_gurutetap/view',
				'ribbon' 		=> '<li class="active">Honor Guru Tetap</li><li>Honor Guru Tetap</li>',
				'page_name' 	=> 'Honor Guru Tetap',
				'js' 			=> 'js_file',
				'myunit'		=>  $myunit
			);
			$this->render_view($data); //Memanggil function render_view
		} else {
			$this->load->view('pagepayroll/login'); //Memanggil function render_view
		}
	}

	public function laporan_pdf(){
		$tgl = $this->mainfunction->tgl_indo(date('Y-m-d'));
		$my_data = $this->model_honorguru->view_honor($this->input->post('bln'), $this->input->post('tahun'), $this->input->post('unit'));
		// print_r($my_data);exit;
        
		$this->load->library('pdf');
		
		$data = array(
			'mydata'      	=> $my_data,
		);
		$this->pdf->setPaper('FOLIO', 'potrait');
		$this->pdf->load_view('pagepayroll/honor_gurutetap/laporan_pdf', $data);
	}

}
