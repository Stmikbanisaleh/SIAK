<?php
// require("../config/config.default.php");
// $query = "SELECT
// siswa.NIS,siswa.Noreg,
// siswa.Namacasis,
// sekolah.NamaSek
// FROM
// siswa
// INNER JOIN sekolah ON siswa.kodesekolah = sekolah.KodeSek
// WHERE Noreg='$_GET[id]'";
// // $assistant = mysql_query($query);
// // $num_assistant = mysql_num_rows($assistant);
// for ($i = 0; $i < $num_assistant; $i++) {
// $row = mysql_fetch_object($assistant);
// $v_NIS = $row->NIS;
// $v_NamaSek = $row->NamaSek;
// $v_Noreg = $row->Noreg;
// $v_Namacasis = $row->Namacasis;
// // include('LPS.php');
// }

// function kekata($x)
// {
// $x = abs($x);
// $angka = array(
//   "", "satu", "dua", "tiga", "empat", "lima",
//   "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"
// );

// $temp = "";
// if ($x < 12) {
//   $temp = " " . $angka[$x];
// } else if ($x < 20) {
//   $temp = kekata($x - 10) . " belas";
// } else if ($x < 100) {
//   $temp = kekata($x / 10) . " puluh" . kekata($x % 10);
// } else if ($x < 200) {
//   $temp = " seratus" . kekata($x - 100);
// } else if ($x < 1000) {
//   $temp = kekata($x / 100) . " ratus" . kekata($x % 100);
// } else if ($x < 2000) {
//   $temp = " seribu" . kekata($x - 1000);
// } else if ($x < 1000000) {
//   $temp = kekata($x / 1000) . " ribu" . kekata($x % 1000);
// } else if ($x < 1000000000) {
//   $temp = kekata($x / 1000000) . " juta" . kekata($x % 1000000);
// } else if ($x < 1000000000000) {
//   $temp = kekata($x / 1000000000) . " milyar" . kekata(fmod($x, 1000000000));
// } else if ($x < 1000000000000000) {
//   $temp = kekata($x / 1000000000000) . " trilyun" . kekata(fmod($x, 1000000000000));
// }
// return $temp;
// }


// function terbilang($x, $style = 4)
// {
// if ($x < 0) {
//   $hasil = "minus " . trim(kekata($x));
// } else {
//   $hasil = trim(kekata($x));
// }
// switch ($style) {
//   case 1:
//     $hasil = strtoupper($hasil);
//     break;
//   case 2:
//     $hasil = strtolower($hasil);
//     break;
//   case 3:
//     $hasil = ucwords($hasil);
//     break;
//   default:
//     $hasil = ucfirst($hasil);
//     break;
// }
// return $hasil;
// }
// function format_rupiah($angka)
// {
// $rupiah = number_format($angka, 0, ',', '.');
// return $rupiah;
// }

// list($bln, $tgl, $thn) = explode('/', $_POST[AwalTglawal]);
// $a1 = $thn . '-' . $bln . '-' . $tgl;
// $b1 = $tgl . '-' . $bln . '-' . $thn;
// list($bln1, $tgl1, $thn1) = explode('/', $_POST[AwalTglakhir]);
// $a2 = $thn1 . '-' . $bln1 . '-' . $tgl1;
// $b2 = $tgl1 . '-' . $bln1 . '-' . $thn1;
?>
<table width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <th width="30%" align="left"><span style="font-family:Rockwell;font-size: 10px;">YAYASAN MUTIARA INSAN NUSANTARA<br>
        SMP - SMA - SMK MUTIARA INSAN NUSANTARA</span></th>
    <th width="40%" rowspan="3"><span style="font-family:Rockwell;font-size: 16px;"><b>REKAP PEMBAYARAN SISWA</b></th>
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
    <th width="50%" align="left" scope="col"><span style="font-family:Rockwell;font-size: 10px;">Tanggal : <?php echo $v_awal; ?> s/d <?php echo $v_akhir; ?></th>
  </tr>
  <tr>
    <th width="50%" align="left" scope="col"><span style="font-family:Rockwell;font-size: 10px;">Pembayaran Siswa</th>
  </tr>
  <tr>
    <th scope="col">&nbsp;</th>
    <th scope="col">&nbsp;</th>
    <th scope="col">&nbsp;</th>
  </tr>
