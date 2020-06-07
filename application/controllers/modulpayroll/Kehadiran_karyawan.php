<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kehadiran_karyawan extends CI_Controller
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
				'page_content' 	=> '../pagepayroll/kehadiran_karyawan/view',
				'ribbon' 		=> '<li class="active">Laporan Kehadiran Karyawan</li><li>kehadiran Karyawan</li>',
				'page_name' 	=> 'Kehadiran Karyawan',
				'js' 			=> 'js_file'
			);
			$this->render_view($data); //Memanggil function render_view
		} else {
			$this->load->view('pagepayroll/login'); //Memanggil function render_view
		}
	}

}
