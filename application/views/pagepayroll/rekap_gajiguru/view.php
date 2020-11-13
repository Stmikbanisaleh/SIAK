<!-- <div class="row">
    <form class="form-horizontal" target="_blank" method="POST" role="form" id="formSearch" action="<?php echo base_url() ?>modulpayroll/rekap_gajiguru/laporan">
        <div class="col-xs-3">
            <input type="number" id="tahun" required name="tahun" placeholder="Tahun" class="form-control" />
        </div>
        <td>
        <div class="col-xs-3">
            <select class="form-control" name="blnawal" id="blnawal">
            	<option value="0">--Bulan Awal--</option>
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
        <div class="col-xs-3">
            <select class="form-control" name="blnakhir" id="blnakhir">
                <option value="0">--Bulan Akhir--</option>
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
        <div class="col-xs-1">
            <button type="submit" id="btn_search" class="btn btn-sm btn-success pull-left">
                <a class="ace-icon fa fa-search bigger-120"></a>Periksa
            </button>
        </div>
        <br>
        <br>
    </form>
</div> -->
<form class="form-horizontal" target="_blank" method="POST" role="form" id="formSearch" action="<?php echo base_url() ?>modulpayroll/rekap_gajiguru/laporan">
    <div class="col-xs-6">
        <div class="form-group">
            <label for="exampleInputEmail1">Tahun</label>
            <input type="number" id="tahun" required name="tahun" placeholder="Tahun" class="form-control" />
            <small id="emailHelp" class="form-text text-muted">Masukan tahun periode gaji.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Bulan Awal</label>
            <select class="form-control" name="blnawal" id="blnawal">
            	<option value="0">--Bulan Awal--</option>
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
            <small id="emailHelp" class="form-text text-muted">Periode awal bulan gaji.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Bulan Akhir</label>
            <select class="form-control" name="blnakhir" id="blnakhir">
                <option value="0">--Bulan Akhir--</option>
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
            <small id="emailHelp" class="form-text text-muted">Periode Akhir bulan gaji.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Unit</label>
            <select class="form-control" name="unit" id="unit">
            	<option value="0">--Pilih Semua--</option>
                <?php
                    foreach($my_sekolah as $row){
                ?>
                <option value="<?= $row['id'] ?>"><?= "[".$row['deskripsi']."]" ?></option>
                <?php
                    }
                ?>
            </select>
            <small  class="form-text text-muted">Pilih karyawan atau guru yang akan ditampilkan (Tidak wajib diisi).</small>
        </div>
        <button type="submit" id="btn_search" class="btn btn-sm btn-success pull-left">
            <a class="ace-icon fa fa-search bigger-120"></a>Periksa
        </button>
    </div>
</form>
