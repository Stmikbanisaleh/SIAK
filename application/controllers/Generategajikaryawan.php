<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Generategajikaryawan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('model_Generategajikaryawan');
    }

    function render_view($data)
    {
        $this->template->load('template', $data); //Display Page
    }

    public function index()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
            $data = array(
                'page_content'  => 'generategajikaryawan/view',
                'ribbon'        => '<li class="active">Generate Gaji Karyawan</li>',
                'page_name'     => 'Generate Gaji Karyawan'
            );
            $this->render_view($data); //Memanggil function render_view
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }

    public function tampil()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
            $my_data = $this->model_Generategajikaryawan->viewOrdering('generate_log', 'id', 'asc')->result();
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
            $refresh = $this->db->query("delete from tb_pendapatan_karyawan where YEAR(effective_date) = '" . $year . "' and MONTH(effective_date) = '" . $bulan . "' ");
            if ($refresh) {
                $getgaji = $this->db->query("Select a.id_karyawan, a.tarif as gaji , a.tunjangan_jabatan, a.transport,a.tunjangan_masakerja,b.nama,b.npwp,c.NAMAJABATAN, b.tgl_mulai_kerja , 
                (d.toko + d.lain + d.infaq_masjid + d.tawun + d.bpjs + d.anggota_koperasi + d.kas_bon + d.ijin_telat + d.bmt + d.koperasi + d.inval) as potongan, d.pph21 ,d.periode,e.tunjangan as tunj_kinerja,e.thr,(e.lain + a.tunjangan_masakerja ) as tunj_lain
                from tarifkaryawan a 
                join biodata_karyawan b on a.id_karyawan = b.nip
                join msjabatan c on b.jabatan = c.ID
                join tbkaryawanpot d on d.id_karyawan = b.nip
                join tbpendapatanlainkaryawan e on a.id_karyawan = e.nip
                where MONTH(d.periode) = '".$bulan."' and YEAR(d.periode) = '" . $year . "'
                ")->result_array();
                if (!empty($getgaji)) {
                    foreach ($getgaji as $data) {
                        $data = array(
                            "employee_number" => $data['id_karyawan'],
                            "nama"    => $data['nama'],
                            "npwp" => $data['npwp'],
                            "pot_lain" => $data['potongan'],
                            "jabatan" => $data['NAMAJABATAN'],
                            "status" => "",
                            "effective_date" => $data['periode'],
                            "awal_kerja" => $data['tgl_mulai_kerja'],
                            "gaji" => $data['gaji'],
                            "jumlah_jam" => "",
                            "tunj_jabatan" => $data['tunjangan_jabatan'],
                            "tunj_lain" => $data['tunj_lain'],
                            "tunj_utility" => $data['tunj_kinerja'],
                            "tunj_transport" => $data['transport'],
                            "thr"  => $data['thr'],
                            "pph21_bulanan" => $data['pph21'],
                            "updatedWith" => $this->session->userdata('nama')

                        );
                        $insert = $this->model_Generategajikaryawan->insert($data, 'tb_pendapatan_karyawan');

                    }
                } else {
                    $insert = false;
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
            } else {
                echo json_encode(false);
            }
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }
}
