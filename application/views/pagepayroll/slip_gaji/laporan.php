<html>
<head>
<style>
    @page { size: 17.6cm 25cm landscape; }
    /*landscape or portrait*/
    
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
    height:550px;
    /* background-color:red; */
   }

   .content_right{
	height:9.6cm;
	width:48%;
	/* border: 2px solid red; */
	margin-left:5px;
	margin-bottom:5px;
	float: right;
	background-clip: padding-box;
    height:550px;
    /* background-color:blue; */
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
	// echo json_encode($mydata);exit;
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
		$pend_gaji_pokok = $row['gaji'];
		$pend_tunjabatan = $row['tunj_jabatan'];
		$pend_transportasi = $row['tunj_transport'];
		$pend_pegawai_tetap = $row['tunj_tetap'];
		$pend_tunj_pembinaan = $row['tunj_pembinaan'];
		$pend_tunj_bpjs = $row['tunj_bpjs'];
		$pend_honor_berkala = $row['honor_berkala'];
		$tunj_masa_kerja = $row['tunj_masa_kerja'];
		$pend_tunj_keluarga = $row['tunj_keluarga'];
        $pend_thr = $row['thr'];
		$pend_tunj_honor_berkala = $row['tunj_malam_lembur'];
		$tunj_khusus1 = $row['tunj_khusus1'];
		$tunj_khusus2 = $row['tunj_khusus2'];
		$tunj_khusus3 = $row['tunj_khusus3'];
		$tunj_khusus4 = $row['tunj_khusus4'];
		$tunj_khusus5 = $row['tunj_khusus5'];
		$pend_lain = $row['tunj_lain'];
		// $jumlah_pend = $pend_gaji_pokok+$pend_pajak+$pend_tunjabatan+$pend_tunjsansos+$pend_strukturalkhusus+$pend_transportasi+$pend_pegawai_tetap+$pend_tunj_pembinaan+$pend_tunj_keluarga+$pend_rapel+$pend_premi+$pend_peralihan+$pend_utility+$pend_honorarium+$pend_asuransi+$pend_bonus+$pend_thr+$pend_cuti+$tunj_bpjs+$pend_lain+$tunj_international+$tunj_aksel+$tunj_walas+$tunj_convert+$tunj_honor_berkala+$tunj_penilaian_kinerja+$tunj_khusus1+$tunj_khusus2;

		
		$tunj_nilai[1] = $pend_gaji_pokok;
		$tunj_nilai[2] = $pend_tunjabatan;
		$tunj_nilai[3] = $pend_transportasi;
		$tunj_nilai[4] = $pend_pegawai_tetap;
		$tunj_nilai[5] = $pend_tunj_pembinaan;
		$tunj_nilai[6] = $pend_tunj_bpjs;
		$tunj_nilai[7] = $pend_honor_berkala;
		$tunj_nilai[8] = $tunj_masa_kerja;
		$tunj_nilai[9] = $pend_tunj_keluarga;
		$tunj_nilai[10] = $pend_thr;
		$tunj_nilai[11] = $pend_tunj_honor_berkala;
		$tunj_nilai[12] = $tunj_khusus1;
		$tunj_nilai[13] = $tunj_khusus2;
		$tunj_nilai[14] = $tunj_khusus3;
		$tunj_nilai[15] = $tunj_khusus4;
		$tunj_nilai[16] = $tunj_khusus5;
		$tunj_nilai[17] = $pend_lain;

		$label_tunj[1] = 'Honor';
		$label_tunj[2] = 'T. Jabatan';
		$label_tunj[3] = 'Transportasi';
		$label_tunj[4] = 'T. Tetap';
		$label_tunj[5] = 'T. Pembinaan';
		$label_tunj[6] = 'BPJS';
		$label_tunj[7] = 'Honor Berkala';
		$label_tunj[8] = 'T. Masa Kerja';
		$label_tunj[9] = 'T. Keluarga';
		$label_tunj[10] = 'THR';
		$label_tunj[11] = 'T. Honor Berkala';

		if($row['ket_tunj_khusus1'] != 0 || $row['ket_tunj_khusus1'] != '' ||$row['ket_tunj_khusus1'] != '0'){
			$label_tunj[12] = 'Tunj. Khusus ('.$row['ket_tunj_khusus1'].')';
		}else{
			$label_tunj[12] = 'Tunj. Khusus';
		}

		if($row['ket_tunj_khusus2'] != 0 || $row['ket_tunj_khusus2'] != '' ||$row['ket_tunj_khusus2'] != '0'){
			$label_tunj[13] = 'Tunj. Khusus ('.$row['ket_tunj_khusus2'].')';
		}else{
			$label_tunj[13] = 'Tunj. Khusus';
		}

		if($row['ket_tunj_khusus3'] != 0 || $row['ket_tunj_khusus3'] != '' ||$row['ket_tunj_khusus3'] != '0'){
			$label_tunj[14] = 'Tunj. Khusus ('.$row['ket_tunj_khusus3'].')';
		}else{
			$label_tunj[14] = 'Tunj. Khusus';
		}

		if($row['ket_tunj_khusus4'] != 0 || $row['ket_tunj_khusus4'] != '' ||$row['ket_tunj_khusus4'] != '0'){
			$label_tunj[15] = 'Tunj. Khusus ('.$row['ket_tunj_khusus4'].')';
		}else{
			$label_tunj[15] = 'Tunj. Khusus';
		}

		if($row['ket_tunj_khusus5'] != 0 || $row['ket_tunj_khusus5'] != '' ||$row['ket_tunj_khusus5'] != '0'){
			$label_tunj[16] = 'Tunj. Khusus ('.$row['ket_tunj_khusus5'].')';
		}else{
			$label_tunj[16] = 'Tunj. Khusus';
		}

		$label_tunj[17] = 'Lain-lain';

		//Potongan
		$pot_infaq_masjid = $row['pot_infaq_masjid'];
        $pot_anggota_koperasi = $row['pot_anggota_koperasi'];
        $pot_kas_bon = $row['pot_kas_bon'];
        $pot_ijin_telat = $row['pot_ijin_telat'];
        $pot_gemart = $row['pot_koperasi'];
		$pot_bmt = $row['pot_bmt'];
		$pot_inval = $row['pot_inval'];
		$pot_toko = $row['pot_toko'];
		$pot_taawun = $row['pot_tawun'];
        $pot_bpjs = $row['pot_bpjs'];
		$pot_ltq = $row['pot_ltq'];
		$pot_pph21 = $row['pph21_bulanan'];
		$pot_lain1 = $row['pot_lain1'];
		$pot_lain2 = $row['pot_lain2'];
		$pot_lain3 = $row['pot_lain3'];
		// $jumlah_pot = $pot_infaq_masjid+$pot_anggota_koperasi+$pot_kas_bon+$pot_ijin_telat+$pot_koperasi+$pot_bmt+$pot_tawun+$pot_pph21+$pot_bpjs+$pot_ltq+$pot_pensiun_27+$pot_pensiun_32+$pot_iuran_pensiun+$pot_iuran_jht+$pot_inval+$pot_toko+$pot_lain;
		
		$pot_nilai[1] = $pot_infaq_masjid;
		$pot_nilai[2] = $pot_anggota_koperasi;
		$pot_nilai[3] = $pot_kas_bon;
		$pot_nilai[4] = $pot_ijin_telat;
		$pot_nilai[5] = $pot_gemart;
		$pot_nilai[6] = $pot_bmt;
		$pot_nilai[7] = $pot_inval;
		$pot_nilai[8] = $pot_toko;
		$pot_nilai[9] = $pot_taawun;
		$pot_nilai[10] = $pot_bpjs;
		$pot_nilai[11] = $pot_ltq;
		$pot_nilai[12] = $pot_pph21;
		$pot_nilai[13] = $pot_lain1;
		$pot_nilai[14] = $pot_lain1;
		$pot_nilai[15] = $pot_lain1;

		

		$label_pot[1] = 'Infaq Masjid';
		$label_pot[2] = 'Anggota Koperasi';
		$label_pot[3] = 'Kasbon';
		$label_pot[4] = 'Izin / Telat';
		$label_pot[5] = 'Gemart';
		$label_pot[6] = 'BMT';
		$label_pot[7] = 'Inval';
		$label_pot[8] = 'Toko Al Hamra';
		$label_pot[9] = 'Taawun';
		$label_pot[10] = 'BPJS';
		$label_pot[11] = 'LTQ';
		$label_pot[12] = 'PPh21';

		if($row['pot_lain1'] != 0 || $row['pot_lain1'] != '' ||$row['pot_lain1'] != '0'){
			$label_pot[13] = 'Pot. Khusus ('.$row['ket_pot_lain1'].')';
		}else{
			$label_pot[13] = '';
		}

		if($row['ket_pot_lain2'] != 0 || $row['ket_pot_lain2'] != '' ||$row['ket_pot_lain2'] != '0'){
			$label_pot[14] = 'Pot. Khusus ('.$row['ket_pot_lain2'].')';
		}else{
			$label_pot[14] = '';
		}

		if($row['pot_lain3'] != 0 || $row['pot_lain3'] != '' ||$row['pot_lain3'] != '0'){
			$label_pot[15] = 'Pot. Khusus ('.$row['ket_pot_lain3'].')';
		}else{
			$label_pot[15] = '';
		}


		
		$row_pendapatan = 17; //Need change value to follow max row pendapatan
		$row_potongan = 15; //Need change value to follow max row potongan

		$cek_row_tunj = 0;
		for($a = 1; $a<= $row_pendapatan; $a++){
			if($tunj_nilai[$a] > 0){
				$cek_row_tunj++;
			}
		}

		$cek_row_pot = 0;
		for($b=1; $b <= $row_potongan; $b++){
			if($pot_nilai[$b] > 0){
				$cek_row_pot++;
			}
		}

		$array_data_sliptemp = array();
		if($cek_row_tunj>=$cek_row_pot || $cek_row_tunj<=$cek_row_pot){//Masuk kondisi baris tunjangan lebih banyak dari potongan

			$seq = 1;
			for($a = 1; $a<= $row_pendapatan; $a++){ //Looping sejumlah elemen tunjangan
				// if($tunj_nilai[$a] > 0){ // Jika terdapat tunjangan dengan nilai lebih dari 0
					$data_temp = array(
						'label_tunj' 	=> $label_tunj[$a],
						'tunj_nilai' 	=> (int)$tunj_nilai[$a],
						'label_pot' 	=> '',
						'pot_nilai' 	=> ''
					);
	
					for($b=$seq; $b <= $row_potongan; $b++){ //looping sejumlah element potongan
						// if($pot_nilai[$b] > 0){ //jika terdapat potongan dengan nilai lebih dari 0
							$data_temp = array(
								'label_tunj' 	=> $label_tunj[$a],
								'tunj_nilai' 	=> (int)$tunj_nilai[$a],
								'label_pot' 	=> $label_pot[$b],
								'pot_nilai' 	=> (int)$pot_nilai[$b]
							);
							$seq = $b+1;
							$b = $row_potongan;
						// }
					}
					array_push($array_data_sliptemp, $data_temp);
				// }
			}
		}
		// else{
		// 	$seq = 1;
		// 	for($b = 1; $b<= 16; $b++){ //looping sejumlah element potongan
		// 		// if($pot_nilai[$b] > 0){ //jika terdapat potongan dengan nilai lebih dari 0
		// 			// $data_temp = array(
		// 			// 	'label_tunj' 	=> '',
		// 			// 	'tunj_nilai' 	=> '',
		// 			// 	'label_pot' 	=> $label_pot[$b],
		// 			// 	'pot_nilai' 	=> (int)$pot_nilai[$b]
		// 			// );
	
		// 			for($a=$seq; $a <= 26; $a++){ //Looping sejumlah elemen tunjangan
		// 				// if($tunj_nilai[$a] > 0){ // Jika terdapat tunjangan dengan nilai lebih dari 0
		// 					$data_temp = array(
		// 						'label_tunj' 	=> $label_tunj[$a],
		// 						'tunj_nilai' 	=> (int)$tunj_nilai[$a],
		// 						'label_pot' 	=> $label_pot[$b],
		// 						'pot_nilai' 	=> (int)$pot_nilai[$b]
		// 					);
		// 					$seq = $a+1;
		// 					$a = 26;
		// 				// }
		// 			}
		// 			array_push($array_data_sliptemp, $data_temp);
		// 		// }
		// 	}
		// }
		
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
					<td style="text-align:right">Periode 
					<?php
					$bulan = $this->mainfunction->periode_bulan(date('m', strtotime($row['effective_date'])));
					 echo $bulan.' '.$tahun
					 ?></td>
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
					<td><?= $row['jabatan']."&nbsp;&nbsp; (".$row['jumlah_jam'].")" ?></td>
				</tr>
				<?php
				}else{
				?>
				<tr style="width:70%">
					<td>Unit Kerja</td>
					<td>:</td>
					<td>
					<?php
						echo $row['status'];
					?>
					</td>
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
						<td width="120px;">Keterangan</td>
						<td width="45px;" style="text-align : right;">Nominal (Rp)</td>
						<td width="20px;"> </td>
						<td width="118px;">Keterangan</td>
						<td width="70px;" style="text-align : right;">Nominal (Rp)</td>
                    </tr>
					<?php
						$no = 1;
						$jumlah_pend = 0;
						$jumlah_pot = 0;
						foreach($array_data_sliptemp as $rows){
							$jumlah_pend = $jumlah_pend+(int)$rows['tunj_nilai'];
							$jumlah_pot = $jumlah_pot+(int)$rows['pot_nilai'];
					?>
					
						<tr>
							<td><?= $no ?></td>
							<td><?= $rows['label_tunj'] ?></td>
							<td style="text-align:right">
								<?php
									if($rows['tunj_nilai'] != ''){
										echo number_format($rows['tunj_nilai']);
									}
								?>
							</td>
							<td></td>
							<td><?= $rows['label_pot'] ?></td>
							<td style="text-align:right">
							<?php
									if($rows['pot_nilai'] != ''){
										echo number_format($rows['pot_nilai']);
									}
								?>
							</td>
						</tr>
					<?php
						$no++;
						}
						$total = (int)$jumlah_pend-(int)$jumlah_pot;
					?>
					<?php
						if($ket!='K'){
							$tambahan = ($row['attribute_1']*$row['attribute_2'])+($row['attribute_3']*$row['attribute_4'])+($row['attribute_5']*$row['attribute_6'])+($row['attribute_7']*$row['attribute_8']);
							$jumlah_pend = $jumlah_pend+$tambahan;
					?>
						<?php
							if($row['attribute_1']!='' || $row['attribute_2']!=''){
						?>
						<tr>
							<td><?= $no ?></td>
							<td>
								<?php
									echo 'Tambahan ('.$row['attribute_1'].'X'.$row['attribute_2'].')+('.$row['attribute_3'].'X'.$row['attribute_4'].')+';
								?>
							</td>
							<td style="text-align:right"><?= $tambahan ?></td>
							<td></td>
						</tr>
						<?php
							}
						?>
						<?php
							if($row['attribute_5']!='' || $row['attribute_7']!=''){
						?>
						<tr>
							<td></td>
							<td>
								<?php
									echo '('.$row['attribute_5'].'X'.$row['attribute_6'].')+('.$row['attribute_7'].'X'.$row['attribute_8'].')';
								?>
							</td>
							<td></td>
							<td></td>
						</tr>
					<?php
							}
							
						}
					?>
					
					
				</table>
			</div>
			<hr style="margin-top:1px;"></hr>
			<table>
					<tr>
						<td width="125px;">Gaji kotor</td>
						<td width="44px;" style="text-align:right"> </td>
						<td width="227px;" style="text-align:right" colspan=""><?= number_format($jumlah_pend) ?></td>
					</tr>
					<tr>
						<td width="125px;">Total Potongan</td>
						<td width="44px;" style="text-align:right"> </td>
						<td width="165px;" style="text-align:right" colspan=""><?= number_format((int)$jumlah_pot) ?></td>
					</tr>
			</table>
			<hr style="margin-top:1px;"></hr>
			<table>
					<tr>
						<td width="125px;">Gaji bersih</td>
						<td width="141px;"> </td>
						<td width="68px;" style="text-align:right">Rp_ <?php echo number_format($total) ?></td>
					</tr>
			</table>
		</div> 
		<div class="footerslip">
            <br><br><br>
			<table>  
				<tr>
					<td width="220px; text-align:center;"> </td>
					<td width="100px; text-align:center;"><?= $tgl ?></td>
				</tr>
				<tr>
					<td width="220px; text-align:center;"></td>
					<td width="100px; text-align:center;">Penerima</td>
				</tr>
				<tr>
					<td width="220px; text-align:center;"></td>
					<td width="100px; text-align:center;"></td>
				</tr>
				<tr>
					<td width="220px; text-align:center;"></td>
					<td width="100px; text-align:center;"></td>
				</tr>
				<tr>
					<td width="220px; text-align:center;"></td>
					<td width="100px; text-align:center;"></td>
				</tr>
				<tr>
					<td width="220px; text-align:center;"></td>
					<td width="100px; text-align:center;"></td>
				</tr>
				<tr>
					<td width="220px; text-align:center;"></td>
					<td width="100px; text-align:center;">(.......................................)</td>
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