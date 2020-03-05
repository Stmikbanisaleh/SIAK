<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('model_siswa');
        $this->load->model('model_guru');
    }

    function render_view($data)
    {
        $this->template->load('template', $data); //Display Page

    }

    public function index()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {

            $myps = $this->model_guru->view('tbps')->result_array();
            $myagama = $this->model_guru->view('tbagama')->result_array();
            $data = array(
                'page_content'  => 'siswa/view',
                'ribbon'        => '<li class="active">Siswa</li>',
                'page_name'     => 'Siswa',
                'myagama'       => $myagama,
                'myps'          => $myps
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
                        'NOINDUK' => $value[0],
                        'NOREG' => $value[1],
                        'NMSISWA' => $value[2],
                        'TPLHR' => $value[3],
                        'TGLHR' => $value[4],
                        'JK' => $value[5],
                        'AGAMA' => $value[6],
                        'TAHUN' => $value[7],
                        'PS' => $value[8],
                        'KDWARGA' => $value[9],
                        'EMAIL' => $value[10],
                        'TELP' => $value[11],
                        'createdAt'    => date('Y-m-d H:i:s')
                    );
                    $result = $this->model_siswa->insert($arrayCustomerQuote, 'mssiswa');
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

            $my_data = $this->model_siswa->view('mssiswa', 'id', 'asc')->result();
            echo json_encode($my_data);
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }

    public function tampil_byid()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {

            $data = array(
                'ID'  => $this->input->post('id'),
            );
            $my_data = $this->model_siswa->view_where('mssiswa', $data)->result();
            echo json_encode($my_data);
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }

    public function simpan()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {

            $data_id = array(
                'NOINDUK'  => $this->input->post('no_induk'),
            );
            $count_id = $this->model_siswa->view_count('mssiswa', $data_id);
            if ($count_id < 1) {
                $data = array(
                    'NOINDUK'  => $this->input->post('no_induk'),
                    'NOREG'  => $this->input->post('noreg'),
                    'TGLREG'  => $this->input->post('tglreg'),
                    'NMSISWA'  => $this->input->post('nmsiswa'),
                    'TPLHR'  => $this->input->post('tplhr'),
                    'TGLHR'  => $this->input->post('tglhr'),
                    'JK'  => $this->input->post('jk'),
                    'AGAMA'  => $this->input->post('agama'),
                    'TAHUN'  => $this->input->post('tahun'),
                    'PS'  => $this->input->post('programsekolah'),
                    'KDWARGA'  => $this->input->post('kdwarga'),
                    'EMAIL'  => $this->input->post('email'),
                    'TELP'  => $this->input->post('telp'),
                    'IDUSER'  => $this->session->userdata('nip'),
                    'createdAt' => date('Y-m-d H:i:s'),
                );
                $action = $this->model_siswa->insert($data, 'mssiswa');
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
                'NOINDUK'  => $this->input->post('e_no_induk'),
                'NOREG'  => $this->input->post('e_noreg'),
                'TGLREG'  => $this->input->post('e_tglreg'),
                'NMSISWA'  => $this->input->post('e_nmsiswa'),
                'TPLHR'  => $this->input->post('e_tplhr'),
                'TGLHR'  => $this->input->post('e_tglhr'),
                'JK'  => $this->input->post('e_jk'),
                'AGAMA'  => $this->input->post('e_agama'),
                'TAHUN'  => $this->input->post('e_tahun'),
                'PS'  => $this->input->post('e_programsekolah'),
                'KDWARGA'  => $this->input->post('e_kdwarga'),
                'EMAIL'  => $this->input->post('e_email'),
                'TELP'  => $this->input->post('e_telp'),
                'IDUSER'  => $this->session->userdata('nip'),
                'updatedAt' => date('Y-m-d H:i:s'),
            );
            $action = $this->model_siswa->update($data_id, $data, 'mssiswa');
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
            $action = $this->model_siswa->update($data_id, $data, 'mssiswa');
            echo json_encode($action);
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }
}
