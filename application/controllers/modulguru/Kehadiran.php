<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kehadiran extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('guru/model_kehadiran');
        if ($this->session->userdata('username_guru') != null && $this->session->userdata('idguru') != null) {
        } else {
            $this->load->view('pageguru/login'); //Memanggil function render_view
        }
    }

    function render_view($data)
    {
        $this->template->load('templateguru', $data); //Display Page

    }

    public function index()
    {
        $data = array(
            'page_content'     => '../pageguru/kehadiran/view',
            'ribbon'         => '<li class="active">Isi Kehadiran</li>',
            'page_name'     => 'Isi Materi & Kehadiran',
        );
        $this->render_view($data); //Memanggil function render_view
    }


    public function simpan()
    {
        $data = array(
            'idJadwal'  => $this->input->post('e_id'),
            'TGLHADIR' => date('Y-m-d H:i:s'),
            'IdGuru' => $this->session->userdata('idguru'),
            'WKTHADIR' => 1,
            'MSKHADIR' => date('Y-m-d H:i:s'),

        );
        $result = $this->model_kehadiran->insert($data, 'trdsrm');
        if ($result) {
            echo $result;
        } else {
            echo 'insert gagal';
        }
    }

    public function tampil()
    {
        $idguru = $this->session->userdata('idguru');
        $my_data = $this->model_kehadiran->view_jadwal($idguru)->result_array();
        echo json_encode($my_data);
    }

    public function tampil_byidselesai()
    {
        $idguru = $this->session->userdata('idguru');
        $my_data = $this->model_kehadiran->view_jadwal($idguru)->result_array();
        echo json_encode($my_data);
    }

    public function update()
    {
        $data_id = array(
            'id'  => $this->input->post('e_id')
        );
        $data = array(
            'IdGuru'  => $this->input->post('e_IdGuru'),
            'GuruNoDapodik'  => $this->input->post('e_GuruNoDapodik'),
            'GuruNama'  => $this->input->post('e_nama'),
            'GuruTelp'  => $this->input->post('e_telepon'),
            'GuruAlamat'  => $this->input->post('e_alamat'),
            'GuruBase' => $this->input->post('e_program_sekolah'),
            // 'GuruWaktu'  => $this->input->post('alamat'),
            'GuruJeniskelamin'  => $this->input->post('e_jenis_kelamin'),
            'GuruPendidikanAkhir'  => $this->input->post('e_pendidikan_terakhir'),
            'GuruAgama'  => $this->input->post('e_agama'),
            'GuruEmail' => $this->input->post('e_email'),
            'GuruTglLahir'  => $this->input->post('e_tgl_lahir'),
            'GuruTempatLahir'  => $this->input->post('e_tempat_lahir'),
            'GuruStatus'  => $this->input->post('e_status'),
            'updatedAt' => date('Y-m-d H:i:s')
        );
        $action = $this->model_jadwal->update($data_id, $data, 'tbguru');
        echo json_encode($action);
    }

    public function search()
    {
        $tahun = $this->input->post('tahun');
        $programsekolah = $this->input->post('programsekolah');
        $result = $this->model_jadwal->getjadwal($tahun, $programsekolah)->result();
        echo json_encode($result);
    }
}
