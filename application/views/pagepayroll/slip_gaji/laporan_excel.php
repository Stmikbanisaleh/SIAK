
<html>
<head>
<style>
	.baris1{
			clear:both;
			margin:1px;
			font-size:6px;
			margin-top:12px;
	}

	.baris2{
			clear:both;
			margin:1px;
			font-size:6px;
	}

	.baris3{
			clear:both;
			margin:1px;
			font-size:6px;
	}

   .content_left{
	height:9.6cm;
	width:48%;
	/* border: 2px solid red; */
	/* margin: 9px; */
	float: left;
	margin-right:5px;
	margin-bottom:5px;
	background-clip: padding-box;
   }

   .content_right{
	height:9.6cm;
	width:48%;
	/* border: 2px solid red; */
	margin-left:5px;
	margin-bottom:5px;
	float: right;
	background-clip: padding-box;
   }

   .informasi{
		width:100%;
		/* clear:both; */
   }

   .isidata{
		width:100%;
		/* clear:both; */
   }

   .tablekiri{
	   width:50%;
	   /* border: 2px solid red; */
	   /* margin:1px;
	   float:left;
	   clear:both; */
   }

   .tablekanan{
	   width:150px;
	   /* border: 2px solid blue; */
	   /* margin:1px;
	   float:right;
	   clear:both; */
   }

   .footerslip{
		width:100%;
		margin-top:0px;
   }

   td{
	   font-size:6px;
	   
   }
