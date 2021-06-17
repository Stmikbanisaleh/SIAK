<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Calendar extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('model_calendar');
        if (empty($this->session->userdata('username')) && empty($this->session->userdata('nama'))) {
            $this->session->set_flashdata('category_error', 'Silahkan masukan username dan password');
            redirect('dashboard/login');
        }
    }

    function render_view($data)
    {
        $this->template->load('template', $data); //Display Page

    }

    public function index()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
            $data = array(
                'page_content'  => 'calendar/view',
                'ribbon'        => '<li class="active">Calendar</li>',
                'page_name'     => 'Calendar'
            );
            $this->render_view($data); //Memanggil function render_view
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }

    public function tampil()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
            $my_data = $this->model_calendar->viewOrdering('calendar', 'id', 'asc')->result();
            echo json_encode($my_data);
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }

    public function tampil_byid()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
            $data = array(
                'id'  => $this->input->post('id'),
            );
            $my_data = $this->model_calendar->viewWhere('calendar', $data)->result();
            echo json_encode($my_data);
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }

    public function simpan()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
                $data = array(
                    'startdate'  => $this->input->post('start'),
                    'endate'  => $this->input->post('end'),
                    'description'  => $this->input->post('description'),
					'createdBy'  => $this->session->userdata('username'),
                    'createdAt' => date('Y-m-d H:i:s'),
                );
                $action = $this->model_calendar->insert($data, 'calendar');
                echo json_encode($action);
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }

    public function update()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
            $data_id = array(
                'id'  => $this->input->post('e_id')
            );
			$data = array(
				'startdate'  => $this->input->post('e_start'),
				'endate'  => $this->input->post('e_end'),
				'description'  => $this->input->post('e_description'),
				'createdBy'  => $this->session->userdata('username'),
				'createdAt' => date('Y-m-d H:i:s'),
			);
            $action = $this->model_calendar->update($data_id, $data, 'calendar');
            echo json_encode($action);
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }

    public function delete()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
            $data_id = array(
                'id'  => $this->input->post('id')
            );
            $action = $this->model_calendar->delete($data_id, 'calendar');
            echo json_encode($action);
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }
}
