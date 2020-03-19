<html>
<head>
	
</head>
<body>
	<table style="margin-top: 4cm; margin-left: 2cm; margin-right: 2cm; margin-bottom: 3cm; font-size: 14px; spacing: 1.5cm; line-height: 20px; font-family: 'Times New Roman', Times, serif;">
		<tr style="height: 1.5cm">
			<td colspan="20" style="text-align: right;">Rajeg, <?= $tgl ?></td>
		</tr>
		<tr>
			<td style="width: 50px;">Nomor</td>
			<td>:</td>
		</tr>
		<tr style="height: 1.5cm">
			<td style="width: 50px;">Lampiran</td>
			<td>: &nbsp;-</td>
		</tr>
		<tr>
			<td style="width: 50px;">Perihal</td>
			<td colspan="19">: &nbsp;Teguran Pembayaran Administrasi Sekolah</td>
		</tr>
		<tr style="padding-top: 20px;">
			<td colspan="3">
				<br>
				<br>
				Kepada Yth,
			</td>
		</tr>
		<tr>
			<td colspan="20">
				Bapak/Ibu Orang Tua / Wali Murid
			</td>
		</tr>
		<tr>
			<td>Dari</td>
		</tr>
		<tr>
			<td style="text-indent: 15px;"><b>Nama</b></td>
			<td colspan="19">&nbsp; : &nbsp;<b><?= $mydata->nmsiswa ?></b></td>
		</tr>
		<tr>
			<td style="text-indent: 15px;"><b>Kelas</b></td>
			<td>&nbsp; : &nbsp;<b><?= $mydata->kelas ?></b></td>
		</tr>
		<tr>
			<td colspan="20"><?= $mydata->NamaSek ?> Mutiara Insan Nusantara</td>
		</tr>
		<tr>
			<td colspan="20">Ditempat</td>
		</tr>
		<tr>
			<td colspan="20"><br><br>Dengan hormat,</td>
		</tr>
		<tr>
			<td colspan="20" style="text-align: justify;">
			Sehubung dengan telah berakhirnya Tahun Ajaran 2018/2019, dan untuk kelangsungan proses Kegiatan Belajar Mengajar (KBM) Tahun Ajaran Baru 2019/2020. Bersama dengan surat ini, kami informasikan kepada Bapak/Ibu Orang Tua/ Wali Murid, berkenaan dengan kewajiban administrasi yang harus diselesaikan adalah sebagai berikut:</td>
		</tr>
		<tr>
			<br><br><br>
			<td colspan="15" style="font-size: 16px; text-align: center;"><b>Sisa Tagihan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Rp <?= number_format($mydata->sisa, 0, ',', '.') ?></b></td><br>
			<br><br>
		</tr>
		<tr>
			<td colspan="20">Demikian Informasi yang dapat kami sampaikan, dan diharapkan kerjasamanya.</td>
		</tr>
		<tr>
			<td colspan="12"><br><br><br><br></td>
			<td colspan="8" style="text-align: center;">Tanggerang, <?= $tgl ?></td>
		</tr>
		<tr>
			<td colspan="12"></td>
			<td colspan="8" style="text-align: center; padding-top: -50px">Bendahara Yayasan</td>
		</tr>
		<tr>
			<td colspan="12"></td>
			<td colspan="8" style="text-align: center;"><br><br><br><b>Novi Dwi Hartati, SE.,MM</b></td>
		</tr>
	</table>
</body>
</html>