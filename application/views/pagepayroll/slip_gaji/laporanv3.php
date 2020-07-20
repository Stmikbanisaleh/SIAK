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
			<center><font size="1"><b>PERGURUAN ISLAM GEMA TERPADU</b><font></center>
			<center><font size="1">TANDA BUKTI PENERIMAAN GAJI / HONOR<font></center>
			<hr></hr>
		</div>
		
		<div class="informasi">
			<table style="width:100%; float:left;">
				<tr>
					<td style="width: 35px;">NIK</td>
					<td style="width: 5px;">:</td>
					<td style=""><?= $row['employee_number']?></td>
					<td style="text-align:right">Periode <?= $bulan.' '.$tahun ?></td>
				</tr>
				<tr style="width:70%">
					<td>Nama</td>
					<td>:</td>
					<td><?= $row['nama'] ?></td>
				</tr>
				<?php
				if($ket=='K'){
				?>
				<tr style="width:70%">
					<td>Jabatan</td>
					<td>:</td>
					<td><?= $row['jabatan'] ?></td>
				</tr>
				<?php
				}else{
				?>
				<tr style="width:70%">
					<td>Unit Kerja</td>
					<td>:</td>
					<td><?= $row['status'] ?></td>
				</tr>
				<?php
				}
				?>
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
						<td width="45px;" style="text-align : right;">Nominal (Rp)</td>
						<td width="9px;"></td>
						<td width="80px;">Keterangan</td>
						<td width="70px;" style="text-align : right;">Nominal (Rp)</td>
					</tr>
					<tr>
						<td>1</td>
						<td>Gaji Pokok</td>
						<td style="text-align:right"><?= number_format($pend_gaji_pokok) ?></td>
						<td></td>
						<td>Asuransi</td>
						<td style="text-align:right"><?= number_format($pot_asuransi) ?></td>
					</tr>
					<tr>
						<td>2</td>
						<td>T. Pajak</td>
						<td style="text-align:right"><?= number_format($pend_pajak) ?></td>
						<td></td>
						<td>Potongan pensiun angka 27/32</td>
						<td style="text-align:right"><?= number_format($pot_pensiun) ?></td>
					</tr>
					<tr>
						<td>3</td>
						<td>T. Jabatan</td>
						<td style="text-align:right"><?= number_format($pend_tunjabatan) ?></td>
						<td></td>
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
			<hr style="margin-top:1px;"></hr>
			<table>
					<tr>
						<td width="125px;">Gaji kotor</td>
						<td width="44px;" style="text-align:right"> </td>
						<td width="165px;" style="text-align:right" colspan=""><?= number_format($jumlah_pend) ?></td>
					</tr>
					<tr>
						<td width="125px;">Total Potongan</td>
						<td width="44px;" style="text-align:right"> </td>
						<td width="165px;" style="text-align:right" colspan=""><?= number_format($jumlah_pot) ?></td>
					</tr>
			</table>
			<hr style="margin-top:1px;"></hr>
			<table>
					<tr>
						<td width="125px;">Gaji bersih</td>
						<td width="141px;"> </td>
						<td width="68px;" style="text-align:right">Rp_ <?= number_format($total) ?></td>
					</tr>
			</table>
		</div>
		<div class="footerslip">
			<table>
				<tr>
					<td width="160px; text-align:center;"> </td>
					<td width="160px; text-align:center;"><?= $tgl ?></td>
				</tr>
				<tr>
					<td width="160px; text-align:center;"></td>
					<td width="160px; text-align:center;">Penerima</td>
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
					<td width="160px; text-align:center;"></td>
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