<?php
$akses = $this->session->userdata('akses');
?>
<ul id="tt1" class="easyui-tree" data-options="animate:true,dnd:true">
    <li data-options="iconCls:'icon-home'">
        <span><a href="<?php echo base_url(); ?>index.php/home">Home</a></span>
    </li>
    <li data-options="iconCls:'icon-master'">
        <span>Master</span>
        <ul>
            <?php
            if ($akses == 'super admin') {
            ?>
                <li data-options="iconCls:'icon-profil'"><a href="<?php echo base_url(); ?>index.php/profil">Profil</a></li>
                <li data-options="iconCls:'icon-users'"><a href="<?php echo base_url(); ?>index.php/pengguna">Pengguna</a></li>
                <li data-options="iconCls:'icon-jenis'"><a href="<?php echo base_url(); ?>index.php/jenis">Jenis Simpanan</a></li>
            <?php } ?>
            <li data-options="iconCls:'icon-anggota'"><a href="<?php echo base_url(); ?>index.php/anggota">Anggota</a></li>
        </ul>
    </li>
    <li data-options="iconCls:'icon-transaksi'">
        <span>Transaksi</span>
        <ul>
            <li data-options="iconCls:'icon-simpanan'"><a href="<?php echo base_url(); ?>index.php/simpanan">Simpanan</a></li>
            <li data-options="iconCls:'icon-penarikan'"><a href="<?php echo base_url(); ?>index.php/pengambilan">Penarikan Dana</a></li>
            <li data-options="iconCls:'icon-cetak'"><a href="<?php echo base_url(); ?>index.php/rekening_koran">Rekening Koran</a></li>
            <li data-options="iconCls:'icon-pinjaman'"><a href="<?php echo base_url(); ?>index.php/pinjaman">Pinjaman</a></li>
            <li data-options="iconCls:'icon-bayar'"><a href="<?php echo base_url(); ?>index.php/pembayaran">Pembayaran</a></li>
        </ul>
    </li>
    <li data-options="iconCls:'icon-lap'">
        <span>Laporan</span>
        <ul>
            <li data-options="iconCls:'icon-cetak'"><a href="<?php echo base_url(); ?>index.php/laporan/anggota">Anggota</a></li>
            <li data-options="iconCls:'icon-cetak'"><a href="<?php echo base_url(); ?>index.php/laporan/simpanan">Simpanan</a></li>
            <li data-options="iconCls:'icon-cetak'"><a href="<?php echo base_url(); ?>index.php/laporan/simpanan_pokok">Simpanan Pokok</a></li>
            <li data-options="iconCls:'icon-cetak'"><a href="<?php echo base_url(); ?>index.php/laporan/simpanan_wajib">Simpanan Wajib</a></li>
            <li data-options="iconCls:'icon-cetak'"><a href="<?php echo base_url(); ?>index.php/laporan/simpanan_sukarela">Simpanan Sukarela</a></li>
            <li data-options="iconCls:'icon-cetak'"><a href="<?php echo base_url(); ?>index.php/laporan/simpanan_apa_saja">Simpanan Apa Saja</a></li>
            <li data-options="iconCls:'icon-cetak'"><a href="<?php echo base_url(); ?>index.php/laporan/simpanan_angsuran">Simpanan Angsuran</a></li>
            <li data-options="iconCls:'icon-cetak'"><a href="<?php echo base_url(); ?>index.php/laporan/penarikan">Penarikan</a></li>
            <li data-options="iconCls:'icon-cetak'"><a href="<?php echo base_url(); ?>index.php/laporan/penarikan_pokok">Penarikan Simpanan Pokok</a></li>
            <li data-options="iconCls:'icon-cetak'"><a href="<?php echo base_url(); ?>index.php/laporan/penarikan_wajib">Penarikan Simpanan Wajib</a></li>
            <li data-options="iconCls:'icon-cetak'"><a href="<?php echo base_url(); ?>index.php/laporan/penarikan_sukarela">Penarikan Simpanan Sukarela</a></li>
            <li data-options="iconCls:'icon-cetak'"><a href="<?php echo base_url(); ?>index.php/laporan/penarikan_apa_saja">Penarikan Simpanan Apa Saja</a></li>
            <li data-options="iconCls:'icon-cetak'"><a href="<?php echo base_url(); ?>index.php/laporan/penarikan_angsuran">Penarikan Angsuran</a></li>
            <li data-options="iconCls:'icon-cetak'"><a href="<?php echo base_url(); ?>index.php/laporan/pinjaman">Pinjaman</a></li>
            <li data-options="iconCls:'icon-cetak'"><a href="<?php echo base_url(); ?>index.php/laporan/pembayaran">Pembayaran</a></li>
            <li data-options="iconCls:'icon-cetak'"><a href="<?php echo base_url(); ?>index.php/laporan/tunggakan">Tunggakan</a></li>
            <li data-options="iconCls:'icon-cetak'"><a href="<?php echo base_url(); ?>index.php/laporan/shu">SHU</a></li>
        </ul>
    </li>
    <li data-options="iconCls:'icon-grafik'">
        <span>Grafik</span>
        <ul>
            <li data-options="iconCls:'icon-grafik'"><a href="<?php echo base_url(); ?>index.php/chart_simpanan">Simpanan</a></li>
            <li data-options="iconCls:'icon-grafik'"><a href="<?php echo base_url(); ?>index.php/chart_penarikan">Penarikan</a></li>
            <li data-options="iconCls:'icon-grafik'"><a href="<?php echo base_url(); ?>index.php/chart_pinjaman">Pinjaman</a></li>
            <li data-options="iconCls:'icon-grafik'"><a href="<?php echo base_url(); ?>index.php/chart_bayar_pinjaman">Bayar Pinjaman</a></li>
            <li data-options="iconCls:'icon-grafik'"><a href="<?php echo base_url(); ?>index.php/chart_dashboard">Dashboard</a></li>
        </ul>
    </li>
    <li data-options="iconCls:'icon-out'">
        <span><a href="<?php echo base_url(); ?>index.php/koperasi/logout">Keluar</a></span>
    </li>
</ul>