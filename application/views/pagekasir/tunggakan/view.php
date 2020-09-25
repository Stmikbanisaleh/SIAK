<div class="row">
	<div class="col-xs-1">
		<button id="item-tambah" role="button" data-toggle="modal" class="btn btn-xs btn-warning">
			<a class="ace-icon fa fa-plus bigger-120"></a>Generate
		</button>
	</div>
	<br>
	<br>
</div>
<div id="modalTambah" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="smaller lighter blue no-margin">Form Generate <?= $page_name; ?></h3>
			</div>
			<form class="form-horizontal" role="form" id="formTambah">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12">
							<!-- PAGE CONTENT BEGINS -->
							<div class="form-group">
								<div class="col-xs-12">
									Tahun Masuk
									<select required class="form-control" name="thnmasuk" id="thnmasuk">
										<option>--Pilih Tahun Masuk--</option>
										<?php foreach ($my_tahun2 as $value) { ?>
											<option value=<?= $value['TAHUN'] ?>><?= $value['TAHUN'] ?></option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<div class="col-xs-12">
									Tahun Akademik
									<select required class="form-control" name="thnakad" id="thnakad">
										<option>--Pilih Tahun Akademik--</option>
										<?php foreach ($my_tahun as $value) { ?>
											<option value=<?= $value['THNAKAD'] ?>><?= $value['THNAKAD'] ?></option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<div class="col-xs-12">
									Unit Sekolah
									<select required class="form-control" name="ps" id="ps">
										<option>--Pilih Unit Sekolah--</option>
										<?php foreach ($myps as $value) { ?>
											<option value=<?= $value['KDTBPS'] ?>><?= $value['DESCRTBPS'] . ' - ' . $value['DESCRTBJS'] ?></option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<div class="col-xs-6">
									Kelas
									<select class="form-control" name="kelas" id="kelas">
										<option>--Pilih Kelas--</option>
										<?php foreach ($my_kelas as $value) { ?>
											<option value=<?= $value['id_kelas'] ?>><?= $value['nama']?></option>
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
<div id="modalEdit" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="smaller lighter blue no-margin">Form Edit Data <?= $page_name; ?></h3>
			</div>
			<form class="form-horizontal" role="form" id="formEdit">
				<div class="modal-body">
					<div class="row">
						<div class="col-xs-12">
							<input type="hidden" id="e_id" name="e_id" placeholder="Rp.1000.000" class="form-control" />
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nama </label>
								<div class="col-xs-6">
									<select class="form-control" disabled name="e_siswa" id="e_siswa">
										<option>--Pilih Siswa--</option>
										<?php foreach ($my_siswa as $value) { ?>
											<option value=<?= $value['NOINDUK'] ?>><?= $value['NOINDUK'] . " - " . $value['NMSISWA'] ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Total tagihan </label>
								<div class="col-sm-6">
									<input type="text" id="e_tot_tagihan" name="e_tot_tagihan" placeholder="Rp.1000.000" class="form-control" />
									<input type="hidden" class="form-control" name="e_tot_tagihan_v" placeholder="Rp.1000.000" id="e_tot_tagihan_v" />
									<script language="JavaScript">
										var rupiah1 = document.getElementById('e_tot_tagihan');
										rupiah1.addEventListener('keyup', function(e) {
											// tambahkan 'Rp.' pada saat form di ketik
											// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
											rup = this.value.replace(/\D/g, '');
											$('#e_tot_tagihan_v').val(rup);
											rupiah1.value = formatRupiah(this.value, 'Rp. ');
										});
									</script>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Bayar </label>
								<div class="col-sm-6">
									<input type="text" id="e_bayar" name="e_bayar" placeholder="Rp.1000.000" class="form-control" />
									<input type="hidden" class="form-control" name="e_bayar_v" placeholder="Rp.1000.000" id="e_bayar_v" />
									<script language="JavaScript">
										var rupiah2 = document.getElementById('e_bayar');
										rupiah2.addEventListener('keyup', function(e) {
											// tambahkan 'Rp.' pada saat form di ketik
											// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
											rup2 = this.value.replace(/\D/g, '');
											$('#e_bayar_v').val(rup2);
											rupiah2.value = formatRupiah(this.value, 'Rp. ');
										});
									</script>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Sisa </label>
								<div class="col-sm-6">
									<input type="text" id="e_sisa" name="e_sisa" placeholder="Rp.1000.000" class="form-control" />
									<input type="hidden" class="form-control" name="e_sisa_v" placeholder="Rp.1000.000" id="e_sisa_v" />
									<script language="JavaScript">
										var rupiah3 = document.getElementById('e_sisa');
										rupiah3.addEventListener('keyup', function(e) {
											// tambahkan 'Rp.' pada saat form di ketik
											// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
											rup3 = this.value.replace(/\D/g, '');
											$('#e_sisa_v').val(rup3);
											rupiah3.value = formatRupiah(this.value, 'Rp. ');
										});
									</script>
								</div>
							</div>
						</div>
					</div>
				</div>
		</div>
		<div class="modal-footer">
			<button type="submit" id="btn_edit" class="btn btn-sm btn-success pull-left">
				<i class="ace-icon fa fa-save"></i>
				Ubah
			</button>
			<button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
				<i class="ace-icon fa fa-times"></i>
				Batal
			</button>
		</div>
		</form>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<div class="row">
	<div class="col-xs-12">
		<div class="table-header">
			Semua Data
		</div>
	</div>
</div>
<br>
<div class="table-responsive">
	<table id="datatable_tabletools" class="display">
		<thead>
			<tr>
				<th>No</th>
				<th>No Induk</th>
				<th>Nama</th>
				<th>Total Tagihan</th>
				<th>Bayar</th>
				<th>Sisa</th>
				<th>Tahun Akademik</th>
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

	$('#item-tambah').on('click', function() {
		$('#modalTambah').modal('show');
	});

	if ($("#formTambah").length > 0) {
		$("#formTambah").validate({
			errorClass: "my-error-class",
			validClass: "my-valid-class",
			submitHandler: function(form) {
				$('#btn_simpan').html('Sending..');
				$.ajax({
					url: "<?php echo base_url('modulkasir/tunggakan/generate') ?>",
					type: "POST",
					data: $('#formTambah').serialize(),
					dataType: "json",
					success: function(response) {
						$('#btn_simpan').html('<i class="ace-icon fa fa-save"></i>' +
							'Simpan');
						if (response == true) {
							document.getElementById("formTambah").reset();
							swalInputSuccess();
							show_data();
							$('#modalTambah').modal('hide');
						} else if (response == 401) {} else {
							swalInputFailed();
						}
						// setTimeout(function(){
						// // $('#res_message').hide();
						// // $('#msg_div').hide();
						// },3000);
					}
				});
			}
		})
	}

	//function show all Data
	function show_data() {
		$.ajax({
			type: 'POST',
			url: '<?php echo site_url('modulkasir/tunggakan/tampil') ?>',
			async: true,
			dataType: 'json',
			success: function(data) {
				var html = '';
				var i = 0;
				var no = 1;
				for (i = 0; i < data.length; i++) {
					html += '<tr>' +
						'<td class="text-left">' + no + '</td>' +
						'<td class="text-left">' + data[i].NIS + '</td>' +
						'<td class="text-left">' + data[i].Namacasis + '</td>' +
						'<td class="text-right">' + data[i].totaltagihan2 + '</td>' +
						'<td class="text-right">' + data[i].bayar2 + '</td>' +
						'<td class="text-right">' + data[i].sisa2 + '</td>' +
						'<td class="text-left">' + data[i].TA + '</td>' +
						'<td class="text-center">' +
						'<button  href="#my-modal-edit" class="btn btn-xs btn-info item_edit" title="Edit" data-id="' + data[i].idsaldo + '">' +
						'<i class="ace-icon fa fa-pencil bigger-120"></i>' +
						'</button>' +
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
		document.getElementById("formEdit").reset();
		var id = $(this).data('id');
		$('#modalEdit').modal('show');
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('modulkasir/tunggakan/tampil_byid') ?>",
			async: true,
			dataType: "JSON",
			data: {
				id: id,
			},
			success: function(data) {
				$('#e_id').val(data[0].idsaldo);
				$('#e_siswa').val(data[0].NIS);
				$('#e_tot_tagihan').val(data[0].TotalTagihan);
				$('#e_tot_tagihan_v').val(data[0].TotalTagihan);
				$('#e_bayar').val(data[0].Bayar);
				$('#e_bayar_v').val(data[0].Bayar);
				$('#e_sisa').val(data[0].Sisa);
				$('#e_sisa_v').val(data[0].Sisa);
			}
		});
	});

	if ($("#formEdit").length > 0) {
		$("#formEdit").validate({
			errorClass: "my-error-class",
			validClass: "my-valid-class",
			rules: {
				e_tot_tagihan_v: {
					required: true,
				},
				e_bayar_v: {
					required: true,
				},
				e_sisa_v: {
					required: true,
					minlength: 10,
				},
			},
			messages: {
				e_tot_tagihan_v: {
					required: "Total tagihan harus diisi!"
				},
				e_bayar_v: {
					required: "Bayar harus diisi!"
				},
				e_sisa_v: {
					required: "Sisa harus diisi!"
				},
			},
			submitHandler: function(form) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url('modulkasir/tunggakan/update') ?>",
					dataType: "JSON",
					data: $('#formEdit').serialize(),
					success: function(data) {
						$('#modalEdit').modal('hide');
						if (data == 1) {
							document.getElementById("formEdit").reset();
							swalEditSuccess();
							show_data();
						} else if (data == 401) {
							document.getElementById("formEdit").reset();
							swalIdDouble();
						} else {
							document.getElementById("formEdit").reset();
							swalEditFailed();
						}
					}
				});
				return false;
			}
		});
	}

	function formatRupiah(angka, prefix) {
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
