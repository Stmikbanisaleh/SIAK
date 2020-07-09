<?php

class Model_kehadiranpengganti extends CI_model
{

    public function view_kehadiranpengganti()
    {
        return  $this->db->query('SELECT td.ID, tg.IdGuru, tg.GuruNama nama_guru, mp.nama matapelajaran, td.ASALTGL, td.GANTIHARI, mr.RUANG, tk.nama kelas
        FROM trdsrm td
        JOIN tbjadwal tj ON tj.id = td.idJadwal
        JOIN tbguru tg ON tj.id_guru = tg.IdGuru
        JOIN mspelajaran mp ON mp.id_mapel = tj.id_mapel
        JOIN msruang mr ON mr.ID = tj.id_ruang
        JOIN tbkelas tk ON tk.id_kelas = tj.nmklstrjdk
        WHERE td.STINVAL = 1');
    }

    public function view_jadwal()
    {
        return  $this->db->query('SELECT tj.id, tg.IdGuru, tg.GuruNama nama_guru, mp.nama matapelajaran, mr.RUANG, tk.nama kelas
        FROM tbjadwal tj
        JOIN tbguru tg ON tj.id_guru = tg.IdGuru
        JOIN mspelajaran mp ON mp.id_mapel = tj.id_mapel
        JOIN msruang mr ON mr.ID = tj.id_ruang
        JOIN tbkelas tk ON tk.id_kelas = tj.nmklstrjdk
        ');
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
