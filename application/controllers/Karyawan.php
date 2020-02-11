<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('model_karyawan');
		$this->load->model('model_jabatan');
	}

	function render_view($data)
	{
		$this->template->load('template', $data); //Display Page
	}

	public function index()
	{
		// $my_data = $this->model_guru->view('tbps')->result_array();
		// $myagama = $this->model_guru->view('tbagama')->result_array();
		// $mypendidikan = $this->model_guru->view('mspendidikan')->result_array();
		$data = array(
			'page_content' 	=> '/karyawan/view',
			'ribbon' 		=> '<li class="active">Dashboard</li><li>Master Karyawan</li>',
			'page_name' 	=> 'Master Karyawan',
			'js' 			=> 'js_file',
			// 'myprogram' 	=> $my_data,
			// 'myagama'		=> $myagama,
			// 'mypendidikan' 	=> $mypendidikan
		);
		$this->render_view($data); //Memanggil function render_view
	}

	// function do_upload(){
    //     $config['upload_path']="./assets/gambar";
    //     $config['allowed_types']='gif|jpg|png';
    //     $config['encrypt_name'] = TRUE;
         
    //     $this->load->library('upload',$config);
    //     if($this->upload->do_upload("foto")){
    //         $data = array('upload_data' => $this->upload->data());
 
    //         $judul= $this->input->post('nik');
    //         $image= $data['upload_data']['file_name']; 
             
    //         $result= $this->model_karyawan->simpan_upload($judul,$image);
    //         echo json_decode($result);
    //     }
 
	//  }
	 
	public function simpan()
	{
		$config['upload_path']          = './assets/gambar/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 100;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;
        $this->load->library('upload',$config);
        if($this->upload->do_upload("foto")){
			$data = array('upload_data' => $this->upload->data());
			$foto = $data['upload_data']['file_name']; 
			$data = array(
				'nip'  => $this->input->post('nip'),
				'nama'  => $this->input->post('nama'),
				'jabatan'  => $this->input->post('jabatan'),
				'username'  => $this->input->post('username'),
				'password'  => $this->input->post('alamat'),
				'level' => $this->input->post('level'),
				'status'  => 1,
				'gambar'  => $foto,
				'createdAt' => date('Y-m-d H:i:s')
			);
			$result = $this->model_karyawan->insert($data, 'TBPENGAWAS');
            echo json_decode($result);
        } else {
			echo json_decode('error');
		}

		// $count_id = $this->model_karyawan->view_count('TBPENGAWAS', $data['IdGuru']);
		// if ($count_id < 1) {
		// 	$result = $this->model_karyawan->insert($data, 'TBPENGAWAS');
		// 	if ($result) {
		// 		echo $result;
		// 	} else {
		// 		echo 'insert gagal';
		// 	}
		// } else {
		// 	echo json_encode(401);
		// }
	}

	public function tampil_byid()
	{
		$data = array(
			'id'  => $this->input->post('id'),
		);
		$my_data = $this->model_karyawan->view_where_v2('TBPENGAWAS', $data)->result();
		echo json_encode($my_data);
	}

	public function tampil()
	{
		$my_data = $this->model_karyawan->view_karyawan()->result_array();
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
		$action = $this->model_karyawan->update($data_id, $data, 'TBPENGAWAS');
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
		$action = $this->model_karyawan->update($data_id,$data,'TBPENGAWAS');
        echo json_encode($action);
        
    }
}
