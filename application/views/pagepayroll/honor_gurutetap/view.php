<form target="_blank" method="POST" role="form" id="formSearch" action="<?php echo base_url() ?>modulpayroll/honor_gurutetap/laporan_pdf">
    <div class="col-xs-6">
        <div class="form-group">
            <label for="exampleInputEmail1">Tahun</label>
            <input type="number" id="tahun" required name="tahun" placeholder="Tahun" class="form-control" />
            <small id="emailHelp" class="form-text text-muted">Periode tahun honor guru.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Bulan</label>
            <select class="form-control" required name="bln" id="bln">
                <option value="0">--Pilih Periode Bulan--</option>
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>
            <small id="emailHelp" class="form-text text-muted">Periode bulan honor guru.</small>
        </div>
        <button type="submit" id="btn_search" class="btn btn-sm btn-success pull-left">
            <a class="ace-icon fa fa-search bigger-120"></a>Periksa
        </button>
    </div>
</form>