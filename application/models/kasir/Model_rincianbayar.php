<?php

class Model_rincianbayar extends CI_model
{

    public function getrincianbayar($nis, $kodesekolah, $kelas, $ta)
    {
        return  $this->db->query("SELECT q1.*, q1.Nominal-q1.jumlah_bayar total
                                    FROM(
                                        SELECT
                                            tb.kodesekolah,
                                            tb.TA,
                                            bk.Thnmasuk,
                                            bk.NIS,
                                            ms.NMSISWA,
                                            bk.Kelas,
                                            tb.idtarif,
                                            tb.Kodejnsbayar,
    	                                    jp.namajenisbayar,
                                            tb.Nominal,
                                            IFNULL((SELECT SUM(dbs.nominalbayar) FROM
                                            detail_bayar_sekolah dbs
                                            JOIN pembayaran_sekolah pms ON dbs.Nopembayaran = pms.Nopembayaran
                                            WHERE dbs.kodejnsbayar = tb.Kodejnsbayar
                                            AND pms.TA = tb.ta
                                            AND pms.NIS = bk.NIS
                                            AND pms.Kelas = bk.Kelas
                                            AND pms.kodesekolah = tb.kodesekolah), 0) jumlah_bayar
                                        FROM tarif_berlaku tb
                                        INNER JOIN baginaikkelas bk ON bk.TA = tb.TA
                                        INNER JOIN mssiswa ms ON bk.NIS = ms.NOINDUK
                                        JOIN jenispembayaran jp ON jp.Kodejnsbayar = tb.Kodejnsbayar
                                        WHERE 1=1 and
                                        tb.TA = '$ta'
                                        AND bk.Kodesekolah = tb.kodesekolah
                                        AND bk.Thnmasuk = tb.ThnMasuk
                                        and tb.kodesekolah = $kodesekolah
                                        and bk.Kelas = $kelas
                                        AND bk.NIS = '$nis') q1");
    }

    public function gettahun($table)
    {
        return $this->db->query("select distinct THNAKAD from .$table ORDER BY THNAKAD DESC");
    }

    public function view($table)
    {
        $this->db->where('isdeleted !=', '1');
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