</style>
</head>
<body>
<?php
header("Content-type:application/x-msdownload");
header("content-disposition:attactment;filename=laporan_honor_reguler.xls");
header("pragma:no-cache");
header("Expires:0");
?>
<?php
	$baris = $mygaji->num_rows();
	$flag = 1;
	$bariske = 1;
	$no = 1;
	$content = 'content_left';
	$mydata = $mygaji->result_array();
	foreach($mydata as $row){
		if($bariske == 1){
			$class_baris = 'baris1';
		}else if($bariske == 2){
			$class_baris = 'baris2';
		}else if($bariske == 3){
			$class_baris = 'baris3';
		}

		if($flag == 1){
			$content = 'content_left';
		}else{
			$content = 'content_right';
		}

		//Pendapatan
		$pend_gaji_pokok = $row['gaji']+$row['rapel'];
		$pend_tunjabatan = $row['tunj_jabatan'];
		$pend_pegawai_tetap = $row['tunj_tetap'];
		$pend_tunjkeluarga = $row['tunj_keluarga'];
		$pend_masakerja = $row['tunj_masakerja'];
		$pend_kesehatan = $row['asuransi_jamsostek']+$row['asuransi_lainnya'];
		$pend_pembinaan = $row['tunj_pembinaan'];
		$pend_transportasi = $row['tunj_transport'];
		$pend_invalkhusus = $row['inval_khusus'];
		$pend_thr = $row['thr'];
		// $pend_strukturalkhusus = $row['tunj_struktural_khusus'];
		$pend_khusus = $row['tunj_khusus'];
		$pend_lain = $row['tunj_lain'];
		$jumlah_pend = $pend_gaji_pokok+$pend_tunjabatan+$pend_pegawai_tetap+$pend_tunjkeluarga+$pend_masakerja+$pend_kesehatan+$pend_kesehatan+$pend_pembinaan+$pend_transportasi+$pend_invalkhusus+$pend_thr+$pend_khusus+$pend_lain;

		//Potongan
		$pot_infaqmasjid = $row['pot_infaqmasjid'];
		$pot_kasbon = $row['pot_kasbon'];
		$pot_ijintelat = $row['pot_ijintelat'];
		$pot_bmt = $row['pot_bmt'];
		$pot_koperasi = $row['pot_koperasi'];
		$pot_diinval = $row['pot_inval'];
		$pot_tokoalhamra = $row['pot_tokoalhamra'];
		$pot_taawun = $row['pot_taawun'];
		$pot_bpjs = $row['pot_bpjs'];
		$pot_lain = $row['pot_lain'];
		$jumlah_pot = $pot_infaqmasjid+$pot_kasbon+$pot_ijintelat+$pot_bmt+$pot_koperasi+$pot_diinval+$pot_tokoalhamra+$pot_taawun+$pot_bpjs+$pot_lain;

		$total = $jumlah_pend-$jumlah_pot;
?>
<?php
	if($flag == 1){
?>
<div class="<?php echo $class_baris; ?>">
<?php
	}
?>
	<div class="<?php echo $content; ?>">
		<div>
			<center><font size="1"><b>PERGURUAN ISLAM GEMA TERPADU</b><font></center>
			<center><font size="1">TANDA BUKTI PENERIMAAN GAJI / HONOR<font></center>
			<hr></hr>
		</div>
		
		<div class="informasi">
			<table style="width:100%; float:left;">
				<tr>
					<td>NIK</td>
					<td>:</td>
					<td style=""><?= $row['employee_number']?></td>
					<td style="text-align:right">Gaji Januari 2012</td>
				</tr>
				<tr style="width:70%">
					<td>Nama</td>
					<td>:</td>
					<td><?= $row['nama'] ?></td>
				</tr>
				<tr style="width:70%">
					<td>Unit Kerja</td>
					<td>:</td>
					<td><?= $row['status'] ?></td>
				</tr>
			</table>
			<hr style="margin-top:40px;"></hr>
		</div>
		<div class="isidata">
			<div class="tablekiri">
				<table>
					<tr>
						<td colspan="4">Perincian</td>
						<td colspan="4">Potongan-potongan</td>
					</tr>
					<tr>
						<td width="9px;">No</td>
						<td width="110px;">Keterangan</td>
						<td width="45px;">Nominal (Rp)</td>
						<td width="9px;">No</td>
						<td width="80px;">Keterangan</td>
						<td width="50px;">Nominal (Rp)</td>
					</tr>
					<tr>
						<td>1</td>
						<td>Gaji Pokok</td>
						<td><?= $pend_gaji_pokok ?></td>
						<td>1</td>
						<td>Infaq Masjid</td>
						<td><?= $pot_infaqmasjid ?></td>
					</tr>
					<tr>
						<td>2</td>
						<td>T. Jabatan</td>
						<td><?= $pend_tunjabatan ?></td>
						<td>2</td>
						<td>Anggota Koperasi</td>
						<td><?= $pot_koperasi ?></td>
					</tr>
					<tr>
						<td>3</td>
						<td>T. Pegawai Tetap</td>
						<td><?= $pend_pegawai_tetap ?></td>
						<td>3</td>
						<td>Kas Bon</td>
						<td><?= $pot_kasbon ?></td>
					</tr>
					<tr>
						<td>4</td>
						<td>T. Keluarga</td>
						<td><?= $pend_tunjkeluarga ?></td>
						<td>4</td>
						<td>Ijin/Telat</td>
						<td><?= $pot_ijintelat ?></td>
					</tr>
					<tr>
						<td>5</td>
						<td>T. Masa Kerja</td>
						<td><?= $pend_masakerja ?></td>
						<td>5</td>
						<td>BMT</td>
						<td><?= $pot_bmt ?></td>
					</tr>
					<tr>
						<td>6</td>
						<td>Transportasi</td>
						<td><?= $pend_pembinaan ?></td>
						<td>6</td>
						<td>Koperasi</td>
						<td><?= $pot_koperasi ?></td>
					</tr>
					<tr>
						<td>7</td>
						<td>T. Inval/Khusus</td>
						<td><?= $pend_invalkhusus?></td>
						<td>7</td>
						<td>Diinval</td>
						<td><?= $pot_diinval ?></td>
					</tr>
					<tr>
						<td>8</td>
						<td>THR</td>
						<td><?= $pend_thr ?></td>
						<td>8</td>
						<td>Toko Al Hamra</td>
						<td><?= $pot_tokoalhamra ?></td>
					</tr>
					<tr>
						<td>9</td>
						<td>T. Khusus</td>
						<td><?= $pend_khusus ?></td>
						<td>9</td>
						<td>Ta'awun</td>
						<td><?= $pot_taawun ?></td>
					</tr>
					<tr>
						<td>10</td>
						<td>Lain-lain</td>
						<td><?= $pend_lain ?></td>
						<td>10</td>
						<td>Lain-lain</td>
						<td><?= $pot_lain ?></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td><?= $pend_khusus ?></td>
						<td>11</td>
						<td>BPJS</td>
						<td><?= $pot_bpjs ?></td>
					</tr>
					<tr>
						<td> </td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td> </td>
					</tr>
				</table>
			</div>
			<hr style="margin-top:1px;"></hr>
			<table>
					<tr>
						<td width="125px;">Jumlah</td>
						<td width="141px;"><?= $jumlah_pend; ?></td>
						<td width="50px;"><?= $jumlah_pot; ?></td>
					</tr>
			</table>
			<hr style="margin-top:1px;"></hr>
			<table>
					<tr>
						<td width="125px;">Total</td>
						<td width="141px;"> </td>
						<td width="50px;"><?= $total; ?></td>
					</tr>
			</table>
		</div>
		<div class="footerslip">
			<table>
				<tr>
					<td width="160px; text-align:center;">Penerima</td>
					<td width="160px; text-align:center;">Keuangan</td>
				</tr>
				<tr>
					<td width="150px; text-align:center;"></td>
					<td width="150px; text-align:center;"></td>
				</tr>
				<tr>
					<td width="150px; text-align:center;"></td>
					<td width="150px; text-align:center;"></td>
				</tr>
				<tr>
					<td width="150px; text-align:center;"></td>
					<td width="150px; text-align:center;"></td>
				</tr>
				<tr>
					<td width="150px; text-align:center;"></td>
					<td width="150px; text-align:center;"></td>
				</tr>
				<tr>
					<td width="150px; text-align:center;"></td>
					<td width="150px; text-align:center;"></td>
				</tr>
				<tr>
					<td width="160px; text-align:center;">(.......................................)</td>
					<td width="160px; text-align:center;">(.......................................)</td>
				</tr>
			</table>
		</div>
	</div>
<?php
if($flag == 2){
?>
</div>
<?php
}
?>
<?php
	$no++;
		if($flag==2){
			$flag = 1;
		}else{
			$flag++;
		}

		if($bariske==3){
			$bariske = 1;
		}else{
			$bariske++;
		}
	}
?>

</div>
</body>
</html>