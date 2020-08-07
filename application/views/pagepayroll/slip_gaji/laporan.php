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
    /* height:550px; */
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
    /* height:550px; */
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
		$pend_pajak = $row['tunj_pajak'];
		$pend_tunjabatan = $row['tunj_jabatan'];
		$pend_tunjsansos = $row['tunj_sansos'];
		$pend_strukturalkhusus = $row['tunj_struktural_khusus'];
		$pend_transportasi = $row['tunj_transport'];
		$pend_pegawai_tetap = $row['tunj_tetap'];
		$pend_tunj_pembinaan = $row['tunj_pembinaan'];
		$pend_tunj_keluarga = $row['tunj_keluarga'];
		$pend_rapel = $row['rapel'];
		$pend_premi = $row['premi'];
		$pend_peralihan = $row['tunj_peralihan'];
		$pend_utility = $row['tunj_utility'];
		$pend_honorarium = $row['honorarium_imb'];
		$pend_asuransi = $row['asuransi_jamsostek']+$row['asuransi_lainnya'];
        $pend_bonus = $row['bonus'];
        $pend_thr = $row['thr'];
        $pend_cuti = $row['cuti_jubelium'];
		$tunj_bpjs = $row['tunj_bpjs'];
		$tunj_international = $row['tunj_international'];
		$tunj_aksel = $row['tunj_aksel'];
		$tunj_walas = $row['tunj_walas'];
		$tunj_khusus1 = $row['tunj_khusus1'];
		$tunj_khusus2 = $row['tunj_khusus2'];
		$pend_lain = $row['tunj_lain'];
		$jumlah_pend = $pend_gaji_pokok+$pend_pajak+$pend_tunjabatan+$pend_tunjsansos+$pend_strukturalkhusus+$pend_transportasi+$pend_pegawai_tetap+$pend_tunj_pembinaan+$pend_tunj_keluarga+$pend_rapel+$pend_premi+$pend_peralihan+$pend_utility+$pend_honorarium+$pend_asuransi+$pend_bonus+$pend_thr+$pend_cuti+$tunj_bpjs+$pend_lain+$tunj_international+$tunj_aksel+$tunj_walas+$tunj_khusus1+$tunj_khusus2;

		
		$tunj_nilai[1] = $pend_gaji_pokok;
		$tunj_nilai[2] = $pend_pajak;
		$tunj_nilai[3] = $pend_tunjabatan;
		$tunj_nilai[4] = $pend_tunjsansos;
		$tunj_nilai[5] = $pend_strukturalkhusus;
		$tunj_nilai[6] = $pend_transportasi;
		$tunj_nilai[7] = $pend_pegawai_tetap;
		$tunj_nilai[8] = $pend_tunj_pembinaan;
		$tunj_nilai[9] = $pend_tunj_keluarga;
		$tunj_nilai[10] = $pend_rapel;
		$tunj_nilai[11] = $pend_premi;
		$tunj_nilai[12] = $pend_peralihan;
		$tunj_nilai[13] = $pend_utility;
		$tunj_nilai[14] = $pend_honorarium;
		$tunj_nilai[15] = $pend_asuransi;
		$tunj_nilai[16] = $pend_bonus;
		$tunj_nilai[17] = $pend_thr;
		$tunj_nilai[18] = $pend_cuti;
		$tunj_nilai[19] = $tunj_bpjs;
		$tunj_nilai[20] = $tunj_international;
		$tunj_nilai[21] = $tunj_aksel;
		$tunj_nilai[22] = $tunj_walas;
		$tunj_nilai[23] = $tunj_khusus1;
		$tunj_nilai[24] = $tunj_khusus2;
		$tunj_nilai[25] = $pend_lain;

		$label_tunj[1] = 'Honor';
		$label_tunj[2] = 'T. Pajak';
		$label_tunj[3] = 'T. Jabatan';
		$label_tunj[4] = 'Sansos';
		$label_tunj[5] = 'Struktural / Khusus';
		$label_tunj[6] = 'Transportasi';
		$label_tunj[7] = 'T. Tetap';
		$label_tunj[8] = 'T. Pembinaan';
		$label_tunj[9] = 'T. Keluarga';
		$label_tunj[10] = 'Rapel';
		$label_tunj[11] = 'Premi';
		$label_tunj[12] = 'Peralihan';
		$label_tunj[13] = 'Utility';
		$label_tunj[14] = 'Honorarium';
		$label_tunj[15] = 'Asuransi Perusahaan';
		$label_tunj[16] = 'Bonus';
		$label_tunj[17] = 'THR';
		$label_tunj[18] = 'Cuti';
		$label_tunj[19] = 'BPJS';
		$label_tunj[20] = 'T. Internasional';
		$label_tunj[21] = 'T. Aksel';
		$label_tunj[22] = 'Walas';
		if($row['ket_tunj_khusus1'] != 0 || $row['ket_tunj_khusus1'] != '' ||$row['ket_tunj_khusus1'] != '0'){
			$label_tunj[23] = 'Tunj. Khusus ('.$row['ket_tunj_khusus1'].')';
		}else{
			$label_tunj[23] = 'Tunj. Khusus';
		}
		if($row['ket_tunj_khusus2'] != 0 || $row['ket_tunj_khusus2'] != '' ||$row['ket_tunj_khusus2'] != '0'){
			$label_tunj[24] = 'Tunj. Khusus ('.$row['ket_tunj_khusus2'].')';
		}else{
			$label_tunj[24] = 'Tunj. Khusus';
		}
		$label_tunj[25] = 'Lain-lain';

		//Potongan
		$pot_infaq_masjid = $row['pot_infaq_masjid'];
        $pot_anggota_koperasi = $row['pot_anggota_koperasi'];
        $pot_kas_bon = $row['pot_kas_bon'];
        $pot_ijin_telat = $row['pot_ijin_telat'];
        $pot_koperasi = $row['pot_koperasi'];
        $pot_bmt = $row['pot_bmt'];
        $pot_tawun = $row['pot_tawun'];
        $pot_pph21 = $row['pph21_bulanan'];
        $pot_bpjs = $row['pot_bpjs'];
		$pot_ltq = $row['pot_ltq'];
		$pot_pensiun_27 = $row['pot_pensiun_27'];
		$pot_pensiun_32 = $row['pot_pensiun_32'];
		$pot_iuran_pensiun = $row['pot_iuran_pensiun'];
		$pot_iuran_jht = $row['pot_iuran_jht'];
		$pot_inval = $row['pot_inval'];
		$pot_toko = $row['pot_toko'];
		$pot_lain = $row['pot_lain'];
		$jumlah_pot = $pot_infaq_masjid+$pot_anggota_koperasi+$pot_kas_bon+$pot_ijin_telat+$pot_koperasi+$pot_bmt+$pot_tawun+$pot_pph21+$pot_bpjs+$pot_ltq+$pot_pensiun_27+$pot_pensiun_32+$pot_iuran_pensiun+$pot_iuran_jht+$pot_inval+$pot_toko+$pot_lain;
		
		$pot_nilai[1] = $pot_infaq_masjid;
		$pot_nilai[2] = $pot_anggota_koperasi;
		$pot_nilai[3] = $pot_kas_bon;
		$pot_nilai[4] = $pot_ijin_telat;
		$pot_nilai[5] = $pot_koperasi;
		$pot_nilai[6] = $pot_bmt;
		$pot_nilai[7] = $pot_tawun;
		$pot_nilai[8] = $pot_pph21;
		$pot_nilai[9] = $pot_bpjs;
		$pot_nilai[10] = $pot_ltq;
		if($pot_pensiun_27 != 0 || $pot_pensiun_27 != '' || $pot_pensiun_27 != '0'){
			$pot_nilai[11] = $pot_pensiun_27;
		}else{
			$pot_nilai[11] = $pot_pensiun_27;
		}
		$pot_nilai[12] = $pot_iuran_pensiun;
		$pot_nilai[13] = $pot_iuran_jht;
		$pot_nilai[14] = $pot_inval;
		$pot_nilai[15] = $pot_toko;
		$pot_nilai[16] = $pot_lain;

		$label_pot[1] = 'Infaq Masjid';
		$label_pot[2] = 'Anggota Koperasi';
		$label_pot[3] = 'Kasbon';
		$label_pot[4] = 'Izin / Telat';
		$label_pot[5] = 'Koperasi';
		$label_pot[6] = 'BMT';
		$label_pot[7] = 'Taawun';
		$label_pot[8] = 'PPh21';
		$label_pot[9] = 'BPJS';
		$label_pot[10] = 'LTQ';
		$label_pot[11] = 'Pot. Pensiun 27 /32';
		$label_pot[12] = 'Iuran Pensiun';
		$label_pot[13] = 'Iuran JHT';
		$label_pot[14] = 'Inval';
		$label_pot[15] = 'Toko Al-Hamra';
		$label_pot[16] = 'Lain-lain';


		$total = $jumlah_pend-$jumlah_pot;

		$cek_row_tunj = 0;
		for($a = 1; $a<= 25; $a++){
			if($tunj_nilai[$a] > 0){
				$cek_row_tunj++;
			}
		}

		$cek_row_pot = 0;
		for($b=1; $b <= 16; $b++){
			if($pot_nilai[$b] > 0){
				$cek_row_pot++;
			}
		}

		$array_data_sliptemp = array();
		if($cek_row_tunj>=$cek_row_pot){//Masuk kondisi baris tunjangan lebih banyak dari potongan

			$seq = 1;
			for($a = 1; $a<= 25; $a++){ //Looping sejumlah elemen tunjangan
				if($tunj_nilai[$a] > 0){ // Jika terdapat tunjangan dengan nilai lebih dari 0
					$data_temp = array(
						'label_tunj' 	=> $label_tunj[$a],
						'tunj_nilai' 	=> (int)$tunj_nilai[$a],
						'label_pot' 	=> '',
						'pot_nilai' 	=> ''
					);
	
					for($b=$seq; $b <= 16; $b++){ //looping sejumlah element potongan
						if($pot_nilai[$b] > 0){ //jika terdapat potongan dengan nilai lebih dari 0
							$data_temp = array(
								'label_tunj' 	=> $label_tunj[$a],
								'tunj_nilai' 	=> (int)$tunj_nilai[$a],
								'label_pot' 	=> $label_pot[$b],
								'pot_nilai' 	=> (int)$pot_nilai[$b]
							);
							$seq = $b+1;
							$b = 16;
						}
					}
					array_push($array_data_sliptemp, $data_temp);
				}
			}
		}else{
			$seq = 1;
			for($b = 1; $b<= 16; $b++){ //looping sejumlah element potongan
				if($pot_nilai[$b] > 0){ //jika terdapat potongan dengan nilai lebih dari 0
					$data_temp = array(
						'label_tunj' 	=> '',
						'tunj_nilai' 	=> '',
						'label_pot' 	=> $label_pot[$b],
						'pot_nilai' 	=> (int)$pot_nilai[$b]
					);
	
					for($a=$seq; $a <= 25; $a++){ //Looping sejumlah elemen tunjangan
						if($tunj_nilai[$a] > 0){ // Jika terdapat tunjangan dengan nilai lebih dari 0
							$data_temp = array(
								'label_tunj' 	=> $label_tunj[$a],
								'tunj_nilai' 	=> (int)$tunj_nilai[$a],
								'label_pot' 	=> $label_pot[$b],
								'pot_nilai' 	=> (int)$pot_nilai[$b]
							);
							$seq = $a+1;
							$a = 25;
						}
					}
					array_push($array_data_sliptemp, $data_temp);
				}
			}
		}
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
						foreach($array_data_sliptemp as $rows){
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
						<td width="165px;" style="text-align:right" colspan=""><?= number_format($jumlah_pot) ?></td>
					</tr>
			</table>
			<hr style="margin-top:1px;"></hr>
			<table>
					<tr>
						<td width="125px;">Gaji bersih</td>
						<td width="141px;"> </td>
						<td width="68px;" style="text-align:right">Rp_ <?php echo number_format($jumlah_pend-$jumlah_pot) ?></td>
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