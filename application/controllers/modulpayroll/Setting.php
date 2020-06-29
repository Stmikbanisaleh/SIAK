<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('payroll/model_setting');
	}

	function render_view($data)
	{
		$this->template->load('templatepayroll', $data); //Display Page
	}

	public function index()
	{
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {
			$my_pembayaran = $this->model_setting->view('jnspembayaran')->result_array();
			$data = array(
				'page_content' 	=> '../pagepayroll/setting/editpassword',
				'ribbon' 		=> '<li class="active">Ganti Password</li>',
				'page_name' 	=> 'Ganti Password',
				'js' 			=> 'js_file',
				'my_pembayaran' => $my_pembayaran,
			);
			$this->render_view($data); //Memanggil function render_view
		} else {
			$this->load->view('pagepayroll/login'); //Memanggil function render_view
		}
	}

    public function update()
    {
        if($this->input->post('password') == $this->input->post('password_new')){
            $data_id = array(
                'nip'  => $this->session->userdata('nip')
            );
            $data = array(
                'PASSWORD'  => hash('sha512',md5($this->input->post('password'))),
                'updatedAt' => date('Y-m-d H:i:s'),
            );
            $action = $this->model_setting->update($data_id, $data, 'tbpengawas');
            echo json_encode($action);
        } else {
            echo json_encode(false);
        }
        
    }

}
