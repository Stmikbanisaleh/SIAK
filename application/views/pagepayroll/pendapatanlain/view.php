<!-- Button -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
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

<div id="my-modal2" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="smaller lighter blue no-margin">Form Import <?= $page_name; ?></h3>
			</div>
			<?php if ($this->session->flashdata('message')) { ?>
                                            <div class="alert alert-danger"> <?= $this->session->flashdata('message') ?> </div>
                                        <?php } ?>
            <form class="form-horizontal" role="form" enctype="multipart/form-data" id="formImport">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- PAGE CONTENT BEGINS -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Import Excel FIle </label>
                                <div class="col-sm-6">
                                    <input type="file" id="file" required name="file" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Sample </label>
                                <div class="col-sm-9">
                                    <a href="<?php echo base_url() . 'modulpayroll/pendapatanlain/downloadsample'; ?>" for="form-field-1"> Download Sample Format </label></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn_edit" class="btn btn-sm btn-success pull-left">
                        <i class="ace-icon fa fa-save"></i>
                        Import
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
<!-- Modal Import Data -->
<div id="my-modal" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="smaller lighter blue no-margin">Form Tambah <?= $page_name ?></h3>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						<!-- PAGE CONTENT BEGINS -->
						<form class="form-horizontal" role="form" id="formTambah">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Guru </label>
								<div class="col-sm-9">
									<select class="form-control" required name="id_guru" id="id_guru">
										<option value="">-- Pilih Guru --</option>
										<?php foreach ($myguru as $value) { ?>
											<option value=<?= $value['IdGuru'] ?>><?= $value['GuruNama'] ?></option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> THR </label>
								<div class="col-sm-9">
									<input type="text" id="thr" required name="thr" placeholder="THR " class="form-control" />
									<input type="hidden" id="thr_v" required name="thr_v" />
									<script language="JavaScript">
										var rupiah3 = document.getElementById('thr');
										rupiah3.addEventListener('keyup', function(e) {
											rup3 = this.value.replace(/\D/g, '');
											$('#thr_v').val(rup3);
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
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tunjangan Penilaian Kinerja</label>
								<div class="col-sm-9">
									<input type="text" id="tjkinerja" required name="tjkinerja" placeholder="Rp. 10.000" class="form-control" />
									<input type="hidden" id="tjkinerja_v" required name="tjkinerja_v" />
									<script language="JavaScript">
										var rupiah44 = document.getElementById('tjkinerja');
										rupiah44.addEventListener('keyup', function(e) {
											rup4 = this.value.replace(/\D/g, '');
											$('#tjkinerja_v').val(rup4);
											rupiah44.value = formatRupiah4(this.value, 'Rp. ');
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
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Inval</label>
								<div class="col-sm-9">
									<input type="text" id="inval" required name="inval" placeholder="Rp. 10.000" class="form-control" />
									<input type="hidden" id="inval_v" required name="inval_v" />
									<script language="JavaScript">
										var rupiah444 = document.getElementById('inval');
										rupiah444.addEventListener('keyup', function(e) {
											rup4 = this.value.replace(/\D/g, '');
											$('#inval_v').val(rup4);
											rupiah444.value = formatRupiah4(this.value, 'Rp. ');
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
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Pendapatan Lain Lain</label>
								<div class="col-sm-9">
									<input type="text" id="tjlain" required name="tjlain" placeholder="Rp. 10.000" class="form-control" />
									<input type="hidden" id="tjlain_v" required name="tjlain_v" />
									<script language="JavaScript">
										var rupiah51 = document.getElementById('tjlain');
										rupiah51.addEventListener('keyup', function(e) {
											rup5 = this.value.replace(/\D/g, '');
											$('#tjlain_v').val(rup5);
											rupiah51.value = formatRupiah5(this.value, 'Rp. ');
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
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Ket. Tunj Khusus 1 </label>
								<div class="col-sm-9">
									<input type="text" id="ket_tunj_khusus1" name="ket_tunj_khusus1" placeholder="Keterangan" class="form-control">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tunjangan Khusus 1</label>
								<div class="col-sm-9">
									<input type="text" id="tunj_khusus1" name="tunj_khusus1" placeholder="Rp. 10.000" class="form-control" />
									<input type="hidden" id="tunj_khusus1_v" name="tunj_khusus1_v" />
									<script language="JavaScript">
										var rupiah91 = document.getElementById('tunj_khusus1');
										rupiah91.addEventListener('keyup', function(e) {
											rup6 = this.value.replace(/\D/g, '');
											$('#tunj_khusus1_v').val(rup6);
											rupiah91.value = formatRupiah9(this.value, 'Rp. ');
										});

										function formatRupiah9(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah9 = split[0].substr(0, sisa),
												ribuan6 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan6) {
												separator = sisa ? '.' : '';
												rupiah9 += separator + ribuan6.join('.');
											}

											rupiah9 = split[1] != undefined ? rupiah9 + ',' + split[1] : rupiah9;
											return prefix == undefined ? rupiah5 : (rupiah9 ? 'Rp. ' + rupiah9 : '');
										}
									</script>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Ket. Tunj Khusus 2 </label>
								<div class="col-sm-9">
									<input type="text" id="ket_tunj_khusus2" name="ket_tunj_khusus2" placeholder="Keterangan" class="form-control">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tunjangan Khusus 2</label>
								<div class="col-sm-9">
									<input type="text" id="tunj_khusus2" name="tunj_khusus2" placeholder="Rp. 10.000" class="form-control" />
									<input type="hidden" id="tunj_khusus2_v" name="tunj_khusus2_v" />
									<script language="JavaScript">
										var rupiah10 = document.getElementById('tunj_khusus2');
										rupiah10.addEventListener('keyup', function(e) {
											rup6 = this.value.replace(/\D/g, '');
											$('#tunj_khusus2_v').val(rup6);
											rupiah10.value = formatRupiah6(this.value, 'Rp. ');
										});

										function formatRupiah6(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah10 = split[0].substr(0, sisa),
												ribuan6 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan6) {
												separator = sisa ? '.' : '';
												rupiah10 += separator + ribuan6.join('.');
											}

											rupiah10 = split[1] != undefined ? rupiah10 + ',' + split[1] : rupiah10;
											return prefix == undefined ? rupiah5 : (rupiah10 ? 'Rp. ' + rupiah10 : '');
										}
									</script>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tambahan (1) </label>
								<div class="col-sm-3">
									<input type="number" id="jam1" name="jam1" placeholder="Jam" class="form-control" />
								</div>
								<div class="col-sm-6">
									<input type="text" id="tarif1" name="tarif1" placeholder="Tarif Perjam(1) " class="form-control" />
									<input type="hidden" id="tarif1_v" name="tarif1_v" />
									<script language="JavaScript">
										var rupiah31 = document.getElementById('tarif1');
										rupiah31.addEventListener('keyup', function(e) {
											rup3 = this.value.replace(/\D/g, '');
											$('#tarif1_v').val(rup3);
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
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tambahan (2) </label>
								<div class="col-sm-3">
									<input type="number" id="jam2" name="jam2" placeholder="Jam" class="form-control" />
								</div>
								<div class="col-sm-6">
									<input type="text" id="tarif2" name="tarif2" placeholder="Tarif Perjam(2) " class="form-control" />
									<input type="hidden" id="tarif2_v" required name="tarif2_v" />
									<script language="JavaScript">
										var rupiah6 = document.getElementById('tarif2');
										rupiah6.addEventListener('keyup', function(e) {
											rup3 = this.value.replace(/\D/g, '');
											$('#tarif2_v').val(rup3);
											rupiah6.value = formatRupiah3(this.value, 'Rp. ');
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
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tambahan (3) </label>
								<div class="col-sm-3">
									<input type="number" id="jam3" name="jam3" placeholder="Jam" class="form-control" />
								</div>
								<div class="col-sm-6">
									<input type="text" id="tarif3" name="tarif3" placeholder="Tarif Perjam(3) " class="form-control" />
									<input type="hidden" id="tarif3_v" required name="tarif3_v" />
									<script language="JavaScript">
										var rupiah712 = document.getElementById('tarif3');
										rupiah712.addEventListener('keyup', function(e) {
											rup3 = this.value.replace(/\D/g, '');
											$('#tarif3_v').val(rup3);
											rupiah712.value = formatRupiah3(this.value, 'Rp. ');
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
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tambahan (4) </label>
								<div class="col-sm-3">
									<input type="number" id="jam4" name="jam4" placeholder="Jam" class="form-control" />
								</div>
								<div class="col-sm-6">
									<input type="text" id="tarif4" name="tarif4" placeholder="Tarif Perjam(4) " class="form-control" />
									<input type="hidden" id="tarif4_v" required name="tarif4_v" />
									<script language="JavaScript">
										var rupiah811 = document.getElementById('tarif4');
										rupiah811.addEventListener('keyup', function(e) {
											rup3 = this.value.replace(/\D/g, '');
											$('#tarif4_v').val(rup3);
											rupiah811.value = formatRupiah3(this.value, 'Rp. ');
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
				<h3 class="smaller lighter blue no-margin">Form Edit <?= $page_name ?></h3>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						<!-- PAGE CONTENT BEGINS -->
						<form class="form-horizontal" role="form" id="formEdit">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Guru </label>
								<input type="hidden" id="e_id" required name="e_id" placeholder="" class="form-control" />
								<div class="col-sm-9">
									<select class="form-control" required name="e_id_guru" id="e_id_guru">
										<option value="">-- Pilih Guru --</option>
										<?php foreach ($myguru as $value) { ?>
											<option value=<?= $value['IdGuru'] ?>><?= $value['GuruNama'] ?></option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> THR </label>
								<div class="col-sm-9">
									<input type="text" id="e_thr" required name="e_thr" placeholder="THR " class="form-control" />
									<input type="hidden" id="e_thr_v" required name="e_thr_v" />
									<script language="JavaScript">
										var rupiah50 = document.getElementById('e_thr');
										rupiah50.addEventListener('keyup', function(e) {
											rup5 = this.value.replace(/\D/g, '');
											$('#e_thr_v').val(rup5);
											rupiah50.value = formatRupiah5(this.value, 'Rp. ');
										});

										function formatRupiah5(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah50 = split[0].substr(0, sisa),
												ribuan5 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan5) {
												separator = sisa ? '.' : '';
												rupiah50 += separator + ribuan5.join('.');
											}

											rupiah50 = split[1] != undefined ? rupiah50 + ',' + split[1] : rupiah50;
											return prefix == undefined ? rupiah50 : (rupiah50 ? 'Rp. ' + rupiah50 : '');
										}
									</script>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tunjangan Penilaian Kinerja</label>
								<div class="col-sm-9">
									<input type="text" id="e_tjkinerja" required name="e_tjkinerja" placeholder="Rp. 10.000" class="form-control" />
									<input type="hidden" id="e_tjkinerja_v" required name="e_tjkinerja_v" />
									<script language="JavaScript">
										var rupiah4 = document.getElementById('e_tjkinerja');
										rupiah4.addEventListener('keyup', function(e) {
											rup4 = this.value.replace(/\D/g, '');
											$('#e_tjkinerja_v').val(rup4);
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
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Inval</label>
								<div class="col-sm-9">
									<input type="text" id="e_inval" required name="e_inval" placeholder="Rp. 10.000" class="form-control" />
									<input type="hidden" id="e_inval_v" required name="e_inval_v" />
									<script language="JavaScript">
										var rupiah44 = document.getElementById('e_inval');
										rupiah44.addEventListener('keyup', function(e) {
											rup4 = this.value.replace(/\D/g, '');
											$('#e_inval_v').val(rup4);
											rupiah44.value = formatRupiah4(this.value, 'Rp. ');
										});

										function formatRupiah4(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah44 = split[0].substr(0, sisa),
												ribuan44 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan44) {
												separator = sisa ? '.' : '';
												rupiah44 += separator + ribuan44.join('.');
											}

											rupiah44 = split[1] != undefined ? rupiah44 + ',' + split[1] : rupiah44;
											return prefix == undefined ? rupiah44 : (rupiah44 ? 'Rp. ' + rupiah44 : '');
										}
									</script>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Pendapatan Lain Lain</label>
								<div class="col-sm-9">
									<input type="text" id="e_tjlain" required name="e_tjlain" placeholder="Rp. 10.000" class="form-control" />
									<input type="hidden" id="e_tjlain_v" required name="e_tjlain_v" />
									<script language="JavaScript">
										var rupiah5 = document.getElementById('e_tjlain');
										rupiah5.addEventListener('keyup', function(e) {
											rup5 = this.value.replace(/\D/g, '');
											$('#e_tjlain_v').val(rup5);
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
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Ket. Tunj Khusus 1 </label>
								<div class="col-sm-9">
									<input type="text" id="e_ket_tunj_khusus1" name="e_ket_tunj_khusus1" placeholder="Keterangan" class="form-control">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tunjangan Khusus 1</label>
								<div class="col-sm-9">
									<input type="text" id="e_tunj_khusus1" name="e_tunj_khusus1" placeholder="Rp. 10.000" class="form-control" />
									<input type="hidden" id="e_tunj_khusus1_v" name="e_tunj_khusus1_v" />
									<script language="JavaScript">
										var rupiah9 = document.getElementById('e_tunj_khusus1');
										rupiah9.addEventListener('keyup', function(e) {
											rup6 = this.value.replace(/\D/g, '');
											$('#e_tunj_khusus1_v').val(rup6);
											rupiah9.value = formatRupiah9(this.value, 'Rp. ');
										});

										function formatRupiah9(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah9 = split[0].substr(0, sisa),
												ribuan6 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan6) {
												separator = sisa ? '.' : '';
												rupiah9 += separator + ribuan6.join('.');
											}

											rupiah9 = split[1] != undefined ? rupiah9 + ',' + split[1] : rupiah9;
											return prefix == undefined ? rupiah5 : (rupiah9 ? 'Rp. ' + rupiah9 : '');
										}
									</script>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Ket. Tunj Khusus 2 </label>
								<div class="col-sm-9">
									<input type="text" id="e_ket_tunj_khusus2" name="e_ket_tunj_khusus2" placeholder="Keterangan" class="form-control">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tunjangan Khusus 2</label>
								<div class="col-sm-9">
									<input type="text" id="e_tunj_khusus2" name="e_tunj_khusus2" placeholder="Rp. 10.000" class="form-control" />
									<input type="hidden" id="e_tunj_khusus2_v" name="e_tunj_khusus2_v" />
									<script language="JavaScript">
										var rupiah101 = document.getElementById('e_tunj_khusus2');
										rupiah101.addEventListener('keyup', function(e) {
											rup6 = this.value.replace(/\D/g, '');
											$('#e_tunj_khusus2_v').val(rup6);
											rupiah101.value = formatRupiah6(this.value, 'Rp. ');
										});

										function formatRupiah6(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah101 = split[0].substr(0, sisa),
												ribuan6 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan6) {
												separator = sisa ? '.' : '';
												rupiah101 += separator + ribuan6.join('.');
											}

											rupiah101 = split[1] != undefined ? rupiah101 + ',' + split[1] : rupiah101;
											return prefix == undefined ? rupiah5 : (rupiah101 ? 'Rp. ' + rupiah101 : '');
										}
									</script>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tambahan (1) </label>
								<div class="col-sm-3">
									<input type="number" id="e_jam1" name="e_jam1" placeholder="Jam" class="form-control" />
								</div>
								<div class="col-sm-6">
									<input type="text" id="e_tarif1" name="e_tarif1" placeholder="Tarif Perjam(1) " class="form-control" />
									<input type="hidden" id="e_tarif1_v" name="e_tarif1_v" />
									<script language="JavaScript">
										var rupiah31 = document.getElementById('e_tarif1');
										rupiah31.addEventListener('keyup', function(e) {
											rup3 = this.value.replace(/\D/g, '');
											$('#e_tarif1_v').val(rup3);
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
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tambahan (2) </label>
								<div class="col-sm-3">
									<input type="number" id="e_jam2" name="e_jam2" placeholder="Jam" class="form-control" />
								</div>
								<div class="col-sm-6">
									<input type="text" id="e_tarif2" name="e_tarif2" placeholder="Tarif Perjam(2) " class="form-control" />
									<input type="hidden" id="e_tarif2_v"  name="e_tarif2_v" />
									<script language="JavaScript">
										var rupiah6 = document.getElementById('e_tarif2');
										rupiah6.addEventListener('keyup', function(e) {
											rup3 = this.value.replace(/\D/g, '');
											$('#e_tarif2_v').val(rup3);
											rupiah6.value = formatRupiah3(this.value, 'Rp. ');
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
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tambahan (3) </label>
								<div class="col-sm-3">
									<input type="number" id="e_jam3" name="e_jam3" placeholder="Jam" class="form-control" />
								</div>
								<div class="col-sm-6">
									<input type="text" id="e_tarif3" name="e_tarif3" placeholder="Tarif Perjam(3) " class="form-control" />
									<input type="hidden" id="e_tarif3_v" name="e_tarif3_v" />
									<script language="JavaScript">
										var rupiah7 = document.getElementById('e_tarif3');
										rupiah7.addEventListener('keyup', function(e) {
											rup3 = this.value.replace(/\D/g, '');
											$('#e_tarif3_v').val(rup3);
											rupiah7.value = formatRupiah3(this.value, 'Rp. ');
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
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tambahan (4) </label>
								<div class="col-sm-3">
									<input type="number" id="e_jam4" name="e_jam4" placeholder="Jam" class="form-control" />
								</div>
								<div class="col-sm-6">
									<input type="text" id="e_tarif4" name="e_tarif4" placeholder="Tarif Perjam(4) " class="form-control" />
									<input type="hidden" id="e_tarif4_v" required name="e_tarif4_v" />
									<script language="JavaScript">
										var rupiah8 = document.getElementById('e_tarif4');
										rupiah8.addEventListener('keyup', function(e) {
											rup3 = this.value.replace(/\D/g, '');
											$('#e_tarif4_v').val(rup3);
											rupiah8.value = formatRupiah3(this.value, 'Rp. ');
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
			Semua Data Pendaptan Lain guru
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
					url: "<?php echo base_url('modulpayroll/pendapatanlain/simpan') ?>",
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
			url: '<?php echo site_url('modulpayroll/pendapatanlain/tampil') ?>',
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
						'<td>' +
						'<button  href="#my-modal-edit" class="btn btn-xs btn-success item_edit" title="Edit" data-id="' + data[i].id + '">' +
						'<i class="ace-icon fa fa-trash-o bigger-120"> Edit</i>' +
						'</button> ' +
						'<button  href="#my-modal-edit" class="btn btn-xs btn-danger item_hapus" title="Hapus" data-id="' + data[i].id + '">' +
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
					url: "<?php echo base_url('modulpayroll/pendapatanlain/delete') ?>",
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

	$('#show_data').on('click', '.item_edit', function() {
		var id = $(this).data('id');
		$('#modalEdit').modal('show');
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('modulpayroll/pendapatanlain/tampil_byid') ?>",
			async: true,
			dataType: "JSON",
			data: {
				id: id,
			},
			success: function(data) {
				$('#e_id').val(data[0].id);
				$('#e_id_guru').val(data[0].IdGuru);

				$('#e_tjkinerja').val(data[0].tunjangan);
				$('#e_tjkinerja_v').val(data[0].tunjangan);
				$('#e_ket_tunj_khusus1').val(data[0].ket_tunj_khusus1);
				$('#e_ket_tunj_khusus2').val(data[0].ket_tunj_khusus2);
				$('#e_jam1').val(data[0].jam1);
				$('#e_jam2').val(data[0].jam2);
				$('#e_jam3').val(data[0].jam3);
				$('#e_jam4').val(data[0].jam4);



				var a = ConvertFormatRupiah(data[0].thr, 'Rp. ');
				$('#e_thr').val(a);
				$('#e_thr_v').val(data[0].thr);

				var b = ConvertFormatRupiah(data[0].tunjangan, 'Rp. ');
				$('#e_tjkinerja').val(b);
				$('#e_tjkinerja_v').val(data[0].tunjangan);

				var c = ConvertFormatRupiah(data[0].lain, 'Rp. ');
				$('#e_tjlain').val(c);
				$('#e_tjlain_v').val(data[0].lain);
				
				var e = ConvertFormatRupiah(data[0].tunj_khusus1, 'Rp. ');
				$('#e_tunj_khusus1').val(e);
				$('#e_tunj_khusus1_v').val(data[0].tunj_khusus1);
				
				var f = ConvertFormatRupiah(data[0].tunj_khusus2, 'Rp. ');
				$('#e_tunj_khusus2').val(f);
				$('#e_tunj_khusus2_v').val(data[0].tunj_khusus2);

				var g = ConvertFormatRupiah(data[0].tarif1, 'Rp. ');
				$('#e_tarif1').val(g);
				$('#e_tarif1_v').val(data[0].tarif1);

				var h = ConvertFormatRupiah(data[0].tarif2, 'Rp. ');
				$('#e_tarif2').val(h);
				$('#e_tarif2_v').val(data[0].tarif2);

				var i = ConvertFormatRupiah(data[0].tarif3, 'Rp. ');
				$('#e_tarif3').val(i);
				$('#e_tarif3_v').val(data[0].tarif3);

				var j = ConvertFormatRupiah(data[0].tarif4, 'Rp. ');
				$('#e_tarif4').val(j);
				$('#e_tarif4_v').val(data[0].tarif4);
				
				var k = ConvertFormatRupiah(data[0].inval, 'Rp. ');
				$('#e_inval').val(k);
				$('#e_inval_v').val(data[0].inval);
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
                    url: "<?php echo base_url('modulpayroll/pendapatanlain/update') ?>",
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
                            swalIdDouble('NIP Sudah Terdaftar');
                        } else {
                            swalEditFailed();
                        }
                    }
                });
            }
        })
	}


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

	if ($("#formImport").length > 0) {
            $("#formImport").validate({
                errorClass: "my-error-class",
                validClass: "my-valid-class",
                submitHandler: function(form) {
                    formdata = new FormData(form);
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url('modulpayroll/pendapatanlain/import') ?>",
                        data: formdata,
                        processData: false,
                        contentType: false,
                        cache: false,
                        async: false,
                        success: function(data) {
                            if (data == 1 || data == true) {
								$('#my-modal2').modal('hide');
                                document.getElementById("formImport").reset();
                                swalInputSuccess();
								show_data();
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
