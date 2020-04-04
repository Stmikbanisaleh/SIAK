<?php

class Model_tarif extends CI_model
{

    public function view()
    {
        return  $this->db->query('select * from tarif where isdeleted != 1 ');
    }

    public function getdata()
    {
        return  $this->db->query("SELECT * ,CONCAT('Rp. ',FORMAT(Nominal,2)) as nominal_v from tarif_berlaku where isdeleted != 1 order by idtarif desc ");
    }

    public function getsekolah()
    {
        return  $this->db->query('SELECT
        sekolah.KodeSek,
        sekolah.NamaSek,
        jurusan.NamaJurusan
        FROM
        sekolah
        JOIN jurusan ON sekolah.Jurusan = jurusan.Kodejurusan where sekolah.isdeleted !=1 
        ORDER BY KodeSek DESC ');
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
        $this->db->where('isdeleted !=', 1);
        return $this->db->get($table);
    }

    public function view_count($table, $data_id)
    {
        $this->db->where('isdeleted !=', 1);
        $this->db->where('tarif =', $data_id);
        $hasil = $this->db->get($table);
        return $hasil->num_rows();
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
