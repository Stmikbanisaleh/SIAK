<?php

class Model_karyawan extends CI_model
{
    public function view($table)
    {
        return $this->db->get($table);
    }

	public function cek($id)
    {
        return $this->db->query("SELECT nip from biodata_karyawan where nip = '".$id."'");
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
        $this->db->where('isdeleted !=', 1);
        return $this->db->get($table);
    }

    public function view_karyawan()
    {
        return  $this->db->query('select a.*,b.*,c.* from biodata_karyawan a 
        left join tbagama b on a.agama = b.KDTBAGAMA
        left join mspendidikan c on a.pendidikan = c.IDMSPENDIDIKAN
        ');
    }

    public function view_karyawan_where($id)
    {
        return  $this->db->query("select a.*,b.*,c.* from biodata_karyawan a 
        left join tbagama b on a.agama = b.KDTBAGAMA
        left join mspendidikan c on a.pendidikan = c.IDMSPENDIDIKAN
        where nip = '$id[id]'
        ");
    }

    public function view_tarif_where($id)
    {
        return  $this->db->query("select a.*,b.nama_pembayaran from tarifkaryawan a
        join jnspembayaran b on a.cara_pembayaran = b.id
        where a.id_karyawan = '$id[id]'
        ");
    }

    public function view_count($table, $data_id)
    {
        return $this->db->query("select nik from " . $table . " where nik = '" . $data_id . "'")->num_rows();
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
}
