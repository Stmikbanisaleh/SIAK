<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Biodata_karyawan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('payroll/model_karyawan');
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {

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
		$my_jabatan = $this->model_karyawan->view('msjabatan')->result_array();
		$my_pembayaran = $this->model_karyawan->view('jnspembayaran')->result_array();
		$mspendidikan = $this->model_karyawan->view('mspendidikan')->result_array();
		$myagama = $this->model_karyawan->view('tbagama')->result_array();

		$data = array(
			'page_content' 	=> '../pagepayroll/biodata_karyawan/view',
			'ribbon' 		=> '<li class="active">Master Biodata Karyawan</li>',
			'page_name' 	=> 'Master Biodata Karyawan',
			'js' 			=> 'js_file',
			'my_jabatan' 	=> $my_jabatan,
			'my_pembayaran'	=> $my_pembayaran,
			'my_pendidikan'	=> $mspendidikan,
			'myagama'	=> $myagama,
		);
		$this->render_view($data); //Memanggil function render_view
	}

	public function tampil()
	{
		$my_data = $this->model_karyawan->view_karyawan()->result_array();
		echo json_encode($my_data);
	}

	public function simpan()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$data = array(
				'nik'  => $this->input->post('nik'),
				'nip'  => $this->input->post('nip'),
				'nama'  => $this->input->post('nama'),
				'jabatan'  => $this->input->post('jabatan'),
				'jenis_kelamin'  => $this->input->post('jenis_kelamin'),
				'agama'  => $this->input->post('agama'),
				'email' => $this->input->post('email'),
				'no_telp'  => hash('sha512',md5($this->input->post('telp'))),
				'alamat'  => $this->input->post('alamat'),
				'pendidikan'  => $this->input->post('pendidikan_terakhir'),
				'tgl_lhr'  => $this->input->post('tgl_lahir'),
				'status' => $this->input->post('status'),
				'tgl_mulai_kerja'  => $this->input->post('tgl_mulai'),
				'createdAt' => date('Y-m-d H:i:s')
			);
			$datatarif = array(
				'id_karyawan' => $this->input->post('nip'),
				'tunjangan_masakerja' => $this->input->post('tunjangan_masa_kerja_v'),
				'tunjangan_jabatan'  => $this->input->post('tunjangan_jabatan_v'),
				'tarif'  => $this->input->post('tarif_karyawan_v'),
				'cara_pembayaran'  => $this->input->post('nama_pembayaran'),
				'transport'  => $this->input->post('transport_v'),
				'no_rekening' => $this->input->post('no_rekening'),
				'createdAt' => date('Y-m-d H:i:s')
			);

			$count_id = $this->model_karyawan->view_count('biodata_karyawan', $data['nik']);
			if ($count_id < 1) {
				$result = $this->model_karyawan->insert($data, 'biodata_karyawan');
				$result2 = $this->model_karyawan->insert($datatarif , 'tarifkaryawan');
				if ($result) {
					echo $result;
				} else {
					echo 'insert gagal';
				}
			} else {
				echo json_encode(401);
			}
		} else {
			$this->load->view('pagepayroll/login'); //Redirect login
		}
	}


	public function tampil_byid()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$data = array(
				'id'  => $this->input->post('id'),
			);
			$my_data = $this->model_karyawan->view_karyawan_where($data)->result();
			echo json_encode($my_data);
		} else {
			$this->load->view('pagepayroll/login'); //Redirect login
		}
	}

	public function tampil_byidtarif()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$data = array(
				'id'  => $this->input->post('id'),
			);
			$my_data = $this->model_karyawan->view_tarif_where($data)->result();
			echo json_encode($my_data);
		} else {
			$this->load->view('pagepayroll/login'); //Redirect login
		}
	}

	public function updatebiodata()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$data = array(
				'id_biodata'  => $this->input->post('e_id'),
			);

			$dataupdate = array(
				'nik'  => $this->input->post('e_nik'),
				'nama'  => $this->input->post('e_nama'),
				'jabatan'  => $this->input->post('e_jabatan'),
				'jenis_kelamin'  => $this->input->post('e_jenis_kelamin'),
				'agama'  => $this->input->post('e_agama'),
				'email'  => $this->input->post('e_email'),
				'no_telp'  => $this->input->post('e_telp'),
				'alamat'  => $this->input->post('e_alamat'),
				'pendidikan'  => $this->input->post('e_pendidikan_terakhir'),
				'tgl_lhr'  => $this->input->post('e_tgl_lahir'),
				'tgl_mulai_kerja'  => $this->input->post('e_tgl_mulai'),
				'status'  => $this->input->post('e_status')
			);

			$my_data = $this->model_karyawan->update($data,$dataupdate,'biodata_karyawan');
			echo json_encode($my_data);
		} else {
			$this->load->view('pagepayroll/login'); //Redirect login
		}
	}

	public function updatetarif()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$data = array(
				'id_karyawan'  => $this->input->post('e_niptarif'),
			);

			$dataupdate = array(
				'tarif'  => $this->input->post('e_tarif_karyawan_v'),
				'tunjangan_jabatan'  => $this->input->post('e_tunjangan_jabatan_v'),
				'tunjangan_masakerja'  => $this->input->post('e_tunjangan_masa_kerja_v'),
				'transport'  => $this->input->post('e_transport_v'),
				'cara_pembayaran'  => $this->input->post('e_nama_pembayaran'),
				'no_rekening'  => $this->input->post('e_no_rekening'),
			);

			$my_data = $this->model_karyawan->update($data,$dataupdate,'tarifkaryawan');
			echo json_encode($my_data);
		} else {
			$this->load->view('pagepayroll/login'); //Redirect login
		}
	}

	public function delete()
    {
        $data_id = array(
            'id_karyawan'  => $this->input->post('id')
		);
		$data_id2 = array(
            'nip'  => $this->input->post('id')
        );
		$action = $this->model_karyawan->delete($data_id, 'tarifkaryawan');
		if($action){
			$action2= $this->model_karyawan->delete($data_id2, 'biodata_karyawan');
			echo json_encode($action);
		}
	}
	
	public function import()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$files = $_FILES;
			$file = $files['file'];
			$fname = $file['tmp_name'];
			$file = $_FILES['file']['name'];
			$fname = $_FILES['file']['tmp_name'];
			$ext = explode('.', $file);
			/** Include path **/
			set_include_path(APPPATH . 'third_party/PHPExcel/Classes/');
			/** PHPExcel_IOFactory */
			include 'PHPExcel/IOFactory.php';
			$objPHPExcel = PHPExcel_IOFactory::load($fname);
			$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, false, true);
			$data_exist = [];
			$empty_message = [];

			foreach ($allDataInSheet as $ads) {
				if (array_filter($ads)) {
					array_push($data_exist, $ads);
				}
			}
			foreach ($data_exist as $keys => $value) {
				if ($keys == '0') {
					continue;
				} else {
					if (!$value[0]) {
						array_push($empty_message, "No at row "  . $keys . " ID KARYAWAN harus di isi");
					}
					if (!$value[1]) {
						array_push($empty_message, "No at row "  . $keys . " NIK KTP harus di isi");
					}
					if (!$value[2]) {
						array_push($empty_message, "No at row "  . $keys . " NAMA harus di isi");
					}
					if (!$value[3]) {
						array_push($empty_message, "No at row "  . $keys . " JABATAN harus di isi");
					}
					if (!$value[4]) {
						array_push($empty_message, "No at row "  . $keys . " JENIS KELAMIN harus di isi");
					}
					if (!$value[5]) {
						array_push($empty_message, "No at row "  . $keys . " AGAMA harus di isi");
					}
					//EMAIL
					//TELP
					//ALAMAT
					if (!$value[9]) {
						array_push($empty_message, "No at row "  . $keys . " PENDIDIKAN harus di isi");
					}
					if (!$value[10]) {
						array_push($empty_message, "No at row "  . $keys . " TARIF / GAJI harus di isi");
					}
					if (!$value[11]) {
						array_push($empty_message, "No at row "  . $keys . " Cara Pembayaran harus di isi");
					}
					if (!$value[12]) {
						array_push($empty_message, "No at row "  . $keys . "No Rekening harus di isi");
					}
					if (!$value[13]) {
						array_push($empty_message, "No at row "  . $keys . "Tunjangan jabatan harus di isi");
					}
					if (!$value[14]) {
						array_push($empty_message, "No at row "  . $keys . "Tunjangan masa kerja harus di isi");
					}
					if (!empty($empty_message)) {
						$ret['msg'] = $empty_message;
						$this->session->set_flashdata('message', '' . json_encode($ret['msg']));
						$result = 2;
					} else {
							
					$data = array(
						'nip' => $value[0],
						'nik' => $value[1],
						'nama' => $value[2],
						'jabatan' => $value[3],
						'jenis_kelamin' => $value[4],
						'agama' => $value[5],
						'email' => $value[6],
						'no_telp' => $value[7],
						'alamat'	=> $value[8],
						'pendidikan'	=> $value[9],

					);
					$datatarif = array(
						'id_karyawan' => $value[0],
						'tarif' => $value[10],
						'cara_pembayaran' => $value[11],
						'no_rekening' => $value[12],
						'tunjangan_jabatan' => $value[13],
						'tunjangan_masakerja' => $value[14],
					);
					$result = $this->model_karyawan->insert($data, 'biodata_karyawan');
					$result = 1;
					$id = $this->db->insert_id();
					if ($id) {
						$result = $this->model_karyawan->insert($datatarif, 'tarifkaryawan');
						$result = 1;
					}
					}
				}
			}
			echo json_encode($result);
		} else {
			$result = 0;
			echo json_encode($result);
		}
	}


	public function downloadsample()
	{
		set_include_path(APPPATH . 'third_party/PHPExcel/Classes/');
		include 'PHPExcel/IOFactory.php';
		$objPHPExcel = new PHPExcel();
		$idtarif = $this->model_karyawan->view('jnspembayaran')->result_array();
		$agama = $this->model_karyawan->view('tbagama')->result_array();
		$jabatan = $this->model_karyawan->view('msjabatan')->result_array();
		$pendidikan = $this->model_karyawan->view('mspendidikan')->result_array();
		$data = $idtarif;
		$no = 1;
		$row = 2;
		$no2 = 1;
		$row2 = 2;
		$no3 = 1;
		$row3 = 2;
		$no4 = 1;
		$row4 = 2;
		if (count($data) > 0) {
			if ($data) {
				$key = array_keys($data[0]);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'ID KARYAWAN');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'NIK (KTP)');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'NAMA');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'JABATAN');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', 'JENIS KELAMIN');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', 'AGAMA');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', 'EMAIL');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1', 'TELP');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1', 'ALAMAT');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J1', 'PENDIDIKAN');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K1', 'TARIF / GAJI KARYAWAN');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L1', 'CARA PEMBAYARAN');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M1', 'NO REKENING / AKUN');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N1', 'TUNJANGAN JABATAN');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O1', 'TUNJANGAN MASA KERJA');

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', '11001101');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B2', '3201226262666662');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C2', 'TEST 1 GEMA');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D2', '3');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E2', 'L');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F2', '1');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G2', 'test@gemanurani.sch.id');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H2', '08xxxxxxxx');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I2', 'Bekasi');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J2', '23');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K2', '4000000');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L2', '1');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M2', '11111111111');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N2', '750000');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O2', '80000');

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', '11001101');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B3', '3201226262666662');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', 'TEST 1 GEMA');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D3', '3');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E3', 'L');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F3', '1');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G3', 'test@gemanurani.sch.id');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H3', '08xxxxxxxx');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I3', 'Bekasi');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J3', '23');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K3', '4000000');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L3', '1');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M3', '11111111111');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N3', '750000');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O3', '80000');

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('R1', 'ID JENIS BAYAR');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('S1', 'CARA PEMBAYARAN');

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('V1', 'ID AGAMA');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('W1', 'NAMA AGAMA');

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Y1', 'KODE JABATAN');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Z1', 'NAMA JABATAN');

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AA1', 'KODE PENDIDIKAN');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AB1', 'NAMA PENDIDIKAN');
				foreach ($data as $dataExcel) {
					$idtarif = $dataExcel['id'];
					$nama_pembayaran = $dataExcel['nama_pembayaran'];

					$objPHPExcel->getActiveSheet(0)->getStyle('R' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('R' . $row, $idtarif, PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('R')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('S' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('S' . $row, $nama_pembayaran, PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('S')->setAutoSize(true);
					$row++;
					$no++;
				}
				foreach ($agama as $dataExcel2) {
					$kodeagama = $dataExcel2['KDTBAGAMA'];
					$namaagama = $dataExcel2['DESCRTBAGAMA'];

					$objPHPExcel->getActiveSheet(0)->getStyle('V' . $row2)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('V' . $row2, $kodeagama, PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('V')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('W' . $row2)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('W' . $row2, $namaagama, PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('W')->setAutoSize(true);
					$row2++;
					$no2++;
				}

				foreach ($jabatan as $dataExcel3) {
					$idjabatan = $dataExcel3['ID'];
					$namajabatan = $dataExcel3['NAMAJABATAN'];

					$objPHPExcel->getActiveSheet(0)->getStyle('Y' . $row3)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('Y' . $row3, $idjabatan, PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('Y')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('Z' . $row3)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('Z' . $row3, $namajabatan, PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('Z')->setAutoSize(true);
					$row3++;
					$no3++;
				}

				foreach ($pendidikan as $dataExcel4) {
					$idpendidikan = $dataExcel4['IDMSPENDIDIKAN'];
					$namapendidikan = $dataExcel4['NMMSPENDIDIKAN'];

					$objPHPExcel->getActiveSheet(0)->getStyle('AA' . $row4)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('AA' . $row4, $idpendidikan, PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('AA')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('AB' . $row4)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('AB' . $row4, $namapendidikan, PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('AB')->setAutoSize(true);
					$row4++;
					$no4++;
				}
				header('Content-Type: application/vnd.ms-excel; charset=utf-8');
				header('Content-Disposition: attachment; filename=report.xls');
				header('Cache-Control: max-age=0');
				ob_end_clean();
				ob_start();
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$filename = 'Sample' . 'csv';
				$objWriter->save('php://output');
			}
		}
	}

}
