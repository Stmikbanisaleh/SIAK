<div class="row">
	<form class="form-horizontal" role="form" id="formSearch">
		<div class="col-xs-3">
			<select class="form-control tahun" name="tahun" id="tahun">
				<option value="0">--Pilih Tahun--</option>
				<?php foreach ($mytahun as $value) { ?>
					<option value=<?= $value['tahun'] ?>><?= $value['tahun'] ?></option>
				<?php } ?>
			</select>
		</div>
		<td>
			<div class="col-xs-3">
				<select class="form-control" name="nopembayaran" id="nopembayaran">
					<option value="0">--Pilih Program--</option>
				</select>
			</div>
			<div class="col-xs-1">
				<button type="submit" id="btn_search" name="btn_search" class="btn btn-sm btn-success pull-left">
					<a class="ace-icon fa fa-search bigger-120"></a>Periksa
				</button>
			</div>
			<br>
			<br>
		</form>
	</div>
	<div id="my-modal2" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 class="smaller lighter blue no-margin">Form Import Data Jenis Pengeluaran</h3>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12">
							<!-- PAGE CONTENT BEGINS -->
							<form class="form-horizontal" role="form" enctype="multipart/form-data" id="formImport">
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Import Excel FIle </label>
									<div class="col-sm-6">
										<input type="file" id="file" required name="file" class="form-control" />
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Sample </label>
									<div class="col-sm-9">
										<a label class="col-sm-3" for="form-field-1"> Download Sample Format </label></a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" id="btn_import" class="btn btn-sm btn-success pull-left">
							<i class="ace-icon fa fa-save"></i>
							Simpan
						</button>
						<button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
							<i class="ace-icon fa fa-times"></i>
							Batal
						</button>
					</div>
				</form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>

	<div id="my-modal" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 class="smaller lighter blue no-margin">Form Input Data Jenis Pengeluaran</h3>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12">
							<!-- PAGE CONTENT BEGINS -->
							<form class="form-horizontal" role="form" id="formTambah">
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Jenis Transaksi </label>
									<div class="col-sm-6">
										<input type="text" id="JnsTransaksi" required name="JnsTransaksi" placeholder="Jenis Transaksi" class="form-control" />
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Rekening </label>
									<div class="col-sm-9">
										<select class="form-control" name="no_jurnal" id="pendidikan_terakhir">
											<option value="">-- Pilih --</option>
											<?php foreach ($myjurnal as $value) { ?>
												<option value=<?= $value['no_jurnal'] ?>><?= $value['kode_jurnal'] . " - " . $value['nama_jurnal'] ?></option>
											<?php } ?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nama Transaksi </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" name="NamaTransaksi" id="NamaTransaksi" placeholder="Nama Transaksi" />
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" id="btn_simpan" class="btn btn-sm btn-success pull-left">
							<i class="ace-icon fa fa-save"></i>
							Simpan
						</button>
						<button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
							<i class="ace-icon fa fa-times"></i>
							Batal
						</button>
					</div>
				</form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>
	<br>
	<div class="row">
		<table class="table table-bordered table-hover table-striped  w-full" cellspacing="0">
			<thead>
				<tr>
					<th>Kode Rekening</th>
					<th>Nama Rekening</th>
					<th>Uraian</th>
					<th>D/K</th>
					<th>Nilai</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if (empty($this->input->get('tahun'))) {
					$sql = "";
				} else {
					$sql = "SELECT
					jurnal.kode_jurnal,
					jurnal.nama_jurnal,
					parameter.id
					FROM
					parameter
					INNER JOIN jurnal ON parameter.no_jurnal = jurnal.no_jurnal";
				}
				// $hasil = mysql_query($sql);
				$hasil = $this->db->query($sql)->result_array();
				$no = 1;
				// while ($r = mysql_fetch_array($hasil)) {
				foreach($hasil as $r){
					$no_bukti = $this->input->get('nopembayaran');
					$query = "SELECT 
					pembayaran_sekolah.Nopembayaran,
					pembayaran_sekolah.NIS,
					pembayaran_sekolah.Noreg,
					pembayaran_sekolah.Kelas,
					pembayaran_sekolah.tglentri,
					pembayaran_sekolah.useridd,
					pembayaran_sekolah.TotalBayar,
					pembayaran_sekolah.kodesekolah,
					pembayaran_sekolah.TA
					FROM pembayaran_sekolah WHERE Nopembayaran='$no_bukti'";

					// $assistant = mysql_query($query);
					// $num_assistant = mysql_num_rows($assistant);
					// for ($i = 0; $i < $num_assistant; $i++) {
					// 	$row = mysql_fetch_object($assistant);
					$row = $this->db->query($query)->row();
					if($row!=null){
						$v_pem = $row->Nopembayaran;
						$v_tglentri = $row->tglentri;
						$v_TotalBayar = $row->TotalBayar;
					}else{
						$v_pem = '';
						$v_tglentri = '';
						$v_TotalBayar = 0;
					}
					// print_r(json_encode($row));exit;
					// }

					$query = "SELECT COUNT(*)AS n,urai FROM akuntansi WHERE bukti='$no_bukti'";
					// $assistant = mysql_query($query);
					// $num_assistant = mysql_num_rows($assistant);
					// for ($i = 0; $i < $num_assistant; $i++) {
					// 	$row = mysql_fetch_object($assistant);
					$row = $this->db->query($query)->row();
					if($row!=null){
						$v_Status = $row->n;
					}else{
						$v_Status = 0;
					}
					// }

					$query = "SELECT detail_akuntansi.urai FROM detail_akuntansi WHERE no_akuntansi='$no_bukti' AND dk='D'";
					// $assistant = mysql_query($query);
					// $num_assistant = mysql_num_rows($assistant);
					// for ($i = 0; $i < $num_assistant; $i++) {
					// 	$row = mysql_fetch_object($assistant);
					$row = $this->db->query($query)->row();
					if($row!=null){
						$v_urai = $row->urai;
					}else{
						$v_urai = '';
					}
					// }

					$query = "SELECT DISTINCT detail_akuntansi.urai FROM detail_akuntansi WHERE no_akuntansi='$no_bukti' AND dk='K'";
					// $assistant = mysql_query($query);
					// $num_assistant = mysql_num_rows($assistant);
					// for ($i = 0; $i < $num_assistant; $i++) {
					// 	$row = mysql_fetch_object($assistant);
					$row = $this->db->query($query)->row();
					if($row!=null){
						$v_urai1 = $row->urai;
					}else{
						$v_urai1 = '';
					}
					// }


					?>
					<tr class="gradeA">
						<td><?= $r['kode_jurnal'] ?></td>
						<td><?= $r['nama_jurnal'] ?></td>
						<td><input name="uraian<?= $no ?>" id="uraian<?= $no ?>" type="text" value="<?= $v_urai ?>" required></td>
						<td>D</td>
						<td><input name="nilai<?= $no ?>" id="nilai<?= $no ?>" type="number" value="<?= $v_TotalBayar ?>" readonly required></td>
					</tr>
					<tr class="gradeA">
						<td><?php

						$sql1 = "SELECT
								jurnal.kode_jurnal,
								jurnal.nama_jurnal,
								(SELECT z.NAMA_REV FROM msrev z WHERE z.KETERANGAN=jurnal.JR AND z.`STATUS`=7) AS JR,
								(SELECT z.NAMA_REV FROM msrev z WHERE z.KETERANGAN=jurnal.type AND z.`STATUS`=8) AS type,
								jenispembayaran.Kodejnsbayar,
								jenispembayaran.namajenisbayar,
								detail_bayar_sekolah.nominalbayar,
								pembayaran_sekolah.tglentri,
								pembayaran_sekolah.NIS,
								pembayaran_sekolah.Noreg,
								sekolah.NamaSek,
								sekolah.KodeSek,
								jurusan_smk.NamaJurusan,
								pembayaran_sekolah.Nopembayaran,
								detail_bayar_sekolah.NodetailBayar,
								siswa.Namacasis
								FROM
								pembayaran_sekolah
								INNER JOIN detail_bayar_sekolah ON pembayaran_sekolah.Nopembayaran = detail_bayar_sekolah.Nopembayaran
								INNER JOIN jenispembayaran ON detail_bayar_sekolah.kodejnsbayar = jenispembayaran.Kodejnsbayar
								INNER JOIN jurnal ON jenispembayaran.no_jurnal = jurnal.no_jurnal
								INNER JOIN sekolah ON pembayaran_sekolah.kodesekolah = sekolah.KodeSek
								INNER JOIN jurusan_smk ON sekolah.Jurusan = jurusan_smk.Kodejurusan
								INNER JOIN siswa ON pembayaran_sekolah.Noreg = siswa.Noreg
								WHERE pembayaran_sekolah.Nopembayaran='$no_bukti'
								ORDER BY pembayaran_sekolah.Nopembayaran";
						$r1 = $this->db->query($sql)->row();
						// $hasil1 = mysql_query($sql1);
						// while ($r1 = mysql_fetch_array($hasil1)) {
						if($r1!=null){
							echo $r1->kode_jurnal . "<br>";
						}else{
							echo "<br>";
						}
						// }
						?></td>
						<td><?php
						$sql1 = "SELECT
						jurnal.kode_jurnal,
						jurnal.nama_jurnal,
						(SELECT z.NAMA_REV FROM msrev z WHERE z.KETERANGAN=jurnal.JR AND z.`STATUS`=7) AS JR,
						(SELECT z.NAMA_REV FROM msrev z WHERE z.KETERANGAN=jurnal.type AND z.`STATUS`=8) AS type,
						jenispembayaran.Kodejnsbayar,
						jenispembayaran.namajenisbayar,
						detail_bayar_sekolah.nominalbayar,
						pembayaran_sekolah.tglentri,
						pembayaran_sekolah.NIS,
						pembayaran_sekolah.Noreg,
						sekolah.NamaSek,
						sekolah.KodeSek,
						jurusan_smk.NamaJurusan,
						pembayaran_sekolah.Nopembayaran,
						detail_bayar_sekolah.NodetailBayar,
						siswa.Namacasis
						FROM
						pembayaran_sekolah
						INNER JOIN detail_bayar_sekolah ON pembayaran_sekolah.Nopembayaran = detail_bayar_sekolah.Nopembayaran
						INNER JOIN jenispembayaran ON detail_bayar_sekolah.kodejnsbayar = jenispembayaran.Kodejnsbayar
						INNER JOIN jurnal ON jenispembayaran.no_jurnal = jurnal.no_jurnal
						INNER JOIN sekolah ON pembayaran_sekolah.kodesekolah = sekolah.KodeSek
						INNER JOIN jurusan_smk ON sekolah.Jurusan = jurusan_smk.Kodejurusan
						INNER JOIN siswa ON pembayaran_sekolah.Noreg = siswa.Noreg
						WHERE pembayaran_sekolah.Nopembayaran='$no_bukti'
						ORDER BY pembayaran_sekolah.Nopembayaran";
						// $hasil1 = mysql_query($sql1);
						// while ($r1 = mysql_fetch_array($hasil1)) {
						$r1 = $this->db->query($sql)->row();
						if($r1!=null){
							echo $r1->nama_jurnal. "<br>";
						}else{
							echo "<br>";
						}
						// }
						?></td>
						<td><input name="uraian_2<?= $no ?>" id="uraian_2<?= $no ?>" type="text" value="<?= $v_urai1 ?>" required></td>
						<td>K</td>
						<td><input name="nilai_2<?= $no ?>" id="nilai_2<?= $no ?>" type="number" value="<?= $v_TotalBayar ?>" readonly required></td>
					</tr>
					<tr>
						<td colspan="5" align="right">
							<input name="kod<?= $no ?>" id="kod<?= $no ?>" type="hidden" value="<?= $r['kode_jurnal'] ?>">
							<input name="nopem<?= $no ?>" id="nopem<?= $no ?>" type="hidden" value="<?= $v_pem ?>">
							<input name="tgl<?= $no ?>" id="tgl<?= $no ?>" type="hidden" value="<?= $v_tglentri ?>">
							<?php if ($v_Status == 1) { ?>
								<input name="kdo<?= $no ?>" id="kdo<?= $no ?>" type="hidden" value="2">
								<button class="btn btn-danger" type="submit" name="simpan1<?= $no ?>" id="simpan1<?= $no ?>" onClick="if(!(checkButton(this.value))) return false;">Batal</button>
								<div id="tampilkandatanya1<?= $no ?>">
								<?php } else { ?>
									<input name="kdo<?= $no ?>" id="kdo<?= $no ?>" type="hidden" value="1">
									<button class="btn btn-primary" type="submit" name="simpan1<?= $no ?>" id="simpan1<?= $no ?>" onClick="if(!(checkButton(this.value))) return false;">Simpan</button>
									<div id="tampilkandatanya1<?= $no ?>">
									<?php } ?>
								</td>
							</tr>
							<script language="javascript">
								var htmlobjek;
								$(document).ready(function() {
									$("#simpan1<?= $no; ?>").click(function() {
										var nopem = $("#nopem<?= $no; ?>").val();
										var tgl = $("#tgl<?= $no; ?>").val();
										var uraian = $("#uraian<?= $no; ?>").val();
										var uraian_2 = $("#uraian_2<?= $no; ?>").val();
										var nilai = $("#nilai<?= $no; ?>").val();
										var nilai_2 = $("#nilai_2<?= $no; ?>").val();
										var kdo = $("#kdo<?= $no; ?>").val();
										var kod = $("#kod<?= $no; ?>").val();
										$("#simpan1<?= $no; ?>").hide();
										$.ajax({
											type: "POST",
											url: "modul/aksi_POSI.php",
											data: "nopem=" + nopem + "&tgl=" + tgl + "&nilai=" + nilai + "&kdo=" + kdo + "&kod=" + kod + "&nilai_2=" + nilai_2 + "&uraian=" + uraian + "&uraian_2=" + uraian_2,
											cache: false,
											success: function(data) {
												$("#simpan1<?= $no; ?>").hide();
												$("#tampilkandatanya1<?= $no; ?>").html(data);
											}
										});
										return false;
									});
								});
							</script>
							<?php
							$no++;
						}
						?>
					</tbody>
				</table>
			</div>

			<script type="text/javascript">
				$(document).ready(function() {
		// show_data();
		$('#datatable_tabletools').DataTable();
		$("#tahun").change(function() {
			var tahun = $('#tahun').val();
			$.ajax({
				type: "POST",
				url: "trx_jurnal/show_nopem",
				data: {
					tahun: tahun
				}
			}).done(function(data) {
				$("#nopembayaran").html(data);
			});
		});

		$("#simpan1").click(function() {
			var nopem = $("#nopem").val();
			var uraian = $("#urai1").val();
			var uraian_2 = $("#urai2").val();
			var nilai = $("#nilai").val();
			var nilai_2 = $("#nilai2").val();
			var kdo = $("#kdo").val();
			var kod = $("#kod").val();
			$("#simpan1").hide();
			$.ajax({
				type: "POST",
				url: '<?php echo site_url('modulakunting/trx_jurnal/simpanjurnal') ?>',
				data: "nopem=" + nopem + "&nilai=" + nilai + "&kdo=" + kdo + "&kod=" + kod + "&nilai_2=" + nilai_2 + "&uraian=" + uraian + "&uraian_2=" + uraian_2,
				cache: false,
				success: function(data) {
					$("#simpan1").hide();
					$("#tampilkandatanya1").html(data);
				}
			});
			return false;
		});

	});
</script>