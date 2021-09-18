<?php

class Model_penentuan extends CI_model
{

    public function getkelas($ThnAkademik, $jenis)
    {
        $v_thnmasuk = "WHERE thnmasuk='" . $ThnAkademik . "' AND kodesekolah='" . $jenis. "'";
        return  $this->db->query(
			"SELECT a.*,b.NAMA_REV as v_Jk, c.DESCRTBAGAMA as v_agama,
			(SELECT (SELECT Y.nama FROM tbkelas Y WHERE Y.id_kelas=z.Kelas) FROM baginaikkelas z WHERE z.NIS=a.NOINDUK AND z.Thnmasuk='".$ThnAkademik."'  Order by idbagiNaikKelas desc  limit 1 )AS Kelas,
			(SELECT z.GolKelas FROM baginaikkelas z WHERE z.NIS=a.NOINDUK AND z.Thnmasuk='".$ThnAkademik."' Order by idbagiNaikKelas desc  limit 1)AS GolKelas 
         FROM mssiswa a 
		 left join msrev b on a.JK = b.KETERANGAN 
		 left join tbagama c on a.AGAMA = c.KDTBAGAMA
		 WHERE TAHUN ='".$ThnAkademik."' AND ps='".$jenis."' Order by NOINDUK desc 
        ");
	}

    public function getformatexcel()
    {
        return $this->db->query("Select * from msruang");
    }

    public function getformatexcel2()
    {
        return $this->db->query("Select * from tbjs");
    }
    public function getformatexcel3()
    {
        return $this->db->query("Select * from tbps");
    }

    public function viewOrdering($table, $order, $ordering)
    {
        $this->db->where('isdeleted !=', 1);
        $this->db->order_by($order, $ordering);
        return $this->db->get($table);
    }
    public function getjurusan()
    {
        return $this->db->query("SELECT a.id, a.KDTBPS KodeSek, a.DESCRTBPS NamaSek, a.SINGKTBPS, b.DESCRTBJS NamaJurusan FROM tbps a JOIN tbjs b ON a.KDTBJS = b.KDTBJS ORDER BY a.KDTBPS ASC");
    }

    public function gettahun()
    {
        return  $this->db->query('select distinct TAHUN from tbakadmk2 where isdeleted != 1 ORDER BY TAHUN DESC ');
    }

    public function getguru()
    {
        return  $this->db->query('select * from tbguru where isdeleted != 1 ORDER BY id DESC ');
    }

    public function getsemester()
    {
        return  $this->db->query('select distinct SEMESTER from tbakadmk where isdeleted != 1 ORDER BY SEMESTER DESC ');
    }

    public function getrev()
    {
        return  $this->db->query('SELECT*FROM msrev WHERE `STATUS`=10 AND isdeleted != 1');
    }

    public function getjadwal($periode, $programsekolah)
    {
        return  $this->db->query("SELECT
        tbguru.IdGuru,
        tbguru.GuruNama,
        tbjadwal.id_mapel,
        mspelajaran.nama,
        tbjadwal.hari,
        msruang.RUANG,
        tbjadwal.NMKLSTRJDK,
        tbjadwal.JAM,
        tbps.DESCRTBPS,
        tbjadwal.id
        FROM
        tbjadwal
        LEFT JOIN tbguru ON tbjadwal.id_guru = tbguru.IdGuru
        INNER JOIN mspelajaran ON tbjadwal.id_mapel = mspelajaran.id_mapel
        INNER JOIN msruang ON tbjadwal.id_ruang = msruang.ID
        INNER JOIN tbps ON tbjadwal.PS = tbps.KDTBPS
        WHERE tbjadwal.periode= " . $periode . " AND tbjadwal.PS= " . $programsekolah . "
        ORDER BY hari");
    }

    public function getps()
    {
        return  $this->db->query('SELECT DISTINCT 
        KDTBPS, DESCRTBPS,SINGKTBPS 
        FROM TBPS ORDER BY KDTBPS DESC ');
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

    public function view_where_noisdelete($data, $table)
    {
        $this->db->where($data);
        return $this->db->get($table);
    }

    public function view_count($table, $data_id)
    {
        return $this->db->query("select RUANG from " . $table . " where RUANG = '" . $data_id['RUANG'] . "' and isdeleted != 1")->num_rows();
    }

    public function insert($data, $table)
    {
        $result = $this->db->insert($table, $data);
        return $result;
    }

    function update($where, $data, $table)
    {
        $this->db->where($data);
        return $this->db->update($table, $where);
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
