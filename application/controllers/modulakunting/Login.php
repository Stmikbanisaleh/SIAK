<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	function __construct()
    {
        parent::__construct();
        $this->load->model('akunting/model_login');
    }

	function render_view($data)
    {
        $this->template->load('templateakunting', $data); //Display Page
    }

	public function index()
	{
			$this->load->view('pageakunting/login');
	}

	public function proses_login()
	{
		$data = array(
            'Useriid'  => $this->input->post('email'),
            'Passwordd'  => md5($this->input->post('password'))
        );
        $my_data = $this->model_login->view_where('user_login', $data);
		if ($my_data->num_rows() == 1) {
			$data = $my_data->result_array();
			foreach ($data as $value) {
				$data = [
					'username' => $value['Useriid'],
					'level' => $value['admin'],
				];
			}
			$this->session->set_userdata($data);
			redirect('modulakunting/dashboard');
		} else {
			$this->session->set_flashdata('category_error', 'User ID atau password salah');
			redirect('modulakunting/login');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('modulakunting/login');
	}

}
