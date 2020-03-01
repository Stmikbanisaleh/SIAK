<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tunggakan extends CI_Controller {

	function render_view($data) {
        $this->template->load('templatekasir', $data); //Display Page
    }

	public function index() {
        $data = array(
        			'page_content' 	=> '../pagekasir/tunggakan/view',
        			'ribbon' 		=> '<li class="active">Tunggakan</li><li>Sample</li>',
					'page_name' 	=> 'Tunggakan',
        		);
        $this->render_view($data); //Memanggil function render_view
    }
}