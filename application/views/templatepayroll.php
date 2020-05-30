<!DOCTYPE html>
<html lang="en">

<head>
	<?php
	$this->load->view('templatepayroll/head');
	?>
	<?php
	$this->load->view('templatepayroll/js-main');
	?>
</head>

<body class="no-skin">
	<div id="navbar" class="navbar navbar-default          ace-save-state navbar-fixed-top">
		<div class="navbar-container ace-save-state" id="navbar-container">
			<?php
			$this->load->view('templatepayroll/navbar');
			?>
		</div><!-- /.navbar-container -->
	</div>

	<div class="main-container ace-save-state" id="main-container">
		<script type="text/javascript">
			try {
				ace.settings.loadState('main-container')
			} catch (e) {}
		</script>

		<div id="sidebar" class="sidebar                  responsive                    ace-save-state">
			<?php
			$this->load->view('templatepayroll/sidebar');
			?>
		</div>

		<div class="main-content">
			<div class="main-content-inner">
				<div class="breadcrumbs ace-save-state" id="breadcrumbs">
					<ul class="breadcrumb">
						<li>
							<i class="ace-icon fa fa-home home-icon"></i>
							<a href="<?= base_url(); ?>">Home</a>
						</li>
						<?= $ribbon; ?>
					</ul><!-- /.breadcrumb -->
				</div>

				<div class="page-content">
					<div class="ace-settings-container" id="ace-settings-container">
					</div><!-- /.ace-settings-container -->
					<div class="page-header">
						<h1>
							<?= $page_name; ?>
						</h1>
					</div><!-- /.page-header -->

					<div class="row">
						<div class="col-xs-12">
							<?php
							$this->load->view('pagepayroll/' . $page_content);
							?>
							<!-- PAGE CONTENT ENDS -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.page-content -->
			</div>
		</div><!-- /.main-content -->

		<div class="footer">
			<?php
			$this->load->view('templatepayroll/footer');
			?>
		</div>

		<a href="javascript:void(0);" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
			<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
		</a>
	</div><!-- /.main-container -->


</body>

</html>