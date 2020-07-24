<?php

class Model_rekapgkar extends CI_model
{
    public function view($table, $order, $ordering)
    {
        $this->db->where('isdeleted !=', 1);
        $this->db->order_by($order, $ordering);
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

    public function view_rekapkaryawan($tahun, $bulan_awal, $bulan_akhir)
    {
        return $this->db->query("select
                                    tp.*,
                                    MONTH(awal_kerja) bulan_awal,
                                    MONTH(akhir_kerja) bulan_akhir
                                FROM
                                tb_pendapatan_karyawan tp
                                WHERE
                                tp.isDeleted != 1
                                AND MONTH(effective_date) >= $bulan_awal
                                AND MONTH(effective_date) <= $bulan_akhir
                                AND YEAR(effective_date) = $tahun");
    }

    public function view_sekolah()
    {
        return $this->db->query("SELECT DISTINCT s.id, s.deskripsi FROM biodata_karyawan bk, sekolah s WHERE s.id = bk.unit_kerja");
    }

    public function view_count($field, $table, $data_id)
    {
        return $this->db->query("select ".$field." from " . $table . " where ".$field." = '". $data_id . "' and isdeleted != 1")->num_rows();
    }
}
