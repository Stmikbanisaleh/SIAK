<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Biodata extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('guru/model_biodata');
        $this->load->model('model_jabatan');
    }

    function render_view($data)
    {
        $this->template->load('templateguru', $data); //Display Page
    }

    public function index()
    {
        $my_data = $this->model_biodata->view('tbps')->result_array();
        $myagama = $this->model_biodata->view('tbagama')->result_array();
        $mypendidikan = $this->model_biodata->view('mspendidikan')->result_array();
        $data = array(
            'page_content'     => '../pageguru/biodata/view',
            'ribbon'         => '<li class="active">Biodata Guru</li><li>Sample</li>',
            'page_name'     => 'Biodata Guru',
            'myprogram'     => $my_data,
            'myagama'        => $myagama,
            'mypendidikan'     => $mypendidikan
        );
        $this->render_view($data); //Memanggil function render_view
    }

    public function tampil_byid()
    {
        $data = array(
            'id'  => $this->input->post('id'),
        );
        $my_data = $this->model_biodata->view_where_v2('TBGURU', $data)->result();
        echo json_encode($my_data);
    }

    public function tampil()
    {
        $my_data = $this->model_biodata->view_guru('TBGURU')->result_array();
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
        $action = $this->model_biodata->update($data_id, $data, 'TBGURU');
        echo json_encode($action);
    }
}
