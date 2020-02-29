<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekening extends CI_Controller {

	function render_view($data) {
        $this->template->load('templateakunting', $data); //Display Page
    }

	public function index() {
        $data = array(
        			'page_content' 	=> '../pageakunting/rekening/view',
        			'ribbon' 		=> '<li class="active">Rekening</li><li>Sample</li>',
					'page_name' 	=> 'Rekening',
        		);
        $this->render_view($data); //Memanggil function render_view
    }
}