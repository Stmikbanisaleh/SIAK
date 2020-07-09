<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Slip_gaji extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('payroll/model_slipgaji');
		$this->load->library('mainfunction');
		if ($this->session->userdata('username_payroll') != null && $this->session->userdata('nama') != null) {

		} else {
			$this->load->view('pagepayroll/login'); //Memanggil function render_view
		}
	}

	function render_view($data)
	{
		$this->template->load('templatepayroll', $data); //Display Page
	}

	public function index()
	{
		$my_karyawan = $this->model_slipgaji->view('biodata_karyawan')->result_array();
		$data = array(
			'page_content' 	=> '../pagepayroll/slip_gaji/view',
			'ribbon' 		=> '<li class="active">Slip Gaji</li><li>Slip Gaji</li>',
			'page_name' 	=> 'Slip Gaji',
			'js' 			=> 'js_file',
			'my_karyawan'	=> $my_karyawan
		);
		$this->render_view($data); //Memanggil function render_view
		
	}

	public function guru()
	{
		$my_karyawan = $this->model_slipgaji->viewOrdering('tbguru', 'GuruNama', 'ASC')->result_array();
		$this->load->model('payroll/model_honorguru');
		$myunit = $this->model_honorguru->view_unit();
		$data = array(
			'page_content' 	=> '../pagepayroll/slip_gaji/view_guru',
			'ribbon' 		=> '<li class="active">Slip Gaji</li><li>Slip Gaji Guru</li>',
			'page_name' 	=> 'Slip Gaji',
			'js' 			=> 'js_file',
			'my_karyawan'	=> $my_karyawan,
			'myunit'		=>  $myunit
		);
		$this->render_view($data); //Memanggil function render_view
		
	}

	public function karyawan()
	{
		$my_karyawan = $this->model_slipgaji->view('biodata_karyawan')->result_array();
		$data = array(
			'page_content' 	=> '../pagepayroll/slip_gaji/view_karyawan',
			'ribbon' 		=> '<li class="active">Slip Gaji</li><li>Slip Gaji Karyawan</li>',
			'page_name' 	=> 'Slip Gaji',
			'js' 			=> 'js_file',
			'my_karyawan'	=> $my_karyawan
		);
		$this->render_view($data); //Memanggil function render_view
		
	}

	public function laporan(){
		$tgl = $this->mainfunction->tgl_indo(date('Y-m-d'));
		$bulan = $this->mainfunction->periode_bulan(date('m'));
		$tahun = $this->input->post('tahun');
		$tabel = '';
		if($this->input->post('tipe_gaji')=='K'){
			$tabel = 'tb_pendapatan_karyawan';
			if($this->input->post('employee') == 'none'){
				$my_gaji = $this->model_slipgaji->view_gaji($tabel,
															$this->input->post('blnawal'),
															$this->input->post('blnakhir'),
															$this->input->post('tahun'));
			}else{
				$where = array(
					'employee_number'	=> $this->input->post('employee'),
				);
				$my_gaji = $this->model_slipgaji->view_gaji_byemp($tabel,
																$this->input->post('blnawal'),
																$this->input->post('blnakhir'),
																$this->input->post('employee'),
																$this->input->post('tahun')
															);
			}
		}else{
			$tabel = 'tb_pendapatan_guru';
			if($this->input->post('employee') == 'none'){
				$my_gaji = $this->model_slipgaji->view_gaji_guru($tabel,
															$this->input->post('blnawal'),
															$this->input->post('blnakhir'),
															$this->input->post('tahun'),
															$this->input->post('unit'));
			}else{
				$where = array(
					'employee_number'	=> $this->input->post('employee'),
				);
				$my_gaji = $this->model_slipgaji->view_gaji_byemp_guru($tabel,
																$this->input->post('blnawal'),
																$this->input->post('blnakhir'),
																$this->input->post('employee'),
																$this->input->post('tahun'),
																$this->input->post('unit')
															);
			}
		}
		

		if($this->input->post('tipe_laporan') == 'P'){
			if($this->input->post('tipe_gaji') == 'K'){
				$this->laporan_pdf_karyawan($my_gaji, $bulan, $tahun, $tgl);
			}else{
				$this->laporan_pdf_guru($my_gaji, $bulan, $tahun, $tgl);
			}
		}else{
			if($this->input->post('tipe_gaji') == 'K'){
				$this->laporan_excel_karyawan($my_gaji, $bulan, $tahun, $tgl);
			}else{
				$this->laporan_excel_guru($my_gaji, $bulan, $tahun, $tgl);
			}
		}
		
	}
	
	public function laporan_pdf_karyawan($my_gaji, $bulan, $tahun, $tgl){
        
		$this->load->library('pdf');
		
		$data = array(
			'mygaji'      	=> $my_gaji,
			'bulan'		=> $bulan,
			'tahun'		=> $tahun,
			'ket'		=> 'K',
			'tgl'		=> $tgl
		);
		$this->pdf->setPaper('FOLIO', 'potrait');
		// $customPaper = array(0,0,254,396);
		// $this->pdf->set_paper($customPaper);
		// $this->pdf->filename = "Slip Gaji ".$tgl.".pdf";
		$this->pdf->load_view('pagepayroll/slip_gaji/laporan', $data);

		// $this->template->load('pagepayroll/slip_gaji/laporan_excel', $data);
	}

	public function laporan_pdf_guru($my_gaji, $bulan, $tahun){
		$tgl = $this->mainfunction->tgl_indo(date('Y-m-d'));
		$this->load->library('pdf');
		
		$data = array(
			'mygaji'      	=> $my_gaji,
			'bulan'		=> $bulan,
			'tahun'		=> $tahun,
			'ket'		=> 'G',
			'tgl'		=> $tgl
		);
		$this->pdf->setPaper('FOLIO', 'potrait');
		$this->pdf->load_view('pagepayroll/slip_gaji/laporan', $data);
	}

	public function laporan_excel_karyawan($my_gaji, $bulan, $tahun){
		
		$data = array(
			'mygaji'      	=> $my_gaji,
			'bulan'		=> $bulan,
			'tahun'		=> $tahun,
			'ket'		=> 'K',
			'tgl'		=> $tgl
		);
		$this->template->load('pagepayroll/slip_gaji/laporan_excel', $data);
	}

	public function laporan_excel_guru($my_gaji, $bulan, $tahun){
		$data = array(
			'mygaji'      	=> $my_gaji,
			'bulan'		=> $bulan,
			'tahun'		=> $tahun,
			'ket'		=> 'G',
			'tgl'		=> $tgl
		);

		$this->template->load('pagepayroll/slip_gaji/laporan_excel', $data);
	}

}
