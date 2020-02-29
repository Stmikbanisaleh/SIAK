<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kartubayar extends CI_Controller {

	function render_view($data) {
        $this->template->load('templatekasir', $data); //Display Page
    }

	public function index() {
        $data = array(
        			'page_content' 	=> '../pagekasir/kartubayar/view',
        			'ribbon' 		=> '<li class="active">Kartu Pembayaran</li><li>Sample</li>',
					'page_name' 	=> 'Kartu Pembayaran',
        		);
        $this->render_view($data); //Memanggil function render_view
    }
}