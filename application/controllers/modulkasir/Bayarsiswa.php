<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bayarsiswa extends CI_Controller {

	function render_view($data) {
        $this->template->load('templatekasir', $data); //Display Page
    }

	public function index() {
        $data = array(
        			'page_content' 	=> '../pagekasir/bayarsiswa/view',
        			'ribbon' 		=> '<li class="active">Pembayaran Siswa</li><li>Sample</li>',
					'page_name' 	=> 'Pembayaran Siswa',
        		);
        $this->render_view($data); //Memanggil function render_view
    }
}