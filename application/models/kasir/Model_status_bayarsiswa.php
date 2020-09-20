<?php

class Model_status_bayarsiswa extends CI_model
{

    public function getkelas($data)
    {
        return $this->db->query("select TAHUN from mssiswa where NOINDUK = '".$data."'");
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

    public function view_siswa($nis){
        return $this->db->query('SELECT
                                    ms.NOINDUK,
                                    ms.NMSISWA,
                                    ps.DESCRTBPS sekolah
                                FROM
                                mssiswa ms
                                JOIN tbps ps ON ps.KDTBPS = ms.ps
                                WHERE ms.NOINDUK = "'.$nis.'"');
    }

    public function view_list_status($nis, $thnakad){
        $where_thnakad = '';
        if($thnakad!="0"){
            $where_thnakad = 'AND tb.TA = "'.$thnakad.'"';
        }
        return $this->db->query('SELECT
                                    ms.NOINDUK,
                                    tb.Kodejnsbayar,
                                    jp.namajenisbayar,
                                    IFNULL((SELECT 
                                    pms.Kelas
                                    FROM pembayaran_sekolah pms
                                    JOIN detail_bayar_sekolah dbs ON dbs.Nopembayaran = pms.Nopembayaran
                                    WHERE pms.NIS = ms.NOINDUK
                                        AND dbs.kodejnsbayar = tb.Kodejnsbayar
                                        AND pms.TA = tb.TA
                                    LIMIT 1), "-") kelas,
                                    tb.TA,
                                    FORMAT(tb.Nominal, 0) tarif_berlaku,
                                    FORMAT((SELECT
                                        SUM(dbs.nominalbayar)
                                    FROM pembayaran_sekolah pms
                                    JOIN detail_bayar_sekolah dbs ON dbs.Nopembayaran = pms.Nopembayaran
                                    WHERE pms.NIS = ms.NOINDUK
                                        AND dbs.kodejnsbayar = tb.Kodejnsbayar
                                        AND tb.TA = pms.TA), 0) nominal_bayar,
                                    (SELECT 
                                        msp.id
                                    FROM pembayaran_sekolah pms
                                    JOIN detail_bayar_sekolah dbs ON dbs.Nopembayaran = pms.Nopembayaran
                                    JOIN mapping_status_pembayaran msp ON msp.id = dbs.id_status_pembayaran
                                    WHERE pms.NIS = ms.NOINDUK
                                        AND dbs.kodejnsbayar = tb.Kodejnsbayar
                                        AND pms.TA = tb.TA
                                    LIMIT 1) id_status_pembayaran,
                                    (SELECT 
                                        msp.status
                                    FROM pembayaran_sekolah pms
                                    JOIN detail_bayar_sekolah dbs ON dbs.Nopembayaran = pms.Nopembayaran
                                    JOIN mapping_status_pembayaran msp ON msp.id = dbs.id_status_pembayaran
                                    WHERE pms.NIS = ms.NOINDUK
                                        AND dbs.kodejnsbayar = tb.Kodejnsbayar
                                        AND pms.TA = tb.TA
                                    LIMIT 1) status_pembayaran,
                                    FORMAT((SELECT 
                                        msp.nominal
                                    FROM pembayaran_sekolah pms
                                    JOIN detail_bayar_sekolah dbs ON dbs.Nopembayaran = pms.Nopembayaran
                                    JOIN mapping_status_pembayaran msp ON msp.id = dbs.id_status_pembayaran
                                    WHERE pms.NIS = ms.NOINDUK
                                        AND dbs.kodejnsbayar = tb.Kodejnsbayar
                                        AND pms.TA = tb.TA
                                    LIMIT 1), 0) nominal_lunas,
                                    (SELECT 
                                        msp.nominal
                                    FROM pembayaran_sekolah pms
                                    JOIN detail_bayar_sekolah dbs ON dbs.Nopembayaran = pms.Nopembayaran
                                    JOIN mapping_status_pembayaran msp ON msp.id = dbs.id_status_pembayaran
                                    WHERE pms.NIS = ms.NOINDUK
                                        AND dbs.kodejnsbayar = tb.Kodejnsbayar
                                        AND pms.TA = tb.TA
                                    LIMIT 1) nominal_lunas_nf,
                                    IFNULL((SELECT 
                                        tp.nama
                                    FROM pembayaran_sekolah pms
                                    JOIN detail_bayar_sekolah dbs ON dbs.Nopembayaran = pms.Nopembayaran
                                    JOIN mapping_status_pembayaran msp ON msp.id = dbs.id_status_pembayaran
                                    JOIN tbpengawas tp ON tp.nip = msp.userInput
                                    WHERE pms.NIS = ms.NOINDUK
                                        AND dbs.kodejnsbayar = tb.Kodejnsbayar
                                        AND pms.TA = tb.TA
                                    LIMIT 1), "-") user_input
                                FROM
                                mssiswa ms
                                JOIN tbps ps ON ps.KDTBPS = ms.ps
                                JOIN tarif_berlaku tb ON ps.KDTBPS = tb.kodesekolah
                                JOIN jenispembayaran jp ON jp.Kodejnsbayar = tb.Kodejnsbayar
                                WHERE ms.NOINDUK = "'.$nis.'"
                                AND ms.TAHUN = (SELECT substring(bn.TA, 6, 8)-bn.Kelas from baginaikkelas bn where bn.nis = ms.NOINDUK limit 1)
                                '.$where_thnakad.'
                                AND tb.ThnMasuk = ms.TAHUN
                                ORDER BY tb.TA DESC, jp.namajenisbayar ASC');
    }

    public function view_detail_bayar($nis, $kodejnsbayar, $kelas, $ta){
        return $this->db->query("SELECT
                                dbs.NodetailBayar
                                FROM pembayaran_sekolah pms
                                JOIN detail_bayar_sekolah dbs ON dbs.Nopembayaran = pms.Nopembayaran
                                WHERE pms.NIS = '$nis'
                                    AND dbs.kodejnsbayar = '$kodejnsbayar'
                                    AND pms.TA = '$ta'
                                    AND pms.Kelas = '$kelas'");
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
