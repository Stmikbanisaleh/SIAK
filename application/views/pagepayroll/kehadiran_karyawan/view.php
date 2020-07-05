<div class="row">
    <form class="form-horizontal" target="_blank" method="POST" role="form" id="formSearch" action="<?php echo base_url() ?>modulpayroll/kehadiran_karyawan/laporan">
        <div class="col-xs-1">
            <input type="number" id="tahun" required name="tahun" placeholder="Tahun" class="form-control" />
        </div>
        <td>
            <div class="col-xs-2">
                <select class="form-control" required name="blnawal" id="blnawal">
                    <option value="">--Bulan Awal--</option>
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
            </div>
        <td>
            <div class="col-xs-2">
                <select class="form-control" required name="blnakhir" id="blnakhir">
                    <option value="">--Bulan Akhir--</option>
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
            </div>
        </td>

        <td>
            <div class="col-xs-3">
                <select class="form-control" name="karyawan" id="karyawan">
                    <option value="none">-- Pilih Berdasarkan Periode --</option>
                    <?php
                    foreach ($my_karyawan as $row) {
                    ?>
                        <option value="<?= $row['nip'] ?>"><?= $row['nama']  ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col-xs-3">
                <select class="form-control" name="type" id="type">
                    <option value="">--Pilih Format--</option>
                    <option value="pdf">PDF</option>
                    <option value="xls">Excel</option>
                </select>
            </div>
            <div class="col-xs-1">
                <button type="submit" id="btn_search" class="btn btn-sm btn-success pull-left">
                    <a class="ace-icon fa fa-search bigger-120"></a>Periksa
                </button>
            </div>
        </td>
        <br>
        <br>
    </form>
</div>