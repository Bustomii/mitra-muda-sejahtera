<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Home</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
	<div class="container-fluid">

		<!-- Main row -->
		<div class="row">
			<!-- Left col -->
			<section class="col-lg-12 connectedSortable">
				<!-- Custom tabs (Charts with tabs)-->
				<div class="col-md-12">
					<div class="info-box">
						<span class="info-box-icon"><img src="<?php echo base_url(); ?>assets/images/logo.png" height="100" width="100" /></span>
						<div class="info-box-content">
							<h2><?php echo $judul; ?></h2>
							<h1><?php echo $nama_perusahaan; ?></h1>
							<h3><?php echo $alamat_perusahaan; ?></h3>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
				<hr><br>

				<!-- Small Box (Stat card) -->
				<h3>Hai, <?php echo $this->session->userdata('username'); ?>.
					Selamat Datang di <?php echo $judul; ?></h3>
				<div class="row">
					<div class="col-lg-3 col-6">
						<!-- small card -->
						<div class="small-box bg-info">
							<div class="inner">
								<h5><strong>Simpanan</strong></h5><br><br>
							</div>
							<div class="icon">
								<i class="fas fa-save"></i>
							</div>
							<a href="<?php echo base_url(); ?>index.php/simpanan" class="small-box-footer">
								More info <i class="fas fa-arrow-circle-right"></i>
							</a>
						</div>
					</div>
					<!-- ./col -->
					<div class="col-lg-3 col-6">
						<!-- small card -->
						<div class="small-box bg-success">
							<div class="inner">
								<h5><strong>Penarikan</strong></h5><br><br>
							</div>
							<div class="icon">
								<i class="fas fa-shopping-bag"></i>
							</div>
							<a href="<?php echo base_url(); ?>index.php/pengambilan" class="small-box-footer">
								More info <i class="fas fa-arrow-circle-right"></i>
							</a>
						</div>
					</div>
					<!-- ./col -->
					<div class="col-lg-3 col-6">
						<!-- small card -->
						<div class="small-box bg-warning">
							<div class="inner">
								<h5><strong>Pinjaman</strong></h5><br><br>
							</div>
							<div class="icon">
								<i class="far fa-envelope-open"></i>
							</div>
							<a href="<?php echo base_url(); ?>index.php/pinjaman" class="small-box-footer">
								More info <i class="fas fa-arrow-circle-right"></i>
							</a>
						</div>
					</div>
					<!-- ./col -->
					<div class="col-lg-3 col-6">
						<!-- small card -->
						<div class="small-box bg-danger">
							<div class="inner">
								<h5><strong>Pembayaran</strong></h5><br><br>
							</div>
							<div class="icon">
								<i class="far fa-envelope"></i>
							</div>
							<a href="<?php echo base_url(); ?>index.php/pembayaran" class="small-box-footer">
								More info <i class="fas fa-arrow-circle-right"></i>
							</a>
						</div>
					</div>
					<!-- ./col -->
				</div>
				<!-- /.row -->

			</section>
		</div>
		<!-- /.row (main row) -->

	</div>
</section>
<!-- /.content -->