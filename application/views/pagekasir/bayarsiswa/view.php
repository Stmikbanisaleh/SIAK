
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
<!-- End Select2 -->

<div class="row">
    <div class="col-xs-4">
        <form class="form-horizontal" role="form" id="formSearch">
            <div class="form-group">
                <div class="col-xs-10">
                    Siswa
                    <select class="form-control" name="siswa" id="siswa">
                        <option>--Pilih Siswa--</option>
                        <?php foreach ($my_siswa as $value) { ?>
                            <option value=<?= $value['NOINDUK'] ?>><?= $value['NOINDUK']." - ".$value['NMSISWA'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-6">
                    Kelas
                    <select class="form-control" name="kelas" id="kelas">
                        <option>--Pilih Kelas--</option>
                        <?php foreach ($my_kelas as $value) { ?>
                            <option value=<?= $value['id_kelas'] ?>><?= $value['nama'] ?></option>
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
            <br>
            <br>
        </form>
    </div>
    <div class="col-xs-7">
        <form class="form-horizontal" target="_blank" method="POST" role="form" id="as" action="<?php echo base_url() ?>modulkasir/surattagihan/laporan_pdf">
            <div class="form-group">
                <div class="col-xs-12">
                    <h4><b>Siswa &nbsp; &nbsp; : 
                        <div id="namasiswa">

                        </div>
                    </b><h4>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-3">
                    <b>Tarif Sekolah</b>
                    <div class="input-group">
                        SPP
                    </div>
                </div>
                <div class="col-xs-3">
                    <b>Biaya tagihan</b>
                    <div class="input-group">
                        Rp. 
                        <div id="tghn_spp">
                            
                        </div>
                    </div>
                </div>
                <div class="col-xs-3">
                    <b>Dibayarkan</b>
                    <div class="input-group">
                        Rp. 
                        <div id="dbyr_spp">
                            
                        </div>
                    </div>
                </div>
                <div class="col-xs-3">
                    <b>Bayar</b>
                    <div class="input-group">
                        <input type="text" id="asd" required name="asd" placeholder="Tahun" class="form-control" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-3">
                    <div class="input-group">
                        Gedung
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="input-group">
                        Rp. 
                        <div id="tghn_gedung">
                            
                        </div>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="input-group">
                        Rp.
                        <div id="dbyr_gedung">
                            
                        </div>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="input-group">
                        <input type="text" id="asd" required name="asd" placeholder="Tahun" class="form-control" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-3">
                    <div class="input-group">
                        Seragam
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="input-group">
                        Rp. 
                        <div id="tghn_seragam">
                            
                        </div>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="input-group">
                        Rp.
                        <div id="dbyr_seragam">
                            
                        </div>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="input-group">
                        <input type="text" id="asd" required name="asd" placeholder="Tahun" class="form-control" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-3">
                    <div class="input-group">
                        Kegiatan
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="input-group">
                        Rp. 
                        <div id="tghn_kegiatan">
                            
                        </div>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="input-group">
                        Rp.
                        <div id="dbyr_kegiatan">
                            
                        </div>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="input-group">
                        <input type="text" id="asd" required name="asd" placeholder="Tahun" class="form-control" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-3">
                    <div class="input-group">
                        <b>Total Tagihan</b>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="input-group">
                        
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="input-group">
                        
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="input-group">
                        <b>Rp. 1.800.000</b>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-5">
                    <div class="input-group">
                        <b>Sisa Belum Dibayarkan</b>
                    </div>
                </div>
                <div class="col-xs-1">
                    <div class="input-group">
                        
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="input-group">
                        
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="input-group">
                        <b>Rp. 1.800.000</b>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-3">
                    <div class="input-group">
                        <b>Total Bayar</b>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="input-group">
                        
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="input-group">
                        
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="input-group">
                        <input type="text" id="asd" required name="asd" placeholder="Tahun" class="form-control" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-1">
                    <br>
                    <button type="submit" id="btn_searcah" class="btn btn-sm btn-success pull-left">
                        <a class="ace-icon fa fa-save bigger-120"></a>Simpan
                    </button>
                </div>
            </div>
            <br>
            <br>
        </form>
    </div>
</div>
<table id="table_id" class="display">
    <thead>
        <tr>
            <th class="col-md-1">No</th>
            <th>No Induk</th>
            <th>Kelas</th>
            <th>Tagihan</th>
            <th>Bayar</th>
            <th>Sisa</th>
            <th>Tahun Akademik</th>
        </tr>
    </thead>
    <tbody id="show_data">

    </tbody>
</table>
<hr>
<br>
<table id="table_id2" class="display">
    <thead>
        <tr>
            <th class="col-md-1">No</th>
            <th>No Induk</th>
            <th>Kelas</th>
            <th>Tanggal</th>
            <th>Bayar</th>
            <th>Petugas</th>
            <th>Tahun Akademik</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody id="show_data2">

    </tbody>
</table>
<hr>
<br>
<table id="table_id3" class="display">
    <thead>
        <tr>
            <th class="col-md-1">No</th>
            <th>No Induk</th>
            <th>Kelas</th>
            <th>Tanggal</th>
            <th>Keterangan</th>
            <th>Tagihan</th>
            <th>Bayar</th>
            <th>Sisa</th>
            <th>Petugas</th>
            <th>Tahun Akademik</th>
        </tr>
    </thead>
    <tbody id="show_data3">

    </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function() {
        $('#table_id').DataTable();
        $('#table_id2').DataTable();
        $('#table_id3').DataTable();
    });
</script>


<!-- Start Select2 -->
<script>
    $('select').select2({ width: '100%', placeholder: "Select an Option", allowClear: true });

    if ($("#formSearch").length > 0) {
        $("#formSearch").validate({
            errorClass: "my-error-class",
            validClass: "my-valid-class",
            rules: {
                siswa: {
                    required: false
                },

                kelas: {
                    required: false
                },
            },
            submitHandler: function(form) {
                $('#btn_search').html('Searching..');

                $.ajax({
                    type: 'POST',
                    url: '<?php echo site_url('modulkasir/bayarsiswa/view_tagihan') ?>',
                    data: $('#formSearch').serialize(),
                    async: true,
                    dataType: 'json',
                    success: function(data) {
                        $('#btn_search').html('<i class="ace-icon fa fa-search"></i>' +
                            'Periksa');
                        $('#namasiswa').html(data[0].Namacasis);
                        $('#tghn_spp').html(formatRupiah(data[0].nominal_spp));
                        $('#tghn_gedung').html(formatRupiah(data[0].nominal_GDG));
                        $('#tghn_seragam').html(formatRupiah(data[0].nominal_SRG));
                        $('#tghn_kegiatan').html(formatRupiah(data[0].nominal_KGT));
                        $('#dbyr_spp').html(formatRupiah(data[0].blmbyr_spp));
                        $('#dbyr_gedung').html(formatRupiah(data[0].blmbyr_gdg));
                        $('#dbyr_seragam').html(formatRupiah(data[0].blmbyr_srg));
                        $('#dbyr_kegiatan').html(formatRupiah(data[0].blmbyr_kgt));
                        console.log(data);

                        /* END TABLETOOLS */
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '<?php echo site_url('modulkasir/bayarsiswa/search') ?>',
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
                                '<td>' + data[i].NIS+ '</td>' +
                                '<td>' + data[i].Kelas+ '</td>' +
                                '<td>' + formatRupiah(data[i].TotalTagihan) + '</td>' +
                                '<td>' + formatRupiah(data[i].Bayar) + '</td>' +
                                '<td>' + formatRupiah(data[i].Sisa) + '</td>' +
                                '<td>' + data[i].TA + '</td>' +
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

                $.ajax({
                    type: 'POST',
                    url: '<?php echo site_url('modulkasir/bayarsiswa/search_pemb_sekolah') ?>',
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
                                '<td>' + data[i].NIS+ '</td>' +
                                '<td>' + data[i].Kelas+ '</td>' +
                                '<td>' + data[i].tglentri+ '</td>' +
                                '<td>' + formatRupiah(data[i].TotalBayar) + '</td>' +
                                '<td>' + data[i].useridd+ '</td>' +
                                '<td>' + data[i].TA+ '</td>' +
                                '<td>' +
                                        '<a target="_blank"  href="<?php echo  base_url().'modulkasir/bayarsiswa/print?noreg='?>'+ data[i].Noreg+'&no='+ data[i].Nopembayaran+'&kls='+ data[i].Kelas+'" class="btn btn-xs btn-info" title="Print" data-id="' + data[i].NIS + '">' +
                                            '<i class="ace-icon fa fa-print bigger-120"></i>' +
                                            '</a> &nbsp' +
                                '</td>' +
                                '</tr>';
                            no++;
                        }
                        $("#table_id2").dataTable().fnDestroy();
                        var a = $('#show_data2').html(html);
                        //                    $('#mydata').dataTable();
                        if (a) {
                            $('#table_id2').dataTable({
                                "bPaginate": true,
                                "bLengthChange": false,
                                "bFilter": true,
                                "bInfo": false,
                                
                            });

                        }
                        /* END TABLETOOLS */
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '<?php echo site_url('modulkasir/bayarsiswa/search_pemb_sekolah_q2') ?>',
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
                                '<td>' + data[i].NIS+ '</td>' +
                                '<td>' + data[i].Kelas+ '</td>' +
                                '<td>' + data[i].tglentri+ '</td>' +
                                '<td>' + data[i].namajenisbayar+ '</td>' +
                                '<td>' + formatRupiah(data[i].nominalbayar) + '</td>' +
                                '<td>' + formatRupiah(data[i].Nominal) + '</td>' +
                                '<td>' + formatRupiah(data[i].sisa) + '</td>' +
                                '<td>' + data[i].useridd+ '</td>' +
                                '<td>' + data[i].TA+ '</td>' +
                                '</tr>';
                            no++;
                        }
                        $("#table_id3").dataTable().fnDestroy();
                        var a = $('#show_data3').html(html);
                        //                    $('#mydata').dataTable();
                        if (a) {
                            $('#table_id3').dataTable({
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

    /* Fungsi formatRupiah */
        function formatRupiah(angka){
            if(angka != null){
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split           = number_string.split(','),
                sisa            = split[0].length % 3,
                rupiah          = split[0].substr(0, sisa),
                ribuan          = split[0].substr(sisa).match(/\d{3}/gi);
     
                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if(ribuan){
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }
     
                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return rupiah;
            }else{
                return 0;
            }
            
        }




</script>
<!-- End Select2