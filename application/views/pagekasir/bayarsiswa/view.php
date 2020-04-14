
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
        <form class="form-horizontal" role="form" id="formInsert1" method="POST" action="<?php echo base_url()?>modulkasir/bayarsiswa/insert">
            <div class="form-group">
                <div class="col-xs-12">
                    <?php if ($this->session->flashdata('cat_error')) { ?>
                        <div class="alert alert-danger"> <?= $this->session->flashdata('cat_error') ?> </div>
                    <?php } ?>
                    <?php if ($this->session->flashdata('cat_success')) { ?>
                        <div class="alert alert-success"> <?= $this->session->flashdata('cat_success') ?> </div>
                    <?php } ?>
                </div>
            </div>
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
                </div>
                <div class="col-xs-3">
                    <b>Biaya tagihan (Rp)</b>
                </div>
                <div class="col-xs-3">
                    <b>Belum dibayarkan (Rp)</b>
                </div>
                <div class="col-xs-3">
                    <b>Bayar</b>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-3">
                    <div class="input-group">
                        SPP
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="input-group">
                        <div id="tghn_spp">
                            0
                        </div>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="input-group">
                        <div id="dbyr_spp">
                            0
                        </div>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="input-group">
                        <input type="number" id="spp" required name="spp" placeholder="SPP" class="form-control" />
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
                        <div id="tghn_gedung">
                            0
                        </div>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="input-group">
                        <div id="dbyr_gedung">
                            0
                        </div>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="input-group">
                        <input type="number" id="gedung" required name="gedung" placeholder="Gedung" class="form-control" />
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
                        <div id="tghn_seragam">
                            0
                        </div>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="input-group">
                        <div id="dbyr_seragam">
                            0
                        </div>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="input-group">
                        <input type="number" id="seragam" required name="seragam" placeholder="Seragam" class="form-control" />
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
                        <div id="tghn_kegiatan">
                            0
                        </div>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="input-group">
                        <div id="dbyr_kegiatan">
                            0
                        </div>
                    </div>
                </div>
                <div class="col-xs-3">
                    <div class="input-group">
                        <input type="number" id="kegiatan" required name="kegiatan" placeholder="Kegiatan" class="form-control" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-3">
                    <div class="input-group">
                        <b>Total Tagihan (Rp)</b>
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
                        <b>
                            <div id="tot_tagihan">
                                0
                            </div>
                        </b>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-5">
                    <div class="input-group">
                        <b>Sisa Belum Dibayarkan (Rp)</b>
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
                        <b>
                            <div id="blm_dibayarkan">
                                0
                            </div>
                        </b>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-3">
                    <div class="input-group">
                        <b>Total Bayar (Rp)</b>
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
                        <input type="text" readonly="" id="ttotal" required name="ttotal" placeholder="0" class="form-control" />
                    </div>
                </div>
            </div>
            <input type="hidden" name="nilai" value='1'>
            <input type="hidden" name="idtarif_spp" id="idtarif_spp">
            <input type="hidden" name="idtarif_gdg" id="idtarif_gdg">
            <input type="hidden" name="idtarif_srg" id="idtarif_srg">
            <input type="hidden" name="idtarif_kgt" id="idtarif_kgt">
            <input type="hidden" name="NIS" id="NIS">
            <input type="hidden" name="Noreg" id="Noreg">
            <input type="hidden" name="Kelas" id="Kelas">
            <input type="hidden" name="sisa" id="sisa">
            <input type="hidden" name="kodesekolah" id="kodesekolah">
            <div class="form-group">
                <div class="col-xs-1">
                    <br>
                    <button type="submit" id="btn_insert" class="btn btn-sm btn-success pull-left">
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
                        var sdh_dibayarkan = Number(null_tonumber(data[0].byr_spp))+Number(null_tonumber(data[0].byr_gdg))+Number(null_tonumber(data[0].byr_srg))+Number(null_tonumber(data[0].byr_kgt));
                        var total_tghn = data[0].TotalTagihan;
                        var blm_dbyrkn = data[0].blm_bayar;
                        $('#btn_search').html('<i class="ace-icon fa fa-search"></i>' +
                            'Periksa');
                        $('#namasiswa').html(data[0].Namacasis);
                        $('#tghn_spp').html(data[0].nominal_spp);
                        $('#tghn_gedung').html(data[0].nominal_gdg);
                        $('#tghn_seragam').html(data[0].nominal_srg);
                        $('#tghn_kegiatan').html(data[0].nominal_kgt);
                        $('#dbyr_spp').html(data[0].blmbyr_spp);
                        $('#dbyr_gedung').html(data[0].blmbyr_gdg);
                        $('#dbyr_seragam').html(data[0].blmbyr_srg);
                        $('#dbyr_kegiatan').html(data[0].blmbyr_kgt);
                        $('#tot_tagihan').html(total_tghn);
                        $('#blm_dibayarkan').html(data[0].Sisa);
                        $('#idtarif_spp').val(data[0].id_spp);
                        $('#idtarif_gdg').val(data[0].id_gdg);
                        $('#idtarif_srg').val(data[0].id_srg);
                        $('#idtarif_kgt').val(data[0].id_kgt);
                        $('#NIS').val(data[0].NOINDUK);
                        $('#Noreg').val(data[0].Noreg);
                        $('#Kelas').val(data[0].Kelas);
                        $('#sisa').val(Number(data[0].Sisa2));
                        $('#kodesekolah').val(data[0].kodesekolah);
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
                                        '<a target="_blank"  href="<?php echo  base_url().'modulkasir/bayarsiswa/print2?noreg='?>'+ data[i].Noreg+'&no='+ data[i].Nopembayaran+'&kls='+ data[i].Kelas+'" class="btn btn-xs btn-info" title="Print" data-id="' + data[i].NIS + '">' +
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
                                '<td>' + formatRupiah(data[i].Nominal) + '</td>' +
                                '<td>' + formatRupiah(data[i].nominalbayar) + '</td>' +
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

    $('#spp').keyup(function() {
        var spp = Number($('#spp').val());
        var gedung = Number($('#gedung').val());
        var kegiatan = Number($('#kegiatan').val());
        var seragam = Number($('#seragam').val());
        var total_bayar = spp + gedung + kegiatan + seragam;
        $('#ttotal').val(total_bayar);
    });

    $('#gedung').keyup(function() {
        var spp = Number($('#spp').val());
        var gedung = Number($('#gedung').val());
        var kegiatan = Number($('#kegiatan').val());
        var seragam = Number($('#seragam').val());
        var total_bayar = spp + gedung + kegiatan + seragam;
        $('#ttotal').val(total_bayar);
    });

    $('#seragam').keyup(function() {
        var spp = Number($('#spp').val());
        var gedung = Number($('#gedung').val());
        var kegiatan = Number($('#kegiatan').val());
        var seragam = Number($('#seragam').val());
        var total_bayar = spp + gedung + kegiatan + seragam;
        $('#ttotal').val(total_bayar);
    });
    $('#kegiatan').keyup(function() {
        var spp = Number($('#spp').val());
        var gedung = Number($('#gedung').val());
        var kegiatan = Number($('#kegiatan').val());
        var seragam = Number($('#seragam').val());
        var total_bayar = spp + gedung + kegiatan + seragam;
        $('#ttotal').val(total_bayar);
    });

        if ($("#formInsert").length > 0) {
        $("#formInsert").validate({
            errorClass: "my-error-class",
            validClass: "my-valid-class",
            rules: {
                spp: {
                    required: false
                },
                gedung: {
                    required: false
                },
                seragam: {
                    required: false
                },
                kegiatan: {
                    required: false
                },
            },
            messages: {
            },
            submitHandler: function(form) {
                $('#btn_insert').html('Sending..');
                $.ajax({
                    url: "<?php echo base_url('modulkasir/bayarsiswa/insert') ?>",
                    type: "POST",
                    data: $('#formInsert').serialize(),
                    dataType: "json",
                    success: function(response) {
                        $('#btn_insert').html('<i class="ace-icon fa fa-save"></i>' +
                            'Simpan');
                        console.log(response);
                        if (response == true) {
                            document.getElementById("formInsert").reset();
                            swalInputSuccess();
                        } else if (response == 401) {
                            swalIdDouble('Eror 401!');
                        } else {
                            swalInputFailed();
                        }
                    }
                });
            }
        })
    }

    /* Fungsi formatRupiah */
        function formatRupiah(angka){
            if(angka != null){
                var number_string = angka.toString().replace(/[^,\d]/g, ''),
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

        function null_tonumber(angka){
            if(angka != null){
                return angka;
            }else{
                return 0;
            }
            
        }

</script>
<!-- End Select2