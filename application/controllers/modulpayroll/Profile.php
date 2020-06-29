<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('payroll/model_profile');
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			// continue;
		} else {
			$this->load->view('pagepayroll/login'); //Redirect login
		}
	}

	function render_view($data)
	{
		$this->template->load('templatepayroll', $data); //Display Page
	}

	public function index()
	{
        $where = array('
        nip' => $this->session->userdata('nip'));
        $mydata = $this->model_profile->viewWhereOrdering('tbpengawas', $where, 'nip', 'asc')->result_array();
		$data = array(
			'page_content' 	=> '../pagepayroll/profile/view',
			'ribbon' 		=> '<li class="active">Profile</li>',
			'page_name' 	=> 'Profile',
			'js' 			=> 'js_file',
			'mykaryawan'		=> $mydata
		);
		$this->render_view($data);
	}


    public function edit()
    {
        if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
            $where = array('
			nip' => $this->session->userdata('nip'));
            $mydata = $this->model_profile->viewWhereOrdering('tbpengawas', $where, 'nip', 'asc')->result_array();
            $data = array(
                'page_content'     => '../pagepayroll/profile/editprofile',
                'ribbon'         => '<li class="active">Dashboard</li><li>Edit Profile</li>',
                'page_name'     => 'Edit Profile',
                'js'             => 'js_file',
                'mydata'        => $mydata,
            );
            $this->render_view($data);
        } else {
            $this->load->view('pagekasir/login'); //Memanggil function render_view
        }
    }
	
	public function update()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$data = array(
				'nip'  => $this->input->post('e_id'),
			);
			$dataupdate = array(
				'nama'  => $this->input->post('nama'),
				'email'  => $this->input->post('email'),
				'telp'  => $this->input->post('telp'),
				'alamat'  => $this->input->post('alamat'),
			);

			$my_data = $this->model_profile->update($data,$dataupdate,'tbpengawas');
			echo json_encode($my_data);
		} else {
			$this->load->view('pagepayroll/login'); //Redirect login
		}
	}
}
