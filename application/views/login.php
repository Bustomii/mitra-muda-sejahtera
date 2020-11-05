<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $judul; ?></title>
<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/style_login.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>asset/fonts/stylesheet.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/themes/gray/easyui.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/themes/icon.css" type="text/css" />
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/jquery.easyui.min.js"></script>
<style type="text/css">
button {margin: 0; padding: 0;}
button {margin: 2px; position: relative; padding: 4px 4px 4px 2px; 
cursor: pointer; float: left;  list-style: none;}
button span.ui-icon {float: left; margin: 0 4px;}
</style>
</head>
<body>
<div id="header">
<h3><?php echo $judul; ?></h3>
</div>

<?php echo form_open('koperasi/index'); ?>
<fieldset>
    <legend>Login</legend>
    <p><label>Username</label>:
    <?php echo form_input($username,set_value('username')); ?></p>
    <p><label>Password</label>:
	<?php echo form_input($password); ?></p>
</fieldset>
<fieldset class="tblFooters">
	<div id="error">
    <?php echo validation_errors(); ?>
	<?php echo $this->session->flashdata('result_login'); ?>
    </div>
	<?php echo form_button($submit,'Login');?>
</fieldset>

<?php echo form_close(); ?>

<div id="footer" align="center">
	<p>Halaman ini dimuat selama <strong>{elapsed_time}</strong> detik</p>
</div>
</body>
</html>