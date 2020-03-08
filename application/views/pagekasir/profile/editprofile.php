<div class="row">
    <div class="col-xs-12">
        <form class="form-horizontal" role="form" id="formTambah">
            <div id="edit-password" class="tab-pane">

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-pass1">NIP</label>
                    <div class="col-sm-4">
                        <input type="hidden" name="e_id" value="<?php echo $mydata[0]['Useriid']; ?>" id="e_id" class="form-control" />
                        <input disabled type="text" name="nip" value="<?php echo $mydata[0]['Useriid']; ?>" id="nip" class="form-control" />
                    </div>
                </div>

                <!-- <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-pass1">Nama</label>
                    <div class="col-sm-4">
                        <input minlength="4" type="text" value="<?php echo $mydata[0]['nama']; ?>" name="nama" id="nama" class="form-control" />
                    </div>
                </div> -->
                <div class="space-4"></div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-pass2">Foto Profile</label>

                    <div class="col-sm-9">
                        <input required type="file" name="file" id="file" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btn_simpan" class="btn btn-info" type="submit">
                    <i class="ace-icon fa fa-save bigger-110"></i>
                    Ubah
                </button> &nbsp;&nbsp;&nbsp;
                <a href="<?php echo base_url() . 'modulkasir/profile/index'; ?>" class="ace-icon fa fa-back bigger-110">
                    Kembali</a>
            </div>
        </form>
    </div>

</div>
<script type="text/javascript">
    if ($("#formTambah").length > 0) {
        $("#formTambah").validate({
            errorClass: "my-error-class",
            validClass: "my-valid-class",
            rules: {
            },
            messages: {
            },
            submitHandler: function(form) {
                $('#btn_simpan').html('Sending..');
                formdata = new FormData(form);
                $.ajax({
                    url: "<?php echo base_url('modulkasir/profile/update') ?>",
                    type: "POST",
                    data: formdata,
                    processData: false,
                    contentType: false,
                    cache: false,
                    async: false,
                    success: function(response) {
                        $('#btn_simpan').html('<i class="ace-icon fa fa-save"></i>' +
                            'Simpan');
                        if (response == true) {
                            document.getElementById("formTambah").reset();
                            swalEditSuccess();
                            $('#modalTambah').modal('hide');
                        } else if (response == 0) {
                            swalEditFailed();
                        } else {
                            swalEditFailed();
                        }
                    }
                });
            }
        })
    }
</script>