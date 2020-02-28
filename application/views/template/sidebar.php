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
			<i class="menu-icon fa fa-cogs"></i>
			<span class="menu-text">
				Setting
			</span>

			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>

		<ul class="submenu">

			<li class="">
				<a href="<?= base_url() . 'biodata'; ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Biodata sekolah
				</a>
			</li>

			<li class="">
				<a href="<?= base_url() . 'ruangan'; ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Ruangan
				</a>
			</li>

			<li class="">
				<a href="<?= base_url() . 'jabatan'; ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Jabatan
				</a>

				<b class="arrow"></b>
			</li>

			<li class="">
				<a href="<?= base_url() . 'tahun_akad1'; ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Tahun Akademik 1
				</a>

				<b class="arrow"></b>
			</li>

			<li class="">
				<a href="<?= base_url() . 'tahun_akad2'; ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Tahun Akademik 2
				</a>

				<b class="arrow"></b>
			</li>
			<li class="">
				<a href="<?= base_url() . 'tahun_akad3'; ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Tahun Akademik 3
				</a>

				<b class="arrow"></b>
			</li>
			<li class="">
				<a href="<?= base_url() . 'prog_sekolah'; ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Program Sekolah
				</a>

				<b class="arrow"></b>
			</li>
			<li class="">
				<a href="<?= base_url() . 'menu'; ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Menu
				</a>

				<b class="arrow"></b>
			</li>

		</ul>
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
				<a href="<?= base_url() . 'guru'; ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Master Biodata Guru
				</a>
			</li>

			<li class="">
				<a href="<?= base_url() . 'karyawan'; ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Master Karyawan
				</a>
			</li>

			<li class="">
				<a href="<?= base_url() . 'siswa'; ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Master Siswa
				</a>

				<b class="arrow"></b>
			</li>
		</ul>
	</li>
	<li class="">
		<a href="javascript:void(0);" class="dropdown-toggle">
			<i class="menu-icon glyphicon glyphicon-pencil"></i>
			<span class="menu-text">
				Nilai
			</span>

			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>

		<ul class="submenu">

			<li class="">
				<a href="<?= base_url() . 'permataajar'; ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Per Mataajar
				</a>
			</li>

			<li class="">
				<a href="<?= base_url() . 'penghapusannilai'; ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Penghapusan Nilai
				</a>
			</li>
		</ul>
	</li>

	<li class="">
		<a href="javascript:void(0);" class="dropdown-toggle">
			<i class="menu-icon fa fa-calendar"></i>
			<span class="menu-text">
				Jadwal
			</span>

			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>

		<ul class="submenu">

			<li class="">
				<a href="<?= base_url() . 'jadwal'; ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Jadwal
				</a>
			</li>

		</ul>
	</li>

	<li class="">
		<a href="javascript:void(0);" class="dropdown-toggle">
			<i class="menu-icon fa fa-book"></i>
			<span class="menu-text">
				Kurikulum
			</span>

			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>

		<ul class="submenu">

			<li class="">
				<a href="<?= base_url() . 'kurikulum'; ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Kurikulum
				</a>

				<b class="arrow"></b>
			</li>

			<li class="">
				<a href="<?= base_url() . 'mataajaraktif'; ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Mata Ajar Aktif
				</a>

				<b class="arrow"></b>
			</li>

		</ul>
	</li>

	<li class="">
		<a href="javascript:void(0);" class="dropdown-toggle">
			<i class="menu-icon fa fa-users "></i>
			<span class="menu-text">
				Lulusan
			</span>
			<b class="arrow fa fa-angle-down"></b>
		</a>
		<b class="arrow"></b>
		<ul class="submenu">
			<li class="">
				<a href="<?= base_url() . 'kelulusan'; ?>">
					<i class="menu-icon fa fa-caret-right"></i>
					Kelulusan Siswa
				</a>
				<b class="arrow"></b>
			</li>
		</ul>
	</li>
</ul><!-- /.nav-list -->

<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
	<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
</div>