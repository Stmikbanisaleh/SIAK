<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengambilanformulir extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('model_pengambilanformulir');
        if (empty($this->session->userdata('username')) && empty($this->session->userdata('nama'))) {
            $this->session->set_flashdata('category_error', 'Silahkan masukan username dan password');
            redirect('dashboard/login');
        }
    }

    function render_view($data)
    {
        $this->template->load('template', $data); //Display Page
    }

    public function import()
	{
		if ($this->session->userdata('nip') != null && $this->session->userdata('nama') != null) {
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
						array_push($empty_message, "No at row "  . $keys . " NIS harus di isi");
					}
					if (!$value[1]) {
						array_push($empty_message, "No at row "  . $keys . " NOREG harus di isi");
					}
					if (!$value[3]) {
						array_push($empty_message, "No at row "  . $keys . "Nama harus di isi");
					}
					if (!$value[4]) {
						array_push($empty_message, "No at row "  . $keys . " Tgl Terima harus di isi");
					}
					if (!$value[5]) {
						array_push($empty_message, "No at row "  . $keys . " Kode Sekolah harus di isi");
					}
					if (!$value[6]) {
						array_push($empty_message, "No at row "  . $keys . "Tahun Pendidikan harus di isi");
					}

					if (!$value[7]) {
						array_push($empty_message, "No at row "  . $keys . "kode Pembayaran harus di isi");
					}

					if (!$value[8]) {
						array_push($empty_message, "No at row "  . $keys . "ID Tarif harus di isi");
					}

					if (!$value[9]) {
						array_push($empty_message, "No at row "  . $keys . " Nominal harus di isi");
					}

					if (!empty($empty_message)) {
						$ret['msg'] = $empty_message;
						$this->session->set_flashdata('message', '' . json_encode($ret['msg']));
						$result = 2;
					} else {
                    $data_calon = array(
                        'Noreg' => $this->input->post('noreg'),
                        'Namacasis' => strtoupper($this->input->post('nama')),
                        'email' => $this->input->post('email'),
                        'TelpHp' => strtoupper($this->input->post('telp')),
                        'thnmasuk' => $tahun,
                        'kodesekolah'  => $this->input->post('sekolah'),
                        'tglentri' => $this->input->post('tanggal'),
                        'userentri' => $this->session->userdata('nip')
                    );
                    $insertcalon = $this->model_pengambilanformulir->insert($data_calon, 'calon_siswa');
					}
				}
            }
            echo json_encode($insertcalon);
		} else {
			$result = 0;
			echo json_encode($result);
		}
    }
    
    public function index()
    {
        $this->load->library('Configfunction');
        $tampil_thnakad = $this->configfunction->getthnakd();
        $mysekolah = $this->model_pengambilanformulir->getsekolah($tampil_thnakad[0]['THNAKAD'])->result_array();
        $my_thnakad3 = $this->model_pengambilanformulir->get_thnakad3()->result_array();
        $data = array(
            'page_content'     => 'pengambilanformulir/view',
            'ribbon'         => '<li class="active">Dashboard</li><li>Master Pengambilan Formulir</li>',
            'page_name'     => 'Master Pengambilan Formulir',
            'js'             => 'js_file',
            'mysekolah'     => $mysekolah,
            'my_thnakad3'   => $my_thnakad3,
        );
        $this->render_view($data); //Memanggil function render_view
    }

    public function simpan()
    {
        $tahun = date("Y");
        $idtarifq = $this->model_pengambilanformulir->getidtarif($this->input->post('sekolah'))->result_array();
        $data = array(
            'Noreg'  => $this->input->post('noreg'),
            'tglentri'  => $this->input->post('tanggal'),
            'useridd'  => $this->session->userdata('nip'),
            'TotalBayar'  => $this->input->post('nominal_v'),
            'kodesekolah'  => $this->input->post('sekolah'),
            'createdAt' => date('Y-m-d H:i:s')
        );
        $insert = $this->model_pengambilanformulir->insert($data, 'pembayaran_sekolah');
        $id_result = $this->db->insert_id();
        if ($insert) {
            $data_detail = array(
                'Nopembayaran' => $id_result,
                'kodejnsbayar' => 'FRM',
                'idtarif'      => $idtarifq[0]['idtarif'],
                'nominalbayar' => $this->input->post('nominal_v')
            );
            $insert_detail = $this->model_pengambilanformulir->insert($data_detail, 'detail_bayar_sekolah');
            if ($insert_detail) {
                $data_calon = array(
                    'Noreg' => $this->input->post('noreg'),
                    'Namacasis' => strtoupper($this->input->post('nama')),
                    'email' => $this->input->post('email'),
                    'TelpHp' => strtoupper($this->input->post('telp')),
                    'thnmasuk' => substr($this->input->post('tahunakademik'), 0, 4),
                    'kodesekolah'  => $this->input->post('sekolah'),
                    'tglentri' => $this->input->post('tanggal'),
                    'userentri' => $this->session->userdata('nip'),
                      'TA' => $this->input->post('tahunakademik'),

                );
                $insertcalon = $this->model_pengambilanformulir->insert($data_calon, 'calon_siswa');
                echo json_encode($insertcalon);
            }
        }
    }

    public function tampil_byid()
    {
        $data = array(
            'id'  => $this->input->post('id'),
        );
        $my_data = $this->model_pengambilanformulir->view_where('jenjang', $data)->result();
        echo json_encode($my_data);
    }

    public function tampil()
    {
        $this->load->library('Configfunction');
        $tampil_thnakad = $this->configfunction->getthnpsb();
        $my_data = $this->model_pengambilanformulir->getdata($tampil_thnakad[0]['THNAKAD'])->result_array();
        echo json_encode($my_data);
    }

    public function update_jenjang()
    {
        $data_id = array(
            'id'  => $this->input->post('e_id')
        );
        $data = array(
            'jenjang'  => $this->input->post('e_jenjang'),
        );
        $action = $this->model_pengambilanformulir->update($data_id, $data, 'jenjang');
        echo json_encode($action);
    }

    public function delete()
    {
        $data_id = array(
            'Noreg'  => $this->input->post('id')
        );
        $nopembayaran = $this->model_pengambilanformulir->getnopembayaran($data_id['Noreg'], 'pembayaran_sekolah')->result_array();
        if ($nopembayaran) {
            $deletedetail = $this->model_pengambilanformulir->deletedetail($nopembayaran[0]['Nopembayaran']);
            if ($deletedetail) {
                $deletpembayaran = $this->model_pengambilanformulir->deletepembayaransekolah($data_id['Noreg']);
                if ($deletpembayaran) {
                    $deletecalon = $this->model_pengambilanformulir->deletecalonsiswa($data_id['Noreg']);
                    echo json_encode($deletecalon);
                }
            }
        }
    }

    public function cetak()
    {
        $this->load->library('Configfunction');
        $sysconfig = $this->configfunction->get_sysconfig();
        $data = array(
            'my_sysconfig' => $sysconfig,
        );
        $this->load->view('page/pengambilanformulir/print', $data); //Memanggil function render_view
    }
}
