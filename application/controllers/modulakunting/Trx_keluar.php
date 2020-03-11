<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trx_keluar extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('akunting/model_trx_keluar');
        if ($this->session->userdata('username') == NULL && $this->session->userdata('level') != 'AKUNTING') {
            $this->session->set_flashdata('category_error', 'Silahkan masukan username dan password');
            redirect('modulakunting/login');
        }
    }

	function render_view($data) {
        $this->template->load('templateakunting', $data); //Display Page
    }

	public function index() {
        $mytrx = $this->model_trx_keluar->view_jenis_trx()->result_array();
        $dk = $this->model_trx_keluar->view_dk(9)->result_array();
        $mytransaksi = $this->model_trx_keluar->view_transaksi()->result_array();

        $data = array(
        			'page_content' 	=> '../pageakunting/trx_keluar/view',
        			'ribbon' 		=> '<li class="active">Transaksi Pengeluaran</li>',
					'page_name' 	=> 'Transaksi Pengeluaran',
                    'mytrx'         => $mytrx,
                    'dk'            => $dk,
                    'mytransaksi'   => $mytransaksi,
        		);
        $this->render_view($data); //Memanggil function render_view
    }
}