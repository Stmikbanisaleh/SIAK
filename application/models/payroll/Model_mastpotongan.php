<?php

class Model_mastpotongan extends CI_model
{
    public function view($table)
    {
        return $this->db->get($table);
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

	public function getnip($data)
    {
        return $this->db->query("Select id_biodata from biodata_karyawan where nip = $data ")->result_array();
	}
	
    public function view_count($table, $data_id)
    {
        return $this->db->query("select id_karyawan from " . $table . " where id_karyawan = '" . $data_id . "'")->num_rows();
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
        return $this->db->query("select a.*, b.nama from tbkaryawanpot a join biodata_karyawan b on a.id_karyawan = b.nip");
    }

    public function cek_karyawan($id, $period){
        return $this->db->query("SELECT * FROM tbkaryawanpot WHERE id_karyawan = '".$id."'");
    }
}
