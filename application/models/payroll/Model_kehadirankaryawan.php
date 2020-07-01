<?php

class Model_kehadirankaryawan extends CI_model
{
    public function view($table)
    {
        return $this->db->get($table);
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
        return $this->db->get($table);
    }

    public function view_kehadirankaryawan($tahun, $blnawal, $blnakhir, $karyawan){

        if($karyawan == 'none'){
            return $this->db->query("select a.id,b.nip,b.nama,DATE(a.tanggal) as tanggal ,DATE_FORMAT(a.tanggal, '%a') as hari from tbkehadiran a join biodata_karyawan b on a.pin = b.nip where YEAR(a.tanggal) = '" . $tahun . "' and Month(a.tanggal) between '".$blnawal."' and '".$blnakhir."' and time(a.tanggal) BETWEEN '05:00:00' and '10:00:00'");
        } else {
            return $this->db->query("select a.id,b.nip,b.nama,DATE(a.tanggal) as tanggal, DATE_FORMAT(a.tanggal, '%a') as hari from tbkehadiran a join biodata_karyawan b on a.pin = b.nip where YEAR(a.tanggal) = '" . $tahun . "' and Month(a.tanggal) between '".$blnawal."' and '".$blnakhir."' and b.nip ='".$karyawan."' and time(a.tanggal) BETWEEN '05:00:00' and '10:00:00'");
        }
    }

    public function view_jammasuk($tanggal, $nip)
    {
        return $this->db->query("select time(a.tanggal) as jam_masuk from tbkehadiran a left join biodata_karyawan
        b on a.pin = b.nip WHERE time(a.tanggal) BETWEEN '05:00:00' and '10:00:00' and date(a.tanggal) = '".$tanggal."' and b.nip = '".$nip."'");
    }

    public function view_jamkeluar($tanggal, $nip)
    {
        return $this->db->query("select time(a.tanggal) as jam_keluar from tbkehadiran a left join biodata_karyawan
        b on a.pin = b.nip WHERE time(a.tanggal) BETWEEN '15:00:00' and '18:00:00' and date(a.tanggal) = '".$tanggal."' and b.nip = '".$nip."'");
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

    public function view_potongan(){
        return $this->db->query("select a.*, b.nama from tbkaryawanpot a join biodata_karyawan b on a.id_karyawan = b.nip");
    }
}
