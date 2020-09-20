<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status_bayarsiswa extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('akunting/model_surattagihan');
        $this->load->model('kasir/model_status_bayarsiswa');
        $this->load->library('mainfunction');
        $this->load->library('Configfunction');
        if (empty($this->session->userdata('kodekaryawan')) && empty($this->session->userdata('namakasir'))) {
            $this->session->set_flashdata('category_error', 'Silahkan masukan username dan password');
            redirect('modulkasir/dashboard/login');
        }
    }

    function render_view($data) {
        $this->template->load('templatekasir', $data); //Display Page
    }

    public function index() {
        $my_siswa = $this->model_surattagihan->view('mssiswa')->result_array();
        $my_kelas = $this->model_surattagihan->view('tbkelas')->result_array();
        $my_tahun = $this->model_surattagihan->gettahun('tbakadmk2')->result_array();
        $data = array(
         'page_content' 	=> '../pagekasir/status_bayarsiswa/view',
         'ribbon' 		=> '<li class="active">Status Pembayaran Siswa</li>',
         'page_name' 	=> 'Pembayaran Siswa',
         'my_siswa'      => $my_siswa,
         'my_kelas'     => $my_kelas,
         'my_tahun'     => $my_tahun
     );
        $this->render_view($data); //Memanggil function render_view
    }

    public function search_siswa()
    {
        $result = $this->model_status_bayarsiswa->view_siswa($this->input->post('siswa'))->result_array();
        echo json_encode($result);
    }

    public function view_list_status()
    {
        $result = $this->model_status_bayarsiswa->view_list_status($this->input->post('siswa'), $this->input->post('thnakad'))->result_array();
        echo json_encode($result);
    }

    public function update_lunas()
    {
        $nominal = $this->input->post('e_nominal_v');
        $nis = $this->input->post('e_nis');
        $kodejnsbayar = $this->input->post('e_kodejnsbayar');
        $kelas = $this->input->post('e_kelas');
        $ta = $this->input->post('e_ta');

        $id_mapping = $nis.$kelas.'-'.$ta.'-'.$kodejnsbayar;
        $hasil_detail_bayar = $this->model_status_bayarsiswa->view_detail_bayar($nis, $kodejnsbayar, $kelas, $ta)->result_array();
        $data = array(
            'id'  => $id_mapping,
            'nominal'  => $nominal,
            'status'  => 'L',
            'userinput'  => $this->session->userdata('kodekaryawan'),
            'createdAt' => date('Y-m-d H:i:s'),
            'updatedAt' => date('Y-m-d H:i:s'),
        );
        $hasil = false;
        $action = $this->model_status_bayarsiswa->insert($data, 'mapping_status_pembayaran');

        if($action){
            $hasil = true;
            foreach($hasil_detail_bayar as $row){
                $data_id = array(
                    'NodetailBayar'  => $row['NodetailBayar']
                );
                $data = array(
                    'id_status_pembayaran'  => $id_mapping,
                    'updatedAt' => date('Y-m-d H:i:s'),
                );
                $action = $this->model_status_bayarsiswa->update($data_id, $data, 'detail_bayar_sekolah');
                if($action){
                    $hasil = true;
                }
            }
        }
        echo json_encode($hasil);
    }

    public function delete()
    {
        $data_id = array(
            'id'  => $this->input->post('id')
        );
        $action = $this->model_status_bayarsiswa->delete($data_id, 'mapping_status_pembayaran');
        echo json_encode($action);
    }
}
