<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Generatepasswordsiswa extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('model_generate_password');
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
            $data = array(
                'page_content'     => 'generatepassword/view',
                'ribbon'         => '<li class="active">Generate Password Siswa</li>',
                'page_name'     => 'Generate Passowrd Siswa',
            );
            $this->render_view($data); //Memanggil function render_view
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }

    public function tampil()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
            $my_data = $this->model_generate_password->viewOrdering('sys_config', 'id', 'asc')->result();
            echo json_encode($my_data);
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }

    public function process()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
			$siswaList = $this->db->query("select * from mssiswa where password = '' or password is null")->result_array();
			foreach ($siswaList as $value ){
				$password = hash("sha512", md5($value['NOINDUK']));
				$this->db->query("update mssiswa set password = '" . $password . "' where NOINDUK = '" . $value['NOINDUK']. "'");
			}
            echo json_encode(true);
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }
}
