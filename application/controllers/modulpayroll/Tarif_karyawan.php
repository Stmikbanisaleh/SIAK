<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tarif_karyawan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('payroll/model_tarif_karyawan');
		$this->load->model('payroll/model_karyawan');
	}

	function render_view($data)
	{
		$this->template->load('templatepayroll', $data); //Display Page
	}

	public function index()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$my_pembayaran = $this->model_tarif_karyawan->view('jnspembayaran')->result_array();
			$my_guru = $this->model_tarif_karyawan->viewOrdering('biodata_karyawan','nama' ,'asc')->result_array();
			$data = array(
				'page_content' 	=> '../pagepayroll/tarif_karyawan/view',
				'ribbon' 		=> '<li class="active">Master Tarif Karyawan</li>',
				'page_name' 	=> 'Master Tarif Karyawan',
				'js' 			=> 'js_file',
				'my_pembayaran' => $my_pembayaran,
				'my_karyawan'		=> $my_guru
			);
			$this->render_view($data); //Memanggil function render_view
		} else {
			$this->load->view('pagepayroll/login'); //Memanggil function render_view
		}
	}
    
	public function tampil()
	{
		$my_data = $this->model_tarif_karyawan->view_karyawan()->result_array();
		echo json_encode($my_data);
	}

    public function honor_berkala()
	{
        $idkaryawan = $this->input->post('id');
        $datakaryawan = $this->model_tarif_karyawan->getmasakerja($idkaryawan)->result_array();
        if($datakaryawan){
            $masakerja = $datakaryawan[0]['masakerja'];
            $honor = $this->model_tarif_karyawan->gethonor($masakerja)->result_array();
		    echo $honor[0]['honor_berkala'];
        }
	}

	public function convert()
	{
        $idkaryawan = $this->input->post('id');
        $datakaryawan = $this->model_tarif_karyawan->getmasakerja($idkaryawan)->result_array();
        if($datakaryawan){
			$masakerja = $datakaryawan[0]['masakerja'];
			if($masakerja >= 10){
				$honor = $this->model_tarif_karyawan->gethonor($masakerja)->result_array();
				$convert = $honor[0]['honor_berkala'] / 2;
			} else {
				$convert = 0;
			}
		    echo $convert;
        }
	}

	public function gethonorjam($id)
	{
		$pendidikan = $this->model_tarif_karyawan->getpendidikan($id)->result_array();
		$datakaryawan = $this->model_tarif_karyawan->getjenjang($pendidikan[0]['pendidikan'])->result_array();
        $jabatan = $this->model_tarif_karyawan->getjabatanjam($id)->result_array();
        if($datakaryawan){
			$nominal = $datakaryawan[0]['nominal'];
			$jabatan = $jabatan[0]['jumlah_jam'];
			if($nominal > 0){
				$convert = (int)$nominal * (int)$jabatan;
			} else {
				$convert = 0;
			}
		    return $convert;
        }
	}


	public function tampil_byidtarif()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$data = array(
				'id'  => $this->input->post('id'),
			);
			$my_data = $this->model_tarif_karyawan->view_where('tarifkaryawan',$data)->result();
			echo json_encode($my_data);
		} else {
			$this->load->view('pagepayroll/login'); //Redirect login
		}
	}
	
	public function simpan()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$honor = $this->input->post('tarif_karyawan_v');
			$convert = $this->input->post('convert_v');
			$hc = (int)$honor + (int)$convert;
			$idkaryawan = $this->input->post('karyawan');
			$honorjam = $this->gethonorjam($idkaryawan);
			$datatarif = array(
				'id_karyawan' => $idkaryawan,
				'tunjangan_masakerja' => $hc,
				'tunjangan_jabatan'  => $this->input->post('tunjangan_jabatan_v'),
				'convert' => $this->input->post('convert_v'),
				'tarif'  => $this->input->post('tarif_karyawan_v'),
				'honor'  => $honorjam,
				'cara_pembayaran'  => $this->input->post('nama_pembayaran'),
				'transport'  => $this->input->post('transport_v'),
				'tunj_pegawai_tetap'  => $this->input->post('tunj_pegawai_tetap_v'),
				'tunj_keluarga'  => $this->input->post('tunj_keluarga_v'),
				'tunj_pembinaan'  => $this->input->post('tunj_pembinaan_v'),
				'bpjs'  => $this->input->post('bpjs_v'),
				'no_rekening' => $this->input->post('no_rekening'),
				'createdAt' => date('Y-m-d H:i:s')
			);

			$hasil = $this->model_tarif_karyawan->view_where('tarifkaryawan',['id_karyawan' => $this->input->post('karyawan')])->num_rows();
			if($hasil>0){
				echo 401;
			}else{
				$result = $this->model_tarif_karyawan->insert($datatarif, 'tarifkaryawan');
				if ($result) {
					echo $result;
				} 
			}
		} else {
			$this->load->view('pagepayroll/login'); //Redirect login
		}
	}

	public function updatetarif()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$data = array(
				'id_karyawan'  => $this->input->post('e_karyawan'),
			);

			$dataupdate = array(
				'tarif'  => $this->input->post('e_tarif_karyawan_v'),
				'tunjangan_jabatan'  => $this->input->post('e_tunjangan_jabatan_v'),
				'tunjangan_masakerja'  => $this->input->post('e_tunjangan_masa_kerja_v'),
				'transport'  => $this->input->post('e_transport_v'),
				'convert'  => $this->input->post('e_convert'),
				'cara_pembayaran'  => $this->input->post('e_nama_pembayaran'),
				'tunj_pegawai_tetap'  => $this->input->post('e_tunj_pegawai_tetap_v'),
				'tunj_keluarga'  => $this->input->post('e_tunj_keluarga_v'),
				'tunj_pembinaan'  => $this->input->post('e_tunj_pembinaan_v'),
				'bpjs'  => $this->input->post('e_bpjs_v'),
				'no_rekening'  => $this->input->post('e_no_rekening'),
			);
			$my_data = $this->model_tarif_karyawan->update($data,$dataupdate,'tarifkaryawan');
			echo json_encode($my_data);
		} else {
			$this->load->view('pagepayroll/login'); //Redirect login
		}
	}

	public function delete()
    {
        $data_id = array(
            'id'  => $this->input->post('id')
        );
        $action = $this->model_tarifguru->delete($data_id, 'tarifguru');
        if($action){
            echo json_encode($action);
        }
    }
}
