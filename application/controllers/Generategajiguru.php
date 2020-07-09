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
            $tglawal = $this->input->post('tglawal');
            $tglakhir = $this->input->post('tglakhir');

            $refresh = $this->db->query("delete from tb_pendapatan_guru where effective_date between '" . $tglawal . "' and '" . $tglakhir . "'");
            if ($refresh) {
                $getgaji = $this->db->query("Select b.GuruNama,a.IdGuru,b.GuruNPWP  as NPWP,a.tarif as gaji, a.transport, (a.tunjangan_masakerja + d.lain + d.tunjangan ) as tunj_lain , a.tunjangan_jabatan,b.GuruNama
                ,b.GuruNPWP, c.JMLJAM, c.TARIF,c.HONOR,c.TAMBAHANJAM,c.TAMBAHANHADIR,d.thr,e.infaq_masjid,e.anggota_koperasi, e.kas_bon, e.ijin_telat, e.koperasi, e.bmt, e.inval, e.toko, e.lain,e.tawun, e.pph21
                from tarifguru a
                join tbguru b on a.IdGuru = b.IdGuru
                join htguru c on a.IdGuru = c.IdGuru
                join tbpendapatanlainguru d on a.IdGuru = d.IdGuru
                join tbgurupot e on a.IdGuru = e.IdGuru
                where d.periode between '".$tglawal."' and '" . $tglakhir . "' and c.PERIODE between '".$tglawal."' and '" . $tglakhir . "'
                ")->result_array();
                if ($getgaji) {
                    foreach ($getgaji as $data) {
                        $gettotalngajar = $this->db->query("select SUM(c.jam) as jam ,SUM(a.TAMBAHAN) as tambahan
                        from trdsrm a 
                        join tbjadwal c on a.idJadwal = c.id
                        join mspelajaran d on c.id_mapel = d.id_mapel 
                        where a.TGLHADIR between '".$tglawal."' and '".$tglakhir."' and a.IdGuru = '".$data['IdGuru']."' group by a.IdGuru")->result_array();
                        $pot_lain = $data['infaq_masjid']+$data['anggota_koperasi']+$data['kas_bon']+$data['ijin_telat']+$data['koperasi']+$data['bmt']+$data['inval']+$data['toko']+$data['lain']+$data['tawun'];
                        $data = array(
                            "employee_number" => $data['IdGuru'],
                            "nama"    => $data['GuruNama'],
                            "npwp" => $data['NPWP'],
                            // "jabatan" => $data['NAMAJABATAN'],
                            "status" => "",
                            "effective_date" => $tglakhir,
                            // "awal_kerja" => $data['tgl_mulai_kerja'],
                            "gaji" => $data['gaji'],
                            "jumlah_jam" => $gettotalngajar[0]['jam']+$gettotalngajar[0]['tambahan'],
                            "tunj_jabatan" => $data['tunjangan_jabatan'],
                            "tunj_transport" => $data['transport'],
                            "tunj_lain" => $data['tunj_lain'],
                            "thr"  => $data['thr'],
                            "pph21_bulanan" => $data['pph21'],
                            "pot_lain" => $pot_lain,
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
                            echo json_encode($insert);
                        }
                    }
                }
            }

      
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }
}
