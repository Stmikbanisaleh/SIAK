<?php

class Model_hasil extends CI_model
{

    public function view($nip)
    {
        return $this->db->query("SELECT
        TBJADWAL.hari,
        TBJADWAL.NMKLSTRJDK,
        TBJADWAL.JAM,
        MSSISWA.NMSISWA,
        TRNILAI.UTSTRNIL,UASTRNIL,
        MSSISWA.NOINDUK,
        TBJADWAL.id_mapel,
        (SELECT z.nama FROM MSPELAJARAN z WHERE z.kode= TBJADWAL.id_mapel)AS nama_mapel
        FROM
        TBJADWAL
        INNER JOIN TBKRS ON TBJADWAL.id = TBKRS.id_jadwal
        INNER JOIN MSSISWA ON TBKRS.NIS = MSSISWA.NOINDUK
        LEFT JOIN TRNILAI ON TBKRS.id_krs = TRNILAI.IDKRS
        WHERE MSSISWA.NOINDUK='$nip'
        ORDER BY NMKLSTRJDK ASC");
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
        return $this->db->query("select NOINDUK from " . $table . " where NOINDUK = '" . $data_id['NOINDUK'] . "' and isdeleted != 1")->num_rows();
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

    public function count_visit()
    {
        return $this->db->query("SELECT COUNT(st.id) visit FROM statistik st");
    }

    public function count_click()
    {
        return $this->db->query("SELECT SUM(st.hits) klik FROM statistik st");
    }

    public function count_guru()
    {
        return $this->db->query("SELECT COUNT(*) guru FROM TBGURU tg");
    }

    public function count_siswa($th_akademik)
    {
        return $this->db->query("SELECT COUNT(DISTINCT NIS) pengguna FROM TBKRS WHERE periode=$th_akademik");
    }
}
