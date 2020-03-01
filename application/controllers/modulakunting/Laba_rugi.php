<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laba_rugi extends CI_Controller {

	function render_view($data) {
        $this->template->load('templateakunting', $data); //Display Page
    }

	public function index() {
        $data = array(
        			'page_content' 	=> '../pageakunting/laba_rugi/view',
        			'ribbon' 		=> '<li class="active">Laporan Laba Rugi</li><li>Sample</li>',
					'page_name' 	=> 'Laporan Laba Rugi',
        		);
        $this->render_view($data); //Memanggil function render_view
    }
}