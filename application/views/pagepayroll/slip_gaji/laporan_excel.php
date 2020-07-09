<html>
<head>
<style>
.text{
  mso-number-format:"\@";/*force text*/
}

.baris1{
	font-size: 1em;
	font-style: normal;
	line-height: normal;
	font-family:"Times New Roman", Times, serif;
}

.baris2{
	font-size:1;
}

.baris3{
	font-size:1;
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
		$pend_gaji_pokok = $row['gaji']+$row['rapel']+$row['premi'];
		$pend_pajak = $row['tunj_pajak'];
		$pend_tunjabatan = $row['tunj_jabatan'];
		$pend_tunjsansos = $row['tunj_sansos'];
		$pend_strukturalkhusus = $row['tunj_struktural_khusus'];
		$pend_transportasi = $row['tunj_transport'];
		$pend_pegawai_tetap = $row['tunj_tetap'];
		$pend_peralihan = $row['tunj_peralihan'];
		$pend_utility = $row['tunj_utility'];
		$pend_honorarium = $row['honorarium_imb'];
		$pend_asuransi = $row['asuransi_jamsostek']+$row['asuransi_lainnya'];
		$pend_bonus = $row['bonus']+$row['thr']+$row['cuti_jubelium'];
		$pend_lain = $row['tunj_lain'];
		$jumlah_pend = $pend_gaji_pokok+$pend_pajak+$pend_tunjabatan+$pend_tunjsansos+$pend_strukturalkhusus+$pend_transportasi+$pend_pegawai_tetap+$pend_peralihan+$pend_utility+$pend_honorarium+$pend_asuransi+$pend_bonus+$pend_lain;

		//Potongan
		$pot_asuransi = $row['pot_iuran_pensiun']+$row['pot_iuran_jht'];
		$pot_pensiun = $row['pot_pensiun_27']+$row['pot_pensiun_32'];
		$pot_pph21 = $row['pph21_bulanan'];
		$pot_lain = $row['pot_lain'];
		$jumlah_pot = $pot_asuransi+$pot_pensiun+$pot_lain;

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
			<center><font size="1em"><b>PERGURUAN ISLAM GEMA TERPADU</b><font></center>
			<center><font size="1em">TANDA BUKTI PENERIMAAN GAJI / HONOR<font></center>
		</div>
		
		<div class="informasi">
			<table style="width:100%; float:left;">
				<tr style="border-top:1px solid;">
					<td style="width: 35px;" colspan="2">NIK</td>
					<td class="text" colspan="3"><?= $row['employee_number']?></td>
					<td style="text-align:right">Gaji <?= $bulan.' '.$tahun ?></td>
				</tr>
				<tr style="width:70%">
					<td colspan="2">Nama</td>
					<td><?= $row['nama'] ?></td>
				</tr>
				<?php
				if($ket=='K'){
				?>
				<tr style="width:70%">
					<td colspan="2">Jabatan</td>
					<td><?= $row['jabatan'] ?></td>
				</tr>
				<?php
				}else{
				?>
				<tr style="width:70%">
					<td colspan="2">Unit Kerja</td>
					<td><?= $row['status'] ?></td>
				</tr>
				<?php
				}
				?>
			</table>
		</div>
		<div class="isidata">
			<div class="tablekiri">
				<table>
					<tr style="border-top:1px solid;">
						<td colspan="3">Perincian</td>
						<td colspan="3">Potongan-potongan</td>
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
						<td style="text-align:right"><?= number_format($pend_gaji_pokok) ?></td>
						<td>1</td>
						<td>Asuransi</td>
						<td style="text-align:right"><?= number_format($pot_asuransi) ?></td>
					</tr>
					<tr>
						<td>2</td>
						<td>T. Pajak</td>
						<td style="text-align:right"><?= number_format($pend_pajak) ?></td>
						<td>2</td>
						<td>Potongan pensiun angka 27/32</td>
						<td style="text-align:right"><?= number_format($pot_pensiun) ?></td>
					</tr>
					<tr>
						<td>3</td>
						<td>T. Jabatan</td>
						<td style="text-align:right"><?= number_format($pend_tunjabatan) ?></td>
						<td>3</td>
						<td>Lain-lain</td>
						<td style="text-align:right"><?= number_format($pot_lain) ?></td>
					</tr>
					<tr>
						<td>4</td>
						<td>Sansos</td>
						<td style="text-align:right"><?= number_format($pend_tunjsansos) ?></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>5</td>
						<td>Struktural/Khusus</td>
						<td style="text-align:right"><?= number_format($pend_strukturalkhusus) ?></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>6</td>
						<td>Transportasi</td>
						<td style="text-align:right"><?= number_format($pend_transportasi) ?></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>7</td>
						<td>T. Tentap</td>
						<td style="text-align:right"><?= number_format($pend_pegawai_tetap) ?></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>8</td>
						<td>Peralihan</td>
						<td style="text-align:right"><?= number_format($pend_peralihan) ?></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>9</td>
						<td>Utility</td>
						<td style="text-align:right"><?= number_format($pend_utility) ?></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<?php
					if($ket=='K'){
					?>
					<tr>
						<td>10</td>
						<td>Honorarium</td>
						<td style="text-align:right"><?= number_format($pend_honorarium) ?></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<?php
					}else{
					?>
					<tr>
						<td>10</td>
						<td>Honorarium (Jumlah jam)</td>
						<td style="text-align:right"><?= number_format($pend_honorarium).' ('.$row["jumlah_jam"].')' ?></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<?php
					}
					?>
					<tr>
						<td>11</td>
						<td>Asuransi Perusahaan</td>
						<td style="text-align:right"><?= number_format($pend_asuransi) ?></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td>12</td>
						<td>Bonus+THR+Cuti</td>
						<td style="text-align:right"><?= number_format($pend_bonus) ?></td>
						<td></td>
						<td></td>
						<td> </td>
					</tr>
					<tr>
						<td>13</td>
						<td>Lain-lain</td>
						<td style="text-align:right"><?= number_format($pend_lain) ?></td>
						<td></td>
						<td></td>
						<td> </td>
					</tr>
				</table>
			</div>
			<table>
					<tr style="border-top:1px solid;">
						<td colspan="2">Jumlah</td>
						<td width="44px;" style="text-align:right"><?= number_format($jumlah_pend) ?></td>
						<td colspan="3" style="text-align:right"><?= number_format($jumlah_pot) ?></td>
					</tr>
			</table>
			<table>
					<tr style="border-top:1px solid;">
						<td width="125px;" colspan="5">Total pendapatan</td>
						<td width="50px;" style="text-align:right"><?= number_format($total) ?></td>
					</tr>
			</table>
		</div>
		<br>
		<div class="footerslip">
			<table>
				<tr>
					<td style="vertical-align : middle;text-align:center;" colspan="3">Penerima</td>
					<td style="vertical-align : middle;text-align:center;" colspan="3">Keuangan</td>
				</tr>
				<tr>
					<td width="150px; text-align:center;" colspan="3"></td>
					<td width="150px; text-align:center;" colspan="3"></td>
				</tr>
				<tr>
					<td width="150px; text-align:center;" colspan="3"></td>
					<td width="150px; text-align:center;" colspan="3"></td>
				</tr>
				<tr>
					<td width="150px; text-align:center;" colspan="3"></td>
					<td width="150px; text-align:center;" colspan="3"></td>
				</tr>
				<tr>
					<td width="150px; text-align:center;" colspan="3"></td>
					<td width="150px; text-align:center;" colspan="3"></td>
				</tr>
				<tr>
					<td style="vertical-align : middle;text-align:center;" colspan="3">(.......................................)</td>
					<td style="vertical-align : middle;text-align:center;" colspan="3">(.......................................)</td>
				</tr>
			</table>
		</div>
	</div>
	<br>
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