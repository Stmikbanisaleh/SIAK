<?php

class Model_rekapkehadiranguru extends CI_model
{

    public function view()
    {
        return  $this->db->query('select g.*, j.nama as nama_jabatan from guru g join jabatan j on g.jabatan = j.id where g.isdeleted != 1 ');
    }

    public function viewOrdering($table, $order, $ordering)
    {
        $this->db->where('isdeleted !=', 1);
        $this->db->order_by($order, $ordering);
        return $this->db->get($table);
    }

    public function view_kehadiranguru($tahun, $blnawal, $blnakhir, $guru){

        if($guru == 'none'){
            return $this->db->query("select b.GuruNama,d.nama, c.JAM jam, sum(a.WKTHADIR) hadir, c.hari,a.ID,e.RUANG,f.SINGKTBPS,c.nmklstrjdk as kelas,sum(d.jam) as jml_jam, a.TAMBAHAN  from trdsrm a 
            join tbguru b on a.IdGuru = b.IdGuru 
            join tbjadwal c on a.idJadwal = c.id
            join mspelajaran d on c.id_mapel = d.id_mapel 
            join msruang e on c.id_ruang = e.ID
            join tbps f on c.ps = f.KDTBPS
            where YEAR(a.TGLHADIR) = '".$tahun."' and Month(a.TGLHADIR) between '".$blnawal."' and '".$blnakhir."'
            GROUP BY b.GuruNama,d.nama,c.hari,e.RUANG,f.SINGKTBPS,c.nmklstrjdk, a.idJadwal");
        } else {
            return $this->db->query("select b.GuruNama,d.nama, c.JAM jam, sum(a.WKTHADIR) hadir, c.hari,a.ID,e.RUANG,f.SINGKTBPS,c.nmklstrjdk as kelas,sum(d.jam) as jml_jam, a.TAMBAHAN  from trdsrm a 
            join tbguru b on a.IdGuru = b.IdGuru 
            join tbjadwal c on a.idJadwal = c.id
            join mspelajaran d on c.id_mapel = d.id_mapel 
            join msruang e on c.id_ruang = e.ID
            join tbps f on c.ps = f.KDTBPS
            where YEAR(a.TGLHADIR) = '".$tahun."' and Month(a.TGLHADIR) between '".$blnawal."' and '".$blnakhir."' and a.IdGuru = '".$guru."' GROUP BY b.GuruNama,d.nama,c.hari,e.RUANG,f.SINGKTBPS,c.nmklstrjdk, a.idJadwal");
        }
    }

    public function view_kehadiranguru_distinct($tahun, $blnawal, $blnakhir, $guru){

        if($guru == 'none'){
            return $this->db->query("select distinct a.IdGuru, b.GuruNama
            from trdsrm a 
            join tbguru b on a.IdGuru = b.IdGuru 
            join tbjadwal c on a.idJadwal = c.id
            join mspelajaran d on c.id_mapel = d.id_mapel 
            join msruang e on c.id_ruang = e.ID
            join tbps f on c.ps = f.KDTBPS
            where YEAR(a.TGLHADIR) = '".$tahun."' and Month(a.TGLHADIR) between '".$blnawal."' and '".$blnakhir."' ");
        } else {
            return $this->db->query("select distinct a.IdGuru, b.GuruNama
            from trdsrm a 
            join tbguru b on a.IdGuru = b.IdGuru 
            join tbjadwal c on a.idJadwal = c.id
            join mspelajaran d on c.id_mapel = d.id_mapel 
            join msruang e on c.id_ruang = e.ID
            join tbps f on c.ps = f.KDTBPS
            where YEAR(a.TGLHADIR) = '".$tahun."' and Month(a.TGLHADIR) between '".$blnawal."' and '".$blnakhir."' and a.IdGuru = '".$guru."'");
        }
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
