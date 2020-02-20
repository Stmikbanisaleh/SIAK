<?php

class Model_jadwal extends CI_model
{

    public function getjadwal($tahun, $programsekolah)
    {
        return $this->db->query("SELECT
        TBGURU.IdGuru,
        TBGURU.GuruNama,
        TBJADWAL.id_mapel,
        MSPELAJARAN.nama,
        TBJADWAL.hari,
        MSRUANG.RUANG,
        TBJADWAL.NMKLSTRJDK,
        TBJADWAL.JAM,
        TBPS.DESCRTBPS,
        TBJADWAL.id
        FROM
        TBJADWAL
        LEFT JOIN TBGURU ON TBJADWAL.id_guru = TBGURU.IdGuru
        INNER JOIN MSPELAJARAN ON TBJADWAL.id_mapel = MSPELAJARAN.kode
        INNER JOIN MSRUANG ON TBJADWAL.ID_RUANG = MSRUANG.ID
        INNER JOIN TBPS ON TBJADWAL.PS = TBPS.KDTBPS
        WHERE TBJADWAL.periode='$tahun' AND TBJADWAL.PS='$programsekolah'
        ORDER BY hari");
    }

    public function view($table)
    {
        $this->db->where('isdeleted !=', 1);
        return $this->db->get($table);
    }

    public function view_custome()
    {
        return $this->db->query("SELECT DISTINCT 
        TBAKADMK.TAHUN FROM TBAKADMK ORDER BY TAHUN DESC");
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
