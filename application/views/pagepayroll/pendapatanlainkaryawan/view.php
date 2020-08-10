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
				<h3 class="smaller lighter blue no-margin">Form Tambah <?= $page_name ?></h3>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						<!-- PAGE CONTENT BEGINS -->
						<form class="form-horizontal" role="form" id="formTambah">
                            <div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Karyawan </label>
								<div class="col-sm-9">
									<select class="form-control" name="nip" id="nip">
										<option value="">-- Pilih Karyawan --</option>
										<?php foreach ($mykaryawan as $value) { ?>
											<option value=<?= $value['nip'] ?>><?= $value['nama'] ?></option>
										<?php } ?>
									</select>
								</div>
                            </div>
                            
                            <div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> THR </label>
								<div class="col-sm-9">
								<input type="text" id="thr" required name="thr" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="thr_v" required name="thr_v"/>
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
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tunjangan Lain Lain</label>
								<div class="col-sm-9">
								<input type="text" id="tjlain" required name="tjlain" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="tjlain_v" required name="tjlain_v"/>
								<script language="JavaScript">
										var rupiah5 = document.getElementById('tjlain');
										rupiah5.addEventListener('keyup', function(e) {
											rup5 = this.value.replace(/\D/g, '');
											$('#tjlain_v').val(rup5);
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
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tunjangan Malam / Lembur</label>
								<div class="col-sm-9">
								<input type="text" id="tj_malam_lembur" required name="tj_malam_lembur" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="tj_malam_lembur_v" required name="tj_malam_lembur_v"/>
								<script language="JavaScript">
										var rupiah6 = document.getElementById('tj_malam_lembur');
										rupiah6.addEventListener('keyup', function(e) {
											rup6 = this.value.replace(/\D/g, '');
											$('#tj_malam_lembur_v').val(rup6);
											rupiah6.value = formatRupiah6(this.value, 'Rp. ');
										});

										function formatRupiah6(angka, prefix) {
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
											return prefix == undefined ? rupiah5 : (rupiah6 ? 'Rp. ' + rupiah6 : '');
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
								<input type="text" id="tunj_khusus1"  name="tunj_khusus1" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="tunj_khusus1_v"  name="tunj_khusus1_v"/>
								<script language="JavaScript">
										var rupiah9 = document.getElementById('tunj_khusus1');
										rupiah9.addEventListener('keyup', function(e) {
											rup6 = this.value.replace(/\D/g, '');
											$('#tunj_khusus1_v').val(rup6);
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
									<input type="text" id="ket_tunj_khusus2" name="ket_tunj_khusus2" placeholder="Keterangan" class="form-control">
								</div>
                            </div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tunjangan Khusus 2</label>
								<div class="col-sm-9">
								<input type="text" id="tunj_khusus2"  name="tunj_khusus2" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="tunj_khusus2_v"  name="tunj_khusus2_v"/>
								<script language="JavaScript">
										var rupiah10 = document.getElementById('tunj_khusus2_v');
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
							<input type="hidden" id="e_id"  required name="e_id"/>
                            <div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Karyawan </label>
								<div class="col-sm-9">
									<select class="form-control" name="e_nip" id="e_nip">
										<option value="">-- Pilih Karyawan --</option>
										<?php foreach ($mykaryawan as $value) { ?>
											<option value=<?= $value['nip'] ?>><?= $value['nama'] ?></option>
										<?php } ?>
									</select>
								</div>
                            </div>
                            
                            <div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> THR </label>
								<div class="col-sm-9">
								<input type="text" id="e_thr" required name="e_thr" placeholder="THR " class="form-control" />
                                <input type="hidden" id="e_thr_v" required name="e_thr_v"/>
								<script language="JavaScript">
										var e_rupiah3 = document.getElementById('e_thr');
										e_rupiah3.addEventListener('keyup', function(e) {
											rup3 = this.value.replace(/\D/g, '');
											$('#e_thr_v').val(rup3);
											e_rupiah3.value = formatRupiah3(this.value, 'Rp. ');
										});

										function formatRupiah3(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												e_rupiah3 = split[0].substr(0, sisa),
												e_ribuan3 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (e_ribuan3) {
												separator = sisa ? '.' : '';
												e_rupiah3 += separator + e_ribuan3.join('.');
											}

											e_rupiah3 = split[1] != undefined ? e_rupiah3 + ',' + split[1] : e_rupiah3;
											return prefix == undefined ? e_rupiah3 : (e_rupiah3 ? 'Rp. ' + e_rupiah3 : '');
										}
									</script>
								</div>
                            </div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tunjangan Lain Lain</label>
								<div class="col-sm-9">
								<input type="text" id="e_tjlain" required name="e_tjlain" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="e_tjlain_v" required name="e_tjlain_v"/>
								<script language="JavaScript">
										var e_rupiah5 = document.getElementById('e_tjlain');
										e_rupiah5.addEventListener('keyup', function(e) {
											rup5 = this.value.replace(/\D/g, '');
											$('#e_tjlain_v').val(rup5);
											e_rupiah5.value = formatRupiah5(this.value, 'Rp. ');
										});

										function formatRupiah5(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												e_rupiah5 = split[0].substr(0, sisa),
												ribuan5 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan5) {
												separator = sisa ? '.' : '';
												e_rupiah5 += separator + ribuan5.join('.');
											}

											e_rupiah5 = split[1] != undefined ? e_rupiah5 + ',' + split[1] : e_rupiah5;
											return prefix == undefined ? e_rupiah5 : (e_rupiah5 ? 'Rp. ' + e_rupiah5 : '');
										}
									</script>
								</div>
                            </div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tunjangan Malam / Lembur</label>
								<div class="col-sm-9">
								<input type="text" id="e_tj_malam_lembur" required name="e_tj_malam_lembur" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="e_tj_malam_lembur_v" required name="e_tj_malam_lembur_v"/>
								<script language="JavaScript">
										var e_rupiah6 = document.getElementById('e_tj_malam_lembur');
										e_rupiah6.addEventListener('keyup', function(e) {
											rup6 = this.value.replace(/\D/g, '');
											$('#e_tj_malam_lembur_v').val(rup6);
											e_rupiah6.value = formatRupiah6(this.value, 'Rp. ');
										});

										function formatRupiah6(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												e_rupiah6 = split[0].substr(0, sisa),
												ribuan6 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan6) {
												separator = sisa ? '.' : '';
												e_rupiah6 += separator + ribuan6.join('.');
											}

											e_rupiah6 = split[1] != undefined ? e_rupiah6 + ',' + split[1] : e_rupiah6;
											return prefix == undefined ? rupiah5 : (e_rupiah6 ? 'Rp. ' + e_rupiah6 : '');
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
								<input type="text" id="e_tunj_khusus1" required name="e_tunj_khusus1" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="e_tunj_khusus1_v" required name="e_tunj_khusus1_v"/>
								<script language="JavaScript">
										var e_rupiah9 = document.getElementById('e_tunj_khusus1');
										e_rupiah9.addEventListener('keyup', function(e) {
											rup6 = this.value.replace(/\D/g, '');
											$('#e_tunj_khusus1_v').val(rup6);
											e_rupiah9.value = formatRupiah9(this.value, 'Rp. ');
										});

										function formatRupiah9(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												e_rupiah9 = split[0].substr(0, sisa),
												ribuan6 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan6) {
												separator = sisa ? '.' : '';
												e_rupiah9 += separator + ribuan6.join('.');
											}

											e_rupiah9 = split[1] != undefined ? e_rupiah9 + ',' + split[1] : e_rupiah9;
											return prefix == undefined ? rupiah5 : (e_rupiah9 ? 'Rp. ' + e_rupiah9 : '');
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
								<input type="text" id="e_tunj_khusus2" required name="e_tunj_khusus2" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="e_tunj_khusus2_v" required name="e_tunj_khusus2_v"/>
								<script language="JavaScript">
										var e_rupiah10 = document.getElementById('e_tunj_khusus2');
										e_rupiah10.addEventListener('keyup', function(e) {
											rup6 = this.value.replace(/\D/g, '');
											$('#e_tunj_khusus2_v').val(rup6);
											e_rupiah10.value = formatRupiah6(this.value, 'Rp. ');
										});

										function formatRupiah6(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												e_rupiah10 = split[0].substr(0, sisa),
												ribuan6 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan6) {
												separator = sisa ? '.' : '';
												e_rupiah10 += separator + ribuan6.join('.');
											}

											e_rupiah10 = split[1] != undefined ? e_rupiah10 + ',' + split[1] : e_rupiah10;
											return prefix == undefined ? rupiah5 : (e_rupiah10 ? 'Rp. ' + e_rupiah10 : '');
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
			Semua Data Pendapatan Lain Karyawan
		</div>
	</div>
</div>
<div class="table-responsive">
	<table id="datatable_tabletools" class="display">
		<thead>
			<tr>
				<th>No</th>
				<th>Kode Karyawan</th>
				<th>Nama Karyawan</th>
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
					url: "<?php echo base_url('modulpayroll/pendapatanlainkaryawan/simpan') ?>",
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
			url: '<?php echo site_url('modulpayroll/pendapatanlainkaryawan/tampil') ?>',
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
						'<td>' + data[i].nama + '</td>' +
						'<td>' +
						'<button  href="#my-modal-edit" class="btn btn-xs btn-info item_edit" title="Edit" data-id="' + data[i].id + '">' +
						'<i class="ace-icon fa fa-pencil bigger-120"> Edit</i>' +
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

	$('#show_data').on('click', '.item_edit', function() {
		var id = $(this).data('id');
		$('#modalEdit').modal('show');
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('modulpayroll/pendapatanlainkaryawan/tampil_byid') ?>",
			async: true,
			dataType: "JSON",
			data: {
				id: id,
			},
			success: function(data) {
				$('#e_id').val(data[0].id);
				$('#e_nip').val(data[0].nip);
				$('#e_ket_tunj_khusus1').val(data[0].ket_tunj_khusus1);
				$('#e_ket_tunj_khusus2').val(data[0].ket_tunj_khusus2);

				var a = ConvertFormatRupiah(data[0].thr, 'Rp. ');
				$('#e_thr').val(a);
				$('#e_thr_v').val(data[0].thr);

				var b = ConvertFormatRupiah(data[0].tunjangan, 'Rp. ');
				$('#e_tjkinerja').val(b);
				$('#e_tjkinerja_v').val(data[0].tunjangan);

				var c = ConvertFormatRupiah(data[0].lain, 'Rp. ');
				$('#e_tjlain').val(c);
				$('#e_tjlain_v').val(data[0].lain);
				
				var d = ConvertFormatRupiah(data[0].tj_malam_lembur, 'Rp. ');
				$('#e_tj_malam_lembur').val(d);
				$('#e_tj_malam_lembur_v').val(data[0].tj_malam_lembur);

				var e = ConvertFormatRupiah(data[0].tunj_khusus1, 'Rp. ');
				$('#e_tunj_khusus1').val(e);
				$('#e_tunj_khusus1_v').val(data[0].tunj_khusus1);
				
				var f = ConvertFormatRupiah(data[0].tunj_khusus2, 'Rp. ');
				$('#e_tunj_khusus2').val(f);
				$('#e_tunj_khusus2_v').val(data[0].tunj_khusus2);
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
                    url: "<?php echo base_url('modulpayroll/pendapatanlainkaryawan/update') ?>",
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
					url: "<?php echo base_url('modulpayroll/pendapatanlainkaryawan/delete') ?>",
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