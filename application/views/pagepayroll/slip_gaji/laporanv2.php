<?php
// session_start();
// include "../../configurasi/koneksi.php";
// function makeInt($angka)
// {
// if ($angka < -0.0000001)
// {
// return ceil($angka-0.0000001);
// }
// else
// {
// return floor($angka+0.0000001);
// }
// }
/*
header("Content-type:application/x-msdownload");
header("content-disposition:attactment;filename=laporan_honor_reguler.xls");
header("pragma:no-cache");
header("Expires:0");
*/
//   date_default_timezone_set("Asia/Jakarta");
//   $jam = date("d F Y"); 
// $sql="SELECT THNAKAD, ID,SEMESTER,TAHUN,UTSUAS FROM TBAKADMK WHERE INDEK=(SELECT MAX(INDEK) FROM TBAKADMK)";
// $tampil=odbc_exec($buka,$sql);
// $sql="SELECT DISTINCT 
// dbo.HTDOSEN.KODEDOSEN,
// dbo.TBDOSAKTF.DSNAMA,
// dbo.TBDOSAKTF.DsStatus
// FROM
// dbo.HTDOSEN
// INNER JOIN dbo.TBDOSAKTF ON dbo.HTDOSEN.KODEDOSEN = dbo.TBDOSAKTF.DSNOTBDOS
// INNER JOIN dbo.pengawas ON dbo.pengawas.KdPengawas = dbo.TBDOSAKTF.DSNOTBDOS
// WHERE pengawas.status='T'
// ORDER BY DSNAMA ASC";
// $tampil_jml=odbc_exec($buka,$sql);

// 									if($_POST[bulan]==1){$f='JANUARI';}
// 									elseif($_POST[bulan]==2){$f='FEBRUARI';}
// 									elseif($_POST[bulan]==3){$f='MARET';}
// 									elseif($_POST[bulan]==4){$f='APRIL';}
// 									elseif($_POST[bulan]==5){$f='MEI';}
// 									elseif($_POST[bulan]==6){$f='JUNI';}
// 									elseif($_POST[bulan]==7){$f='JULI';}
// 									elseif($_POST[bulan]==8){$f='AGUSTUS';}
// 									elseif($_POST[bulan]==9){$f='SEPTEMBER';}
// 									elseif($_POST[bulan]==10){$f='OKTOBER';}
// 									elseif($_POST[bulan]==11){$f='NOVEMBER';}
// 									elseif($_POST[bulan]==12){$f='DESEMBER';}
header("Content-type:application/x-msdownload");
header("content-disposition:attactment;filename=laporan_honor_reguler.xls");
header("pragma:no-cache");
header("Expires:0");// 

?>
<html>
<head>
<style type="text/css">
table{
	font-size: 1em;
}
@page {
   size: 25.4cm 46cm;
   margin-top: 1cm;
   margin-bottom: 0cm;
   margin-left: 0cm;
   margin-right: 0cm;
   border: 1px solid blue;
}
#teks {
	font-size: 1em;
	font-style: normal;
	line-height: normal;
	color: #000000;
	font-family:Arial, Helvetica, sans-serif;
	
}
.style2 {
	font-size: 1em;
	font-style: normal;
	line-height: normal;
	color: #000000;
	font-family:Arial, Helvetica, sans-serif;	
}
#teks2 {
	font-size: 1em;
	font-style: normal;
	line-height: normal;
	font-weight: bold;
	color: #000000;
font-family:"Times New Roman", Times, serif;
	
}
#teks3 {
	font-size: 1em;
	font-style: normal;
	line-height: normal;
	font-weight: bold;
	color: #000000;
font-family:Arial, Helvetica, sans-serif;	
}
.style4 {font-size: medium; }

</style>
</head>
<body>
<table border="0" width="100%" class="style2" cellspacing="3">
<?php
// 	$no=1;
// while(odbc_fetch_row($tampil_jml)){
// 	if($no%2==1){
// 	print "<tr>";
// 	}
?>
	<td>
<table border="1" width="100%" class="style2" cellpadding="1" cellspacing="3">
<tr>
	<td colspan='5' align='center'><b><div id="teks3">STMIK BANI SALEH</div></td>      
