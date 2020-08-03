<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<div class="row">
    <form class="form-horizontal" target="_blank" method="POST" role="form" id="formSearch" action="<?php echo base_url() ?>modulkasir/lap_bayarsiswa/laporan_pdf">
        <div class="col-xs-4">
            Program Sekolah
            <select class="form-control" name="programsekolah" id="programsekolah">
                <option value="0">--Pilih Program Sekolah--</option>
                <?php foreach ($myps as $value) { ?>
                    <option value=<?= $value['KDTBPS'] ?>><?= $value['KDTBPS']." - ".$value['SINGKTBPS'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-xs-3">
            Siswa
            <select class="form-control" name="siswa" id="siswa">
                                        <option value="0">-- Pilih Siswa --</option>
                                    </select>
        </div>
        <div class="col-xs-1">
            <br>
            <button type="submit" id="btn_search" class="btn btn-sm btn-success pull-left">
                <a class="ace-icon fa fa-search bigger-120"></a>Periksa
            </button>
        </div>
        <br>
        <br>
    </form>
    </div>
    <br>
    <br>
    <div class="row">
    <div class="col-xs-12">
        <div class="table-header">
            Semua Data <?= $page_name; ?>
        </div>
    </div>
</div>


<div class="table-responsive">
    <table id="table_id" class="display">
        <thead>
            <tr>
                <th class="col-md-1">No</th>
                <th>NOREG</th>
                <th>NAMA SISWA</th>
                <th>TAHUN MASUK</th>
                <th>TAHUN AKADEMIK</th>
                <th>KELAS</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="show_data">
        </tbody>
    </table>
</div>


<script>
    if ($("#formSearch").length > 0) {
        $("#formSearch").validate({
            errorClass: "my-error-class",
            validClass: "my-valid-class",
            rules: {
                nopembayaran: {
                    required: false
                },

                tahun: {
                    required: false
                },
            },
            submitHandler: function(form) {
                $('#btn_search').html('Searching..');
                $.ajax({
                    type: 'POST',
                    url: '<?php echo site_url('modulkasir/lap_rekapbayarsiswa/search') ?>',
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
                            html += '<tr>' +
                                '<td class="text-center">' + no + '</td>' +
                                '<td>' + data[i].NOREG + '</td>' +
                                '<td>' + data[i].NMSISWA + '</td>' +
                                '<td>' + data[i].TAHUN + '</td>' +
                                '<td>' + data[i].TA + '</td>' +
                                '<td>' + data[i].Kelas + '</td>' +
                                '<td class="text-center">' +
                                '<button  href="#my-modal-edit" class="btn btn-xs btn-successs item_edit" title="Upload" data-ta="' + data[i].TA + '" data-id="' + data[i].NOREG + '">' +
                                '<i class="ace-icon fa fa-print bigger-120"></i>' +
                                '</button> &nbsp' +
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
        })
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('select').select2({
			width: '100%',
			placeholder: "Pilih Siswa",
			allowClear: true
		});
        show_data();
        $('#table_id').DataTable();
        $("#programsekolah").change(function() {
            var ps = $('#programsekolah').val();
            $.ajax({
                type: "POST",
                url: "lap_rekapbayarsiswa/showsiswa",
                data: {
                    programsekolah: ps
                }
            }).done(function(data) {
                $("#siswa").html(data);
            });
        });
    });

    //function show all Data
    function show_data() {
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('laporan/tampil') ?>',
            async: true,
            dataType: 'json',
            success: function(data) {
                var html = '';
                var i = 0;
                var no = 1;
                for (i = 0; i < data.length; i++) {
                    html += '<tr>' +
                        '<td class="text-center">' + no + '</td>' +
                        '<td>' + data[i].NAMAJABATAN + '</td>' +
                        '<td>' + data[i].KET + '</td>' +
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

</script>