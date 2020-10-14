<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tarif_guru extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('payroll/model_tarifguru');
	}

	function render_view($data)
	{
		$this->template->load('templatepayroll', $data); //Display Page
	}

	public function index()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$my_pembayaran = $this->model_tarifguru->view('jnspembayaran')->result_array();
			$my_guru = $this->model_tarifguru->viewOrdering('tbguru', 'GuruNama', 'asc')->result_array();
			$data = array(
				'page_content' 	=> '../pagepayroll/tarifguru/view',
				'ribbon' 		=> '<li class="active">Master Tarif Guru</li>',
				'page_name' 	=> 'Master Tarif Guru',
				'js' 			=> 'js_file',
				'my_pembayaran' => $my_pembayaran,
				'my_guru'		=> $my_guru
			);
			$this->render_view($data); //Memanggil function render_view
		} else {
			$this->load->view('pagepayroll/login'); //Memanggil function render_vieww
		}
	}

	public function honor_berkala()
	{
        $idkaryawan = $this->input->post('id');
        $datakaryawan = $this->model_tarifguru->getmasakerja($idkaryawan)->result_array();
        if($datakaryawan){
            $masakerja = $datakaryawan[0]['masakerja'];
            $honor = $this->model_tarifguru->gethonor($masakerja)->result_array();
		    echo $honor[0]['honor_berkala'];
        }
	}

	public function tampil()
	{
		$my_data = $this->model_tarifguru->view_guru()->result_array();
		echo json_encode($my_data);
	}

	public function simpan()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$datatarif = array(
				'IdGuru' => $this->input->post('guru'),
				'tarif'  => $this->input->post('tarif_guru_v'),
				'cara_pembayaran'  => $this->input->post('nama_pembayaran'),
				'no_rekening' => $this->input->post('no_rekening'),
				'transport' => $this->input->post('transport_v'),
				'convert' => $this->input->post('convert_v'),
				'tunjangan_bpjs' => $this->input->post('tunjangan_bpjs_v'),
				'tunjangan_masakerja' => $this->input->post('tunjangan_masa_kerja_v'),
				'tunjangan_jabatan' => $this->input->post('tunjangan_jabatan_v'),
				'tunjangan_keluarga' => $this->input->post('tunjangan_keluarga_v'),
				'tunjangan_pegawai_tetap' => $this->input->post('tunjangan_pegawai_tetap_v'),
				'tunjangan_aksel' => $this->input->post('tunjangan_aksel_v'),
				'tunjangan_internasional' => $this->input->post('tunjangan_internasional_v'),
				'createdAt' => date('Y-m-d H:i:s')
			);

			$count_id = $this->model_tarifguru->view_count('IdGuru', 'tarifguru', $datatarif['IdGuru']);
			if ($count_id < 1) {
				$result = $this->model_tarifguru->insert($datatarif, 'tarifguru');
				if ($result) {
					echo $result;
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
			'tarif'  => $this->input->post('e_tarif_guru_v'),
			'cara_pembayaran'  => $this->input->post('e_nama_pembayaran'),
			'no_rekening' => $this->input->post('e_no_rekening'),
			'transport' => $this->input->post('e_transport_v'),
			'convert' => $this->input->post('e_convert_v'),
			'tunjangan_bpjs' => $this->input->post('e_tunjangan_bpjs_v'),
			'tunjangan_masakerja' => $this->input->post('e_tunjangan_masa_kerja_v'),
			'tunjangan_jabatan' => $this->input->post('e_tunjangan_jabatan_v'),
			'tunjangan_keluarga' => $this->input->post('e_tunjangan_keluarga_v'),
			'tunjangan_pegawai_tetap' => $this->input->post('e_tunjangan_pegawai_tetap_v'),
			'tunjangan_aksel' => $this->input->post('e_tunjangan_aksel_v'),
			'tunjangan_internasional' => $this->input->post('e_tunjangan_internasional_v'),
			'updatedAt' => date('Y-m-d H:i:s')
		);
		$action = $this->model_tarifguru->update($data_id, $data, 'tarifguru');
		echo json_encode($action);
	}

	public function tampil_byid()
    {
        if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {

            $data = array(
                'id'  => $this->input->post('id'),
            );
            $my_data = $this->model_tarifguru->view_where('tarifguru', $data)->result();
            echo json_encode($my_data);
        } else {
            $this->load->view('pagepayroll/login'); //Memanggil function render_view
        }
	}

	public function delete()
	{
		$data_id = array(
			'id'  => $this->input->post('id')
		);
		$action = $this->model_tarifguru->delete($data_id, 'tarifguru');
		if ($action) {
			echo json_encode($action);
		}
	}
}
