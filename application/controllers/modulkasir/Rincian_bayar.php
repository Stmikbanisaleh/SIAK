<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rincian_bayar extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('kasir/Model_rincianbayar');
        $this->load->library('mainfunction');
        $this->load->library('Configfunction');
        if (empty($this->session->userdata('kodekaryawan')) && empty($this->session->userdata('namakasir'))) {
            $this->session->set_flashdata('category_error', 'Silahkan masukan username dan password');
            redirect('modulkasir/dashboard/login');
        }
    }

    function render_view($data) {
        $this->template->load('templatekasir', $data); //Display Page
    }

    public function index() {
        $my_siswa = $this->Model_rincianbayar->view('mssiswa')->result_array();
        $my_kelas = $this->Model_rincianbayar->view('tbkelas')->result_array();
        $my_tahun = $this->Model_rincianbayar->gettahun('tbakadmk2')->result_array();
        $data = array(
         'page_content' 	=> '../pagekasir/rincian_bayar/view',
         'ribbon' 		=> '<li class="active">Pembayaran Siswa</li>',
         'page_name' 	=> 'Pembayaran Siswa',
         'my_siswa'      => $my_siswa,
         'my_kelas'     => $my_kelas,
         'my_tahun'     => $my_tahun
     );
        $this->render_view($data); //Memanggil function render_view
    }

    public function laporan_pdf(){
        $tgl = $this->mainfunction->tgl_indo(date('Y-m-d'));
        $this->load->library('pdf');
        $explode = explode('-', $this->input->post('siswa'));
        $nis = $explode[0];
        $nama = $explode[1];
        $where = array(
            'NOINDUK' => $nis
        );
        $getsiswa = $this->Model_rincianbayar->view_where('mssiswa', $where)->row();

        $where = array(
            'KDTBPS' => $getsiswa->PS
        );
        $sekolah = $this->Model_rincianbayar->view_where('tbps', $where)->row();

        $where = array(
            'id_kelas' => $this->input->post('kelas')
        );
        $kelas = $this->Model_rincianbayar->view_where('tbkelas', $where)->row();

        $rincian_bayar = $this->Model_rincianbayar->getrincianbayar($nis, $getsiswa->PS, $this->input->post('kelas'), $this->input->post('th_akad'))->result_array();
        $data = array(
                'myrincian'         => $rincian_bayar,
                'nama'              => $getsiswa->NMSISWA,
                'sekolah'           => $sekolah->SINGKTBPS,
                'kelas'             => $kelas->nama,
                'tgl'               => $tgl,
                'ta'                => $this->input->post('th_akad')
            );


        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Rekap-Pembayaran.pdf";
        $this->pdf->load_view('pagekasir/rincian_bayar/laporan', $data);
        // $this->load->view('pagekasir/rincian_bayar/laporan', $data);
    }
}