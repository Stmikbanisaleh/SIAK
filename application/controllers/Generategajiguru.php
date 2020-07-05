<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Generategajiguru extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('model_Generategajiguru');
    }

    function render_view($data)
    {
        $this->template->load('template', $data); //Display Page
    }

    public function index()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
            $data = array(
                'page_content'  => 'generategajiguru/view',
                'ribbon'        => '<li class="active">Generate Gaji Guru</li>',
                'page_name'     => 'Generate Gaji Guru'
            );
            $this->render_view($data); //Memanggil function render_view
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }

    public function tampil()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
            $my_data = $this->model_Generategajiguru->viewOrdering('generate_log2', 'id', 'asc')->result();
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
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
            $year = $this->input->post('tahun');
            $bulan = $this->input->post('bln');
            $refresh = $this->db->query("delete from tb_pendapatan_guru where YEAR(effective_date) = '" . $year . "' and MONTH(effective_date) = '" . $bulan . "' ");
            if ($refresh) {
                $getgaji = $this->db->query("Select 
                ")->result_array();
                if ($getgaji) {
                    foreach ($getgaji as $data) {
                        $data = array(
                            "employee_number" => $data['id_karyawan'],
                            "nama"    => $data['nama'],
                            "npwp" => $data['npwp'],
                            "pot_taawun" => $data['tawun'],
                            "jabatan" => $data['NAMAJABATAN'],
                            "status" => "",
                            "effective_date" => $data['periode'],
                            "awal_kerja" => $data['tgl_mulai_kerja'],
                            "gaji" => $data['gaji'],
                            "jumlah_jam" => "",
                            "tunj_jabatan" => $data['tunjangan_jabatan'],
                            "tunj_transport" => $data['transport'],
                            "tunj_masakerja" => $data['tunjangan_masakerja'],
                            "thr"  => $data['thr'],
                            "pot_inval" => $data['inval'],
                            "pot_anggotakoperasi" => $data['anggota_koperasi'],
                            "pot_infaqmasjid" => $data['infaq_masjid'],
                            "pot_kasbon" => $data['kas_bon'],
                            "pot_ijintelat" => $data['ijin_telat'],
                            "pot_bmt" => $data['bmt'],
                            "pot_koperasi" => $data['koperasi'],
                            "pot_tokoalhamra" => $data['toko'],
                            "pot_lain" => $data['lain'],
                            "pot_bpjs" => $data['bpjs'],
                            "pph21_bulanan" => $data['pph21'],
                            "updatedWith" => $this->session->userdata('nama')

                        );
                        $insert = $this->model_Generategajikaryawan->insert($data, 'tb_pendapatan');
                    }
                }
            }

            if ($insert) {
                $log = array(
                    "username" => $this->session->userdata('nama'),
                    "nip" => $this->session->userdata('nip'),
                    "waktu" => date('Y-m-d H:i:s')
                );
                $insertlog = $this->model_Generategajikaryawan->insert($log, 'generate_log');
                echo json_encode($insert);
            }
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }
}
