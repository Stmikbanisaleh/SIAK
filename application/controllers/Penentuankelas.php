<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penentuankelas extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('model_penentuan');
        $this->load->library('Configfunction');
    }

    function render_view($data)
    {
        $this->template->load('template', $data); //Display Page

    }

        public function index()
    {
        $mytahun = $this->model_penentuan->gettahun()->result_array();
        $myjurusan = $this->model_penentuan->getjurusan()->result_array();
        $myrev = $this->model_penentuan->getrev()->result();

        $data = array(
            'page_content'  => 'penentuan/view',
            'ribbon'        => '<li class="active">Penentuan Kelas</li>',
            'page_name'     => 'Penentuan Kelas',
            'mytahun'        => $mytahun,
            'myjurusan'       => $myjurusan,
            'myrev'         => $myrev,

        );
        $this->render_view($data); //Memanggil function render_view
    }

    public function search()
    {
        $tahun = $this->input->post('thn');
        $jurusan = $this->input->post('jurusan');
        $result = $this->model_penentuan->getkelas($tahun, $jurusan)->result();
        // print_r($result);exit;
        echo json_encode($result);
    }

    public function showguru()
    {
        $ps = $this->input->post('ps');
        $data = array('GuruBase' => $ps);
        $my_data = $this->model_jadwal->viewWhereOrdering('tbguru', $data, 'id', 'asc')->result_array();
        echo "<option value='0'>--Pilih Guru --</option>";
        foreach ($my_data as $value) {
            echo "<option value='" . $value['IdGuru'] . "'>[" . $value['GuruNama'] . "] </option>";
        }
    }

    public function showmapel()
    {
        $ps = $this->input->post('ps');
        $data = array('PS' => $ps);
        $my_data = $this->model_jadwal->viewWhereOrdering('mspelajaran', $data, 'id_mapel', 'asc')->result_array();
        echo "<option value='0'>--Pilih Mapel --</option>";
        foreach ($my_data as $value) {
            echo "<option value='" . $value['id_mapel'] . "'>[" . $value['nama'] . "] </option>";
        }
    }

    public function tampil()
    {
        $my_data = '';
        echo json_encode($my_data);
    }

    public function tampil_byid()
    {
        $data = array(
            'id'  => $this->input->post('id'),
        );
        $my_data = $this->model_jadwal->view_where('tbjadwal', $data)->result();
        echo json_encode($my_data);
    }

    public function simpan()
    {
        $this->load->library('Configfunction');
        $tampil_thnakad = $this->configfunction->getthnakd();
        $data = array(
            'ps'  => $this->input->post('programsekolahs'),
            'id_mapel'  => $this->input->post('mataajar'),
            'id_ruang'  => $this->input->post('ruang'),
            'id_guru'  => $this->input->post('guru'),
            'hari'  => $this->input->post('hari'),
            'jam'  => $this->input->post('jam'),
            'nmklstrjdk'  => $this->input->post('kelas'),
            'periode'  => $tampil_thnakad[0]['THNAKAD'],
            'semester'  => $tampil_thnakad[0]['SEMESTER'],
            'createdAt' => date('Y-m-d H:i:s'),
        );
        $action = $this->model_jadwal->insert($data, 'tbjadwal');
        echo json_encode($action);
    }

    public function update()
    {
        $data_id = array(
            'id'  => $this->input->post('e_id')
        );
        $data = array(
            'nama'  => $this->input->post('e_nama'),
            'updatedAt' => date('Y-m-d H:i:s'),
        );
        $action = $this->model_jadwal->update($data_id, $data, 'tbjadwal');
        echo json_encode($action);
    }

    public function delete()
    {
        $data_id = array(
            'id'  => $this->input->post('id')
        );
        $data = array(
            'isdeleted'  => 1,
        );
        $action = $this->model_jadwal->update($data_id, $data, 'tbjadwal');
        echo json_encode($action);
    }

    public function ubah()
    {
        $tampil_thnakad = $this->configfunction->getthnakd();
        $ThnAkademik = $tampil_thnakad[0]['THNAKAD'];

        $data = array(
            'GolKelas'  => $this->input->post('gol'),
        );
        $where = array(
            'NIS'  => $this->input->post('noreg'),
            'TA'  => $ThnAkademik,
        );
        $action = $this->model_penentuan->update($where, $data, 'baginaikkelas');
        // print_r($this->db->last_query());exit;
        echo json_encode($action);
    }

    public function naik()
    {
        $tampil_thnakad = $this->configfunction->getthnakd();
        $ThnAkademik = $tampil_thnakad[0]['THNAKAD'];

        $data = array(
            'Naikkelas'  => $this->input->post('id_Kelas_naik'),
            'Kelas'  => $this->input->post('id_Kelas_naik'),
        );
        $where = array(
            'NIS'  => $this->input->post('noreg'),
            'TA'  => $ThnAkademik,
        );
        $action = $this->model_penentuan->update($where, $data, 'baginaikkelas');
        echo json_encode($action);
    }

    public function tinggal()
    {
        $tampil_thnakad = $this->configfunction->getthnakd();
        $ThnAkademik = $tampil_thnakad[0]['THNAKAD'];

        $data = array(
            'Naikkelas'  => $this->input->post('id_kelas'),
            'Kelas'  => $this->input->post('id_kelas'),
        );
        $where = array(
            'NIS'  => $this->input->post('noreg'),
            'TA'  => $ThnAkademik,
        );
        $action = $this->model_penentuan->update($where, $data, 'baginaikkelas');
        echo json_encode($action);
    }

    public function validasi(){
        $tampil_thnakad = $this->configfunction->getthnakd();
        $thn = $this->input->post('thn');
        $ps = $this->input->post('jurusan');
        $ThnAkademik = $tampil_thnakad[0]['THNAKAD'];
        $sql = "SELECT * ,
        (SELECT z.NAMA_REV FROM msrev z WHERE z.`STATUS`='4' AND z.KETERANGAN=siswa.agama)AS v_agama,
        (SELECT z.NAMA_REV FROM msrev z WHERE z.`STATUS`='1' AND z.KETERANGAN=siswa.Jk)AS v_Jk,
        (SELECT z.DESCRTBPS FROM tbps z WHERE z.KDTBPS= siswa.PS)AS v_sekolah,
        (SELECT z.Naikkelas FROM baginaikkelas z WHERE z.NIS=siswa.NOINDUK ORDER BY idbagiNaikKelas DESC LIMIT 1)AS Naikkelas,
        DATE_FORMAT(tglhr,'%d-%m-%Y')tgl_lahir
        FROM mssiswa siswa WHERE TAHUN='$thn' AND PS ='$ps'";
        $hasil = $this->db->query($sql)->result_array();
        // print_r($this->db->last_query());exit;
        if($this->db->query($sql)->num_rows() < 1){
            echo json_encode(401);
        }else{
            foreach ($hasil as $rl){
                $query = "SELECT COUNT(*)AS jml,Naikkelas,idbagiNaikKelas,Kelas FROM baginaikkelas WHERE NIS ='".$rl['NOINDUK']."' AND TA='".$ThnAkademik."' ORDER BY idbagiNaikKelas DESC LIMIT 1";
                $cari1 = $this->db->query($query)->row();

                $jml = $cari1->jml;
                $Naikkelas = $cari1->Naikkelas;
                $idbagiNaikKelas = $cari1->idbagiNaikKelas;
                $Kelas = $cari1->Kelas;

                if ($jml != 1) {

                    $str = $ThnAkademik;
                    $pieces = (explode("/", $str));
                    $v_hasil = $pieces[0] - $rl['TAHUN'];

                    $query_kdsk = $this->db->query("select kdsk from tbps where kdtbps = '".$rl['PS']."'");
                    $hasil_kdsk = $query_kdsk->row();

                    if($hasil_kdsk == null){
                        $kls = '';
                    }else{
                        $kdsk = $hasil_kdsk->kdsk;
                    }
                        
                        if($kdsk == 1){
                            $kls = 1;
                        }else if($kdsk == 2){
                            $kls = 1;
                        }else if($kdsk == 3){
                            $kls = 7;
                        }else if($kdsk == 4){
                            $kls = 10;
                        }else{
                            $kls = 0;
                        }

                    // if ($v_hasil == '0') {
                    //     if ($rl['PS'] == '01') {
                    //         $kls = 1;
                    //     } else {
                    //         $kls = 4;
                    //     }
                    // } elseif ($v_hasil == 1) {
                    //     if ($rl['PS'] == '01') {
                    //         $kls = 2;
                    //     } else {
                    //         $kls = 5;
                    //     }
                    // } elseif ($v_hasil == 2) {
                    //     if ($rl['PS'] == '01') {
                    //         $kls = 3;
                    //     } else {
                    //         $kls = 6;
                    //     }
                    // }

                    if ($rl['Naikkelas'] == '') {
                        $vt_kelas = $kls;
                    } else {
                        if ($kls >= $rl['Naikkelas']) {
                            $vt_kelas = $rl['Naikkelas'];
                        } else {
                            $vt_kelas = $kls;
                        }
                    }

                    $data = array(
                        'Thnmasuk'  => $rl['TAHUN'],
                        'Kelas'  => $vt_kelas,
                        'Kodesekolah'  => $rl['PS'],
                        'TA'  => $ThnAkademik,
                        'tglentri'  => date('Y-m-d H:i:s'),
                        'userentri'  => $this->session->userdata('nip'),
                        'NIS'  => $rl['NOINDUK'],
                    );
                    $action = $this->model_penentuan->insert($data, 'baginaikkelas');
                }
            }
            echo json_encode(true);
        }
    }

	public function downloadsample()
	{
		set_include_path(APPPATH . 'third_party/PHPExcel/Classes/');
		include 'PHPExcel/IOFactory.php';
		$objPHPExcel = new PHPExcel();
        $idtarif = $this->model_penentuan->getformatexcel()->result_array();
        $data2 = $this->model_penentuan->getformatexcel2()->result_array();
        $data3 = $this->model_penentuan->getformatexcel3()->result_array();
		$data = $idtarif;
		$no = 1;
        $row = 2;
		$row2 = 2;
		$row3 = 2;
        
		if (count($data) > 0) {
			if ($data) {
				$key = array_keys($data[0]);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'TAHUN MASUK');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'RUANGAN');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'KELAS');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'NAIK KELAS');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', 'GOlONGAN KELAS');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', 'JURUSAN');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', 'KODE SEKOLAH');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1', 'TAHUN AKADEMIK');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1', 'NIS');

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', '2020');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B2', '1');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C2', '10');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D2', '10');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E2', '1');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F2', '15');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G2', '23');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H2', '2020/2021');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I2', "'1951123");

                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', '2020');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B3', '1');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', '10');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D3', '10');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E3', '1');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F3', '15');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G3', '23');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H3', '2020/2021');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I3', "'1951123");

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O1', 'KODE RUANGAN');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P1', 'NAMA RUANGAN');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q1', 'KODE JURUSAN');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('R1', 'NAMA JURUSAN');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('S1', 'KODE SEKOLAH');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('T1', 'NAMA SEKOLAH');
				foreach ($data as $dataExcel) {
					$idruang = $dataExcel['ID'];
					$nmruang = $dataExcel['RUANG'];
				
					$objPHPExcel->getActiveSheet(0)->getStyle('O' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('O' . $row, $idruang, PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('O')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('P' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('P' . $row, $nmruang, PHPExcel_Cell_DataType::TYPE_STRING);
                    $objPHPExcel->getActiveSheet(0)->getColumnDimension('P')->setAutoSize(true);
                    $row++;
                }
                foreach($data2 as $dataExcel2){
                    $kodejurusan = $dataExcel2['KDTBJS'];
					$nmjurusan = $dataExcel2['DESCRTBJS'];
                    $objPHPExcel->getActiveSheet(0)->getStyle('Q' . $row2)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('Q' . $row2, $kodejurusan, PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('Q')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('R' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('R' . $row2, $nmjurusan, PHPExcel_Cell_DataType::TYPE_STRING);
                    $objPHPExcel->getActiveSheet(0)->getColumnDimension('R')->setAutoSize(true);
                    $row2++;
                    
                }
				foreach($data3 as $dataExcel3){
                    $kdps = $dataExcel3['KDTBPS'];
					$nm = $dataExcel3['SINGKTBPS'];
                    $objPHPExcel->getActiveSheet(0)->getStyle('S' . $row3)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('S' . $row3, $kdps, PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('S')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('T' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('T' . $row3, $nm, PHPExcel_Cell_DataType::TYPE_STRING);
                    $objPHPExcel->getActiveSheet(0)->getColumnDimension('T')->setAutoSize(true);
                    $row3++;
                }

				
					
				
				header('Content-Type: application/vnd.ms-excel; charset=utf-8');
				header('Content-Disposition: attachment; filename=report.xls');
				header('Cache-Control: max-age=0');
				ob_end_clean();
				ob_start();
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$filename = 'Sample penentuankelas' . 'csv';
				$objWriter->save('php://output');
			}
		}
    }
    
    public function import()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
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

            foreach ($allDataInSheet as $ads) {
                if (array_filter($ads)) {
                    array_push($data_exist, $ads);
                }
            }
            foreach ($data_exist as $key => $value) {
                if ($key == '0') {
                    continue;
                } else {
                    $where = array(
                        'NIS' => $value[8]
                    );
                    $result = $this->model_penentuan->view_where_noisdelete($arrayCustomerQuote, 'baginaikkelas')->numrows();
                    echo json_encode($result);exit;

                    $arrayCustomerQuote = array(
                        'Thnmasuk' => $value[0],
                        'Ruangan' => $value[1],
                        'kelas' => $value[2],
                        'Naikkelas' => $value[3],
                        'GolKelas' => $value[4],
                        'Jurusan' => $value[5],
                        'Kodesekolah' => $value[6],
                        'TA' => $value[7],
                        'userentri' => $this->session->userdata('nip'),
                        'NIS' => $value[8],
                        'tglentri' => date('Y-m-d H:i:s')
                    );
                    $result = $this->model_penentuan->insert($arrayCustomerQuote, 'baginaikkelas');
                }
            }
            if ($result) {
                $result = 1;
            }

            echo json_encode($result);
        } else {
            echo json_encode($result);
        }
    }

}
