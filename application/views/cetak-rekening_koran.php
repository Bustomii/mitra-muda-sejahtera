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
        width: 21cm;
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
        padding-right: 2mm;
        border-bottom: 0.2mm solid #000;
        border: 1px solid #000;
    }

    h1 {
        font-size: 18pt;
    }

    h2 {
        font-size: 14pt;
    }

    h3 {
        font-size: 10pt;
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
        width: 21cm;
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
        width: 21cm;
        page-break-after: always;
        margin-bottom: 10px;
    }

    .akhir {
        width: 21cm;
        font-size: 13px;
    }

    .page {
        width: 21cm;
        font-size: 12px;
    }

    .tengah .tampil_data {
        margin: 0px;
    }

    .atas {
        width: 21cm;
    }

    .atas .kiri {
        float: left;
    }

    .atas .kanan {
        float: right;
    }
</style>
<?php
$page = 1;
$tgl_now = $this->app_model->tgl_now_indo();
$q_jenis['id_jenis'] = $jenis;
$r_jenis = $this->app_model->getSelectedData("jenis_simpan", $q_jenis);
$row_jenis = $r_jenis->num_rows();
if ($row_jenis > 0) {
    foreach ($r_jenis->result() as $d_jenis) {
        $dt_jenis['jenis'] = $d_jenis->jenis_simpanan;
        $dt_jenis['kode'] = $d_jenis->id_jenis;
    }
}
$q_anggota['noanggota'] = $id;
$r_anggota = $this->app_model->getSelectedData("anggota", $q_anggota);
$row_anggota = $r_anggota->num_rows();
if ($row_anggota > 0) {
    foreach ($r_anggota->result() as $d_anggota) {
        $dt_anggota['kode'] = $d_anggota->noanggota;
        $dt_anggota['nama'] = $d_anggota->namaanggota;
        $dt_anggota['no'] = $d_anggota->noidentitas;
        $dt_anggota['jk'] = $d_anggota->jk;
        $dt_anggota['tempat_lahir'] = $d_anggota->tempat_lahir;
        $dt_anggota['tgl_lahir'] = $d_anggota->tgl_lahir;
        $dt_anggota['alamat'] = $d_anggota->alamat;
        $dt_anggota['hp'] = $d_anggota->hp;
        $dt_anggota['foto'] = $d_anggota->foto;
    }
}
$jk_anggota = "";
if ($dt_anggota['jk'] == "L") {
    $jk_anggota = "Laki-Laki";
} else {
    $jk_anggota = "Perempuan";
}
$tgl_lahir_anggota = $this->app_model->tgl_str($dt_anggota['tgl_lahir']);
$foto_anggota = base_url('uploads/' . $dt_anggota['foto']);
$logo = base_url('asset/images/logo.png');
$nama_perusahaan = $this->app_model->Nama_Perusahaan();
$kota_perusahaan = $this->app_model->Kota();
$alamat_perusahaan = $this->app_model->Alamat();
$hp_perusahaan = $this->app_model->Hp();
$tgl_akhir_periode = $this->app_model->tgl_str($tgl_akhir);
?>
<div class="profil">
    <img src="<?= $logo; ?>" height="70" width="70" style="float: left; padding-right: 2mm;">
    <h1><?= $nama_perusahaan; ?></h1>
    <h2><?= $alamat_perusahaan; ?></h2>
    <h3><?= $hp_perusahaan; ?></h3>
</div>
<div class="header">
    <h2>HISTORI TRANSAKSI</h2>
