<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenisbayar extends CI_Controller {

	function render_view($data) {
        $this->template->load('templatetu', $data); //Display Page
    }

	public function index() {
        $data = array(
        			'page_content' 	=> '../pagetu/jenisbayar/view',
        			'ribbon' 		=> '<li class="active">Jenis Pembayaran</li><li>Sample</li>',
					'page_name' 	=> 'Jenis Pembayaran',
        		);
        $this->render_view($data); //Memanggil function render_view
    }
}