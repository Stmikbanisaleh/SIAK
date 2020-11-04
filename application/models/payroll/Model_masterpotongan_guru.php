<?php

class Model_masterpotongan_guru extends CI_model
{
    public function view($table)
    {
        return $this->db->get($table);
    }

    public function cek($id){
        return $this->db->query("select IdGuru from tbgurupot where IdGuru = '".$id."' ");
    }
    public function viewOrdering($table, $order, $ordering)
    {
        $this->db->where('isdeleted !=', 1);
        $this->db->order_by($order, $ordering);
        return $this->db->get($table);
    }

    public function viewWhereOrdering($table, $data, $order, $ordering)
    {
        $this->db->where($data);
        $this->db->where('isdeleted !=', 1);
        $this->db->order_by($order, $ordering);
        return $this->db->get($table);
    }

    public function view_where($table, $data)
    {
        $this->db->where($data);
        return $this->db->get($table);
    }

    public function view_count($table, $data_id)
    {
        return $this->db->query("select IdGuru from " . $table . " where IdGuru = '" . $data_id . "'")->num_rows();
    }

	public function getformat()
    {
        return $this->db->query("SELECT a.IdGuru, a.GuruNama , b.infaq_masjid , b.anggota_koperasi, b.kas_bon, 
		b.ijin_telat, b.bmt, b.koperasi, b.inval, b.toko, b.tawun, b.bpjs,b.ltq, b.ket_khusus1, b.tunj_khusus1
		from tbguru a join tbgurupot b on a.IdGuru = b.IdGuru order by a.GuruNama asc");
	}

    public function insert($data, $table)
    {
        $result = $this->db->insert($table, $data);
        return $result;
    }

    function update($where, $data, $table)
    {
        $this->db->where($where);
        return $this->db->update($table, $data);
    }

    function delete($where, $table)
    {
        $this->db->where($where);
        return $this->db->delete($table);
    }

    function truncate($table)
    {
        $this->db->truncate($table);
    }

    public function view_potongan(){
        return $this->db->query("select a.*, b.GuruNama from tbgurupot a join tbguru b on a.IdGuru = b.IdGuru");
    }
}
