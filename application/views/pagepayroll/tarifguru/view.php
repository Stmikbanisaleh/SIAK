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
							<div class="text-center"> TARIF GURU </div>
							<hr>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Guru </label>
								<div class="col-sm-9">
									<select class="form-control" required name="guru" id="guru">
										<option value="">-- Pilih Guru --</option>
										<?php foreach ($my_guru as $value) { ?>
											<option value=<?= $value['IdGuru'] ?>><?php echo "[".$value['IdGuru']."] - ".$value['GuruNama'] ?></option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Gaji Guru </label>
								<div class="col-sm-9">
									<input type="text" id="tarif_guru" required name="tarif_guru" placeholder="Rp. 10.0000" class="form-control" />
									<input type="hidden" id="tarif_guru_v" required name="tarif_guru_v" />
									<script language="JavaScript">
										var rupiah1 = document.getElementById('tarif_guru');
										rupiah1.addEventListener('keyup', function(e) {
											rup1 = this.value.replace(/\D/g, '');
											$('#tarif_guru_v').val(rup1);
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
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tunjangan Masa Kerja </label>
								<div class="col-sm-9">
									<input type="text" id="tunjangan_masa_kerja" required name="tunjangan_masa_kerja" placeholder="Rp. 10.0000" class="form-control" />
									<input type="hidden" id="tunjangan_masa_kerja_v" required name="tunjangan_masa_kerja_v" />
									<script language="JavaScript">
										var rupiah3 = document.getElementById('tunjangan_masa_kerja');
										rupiah3.addEventListener('keyup', function(e) {
											rup3 = this.value.replace(/\D/g, '');
											$('#tunjangan_masa_kerja_v').val(rup3);
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
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tarif Per Jam </label>
								<div class="col-sm-9">
									<input type="text" id="tarif_jam" required name="tarif_jam" placeholder="Rp. 10.0000" class="form-control" />
									<input type="hidden" id="tarif_jam_v" required name="tarif_jam_v" />
									<script language="JavaScript">
										var rupiah01 = document.getElementById('tarif_jam');
										rupiah01.addEventListener('keyup', function(e) {
											rup1 = this.value.replace(/\D/g, '');
											$('#tarif_jam_v').val(rup1);
											rupiah01.value = formatRupiah1(this.value, 'Rp. ');
										});

										function formatRupiah1(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah01= split[0].substr(0, sisa),
												ribuan01= split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan01) {
												separator = sisa ? '.' : '';
												rupiah01 += separator + ribuan01.join('.');
											}

											rupiah01 = split[1] != undefined ? rupiah01 + ',' + split[1] : rupiah01;
											return prefix == undefined ? rupiah01 : (rupiah01 ? 'Rp. ' + rupiah01 : '');
										}
									</script>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tarif Inval Per Jam </label>
								<div class="col-sm-9">
									<input type="text" id="tarif_inval" required name="tarif_inval" placeholder="Rp. 10.0000" class="form-control" />
									<input type="hidden" id="tarif_inval_v" required name="tarif_inval_v" />
									<script language="JavaScript">
										var rupiah0 = document.getElementById('tarif_inval');
										rupiah0.addEventListener('keyup', function(e) {
											rup1 = this.value.replace(/\D/g, '');
											$('#tarif_inval_v').val(rup1);
											rupiah0.value = formatRupiah1(this.value, 'Rp. ');
										});

										function formatRupiah1(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah0= split[0].substr(0, sisa),
												ribuan0 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan0) {
												separator = sisa ? '.' : '';
												rupiah0 += separator + ribuan0.join('.');
											}

											rupiah0 = split[1] != undefined ? rupiah0 + ',' + split[1] : rupiah0;
											return prefix == undefined ? rupiah0 : (rupiah0 ? 'Rp. ' + rupiah0 : '');
										}
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
				<th>Nama Lengkap</th>
                <th>Tarif</th>
                <th>Status</th>
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
			url: '<?php echo site_url('modulpayroll/tarif_guru/tampil') ?>',
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
						'<td class="text-left">' + data[i].GuruNama + '</td>' +
						'<td >' + data[i].Nominal2 + '</td>' +
                        '<td>' + data[i].nama_pembayaran + '</td>' +
						'<td >' +
                        '<button  href="#my-modal-edit" class="btn btn-xs btn-danger item_hapus" title="Hapus" data-id="' + data[i].idt + '">' +
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
					url: "<?php echo base_url('modulpayroll/tarif_guru/delete') ?>",
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

	if ($("#formTambah").length > 0) {
		$("#formTambah").validate({
			errorClass: "my-error-class",
			validClass: "my-valid-class",
			submitHandler: function(form) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url('modulpayroll/tarif_guru/simpan') ?>",
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
</script>