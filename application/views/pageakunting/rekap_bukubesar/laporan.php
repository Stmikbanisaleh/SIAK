<?php
// require("../config/config.default.php");
// $query = "SELECT
// jurnal.kode_jurnal,
// jurnal.nama_jurnal
// FROM
// parameter
// INNER JOIN jurnal ON parameter.no_jurnal = jurnal.no_jurnal";
// $assistant = mysql_query($query);
// $num_assistant = mysql_num_rows($assistant);
// for ($i = 0; $i < $num_assistant; $i++) {
//     $row = mysql_fetch_object($assistant);
//     $v_kode_jurnal = $row->kode_jurnal;
//     $v_nama_jurnal = $row->nama_jurnal;
// }
// function kekata($x)
// {
//     $x = abs($x);
//     $angka = array(
//         "", "satu", "dua", "tiga", "empat", "lima",
//         "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"
//     );
//     $temp = "";
//     if ($x < 12) {
//         $temp = " " . $angka[$x];
//     } else if ($x < 20) {
//         $temp = kekata($x - 10) . " belas";
//     } else if ($x < 100) {
//         $temp = kekata($x / 10) . " puluh" . kekata($x % 10);
//     } else if ($x < 200) {
//         $temp = " seratus" . kekata($x - 100);
//     } else if ($x < 1000) {
//         $temp = kekata($x / 100) . " ratus" . kekata($x % 100);
//     } else if ($x < 2000) {
//         $temp = " seribu" . kekata($x - 1000);
//     } else if ($x < 1000000) {
//         $temp = kekata($x / 1000) . " ribu" . kekata($x % 1000);
//     } else if ($x < 1000000000) {
//         $temp = kekata($x / 1000000) . " juta" . kekata($x % 1000000);
//     } else if ($x < 1000000000000) {
//         $temp = kekata($x / 1000000000) . " milyar" . kekata(fmod($x, 1000000000));
//     } else if ($x < 1000000000000000) {
//         $temp = kekata($x / 1000000000000) . " trilyun" . kekata(fmod($x, 1000000000000));
//     }
//     return $temp;
// }


