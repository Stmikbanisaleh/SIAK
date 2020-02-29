<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trx_jurnal extends CI_Controller {

	function render_view($data) {
        $this->template->load('templateakunting', $data); //Display Page
    }

	public function index() {
        $data = array(
        			'page_content' 	=> '../pageakunting/trx_jurnal/view',
        			'ribbon' 		=> '<li class="active">Transaksi Jurnal</li><li>Sample</li>',
					'page_name' 	=> 'Transaksi Jurnal',
        		);
        $this->render_view($data); //Memanggil function render_view
    }
}