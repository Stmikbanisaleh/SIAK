<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buk extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('akunting/model_buk');
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
        			'page_content' 	=> '../pageakunting/buk/view',
        			'ribbon' 		=> '<li class="active">BUK</li><li>Sample</li>',
					'page_name' 	=> 'BUK',
                    'mytahun'       => $mytahun,
        		);
        $this->render_view($data); //Memanggil function render_view
    }

    public function tampil()
    {
        $nopembayaran = $this->input->post('nopembayaran');
        if ($nopembayaran == '0') {
                $cp = "WHERE posting='T'";
            } else {
                $cp = "WHERE bukti = ".$nopembayaran;
            }
        $my_data = $this->model_buk->view_buk($cp)->result_array();
        echo json_encode($my_data);
    }

    public function show_nopem()
    {
        $tahun = $this->input->post('tahun');
        $my_data = $this->model_buk->view_nopembytahun($tahun)->result_array();
        echo "<option value='0'>--Pilih Program --</option>";
        foreach ($my_data as $value) 
            {
                echo "<option value='".$value['Nopembayaran']."'>[".$value['Nopembayaran']."] - ".$value['tglentri']."</option>";
            }
    }
}