<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('guru/model_guru');
    }

    function render_view($data)
    {
        $this->template->load('templateguru', $data); //Display Page

    }

    public function index()
    {
        $data = array(
            'page_content'     => '../pageguru/profile/view',
            'ribbon'         => '<li class="active">Profil Guru</li><li>Sample</li>',
            'page_name'     => 'Profil Guru',
        );
        $this->render_view($data); //Memanggil function render_view
    }

    public function tampil()
    {
        $my_data = $this->model_guru->viewOrdering('sys_config', 'id', 'asc')->result();
        echo json_encode($my_data);
    }

    public function tampil_byid()
    {
        $data = array(
            'id'  => $this->input->post('id'),
        );
        $my_data = $this->model_guru->view_where('sys_config', $data)->result();
        echo json_encode($my_data);
    }

    public function update()
    {
        $data_id = array(
            'id'  => $this->input->post('e_id')
        );
        $data = array(
            'apps_name'  => $this->input->post('e_appsname'),
            'address'  => $this->input->post('e_alamat'),
            'email'  => $this->input->post('e_email'),
            'name_school'  => $this->input->post('e_sekolah'),
            'url'  => $this->input->post('e_url'),
            'satker'  => $this->input->post('e_satker'),
            'facebook'  => $this->input->post('e_facebook'),
            'google'  => $this->input->post('e_google'),
            'tweeter'  => $this->input->post('e_tweeter'),
            'no_telp'  => $this->input->post('e_telp'),
            'meta_deskripsi'  => $this->input->post('e_deskripsi'),
            'meta_keyword'  => $this->input->post('e_keyword'),
            'favicon'  => $this->input->post('e_favicon'),
            'directory'  => $this->input->post('e_folder'),
            'updatedAt' => date('Y-m-d H:i:s'),
        );
        $action = $this->model_biodata->update($data_id, $data, 'sys_config');
        echo json_encode($action);
    }
}
