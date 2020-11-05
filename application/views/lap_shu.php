<style type="text/css">
	* {
		font-family: Arial;
		margin: 0px;
		padding: 0px;
	}

	@page {
		margin-left: 3cm 2cm 2cm 2cm;
	}

	table.grid {
		width: 29.7cm;
		font-size: 9pt;
		border-collapse: collapse;
	}

	table.grid th {
		padding-top: 1mm;
		padding-bottom: 1mm;
	}

	table.grid th {
		background: #F0F0F0;
		border-top: 0.2mm solid #000;
		border-bottom: 0.2mm solid #000;
		text-align: center;
		padding-left: 0.2cm;
		border: 1px solid #000;
	}

	table.grid tr td {
		padding-top: 0.5mm;
		padding-bottom: 0.5mm;
		padding-left: 2mm;
		border-bottom: 0.2mm solid #000;
		border: 1px solid #000;
	}

	h1 {
		font-size: 18pt;
	}

	h2 {
		font-size: 14pt;
	}

	.profil {
		display: block;
		width: 20.4cm;
		font-size: 10px;
		margin: 0px;
		padding: 0px;
	}

	.profil .koperasi {
		font-size: 14px;
		font-weight: bold;
	}

	.header {
		display: block;
		width: 29.7cm;
		margin-bottom: 0.3cm;
		text-align: center;
	}

	.attr {
		font-size: 9pt;
		width: 100%;
		padding-top: 2pt;
		padding-bottom: 2pt;
		border-top: 0.2mm solid #000;
		border-bottom: 0.2mm solid #000;
	}

	.pagebreak {
		width: 29.7cm;
		page-break-after: always;
		margin-bottom: 10px;
	}

	.akhir {
		width: 29.7cm;
		font-size: 13px;
	}

	.page {
		width: 29.7cm;
		font-size: 12px;
	}
</style>
<?php

$judul_H = "Laporan SHU Anggota <br>";

$tgl = $this->app_model->tgl_sql($param);

$where = " ";
$judul_H .= "Per Tanggal $param<br>";

$profil = "<span class='koperasi'>" . $nama_perusahaan . "</span><br>";
$profil .= $alamat_perusahaan;

$query = "select * from anggota
		$where
		order by noanggota";
//echo $query;
$shu_jasa = $this->app_model->shu_ditahan($tgl);
$shu_simpanan = $this->app_model->shu_simpanan($tgl);

$data = $this->db->query($query);

echo  "<div class='profil'>" . $profil . "
		</div>
		<br>
		<div class='header'>
		  <h2>" . $judul_H . "</h2>
		  </div>
	<p>SHU Jasa 25%: " . number_format($shu_jasa) . " - SHU Simpanan 20% : " . number_format($shu_simpanan) . "</p>		  
		<table class='grid' >
		<tr>
			<th width='5%' rowspan='2'>No</th>
			<th rowspan='2'>Nomor Anggota</th>
			<th rowspan='2'>Nama Anggota</th>
			<th rowspan='2'>L/P</th>
			<th colspan='2'>SHU</th>
			<th rowspan='2'>Total</th>
		</tr>
		<tr>
			<th>Jasa Pinjaman</th>
			<th>Simpanan Wajib</th>
		</tr>";

$no = 1;
$page = 1;
foreach ($data->result_array() as $r_data) {
	$jasa = $this->app_model->pendapatan_bunga($r_data['noanggota'], $tgl);
	$simpanan = 0; //$this->app_model->sisa_pinjaman($r_data['noanggota']);
	$total = $jasa + $simpanan;
	echo "<tr>
				<td align='center'>$no</td>
				<td align='center'>$r_data[noanggota]</td>
				<td align='left'>$r_data[namaanggota]</td>
				<td align='center'>$r_data[jk]</td>
				<td align='right'>" . number_format($jasa) . "</td>
				<td align='right'>" . number_format($simpanan) . "</td>
				<td align='right'>" . number_format($total) . "</td>
			</tr>";
	$no++;
}

echo "</table>";
echo "<br>";
echo "<div class='akhir' align='right'>";
echo "Lampung Tengah, " . date('d F Y');
echo "<br>Staf Koperasi";
echo "<br><br><br>";
echo $this->session->userdata('username');
echo  "</div>";
echo "<div class='page' align='center'>Hal - " . $page . "</div>";
?>