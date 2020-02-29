<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surattagihan extends CI_Controller {

	function render_view($data) {
        $this->template->load('templatekasir', $data); //Display Page
    }

	public function index() {
        $data = array(
        			'page_content' 	=> '../pagekasir/surattagihan/view',
        			'ribbon' 		=> '<li class="active">Surat Tagihan</li><li>Sample</li>',
					'page_name' 	=> 'Surat Tagihan',
        		);
        $this->render_view($data); //Memanggil function render_view
    }
}