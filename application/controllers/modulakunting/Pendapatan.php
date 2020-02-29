<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendapatan extends CI_Controller {

	function render_view($data) {
        $this->template->load('templateakunting', $data); //Display Page
    }

	public function index() {
        $data = array(
        			'page_content' 	=> '../pageakunting/pendapatan/view',
        			'ribbon' 		=> '<li class="active">Penerimaan Pendapatan</li><li>Sample</li>',
					'page_name' 	=> 'Penerimaan Pendapatan',
        		);
        $this->render_view($data); //Memanggil function render_view
    }
}