<script type="text/javascript">
$(function() {
	$("#theTable.detail tr:even").addClass("stripe1");
	$("#theTable.detail tr:odd").addClass("stripe2");
	$("#theTable.detail tr").hover(
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
.tengah .tampil_data {
	margin:0px;
}
</style>
<div class="tengah">
	<div class="tampil_data">
    <table id="theTable" class="detail" width="100%">
    <tr>
    	<th width="5">No</th>
        <th>Cicilan</th>
        <th>Angsuran</th>
        <th>Bunga</th>
        <th width="150">Tanggal JT</th>
        <th width="150">Tanggal Bayar</th>
        <th>Jumlah Bayar</th>
	</tr>   
    <?php
	if($dt_view_pinjaman->num_rows()>0){
		$t_angsuran=0;
		$t_bunga=0;
		$t_jml=0;
		$no =1;
		foreach($dt_view_pinjaman->result_array() as $db){
			$tgl = $this->app_model->tgl_str($db['tgl_jatuh_tempo']);
			$tgl_bayar = $this->app_model->tgl_str($db['tgl_bayar']);
			$jml = $db['jumlah_bayar'];
	?>    
    	<tr>
			<td align="center"><?php echo $no; ?></td>
            <td><?php echo $db['cicilan']; ?></td>
            <td align="right"><?php echo number_format($db['angsuran']); ?></td>
            <td align="right"><?php echo number_format($db['bunga']); ?></td>
            <td align="center"><?php echo $tgl; ?></td>
            <td align="center"><?php echo $tgl_bayar; ?></td>
			<td align="right"><?php echo number_format($jml); ?></td>
    </tr>
    <?php
		$t_angsuran = $t_angsuran+$db['angsuran'];
		$t_bunga = $t_bunga+$db['bunga'];
		$t_jml  = $t_jml+$jml;
		$no++;
		}
	}else{
		$t_angsuran=0;
		$t_bunga=0;
		$t_jml=0;
	?>
    	<tr>
        	<td colspan="6" align="center" >Tidak Ada Data</td>
        </tr>
    <?php
	}
	?>
    <tr>
    	<td colspan="2" >Total</td>
        <td align="right"><?php echo number_format($t_angsuran);?></td>
        <td align="right"><?php echo number_format($t_bunga);?></td>
        <td colspan="2"></td>
        <td align="right"><?php echo number_format($t_jml);?></td>
	</tr>        
    </table>
    </div>
</div>