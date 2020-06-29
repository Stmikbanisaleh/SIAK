<?php

class Model_cuti extends CI_model
{
    public function view($table)
    {
        return $this->db->get($table);
    }

    public function view_cuti()
    {
        return $this->db->query("select a.*,b.*,c.keterangan,d.NAMAJABATAN, DATE_FORMAT(b.tanggal, '%d-%m-%Y') as tanggal_f from biodata_karyawan a join tbkehadiran b on a.nip = b.pin 
        join tbcuti c on b.status = c.id join msjabatan d on a.jabatan = d.ID");
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
}
