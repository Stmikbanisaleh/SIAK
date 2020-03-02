<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jeniskelas extends CI_Controller {

	function render_view($data) {
        $this->template->load('templatetu', $data); //Display Page
    }

	public function index() {
        $data = array(
        			'page_content' 	=> '../pagetu/jeniskelas/view',
        			'ribbon' 		=> '<li class="active">Jenis Kelas</li><li>Sample</li>',
					'page_name' 	=> 'Jenis Kelas',
        		);
        $this->render_view($data); //Memanggil function render_view
    }
}