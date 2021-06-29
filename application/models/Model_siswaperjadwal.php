<?php

class Model_siswaperjadwal extends CI_model
{

    public function view($table)
    {
        return $this->db->get($table);
    }

	public function viewsiswa($jadwal)
    {
        return  $this->db->query("select a.id_krs as id,a.periode, b.nmsiswa,d.nama as mapel , c.nmklstrjdk from tbkrs a
		 join mssiswa b on a.NIS = b.NOINDUK
		 join tbjadwal c on a.id_jadwal = c.id
		 join mspelajaran d on c.id_mapel = d.id_mapel
		where a.id_jadwal = $jadwal");
    }

	public function viewjadwal($tahun, $ps)
    {
        return  $this->db->query("select a.id,a.nmklstrjdk,b.nama from tbjadwal a
		join mspelajaran b on a.id_mapel = b.id_mapel where a.ps = $ps and a.periode = $tahun  ");
    }

	public function gettahun()
    {
        return  $this->db->query('select distinct TAHUN from tbakadmk2 where isdeleted != 1 ORDER BY TAHUN DESC ');
    }

	public function getsekolah()
    {
        return  $this->db->query("SELECT a.id, a.KDTBPS, a.DESCRTBPS, a.SINGKTBPS, b.DESCRTBJS FROM tbps a JOIN tbjs b ON a.KDTBJS = b.KDTBJS");
    }
    public function viewOrdering($table, $order, $ordering)
    {
        $this->db->order_by($order, $ordering);
        return $this->db->get($table);
    }

    public function viewWhereOrdering($table, $data, $order, $ordering)
    {
        $this->db->where($data);
        $this->db->order_by($order, $ordering);
        return $this->db->get($table);
    }

    public function viewWhere($table, $data)
    {
        $this->db->where($data);
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
