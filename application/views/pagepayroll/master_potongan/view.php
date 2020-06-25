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
				<h3 class="smaller lighter blue no-margin">Form Tambah Tarif Potongan</h3>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						<!-- PAGE CONTENT BEGINS -->
						<form class="form-horizontal" role="form" id="formTambah">
                            <input type="hidden" id="id" required name="e_id" />
                            <div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Karyawan </label>
								<div class="col-sm-9">
									<select class="form-control" name="id_karyawan" id="id_karyawan">
										<option value="">-- Pilih Karyawan --</option>
										<?php foreach ($mykaryawan as $value) { ?>
											<option value=<?= $value['nip'] ?>><?= $value['nama'] ?></option>
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
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Infaq Masjid</label>
								<div class="col-sm-9">
								<input type="text" id="infaq_masjid" required name="infaq_masjid" placeholder="Tarif Potongan" class="form-control" />
                                <input type="hidden" id="infaq_masjid_v" required name="infaq_masjid_v"/>
								<script language="JavaScript">
										var rupiah3 = document.getElementById('infaq_masjid');
										rupiah3.addEventListener('keyup', function(e) {
											rup3 = this.value.replace(/\D/g, '');
											$('#infaq_masjid_v').val(rup3);
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
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Anggota Koperasi</label>
								<div class="col-sm-9">
								<input type="text" id="anggota_koperasi" required name="anggota_koperasi" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="anggota_koperasi_v" required name="anggota_koperasi_v"/>
								<script language="JavaScript">
										var rupiah4 = document.getElementById('anggota_koperasi');
										rupiah4.addEventListener('keyup', function(e) {
											rup4 = this.value.replace(/\D/g, '');
											$('#anggota_koperasi_v').val(rup4);
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
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Kas / Bon</label>
								<div class="col-sm-9">
								<input type="text" id="kas_bon" required name="kas_bon" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="kas_bon_v" required name="kas_bon_v"/>
								<script language="JavaScript">
										var rupiah5 = document.getElementById('kas_bon');
										rupiah5.addEventListener('keyup', function(e) {
											rup5 = this.value.replace(/\D/g, '');
											$('#kas_bon_v').val(rup5);
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
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Ijin / Telat</label>
								<div class="col-sm-9">
								<input type="text" id="ijin_telat" required name="ijin_telat" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="ijin_telat_v" required name="ijin_telat_v"/>
								<script language="JavaScript">
										var rupiah6 = document.getElementById('ijin_telat');
										rupiah6.addEventListener('keyup', function(e) {
											rup6 = this.value.replace(/\D/g, '');
											$('#ijin_telat_v').val(rup6);
											rupiah6.value = formatRupiah5(this.value, 'Rp. ');
										});

										function formatRupiah5(angka, prefix) {
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
											return prefix == undefined ? rupiah6 : (rupiah6 ? 'Rp. ' + rupiah6 : '');
										}
									</script>
								</div>
                            </div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> BMT</label>
								<div class="col-sm-9">
								<input type="text" id="bmt" required name="bmt" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="bmt_v" required name="bmt_v"/>
								<script language="JavaScript">
										var rupiah7 = document.getElementById('bmt');
										rupiah7.addEventListener('keyup', function(e) {
											rup7 = this.value.replace(/\D/g, '');
											$('#bmt_v').val(rup7);
											rupiah7.value = formatRupiah7(this.value, 'Rp. ');
										});

										function formatRupiah7(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah7 = split[0].substr(0, sisa),
												ribuan7 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan7) {
												separator = sisa ? '.' : '';
												rupiah7 += separator + ribuan7.join('.');
											}

											rupiah7 = split[1] != undefined ? rupiah7 + ',' + split[1] : rupiah7;
											return prefix == undefined ? rupiah7 : (rupiah7 ? 'Rp. ' + rupiah7 : '');
										}
									</script>
								</div>
                            </div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Koperasi</label>
								<div class="col-sm-9">
								<input type="text" id="koperasi" required name="koperasi" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="koperasi_v" required name="koperasi_v"/>
								<script language="JavaScript">
										var rupiah8 = document.getElementById('koperasi');
										rupiah8.addEventListener('keyup', function(e) {
											rup8 = this.value.replace(/\D/g, '');
											$('#koperasi_v').val(rup8);
											rupiah8.value = formatRupiah8(this.value, 'Rp. ');
										});

										function formatRupiah8(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah8 = split[0].substr(0, sisa),
												ribuan8 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan8) {
												separator = sisa ? '.' : '';
												rupiah8 += separator + ribuan8.join('.');
											}

											rupiah8 = split[1] != undefined ? rupiah8 + ',' + split[1] : rupiah8;
											return prefix == undefined ? rupiah8 : (rupiah8 ? 'Rp. ' + rupiah8 : '');
										}
									</script>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Inval</label>
								<div class="col-sm-9">
								<input type="text" id="inval" required name="inval" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="inval_v" required name="inval_v"/>
								<script language="JavaScript">
										var rupiah9 = document.getElementById('inval');
										rupiah9.addEventListener('keyup', function(e) {
											rup8 = this.value.replace(/\D/g, '');
											$('#inval_v').val(rup8);
											rupiah9.value = formatRupiah9(this.value, 'Rp. ');
										});

										function formatRupiah9(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah9 = split[0].substr(0, sisa),
												ribuan9 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan9) {
												separator = sisa ? '.' : '';
												rupiah9 += separator + ribuan9.join('.');
											}

											rupiah9 = split[1] != undefined ? rupiah9 + ',' + split[1] : rupiah9;
											return prefix == undefined ? rupiah9 : (rupiah9 ? 'Rp. ' + rupiah9 : '');
										}
									</script>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Toko Al Hamra</label>
								<div class="col-sm-9">
								<input type="text" id="toko" required name="toko" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="toko_v" required name="toko_v"/>
								<script language="JavaScript">
										var rupiah10 = document.getElementById('toko');
										rupiah10.addEventListener('keyup', function(e) {
											rup8 = this.value.replace(/\D/g, '');
											$('#toko_v').val(rup8);
											rupiah10.value = formatRupiah9(this.value, 'Rp. ');
										});

										function formatRupiah9(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah10 = split[0].substr(0, sisa),
												ribuan10 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan10) {
												separator = sisa ? '.' : '';
												rupiah10 += separator + ribuan10.join('.');
											}

											rupiah10 = split[1] != undefined ? rupiah10 + ',' + split[1] : rupiah10;
											return prefix == undefined ? rupiah10 : (rupiah10 ? 'Rp. ' + rupiah10 : '');
										}
									</script>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Lain - Lain</label>
								<div class="col-sm-9">
								<input type="text" id="lain" required name="lain" placeholder="Rp. 10.000" class="form-control" />
                                <input type="hidden" id="lain_v" required name="lain_v"/>
								<script language="JavaScript">
										var rupiah11 = document.getElementById('lain');
										rupiah11.addEventListener('keyup', function(e) {
											rup8 = this.value.replace(/\D/g, '');
											$('#lain_v').val(rup8);
											rupiah11.value = formatRupiah9(this.value, 'Rp. ');
										});

										function formatRupiah9(angka, prefix) {
											var number_string = angka.replace(/[^,\d]/g, '').toString(),
												split = number_string.split(','),
												sisa = split[0].length % 3,
												rupiah11 = split[0].substr(0, sisa),
												ribuan11 = split[0].substr(sisa).match(/\d{3}/gi);

											// tambahkan titik jika yang di input sudah menjadi angka ribuan
											if (ribuan11) {
												separator = sisa ? '.' : '';
												rupiah11 += separator + ribuan11.join('.');
											}

											rupiah11 = split[1] != undefined ? rupiah11 + ',' + split[1] : rupiah11;
											return prefix == undefined ? rupiah11 : (rupiah11 ? 'Rp. ' + rupiah11 : '');
										}
									</script>
								</div>
                            </div>


                            <div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Periode </label>
								<div class="col-sm-9">
									<select class="form-control" required name="potong_periode" id="potong_periode">
                                        <option value="">-- Pilih Periode --</option>
                                        <option value="Bulanan">Bulanan</option>
                                        <option value="Periodik">Periodik</option>
									</select>
								</div>
                            </div>
                            
                            <div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Status </label>
								<div class="col-sm-9">
									<select class="form-control" required name="potong_status" id="potong_status">
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
                                        <?php foreach ($my_guru as $value) { ?>
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
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Infaq Masjid </label>
                                <div class="col-sm-9">
                                <input type="text" id="infaq_masjid" required name="infaq_masjid" placeholder="Tarif Potongan" class="form-control" />

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
				<th>Kode Karyawan</th>
				<th>Nama Karyawan</th>
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
	if ($("#formTambah").length > 0) {
		$("#formTambah").validate({
			errorClass: "my-error-class",
			validClass: "my-valid-class",
			submitHandler: function(form) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url('modulpayroll/master_potongan/simpan') ?>",
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
						'<td class="text-center">' + data[i].id_karyawan + '</td>' +
						'<td>' + data[i].nama + '</td>' +
						'<td>' + data[i].potong_nama + '</td>' +
						'<td>' + data[i].potong_periode + '</td>' +
                        '<td>' + data[i].potong_status + '</td>' +
						'<td>' +
						'<button  href="#my-modal-edit" class="btn btn-xs btn-info item_edit" title="Edit" data-id="' + data[i].id_potong + '">' +
						'<i class="ace-icon fa fa-pencil bigger-120"> Edit </i>' +
                        '</button> ' + 
                        '<button  href="#my-modal-edit" class="btn btn-xs btn-danger item_hapus" title="Hapus" data-id="' + data[i].id_potong + '">' +
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