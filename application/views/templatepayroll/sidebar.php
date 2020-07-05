<script type="text/javascript">
	try {
		ace.settings.loadState('sidebar')
	} catch (e) {}
</script>

<div class="sidebar-shortcuts" id="sidebar-shortcuts">
</div><!-- /.sidebar-shortcuts -->

<ul class="nav nav-list">
	<li class="">
		<a href="<?= base_url().'modulpayroll/dashboard'; ?>">
			<i class="menu-icon fa fa-tachometer"></i>
			<span class="menu-text"> Dashboard </span>
		</a>
		<b class="arrow"></b>
	</li>
	<li class="">
		<a href="javascript:void(0);" class="dropdown-toggle">
			<i class="menu-icon glyphicon glyphicon-user"></i>
			<span class="menu-text">
				Data Master
			</span>
			<b class="arrow fa fa-angle-down"></b>
		</a>
		<b class="arrow"></b>
		<ul class="submenu">
			<li class="">
				<a href="<?= base_url() . 'modulpayroll/biodataguru'; ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Master Biodata Guru
				</a>
			</li>
			<li class="">
				<a href="<?= base_url() . 'modulpayroll/tarif_guru'; ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Master Tarif Guru
				</a>
			</li>
			<li class="">
				<a href="<?= base_url() . 'modulpayroll/biodata_karyawan'; ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Master Biodata Karyawan
				</a>
				<b class="arrow"></b>
			</li>
			<li class="">
				<a href="<?= base_url() . 'modulpayroll/jenis_pembayaran'; ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Master Jenis Pembayaran
				</a>
				<b class="arrow"></b>
			</li>
			<li class="">
				<a href="<?= base_url() . 'modulpayroll/syncron'; ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Syncron
				</a>
				<b class="arrow"></b>
			</li>
		</ul>
	</li>
	<li class="">
		<a href="javascript:void(0);" class="dropdown-toggle">
			<i class="menu-icon fa fa-cogs"></i>
			<span class="menu-text">
				Setting
			</span>
			<b class="arrow fa fa-angle-down"></b>
		</a>
		<b class="arrow"></b>
		<ul class="submenu">
			<li class="">
				<a href="<?= base_url() . 'modulpayroll/master_potongan'; ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Master Potongan Karyawan
				</a>
			</li>
			<li class="">
				<a href="<?= base_url() . 'modulpayroll/master_potongan_guru'; ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Master Potongan Guru
				</a>
			</li>
			<li class="">
				<a href="<?= base_url() . 'modulpayroll/cuti'; ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Tugas Dinas / Cuti
				</a>
				<b class="arrow"></b>
			</li>
		</ul>
	</li>
	<li class="">
		<a href="javascript:void(0);" class="dropdown-toggle">
			<i class="menu-icon fa fa-book"></i>
			<span class="menu-text">
				Laporan
			</span>
			<b class="arrow fa fa-angle-down"></b>
		</a>
		<b class="arrow"></b>
		<ul class="submenu">
			<li class="">
				<a href="<?= base_url() . 'modulpayroll/honor_gurutetap'; ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Honorarium Guru Tetap
				</a>
			</li>
			<li class="">
				<a href="<?= base_url() . 'modulpayroll/kehadiran_karyawan'; ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Laporan Kehadiran Karyawan
				</a>
				<b class="arrow"></b>
			</li>
			<li class="">
				<a href="<?= base_url() . 'modulpayroll/slip_gaji'; ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Slip Gaji
				</a>
				<b class="arrow"></b>
			</li>
			<li class="">
				<a href="<?= base_url() . 'modulpayroll/potong_gaji'; ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Laporan Potongan Gaji
				</a>
				<b class="arrow"></b>
			</li>
			<li class="">
				<a href="<?= base_url() . 'modulpayroll/rekap_gajiguru'; ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Rekap Gaji Guru
				</a>
				<b class="arrow"></b>
			</li>
			<li class="">
				<a href="<?= base_url() . 'modulpayroll/rekap_gajikaryawan'; ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Rekap Gaji Karyawan
				</a>
				<b class="arrow"></b>
			</li>
		</ul>
	</li>
</ul><!-- /.nav-list -->

<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
	<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
</div>