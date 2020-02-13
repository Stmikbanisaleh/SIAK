<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
	<span class="sr-only">Toggle sidebar</span>

	<span class="icon-bar"></span>

	<span class="icon-bar"></span>

	<span class="icon-bar"></span>
</button>

<div class="navbar-header pull-left">
	<a href="<?php echo base_url()?>" class="navbar-brand">
		<small>
			<i class="fa fa-leaf"></i>
			Operator
		</small>
	</a>
</div>

<div class="navbar-buttons navbar-header pull-right" role="navigation">
	<ul class="nav ace-nav">
		<li class="light-blue dropdown-modal">
			<a data-toggle="dropdown" href="javascript:void(0);" class="dropdown-toggle">
				<img class="nav-user-photo" src="<?= base_url() ?>assets/image/avatars/avatar2.png" alt="Jason's Photo" />
				<span class="user-info">
					<small>Welcome,</small>
					Jason
				</span>

				<i class="ace-icon fa fa-caret-down"></i>
			</a>

			<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
				<li>
					<a href="javascript:void(0);">
						<i class="ace-icon fa fa-cog"></i>
						Settings
					</a>
				</li>

				<li>
					<a href="profile.html">
						<i class="ace-icon fa fa-user"></i>
						Profile
					</a>
				</li>

				<li class="divider"></li>

				<li>
					<a href="javascript:void(0);">
						<i class="ace-icon fa fa-power-off"></i>
						Logout
					</a>
				</li>
			</ul>
		</li>
	</ul>
</div>