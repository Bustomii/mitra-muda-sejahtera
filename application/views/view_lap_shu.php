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
	$("#tanggal").datepicker({
			dateFormat:"dd-mm-yy"
    });
	
	$("#noanggota").keyup(function(e){
		var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());
		CariAnggota(isi);
	});
	
	$("#cetak").click(function(){
		var tgl 	= $('#tanggal').val();
		var	pilih	= $(".pilih:checked").val();
		var jml_pilih = $(".pilih:checked");
		
		if(tgl.length == 0){
           var error = true;
           alert("Maaf, Tanggal belum memilih");
		   $("#tanggal").focus();
		   return (false);
         }
			window.open("<?php echo base_url();?>index.php/laporan/cetak_shu/"+tgl);	
	});	
});
</script>
<style type="text/css">
.tengah .tampil_data {
	margin:0px;
}
</style>
<div class="atas">
	<p><img src="<?php echo base_url();?>/asset/css/themes/icons/print.png" align="absmiddle" />
	Laporan SHU Anggota
    </p>
</div>
<div class="tengah">
    <table width="100%">
    <tr>
    	<td width="10%">Per Tanggal</td>
        <td><input type="text" name="tanggal" id="tanggal" size="12" /></td>
	</tr>
     </table>       
</div>
<div class="bawah">
<div id="tombol_input">
    <center>
    <button name="cetak" id="cetak" class="easyui-linkbutton" data-options="iconCls:'icon-print'">Cetak</button>
	</center>
</div>    	
</div>