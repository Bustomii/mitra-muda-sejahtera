<style type="text/css">
*{
font-family: Arial;
margin:0px;
padding:0px;
}
@page {
 margin-left:3cm 2cm 2cm 2cm;
}
table.grid{
width:20.4cm ;
font-size: 9pt;
border-collapse:collapse;
}
table.grid th{
padding-top:1mm;
padding-bottom:1mm;
}
table.grid th{
background: #F0F0F0;
border-top: 0.2mm solid #000;
border-bottom: 0.2mm solid #000;
text-align:center;
padding-left:0.2cm;
border:1px solid #000;
}
table.grid tr td{
padding-top:0.5mm;
padding-bottom:0.5mm;
padding-left:2mm;
border-bottom:0.2mm solid #000;
border:1px solid #000;
}
h1{
font-size: 18pt;
}
h2{
font-size: 14pt;
}
.header{
display: block;
width:20.4cm ;
margin-bottom: 0.3cm;
text-align: center;
}
.attr{
font-size:9pt;
width: 100%;
padding-top:2pt;
padding-bottom:2pt;
border-top: 0.2mm solid #000;
border-bottom: 0.2mm solid #000;
}
.pagebreak {
width:20cm ;
page-break-after: always;
margin-bottom:10px;
}
.akhir {
width:20cm ;
}
.page {
width:20cm ;
}
.profil{
display: block;
width:20.4cm ;
font-size:10px;
margin:0px;
padding:0px;
}
.profil .koperasi{
font-size:14px;
font-weight:bold;
}
</style>
<?php
$judul_H = "Laporan Saldo Simpanan Anggota <br>";

if($pilih=='pilih'){
	$where	= " WHERE noanggota = '$noanggota'";
	$judul_H .= "Berdasarkan Nomor $noanggota<br>";
}else{
	$where	= "";
}

$profil = "<span class='koperasi'>".$nama_perusahaan."</span><br>";
$profil .= $alamat_perusahaan;

$query = "select * from anggota
		$where
		order by noanggota";
//echo $query;

$data = $this->db->query($query);

function myheader($profil,$judul_H){
echo  "<div class='profil'>".$profil."
		</div>
		<br>
		<div class='header'>
		  <h2>".$judul_H."</h2>
		  </div>
		<table class='grid' >
		<tr>
			<th width='5%'>No</th>
			<th >Nomor Anggota</th>
			<th >No Identitas</th>
			<th >Nama Anggota</th>
			<th >L/P</th>
			<th >HP</th>
			<th >Saldo Simpanan Apa Saja</th>
		</tr>";		
}
	//echo $query;
function myfooter(){	
	echo "</table>";
}
	$stotal=0;
	$no=1;
	$page =1;
	foreach($data->result_array() as $r_data){
		$tgllhr = $this->app_model->tgl_str($r_data['tgl_lahir']);
		$saldo = $this->app_model->getSaldo_Simpanan_Apa_Saja($r_data['noanggota']);
	//$total = $r_data[total];
	$stotal = $stotal+$saldo;
	if(($no%40) == 1){
   	if($no > 1){
        myfooter();
        echo "<div class=\"pagebreak\" align='right'>
		<div class='page' align='center'>Hal - $page</div>
		</div>";
		$page++;
  	}
   	myheader($profil,$judul_H);
	}
	echo "<tr>
			<td align='center'>$no</td>
			<td align='center'>$r_data[noanggota]</td>
			<td align='center'>$r_data[noidentitas]</td>
			<td align='left'>$r_data[namaanggota]</td>
			<td align='center'>$r_data[jk]</td>
			<td align='left'>$r_data[hp]</td>
			<td align='right'>".number_format($saldo)."</td>
			</tr>";
	$no++;
	}

myfooter();	
		echo "</table>";
	echo "<div class='akhir' align='right'>
			Total <b>".number_format($stotal)."</b>
		</div>";
	echo "<div class='page' align='center'>Hal - ".$page."</div>";
	/*
	header("Content-type: application/x-msdownload");
	header("Content-Disposition: attachment; filename=laporan.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	*/
	//echo $content;
//}
?>