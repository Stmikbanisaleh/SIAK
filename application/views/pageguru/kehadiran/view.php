<div id="modalEdit" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="smaller lighter blue no-margin">Form Mulai</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <form class="form-horizontal" role="form" id="formEdit">
                            <div class="form-group">
                                <span>
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Mulai </label>
                                    <div class="col-sm-6">
                                        <input type="hidden" name="e_id" id="e_id" class="form-control" />
                                        <label id ="txt" class="col-sm-3 control-label no-padding-right" for="form-field-1"> Mulai </label>
                                    </div>
                                </span>
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

<div id="modalEdit2" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="smaller lighter blue no-margin">Form Selesai</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <form class="form-horizontal" role="form" id="formSelesai">
                            <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Pokok Bahasan </label>
                                    <div class="col-sm-6">
                                        <input type="hidden" name="e_id2" id="e_id2" class="form-control" />
                                        <textarea  name="pkbahasan" id="pkbahasan" class="form-control"></textarea>
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Rincian </label>
                                    <div class="col-sm-6">
                                        <textarea  name="rincian" id="rincian" class="form-control"></textarea>
                                    </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btn_update" class="btn btn-sm btn-success pull-left">
                    <i class="ace-icon fa fa-save"></i>
                    Selesai
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

<div id="modalBahasan" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="smaller lighter blue no-margin">Form Bahasan</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <form class="form-horizontal" role="form" id="formEditbahasan">
                            <div class="form-group">
                                <span>
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Pokok Bahasan </label>
                                    <div class="col-sm-6">
                                        <input type="hidden" name="e_id" id="e_id" class="form-control" />
                                        <textarea type="text" id="e_bahasan" name="e_bahasan" readonly placeholder="" class="form-control"></textarea>
                                    </div>
                                </span>
                            </div>
                    </div>
                </div>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div id="modalRincian" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="smaller lighter blue no-margin">Form Rincian</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <form class="form-horizontal" role="form" id="formRincian">
                            <div class="form-group">
                                <span>
                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Rincian </label>
                                    <div class="col-sm-6">
                                        <input type="hidden" name="e_id" id="e_id" class="form-control" />
                                        <textarea type="text" id="e_rincian" name="e_rincian" readonly placeholder="" class="form-control"></textarea>
                                    </div>
                                </span>
                            </div>
                    </div>
                </div>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="table-header">
            Tampil Jadwal
        </div>
    </div>
</div>
<div class="table-responsive">
    <table id="datatable_tabletools" class="display">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Guru</th>
                <th>Pokok Pembahasan</th>
                <th>Rincian </th>
                <th>Mengajar</th>
                <th class="text-center">Mulai</th>
                <th class="text-center">Selesai</th>
            </tr>
        </thead>
        <tbody id="show_data">
        </tbody>
    </table>
</div>

<body onload="startTime()">
    <script type="text/javascript">
        function startTime() {
            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('txt').innerHTML =
                h + ":" + m + ":" + s;
            var t = setTimeout(startTime, 500);
        }

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i
            }; // add zero in front of numbers < 10
            return i;
        }

        $('#show_data').on('click', '.item_edit', function() {
            document.getElementById("formEdit").reset();
            var id = $(this).data('id');
            $('#modalEdit').modal('show');
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('modulguru/kehadiran/tampil_byidstart') ?>",
                async: true,
                dataType: "JSON",
                data: {
                    id: id,
                },
                success: function(data) {
                    $('#e_id').val(data[0].id);
                }
            });
        });

        $('#show_data').on('click', '.item_edit2', function() {
            document.getElementById("formSelesai").reset();
            var id = $(this).data('id');
            $('#modalEdit2').modal('show');
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('modulguru/kehadiran/tampil_byidselesai') ?>",
                async: true,
                dataType: "JSON",
                data: {
                    id: id,
                },
                success: function(data) {
                    $('#e_id2').val(data[0].id);
                }
            });
        });

        $('#show_data').on('click', '.item_bahasan', function() {
            document.getElementById("formEditbahasan").reset();
            var id = $(this).data('id');
            $('#modalBahasan').modal('show');
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('modulguru/kehadiran/tampil_byidbahasan') ?>",
                async: true,
                dataType: "JSON",
                data: {
                    id: id,
                },
                success: function(data) {
                    $('#e_bahasan').val(data[0].PKBAHASAN);
                }
            });
        });

        $('#show_data').on('click', '.item_rincian', function() {
            document.getElementById("formRincian").reset();
            var id = $(this).data('id');
            $('#modalRincian').modal('show');
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('modulguru/kehadiran/tampil_byidrincian') ?>",
                async: true,
                dataType: "JSON",
                data: {
                    id: id,
                },
                success: function(data) {
                    $('#e_rincian').val(data[0].RINCIAN);
                }
            });
        });


        $(document).ready(function() {
            show_data();
            $('#datatable_tabletools').DataTable();
        });

        $('#item-check').on('click', '.item_edit', function() {
            show_data();
        });

        if ($("#formEdit").length > 0) {
            $("#formEdit").validate({
                errorClass: "my-error-class",
                validClass: "my-valid-class",
                submitHandler: function(form) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url('modulguru/kehadiran/simpan') ?>",
                        dataType: "JSON",
                        data: $('#formEdit').serialize(),
                        success: function(data) {
                            $('#modalEdit').modal('hide');
                            if (data == 1) {
                                document.getElementById("formEdit").reset();
                                swalEditSuccess();
                                show_data();
                            } else {
                                swalEditFailed();
                            }
                        }
                    });
                    return false;
                }
            });
        }

        if ($("#formSelesai").length > 0) {
            $("#formSelesai").validate({
                errorClass: "my-error-class",
                validClass: "my-valid-class",
                submitHandler: function(form) {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url('modulguru/kehadiran/selesai') ?>",
                        dataType: "JSON",
                        data: $('#formSelesai').serialize(),
                        success: function(data) {
                            $('#modalEdit2').modal('hide');
                            if (data == 1) {
                                document.getElementById("formSelesai").reset();
                                swalEditSuccess();
                                show_data();
                            }
                        }
                    });
                    return false;
                }
            });
        }

        //function show all Data
        function show_data() {
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('modulguru/kehadiran/tampil') ?>",
                async: true,
                dataType: 'JSON',
                success: function(data) {
                    var html = '';
                    var i = 0;
                    var no = 1;
                    for (i = 0; i < data.length; i++) {
                        html +=
                            '<tr>' +
                            '<td class="text-center">' + no + '</td>' +
                            '<td>' + data[i].GuruNama + '</td>' +
                            '<td>' + data[i].pokok_bahasan + '</td>' +
                            '<td>' + data[i].rincian + '</td>' +
                            '<td>' + data[i].namamapel + ' <br> Jam ke ' + data[i].JAM + '<br> ' + data[i].nmkls + ' </td>' +
                            '<td class="text-center">' +
                            '<button  href="#my-modal-edit" class="btn btn-xs btn-info item_edit" title="Edit" data-id="' + data[i].id + '">' +
                            '<i class="ace-icon fa fa-play bigger-120"></i> Mulai' +
                            '</button> &nbsp' +
                            '<td class="text-center">' +
                            '<button  href="#my-modal-edit" class="btn btn-xs btn-danger item_edit2" title="Edit" data-id="' + data[i].id + '">' +
                            '<i class="ace-icon fa fa-stop bigger-120"></i> Selesai' +
                            '</button> &nbsp' +
                            '</tr>' +
                            '</form>';
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