<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengembalianformulir extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('model_pengembalianformulir');
    }

    function render_view($data)
    {
        $this->template->load('template', $data); //Display Page
    }

    public function index()
    {
        $this->load->library('Configfunction');
        $tampil_thnakad = $this->configfunction->getthnakd();
        $mysekolah = $this->model_pengembalianformulir->getsekolah($tampil_thnakad[0]['THNAKAD'])->result_array();
        $data = array(
            'page_content'     => 'pengembalianformulir/view',
            'ribbon'         => '<li class="active">Dashboard</li><li>Master Pengembalian Formulir</li>',
            'page_name'     => 'Master Pengembalian Formulir',
            'js'             => 'js_file',
            'mysekolah'     => $mysekolah
        );
        $this->render_view($data); //Memanggil function render_view
    }

    public function simpan()
    {
        $tahun = date("Y");
        $idtarifq = $this->model_pengembalianformulir->getidtarif($this->input->post('sekolah'))->result_array();
        $data = array(
            'Noreg'  => $this->input->post('noreg'),
            'tglentri'  => date('Y-m-d H:i:s'),
            'useridd'  => $this->session->userdata('nip'),
            'TotalBayar'  => $this->input->post('nominal'),
            'kodesekolah'  => $this->input->post('sekolah'),
            'TA' => $this->input->post('tahunakademik'),
            'createdAt' => date('Y-m-d H:i:s')
        );
        $insert = $this->model_pengembalianformulir->insert($data, 'pembayaran_sekolah');
        $id_result = $this->db->insert_id();
        if ($insert) {
            $data_detail = array(
                'Nopembayaran' => $id_result,
                'kodejnsbayar' => 'FRM',
                'idtarif'      => $idtarifq[0]['idtarif'],
                'nominalbayar' => $this->input->post('nominal')
            );
            $insert_detail = $this->model_pengembalianformulir->insert($data_detail, 'detail_bayar_sekolah');
            if ($insert_detail) {
                $data_calon = array(
                    'Noreg' => $this->input->post('noreg'),
                    'Namacasis' => strtoupper($this->input->post('nama')),
                    'thnmasuk' => $tahun,
                    'tglentri' => date('Y-m-d H:i:s'),
                    'userentri' => $this->session->userdata('kodekaryawan')
                );
                $insertcalon = $this->model_pengembalianformulir->insert($data_calon, 'calon_siswa');
                echo json_encode($insertcalon);
            }
        }
    }

    public function tampil_byid()
    {
        $data = array(
            'id'  => $this->input->post('id'),
        );
        $my_data = $this->model_pengembalianformulir->view_where('jenjang', $data)->result();
        echo json_encode($my_data);
    }

    public function tampil()
    {
        $this->load->library('Configfunction');
        $tampil_thnakad = $this->configfunction->getthnakd();
        $my_data = $this->model_pengembalianformulir->getdata($tampil_thnakad[0]['THNAKAD'])->result_array();
        echo json_encode($my_data);
    }

    public function update_jenjang()
    {
        $data_id = array(
            'id'  => $this->input->post('e_id')
        );
        $data = array(
            'jenjang'  => $this->input->post('e_jenjang'),
        );
        $action = $this->model_pengembalianformulir->update($data_id, $data, 'jenjang');
        echo json_encode($action);
    }

    public function delete()
    {
        $data_id = array(
            'Noreg'  => $this->input->post('id')
        );
        $nopembayaran = $this->model_pengembalianformulir->getnopembayaran($data_id['Noreg'], 'pembayaran_sekolah')->result_array();
        if ($nopembayaran) {
            $deletedetail = $this->model_pengembalianformulir->deletedetail($nopembayaran[0]['Nopembayaran']);
            if ($deletedetail) {
                $deletpembayaran = $this->model_pengembalianformulir->deletepembayaransekolah($data_id['Noreg']);
                if ($deletpembayaran) {
                    $deletecalon = $this->model_pengembalianformulir->deletecalonsiswa($data_id['Noreg']);
                    echo json_encode($deletecalon);
                }
            }
        }
    }
}
