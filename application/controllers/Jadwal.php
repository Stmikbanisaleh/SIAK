<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {

    function __construct(){
        parent::__construct();      
        $this->load->model('model_jadwal');

    }

	function render_view($data) {
        $this->template->load('template', $data); //Display Page
       
    }

	public function index() {
        $mytahun = $this->model_jadwal->gettahun()->result_array();
		$myps = $this->model_jadwal->getps()->result_array();
        $data = array(
                    'page_content'  => 'jadwal/view',
                    'ribbon'        => '<li class="active">Master Jadwal</li>',
                    'page_name'     => 'Master Jadwal',
                    'mytahun'		=> $mytahun,
                    'myps'			=> $myps
                );
        $this->render_view($data); //Memanggil function render_view
    }

    public function tampil()
    {
        $my_data = '';
        echo json_encode($my_data);
    }

    public function tampil_byid()
    {
        $data = array(
            'id'  => $this->input->post('id'),
        );
        $my_data = $this->model_jadwal->view_where('tbjadwal',$data)->result();
        echo json_encode($my_data);
    }

    public function simpan()
    {
        $data_id = array(
            'nama'  => $this->input->post('nama')
        );
        $count_id = $this->model_jadwal->view_count('tbjadwal', $data_id);
        if($count_id<1){
            $data = array(
                'id'  => $this->input->post('id'),
                'nama'  => $this->input->post('nama'),
                'createdAt' => date('Y-m-d H:i:s'),
            );
            $action = $this->model_jadwal->insert($data,'tbjadwal');
            echo json_encode($action);
        }else{
            echo json_encode(401);
        }
        
    }

    public function update()
    {
        $data_id = array(
            'id'  => $this->input->post('e_id')
        );
        $data = array(
            'nama'  => $this->input->post('e_nama'),
            'updatedAt' => date('Y-m-d H:i:s'),
        );
        $action = $this->model_jadwal->update($data_id,$data,'tbjadwal');
        echo json_encode($action);
        
    }

    public function delete()
    {
        $data_id = array(
            'id'  => $this->input->post('id')
        );
        $data = array(
            'isdeleted'  => 1,
        );
        $action = $this->model_jadwal->update($data_id,$data,'tbjadwal');
        echo json_encode($action);
        
    }
}