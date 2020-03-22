<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kartubayar extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('kasir/model_kartubayar');
        $this->load->library('pdf');
        $this->load->library('mainfunction');
        // if ($this->session->userdata('kodekaryawan') != null && $this->session->userdata('nama') != null) {
        //     $this->session->set_flashdata('category_error', 'Silahkan masukan username dan password');
        //     redirect('pagekasir/login');
        // }
    }

	function render_view($data) {
        $this->template->load('templatekasir', $data); //Display Page
    }

	public function index() {
        $my_siswa = $this->model_kartubayar->view('mssiswa')->result_array();
        $data = array(
        			'page_content' 	=> '../pagekasir/kartubayar/view',
        			'ribbon' 		=> '<li class="active">Kartu Pembayaran</li><li>Sample</li>',
					'page_name' 	=> 'Kartu Pembayaran',
                    'my_siswa'      => $my_siswa,
        		);
        $this->render_view($data); //Memanggil function render_view
    }

    public function show_nopem()
    {
        $siswa = $this->input->post('siswa');
        $my_data = $this->model_kartubayar->view_nopem($siswa)->result_array();
        echo "<option value='0'>--Pilih Noa Pembayaran--</option>";
        foreach ($my_data as $value) {
            echo "<option value='" . $value['Nopembayaran'] . "'>[" . $value['Nopembayaran'] . "] - " . $value['tglentri'] . "</option>";
        }
    }

    public function laporan_pdf(){
        $tgl = $this->mainfunction->tgl_indo(date('Y-m-d'));
        $nis = $this->input->post('siswa');
        $pilihan_pertama = $this->input->post('pilihan_pertama');  
        $dari = $this->input->post('dari'); 
        $sampai = $this->input->post('sampai'); 
        // $my_pembsiswa = $this->model_kartubayar->view_siswatg($nis, $kelas)->row();
        // print_r(json_encode($my_pembsiswa));
        // echo $my_pembsiswa->nmsiswa;
        // exit;
        $data = array(
            // 'mydata'      => $my_pembsiswa,
            'tgl'         => $tgl,
            'siswa'         => $nis,

        );
        $this->pdf->setPaper('FOLIO', 'potrait');
        $this->pdf->filename = "laporan-Kartu-Bayar".date('Y-m-d').".pdf";
        $this->pdf->load_view('pagekasir/kartubayar/laporan', $data);
    }
}