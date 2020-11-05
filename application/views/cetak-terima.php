<style type="text/css">
	* {
		font-family: Arial;
		font-size: 12px;
	}

	#kotak_luar {
		width: 20.4cm;
		margin: 10px 10px 10px 10px;
		font-size: 12px;
	}

	#kotak_judul {
		border: 2px solid;
		line-height: 5px;
	}

	#judul_koperasi {
		width: 450px;
	}

	h1 {
		font-size: 16px;
	}

	h2 {
		font-size: 10px;
	}

	h1 u {
		font-size: 16px;
	}

	#nomor {
		float: right;
		margin-right: 40px;
		margin-top: -5px;
		font-size: 12px;
		font-weight: bold;
	}

	#kotak_subjek {
		padding-left: 20px;
		padding-top: 20px;
		width: 500px;
		border: 2px solid;
		clear: both;
		height: 250px;
	}

	#t_subjek tr {
		height: 60px;
	}

	#t_subjek i {
		font-size: 16px;
	}

	#kotak_nip {
		float: right;
		padding-top: 20px;
		width: 245px;
		border: 2px solid;
		margin-top: -274px;
		height: 250px;
	}

	#dalam_kotak_nip {
		padding: 5px 15px 5px 5px;
	}
</style>
<?php
echo "<div id='kotak_luar'>
	<div id='kotak_judul'>
		<div id='judul_koperasi' align='center'>
		<h1>" . $nama_perusahaan . "</h1>
		<h2><u>" . $alamat_perusahaan . "</u></h2>
		</div>
		<div id='nomor'>
		Nomor : " . sprintf("%05s", $nomor) . "</b>
		</div>
		<br>
		<span id='kwitansi' align='center'>
		<h1>KWITANSI TANDA TERIMA</h1>
		</span>
		<br>
	</div>
	<div id='kotak_subjek'>
	<table id='t_subjek'>
	<tr>
		<td valign='top' width='70'>Subjek</td>
		<td valign='top' width='2'>:</td>
		<td valign='top'>Sudah terima dari <b><i>" . $nama . "</i></b> <br>alamat " . $alamat . "</td>
	</tr>
	<tr>
		<td valign='top'>Untuk</td>
		<td valign='top' width='2'>:</td>
		<td valign='top'>(Penarikan / Setoran) " . $jenis . " </td>
	</tr>
	<tr>
		<td valign='top'>Terbilang</td>
		<td valign='top' width='2'>:</td>
		<td valign='top'><i>" . $terbilang . " rupiah</i></td>
	</tr>
	<tr>
		<td valign='top'>Rp</td>
		<td valign='top' width='2'>:</td>
		<td valign='top'><b><i>" . $jumlah . "</i></b></td>
	</tr>
	</table>
	</div>
	<div id='kotak_nip'>
		<div id='dalam_kotak_nip'>
		<table>
		<tr>
			<td valign='top' width='70'>NIP</td>
			<td valign='top' width='2'>:</td>
			<td valign='top'><b>" . $noanggota . "</b></td>
		</tr>
		<tr>
			<td valign='top' width='70'>No. Rek</td>
			<td valign='top' width='2'>:</td>
			<td valign='top'>" . $identitas . "</td>
		</tr>
		</table>
		<br><br>
		<p><center>Lampung Tengah, $tgl</center></p>
		<br>
		<p><center>Yang Menerima</center></p>
		<br><br><br>
		<p><center>(_______________________)</center></p>
		
		</div>
	</div>
</div>";
?>