</table>
<table width="100%" cellpadding="6" cellspacing="2" rules="rows">
  <tr>
    <th width="5%" align="center"><span style="font-family:Rockwell;font-size: 10px;">No.</th>
    <th width="10%" align="left"><span style="font-family:Rockwell;font-size: 10px;">No. Bukti</th>
    <th width="10%" align="left"><span style="font-family:Rockwell;font-size: 10px;">Sekolah</th>
    <th width="30%" align="left"><span style="font-family:Rockwell;font-size: 10px;">Jenis Pembayaran</th>
    <th width="10%" align="left"><span style="font-family:Rockwell;font-size: 10px;">Nominal</th>
    <th width="10%" align="left"><span style="font-family:Rockwell;font-size: 10px;">Kelas</th>
    <th width="10%" align="left"><span style="font-family:Rockwell;font-size: 10px;">Tanggal</th>
    <th width="10%" align="left"><span style="font-family:Rockwell;font-size: 10px;">Tahun Pelajaran</th>
  </tr>
  <?php
//   $sql = "SELECT
// (SELECT z.NamaSek FROM sekolah z WHERE z.KodeSek=pembayaran_sekolah.kodesekolah)AS kodesekolah,
// jenispembayaran.namajenisbayar,
// detail_bayar_sekolah.nominalbayar,
// pembayaran_sekolah.TA,
// (SELECT z.Kelas FROM jnskelas z WHERE z.IdKelas=pembayaran_sekolah.Kelas)AS Kelas,
// DATE_FORMAT(tglentri,'%d-%m-%Y')tglentri,pembayaran_sekolah.Nopembayaran
// FROM
// pembayaran_sekolah
// INNER JOIN detail_bayar_sekolah ON pembayaran_sekolah.Nopembayaran = detail_bayar_sekolah.Nopembayaran
// INNER JOIN jenispembayaran ON detail_bayar_sekolah.kodejnsbayar = jenispembayaran.Kodejnsbayar
// WHERE tglentri BETWEEN '$a1' AND '$a2'
// ORDER BY pembayaran_sekolah.Nopembayaran,detail_bayar_sekolah.kodejnsbayar,tglentri";
  // $hasil = mysql_query($sql);
  $no = 1;
  // while ($r = mysql_fetch_array($hasil)) {
  $v_uang = 0;
  foreach ($mydata as $r) {
    ?>
    <tr>
      <th align="center"><span style="font-family:Rockwell;font-size: 10px;"><?php echo $no ?></th>
      <th align="left"><span style="font-family:Rockwell;font-size: 10px;"><?php echo $r['Nopembayaran']; ?></th>
      <th align="left"><span style="font-family:Rockwell;font-size: 10px;"><?php echo $r['kodesekolah']; ?></th>
      <th align="left"><span style="font-family:Rockwell;font-size: 10px;"><?php echo $r['namajenisbayar']; ?></th>
      <th align="left"><span style="font-family:Rockwell;font-size: 10px;">Rp. <?php echo number_format($r['nominalbayar']); ?></th>
      <th align="left"><span style="font-family:Rockwell;font-size: 10px;"><?php echo $r['Kelas']; ?></th>
      <th align="left"><span style="font-family:Rockwell;font-size: 10px;"><?php echo $r['tglentri']; ?></th>
      <th align="left"><span style="font-family:Rockwell;font-size: 10px;"><?php echo $r['TA']; ?></th>
    </tr>
  <?php
    $no++;
    $v_uang = $v_uang + $r['nominalbayar'];
  }
  ?>
  <tr>
    <th scope="col"><span style="font-family:Rockwell;font-size: 10px;">Total</th>
    <th scope="col" colspan='5'>&nbsp;</th>
    <th scope="col"><span style="font-family:Rockwell;font-size: 10px;">Rp. <?= number_format($v_uang) ?></th>
  </tr>
</table>
<br><br>
<table width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <th width="30%" align="left" scope="col"><span style="font-family:Rockwell;font-size: 10px;"></th>
    <th align="right" width="5%" scope="col"><span style="font-family:Rockwell;font-size: 10px;"></th>
    <th width="10%" scope="col"><span style="font-family:Rockwell;font-size: 10px;"></th>
  </tr>
</table>
<br><br>
<table width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <th width="5%" scope="col"></th>
    <th align="right" width="30%" scope="col"><span style="font-family:Rockwell;font-size: 10px;"></th>
    <th width="10%" scope="col"><span style="font-family:Rockwell;font-size: 10px;">Bekasi, <?php
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