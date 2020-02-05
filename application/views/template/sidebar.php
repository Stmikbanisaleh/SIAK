<script type="text/javascript">
	try {
		ace.settings.loadState('sidebar')
	} catch (e) {}
</script>

<div class="sidebar-shortcuts" id="sidebar-shortcuts">
	<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
		<button class="btn btn-success">
			<i class="ace-icon fa fa-signal"></i>
		</button>

		<button class="btn btn-info">
			<i class="ace-icon fa fa-pencil"></i>
		</button>

		<button class="btn btn-warning">
			<i class="ace-icon fa fa-users"></i>
		</button>

		<button class="btn btn-danger">
			<i class="ace-icon fa fa-cogs"></i>
		</button>
	</div>

	<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
		<span class="btn btn-success"></span>

		<span class="btn btn-info"></span>

		<span class="btn btn-warning"></span>

		<span class="btn btn-danger"></span>
	</div>
</div><!-- /.sidebar-shortcuts -->

<ul class="nav nav-list">
	<li class="">
		<a href="<?= base_url(); ?>">
			<i class="menu-icon fa fa-tachometer"></i>
			<span class="menu-text"> Dashboard </span>
		</a>

		<b class="arrow"></b>
	</li>

	<li class="">
		<a href="javascript:void(0);" class="dropdown-toggle">
			<i class="menu-icon glyphicon glyphicon-download"></i>
			<span class="menu-text">
				Master User
			</span>

			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>

		<ul class="submenu">

			<li class="">
				<a href="<?= base_url() . 'jenjang'; ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Jenjang Pendidikan
				</a>
			</li>

			<li class="">
				<a href="<?= base_url() . 'guru'; ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Guru
				</a>
			</li>

			<li class="">
				<a href="<?= base_url() . 'karyawan'; ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Karyawan
				</a>

				<b class="arrow"></b>
			</li>

			<li class="">
				<a href="<?= base_url() . 'jabatan'; ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Jabatan
				</a>

				<b class="arrow"></b>
			</li>

			<li class="">
				<a href="typography.html">
					<i class="menu-icon fa fa-caret-right"></i>
					Role
				</a>

				<b class="arrow"></b>
			</li>

		</ul>
	</li>

	<li class="">
		<a href="javascript:void(0);" class="dropdown-toggle">
			<i class="menu-icon fa fa-money"></i>
			<span class="menu-text">
				Master Tarif
			</span>

			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>

		<ul class="submenu">

			<li class="">
				<a href="<?= base_url() . 'tarif'; ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Tarif
				</a>
			</li>

			<li class="">
				<a href="<?= base_url() . 'karyawan'; ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Karyawan
				</a>

				<b class="arrow"></b>
			</li>

			<li class="">
				<a href="<?= base_url() . 'jabatan'; ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Jabatan
				</a>

				<b class="arrow"></b>
			</li>

			<li class="">
				<a href="typography.html">
					<i class="menu-icon fa fa-caret-right"></i>
					Role
				</a>

				<b class="arrow"></b>
			</li>

		</ul>
	</li>

	<li class="">
		<a href="javascript:void(0);" class="dropdown-toggle">
			<i class="menu-icon glyphicon glyphicon-upload"></i>
			<span class="menu-text">
				Master TU
			</span>

			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>

		<ul class="submenu">

			<li class="">
				<a href="typography.html">
					<i class="menu-icon fa fa-caret-right"></i>
					Employee
				</a>

				<b class="arrow"></b>
			</li>

			<li class="">
				<a href="typography.html">
					<i class="menu-icon fa fa-caret-right"></i>
					Teacher's
				</a>

				<b class="arrow"></b>
			</li>

		</ul>
	</li>

	<li class="">
		<a href="javascript:void(0);" class="dropdown-toggle">
			<i class="menu-icon glyphicon glyphicon-upload"></i>
			<span class="menu-text">
				Master Akuntansi
			</span>

			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>

		<ul class="submenu">

			<li class="">
				<a href="typography.html">
					<i class="menu-icon fa fa-caret-right"></i>
					Employee
				</a>

				<b class="arrow"></b>
			</li>

			<li class="">
				<a href="typography.html">
					<i class="menu-icon fa fa-caret-right"></i>
					Teacher's
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
		</a>
	</li>

	<li class="">
		<a href="javascript:void(0);" class="dropdown-toggle">
			<i class="menu-icon fa fa-info-circle"></i>
			<span class="menu-text">
				Transaksi
			</span>
		</a>
	</li>

	<li class="">
		<a href="javascript:void(0);" class="dropdown-toggle">
			<i class="menu-icon fa fa-info-circle"></i>
			<span class="menu-text">
				Transaksi Keuangan
			</span>
		</a>
	</li>

	<li class="">
		<a href="javascript:void(0);" class="dropdown-toggle">
			<i class="menu-icon fa fa-info-circle"></i>
			<span class="menu-text">
				Laporan Keuangan
			</span>
		</a>
	</li>


</ul><!-- /.nav-list -->

<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
	<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
</div>