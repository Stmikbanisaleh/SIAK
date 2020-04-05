<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_bayarsiswa extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('akunting/model_laporan');
        $this->load->library('mainfunction');
        if (empty($this->session->userdata('kodekaryawan')) && empty($this->session->userdata('nama'))) {
            $this->session->set_flashdata('category_error', 'Silahkan masukan username dan password');
            redirect('modulkasir/dashboard/login');
        }
    }

	function render_view($data) {
        $this->template->load('templatekasir', $data); //Display Page
    }

	public function index() {
        $data = array(
        			'page_content' 	=> '../pagekasir/lap_bayarsiswa/view',
        			'ribbon' 		=> '<li class="active">Laporan Pembayaran Siswa</li>',
					'page_name' 	=> 'Laporan Pembayaran Siswa',
        		);
        $this->render_view($data); //Memanggil function render_view
    }

    public function laporan_pdf(){
        $this->load->library('pdf');
        $tgl = $this->mainfunction->tgl_indo(date('Y-m-d'));
        $periode_awal = $this->input->post('periode_awal');
        $periode_akhir = $this->input->post('periode_akhir');  
        $my_pembsiswa = $this->model_laporan->get_pemb_siswa($periode_awal, $periode_akhir)->result_array();
        // print_r($this->db->last_query());exit;
        // print_r(json_encode($my_pembsiswa));exit;
        $data = array(
            'v_awal'      => $periode_awal,
            'v_akhir'     => $periode_akhir,
            'mydata'      => $my_pembsiswa,
            'tgl'         => $tgl,
        );
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Laporan-pembayaran.pdf";
        $this->pdf->load_view('pagekasir/lap_bayarsiswa/laporan', $data);
    }

        function format_bulan($bulan){
        $v_awal = '';
        switch ($bulan) {
            case 1:
            $v_awal = "Januari";
            break;
            case 2:
            $v_awal = "Februari";
            break;
            case 3:
            $v_awal = "Maret";
            break;
            case 4:
            $v_awal = "April";
            break;
            case 5:
            $v_awal = "Mei";
            break;
            case 6:
            $v_awal = "Juni";
            break;
            case 7:
            $v_awal = "Juli";
            break;
            case 8:
            $v_awal = "Agustus";
            break;
            case 9:
            $v_awal = "September";
            break;
            case 10:
            $v_awal = "Oktober";
            break;
            case 11:
            $v_awal = "November";
            break;
            case 12:
            $v_awal = "Desember";
            break;
        }
        return $v_awal;
    }
}