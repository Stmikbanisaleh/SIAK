<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trx_jurnal extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('akunting/model_buk');
        $this->load->model('akunting/model_trx_jurnal');
        if ($this->session->userdata('username') == NULL && $this->session->userdata('level') != 'AKUNTING') {
            $this->session->set_flashdata('category_error', 'Silahkan masukan username dan password');
            redirect('modulakunting/login');
        }
    }

	function render_view($data) {
        $this->template->load('templateakunting', $data); //Display Page
    }

	public function index() {
        $mytahun = $this->model_buk->view_tahun()->result_array();
        $data = array(
        			'page_content' 	=> '../pageakunting/trx_jurnal/view',
        			'ribbon' 		=> '<li class="active">Transaksi Jurnal</li>',
					'page_name' 	=> 'Transaksi Jurnal',
                    'mytahun'       => $mytahun,
        		);
        $this->render_view($data); //Memanggil function render_view
    }

    public function show_nopem()
    {
        $tahun = $this->input->post('tahun');
        $my_data = $this->model_buk->view_nopembytahun($tahun)->result_array();
        echo "<option value='0'>--Pilih Program--</option>";
        foreach ($my_data as $value) {
            echo "<option value='" . $value['Nopembayaran'] . "'>[" . $value['Nopembayaran'] . "] - " . $value['tglentri'] . "</option>";
        }
    }

    public function tampil()
    {
        $nopembayaran = $this->input->post('nopembayaran');
        $my_data = $this->model_trx_jurnal->view_transaksi($nopembayaran)->result_array();
        echo json_encode($my_data);
    }
}