<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bayarsiswa extends CI_Controller {
        function __construct()
    {
        parent::__construct();
        $this->load->model('akunting/model_surattagihan');
        $this->load->model('kasir/model_bayarsiswa');
        $this->load->library('pdf');
        $this->load->library('mainfunction');
        $this->load->library('Configfunction');
    }

	function render_view($data) {
        $this->template->load('templatekasir', $data); //Display Page
    }

	public function index() {
        $my_siswa = $this->model_surattagihan->view('mssiswa')->result_array();
        $my_kelas = $this->model_surattagihan->view('tbkelas')->result_array();
        $data = array(
        			'page_content' 	=> '../pagekasir/bayarsiswa/view',
        			'ribbon' 		=> '<li class="active">Pembayaran Siswa</li>',
					'page_name' 	=> 'Pembayaran Siswa',
                    'my_siswa'      => $my_siswa,
                    'my_kelas'     => $my_kelas
        		);
        $this->render_view($data); //Memanggil function render_view
    }

    public function search()
    {
        $siswa = $this->input->post('siswa');
        $kelas = $this->input->post('kelas');
        $result = $this->model_bayarsiswa->pembsis_detail($siswa, $kelas)->result();
        echo json_encode($result);
    }

    public function search_pemb_sekolah()
    {
        $siswa = $this->input->post('siswa');
        $kelas = $this->input->post('kelas');
        $result = $this->model_bayarsiswa->pemb_sekolah($siswa, $kelas)->result();
        echo json_encode($result);
    }

    public function search_pemb_sekolah_q2()
    {
        $siswa = $this->input->post('siswa');
        $kelas = $this->input->post('kelas');
        $result = $this->model_bayarsiswa->pemb_sekolah_q2($siswa, $kelas)->result();
        echo json_encode($result);
    }

    public function print(){
        // $tgl = $this->mainfunction->tgl_indo(date('Y-m-d'));
        // $periode_awal = $this->input->post('periode_awal');
        // $periode_akhir = $this->input->post('periode_akhir');  
        // $my_pembsiswa = $this->model_laporan->get_pemb_siswa($periode_awal, $periode_akhir)->result_array();
        // print_r(json_encode($my_pembsiswa));exit;
        // $data = array(
        //     'v_awal'      => $periode_awal,
        //     'v_akhir'     => $periode_akhir,
        //     'mydata'      => $my_pembsiswa,
        //     'tgl'         => $tgl,
        // );
        $tampil_thnakad = $this->configfunction->getthnakd();
        $thnakad = $tampil_thnakad[0]['THNAKAD'];
        $data = array(
            'ThnAkademik'         => $thnakad,
        );


        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Rekap-Pembayaran.pdf";
        $this->pdf->load_view('pagekasir/bayarsiswa/laporan', $data);
    }
}