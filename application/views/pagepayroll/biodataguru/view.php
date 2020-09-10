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
				<h3 class="smaller lighter blue no-margin">Form Import <?= $page_name ?></h3>
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
									<a href="<?php echo base_url() . 'assets/guru.xls' ?>" class="col-sm-3" for="form-field-1"> Download Sample Format</a>
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
				<h3 class="smaller lighter blue no-margin">Form Input <?= $page_name ?></h3>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						<!-- PAGE CONTENT BEGINS -->
						<form class="form-horizontal" role="form" id="formTambah">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Kode </label>
								<div class="col-sm-6">
									<input type="text" id="IdGuru" required name="IdGuru" placeholder="Kode Guru" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Kode Dapodik </label>
								<div class="col-sm-9">
									<input type="text" id="GuruNoDapodik" required name="GuruNoDapodik" placeholder="kode Dapodik" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> NPWP </label>
								<div class="col-sm-9">
									<input type="text" id="npwp" name="npwp" placeholder="NPWP" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> NIK </label>
								<div class="col-sm-9">
									<input type="text" id="nik" name="nik" placeholder="NIK KTP" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nama </label>
								<div class="col-sm-9">
									<input type="text" id="nama" required name="nama" placeholder="Nama Guru" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Telepon </label>
								<div class="col-sm-9">
									<input type="text" id="telepon" required name="telepon" placeholder="No Telp" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Alamat </label>
								<div class="col-sm-9">
									<textarea class="form-control" required name="alamat" id="alamat" placeholder="Masukan Alamat"></textarea>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Unit Kerja </label>
								<div class="col-sm-9">
									<select class="form-control" name="program_sekolah" id="program_sekolah">
										<option value="">-- Pilih Unit --</option>
										<?php foreach ($myprogram as $value) { ?>
											<option value=<?= $value['id'] ?>> <?= $value['deskripsi']; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Jenis Kelamin </label>
								<div class="col-sm-9">
									<select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
										<option value="">-- Pilih Pengguna --</option>
										<option value="L">Laki-Laki</option>
										<option value="P">Perempuan</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Pendidikan Terakhir </label>
								<div class="col-sm-9">
									<select class="form-control" name="pendidikan_terakhir" id="pendidikan_terakhir">
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
									<select class="form-control" name="agama" id="agama">
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
									<input type="text" class="form-control" name="email" id="email" placeholder="Email" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tanggal lahir </label>
								<div class="col-sm-9">
									<input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" placeholder="24/10/1995"></textarea>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tempat Lahir </label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Jakarta" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tanggal Awal Kerja </label>
								<div class="col-sm-9">
									<input type="date" class="form-control" name="awal_kerja" id="awal_kerja" placeholder="" />
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
				<h3 class="smaller lighter blue no-margin">Form Edit <?= $page_name ?></h3>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						<!-- PAGE CONTENT BEGINS -->
						<form class="form-horizontal" role="form" id="formEdit">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Kode </label>
								<div class="col-sm-6">
									<input type="hidden" id="e_id" required name="e_id" />
									<input type="text" id="e_IdGuru" required name="e_IdGuru" placeholder="Kode Guru" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Kode Dapodik </label>
								<div class="col-sm-9">
									<input type="text" id="e_GuruNoDapodik" required name="e_GuruNoDapodik" placeholder="kode Dapodik" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> NPWP </label>
								<div class="col-sm-9">
									<input type="text" id="e_npwp" name="e_npwp" placeholder="NPWP" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> NIK </label>
								<div class="col-sm-9">
									<input type="text" required id="e_nik" name="e_nik" placeholder="NIK KTP" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nama </label>
								<div class="col-sm-9">
									<input type="text" id="e_nama" required name="e_nama" placeholder="Nama Guru" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Telepon </label>
								<div class="col-sm-9">
									<input type="text" id="e_telepon" required name="e_telepon" placeholder="No Telp" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Alamat </label>
								<div class="col-sm-9">
									<textarea class="form-control" required name="e_alamat" id="e_alamat" placeholder="Masukan Alamat"></textarea>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Unit Kerja </label>
								<div class="col-sm-9">
									<select class="form-control" name="e_program_sekolah" id="e_program_sekolah">
										<option value="">-- Pilih Unit --</option>
										<?php foreach ($myprogram as $value) { ?>
											<option value=<?= $value['id'] ?>> <?= $value['deskripsi']; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Jenis Kelamin </label>
								<div class="col-sm-9">
									<select class="form-control" name="e_jenis_kelamin" id="e_jenis_kelamin">
										<option value="">-- Pilih Pengguna --</option>
										<option value="L">Laki-Laki</option>
										<option value="P">Perempuan</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Pendidikan Terakhir </label>
								<div class="col-sm-9">
									<select class="form-control" name="e_pendidikan_terakhir" id="e_pendidikan_terakhir">
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
									<select class="form-control" name="e_agama" id="e_agama">
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
									<input type="text" class="form-control" name="e_email" id="e_email" placeholder="Email" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tanggal lahir </label>
								<div class="col-sm-9">
									<input type="date" class="form-control" name="e_tgl_lahir" id="e_tgl_lahir" placeholder="24/10/1995"></textarea>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tempat Lahir </label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="e_tempat_lahir" id="e_tempat_lahir" placeholder="Jakarta" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tanggal Awal Kerja </label>
								<div class="col-sm-9">
									<input type="date" class="form-control" name="e_awal_kerja" id="e_awal_kerja" placeholder="" />
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

<div id="modalRiwayatpendidikan" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="smaller lighter blue no-margin">Form Riwayat Pendidikan</h3>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						<!-- PAGE CONTENT BEGINS -->
						<form class="form-horizontal" role="form" id="formEdit">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Kode </label>
								<div class="col-sm-6">
									<input type="hidden" id="e_idrp" required name="e_idrp" />
									<input type="text" id="e_IdGururp" required name="e_IdGururp" readonly placeholder="Kode Guru" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Kode Dapodik </label>
								<div class="col-sm-9">
									<input type="text" id="e_GuruNoDapodikrp" readonly name="e_GuruNoDapodikrp" placeholder="kode Dapodik" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Pendidikan Terakhir </label>
								<div class="col-sm-9">
									<select class="form-control" name="e_pendidikan_terakhirrp" id="e_pendidikan_terakhirrp">
										<option value="">-- Pilih Pendidikan --</option>
										<?php foreach ($mypendidikan as $value) { ?>
											<option value=<?= $value['IDMSPENDIDIKAN'] ?>><?= $value['NMMSPENDIDIKAN'] ?></option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Prodi </label>
								<div class="col-sm-9">
									<input type="text" id="e_prodirp" required name="e_prodirp" placeholder="Program Studi" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Gelar </label>
								<div class="col-sm-9">
									<textarea class="form-control" required name="e_gelar" id="e_gelar" placeholder="S.Kom. , S.Pd."></textarea>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tahun Masuk </label>
								<div class="col-sm-9">
									<input type="text" id="e_tahunmasuk" required name="e_tahunmasuk" placeholder="Tahun Masuk" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tahun Lulus </label>
								<div class="col-sm-9">
									<input type="text" id="e_tahunlulus" required name="e_tahunlulus" placeholder="Tahun Masuk" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> No Ijazah </label>
								<div class="col-sm-9">
									<input type="text" id="e_noijazah" required name="e_noijazah" placeholder="43A830.12" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Status Kompetensi </label>
								<div class="col-sm-9">
									<select class="form-control" name="e_status" id="e_status">
										<option value="">-- Pilih Status --</option>
										<option value="T">Kompetensi</option>
										<option value="F">Non Kompetensi</option>
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

<div class="row">
	<div class="col-xs-12">
		<div class="table-header">
			Semua Data guru
		</div>
	</div>
</div>
<br>
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
	if ($("#formImport").length > 0) {
		$("#formImport").validate({
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
				formdata = new FormData(form);
				$.ajax({
					type: "POST",
					url: "<?php echo base_url('modulpayroll/biodataguru/import') ?>",
					data: formdata,
					processData: false,
					contentType: false,
					cache: false,
					async: false,
					success: function(data) {
						console.log(data);
						$('#my-modal2').modal('hide');
						if (data == 1 || data == true) {
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
	if ($("#formTambah").length > 0) {
		$("#formTambah").validate({
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
					url: "<?php echo base_url('modulpayroll/biodataguru/simpan') ?>",
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

	if ($("#formEdit").length > 0) {
		$("#formEdit").validate({
			submitHandler: function(form) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url('modulpayroll/biodataguru/updatebiodata') ?>",
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

	//Simpan guru

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
				$('#e_Tahunmasakerja').val(data[0].Tahunmasakerja);
				$('#e_IdGuru').val(data[0].aidiguru);
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
				$('#e_npwp').val(data[0].GuruNPWP);
				$('#e_nik').val(data[0].GuruNik);
				$('#e_awal_kerja').val(data[0].awal_kerja);
			}
		});
	});

	$('#show_data').on('click', '.item_riwayatpendidikan', function() {
		var id = $(this).data('id');
		$('#modalRiwayatpendidikan').modal('show');
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('modulpayroll/biodataguru/tampil_byidrp') ?>",
			async: true,
			dataType: "JSON",
			data: {
				id: id,
			},
			success: function(data) {
				$('#e_idrp').val(data[0].id);
				$('#e_IdGururp').val(data[0].aidiguru);
				$('#e_GuruNoDapodikrp').val(data[0].GuruNoDapodik);
				$('#e_pendidikan_terakhirrp').val(data[0].GuruPendidikanAkhir);
				$('#e_prodirp').val(data[0].RiwayatProdi);
				$('#e_gelar').val(data[0].RiawayatGelar);
				$('#e_tahunmasuk').val(data[0].RiwayatTahun);
				$('#e_noijazah').val(data[0].RiwayatNoIjazah);
				$('#e_tahunlulus').val(data[0].RiwayatTglLulus);
				$('#e_status').val(data[0].RiwayatKompetensi);
			}
		});
	});

	$('#show_data').on('click', '.item_riwayatjabatan', function() {
		var id = $(this).data('id');
		$('#modalRiwayatpendidikan').modal('show');
		$.ajax({
			type: "POST",
			url: "<?php echo base_url('modulpayroll/biodataguru/tampil_byidrp') ?>",
			async: true,
			dataType: "JSON",
			data: {
				id: id,
			},
			success: function(data) {
				$('#e_idrp').val(data[0].id);
				$('#e_IdGururp').val(data[0].aidiguru);
				$('#e_GuruNoDapodikrp').val(data[0].GuruNoDapodik);
				$('#e_pendidikan_terakhirrp').val(data[0].GuruPendidikanAkhir);
				$('#e_prodirp').val(data[0].RiwayatProdi);
				$('#e_gelar').val(data[0].RiawayatGelar);
				$('#e_tahunmasuk').val(data[0].RiwayatTahun);
				$('#e_noijazah').val(data[0].RiwayatNoIjazah);
				$('#e_tahunlulus').val(data[0].RiwayatTglLulus);
				$('#e_status').val(data[0].RiwayatKompetensi);
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
						'<button  href="#my-modal-edit" class="btn btn-xs btn-info item_edit" title="Edit" data-id="' + data[i].IdGuru + '">' +
						'<i class="ace-icon fa fa-pencil-square-o bigger-120"> Edit</i>' +
						'</button> ' + '<br>' + '<br>' +
						'<button class="btn btn-xs btn-success item_riwayatpendidikan" title="Riwayatp" data-id="' + data[i].IdGuru + '">' +
						'Riwayat Pendidikan' +
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