</div>
<div class="atas">
    <div class="kiri">
        <table>
            <tr>
                <td>Periode (Sampai Dengan)</td>
                <td>:</td>
                <td><?= $tgl_akhir_periode; ?></td>
            </tr>
            <tr>
                <td>Jenis Simpanan (Kode)</td>
                <td>:</td>
                <td><?= $dt_jenis['jenis'] . " (" . $dt_jenis['kode'] . ")"; ?></td>
            </tr>
        </table>
    </div>
    <div class="kanan">
        <table>
            <tr>
                <td>Kode Anggota</td>
                <td>:</td>
                <td><?= $id; ?></td>
                <td rowspan="5"><img src="<?= $foto_anggota; ?>" height="100" width="100"></td>
            </tr>
            <tr>
                <td>No Identitas</td>
                <td>:</td>
                <td><?= $dt_anggota['no']; ?></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><?= $dt_anggota['nama']; ?></td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td><?= $jk_anggota; ?></td>
            </tr>
            <tr>
                <td>TTL</td>
                <td>:</td>
                <td><?= $dt_anggota['tempat_lahir'] . ", " . $tgl_lahir_anggota; ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td colspan="2"><?= $dt_anggota['alamat']; ?></td>
            </tr>
            <tr>
                <td style="padding-left: 4mm;">RT/RW</td>
                <td>:</td>
                <td colspan="2"><?= $dt_anggota['alamat']; ?></td>
            </tr>
            <tr>
                <td style="padding-left: 4mm;">Kel/Desa</td>
                <td>:</td>
                <td colspan="2"><?= $dt_anggota['alamat']; ?></td>
            </tr>
            <tr>
                <td style="padding-left: 4mm;">Kecamatan</td>
                <td>:</td>
                <td colspan="2"><?= $dt_anggota['alamat']; ?></td>
            </tr>
            <tr>
                <td style="padding-left: 4mm;">Kabupaten</td>
                <td>:</td>
                <td colspan="2"><?= $dt_anggota['alamat']; ?></td>
            </tr>
            <tr>
                <td style="padding-left: 4mm;">Provinsi</td>
                <td>:</td>
                <td colspan="2"><?= $dt_anggota['alamat']; ?></td>
            </tr>
        </table>
    </div>
</div>
<div class="body">
    <div class="tengah">
        <div class="tampil_data">
            <table id="theTable" class="grid">
                <thead>
                    <th align="center" style="width: 15%;">Tanggal</th>
                    <th align="center" style="width: 5%;">Kode</th>
                    <th align="center" style="width: 15%;">Debet</th>
                    <th align="center" style="width: 15%;">Kredit</th>
                    <th align="center" style="width: 5%;">Admin</th>
                    <th align="center" style="width: 15%;">Saldo</th>
                    <th align="center">Keterangan</th>
                </thead>
                <?php
                if ($dt_view_simpanan->num_rows() == 0 && $dt_view_pengambilan->num_rows() == 0) {
                ?>
                    <tr>
                        <td colspan="7" align="center">Tidak Ada Data</td>
                    </tr>
                    <?php
                } else {
                    $saldo = 0;
                    $dt1 = strtotime($tgl_awal);
                    $dt2 = strtotime($tgl_akhir);
                    $diff = abs($dt2 - $dt1);
                    $jarak = $diff / 86400; // 86400 detik sehari
                    $i = 0;
                    while ($i <= $jarak) {
                        $harinya = date('Y-m-d', strtotime('+' . $i . ' day', strtotime($tgl_awal)));
                        $i++;
                        foreach ($dt_view_simpanan->result_array() as $db) {
                            if ($db['tgl'] == $harinya) {
                                $tgl = $this->app_model->tgl_str($db['tgl']);
                    ?>
                                <tr>
                                    <td align="center"><?= $tgl; ?></td>
                                    <td align="center"><?= $db['id_jenis']; ?></td>
                                    <td align="center"><?= ""; ?></td>
                                    <td align="right"><?= number_format($db['jumlah']); ?></td>
                                    <td align="center"><?= $db['user_id']; ?></td>
                                    <td align="right"><?= number_format($saldo += $db['jumlah']); ?></td>
                                    <td align="center"><?= $db['ket']; ?></td>
                                </tr>
                            <?php
                            }
                        }
                        foreach ($dt_view_pengambilan->result_array() as $db) {
                            if ($db['tgl'] == $harinya) {
                                $tgl = $this->app_model->tgl_str($db['tgl']);
                            ?>
                                <tr>
                                    <td align="center"><?= $tgl; ?></td>
                                    <td align="center"><?= $db['id_jenis']; ?></td>
                                    <td align="right"><?= number_format($db['jumlah']); ?></td>
                                    <td align="center"><?= ""; ?></td>
                                    <td align="center"><?= $db['user_id']; ?></td>
                                    <td align="right"><?= number_format($saldo -= $db['jumlah']); ?></td>
                                    <td align="center"><?= $db['ket']; ?></td>
                                </tr>
                <?php
                            }
                        }
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>

<?php
echo "<br>";
echo "<div class='akhir' align='right'>";
echo $kota_perusahaan . ", " . $tgl_now;
echo "<br>Staf Koperasi";
echo "<br><br><br><br><br>";
echo $this->session->userdata('nama_pengguna');
echo  "</div>";
//echo "<div class='page' align='center'>Hal - " . $page . "</div>";
?>