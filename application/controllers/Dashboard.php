<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function render_view($data) {
        $this->template->load('template', $data); //Display Page
    }

	public function index() {
        $data = array(
        			'page_content' 	=> 'dashboard',
        			'ribbon' 		=> '<li class="active">Dashboard</li><li>Sample</li>',
        			'page_name' 	=> 'Dashboard',
        		);
        $this->render_view($data); //Memanggil function render_view
    }
}