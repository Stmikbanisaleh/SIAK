<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemasukan extends CI_Controller {

	function render_view($data) {
        $this->template->load('templateakunting', $data); //Display Page
    }

	public function index() {
        $data = array(
        			'page_content' 	=> '../pageakunting/pemasukan/view',
        			'ribbon' 		=> '<li class="active">Jenis Pemasukan</li><li>Sample</li>',
					'page_name' 	=> 'Jenis Pemasukan',
        		);
        $this->render_view($data); //Memanggil function render_view
    }
}