<!-- Button -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<div class="row">
	<div class="col-xs-1">
		<button href="#my-modal" role="button" data-toggle="modal" class="btn btn-xs btn-info">
			<a class="ace-icon fa fa-plus bigger-120"></a> Tambah Data
		</button>
	</div>
	<br>
	<br>
</div>

<!-- Modal Import Data -->
<div id="my-modal" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="smaller lighter blue no-margin">Form Tambah <?=$page_name?></h3>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						<!-- PAGE CONTENT BEGINS -->
						<form class="form-horizontal" role="form" id="formTambah">
                            <div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Guru </label>
								<div class="col-sm-9">
									<select class="form-control" name="id_guru" id="id_guru">
										<option value="">-- Pilih Guru --</option>
										<?php foreach ($myguru as $value) { ?>
											<option value=<?= $value['IdGuru'] ?>><?= $value['GuruNama'] ?></option>
										<?php } ?>
									</select>
								</div>
                            </div>
                            
                            <div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Infaq Masjid</label>
								<div class="col-sm-9">
								<input type="text" id="infaq_masjid" required name="infaq_masjid" placeholder="Tarif Potongan" class="form-control" />
                                <input type="hidden" id="infaq_masjid_v" required name="infaq_masjid_v"/>
								<script language="JavaScript">
										var rupiah3 = document.getElementById('infaq_masjid');
										rupiah3.addEventListener('keyup', function(e) {
											rup3 = this.value.replace(/\D/g, '');
											$('#infaq_masjid_v').val(rup3);
											rupiah3.value = formatRupiah3(this.value, 'Rp. ');
										});

										function formatRupiah3(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah3 = split[0].substr(0, sisa),
												ribuan3 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan3) {
												separator = sisa ? '.' : '';
												rupiah3 += separator + ribuan3.join('.');
											}

											rupiah3 = split[1] != undefined ? rupiah3 + ',' + split[1] : rupiah3;
											return prefix == undefined ? rupiah3 : (rupiah3 ? 'Rp. ' + rupiah3 : '');
										}
									</script>
								</div>
                            </div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Anggota Koperasi</label>
								<div class="col-sm-9">
								<input type="text" id="anggota_koperasi" required name="anggota_koperasi" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="anggota_koperasi_v" required name="anggota_koperasi_v"/>
								<script language="JavaScript">
										var rupiah4 = document.getElementById('anggota_koperasi');
										rupiah4.addEventListener('keyup', function(e) {
											rup4 = this.value.replace(/\D/g, '');
											$('#anggota_koperasi_v').val(rup4);
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
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Kas / Bon</label>
								<div class="col-sm-9">
								<input type="text" id="kas_bon" required name="kas_bon" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="kas_bon_v" required name="kas_bon_v"/>
								<script language="JavaScript">
										var rupiah5 = document.getElementById('kas_bon');
										rupiah5.addEventListener('keyup', function(e) {
											rup5 = this.value.replace(/\D/g, '');
											$('#kas_bon_v').val(rup5);
											rupiah5.value = formatRupiah5(this.value, 'Rp. ');
										});

										function formatRupiah5(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah5 = split[0].substr(0, sisa),
												ribuan5 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan5) {
												separator = sisa ? '.' : '';
												rupiah5 += separator + ribuan5.join('.');
											}

											rupiah5 = split[1] != undefined ? rupiah5 + ',' + split[1] : rupiah5;
											return prefix == undefined ? rupiah5 : (rupiah5 ? 'Rp. ' + rupiah5 : '');
										}
									</script>
								</div>
                            </div>
                            

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Ijin / Telat</label>
								<div class="col-sm-9">
								<input type="text" id="ijin_telat" required name="ijin_telat" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="ijin_telat_v" required name="ijin_telat_v"/>
								<script language="JavaScript">
										var rupiah6 = document.getElementById('ijin_telat');
										rupiah6.addEventListener('keyup', function(e) {
											rup6 = this.value.replace(/\D/g, '');
											$('#ijin_telat_v').val(rup6);
											rupiah6.value = formatRupiah5(this.value, 'Rp. ');
										});

										function formatRupiah5(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah6 = split[0].substr(0, sisa),
												ribuan6 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan6) {
												separator = sisa ? '.' : '';
												rupiah6 += separator + ribuan6.join('.');
											}

											rupiah6 = split[1] != undefined ? rupiah6 + ',' + split[1] : rupiah6;
											return prefix == undefined ? rupiah6 : (rupiah6 ? 'Rp. ' + rupiah6 : '');
										}
									</script>
								</div>
                            </div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> BMT</label>
								<div class="col-sm-9">
								<input type="text" id="bmt" required name="bmt" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="bmt_v" required name="bmt_v"/>
								<script language="JavaScript">
										var rupiah7 = document.getElementById('bmt');
										rupiah7.addEventListener('keyup', function(e) {
											rup7 = this.value.replace(/\D/g, '');
											$('#bmt_v').val(rup7);
											rupiah7.value = formatRupiah7(this.value, 'Rp. ');
										});

										function formatRupiah7(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah7 = split[0].substr(0, sisa),
												ribuan7 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan7) {
												separator = sisa ? '.' : '';
												rupiah7 += separator + ribuan7.join('.');
											}

											rupiah7 = split[1] != undefined ? rupiah7 + ',' + split[1] : rupiah7;
											return prefix == undefined ? rupiah7 : (rupiah7 ? 'Rp. ' + rupiah7 : '');
										}
									</script>
								</div>
                            </div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Koperasi</label>
								<div class="col-sm-9">
								<input type="text" id="koperasi" required name="koperasi" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="koperasi_v" required name="koperasi_v"/>
								<script language="JavaScript">
										var rupiah8 = document.getElementById('koperasi');
										rupiah8.addEventListener('keyup', function(e) {
											rup8 = this.value.replace(/\D/g, '');
											$('#koperasi_v').val(rup8);
											rupiah8.value = formatRupiah8(this.value, 'Rp. ');
										});

										function formatRupiah8(angka, prefix) {
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
									</script>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Diinval</label>
								<div class="col-sm-9">
								<input type="text" id="inval" required name="inval" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="inval_v" required name="inval_v"/>
								<script language="JavaScript">
										var rupiah9 = document.getElementById('inval');
										rupiah9.addEventListener('keyup', function(e) {
											rup8 = this.value.replace(/\D/g, '');
											$('#inval_v').val(rup8);
											rupiah9.value = formatRupiah9(this.value, 'Rp. ');
										});

										function formatRupiah9(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah9 = split[0].substr(0, sisa),
												ribuan9 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan9) {
												separator = sisa ? '.' : '';
												rupiah9 += separator + ribuan9.join('.');
											}

											rupiah9 = split[1] != undefined ? rupiah9 + ',' + split[1] : rupiah9;
											return prefix == undefined ? rupiah9 : (rupiah9 ? 'Rp. ' + rupiah9 : '');
										}
									</script>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Toko Al Hamra</label>
								<div class="col-sm-9">
								<input type="text" id="toko" required name="toko" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="toko_v" required name="toko_v"/>
								<script language="JavaScript">
										var rupiah10 = document.getElementById('toko');
										rupiah10.addEventListener('keyup', function(e) {
											rup8 = this.value.replace(/\D/g, '');
											$('#toko_v').val(rup8);
											rupiah10.value = formatRupiah9(this.value, 'Rp. ');
										});

										function formatRupiah9(angka, prefix) {
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
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Lain - Lain</label>
								<div class="col-sm-9">
								<input type="text" id="lain" required name="lain" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="lain_v" required name="lain_v"/>
								<script language="JavaScript">
										var rupiah11 = document.getElementById('lain');
										rupiah11.addEventListener('keyup', function(e) {
											rup8 = this.value.replace(/\D/g, '');
											$('#lain_v').val(rup8);
											rupiah11.value = formatRupiah9(this.value, 'Rp. ');
										});

										function formatRupiah9(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah11 = split[0].substr(0, sisa),
												ribuan11 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan11) {
												separator = sisa ? '.' : '';
												rupiah11 += separator + ribuan11.join('.');
											}

											rupiah11 = split[1] != undefined ? rupiah11 + ',' + split[1] : rupiah11;
											return prefix == undefined ? rupiah11 : (rupiah11 ? 'Rp. ' + rupiah11 : '');
										}
									</script>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">PPH 21</label>
								<div class="col-sm-9">
								<input type="text" id="pph21" required name="pph21" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="pph21_v" required name="pph21_v"/>
								<script language="JavaScript">
										var rupiah12 = document.getElementById('pph21');
										rupiah12.addEventListener('keyup', function(e) {
											rup8 = this.value.replace(/\D/g, '');
											$('#pph21_v').val(rup8);
											rupiah12.value = formatRupiah9(this.value, 'Rp. ');
										});

										function formatRupiah9(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah12 = split[0].substr(0, sisa),
												ribuan12 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan12) {
												separator = sisa ? '.' : '';
												rupiah12 += separator + ribuan12.join('.');
											}

											rupiah12 = split[1] != undefined ? rupiah12 + ',' + split[1] : rupiah12;
											return prefix == undefined ? rupiah12 : (rupiah12 ? 'Rp. ' + rupiah12 : '');
										}
									</script>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tawun</label>
								<div class="col-sm-9">
								<input type="text" id="tawun" required name="tawun" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="tawun_v" required name="tawun_v"/>
								<script language="JavaScript">
										var rupiah13 = document.getElementById('tawun');
										rupiah13.addEventListener('keyup', function(e) {
											rup8 = this.value.replace(/\D/g, '');
											$('#tawun_v').val(rup8);
											rupiah13.value = formatRupiah9(this.value, 'Rp. ');
										});

										function formatRupiah9(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah13 = split[0].substr(0, sisa),
												ribuan13 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan13) {
												separator = sisa ? '.' : '';
												rupiah13 += separator + ribuan13.join('.');
											}

											rupiah13 = split[1] != undefined ? rupiah13 + ',' + split[1] : rupiah13;
											return prefix == undefined ? rupiah13 : (rupiah13 ? 'Rp. ' + rupiah13 : '');
										}
									</script>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">LTQ</label>
								<div class="col-sm-9">
								<input type="text" id="ltq" required name="ltq" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="ltq_v" required name="ltq_v"/>
								<script language="JavaScript">
										var rupiah14 = document.getElementById('ltq');
										rupiah14.addEventListener('keyup', function(e) {
											rup8 = this.value.replace(/\D/g, '');
											$('#ltq_v').val(rup8);
											rupiah14.value = formatRupiah9(this.value, 'Rp. ');
										});

										function formatRupiah9(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah14 = split[0].substr(0, sisa),
												ribuan14 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan14) {
												separator = sisa ? '.' : '';
												rupiah14 += separator + ribuan14.join('.');
											}

											rupiah14 = split[1] != undefined ? rupiah14 + ',' + split[1] : rupiah14;
											return prefix == undefined ? rupiah14 : (rupiah14 ? 'Rp. ' + rupiah14 : '');
										}
									</script>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">BPJS</label>
								<div class="col-sm-9">
								<input type="text" id="bpjs" required name="bpjs" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="bpjs_v" required name="bpjs_v"/>
								<script language="JavaScript">
										var rupiah15 = document.getElementById('bpjs');
										rupiah15.addEventListener('keyup', function(e) {
											rup8 = this.value.replace(/\D/g, '');
											$('#bpjs_v').val(rup8);
											rupiah15.value = formatRupiah9(this.value, 'Rp. ');
										});

										function formatRupiah9(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah15 = split[0].substr(0, sisa),
												ribuan15 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan15) {
												separator = sisa ? '.' : '';
												rupiah15 += separator + ribuan15.join('.');
											}

											rupiah15 = split[1] != undefined ? rupiah15 + ',' + split[1] : rupiah15;
											return prefix == undefined ? rupiah15 : (rupiah15 ? 'Rp. ' + rupiah15 : '');
										}
									</script>
								</div>
							</div>
							
                            <div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Periode </label>
								<div class="col-sm-9">
									<input type="date" id="periode" required name="periode" placeholder="Rp. 10.000" class="form-control" />
								</div>
                            </div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" id="btn_update" class="btn btn-sm btn-success pull-left">
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
				<h3 class="smaller lighter blue no-margin">Form Edit <?=$page_name ?></h3>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						<!-- PAGE CONTENT BEGINS -->
						<form class="form-horizontal" role="form" id="formEdit">
                            <div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Guru </label>
								<input type="hidden" id="e_id_potong"  required name="e_id_potong"  />
								<div class="col-sm-9">
                                    <select class="form-control" name="e_id_guru" id="e_id_guru">
										<option value="">-- Pilih Guru --</option>
										<?php foreach ($myguru as $value) { ?>
											<option value=<?= $value['IdGuru'] ?>><?= $value['GuruNama'] ?></option>
										<?php } ?>
									</select>
								</div>
                            </div>
                            <div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Infaq Masjid</label>
								<div class="col-sm-9">
								<input type="text" id="e_infaq_masjid" required name="e_infaq_masjid" placeholder="Tarif Potongan" class="form-control" />
                                <input type="hidden" id="e_infaq_masjid_v" required name="e_infaq_masjid_v"/>
								<script language="JavaScript">
										var rupiah31 = document.getElementById('e_infaq_masjid');
										rupiah31.addEventListener('keyup', function(e) {
											rup31 = this.value.replace(/\D/g, '');
											$('#e_infaq_masjid_v').val(rup31);
											rupiah31.value = formatRupiah31(this.value, 'Rp. ');
										});

										function formatRupiah31(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah31 = split[0].substr(0, sisa),
												ribuan31 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan31) {
												separator = sisa ? '.' : '';
												rupiah31 += separator + ribuan31.join('.');
											}

											rupiah31 = split[1] != undefined ? rupiah31 + ',' + split[1] : rupiah31;
											return prefix == undefined ? rupiah31 : (rupiah31 ? 'Rp. ' + rupiah31 : '');
										}
									</script>
								</div>
                            </div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Anggota Koperasi</label>
								<div class="col-sm-9">
								<input type="text" id="e_anggota_koperasi" required name="e_anggota_koperasi" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="e_anggota_koperasi_v" required name="e_anggota_koperasi_v"/>
								<script language="JavaScript">
										var rupiah41 = document.getElementById('e_anggota_koperasi');
										rupiah41.addEventListener('keyup', function(e) {
											rup41 = this.value.replace(/\D/g, '');
											$('#e_anggota_koperasi_v').val(rup41);
											rupiah41.value = formatRupiah41(this.value, 'Rp. ');
										});

										function formatRupiah41(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah41 = split[0].substr(0, sisa),
												ribuan41 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan41) {
												separator = sisa ? '.' : '';
												rupiah41 += separator + ribuan41.join('.');
											}

											rupiah41 = split[1] != undefined ? rupiah4 + ',' + split[1] : rupiah41;
											return prefix == undefined ? rupiah41 : (rupiah41 ? 'Rp. ' + rupiah41 : '');
										}
									</script>
								</div>
                            </div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Kas / Bon</label>
								<div class="col-sm-9">
								<input type="text" id="e_kas_bon" required name="e_kas_bon" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="e_kas_bon_v" required name="e_kas_bon_v"/>
								<script language="JavaScript">
										var rupiah51 = document.getElementById('e_kas_bon');
										rupiah51.addEventListener('keyup', function(e) {
											rup51 = this.value.replace(/\D/g, '');
											$('#e_kas_bon_v').val(rup51);
											rupiah51.value = formatRupiah51(this.value, 'Rp. ');
										});

										function formatRupiah51(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah51 = split[0].substr(0, sisa),
												ribuan51 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan51) {
												separator = sisa ? '.' : '';
												rupiah51 += separator + ribuan51.join('.');
											}

											rupiah51 = split[1] != undefined ? rupiah51 + ',' + split[1] : rupiah51;
											return prefix == undefined ? rupiah51 : (rupiah51 ? 'Rp. ' + rupiah51 : '');
										}
									</script>
								</div>
                            </div>
                            

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Ijin / Telat</label>
								<div class="col-sm-9">
								<input type="text" id="e_ijin_telat" required name="e_ijin_telat" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="e_ijin_telat_v" required name="e_ijin_telat_v"/>
								<script language="JavaScript">
										var rupiah61 = document.getElementById('e_ijin_telat');
										rupiah61.addEventListener('keyup', function(e) {
											rup61 = this.value.replace(/\D/g, '');
											$('#e_ijin_telat_v').val(rup61);
											rupiah61.value = formatRupiah51(this.value, 'Rp. ');
										});

										function formatRupiah51(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah61 = split[0].substr(0, sisa),
												ribuan61 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan61) {
												separator = sisa ? '.' : '';
												rupiah61 += separator + ribuan61.join('.');
											}

											rupiah61 = split[1] != undefined ? rupiah61 + ',' + split[1] : rupiah61;
											return prefix == undefined ? rupiah61 : (rupiah61 ? 'Rp. ' + rupiah61 : '');
										}
									</script>
								</div>
                            </div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> BMT</label>
								<div class="col-sm-9">
								<input type="text" id="e_bmt" required name="e_bmt" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="e_bmt_v" required name="e_bmt_v"/>
								<script language="JavaScript">
										var rupiah71 = document.getElementById('e_bmt');
										rupiah71.addEventListener('keyup', function(e) {
											rup71 = this.value.replace(/\D/g, '');
											$('#e_bmt_v').val(rup71);
											rupiah71.value = formatRupiah71(this.value, 'Rp. ');
										});

										function formatRupiah71(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah71 = split[0].substr(0, sisa),
												ribuan71 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan71) {
												separator = sisa ? '.' : '';
												rupiah71 += separator + ribuan71.join('.');
											}

											rupiah71 = split[1] != undefined ? rupiah71 + ',' + split[1] : rupiah71;
											return prefix == undefined ? rupiah71 : (rupiah71 ? 'Rp. ' + rupiah71 : '');
										}
									</script>
								</div>
                            </div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Koperasi</label>
								<div class="col-sm-9">
								<input type="text" id="e_koperasi" required name="e_koperasi" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="e_koperasi_v" required name="e_koperasi_v"/>
								<script language="JavaScript">
										var rupiah81 = document.getElementById('e_koperasi');
										rupiah81.addEventListener('keyup', function(e) {
											rup81 = this.value.replace(/\D/g, '');
											$('#e_koperasi_v').val(rup81);
											rupiah81.value = formatRupiah8(this.value, 'Rp. ');
										});

										function formatRupiah81(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah81 = split[0].substr(0, sisa),
												ribuan81 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan81) {
												separator = sisa ? '.' : '';
												rupiah81 += separator + ribuan81.join('.');
											}

											rupiah81 = split[1] != undefined ? rupiah81 + ',' + split[1] : rupiah81;
											return prefix == undefined ? rupiah81 : (rupiah81 ? 'Rp. ' + rupiah81 : '');
										}
									</script>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Diinval</label>
								<div class="col-sm-9">
								<input type="text" id="e_inval" required name="e_inval" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="e_inval_v" required name="e_inval_v"/>
								<script language="JavaScript">
										var rupiah91 = document.getElementById('e_inval');
										rupiah91.addEventListener('keyup', function(e) {
											rup81 = this.value.replace(/\D/g, '');
											$('#e_inval_v').val(rup81);
											rupiah91.value = formatRupiah9(this.value, 'Rp. ');
										});

										function formatRupiah9(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah91 = split[0].substr(0, sisa),
												ribuan91 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan91) {
												separator = sisa ? '.' : '';
												rupiah91 += separator + ribuan91.join('.');
											}

											rupiah91 = split[1] != undefined ? rupiah91 + ',' + split[1] : rupiah91;
											return prefix == undefined ? rupiah91 : (rupiah91 ? 'Rp. ' + rupiah91 : '');
										}
									</script>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Toko Al Hamra</label>
								<div class="col-sm-9">
								<input type="text" id="e_toko" required name="e_toko" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="e_toko_v" required name="e_toko_v"/>
								<script language="JavaScript">
										var rupiah101 = document.getElementById('e_toko');
										rupiah101.addEventListener('keyup', function(e) {
											rup8 = this.value.replace(/\D/g, '');
											$('#e_toko_v').val(rup8);
											rupiah101.value = formatRupiah101(this.value, 'Rp. ');
										});

										function formatRupiah101(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah101 = split[0].substr(0, sisa),
												ribuan101 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan101) {
												separator = sisa ? '.' : '';
												rupiah101 += separator + ribuan101.join('.');
											}

											rupiah101 = split[1] != undefined ? rupiah101 + ',' + split[1] : rupiah101;
											return prefix == undefined ? rupiah101 : (rupiah101 ? 'Rp. ' + rupiah101 : '');
										}
									</script>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Lain - Lain</label>
								<div class="col-sm-9">
								<input type="text" id="e_lain" required name="e_lain" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="e_lain_v" required name="e_lain_v"/>
								<script language="JavaScript">
										var rupiah111 = document.getElementById('e_lain');
										rupiah111.addEventListener('keyup', function(e) {
											rup8 = this.value.replace(/\D/g, '');
											$('#e_lain_v').val(rup8);
											rupiah111.value = formatRupiah111(this.value, 'Rp. ');
										});

										function formatRupiah111(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah111 = split[0].substr(0, sisa),
												ribuan111 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan111) {
												separator = sisa ? '.' : '';
												rupiah111 += separator + ribuan111.join('.');
											}

											rupiah111 = split[1] != undefined ? rupiah111 + ',' + split[1] : rupiah111;
											return prefix == undefined ? rupiah111 : (rupiah111 ? 'Rp. ' + rupiah111 : '');
										}
									</script>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">PPH 21</label>
								<div class="col-sm-9">
								<input type="text" id="e_pph21" required name="e_pph21" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="e_pph21_v" required name="e_pph21_v"/>
								<script language="JavaScript">
										var rupiah121 = document.getElementById('e_pph21');
										rupiah121.addEventListener('keyup', function(e) {
											rup8 = this.value.replace(/\D/g, '');
											$('#e_pph21_v').val(rup8);
											rupiah121.value = formatRupiah121(this.value, 'Rp. ');
										});

										function formatRupiah121(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah121 = split[0].substr(0, sisa),
												ribuan121 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan121) {
												separator = sisa ? '.' : '';
												rupiah121 += separator + ribuan121.join('.');
											}

											rupiah121 = split[1] != undefined ? rupiah121 + ',' + split[1] : rupiah121;
											return prefix == undefined ? rupiah121 : (rupiah121 ? 'Rp. ' + rupiah121 : '');
										}
									</script>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Tawun</label>
								<div class="col-sm-9">
								<input type="text" id="e_tawun" required name="e_tawun" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="e_tawun_v" required name="e_tawun_v"/>
								<script language="JavaScript">
										var rupiah131 = document.getElementById('e_tawun');
										rupiah131.addEventListener('keyup', function(e) {
											rup8 = this.value.replace(/\D/g, '');
											$('#e_tawun_v').val(rup8);
											rupiah131.value = formatRupiah131(this.value, 'Rp. ');
										});

										function formatRupiah131(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah131 = split[0].substr(0, sisa),
												ribuan131 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan131) {
												separator = sisa ? '.' : '';
												rupiah131 += separator + ribuan131.join('.');
											}

											rupiah131 = split[1] != undefined ? rupiah131 + ',' + split[1] : rupiah131;
											return prefix == undefined ? rupiah131 : (rupiah131 ? 'Rp. ' + rupiah131 : '');
										}
									</script>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">BPJS</label>
								<div class="col-sm-9">
								<input type="text" id="e_bpjs" required name="e_bpjs" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="e_bpjs_v" required name="e_bpjs_v"/>
								<script language="JavaScript">
										var rupiah141 = document.getElementById('e_bpjs');
										rupiah141.addEventListener('keyup', function(e) {
											rup8 = this.value.replace(/\D/g, '');
											$('#e_bpjs_v').val(rup8);
											rupiah141.value = formatRupiah141(this.value, 'Rp. ');
										});

										function formatRupiah141(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah141 = split[0].substr(0, sisa),
												ribuan141 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan141) {
												separator = sisa ? '.' : '';
												rupiah141 += separator + ribuan141.join('.');
											}

											rupiah141 = split[1] != undefined ? rupiah141 + ',' + split[1] : rupiah141;
											return prefix == undefined ? rupiah141 : (rupiah141 ? 'Rp. ' + rupiah141 : '');
										}
									</script>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">LTQ</label>
								<div class="col-sm-9">
								<input type="text" id="e_ltq" required name="e_ltq" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="e_ltq_v" required name="e_ltq_v"/>
								<script language="JavaScript">
										var rupiah151 = document.getElementById('e_ltq');
										rupiah151.addEventListener('keyup', function(e) {
											rup8 = this.value.replace(/\D/g, '');
											$('#e_ltq_v').val(rup8);
											rupiah151.value = formatRupiah131(this.value, 'Rp. ');
										});

										function formatRupiah15(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah151 = split[0].substr(0, sisa),
												ribuan151 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan151) {
												separator = sisa ? '.' : '';
												rupiah151 += separator + ribuan151.join('.');
											}

											rupiah151 = split[1] != undefined ? rupiah151 + ',' + split[1] : rupiah151;
											return prefix == undefined ? rupiah151 : (rupiah151 ? 'Rp. ' + rupiah151 : '');
										}
									</script>
								</div>
							</div>
							
                            <div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Periode </label>
								<div class="col-sm-9">
									<input type="date" id="e_periode" required name="e_periode" placeholder="Rp. 10.000" class="form-control" />
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
			Semua Data Potongan guru
		</div>
	</div>
