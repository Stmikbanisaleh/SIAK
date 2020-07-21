<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_potongan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('payroll/model_mastpotongan');
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			// continue;
		} else {
			$this->load->view('pagepayroll/login'); //Redirect login
		}
	}

	function render_view($data)
	{
		$this->template->load('templatepayroll', $data); //Display Page
	}

	public function index()
	{
		$mykaryawan = $this->model_mastpotongan->view('biodata_karyawan')->result_array();
		$data = array(
			'page_content' 	=> '../pagepayroll/master_potongan/view',
			'ribbon' 		=> '<li class="active">Master Potongan Karyawan</li>',
			'page_name' 	=> 'Master Potongan Karyawan',
			'js' 			=> 'js_file',
			'mykaryawan'		=> $mykaryawan
		);
		$this->render_view($data);
	}

	public function tampil()
	{
		$my_data = $this->model_mastpotongan->view_potongan()->result_array();
		echo json_encode($my_data);
	}

	public function simpan()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$data = array(
				'id_karyawan'  => $this->input->post('id_karyawan'),
				'infaq_masjid'  => $this->input->post('infaq_masjid_v'),
				'anggota_koperasi'  => $this->input->post('anggota_koperasi_v'),
				'kas_bon' => $this->input->post('kas_bon_v'),
				'ijin_telat' => $this->input->post('ijin_telat_v'),
				'koperasi' => $this->input->post('koperasi_v'),
				'bmt' => $this->input->post('bmt_v'),
				'inval'  => $this->input->post('inval_v'),
				'toko' => $this->input->post('toko_v'),
				'lain' => $this->input->post('lain_v'),
				'tawun'  => $this->input->post('tawun_v'),
				'ltq'  => $this->input->post('ltq_v'),
				'bpjs'  => $this->input->post('bpjs_v'),
				'pph21'  => $this->input->post('pph21_v'),
				'periode'  => $this->input->post('periode'),
				'createdAt' => date('Y-m-d H:i:s')
			);
			
			$hasil = $this->model_mastpotongan->cek_karyawan($this->input->post('id_karyawan'), $this->input->post('periode'))->num_rows();
			if($hasil>0){
				echo 401;
			}else{
				$result = $this->model_mastpotongan->insert($data, 'tbkaryawanpot');
				if ($result) {
					echo $result;
				} 
			}
			
		} else {
			$this->load->view('pagepayroll/login'); //Redirect login
		}
	}

	public function tampil_byid()
    {
        if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {

            $data = array(
                'id_potong'  => $this->input->post('id'),
            );
            $my_data = $this->model_mastpotongan->view_where('tbkaryawanpot', $data)->result();
            echo json_encode($my_data);
        } else {
            $this->load->view('pagekasir/login'); //Memanggil function render_view
        }
	}
	
	public function update()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$data = array(
				'id_potong'  => $this->input->post('e_id_potong'),
			);
			$dataupdate = array(
				'infaq_masjid'  => $this->input->post('e_infaq_masjid_v'),
				'anggota_koperasi'  => $this->input->post('e_anggota_koperasi_v'),
				'kas_bon'  => $this->input->post('e_kas_bon_v'),
				'ijin_telat'  => $this->input->post('e_ijin_telat_v'),
				'bmt'  => $this->input->post('e_bmt_v'),
				'koperasi'  => $this->input->post('e_koperasi_v'),
				'inval'  => $this->input->post('e_inval_v'),
				'tawun' => $this->input->post('e_tawun_v'),
				'toko'  => $this->input->post('e_toko_v'),
				'lain'  => $this->input->post('e_lain_v'),
				'pph21'  => $this->input->post('e_pph21_v'),
				'bpjs'  => $this->input->post('e_bpjs_v'),
				'ltq'  => $this->input->post('e_ltq_v'),
				'periode'  => $this->input->post('e_periode'),
			);

			$my_data = $this->model_mastpotongan->update($data,$dataupdate,'tbkaryawanpot');
			echo json_encode($my_data);
		} else {
			$this->load->view('pagepayroll/login'); //Redirect login
		}
	}

	public function delete()
    {
        $data_id = array(
            'id_potong'  => $this->input->post('id')
		);
		$action = $this->model_mastpotongan->delete($data_id, 'tbkaryawanpot');
		if($action){
			echo json_encode($action);
		}
	}
}
