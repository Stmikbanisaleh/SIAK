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

    //OLD
    // public function view_rekapkaryawan($tahun, $bulan_awal, $bulan_akhir, $unit)
    // {
    //     return $this->db->query("select
    //                                 MONTH(awal_kerja) bulan_awal,
    //                                 MONTH(akhir_kerja) bulan_akhir,
    //                                 tk.no_rekening,
    //                                 tp.*
    //                             FROM
    //                                 tb_pendapatan_karyawan tp
    //                                 JOIN tarifkaryawan tk ON tp.employee_number = tk.id_karyawan
    //                                 JOIN biodata_karyawan bk ON bk.nip = tp.employee_number
    //                                 JOIN tbps ps ON bk.unit_kerja = ps.KDSK
    //                             WHERE
    //                                 tp.isDeleted != 1
    //                                 AND ps.KDUNIT = $unit
    //                                 AND MONTH(effective_date) >= $bulan_awal
    //                                 AND MONTH(effective_date) <= $bulan_akhir
    //                                 AND YEAR(effective_date) = $tahun");
    // }
    //OLD

    public function view_rekapkaryawan($tahun, $bulan_awal, $bulan_akhir, $unit)
    {
		if($unit == 0){
			return $this->db->query("select
			tk.id_karyawan, MONTH(awal_kerja) bulan_awal,
			MONTH(akhir_kerja) bulan_akhir,
            tk.no_rekening,
            bk.nip,
			tp.*
		FROM
			tb_pendapatan_karyawan tp
			JOIN tarifkaryawan tk ON tp.employee_number = tk.id_karyawan
			JOIN biodata_karyawan bk ON bk.nip = tp.employee_number
			JOIN sekolah ps ON bk.unit_kerja = ps.id
		WHERE
			tp.isDeleted != 1
			AND MONTH(tp.effective_date) >= $bulan_awal
			AND MONTH(tp.effective_date) <= $bulan_akhir
			AND YEAR(tp.effective_date) = $tahun");
		} else {
			return $this->db->query("select
			tk.id_karyawan, MONTH(awal_kerja) bulan_awal,
			MONTH(akhir_kerja) bulan_akhir,
			tk.no_rekening,
            bk.nip,
			tp.*
		FROM
			tb_pendapatan_karyawan tp
			JOIN tarifkaryawan tk ON tp.employee_number = tk.id_karyawan
			JOIN biodata_karyawan bk ON bk.nip = tp.employee_number
			JOIN sekolah ps ON bk.unit_kerja = ps.id
		WHERE
			tp.isDeleted != 1
			AND ps.id = $unit
			AND MONTH(tp.effective_date) >= $bulan_awal
			AND MONTH(tp.effective_date) <= $bulan_akhir
			AND YEAR(tp.effective_date) = $tahun");
		}
       
    }

    public function view_sekolah()
    {
        return $this->db->query("SELECT DISTINCT s.id, s.deskripsi FROM biodata_karyawan bk, sekolah s WHERE s.id = bk.unit_kerja");
    }

    public function view_sekolah_one($id)
    {
        return $this->db->query("SELECT DISTINCT s.id, s.deskripsi FROM biodata_karyawan bk, sekolah s WHERE s.id = bk.unit_kerja AND s.id = $id");
    }

    public function view_unit()
    {
        return $this->db->query("SELECT s.id, s.deskripsi FROM sekolah s ORDER BY s.id");
    }

    public function view_count($field, $table, $data_id)
    {
        return $this->db->query("select ".$field." from " . $table . " where ".$field." = '". $data_id . "' and isdeleted != 1")->num_rows();
    }
}
