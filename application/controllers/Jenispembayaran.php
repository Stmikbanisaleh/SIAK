<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenispembayaran extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('model_jenis');
    }

    function render_view($data)
    {
        $this->template->load('template', $data); //Display Page

    }

    public function search()
    {
        $tahun = $this->input->post('tahun');
        $programsekolah = $this->input->post('programsekolah');
        $result = $this->model_jadwal->getjadwal($tahun, $programsekolah)->result();
        echo json_encode($result);
    }

    public function index()
    {
        $data = array(
            'page_content'  => 'jenispembayaran/view',
            'ribbon'        => '<li class="active">Jenis Pembayaran</li>',
            'page_name'     => 'Master Jenis Pembayaran',
        );
        $this->render_view($data); //Memanggil function render_view
    }

    public function tampil()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
            $my_data = $this->model_jenis->viewOrdering('jenispembayaran', 'Kodejnsbayar', 'asc')->result();
            echo json_encode($my_data);
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }

    public function import()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
            $id = $this->input->post('e_id');
            $this->load->library('Configfunction');
            $tampil_thnakad = $this->configfunction->getthnakd();
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
                        'id_jadwal' => $id,
                        'periode' => $tampil_thnakad[0]['THNAKAD'],
                        'NIS' => $value[0],
                        'createdAt'    => date('Y-m-d H:i:s')
                    );
                    $result = $this->model_jadwal->insert($arrayCustomerQuote, 'tbkrs');
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

    public function tampil_byid()
    {
        $data = array(
            'Kodejnsbayar'  => $this->input->post('id'),
        );
        $my_data = $this->model_jenis->view_where('jenispembayaran', $data)->result();
        echo json_encode($my_data);
    }

    public function simpan()
    {
        $this->load->library('Configfunction');
        $data = array(
            'Kodejnsbayar'  => $this->input->post('kdjenisbayar'),
            'namajenisbayar'  => $this->input->post('nmjenisbayar'),
            'createdAt' => date('Y-m-d H:i:s'),
        );
        $action = $this->model_jenis->insert($data, 'jenispembayaran');
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
            'Kodejnsbayar'  => $this->input->post('id')
        );
        $data = array(
            'isdeleted'  => 1,
        );
        $action = $this->model_jenis->update($data_id, $data, 'jenispembayaran');
        echo json_encode($action);
    }
}
