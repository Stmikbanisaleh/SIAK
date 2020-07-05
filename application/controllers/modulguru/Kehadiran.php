<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kehadiran extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('guru/model_kehadiran');
        $this->load->library('Configfunction');
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
        $date = date("Y-m-d");
        $idguru = $this->session->userdata('idguru');
        $idjadwal = $this->input->post('e_id');
        $cek = $this->db->query("select count(ID) as total from trdsrm  where IdJadwal ='" . $idjadwal . "' and IdGuru = '" . $idguru . "' and DATE(TGLHADIR) = '".$date."'")->result_array();
        if ($cek[0]['total'] == 0 ) {
            $data = array(
                'idJadwal'  => $this->input->post('e_id'),
                'TGLHADIR' => date('Y-m-d H:i:s'),
                'IdGuru' => $this->session->userdata('idguru'),
                'WKTHADIR' => 1,
                'MSKHADIR' => date('Y-m-d H:i:s'),

            );
            $result = $this->model_kehadiran->insert($data, 'trdsrm');
            echo json_encode($result);
        } else {
            $result = 0;
            echo json_encode($result);

        }
    }

    public function tampil()
    {
        $date = date("Y-m-d");
        $hari = $this->configfunction->gethari($date);
        $idguru = $this->session->userdata('idguru');
        $my_data = $this->model_kehadiran->view_jadwal($idguru, $hari)->result_array();
        echo json_encode($my_data);
    }

    public function tampil_byidbahasan()
    {
        $idguru = $this->session->userdata('idguru');
        $id = $this->input->post('id');
        $my_data = $this->model_kehadiran->view_bahasan($idguru, $id)->result_array();
        echo json_encode($my_data);
    }

    public function tampil_byidrincian()
    {
        $idguru = $this->session->userdata('idguru');
        $id = $this->input->post('id');
        $my_data = $this->model_kehadiran->view_rincian($idguru, $id)->result_array();
        echo json_encode($my_data);
    }

    public function tampil_byidselesai()
    {
        $id = $this->input->post('id');
        $my_data = $this->model_kehadiran->view_jadwal2($id)->result_array();
        echo json_encode($my_data);
    }

    public function tampil_byidstart()
    {
        $id = $this->input->post('id');
        $my_data = $this->model_kehadiran->view_jadwal2($id)->result_array();
        echo json_encode($my_data);
    }

    public function selesai()
    {
        $idguru = $this->session->userdata('idguru');
        $data_id = array(
            'ID'  => $this->input->post('e_id2')
        );
        $date =  $this->db->query("Select MAX(TGLHADIR) as tglh FROM trdsrm where IdGuru ='" . $idguru . "' and IdJadwal ='" . $data_id['ID'] . "'")->result_array();
        $ID = $this->db->query("Select ID from trdsrm where TGLHADIR = '" . $date[0]['tglh'] . "' ")->result_array();
        $data_id = array(
            'ID'  => $ID[0]['ID']
        );
        $data = array(
            'SLSHADIR'  => date('Y-m-d H:i:s'),
            'PKBAHASAN'  => $this->input->post('pkbahasan'),
            'RINCIAN'  => $this->input->post('rincian'),
        );
        $action = $this->model_kehadiran->update($data_id, $data, 'trdsrm');
        echo json_encode($action);
    }
}
