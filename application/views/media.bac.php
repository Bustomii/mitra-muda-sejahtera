<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" href="<?php echo base_url(); ?>asset/images/logo.png">
    <title><?php echo $judul; ?></title>
    <!--
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/themes/pepper-grinder/easyui.css">
-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/easyui-1.9.4/themes/default/easyui.css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/style.css">

    <!--
        <script type="text/javascript" src="<?php echo base_url(); ?>asset/easyui-1.9.4/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>asset/easyui-1.9.4/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>asset/easyui-1.9.4/jquery.easyui.mobile.js"></script>
    -->

    <!--
        -->
    <script type="text/javascript" src="<?php echo base_url(); ?>asset/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>asset/js/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>asset/js/jquery.datebox.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>asset/js/jquery.price_format.1.7.js"></script>

    <!-- untuk autocomplite -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/js/jquery.autocomplete.css" />
    <script type="text/javascript" src="<?php echo base_url(); ?>asset/js/jquery.autocomplete.js"></script>

    <!-- untuk datepicker -->
    <link type="text/css" href="<?php echo base_url(); ?>asset/css/smoothness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
    <script type="text/javascript" src="<?php echo base_url(); ?>asset/js/ui.core.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>asset/js/ui.datepicker.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>asset/js/ui.datepicker-id.js"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>asset/js/clock.js"></script>
    <!-- charts -->
    <script type="text/javascript" src="<?php echo base_url(); ?>asset/js/highcharts.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>asset/js/exporting.js"></script>

    <!-- webcam -->
    <script type="text/javascript" src="<?php echo base_url(); ?>asset/js/webcam.js"></script>
</head>

<body onLoad="goforit()" class="easyui-layout">
    <?php
    $user  = $this->session->userdata('nama_pengguna');
    ?>
    <div class="atas" data-options="region:'north',border:false" style="height:95px;padding:5px">
        <div id="logo">
            <img src="<?php echo base_url(); ?>asset/images/logo.png" height="70" width="70" />
        </div>
        <div id="judul">
            <p>
                <h2><?php echo $judul; ?></h2>
            </p>
            <p>
                <h1><?php echo $nama_perusahaan; ?></h1>
            </p>
            <p>
                <h3><?php echo $alamat_perusahaan; ?></h3>
            </p>
        </div>
        <div id="jam">
            <h2 style="line-height:5px;">Halaman Administrator</h2>
            <span id="clock"></span>
        </div>
    </div>
    <div data-options="region:'west',split:true,iconCls:'icon-menu',title:'Menu Utama',hideCollapsedContent:false" style="width:200px;padding:10px;">
        <?php echo $this->load->view('menu'); ?>
    </div>
    <div id="content" data-options="region:'center',title:' Nama Pengguna : <?php echo $user; ?>',iconCls:'icon-content'">
        <?php echo $isi; ?>
    </div>
    <div class="bawah" data-options="region:'south',border:false" style="height:50px;padding:2px;color:#000;">
        <div align="center">
            <p>
                Halaman ini dimuat selama<strong>{elapsed_time}</strong> detik
            </p>
            <p>
                <a href="ancodecorp.com">Copyright &copy; <?php echo $lisensi; ?></a>
            </p>
        </div>
    </div>
</body>

</html>