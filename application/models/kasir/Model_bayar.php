<?php

class Model_bayar extends CI_model
{

    public function view_visi($table)
    {
        $this->db->where('jenis =', '1');
        return $this->db->get($table);
    }

    public function getsiswa($noreg){
        if(empty($noreg)){
            $v_cek = "WHERE detail_bayar_sekolah.kodejnsbayar NOT IN('SPP','GDG','KGT','FRM')";
        } else {
            $v_cek = "WHERE detail_bayar_sekolah.kodejnsbayar NOT IN('SPP','GDG','KGT','FRM') AND pembayaran_sekolah.NIS='$noreg' OR mssiswa.Noinduk='$noreg' AND detail_bayar_sekolah.kodejnsbayar NOT IN('SPP','GDG','KGT','FRM') ";
        }
        return $this->db->query("SELECT DISTINCT
        mssiswa.NOINDUK,
        pembayaran_sekolah.Noreg,
        mssiswa.NMSISWA,
        tbps.DESCRTBPS NamaSek,
        tarif_berlaku.Nominal,
        CONCAT('Rp. ',FORMAT(tarif_berlaku.Nominal,2)) AS Nominal2,
        pembayaran_sekolah.TA,
        tbkelas.nama,
        jenispembayaran.namajenisbayar,
        detail_bayar_sekolah.kodejnsbayar,
        CONCAT('Rp. ',FORMAT(SUM(pembayaran_sekolah.TotalBayar),2)) AS TotalBayar2,
        SUM(pembayaran_sekolah.TotalBayar)AS TotalBayar
        FROM
        pembayaran_sekolah
        INNER JOIN mssiswa ON mssiswa.Noreg = pembayaran_sekolah.Noreg
        INNER JOIN tbps ON mssiswa.PS = tbps.KDTBPS
        INNER JOIN tbkelas ON pembayaran_sekolah.Kelas = tbkelas.id_kelas
        INNER JOIN detail_bayar_sekolah ON pembayaran_sekolah.Nopembayaran = detail_bayar_sekolah.Nopembayaran
        INNER JOIN tarif_berlaku ON detail_bayar_sekolah.idtarif = tarif_berlaku.idtarif
        INNER JOIN jenispembayaran ON jenispembayaran.Kodejnsbayar = tarif_berlaku.Kodejnsbayar $v_cek 
		GROUP BY kodejnsbayar");
    }

    public function view($table)
    {
        $this->db->where('isdeleted !=' ,1);
        return $this->db->get($table);
    }

    public function view_misi($table)
    {
        $this->db->where('jenis =', '2');
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
