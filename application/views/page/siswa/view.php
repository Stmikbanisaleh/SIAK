<div class="row">
    <div class="col-xs-1">
        <button id="item-tambah" role="button" data-toggle="modal" class="btn btn-xs btn-info">
            <a class="ace-icon fa fa-plus bigger-120"></a>Tambah Data
        </button>

    </div>
    <div class="col-xs-1">
        <button id="item-tambah" role="button" data-toggle="modal" class="btn btn-xs btn-info">
            <a class="ace-icon fa fa-plus bigger-120"></a>Import Data
        </button>

    </div>
    <br>
    <br>
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
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> No Induk </label>
                                <div class="col-sm-6">
                                    <input type="text" id="no_induk" name="no_induk" placeholder="1234567" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> No Registrasi </label>
                                <div class="col-sm-6">
                                    <input type="text" id="noreg" name="noreg" placeholder="32123132121" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tanggal Registrasi </label>
                                <div class="col-sm-6">
                                    <input type="date" id="tglreg" name="tglreg" placeholder="" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nama </label>
                                <div class="col-sm-6">
                                    <input type="text" id="nmsiswa" name="nmsiswa" placeholder="Nama Siswa" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tempat Lahir </label>
                                <div class="col-sm-6">
                                    <input type="text" id="tplhr" name="tplhr" placeholder="Bekasi" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tanggal Lahir </label>
                                <div class="col-sm-6">
                                    <input type="date" id="tglhr" name="tglhr" placeholder="" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Jenis Kelamin </label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="jk" id="jk">
                                        <option value="">-- Status --</option>
                                        <option value="P">Perempuan</option>
                                        <option value="L">Laki-Laki</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Agama </label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="agama" id="agama">
                                        <option value="">-- Pilih Agama --</option>
                                        <?php foreach ($myagama as $value) { ?>
                                            <option value=<?= $value['KDTBAGAMA'] ?>><?= $value['DESCRTBAGAMA'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tahun </label>
                                <div class="col-sm-6">
                                    <input type="number" id="tahun" name="tahun" placeholder="2020" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Program Sekolah </label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="programsekolah" id="programsekolah">
                                        <option value="">-- Pilih Program --</option>
                                        <?php foreach ($myps as $value) { ?>
                                            <option value=<?= $value['KDTBPS'] ?>><?= $value['DESCRTBPS'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Kewarganegaraan </label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="kdwarga" id="kdwarga">
                                        <option value="">-- Status --</option>
                                        <option value="1">WNI</option>
                                        <option value="2">WNA</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Email </label>
                                <div class="col-sm-6">
                                    <input type="email" id="email" name="email" id="form-field-1" placeholder="" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Telepon </label>
                                <div class="col-sm-6">
                                    <input type="number" id="telp" name="telp" id="form-field-1" placeholder="" class="form-control" />
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
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> No Induk </label>
                                <div class="col-sm-6">
                                    <input type="hidden" id="e_id" name="e_id" placeholder="1234567" class="form-control" />
                                    <input type="text" id="e_no_induk" name="e_no_induk" placeholder="1234567" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> No Registrasi </label>
                                <div class="col-sm-6">
                                    <input type="text" id="e_noreg" name="e_noreg" placeholder="32123132121" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tanggal Registrasi </label>
                                <div class="col-sm-6">
                                    <input type="date" id="e_tglreg" name="e_tglreg" placeholder="" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nama </label>
                                <div class="col-sm-6">
                                    <input type="text" id="e_nmsiswa" name="e_nmsiswa" placeholder="Nama Siswa" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tempat Lahir </label>
                                <div class="col-sm-6">
                                    <input type="text" id="e_tplhr" name="e_tplhr" placeholder="Bekasi" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tanggal Lahir </label>
                                <div class="col-sm-6">
                                    <input type="date" id="e_tglhr" name="e_tglhr" placeholder="" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Jenis Kelamin </label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="e_jk" id="e_jk">
                                        <option value="">-- Status --</option>
                                        <option value="P">Perempuan</option>
                                        <option value="L">Laki-Laki</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Agama </label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="e_agama" id="e_agama">
                                        <option value="">-- Pilih Agama --</option>
                                        <?php foreach ($myagama as $value) { ?>
                                            <option value=<?= $value['KDTBAGAMA'] ?>><?= $value['DESCRTBAGAMA'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tahun </label>
                                <div class="col-sm-6">
                                    <input type="number" id="e_tahun" name="e_tahun" placeholder="2020" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Program Sekolah </label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="e_programsekolah" id="e_programsekolah">
                                        <option value="">-- Pilih Program --</option>
                                        <?php foreach ($myps as $value) { ?>
                                            <option value=<?= $value['KDTBPS'] ?>><?= $value['DESCRTBPS'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Kewarganegaraan </label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="e_kdwarga" id="e_kdwarga">
                                        <option value="">-- Status --</option>
                                        <option value="1">WNI</option>
                                        <option value="2">WNA</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Email </label>
                                <div class="col-sm-6">
                                    <input type="email" id="e_email" name="e_email" id="form-field-1" placeholder="" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Telepon </label>
                                <div class="col-sm-6">
                                    <input type="number" id="e_telp" name="e_telp" id="form-field-1" placeholder="" class="form-control" />
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
            <th>No Induk</th>
            <!-- <th>No Registrasi</th> -->
            <!-- <th>Tanggal Resigtrasi</th> -->
            <th>Nama</th>
            <!-- <th>Tempat Lahir</th> -->
            <!-- <th>Tanggal Lahir</th> -->
            <!-- <th>Jenis Kelamin</th> -->
            <th>Agama</th>
            <th>Tahun Masuk</th>
            <th>Program Sekolah</th>
            <!-- <th>Kewarganegaraan</th> -->
            <th>E-Mail</th>
            <th>Petugas</th>
            <th>Telp</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody id="show_data">
    </tbody>
</table>
<script>
    if ($("#formTambah").length > 0) {
        $("#formTambah").validate({
            errorClass: "my-error-class",
            validClass: "my-valid-class",
            rules: {
                id: {
                    required: true
                    // ,maxlength: 50
                },

                nama: {
                    required: true
                    // , digits:true,
                    // minlength: 10,
                    // maxlength:12,
                },
                // email: {
                //         required: true,
                //         maxlength: 50,
                //         email: true,
                //     },    
            },
            messages: {

                id: {
                    required: "Kode jabatan harus diisi!"
                    // ,maxlength: "Your last name maxlength should be 50 characters long."
                },
                nama: {
                    required: "Nama jabatan harus diisi!"
                    // ,minlength: "The contact number should be 10 digits",
                    // digits: "Please enter only numbers",
                    // maxlength: "The contact number should be 12 digits",
                },
                // email: {
                //     required: "Please enter valid email",
                //     email: "Please enter valid email",
                //     maxlength: "The email name should less than or equal to 50 characters",
                //   },

            },
            submitHandler: function(form) {
                $('#btn_simpan').html('Sending..');
                $.ajax({
                    url: "<?php echo base_url('siswa/simpan') ?>",
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
                            swalIdDouble('Nama Ruangan Sudah digunakan!');
                        } else {
                            swalInputFailed();
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
                e_id: {
                    required: true
                },
                e_nama: {
                    required: true
                },
            },
            messages: {

                e_id: {
                    required: "Kode jabatan harus diisi!"
                },
                e_nama: {
                    required: "Nama jabatan harus diisi!"
                },

            },
            submitHandler: function(form) {
                $('#btn_edit').html('Sending..');
                $.ajax({
                    url: "<?php echo base_url('siswa/update') ?>",
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
                            swalIdDouble('No Induk Sudah digunakan!');
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
            type: 'ajax',
            url: '<?php echo site_url('siswa/tampil') ?>',
            async: true,
            dataType: 'json',
            success: function(data) {
                var html = '';
                var i = 0;
                var no = 1;
                for (i = 0; i < data.length; i++) {
                    html += '<tr>' +
                        '<td class="text-left">' + data[i].NOINDUK + '</td>' +
                        // '<td>' + data[i].NOREG + '</td>' +
                        // '<td class="text-right">' + data[i].TGLREG + '</td>' +
                        '<td>' + data[i].NMSISWA + '</td>' +
                        // '<td class="text-right">' + data[i].TPLHR + '</td>' +
                        // '<td>' + data[i].TGLHR + '</td>' +
                        // '<td class="text-right">' + data[i].JK + '</td>' +
                        '<td class="text-right">' + data[i].agama + '</td>' +
                        '<td class="text-right">' + data[i].TAHUN + '</td>' +
                        '<td class="text-right">' + data[i].ps + '</td>' +
                        // '<td class="text-right">' + data[i].KDWARGA + '</td>' +
                        '<td class="text-right">' + data[i].EMAIL + '</td>' +
                        '<td class="text-right">' + data[i].IDUSER + '</td>' +
                        '<td class="text-right">' + data[i].TELP + '</td>' +
                        '<td class="text-center">' +
                        '<button  href="#my-modal-edit" class="btn btn-xs btn-info item_edit" title="Edit" data-id="' + data[i].ID + '">' +
                        '<i class="ace-icon fa fa-pencil bigger-120"></i>' +
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
            url: "<?php echo base_url('siswa/tampil_byid') ?>",
            async: true,
            dataType: "JSON",
            data: {
                id: id,
            },
            success: function(data) {
                $('#e_id').val(data[0].ID);
                $('#e_no_induk').val(data[0].NOINDUK);
                $('#e_noreg').val(data[0].NOREG);
                $('#e_tglreg').val(data[0].TGLREG);
                $('#e_nmsiswa').val(data[0].NMSISWA);
                $('#e_tplhr').val(data[0].TPLHR);
                $('#e_tglhr').val(data[0].TGLHR);
                $('#e_jk').val(data[0].JK);
                $('#e_agama').val(data[0].AGAMA);
                $('#e_tahun').val(data[0].TAHUN);
                $('#e_programsekolah').val(data[0].PS);
                $('#e_kdwarga').val(data[0].KDWARGA);
                $('#e_email').val(data[0].EMAIL);
                $('#e_telp').val(data[0].TELP);
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
                    url: "<?php echo base_url('siswa/delete') ?>",
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


    //Simpan guru
    // $('#btn_simpan1').on('click', function() {
    // 	var id = $('#id').val();
    // 	var nama = $('#nama').val();
    // 	$.ajax({
    // 		type: "POST",
    // 		url: "<?php echo base_url('jabatan/simpan_jabatan') ?>",
    // 		dataType: "JSON",
    // 		data: {
    // 			id: id,
    // 			nama: nama,
    // 		},
    // 		success: function(response) {
    // 			if(response == true){
    // 				swalInputSuccess();
    // 				show_data();
    // 				$('[name="id"]').val("");
    // 				$('[name="nama"]').val("");
    // 				$('#modalTambah').modal('hide');
    // 			}else if(response == 1048){
    // 				swalIdDouble('ID Jabatan Sudah digunakan!');
    // 			}else{
    // 				swalInputFailed();
    // 			}
    // 		}
    // 	});
    // 	return false;
    // });
</script>