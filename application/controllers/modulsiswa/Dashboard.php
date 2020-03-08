<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('modulsiswa/model_siswa');
        $this->load->library('configfunction');
    }

    function render_view($data)
    {
        $this->template->load('templatesiswa', $data); //Display Page
    }

    public function index()
    {
        if ($this->session->userdata('username_siswa') != null && $this->session->userdata('email') != null) {
            $idthnakademik = $this->configfunction->getidthnakd();
            $th_akademik = $idthnakademik[0]['ID'];
            $visit = $this->model_siswa->count_visit()->result();
            $click = $this->model_siswa->count_click()->result();
            $guru = $this->model_siswa->count_guru()->result();
            $siswa = $this->model_siswa->count_siswa($th_akademik)->result();
            $data = array(
                'page_content'     => 'dashboard',
                'ribbon'         => '',
                'page_name'     => 'Home',
                'visit'         => $visit,
                'click'         => $click,
                'guru'          => $guru,
                'siswa'         => $siswa
            );
            $this->render_view($data); //Memanggil function render_view
        } else {
            $this->load->view('pagesiswa/login'); //Memanggil function render_view
        }
    }

    public function login()
    {
        $email = $this->input->post('email');
        $password = hash("sha512",md5($this->input->post('password')));
        $query = $this->db->query("select count(NOINDUK) as jml,NMSISWA,NOINDUK,EMAIL from mssiswa where NOINDUK='" . $email . "' and PASSWORD = '$password'  GROUP BY NOINDUK");
        // print_r($this->db->last_query());exit;
        if ($query->num_rows() == 1) {
            $data = $query->result_array();
            foreach ($data as $value) {
                $data = [
                    'username_siswa' => $value['NMSISWA'],
                    'email' => $value['EMAIL'],
                    'nis' => $value['NOINDUK'],
                ];
            }
            $this->session->set_userdata($data);
            redirect('modulsiswa/dashboard/index');
        } else {
            $this->session->set_flashdata('category_error', 'Email atau password salah');
            redirect('modulsiswa/dashboard/index');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('modulsiswa/dashboard/index');
    }
}
