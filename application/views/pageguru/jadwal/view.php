<div class="row">
    <div class="col-xs-6">
        <!-- PAGE CONTENT BEGINS -->
        <form class="form-horizontal" role="form" id="formTambah">

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Program Sekolah </label>
                <div class="col-sm-9">
                    <select class="form-control" name="program_sekolah" id="program_sekolah">
                        <option value="">-- Pilih Program --</option>
                        <?php foreach ($myprogram as $value) { ?>
                            <option value=<?= $value['KDTBPS'] ?>><?= $value['DESCRTBPS'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Tahun Akademik </label>
                <div class="col-sm-9">
                    <select class="form-control" name="tahun" id="tahun">
                        <option value="">-- Pilih Tahun --</option>
                        <?php foreach ($myakadmk as $value) { ?>
                            <option value=<?= $value['ID'] ?>><?= $value['TAHUN'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <button type="submit" id="btn_periksa" class="btn btn-xs btn-info pull-right">
                <i class="ace-icon fa fa-search bigger-120"></i>
                Periksa
            </button>
            <br>
            <br>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="table-header">
            Tampil Jadwal
        </div>
    </div>
</div>
<table id="datatable_tabletools" class="display">
    <thead>
        <tr>
            <th>Guru</th>
            <th>Mata Ajar</th>
            <th>Hari </th>
            <th>Ruang</th>
            <th>Kelas</th>
            <th>Jam</th>
            <th>Program Sekolah</th>
        </tr>
    </thead>
    <tbody id="show_data">
    </tbody>
</table>
<script type="text/javascript">
    $(document).ready(function() {
        show_data();
        $('#datatable_tabletools').DataTable();
    });
    $("#datatable_tabletools").dataTable().fnDestroy();
    var a = $('#show_data').html(html);
    //$('#mydata').dataTable();
    if (a) {
        $('#datatable_tabletools').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false
        });
    }
    $(document).ready(function() {

        var userDataTable = $('#datatable_tabletools').DataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            //'searching': false, // Remove default Search Control
            'ajax': {
                'url': '<?= base_url() ?>modulguru/jadwal/periksa_jadwal',
                'data': function(data) {
                    data.searchProgram = $('#program_sekolah').val();
                    data.searchTahun = $('#tahun').val();
                }
            },
            'columns': [{
                    data: 'GuruNama'
                },
                {
                    data: 'nama'
                },
                {
                    data: 'hari'
                },
                {
                    data: 'RUANG'
                },
                {
                    data: 'NMKLSTRJDK'
                },
                {
                    data: 'JAM'
                },
                {
                    data: 'DESCRTBPS'
                },
            ]
        });

        $('#program_sekolah,#tahun').change(function() {
            userDataTable.draw();
        });

    });
</script>