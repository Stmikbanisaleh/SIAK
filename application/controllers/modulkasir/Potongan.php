<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Potongan extends CI_Controller {

	function render_view($data) {
        $this->template->load('templatekasir', $data); //Display Page
    }

	public function index() {
        $data = array(
        			'page_content' 	=> '../pagekasir/potongan/view',
        			'ribbon' 		=> '<li class="active">Potongan</li><li>Sample</li>',
					'page_name' 	=> 'Potongan',
        		);
        $this->render_view($data); //Memanggil function render_view
    }
}