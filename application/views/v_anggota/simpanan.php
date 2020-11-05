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
	DAFTAR SIMPANAN ANGGOTA
    </p>
</div>
<div class="tengah">
    <table id="theTable" width="100%">
    <tr>
    	<th width="5">No</th>
        <th width="50">Nomor</th>
        <th>No.Identitas</th>
        <th>Nama Anggota</th>
        <th>Jenis Kelamin</th>
        <th>Jumlah Simpanan</th>
        <th>Jumlah Pengambilan</th>
        <th>Saldo</th>
        <th>Detail</th>
	</tr>   
    <?php
	if($dt_simpanan->num_rows()>0){
		$no =1+$hal;
		foreach($dt_simpanan->result_array() as $db){
			if($db['jk']=='L'){
				$sex = 'Laki-laki';
			}else{
				$sex = 'Perempuan';
			}

			$saldo = $db['jumlah_simpanan'] - $db['jumlah_pengambilan']
	?>    
    	<tr>
			<td align="center"><?php echo $no; ?></td>
            <td align="center"><?php echo $db['noanggota']; ?></td>
            <td align="center"><?php echo $db['noidentitas']; ?></td>
			<td><?php echo $db['namaanggota']; ?></td>
            <td align="center"><?php echo $sex; ?></td>
            <td align="right"><?php echo number_format($db['jumlah_simpanan']); ?></td>
            <td align="right"><?php echo number_format($db['jumlah_pengambilan']); ?></td>
            <td align="right"><?php echo number_format($saldo); ?></td>
            <td align="center"><a href="<?php echo base_url();?>index.php/c_anggota/simpanan/detail">Detail</a></td>
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