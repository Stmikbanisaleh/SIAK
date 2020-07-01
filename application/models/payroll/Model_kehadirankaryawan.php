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

    public function view_kehadirankaryawan($tahun, $blnawal, $blnakhir, $karyawan)
    {
        if($karyawan  == ''){
            return $this->db->query("select b.nip.b.nama from tbkehadiran a join biodata_karyawan b on a.pin = b.nip where YEAR(a.periode) = '" . $tahun . "' and Month(a.periode) between '".$blnawal."' and '".$blnakhir."'");
        } else {
            return $this->db->query("select b.nip.b.nama from tbkehadiran where YEAR(a.periode) = '" . $tahun . "' and Month(a.periode) between '".$blnawal."' and '".$blnakhir."' and pin ='".$karyawan."'");
        }
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
