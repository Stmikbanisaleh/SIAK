<div class="row">
	<form class="form-horizontal" role="form" id="formSearch">
		<div class="form-group">
			<div class="col-xs-3">
				Jenis Transaksi
				<select class="form-control tahun" name="tahun" id="tahun">
					<option value="0">--Pilih Jenis Transaksi--</option>
					<?php foreach ($mytrx as $value) { ?>
						<option value=<?= $value['kode_jurnal'] ?>><?= $value['NamaTransaksi']."-".$value['kode_jurnal']?></option>
					<?php } ?>
				</select>
			</div>
			<div class="col-xs-2">
				Debet / Kredit
				<select class="form-control tahun" name="dk" id="dk">
					<option value="0">--Pilih D/K--</option>
					<?php foreach ($dk as $value) { ?>
						<option value=<?= $value['KETERANGAN'] ?>><?= $value['NAMA_REV']?></option>
					<?php } ?>
				</select>
			</div>
			<div class="col-xs-4">
				Keterangan
				<input type="number" id="tahun" required name="tahun" placeholder="Keterangan" class="form-control" />
			</div>
		</div>
		<div class="form-group">
			<div class="col-xs-3">
				Nilai
				<input type="number" id="tahun" required name="tahun" placeholder="Nilai" class="form-control" />
			</div>
			<div class="col-xs-3">
				Tanggal Bukti
				<input type="date" id="tahun" required name="tahun" placeholder="Tgl Bukti" class="form-control" />
			</div>
			<div class="col-xs-3">
				Nomor Bukti
				<input type="number" id="tahun" required name="tahun" placeholder="Nomor Bukti" class="form-control" />
			</div>
			<div class="col-xs-1">
				 <br>
				<button type="submit" id="btn_search" class="btn btn-sm btn-success pull-left">
					Simpan
				</button>
			</div>
		</div>
		
		<br>
		<br>
	</form>
</div>
<div id="my-modal2" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="smaller lighter blue no-margin">Form Import Data Jenis Pengeluaran</h3>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						<!-- PAGE CONTENT BEGINS -->
						<form class="form-horizontal" role="form" enctype="multipart/form-data" id="formImport">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Import Excel FIle </label>
								<div class="col-sm-6">
									<input type="file" id="file" required name="file" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Sample </label>
								<div class="col-sm-9">
									<a label class="col-sm-3" for="form-field-1"> Download Sample Format </label></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" id="btn_import" class="btn btn-sm btn-success pull-left">
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

<div id="my-modal" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="smaller lighter blue no-margin">Form Input Data Jenis Pengeluaran</h3>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-xs-12">
						<!-- PAGE CONTENT BEGINS -->
						<form class="form-horizontal" role="form" id="formTambah">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Jenis Transaksi </label>
								<div class="col-sm-6">
									<input type="text" id="JnsTransaksi" required name="JnsTransaksi" placeholder="Jenis Transaksi" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Rekening </label>
								<div class="col-sm-9">
									<select class="form-control" name="no_jurnal" id="pendidikan_terakhir">
										<option value="">-- Pilih --</option>
										<?php foreach ($myjurnal as $value) { ?>
											<option value=<?= $value['no_jurnal'] ?>><?= $value['kode_jurnal'] . " - " . $value['nama_jurnal'] ?></option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nama Transaksi </label>
								<div class="col-sm-9">
									<input type="text" class="form-control" name="NamaTransaksi" id="NamaTransaksi" placeholder="Nama Transaksi" />
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
			Semua Data Transaksi Pengeluaran
		</div>
	</div>
</div>
<table id="datatable_tabletools" class="display">
	<thead>
		<tr>
			<th>No</th>
			<th>Kode Rekening</th>
			<th>Tanggal Bukti</th>
			<th>No Bukti</th>
			<th>Keterangan</th>
			<th>Nilai</th>
			<th>DK</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody id="show_data">
		<?php
		$no=1;
			foreach ($mytransaksi as $r){
				?>
			</tr>
				<td><?=$no?></td>
						<td><?=$r['no_rek']?></td>
						<td><?=$r['Tgl_bukti']?></td>
						<td><?=$r['No_bukti']?></td>
						<td><?=$r['Ket']?></td>
						<td><?=$r['Nilai']?></td>
						<td><?=$r['DK']?></td>
						<td><button class="btn btn-xs btn-danger item_hapus" title="Delete" data-id="<=$r['id']">
                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                        </button></td>
					</tr>
				<?php
				$no++;
			}
		?>
		

	</tbody>
</table>
<script type="text/javascript">
	$(document).ready(function() {
		// show_data();
		$('#datatable_tabletools').DataTable();
	});
</script>