</tr>
<tr>
	<td colspan='5' align='center'><b><div id="teks3">SLIP GAJI DOSEN</div></td>      
</tr>
<tr>
	<td colspan='5' align='center'><b><div id="teks3">BULAN </div></td>
</tr>
<tr>
	<td colspan='5'  class="style2">
	Nama Dosen &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:  Dia<br>
	Kode Dosen &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:  433<br>
	Status Dosen &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:  Aktif
	</td>
</tr> 
<tr>
	<td colspan='5'>
		<table border="0" width="100%" class="style2">
			<tr>
				<td width='20%'><b>PENDAPATAN</td>
				<td width='20%'>&nbsp;</td>
				<td width='20%'>&nbsp;</td>
				<td width='20%'>&nbsp;</td>
			</tr>
			<tr>
				<td><b>Tarif SKS</td>
				<td>&nbsp;</td>
				<td><b>Jumlah SKS</td>
				<td><b>Honor</td>
			</tr>
			<tr>
				<td><b>Regular</td>
				<td>
					<table border="1" width="100%" class="style2">
					<tr>
						<td align='right'><b>20000
						<?php
						// $sql="SELECT (TARIF)AS TARIF FROM pengawas WHERE KdPengawas='".odbc_result($tampil_jml,KODEDOSEN)."'";
						// $senat=odbc_exec($buka,$sql);
						// if(odbc_result($senat,TARIF)==NULL){echo"0";}else{echo number_format(odbc_result($senat,TARIF), 0,".",".");}
						?>
						</td>
					</tr>
					</table>
				</td>
				<td>
					<table border="1" width="100%" class="style2">
					<tr>
						<td align='right'><b>20000
						<?php
						// $sql="SELECT*FROM HTDOSEN WHERE KODEDOSEN='".odbc_result($tampil_jml,KODEDOSEN)."' AND THNAKAD='".odbc_result($tampil,TAHUN)."' AND PERIODE='".$_POST[bulan]."' AND STATUS='R'";
						// $senat=odbc_exec($buka,$sql);
						// if(odbc_result($senat,JMLHADIR)==NULL){echo"0";}else{echo odbc_result($senat,JMLHADIR);}
						?>
						</td>
					</tr>
					</table>
				</td>
				<td>
					<table border="1" width="100%" class="style2">
					<tr>
						<td align='right'><b>20000
						<?php
						// $sql="SELECT*FROM HTDOSEN WHERE KODEDOSEN='".odbc_result($tampil_jml,KODEDOSEN)."' AND THNAKAD='".odbc_result($tampil,TAHUN)."' AND PERIODE='".$_POST[bulan]."' AND STATUS='R'";
						// $senat=odbc_exec($buka,$sql);
						// if(odbc_result($senat,HONOR)==NULL){echo"0";}else{echo number_format(odbc_result($senat,HONOR), 0,".",".");}
						// $v1=odbc_result($senat,HONOR);
						?>
						</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td><b>Jum'at/Sabtu</td>
				<td>
					<table border="1" width="100%" class="style2">
					<tr>
						<td align='right'><b>20000
						<?php
