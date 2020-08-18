<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_pembayaran extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('payroll/model_jnspembayaran');
	}

	function render_view($data)
	{
		$this->template->load('templatepayroll', $data); //Display Page
	}

	public function index()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$data = array(
				'page_content' 	=> '../pagepayroll/jenis_pembayaran/view',
				'ribbon' 		=> '<li class="active">Dashboard</li><li>Master Jenis Pembayaran</li>',
				'page_name' 	=> 'Master Jenis Pembayaran',
				'js' 			=> 'js_file',
			);
			$this->render_view($data); //Memanggil function render_view
		} else {
			$this->load->view('pagepayroll/login'); //Redirect login
		}
	}

	public function tampil()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$my_data = $this->model_jnspembayaran->view('jnspembayaran')->result_array();
			echo json_encode($my_data);
		} else {
			$this->load->view('pagepayroll/login'); //Redirect login
		}
	}

	public function tampil_byid()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$data = array(
				'id'  => $this->input->post('id'),
			);
			$my_data = $this->model_jnspembayaran->view_where('jnspembayaran', $data)->result();
			echo json_encode($my_data);
		} else {
			$this->load->view('pagepayroll/login'); //Redirect login
		}
	}


	public function simpan()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$data = array(
				'nama_pembayaran'  => $this->input->post('nama_pembayaran'),
				'createdAt' => date('Y-m-d H:i:s')
			);
			$count_id = $this->model_jnspembayaran->view_count('nama_pembayaran', 'jnspembayaran', $data['nama_pembayaran']);
			if ($count_id < 1) {
				$result = $this->model_jnspembayaran->insert($data, 'jnspembayaran');
				if ($result) {
					echo $result;
				} else {
					echo 'insert gagal';
				}
			} else {
				echo json_encode(401);
			}
		} else {
			$this->load->view('pagepayroll/login'); //Redirect login
		}
	}

	public function update()
	{
		$data_id = array(
			'id'  => $this->input->post('e_id')
		);
		$data = array(
			'nama_pembayaran'  => $this->input->post('e_nama_pembayaran'),
		);

		$count_id = $this->model_jnspembayaran->view_count('nama_pembayaran', 'jnspembayaran', $data['nama_pembayaran']);
		if ($count_id < 1) {
			$action = $this->model_jnspembayaran->update($data_id, $data, 'jnspembayaran');
			if ($action) {
				echo $action;
			} else {
				echo 'insert gagal';
			}
		} else {
			echo json_encode(401);
		}
	}

	public function delete()
	{
		$data_id = array(
			'id'  => $this->input->post('id')
		);
		$action = $this->model_jnspembayaran->delete($data_id, 'jnspembayaran');
		if ($action) {
			echo json_encode($action);
		}
	}
}
