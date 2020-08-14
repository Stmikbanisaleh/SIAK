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

    public function view_gaji($table, $bulan_awal, $bulan_akhir, $tahun, $unit)
    {
        if(!empty($unit)){
            return $this->db->query("SELECT
                                    tp.* FROM ".$table." tp
                                    JOIN biodata_karyawan bk ON bk.nik = tp.employee_number
                                    JOIN tbps ps ON bk.unit_kerja = ps.KDSK
                                    WHERE MONTH(tp.effective_date) BETWEEN '".$bulan_awal."' AND '".$bulan_akhir."'
                                    AND YEAR(tp.effective_date) = '".$tahun."'
                                    AND ps.KDUNIT = $unit
                                    AND tp.isDeleted != 1");
        }else{
            return $this->db->query("SELECT
                                    * FROM ".$table." tp
                                    WHERE MONTH(tp.effective_date) BETWEEN '".$bulan_awal."' AND '".$bulan_akhir."'
                                    AND YEAR(tp.effective_date) = '".$tahun."'
                                    AND tp.isDeleted != 1");
        }
    }

    public function view_gaji_byemp($table, $bulan_awal, $bulan_akhir, $emp, $tahun)
    {
        if(!empty($unit)){
            return $this->db->query("SELECT
                                        tp.* FROM ".$table." tp
                                        JOIN biodata_karyawan bk ON bk.nik = tp.employee_number
                                        JOIN tbps ps ON bk.unit_kerja = ps.KDSK
                                    WHERE MONTH(tp.effective_date) BETWEEN '".$bulan_awal."' AND '".$bulan_akhir."'
                                        AND tp.employee_number = '".$emp."'
                                        AND YEAR(tp.effective_date) = '".$tahun."'
                                        AND ps.KDUNIT = $unit
                                        AND tp.isDeleted != 1");
        }else{
            return $this->db->query("SELECT
                                        * FROM ".$table." tp
                                    WHERE MONTH(tp.effective_date) BETWEEN '".$bulan_awal."' AND '".$bulan_akhir."'
                                        AND tp.employee_number = '".$emp."'
                                        AND YEAR(tp.effective_date) = '".$tahun."'
                                        AND tp.isDeleted != 1");
        }
        
    }

    public function view_gaji_guru($table, $bulan_awal, $bulan_akhir, $tahun, $unit)
    {
        if(!empty($unit)){
            return $this->db->query("SELECT 
                                        tp.*, (SELECT ps.DESCRTBPS FROM tbps ps WHERE ps.KDUNIT = $unit and ps.KDSK = b.GuruBase LIMIT 1) as DESCRTBPS
                                    FROM ".$table." tp
                                    JOIN tbguru b ON tp.employee_number = b.IdGuru
                                    WHERE MONTH(tp.effective_date) BETWEEN '".$bulan_awal."' AND '".$bulan_akhir."'
                                    AND YEAR(tp.effective_date) = '".$tahun."'
                                    AND tp.isDeleted != 1");
        }else{
            return $this->db->query("SELECT * FROM ".$table." tp
                                JOIN tbguru b ON tp.employee_number = b.IdGuru
                                WHERE MONTH(tp.effective_date) BETWEEN '".$bulan_awal."' AND '".$bulan_akhir."'
                                AND YEAR(tp.effective_date) = '".$tahun."'
                                AND tp.isDeleted != 1");
        }
        
    }

    public function view_gaji_byemp_guru($table, $bulan_awal, $bulan_akhir, $emp, $tahun, $unit)
    {
        if(!empty($unit)){
            return $this->db->query("SELECT
                                        tp.*, (SELECT ps.DESCRTBPS FROM tbps ps WHERE ps.KDUNIT = $unit and ps.KDSK = b.GuruBase LIMIT 1) as DESCRTBPS
                                    FROM ".$table." tp
                                    JOIN tbguru b ON tp.employee_number = b.IdGuru
                                    WHERE MONTH(tp.effective_date) BETWEEN '".$bulan_awal."' AND '".$bulan_akhir."'
                                    AND tp.employee_number = '".$emp."'
                                    AND YEAR(tp.effective_date) = '".$tahun."'
                                    AND tp.isDeleted != 1");
        }else{
            return $this->db->query("SELECT
                                    * FROM ".$table." tp
                                    JOIN tbguru b ON tp.employee_number = b.IdGuru
                                    WHERE MONTH(tp.effective_date) BETWEEN '".$bulan_awal."' AND '".$bulan_akhir."'
                                    AND tp.employee_number = '".$emp."'
                                    AND YEAR(tp.effective_date) = '".$tahun."'
                                    AND tp.isDeleted != 1");
        }
    }
}
