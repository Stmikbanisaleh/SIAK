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

			$data = array(
				'page_content' 	=> '../pagepayroll/honor_gurutetap/view',
				'ribbon' 		=> '<li class="active">Honor Guru Tetap</li><li>Honor Guru Tetap</li>',
				'page_name' 	=> 'Honor Guru Tetap',
				'js' 			=> 'js_file'
			);
			$this->render_view($data); //Memanggil function render_view
		} else {
			$this->load->view('pagepayroll/login'); //Memanggil function render_view
		}
	}

	public function laporan_pdf(){
		$tgl = $this->mainfunction->tgl_indo(date('Y-m-d'));
		// 	$my_gaji = $this->model_slipgaji->view_gaji_byemp('tb_pendapatan',
		// 													$this->input->post('blnawal'),
		// 													$this->input->post('blnakhir'),
		// 													$this->input->post('employee'));
		// }
        
		$this->load->library('pdf');
		
		$data = array(
			'mygaji'      	=> 'a',
		);
		$this->pdf->setPaper('FOLIO', 'potrait');
		$this->pdf->load_view('pagepayroll/slip_gaji/laporan', $data);
	}

}
