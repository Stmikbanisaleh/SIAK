<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelulusan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('model_kelulusan');
	}

	function render_view($data)
	{
		$this->template->load('template', $data); //Display Page
	}

	public function index()
	{
		$mythnakad = $this->model_kelulusan->getthnakad()->result_array();
		$mysemester = $this->model_kelulusan->getsemester()->result_array();
		$myps = $this->model_kelulusan->get_sekjur()->result_array();
		$data = array(
			'page_content' 	=> 'kelulusan/view',
			'ribbon' 		=> '<li class="active">Dashboard</li><li>Kelulusan Siswa</li>',
			'page_name' 	=> 'Kelulusan Siswa',
			'js' 			=> 'js_file',
			'mythnakad'	=> $mythnakad,
			'myps'			=> $myps,
			'mysemester'	=> $mysemester
		);
		$this->render_view($data);
	}

	public function simpan()
	{
		$data = array(
			'NISRKP'  => $this->input->post('kode'),
			'THNAKDRKP'  => $this->input->post('tahun'),
			'GANGENRKP'  => $this->input->post('semester'),
			'STSRKP'  => 'L',
			'TANGGAL_KELUAR'  => $this->input->post('tanggal'),
			'createdAt' => date('Y-m-d H:i:s'),
		);
		$action = $this->model_kelulusan->insert($data, 'rkpaktvsiswa');
		echo json_encode($action);
	}

	public function tampil_byid()
	{
		$data = array(
			'id_pengawas'  => $this->input->post('id'),
		);
		$my_data = $this->model_kelulusan->view_where('tbpengawas', $data)->result();
		echo json_encode($my_data);
	}

	public function tampil()
	{
		$my_data = $this->model_kelulusan->view_karyawan()->result_array();
		echo json_encode($my_data);
	}

	public function update()
	{
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
			$result = $this->model_kelulusan->update($data_id, $data, 'tbpengawas');
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
			$result = $this->model_kelulusan->update($data_id, $data, 'tbpengawas');
			echo json_decode($result);
		}
		echo json_encode($result);
	}

	public function delete()
	{
		$data_id = array(
			'IDRKP'  => $this->input->post('id')
		);
		$data = array(
			'isdeleted'  => 1,
		);
		$action = $this->model_kelulusan->update($data_id, $data, 'rkpaktvsiswa');
		echo json_encode($action);
	}

	public function search()
	{
		$tahun = $this->input->post('tahun');
		$programsekolah = $this->input->post('programsekolah');
		$result = $this->model_kelulusan->getsearch($tahun, $programsekolah)->result();
		// echo $this->db->last_query();exit;
		echo json_encode($result);
	}

	public function lulus()
	{
		$query = $this->db->query("SELECT*FROM calon_siswa where Noreg='".$this->input->post('noreg')."'");
		$row = $query->row();

			$v_StatusCalsisw = $row->StatusCalsisw;

		if ($v_StatusCalsisw == 1) {
			$data = array(
	            'StatusCalsisw'  => 4,
	        );
	        $where = array(
	            'Noreg'  => $this->input->post('noreg'),
	        );
	        $action = $this->model_kelulusan->update($where, $data, 'calon_siswa');

	        //Update Siswa
	        $data = array(
	            'STATUSCALONSISWA'  => 4,
	        );
	        $where = array(
	            'NOREG'  => $this->input->post('noreg'),
	        );
	        $action = $this->model_kelulusan->update($where, $data, 'mssiswa');
	        echo json_encode($action);
		} else {
			$data = array(
	            'StatusCalsisw'  => 1,
	        );
	        $where = array(
	            'Noreg'  => $this->input->post('noreg'),
	        );
	        $action = $this->model_kelulusan->update($where, $data, 'calon_siswa');

	        //Update Siswa
	        $data = array(
	            'STATUSCALONSISWA'  => 1,
	        );
	        $where = array(
	            'NOREG'  => $this->input->post('noreg'),
	        );
	        $action = $this->model_kelulusan->update($where, $data, 'mssiswa');
	        echo json_encode($action);
		}
	}

	public function keluarkan()
	{
			$data = array(
	            'StatusCalsisw'  => $this->input->post('n'),
	        );
	        $where = array(
	            'Noreg'  => $this->input->post('noreg'),
	        );
	        $action = $this->model_kelulusan->update($where, $data, 'calon_siswa');

	        //Update Siswa
	        $data = array(
	            'STATUSCALONSISWA'  => $this->input->post('n'),
	        );
	        $where = array(
	            'NOREG'  => $this->input->post('noreg'),
	        );
	        $action = $this->model_kelulusan->update($where, $data, 'mssiswa');
	        echo json_encode($action);
	}
}
