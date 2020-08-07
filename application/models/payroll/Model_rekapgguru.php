<?php

class Model_rekapgguru extends CI_model
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

    public function view_rekapguru($tahun, $bulan_awal, $bulan_akhir)
    {
        return $this->db->query("select
                                    tp.*,
                                    tg.no_rekening,
                                    MONTH(awal_kerja) bulan_awal,
                                    MONTH(akhir_kerja) bulan_akhir
                                FROM
                                tb_pendapatan_guru tp
                                JOIN tarifguru tg ON tp.employee_number = tg.IdGuru
                                WHERE
                                tp.isDeleted != 1
                                AND MONTH(effective_date) >= $bulan_awal
                                AND MONTH(effective_date) <= $bulan_akhir
                                AND YEAR(effective_date) = $tahun");
    }

    public function view_count($field, $table, $data_id)
    {
        return $this->db->query("select ".$field." from " . $table . " where ".$field." = '". $data_id . "' and isdeleted != 1")->num_rows();
    }
}
