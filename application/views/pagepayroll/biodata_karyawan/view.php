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
<div id="my-modal2" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="smaller lighter blue no-margin">Form Import Data Guru</h3>
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

<!-- Modal Input Data -->
<div id="my-modal" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="smaller lighter blue no-margin">Form Input Data Guru</h3>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						<!-- PAGE CONTENT BEGINS -->
						<form class="form-horizontal" role="form" id="formTambah">
                        <div class="text-center">
                            BIODATA KARYAWAN
                        </div>
                        <hr>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> NIK Karyawan</label>
                            <div class="col-sm-9">
                                <input type="text" id="nik" required name="nik" placeholder="NIK Karyawan" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nama </label>
                            <div class="col-sm-9">
                                <input type="text" id="nama" required name="nama" placeholder="Nama" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Jabatan </label>
                            <div class="col-sm-9">
                                <select class="form-control" name="jabatan" id="jabatan">
                                    <option value="">-- Pilih Jabatan --</option>
                                    <?php foreach ($my_jabatan as $value) { ?>
                                        <option value=<?= $value['ID'] ?>> <?= $value['NAMAJABATAN']; ?></option>
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
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Agama </label>
                            <div class="col-sm-9">
                                <input type="text" id="agama" required name="agama" placeholder="Agama" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Email </label>
                            <div class="col-sm-9">
                                <input type="email" id="email" required name="email" placeholder="Email" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> No. Telp </label>
                            <div class="col-sm-9">
                            <input type="text" id="telp" required name="telp" placeholder="No. Telp" class="form-control" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Alamat </label>
                            <div class="col-sm-9">
                                <textarea class="form-control" required name="alamat" id="alamat" placeholder="Alamat"></textarea>
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
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tanggal lahir </label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" placeholder="24/10/1995"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Status Aktif </label>
                            <div class="col-sm-9">
                                <select class="form-control" name="status" id="status">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="T">Aktif</option>
                                    <option value="F">Tidak</option>
                                </select>
                            </div>
						</div>
						
						<div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tanggal Mulai Kerja </label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="tgl_mulai" id="tgl_mulai" placeholder="24/10/1995"></textarea>
                            </div>
                        </div>

                        <hr>
                            <div class="text-center"> TARIF KARYAWAN </div>
                        <hr>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Infak Masjid </label>
                            <div class="col-sm-9">
							<input type="text" id="infak" required name="infak" placeholder="Rp. 10.0000" class="form-control" />
							<input type="hidden" id="infak_v" required name="infak_v"/>
							<script language="JavaScript">
                                        var rupiah1 = document.getElementById('infak');
                                        rupiah1.addEventListener('keyup', function(e) {
                                            rup1 = this.value.replace(/\D/g, '');
                                            $('#infak_v').val(rup1);
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
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Potongan </label>
                            <div class="col-sm-9">
							<input type="text" id="potongan" required name="potongan" placeholder="Rp. 10.000" class="form-control" />
							<input type="hidden" id="potongan_v" required name="potongan_v"/>
							<script language="JavaScript">
                                        var rupiah2 = document.getElementById('potongan');
                                        rupiah2.addEventListener('keyup', function(e) {
                                            rup2 = this.value.replace(/\D/g, '');
                                            $('#potongan_v').val(rup2);
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
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Koperasi </label>
                            <div class="col-sm-9">
							<input type="text" id="koperasi" required name="koperasi" placeholder="Rp. 10.0000" class="form-control" />
							<input type="hidden" id="koperasi_v" required name="koperasi_v" />
							<script language="JavaScript">
                                        var rupiah3 = document.getElementById('koperasi');
                                        rupiah3.addEventListener('keyup', function(e) {
                                            rup3 = this.value.replace(/\D/g, '');
                                            $('#koperasi_v').val(rup3);
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
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Anggota Koperasi </label>
                            <div class="col-sm-9">
							<input type="text" id="anggota_koperasi" required name="anggota_koperasi" placeholder="Rp. 10.000" class="form-control" />
							<input type="hidden" id="anggota_koperasi_v"  name="anggota_koperasi_v"  />

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
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Kas / Bon </label>
                            <div class="col-sm-9">
							<input type="text" id="tarif" required name="tarif" placeholder="kas / Bon" class="form-control" />
							<input type="hidden" id="tarif_v" required name="tarif_v"  />

							<script language="JavaScript">
                                        var rupiah5 = document.getElementById('tarif');
                                        rupiah5.addEventListener('keyup', function(e) {
                                            rup5 = this.value.replace(/\D/g, '');
                                            $('#tarif_v').val(rup5);
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
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Ijin / Telat </label>
                            <div class="col-sm-9">
							<input type="text" id="ijin_telat" required name="ijin_telat" placeholder="Ijin Telat" class="form-control" />
							<input type="hidden" id="ijin_telat_v"  name="ijin_telat_v" />
							<script language="JavaScript">
                                        var rupiah6 = document.getElementById('ijin_telat');
                                        rupiah6.addEventListener('keyup', function(e) {
                                            rup6 = this.value.replace(/\D/g, '');
                                            $('#ijin_telat_v').val(rup6);
                                            rupiah6.value = formatRupiah6(this.value, 'Rp. ');
                                        });
                                        function formatRupiah6(angka, prefix) {
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
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> BMT </label>
                            <div class="col-sm-9">
							<input type="text" id="bmt" required name="bmt" placeholder="bmt" class="form-control" />
							<input type="hidden" id="bmt_v"  name="bmt_v" />

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
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Di Inval </label>
                            <div class="col-sm-9">
							<input type="text" id="diinval" required name="diinval" placeholder="Di inval" class="form-control" />
							<input type="hidden" id="diinval_v"  name="diinval_v"  />
							
							<script language="JavaScript">
                                        var rupiah8 = document.getElementById('diinval');
                                        rupiah8.addEventListener('keyup', function(e) {
                                            rup8 = this.value.replace(/\D/g, '');
                                            $('#diinval_v').val(rup8);
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

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> NIPP </label>
								<div class="col-sm-6">
									<input type="hidden" id="e_id" required name="e_id" />
									<input type="text" id="e_nip" required name="e_nip" readonly placeholder="NIPP" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nama </label>
								<div class="col-sm-9">
									<input type="text" id="e_nama" required name="e_nama" placeholder="Nama" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Jabatan </label>
								<div class="col-sm-9">
									<select class="form-control" name="e_jabatan" id="e_jabatan">
										<option value="">-- Pilih Jabatan --</option>
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
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Agama </label>
								<div class="col-sm-9">
									<input type="text" id="e_agama" required name="e_agama" placeholder="Agama" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Email </label>
								<div class="col-sm-9">
									<input type="email" id="e_email" required name="e_email" placeholder="Email" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> No. Telp </label>
								<div class="col-sm-9">
                                <input type="text" id="e_telp" required name="e_telp" placeholder="No. Telp" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Alamat </label>
								<div class="col-sm-9">
									<textarea class="form-control" required name="e_alamat" id="e_alamat" placeholder="Alamat"></textarea>
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
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tanggal lahir </label>
								<div class="col-sm-9">
									<input type="date" class="form-control" name="e_tgl_lahir" id="e_tgl_lahir" placeholder="24/10/1995"></textarea>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Status Aktif </label>
								<div class="col-sm-9">
									<select class="form-control" name="e_status" id="e_status">
										<option value="">-- Pilih Status --</option>
										<option value="T">Aktif</option>
										<option value="F">Tidak</option>
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

<!-- Modal Edit Tarif -->
<div id="modalEditTarif" class="modal fade" tabindex="-1">
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
                            <input type="hidden" id="e_id" required name="e_id" />

                            <div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Posisi </label>
								<div class="col-sm-9">
                                <input type="text" id="e_posisi" required name="e_posisi" placeholder="Posisi" class="form-control" />
								</div>
							</div>

                            <div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Jabatan </label>
								<div class="col-sm-9">
                                <input type="text" id="e_jabatan" required name="e_jabatan" placeholder="Jabatan" class="form-control" />
								</div>
							</div>

                            <div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tarif </label>
								<div class="col-sm-9">
                                <input type="number" id="e_tarif" required name="e_tarif" placeholder="Tarif" class="form-control" />
								</div>
							</div>

                            <div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Cara Pembayaran </label>
								<div class="col-sm-9">
									<select class="form-control" name="e_pendidikan_terakhir" id="e_pendidikan_terakhir">
										<option value="">-- Pilih Cara Pembayaran --</option>
										<?php foreach ($mypendidikan as $value) { ?>
											<option value=<?= $value['IDMSPENDIDIKAN'] ?>><?= $value['NMMSPENDIDIKAN'] ?></option>
										<?php } ?>
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
			Semua Data guru
		</div>
	</div>
</div>
<div class="table-responsive">
	<table id="datatable_tabletools" class="display">
		<thead>
			<tr>
				<th>No</th>
				<th>NIPP</th>
				<th>Nama</th>
				<th>Email</th>
				<th>No. Telp</th>
				<th>Pendidikan Terakhir</th>
                <th>Alamat</th>
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
			url: '<?php echo site_url('modulpayroll/biodata_karyawan/tampil') ?>',
			async: true,
			dataType: 'json',
			success: function(data) {
				var html = '';
				var i = 0;
				var no = 1;
				for (i = 0; i < data.length; i++) {
					html += '<tr>' +
						'<td class="text-center">' + no + '</td>' +
						'<td class="text-center">' + data[i].nip + '</td>' +
						'<td>' + data[i].nama + '</td>' +
						'<td>' + data[i].email + '</td>' +
						'<td>' + data[i].telp + '</td>' +
                        '<td>' + data[i].NMMSPENDIDIKAN + '</td>' +
                        '<td>' + data[i].alamat + '</td>' +
						'<td >' +
						'<button  href="#my-modal-edit" class="btn btn-xs btn-info item_edit" title="Edit" data-id="' + data[i].id + '">' +
						'<i class="ace-icon fa fa-book bigger-120"> Edit Biodata </i>' +
                        '</button> ' + 
                        '<br>' + '<br>' + 
                        '<button  href="#my-modal-edit_tarif" class="btn btn-xs btn-success item_edit_tarif" title="Edit" data-id="' + data[i].id + '">' +
						'<i class="ace-icon fa fa-pencil bigger-120"> Edit Tarif</i>' +
                        '</button> ' + 
                        '<br>' + '<br>' + 
                        '<button  href="#my-modal-edit" class="btn btn-xs btn-danger item_hapus" title="Hapus" data-id="' + data[i].id + '">' +
						'<i class="ace-icon fa fa-trash-o bigger-120"> Hapus</i>' +
						'</button> ' + 
                        // '<br>' + '<br>' + 
						// '<button class="btn btn-xs btn-success item_riwayatpendidikan" title="Riwayatp" data-id="' + data[i].id + '">' +
						// 'Riwayat Pendidikan' +
                        // '</button>' + '<br>' + '<br>' + 
                        // '<button class="btn btn-xs btn-warning item_hapus" title="Delete" data-id="' + data[i].id + '">' +
						// 'Riwayat Jabatan <br>' +
                        // '</button>' + '<br>' + '<br>' + 
                        // '<button class="btn btn-xs btn-info item_hapus" title="Delete" data-id="' + data[i].id + '">' +
						// 'Riwayat Seminar <br>' +
                        // '</button>' + '<br>' + '<br>' + 
                        // '<button class="btn btn-xs btn-primary item_hapus" title="Delete" data-id="' + data[i].id + '">' +
						// 'Riwayat Sertifikasi <br>' +
                        // '</button>' + '<br>' + '<br>' + 
                        // '<button class="btn btn-xs btn-default item_hapus" title="Delete" data-id="' + data[i].id + '">' +
						// 'Riwayat Senat <br>' +
						// '</button>' +
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
	
	if ($("#formTambah").length > 0) {
		$("#formTambah").validate({
			errorClass: "my-error-class",
			validClass: "my-valid-class",
			submitHandler: function(form) {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url('modulpayroll/biodata_karyawan/simpan') ?>",
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