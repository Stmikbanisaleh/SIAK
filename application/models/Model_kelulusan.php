<?php 

class Model_kelulusan extends CI_model{

    public function view($table){
        return $this->db->get($table);
    }

    public function getsearch($tahun, $programsekolah){
        return  $this->db->query("SELECT
        RKPAKTVSISWA.IDRKP,
        RKPAKTVSISWA.NISRKP,
        RKPAKTVSISWA.THNAKDRKP,
        RKPAKTVSISWA.GANGENRKP,
        RKPAKTVSISWA.SMTRKP,
        RKPAKTVSISWA.STSRKP,
        RKPAKTVSISWA.TANGGAL_KELUAR,
        MSSISWA.NMSISWA,
        TBPS.DESCRTBPS
        FROM
        RKPAKTVSISWA
        INNER JOIN MSSISWA ON RKPAKTVSISWA.NISRKP = MSSISWA.NOINDUK
        INNER JOIN TBPS ON MSSISWA.PS = TBPS.KDTBPS
        WHERE
        RKPAKTVSISWA.STSRKP IN ('L') AND RKPAKTVSISWA.THNAKDRKP='$tahun' AND RKPAKTVSISWA.GANGENRKP='$programsekolah' and RKPAKTVSISWA.isdeleted !=1
        ");
    }

    public function getsemester(){
        return $this->db->query('SELECT DISTINCT SEMESTER FROM tbakadmk ORDER BY SEMESTER DESC');
    }

    public function getthnakad(){
        return $this->db->query('SELECT DISTINCT THNAKAD FROM tbakadmk ORDER BY ID DESC');
    }

    public function viewtampil(){
        return $this->db->query('select a.*,b.DESCRTBPS from mspelajaran a join tbps b on a.ps = b.KDTBPS where a.isdeleted != 1');
    }

    public function viewOrdering($table,$order,$ordering){
        $this->db->where('isdeleted !=', 1);
        $this->db->order_by($order,$ordering);
        return $this->db->get($table);
    }

    public function viewWhereOrdering($table,$data,$order,$ordering){
        $this->db->where($data);
        $this->db->order_by($order,$ordering);
        return $this->db->get($table);
    }
    
    public function view_where($table,$data){
        $this->db->where($data);
        return $this->db->get($table);
    }

    public function view_count($table,$data_id){
        $this->db->where($data_id);
        $this->db->where('isdeleted !=', 1);
        $hasil = $this->db->get($table);
        return $hasil->num_rows();
    }
      
    public function insert($data, $table){
        $result = $this->db->insert($table, $data);
        return $result;
    }

    function update($where,$data,$table){
		$this->db->where($where);
		return $this->db->update($table,$data);
	}	
    
    function delete($where,$table){
    	$this->db->where($where);
    	return $this->db->delete($table);
    }

    function truncate($table){
      $this->db->truncate($table);
    }
}