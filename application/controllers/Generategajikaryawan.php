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

    public function getLastDateOfMonth($year, $month)
    {
        $date = $year.'-'.$month.'-01';  //make date of month
        return date('t', strtotime($date)); 
    }

    public function generate()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
            $year = $this->input->post('tahun');
            $bulan = $this->input->post('bln');
            $refresh = $this->db->query("delete from tb_pendapatan_karyawan where tahun  = '" . $year . "' and bulan = '" . $bulan . "' ");
            if ($refresh) {
                $getgaji = $this->db->query("Select a.id_karyawan,a.bpjs,a.tarif+a.honor as gaji ,a.tunj_pembinaan, a.tunj_keluarga, a.tunjangan_jabatan, a.transport,a.tunjangan_masakerja,a.tunj_pegawai_tetap, b.nama,b.npwp,c.NAMAJABATAN, b.tgl_mulai_kerja , 
                d.jht, d.inval, d.infaq_masjid as infaq_masjid , d.toko  as toko, d.tawun as tawun , d.bpjs as bpjs,  d.anggota_koperasi  as agt_koperasi, d.kas_bon as kas_bon,d.bmt,d.ijin_telat ,d.koperasi , d.lain as lain, d.pph21 ,d.periode,e.tunjangan as tunj_kinerja,e.thr,(e.lain + a.tunjangan_masakerja ) as tunj_lain,e.tunj_khusus1,e.tunj_khusus2,e.ket_tunj_khusus1,e.ket_tunj_khusus2
                from tarifkaryawan a 
                join biodata_karyawan b on a.id_karyawan = b.nip
                join msjabatan c on b.jabatan = c.ID
                join tbkaryawanpot d on d.id_karyawan = b.nip
                join tbpendapatanlainkaryawan e on a.id_karyawan = e.nip
                ")->result_array();
                $lastday = $this->getLastDateOfMonth($year, $bulan);
                if (!empty($getgaji)) {
                    foreach ($getgaji as $data) {
                        $data = array(
                            "employee_number" => $data['id_karyawan'],
                            "nama"    => $data['nama'],
                            "npwp" => $data['npwp'],
                            "pot_lain" => $data['lain'],
                            "pot_iuran_jht" => $data['jht'],
                            "pot_infaq_masjid" => $data['infaq_masjid'],
                            "pot_toko" => $data['toko'],
                            "pot_tawun" => $data['tawun'],
                            "pot_bpjs" => $data['bpjs'],
                            "pot_kas_bon" => $data['kas_bon'],
                            "pot_bmt" => $data['bmt'],
                            "pot_inval" => $data['inval'],
                            "pot_ijin_telat" => $data['ijin_telat'],
                            "pot_anggota_koperasi" => $data['agt_koperasi'],
                            "pot_koperasi" => $data['koperasi'],
                            "jabatan" => $data['NAMAJABATAN'],
                            "status" => "",
                            "effective_date" => $year.'-'.$bulan.'-'.$lastday,
                            "bulan" => $bulan,
                            "tahun" => $year,
                            "awal_kerja" => $data['tgl_mulai_kerja'],
                            "gaji" => $data['gaji'],
                            "jumlah_jam" => "",
                            "tunj_jabatan" => $data['tunjangan_jabatan'],
                            "tunj_bpjs" => $data['bpjs'],
                            "tunj_pembinaan" => $data['tunj_pembinaan'],
                            "tunj_khusus1" => $data['tunj_khusus1'],
                            "tunj_khusus2" => $data['tunj_khusus2'],
                            "ket_tunj_khusus1" => $data['ket_tunj_khusus1'],
                            "ket_tunj_khusus2" => $data['ket_tunj_khusus2'],
                            "tunj_lain" => $data['tunj_lain'],
                            "tunj_tetap" => $data['tunj_pegawai_tetap'],
                            "tunj_utility" => $data['tunj_kinerja'],
                            "tunj_keluarga" => $data['tunj_keluarga'],
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
