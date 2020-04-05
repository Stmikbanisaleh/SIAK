<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tunggakan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('kasir/model_tunggakan');
		if (empty($this->session->userdata('kodekaryawan')) && empty($this->session->userdata('nama'))) {
            $this->session->set_flashdata('category_error', 'Silahkan masukan username dan password');
            redirect('modulkasir/dashboard/login');
        }
	}

	function render_view($data)
	{
		$this->template->load('templatekasir', $data); //Display Page
	}

	public function index()
	{
		if ($this->session->userdata('kodekaryawan') != null && $this->session->userdata('nama') != null) {

			$data = array(
				'page_content' 	=> '../pagekasir/tunggakan/view',
				'ribbon' 		=> '<li class="active">Tunggakan</li><li>Sample</li>',
				'page_name' 	=> 'Tunggakan',
			);
			$this->render_view($data); //Memanggil function render_view
		} else {
		}
	}

	public function tampil()
	{
		if ($this->session->userdata('kodekaryawan') != null && $this->session->userdata('nama') != null) {
			$this->load->library('Configfunction');
			$IdTA = $this->configfunction->getidta();
			$IdTA = $IdTA[0]['ID'];
			$my_data = $this->db->query("SELECT
			saldopembayaran_sekolah.idsaldo,NIS,
			saldopembayaran_sekolah.Noreg,
			(SELECT z.Namacasis FROM calon_siswa z WHERE z.Noreg=saldopembayaran_sekolah.Noreg) AS Namacasis,
			saldopembayaran_sekolah.TotalTagihan,CONCAT('Rp. ',FORMAT(saldopembayaran_sekolah.TotalTagihan,2)) as totaltagihan2,
			saldopembayaran_sekolah.Bayar,CONCAT('Rp. ',FORMAT(saldopembayaran_sekolah.Bayar,2)) as bayar2,
			saldopembayaran_sekolah.Sisa,CONCAT('Rp. ',FORMAT(saldopembayaran_sekolah.Sisa,2)) as sisa2,
			(TA)as tas,
			(SELECT z.THNAKAD FROM tbakadmk z WHERE z.ID=saldopembayaran_sekolah.TA)AS TA
			FROM saldopembayaran_sekolah
			WHERE TA= " . $IdTA . "
			Order by Noreg desc")->result_array();
			echo json_encode($my_data);
		} else {
			$this->load->view('pagekasir/login'); //Memanggil function render_view
		}
	}

	public function generate()
	{
		if ($this->session->userdata('kodekaryawan') != null && $this->session->userdata('nama') != null) {
			$this->load->library('Configfunction');
			$IdTA = $this->configfunction->getidta();
			$idtea = $IdTA[0]['ID'];
			$thnakademik = $IdTA[0]['THNAKAD'];
			$calonsiswa = $this->db->query("SELECT * FROM calon_siswa WHERE Noreg NOT IN(SELECT saldopembayaran_sekolah.Noreg
			FROM saldopembayaran_sekolah) AND kodesekolah IS NOT NULL AND thnmasuk IS NOT NULL ORDER BY kodesekolah,Noreg")->result_array();
			if ($calonsiswa) {
				foreach ($calonsiswa as $value) {
					$tarif = $this->db->query("SELECT
					SUM(tarif_berlaku.Nominal)AS total
					FROM tarif_berlaku
					WHERE kodesekolah='$value[kodesekolah]' AND `status`='T' AND ThnMasuk='$value[thnmasuk]' AND Kodejnsbayar IN('SRG','SPP','KGT','GDG')");
					$n = $tarif->num_rows();
					if ($tarif) {
						$v = $tarif->result_array();
						$vtotal = $v[0]['total'];
						$naikkelas = $this->db->query("SELECT
						baginaikkelas.idbagiNaikKelas,
						baginaikkelas.Thnmasuk,
						baginaikkelas.Ruangan,
						baginaikkelas.Kelas,
						baginaikkelas.Naikkelas,
						baginaikkelas.Jurusan,
						baginaikkelas.Kodesekolah,
						baginaikkelas.TA,
						baginaikkelas.tglentri,
						baginaikkelas.userentri,
						baginaikkelas.NIS
						FROM baginaikkelas
						JOIN mssiswa ON baginaikkelas.NIS = mssiswa.NOINDUK
						WHERE baginaikkelas.TA='" . $thnakademik . "'  AND mssiswa.Noreg= $value[Noreg]");
						if ($naikkelas) {
							$kelas = $naikkelas->result_array();
							$vkelas = $kelas[0]['Kelas'];
							$vnis = $kelas[0]['NIS'];
							if ($vkelas == '') {
								if ($value['kodesekolah'] == '01') {
									$t_kelas = 1;
								} else {
									$t_kelas = 4;
								}
							} else {
								$t_kelas = $vkelas;
							}
							$data = array(
								'NIS' => $vnis,
								'Noreg' => $value['Noreg'],
								'TotalTagihan' => $vtotal,
								'TA' => $idtea,
								'Kelas' => $t_kelas,
								'createdAt' => date('Y-m-d H:i:s')
							);
							$insert = $this->model_tunggakan->insert($data, 'saldopembayaran_sekolah');
						}
					}
				}
			}
		} else {
			$this->load->view('pagekasir/login'); //Memanggil function render_view
		}
	}
}
