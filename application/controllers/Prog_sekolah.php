<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prog_sekolah extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('model_tahun_akademik');
    }

    function render_view($data)
    {
        $this->template->load('template', $data); //Display Page

    }

    public function index()
    {
        $data = array(
            'page_content'  => 'prog_sekolah/view',
            'ribbon'        => '<li class="active">Program Sekolah</li>',
            'page_name'     => 'Program Sekolah'
        );
        $this->render_view($data); //Memanggil function render_view
    }

    public function tampil()
    {
        $my_data = $this->model_tahun_akademik->viewOrdering('tbps', 'kdtbps', 'asc')->result();
        echo json_encode($my_data);
    }

    public function tampil_byid()
    {
        $data = array(
            'KDTBPS'  => $this->input->post('id'),
        );
        $my_data = $this->model_tahun_akademik->view_where('tbps', $data)->result();
        echo json_encode($my_data);
    }

    public function update()
    {
        $data_id = array(
            'KDTBPS'  => $this->input->post('e_id')
        );
        $data = array(
            'DESCRTBPS'  => $this->input->post('e_deskripsi'),
            'SINGKTBPS'  => $this->input->post('e_singkatan'),
            'updatedAt' => date('Y-m-d H:i:s'),
        );

        $action = $this->model_tahun_akademik->update($data_id, $data, 'tbps');
        echo json_encode($action);
    }
 
}
