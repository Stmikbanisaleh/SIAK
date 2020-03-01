<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trx_keluar extends CI_Controller {

	function render_view($data) {
        $this->template->load('templateakunting', $data); //Display Page
    }

	public function index() {
        $data = array(
        			'page_content' 	=> '../pageakunting/trx_keluar/view',
        			'ribbon' 		=> '<li class="active">Transaksi Pengeluaran</li><li>Sample</li>',
					'page_name' 	=> 'Transaksi Pengeluaran',
        		);
        $this->render_view($data); //Memanggil function render_view
    }
}