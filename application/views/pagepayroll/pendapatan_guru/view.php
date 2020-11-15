<div class="row">
    <div class="col-xs-4">
        <form class="form-horizontal" role="form" id="formSearch">
            <div class="form-group">
                <div class="col-xs-10">
                    Periode Awal
					<input type="date" class="form-control" name="tgl_awal" id="tgl_awal" placeholder="24/10/1995">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-10">
                    Periode Akhir
					<input type="date" class="form-control" name="tgl_akhir" id="tgl_akhir" placeholder="24/10/1995">
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-10">
                    Unit
					<select class="form-control" required name="unit" id="unit">
						<!-- <option value="0">--Pilih--</option> -->
						<option value="0">[Pilih Semua]</option>
						<?php
							foreach($myunit as $row){
						?>
							<option value="<?= $row['id'] ?>"><?php echo "[".$row['deskripsi']."]"?></option>
						<?php
							}
						?>
					</select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-10">
                    Guru
					<select class="form-control" required name="guru" id="guru">
						<!-- <option value="0">--Pilih--</option> -->
						<option value="0">Pilih Guru</option>
						<?php
							foreach($myguru as $row){
						?>
							<option value="<?= $row['IdGuru'] ?>"><?php echo "[".$row['IdGuru']."-".$row['GuruNama']."]"?></option>
						<?php
							}
						?>
					</select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-1">
                    <br>
                    <button type="submit" id="btn_search" class="btn btn-sm btn-success pull-left">
                        <a class="ace-icon fa fa-search bigger-120"></a>Periksa
                    </button>
                </div>
            </div>
            <br>
            <br>
        </form>
    </div>
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
							<!-- <div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Guru </label>
								<input type="hidden" id="e_id" required name="e_id" />
								<div class="col-sm-9">
									<select class="form-control" readonly name="e_guru" id="e_guru">
										<option value="">-- Pilih Guru --</option>
										<?php foreach ($my_guru as $value) { ?>
											<option value=<?= $value['IdGuru'] ?>><?php echo "[" . $value['IdGuru'] . "] - " . $value['GuruNama'] ?></option>
										<?php } ?>
									</select>
								</div>
							</div> -->

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Honor Guru </label>
								<div class="col-sm-9">
									<input type="hidden" id="e_id" required name="e_id" />
									<input type="text" id="e_gaji" required name="e_gaji" placeholder="Rp. 10.0000" class="form-control" />
									<input type="hidden" id="e_gaji_v" required name="e_gaji_v" />
									<script language="JavaScript">
										var rupiah1 = document.getElementById('e_gaji');
										rupiah1.addEventListener('keyup', function(e) {
											rup1 = this.value.replace(/\D/g, '');
											$('#e_gaji_v').val(rup1);
											rupiah1.value = ConvertFormatRupiah(this.value, 'Rp. ');
										});
									</script>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tunjangan Jabatan </label>
								<div class="col-sm-9">
									<input type="text" id="e_tunj_jabatan" required name="e_tunj_jabatan" placeholder="Rp. 10.0000" class="form-control" />
									<input type="hidden" id="e_tunj_jabatan_v" required name="e_tunj_jabatan_v" />
									<script language="JavaScript">
										var rupiah1 = document.getElementById('e_tunj_jabatan');
										rupiah1.addEventListener('keyup', function(e) {
											rup1 = this.value.replace(/\D/g, '');
											$('#e_tunj_jabatan_v').val(rup1);
											rupiah1.value = ConvertFormatRupiah(this.value, 'Rp. ');
										});
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
				<th>Action</th>
			</tr>
		</thead>
		<tbody id="show_data">
		</tbody>
	</table>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#datatable_tabletools').DataTable();
	});
	
	if ($("#formSearch").length > 0) {
        $("#formSearch").validate({
            errorClass: "my-error-class",
            validClass: "my-valid-class",
            submitHandler: function(form) {
                $('#btn_search').html('Memeriksa..');
                $.ajax({
                    url: "<?php echo base_url('modulpayroll/pendapatanguru/tampil') ?>",
                    type: "POST",
                    data: $('#formSearch').serialize(),
                    dataType: "json",
                    success: function(data) {
					var html = '';
					var i = 0;
					var no = 1;
					for (i = 0; i < data.length; i++) {
						html += '<tr>' +
							'<td class="text-center">' + no + '</td>' +
							'<td class="text-center">' + data[i].employee_number + '</td>' +
							'<td class="text-left">' + data[i].nama + '</td>' +
							'<td >' +
							'<button  href="#my-modal-edit" class="btn btn-xs btn-success item_edit" title="Edit" data-id="' + data[i].id_pendapatan + '">' +
							'<i class="ace-icon fa fa-trash-o bigger-120"> Edit</i>' +
							'</button>' +
							'</td>' +
							'</tr>';
						no++;
					}
					$("#datatable_tabletools").dataTable().fnDestroy();
					var a = $('#show_data').html(html);
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
        })
	}



	$('#show_data').on('click', '.item_edit', function() {
		var id = $(this).data('id');
		$('#modalEdit').modal('show');
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('modulpayroll/pendapatanguru/tampil_byid') ?>",
			async: true,
			dataType: "JSON",
			data: {
				id: id,
			},
			success: function(data) {
				$('#e_id').val(data[0].id);


				var n_gaji = ConvertFormatRupiah(data[0].gaji, 'Rp. ');
				$('#e_gaji').val(n_gaji);
				$('#e_gaji_v').val(data[0].gaji);
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
                    url: "<?php echo base_url('modulpayroll/tarif_guru/update') ?>",
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
