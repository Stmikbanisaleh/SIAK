<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mssiswa extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('model_mssiswa');
    }

    function render_view($data)
    {
        $this->template->load('template', $data); //Display Page
    }

    public function search()
    {
        $noreg = $this->input->post('s_noreg');
        $ta = $this->input->post('ta');
        $sekolah = $this->input->post('sekolah');
        $result = $this->model_mssiswa->getsiswa($noreg,$sekolah)->result();
        // print_r($result);exit;
        echo json_encode($result);
    }

    public function showta()
    {
        $ps = $this->input->post('ps');
        $my_data = $this->model_mssiswa->getta($ps)->result_array();
        echo "<option value='0'>--Pilih Tahun --</option>";
        foreach ($my_data as $value) {
            echo "<option value='" . $value['thn'] . "'>[" . $value['ThnAkademik'] . "] </option>";
        }
    }

    public function index()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
            $this->load->library('Configfunction');
            $tampil_thnakad = $this->configfunction->getthnakd();
            $mysekolah = $this->model_mssiswa->getsekolah()->result_array();
            $myps = $this->model_mssiswa->viewOrdering('tbps','id','desc')->result_array();
            $myagama = $this->model_mssiswa->viewOrdering('tbagama','KDTBAGAMA','desc')->result_array();
            $data = array(
                'page_content'  => 'mssiswa/view',
                'ribbon'        => '<li class="active">Master Siswa</li>',
                'page_name'     => 'Master Siswa',
                'myagama'       => $myagama,
                'myps'          => $myps,
                'mysekolah'     => $mysekolah,
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
                    $arrayCustomerQuote2 = array(
                        'Noreg' => $value[0],
                        // 'PASSWORD' => hash('sha512',md5($value[0])),
                        'Namacasis' => $value[2],
                        'tptlhr' => $value[3],
                        'tgllhr' => $value[4],
                        'agama' => $value[6],
                        'thnmasuk' => $value[7],
                        'kodesekolah' => $value[8],
                        'TelpHp' => $value[11],
                        'createdAt'    => date('Y-m-d H:i:s')
                    );
                    $result = $this->model_mssiswa->insert($arrayCustomerQuote2, 'calon_siswa');
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
            $my_data = $this->model_mssiswa->viewOrdering('mssiswa', 'id', 'asc')->result();
            echo json_encode($my_data);
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }

    public function tampil_byid()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
            $noreg = array(
                'Noreg' => $this->input->get('id')
            );
            $jk = array(
                'status' => 1
            );
            $this->load->library('Configfunction');
            $tampil_thnakad = $this->configfunction->getthnakd();
            $mysekolah = $this->model_mssiswa->getsekolah($tampil_thnakad[0]['THNAKAD'])->result_array();
            $mysiswa = $this->model_mssiswa->view_where('mssiswa', $noreg)->row();
            $myjeniskelamin = $this->model_mssiswa->view_where('msrev', $jk)->result_array();
            $myagama = $this->model_mssiswa->viewOrdering('tbagama','KDTBAGAMA','desc')->result_array();
            $mytbpk = $this->model_mssiswa->viewOrdering('mspenghasilan', 'IDMSPENGHASILAN', 'desc')->result_array();
            $myjob = $this->model_mssiswa->viewOrdering('mspekerjaan', 'IDMSPEKERJAAN', 'desc')->result_array();
            $mytbkec = $this->model_mssiswa->viewOrdering('tbkec', 'IDKEC', 'desc')->result_array();
            $mytbpro = $this->model_mssiswa->viewOrdering('tbpro', 'KDTBPRO', 'desc')->result_array();
            $mypro = $this->model_mssiswa->getpro()->result_array();
            $data = array(
                'page_content'  => 'mssiswa/edit',
                'ribbon'        => '<li class="active">Biodata Siswa</li>',
                'page_name'     => 'Biodata Siswa',
                'mysiswa'       => $mysiswa,
                'myjeniskelamin' => $myjeniskelamin,
                'myagama'       => $myagama,
                'mysekolah'     => $mysekolah,
                'mytbpk'        => $mytbpk,
                'mytbkec'        => $mytbkec,
                'mytbpro'       => $mytbpro,
                'mypro'         => $mypro,
                'myjob'         => $myjob
            );

            $this->render_view($data); //Memanggil function render_view
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
            $count_id = $this->model_mssiswa->view_count('mssiswa', $data_id);
            if ($count_id < 1) {
                $data = array(
                    'NOINDUK'  => $this->input->post('no_induk'),
                    'NOREG'  => $this->input->post('noreg'),
                    'TGLREG'  => $this->input->post('tglreg'),
                    'NMSISWA'  => strtoupper($this->input->post('nmsiswa')),
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
                $action = $this->model_mssiswa->insert($data, 'mssiswa');
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
                'NOREG'  => $this->input->post('noreg')
            );
            $noreg = $this->input->post('noreg');
            //file1 photo siswa
            //photoijazah
            //photonem
            $data = array(
                'NOREG'  => $this->input->post('noreg'),
                'NMSISWA'  => $this->input->post('nama'),
                'AGAMA'  => $this->input->post('agama'),
                'JK'  => $this->input->post('jk'),
                'TGLHR'  => $this->input->post('tglhr'),
                'PS'  => $this->input->post('sekolah'),
                'TPLHR'  => $this->input->post('tempat'),
                'NMBAPAK' => $this->input->post('ayah'),
                'GAJIORTU'  => $this->input->post('penghasilan'),
                'NMIBU' => $this->input->post('ibu'),
                'KELURAHAN' => $this->input->post('kelurahan'),
                'KECAMATAN' => $this->input->post('kecamatan'),
                'KABUPATEN' => $this->input->post('kabupaten'),
                'PROVINSI' => $this->input->post('provinsi'),
                'KDPOS'  => $this->input->post('kdpos'),
                'NOHP'  => $this->input->post('nohp'),
                'NMWALI'  => $this->input->post('wali'),
                'PEKERJAANORTU'  => $this->input->post('pekerjaan'),
                'ALAMATRUMAH'  => $this->input->post('alamat2'),
                'TLPRUMAH'  => $this->input->post('telprmh'),
                'TLPWALI'  => $this->input->post('telpwali'),
                'NMASLSKL'  => $this->input->post('aslsekolah'),
                'PROVINSISEKOLAHASAL'  => $this->input->post('provinsi2'),
                'KABUPATENSEKOLAHASAL' => $this->input->post('kabupaten2'),
                'KELURAHANSEKOLAHASAL' => $this->input->post('kelurahan2'),
                'KECAMATANSEKOLAHASAL' => $this->input->post('kecamatan2'),
                'ALMASLSKL' => $this->input->post('alamat3'),
                'NOIJAZAH' => $this->input->post('noijazah'),
                'THNMASUKSEKOLAHASAL' => $this->input->post('thnmassuk'),
                'NILNEMASLSKL' => $this->input->post('nem'),
                'updatedAt' => date('Y-m-d H:i:s'),
            );
            $action2 = $this->model_mssiswa->update($data_id, $data, 'mssiswa');
            $ceksiswa = $this->db->query("select NOREG from mssiswa where NOREG = '$noreg'");
            echo json_encode(1);
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
            $action = $this->model_mssiswa->update($data_id, $data, 'mssiswa');
            echo json_encode($action);
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }
}
