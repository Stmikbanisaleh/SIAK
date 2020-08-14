<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekapkehadiranguru extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('model_rekapkehadiranguru');
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
            $my_data = $this->model_rekapkehadiranguru->viewOrdering('tbguru', 'id', 'asc')->result_array();
            $data = array(
                'page_content'  => 'rekapkehadiranguru/view',
                'ribbon'        => '<li class="active">Rekap Kehadiran Guru</li>',
                'page_name'     => 'Rekap Kehadiran Guru',
                'my_data'       => $my_data
            );
            $this->render_view($data); //Memanggil function render_view
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }

    public function tampil()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {

            $my_data = $this->model_tahun_akademik->viewOrdering('tbps', 'kdtbps', 'asc')->result();
            echo json_encode($my_data);
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }

    public function tampil_byid()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {

            $data = array(
                'KDTBPS'  => $this->input->post('id'),
            );
            $my_data = $this->model_tahun_akademik->view_where('tbps', $data)->result();
            echo json_encode($my_data);
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }

    public function update()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {

            $data_id = array(
                'KDTBPS'  => $this->input->post('e_id')
            );
            $data = array(
                'DESCRTBPS'  => $this->input->post('e_deskripsi'),
                'SINGKTBPS'  => $this->input->post('e_singkatan'),
                'updatedAt' => date('Y-m-d H:i:s'),
            );

            $action = $this->model_tahun_akademik->update($data_id, $data, 'tbps');
            echo json_encode($action);
        } else {
            $this->load->view('page/login'); //Memanggil function render_view
        }
    }

    public function laporan()
    {
        if ($this->session->userdata('username') != null && $this->session->userdata('nama') != null) {
            set_include_path(APPPATH . 'third_party/PHPExcel/Classes/');
            include 'PHPExcel/IOFactory.php';
            $objPHPExcel = new PHPExcel();
            $tahun = $this->input->post('tahun');
            $blnawal = $this->input->post('blnawal');
            $blnakhir = $this->input->post('blnakhir');
            $guru = $this->input->post('guru');
            // $data = $this->model_rekapkehadiranguru->view_kehadiranguru($tahun, $blnawal, $blnakhir, $guru)->result_array();
            $mydata = $this->model_rekapkehadiranguru->view_kehadiranguru_distinct($tahun, $blnawal, $blnakhir, $guru)->result_array();
            $data = array(
                'mydata'    => $mydata,
                'tahun'     => $tahun,
                'blnawal'   => $blnawal,
                'blnakhir'  => $blnakhir
            );

            $this->load->view('page/rekapkehadiranguru/laporan_excel', $data);
            // print_r($data);exit;
            // $no = 1;
            // $row = 3;
            // if (count($data) > 0) {
            //     if ($data) {
            //         $key = array_keys($data[0]);
                    //==========================Header Page============================//
                    // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', ' No ');
                    // $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:A2');

                    // $value = 'No';
                    // $objPHPExcel->getActiveSheet()->getStyle('A1:A2')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('A1:A2')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('A1:A2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('A1:A2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', ' No ');
                    // $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:A2');

                    // $objPHPExcel->getActiveSheet()->getStyle('A1:R2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    // $objPHPExcel->getActiveSheet()->getStyle('A1:R2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

                    // //==============================//
                    // $objPHPExcel->getActiveSheet()->getStyle('A1:A2')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('A1:A2')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('A1:A2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('A1:A2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', ' No ');
                    // $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:A2');

                    // //==============================//
                    // $objPHPExcel->getActiveSheet()->getStyle('B1:B2')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('B1:B2')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('B1:B2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('B1:B2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'NIP');
                    // $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B1:B2');
                    // //==============================//
                    // $objPHPExcel->getActiveSheet()->getStyle('C1:C2')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('C1:C2')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('C1:C2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('C1:C2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'Nama');
                    // $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C1:C2');
                    // //==============================//
                    // $objPHPExcel->getActiveSheet()->getStyle('D1:D2')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('D1:D2')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('D1:D2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('D1:D2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'Tanggal');
                    // $objPHPExcel->setActiveSheetIndex(0)->mergeCells('D1:D2');
                    // //==============================//
                    // $objPHPExcel->getActiveSheet()->getStyle('E1:E2')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('E1:E2')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('E1:E2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('E1:E2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', 'Hari');
                    // $objPHPExcel->setActiveSheetIndex(0)->mergeCells('E1:E2');
                    // //==============================//
                    // $objPHPExcel->getActiveSheet()->getStyle('F1:G1')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('F1:G1')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('F1:G1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('F1:G1')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', 'Planned Time');
                    // $objPHPExcel->setActiveSheetIndex(0)->mergeCells('F1:G1');
                    // //==============================//
                    // $objPHPExcel->getActiveSheet()->getStyle('F2')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('F2')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('F2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('F2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F2', 'Jam Masuk');
                    // //==============================//
                    // $objPHPExcel->getActiveSheet()->getStyle('G2')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('G2')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('G2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('G2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G2', 'Jam Keluar');
                    // //==============================//
                    // $objPHPExcel->getActiveSheet()->getStyle('H1:I1')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('H1:I1')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('H1:I1')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('H1:I1')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1', 'Actual Time');
                    // $objPHPExcel->setActiveSheetIndex(0)->mergeCells('H1:I1');
                    // //==============================//
                    // $objPHPExcel->getActiveSheet()->getStyle('H2')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('H2')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('H2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('H2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H2', 'Jam Masuk');
                    // //==============================//
                    // $objPHPExcel->getActiveSheet()->getStyle('I2')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('I2')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('I2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('I2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I2', 'Jam Keluar');
                    // //==============================//
                    // $objPHPExcel->getActiveSheet()->getStyle('J1:J2')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('J1:J2')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('J1:J2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('J1:J2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J1', 'Jam Kerja Standar');
                    // $objPHPExcel->setActiveSheetIndex(0)->mergeCells('J1:J2');
                    // //==============================//
                    // $objPHPExcel->getActiveSheet()->getStyle('K1:K2')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('K1:K2')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('K1:K2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('K1:K2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K1', 'Jam Kerja Actual');
                    // $objPHPExcel->setActiveSheetIndex(0)->mergeCells('K1:K2');
                    // //==============================//
                    // $objPHPExcel->getActiveSheet()->getStyle('L1:L2')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('L1:L2')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('L1:L2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('L1:L2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L1', 'Late In');
                    // $objPHPExcel->setActiveSheetIndex(0)->mergeCells('L1:L2');
                    // //==============================//
                    // $objPHPExcel->getActiveSheet()->getStyle('M1:M2')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('M1:M2')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('M1:M2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('M1:M2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M1', 'Late Out');
                    // $objPHPExcel->setActiveSheetIndex(0)->mergeCells('M1:M2');
                    // //==============================//
                    // $objPHPExcel->getActiveSheet()->getStyle('N1:N2')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('N1:N2')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('N1:N2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('N1:N2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N1', 'Early In');
                    // $objPHPExcel->setActiveSheetIndex(0)->mergeCells('N1:N2');
                    // //==============================//
                    // $objPHPExcel->getActiveSheet()->getStyle('O1:O2')->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('O1:O2')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('O1:O2')->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->getActiveSheet()->getStyle('O1:O2')->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O1', 'Early Out');
                    // $objPHPExcel->setActiveSheetIndex(0)->mergeCells('O1:O2');

                    //==============================//
                    // foreach ($data as $dataExcel) {
                    //     $nip = $dataExcel['nip'];
                    //     $nama = $dataExcel['nama'];
                    //     $tanggal = $dataExcel['tanggal'];
                    //     $hari = $this->configfunction->gethari($dataExcel['hari']);
                    //     // $getjammasuk = $this->model_kehadirankaryawan->view_jammasuk($tanggal, $nip)->result_array();
                    //     // $getjamkeluar = $this->model_kehadirankaryawan->view_jamkeluar($tanggal, $nip)->result_array();


                    //     $objPHPExcel->getActiveSheet()->getStyle('A' . $row)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('A' . $row)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('A' . $row)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('A' . $row)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet(0)->getStyle('A' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                    //     $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('A' . $row, $no, PHPExcel_Cell_DataType::TYPE_STRING);
                    //     $objPHPExcel->getActiveSheet(0)->getColumnDimension('A')->setAutoSize(true);

                    //     $objPHPExcel->getActiveSheet()->getStyle('B' . $row)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('B' . $row)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('B' . $row)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('B' . $row)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet(0)->getStyle('B' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                    //     $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('B' . $row, $nip, PHPExcel_Cell_DataType::TYPE_STRING);
                    //     $objPHPExcel->getActiveSheet(0)->getColumnDimension('B')->setAutoSize(true);

                    //     $objPHPExcel->getActiveSheet()->getStyle('C' . $row)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('C' . $row)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('C' . $row)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('C' . $row)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet(0)->getStyle('C' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                    //     $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('C' . $row, $nama, PHPExcel_Cell_DataType::TYPE_STRING);
                    //     $objPHPExcel->getActiveSheet(0)->getColumnDimension('C')->setAutoSize(true);

                    //     $objPHPExcel->getActiveSheet()->getStyle('D' . $row)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('D' . $row)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('D' . $row)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('D' . $row)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet(0)->getStyle('D' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                    //     $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('D' . $row, $tanggal, PHPExcel_Cell_DataType::TYPE_STRING);
                    //     $objPHPExcel->getActiveSheet(0)->getColumnDimension('D')->setAutoSize(true);

                    //     $objPHPExcel->getActiveSheet()->getStyle('E' . $row)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('E' . $row)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('E' . $row)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('E' . $row)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet(0)->getStyle('E' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                    //     $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('E' . $row, $hari, PHPExcel_Cell_DataType::TYPE_STRING);
                    //     $objPHPExcel->getActiveSheet(0)->getColumnDimension('E')->setAutoSize(true);

                    //     //===================================================//
                    //     //Jika Sabtu Minggu Jam Masuk = 07:30:00 //
                    //     //Jika Bukan Sabtu Minggu Jam Masuk = 06:30:00 //
                    //     if ($hari == 'Sabtu' || $hari == 'Minggu') {
                    //         $jam_masuk = '07:30:00';
                    //     } else {
                    //         $jam_masuk = '06:30:00';
                    //     }
                    //     $objPHPExcel->getActiveSheet()->getStyle('F' . $row)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('F' . $row)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('F' . $row)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('F' . $row)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet(0)->getStyle('F' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                    //     $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('F' . $row, $jam_masuk, PHPExcel_Cell_DataType::TYPE_STRING);
                    //     $objPHPExcel->getActiveSheet(0)->getColumnDimension('F')->setAutoSize(true);
                    //     //===================================================//

                    //     //===================================================//
                    //     //Jika Sabtu Minggu Jam Masuk = 12:00:00 //
                    //     //Jika Bukan Sabtu Minggu Jam Masuk = 17:30:00 //
                    //     //Selisih planned didapat dari selisih jam masuk dan jam keluar//
                    //     if ($hari == 'Sabtu' || $hari == 'Minggu') {
                    //         $jam_keluar = '12:00:00';
                    //         $selisih_planned = '04:30:00';
                    //     } else {
                    //         $jam_keluar = '17:30:00';
                    //         $selisih_planned = '10:00:00';
                    //     }
                    //     $objPHPExcel->getActiveSheet()->getStyle('G' . $row)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('G' . $row)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('G' . $row)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('G' . $row)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet(0)->getStyle('G' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                    //     $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('G' . $row, $jam_keluar, PHPExcel_Cell_DataType::TYPE_STRING);
                    //     $objPHPExcel->getActiveSheet(0)->getColumnDimension('G')->setAutoSize(true);
                    //     //===================================================//
                    //     $actual_jam_masuk = '';
                    //     $actual_jam_keluar = '';
                    //     $selisih = '';
                    //     $telat_masuk = '';
                    //     $telat_keluar = '';
                    //     $cepat_masuk = '';
                    //     $cepat_keluar = '';
                    //     $telat_masuk1 = '';
                    //     $telat_keluar1 = '';
                    //     $cepat_masuk1 = '';
                    //     $cepat_keluar1 = '';

                    //     $getfingerkary = $this->model_kehadirankaryawan->view_jamfinger_kar($tanggal, $nip, $jam_masuk, $jam_keluar)->result_array();

                    //     foreach ($getfingerkary as $rows) {
                    //         $actual_jam_masuk = $rows['jam_masuk'];
                    //         $actual_jam_keluar = $rows['jam_keluar'];
                    //         $selisih = $rows['selisih'];

                    //         if (strtotime($rows['telat_masuk']) > 0) {
                    //             $telat_masuk = $rows['telat_masuk'];
                    //         }

                    //         if (strtotime($rows['telat_keluar']) > 0) {
                    //             $telat_keluar = $rows['telat_keluar'];
                    //         }

                    //         if (strtotime($rows['cepat_masuk']) > 0) {
                    //             $cepat_masuk = $rows['cepat_masuk'];
                    //         }

                    //         if (strtotime($rows['cepat_keluar']) > 0) {
                    //             $cepat_keluar = $rows['cepat_keluar'];
                    //         }
                    //     }


                    //     $objPHPExcel->getActiveSheet()->getStyle('H' . $row)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('H' . $row)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('H' . $row)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('H' . $row)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet(0)->getStyle('H' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                    //     $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('H' . $row, $actual_jam_masuk, PHPExcel_Cell_DataType::TYPE_STRING);
                    //     $objPHPExcel->getActiveSheet(0)->getColumnDimension('H')->setAutoSize(true);

                    //     //==========================================//
                    //     $objPHPExcel->getActiveSheet()->getStyle('I' . $row)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('I' . $row)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('I' . $row)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('I' . $row)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet(0)->getStyle('I' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                    //     $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('I' . $row, $actual_jam_keluar, PHPExcel_Cell_DataType::TYPE_STRING);
                    //     $objPHPExcel->getActiveSheet(0)->getColumnDimension('I')->setAutoSize(true);

                    //     //==========================================//
                    //     $objPHPExcel->getActiveSheet()->getStyle('J' . $row)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('J' . $row)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('J' . $row)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('J' . $row)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet(0)->getStyle('J' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                    //     $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('J' . $row, $selisih_planned, PHPExcel_Cell_DataType::TYPE_STRING);
                    //     $objPHPExcel->getActiveSheet(0)->getColumnDimension('J')->setAutoSize(true);

                    //     //==========================================//
                    //     $objPHPExcel->getActiveSheet()->getStyle('K' . $row)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('K' . $row)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('K' . $row)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('K' . $row)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet(0)->getStyle('K' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                    //     $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('K' . $row, $selisih, PHPExcel_Cell_DataType::TYPE_STRING);
                    //     $objPHPExcel->getActiveSheet(0)->getColumnDimension('K')->setAutoSize(true);

                    //     //==========================================//
                    //     $objPHPExcel->getActiveSheet()->getStyle('L' . $row)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('L' . $row)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('L' . $row)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('L' . $row)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet(0)->getStyle('L' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                    //     $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('L' . $row, $telat_masuk, PHPExcel_Cell_DataType::TYPE_STRING);
                    //     $objPHPExcel->getActiveSheet(0)->getColumnDimension('L')->setAutoSize(true);

                    //     $objPHPExcel->getActiveSheet()->getStyle('M' . $row)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('M' . $row)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('M' . $row)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('M' . $row)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet(0)->getStyle('M' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                    //     $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('M' . $row, $telat_keluar, PHPExcel_Cell_DataType::TYPE_STRING);
                    //     $objPHPExcel->getActiveSheet(0)->getColumnDimension('M')->setAutoSize(true);

                    //     $objPHPExcel->getActiveSheet()->getStyle('N' . $row)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('N' . $row)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('N' . $row)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('N' . $row)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet(0)->getStyle('N' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                    //     $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('N' . $row, $cepat_masuk, PHPExcel_Cell_DataType::TYPE_STRING);
                    //     $objPHPExcel->getActiveSheet(0)->getColumnDimension('N')->setAutoSize(true);

                    //     $objPHPExcel->getActiveSheet()->getStyle('O' . $row)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('O' . $row)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('O' . $row)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet()->getStyle('O' . $row)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                    //     $objPHPExcel->getActiveSheet(0)->getStyle('O' . $row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                    //     $objPHPExcel->getActiveSheet(0)->setCellValueExplicit('O' . $row, $cepat_keluar, PHPExcel_Cell_DataType::TYPE_STRING);
                    //     $objPHPExcel->getActiveSheet(0)->getColumnDimension('O')->setAutoSize(true);

                    //     //==========================================//
                    //     $row++;
                    //     $no++;
                    // }

            //         header('Content-Type: application/vnd.ms-excel; charset=utf-8');
            //         header('Content-Disposition: attachment; filename=report.xls');
            //         header('Cache-Control: max-age=0');
            //         ob_end_clean();
            //         ob_start();
            //         $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            //         $filename = 'Laporan Kehadiran Guru' . 'csv';
            //         $objWriter->save('php://output');
            //     }
            // } else {
            //     echo json_encode('Tidak Ada data Yang di generate');
            // }
        } else {
            $this->load->view('pagepayroll/login'); //Memanggil function render_view
        }
    }
}
