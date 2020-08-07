<?php

class Model_slipgaji extends CI_model
{
    public function view($table)
    {
        $this->db->where('isdeleted !=', 1);
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

    public function view_count($field, $table, $data_id)
    {
        return $this->db->query("select ".$field." from " . $table . " where ".$field." = '". $data_id . "' and isdeleted != 1")->num_rows();
    }

    public function view_gaji($table, $bulan_awal, $bulan_akhir, $tahun)
    {
        return $this->db->query("SELECT
                                * FROM ".$table." tp
                                WHERE MONTH(tp.effective_date) BETWEEN '".$bulan_awal."' AND '".$bulan_akhir."'
                                AND YEAR(tp.effective_date) = '".$tahun."'
                                AND tp.isDeleted != 1");
    }

    public function view_gaji_byemp($table, $bulan_awal, $bulan_akhir, $emp, $tahun)
    {
        return $this->db->query("SELECT
                                    * FROM ".$table." tp
                                WHERE MONTH(tp.effective_date) BETWEEN '".$bulan_awal."' AND '".$bulan_akhir."'
                                    AND tp.employee_number = '".$emp."'
                                    AND YEAR(tp.effective_date) = '".$tahun."'
                                    AND tp.isDeleted != 1");
    }

    public function view_gaji_guru($table, $bulan_awal, $bulan_akhir, $tahun, $unit)
    {
        if(!empty($unit)){
            return $this->db->query("SELECT * FROM ".$table." tp
                                JOIN tbguru b ON tp.employee_number = b.IdGuru
                                JOIN tbps ps ON ps.KDSK = b.GuruBase
                                WHERE MONTH(tp.effective_date) BETWEEN '".$bulan_awal."' AND '".$bulan_akhir."'
                                AND YEAR(tp.effective_date) = '".$tahun."'
                                AND b.GuruBase = $unit
                                AND tp.isDeleted != 1");
        }else{
            return $this->db->query("SELECT * FROM ".$table." tp
                                JOIN tbguru b ON tp.employee_number = b.IdGuru
                                JOIN tbps ps ON ps.KDSK = b.GuruBase
                                WHERE MONTH(tp.effective_date) BETWEEN '".$bulan_awal."' AND '".$bulan_akhir."'
                                AND YEAR(tp.effective_date) = '".$tahun."'
                                AND tp.isDeleted != 1");
        }
        
    }

    public function view_gaji_byemp_guru($table, $bulan_awal, $bulan_akhir, $emp, $tahun, $unit)
    {
        if(!empty($unit)){
            return $this->db->query("SELECT
                                    * FROM ".$table." tp
                                    JOIN tbguru b ON tp.employee_number = b.IdGuru
                                    JOIN tbps ps ON ps.KDSK = b.GuruBase
                                    WHERE MONTH(tp.effective_date) BETWEEN '".$bulan_awal."' AND '".$bulan_akhir."'
                                    AND tp.employee_number = '".$emp."'
                                    AND ps.id = $unit
                                    AND YEAR(tp.effective_date) = '".$tahun."'
                                    AND tp.isDeleted != 1");
        }else{
            return $this->db->query("SELECT
                                    * FROM ".$table." tp
                                    JOIN tbguru b ON tp.employee_number = b.IdGuru
                                    JOIN tbps ps ON ps.KDSK = b.GuruBase
                                    WHERE MONTH(tp.effective_date) BETWEEN '".$bulan_awal."' AND '".$bulan_akhir."'
                                    AND tp.employee_number = '".$emp."'
                                    AND YEAR(tp.effective_date) = '".$tahun."'
                                    AND tp.isDeleted != 1");
        }
    }
}
