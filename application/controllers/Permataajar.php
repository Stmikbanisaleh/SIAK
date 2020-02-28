<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Permataajar extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('model_permataajar');
	}

	function render_view($data)
	{
		$this->template->load('template', $data); //Display Page
	}

	public function index()
	{
		if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {

			$mytahun = $this->model_permataajar->gettahun()->result_array();
			$mysemester = $this->model_permataajar->getsemester()->result_array();
			$myps = $this->model_permataajar->getps()->result_array();

			$data = array(
				'page_content' 	=> '/permataajar/view',
				'ribbon' 		=> '<li class="active">Dashboard</li><li>Data Permataajar</li>',
				'page_name' 	=> 'Data Permataajar',
				'js' 			=> 'js_file',
				'mytahun'		=> $mytahun,
				'mysemester'	=> $mysemester,
				'myps'			=> $myps
			);
			$this->render_view($data);
		} else {
			$this->load->view('page/login'); //Memanggil function render_view
		}
	}

	public function search()
	{
		if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {

			$tahun = $this->input->post('tahun');
			$semester = $this->input->post('semester');
			$programsekolah = $this->input->post('programsekolah');
			$result = $this->model_permataajar->getpermataajar($tahun, $semester, $programsekolah)->result();
			echo json_encode($result);
		} else {
			$this->load->view('page/login'); //Memanggil function render_view
		}
	}
	public function simpan()
	{
		if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {

			$config['upload_path']          = './assets/gambar';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['encrypt_name'] = TRUE;

			$this->load->library('upload', $config);
			if ($this->upload->do_upload("file")) {
				$data = array('upload_data' => $this->upload->data());
				$foto = $data['upload_data']['file_name'];
				$data = array(
					'nip'  => $this->input->post('nip'),
					'nama'  => $this->input->post('nama'),
					'jabatan'  => $this->input->post('jabatan'),
					'username'  => $this->input->post('email'),
					'password'  => $this->input->post('password'),
					'level' => $this->input->post('level'),
					'status'  => 1,
					'gambar'  => $foto,
					'createdAt' => date('Y-m-d H:i:s')
				);
				$result = $this->model_karyawan->insert($data, 'TBPENGAWAS');
				echo json_decode($result);
			} else {
				$data = array(
					'nip'  => $this->input->post('nip'),
					'nama'  => $this->input->post('nama'),
					'jabatan'  => $this->input->post('jabatan'),
					'username'  => $this->input->post('email'),
					'password'  => $this->input->post('password'),
					'level' => $this->input->post('level'),
					'status'  => 1,
					'gambar'  => null,
					'createdAt' => date('Y-m-d H:i:s')
				);
				$result = $this->model_karyawan->insert($data, 'TBPENGAWAS');
				echo json_decode($result);
			}
		} else {
			$this->load->view('page/login'); //Memanggil function render_view
		}
	}

	public function tampil_byid()
	{
		if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {

			$data = array(
				'id_pengawas'  => $this->input->post('id'),
			);
			$my_data = $this->model_karyawan->view_where('TBPENGAWAS', $data)->result();
			echo json_encode($my_data);
		} else {
			$this->load->view('page/login'); //Memanggil function render_view
		}
	}

	public function tampil()
	{
		if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {

			$my_data = $this->model_karyawan->view_karyawan()->result_array();
			echo json_encode($my_data);
		} else {
			$this->load->view('page/login'); //Memanggil function render_view
		}
	}

	public function update()
	{
		if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {

			$data_id = array(
				'id'  => $this->input->post('e_id')
			);
			$config['upload_path']          = './assets/gambar';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['encrypt_name'] = TRUE;

			$this->load->library('upload', $config);
			if ($this->upload->do_upload("e_file")) {
				$data = array('upload_data' => $this->upload->data());
				$foto = $data['upload_data']['file_name'];
				$data = array(
					'nip'  => $this->input->post('nip'),
					'nama'  => $this->input->post('nama'),
					'jabatan'  => $this->input->post('jabatan'),
					'username'  => $this->input->post('email'),
					'password'  => $this->input->post('password'),
					'level' => $this->input->post('level'),
					'status'  => 1,
					'gambar'  => $foto,
					'createdAt' => date('Y-m-d H:i:s')
				);
				$result = $this->model_karyawan->update($data_id, $data, 'TBPENGAWAS');
				echo json_decode($result);
			} else {
				$data = array(
					'nip'  => $this->input->post('e_nip'),
					'nama'  => $this->input->post('e_nama'),
					'jabatan'  => $this->input->post('e_jabatan'),
					'username'  => $this->input->post('e_email'),
					'password'  => $this->input->post('e_password'),
					'level' => $this->input->post('e_level'),
					'status'  => $this->input->post('e_status'),
					'gambar'  => null,
					'createdAt' => date('Y-m-d H:i:s')
				);
				$result = $this->model_karyawan->update($data_id, $data, 'TBPENGAWAS');
				echo json_decode($result);
			}
			echo json_encode($result);
		} else {
			$this->load->view('page/login'); //Memanggil function render_view
		}
	}

	public function delete()
	{
		if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {

			$data_id = array(
				'id_pengawas'  => $this->input->post('id')
			);
			$data = array(
				'isdeleted'  => 1,
			);
			$action = $this->model_karyawan->update($data_id, $data, 'TBPENGAWAS');
			echo json_encode($action);
		} else {
			$this->load->view('page/login'); //Memanggil function render_view
		}
	}
}
