<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswaperjadwal extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('model_siswaperjadwal');
		if (empty($this->session->userdata('username')) && empty($this->session->userdata('nama'))) {
            $this->session->set_flashdata('category_error', 'Silahkan masukan username dan password');
            redirect('dashboard/login');
        }
	}

	function render_view($data)
	{
		$this->template->load('template', $data); //Display Page
	}

	public function index()
	{
		$mytahun = $this->model_siswaperjadwal->gettahun()->result_array();
		$myps = $this->model_siswaperjadwal->getsekolah()->result_array();
		$data = array(
			'page_content' 	=> 'siswaperjadwal/view',
			'ribbon' 		=> '<li class="active">Dashboard</li><li>Siswa Perjadwal</li>',
			'page_name' 	=> 'Master Siswa Perjadwal',
			'js' 			=> 'js_file',
			'mytahun'		=> $mytahun,
			'myps'			=> $myps
		);
		$this->render_view($data); //Memanggil function render_view
	}

	public function tampil_byid()
	{
		$data = array(
			'id'  => $this->input->post('id'),
		);
		$my_data = $this->model_siswaperjadwal->viewWhere('jenjang', $data)->result();
		echo json_encode($my_data);
	}

	public function showjadwal()
	{
		$my_data = $this->model_siswaperjadwal->viewjadwal( $this->input->post('tahun'),$this->input->post('ps'))->result_array();
		echo "<option value='0'>--Pilih Jadwal --</option>";
        foreach ($my_data as $value) {
            echo "<option value='" . $value['id'] . "'>[" . $value['nama'] .'-'. $value['nmklstrjdk']."] </option>";
        }
	}

	public function tampil_jenjang()
	{
		$my_data = $this->model_jenjang->view('jenjang')->result_array();
		echo json_encode($my_data);
	}

	public function search()
	{
		$jadwal = $this->input->post('jadwal');
		$my_data = $this->model_siswaperjadwal->viewsiswa($jadwal)->result_array();
		echo json_encode($my_data);
	}

	public function delete()
    {
        $data_id = array(
            'id_krs'  => $this->input->post('id')
        );
       
		$action = $this->model_siswaperjadwal->delete($data_id,'tbkrs');
        echo json_encode($action);
        
    }
}
