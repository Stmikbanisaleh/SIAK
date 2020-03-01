<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('akunting/model_pengeluaran');
    }

	function render_view($data) {
        $this->template->load('templateakunting', $data); //Display Page
    }

	public function index() {
        $this->load->model('model_guru');
        $this->load->model('model_jabatan');
        $my_data = $this->model_guru->view('tbps')->result_array();
        $myagama = $this->model_guru->view('tbagama')->result_array();
        $mypendidikan = $this->model_guru->view('mspendidikan')->result_array();
        $data = array(
        			'page_content' 	=> '../pageakunting/pengeluaran/view',
        			'ribbon' 		=> '<li class="active">Jenis Pengeluaran</li><li>Sample</li>',
					'page_name' 	=> 'Jenis Pengeluaran',
                    'myprogram'     => $my_data,
                    'myagama'       => $myagama,
                    'mypendidikan'  => $mypendidikan
        		);
        $this->render_view($data); //Memanggil function render_view
    }

    public function tampil()
    {
        $my_data = $this->model_pengeluaran->view_pengeluaran('TBGURU')->result_array();
        echo json_encode($my_data);
    }
}