<div class="row">
    <div class="col-xs-6">
        <!-- PAGE CONTENT BEGINS -->
        <form class="form-horizontal" role="form" id="formSearch">
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Kode Dapodik </label>
                <div class="col-sm-9">
                    <?php if (!empty($guru[0]['GuruNoDapodik'])) { ?>
                        <input type="text" disabled id="kddapodik" value="<?php echo $guru[0]['GuruNoDapodik']; ?>" name="kddapodik" placeholder="kode Dapodik" class="form-control" />
                    <?php } else { ?>
                        <input type="text" disabled id="kddapodik" value="No Dapotik belum ada" name="kddapodik" placeholder="kode Dapodik" class="form-control" />
                    <?php } ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nama </label>
                <div class="col-sm-9">
                    <input type="hidden" id="gurunama" value="<?php echo $guru[0]['GuruNama']; ?>" name="gurunama" />
                    <input type="text" disabled id="gurunama2" value="<?php echo $guru[0]['GuruNama']; ?>" name="gurunama2" placeholder="nama siswa" class="form-control" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Mata Pelajaran </label>
                <div class="col-sm-9">
                    <select class="form-control" name="mapel" id="mapel">
                        <option value="">-- Pilih Pelajaran --</option>
                        <?php foreach ($mypelajaran as $value) { ?>
                            <option value=<?= $value['id'] ?>><?= $value['nama'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <button type="submit" id="btn_tampilkan" class="btn btn-xs btn-info pull-right">
                <i class="ace-icon fa fa-search bigger-120"></i>
                Tampilkan
            </button>
            <br>
            <br>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="table-header">
            Form Nilai Uts
        </div>
    </div>
</div>
<table id="datatable_tabletools" class="display">
    <thead>
        <tr>
            <th>No</th>
            <th>Hari</th>
            <th>Nama Kelas</th>
            <th>Jam</th>
            <th>Nama Siswa</th>
            <th>UTS</th>
        </tr>
    </thead>
    <tbody id="show_data">
    </tbody>
</table>
<script type="text/javascript">
    if ($("#formSearch").length > 0) {
        $("#formSearch").validate({
            errorClass: "my-error-class",
            validClass: "my-valid-class",
            rules: {
                tahun: {
                    required: true,
                },
                semester: {
                    required: true,
                },
                programsekolah: {
                    required: true,
                },
            },
            messages: {
                tahun: {
                    required: "Tahun harus diisi!"
                },
                semester: {
                    required: "Semester harus diisi!"
                },
                programsekolah: {
                    required: "Harap Masukan Program sekolah dengan benar!"
                },
            },
            submitHandler: function(form) {
                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url('modulguru/uts/search') ?>",
                    data: $('#formSearch').serialize(),
                    dataType: 'JSON',
                    success: function(data) {
                        var html = '';
                        var i = 0;
                        var no = 1;
                        for (i = 0; i < data.length; i++) {
                            html += '<tr>' +
                                '<td class="text-center">' + no + '</td>' +
                                '<td>' + data[i].hari + '</td>' +
                                '<td>' + data[i].NMKLSTRJDK + '</td>' +
                                '<td>' + data[i].JAM + '</td>' +
                                '<td>' + data[i].NMSISWA + '</td>' +
                                '<td>' + data[i].UTSTRNIL + '</td>' +
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
                    url: "<?php echo base_url('guru/simpan') ?>",
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
                    url: "<?php echo base_url('guru/update') ?>",
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
                    url: "<?php echo base_url('guru/delete') ?>",
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
            url: "<?php echo base_url('guru/tampil_byid') ?>",
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

    //function show all Data
    function show_data() {
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('modulguru/uts/tampil') ?>',
            async: true,
            dataType: 'json',
            success: function(data) {
                var html = '';
                var i = 0;
                var no = 1;
                for (i = 0; i < data.length; i++) {
                    html += '<tr>' +
                        '<td class="text-center">' + no + '</td>' +
                        '<td>' + data[i].DESCRTBPS + '</td>' +
                        '<td>' + data[i].IdGuru + '</td>' +
                        '<td>' + data[i].GuruNoDapodik + '</td>' +
                        '<td>' + data[i].GuruNama + '</td>' +
                        '<td>' + data[i].GuruTelp + '</td>' +
                        '<td>' + data[i].GuruAlamat + '</td>' +
                        '<td>' + data[i].GuruJeniskelamin + '</td>' +
                        '<td>' + data[i].NMMSPENDIDIKAN + '</td>' +
                        '<td class="text-center">' +
                        '<button  href="#my-modal-edit" class="btn btn-xs btn-info item_edit" title="Edit" data-id="' + data[i].id + '">' +
                        '<i class="ace-icon fa fa-pencil bigger-120"></i>' +
                        '</button> &nbsp' +
                        '<button class="btn btn-xs btn-danger item_hapus" title="Delete" data-id="' + data[i].id + '">' +
                        '<i class="ace-icon fa fa-trash-o bigger-120"></i>' +
                        '</button>' +
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