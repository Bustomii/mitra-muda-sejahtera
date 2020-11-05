<script type="text/javascript">
$(function() {
	//$(".list td:even").addClass("stripe1");
	//$(".list td:odd").addClass("stripe2");
	$(".list td").hover(
		function() {
			$(this).toggleClass("highlight");
		},
		function() {
			$(this).toggleClass("highlight");
		}
	);
});
</script>
<style type="text/css">
thead {
	background:#D3DCE3;
	font-weight:bold;
}
.highlight{
	background:#D3DCE3;
	cursor:pointer;
}
</style>
<div class="atas">
	<p><img src="<?php echo base_url();?>/asset/css/themes/icons/home.png" align="absmiddle" />
	HOME
    </p>
</div>
<div class="tengah">
<h3>Hai, <?php echo $this->session->userdata('username'); ?>. 
Selamat Datang di <?php echo $judul; ?></h3>
<table class="list" width="100%">
	<thead>
    <td class="center" colspan="2"><center>CONTROL PANEL</center></td>
    </thead>
    <tr>
    	<td align="center"><a href="<?php echo base_url();?>index.php/c_anggota/simpanan"><img src="<?php echo base_url();?>asset/images/simpanan.png" /><br />
        <b>Simpanan</b></a></td>
        <td align="center"><a href="<?php echo base_url();?>index.php/c_anggota/pinjaman"><img src="<?php echo base_url();?>asset/images/pinjaman.png" /><br />
        <b>Pinjaman</b></a></td>
	</tr>       
</table>   
Keterangan SHU :
<ol>
<li>SHU atas Jasa Pinjam       25%</li>
<li>SHU atas Simpanan Wajib      20%</li>
</ol>
Komponen lainnya tidak dimasukan.
</div>