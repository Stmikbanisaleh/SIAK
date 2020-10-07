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

    public function getLastDateOfMonth($year, $month)
    {
        $date = $year.'-'.$month.'-01';  //make date of month
        return date('t', strtotime($date)); 
    }

    public function generate()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');
			$refresh = $this->db->query("delete from tb_pendapatan_guru where tahun  = '" . $tahun . "' and bulan = '" . $bulan . "' ");
            if ($refresh) {
                $getgaji = $this->db->query("Select d.inval as invalan,b.GuruBase as status, b.GuruNama,a.IdGuru,b.GuruNPWP  as NPWP,a.tarif as gaji, a.transport, a.tunjangan_aksel,
                a.convert,a.tunjangan_internasional, a.tunjangan_keluarga, a.tunjangan_walas, d.tunj_khusus1, d.tunj_khusus2, d.ket_tunj_khusus1,d.ket_tunj_khusus2,d.lain as tunj_lain,
                a.tunjangan_pegawai_tetap, a.tunjangan_masakerja, a.tunjangan_jabatan,b.GuruNama,b.GuruNPWP, c.JMLJAM, c.TARIF,c.HONOR,c.TAMBAHANJAM,c.TAMBAHANHADIR,d.thr,
                a.tunjangan_bpjs,e.infaq_masjid,e.anggota_koperasi, e.kas_bon, e.ijin_telat, e.koperasi, e.bmt, e.inval,e.ltq, e.toko, e.lain,e.tawun, e.pph21,e.bpjs as pot_bpjs,
                d.tunjangan,d.jam1, d.tarif1,d.jam2,d.tarif2,d.jam3,d.tarif3, d.jam4, d.tarif4, e.ket_khusus1 as ket_pot_khusus,e.tunj_khusus1 as pot_khusus
                from tarifguru a
                join tbguru b on a.IdGuru = b.IdGuru
                left join htguru c on a.IdGuru = c.IdGuru
                left join tbpendapatanlainguru d on a.IdGuru = d.IdGuru
                left join tbgurupot e on a.IdGuru = e.IdGuru
                ")->result_array();
                if ($getgaji) {
                    foreach ($getgaji as $data) {
                        // $jam = $this->model
                        $lastday = $this->getLastDateOfMonth($tahun, $bulan);
                        $pot_lain = $data['infaq_masjid']+$data['anggota_koperasi']+$data['kas_bon']+$data['ijin_telat']+$data['koperasi']+$data['bmt']+$data['inval']+$data['toko']+$data['lain']+$data['tawun'];
                        $tahun = $this->input->post('tahun');
                        $data = array(
                            "employee_number" => $data['IdGuru'],
                            "nama"    => $data['GuruNama'],
                            "npwp" => $data['NPWP'],
                            "status" => $data['status'],
                            "tahun" => $tahun,
							"bulan" => $bulan,
                            "inval" => $data['invalan'],
                            "gaji" => $data['gaji'],
                            "tunj_penilaian_kinerja" => $data['tunjangan'],
                            "tunj_tetap" => $data['tunjangan_pegawai_tetap'],
                            "effective_date" => $tahun.'-'.$bulan.'-'.$lastday,
                            "tunj_jabatan" => $data['tunjangan_jabatan'],
                            "tunj_transport" => $data['transport'],
                            "tunj_international" => $data['tunjangan_internasional'],
                            "tunj_aksel" => $data['tunjangan_aksel'],
                            "tunj_keluarga" => $data['tunjangan_keluarga'],
                            "tunj_walas" => $data['tunjangan_walas'],
                            "tunj_khusus1" => $data['tunj_khusus1'],
                            "tunj_khusus2" => $data['tunj_khusus2'],
                            "honor_berkala" => $data['tunjangan_masakerja'],
                            "convert" => $data['convert'],
                            "ket_tunj_khusus1" => $data['ket_tunj_khusus1'],
                            "ket_tunj_khusus2" => $data['ket_tunj_khusus2'],
                            "attribute_1" => $data['jam1'],
                            "attribute_2" => $data['tarif1'],
                            "attribute_3" => $data['jam2'],
                            "attribute_4" => $data['tarif2'],
                            "attribute_5" => $data['jam3'],
                            "attribute_6" => $data['tarif3'],
                            "attribute_7" => $data['jam4'],
                            "attribute_8" => $data['tarif4'],
                            "tunj_bpjs" => $data['tunjangan_bpjs'],
                            "tunj_lain" => $data['tunj_lain'],
                            "thr"  => $data['thr'],
                            "pph21_bulanan" => $data['pph21'],
                            "ket_pot_khusus" => $data['ket_pot_khusus'],
                            "pot_khusus" => $data['pot_khusus'],
                            "pot_lain" => $data['lain'],
                            "pot_ltq" => $data['ltq'],
                            "pot_inval" => $data['inval'],
                            "pot_infaq_masjid" => $data['infaq_masjid'],
                            "pot_anggota_koperasi" => $data['anggota_koperasi'],
                            "pot_kas_bon" => $data['kas_bon'],
                            "pot_ijin_telat" => $data['ijin_telat'],
                            "pot_bmt" => $data['bmt'],
                            "pot_koperasi" => $data['koperasi'],
                            "pot_toko" => $data['toko'],
                            "pph21_bulanan" => $data['pph21'],
                            "pot_bpjs" => $data['pot_bpjs'],
                            "pot_tawun" => $data['tawun'],
                            "updatedWith" => $this->session->userdata('nama')
                        );
                        $insert = $this->model_Generategajiguru->insert($data, 'tb_pendapatan_guru');
                        if ($insert) {
                            $log = array(
                                "username" => $this->session->userdata('nama'),
                                "nip" => $this->session->userdata('nip'),
                                "waktu" => date('Y-m-d H:i:s')
                            );
                            $insertlog = $this->model_Generategajiguru->insert($log, 'generate_log2');
                        }
                    }
                }
            }
            echo json_encode($insert);
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }
}
