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
	
	$("#noanggota").keyup(function(e){
		var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());
		CariAnggota(isi);
	});
	
	$("#cetak").click(function(){
		var kode 	= $('#noanggota').val();
		var	pilih	= $(".pilih:checked").val();
		var jml_pilih = $(".pilih:checked");
		
		if(jml_pilih.length == 0){
           var error = true;
           alert("Maaf, Anda belum memilih");
		   //$("#txt_user").focus();
		   return (false);
         }
		window.open("<?php echo base_url();?>index.php/laporan/cetak_anggota/"+pilih+"/"+kode);	
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
	Laporan Anggota
    </p>
</div>
<div class="tengah">
    <table width="100%">
    <tr>
    	<td width="20%"><input type="radio" name="pilih" class="pilih" value="semua" checked="checked" /> Semua Data</td>
        <td></td>
	</tr>
    <tr>
    	<td><input type="radio" name="pilih" class="pilih" value="pilih" /> Pilih Nomor Anggota</td>
        <td><input type="text" name="noanggota" id="noanggota" /></td>
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