</div>
<div class="table-responsive">
	<table id="datatable_tabletools" class="display">
		<thead>
			<tr>
				<th>No</th>
				<th>Kode Guru</th>
				<th>Nama Guru</th>
				<th>Periode</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody id="show_data">
		</tbody>
	</table>
</div>
<script type="text/javascript">
 
	if ($("#formTambah").length > 0) {
		$("#formTambah").validate({
			errorClass: "my-error-class",
			validClass: "my-valid-class",
			submitHandler: function(form) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url('modulpayroll/master_potongan_guru/simpan') ?>",
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

	$(document).ready(function() {
		show_data();
		$('#datatable_tabletools').DataTable();
    
	});

	//function show all Data
	function show_data() {
		$.ajax({
			type: 'POST',
			url: '<?php echo site_url('modulpayroll/master_potongan_guru/tampil') ?>',
			async: true,
			dataType: 'json',
			success: function(data) {
				var html = '';
				var i = 0;
				var no = 1;
				for (i = 0; i < data.length; i++) {
					html += '<tr>' +
						'<td class="text-center">' + no + '</td>' +
						'<td class="text-center">' + data[i].IdGuru + '</td>' +
						'<td>' + data[i].GuruNama + '</td>' +
						'<td>' + data[i].periode + '</td>' +
						'<td>' +
						'<button  href="#my-modal-edit" class="btn btn-xs btn-info item_edit" title="Edit" data-id="' + data[i].id_potong + '">' +
						'<i class="ace-icon fa fa-pencil bigger-120"> Edit </i>' +
                        '</button><br><br> ' + 
                        '<button  href="#my-modal-edit" class="btn btn-xs btn-danger item_hapus" title="Hapus" data-id="' + data[i].id_potong + '">' +
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
    
    $('#show_data').on('click', '.item_edit', function() {
		var id = $(this).data('id');
		$('#modalEdit').modal('show');
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('modulpayroll/master_potongan_guru/tampil_byid') ?>",
			async: true,
			dataType: "JSON",
			data: {
				id: id,
			},
			success: function(data) {
				$('#e_id_potong').val(data[0].id_potong);
				$('#e_id_guru').val(data[0].IdGuru);
				$('#e_infaq_masjid').val(data[0].infaq_masjid);
				$('#e_anggota_koperasi').val(data[0].anggota_koperasi);
				$('#e_anggota_koperasi_v').val(data[0].anggota_koperasi);
				$('#e_infaq_masjid_v').val(data[0].infaq_masjid);
				$('#e_kas_bon').val(data[0].kas_bon);
				$('#e_kas_bon_v').val(data[0].kas_bon);
				$('#e_ijin_telat').val(data[0].ijin_telat);
				$('#e_ijin_telat_v').val(data[0].ijin_telat);
				$('#e_bmt').val(data[0].bmt);
				$('#e_bmt_v').val(data[0].bmt);
				$('#e_koperasi').val(data[0].koperasi);
				$('#e_koperasi_v').val(data[0].koperasi);
				$('#e_inval').val(data[0].inval);
				$('#e_inval_v').val(data[0].inval);
				$('#e_toko').val(data[0].toko);
				$('#e_toko_v').val(data[0].toko);
				$('#e_lain').val(data[0].lain);
				$('#e_lain_v').val(data[0].lain);
				$('#e_pph21').val(data[0].pph21);
				$('#e_pph21_v').val(data[0].pph21);
				$('#e_periode').val(data[0].periode);
				$('#e_tawun').val(data[0].tawun);
				$('#e_tawun_v').val(data[0].tawun);
				$('#e_bpjs').val(data[0].bpjs);
				$('#e_bpjs_v').val(data[0].bpjs);
				$('#e_ltq').val(data[0].ltq);
				$('#e_ltq').val(data[0].ltq);
			}
		});
    });

	if ($("#formEdit").length > 0) {
        $("#formEdit").validate({
            errorClass: "my-error-class",
            validClass: "my-valid-class",
            submitHandler: function(form) {
                $('#btn_edit').html('Sending..');
                $.ajax({
                    url: "<?php echo base_url('modulpayroll/master_potongan_guru/update') ?>",
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
					url: "<?php echo base_url('modulpayroll/master_potongan_guru/delete') ?>",
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
	})
</script>