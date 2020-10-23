<!-- <div class="row">
	<div class="space-6"></div>

	<div class="col-sm-12 infobox-container">
		<div class="infobox infobox-green">
			<div class="infobox-icon ">
				<i class="ace-icon fa fa-users"></i>
			</div>

			<div class="infobox-data">
				<span class="infobox-data-number">Siswa</span>
				<div class="infobox-content">Jumlah Siswa</div>
			</div>

			<div class="stat stat-success"><?=$siswa[0]->pengguna?></div>
		</div>

		<div class="infobox infobox-blue">
			<div class="infobox-icon">
				<i class="ace-icon fa fa-eye"></i>
			</div>

			<div class="infobox-data">
				<span class="infobox-data-number">Visit</span>
				<div class="infobox-content">Jumlah Pengunjung</div>
			</div>

			
			<div class="stat stat-success"><?=$visit[0]->visit?></div>
		</div>

		<div class="infobox infobox-pink">
			<div class="infobox-icon">
				<i class="ace-icon fa fa-book"></i>
			</div>

			<div class="infobox-data">
				<span class="infobox-data-number">Klik</span>
				<div class="infobox-content">Jumlah Klik</div>
			</div>
			<div class="stat stat-success"><?=$click[0]->klik?></div>
		</div>

		<div class="infobox infobox-red">
			<div class="infobox-icon">
				<i class="ace-icon fa fa-credit-card"></i>
			</div>

			<div class="infobox-data">
				<span class="infobox-data-number">Guru</span>
				<div class="infobox-content">Jumlah Guru</div>
			</div>

			<div class="stat stat-success"><?=$guru[0]->guru?></div>
		</div>
	</div>

	
	</div>
</div> -->

<!-- <div class="hr hr32 hr-dotted"></div> -->
<!-- <div class="container">     -->
	<!-- <div class="row">
		<div class="panel panel-default col-md-7">
		<div class="panel-heading">  <h4 >User Profile</h4></div>
		<div class="panel-body">
			<div class="col-md-2 col-xs-12 col-sm-6 col-lg-3">
				<img class="col-md-11" alt="User Pic" src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg" id="profile-image1" class="img-circle img-responsive"> 

			</div>
			<div class="col-md-8 col-xs-12 col-sm-6 col-lg-8" >
				<div class="container" >
					<h2>Ima Rahmayanti</h2>
					<p><b>SD-REGULER</b></p>
				
				</div>
					<hr>
						<ul class="container details" >
							<li><p><span class="glyphicon" style="width:130px;">NIS</span>: 2021334572</p></li>
							<li><p><span class="glyphicon" style="width:130px;">Jenis Kelamin</span>: Perempuan</p></li>
							<li><p><span class="glyphicon" style="width:130px;">Tempat, Tgl Lahir</span>: Cianjur, 21 Januari 2020</p></li>
							<li><p><span class="glyphicon" style="width:130px;">Phone</span>: 0857123333</p></li>
							<li><p><span class="glyphicon" style="width:130px;">Email</span>: somerandom@email.com</p></li>
						</ul>
					<hr>
				<div class="col-sm-5 col-xs-6 tital " >Date Of Joining: 15 Jun 2016</div>
			</div>
		</div>
	</div> -->
<!-- </div> -->
<!-- /.row -->
<div class="row">
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-line-chart fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">
						<?php
							if(!empty($kelas)){
								echo $Kelas->kelas;
							}else{
								echo "Belum mendapat kelas";
							}
						?>
						</div>
						<div>Kelas</div>
					</div>
				</div>
			</div>
			<a>
				<div class="panel-footer">
					<span class="pull-left">Tingkat kelas siswa</span>
					<!-- <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span> -->

					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-warning">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-plus fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">
							<?php
								echo $jml_siswa->jml_siswa;
							?>
						</div>
						<div>Jumlah siswa</div>
					</div>
				</div>
			</div>
			<a>
				<div class="panel-footer">
					<span class="pull-left">Jumlah siswa pada kelas yang diikuti</span>
					<!-- <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span> -->

					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="fa fa-dollar fa-5x"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">Rp. <?php echo $tarif_spp ?></div>
						<div>SPP Siswa</div>
					</div>
				</div>
			</div>
			<a>
				<div class="panel-footer">
					<span class="pull-left">Biaya SPP siswa pada kelas tersebut</span>
					<!-- <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span> -->

					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>
