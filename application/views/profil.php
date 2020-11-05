<script type="text/javascript">
	$(document).ready(function() {
		$(':input:not([type="submit"])').each(function() {
			$(this).focus(function() {
				$(this).addClass('hilite');
			}).blur(function() {
				$(this).removeClass('hilite');
			});
		});
		$("#koperasi").focus();

		$("#koperasi").keyup(function(e) {
			var isi = $(e.target).val();
			$(e.target).val(isi.toUpperCase());
		});
		/*
	$("#fax").datepicker({
			dateFormat:"dd-mm-yy",
			changeYear : true,
			changeMonth:true,
    });
	*/
		$("#simpan").click(function() {
			var koperasi = $("#koperasi").val();
			var alamat = $("#alamat").val();
			var kota = $("#kota").val();
			var hp = $("#hp").val();
			var fax = $("#fax").val();
			var email = $("#email").val();

			var string = "koperasi=" + koperasi + "&alamat=" + alamat + "&kota=" + kota + "&hp=" + hp + "&fax=" + fax + "&email=" + email;

			//alert(koperasi);
			if (koperasi.length == 0) {
				alert('Maaf, Anda belum mengisi Nama Koperasi');
				$("#koperasi").focus();
				return false;
			}
			if (alamat.length == 0) {
				alert('Maaf, Anda belum mengisi Alamat');
				$("#alamat").focus();
				return false;
			}

			$.ajax({
				type: 'POST',
				url: "<?php echo site_url(); ?>/profil/simpan",
				data: string,
				cache: false,
				success: function(data) {
					alert('Info ' + data);
				}
			});
		});

	});
</script>

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
		<div class="row">
			<!-- left column -->
			<div class="col-md-12">
				<!-- general form elements -->
				<div class="card card-primary">
					<div class="card-header">
						<h3 class="card-title"><i class="fa fa-university" aria-hidden="true"></i> Profil Perusahaan</h3>
					</div>
					<!-- /.card-header -->
					<!-- form start -->
					<form role="form">
						<div class="card-body">
							<div class="form-group">
								<label>Koperasi</label><br>
								<?php echo form_input($koperasi); ?>
							</div>
							<div class="form-group">
								<label>Alamat</label><br>
								<?php echo form_input($alamat); ?>
							</div>
							<div class="form-group">
								<label>Kota</label><br>
								<?php echo form_input($kota); ?>
							</div>
							<div class="form-group">
								<label>HP</label><br>
								<?php echo form_input($hp); ?>
							</div>
							<div class="form-group">
								<label>Fax</label><br>
								<?php echo form_input($fax); ?>
							</div>
							<div class="form-group">
								<label>Email</label><br>
								<?php echo form_input($email); ?>
							</div>
						</div>
						<!-- /.card-body -->
						<div class="card-footer">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
				</div>
				<!-- /.card -->
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
</section>
<!-- /.content -->