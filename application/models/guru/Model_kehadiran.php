<?php

class Model_kehadiran extends CI_model
{

   public function view_jadwal($idguru, $hari)
    {
        return  $this->db->query("
        select a.*,d.GuruNama,b.nama as namamapel,e.nama as nmkls from tbjadwal a
        join mspelajaran b on a.id_mapel = b.id_mapel
        join tbguru d on a.id_guru = d.IdGuru
        join tbkelas e on a.nmklstrjdk = e.id_kelas
        where a.id_guru = '".$idguru."' and hari = '".$hari."'
        ");
    }

    public function view_jadwal2($id)
    {
        return  $this->db->query("
        select id from tbjadwal
        where id = '".$id."'
        ");
    }

    public function view_bahasan($idguru, $id)
    {
        return  $this->db->query("
        select PKBAHASAN from trdsrm a
        where a.IdGuru = '".$idguru."' and a.IdJadwal = ".$id."
        ");
    }

    public function view_rincian($idguru, $id)
    {
        return  $this->db->query("
        select RINCIAN from trdsrm a
        where a.IdGuru = '".$idguru."' and a.IdJadwal = ".$id."
        ");
    }

    public function view_count($table, $data_id)
    {
        return $this->db->query('select IdGuru from ' . $table . ' where IdGuru = ' . $data_id . ' and isdeleted != 1')->num_rows();
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
