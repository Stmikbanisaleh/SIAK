<?php

class Model_kartubayar extends CI_model
{
	public function view($table)
    {
        $this->db->where('isdeleted !=', '1');
        return $this->db->get($table);
    }

	public function view_nopem($nis)
	{
		return $this->db->query("SELECT 
								pembayaran_sekolah.Nopembayaran,
								pembayaran_sekolah.NIS,
								DATE_FORMAT(tglentri,'%d-%m-%Y') tglentri
								FROM pembayaran_sekolah
								WHERE NIS = '$nis'");
	}
}

?>