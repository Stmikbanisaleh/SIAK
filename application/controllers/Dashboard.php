<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	function render_view($data)
	{
		$this->template->load('template', $data); //Display Page
	}

	public function index()
	{
		if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
			$data = array(
				'page_content' 	=> 'dashboard',
				'ribbon' 		=> '<li class="active">Dashboard</li><li>Sample</li>',
				'page_name' 	=> 'Dashboard',
			);
			$this->render_view($data); //Memanggil function render_view
		} else {
			$this->load->view('page/login'); //Memanggil function render_view
		}
	}

	public function login()
	{
		$email = $this->input->post('email');
		$password = md5($this->input->post('password'));
		$query = $this->db->query("select * from tbpengawas where username ='" . $email . "' and password = '" . $password . "'");
		if ($query->num_rows() == 1) {
			$data = $query->result_array();
			foreach ($data as $value) {
				$data = [
					'username' => $value['username'],
					'nama' => $value['nama'],
					'nip' => $value['nip'],
					'jabatan' => $value['jabatan'],
				];
			}
			$this->session->set_userdata($data);
			redirect('dashboard/index');
		} else {
			$this->session->set_flashdata('category_error', 'Email atau password salah');
			redirect('dashboard/index');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('dashboard/index');
	}
}
