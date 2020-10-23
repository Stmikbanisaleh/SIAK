<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bayarlain extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('kasir/model_bayar');
		$this->load->library('Configfunction');
		if (empty($this->session->userdata('kodekaryawan')) && empty($this->session->userdata('namakasir'))) {
            $this->session->set_flashdata('category_error', 'Silahkan masukan username dan password');
            redirect('modulkasir/dashboard/login');
        }
	}
	
	function render_view($data) {
        $this->template->load('templatekasir', $data); //Display Page
    }

	public function index() {
		$this->load->library("Configfunction");
		$mysiswa = $this->model_bayar->view('mssiswa')->result_array();
		$mykelas = $this->model_bayar->view('tbkelas')->result_array();
		$ta = $this->configfunction->getthnakd();
        $data = array(
        			'page_content' 	=> '../pagekasir/bayarlain/view',
        			'ribbon' 		=> '<li class="active">Pembayaran Lain-Lain</li>',
					'page_name' 	=> 'Pembayaran Lain-Lain',
					'mysiswa'		=> $mysiswa,
					'ta'			=> $ta[0]['THNAKAD'],
					'mykelas'		=> $mykelas
        		);
        $this->render_view($data); //Memanggil function render_view
	}
	
	public function search()
    {
		$noreg = $this->input->post('nik');
		$result = $this->model_bayar->getsiswa1($noreg)->result();
        echo json_encode($result);
	}

	public function showsiswa()
    {
		$this->load->library("Configfunction");
		$noreg = $this->input->post('nik');
		$ta = $this->configfunction->getthnakd();
		$getssiswa = $this->model_bayar->getsiswa($noreg)->result_array();
		$siswa = $getssiswa;
		$siswa = $siswa[0]['PS'];
		$result = $this->model_bayar->getsiswa2($ta[0]['THNAKAD'],$siswa)->result_array();
		echo "<option value='0'>--Pilih Data --</option>";
        foreach ($result as $value) {
            echo "<option value='" . $value['idtarif'] . "'> [T.MASUK - ".$value['TA']."]  - [TA - ".$value['tea']."]  - [".$value['namajenisbayar']."] - [".$value['Nominal2']."] </option>";
        }
	}

	public function showsiswa2()
    {
		
		$noreg = $this->input->post('nik');
		$result = $this->model_bayar->getsiswa($noreg)->result_array();
		if(count($result) > 0){
			echo json_encode($result[0]['NMSISWA']);
		}
	}

	public function simpan()
    {
		$nis= $this->input->post('nik2');
		$ket= $this->input->post('ket');
		$kelas= $this->input->post('kelas');
		$ThnAkademik = $this->input->post('thnakad');
		$getkelas = $this->db->query("SELECT *
		FROM mssiswa WHERE NOINDUK='$nis' OR Noreg='$nis'")->result_array();
		$kdsekolah = $getkelas[0]['PS'];
		if($kdsekolah){
			$gettarif = $this->db->query("SELECT * FROM tarif_berlaku WHERE `status`='T' AND idtarif ='$ket'
			 AND kodesekolah='$kdsekolah' AND TA='$ThnAkademik'")->result_array();
			 if(!empty($gettarif)){
				$data = array(
					'NIS'  => $nis,
					'Noreg'  => $getkelas[0]['NOREG'],
					'Kelas'  => $kelas,
					'tglentri'  => date('Y-m-d'),
					'useridd'  => $this->session->userdata('kodekaryawan'),
					'TotalBayar'  => $this->input->post('nominal_v'),
					'kodesekolah'  => $getkelas[0]['PS'],
					'TA'  => $this->input->post('thnakad'),
					'createdAt' => date('Y-m-d H:i:s'),
				);
				$action = $this->model_bayar->insert($data, 'pembayaran_sekolah');
				$id = $this->db->insert_id();

				$data2 = array(
					'Nopembayaran' => $id,
					'kodejnsbayar' => $gettarif[0]['Kodejnsbayar'],
					'idtarif'	=>	$gettarif[0]['idtarif'],
					'nominalbayar' => $this->input->post('nominal_v')
				);
				$action = $this->model_bayar->insert($data2, 'detail_bayar_sekolah');
				echo json_encode($action);
			}else{
				echo json_encode(500);
			}
		}else{
			echo json_encode(500);
		}
	}
	
	public function cetak(){
        $this->load->library('pdf');
        $tampil_thnakad = $this->configfunction->getthnakd();
        $thnakad = $tampil_thnakad[0]['THNAKAD'];
		$myconfig = $this->model_bayar->view('sys_config')->row();
        $data = array(
            'ThnAkademik'         => $thnakad,
			'myconfig'		=> $myconfig
		);

        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "Rekap-Pembayaran.pdf";
        $this->pdf->load_view('pagekasir/bayarlain/laporan', $data);
    }


}
