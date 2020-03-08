<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == NULL && $this->session->userdata('level') != 'AKUNTING') {
            redirect('modulakunting/login');
        }

        $this->load->model('akunting/model_dashboard');
    }

    function render_view($data)
    {
        $this->template->load('templateakunting', $data); //Display Page
    }

    public function index()
    {
        $data = array(
            'page_content' 	=> 'dashboard',
            'ribbon' 		=> '<li class="active">Dashboard</li><li>Sample</li>',
            'page_name' 	=> 'Dashboard',
        );
        $this->render_view($data); //Memanggil function render_view
    }
}
