<?php

class Model_pendapatanlainkaryawan extends CI_model
{
    public function view($table)
    {
        $this->db->where('isdeleted !=', 1);
        return $this->db->get($table);
    }

    public function view_pendapatanlain()
    {
        return $this->db->query("SELECT b.id,a.nip,a.nama , b.lain, b.tunjangan, b.periode from biodata_karyawan a 
        join tbpendapatanlainkaryawan b on a.nip = b.nip ");
    }

    public function viewhonorium()
    {
        return $this->db->query("SELECT a.IDRD,b.GuruNama, CONCAT('Rp. ',FORMAT(a.TARIF * a.JMLJAM,2)) as tarif2 ,DATE_FORMAT(a.TGLAWAL, '%d-%b-%Y') as TGLAWAL ,DATE_FORMAT(a.TGLAKHIR, '%d-%b-%Y') as TGLAKHIR,a.JMLJAM,CONCAT('Rp. ',FORMAT(a.TARIF,2)) as tarif from htguru a
        JOIN tbguru b on b.IdGuru = a.IdGuru
        ");
    }

    public function cek_karyawan($nip,$periode)
    {
        return $this->db->query("SELECT * FROM tbpendapatanlainkaryawan where nip ='".$nip."' and MONTH(periode) = '".$periode."'");
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
        // $this->db->where('isdeleted !=', 1);
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

    public function view_gaji($table, $bulan_awal, $bulan_akhir)
    {
        return $this->db->query("SELECT
                                * FROM ".$table." tp
                                WHERE MONTH(tp.effective_date) BETWEEN '".$bulan_awal."' AND '".$bulan_akhir."'
                                AND tp.isDeleted != 1");
    }

    public function view_gaji_byemp($table, $bulan_awal, $bulan_akhir, $emp)
    {
        return $this->db->query("SELECT
                                    * FROM ".$table." tp
                                WHERE MONTH(tp.effective_date) BETWEEN '".$bulan_awal."' AND '".$bulan_akhir."'
                                    AND tp.employee_number = '".$emp."'
                                    AND tp.isDeleted != 1");
    }
}
