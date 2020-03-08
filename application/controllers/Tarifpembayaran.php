<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tarifpembayaran extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('model_tarif');
    }

    function render_view($data)
    {
        $this->template->load('template', $data); //Display Page
    }

    public function index()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
            $sekolah = $this->model_tarif->getsekolah()->result_array();
            $jenisbayar = $this->model_tarif->viewOrdering('jenispembayaran','Kodejnsbayar','asc')->result_array();
            $data = array(
                'page_content'  => 'tarifpembayaran/view',
                'ribbon'        => '<li class="active">Tarif Pembayaran</li>',
                'page_name'     => 'Master Tarif Pembayaran',
                'sekolah'       => $sekolah,
                'jenisbayar'    => $jenisbayar
            );
            $this->render_view($data); //Memanggil function render_view
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }

    public function tampil()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
            $my_data = $this->model_tarif->getdata()->result();
            echo json_encode($my_data);
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }

    public function tampil_byid()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
            $data = array(
                'idtarif'  => $this->input->post('id'),
            );
            $my_data = $this->model_tarif->view_where('tarif_berlaku', $data)->result();
            echo json_encode($my_data);
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }

    public function simpan()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
            $data = array(
                'kodesekolah'  => $this->input->post('sekolah'),
                'Kodejnsbayar'  => $this->input->post('kodejenis'),
                'ThnMasuk'  => $this->input->post('tahun'),
                'Nominal'  => $this->input->post('nominal_v'),
                'TA'  => $this->input->post('tahunakad'),
                'tglentri'  => date('Y-m-d H:i:s'),
                'status'  => 'T',
                'userridd'  => $this->session->userdata('nip'),
                'createdAt' => date('Y-m-d H:i:s'),
            );
            $action = $this->model_tarif->insert($data, 'tarif_berlaku');
            echo json_encode($action);
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }

    public function update()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
            $data_id = array(
                'idtarif'  => $this->input->post('e_id')
            );
            $data = array(
                'kodesekolah'  => $this->input->post('e_sekolah'),
                'Kodejnsbayar'  => $this->input->post('e_kodejenis'),
                'ThnMasuk'  => $this->input->post('e_tahun'),
                'Nominal'  => $this->input->post('e_nominal_v'),
                'TA'  => $this->input->post('e_tahunakad'),
                'status'  => $this->input->post('e_status'),
                'userridd'  => $this->session->userdata('nip'),
                'updatedAt' => date('Y-m-d H:i:s'),
            );
            $action = $this->model_tarif->update($data_id, $data, 'tarif_berlaku');
            echo json_encode($action);
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }

    public function delete()
    {
        $data_id = array(
            'idtarif'  => $this->input->post('id')
        );
        $data = array(
            'isdeleted'  => 1,
        );
        $action = $this->model_tarif->update($data_id, $data, 'tarif_berlaku');
        echo json_encode($action);
    }
}
