<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_bayarsiswa extends CI_Controller {

	function render_view($data) {
        $this->template->load('templatekasir', $data); //Display Page
    }

	public function index() {
        $data = array(
        			'page_content' 	=> '../pagekasir/lap_bayarsiswa/view',
        			'ribbon' 		=> '<li class="active">Laporan Pembayaran Siswa</li><li>Sample</li>',
					'page_name' 	=> 'Laporan Pembayaran Siswa',
        		);
        $this->render_view($data); //Memanggil function render_view
    }
}