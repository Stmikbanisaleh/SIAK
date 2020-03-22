<?php

class Model_bayarsiswa extends CI_model
{

    public function view_visi($table)
    {
        $this->db->where('jenis =', '1');
        return $this->db->get($table);
    }

    public function pembsis_detail($siswa, $kelas){
        return $this->db->query("SELECT
                                    saldopembayaran_sekolah.idsaldo,
                                    saldopembayaran_sekolah.NIS,
                                    saldopembayaran_sekolah.Noreg,
                                    saldopembayaran_sekolah.Kdjnsbayar,
                                    saldopembayaran_sekolah.idtarif,
                                    saldopembayaran_sekolah.TotalTagihan TotalTagihan,
                                    saldopembayaran_sekolah.Bayar Bayar,
                                    saldopembayaran_sekolah.Sisa Sisa,
                                    (SELECT z.ThnAkademik FROM tahunakademik_2 z WHERE z.IdTA=saldopembayaran_sekolah.TA)AS TA,
                                    (SELECT z.nama FROM tbkelas z WHERE z.id_kelas=saldopembayaran_sekolah.Kelas)AS Kelas
                                    FROM saldopembayaran_sekolah
                                    WHERE NIS='$siswa' OR saldopembayaran_sekolah.Noreg='$siswa'
                                    ORDER BY Kelas DESC");
    }

    public function pemb_sekolah($siswa, $kelas){
        return $this->db->query("SELECT
                                    pembayaran_sekolah.Nopembayaran,Noreg,
                                    pembayaran_sekolah.NIS,
                                    pembayaran_sekolah.Noreg,
                                    (SELECT z.nama FROM tbkelas z WHERE z.id_kelas=pembayaran_sekolah.Kelas)AS Kelas,
                                    DATE_FORMAT(pembayaran_sekolah.tglentri,'%d-%m-%Y')tglentri,
                                    pembayaran_sekolah.useridd,
                                    pembayaran_sekolah.TotalBayar,
                                    pembayaran_sekolah.TA
                                    FROM pembayaran_sekolah
                                    WHERE pembayaran_sekolah.NIS='".$siswa."' OR pembayaran_sekolah.Noreg='".$siswa."' AND pembayaran_sekolah.Kelas IS NOT NULL
                                    ORDER BY tglentri desc");
    }

    public function pemb_sekolah_q2($siswa, $kelas){
        return $this->db->query("SELECT
                                    pembayaran_sekolah.NIS,Noreg,
                                    (SELECT z.Kelas FROM jnskelas z WHERE z.IdKelas=pembayaran_sekolah.Kelas) AS Kelas,
                                    DATE_FORMAT(pembayaran_sekolah.tglentri,'%d-%m-%Y')tglentri,
                                    jenispembayaran.namajenisbayar,
                                    detail_bayar_sekolah.nominalbayar,
                                    tarif_berlaku.Nominal,
                                    (tarif_berlaku.Nominal-detail_bayar_sekolah.nominalbayar)AS sisa,
                                    pembayaran_sekolah.useridd,
                                    detail_bayar_sekolah.NodetailBayar,
                                    pembayaran_sekolah.TA
                                    FROM
                                    pembayaran_sekolah
                                    INNER JOIN detail_bayar_sekolah ON pembayaran_sekolah.Nopembayaran = detail_bayar_sekolah.Nopembayaran
                                    INNER JOIN tarif_berlaku ON detail_bayar_sekolah.idtarif = tarif_berlaku.idtarif
                                    INNER JOIN jenispembayaran ON detail_bayar_sekolah.kodejnsbayar = jenispembayaran.Kodejnsbayar
                                    WHERE pembayaran_sekolah.NIS='$siswa' OR pembayaran_sekolah.Noreg='$siswa'
                                    ORDER BY tglentri desc");
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
