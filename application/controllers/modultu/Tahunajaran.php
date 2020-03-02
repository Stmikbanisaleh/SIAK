<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tahunajaran extends CI_Controller {

	function render_view($data) {
        $this->template->load('templatetu', $data); //Display Page
    }

	public function index() {
        $data = array(
        			'page_content' 	=> '../pagetu/tahunajaran/view',
        			'ribbon' 		=> '<li class="active">Tahun Ajaran</li><li>Sample</li>',
					'page_name' 	=> 'Tahun Ajaran',
        		);
        $this->render_view($data); //Memanggil function render_view
    }
}