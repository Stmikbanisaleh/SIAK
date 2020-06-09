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
<div id="my-modal" class="modal fade" tabindex="-1">
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
						<form class="form-horizontal" role="form" id="formEdit">
                            <input type="hidden" id="id" required name="e_id" />

                            <div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Guru </label>
								<div class="col-sm-9">
									<select class="form-control" name="IdGuru" id="IdGuru">
										<option value="">-- Pilih Guru --</option>
										<?php foreach ($mypendidikan as $value) { ?>
											<option value=<?= $value['id'] ?>><?= $value['GuruNama'] ?></option>
										<?php } ?>
									</select>
								</div>
                            </div>
                            
                            <div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Jenis Potongan </label>
								<div class="col-sm-9">
									<select class="form-control" name="PotonganNama" id="PotonganNama">
                                        <option value="">-- Pilih Jenis Potongan --</option>
                                        <option value="Arisan">Arisan</option>
                                        <option value="Asuransi Kesehatan">Asuransi Kesehatan</option>
                                        <option value="Kasbon">Kasbon</option>
									</select>
								</div>
							</div>

                            <div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tarif Potongan </label>
								<div class="col-sm-9">
                                <input type="text" id="PotongTarif" required name="PotongTarif" placeholder="Tarif Potongan" class="form-control" />
								</div>
                            </div>
                            
                            <div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Periode </label>
								<div class="col-sm-9">
									<select class="form-control" name="PotonganNama" id="PotonganNama">
                                        <option value="">-- Pilih Periode --</option>
                                        <option value="Bulanan">Bulanan</option>
                                        <option value="Periodik">Periodik</option>
									</select>
								</div>
                            </div>
                            
                            <div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Status </label>
								<div class="col-sm-9">
									<select class="form-control" name="PotonganNama" id="PotonganNama">
                                        <option value="">-- Pilih Keterangan --</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Non-aktif">Non-aktif</option>
									</select>
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
				<h3 class="smaller lighter blue no-margin">Form Edit Data Karyawan</h3>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						<!-- PAGE CONTENT BEGINS -->
						<form class="form-horizontal" role="form" id="formEdit">

                            <input type="hidden" id="id" required name="e_id" />

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Guru </label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="IdGuru" id="IdGuru">
                                        <option value="">-- Pilih Guru --</option>
                                        <?php foreach ($mypendidikan as $value) { ?>
                                            <option value=<?= $value['id'] ?>><?= $value['GuruNama'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Jenis Potongan </label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="PotonganNama" id="PotonganNama">
                                        <option value="">-- Pilih Jenis Potongan --</option>
                                        <option value="Arisan">Arisan</option>
                                        <option value="Asuransi Kesehatan">Asuransi Kesehatan</option>
                                        <option value="Kasbon">Kasbon</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tarif Potongan </label>
                                <div class="col-sm-9">
                                <input type="text" id="PotongTarif" required name="PotongTarif" placeholder="Tarif Potongan" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Periode </label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="PotonganNama" id="PotonganNama">
                                        <option value="">-- Pilih Periode --</option>
                                        <option value="Bulanan">Bulanan</option>
                                        <option value="Periodik">Periodik</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Status </label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="PotonganNama" id="PotonganNama">
                                        <option value="">-- Pilih Keterangan --</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Non-aktif">Non-aktif</option>
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
				<th>Guru</th>
				<th>Potongan</th>
				<th>Jenis Potongan</th>
				<th>Periode</th>
				<th>Status Potongan</th>
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
			url: '<?php echo site_url('modulpayroll/master_potongan/tampil') ?>',
			async: true,
			dataType: 'json',
			success: function(data) {
				var html = '';
				var i = 0;
				var no = 1;
				for (i = 0; i < data.length; i++) {
					html += '<tr>' +
						'<td class="text-center">' + no + '</td>' +
						'<td class="text-center">' + data[i].GuruNama + '</td>' +
						'<td>' + data[i].PotongTarif + '</td>' +
						'<td>' + data[i].PotongNama + '</td>' +
						'<td>' + data[i].PotongPeriode + '</td>' +
                        '<td>' + data[i].PotongStatus + '</td>' +
						'<td >' +
						'<button  href="#my-modal-edit" class="btn btn-xs btn-info item_edit" title="Edit" data-id="' + data[i].id + '">' +
						'<i class="ace-icon fa fa-pencil bigger-120"> Edit </i>' +
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

    $('#show_data').on('click', '.item_edit_tarif', function() {
		var id = $(this).data('id');
		$('#modalEditTarif').modal('show');
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
					url: "<?php echo base_url('modulpayroll/biodataguru/delete') ?>",
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