</div>
<!-- /.row -->
<body class="no-skin">
	<div class="main-content">
		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<div class="hr dotted"></div>
					<div>
						<div id="user-profile-1" class="user-profile row">
							<div class="col-xs-12 col-sm-3 center">
								<div>
									<span class="profile-picture">
										<?php $result = $this->db->query("select * from mssiswa where NOINDUK ='" . $this->session->userdata('nis') . "'")->result_array();
										 ?>
										<img id="avatar" class="editable img-responsive" alt="Siswa Avatar" src="
										<?php if (!empty($result[0]['IMG'])) {
											echo base_url(); ?>assets/gambar/<?php echo $result[0]['IMG'];
																			} else {
																				echo base_url() . 'assets/gambar/no-image.png';
																			} ?>" />
									</span>
									<div class="space-4"></div>
									<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
										<div class="inline position-relative">
											<a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
												<span class="white"><?php echo $this->session->userdata('username_siswa'); ?></span>
											</a>
										</div>
									</div>
								</div>

								<div class="space-6"></div>

								<div class="hr hr12 dotted"></div>



								<div class="hr hr16 dotted"></div>
							</div>

							<div class="col-xs-12 col-sm-9">
								<!-- <div class="center">
									<span class="btn btn-app btn-sm btn-light no-hover">
										<span class="line-height-1 bigger-170 blue"> 1,411 </span>

										<br />
										<span class="line-height-1 smaller-90"> Views </span>
									</span>

									<span class="btn btn-app btn-sm btn-yellow no-hover">
										<span class="line-height-1 bigger-170"> 32 </span>

										<br />
										<span class="line-height-1 smaller-90"> Followers </span>
									</span>

									<span class="btn btn-app btn-sm btn-pink no-hover">
										<span class="line-height-1 bigger-170"> 4 </span>

										<br />
										<span class="line-height-1 smaller-90"> Projects </span>
									</span>

									<span class="btn btn-app btn-sm btn-grey no-hover">
										<span class="line-height-1 bigger-170"> 23 </span>

										<br />
										<span class="line-height-1 smaller-90"> Reviews </span>
									</span>

									<span class="btn btn-app btn-sm btn-success no-hover">
										<span class="line-height-1 bigger-170"> 7 </span>

										<br />
										<span class="line-height-1 smaller-90"> Albums </span>
									</span>

									<span class="btn btn-app btn-sm btn-primary no-hover">
										<span class="line-height-1 bigger-170"> 55 </span>

										<br />
										<span class="line-height-1 smaller-90"> Contacts </span>
									</span>
								</div> -->

								<div class="space-12"></div>

								<div class="profile-user-info profile-user-info-striped">
									<div class="profile-info-row">
										<div class="profile-info-name"> Nama Lengkap </div>

										<div class="profile-info-value">
											<span class="editable" id="username"><?php echo $result[0]['NMSISWA']; ?> </span>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> NIS / NO INDUK </div>

										<div class="profile-info-value">
											<span class="editable" id="age"><?php echo $result[0]['NOINDUK']; ?> </span>
										</div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name"> Tanggal Lahir </div>

										<div class="profile-info-value">
											<span class="editable" id="age"><?php echo $result[0]['TGLHR']; ?> </span>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Joined </div>

										<div class="profile-info-value">
											<span class="editable" id="signup"><?php echo $result[0]['createdAt']; ?></span>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> No HP </div>

										<div class="profile-info-value">
											<span class="editable" id="login"><?php echo $result[0]['NOHP']; ?></span>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Alamat </div>

										<div class="profile-info-value">
											<span class="editable" id="login"><?php echo $result[0]['ALAMATRUMAH']; ?></span>
										</div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name"> Nama Bapak </div>

										<div class="profile-info-value">
											<span class="editable" id="login"><?php echo $result[0]['NMBAPAK']; ?></span>
										</div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name"> Nama Ibu </div>

										<div class="profile-info-value">
											<span class="editable" id="login"><?php echo $result[0]['NMIBU']; ?></span>
										</div>
									</div>
									<br>
								</div>

							</div>

						</div>
						<!-- <div class="modal-footer">
							<a href="<?php echo base_url() . 'modulsiswa/profile/edit'; ?>" class="btn btn-xs btn-success" title="Edit" data-id=15>Edit Profile</a>
						</div> -->
					</div>

					<!-- PAGE CONTENT ENDS -->
				</div><!-- /.col -->
			</div><!-- /.row -->
			<div class="row">
				
				<!-- <div class="card border-info mb-3">
				<div class="card-body text-success">
					<h5 class="card-title">SEKOLAH ISLAM TERPADU GEMA NURANI</h5> 
					<p class="card-text">Selamat datang pada halaman dashboard siswa. </p>
				</div>
				</div> -->
			</div>
		</div><!-- /.page-content -->
	</div>
	</div><!-- /.main-content -->
	</div><!-- /.main-container -->