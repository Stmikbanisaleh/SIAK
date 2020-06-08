<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_pembayaran extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('payroll/model_jnspembayaran');
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			// continue;
		} else {
			$this->load->view('pagepayroll/login'); //Redirect login
		}
	}

	function render_view($data)
	{
		$this->template->load('templatepayroll', $data); //Display Page
	}

	public function index()
	{
		$data = array(
			'page_content' 	=> '../pagepayroll/jenis_pembayaran/view',
			'ribbon' 		=> '<li class="active">Dashboard</li><li>Master Jenis Pembayaran</li>',
			'page_name' 	=> 'Master Jenis Pembayaran',
			'js' 			=> 'js_file',
		);
		$this->render_view($data); //Memanggil function render_view
	}

	public function tampil()
	{
		$my_data = $this->model_jnspembayaran->view('jnspembayaran')->result_array();
		echo json_encode($my_data);
    }
    
    public function tampil_byid()
	{
        $data = array(
            'id'  => $this->input->post('id'),
        );
        $my_data = $this->model_jnspembayaran->view_where('jnspembayaran', $data)->result();
        echo json_encode($my_data);
	}

}
