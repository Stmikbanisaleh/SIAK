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
            <th>No Induk</th>
            <th>Kelas</th>
            <th>Tanggal</th>
            <th>Bayar Ke</th>
            <th>SPP</th>
            <th>DU+Buku</th>
            <th>Kegiatan</th>
            <th>Petugas</th>
            <th>Cara Bayar</th>
            <th>Potongan SPP</th>
            <th>Potongan DU+Buku</th>
            <th>Potongan Kegiatan</th>
            <th>Tahun Akademik</th>
        </tr>
    </thead>
    <tbody id="show_data">
    </tbody>
</table>
<script type="text/javascript">
    $(document).ready(function() {
        show_data();
        $('#table_id').DataTable();
    });

    //function show all Data
    function show_data() {
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('modulsiswa/rekap/tampil') ?>',
            async: true,
            dataType: 'json',
            success: function(data) {
                var html = '';
                var i = 0;
                var no = 1;
                for (i = 0; i < data.length; i++) {
                    html += '<tr>' +
                        '<td class="text-center">' + no + '</td>' +
                        '<td>' + data[i].PBKNIS + '</td>' +
                        '<td>' + data[i].PBKSemester + '</td>' +
                        '<td>' + data[i].PBKTgl + '</td>' +
                        '<td>' + data[i].PBKByrke + '</td>' +
                        '<td>' + data[i].PBKSPP + '</td>' +
                        '<td>' + data[i].PBKBPP + '</td>' +
                        '<td>' + data[i].PBKKegiatan + '</td>' +
                        '<td>' + data[i].PBKuser + '</td>' +
                        '<td>' + data[i].PBKcrbayar + '</td>' +
                        '<td>' + data[i].PBKPotspp + '</td>' +
                        '<td>' + data[i].PBKpotbpp + '</td>' +
                        '<td>' + data[i].PBKpotkegiatan + '</td>' +
                        '<td>' + data[i].PBKTA + '</td>' +
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
            url: "<?php echo base_url('jabatan/tampil_byid') ?>",
            async: true,
            dataType: "JSON",
            data: {
                id: id,
            },
            success: function(data) {
                $('#e_id').val(data[0].ID);
                $('#e_nama').val(data[0].NAMAJABATAN);
                $('#e_keterangan').val(data[0].KET);

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
                    url: "<?php echo base_url('jabatan/delete') ?>",
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