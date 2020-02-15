<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('modulsiswa/model_siswa');
        $this->load->library('configfunction');
    }

	function render_view($data) {
        $this->template->load('templatesiswa', $data); //Display Page
    }

	public function index() {
        $idthnakademik = $this->configfunction->getidthnakd();
        $th_akademik = $idthnakademik[0]['ID'];

        $visit = $this->model_siswa->count_visit()->result();
        $click = $this->model_siswa->count_click()->result();
        $guru = $this->model_siswa->count_guru()->result();
        $siswa = $this->model_siswa->count_siswa($th_akademik)->result();
        

        // print_r(json_encode($visit));exit;
        $data = array(
        			'page_content' 	=> 'dashboard',
        			'ribbon' 		=> '',
        			'page_name' 	=> 'Home',
                    'visit'         => $visit,
                    'click'         => $click,
                    'guru'          => $guru,
                    'siswa'         => $siswa
        		);
        $this->render_view($data); //Memanggil function render_view
    }
}