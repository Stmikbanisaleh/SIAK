<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('kasir/model_dashboard');
    }

    function render_view($data)
    {
        $this->template->load('templatekasir', $data); //Display Page
    }

    public function index()
    {
        if ($this->session->userdata('kodekaryawan') != null && $this->session->userdata('nama') != null) {
            $data = array(
                'page_content'     => 'dashboard',
                'ribbon'         => '<li class="active">Dashboard</li>',
                'page_name'     => 'Dashboard',
            );
            $this->render_view($data); //Memanggil function render_view
        } else {
            $this->load->view('pagekasir/login'); //Memanggil function render_view
        }
    }

    public function login()
    {
        $useriid = $this->input->post('useriid');
        $password = md5($this->input->post('password'));
        $password = hash("sha512", $password);
        $query = $this->db->query("select * from user_login where Useriid ='" . $useriid . "' and Passwordd = '" . $password . "'");
        if ($query->num_rows() == 1) {
            $data = $query->result_array();
            foreach ($data as $value) {
                $data = [
                    'kodekaryawan' => $value['Useriid'],
                    'nama' => $value['admin'],
                ];
            }
            $this->session->set_userdata($data);
            redirect('modulkasir/dashboard/index');
        } else {
            $this->session->set_flashdata('category_error', 'User ID atau password salah');
            redirect('modulkasir/dashboard/index');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('modulkasir/dashboard/index');
    }
}
