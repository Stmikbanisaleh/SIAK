<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kehadiranpengganti extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('model_kehadiranpengganti');
        $this->load->model('model_kehadiranguru');
        if (empty($this->session->userdata('username')) && empty($this->session->userdata('nama'))) {
            $this->session->set_flashdata('category_error', 'Silahkan masukan username dan password');
            redirect('dashboard/login');
        }
    }

    function render_view($data)
    {
        $this->template->load('template', $data); //Display Page
    }

    public function index()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
            $myguru = $this->model_kehadiranguru->viewOrdering('tbguru', 'id', 'asc')->result_array();
            $myjadwal = $this->model_kehadiranpengganti->view_jadwal()->result_array();
            
            $data = array(
                'page_content'  => 'kehadiranpengganti/view',
                'ribbon'        => '<li class="active">Kehadiran Pengganti Hari</li>',
                'page_name'     => 'Kehadiran Pengganti',
                'myguru'        => $myguru,
                'myjadwal'      => $myjadwal
            );
            $this->render_view($data); //Memanggil function render_view
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }
    
    public function tampil()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
            $my_data = $this->model_kehadiranpengganti->view_kehadiranpengganti()->result();
            echo json_encode($my_data);
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }

    public function tampil_byid()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
            $data = array(
                'id'  => $this->input->post('id'),
            );
            $my_data = $this->model_kehadiranpengganti->view_where('trdsrm', $data)->result();
            echo json_encode($my_data);
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }

    public function simpan()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
                $data = array(
                    'idJadwal'  => $this->input->post('id_jadwal'),
                    'IdGuru'  => $this->input->post('nama'),
                    'TGLHADIR'  => $this->input->post('tanggal_awal'),
                    'ASALTGL'  => $this->input->post('tanggal_awal'),
                    'STINVAL'  => 1,
                    'GANTIHARI'  => $this->input->post('tanggal_akhir'),
                );
                $action = $this->model_kehadiranpengganti->insert($data, 'trdsrm');
                echo json_encode($action);
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }

    public function update()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
            $data_id = array(
                'ID'  => $this->input->post('e_id')
            );
            $data = array(
                'idJadwal'  => $this->input->post('e_id_jadwal'),
                'IdGuru'  => $this->input->post('e_nama'),
                'TGLHADIR'  => $this->input->post('e_tanggal_awal'),
                'ASALTGL'  => $this->input->post('e_tanggal_awal'),
                'GANTIHARI'  => $this->input->post('e_tanggal_akhir'),
            );
            $action = $this->model_kehadiranpengganti->update($data_id, $data, 'trdsrm');
            echo json_encode($action);
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }

    public function delete()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
            $data_id = array(
                'ID'  => $this->input->post('id')
            );
            $action = $this->model_kehadiranpengganti->delete($data_id, 'trdsrm');
            echo json_encode($action);
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }
}
