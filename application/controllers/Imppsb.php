<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Imppsb extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('model_imppsb');
	}

    public function index()
	{
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
			$data = array(
				'page_content' 	=> '../page/imppsb/view',
				'ribbon' 		=> '<li class="active">Import PSB Online</li>',
				'page_name' 	=> 'Import PSB Online',
			);
			$this->render_view($data); //Memanggil function render_view
		} else {
			$this->load->view('page/login'); //Memanggil function render_view
		}
    }
    
	function render_view($data)
	{
		$this->template->load('template', $data); //Display Page
	}

	public function downloadsample()
	{
		set_include_path(APPPATH . 'third_party/PHPExcel/Classes/');
		include 'PHPExcel/IOFactory.php';
		$objPHPExcel = new PHPExcel();
		$idtarif = $this->model_imppsb->getkodesekolah();
		$data = $idtarif;
		$no = 1;
		$row = 2;
		if (count($data) > 0) {
			if ($data) {
				$key = array_keys($data[0]);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'NAMA CALON SISWA');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'KODE SEKOLAH');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'TELP(HP)');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'TAHUN MASUK');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', 'TGL ENTRI');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', 'EMAIL');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', 'TAHUN AKADEMIK');

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', 'Test Calon siswa 1');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B2', '18');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C2', '082222222222');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D2', '2020');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E2', '2019-1-20 (YYYY-MM-DD)');
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F2', 'test@gmail.com');
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G2', '2020/2021');
                
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', 'Test Calon siswa 2');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B3', '18');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C3', '082222222222');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D3', '2020');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E3', '2019-1-20 (YYYY-MM-DD)');
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F3', 'test@gmail.com');
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G3', '2020/2021');
                
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A4', 'Test Calon siswa 3');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B4', '18');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', '082222222222');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D4', '2020');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E4', '2019-1-20 (YYYY-MM-DD)');
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F4', 'test@gmail.com');
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G4', '2020/2021');

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1', 'KODE SEKOLAH');
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J1', 'NAMA SEKOLAH');
                
				foreach ($data as $dataExcel) {
					$kodesekolah = $dataExcel['KDTBPS'];
					$namasekolah = $dataExcel['DESCRTBPS'].' ' .$dataExcel['DESCRTBJS'];

					$objPHPExcel->getActiveSheet(0)->getStyle('I' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('I' . $row, $kodesekolah, PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('I')->setAutoSize(true);

					$objPHPExcel->getActiveSheet(0)->getStyle('J' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
					$objPHPExcel->getActiveSheet(0)->setCellValueExplicit('J' . $row, $namasekolah, PHPExcel_Cell_DataType::TYPE_STRING);
					$objPHPExcel->getActiveSheet(0)->getColumnDimension('J')->setAutoSize(true);
					$row++;
					$no++;
				}
				header('Content-Type: application/vnd.ms-excel; charset=utf-8');
				header('Content-Disposition: attachment; filename=sampleimportpsb.xls');
				header('Cache-Control: max-age=0');
				ob_end_clean();
				ob_start();
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
				$filename = 'Sample' . 'csv';
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
						array_push($empty_message, "Kolom pada row "  . $keys . " Nama Siswa harus di isi");
					}
					if (!$value[1]) {
						array_push($empty_message, "Kolom pada row"  . $keys . " Kode Sekolah");
					}
					if (!$value[2]) {
						array_push($empty_message, "Kolom pada row"  . $keys . " Telp(Hp) harus di isi");
					}
					if (!$value[3]) {
						array_push($empty_message, "Kolom pada row "  . $keys . " Tahun masuk harus di isi");
					}
					if (!$value[4]) {
						array_push($empty_message, "Kolom pada row "  . $keys . " Tgl entri harus di isi ");
                    }
                    if (!$value[6]) {
						array_push($empty_message, "Kolom pada row "  . $keys . " Tahun akademik harus di isi ");
                    }
                    $noreg = $this->generateno();
                    if ($noreg == 401) {
						array_push($empty_message, "Terjadi error saat proses upload, harap upload ulang ");
					}	
					if (!empty($empty_message)) {
						$ret['msg'] = $empty_message;
						$this->session->set_flashdata('message', '' . json_encode($ret['msg']));
						$result = 2;
					} else {
					$calonsiswa = array(
						'Noreg' => $noreg,
                        'Namacasis' => $value[0],
						'kodesekolah' => $value[1],
						'TelpHp' => $value[2],
						'userentri' => $this->session->userdata('nip'),
                        'thnmasuk' => $value[3],
						'tglentri' => $value[4],
                        'email' => $value[5],
						'TA' => $value[6],
						'createdAt'	=> date('Y-m-d H:i:s')
					);
					$result = $this->model_imppsb->insert($calonsiswa, 'calon_siswa');
					}
				}
            }
            $result = 1;
			echo json_encode($result);
		} else {
			$result = 0;
			echo json_encode($result);
		}
    }
    
    private function generateno(){
        $noreg = $this->model_imppsb->getnoreg();
        $noreg = $noreg[0]['noreg'];
        $status = $this->validasinoreg($noreg);
        if($status == 200){
            return $noreg;
        }
        return 401;
    }

    private function validasinoreg($noreg){
        $cek = $this->model_imppsb->ceknoreg($noreg);
        if($cek > 0){
            $status = 401;
        } 
        $status = 200;
        return $status;
    }
}