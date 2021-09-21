<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bayarsiswa extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('akunting/model_surattagihan');
		$this->load->model('kasir/model_bayarsiswa');
		$this->load->library('mainfunction');
		$this->load->library('Configfunction');
		if (empty($this->session->userdata('kodekaryawan')) && empty($this->session->userdata('namakasir'))) {
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
		$my_siswa = $this->model_surattagihan->view('mssiswa')->result_array();
		$my_kelas = $this->model_surattagihan->view('tbkelas')->result_array();
		$my_tahun = $this->model_surattagihan->gettahun('tbakadmk2')->result_array();
		$data = array(
			'page_content' 	=> '../pagekasir/bayarsiswa/view',
			'ribbon' 		=> '<li class="active">Pembayaran SPP</li>',
			'page_name' 	=> 'Pembayaran SPP',
			'my_siswa'      => $my_siswa,
			'my_kelas'     => $my_kelas,
			'my_tahun'     => $my_tahun
		);
		$this->render_view($data); //Memanggil function render_view
	}

	public function view_tagihan()
	{
		$thnmasuk = $this->model_bayarsiswa->getkelas($this->input->post('siswa'))->result_array();
		$thn = $thnmasuk[0]['TAHUN'];
		$thnakad = $this->input->post('thnakad');
		$siswa = $this->input->post('siswa');
		$kelas = $this->input->post('kelas');
		$result = $this->model_bayarsiswa->view_tagihan($siswa, $kelas, $thnakad, $thn)->result();
		if (count($result) > 0) {
			echo json_encode($result);
		} else {
			echo json_encode(0);
		}
	}

	public function search()
	{
		$siswa = $this->input->post('siswa');
		$kelas = $this->input->post('kelas');
		$result = $this->model_bayarsiswa->pembsis_detail($siswa, $kelas)->result();
		echo json_encode($result);
	}

	public function search_pemb_sekolah()
	{
		$siswa = $this->input->post('siswa');
		$kelas = $this->input->post('kelas');
		$result = $this->model_bayarsiswa->pemb_sekolah($siswa, $kelas)->result();
		echo json_encode($result);
	}

	public function search_pemb_sekolah_q2()
	{
		$siswa = $this->input->post('siswa');
		$kelas = $this->input->post('kelas');
		$result = $this->model_bayarsiswa->pemb_sekolah_q2($siswa, $kelas)->result();
		echo json_encode($result);
	}

	public function print2()
	{
		$this->load->library('pdf');
		$tampil_thnakad = $this->configfunction->getthnakd();
		$thnakad = $tampil_thnakad[0]['THNAKAD'];
		$data = array(
			'ThnAkademik'         => $thnakad,
		);


		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->filename = "Rekap-Pembayaran.pdf";
		$this->pdf->load_view('pagekasir/bayarsiswa/laporan', $data);
	}

	public function insert()
	{

		if ($this->input->post('spp_v') && $this->input->post('spp') > 0) {


			// $tampil_thnakad = $this->configfunction->getthnakdkeuangan();
			$thnakad = $this->input->post('ta');
			$tot = $this->input->post('spp') + $this->input->post('gedung') + $this->input->post('seragam') + $this->input->post('kegiatan');
			// print_r(json_encode($tot));exit;
			$ss = $this->input->post('sisa') - $tot;
			// print_r(json_encode($this->input->post('sisa')));exit;
			$nis = $this->input->post('NIS');
			$kelas = $this->input->post('Kelas');
			$psku = $this->db->query("select ps from mssiswa where NOINDUK = '$nis'")->result_array();
			$psku = $psku[0]['ps'];
			$data = array(
				'NIS'           => $this->input->post('NIS'),
				'Noreg'         => $this->input->post('Noreg'),
				'Kelas'         => $this->input->post('Kelas'),
				'tglentri'      => date('Y-m-d H:i:s'),
				'createdAt'      => date('Y-m-d H:i:s'),
				'useridd'       => $this->session->userdata('kodekaryawan'),
				'TotalBayar'    => $tot,
				'kodesekolah'   => $psku,
				'TA'            => $thnakad,
			);
			$action = $this->db->insert('pembayaran_sekolah', $data);
			$id = $this->db->insert_id();
			if ($this->input->post('spp') > 0) {
				$ins1 = array(
					'Nopembayaran'           => $id,
					'kodejnsbayar'         => 'SPP',
					'idtarif'      => $this->input->post('idtarif_spp'),
					'nominalbayar'       => $this->input->post('spp'),
					'createdAt' => date('Y-m-d H:i:s'),
				);
				$action = $this->db->insert('detail_bayar_sekolah', $ins1);
			}

			$query = "SELECT TotalTagihan FROM saldopembayaran_sekolah WHERE NIS=" . $this->input->post('NIS') . "  AND Kelas=" . $this->input->post('Kelas');
			$q2 = $this->db->query($query)->row();
			$v_TotalTagihan = $q2->TotalTagihan;

			$query = "SELECT SUM(SPP)AS SPP FROM(
                    SELECT
                    (SELECT SUM(z.nominalbayar) FROM detail_bayar_sekolah z WHERE z.Nopembayaran=pembayaran_sekolah.Nopembayaran AND z.kodejnsbayar='SPP')AS SPP
                    FROM
                    pembayaran_sekolah
                    WHERE NIS='" . $nis . "' AND Kelas='" . $kelas . "' AND TA='" . $thnakad . "')AS kl";
			$q3 = $this->db->query($query)->row();
			$t_SPP = $q3->SPP;

			$f_tot = ($t_SPP);
			$v_Sisa = ($v_TotalTagihan) - ($t_SPP);
			$sql = "UPDATE saldopembayaran_sekolah SET
            saldopembayaran_sekolah.Bayar='$f_tot',
            saldopembayaran_sekolah.Sisa='$v_Sisa'
            WHERE 
            saldopembayaran_sekolah.NIS = " . $nis . "
            AND saldopembayaran_sekolah.Kelas = " . $kelas;
			$action = $this->db->query($sql);

			if ($action) {
				$this->session->set_flashdata('cat_success', 'Data Berhasil Disimpan!');
			} else {
				$this->session->set_flashdata('cat_error', 'EROR!!!');
			}
			header("Location: " . base_url() . "modulkasir/bayarsiswa");
		} else {
			$this->session->set_flashdata('cat_error', 'Nominal Bayar tidak boleh kosong atau kurang dari Rp.1');
			header("Location: " . base_url() . "modulkasir/bayarsiswa");
		}
		// echo json_encode(true);    
	}

	public function delete()
	{
		$data_id = array(
			'Nopembayaran'  => $this->input->post('id')
		);
		$action = false;
		$action = $this->model_bayarsiswa->delete($data_id, 'detail_bayar_sekolah');
		if ($action) {
			$dataDelete = $this->model_bayarsiswa->getDataDelete($this->input->post('id'))->result_array();
				$nis = $dataDelete[0]['NIS'];
				$kelas = $dataDelete[0]['Kelas'];
				$thnakad = $dataDelete[0]['TA'];
				$updateSaldo = $this->updateSaldo($thnakad, $nis, $kelas);
				$this->model_bayarsiswa->delete($data_id, 'pembayaran_sekolah');
			echo json_encode($updateSaldo);
		} else {
			echo json_encode($action);
		}
	}

	private function updateSaldo($thnakad, $nis, $kelas)
	{
		$query = "SELECT TotalTagihan FROM saldopembayaran_sekolah WHERE NIS=" . $nis . "  AND Kelas=" . $kelas;
		$q2 = $this->db->query($query)->row();
		$v_TotalTagihan = $q2->TotalTagihan;
		$query = "SELECT SUM(SPP)AS SPP FROM(
				SELECT
				(SELECT SUM(z.nominalbayar) FROM detail_bayar_sekolah z WHERE z.Nopembayaran=pembayaran_sekolah.Nopembayaran AND z.kodejnsbayar='SPP')AS SPP
				FROM
				pembayaran_sekolah
				WHERE NIS='" . $nis . "' AND Kelas='" . $kelas . "' AND TA='" . $thnakad . "')AS kl";
		$q3 = $this->db->query($query)->row();
		$t_SPP = $q3->SPP;

		$f_tot = ($t_SPP);
		$v_Sisa = ($v_TotalTagihan) - ($t_SPP);
		$sql = "UPDATE saldopembayaran_sekolah SET
		saldopembayaran_sekolah.Bayar='$f_tot',
		saldopembayaran_sekolah.Sisa='$v_Sisa'
		WHERE 
		saldopembayaran_sekolah.NIS = " . $nis . "
		AND saldopembayaran_sekolah.Kelas = " . $kelas;
		$action = $this->db->query($sql);
	}
	public function tampil_byid()
	{
		$data = array(
			'Nopembayaran'  => $this->input->post('id'),
		);
		$my_data = $this->model_bayarsiswa->view_where('pembayaran_sekolah', $data)->result();
		echo json_encode($my_data);
	}

	public function update()
	{
		$data_id = array(
			'Nopembayaran'  => $this->input->post('e_id')
		);
		$data = array(
			'TotalBayar'  => $this->input->post('e_bayar_v'),
			'useridd'  => $this->session->userdata('kodekaryawan'),
			'updatedAt' => date('Y-m-d H:i:s')
		);
		$data2 = array(
			'nominalbayar'  => $this->input->post('e_bayar_v'),
			'updatedAt' => date('Y-m-d H:i:s')
		);
		$action = $this->model_bayarsiswa->update($data_id, $data, 'pembayaran_sekolah');
		if ($action) {
			$action = $this->model_bayarsiswa->update($data_id, $data2, 'detail_bayar_sekolah');
			$dataDelete = $this->model_bayarsiswa->getDataDelete($this->input->post('e_id'))->result_array();
			$nis = $dataDelete[0]['NIS'];
			$kelas = $dataDelete[0]['Kelas'];
			$thnakad = $dataDelete[0]['TA'];
			$updateSaldo = $this->updateSaldo($thnakad, $nis, $kelas);
		}
		echo json_encode($action);
	}
}
