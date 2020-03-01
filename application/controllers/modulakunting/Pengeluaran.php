<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran extends CI_Controller {

	function render_view($data) {
        $this->template->load('templateakunting', $data); //Display Page
    }

	public function index() {
        $data = array(
        			'page_content' 	=> '../pageakunting/pengeluaran/view',
        			'ribbon' 		=> '<li class="active">Jenis Pengeluaran</li><li>Sample</li>',
					'page_name' 	=> 'Jenis Pengeluaran',
        		);
        $this->render_view($data); //Memanggil function render_view
    }
}