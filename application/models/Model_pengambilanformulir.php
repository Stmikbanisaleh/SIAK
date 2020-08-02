<?php

class Model_pengambilanformulir extends CI_model
{

    public function getnopembayaran($data)
    {
        return  $this->db->query("SELECT * FROM pembayaran_sekolah where Noreg='$data' ORDER BY Nopembayaran DESC LIMIT 1");
    }

    public function deletedetail($data)
    {
        return  $this->db->query("DELETE FROM detail_bayar_sekolah WHERE Nopembayaran='$data'");
    }

    public function deletepembayaransekolah($data)
    {
        return  $this->db->query("DELETE FROM pembayaran_sekolah WHERE Noreg ='$data'");
    }

    public function deletecalonsiswa($data)
    {
        return  $this->db->query("DELETE FROM calon_siswa WHERE Noreg='$data'");
    }

    public function getidtarif($sekolah)
    {
        return  $this->db->query("SELECT * FROM tarif_berlaku WHERE `status`='T' AND Kodejnsbayar='FRM' AND kodesekolah='$sekolah' and isdeleted != 1");
    }

    public function getdata($ThnAkademik)
    {
        return  $this->db->query("SELECT 
		DISTINCT
		a.Noreg,
	    a.Namacasis,
        a.TelpHp,
        a.email,
		a.tglentri,
		a.userentri,
		a.TA,
		(SELECT z.DESCRTBPS FROM tbps z WHERE z.KDTBPS=a.kodesekolah)AS NamaSek,
        (SELECT b.DESCRTBJS FROM tbps a JOIN tbjs b ON a.KDTBJS = b.KDTBJS WHERE a.KDTBPS=a.kodesekolah)AS NamaJurusan,
		a.kodesekolah,
		a.thnmasuk FROM calon_siswa a
        WHERE a.TA ='$ThnAkademik'
        order by a.Noreg desc
	");
    }

    public function getsekolah($ThnAkademik)
    {
        return $this->db->query("SELECT
        tarif_berlaku.idtarif,
        kodesekolah,
        (SELECT z.DESCRTBPS FROM tbps z WHERE z.KDTBPS = tarif_berlaku.kodesekolah)AS sekolah,
        (SELECT b.DESCRTBJS FROM tbps a JOIN tbjs b ON a.KDTBJS = b.KDTBJS WHERE a.KDTBPS=tarif_berlaku.kodesekolah)AS NamaJurusan,
        tarif_berlaku.Kodejnsbayar,
        tarif_berlaku.ThnMasuk,
        tarif_berlaku.Nominal,
        tarif_berlaku.TA,
        tarif_berlaku.tglentri,
        tarif_berlaku.userridd,
        tarif_berlaku.`status`
        FROM tarif_berlaku WHERE `status`='T' AND Kodejnsbayar='FRM' AND TA='$ThnAkademik'");
    }

    public function get_thnakad3()
    {
        return  $this->db->query("SELECT distinct(THNAKAD) FROM tbakadmk3 where isdeleted != 1");
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
        return $this->db->query("select NAMA from " . $table . " where NAMA = '" . $data_id['NAMA'] . "' and isdeleted != 1")->num_rows();
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