// 						$sql="SELECT FLOOR(TARIF+(TARIF*0.10))AS TARIF FROM pengawas WHERE KdPengawas='".odbc_result($tampil_jml,KODEDOSEN)."'";
// 						$senat=odbc_exec($buka,$sql);
// 						$jum_f=odbc_result($senat,TARIF);
//  $ratusan = substr($jum_f, -2);
//  if($ratusan<100){
//  $akhir = $jum_f + (100-$ratusan);
//  }else{
//  $akhir = $jum_f + (100-$ratusan);
//  }
// 						if(odbc_result($senat,TARIF)==NULL){echo"0";}else{echo number_format($akhir, 0,".",".");}
// 						$v_d2=$akhir;
						?>
						</td>
					</tr>
					</table>
				</td>
				<td>
					<table border="1" width="100%" class="style2">
					<tr>
						<td align='right'><b>20000
						<?php
						// $sql="SELECT SUM(dbo.D_HTDOSEN.SKS)AS SKS,SUM(HADIR)AS HADIR,SUM(dbo.D_HTDOSEN.SKS*dbo.D_HTDOSEN.HADIR)AS v_jml FROM D_HTDOSEN WHERE KODEDOSEN='".odbc_result($tampil_jml,KODEDOSEN)."' AND THNAKAD='".odbc_result($tampil,TAHUN)."' AND PERIODE='".$_POST[bulan]."' AND HARI NOT IN('minggu')";
						// $senat=odbc_exec($buka,$sql);
						// if(odbc_result($senat,v_jml)==NULL){echo"0";}else{echo odbc_result($senat,v_jml);}
						// $v2=$v_d2*odbc_result($senat,v_jml);
						?>
						</td>
					</tr>
					</table>
				</td>
				<td>
					<table border="1" width="100%" class="style2">
					<tr>
						<td align='right'><b>200000
						<?php
						// echo number_format($v2, 0,".",".");
						?>
						</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td><b>Minggu</td>
				<td>
					<table border="1" width="100%" class="style2">
					<tr>
						<td align='right'><b>20000
						<?php
// 						$sql="SELECT FLOOR(TARIF+(TARIF*0.25))AS TARIF FROM pengawas WHERE KdPengawas='".odbc_result($tampil_jml,KODEDOSEN)."'";
// 						$senat=odbc_exec($buka,$sql);
// 						$jum_f=odbc_result($senat,TARIF);
//  $ratusan = substr($jum_f, -2);
//  if($ratusan<100){
//  $akhir = $jum_f + (100-$ratusan);
//  }else{
//  $akhir = $jum_f + (100-$ratusan);
//  }
// 						if(odbc_result($senat,TARIF)==NULL){echo"0";}else{echo number_format($akhir, 0,".",".");}
// 						$v_d3=$akhir;
						?>
						</td>
					</tr>
					</table>
				</td>
				<td>
					<table border="1" width="100%" class="style2">
					<tr>
						<td align='right'><b>20000
						<?php
						// $sql="SELECT SUM(dbo.D_HTDOSEN.SKS)AS SKS,SUM(HADIR)AS HADIR,SUM(dbo.D_HTDOSEN.SKS*dbo.D_HTDOSEN.HADIR)AS v_jml FROM D_HTDOSEN WHERE KODEDOSEN='".odbc_result($tampil_jml,KODEDOSEN)."' AND THNAKAD='".odbc_result($tampil,TAHUN)."' AND PERIODE='".$_POST[bulan]."' AND HARI='minggu'";
						// $senat=odbc_exec($buka,$sql);
						// if(odbc_result($senat,v_jml)==NULL){echo"0";}else{echo odbc_result($senat,v_jml);}
						// $v3=$v_d3*odbc_result($senat,v_jml);
						?>
						</td>
					</tr>
					</table>
				</td>
				<td>
					<table border="1" width="100%" class="style2">
					<tr>
						<td align='right'><b>200000
						<?php
						// echo number_format($v3, 0,".",".");
						?>
						</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan='4'><HR WIDTH=80% SIZE=1 NOSHADE align='right'></td>
			</tr>
			<tr>
				<td><b>Total Honor Mengajar</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>
					<table border="1" width="100%" class="style2">
					<tr>
						<td align='right'><b>200000
						<?php
						// $t_v=$v1+$v2+$v3;
						// echo number_format($t_v, 0,".",".");
						?>
						</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td><b>Pembimbing Akademik</td>
				<td><b></td>
				<td>&nbsp;</td>
				<td>
					<table border="1" width="100%" class="style2">
					<tr>
						<td align='right'><b>200000
						<?php
