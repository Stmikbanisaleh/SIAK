<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bayarlain extends CI_Controller {

	function render_view($data) {
        $this->template->load('templatekasir', $data); //Display Page
    }

	public function index() {
        $data = array(
        			'page_content' 	=> '../pagekasir/bayarlain/view',
        			'ribbon' 		=> '<li class="active">Pembayaran Lain-Lain</li><li>Sample</li>',
					'page_name' 	=> 'Pembayaran Lain-Lain',
        		);
        $this->render_view($data); //Memanggil function render_view
    }
}