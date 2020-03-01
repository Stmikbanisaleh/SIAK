<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Neraca extends CI_Controller {

	function render_view($data) {
        $this->template->load('templateakunting', $data); //Display Page
    }

	public function index() {
        $data = array(
        			'page_content' 	=> '../pageakunting/neraca/view',
        			'ribbon' 		=> '<li class="active">Laporan Neraca</li><li>Sample</li>',
					'page_name' 	=> 'Laporan Neraca',
        		);
        $this->render_view($data); //Memanggil function render_view
    }
}