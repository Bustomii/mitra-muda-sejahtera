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
<style type="text/css">
</style>
<div class="atas">
	<p><img src="<?php echo base_url(); ?>/asset/css/themes/icons/profil.png" align="absmiddle" />
		PROFIL PERUSAHAAN
	</p>
</div>
<div class="tengah">
	<p><label>Koperasi</label>:<?php echo form_input($koperasi); ?></p>
	<p><label>Alamat</label>:<?php echo form_input($alamat); ?></p>
	<p><label>Kota</label>:<?php echo form_input($kota); ?></p>
	<p><label>Hp</label>:<?php echo form_input($hp); ?></p>
	<p><label>Fax</label>:<?php echo form_input($fax); ?></p>
	<p><label>Email</label>:<?php echo form_input($email); ?></p>
</div>
<div class="bawah">
	<div id="tombol_input">
		<center><?php echo form_button($simpan, 'SIMPAN'); ?></center>
	</div>
</div>

<!-- /.card -->