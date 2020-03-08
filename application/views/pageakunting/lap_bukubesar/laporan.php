<?php
// echo $this->input->post('tahun'). "-" . $this->input->post('blnawal') . "-01";
// echo $this->input->post('tahun'). "-" . $this->input->post('blnakhir') . "-02";
// echo $this->input->post('coa');
// $mynilatransbuk = $this->model_laporan->view_nilatransbukbes($this->input->post('tahun'). "-" . $this->input->post('blnawal') . "-01", $this->input->post('tahun'). "-" . $this->input->post('blnakhir') . "-01", $this->input->post('coa'))->result_array();
// print_r(json_encode($mynilatransbuk));
// exit;
?>
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <th width="30%" align="left"><span style="font-family:Rockwell;font-size: 10px;">YAYASAN MUTIARA INSAN NUSANTARA<br>
              SMP - SMA - SMK MUTIARA INSAN NUSANTARA</span></th>
          <th width="40%" rowspan="3"><span style="font-family:Rockwell;font-size: 16px;"><b>BUKU BESAR</b></th>
          <th width="30%"></th>
        </tr>
        <tr>
          <th align="left"><span style="font-family:Rockwell;font-size: 10px;">Jl. Rajawali Pulo No. 2, Kampung Nagreg, RT.04/02, Desa Rajeg Mulya
              Kecamatan Rajeg, Kabupaten Tangerang 15540</th>
          <th align="left"><span style="font-family:Rockwell;font-size: 10px;"></th>
        </tr>
        <tr>
          <th align="left"><span style="font-family:Rockwell;font-size: 10px;">Telp. (021) 59391134</th>
          <th align="left"><span style="font-family:Rockwell;font-size: 10px;"></th>
        </tr>
      </table>
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <th scope="col">&nbsp;</th>
          <th scope="col">&nbsp;</th>
          <th scope="col">&nbsp;</th>
        </tr>
        <tr>
          <th scope="col">&nbsp;</th>
          <th scope="col">&nbsp;</th>
          <th scope="col">&nbsp;</th>
        </tr>
      </table>
      <table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <th width="50%" align="left" scope="col"><span style="font-family:Rockwell;font-size: 10px;">Untuk Bulan : <?php echo $v_awal; ?> s/d <?php echo $v_akhir; ?> <?php echo $tahun; ?></th>
        </tr>
        <tr>
          <th width="50%" align="left" scope="col"><span style="font-family:Rockwell;font-size: 10px;">Kode Rekening : <?php echo $v_kode_jurnal; ?>-<?php echo $v_nama_jurnal; ?></th>
        </tr>
        <tr>
          <th scope="col">&nbsp;</th>
          <th scope="col">&nbsp;</th>
          <th scope="col">&nbsp;</th>
        </tr>
      </table>
      <table width="100%" cellpadding="6" cellspacing="2" rules="rows">
        <tr>
          <th align="left"><span style="font-family:Rockwell;font-size: 10px;">Tgl</th>
          <th align="left"><span style="font-family:Rockwell;font-size: 10px;">Nomor Bukti</th>
          <th align="left"><span style="font-family:Rockwell;font-size: 10px;">Uraian</th>
          <th align="center"><span style="font-family:Rockwell;font-size: 10px;">Nilai</th>
          <th align="center"><span style="font-family:Rockwell;font-size: 10px;">Debet</th>
          <th align="center"><span style="font-family:Rockwell;font-size: 10px;">Kredit</th>
          <th align="center"><span style="font-family:Rockwell;font-size: 10px;">Saldo</th>
        </tr>
        <tr>
          <th align="left"><span style="font-family:Rockwell;font-size: 10px;"></th>
          <th align="left"><span style="font-family:Rockwell;font-size: 10px;"></th>
          <th align="left"><span style="font-family:Rockwell;font-size: 10px;">Saldo Awal</th>
          <th align="right"><span style="font-family:Rockwell;font-size: 10px;">Rp. 0</th>
          <th align="right"><span style="font-family:Rockwell;font-size: 10px;">Rp. 0</th>
          <th align="right"><span style="font-family:Rockwell;font-size: 10px;">Rp. 0</th>
          <th align="right"><span style="font-family:Rockwell;font-size: 10px;">Rp. <?= number_format($v_nml) ?></th>
        </tr>
        <?php
