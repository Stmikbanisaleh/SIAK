<?php

class Model_rekap extends CI_model
{
    public function view_tagihan($siswa, $thnakad)
    {
        return $this->db->query("SELECT *,
                                    FORMAT(mq.nominal_spp-mq.byr_spp, 0) blmbyr_spp,
                                    FORMAT(mq.nominal_gdg-mq.byr_gdg, 0) blmbyr_gdg,
                                    FORMAT(mq.nominal_srg-mq.byr_srg, 0) blmbyr_srg,
                                    FORMAT(mq.nominal_kgt-mq.byr_kgt, 0) blmbyr_kgt,
                                    FORMAT(TotalTagihan-(byr_spp+byr_gdg+byr_srg+byr_kgt), 0) blm_bayar
                                FROM
                                (SELECT
                                    (SELECT z.THNAKAD FROM tbakadmk z WHERE z.ID=saldopembayaran_sekolah.TA) AS TAS,
                                    calon_siswa.thnmasuk,
                                    calon_siswa.kodesekolah,
                                    calon_siswa.Noreg,
                                    mssiswa.NOINDUK,
                                    saldopembayaran_sekolah.Sisa as  Sisa2,
                                    FORMAT(saldopembayaran_sekolah.Sisa, 0) Sisa,
                                    saldopembayaran_sekolah.Kelas,
                                    calon_siswa.Namacasis,
                                    FORMAT(saldopembayaran_sekolah.TotalTagihan, 0) TotalTagihan,
                                    FORMAT((SELECT 
                                        ROUND(Nominal-(Nominal*saldopembayaran_sekolah.pot_spp/100), 0)
                                        FROM tarif_berlaku
                                        WHERE ThnMasuk = calon_siswa.thnmasuk
                                        AND kodesekolah = calon_siswa.kodesekolah
                                        AND Kodejnsbayar='SPP'), 0) nominal_spp,
                                    FORMAT((SELECT 
                                        ROUND(Nominal-(Nominal*saldopembayaran_sekolah.pot_spp/100), 0)
                                        FROM tarif_berlaku
                                        WHERE ThnMasuk = calon_siswa.thnmasuk
                                        AND kodesekolah = calon_siswa.kodesekolah
                                        AND Kodejnsbayar='GDG'), 0) nominal_GDG,
                                    FORMAT((SELECT
                                        ROUND(Nominal-(Nominal*saldopembayaran_sekolah.pot_spp/100), 0)
                                        FROM tarif_berlaku
                                        WHERE ThnMasuk = calon_siswa.thnmasuk
                                        AND kodesekolah = calon_siswa.kodesekolah
                                        AND Kodejnsbayar='SRG'), 0) nominal_SRG,
                                    FORMAT((SELECT
                                        ROUND(Nominal-(Nominal*saldopembayaran_sekolah.pot_spp/100), 0)
                                        FROM tarif_berlaku
                                        WHERE ThnMasuk = calon_siswa.thnmasuk
                                        AND kodesekolah = calon_siswa.kodesekolah
                                        AND Kodejnsbayar='KGT'), 0) nominal_KGT,
                                    (SELECT
                                        SUM((SELECT SUM(z.nominalbayar)
                                            FROM detail_bayar_sekolah z
                                            WHERE z.Nopembayaran=pembayaran_sekolah.Nopembayaran
                                            AND z.kodejnsbayar='SPP'))
                                        FROM
                                            pembayaran_sekolah
                                        WHERE NIS = mssiswa.NOINDUK
                                        AND Kelas = saldopembayaran_sekolah.Kelas
                                        AND TA='$thnakad') byr_spp,
                                    (SELECT
                                        SUM((SELECT SUM(z.nominalbayar)
                                            FROM detail_bayar_sekolah z
                                            WHERE z.Nopembayaran=pembayaran_sekolah.Nopembayaran
                                            AND z.kodejnsbayar='GDG'))
                                        FROM
                                            pembayaran_sekolah
                                        WHERE NIS = mssiswa.NOINDUK
                                        AND Kelas = saldopembayaran_sekolah.Kelas
                                        AND TA='$thnakad') byr_gdg,
                                    (SELECT
                                        SUM((SELECT SUM(z.nominalbayar)
                                            FROM detail_bayar_sekolah z
                                            WHERE z.Nopembayaran=pembayaran_sekolah.Nopembayaran
                                            AND z.kodejnsbayar='SRG'))
                                        FROM
                                            pembayaran_sekolah
                                        WHERE NIS = mssiswa.NOINDUK
                                        AND Kelas = saldopembayaran_sekolah.Kelas
                                        AND TA='$thnakad') byr_srg,
                                    (SELECT
                                        SUM((SELECT SUM(z.nominalbayar)
                                            FROM detail_bayar_sekolah z
                                            WHERE z.Nopembayaran=pembayaran_sekolah.Nopembayaran
                                            AND z.kodejnsbayar='KGT'))
                                        FROM
                                            pembayaran_sekolah
                                        WHERE NIS = mssiswa.NOINDUK
                                        AND Kelas = saldopembayaran_sekolah.Kelas
                                        AND TA='$thnakad') byr_kgt,
                                    (SELECT
                                        idtarif
                                        FROM tarif_berlaku
                                        WHERE ThnMasuk = calon_siswa.thnmasuk
                                        AND kodesekolah = calon_siswa.kodesekolah
                                        AND Kodejnsbayar='SPP') id_spp,
                                    (SELECT
                                        idtarif
                                        FROM tarif_berlaku
                                        WHERE ThnMasuk = calon_siswa.thnmasuk
                                        AND kodesekolah = calon_siswa.kodesekolah
                                        AND Kodejnsbayar='GDG') id_gdg,
                                    (SELECT
                                        idtarif
                                        FROM tarif_berlaku
                                        WHERE ThnMasuk = calon_siswa.thnmasuk
                                        AND kodesekolah = calon_siswa.kodesekolah
                                        AND Kodejnsbayar='SRG') id_srg,
                                    (SELECT
                                        idtarif
                                        FROM tarif_berlaku
                                        WHERE ThnMasuk = calon_siswa.thnmasuk
                                        AND kodesekolah = calon_siswa.kodesekolah
                                        AND Kodejnsbayar='KGT') id_kgt
                                    FROM saldopembayaran_sekolah
                                    INNER JOIN calon_siswa ON saldopembayaran_sekolah.Noreg = calon_siswa.Noreg
                                    LEFT JOIN mssiswa ON mssiswa.Noreg = calon_siswa.Noreg
                                    WHERE NIS = '$siswa') mq");
    }

    public function pembsis_detail($siswa)
    {
        return $this->db->query("SELECT
                                    saldopembayaran_sekolah.idsaldo,
                                    saldopembayaran_sekolah.NIS,
                                    saldopembayaran_sekolah.Noreg,
                                    saldopembayaran_sekolah.Kdjnsbayar,
                                    saldopembayaran_sekolah.idtarif,
                                    saldopembayaran_sekolah.TotalTagihan TotalTagihan,
                                    saldopembayaran_sekolah.Bayar Bayar,
                                    saldopembayaran_sekolah.Sisa Sisa,
                                    (SELECT z.THNAKAD FROM tbakadmk z WHERE z.ID=saldopembayaran_sekolah.TA)AS TA,
                                    (SELECT z.nama FROM tbkelas z WHERE z.id_kelas=saldopembayaran_sekolah.Kelas)AS Kelas
                                    FROM saldopembayaran_sekolah
                                    WHERE NIS='$siswa' OR saldopembayaran_sekolah.Noreg='$siswa'
                                    ORDER BY Kelas DESC");
    }

    public function pemb_sekolah($siswa)
    {
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
                                    WHERE pembayaran_sekolah.NIS='" . $siswa . "' OR pembayaran_sekolah.Noreg='" . $siswa . "' AND pembayaran_sekolah.Kelas IS NOT NULL
                                    ORDER BY tglentri desc");
    }

    public function pemb_sekolah_q2($siswa)
    {
        return $this->db->query("SELECT
                                    pembayaran_sekolah.NIS,Noreg,
                                    (SELECT z.nama FROM tbkelas z WHERE z.id_kelas=pembayaran_sekolah.Kelas)AS Kelas,
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
