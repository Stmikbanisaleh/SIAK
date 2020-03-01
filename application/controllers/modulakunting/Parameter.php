<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parameter extends CI_Controller {

	function render_view($data) {
        $this->template->load('templateakunting', $data); //Display Page
    }

	public function index() {
        $data = array(
        			'page_content' 	=> '../pageakunting/parameter/view',
        			'ribbon' 		=> '<li class="active">Parameter</li><li>Sample</li>',
					'page_name' 	=> 'Parameter',
        		);
        $this->render_view($data); //Memanggil function render_view
    }
}