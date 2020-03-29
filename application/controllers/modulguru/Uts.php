<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Uts extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('guru/model_uts');
    }

    function render_view($data)
    {
        $this->template->load('templateguru', $data); //Display Page

    }

    public function index()
    {
        $session = $this->session->userdata('idguru');
        $nodapodik = $this->model_uts->views($session)->result_array();
        $mypelajaran = $this->model_uts->getmapel($session)->result_array();

        $data = array(
            'page_content'     => '../pageguru/uts/view',
            'ribbon'         => '<li class="active">Nilai Uts</li><li>Sample</li>',
            'page_name'     => 'Nilai Uts',
            'mypelajaran'     => $mypelajaran,
            'guru'  => $nodapodik
        );
        $this->render_view($data); //Memanggil function render_view
    }

    public function tampil_byid()
    {
        $data = array(
            'id'  => $this->input->post('id'),
        );
        $my_data = $this->model_uts->view_where_v2('tbguru', $data)->result();
        echo json_encode($my_data);
    }

    public function tampil()
    {
        $my_data = $this->model_uts->view_guru('tbguru')->result_array();
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
        $action = $this->model_uts->update($data_id, $data, 'tbguru');
        echo json_encode($action);
    }

    public function search()
	{
			$mapel = $this->input->post('mapel');
            $result = $this->model_uts->getuts($mapel)->result();
			echo json_encode($result);
	}
}
