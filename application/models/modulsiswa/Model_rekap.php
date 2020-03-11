<?php

class Model_rekap extends CI_model
{
    public function view($nip)
    {
        return $this->db->query("SELECT
        Pembayaran.PBKNo,
        Pembayaran.PBKNotranurut,
        Pembayaran.PBKNoTrans,
        Pembayaran.PBKTgl,
        Pembayaran.PBKByrke,
        Pembayaran.PBKNIS,
        Pembayaran.PBKnoreg,
        Pembayaran.PBKSemester,
        Pembayaran.PBKTrpno,
        Pembayaran.PBKSKNO,
        Pembayaran.PBKSPP,
        Pembayaran.PBKBPP,
        Pembayaran.PBKKegiatan,
        Pembayaran.PBKuser,
        Pembayaran.PBKwaktu,
        Pembayaran.PBKcrbayar,
(SELECT z.PtPotSPP FROM Potongan z WHERE z.Ptno=Pembayaran.PBKRkpno)AS PBKPotspp,
(SELECT z.PtPotBPP FROM Potongan z WHERE z.Ptno=Pembayaran.PBKRkpno)AS PBKpotbpp,
(SELECT z.PtPotKegiatan FROM Potongan z WHERE z.Ptno=Pembayaran.PBKRkpno)AS PBKpotkegiatan,
        Pembayaran.PBKRkpno,
        Pembayaran.PBKTA
        FROM Pembayaran
        WHERE PBKNIS='$nip'
        ORDER BY PBKTgl DESC");
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
        return $this->db->query("SELECT COUNT(*) guru FROM tbguru tg");
    }

    public function count_siswa($th_akademik)
    {
        return $this->db->query("SELECT COUNT(DISTINCT NIS) pengguna FROM tbkrs WHERE periode=$th_akademik");
    }
}