// 						$thm_akad=odbc_result($tampil,2);
// $lihat_pa="SELECT COUNT(DISTINCT dbo.TBDOSAKTF.DSNAMA)AS jml FROM dbo.MSPA INNER JOIN dbo.TBDOSAKTF ON dbo.MSPA.KDDOSPA = dbo.TBDOSAKTF.DSNOTBDOS WHERE
// dbo.MSPA.THNAKD = '".$thm_akad."' AND TBDOSAKTF.DSNOTBDOS='".odbc_result($tampil_jml,KODEDOSEN)."' AND dbo.MSPA.KDDOSPA NOT IN ('0')";
// $tampil_pa=odbc_exec($buka,$lihat_pa);
// if(odbc_result($tampil_pa,jml)==1){
// 							if($_POST['pmb']==1){
// 								$pa_v=300000;
// 							}else{
// 								$pa_v=0;
// 							}
// }else{
// 		$pa_v=0;
// }
					
// 						echo number_format($pa_v, 0,".",".");
						?>
						</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td><b>Senat Akademik</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>
					<table border="1" width="100%" class="style2">
					<tr>
						<td align='right'><b>200000
						<?php
						// $sql="SELECT
						// 	dbo.TBDOSSENAT.SenatTarif
						// 	FROM
						// 	dbo.TBDOSSENAT
						// 	WHERE DSNOTBDOS='".odbc_result($tampil_jml,KODEDOSEN)."' AND SenatStatus=1";
						// $senat=odbc_exec($buka,$sql);
						// if(odbc_result($senat,SenatTarif)==NULL){echo"0";}else{echo number_format(odbc_result($senat,SenatTarif), 0,".",".");}
						// $t_v2=odbc_result($senat,SenatTarif);
						?>
						</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td><b>Tunjangan Dosen Tetap</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>
					<table border="1" width="100%" class="style2">
					<tr>
						<td align='right'><b>200000
						<?php
