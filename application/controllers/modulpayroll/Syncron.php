<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Syncron extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	function render_view($data)
	{
		$this->template->load('templatepayroll', $data); //Display Page
	}

	public function index()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {

			$data = array(
				'page_content' 	=> '../pagepayroll/syncron/view',
				'ribbon' 		=> '<li class="active">Syncron</li><li>Syncron</li>',
				'page_name' 	=> 'Syncron',
				'js' 			=> 'js_file'
			);
			$this->render_view($data); //Memanggil function render_view
		} else {
			$this->load->view('pagepayroll/login'); //Memanggil function render_view
		}
	}

	public function generate()
	{
		if ($this->session->userdata('kodekaryawan') != null && $this->session->userdata('nama') != null) {
			$this->load->library('Configfunction');
			$IdTA = $this->configfunction->getidta();
			$idtea = $IdTA[0]['ID'];
			$thnakademik = $IdTA[0]['THNAKAD'];
			$thn = $IdTA[0]['TAHUN'];
			$calonsiswa = $this->db->query("SELECT NOINDUK,PS, TAHUN, NOREG FROM mssiswa WHERE TAHUN = '$thn' AND NOT EXISTS (SELECT a.Noreg
											FROM saldopembayaran_sekolah a where
											a.Noreg = mssiswa.NOREG) AND PS IS NOT NULL AND TAHUN IS NOT NULL ORDER BY PS,NOREG")->result_array();
			if (count($calonsiswa) > 0) {
				foreach ($calonsiswa as $value) {
					$tarif = $this->db->query("SELECT
					SUM(tarif_berlaku.Nominal)AS total
					FROM tarif_berlaku
					WHERE kodesekolah='$value[PS]' AND `status`='T' AND ThnMasuk='$value[TAHUN]' AND Kodejnsbayar IN('SRG','SPP','KGT','GDG')");
					$n = $tarif->num_rows();
					if ($tarif) {
						$v = $tarif->result_array();
						$vtotal = $v[0]['total'];
						$naikkelas = $this->db->query("SELECT
						baginaikkelas.Kelas,
						baginaikkelas.NIS
						FROM baginaikkelas
						JOIN mssiswa ON baginaikkelas.NIS = mssiswa.NOINDUK
						WHERE baginaikkelas.TA='" . $thnakademik . "'  AND mssiswa.NOREG= $value[NOREG]");
						if (count($naikkelas->result_array()) > 0) {
							$kelas = $naikkelas->result_array();
							$vkelas = $kelas[0]['Kelas'];
							$vnis = $kelas[0]['NIS'];
							$kdsk = "select KDSK from tbps WHERE kdtbps = '".$value['PS']."'";
							$kdsk = $this->db->query($kdsk)->row();
							$bayar = "select sum(Totalbayar) as bayar from pembayaran_sekolah join detail_bayar_sekolah on pembayaran_sekolah.Nopembayaran = detail_bayar_sekolah.Nopembayaran WHERE NIS = '".$value['NOINDUK']."' and TA= '$thnakademik' AND detail_bayar_sekolah.kodejnsbayar IN('SRG','SPP','KGT','GDG') ";
							$nominal = $this->db->query($bayar)->row();
							if($kdsk==NULL){
								$kdsk = '';
							}else{
								$kdsk = $kdsk->KDSK;
							}
							// print_r(json_encode($kdsk));exit;
							if ($vkelas == '') {
								if ($value['PS'] == '1') {
									$t_kelas = 1;
								}else if($kdsk = '2'){
									$t_kelas = 1;
								}else if($kdsk = '3'){
									$t_kelas = 7;
								}else if($kdsk = '2'){
									$t_kelas = 10;
								} else {
									$t_kelas = 0;
								}
							} else {
								$t_kelas = $vkelas;
							}
							$vsisa = $vtotal - $nominal->bayar;
							//jika ada datanya di delete lalu di insert
							$checkdata = $this->db->query("select count(*) as total from saldopembayaran_sekolah where NIS = '$vnis' ")->result_array();
							if(count($checkdata) > 0 ) {
									$this->db->query("delete from saldopembayaran_sekolah where NIS = '$vnis'");
							}
							$data = array(
								'NIS' => $vnis,
								'Noreg' => $value['NOREG'],
								'TotalTagihan' => $vtotal,
								'TA' => $idtea,
								'Bayar' => $nominal->bayar,
								'Sisa' => $vsisa,
								'Kelas' => $t_kelas,
								'createdAt' => date('Y-m-d H:i:s')
							);
							// print_r($data);
							$insert = $this->model_tunggakan->insert($data, 'saldopembayaran_sekolah');	
							
						} 
					}
				}
				echo json_encode(true);	
			} else {
				echo json_encode(false);
			}
		} else {
			$this->load->view('pagepayroll/login'); //Memanggil function render_view
		}
	}

}