// function terbilang($x, $style = 4)
// {
//     if ($x < 0) {
//         $hasil = "minus " . trim(kekata($x));
//     } else {
//         $hasil = trim(kekata($x));
//     }
//     switch ($style) {
//         case 1:
//             $hasil = strtoupper($hasil);
//             break;
//         case 2:
//             $hasil = strtolower($hasil);
//             break;
//         case 3:
//             $hasil = ucwords($hasil);
//             break;
//         default:
//             $hasil = ucfirst($hasil);
//             break;
//     }
//     return $hasil;
// }
// function format_rupiah($angka)
// {
//     $rupiah = number_format($angka, 0, ',', '.');
//     return $rupiah;
// }
// $awal = $bln_awal;
// switch ($awal) {
//     case 1:
//         $bln_awal = "Januari";
//         break;
//     case 2:
//         $bln_awal = "Februari";
//         break;
//     case 3:
//         $bln_awal = "Maret";
//         break;
//     case 4:
//         $bln_awal = "April";
//         break;
//     case 5:
//         $bln_awal = "Mei";
//         break;
//     case 6:
//         $bln_awal = "Juni";
//         break;
//     case 7:
//         $bln_awal = "Juli";
//         break;
//     case 8:
//         $bln_awal = "Agustus";
//         break;
//     case 9:
//         $bln_awal = "September";
//         break;
//     case 10:
//         $bln_awal = "Oktober";
//         break;
//     case 11:
//         $bln_awal = "November";
//         break;
//     case 12:
//         $bln_awal = "Desember";
//         break;
// }
// $akhir = $bln_akhir;
// switch ($akhir) {
//     case 1:
//         $bln_akhir = "Januari";
//         break;
//     case 2:
//         $bln_akhir = "Februari";
//         break;
//     case 3:
//         $bln_akhir = "Maret";
//         break;
//     case 4:
//         $bln_akhir = "April";
//         break;
//     case 5:
//         $bln_akhir = "Mei";
//         break;
//     case 6:
//         $bln_akhir = "Juni";
//         break;
//     case 7:
//         $bln_akhir = "Juli";
//         break;
//     case 8:
//         $bln_akhir = "Agustus";
//         break;
//     case 9:
//         $bln_akhir = "September";
//         break;
//     case 10:
//         $bln_akhir = "Oktober";
//         break;
//     case 11:
//         $bln_akhir = "November";
//         break;
//     case 12:
//         $bln_akhir = "Desember";
//         break;
// }
// $query = "SELECT
// SUM(Nilai)AS nml
// FROM
// transaksi_buk
// INNER JOIN jurnal ON transaksi_buk.no_rek = jurnal.kode_jurnal
// WHERE Tgl_bukti <'" . $tahun . "-" . $bln_awal . "-01'";
// $assistant = mysql_query($query);
// $num_assistant = mysql_num_rows($assistant);
// for ($i = 0; $i < $num_assistant; $i++) {
//     $row = mysql_fetch_object($assistant);
//     $v_nml = $row->nml;
// }
?>
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <th width="30%" align="left"><span style="font-family:Rockwell;font-size: 10px;">YAYASAN MUTIARA INSAN NUSANTARA<br>
                            SMP - SMA - SMK MUTIARA INSAN NUSANTARA</span></th>
                    <th width="40%" rowspan="3"><span style="font-family:Rockwell;font-size: 16px;"><b>REKAPITULASI BUKU BESAR</b></th>
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
                    <th width="50%" align="left" scope="col"><span style="font-family:Rockwell;font-size: 10px;">Untuk Bulan : <?php echo $bln_awal; ?> s/d <?php echo $bln_akhir; ?> <?php echo $tahun; ?></th>
                </tr>

                <tr>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                </tr>
            </table>
            <table width="100%" cellpadding="6" cellspacing="2" rules="rows">
                <tr>
                    <th align="left"><span style="font-family:Rockwell;font-size: 10px;"></th>
                    <th align="left"><span style="font-family:Rockwell;font-size: 10px;"></th>
                    <th align="left"><span style="font-family:Rockwell;font-size: 10px;"></th>
                    <th colspan="2" align="center"><span style="font-family:Rockwell;font-size: 10px;">Saldo Awal</th>
                    <th colspan="2" align="center"><span style="font-family:Rockwell;font-size: 10px;">Mutasi</th>
                    <th colspan="2" align="center"><span style="font-family:Rockwell;font-size: 10px;">Rugi Laba</th>
                    <th colspan="2" align="center"><span style="font-family:Rockwell;font-size: 10px;">Neraca</th>
                </tr>
                <tr>
                    <th align="left"><span style="font-family:Rockwell;font-size: 10px;">No</th>
                    <th align="left"><span style="font-family:Rockwell;font-size: 10px;">Kode Rekening</th>
                    <th align="left"><span style="font-family:Rockwell;font-size: 10px;">Nama Rekening</th>
                    <th align="right"><span style="font-family:Rockwell;font-size: 10px;">Debet</th>
                    <th align="right"><span style="font-family:Rockwell;font-size: 10px;">Kredit</th>
                    <th align="right"><span style="font-family:Rockwell;font-size: 10px;">Debet</th>
                    <th align="right"><span style="font-family:Rockwell;font-size: 10px;">Kredit</th>
                    <th align="right"><span style="font-family:Rockwell;font-size: 10px;">Debet</th>
                    <th align="right"><span style="font-family:Rockwell;font-size: 10px;">Kredit</th>
                    <th align="right"><span style="font-family:Rockwell;font-size: 10px;">Debet</th>
                    <th align="right"><span style="font-family:Rockwell;font-size: 10px;">Kredit</th>
                </tr>
                <?php
    //             $sql = "SELECT
    //             transaksi_buk.No_bukti,
    //             DATE_FORMAT(Tgl_bukti,'%d-%m-%Y') AS tgl1,
    //             transaksi_buk.Tgl_bukti,
    //             transaksi_buk.no_rek,
    //             transaksi_buk.Ket,
    //             transaksi_buk.DK,
    //             sum(transaksi_buk.Nilai)as Nilai,
    //             jurnal.nama_jurnal,
    //             transaksi_buk.id,
				// jurnal.JR
    //             FROM
    //             transaksi_buk
    //             INNER JOIN jurnal ON transaksi_buk.no_rek = jurnal.kode_jurnal
    //             GROUP BY no_rek
    //             ORDER BY no_rek";
    //             $hasil = mysql_query($sql);
                $no = 1;
    //             while ($r = mysql_fetch_array($hasil)) {
                $v_uang = 0;
                $totsad = 0;
                $totsak = 0;
                $totmtd = 0;
                $totmtk = 0;
                $totrld = 0;
                $totrlk = 0;
                $totnrd = 0;
                $totnrk = 0;
                $vrld = 0;
                $vrlk = 0;
                $nrds = 0;
                $tode = 0;
                $tokre = 0;
                foreach ($myrekening as $r) {
//                     $query = "SELECT 
// id,
// DK,
// Nilai FROM transaksi_buk where id='$r[id]'";
//                     $assistant = mysql_query($query);
//                     $num_assistant = mysql_num_rows($assistant);
                    $data_transbuk = $this->model_laporan->get_transbuk($r['id'])->result_array();
                    $v_dk = $data_transbuk[0]['DK'];
                    $v_nilai = $data_transbuk[0]['Nilai'];
                    // for ($i = 0; $i < $num_assistant; $i++) {
                    //     $row = mysql_fetch_object($assistant);
                    //     $v_dk = $row->DK;
                    //     $v_nilai = $row->Nilai;
                    // }

                    if ($no == 1) {
                        $v_uang = $v_uang + $r['Nilai'] + $v_nml;
                    } else {
                        $v_uang = $v_uang + $r['Nilai'];
                    }
                    ?>
                    <!--Mendapatkan total Saldo awal debet-->
                    <?php
					if($r['JR']==1){
                        $qu = "SELECT sum(Nilai) as saldebet,Tgl_bukti FROM transaksi_buk WHERE Tgl_bukti <'" . $tahun . "-" . $bln_awal . "-01' AND  no_rek='".$r['no_rek']."' AND DK='D'  ";
                        // $has = mysql_query($qu);
                        // $sad = mysql_fetch_assoc($has);		
                        $sad = $this->model_laporan->view_byquery($qu)->row();
					}elseif($r['JR']==2){
                        $qu = "SELECT sum(Nilai) as saldebet,Tgl_bukti FROM transaksi_buk WHERE Tgl_bukti <'" . $tahun . "-" . $bln_awal . "-01' AND  no_rek='".$r['no_rek']."' AND DK='D'  ";
                        // $has = mysql_query($qu);
                        // $sad = mysql_fetch_assoc($has);			
                        $sad = $this->model_laporan->view_byquery($qu)->row();
					}else{
						if($bln_awal==1){
                        $qu = "SELECT sum(Nilai-Nilai) as saldebet,Tgl_bukti FROM transaksi_buk WHERE Tgl_bukti <'" . $tahun . "-" . $bln_awal . "-01' AND  no_rek='".$r['no_rek']."' AND DK='D'  ";
                        // $has = mysql_query($qu);
                        // $sad = mysql_fetch_assoc($has);		
                        $sad = $this->model_laporan->view_byquery($qu)->row();				
						}else{
                        $qu = "SELECT sum(Nilai) as saldebet,Tgl_bukti FROM transaksi_buk WHERE Tgl_bukti <'" . $tahun . "-" . $bln_awal . "-01' AND  no_rek='".$r['no_rek']."' AND DK='D'  ";
                        // $has = mysql_query($qu);
                        // $sad = mysql_fetch_assoc($has);
                        $sad = $this->model_laporan->view_byquery($qu)->row();
						}
					}
                    // print_r(json_encode($sad));exit;
                        ?>

                    <!--Mendapatkan total Saldo awal kredit-->
                    <?php
						if($bln_awal==1){
                        $qu = "SELECT sum(Nilai-Nilai) as salkredit,Tgl_bukti FROM transaksi_buk WHERE Tgl_bukti <'" . $tahun . "-" . $bln_awal . "-01' AND  no_rek='".$r['no_rek']."' AND DK='K'  ";
                        // $has = mysql_query($qu);
                        // $sak = mysql_fetch_assoc($has);
                        $sak = $this->model_laporan->view_byquery($qu)->row();
						}else{
                        $qu = "SELECT sum(Nilai) as salkredit,Tgl_bukti FROM transaksi_buk WHERE Tgl_bukti <'" . $tahun . "-" . $bln_awal . "-01' AND  no_rek='".$r['no_rek']."' AND DK='K'  ";
                        // $has = mysql_query($qu);
                        // $sak = mysql_fetch_assoc($has);
                        $sak = $this->model_laporan->view_byquery($qu)->row();
						}

                        ?>

                    <!--Mendapatkan total Mutasi debet-->
                    <?php
                        $qu = "SELECT sum(Nilai) as mtdebet,Tgl_bukti FROM transaksi_buk WHERE Tgl_bukti >='" . $tahun . "-" . $bln_awal . "-01' AND Tgl_bukti <='" . $tahun . "-" . $bln_akhir . "-31' AND  no_rek='".$r['no_rek']."' AND DK='D' ";
                        // $has = mysql_query($qu);
                        // $mtd = mysql_fetch_assoc($has);
                        $mtd = $this->model_laporan->view_byquery($qu)->row();
                        // print_r(json_encode($mtd));exit;
                        ?>



                    <!--Mendapatkan total Mutasi kredit-->
                    <?php
                        $qu = "SELECT sum(Nilai) as mtkredit,Tgl_bukti FROM transaksi_buk WHERE Tgl_bukti >='" . $tahun . "-" . $bln_awal . "-01' AND Tgl_bukti <='" . $tahun . "-" . $bln_akhir . "-31' AND  no_rek='".$r['no_rek']."' AND DK='K'  ";
                        // $has = mysql_query($qu);
                        // $mtk = mysql_fetch_assoc($has);
                        $mtk = $this->model_laporan->view_byquery($qu)->row();
                        // print_r(json_encode($qu));exit;
                        ?>

                    <!--Mendapatkan total Rugi Laba debet-->
                    <?php
					
					if($r['JR']==1){
                        $qu = "SELECT sum(Nilai) as saldebet,Tgl_bukti FROM transaksi_buk JOIN jurnal  ON jurnal.kode_jurnal = transaksi_buk.no_rek WHERE Tgl_bukti <'" . $tahun . "-" . $bln_awal . "-01' AND  no_rek='".$r['no_rek']."' AND DK='D'  AND jurnal.JR NOT IN(1) ";
                        // $has = mysql_query($qu);
                        // $sads = mysql_fetch_assoc($has);
                        $sads = $this->model_laporan->view_byquery($qu)->row();

					}elseif($r['JR']==2){
                        $qu = "SELECT sum(Nilai) as saldebet,Tgl_bukti FROM transaksi_buk JOIN jurnal  ON jurnal.kode_jurnal = transaksi_buk.no_rek WHERE Tgl_bukti <'" . $tahun . "-" . $bln_awal . "-01' AND  no_rek='".$r['no_rek']."' AND DK='D'  AND jurnal.JR NOT IN(1) ";
                        // $has = mysql_query($qu);
                        // $sads = mysql_fetch_assoc($has);		
                        $sads = $this->model_laporan->view_byquery($qu)->row();

					}else{
						if($bln_awal==1){
                        $qu = "SELECT sum(Nilai-Nilai) as saldebet,Tgl_bukti FROM transaksi_buk JOIN jurnal  ON jurnal.kode_jurnal = transaksi_buk.no_rek WHERE Tgl_bukti <'" . $tahun . "-" . $bln_awal . "-01' AND  no_rek='".$r['no_rek']."' AND DK='D'  AND jurnal.JR NOT IN(1) ";
                        // $has = mysql_query($qu);
                        // $sads = mysql_fetch_assoc($has);
                        $sads = $this->model_laporan->view_byquery($qu)->row();

						}else{
                        $qu = "SELECT sum(Nilai) as saldebet,Tgl_bukti FROM transaksi_buk JOIN jurnal  ON jurnal.kode_jurnal = transaksi_buk.no_rek WHERE Tgl_bukti <'" . $tahun . "-" . $bln_awal . "-01' AND  no_rek='".$r['no_rek']."' AND DK='D'  AND jurnal.JR NOT IN(1) ";
                        // $has = mysql_query($qu);
                        // $sads = mysql_fetch_assoc($has);
                        $sads = $this->model_laporan->view_byquery($qu)->row();

						}
					}
					
                        $qu = "SELECT sum(Nilai) as mtdebet,Tgl_bukti FROM transaksi_buk JOIN jurnal  ON jurnal.kode_jurnal = transaksi_buk.no_rek WHERE Tgl_bukti >='" . $tahun . "-" . $bln_awal . "-01' AND Tgl_bukti <='" . $tahun . "-" . $bln_akhir . "-31' AND  no_rek='".$r['no_rek']."' AND DK='D'  AND jurnal.JR NOT IN(1) ";
                        // $has = mysql_query($qu);
                        // $mtds = mysql_fetch_assoc($has);
                        $mtds = $this->model_laporan->view_byquery($qu)->row();
                        ?>

                    <!--Mendapatkan total Rugi Laba kredit-->
                    <?php
					
					
						if($bln_awal==1){
                        $qu = "SELECT sum(Nilai-Nilai) as salkredit,Tgl_bukti FROM transaksi_buk WHERE Tgl_bukti <'" . $tahun . "-" . $bln_awal . "-01' AND  no_rek='".$r['no_rek']."' AND DK='K'  ";
                        // $has = mysql_query($qu);
                        // $saks = mysql_fetch_assoc($has);
                        $saks = $this->model_laporan->view_byquery($qu)->row();

						}else{
                        $qu = "SELECT sum(Nilai) as salkredit,Tgl_bukti FROM transaksi_buk WHERE Tgl_bukti <'" . $tahun . "-" . $bln_awal . "-01' AND  no_rek='".$r['no_rek']."' AND DK='K'  ";
                        // $has = mysql_query($qu);
                        // $saks = mysql_fetch_assoc($has);
                        $saks = $this->model_laporan->view_byquery($qu)->row();

						}
						
                        $qu = "SELECT sum(Nilai) as mtkredit,Tgl_bukti FROM transaksi_buk WHERE Tgl_bukti >='" . $tahun . "-" . $bln_awal . "-01' AND Tgl_bukti <='" . $tahun . "-" . $bln_akhir . "-31' AND  no_rek='".$r['no_rek']."' AND DK='K'  ";
                        // $has = mysql_query($qu);
                        // $mtks = mysql_fetch_assoc($has);
                        $mtks = $this->model_laporan->view_byquery($qu)->row();

                        ?>

                    <!--Mendapatkan total Neraca Debet-->
                    <?php
						if($bln_awal==1){
                        $qu = "SELECT sum(tb.Nilai-tb.Nilai) as nerdebet,tb.Tgl_bukti,j.JR FROM transaksi_buk tb JOIN jurnal j ON j.kode_jurnal = tb.no_rek WHERE tb.Tgl_bukti <='" . $tahun . "-" . $bln_akhir . "-31' AND  tb.no_rek='".$r['no_rek']."' AND tb.DK='D' AND j.JR NOT IN(3,4)";
                        // $has = mysql_query($qu);
                        // $nrd = mysql_fetch_assoc($has);
                        $nrd = $this->model_laporan->view_byquery($qu)->row();

						}else{
                        $qu = "SELECT sum(tb.Nilai) as nerdebet,tb.Tgl_bukti,j.JR FROM transaksi_buk tb JOIN jurnal j ON j.kode_jurnal = tb.no_rek WHERE tb.Tgl_bukti <='" . $tahun . "-" . $bln_akhir . "-31' AND  tb.no_rek='".$r['no_rek']."' AND tb.DK='D' AND j.JR NOT IN(3,4)";
                        // $has = mysql_query($qu);
                        // $nrd = mysql_fetch_assoc($has);
                        $nrd = $this->model_laporan->view_byquery($qu)->row();

						}
						
                        ?>

                    <!--Mendapatkan total Neraca Kredit-->
                    <?php
						if($bln_awal==1){
                        $qu = "SELECT sum(tb.Nilai-tb.Nilai) as nerkredit,tb.Tgl_bukti,j.JR FROM transaksi_buk tb JOIN jurnal j ON j.kode_jurnal = tb.no_rek WHERE tb.Tgl_bukti <='" . $tahun . "-" . $bln_akhir . "-31' AND  tb.no_rek='".$r['no_rek']."' AND tb.DK='K' AND j.JR NOT IN(3,4)";
                        // $has = mysql_query($qu);
                        // $nrk = mysql_fetch_assoc($has);
                        $nrk = $this->model_laporan->view_byquery($qu)->row();

						}else{
                        $qu = "SELECT sum(tb.Nilai) as nerkredit,tb.Tgl_bukti,j.JR FROM transaksi_buk tb JOIN jurnal j ON j.kode_jurnal = tb.no_rek WHERE tb.Tgl_bukti <='" . $tahun . "-" . $bln_akhir . "-31' AND  tb.no_rek='".$r['no_rek']."' AND tb.DK='K' AND j.JR NOT IN(3,4)";
                        // $has = mysql_query($qu);
                        // $nrk = mysql_fetch_assoc($has);	
                        $nrk = $this->model_laporan->view_byquery($qu)->row();

						}
						
						if($bln_awal==1){
                        $qu = "SELECT sum(tb.Nilai-tb.Nilai) as nerkredit,tb.Tgl_bukti,j.JR FROM transaksi_buk tb JOIN jurnal j ON j.kode_jurnal = tb.no_rek WHERE tb.Tgl_bukti <='" . $tahun . "-" . $bln_akhir . "-31' AND  tb.no_rek='".$r['no_rek']."' AND tb.DK='K' AND j.JR NOT IN(1,3,4)";
                        // $has = mysql_query($qu);
                        // $nrks = mysql_fetch_assoc($has);
                        $nrks = $this->model_laporan->view_byquery($qu)->row();

						}else{
                        $qu = "SELECT sum(tb.Nilai) as nerkredit,tb.Tgl_bukti,j.JR FROM transaksi_buk tb JOIN jurnal j ON j.kode_jurnal = tb.no_rek WHERE tb.Tgl_bukti <='" . $tahun . "-" . $bln_akhir . "-31' AND  tb.no_rek='".$r['no_rek']."' AND tb.DK='K' AND j.JR NOT IN(1,3,4)";
                        // $has = mysql_query($qu);
                        // $nrks = mysql_fetch_assoc($has);		
                        $nrks = $this->model_laporan->view_byquery($qu)->row();

						}
						// print_r($sad->saldebet);exit;
                        ?>

                    <tr>
                        <th align="left"><span style="font-family:Rockwell;font-size: 10px;"><?php echo $no; ?></th>
                        <th align="left"><span style="font-family:Rockwell;font-size: 10px;"><?php echo $r['no_rek']; ?></th>
                        <th align="left"><span style="font-family:Rockwell;font-size: 10px;"><?php echo $r['nama_jurnal']; ?></th>
                        <th align="right"><span style="font-family:Rockwell;font-size: 10px;">
                                Rp. <?php if ($sad->saldebet) {
                                            echo number_format($sad->saldebet);
                                        } else {
                                            echo 0;
                                        } ?>
                        </th>
                        <th align="right"><span style="font-family:Rockwell;font-size: 10px;">
                                Rp. <?php if ($sak->salkredit) {
                                            echo number_format($sak->salkredit);
                                        } else {
                                            echo 0;
                                        } ?>
                        </th>
                        <th align="right"><span style="font-family:Rockwell;font-size: 10px;">
                                Rp. <?php if ($mtd->mtdebet) {
                                            echo number_format($mtd->mtdebet);
                                        } else {
                                            echo 0;
                                        } ?>
                        </th>
                        <th align="right"><span style="font-family:Rockwell;font-size: 10px;">
                                Rp. <?php if ($mtk->mtkredit) {
                                            echo number_format($mtk->mtkredit);
                                        } else {
                                            echo 0;
                                        } ?>
                        </th>
                        <th align="right"><span style="font-family:Rockwell;font-size: 10px;">
                                Rp. <?php 
						if($no==1){echo 0;}else{
						echo number_format($vrld=$sads->saldebet+$mtds->mtdebet);}
										?>
                        </th>
                        <th align="right"><span style="font-family:Rockwell;font-size: 10px;">
                                Rp. <?php 
						if($no==1){echo 0;}else{
						echo number_format($vrlk=$saks->salkredit+$mtks->mtkredit);}
										?>
                        </th>
                        <th align="right"><span style="font-family:Rockwell;font-size: 10px;">
                                Rp. <?php
                                            echo number_format($nrds=$nrd->nerdebet-$nrk->nerkredit);
                                         ?>
                        </th>
                        <th align="right"><span style="font-family:Rockwell;font-size: 10px;">
                                Rp. <?php if ($nrks->nerkredit) {
                                            echo number_format($nrks->nerkredit);
                                        } else {
                                            echo 0;
                                        } ?>
                        </th>
                    </tr>
                <?php
                    $no++;
          $totsad += $sad->saldebet;
          $totsak += $sak->salkredit;
          $totmtd += $mtd->mtdebet;
          $totmtk += $mtk->mtkredit;
          $totrld += $vrld;
          $totrlk += $vrlk;
          $totnrd += $nrds;
          $totnrk += $nrks->nerkredit;
		  
                    if ($r['DK'] == "D") {
                        $tode += $v_nilai;
                    } elseif ($r['DK'] == "K") {
                        $tokre += $v_nilai;
                    }
                }

                ?>
        <tr>
          <th colspan="3"><span style="font-family:Rockwell;font-size: 10px;">Total</th>
          <th align="right"><span style="font-family:Rockwell;font-size: 10px;">Rp. <?= number_format($totsad); ?></th>
          <th align="right"><span style="font-family:Rockwell;font-size: 10px;">Rp. <?= number_format($totsak); ?></th>
          <th align="right"><span style="font-family:Rockwell;font-size: 10px;">Rp. <?= number_format($totmtd); ?></th>
          <th align="right"><span style="font-family:Rockwell;font-size: 10px;">Rp. <?= number_format($totmtk); ?></th>
          <th align="right"><span style="font-family:Rockwell;font-size: 10px;">Rp. <?= number_format($totrld); ?></th>
          <th align="right"><span style="font-family:Rockwell;font-size: 10px;">Rp. <?= number_format($totrlk); ?></th>
          <th align="right"><span style="font-family:Rockwell;font-size: 10px;">Rp. <?= number_format($totnrd); ?></th>
          <th align="right"><span style="font-family:Rockwell;font-size: 10px;">Rp. <?= number_format($totnrk); ?></th>
        </tr>
        <tr>
          <th colspan="3"><span style="font-family:Rockwell;font-size: 10px;">Laba(Rugi)</th>
          <th align="right"><span style="font-family:Rockwell;font-size: 10px;"></th>
          <th align="right"><span style="font-family:Rockwell;font-size: 10px;"></th>
          <th align="right"><span style="font-family:Rockwell;font-size: 10px;"></th>
          <th align="right"><span style="font-family:Rockwell;font-size: 10px;"></th>
          <th align="right"><span style="font-family:Rockwell;font-size: 10px;">Rp. <?= number_format(abs($gdlb=$totrlk-$totrld)); ?></th>
          <th align="right"><span style="font-family:Rockwell;font-size: 10px;"></th>
          <th align="right"><span style="font-family:Rockwell;font-size: 10px;"></th>
          <th align="right"><span style="font-family:Rockwell;font-size: 10px;">Rp. <?= number_format(abs($gdnc=$totnrd-$totnrk)); ?></th>
        </tr>
        <tr>
          <th colspan="3"><span style="font-family:Rockwell;font-size: 10px;"></th>
          <th align="right"><span style="font-family:Rockwell;font-size: 10px;"></th>
          <th align="right"><span style="font-family:Rockwell;font-size: 10px;"></th>
          <th align="right"><span style="font-family:Rockwell;font-size: 10px;"></th>
          <th align="right"><span style="font-family:Rockwell;font-size: 10px;"></th>
          <th align="right"><span style="font-family:Rockwell;font-size: 10px;">Rp. <?= number_format(abs($gdlb+$totrld)); ?></th>
          <th align="right"><span style="font-family:Rockwell;font-size: 10px;">Rp. <?= number_format($totrlk); ?></th>
          <th align="right"><span style="font-family:Rockwell;font-size: 10px;">Rp. <?= number_format($totnrd); ?></th>
          <th align="right"><span style="font-family:Rockwell;font-size: 10px;">Rp. <?= number_format(abs($gdnc+$totnrk)); ?></th>
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