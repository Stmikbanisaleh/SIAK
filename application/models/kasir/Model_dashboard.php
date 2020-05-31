<?php

class Model_dashboard extends CI_model
{

    public function view($table)
    {
        $this->db->where('isdeleted !=', '1');
        return $this->db->get($table);
    }

    public function view_visi($table)
    {
        $this->db->where('jenis =', '1');
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

    public function th_akdmk(){
        return $this->db->query("select distinct TAHUN, THNAKAD FROM tbakadmk");
    }

    public function max_th_akdmk(){
        return $this->db->query("select max(tahun) tahun FROM tbakadmk");
    }

    public function view_graph($tahun1, $tahun2)
    {
        return $this->db->query("SELECT
                                    bm.bulan_nama,
                                    (SELECT
                                        SUM(ds.nominalbayar)
                                    FROM
                                        pembayaran_sekolah ps,
                                        detail_bayar_sekolah ds
                                    WHERE 1=1
                                        AND ps.Nopembayaran = ds.Nopembayaran
                                        AND year(ps.tglentri)  = '$tahun1'
                                        AND month(ps.tglentri) = bm.bulan_nomor
                                        AND ds.kodejnsbayar = 'SPP') spp,
                                    (SELECT
                                        SUM(ds.nominalbayar)
                                    FROM
                                        pembayaran_sekolah ps,
                                        detail_bayar_sekolah ds
                                    WHERE 1=1
                                        AND ps.Nopembayaran = ds.Nopembayaran
                                        AND year(ps.tglentri)  = '$tahun1'
                                        AND month(ps.tglentri) = bm.bulan_nomor
                                        AND ds.kodejnsbayar = 'GDG') gdg,
                                    (SELECT
                                        SUM(ds.nominalbayar)
                                    FROM
                                        pembayaran_sekolah ps,
                                        detail_bayar_sekolah ds
                                    WHERE 1=1
                                        AND ps.Nopembayaran = ds.Nopembayaran
                                        AND year(ps.tglentri)  = '$tahun1'
                                        AND month(ps.tglentri) = bm.bulan_nomor
                                        AND ds.kodejnsbayar = 'SRG') srg,
                                    (SELECT
                                        SUM(ds.nominalbayar)
                                    FROM
                                        pembayaran_sekolah ps,
                                        detail_bayar_sekolah ds
                                    WHERE 1=1
                                        AND ps.Nopembayaran = ds.Nopembayaran
                                        AND year(ps.tglentri)  = '$tahun1'
                                        AND month(ps.tglentri) = bm.bulan_nomor
                                        AND ds.kodejnsbayar = 'KGT') kgt,
                                (SELECT
                                        SUM(ds.nominalbayar)
                                    FROM
                                        pembayaran_sekolah ps,
                                        detail_bayar_sekolah ds
                                    WHERE 1=1
                                        AND ps.Nopembayaran = ds.Nopembayaran
                                        AND year(ps.tglentri)  = '$tahun1'
                                        AND month(ps.tglentri) = bm.bulan_nomor
                                        AND ds.kodejnsbayar NOT IN ('SPP','SRG','GDG','KGT')) lain
                                FROM
                                    bulan_mapping bm
                                WHERE bm.bulan_nomor > 5
                                UNION
                                SELECT
                                    bm1.bulan_nama,
                                    (SELECT
                                        SUM(ds.nominalbayar)
                                    FROM
                                        pembayaran_sekolah ps,
                                        detail_bayar_sekolah ds
                                    WHERE 1=1
                                        AND ps.Nopembayaran = ds.Nopembayaran
                                        AND year(ps.tglentri)  = '$tahun2'
                                        AND month(ps.tglentri) = bm1.bulan_nomor
                                        AND ds.kodejnsbayar = 'SPP') spp,
                                    (SELECT
                                        SUM(ds.nominalbayar)
                                    FROM
                                        pembayaran_sekolah ps,
                                        detail_bayar_sekolah ds
                                    WHERE 1=1
                                        AND ps.Nopembayaran = ds.Nopembayaran
                                        AND year(ps.tglentri)  = '$tahun2'
                                        AND month(ps.tglentri) = bm1.bulan_nomor
                                        AND ds.kodejnsbayar = 'GDG') gdg,
                                    (SELECT
                                        SUM(ds.nominalbayar)
                                    FROM
                                        pembayaran_sekolah ps,
                                        detail_bayar_sekolah ds
                                    WHERE 1=1
                                        AND ps.Nopembayaran = ds.Nopembayaran
                                        AND year(ps.tglentri)  = '$tahun2'
                                        AND month(ps.tglentri) = bm1.bulan_nomor
                                        AND ds.kodejnsbayar = 'SRG') srg,
                                    (SELECT
                                        SUM(ds.nominalbayar)
                                    FROM
                                        pembayaran_sekolah ps,
                                        detail_bayar_sekolah ds
                                    WHERE 1=1
                                        AND ps.Nopembayaran = ds.Nopembayaran
                                        AND year(ps.tglentri)  = '$tahun2'
                                        AND month(ps.tglentri) = bm1.bulan_nomor
                                        AND ds.kodejnsbayar = 'KGT') kgt,
                                (SELECT
                                        SUM(ds.nominalbayar)
                                    FROM
                                        pembayaran_sekolah ps,
                                        detail_bayar_sekolah ds
                                    WHERE 1=1
                                        AND ps.Nopembayaran = ds.Nopembayaran
                                        AND year(ps.tglentri)  = '$tahun2'
                                        AND month(ps.tglentri) = bm1.bulan_nomor
                                        AND ds.kodejnsbayar NOT IN ('SPP','SRG','GDG','KGT')) lain
                                FROM
                                    bulan_mapping bm1
                                WHERE bm1.bulan_nomor < 6");
    }
}
