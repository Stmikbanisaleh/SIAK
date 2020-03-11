<div class="row">
    <div class="col-xs-1">
        <button id="item-tambah" role="button" data-toggle="modal" class="btn btn-xs btn-info">
            <a class="ace-icon fa fa-plus bigger-120"></a>Tambah Data
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
                <h3 class="smaller lighter blue no-margin">Form Import Data Potongan</h3>
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
                                    <a href="<?php echo base_url() . 'assets/jabatan.xlsx' ?>" class="col-sm-3" for="form-field-1"> Download Sample Format</a>
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
<div id="modalTambah" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="smaller lighter blue no-margin">Form Input Data <?= $page_name; ?></h3>
            </div>
            <form class="form-horizontal" role="form" id="formTambah">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- PAGE CONTENT BEGINS -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nama Siswa </label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="nama" id="nama">
                                        <option value="">-- Pilih --</option>
                                        <?php foreach ($mysiswa as $value) { ?>
                                            <option value=<?= $value['NOINDUK'] ?>><?= $value['NMSISWA'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Kelas </label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="kelas" id="kelas">
                                        <option value="">-- Pilih --</option>
                                        <?php foreach ($mykelas as $value) { ?>
                                            <option value=<?= $value['id_kelas'] ?>><?= $value['nama'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Potongan SPP </label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="potonganspp" placeholder="Rp.1000.000" id="potonganspp" />
                                    <input type="hidden" class="form-control" name="potonganspp_v" placeholder="Rp.1000.000" id="potonganspp_v" />

                                    <script language="JavaScript">
                                        var rupiah = document.getElementById('potonganspp');
                                        rupiah.addEventListener('keyup', function(e) {
                                            // tambahkan 'Rp.' pada saat form di ketik
                                            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                                            rup = this.value.replace(/\D/g, '');
                                            $('#potonganspp_v').val(rup);
                                            rupiah.value = formatRupiah(this.value, 'Rp. ');
                                        });

                                        function formatRupiah(angka, prefix) {
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
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Potongan Gedung </label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="potongangedung" placeholder="Rp.1000.000" id="potongangedung" />
                                    <input type="hidden" class="form-control" name="potongangedung_v" placeholder="Rp.1000.000" id="potongangedung_v" />

                                    <script language="JavaScript">
                                        var rupiah2 = document.getElementById('potongangedung');
                                        rupiah2.addEventListener('keyup', function(e) {
                                            // tambahkan 'Rp.' pada saat form di ketik
                                            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                                            rup2 = this.value.replace(/\D/g, '');
                                            $('#potongangedung_v').val(rup2);
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
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Potongan Modul </label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="potonganmodul" placeholder="Rp.1000.000" id="potonganmodul" />
                                    <input type="hidden" class="form-control" name="potonganmodul_v" placeholder="Rp.1000.000" id="potonganmodul_v" />
                                    <script language="JavaScript">
                                        var rupiah3 = document.getElementById('potonganmodul');
                                        rupiah3.addEventListener('keyup', function(e) {
                                            // tambahkan 'Rp.' pada saat form di ketik
                                            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                                            rup3 = this.value.replace(/\D/g, '');
                                            $('#potonganmodul_v').val(rup3);
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
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Potongan Modul </label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="potongankegiatan" placeholder="Rp.1000.000" id="potongankegiatan" />
                                    <input type="hidden" class="form-control" name="potongankegiatan_v" placeholder="Rp.1000.000" id="potongankegiatan_v" />
                                    <script language="JavaScript">
                                        var rupiah4 = document.getElementById('potongankegiatan');
                                        rupiah4.addEventListener('keyup', function(e) {
                                            // tambahkan 'Rp.' pada saat form di ketik
                                            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                                            rup4 = this.value.replace(/\D/g, '');
                                            $('#potongankegiatan_v').val(rup4);
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
                <h3 class="smaller lighter blue no-margin">Form Edit Data <?= $page_name; ?></h3>
            </div>
            <form class="form-horizontal" role="form" id="formEdit">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- PAGE CONTENT BEGINS -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Potongan SPP </label>
                                <div class="col-sm-6">
                                    <input type="hidden" name="e_id" id="e_id" />
                                    <input type="text" class="form-control" name="e_potonganspp" placeholder="Rp.1000.000" id="e_potonganspp" />
                                    <input type="hidden" class="form-control" name="e_potonganspp_v" placeholder="Rp.1000.000" id="e_potonganspp_v" />

                                    <script language="JavaScript">
                                        var rupiah5 = document.getElementById('e_potonganspp');
                                        rupiah5.addEventListener('keyup', function(e) {
                                            // tambahkan 'Rp.' pada saat form di ketik
                                            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                                            rup5 = this.value.replace(/\D/g, '');
                                            $('#e_potonganspp_v').val(rup5);
                                            rupiah5.value = formatRupiah5(this.value, 'Rp. ');
                                        });

                                        function formatRupiah5(angka, prefix) {
                                            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                                                split = number_string.split(','),
                                                sisa5 = split[0].length % 3,
                                                rupiah5 = split[0].substr(0, sisa5),
                                                ribuan5 = split[0].substr(sisa5).match(/\d{3}/gi);

                                            // tambahkan titik jika yang di input sudah menjadi angka ribuan
                                            if (ribuan5) {
                                                separator = sisa5 ? '.' : '';
                                                rupiah5 += separator + ribuan5.join('.');
                                            }

                                            rupiah5 = split[1] != undefined ? rupiah5 + ',' + split[1] : rupiah5;
                                            return prefix == undefined ? rupiah5 : (rupiah5 ? 'Rp. ' + rupiah5 : '');
                                        }
                                    </script>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Potongan Gedung </label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="e_potongangedung" placeholder="Rp.1000.000" id="e_potongangedung" />
                                    <input type="hidden" class="form-control" name="e_potongangedung_v" placeholder="Rp.1000.000" id="e_potongangedung_v" />

                                    <script language="JavaScript">
                                        var rupiah6 = document.getElementById('e_potongangedung');
                                        rupiah6.addEventListener('keyup', function(e) {
                                            // tambahkan 'Rp.' pada saat form di ketik
                                            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                                            rup6 = this.value.replace(/\D/g, '');
                                            $('#e_potongangedung_v').val(rup6);
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
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Potongan Modul </label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="e_potonganmodul" placeholder="Rp.1000.000" id="e_potonganmodul" />
                                    <input type="hidden" class="form-control" name="e_potonganmodul_v" placeholder="Rp.1000.000" id="e_potonganmodul_v" />
                                    <script language="JavaScript">
                                        var rupiah7 = document.getElementById('e_potonganmodul');
                                        rupiah7.addEventListener('keyup', function(e) {
                                            // tambahkan 'Rp.' pada saat form di ketik
                                            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                                            rup7 = this.value.replace(/\D/g, '');
                                            $('#potonganmodul_v').val(rup7);
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
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Potongan Kegiatan </label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="e_potongankegiatan" placeholder="Rp.1000.000" id="e_potongankegiatan" />
                                    <input type="hidden" class="form-control" name="e_potongankegiatan_v" placeholder="Rp.1000.000" id="e_potongankegiatan_v" />
                                    <script language="JavaScript">
                                        var rupiah8 = document.getElementById('e_potongankegiatan');
                                        rupiah8.addEventListener('keyup', function(e) {
                                            // tambahkan 'Rp.' pada saat form di ketik
                                            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                                            rup8 = this.value.replace(/\D/g, '');
                                            $('#e_potongankegiatan_v').val(rup8);
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
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn_edit" class="btn btn-sm btn-success pull-left">
                        <i class="ace-icon fa fa-save"></i>
                        Ubah
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
<table id="table_id" class="display">
    <thead>
        <tr>
            <th class="col-md-1">No</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Potongan SPP</th>
            <th>Potongan Gedung</th>
            <th>Potongan Modul</th>
            <th>Potongan Kegiatan</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="show_data">
    </tbody>
</table>
<script>
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
                    url: "<?php echo base_url('jabatan/import') ?>",
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
                potonganspp: {
                    required: true
                },
                potonganmodul: {
                    required: true
                },
                potongankegiatan: {
                    required: true
                },
                potongangedung: {
                    required: true
                },
                nis: {
                    required: true
                },
                kelas: {
                    required: true
                },
                nama: {
                    required: true
                },
            },
            messages: {

                potonganspp: {
                    required: "Jika Tidak ada harap di isi 0"
                },
                potonganmodul: {
                    required: "Jika Tidak ada harap di isi 0"
                },
                potongankegiatan: {
                    required: "Jika Tidak ada harap di isi 0"
                },
                potongangedung: {
                    required: "Jika Tidak ada harap di isi 0"
                },

            },
            submitHandler: function(form) {
                $('#btn_simpan').html('Sending..');
                $.ajax({
                    url: "<?php echo base_url('modulkasir/potongan/simpan') ?>",
                    type: "POST",
                    data: $('#formTambah').serialize(),
                    dataType: "json",
                    success: function(response) {
                        $('#btn_simpan').html('<i class="ace-icon fa fa-save"></i>' +
                            'Simpan');
                        if (response == true) {
                            document.getElementById("formTambah").reset();
                            swalInputSuccess();
                            show_data();
                            $('#modalTambah').modal('hide');
                        } else if (response == 401) {
                            swalIdDouble('Potongan Sudah digunakan!');
                        } else {
                            swalPotonganFailed();
                        }
                    }
                });
            }
        })
    }

    if ($("#formEdit").length > 0) {
        $("#formEdit").validate({
            errorClass: "my-error-class",
            validClass: "my-valid-class",
            rules: {

            },
            messages: {

                e_nama: {
                    required: "Nama jabatan harus diisi!"
                },

            },
            submitHandler: function(form) {
                $('#btn_edit').html('Sending..');
                $.ajax({
                    url: "<?php echo base_url('modulkasir/potongan/update') ?>",
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
                            swalIdDouble('Nama Jabatan Sudah digunakan!');
                        } else {
                            swalEditFailed();
                        }
                    }
                });
            }
        })
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        show_data();
        $('#table_id').DataTable();
    });

    //function show all Data
    function show_data() {
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('modulkasir/potongan/tampil') ?>',
            async: true,
            dataType: 'json',
            success: function(data) {
                var html = '';
                var i = 0;
                var no = 1;
                for (i = 0; i < data.length; i++) {
                    html += '<tr>' +
                        '<td class="text-center">' + no + '</td>' +
                        '<td>' + data[i].NMSISWA + '</td>' +
                        '<td>' + data[i].Kelass + '</td>' +
                        '<td>' + data[i].pot_spp2 + '</td>' +
                        '<td>' + data[i].pot_gdg2 + '</td>' +
                        '<td>' + data[i].pot_modul2 + '</td>' +
                        '<td>' + data[i].pot_kgt2 + '</td>' +
                        '<td class="text-center">' +
                        '<button  href="#my-modal-edit" class="btn btn-xs btn-info item_edit" title="Edit" data-id="' + data[i].idsaldo + '">' +
                        '<i class="ace-icon fa fa-pencil bigger-120"></i>' +
                        '</button> &nbsp' +
                        '<button class="btn btn-xs btn-danger item_hapus" title="Delete" data-id="' + data[i].idsaldo + '">' +
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

    //show modal tambah
    $('#item-tambah').on('click', function() {
        $('#modalTambah').modal('show');
    });

    //get data for update record
    $('#show_data').on('click', '.item_edit', function() {
        document.getElementById("formEdit").reset();
        var id = $(this).data('id');
        $('#modalEdit').modal('show');
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('modulkasir/potongan/tampil_byid') ?>",
            async: true,
            dataType: "JSON",
            data: {
                id: id,
            },
            success: function(data) {
                $('#e_id').val(data[0].idsaldo);
                $('#e_potonganspp').val(formatRupiah5(data[0].pot_spp, 'Rp. '));
                $('#e_potonganspp_v').val(data[0].pot_spp);
                $('#e_potongangedung').val(formatRupiah6(data[0].pot_gdg, 'Rp. '));
                $('#e_potongangedung_v').val(data[0].pot_gdg);
                $('#e_potongankegiatan').val(formatRupiah7(data[0].pot_kgt, 'Rp. '));
                $('#e_potongankegiatan_v').val(data[0].pot_kgt);
                $('#e_potonganmodul').val(formatRupiah8(data[0].pot_modul, 'Rp. '));
                $('#e_potonganmodul_v').val(data[0].pot_modul);
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
                    url: "<?php echo base_url('modulkasir/potongan/delete') ?>",
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