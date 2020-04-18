<div class="row">
	<form class="form-horizontal" role="form" id="formSearch">
		<div class="col-xs-3">
			<select class="form-control tahun" name="tahun" id="tahun">
				<option value="0">--Pilih Tahun--</option>
				<?php foreach ($mytahun as $value) { ?>
					<option value=<?= $value['tahun'] ?>><?= $value['tahun'] ?></option>
				<?php } ?>
			</select>
		</div>
		<td>
			<div class="col-xs-3">
				<select class="form-control" name="nopembayaran" id="nopembayaran">
					<option value="0">--Pilih Program--</option>
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
				<h3 class="smaller lighter blue no-margin">Form Import Data Jenis Pengeluaran</h3>
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
									<a label class="col-sm-3" for="form-field-1"> Download Sample Format </label></a>
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

<div id="my-modal" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="smaller lighter blue no-margin">Form Input Data Jenis Pengeluaran</h3>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						<!-- PAGE CONTENT BEGINS -->
						<form class="form-horizontal" role="form" id="formTambah">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Jenis Transaksi </label>
								<div class="col-sm-6">
									<input type="text" id="JnsTransaksi" required name="JnsTransaksi" placeholder="Jenis Transaksi" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Rekening </label>
								<div class="col-sm-9">
									<select class="form-control" name="no_jurnal" id="pendidikan_terakhir">
										<option value="">-- Pilih --</option>
										<?php foreach ($myjurnal as $value) { ?>
											<option value=<?= $value['no_jurnal'] ?>><?= $value['kode_jurnal'] . " - " . $value['nama_jurnal'] ?></option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nama Transaksi </label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="NamaTransaksi" id="NamaTransaksi" placeholder="Nama Transaksi" />
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
			Semua Data guru
		</div>
	</div>
</div>
<div class="table-responsive">
	<table id="datatable_tabletools" class="display">
		<thead>
			<tr>
				<th>No</th>
				<th>No Bukti</th>
				<th>Tanggal</th>
				<th>Debet</th>
				<th>Kredit</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody id="show_data">
		</tbody>
	</table>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		// show_data();
		$('#datatable_tabletools').DataTable();
		$("#tahun").change(function() {
			var tahun = $('#tahun').val();
			$.ajax({
				type: "POST",
				url: "buk/show_nopem",
				data: {
					tahun: tahun
				}
			}).done(function(data) {
				$("#nopembayaran").html(data);
			});
		});

	});

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
					url: '<?php echo site_url('modulakunting/buk/tampil') ?>',
					data: $('#formSearch').serialize(),
					async: true,
					dataType: 'json',
					success: function(data) {
						$('#btn_search').html('<i class="ace-icon fa fa-search"></i>' +
							'Periksa');
						var html = '';
						var i = 0;
						var no = 1;
						if (data.length == 0) {
							var a = $('#show_data').html('<tr>' +
								'<td></td>' +
								'<td></td>' +
								'<td></td>' +
								'<td></td>' +
								'<td></td>' +
								'<td></td>' +
								'</tr>');
							var b = $("#table_id").dataTable().fnDestroy();
							$('#table_id').dataTable({
								"bPaginate": true,
								"bLengthChange": false,
								"bFilter": true,
								"bInfo": false,
								"bAutoWidth": false
							});
						} else {
							for (i = 0; i < data.length; i++) {
								if (data[i].posting == 'T') {
									var button = '<button  href="#my-modal-edit" class="btn btn-xs btn-info item_posting" id="item_posting" title="" data-bukti="' + data[i].bukti + '" data-tgl="' + data[i].tgl + '">' +
										'Posting' +
										'</button> &nbsp';
								} else {
									var button = '<button class="btn btn-xs btn-danger item_batalp" id="item_batalp" title="" data-bukti="' + data[i].bukti + '" data-tgl="' + data[i].tgl + '">' +
										'Batal' +
										'</button>';
								}
								html += '<tr>' +
									'<td class="text-center">' + no + '</td>' +
									'<td>' + data[i].bukti + '</td>' +
									'<td>' + data[i].tgl1 + '</td>' +
									'<td>' + data[i].tdebet + '</td>' +
									'<td>' + data[i].tkredit + '</td>' +
									'<td class="text-center">' +
									'<div id="info"></div>' +
									button +
									'</td>' +
									'</tr>';
								no++;
							}
							$("#table_id").dataTable().fnDestroy();
							var a = $('#show_data').html(html);
							if (a) {
								$('#table_id').dataTable({
									"bPaginate": true,
									"bLengthChange": false,
									"bFilter": true,
									"bInfo": false,
									"bAutoWidth": false
								});
							}
						}

						/* END TABLETOOLS */
					}
				});

			}
		})
	}

	$('#show_data').on('click', '.item_posting', function() {
		// document.getElementById("formEdit").reset();
		var bukti = $(this).data('bukti');
		var tgl = $(this).data('tgl');
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('modulakunting/buk/posting') ?>",
			async: true,
			dataType: "JSON",
			data: {
				bukti: bukti,
				tgl: tgl,
			},
			success: function(data) {
				$('#item_posting').hide();
				$('#info').html('<div class="alert alert-info">' +
					'This alert needs your attention, but its not super important.' +
					'</div>');
			}
		});
	});

	$('#show_data').on('click', '.item_batalp', function() {
		var bukti = $(this).data('bukti');
		var tgl = $(this).data('tgl');
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('modulakunting/buk/batal_posting') ?>",
			async: true,
			dataType: "JSON",
			data: {
				bukti: bukti,
				tgl: tgl,
			},
			success: function(data) {
				$('#item_batalp').hide();
				$('#info').html('<div class="alert alert-info">' +
					data +
					'</div>');
			}
		});
	});
</script>