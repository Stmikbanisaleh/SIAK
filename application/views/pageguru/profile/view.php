<div class="row">
    <div class="col-xs-6">
        <!-- PAGE CONTENT BEGINS -->
        <form class="form-horizontal" role="form" id="formTambah">
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Kode </label>
                <div class="col-sm-6">
                    <input type="hidden" id="e_id" required name="e_id" />
                    <input type="text" id="e_IdGuru" required name="e_IdGuru" placeholder="Kode Guru" class="form-control" readonly />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nama Lengkap</label>
                <div class="col-sm-9">
                    <input type="text" id="nama" required name="nama" placeholder="Nama Guru" class="form-control" readonly />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Email </label>
                <div class="col-sm-9">
                    <input type="email" id="e_email" required name="e_email" placeholder="xxxxxxx@gmail.com" class="form-control" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Foto </label>
                <div class="col-sm-9">
                    <input type="file" id="e_photos" required name="e_photos" placeholder="" class="form-control" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Username</label>
                <div class="col-sm-9">
                    <input type="text" id="e_username" required name="e_username" placeholder="Username" class="form-control" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Password </label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" required name="e_password" id="e_password1" placeholder="password"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Re-Password </label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" required name="e_password" id="e_password2" placeholder="konfirmasi password"></textarea>
                </div>
            </div>

    </div>
</div>
</div>
<button type="submit" id="btn_simpan" class="btn btn-sm btn-success pull-left">
    <i class="ace-icon fa fa-save"></i>
    Simpan
</button>
<button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
    <i class="ace-icon fa fa-times"></i>
    Batal
</button>
</form>
<script type="text/javascript">
    window.onload = function() {
        document.getElementById("e_password1").onchange = validatePassword;
        document.getElementById("e_password2").onchange = validatePassword;
    }

    function validatePassword() {
        var pass2 = document.getElementById("e_password2").value;
        var pass1 = document.getElementById("e_password1").value;
        if (pass1 != pass2)
            document.getElementById("e_password2").setCustomValidity("Passwords Tidak Sama, Coba Lagi");
        else
            document.getElementById("e_password2").setCustomValidity('');
    }
</script>