<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Impbayar extends CI_Controller {

	function render_view($data) {
        $this->template->load('templatekasir', $data); //Display Page
    }

	public function index() {
        $data = array(
        			'page_content' 	=> '../pagekasir/impbayar/view',
        			'ribbon' 		=> '<li class="active">Import Pembayaran</li><li>Sample</li>',
					'page_name' 	=> 'Import Pembayaran',
        		);
        $this->render_view($data); //Memanggil function render_view
    }
}