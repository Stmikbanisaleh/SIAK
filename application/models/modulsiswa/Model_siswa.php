<?php

class Model_siswa extends CI_model
{

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

    public function cek_kelas($th_akademik, $nis)
    {
        return $this->db->query("SELECT
                                    b.Kelas
                                FROM
                                mssiswa m
                                JOIN baginaikkelas b ON b.NIS = m.NOINDUK
                                WHERE m.NOINDUK = '$nis'
                                AND b.TA = '$th_akademik'
                                ORDER BY b.TA DESC
                                LIMIT 1");
    }

    public function kelas_siswa($th_akademik, $nis)
    {
        return $this->db->query("SELECT
                                    b.Kelas, m.PS
                                FROM
                                mssiswa m
                                JOIN baginaikkelas b ON b.NIS = m.NOINDUK
                                WHERE m.NOINDUK = '$nis'
                                AND b.TA = '$th_akademik'
                                ORDER BY b.TA DESC
                                LIMIT 1");
    }

    public function jumlah_siswa_bykelas($th_akademik, $kodesekolah, $kelas)
    {
        return $this->db->query("SELECT
                                    count(m.NOINDUK) jml_siswa
                                FROM
                                mssiswa m
                                JOIN baginaikkelas b ON b.NIS = m.NOINDUK
                                AND m.TAHUN = b.Thnmasuk
                                AND b.Kodesekolah = m.PS
                                AND m.ps = '$kodesekolah'
                                AND b.TA = '$th_akademik'
                                AND b.Kelas = '$kelas'");
    }

    public function nominal_spp($th_akademik, $kodesekolah, $kelas, $nis)
    {
        return $this->db->query("SELECT
                                    tb.Nominal
                                FROM
                                mssiswa m
                                JOIN baginaikkelas b ON b.NIS = m.NOINDUK
                                JOIN tarif_berlaku tb ON b.Thnmasuk = tb.ThnMasuk
                                AND tb.TA = b.TA
                                AND tb.kodesekolah = m.PS
                                AND tb.Kodejnsbayar ='SPP'
                                AND m.TAHUN = b.Thnmasuk
                                AND b.Kodesekolah = m.PS
                                AND m.ps = '$kodesekolah'
                                AND b.TA = '$th_akademik'
                                AND b.Kelas = '$kelas'
                                AND m.NOINDUK = '$nis'");
    }
}
