<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tarifbayar extends CI_Controller {

	function render_view($data) {
        $this->template->load('templatetu', $data); //Display Page
    }

	public function index() {
        $data = array(
        			'page_content' 	=> '../pagetu/tarifbayar/view',
        			'ribbon' 		=> '<li class="active">Tarif Pembayaran</li><li>Sample</li>',
					'page_name' 	=> 'Tarif Pembayaran',
        		);
        $this->render_view($data); //Memanggil function render_view
    }
}