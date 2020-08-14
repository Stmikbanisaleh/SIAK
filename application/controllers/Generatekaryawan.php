<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Generatekaryawan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
		$this->load->model('model_generatekaryawan');
		if (empty($this->session->userdata('username')) && empty($this->session->userdata('nama'))) {
            $this->session->set_flashdata('category_error', 'Silahkan masukan username dan password');
            redirect('dashboard/login');
        }
    }

    function render_view($data)
    {
        $this->template->load('template', $data); //Display Page
    }

    public function index()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
            $data = array(
                'page_content'  => 'generatekaryawan/view',
                'ribbon'        => '<li class="active">Generate Kehadiran Karyawan</li>',
                'page_name'     => 'Generate Kehadiran Karyawan'
            );
            $this->render_view($data); //Memanggil function render_view
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
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
					$arrayCustomerQuote = array(
						'NAMAJABATAN' => $value[0],
						'KET' => $value[1],
						'createdAt'	=> date('Y-m-d H:i:s')
					);
                    $result = $this->model_generateguru->insert($arrayCustomerQuote, 'msjabatan');
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
    
    public function tampil()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
            $my_data = $this->model_generateguru->viewOrdering('msjabatan', 'id', 'asc')->result();
            echo json_encode($my_data);
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }

    public function tampil_byid()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
            $data = array(
                'id'  => $this->input->post('id'),
            );
            $my_data = $this->model_generateguru->view_where('msjabatan', $data)->result();
            echo json_encode($my_data);
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }

    public function simpan()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
            $data_id = array(
                'NAMAJABATAN'  => $this->input->post('nama')
            );
            $count_id = $this->model_generateguru->view_count('msjabatan', $data_id);
            if ($count_id < 1) {
                $data = array(
                    'id'  => $this->input->post('id'),
                    'NAMAJABATAN'  => $this->input->post('nama'),
                    'KET'  => $this->input->post('keterangan'),
                    'createdAt' => date('Y-m-d H:i:s'),
                );
                $action = $this->model_generateguru->insert($data, 'msjabatan');
                echo json_encode($action);
            } else {
                echo json_encode(401);
            }
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }

    public function update()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
            $data_id = array(
                'ID'  => $this->input->post('e_id')
            );
            $data = array(
                'NAMAJABATAN'  => $this->input->post('e_nama'),
                'KET'  => $this->input->post('e_keterangan'),
                'updatedAt' => date('Y-m-d H:i:s'),
            );
            $action = $this->model_generateguru->update($data_id, $data, 'msjabatan');
            echo json_encode($action);
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }

    public function delete()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
            $data_id = array(
                'ID'  => $this->input->post('id')
            );
            $data = array(
                'isdeleted'  => 1,
            );
            $action = $this->model_generateguru->update($data_id, $data, 'msjabatan');
            echo json_encode($action);
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
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
			$this->load->view('page/login'); //Memanggil function render_view
		}
	}
}
