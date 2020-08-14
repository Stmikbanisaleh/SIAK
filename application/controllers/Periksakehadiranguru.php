<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Periksakehadiranguru extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('model_periksakehadiranguru');
        if (empty($this->session->userdata('username')) && empty($this->session->userdata('nama'))) {
            $this->session->set_flashdata('category_error', 'Silahkan masukan username dan password');
            redirect('dashboard/login');
        }
    }

    function render_view($data)
    {
        $this->template->load('template', $data); //Display Page
    }

    public function showmapel()
    {
		$guru = $this->input->post('guru');
        $result = $this->model_periksakehadiranguru->getguru($guru)->result_array();
		echo "<option value='0'>--Pilih Data --</option>";
        foreach ($result as $value) {
            echo "<option value='" . $value['id_mapel'] . "'>[".$value['nama']."] - [".$value['hari']."] - Jam Ke [".$value['JAM']."] - Kelas [".$value['nmklstrjdk']."] - [".$value['SINGKTBPS']."] </option>";
        }
    }
    
    public function index()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
            $myguru = $this->model_periksakehadiranguru->viewOrdering('tbguru','GuruNama','asc')->result_array();
            $data = array(
                'page_content'  => 'periksakehadiranguru/view',
                'ribbon'        => '<li class="active">Periksa Kehadiran Guru</li>',
                'page_name'     => 'Periksa Kehadiran Guru',
                'myguru'    => $myguru,
            );
            $this->render_view($data); //Memanggil function render_view
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }

    public function search()
    {
        $guru = $this->input->post('guru');
        $mapel = $this->input->post('mapel');
        $result = $this->model_periksakehadiranguru->getjadwal($guru, $mapel)->result();
        echo json_encode($result);
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
            $my_data = $this->model_periksakehadiranguru->view_kehadiran()->result();
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
                'ID'  => $this->input->post('id')
            );
            $data = array(
                'TAMBAHAN'  => $this->input->post('tambahan'),
            );
            $action = $this->model_periksakehadiranguru->update($data_id, $data, 'trdsrm');
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
                'MSKHADIR'  => null,
                'SLSHADIR'  => null,
                'STINVAL'  => null,
                'PKBAHASAN'  => null,
                'TGLBAHASAN'  => null,
                'KETTDKHDR'  => null,
                'ASALTGL'  => null,
                'TAMBAHAN'  => null
            );
            $action = $this->model_periksakehadiranguru->update($data_id, $data, 'trdsrm');
            echo json_encode($action);
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }
}
