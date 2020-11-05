<script type="text/javascript">
$(document).ready(function(){
	$(':input:not([type="submit"])').each(function() {
		$(this).focus(function() {
			$(this).addClass('hilite');
		}).blur(function() {
			$(this).removeClass('hilite');});
	});	
	
});
</script>
<style type="text/css">
</style>
<div class="atas">
	<p><img src="<?php echo base_url();?>/asset/css/themes/icons/profil.png" align="absmiddle" />
	PROFIL KOPERASI
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
<div class="atas">
	<p><img src="<?php echo base_url();?>/asset/css/themes/icons/users.png" align="absmiddle" />
	PROFIL ANGGOTA
    </p>
</div>
<div class="tengah">
<p><label>No Identitas</label>: 
<input type="text"  value="<?php echo $noidentitas; ?>" readonly="readonly" /></p>
<p><label>Nama Anggota</label>: 
<input type="text" value="<?php echo $namaanggota; ?>" size="50" readonly="readonly" /></p>
<?php
if($jk=='L'){
	$sex = 'Laki-laki';
}else{
	$sex = 'Perempuan';
}
?>
<p><label>Jenis Kelamin</label>:
<input type="text" value="<?php echo $sex; ?>" readonly="readonly" /></p>
<p><label>Tempat Lahir</label>:
<input type="text" value="<?php echo $tempat_lahir; ?>" readonly="readonly" /></p>
<p><label>Tanggal Lahir</label>:
<input type="text" value="<?php echo $tgl_lahir; ?>" readonly="readonly" /> </p>
<p><label>Alamat</label>:
<input type="text" value="<?php echo $alamat; ?>" size="80" readonly="readonly" /></p>
<p><label>No Handphone</label>:
<input type="text" value="<?php $hp; ?>" readonly="readonly" /></p>

</div>