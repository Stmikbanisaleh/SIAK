<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Honor_gurutetap extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
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

}
