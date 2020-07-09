<?php

class Model_periksakehadiranguru extends CI_model
{

    public function view_kehadiran()
    {
        return  $this->db->query('SELECT ts.*, tg.GuruNama, mp.nama mapel FROM trdsrm ts
        JOIN tbguru tg ON ts.IdGuru = tg.IdGuru
        JOIN tbjadwal tj ON ts.idJadwal = tj.id
        JOIN mspelajaran mp ON tj.id_mapel = mp.id_mapel');
    }


    public function getguru($guru)
    {
        return $this->db->query("select a.JAM, a.id_mapel, b.nama,c.SINGKTBPS,a.nmklstrjdk, a.hari from tbjadwal a 
        join mspelajaran b on a.id_mapel = b.id_mapel
        join tbps c on a.ps = c.KDTBPS 
        where id_guru = '".$guru."' ");
    }
    
    public function getjadwal($guru, $mapel)
    {
        return  $this->db->query("SELECT mp.id_mapel,ts.*, tg.GuruNama, mp.nama mapel FROM trdsrm ts
        JOIN tbguru tg ON ts.IdGuru = tg.IdGuru
        JOIN tbjadwal tj ON ts.idJadwal = tj.id
        JOIN mspelajaran mp ON tj.id_mapel = mp.id_mapel where ts.IdGuru = '".$guru."' and mp.id_mapel ='".$mapel."' ");
    }

    public function viewOrdering($table, $order, $ordering)
    {
        // $this->db->where('isdeleted !=', 1);
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
        return $this->db->query('select nik from ' . $table . ' where nik = ' . $data_id . ' and isdeleted != 1')->num_rows();
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
