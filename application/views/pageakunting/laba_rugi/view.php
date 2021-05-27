<div class="row">
    <?php if ($this->session->flashdata('category_error')) { ?>
        <div class="alert alert-danger"> <?= $this->session->flashdata('category_error') ?> </div>
    <?php } ?>
    <form class="form-horizontal" target="_blank" method="POST" role="form" id="formSearch" action="<?php echo base_url() ?>modulakunting/laba_rugi/laporan">
        <div class="col-xs-3">
            <input type="number" id="tahun" required name="tahun" placeholder="Tahun" class="form-control" />
        </div>
        <td>
            <div class="col-xs-3">
                <select class="form-control" name="blnawal" id="blnawal">
                    <option value="0">--Bulan Awal--</option>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
            </div>
        <td>
            <div class="col-xs-3">
                <select class="form-control" name="blnakhir" id="blnakhir">
                    <option value="0">--Bulan Akhir--</option>
					<option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
            </div>
            <div class="col-xs-1">
                <button type="submit" id="btn_search" class="btn btn-sm btn-success pull-left">
                    <a class="ace-icon fa fa-search bigger-120"></a>Periksa
                </button>
            </div>
            <br>
            <br>
    </form>
</div>
