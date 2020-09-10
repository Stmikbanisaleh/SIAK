<!-- Button -->
<div class="row">
	<div class="col-xs-1">
		<button href="#my-modal" role="button" data-toggle="modal" class="btn btn-xs btn-info">
			<a class="ace-icon fa fa-plus bigger-120"></a> Tambah Data
		</button>
	</div>
	<div class="col-xs-1">
		<button href="#my-modal2" role="button" data-toggle="modal" class="btn btn-xs btn-success">
			<a class="ace-icon fa fa-upload bigger-120"></a> Import Data
		</button>
	</div>
	<br>
	<br>
</div>

<!-- Modal Import Data -->
<div id="my-modal2" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="smaller lighter blue no-margin">Form Import <?=$page_name ?></h3>
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
									<a href="<?php echo base_url() . 'modulpayroll/biodata_karyawan/karyawan'?>" class="col-sm-3" for="form-field-1"> Download Sample Format</a>
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

<!-- Modal Input Data -->
<div id="my-modal" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="smaller lighter blue no-margin">Form Input <?= $page_name ?></h3>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						<!-- PAGE CONTENT BEGINS -->
						<form class="form-horizontal" role="form" id="formTambah">
							<div class="text-center">
								BIODATA KARYAWAN
							</div>
							<hr>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> NIK KTP</label>
								<div class="col-sm-9">
									<input type="text" id="nik" required name="nik" placeholder="NIK KTP" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> NPWP</label>
								<div class="col-sm-9">
									<input type="text" id="npwp" required name="npwp" placeholder="NPWP" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> NIP Pegawai</label>
								<div class="col-sm-9">
									<input type="text" id="nip" required name="nip" placeholder="NIP Pegawai" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nama </label>
								<div class="col-sm-9">
									<input type="text" id="nama" required name="nama" placeholder="Nama" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Jabatan </label>
								<div class="col-sm-9">
									<select class="form-control" name="jabatan" id="jabatan">
										<option value="">-- Pilih Jabatan --</option>
										<?php foreach ($my_jabatan as $value) { ?>
											<option value=<?= $value['ID'] ?>> <?= $value['NAMAJABATAN']; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Jenis Kelamin </label>
								<div class="col-sm-9">
									<select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
										<option value="">-- Pilih Pengguna --</option>
										<option value="L">Laki-Laki</option>
										<option value="P">Perempuan</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Agama </label>
								<div class="col-sm-9">
									<select class="form-control" name="agama" id="agama">
										<option value="">-- Pilih Agama --</option>
										<?php foreach ($myagama as $value) { ?>
											<option value=<?= $value['KDTBAGAMA'] ?>><?= $value['DESCRTBAGAMA'] ?></option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Email </label>
								<div class="col-sm-9">
									<input type="email" id="email" required name="email" placeholder="Email" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> No. Telp </label>
								<div class="col-sm-9">
									<input type="text" id="telp" required name="telp" placeholder="No. Telp" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Alamat </label>
								<div class="col-sm-9">
									<textarea class="form-control" required name="alamat" id="alamat" placeholder="Alamat"></textarea>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Pendidikan Terakhir </label>
								<div class="col-sm-9">
									<select class="form-control" name="pendidikan_terakhir" id="pendidikan_terakhir">
										<option value="">-- Pilih Pendidikan --</option>
										<?php foreach ($my_pendidikan as $value) { ?>
											<option value=<?= $value['IDMSPENDIDIKAN'] ?>><?= $value['NMMSPENDIDIKAN'] ?></option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tanggal lahir </label>
								<div class="col-sm-9">
									<input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" placeholder="24/10/1995"></textarea>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Status Aktif </label>
								<div class="col-sm-9">
									<select class="form-control" name="status" id="status">
										<option value="">-- Pilih Status --</option>
										<option value="1">Aktif</option>
										<option value="0">Tidak</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tanggal Mulai Kerja </label>
								<div class="col-sm-9">
									<input type="date" class="form-control" name="tgl_mulai" id="tgl_mulai" placeholder="24/10/1995"></textarea>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Unit Kerja </label>
								<div class="col-sm-9">
									<select required class="form-control" name="unit_kerja" id="unit_kerja">
										<option value="">-- Pilih Unit Kerja --</option>
										<?php foreach ($myunit as $value) { ?>
											<option value=<?= $value['id'] ?>><?= $value['deskripsi'] ?></option>
										<?php } ?>
									</select>
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

<!-- Modal Edit Biodata -->
<div id="modalEdit" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="smaller lighter blue no-margin">Form Edit <?= $page_name ?></h3>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						<!-- PAGE CONTENT BEGINS -->
						<form class="form-horizontal" role="form" id="formEdit">
							<form class="form-horizontal" role="form" id="formEdit">
								<div class="text-center">
									BIODATA KARYAWAN
								</div>
								<hr>

								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> NIK KTP</label>
									<div class="col-sm-9">
										<input type="hidden" id="e_id" required name="e_id" />
										<input type="text" id="e_nik" required name="e_nik" placeholder="NIK KTP" class="form-control" />
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> NPWP </label>
									<div class="col-sm-9">
										<input type="text" id="e_npwp" required name="e_npwp" placeholder="NPWP" class="form-control" />
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> NIP Pegawai</label>
									<div class="col-sm-9">
										<input type="text" id="e_nip" required name="e_nip" placeholder="NIP Pegawai" class="form-control" />
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nama </label>
									<div class="col-sm-9">
										<input type="text" id="e_nama" required name="e_nama" placeholder="Nama" class="form-control" />
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Jabatan </label>
									<div class="col-sm-9">
										<select class="form-control" name="e_jabatan" id="e_jabatan">
											<option value="">-- Pilih Jabatan --</option>
											<?php foreach ($my_jabatan as $value) { ?>
												<option value=<?= $value['ID'] ?>> <?= $value['NAMAJABATAN']; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Jenis Kelamin </label>
									<div class="col-sm-9">
										<select class="form-control" name="e_jenis_kelamin" id="e_jenis_kelamin">
											<option value="">-- Pilih Pengguna --</option>
											<option value="L">Laki-Laki</option>
											<option value="P">Perempuan</option>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Agama </label>
									<div class="col-sm-9">
										<select class="form-control" name="e_agama" id="e_agama">
											<option value="">-- Pilih Agama --</option>
											<?php foreach ($myagama as $value) { ?>
												<option value=<?= $value['KDTBAGAMA'] ?>><?= $value['DESCRTBAGAMA'] ?></option>
											<?php } ?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Email </label>
									<div class="col-sm-9">
										<input type="email" id="e_email" required name="e_email" placeholder="Email" class="form-control" />
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> No. Telp </label>
									<div class="col-sm-9">
										<input type="text" id="e_telp" required name="e_telp" placeholder="No. Telp" class="form-control" />
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Alamat </label>
									<div class="col-sm-9">
										<textarea class="form-control" required name="e_alamat" id="e_alamat" placeholder="Alamat"></textarea>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Pendidikan Terakhir </label>
									<div class="col-sm-9">
										<select class="form-control" name="e_pendidikan_terakhir" id="e_pendidikan_terakhir">
											<option value="">-- Pilih Pendidikan --</option>
											<?php foreach ($my_pendidikan as $value) { ?>
												<option value=<?= $value['IDMSPENDIDIKAN'] ?>><?= $value['NMMSPENDIDIKAN'] ?></option>
											<?php } ?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tanggal lahir </label>
									<div class="col-sm-9">
										<input type="date" class="form-control" name="e_tgl_lahir" id="e_tgl_lahir" placeholder="24/10/1995"></textarea>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tanggal Mulai Kerja </label>
									<div class="col-sm-9">
										<input type="date" class="form-control" name="e_tgl_mulai" id="e_tgl_mulai" placeholder="24/10/1995"></textarea>
									</div>
								</div>

								<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Unit Kerja </label>
								<div class="col-sm-9">
									<select required class="form-control" name="e_unit_kerja" id="e_unit_kerja">
										<option value="">-- Pilih Unit Kerja --</option>
										<?php foreach ($myunit as $value) { ?>
											<option value=<?= $value['id'] ?>><?= $value['deskripsi'] ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" id="btn_update" class="btn btn-sm btn-success pull-left">
					<i class="ace-icon fa fa-save"></i>
					Update
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

<!-- Modal Edit Tarif -->
<div id="modalEditTarif" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="smaller lighter blue no-margin">Form Edit Tarif Karyawan</h3>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						<!-- PAGE CONTENT BEGINS -->
						<form class="form-horizontal" role="form" id="formEditTarif">
							<input type="hidden" id="e_niptarif" required name="e_niptarif" />
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Gaji Karyawan </label>
								<div class="col-sm-9">
									<input type="text" id="e_tarif_karyawan" required name="e_tarif_karyawan" placeholder="Rp. 10.0000" class="form-control" />
									<input type="hidden" id="e_tarif_karyawan_v" required name="e_tarif_karyawan_v" />
									<script language="JavaScript">
										var rupiah10 = document.getElementById('e_tarif_karyawan');
										rupiah10.addEventListener('keyup', function(e) {
											rup10 = this.value.replace(/\D/g, '');
											$('#e_tarif_karyawan_v').val(rup10);
											rupiah10.value = formatRupiah10(this.value, 'Rp. ');
										});

										function formatRupiah10(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah10 = split[0].substr(0, sisa),
												ribuan10 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan10) {
												separator = sisa ? '.' : '';
												rupiah10 += separator + ribuan10.join('.');
											}

											rupiah10 = split[1] != undefined ? rupiah10 + ',' + split[1] : rupiah10;
											return prefix == undefined ? rupiah10 : (rupiah10 ? 'Rp. ' + rupiah10 : '');
										}
									</script>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tunjangan Jabatan </label>
								<div class="col-sm-9">
									<input type="text" id="e_tunjangan_jabatan" required name="e_tunjangan_jabatan" placeholder="Rp. 10.000" class="form-control" />
									<input type="hidden" id="e_tunjangan_jabatan_v" required name="e_tunjangan_jabatan_v" />
									<script language="JavaScript">
										var rupiah20 = document.getElementById('e_tunjangan_jabatan');
										rupiah20.addEventListener('keyup', function(e) {
											rup20 = this.value.replace(/\D/g, '');
											$('#e_tunjangan_jabatan_v').val(rup20);
											rupiah20.value = formatRupiah20(this.value, 'Rp. ');
										});

										function formatRupiah20(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah20 = split[0].substr(0, sisa),
												ribuan20 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan20) {
												separator = sisa ? '.' : '';
												rupiah20 += separator + ribuan20.join('.');
											}

											rupiah20 = split[1] != undefined ? rupiah2 + ',' + split[1] : rupiah20;
											return prefix == undefined ? rupiah2 : (rupiah20 ? 'Rp. ' + rupiah20 : '');
										}
									</script>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tunjangan Masa Kerja </label>
								<div class="col-sm-9">
									<input type="text" id="e_tunjangan_masa_kerja" required name="tunjangan_masa_kerja" placeholder="Rp. 10.0000" class="form-control" />
									<input type="hidden" id="e_tunjangan_masa_kerja_v" required name="e_tunjangan_masa_kerja_v" />
									<script language="JavaScript">
										var rupiah30 = document.getElementById('e_tunjangan_masa_kerja');
										rupiah30.addEventListener('keyup', function(e) {
											rup30 = this.value.replace(/\D/g, '');
											$('#e_tunjangan_masa_kerja_v').val(rup30);
											rupiah30.value = formatRupiah30(this.value, 'Rp. ');
										});

										function formatRupiah30(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah30 = split[0].substr(0, sisa),
												ribuan30 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan30) {
												separator = sisa ? '.' : '';
												rupiah30 += separator + ribuan30.join('.');
											}

											rupiah30 = split[1] != undefined ? rupiah30 + ',' + split[1] : rupiah30;
											return prefix == undefined ? rupiah30 : (rupiah30 ? 'Rp. ' + rupiah30 : '');
										}
									</script>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Transport </label>
								<div class="col-sm-9">
									<input type="text" id="e_transport" required name="e_transport" placeholder="Rp. 10.0000" class="form-control" />
									<input type="hidden" id="e_transport_v" required name="e_transport_v" />
									<script language="JavaScript">
										var rupiah40 = document.getElementById('e_transport');
										rupiah40.addEventListener('keyup', function(e) {
											rup40 = this.value.replace(/\D/g, '');
											$('#e_transport_v').val(rup40);
											rupiah40.value = formatRupiah40(this.value, 'Rp. ');
										});

										function formatRupiah40(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah40 = split[0].substr(0, sisa),
												ribuan40 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan40) {
												separator = sisa ? '.' : '';
												rupiah40 += separator + ribuan40.join('.');
											}

											rupiah40 = split[1] != undefined ? rupiah40 + ',' + split[1] : rupiah40;
											return prefix == undefined ? rupiah40 : (rupiah40 ? 'Rp. ' + rupiah40 : '');
										}
									</script>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tunjangan Pegawai Tetap </label>
								<div class="col-sm-9">
									<input type="text" id="e_tunj_pegawai_tetap" required name="e_tunj_pegawai_tetap" placeholder="Rp. 10.0000" class="form-control" />
									<input type="hidden" id="e_tunj_pegawai_tetap_v" required name="e_tunj_pegawai_tetap_v" />
									<script language="JavaScript">
										var e_rupiah5 = document.getElementById('e_tunj_pegawai_tetap');
										e_rupiah5.addEventListener('keyup', function(e) {
											e_rup5 = this.value.replace(/\D/g, '');
											$('#e_tunj_pegawai_tetap_v').val(e_rup5);
											e_rupiah5.value = formatRupiah4(this.value, 'Rp. ');
										});
									</script>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tunjangan BPJS </label>
								<div class="col-sm-9">
									<input type="text" id="e_bpjs" required name="e_bpjs" placeholder="Rp. 10.0000" class="form-control" />
									<input type="hidden" id="e_bpjs_v" required name="e_bpjs_v" />
									<script language="JavaScript">
										var e_rupiah6 = document.getElementById('e_bpjs');
										e_rupiah6.addEventListener('keyup', function(e) {
											e_rup6 = this.value.replace(/\D/g, '');
											$('#e_bpjs_v').val(e_rup6);
											e_rupiah6.value = formatRupiah4(this.value, 'Rp. ');
										});
									</script>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Cara Pembayaran </label>
								<div class="col-sm-9">
									<select class="form-control" name="e_nama_pembayaran" id="e_nama_pembayaran">
										<option value="">-- Pilih Cara Pembayaran --</option>
										<?php foreach ($my_pembayaran as $value) { ?>
											<option value=<?= $value['id'] ?>><?= $value['nama_pembayaran'] ?></option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> No Rekening </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" name="e_no_rekening" id="e_no_rekening" placeholder="No rekening / Akun"></textarea>
									</div>
							</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" id="btn_update" class="btn btn-sm btn-success pull-left">
					<i class="ace-icon fa fa-save"></i>
					Update
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

<div class="row">
	<div class="col-xs-12">
		<div class="table-header">
			Semua Data guru
		</div>
	</div>
</div>
<div class="table-responsive">
	<table id="datatable_tabletools" class="display">
		<thead>
			<tr>
				<th>No</th>
				<th>NIP (Pegawai)</th>
				<th>NIK (KTP)</th>
				<th>Nama</th>
				<th>Email</th>
				<th>No. Telp</th>
				<th>Pendidikan Terakhir</th>
				<th>Alamat</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody id="show_data">
		</tbody>
	</table>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		show_data();
		$('#datatable_tabletools').DataTable();
	});

	//function show all Data
	function show_data() {
		$.ajax({
			type: 'POST',
			url: '<?php echo site_url('modulpayroll/biodata_karyawan/tampil') ?>',
			async: true,
			dataType: 'json',
			success: function(data) {
				var html = '';
				var i = 0;
				var no = 1;
				for (i = 0; i < data.length; i++) {
					html += '<tr>' +
						'<td class="text-center">' + no + '</td>' +
						'<td class="text-center">' + data[i].nip + '</td>' +
						'<td class="text-center">' + data[i].nik + '</td>' +
						'<td>' + data[i].nama + '</td>' +
						'<td>' + data[i].email + '</td>' +
						'<td>' + data[i].no_telp + '</td>' +
						'<td>' + data[i].NMMSPENDIDIKAN + '</td>' +
						'<td>' + data[i].alamat + '</td>' +
						'<td >' +
						'<button  href="#my-modal-edit" class="btn btn-xs btn-info item_edit" title="Edit" data-id="' + data[i].nip + '">' +
						'<i class="ace-icon fa fa-book bigger-120"> Edit Biodata </i>' +
						'</button> ' +
						'<br>' + '<br>' +
						'<button  href="#my-modal-edit" class="btn btn-xs btn-danger item_hapus" title="Hapus" data-id="' + data[i].nip + '">' +
						'<i class="ace-icon fa fa-trash-o bigger-120"> Hapus</i>' +
						'</button> ' +
						'</td>' +
						'</tr>';
					no++;
				}
				$("#datatable_tabletools").dataTable().fnDestroy();
				var a = $('#show_data').html(html);
				//                    $('#mydata').dataTable();
				if (a) {
					$('#datatable_tabletools').dataTable({
						"bPaginate": true,
						"bLengthChange": false,
						"bFilter": true,
						"bInfo": false,
						"bAutoWidth": false
					});
				}
				/* END TABLETOOLS */
			}

		});
	}

	if ($("#formTambah").length > 0) {
		$("#formTambah").validate({
			errorClass: "my-error-class",
			validClass: "my-valid-class",
			submitHandler: function(form) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url('modulpayroll/biodata_karyawan/simpan') ?>",
					dataType: "JSON",
					data: $('#formTambah').serialize(),
					success: function(data) {
						$('#my-modal').modal('hide');
						if (data == 1) {
							document.getElementById("formTambah").reset();
							swalInputSuccess();
							show_data();
						} else if (data == 401) {
							document.getElementById("formTambah").reset();
							swalIdDouble();
						} else {
							document.getElementById("formTambah").reset();
							swalInputFailed();
						}
					}
				});
				return false;
			}
		});
	}

	$('#show_data').on('click', '.item_edit', function() {
		var id = $(this).data('id');
		$('#modalEdit').modal('show');
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('modulpayroll/biodata_karyawan/tampil_byid') ?>",
			async: true,
			dataType: "JSON",
			data: {
				id: id,
			},
			success: function(data) {
				$('#e_id').val(data[0].id_biodata);
				$('#e_unit_kerja').val(data[0].unit_kerja);
				$('#e_nik').val(data[0].nik);
				$('#e_npwp').val(data[0].npwp);
				$('#e_nip').val(data[0].nip);
				$('#e_nama').val(data[0].nama);
				$('#e_jabatan').val(data[0].jabatan);
				$('#e_jenis_kelamin').val(data[0].jenis_kelamin);
				$('#e_agama').val(data[0].agama);
				$('#e_email').val(data[0].email);
				$('#e_telp').val(data[0].no_telp);
				$('#e_alamat').val(data[0].alamat);
				$('#e_pendidikan_terakhir').val(data[0].pendidikan);
				$('#e_tgl_lahir').val(data[0].tgl_lhr);
				$('#e_status').val(data[0].status);
				$('#e_tgl_mulai').val(data[0].tgl_mulai_kerja);
			}
		});
	});

	$('#show_data').on('click', '.item_edit_tarif', function() {
		var id = $(this).data('id');
		$('#modalEditTarif').modal('show');
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('modulpayroll/biodata_karyawan/tampil_byidtarif') ?>",
			async: true,
			dataType: "JSON",
			data: {
				id: id,
			},
			success: function(data) {
				$('#e_niptarif').val(data[0].id_karyawan);
				$('#e_tarif_karyawan').val(data[0].tarif);
				$('#e_tarif_karyawan_v').val(data[0].tarif);
				$('#e_tunjangan_jabatan').val(data[0].tunjangan_jabatan);
				$('#e_tunjangan_jabatan_v').val(data[0].tunjangan_jabatan);
				$('#e_tunjangan_masa_kerja').val(data[0].tunjangan_masakerja);
				$('#e_tunjangan_masa_kerja_v').val(data[0].tunjangan_masakerja);
				$('#e_nama_pembayaran').val(data[0].cara_pembayaran);
				$('#e_no_rekening').val(data[0].no_rekening);
				$('#e_transport').val(data[0].transport);
				$('#e_transport_v').val(data[0].transport);
				$('#e_tunj_pegawai_tetap').val(data[0].tunj_pegawai_tetap);
				$('#e_tunj_pegawai_tetap_v').val(data[0].tunj_pegawai_tetap);
				$('#e_bpjs').val(data[0].bpjs);
				$('#e_bpjs_v').val(data[0].bpjs);


			}
		});
	});

	if ($("#formEditTarif").length > 0) {
        $("#formEditTarif").validate({
            errorClass: "my-error-class",
            validClass: "my-valid-class",
            submitHandler: function(form) {
                $('#btn_edit').html('Sending..');
                $.ajax({
                    url: "<?php echo base_url('modulpayroll/biodata_karyawan/updatetarif') ?>",
                    type: "POST",
                    data: $('#formEditTarif').serialize(),
                    dataType: "json",
                    success: function(response) {
                        $('#btn_edit').html('<i class="ace-icon fa fa-save"></i>' +
                            'Ubah');
                        if (response == true) {
                            document.getElementById("formEditTarif").reset();
                            swalEditSuccess();
                            show_data();
                            $('#modalEditTarif').modal('hide');
                        } else if (response == 401) {
                            swalIdDouble('Kode Tarif Sudah Terdaftar');
                        } else {
                            swalEditFailed();
                        }
                    }
                });
            }
        })
	}

	if ($("#formEdit").length > 0) {
        $("#formEdit").validate({
            errorClass: "my-error-class",
            validClass: "my-valid-class",
            submitHandler: function(form) {
                $('#btn_edit').html('Sending..');
                $.ajax({
                    url: "<?php echo base_url('modulpayroll/biodata_karyawan/updatebiodata') ?>",
                    type: "POST",
                    data: $('#formEdit').serialize(),
                    dataType: "json",
                    success: function(response) {
                        $('#btn_edit').html('<i class="ace-icon fa fa-save"></i>' +
                            'Ubah');
                        if (response == true) {
                            document.getElementById("formEdit").reset();
                            swalEditSuccess();
                            show_data();
                            $('#modalEdit').modal('hide');
                        } else if (response == 401) {
                            swalIdDouble('Kode Tarif Sudah Terdaftar');
                        } else {
                            swalEditFailed();
                        }
                    }
                });
            }
        })
	}
	
	$('#show_data').on('click', '.item_hapus', function() {
		var id = $(this).data('id');
		Swal.fire({
			title: 'Apakah anda yakin?',
			text: "Anda tidak akan dapat mengembalikan ini!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya, Hapus!',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url('modulpayroll/biodata_karyawan/delete') ?>",
					async: true,
					dataType: "JSON",
					data: {
						id: id,
					},
					success: function(data) {
						show_data();
						swalDeleteSuccess();
					}
				});
			}
		})
	});

	if ($("#formImport").length > 0) {
            $("#formImport").validate({
                errorClass: "my-error-class",
                validClass: "my-valid-class",
                submitHandler: function(form) {
                    formdata = new FormData(form);
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url('modulpayroll/biodata_karyawan/import') ?>",
                        data: formdata,
                        processData: false,
                        contentType: false,
                        cache: false,
                        async: false,
                        success: function(data) {
                            console.log(data);
                            if (data == 1 || data == true) {
                                document.getElementById("formImport").reset();
								swalInputSuccess();
								$('#my-modal2').modal('hide');
								
                            } else if (data == 401) {
                                document.getElementById("formImport").reset();
                                swalIdDouble();
                            } else {
                                document.getElementById("formImport").reset();
                                swalInputFailed();
                            }
                        }
                    });
                    return false;
                }
            });
        }
</script>
