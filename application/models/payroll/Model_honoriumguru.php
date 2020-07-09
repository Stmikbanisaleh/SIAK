<?php

class Model_honoriumguru extends CI_model
{
    public function view($table)
    {
        $this->db->where('isdeleted !=', 1);
        return $this->db->get($table);
    }

    public function getjmljam($idguru , $tglawal, $tglakhir)
    {
        return $this->db->query("select SUM(c.jam) as jmljam ,SUM(a.TAMBAHAN) as tambahan
        from trdsrm a 
        join tbjadwal c on a.idJadwal = c.id
        join mspelajaran d on c.id_mapel = d.id_mapel 
        WHERE a.TGLHADIR BETWEEN '$tglawal' AND '$tglakhir'
        AND a.IdGuru = '$idguru' and a.STINVAL = 0");
    }

    public function viewhonorium()
    {
        return $this->db->query("SELECT a.IDRD,b.GuruNama, CONCAT('Rp. ',FORMAT(a.HONOR,2)) as tarif2,CONCAT('Rp. ',FORMAT(a.TAMBAHANJAM,2)) as inval ,DATE_FORMAT(a.TGLAWAL, '%d-%b-%Y') as TGLAWAL ,DATE_FORMAT(a.TGLAKHIR, '%d-%b-%Y') as TGLAKHIR,a.JMLJAM,CONCAT('Rp. ',FORMAT(a.TARIF,2)) as tarif from htguru a
        JOIN tbguru b on b.IdGuru = a.IdGuru
        ");
    }

    public function gethonor($idguru)
    {
        return $this->db->query("SELECT tarif_perjam,tarif_inval
        FROM tarifguru c
        WHERE c.IdGuru = '$idguru'");
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
