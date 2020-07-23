<div class="row">
    <div class="col-xs-1">
        <button id="item-tambah" role="button" data-toggle="modal" class="btn btn-xs btn-warning">
            <a class="ace-icon fa fa-plus bigger-120"></a>Generate
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
                <h3 class="smaller lighter blue no-margin">Form Generate <?= $page_name; ?></h3>
            </div>
            <form class="form-horizontal" role="form" id="formTambah">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- PAGE CONTENT BEGINS -->
                            <div class="form-group">
                                <div class="col-xs-12">
                                    Tahun Masuk
                                    <select required class="form-control" name="thnmasuk" id="thnmasuk">
                                        <option>--Pilih Tahun Masuk--</option>
                                        <?php foreach ($my_tahun2 as $value) { ?>
                                            <option value=<?= $value['TAHUN'] ?>><?= $value['TAHUN'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-12">
                                    Tahun Akademik
                                    <select required class="form-control" name="thnakad" id="thnakad">
                                        <option>--Pilih Tahun Akademik--</option>
                                        <?php foreach ($my_tahun as $value) { ?>
                                            <option value=<?= $value['THNAKAD'] ?>><?= $value['THNAKAD'] ?></option>
                                        <?php } ?>
                                    </select>
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
<div class="row">
    <div class="col-xs-12">
        <div class="table-header">
            Semua Data
        </div>
    </div>
</div>
<br>
<div class="table-responsive">
    <table id="datatable_tabletools" class="display">
        <thead>
            <tr>
                <th>No</th>
                <th>No Induk</th>
                <th>Nama</th>
                <th>Total Tagihan</th>
                <th>Bayar</th>
                <th>Sisa</th>
                <th>Tahun Akademik</th>
            </tr>
        </thead>
        <tbody id="show_data">
        </tbody>
    </table>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        show_data();
        $('#datatable_tabletools').DataTable();
    });

    $('#item-tambah').on('click', function() {
        $('#modalTambah').modal('show');
    });

    // function generate() {
    //     $('#btn_generate').html('Generating...');
    //     document.getElementById("btn_generate").setAttribute("disabled", true);
    //     $.ajax({
    //         url: "<?php echo base_url('modulkasir/tunggakan/generate') ?>",
    //         type: "POST",
    //         dataType: "json",
    //         success: function(response) {
    //             // console.log(response);
    //             $('#btn_generate').html('<i class="ace-icon fa fa-plus"></i>' +
    //                 'Generate');
    //             if (response == true) {
    //                 swalGenerateSuccess();
    //                 document.getElementById("btn_generate").removeAttribute("disabled");
    //                 show_data();
    //             } else if (response == 401) {
    //                 swalIdDouble('Nama Ruangan Sudah digunakan!');
    //                 document.getElementById("btn_generate").removeAttribute("disabled");
    //             } else {
    //                 swalGenerateFailed();
    //                 document.getElementById("btn_generate").removeAttribute("disabled");
    //             }
    //         }
    //     });
    // };

    if ($("#formTambah").length > 0) {
		$("#formTambah").validate({
			errorClass: "my-error-class",
			validClass: "my-valid-class",
			submitHandler: function(form) {
				$('#btn_simpan').html('Sending..');
				$.ajax({
                    url: "<?php echo base_url('modulkasir/tunggakan/generate') ?>",
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
						} else {
							swalInputFailed();
						}
						// setTimeout(function(){
						// // $('#res_message').hide();
						// // $('#msg_div').hide();
						// },3000);
					}
				});
			}
		})
	}

    //function show all Data
    function show_data() {
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('modulkasir/tunggakan/tampil') ?>',
            async: true,
            dataType: 'json',
            success: function(data) {
                var html = '';
                var i = 0;
                var no = 1;
                for (i = 0; i < data.length; i++) {
                    html += '<tr>' +
                        '<td class="text-left">' + no + '</td>' +
                        '<td class="text-left">' + data[i].NIS + '</td>' +
                        '<td class="text-left">' + data[i].Namacasis + '</td>' +
                        '<td class="text-right">' + data[i].totaltagihan2 + '</td>' +
                        '<td class="text-right">' + data[i].bayar2 + '</td>' +
                        '<td class="text-right">' + data[i].sisa2 + '</td>' +
                        '<td class="text-left">' + data[i].TA + '</td>' +
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