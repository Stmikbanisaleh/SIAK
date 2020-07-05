<?php

class Model_kehadiranguru extends CI_model
{

    public function viewtrdsm()
    {
        return  $this->db->query("select a.ID,b.JAM, b.hari ,d.GuruNama, d.IdGuru, c.nama, DATE_FORMAT(a.TGLHADIR,'%e  %M %Y') as TGLHADIR, TIME(a.MSKHADIR) as MSKHADIR , a.SLSHADIR,a.STINVAL,a.KETTDKHDR,a.TAMBAHAN from trdsrm a 
        join tbjadwal b on a.idJadwal = b.id
        join mspelajaran c on b.id_mapel = c.id_mapel
        join tbguru d on a.IdGuru = d.IdGuru 
        join tbps e on b.ps = e.KDTBPS
        ");
    }

  

    public function viewOrdering($table, $order, $ordering)
    {
        $this->db->where('isdeleted !=', 1);
        $this->db->order_by($order, $ordering);
        return $this->db->get($table);
    }

    public function getsearch($idguru, $mapel){
        if(empty($mapel)){
            return  $this->db->query("select a.ID,b.JAM, b.hari ,d.GuruNama, d.IdGuru, c.nama, DATE_FORMAT(a.TGLHADIR,'%e  %M %Y') as TGLHADIR, TIME(a.MSKHADIR) as MSKHADIR , a.SLSHADIR,a.STINVAL,a.KETTDKHDR,a.TAMBAHAN from trdsrm a 
            join tbjadwal b on a.idJadwal = b.id
            join mspelajaran c on b.id_mapel = c.id_mapel
            join tbguru d on a.IdGuru = d.IdGuru 
            join tbps e on b.ps = e.KDTBPS 
            where a.IdGuru = '".$idguru."'
            ");
        } else {
            return  $this->db->query("select a.ID,b.JAM, b.hari ,d.GuruNama, d.IdGuru, c.nama, DATE_FORMAT(a.TGLHADIR,'%e  %M %Y') as TGLHADIR, TIME(a.MSKHADIR) as MSKHADIR , a.SLSHADIR,a.STINVAL,a.KETTDKHDR,a.TAMBAHAN from trdsrm a 
            join tbjadwal b on a.idJadwal = b.id
            join mspelajaran c on b.id_mapel = c.id_mapel
            join tbguru d on a.IdGuru = d.IdGuru 
            join tbps e on b.ps = e.KDTBPS 
            where a.IdGuru = '".$idguru."' and b.id_mapel = '".$mapel."'
            ");
        }
       
    }

    public function getguru($guru)
    {
        return $this->db->query("select a.JAM, a.id_mapel, b.nama,c.SINGKTBPS,a.nmklstrjdk, a.hari from tbjadwal a 
        join mspelajaran b on a.id_mapel = b.id_mapel
        join tbps c on a.ps = c.KDTBPS 
        where id_guru = '".$guru."' ");
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
