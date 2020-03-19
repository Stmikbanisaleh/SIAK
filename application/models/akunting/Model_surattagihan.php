<?php

class Model_surattagihan extends CI_model
{
	public function view($table)
    {
        $this->db->where('isdeleted !=', '1');
        return $this->db->get($table);
    }

	public function view_siswatg($nis, $kelas)
	{
		return $this->db->query("SELECT sp.nis,sp.Kelas,sp.sisa,s.nmsiswa,jk.nama kelas, sk.NamaSek, sp.Kelas FROM saldopembayaran_sekolah sp JOIN mssiswa s ON sp.NIS = s.NOINDUK JOIN tbkelas jk ON sp.Kelas = jk.id_kelas JOIN sekolah sk ON s.PS = sk.KodeSek WHERE sp.NIS = '2018030022' AND sp.Kelas  = '03'");
	}
}

?>