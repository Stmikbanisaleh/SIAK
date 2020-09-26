<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<!-- End Select2 -->

<div class="col-xs-12">
    <form class="form-horizontal" role="form" id="formSearch">
        <div class="form-group">
            <div class="col-xs-12 col-md-5 col-lg-5">
                    
                <select class="form-control" name="siswa" id="siswa">
                    <option value="0">--Pilih Siswa--</option>
                    <?php foreach ($my_siswa as $value) { ?>
                        <option value=<?= $value['NOINDUK'] ?>><?= $value['NOINDUK'] . " - " . $value['NMSISWA'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <!-- <div class="form-group">
            <div class="col-xs-6">
                Kelas
                <select class="form-control" name="kelas" id="kelas">
                    <option>--Pilih Kelas--</option>
                    <?php foreach ($my_kelas as $value) { ?>
                        <option value=<?= $value['id_kelas'] ?>><?= $value['nama'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>-->
        <div class="form-group">
            <div class="col-xs-12 col-md-5 col-lg-5">
                Tahun Akademik
                <select class="form-control" name="thnakad" id="thnakad">
                    <option value="0"   >--Pilih Tahun Akademik--</option>
                    <?php foreach ($my_tahun as $value) { ?>
                        <option value=<?= $value['THNAKAD'] ?>><?= $value['THNAKAD'] ?></option>
                    <?php } ?>
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
        <hr>
        <div class="form-group">
            <div class="col-xs-3 col-md-1 col-lg-1">
                NIS
            </div>
            <div class="col-xs-9 col-md-11 col-lg-11" id="nis">
                : -
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-3 col-md-1 col-lg-1">
                Nama
            </div>
            <div class="col-xs-9 col-md-11 col-lg-11" id="nama">
                : -
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-3 col-md-1 col-lg-1">
                Sekolah
            </div>
            <div class="col-xs-9 col-md-11 col-lg-11" id="sekolah">
                : -
            </div>
        </div>
        <hr>
    </form>
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
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nominal </label>
                                <div class="col-sm-6">
                                    <input type="text" id="e_nominal" name="e_nominal" placeholder="Rp.1000.000" class="form-control" />
                                    <input type="hidden" class="form-control" name="e_nominal_v" placeholder="Rp.1000.000" id="e_nominal_v" />
                                    <script language="JavaScript">
                                        var rupiah6 = document.getElementById('e_nominal');
                                        rupiah6.addEventListener('keyup', function(e) {
                                            // tambahkan 'Rp.' pada saat form di ketik
                                            // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                                            rup6 = this.value.replace(/\D/g, '');
                                            $('#e_nominal_v').val(rup6);
                                            rupiah6.value = formatRupiah6(this.value, 'Rp. ');
                                        });

                                        function formatRupiah6(angka, prefix) {
                                            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                                                split = number_string.split(','),
                                                sisa6 = split[0].length % 3,
                                                rupiah6 = split[0].substr(0, sisa6),
                                                ribuan6 = split[0].substr(sisa6).match(/\d{3}/gi);

                                            // tambahkan titik jika yang di input sudah menjadi angka ribuan
                                            if (ribuan6) {
                                                separator = sisa6 ? '.' : '';
                                                rupiah6 += separator + ribuan6.join('.');
                                            }

                                            rupiah6 = split[1] != undefined ? rupiah6 + ',' + split[1] : rupiah6;
                                            return prefix == undefined ? rupiah6 : (rupiah6 ? 'Rp. ' + rupiah6 : '');
                                        }
                                    </script>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-3">
                                <input type="hidden" id="e_nis" name="e_nis" placeholder="NISN" class="form-control" />
                                <input type="hidden" id="e_kodejnsbayar" name="e_kodejnsbayar" placeholder="Kode Jenis Bayar" class="form-control" />
                                <input type="hidden" id="e_kelas" name="e_kelas" placeholder="Kelas" class="form-control" />
                                <input type="hidden" id="e_ta" name="e_ta" placeholder="Tahun Ajaran" class="form-control" />
                                </div>
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
            <!-- Semua Data <?= $page_name; ?> -->
        </div>
    </div>
</div>
<br>
<div class="table-responsive">
    <table id="table_id" class="display">
        <thead>
            <tr>
                <th class="col-md-1">No</th>
                <th>Jenis Pembayaran</th>
                <th>Kelas</th>
                <th>Tahun Ajaran</th>
                <th>Tarif Berlaku</th>
                <th>Nominal Bayar</th>
                <th>Status Pembayaran</th>
                <th>Nominal Lunas</th>
                <th>User Input</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="show_data">
        </tbody>
    </table>
</div>
<script>
    $('select').select2({
        width: '100%',
        placeholder: "Select an Option",
        allowClear: true
    });

    if ($("#formSearch").length > 0) {
        $("#formSearch").validate({
            errorClass: "my-error-class",
            validClass: "my-valid-class",
            rules: {
                siswa: {
                    required: true
                },
                thnakad: {
                    required: false
                },
            },
            submitHandler: function(form) {
                $('#btn_search').html('Searching..');

                $.ajax({
                    type: 'POST',
                    url: '<?php echo site_url('modulkasir/status_bayarsiswa/search_siswa') ?>',
                    data: $('#formSearch').serialize(),
                    async: true,
                    dataType: 'json',
                    success: function(data) {
                            document.getElementById('nis').innerHTML = ': '+data[0].NOINDUK;
                            document.getElementById('nama').innerHTML = ': '+data[0].NMSISWA;
                            document.getElementById('sekolah').innerHTML = ': '+data[0].sekolah;

                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '<?php echo site_url('modulkasir/status_bayarsiswa/view_list_status') ?>',
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
                            // var a = convert_null_to_string(null, '-');
                            var nominal_bayar = (data[i].nominal_bayar == null ? '-' : data[i].nominal_bayar);
                            var status_pembayaran = (data[i].status_pembayaran == null ? '-' : data[i].status_pembayaran);
                            var decode_status_pembayaran = (status_pembayaran == 'L' ? 'Lunas' : status_pembayaran);
                            var nominal_lunas = (data[i].nominal_lunas == null ? '-' : data[i].nominal_lunas);
                            action_edit = '';
                            action_hapus = '';
                            if(data[i].kelas != "-"){
                                var action_edit = '<button  href="#my-modal-edit" class="btn btn-xs btn-info item_edit" title="Edit" data-nominal_lunas_nf="' + data[i].nominal_lunas_nf + '" data-nisn="' + data[i].NOINDUK + '" data-kodejnsbayar="' + data[i].Kodejnsbayar + '" data-kelas="' + data[i].kelas + '" data-ta="' + data[i].TA + '">' +
                                    '<i class="ace-icon fa fa-pencil bigger-120"></i>' +
                                    '</button> &nbsp';
                            }
                            if(status_pembayaran == 'L'){
                                var action_hapus = '<button class="btn btn-xs btn-danger item_hapus" title="Delete" data-id="' + data[i].id_status_pembayaran + '">' +
                                    '<i class="ace-icon fa fa-trash-o bigger-120"></i>' +
                                    '</button>';
                            }
                            html += '<tr>' +
                                '<td class="text-center">' + no + '</td>' +
                                '<td>' + data[i].namajenisbayar + '</td>' +
                                '<td>' + data[i].kelas + '</td>' +
                                '<td>' + data[i].TA + '</td>' +
                                '<td>' + data[i].tarif_berlaku + '</td>' +
                                '<td>' + nominal_bayar + '</td>' +
                                '<td>' + decode_status_pembayaran + '</td>' +
                                '<td>' + nominal_lunas + '</td>' +
                                '<td>' + data[i].user_input + '</td>' +
                                '<td class="text-center">' +
                                action_edit+
                                action_hapus+
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

                            });

                        }
                        /* END TABLETOOLS */
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
                e_nominal_v: {
                    required: true
                },
            },
            submitHandler: function(form) {
                $('#btn_edit').html('Sending..');
                $.ajax({
                    url: "<?php echo base_url('modulkasir/status_bayarsiswa/update_lunas') ?>",
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
</script>
<script type="text/javascript">
    $(document).ready(function() {
        // show_data();
        $('#table_id').DataTable();
    });


    //show modal tambah
    $('#item-tambah').on('click', function() {
        $('#modalTambah').modal('show');
    });

    //get data for update record
    $('#show_data').on('click', '.item_edit', function() {
        document.getElementById("formEdit").reset();
        var nominal_lunas_nf = $(this).data('nominal_lunas_nf');
        var nisn = $(this).data('nisn');
        var kodejnsbayar = $(this).data('kodejnsbayar');
        var kelas = $(this).data('kelas');
        var ta = $(this).data('ta');
        $('#modalEdit').modal('show');

        rp_nominal = formatRp(nominal_lunas_nf, 'Rp. ');
        $('#e_nominal').val(rp_nominal);
        $('#e_nominal_v').val(nominal_lunas_nf);
        $('#e_nominal_v').val(nominal_lunas_nf);
        $('#e_nis').val(nisn);
        $('#e_kodejnsbayar').val(kodejnsbayar);
        $('#e_kelas').val(kelas);
        $('#e_ta').val(ta);
    });

    function formatRp(angka, prefix) {
        if(angka == null){
            return 0;
            exit;
        }
        var	number_string = angka.toString(),
        sisa 	= number_string.length % 3,
        rupiah 	= number_string.substr(0, sisa),
        ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        return prefix == undefined ? rupiah : (rupiah ? prefix + rupiah : '');
    }

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
                    url: "<?php echo base_url('modulkasir/status_bayarsiswa/delete') ?>",
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
