<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('model_guru');
		$this->load->model('model_jabatan');
	}

	function render_view($data)
	{
		$this->template->load('template', $data); //Display Page
	}

	public function index()
	{
		$my_data = $this->model_guru->view('guru')->result_array();
		$my_jabatan = $this->model_jabatan->view('jabatan')->result_array();
		$data = array(
			'page_content' 	=> '../guru/index',
			'ribbon' 		=> '<li class="active">Dashboard</li><li>Master Guru</li>',
			'page_name' 	=> 'Master Guru',
			'js' 			=> 'js_file',
			'mydata' 		=> $my_data,
			'myjabatan' 	=> $my_jabatan,
		);
		$this->render_view($data); //Memanggil function render_view
	}

	public function simpan_guru()
	{
		$data = array(
			'nik'  => $this->input->post('nik'),
			'nama'  => $this->input->post('nama'),
			'jabatan'  => $this->input->post('jabatan'),
			'email'  => $this->input->post('email'),
			'telepon'  => $this->input->post('telepon'),
			'alamat' => $this->input->post('alamat'),
			'createdAt' => date('Y-m-d H:i:s')
		);
		$count_id = $this->model_guru->view_count('guru', $data['nik']);
		if ($count_id < 1) {
			$result = $this->model_guru->insert($data, 'guru');
			if ($result) {
				echo $result;
			} else {
				echo 'insert gagal';
			}
		} else {
			echo json_encode(401);
		}
	}

	public function tampil_byid()
	{
		$data = array(
			'id'  => $this->input->post('id'),
		);
		$my_data = $this->model_guru->view_where('guru', $data)->result();
		echo json_encode($my_data);
	}

	public function tampil_guru()
	{
		$my_data = $this->model_guru->view('guru')->result_array();
		echo json_encode($my_data);
	}

	public function update_guru()
	{
		$data_id = array(
			'id'  => $this->input->post('e_id')
		);
		$data = array(
			'nama'  => $this->input->post('e_nama'),
			'email'  => $this->input->post('e_email'),
			'alamat'  => $this->input->post('e_alamat'),
			'telepon'  => $this->input->post('e_telepon'),
			'nik'  => $this->input->post('e_nik'),
		);
		$action = $this->model_guru->update($data_id, $data, 'guru');
		echo json_encode($action);
	}

	public function delete_guru()
    {
        $data_id = array(
            'id'  => $this->input->post('id')
        );
        $data = array(
            'isdeleted'  => 1,
        );
		$action = $this->model_guru->update($data_id,$data,'guru');
        echo json_encode($action);
        
    }
}
