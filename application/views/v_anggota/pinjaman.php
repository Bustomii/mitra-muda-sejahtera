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
function cetakData(ID){
	var id			= ID;
	//alert(id);
	$.ajax({
		type	: "POST",
		url		: "<?php echo site_url(); ?>/pinjaman/CariData",
		data	: "id="+id,
		cache	: false,
		dataType: "json",
		success	: function(data){
			//$('#jumlah').val(data.jumlah);
			//alert('Info '+data.info);
			if(data.info==true){
				window.open('<?php echo site_url(); ?>/pinjaman/cetak/'+id);	
			}else{
				alert('Maaf, Data belum tersimpan');
			}
			
		}
	});
}
</script>
<div class="atas">
	<p><img src="<?php echo base_url();?>/asset/css/themes/icons/pinjaman.png" align="absmiddle" />
	DAFTAR PINJAMAN ANGGOTA
    </p>
</div>
<div class="tengah">
    <table id="theTable" width="100%">
    <tr>
    	<th width="5">No</th>
        <th width="50">Nomor</th>
        <th>Tanggal</th>
        <th>Nomor Anggota</th>
        <th>Nama Anggota</th>
        <th>Jenis Kelamin</th>
        <th>Lama</th>
        <th>Jumlah</th>
        <th>Bunga</th>
        <th>Jumlah Bayar</th>
        <th>Jumlah Cicilan</th>
        <th>Sisa</th>
        <th>Aksi</th>
	</tr>   
    <?php
	if($dt_pinjaman->num_rows()>0){
		$no =1+$hal;
		foreach($dt_pinjaman->result_array() as $db){
			if($db['jk']=='L'){
				$sex = 'Laki-laki';
			}else{
				$sex = 'Perempuan';
			}
			$jml_bayar = $db['jumlah']+($db['jumlah']*$db['bunga']/100);
			$jml_cicilan = $this->app_model->jmlCicilan($db['id_pinjam']);
			$sisa = $jml_bayar-$jml_cicilan;
	?>    
    	<tr>
			<td align="center"><?php echo $no; ?></td>
            <td align="center"><?php echo $db['id_pinjam']; ?></td>
            <td align="center"><?php echo $this->app_model->tgl_str($db['tgl']); ?></td>
            <td align="center"><?php echo $db['noanggota']; ?></td>
			<td><?php echo $db['namaanggota']; ?></td>
            <td align="center"><?php echo $sex; ?></td>
            <td align="center"><?php echo $db['lama']." Bulan"; ?></td>
            <td align="right"><?php echo number_format($db['jumlah']); ?></td>
            <td align="center"><?php echo $db['bunga']."%"; ?></td>
            <td align="right"><?php echo number_format($jml_bayar); ?></td>
            <td align="right"><?php echo number_format($jml_cicilan); ?></td>
            <td align="right"><?php echo number_format($sisa); ?></td>
            <td align="center">
            <a href="javascript:cetakData('<?php echo $db['id_pinjam'] ?>')">
			<img src="<?php echo base_url();?>asset/images/print.png" title='Cetak'>
			</a>
            </td>
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