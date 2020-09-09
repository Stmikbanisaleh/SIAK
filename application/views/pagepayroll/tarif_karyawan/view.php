<!-- Button -->
<div class="row">
	<div class="col-xs-1">
		<button href="#my-modal" role="button" data-toggle="modal" class="btn btn-xs btn-info">
			<a class="ace-icon fa fa-plus bigger-120"></a> Tambah Data
		</button>
	</div>
	<br>
	<br>
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
							<div class="text-center"> TARIF KARYAWAN </div>
							<hr>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Karyawan </label>
								<div class="col-sm-9">
									<select class="form-control" required name="karyawan" id="karyawan">
										<option value="">-- Pilih karyawan --</option>
										<?php foreach ($my_karyawan as $value) { ?>
											<option value=<?= $value['nip'] ?>><?php echo "[" . $value['nip'] . "] - " . $value['nama'] ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group">
                                <!-- <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Honor Berkala </label> -->
                                
								<div class="col-sm-9">
									<input type="hidden" id="tarif_karyawan" required name="tarif_karyawan" placeholder="Rp. 10.0000" class="form-control" />
									<input type="hidden" id="tarif_karyawan_v" required name="tarif_karyawan_v" />
									<script language="JavaScript">
										var rupiah1 = document.getElementById('tarif_karyawan');
										rupiah1.addEventListener('keyup', function(e) {
											rup1 = this.value.replace(/\D/g, '');
											$('#tarif_karyawan_v').val(rup1);
											rupiah1.value = formatRupiah1(this.value, 'Rp. ');
										});

										function formatRupiah1(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah1 = split[0].substr(0, sisa),
												ribuan1 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan1) {
												separator = sisa ? '.' : '';
												rupiah1 += separator + ribuan1.join('.');
											}

											rupiah1 = split[1] != undefined ? rupiah1 + ',' + split[1] : rupiah1;
											return prefix == undefined ? rupiah1 : (rupiah1 ? 'Rp. ' + rupiah1 : '');
										}
									</script>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tunjangan Jabatan </label>
								<div class="col-sm-9">
									<input type="text" id="tunjangan_jabatan" required name="tunjangan_jabatan" placeholder="Rp. 10.000" class="form-control" />
									<input type="hidden" id="tunjangan_jabatan_v" required name="tunjangan_jabatan_v" />
									<script language="JavaScript">
										var rupiah2 = document.getElementById('tunjangan_jabatan');
										rupiah2.addEventListener('keyup', function(e) {
											rup2 = this.value.replace(/\D/g, '');
											$('#tunjangan_jabatan_v').val(rup2);
											rupiah2.value = formatRupiah2(this.value, 'Rp. ');
										});

										function formatRupiah2(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah2 = split[0].substr(0, sisa),
												ribuan2 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan2) {
												separator = sisa ? '.' : '';
												rupiah2 += separator + ribuan2.join('.');
											}

											rupiah2 = split[1] != undefined ? rupiah2 + ',' + split[1] : rupiah2;
											return prefix == undefined ? rupiah2 : (rupiah2 ? 'Rp. ' + rupiah2 : '');
										}
									</script>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tunjangan Masa Kerja (convert) </label>
								<div class="col-sm-9">
									<input type="text" id="convert" required name="convert" placeholder="Rp. 10.000" class="form-control" />
									<input type="hidden" id="convert_v" required name="convert_v" />
									<script language="JavaScript">
										var rupiah99 = document.getElementById('convert');
										rupiah99.addEventListener('keyup', function(e) {
											rup99 = this.value.replace(/\D/g, '');
											$('#convert_v').val(rup99);
											rupiah99.value = formatRupiah2(this.value, 'Rp. ');
										});

										function formatRupiah2(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah99 = split[0].substr(0, sisa),
												ribuan99 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan99) {
												separator = sisa ? '.' : '';
												rupiah99 += separator + ribuan99.join('.');
											}

											rupiah99 = split[1] != undefined ? rupiah99 + ',' + split[1] : rupiah99;
											return prefix == undefined ? rupiah99 : (rupiah99 ? 'Rp. ' + rupiah99 : '');
										}
									</script>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Transport </label>
								<div class="col-sm-9">
									<input type="text" id="transport" required name="transport" placeholder="Rp. 10.0000" class="form-control" />
									<input type="hidden" id="transport_v" required name="transport_v" />
									<script language="JavaScript">
										var rupiah4 = document.getElementById('transport');
										rupiah4.addEventListener('keyup', function(e) {
											rup4 = this.value.replace(/\D/g, '');
											$('#transport_v').val(rup4);
											rupiah4.value = formatRupiah4(this.value, 'Rp. ');
										});

										function formatRupiah4(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah4 = split[0].substr(0, sisa),
												ribuan4 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan4) {
												separator = sisa ? '.' : '';
												rupiah4 += separator + ribuan4.join('.');
											}

											rupiah4 = split[1] != undefined ? rupiah4 + ',' + split[1] : rupiah4;
											return prefix == undefined ? rupiah4 : (rupiah4 ? 'Rp. ' + rupiah4 : '');
										}
									</script>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tunjangan Pegawai Tetap </label>
								<div class="col-sm-9">
									<input type="text" id="tunj_pegawai_tetap" required name="tunj_pegawai_tetap" placeholder="Rp. 10.0000" class="form-control" />
									<input type="hidden" id="tunj_pegawai_tetap_v" required name="tunj_pegawai_tetap_v" />
									<script language="JavaScript">
										var rupiah5 = document.getElementById('tunj_pegawai_tetap');
										rupiah5.addEventListener('keyup', function(e) {
											rup5 = this.value.replace(/\D/g, '');
											$('#tunj_pegawai_tetap_v').val(rup5);
											rupiah5.value = formatRupiah4(this.value, 'Rp. ');

											function formatRupiah4(angka, prefix) {
												var number_string = angka.replace(/[^,\d]/g, '').toString(),
													split = number_string.split(','),
													sisa = split[0].length % 3,
													rupiah4 = split[0].substr(0, sisa),
													ribuan4 = split[0].substr(sisa).match(/\d{3}/gi);

												// tambahkan titik jika yang di input sudah menjadi angka ribuan
												if (ribuan4) {
													separator = sisa ? '.' : '';
													rupiah4 += separator + ribuan4.join('.');
												}

												rupiah4 = split[1] != undefined ? rupiah4 + ',' + split[1] : rupiah4;
												return prefix == undefined ? rupiah4 : (rupiah4 ? 'Rp. ' + rupiah4 : '');
											}
										});
									</script>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tunjangan Keluarga </label>
								<div class="col-sm-9">
									<input type="text" id="tunj_keluarga" required name="tunj_keluarga" placeholder="Rp. 10.0000" class="form-control" />
									<input type="hidden" id="tunj_keluarga_v" required name="tunj_keluarga_v" />
									<script language="JavaScript">
										var rupiah7 = document.getElementById('tunj_keluarga');
										rupiah7.addEventListener('keyup', function(e) {
											rup7 = this.value.replace(/\D/g, '');
											$('#tunj_keluarga_v').val(rup7);
											rupiah7.value = formatRupiah4(this.value, 'Rp. ');

											function formatRupiah4(angka, prefix) {
												var number_string = angka.replace(/[^,\d]/g, '').toString(),
													split = number_string.split(','),
													sisa = split[0].length % 3,
													rupiah4 = split[0].substr(0, sisa),
													ribuan4 = split[0].substr(sisa).match(/\d{3}/gi);

												// tambahkan titik jika yang di input sudah menjadi angka ribuan
												if (ribuan4) {
													separator = sisa ? '.' : '';
													rupiah4 += separator + ribuan4.join('.');
												}

												rupiah4 = split[1] != undefined ? rupiah4 + ',' + split[1] : rupiah4;
												return prefix == undefined ? rupiah4 : (rupiah4 ? 'Rp. ' + rupiah4 : '');
											}
										});
									</script>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tunjangan Pembinaan </label>
								<div class="col-sm-9">
									<input type="text" id="tunj_pembinaan" required name="tunj_pembinaan" placeholder="Rp. 10.0000" class="form-control" />
									<input type="hidden" id="tunj_pembinaan_v" required name="tunj_pembinaan_v" />
									<script language="JavaScript">
										var rupiah8 = document.getElementById('tunj_pembinaan');
										rupiah8.addEventListener('keyup', function(e) {
											rup8 = this.value.replace(/\D/g, '');
											$('#tunj_pembinaan_v').val(rup8);
											rupiah8.value = formatRupiah49(this.value, 'Rp. ');

											function formatRupiah49(angka, prefix) {
												var number_string = angka.replace(/[^,\d]/g, '').toString(),
													split = number_string.split(','),
													sisa = split[0].length % 3,
													rupiah8 = split[0].substr(0, sisa),
													ribuan8 = split[0].substr(sisa).match(/\d{3}/gi);

												// tambahkan titik jika yang di input sudah menjadi angka ribuan
												if (ribuan8) {
													separator = sisa ? '.' : '';
													rupiah8 += separator + ribuan8.join('.');
												}

												rupiah8 = split[1] != undefined ? rupiah8 + ',' + split[1] : rupiah8;
												return prefix == undefined ? rupiah8 : (rupiah8 ? 'Rp. ' + rupiah8 : '');
											}
										});
									</script>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tunjangan BPJS </label>
								<div class="col-sm-9">
									<input type="text" id="bpjs" required name="bpjs" placeholder="Rp. 10.0000" class="form-control" />
									<input type="hidden" id="bpjs_v" required name="bpjs_v" />
									<script language="JavaScript">
										var rupiah6 = document.getElementById('bpjs');
										rupiah6.addEventListener('keyup', function(e) {
											rup6 = this.value.replace(/\D/g, '');
											$('#bpjs_v').val(rup6);
											rupiah6.value = formatRupiah4(this.value, 'Rp. ');
										});
									</script>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Cara Pembayaran </label>
								<div class="col-sm-9">
									<select class="form-control" name="nama_pembayaran" id="nama_pembayaran">
										<option value="">-- Pilih Cara Pembayaran --</option>
										<?php foreach ($my_pembayaran as $value) { ?>
											<option value=<?= $value['id'] ?>><?= $value['nama_pembayaran'] ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> No Rekening / Akun </label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="no_rekening" id="no_rekening" placeholder="No Rekening / Akun"></textarea>
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

							<input type="hidden" id="e_id" required name="e_id" />
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Karyawan </label>
								<div class="col-sm-9">
									<select class="form-control" required name="e_karyawan" id="e_karyawan">
										<option value="">-- Pilih karyawan --</option>
										<?php foreach ($my_karyawan as $value) { ?>
											<option value=<?= $value['nip'] ?>><?php echo "[" . $value['nip'] . "] - " . $value['nama'] ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<!-- <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Honor Berkala </label> -->
								<div class="col-sm-9">
									<input type="hidden" id="e_tarif_karyawan" required name="e_tarif_karyawan" placeholder="Rp. 10.0000" class="form-control" />
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
								<!-- </div>
							</div> -->

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tunjangan Masa Kerja (convert) </label>
								<div class="col-sm-9">
									<input type="text" id="e_convert" required name="e_convert" placeholder="Rp. 10.0000" class="form-control" />
									<input type="hidden" id="e_convert_v" required name="e_convert_v" />
									<script language="JavaScript">
										var rupiah100 = document.getElementById('e_convert');
										rupiah100.addEventListener('keyup', function(e) {
											rup100 = this.value.replace(/\D/g, '');
											$('#e_convert_v').val(rup100);
											rupiah100.value = formatRupiah10(this.value, 'Rp. ');
										});

										function formatRupiah10(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah100 = split[0].substr(0, sisa),
												ribuan100 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan100) {
												separator = sisa ? '.' : '';
												rupiah100 += separator + ribuan100.join('.');
											}

											rupiah100 = split[1] != undefined ? rupiah100 + ',' + split[1] : rupiah100;
											return prefix == undefined ? rupiah100 : (rupiah100 ? 'Rp. ' + rupiah100 : '');
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
										var rupiah5 = document.getElementById('e_tunj_pegawai_tetap');
										rupiah5.addEventListener('keyup', function(e) {
											rup5 = this.value.replace(/\D/g, '');
											$('#e_tunj_pegawai_tetap_v').val(rup5);
											rupiah5.value = formatRupiah4(this.value, 'Rp. ');
										});
									</script>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tunjangan Keluarga </label>
								<div class="col-sm-9">
									<input type="text" id="e_tunj_keluarga" required name="e_tunj_keluarga" placeholder="Rp. 10.0000" class="form-control" />
									<input type="hidden" id="e_tunj_keluarga_v" required name="e_tunj_keluarga_v" />
									<script language="JavaScript">
										var rupiah7 = document.getElementById('e_tunj_keluarga');
										rupiah7.addEventListener('keyup', function(e) {
											rup7 = this.value.replace(/\D/g, '');
											$('#e_tunj_keluarga_v').val(rup7);
											rupiah7.value = formatRupiah4(this.value, 'Rp. ');
										});
									</script>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tunjangan Pembinaan </label>
								<div class="col-sm-9">
									<input type="text" id="e_tunj_pembinaan" required name="e_tunj_pembinaan" placeholder="Rp. 10.0000" class="form-control" />
									<input type="hidden" id="e_tunj_pembinaan_v" required name="e_tunj_pembinaan_v" />
									<script language="JavaScript">
										var rupiah8 = document.getElementById('e_tunj_pembinaan');
										rupiah8.addEventListener('keyup', function(e) {
											rup8 = this.value.replace(/\D/g, '');
											$('#e_tunj_pembinaan_v').val(rup8);
											rupiah8.value = formatRupiah4(this.value, 'Rp. ');
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
										var rupiah6 = document.getElementById('e_bpjs');
										rupiah6.addEventListener('keyup', function(e) {
											rup6 = this.value.replace(/\D/g, '');
											$('#e_bpjs_v').val(rup6);
											rupiah6.value = formatRupiah4(this.value, 'Rp. ');
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
				<th>NAMA</th>
				<th>Tunj. Jabatan</th>
				<th>Honor (berkala)</th>
				<th>Transport</th>
				<th>Honor</th>
				<th>Honor (berkala) + Convert</th>
				<th>Tunj. Pegawa Tetap</th>
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
		$("#karyawan").change(function() {
			var id = $('#karyawan').val();
			$.ajax({
				type: "POST",
				url: '<?php echo site_url('modulpayroll/tarif_karyawan/honor_berkala') ?>',
				data: {
					id: id
				}
			}).done(function(data) {
				var a = ConvertFormatRupiah(data, 'Rp. ');
				$("#tarif_karyawan").val(a);
				$("#tarif_karyawan_v").val(data);
			});
		});

		$("#karyawan").change(function() {
			var id = $('#karyawan').val();
			$.ajax({
				type: "POST",
				url: '<?php echo site_url('modulpayroll/tarif_karyawan/convert') ?>',
				data: {
					id: id
				}
			}).done(function(data) {
				var a = ConvertFormatRupiah(data, 'Rp. ');
				$("#convert").val(a);
				$("#convert_v").val(data);
			});
		});

		$("#e_karyawan").change(function() {
			var id = $('#e_karyawan').val();
			$.ajax({
				type: "POST",
				url: '<?php echo site_url('modulpayroll/tarif_karyawan/honor_berkala') ?>',
				data: {
					id: id
				}
			}).done(function(data) {
				var a = ConvertFormatRupiah(data, 'Rp. ');
				$("#e_tarif_karyawan").val(a);
				$("#e_tarif_karyawan_v").val(data);
			});
		});
	});

	//function show all Data
	function show_data() {
		$.ajax({
			type: 'POST',
			url: '<?php echo site_url('modulpayroll/tarif_karyawan/tampil') ?>',
			async: true,
			dataType: 'json',
			success: function(data) {
				var html = '';
				var i = 0;
				var no = 1;
				for (i = 0; i < data.length; i++) {
					html += '<tr>' +
						'<td class="text-center">' + no + '</td>' +
						'<td class="text-center">' + data[i].id_karyawan + '</td>' +
						'<td>' + data[i].nama + '</td>' +
						'<td>' + data[i].tunjangan_jabatan + '</td>' +
						'<td>' + data[i].tarif + '</td>' +
						'<td>' + data[i].transport + '</td>' +
						'<td>' + data[i].honor + '</td>' +
						'<td>' + data[i].hc + '</td>' +
						'<td>' + data[i].tunj_pegawai_tetap + '</td>' +
						'<td >' +
						'<button  href="#my-modal-edit_tarif" class="btn btn-xs btn-success item_edit_tarif" title="Edit" data-id="' + data[i].id + '">' +
						'<i class="ace-icon fa fa-pencil bigger-120"> Edit Tarif</i>' +
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
					url: "<?php echo base_url('modulpayroll/tarif_karyawan/simpan') ?>",
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

	$('#show_data').on('click', '.item_edit_tarif', function() {
		var id = $(this).data('id');
		$('#modalEditTarif').modal('show');
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('modulpayroll/tarif_karyawan/tampil_byidtarif') ?>",
			async: true,
			dataType: "JSON",
			data: {
				id: id,
			},
			success: function(data) {
				$('#e_karyawan').val(data[0].id_karyawan);

				var a = ConvertFormatRupiah(data[0].tarif, 'Rp. ');
				$('#e_tarif_karyawan').val(a);
				$('#e_tarif_karyawan_v').val(data[0].tarif);

				var b = ConvertFormatRupiah(data[0].tunjangan_jabatan, 'Rp. ');
				$('#e_tunjangan_jabatan').val(b);
				$('#e_tunjangan_jabatan_v').val(data[0].tunjangan_jabatan);

				// var c = ConvertFormatRupiah(data[0].tunjangan_masakerja, 'Rp. ');
				// $('#e_tunjangan_jabatan').val(c);
				// $('#e_tunjangan_jabatan_v').val(data[0].tunjangan_masakerja);

				var d = ConvertFormatRupiah(data[0].convert, 'Rp. ');
				$('#e_convert').val(d);
				$('#e_convert_v').val(data[0].convert);

				var e = ConvertFormatRupiah(data[0].tunj_pegawai_tetap, 'Rp. ');
				$('#e_tunj_pegawai_tetap').val(e);
				$('#e_tunj_pegawai_tetap_v').val(data[0].tunj_pegawai_tetap);

				var f = ConvertFormatRupiah(data[0].tunj_keluarga, 'Rp. ');
				$('#e_tunj_keluarga').val(f);
				$('#e_tunj_keluarga_v').val(data[0].tunj_keluarga);

				var g = ConvertFormatRupiah(data[0].tunj_pembinaan, 'Rp. ');
				$('#e_tunj_pembinaan').val(g);
				$('#e_tunj_pembinaan_v').val(data[0].tunj_pembinaan);

				var h = ConvertFormatRupiah(data[0].transport, 'Rp. ');
				$('#e_transport').val(h);
				$('#e_transport_v').val(data[0].transport);

				var i = ConvertFormatRupiah(data[0].bpjs, 'Rp. ');
				$('#e_bpjs').val(i);
				$('#e_bpjs_v').val(data[0].bpjs);

				$('#e_nama_pembayaran').val(data[0].cara_pembayaran);
				$('#e_no_rekening').val(data[0].no_rekening);



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
					url: "<?php echo base_url('modulpayroll/tarif_karyawan/updatetarif') ?>",
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
					url: "<?php echo base_url('modulpayroll/tarif_karyawan/delete') ?>",
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

	function ConvertFormatRupiah(angka, prefix) {
		var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split = number_string.split(','),
			sisa = split[0].length % 3,
			rupiah = split[0].substr(0, sisa),
			ribuan = split[0].substr(sisa).match(/\d{3}/gi);

		// tambahkan titik jika yang di input sudah menjadi angka ribuan
		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}

		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
	}
</script>
