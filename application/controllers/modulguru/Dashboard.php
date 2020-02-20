<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('guru/model_dashboard');
	}

	function render_view($data)
	{
		$this->template->load('templateguru', $data); //Display Page
	}

	public function index()
	{
		if ($this->session->userdata('username_guru') != null && $this->session->userdata('idguru') != null) {
			$my_data = $this->model_dashboard->view_visi('visimisi')->result_array();
			$my_data1 = $this->model_dashboard->view_misi('visimisi')->result_array();
			$data = array(
				'page_content' 	=> 'dashboard',
				'ribbon' 		=> '<li class="active">Dashboard</li><li>Sample</li>',
				'page_name' 	=> 'Dashboard',
				'myvisimisi'     => $my_data,
				'mymisi'     => $my_data1,
			);
			$this->render_view($data); //Memanggil function render_view
		} else {
			$this->load->view('pageguru/login'); //Memanggil function render_view
		}
	}

	public function login()
	{
		$email = $this->input->post('email');
		$password = md5($this->input->post('password'));
		$query = $this->db->query("select count(IdGuru) as jml,nama,email,photos,IdGuru from guru where IdGuru='" . $email . "' and password like '" . $password . "' GROUP BY nama,email,photos,IdGuru");
		if ($query->num_rows() == 1) {
			$data = $query->result_array();
			foreach ($data as $value) {
				$data = [
					'username_guru' => $value['nama'],
					'email' => $value['email'],
					'idguru' => $value['IdGuru'],
				];
			}
			$this->session->set_userdata($data);
			redirect('modulguru/dashboard/index');
		} else {
			$this->session->set_flashdata('category_error', 'Email atau password salah');
			redirect('modulguru/dashboard/index');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('modulguru/dashboard/index');
	}
}
