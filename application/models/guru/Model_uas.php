<?php

class Model_uas extends CI_model
{
    public function views($session)
    {
        return $this->db->query("SELECT * FROM TBGURU WHERE IdGuru= '" . $session . "' and isdeleted != 1");
    }

    public function getmapel($session)
    {
        return $this->db->query("SELECT
        TBJADWAL.id,
        (SELECT z.nama FROM MSPELAJARAN z WHERE z.kode=TBJADWAL.id_mapel)AS nama
        FROM
        TBJADWAL
        WHERE
        TBJADWAL.id_guru = '" . $session . "'");
    }

    public function getuts($mapel)
    {
        return $this->db->query("SELECT
        TBJADWAL.hari,
        TBJADWAL.NMKLSTRJDK,
        TBJADWAL.JAM,
        MSSISWA.NMSISWA,
        TRNILAI.UTSTRNIL,
        TRNILAI.UASTRNIL,
        TBJADWAL.id,
        TBKRS.id_krs,
        MSSISWA.NOINDUK,
        TBJADWAL.id_mapel,
        (TRNILAI.ID)AS idnilai
        FROM
        TBJADWAL
        INNER JOIN TBKRS ON TBJADWAL.id = TBKRS.id_jadwal
        INNER JOIN MSSISWA ON TBKRS.NIS = MSSISWA.NOINDUK
        LEFT JOIN TRNILAI ON TBKRS.id_krs = TRNILAI.IDKRS
        WHERE
        TBJADWAL.id = '" .$mapel. "'");
    }

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
