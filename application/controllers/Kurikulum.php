<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kurikulum extends CI_Controller {

    function __construct(){
        parent::__construct();      
        $this->load->model('model_kurikulum');

    }

	function render_view($data) {
        $this->template->load('template', $data); //Display Page
       
    }

	public function index() {
        $data = array(
                    'page_content'  => 'kurikulum/view',
                    'ribbon'        => '<li class="active">Master Kurikulum</li>',
                    'page_name'     => 'Master Kurikulum'
                );
        $this->render_view($data); //Memanggil function render_view
    }

    public function tampil()
    {
        $my_data = $this->model_jabatan->viewOrdering('kurikulum','id','asc')->result();
        echo json_encode($my_data);
    }

    public function tampil_byid()
    {
        $data = array(
            'id'  => $this->input->post('id'),
        );
        $my_data = $this->model_jabatan->view_where('kurikulum',$data)->result();
        echo json_encode($my_data);
    }

    public function simpan()
    {
        $data_id = array(
            'nama'  => $this->input->post('nama')
        );
        $count_id = $this->model_jabatan->view_count('kurikulum', $data_id);
        if($count_id<1){
            $data = array(
                'id'  => $this->input->post('id'),
                'nama'  => $this->input->post('nama'),
                'createdAt' => date('Y-m-d H:i:s'),
            );
            $action = $this->model_jabatan->insert($data,'kurikulum');
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
        $action = $this->model_jabatan->update($data_id,$data,'kurikulum');
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
        $action = $this->model_jabatan->update($data_id,$data,'kurikulum');
        echo json_encode($action);
        
    }
}