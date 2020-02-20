<?php

class Model_biodata extends CI_model
{

    public function view($session)
    {
        return $this->db->query("SELECT
        TBGURU.id,
        TBGURU.IdGuru,
        TBGURU.GuruNoDapodik,
        TBGURU.GuruNama,
        TBGURU.GuruTelp,
        TBGURU.GuruAlamat,
        TBGURU.GuruWaktu,
        TBGURU.GuruJenisKelamin,
        TBGURU.GuruPendidikanAkhir,
        TBGURU.GuruAgama,
        TBAGAMA.DESCRTBAGAMA,
        TBGURU.GuruEmail,
        TBGURU.GuruTempatLahir,
        TBGURU.GuruTglLahir,
        TBGURU.GuruStatus
        FROM
        guru
        LEFT JOIN TBGURU ON guru.IdGuru = TBGURU.IdGuru
        LEFT JOIN tbagama ON TBGURU.GuruAgama = tbagama.KDTBAGAMA

        LEFT JOIN TBGURURIWAYAT ON TBGURU.IdGuru = TBGURURIWAYAT.IdGuru where TBGURU.IdGuru='".$session."'");
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

    public function view_where_v2($table, $data)
    {
        return  $this->db->query('select * from tbguru a 
        left join tbagama b on a.GuruAgama = b.KDTBAGAMA
        left join mspendidikan c on a.GuruPendidikanAkhir = c.IDMSPENDIDIKAN
        left join tbps d on a.GuruBase = d.KDTBPS
        where a.isdeleted != 1 and a.id = ' . $data['id'] . '
        ');
    }

    public function view_guru()
    {
        return  $this->db->query('select * from tbguru a 
        left join tbagama b on a.GuruAgama = b.KDTBAGAMA
        left join mspendidikan c on a.GuruPendidikanAkhir = c.IDMSPENDIDIKAN
        left join tbps d on a.GuruBase = d.KDTBPS
        where a.isdeleted != 1
        ');
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
