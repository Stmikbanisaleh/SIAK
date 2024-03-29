<?php

class Model_tarifguru extends CI_model
{
    public function view($table)
    {
        $this->db->where('isdeleted !=', 1);
        return $this->db->get($table);
    }

    public function view_guru()
    {
        return $this->db->query("select a.*,b.tarif,CONCAT('Rp. ',FORMAT(b.tarif,2)) Nominal2,c.nama_pembayaran,b.id as idt from tbguru a 
        LEFT join tarifguru b on a.IdGuru = b.IdGuru 
        LEFT join jnspembayaran c on b.cara_pembayaran = c.id ");
    }

	public function  getmasakerja($id)
    {
        return $this->db->query("SELECT FLOOR(DATEDIFF(NOW(),awal_kerja)/365) as masakerja  from tbguru where id = '".$id."' ");
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

    public function view_count($field, $table, $data_id)
    {
        return $this->db->query("select ".$field." from " . $table . " where ".$field." = '". $data_id . "'")->num_rows();
    }
}
