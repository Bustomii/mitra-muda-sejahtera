<script type="text/javascript">
$(function() {
	$("#theTable tr:even").addClass("stripe1");
	$("#theTable tr:odd").addClass("stripe2");
	$("#theTable tr").hover(
		function() {
			$(this).toggleClass("highlight");
		},
		function() {
			$(this).toggleClass("highlight");
		}
	);
});
$(document).ready(function(){	
	$(':input:not([type="submit"])').each(function() {
		$(this).focus(function() {
			$(this).addClass('hilite');
		}).blur(function() {
			$(this).removeClass('hilite');});
	});
});
</script>

<div class="atas">
	<p><img src="<?php echo base_url();?>/asset/css/themes/icons/simpanan.png" align="absmiddle" />
	DAFTAR SIMPANAN DETAIL ANGGOTA
    </p>
<hr />    
<form name="form" action="<?php echo base_url();?>index.php/c_anggota/simpanan/cari_detail" method="post">
Jenis Simpanan
<select name="jenis" id="jenis">
<option value="">-PILIH-</option>
<?php
foreach($jenis_simpan->result() as $t){
	echo "<option value='$t->id_jenis'>$t->jenis_simpanan</option>";
}
?>
</select>    
<button type="submit">Cari</button>
</form>
</div>
<div class="tengah">
    <table id="theTable" width="100%">
    <tr>
    	<th width="5">No</th>
        <th width="150">Tanggal</th>
        <th>Jenis Simpanan</th>
        <th>Jumlah Simpanan</th>
        <th>Jumlah Pengambilan</th>
        <th>Saldo</th>
	</tr>   
    <?php
	if($dt_simpanan->num_rows()>0){
		$simpan=0;
		$ambil = 0;
		$saldo = 0;
		$no =1+$hal;
		
		foreach($dt_simpanan->result_array() as $db){
		$tgl = $this->app_model->tgl_str($db['tgl']);
		$jenis = $this->app_model->nama_jenis($db['id_jenis']);	
		$ket = $db['ket'];
		if($ket=='simpan'){
			$simpan = $db['jumlah'];
			$ambil = 0;
		}else{
			$simpan = 0;
			$ambil = $db['jumlah'];
		}
			$saldo = $saldo+$simpan-$ambil;//$db['jumlah_simpanan'] - $db['jumlah_pengambilan']
	?>    
    	<tr>
			<td align="center"><?php echo $no; ?></td>
            <td align="center"><?php echo $tgl; ?></td>
            <td align="center"><?php echo $jenis; ?></td>
            <td align="right"><?php echo number_format($simpan); ?></td>
            <td align="right"><?php echo number_format($ambil); ?></td>
            <td align="right"><?php echo number_format($saldo); ?></td>
    </tr>
    <?php
		$no++;
		}
	}else{
	?>
    	<tr>
        	<td colspan="5" align="center" >Tidak Ada Data</td>
        </tr>
    <?php
	}
	?>
    </table>