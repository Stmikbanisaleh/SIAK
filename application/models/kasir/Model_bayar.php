<?php

class Model_bayar extends CI_model
{

    public function view_visi($table)
    {
        $this->db->where('jenis =', '1');
        return $this->db->get($table);
    }

    public function getsiswa($noreg){
        return $this->db->query("SELECT PS,NMSISWA FROM mssiswa WHERE NOINDUK = '".$noreg."'");
    }

    public function getsiswa2($ta,$ps){
        return $this->db->query("SELECT
        tarif_berlaku.idtarif,
        kodesekolah,
        (SELECT z.DESCRTBPS FROM tbps z WHERE z.KDTBPS =tarif_berlaku.kodesekolah)AS sekolah,
        (SELECT z.namajenisbayar FROM jenispembayaran z WHERE z.Kodejnsbayar=tarif_berlaku.Kodejnsbayar)AS namajenisbayar,
        tarif_berlaku.Kodejnsbayar,
        tarif_berlaku.ThnMasuk,
        tarif_berlaku.Nominal,
        tarif_berlaku.TA,
        tarif_berlaku.tglentri,
        tarif_berlaku.userridd,
        tarif_berlaku.`status`
        FROM tarif_berlaku 
        WHERE `status`='T' AND TA='$ta' AND kodesekolah='$ps' AND Kodejnsbayar NOT IN('SPP','GDG','KGT','FRM','SRG')");
    }

    public function view($table)
    {
        $this->db->where('isdeleted !=' ,1);
        return $this->db->get($table);
    }

    public function view_misi($table)
    {
        $this->db->where('jenis =', '2');
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
        $this->db->where('isdeleted !=', 1);
        return $this->db->get($table);
    }

    public function view_count($table, $data_id)
    {
        return $this->db->query('select IdGuru from ' . $table . ' where IdGuru = ' . $data_id . ' and isdeleted != 1')->num_rows();
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
