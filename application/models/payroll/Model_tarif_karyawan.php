<?php

class Model_tarif_karyawan extends CI_model
{
    public function view($table)
    {
        $this->db->where('isdeleted !=', 1);
        return $this->db->get($table);
    }

    public function  getmasakerja($id)
    {
        return $this->db->query("SELECT FLOOR(DATEDIFF(NOW(),tgl_mulai_kerja)/365) as masakerja  from biodata_karyawan where nip = '".$id."' ");
    }

    public function  getpendidikan($id)
    {
        return $this->db->query("SELECT pendidikan from biodata_karyawan a join msjabatan b on a.jabatan = b.ID where nip = '".$id."'");
    }

    public function  gethonor($masakerja)
    {
        return $this->db->query("SELECT honor_berkala from master_honor_berkala where masa_kerja = ".$masakerja." ");
    }

    public function  getjabatanjam($id)
    {
        return $this->db->query("SELECT b.jumlah_jam from biodata_karyawan a join msjabatan b on a.jabatan = b.ID where nip = '".$id."'   ");
    }

    public function  gettarifhonor($id)
    {
        return $this->db->query("SELECT nominal from master_honor where jenjang_alias = ".$id." ");
    }

    public function  getjenjang($id)
    {
        return $this->db->query("SELECT nominal from master_honor where jenjang_alias = ".$id." ");
    }

    public function view_karyawan()
    {
        return $this->db->query("SELECT 
        a.id_karyawan,a.id,
        CONCAT('Rp. ',FORMAT(a.tunjangan_jabatan,2)) as tunjangan_jabatan,
        CONCAT('Rp. ',FORMAT(a.tarif,2)) as tarif,
        CONCAT('Rp. ',FORMAT(a.transport,2)) as transport,
        CONCAT('Rp. ',FORMAT(a.honor,2)) as honor,
        CONCAT('Rp. ',FORMAT(a.tarif + a.convert,2)) as hc,
        CONCAT('Rp. ',FORMAT(a.tunj_pegawai_tetap,2)) as tunj_pegawai_tetap,
         b.nama from tarifkaryawan a join biodata_karyawan b on a.id_karyawan = b.nip ");
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
