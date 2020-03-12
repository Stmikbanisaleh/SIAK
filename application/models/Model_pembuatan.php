<?php

class Model_pembuatan extends CI_model
{

    public function proses($jurusan, $tahun)
    {
        return  $this->db->query("SELECT*
		FROM calon_siswa
		WHERE kodesekolah='$jurusan' AND thnmasuk='$tahun' AND Noreg NOT IN(SELECT Noreg FROM mssiswa)
		Order by  NOREG ASC ");
    }
    public function getnis($thn,$kode){
        return $this->db->query("SELECT RIGHT(NOINDUK,3)AS ni FROM mssiswa WHERE TAHUN=$thn AND PS=$kode
        Order by NOINDUK DESC LIMIT 1");
    }
    public function generate($thn,$kode)
    {
        return $this->db->query("SELECT * FROM mssiswa WHERE TAHUN=$thn AND PS=$kode AND NOINDUK is null
		Order by NOREG ASC");
    }

    public function getdata()
    {
        return $this->db->query("SELECT
		(SELECT z.NIS FROM siswa z WHERE z.Noreg=pembayaran_sekolah.Noreg)AS NIS,
		pembayaran_sekolah.Nopembayaran,
		pembayaran_sekolah.Noreg,
		(SELECT z.Namacasis FROM calon_siswa z WHERE z.Noreg=pembayaran_sekolah.Noreg)AS Namacasis,
		DATE_FORMAT(tglentri,'%d-%m-%Y')tglbayar,
		pembayaran_sekolah.useridd,
		pembayaran_sekolah.TotalBayar,
        CONCAT('Rp. ',FORMAT(pembayaran_sekolah.TotalBayar,2)) as totalbayar2,
		(SELECT (SELECT y.NamaSek FROM sekolah y WHERE y.KodeSek=z.kodesekolah) FROM calon_siswa z WHERE z.Noreg=pembayaran_sekolah.Noreg)AS NamaSek,
		(SELECT (SELECT (SELECT x.NamaJurusan FROM jurusan x WHERE x.Kodejurusan=y.Jurusan) FROM sekolah y WHERE y.KodeSek=z.kodesekolah) FROM calon_siswa z WHERE z.Noreg=pembayaran_sekolah.Noreg)AS NamaJurusan,
		pembayaran_sekolah.TA
		FROM pembayaran_sekolah
		WHERE pembayaran_sekolah.Noreg NOT IN(SELECT Noreg FROM mssiswa)
		Order by Nopembayaran desc");
    }

    public function getjurusan()
    {
        return $this->db->query("
        SELECT sekolah.KodeSek,
														sekolah.NamaSek,
														jurusan.NamaJurusan
														FROM
														sekolah
														INNER JOIN jurusan ON sekolah.Jurusan = jurusan.Kodejurusan
														ORDER BY KodeSek DESC");
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
}