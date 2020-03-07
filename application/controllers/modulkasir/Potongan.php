<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Potongan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('kasir/model_potongan');
	}

	function render_view($data)
	{
		$this->template->load('templatekasir', $data); //Display Page
	}

	public function index()
	{
		if ($this->session->userdata('kodekaryawan') != null && $this->session->userdata('nama') != null) {

			$mysiswa = $this->model_potongan->viewOrdering('mssiswa', 'ID', 'asc')->result_array();
			$mykelas = $this->model_potongan->viewOrdering('tbkelas', 'id_kelas', 'asc')->result_array();
			$data = array(
				'page_content' 	=> '../pagekasir/potongan/view',
				'ribbon' 		=> '<li class="active">Potongan</li><li>Sample</li>',
				'page_name' 	=> 'Potongan',
				'mysiswa'		=> $mysiswa,
				'mykelas'		=> $mykelas,
			);
			$this->render_view($data); //Memanggil function render_view
		} else {
			$this->load->view('pagekasir/login'); //Memanggil function render_view
		}
	}

	public function tampil()
	{
		if ($this->session->userdata('kodekaryawan') != null && $this->session->userdata('nama') != null) {

			$my_data = $this->db->query("SELECT sd.*, ss.NMSISWA, jk.nama as Kelass ,
			CONCAT('Rp. ',FORMAT(sd.pot_spp,2)) as pot_spp2,
			CONCAT('Rp. ',FORMAT(sd.pot_gdg,2)) as pot_gdg2,
			CONCAT('Rp. ',FORMAT(sd.pot_modul,2)) as pot_modul2,
			CONCAT('Rp. ',FORMAT(sd.pot_kgt,2)) as pot_kgt2
			FROM saldopembayaran_sekolah sd
			JOIN mssiswa ss ON sd.NIS = ss.NOINDUK
			JOIN tbkelas jk ON sd.Kelas = jk.id_kelas
			WHERE sd.pot_spp > 0 OR sd.pot_gdg > 0 OR sd.pot_modul > 0 OR sd.pot_kgt > 0 and sd.isdeleted != 1")->result_array();
			echo json_encode($my_data);
		} else {
			$this->load->view('pagekasir/login'); //Memanggil function render_view
		}
	}

	public function simpan()
	{
		if ($this->session->userdata('kodekaryawan') != null && $this->session->userdata('nama') != null) {
			$where = array(
				'NIS'	=> $this->input->post('nama'),
				'Kelas' => $this->input->post('kelas')
			);
			$data = array(
				'pot_spp'  => $this->input->post('potonganspp_v'),
				'pot_gdg'  => $this->input->post('potongangedung_v'),
				'pot_modul'  => $this->input->post('potonganmodul_v'),
				'pot_kgt'  => $this->input->post('potongankegiatan_v'),
				'updatedAt' => date('Y-m-d H:i:s')
			);
			$count = $this->db->query("select * from saldopembayaran_sekolah where NIS ='" . $where['NIS'] . "' and Kelas = " . $where['Kelas'] ." and isdeleted != 1")->num_rows();
			if (($count) > 0) {
				$result = $this->model_potongan->update($where, $data, 'saldopembayaran_sekolah');
				echo $result;
			} else {
				$result = 0;
				echo $result;
			}
		} else {
			$this->load->view('pagekasir/login'); //Memanggil function render_view
		}
	}

	public function update()
	{
		if ($this->session->userdata('kodekaryawan') != null && $this->session->userdata('nama') != null) {

			$data_id = array(
				'idsaldo'  => $this->input->post('e_id')
			);
			$data = array(
				'pot_spp'  => $this->input->post('e_potonganspp_v'),
				'pot_kgt'  => $this->input->post('e_potongankegiatan_v'),
				'pot_modul'  => $this->input->post('e_potonganmodul_v'),
				'pot_gdg'  => $this->input->post('e_potongangedung_v'),
				'updatedAt' => date('Y-m-d H:i:s')
			);
			$action = $this->model_potongan->update($data_id, $data, 'saldopembayaran_sekolah');
			echo json_encode($action);
		} else {
			$this->load->view('page/login'); //Memanggil function render_view
		}
	}

	public function tampil_byid()
	{
		if ($this->session->userdata('kodekaryawan') != null && $this->session->userdata('nama') != null) {
			$data = array(
				'idsaldo'  => $this->input->post('id'),
			);
			$my_data = $this->model_potongan->view_where('saldopembayaran_sekolah', $data)->result();
			echo json_encode($my_data);
		} else {
			$this->load->view('pagekasir/login'); //Memanggil function render_view
		}
	}

	public function delete()
	{
		if ($this->session->userdata('kodekaryawan') != null && $this->session->userdata('nama') != null) {
			$data_id = array(
				'idpot'  => $this->input->post('id')
			);
			$data = array(
				'isdeleted'  => 1,
			);
			$action = $this->model_potongan->update($data_id, $data, 'tbpot');
			echo json_encode($action);
		} else {
			$this->load->view('pagekasir/login'); //Memanggil function render_view
		}
	}
}
