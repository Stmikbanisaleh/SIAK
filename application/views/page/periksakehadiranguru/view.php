
<div class="row">
	<form class="form-horizontal" target="_blank" method="POST" role="form" id="formSearch" action="<?php echo base_url() ?>modulkasir/lap_bayarsiswa/laporan_pdf">
		<div class="form-group">
			<label class="col-xs-2 control-label" for="form-field-select-1"> Pilih Nama Guru </label>
			<div class="col-sm-5">
				<select class="form-control" id="nama" name="nama">
					<option value=""></option>
					<option value="A">A</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-xs-2 control-label" for="form-field-select-1"> Pilih Mata Pelajaran </label>
			<div class="col-sm-5">
				<select class="form-control" id="id_mapel" name="id_mapel">
					<option value=""></option>
					<option value="1">1</option>
				</select>
			</div>
		</div>
		<div class="form-group">
		<label class="col-xs-2 control-label" for="form-field-select-1"> </label>
		<div class="col-sm-5">
			<button type="submit" id="btn_search" class="btn btn-sm btn-primary">
				<a class="ace-icon fa fa-search bigger-120"></a>Periksa
			</button>
		</div>
		</div>
	</form>
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
				<th class="col-md-1">No</th>
				<th>Nama Guru</th>
				<th>Mata Pelajaran</th>
				<th>Tanggal</th>
				<th>Mulai</th>
				<th>Inval</th>
				<th>Ket. Tidak Hadir</th>
				<th>Ganti Hari</th>
				<th>Tambahan</th>
				<th>Batal</th>
			</tr>
		</thead>
		<tbody id="show_data">
		</tbody>
	</table>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		show_data();
		$('#table_id').DataTable();
	});
	
	//function show all Data
	function show_data() {
		$.ajax({
			type: 'POST',
			url: '<?php echo site_url('periksakehadiranguru/tampil') ?>',
			async: true,
			dataType: 'json',
			success: function(data) {
				var html = '';
				var i = 0;
				var no = 1;
				for (i = 0; i < data.length; i++) {
					html += '<tr>' +
						'<td class="text-center">' + no + '</td>' +
						'<td>' + data[i].GuruNama + '</td>' +
						'<td>' + data[i].mapel + '</td>' +
						'<td>' + data[i].TGLHADIR + '</td>' +
						'<td>' + data[i].MSKHADIR + '</td>' +
						'<td>' + data[i].STINVAL + '</td>' +
						'<td>' + data[i].KETTDKHDR + '</td>' +
						'<td>' + data[i].GANTIHARI + '</td>' +
						'<td>' +
						'<input type="number" id="tambahan'+no+'" name="tambahan" class="form-control" value="' + data[i].TAMBAHAN + '"/>' +
						'</td>' +
						'<td class="text-center">' +
						'<button  href="#my-modal-edit" class="btn btn-xs btn-info item_edit" title="Edit" data-id="' + data[i].ID + '" data-no="'+no+'">' +
						'<i class="ace-icon fa fa-plus bigger-120"></i>' +
						'</button> &nbsp' +
						'<button class="btn btn-xs btn-danger item_hapus" title="Delete" data-id="' + data[i].ID + '">' +
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

	//get data for update record
	$('#show_data').on('click', '.item_edit', function() {
		var id = $(this).data('id');
		var no = $(this).data('no');
		var tambahan = document.getElementById ('tambahan'+no).value;
		var post_data = {
			id : id,
			tambahan : tambahan
		}
		$.ajax({
			url: "<?php echo base_url('periksakehadiranguru/update') ?>",
			type: "POST",
			data: post_data,
			dataType: "json",
			success: function(response) {
				$('#btn_edit').html('<i class="ace-icon fa fa-save"></i>' +
					'Ubah');
				if (response == true) {
					swalEditSuccess();
				} else {
					swalEditFailed();
				}
			}
		});
	});

	$('#show_data').on('click', '.item_hapus', function() {
		var id = $(this).data('id');
		Swal.fire({
			title: 'Apakah anda yakin?',
			text: "Ini akan mereset data pada baris ini!",
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
					url: "<?php echo base_url('periksakehadiranguru/delete') ?>",
					async: true,
					dataType: "JSON",
					data: {
						id: id,
					},
					success: function(data) {
						show_data();
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