// 						$sql="SELECT 
// dbo.TBDOSAKTF.DSNAMA,
// (SELECT z.TARIF FROM pengawas z WHERE z.KdPengawas=dbo.TBDOSAKTF.DSNOTBDOS)as tarif,
// (SELECT DISTINCT RTRIM(z.RiwayatKompetensi) FROM TBDOSRIWAYAT z WHERE z.RiwayatKompetensi='Kompetensi' AND z.DSNOTBDOS=TBDOSAKTF.DSNOTBDOS)AS riwayat
// FROM 
// TBDOSAKTF 
// WHERE 
// TBDOSAKTF.DSNAMA NOT IN(SELECT
// RTRIM(dbo.pengawas.NamaPengawas)
// FROM pengawas
// WHERE KdPengawas LIKE'S%' AND status='T') 
// AND dbo.TBDOSAKTF.DsStatus = 'tetap' 
// AND	dbo.TBDOSAKTF.DSNOTBDOS = '".odbc_result($tampil_jml,KODEDOSEN)."' 
// AND TBDOSAKTF.DSNOTBDOS IN(SELECT
// RTRIM(dbo.pengawas.KdPengawas)
// FROM pengawas
// WHERE status='T') 
// ORDER BY 
// dbo.TBDOSAKTF.DSNAMA ASC";
// 						$senat=odbc_exec($buka,$sql);						
// 						if(odbc_result($senat,riwayat)=='Kompetensi'){
// 							$grand=((odbc_result($senat,TARIF)*4+(odbc_result($senat,TARIF)*4*0.2))/1000)*1000;							
// $ratusan = substr($grand, -2);
// if($ratusan<100){
//  $akhir = $grand + (100-$ratusan);
//  }else{
//  $akhir = $grand + (100-$ratusan);
//  } 						
// 						}else{
// 					$total=(odbc_result($senat,TARIF));
// 					$akhir=$total*4;
// 						}	
// 						if(odbc_result($senat,TARIF)==NULL){echo"0";}else{echo number_format($akhir, 0,".",".");}
// 						$t_v3=$akhir;
						?>
						</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan='4'><HR WIDTH=100% SIZE=1 NOSHADE align='right'></td>
			</tr>
			<tr>
				<td colspan='3'><b>TOTAL PENDAPATAN</td>
						<td align='right'><b>200000
						<?php
						// $p_v=$t_v+$t_v2+$t_v3+$pa_v;
						// echo number_format($p_v, 0,".",".");
						?>
						</td>
			</tr>
			<tr>
				<td colspan='4'><HR WIDTH=100% SIZE=1 NOSHADE align='right'></td>
			</tr>
			<tr>
				<td colspan='4'><b>POTONGAN</td>
			</tr>
			<tr>
				<td><b>Infaq</td>
				<td>
					<table border="1" width="100%" class="style2">
					<tr>
						<td align='right'><b>20000
						<?php
						// $i_vi=$p_v*0.025;	
						// $i_v=round($i_vi);
						// $ratusan = substr($i_v, -2);
						// if($ratusan<100){
						//  $i_akhir = $i_v + (100-$ratusan);
						//  }else{
						//  $i_akhir = $i_v + (100-$ratusan);
						//  } 						
						//  if($i_akhir<=100){$infaq='0';}else{$infaq=$i_akhir;}	
						// echo number_format($i_akhir, 0,".",".");
						?>
						</td>
					</tr>
					</table>
				</td>
				<td><b>Arisan</td>
				<td>
					<table border="1" width="100%" class="style2">
					<tr>
						<td align='right'><b>20000000
						<?php
						// $sql="SELECT
						// 		dbo.TBDOSPOT.IdPotong,
						// 		dbo.TBDOSPOT.DSNOTBDOS,
						// 		dbo.TBDOSPOT.PotongTarif
						// 		FROM TBDOSPOT
						// 		WHERE PotongNama=1 AND PotongStatus='1'  AND DSNOTBDOS='".odbc_result($tampil_jml,KODEDOSEN)."' ";
						// $senat=odbc_exec($buka,$sql);
						// $a_v=odbc_result($senat,PotongTarif);	
						// echo number_format($a_v, 0,".",".");
						?>
						</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td><b>Asuransi Kesehatan</td>
				<td>
					<table border="1" width="100%" class="style2">
					<tr>
						<td align='right'><b>20000
						<?php
						// $sql="SELECT
						// 		dbo.TBDOSPOT.IdPotong,
						// 		dbo.TBDOSPOT.DSNOTBDOS,
						// 		dbo.TBDOSPOT.PotongTarif
						// 		FROM TBDOSPOT
						// 		WHERE PotongNama=2 AND PotongStatus='1'  AND DSNOTBDOS='".odbc_result($tampil_jml,KODEDOSEN)."' ";
						// $senat=odbc_exec($buka,$sql);
						// $as_v=odbc_result($senat,PotongTarif);
						// echo number_format($as_v, 0,".",".");
						?>
						</td>
					</tr>
					</table>
				</td>
				<td><b>Kasbon</td>
				<td>
					<table border="1" width="100%" class="style2">
					<tr>
						<td align='right'><b>20000
						<?php
						// $sql="SELECT
						// 		dbo.TBDOSPOT.IdPotong,
						// 		dbo.TBDOSPOT.DSNOTBDOS,
						// 		dbo.TBDOSPOT.PotongTarif
						// 		FROM TBDOSPOT
						// 		WHERE PotongNama=3 AND PotongStatus='1'  AND DSNOTBDOS='".odbc_result($tampil_jml,KODEDOSEN)."' ";
						// $senat=odbc_exec($buka,$sql);
						// $k_v=odbc_result($senat,PotongTarif);
						// echo number_format($k_v, 0,".",".");
						?>
						</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan='4'><HR WIDTH=100% SIZE=1 NOSHADE align='right'></td>
			</tr>
			<tr>
				<td colspan='3'><b>TOTAL POTONGAN</td>
						<td align='right'><b>20000
						<?php
						// $tp_v=($k_v+$as_v+$a_v+$infaq);
						// echo number_format($tp_v, 0,".",".");
						?>
						</td>
			</tr>
			<tr>
				<td colspan='4'><HR WIDTH=100% SIZE=1 NOSHADE align='right'></td>
			</tr>
			<tr>
				<td colspan='3'><b>PENDAPATAN BERSIH</td>
						<td align='right'><b>20000
						<?php
						// $pb_v=($p_v-$tp_v);
						// echo number_format($pb_v, 0,".",".");
						?>
						</td>
			</tr>
		</table>
	</td>
</tr> 
</table>
<br>
</td> 
<?php
//  $no++;
// }
?>     
</tr>
</table>
</body>
</html>
