<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buk extends CI_Controller {

	function render_view($data) {
        $this->template->load('templateakunting', $data); //Display Page
    }

	public function index() {
        $data = array(
        			'page_content' 	=> '../pageakunting/buk/view',
        			'ribbon' 		=> '<li class="active">BUK</li><li>Sample</li>',
					'page_name' 	=> 'BUK',
        		);
        $this->render_view($data); //Memanggil function render_view
    }
}