<?php

class Model_jadwal extends CI_model
{

    public function view($periode,$ps)
    {
        return  $this->db->query("select * from tbjadwal a 
        left join tbguru b on a.id_guru = b.idGuru
        join mspelajaran c on a.id_mapel = c.id_mapel
        join msruang d on a.id_ruang = d.ID
        join tbps e on a.ps = e.KDTBPS where a.periode = " .$periode ." and a.ps = ".$ps." 
        ");
    }

    public function viewOrdering($table, $order, $ordering)
    {
        $this->db->where('isdeleted !=', 1);
        $this->db->order_by($order, $ordering);
        return $this->db->get($table);
    }

    public function gettahun()
    {
        return  $this->db->query('select TAHUN from tbakadmk where isdeleted != 1 ORDER BY TAHUN DESC ');
    }

    public function getguru()
    {
        return  $this->db->query('select * from tbguru where isdeleted != 1 ORDER BY id DESC ');
    }

    public function getsemester()
    {
        return  $this->db->query('select SEMESTER from tbakadmk where isdeleted != 1 ORDER BY SEMESTER DESC ');
    }

    public function getjadwal($periode, $programsekolah)
    {
        return  $this->db->query("SELECT
        TBGURU.IdGuru,
        TBGURU.GuruNama,
        TBJADWAL.id_mapel,
        MSPELAJARAN.nama,
        TBJADWAL.hari,
        MSRUANG.RUANG,
        TBJADWAL.NMKLSTRJDK,
        TBJADWAL.JAM,
        TBPS.DESCRTBPS,
        TBJADWAL.id
        FROM
        TBJADWAL
        LEFT JOIN TBGURU ON TBJADWAL.id_guru = TBGURU.IdGuru
        INNER JOIN MSPELAJARAN ON TBJADWAL.id_mapel = MSPELAJARAN.id_mapel
        INNER JOIN MSRUANG ON TBJADWAL.id_ruang = MSRUANG.ID
        INNER JOIN TBPS ON TBJADWAL.PS = TBPS.KDTBPS
        WHERE TBJADWAL.periode= ".$periode ." AND TBJADWAL.PS= ". $programsekolah."
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
