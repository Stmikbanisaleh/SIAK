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
		$my_data = $this->model_guru->view('tbps')->result_array();
		$myagama = $this->model_guru->view('tbagama')->result_array();
		$mypendidikan = $this->model_guru->view('mspendidikan')->result_array();
		$data = array(
			'page_content' 	=> '/guru/index',
			'ribbon' 		=> '<li class="active">Dashboard</li><li>Master Guru</li>',
			'page_name' 	=> 'Master Guru',
			'js' 			=> 'js_file',
			'myprogram' 	=> $my_data,
			'myagama'		=> $myagama,
			'mypendidikan' 	=> $mypendidikan
		);
		$this->render_view($data); //Memanggil function render_view
	}

	public function simpan()
	{
		$data = array(
			'IdGuru'  => $this->input->post('IdGuru'),
			'GuruNoDapodik'  => $this->input->post('GuruNoDapodik'),
			'GuruNama'  => $this->input->post('nama'),
			'GuruTelp'  => $this->input->post('telepon'),
			'GuruAlamat'  => $this->input->post('alamat'),
			'GuruBase' => $this->input->post('program_sekolah'),
			// 'GuruWaktu'  => $this->input->post('alamat'),
			'GuruJeniskelamin'  => $this->input->post('jenis_kelamin'),
			'GuruPendidikanAkhir'  => $this->input->post('pendidikan_terakhir'),
			'GuruAgama'  => $this->input->post('agama'),
			'GuruEmail' => $this->input->post('email'),
			'GuruTglLahir'  => $this->input->post('tgl_lahir'),
			'GuruTempatLahir'  => $this->input->post('tempat_lahir'),
			'GuruStatus'  => $this->input->post('status'),
			'createdAt' => date('Y-m-d H:i:s')
		);
		$count_id = $this->model_guru->view_count('TBGURU', $data['IdGuru']);
		if ($count_id < 1) {
			$result = $this->model_guru->insert($data, 'TBGURU');
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
		$my_data = $this->model_guru->view_where_v2('TBGURU', $data)->result();
		echo json_encode($my_data);
	}

	public function tampil()
	{
		$my_data = $this->model_guru->view_guru('TBGURU')->result_array();
		echo json_encode($my_data);
	}

	public function update()
	{
		$data_id = array(
			'id'  => $this->input->post('e_id')
		);
		$data = array(
			'IdGuru'  => $this->input->post('e_IdGuru'),
			'GuruNoDapodik'  => $this->input->post('e_GuruNoDapodik'),
			'GuruNama'  => $this->input->post('e_nama'),
			'GuruTelp'  => $this->input->post('e_telepon'),
			'GuruAlamat'  => $this->input->post('e_alamat'),
			'GuruBase' => $this->input->post('e_program_sekolah'),
			// 'GuruWaktu'  => $this->input->post('alamat'),
			'GuruJeniskelamin'  => $this->input->post('e_jenis_kelamin'),
			'GuruPendidikanAkhir'  => $this->input->post('e_pendidikan_terakhir'),
			'GuruAgama'  => $this->input->post('e_agama'),
			'GuruEmail' => $this->input->post('e_email'),
			'GuruTglLahir'  => $this->input->post('e_tgl_lahir'),
			'GuruTempatLahir'  => $this->input->post('e_tempat_lahir'),
			'GuruStatus'  => $this->input->post('e_status'),
			'updatedAt' => date('Y-m-d H:i:s')
		);
		$action = $this->model_guru->update($data_id, $data, 'TBGURU');
		echo json_encode($action);
	}

	public function delete()
    {
        $data_id = array(
            'id'  => $this->input->post('id')
        );
        $data = array(
            'isdeleted'  => 1,
        );
		$action = $this->model_guru->update($data_id,$data,'TBGURU');
        echo json_encode($action);
        
    }
}
