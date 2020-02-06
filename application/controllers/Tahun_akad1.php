<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tahun_akad1 extends CI_Controller {

    function __construct(){
        parent::__construct();      
        $this->load->model('model_tahun_akademik');

    }

	function render_view($data) {
        $this->template->load('template', $data); //Display Page
       
    }

	public function index() {
        $data = array(
                    'page_content'  => 'tahun_akademik/view',
                    'ribbon'        => '<li class="active">Tahun Akademik 1</li>',
                    'page_name'     => 'Tahun Akademik 1'
                );
        $this->render_view($data); //Memanggil function render_view
    }

    public function tampil()
    {
        $my_data = $this->model_tahun_akademik->viewOrdering('tbakadmk','id','asc')->result();
        echo json_encode($my_data);
    }

    public function tampil_byid()
    {
        $data = array(
            'id'  => $this->input->post('id'),
        );
        $my_data = $this->model_tahun_akademik->view_where('tbakadmk',$data)->result();
        echo json_encode($my_data);
    }

    public function simpan()
    {
        $data_id = array(
            'RUANG'  => $this->input->post('ruang'),
        );
        $count_id = $this->model_tahun_akademik->view_count('tbakadmk', $data_id);
        if($count_id<1){
            $data = array(
                'RUANG'  => $this->input->post('ruang'),
                'GEDUNG'  => $this->input->post('gedung'),
                'LANTAI'  => $this->input->post('lantai'),
                'PROJECTOR'  => $this->input->post('projector'),
                'LUAS'  => $this->input->post('luas'),
                'FUNGSI'  => $this->input->post('fungsi'),
                'JUMKURSI'  => $this->input->post('kursi'),
                'KETERANGAN'  => $this->input->post('keterangan'),
                'STATUS'  => $this->input->post('aktif'),
                'createdAt' => date('Y-m-d H:i:s'),
            );
            $action = $this->model_tahun_akademik->insert($data,'tbakadmk');
            echo json_encode($action);
        }else{
            echo json_encode(401);
        }
        
    }

    public function update()
    {
        $data_id = array(
            'ID'  => $this->input->post('e_id')
        );
        $data = array(
            'RUANG'  => $this->input->post('e_ruang'),
            'GEDUNG'  => $this->input->post('e_gedung'),
            'LANTAI'  => $this->input->post('e_lantai'),
            'PROJECTOR'  => $this->input->post('e_projector'),
            'LUAS'  => $this->input->post('e_luas'),
            'FUNGSI'  => $this->input->post('e_fungsi'),
            'JUMKURSI'  => $this->input->post('e_kursi'),
            'KETERANGAN'  => $this->input->post('e_keterangan'),
            'STATUS'  => $this->input->post('e_aktif'),
            'updatedAt' => date('Y-m-d H:i:s'),
        );
        $action = $this->model_tahun_akademik->update($data_id,$data,'tbakadmk');
        echo json_encode($action);
        
    }

    public function delete()
    {
        $data_id = array(
            'ID'  => $this->input->post('id')
        );
        $data = array(
            'isdeleted'  => 1,
        );
        $action = $this->model_tahun_akademik->update($data_id,$data,'tbakadmk');
        echo json_encode($action);
        
    }
}