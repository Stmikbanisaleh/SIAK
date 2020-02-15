<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('model_jadwal');

    }

    function render_view($data)
    {
        $this->template->load('template', $data); //Display Page

    }

    public function index()
    {
        $myguru = $this->model_jadwal->viewOrdering('tbguru', 'id', 'asc')->result_array();
        $myhari = $this->model_jadwal->viewOrdering('tbhari', 'id', 'asc')->result_array();
        $mytahun = $this->model_jadwal->viewOrdering('tbakadmk', 'id', 'asc')->result_array();
        $myps = $this->model_jadwal->viewOrdering('tbps', 'KDTBPS', 'asc')->result_array();
        $myruang = $this->model_jadwal->viewOrdering('msruang', 'ID', 'asc')->result_array();
        $data = array(
            'page_content'  => 'jadwal/view',
            'ribbon'        => '<li class="active">Master Jadwal</li>',
            'page_name'     => 'Master Jadwal',
            'mytahun'        => $mytahun,
            'myps'            => $myps,
            'myguru'        => $myguru,
            'myhari'        => $myhari,
            'myruang'        => $myruang,
        );
        $this->render_view($data); //Memanggil function render_view
    }

    public function tampil()
    {
        $my_data = '';
        echo json_encode($my_data);
    }

    public function tampil_byid()
    {
        $data = array(
            'id'  => $this->input->post('id'),
        );
        $my_data = $this->model_jadwal->view_where('tbjadwal', $data)->result();
        echo json_encode($my_data);
    }

    public function simpan()
    {
        $this->load->library('Configfunction');
        $tampil_thnakad = $this->configfunction->getthnakd();
        $data = array(
            'ps'  => $this->input->post('programsekolah'),
            'id_guru'  => $this->input->post('guru'),
            'id_mapel'  => $this->input->post('mapel'),
            'id_ruang'  => $this->input->post('ruang'),
            'id_guru'  => $this->input->post('guru'),
            'periode'  => 
            'createdAt' => date('Y-m-d H:i:s'),
        );
        $action = $this->model_jadwal->insert($data, 'tbjadwal');
        echo json_encode($action);
    }

    public function update()
    {
        $data_id = array(
            'id'  => $this->input->post('e_id')
        );
        $data = array(
            'nama'  => $this->input->post('e_nama'),
            'updatedAt' => date('Y-m-d H:i:s'),
        );
        $action = $this->model_jadwal->update($data_id, $data, 'tbjadwal');
        echo json_encode($action);
    }

    public function delete()
    {
        $data_id = array(
            'id'  => $this->input->post('id')
        );
        $data = array(
            'isdeleted'  => 1,
        );
        $action = $this->model_jadwal->update($data_id, $data, 'tbjadwal');
        echo json_encode($action);
    }
}
