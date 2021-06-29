<div class="row">
	<form class="form-horizontal" role="form" id="formSearch">
		<div class="col-xs-3">
			<select class="form-control" name="tahun" id="tahun">
				<option value=>--Pilih Tahun--</option>
				<?php foreach ($mytahun as $value) { ?>
					<option value=<?= $value['TAHUN'] ?>><?= $value['TAHUN'] ?></option>
				<?php } ?>
			</select>
		</div>

		<div class="col-xs-3">
			<select class="form-control" name="programsekolah" id="programsekolah">
				<option value=>--Pilih Program --</option>
				<?php foreach ($myps as $value) { ?>
					<option value=<?= $value['KDTBPS'] ?>><?= $value['DESCRTBPS'] . '-' . $value['DESCRTBJS'] ?></option>
				<?php } ?>
			</select>
		</div>

		<div class="col-xs-3">
			<select select required class="form-control" name="jadwal" id="jadwal">
				<option value="0">-- Pilih Jadwal --</option>
			</select>
		</div>

		<div class="col-xs-1">
			<button type="submit" id="btn_search" class="btn btn-sm btn-success pull-left">
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
				<h3 class="smaller lighter blue no-margin">Form Import Data <?= $page_name; ?></h3>
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
									<a href="<?php echo base_url() . 'assets/siswa.xls'; ?>" for="form-field-1"> Download Sample Format </label></a>
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
<div class="row">
	<div class="col-xs-12">
		<div class="table-header">
			Semua Data <?= $page_name; ?>
		</div>
	</div>
</div>
<br>
<div class="table-responsive">
	<table id="table_id" class="display">
		<thead>
			<tr>
				<th>Nama Siswa</th>
				<th>Matapelajaran</th>
				<th>Kelas</th>
				<th>Periode</th>
				<th>Action</>
			</tr>
		</thead>
		<tbody id="show_data">
		</tbody>
	</table>
</div>
<script>
	if ($("#formSearch").length > 0) {
		$("#formSearch").validate({
			errorClass: "my-error-class",
			validClass: "my-valid-class",
			rules: {
				nopembayaran: {
					required: false
				},

				tahun: {
					required: false
				},
			},
			submitHandler: function(form) {
				$('#btn_search').html('Searching..');
				$.ajax({
					type: 'POST',
					url: '<?php echo site_url('siswaperjadwal/search') ?>',
					data: $('#formSearch').serialize(),
					async: true,
					dataType: 'json',
					success: function(data) {
						$('#btn_search').html('<i class="ace-icon fa fa-search"></i>' +
							'Periksa');
						var html = '';
						var i = 0;
						var no = 1;
						for (i = 0; i < data.length; i++) {
							html += '<tr>' +
								'<td>' + data[i].nmsiswa + '</td>' +
								'<td>' + data[i].mapel + '</td>' +
								'<td>' + data[i].nmklstrjdk + '</td>' +
								'<td>' + data[i].periode + '</td>' +
								'<td class="text-center">' +
								'<button class="btn btn-xs btn-danger item_hapus" title="Delete" data-id="' + data[i].id + '">' +
								'<i class="ace-icon fa fa-trash-o bigger-120"></i>' +
								'</button>' +
								'</td>' +
								'</tr>';
							no++;
						}
						$("#table_id").dataTable().fnDestroy();
						var a = $('#show_data').html(html);
						//                    $('#mydata').dataTable();
						if (a) {
							$('#table_id').dataTable({
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
		})
	}

	$(document).ready(function() {
		$('#table_id').DataTable();
		$("#programsekolah").change(function() {
			var ps = $('#programsekolah').val();
			var tahun = $('#tahun').val();

			$.ajax({
				type: "POST",
				url: "siswaperjadwal/showjadwal",
				data: {
					ps: ps,
					tahun: tahun
				}
			}).done(function(data) {
				$("#jadwal").html(data);
			});
		});
	});

	//show modal tambah
	$('#item-tambah').on('click', function() {
		$('#modalTambah').modal('show');
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
					url: "<?php echo base_url('siswaperjadwal/delete') ?>",
					async: true,
					dataType: "JSON",
					data: {
						id: id,
					},
					success: function(data) {
						Swal.fire(
							'Terhapus!',
							'Data sudah dihapus.',
							'success'
						)
					}
				});
			}
		})
	})
	
</script>