//         $sql = "SELECT
// transaksi_buk.No_bukti,
// DATE_FORMAT(Tgl_bukti,'%d-%m-%Y') AS tgl1,
// transaksi_buk.Tgl_bukti,
// transaksi_buk.no_rek,
// transaksi_buk.Ket,
// transaksi_buk.DK,
// transaksi_buk.Nilai,
// jurnal.nama_jurnal,
// transaksi_buk.id
// FROM
// transaksi_buk
// INNER JOIN jurnal ON transaksi_buk.no_rek = jurnal.kode_jurnal
// WHERE Tgl_bukti >='" . $_POST[tahun] . "-" . $_POST[awal] . "-01' AND Tgl_bukti <='" . $_POST[tahun] . "-" . $_POST[akhir] . "-31' AND jurnal.kode_jurnal='".$_POST[jurnal]."'
// ORDER BY Tgl_bukti,no_rek";
        // $hasil = mysql_query($sql);
        $mynilatransbuk = $this->model_laporan->view_nilatransbukbes($this->input->post('tahun'). "-" . $this->input->post('blnawal') . "-01", $this->input->post('tahun'). "-" . $this->input->post('blnakhir') . "-01", $this->input->post('coa'))->result_array();
        // print_r($mynilatransbuk);exit;
        $no = 1;
        // print_r($mynilatransbuk);exit;
        $totnilai = 0;
        $totkredit = 0;
        $totdebet = 0;
        foreach ($mynilatransbuk as $r) {
          // echo "asd";
        $data_transbuk = $this->model_laporan->get_transbuk($r['id'])->result_array();
        // print_r(json_encode($data_transbuk[0]['DK']));exit;
        // print_r($data_transbuk);exit;
//           $query = "SELECT 
// id,
// DK,
// Nilai FROM transaksi_buk where id='$r[id]'";
          // $assistant = mysql_query($query);
          // $num_assistant = mysql_num_rows($assistant);
        // foreach ($data_transbuk as $r1) {
        //   $v_dk = $r1['DK'];
        //     $v_nilai = $r1['Nilai'];
        // }
          // for ($i = 0; $i < $num_assistant; $i++) {
          //   $row = mysql_fetch_object($assistant);
          //   $v_dk = $row->DK;
          //   $v_nilai = $row->Nilai;
          // }
        // print_r(json_encode($data_transbuk));exit;
            $v_dk = $data_transbuk[0]['DK'];
            $v_nilai = $data_transbuk[0]['Nilai'];
            $v_uang = 0;
		if($r['DK']=='D'){
          if ($no == 1) {
            $v_uang = $v_uang + $r['Nilai'] + $v_nml;
          } else {
            $v_uang = $v_uang + $r['Nilai'];
          }
		}else{
            $v_uang = $v_uang - $r['Nilai'];	
		}
          ?>
          <tr>
            <th align="left"><span style="font-family:Rockwell;font-size: 10px;"><?php echo $r['tgl1']; ?></th>
            <th align="left"><span style="font-family:Rockwell;font-size: 10px;"><?php echo $r['No_bukti']; ?></th>
            <th align="left"><span style="font-family:Rockwell;font-size: 10px;"><?php echo $r['Ket']; ?></th>
            <th align="right"><span style="font-family:Rockwell;font-size: 10px;">Rp. <?php echo number_format($r['Nilai']); ?></th>
            <th align="right"><span style="font-family:Rockwell;font-size: 10px;">Rp. <?php if ($r['DK'] == "D") {
																							$vmn=$v_nilai;
																							$totdebet +=$vmn;
                                                                                          echo number_format($v_nilai);
                                                                                        } else {
                                                                                          echo 0;
                                                                                        }; ?></th>
            <th align="right"><span style="font-family:Rockwell;font-size: 10px;">Rp. <?php if ($r['DK'] == "K") {
																							$vmn=$v_nilai;
																							 $totkredit +=$vmn;
                                                                                          echo number_format($v_nilai);
                                                                                        } else {
                                                                                          echo 0;
                                                                                        }; ?></th>
            <th align="right"><span style="font-family:Rockwell;font-size: 10px;">Rp. <?php echo number_format($v_uang); ?></th>
          </tr>
        <?php
          $no++;
          $totnilai += $r['Nilai'];
        }
        ?>
        <tr>
          <th colspan="3"><span style="font-family:Rockwell;font-size: 10px;">Total</th>
          <th align="right"><span style="font-family:Rockwell;font-size: 10px;">Rp. <?= number_format($totnilai); ?></th>
          <th align="right"><span style="font-family:Rockwell;font-size: 10px;">Rp. <?= number_format($totdebet); ?></th>
          <th align="right"><span style="font-family:Rockwell;font-size: 10px;">Rp. <?= number_format($totkredit); ?></th>
          <th align="right"><span style="font-family:Rockwell;font-size: 10px;"></th>
        </tr>
      </table>

      <br><br>
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <th width="5%" scope="col"></th>
          <th align="right" width="30%" scope="col"><span style="font-family:Rockwell;font-size: 10px;"></th>
          <th width="10%" scope="col"><span style="font-family:Rockwell;font-size: 10px;">Bekasi, <?php $tgl = date('d/m/Y');
                                                                                                  echo $tgl; ?></th>
        </tr>
      </table>
      <br><br>
      <br>
      <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <th width="5%" scope="col"></th>
          <th align="right" width="30%" scope="col"><span style="font-family:Rockwell;font-size: 12px;"></th>
          <th width="10%" scope="col"><span style="font-family:Rockwell;font-size: 12px;">Kasir</th>
        </tr>
      </table>