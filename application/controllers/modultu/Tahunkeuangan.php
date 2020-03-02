<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tahunkeuangan extends CI_Controller {

	function render_view($data) {
        $this->template->load('templatetu', $data); //Display Page
    }

	public function index() {
        $data = array(
        			'page_content' 	=> '../pagetu/tahunkeuangan/view',
        			'ribbon' 		=> '<li class="active">Tahun Keuangan</li><li>Sample</li>',
					'page_name' 	=> 'Tahun Keuangan',
        		);
        $this->render_view($data); //Memanggil function render_view
    }
}