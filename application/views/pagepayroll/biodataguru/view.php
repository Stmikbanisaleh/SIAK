<div class="row">
</div>

<div id="modalEdit" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="smaller lighter blue no-margin">Form Detail Data Guru</h3>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						<!-- PAGE CONTENT BEGINS -->
						<form class="form-horizontal" role="form" id="formEdit">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Kode Guru</label>
								<div class="col-sm-6">
									<input type="text" id="e_IdGuru" readonly name="e_IdGuru" placeholder="kode Guru" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Kode Dapodik </label>
								<div class="col-sm-9">
									<input type="text" id="e_GuruNoDapodik" readonly required name="e_GuruNoDapodik" placeholder="kode Dapodik" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nama </label>
								<div class="col-sm-9">
									<input type="text" id="e_nama" readonly required name="e_nama" placeholder="Nama Guru" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Telepon </label>
								<div class="col-sm-9">
									<input type="text" id="e_telepon" readonly required name="e_telepon" placeholder="No Telp" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Alamat </label>
								<div class="col-sm-9">
									<textarea class="form-control" readonly required name="e_alamat" id="e_alamat" placeholder="Masukan Alamat"></textarea>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Program Sekolah </label>
								<div class="col-sm-9">
									<select class="form-control" disabled name="e_program_sekolah" id="e_program_sekolah">
										<option value="">-- Pilih Program --</option>
										<?php foreach ($myprogram as $value) { ?>
											<option value=<?= $value['id'] ?>> <?= $value['deskripsi']; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Jenis Kelamin </label>
								<div class="col-sm-9">
									<select class="form-control" disabled name="e_jenis_kelamin" id="e_jenis_kelamin">
										<option value="">-- Pilih Pengguna --</option>
										<option value="L">Laki-Laki</option>
										<option value="P">Perempuan</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Pendidikan Terakhir </label>
								<div class="col-sm-9">
									<select class="form-control" disabled name="e_pendidikan_terakhir" id="e_pendidikan_terakhir">
										<option value="">-- Pilih Pendidikan --</option>
										<?php foreach ($mypendidikan as $value) { ?>
											<option value=<?= $value['IDMSPENDIDIKAN'] ?>><?= $value['NMMSPENDIDIKAN'] ?></option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Agama </label>
								<div class="col-sm-9">
									<select class="form-control" disabled name="e_agama" id="e_agama">
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
									<input type="text" disabled class="form-control" name="e_email" id="e_email" placeholder="Email" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tanggal lahir </label>
								<div class="col-sm-9">
									<input type="date" disabled class="form-control" name="e_tgl_lahir" id="e_tgl_lahir" placeholder="24/10/1995"></textarea>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tempat Lahir </label>
								<div class="col-sm-9">
									<input type="text" disabled class="form-control" name="e_tempat_lahir" id="e_tempat_lahir" placeholder="Jakarta" />
								</div>
							</div>
					</div>
				</div>
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
				<th>Program Sekolah</th>
				<th>Kode</th>
				<th>Kode Dapodik</th>
				<th>Nama</th>
				<th>Telp</th>
				<th>Alamat</th>
				<th>Jenis Kelamin</th>
				<th>Pendidikan Terakhir</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody id="show_data">
		</tbody>
	</table>
</div>
<script type="text/javascript">
		if ($("#formEdit").length > 0) {
		$("#formEdit").validate({
			errorClass: "my-error-class",
			validClass: "my-valid-class",
			rules: {
				nama: {
					required: true,
				},
				telepon: {
					required: true,
					digits: true,
					maxlength: 14,
					minlength: 10,
				},
				alamat: {
					required: true,
					minlength: 10,
				},
				email: {
					required: true,
					email: true,
				},
			},
			messages: {
				nama: {
					required: "Nama Guru harus diisi!"
				},
				telepon: {
					required: "Telepon harus diisi!"
				},
				alamat: {
					required: "Harap Masukan alamat dengan benar!"
				},
			},
			submitHandler: function(form) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url('modulpayroll/biodataguru/update') ?>",
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

	$(document).ready(function() {
		show_data();
		$('#datatable_tabletools').DataTable();
	});

	$('#show_data').on('click', '.item_edit', function() {
		var id = $(this).data('id');
		$('#modalEdit').modal('show');
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('modulpayroll/biodataguru/tampil_byid') ?>",
			async: true,
			dataType: "JSON",
			data: {
				id: id,
			},
			success: function(data) {
				$('#e_id').val(data[0].id);
				$('#e_IdGuru').val(data[0].IdGuru);
				$('#e_GuruNoDapodik').val(data[0].GuruNoDapodik);
				$('#e_nama').val(data[0].GuruNama);
				$('#e_telepon').val(data[0].GuruTelp);
				$('#e_alamat').val(data[0].GuruAlamat);
				$('#e_program_sekolah').val(data[0].GuruBase);
				$('#e_jenis_kelamin').val(data[0].GuruJeniskelamin);
				$('#e_pendidikan_terakhir').val(data[0].GuruPendidikanAkhir);
				$('#e_agama').val(data[0].GuruAgama);
				$('#e_email').val(data[0].GuruEmail);
				$('#e_tgl_lahir').val(data[0].GuruTglLahir);
				$('#e_tempat_lahir').val(data[0].GuruTempatLahir);
				$('#e_status').val(data[0].GuruStatus);
			}
		});
    });
    
    $('#show_data').on('click', '.item_riwayatpendidikan', function() {
		var id = $(this).data('id');
		$('#modalRiwayatpendidikan').modal('show');
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('modulpayroll/biodataguru/tampil_byid') ?>",
			async: true,
			dataType: "JSON",
			data: {
				id: id,
			},
			success: function(data) {
				$('#e_idrp').val(data[0].id);
				$('#e_IdGururp').val(data[0].IdGuru);
				$('#e_GuruNoDapodikrp').val(data[0].GuruNoDapodik);
				$('#e_nama').val(data[0].GuruNama);
				$('#e_telepon').val(data[0].GuruTelp);
				$('#e_alamat').val(data[0].GuruAlamat);
				$('#e_program_sekolah').val(data[0].GuruBase);
				$('#e_jenis_kelamin').val(data[0].GuruJeniskelamin);
				$('#e_pendidikan_terakhirrp').val(data[0].GuruPendidikanAkhir);
				$('#e_agama').val(data[0].GuruAgama);
				$('#e_email').val(data[0].GuruEmail);
				$('#e_tgl_lahir').val(data[0].GuruTglLahir);
				$('#e_tempat_lahir').val(data[0].GuruTempatLahir);
				$('#e_status').val(data[0].GuruStatus);
			}
		});
	});

	//function show all Data
	function show_data() {
		$.ajax({
			type: 'POST',
			url: '<?php echo site_url('modulpayroll/biodataguru/tampil') ?>',
			async: true,
			dataType: 'json',
			success: function(data) {
				var html = '';
				var i = 0;
				var no = 1;
				for (i = 0; i < data.length; i++) {
					html += '<tr>' +
						'<td class="text-center">' + no + '</td>' +
						'<td class="text-center">' + data[i].deskripsi + '</td>' +
						'<td>' + data[i].IdGuru + '</td>' +
						'<td>' + data[i].GuruNoDapodik + '</td>' +
						'<td>' + data[i].GuruNama + '</td>' +
						'<td>' + data[i].GuruTelp + '</td>' +
						'<td>' + data[i].GuruAlamat + '</td>' +
						'<td>' + data[i].GuruJeniskelamin + '</td>' +
						'<td>' + data[i].NMMSPENDIDIKAN + '</td>' +
						'<td >' +
						'<button  href="#my-modal-edit" class="btn btn-xs btn-info item_edit" title="Edit" data-id="' + data[i].id + '">' +
						'<i class="ace-icon fa fa-eye bigger-120"> Lihat detail</i>' +
						'</button> ' + '<br>' + '<br>' + 
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
</script>