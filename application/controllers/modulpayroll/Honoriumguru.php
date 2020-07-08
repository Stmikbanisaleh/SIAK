<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Honoriumguru extends CI_Controller
{

	function __construct()
	{
        parent::__construct();
        $this->load->model('payroll/model_honoriumguru');
	}

	function render_view($data)
	{
		$this->template->load('templatepayroll', $data); //Display Page
	}

	public function index()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
            $myguru = $this->model_honoriumguru->viewOrdering('tbguru','GuruNama','asc')->result_array();
			$data = array(
				'page_content' 	=> '../pagepayroll/honoriumguru/view',
				'ribbon' 		=> '<li class="active">Master Guru Tetap</li>',
				'page_name' 	=> 'Master Honor Guru ',
                'js' 			=> 'js_file',
                'myguru'        => $myguru
			);
			$this->render_view($data); //Memanggil function render_view
		} else {
			$this->load->view('pagepayroll/login'); //Memanggil function render_view
		}
    }
    
    public function tampil()
	{
        $my_data = $this->model_honoriumguru->viewhonorium()->result_array();
		echo json_encode($my_data);
    }
    
    public function simpan()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
            $idguru = $this->input->post('id_guru');
            $periode = $this->input->post('tglawal');
            $tglawal = $this->input->post('tglawal');
            $tglakhir = $this->input->post('tglakhir');
            $jmljam = $this->model_honoriumguru->getjmljam($idguru , $tglawal,$tglakhir)->result_array();
            $honor = $this->model_honoriumguru->gethonor($idguru)->result_array();
            if(empty($honor)){
                echo 401;
            } else {
                $data = array(
                    'IdGuru'  =>  $idguru,
                    'TARIF'  => $this->input->post('tarif_per_jam_v'),
                    'JMLJAM ' => $jmljam[0]['jmljam'],
                    'TGLAWAL'  => $this->input->post('tglawal'),
                    'TGLAKHIR ' => $this->input->post('tglakhir'),
                    'periode'  => $periode,
                    'HONOR'  => $honor[0]['tarif'],
                    'TAMBAHANJAM'  => $this->input->post('tambahanjam_v'),
                    'TAMBAHANHADIR'  => $this->input->post('tambahanhadir_v'),
                );
                $result = $this->model_honoriumguru->insert($data, 'htguru');
                if ($result) {
                    echo $result;
                } 
            }
		} else {
			$this->load->view('pagepayroll/login'); //Redirect login
		}
    }
    
    public function delete()
    {
        $data_id = array(
            'IDRD'  => $this->input->post('id')
		);
        $action = $this->model_honoriumguru->delete($data_id, 'htguru');
		if($action){
			echo json_encode($action);
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
				'periode'  => $this->input->post('e_periode'),
			);

			$my_data = $this->model_mastpotongan->update($data,$dataupdate,'tbkaryawanpot');
			echo json_encode($my_data);
		} else {
			$this->load->view('pagepayroll/login'); //Redirect login
		}
	}

}
