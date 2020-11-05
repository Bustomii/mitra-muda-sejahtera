<script type="text/javascript">
    $(function() {
        $("#theTable tr:even").addClass("stripe1");
        $("#theTable tr:odd").addClass("stripe2");
        $("#theTable tr").hover(
            function() {
                $(this).toggleClass("highlight");
            },
            function() {
                $(this).toggleClass("highlight");
            }
        );
    });
    $(document).ready(function() {
        $(':input:not([type="submit"])').each(function() {
            $(this).focus(function() {
                $(this).addClass('hilite');
            }).blur(function() {
                $(this).removeClass('hilite');
            });
        });

        $("#anggota").focus();

        $("#tgl_awal").datepicker({
            dateFormat: "dd-mm-yy"
        });
        $("#tgl_akhir").datepicker({
            dateFormat: "dd-mm-yy"
        });

        $("#anggota").keyup(function(e) {
            var isi = $(e.target).val();
            $(e.target).val(isi.toUpperCase());
            CariAnggota(isi);
            view_rekening_koran();
        });
        $("#jenis").change(function() {
            view_rekening_koran();
        });
        $("#tgl_awal").change(function() {
            view_rekening_koran();
        });
        $("#tgl_akhir").change(function() {
            view_rekening_koran();
        });


        //tampil_data();

        $("#tutup").click(function() {
            //tampil_data();
            window.location.replace('<?php echo site_url(); ?>/home');
        });

        function CariAnggota(isi) {
            var nomor = isi; //$("#anggota").val();
            //alert('Info '+nomor);
            $.ajax({
                type: "POST",
                url: "<?php echo site_url(); ?>/ref_json/CariAnggota",
                data: "nomor=" + nomor,
                dataType: "json",
                cache: false,
                success: function(data) {
                    $('#identitas').val(data.identitas);
                    $('#nama_anggota').val(data.anggota);
                    $('#jk').val(data.jk);
                    $('#hp').val(data.hp);
                    $('#ttl').val(data.tempat_lhr + ", " + data.tgl_lhr);

                    //view_pinjaman(data.no_pinjam);
                }
            });
        }

        function view_rekening_koran() {
            var nomor = $("#anggota").val();
            var jenis = $("#jenis").val();
            var tgl_awal = $("#tgl_awal").val();
            var tgl_akhir = $("#tgl_akhir").val();
            //alert('Info '+nomor);
            $.ajax({
                type: "POST",
                url: "<?php echo site_url(); ?>/rekening_koran/view_rekening_koran",
                data: "nomor=" + nomor + "&jenis=" + jenis + "&tgl_awal=" + tgl_awal + "&tgl_akhir=" + tgl_akhir,
                chace: false,
                success: function(data) {
                    $("#view_rekening_koran").html(data);
                    //alert('info'+nomor);
                }
            });
        }

        $("#refresh").click(function() {
            window.location.replace('<?php echo site_url(); ?>/rekening_koran/index');
        });

        $("#cetak").click(function() {
            var nomor = $("#anggota").val();
            var jenis = $("#jenis").val();
            var tgl_awal = $("#tgl_awal").val();
            var tgl_akhir = $("#tgl_akhir").val();

            if (nomor.length == 0) {
                $.messager.show({
                    title: 'Info',
                    msg: 'Maaf, No Anggota tidak boleh kosong',
                    timeout: 2000,
                    showType: 'slide'
                });
                $("#anggota").focus();
                return false();
            } else {
                if (jenis.length == 0) {
                    $.messager.show({
                        title: 'Info',
                        msg: 'Maaf, Jenis Simpanan tidak boleh kosong',
                        timeout: 2000,
                        showType: 'slide'
                    });
                    $("#jenis").focus();
                    return false();
                } else {
                    if (tgl_awal.length == 0) {
                        $.messager.show({
                            title: 'Info',
                            msg: 'Maaf, Tanggal awal tidak boleh kosong',
                            timeout: 2000,
                            showType: 'slide'
                        });
                        $("#tgl_awal").focus();
                        return false();
                    } else {
                        if (tgl_akhir.length == 0) {
                            $.messager.show({
                                title: 'Info',
                                msg: 'Maaf, Tanggal Akhir tidak boleh kosong',
                                timeout: 2000,
                                showType: 'slide'
                            });
                            $("#tgl_akhir").focus();
                            return false();
                        } else {
                            $.ajax({
                                type: "POST",
                                url: "<?php echo site_url(); ?>/rekening_koran/CariData",
                                data: "nomor=" + nomor + "&jenis=" + jenis + "&tgl_awal=" + tgl_awal + "&tgl_akhir=" + tgl_akhir,
                                cache: false,
                                dataType: "json",
                                success: function(data) {
                                    //$('#jumlah').val(data.jumlah);
                                    //alert('Info '+data.info);
                                    if (data.info == true) {

                                        $.messager.show({
                                            title: 'Info',
                                            msg: 'Lanjut',
                                            timeout: 2000,
                                            showType: 'slide'
                                        });

                                        window.open('<?php echo site_url(); ?>/rekening_koran/cetak/' + "?nomor=" + nomor + "&jenis=" + jenis + "&tgl_awal=" + tgl_awal + "&tgl_akhir=" + tgl_akhir);
                                    } else {
                                        $.messager.show({
                                            title: 'Info',
                                            msg: 'Maaf, Tidak ada data',
                                            timeout: 2000,
                                            showType: 'slide'
                                        });
                                        //alert('Maaf, Data belum tersimpan');
                                    }

                                }
                            });
                        }
                    }
                }
            }
        });

    });
</script>
<style type="text/css">
    #tombol {
        float: left;
    }

    #pencarian {
        float: right;
    }

    #form_input {
        width: 100%;
        height: 200px;
    }

    #inputan {
        width: 50%;
        padding-top: 5px;
    }

    #view_anggota {
        width: 50%;
        padding-top: 5px;
    }

    #view_rekening_koran {
        margin: 0px;
    }
</style>
<div class="atas">
    <p><img src="<?php echo base_url(); ?>/asset/css/themes/icons/print.png" align="absmiddle" />
        CETAK REKENING KORAN ANGGOTA
    </p>
</div>
<div class="tengah">
    <div id="form_input" class="easyui-layout" data-options="fit:true">
        <div id="inputan" region="center" title="Data Input">
            <p><label>Nomor Anggota</label>:<?php echo form_input($anggota); ?></p>
            <p><label>Jenis Simpanan</label>:<?php echo form_dropdown('jenis', $opt_jenis, '', $jenis); ?></p>
            <p><label>Tanggal</label>:<?php echo form_input($tgl_awal); ?> - <?php echo form_input($tgl_akhir); ?></p>
        </div>
        <div id="view_anggota" region="east" title="Data Anggota" data-options="collapsible:false">
            <p><label>No.Identitas</label>:<?php echo form_input($identitas); ?></p>
            <p><label>Nama Anggota</label>:<?php echo form_input($nama_anggota); ?></p>
            <p><label>Tempat, Tanggal Lahir</label>:<?php echo form_input($ttl); ?></p>
            <p><label>Jenis Kelamin</label>:<?php echo form_input($jk); ?></p>
            <p><label>No HP</label>:<?php echo form_input($hp); ?></p>
        </div>
    </div>
</div>
<div class="bawah">
    <div id="paging">
        <p>
            <center><?php echo $paginator; ?></center>
        </p>
    </div>
    <div id="tombol_input">
        <center>
            <?php echo form_button($cetak, 'CETAK'); ?>
            <?php echo form_button($refresh, 'REFRESH'); ?>
            <?php echo form_button($tutup, 'TUTUP'); ?>
        </center>
    </div>
</div>
<div id="view_rekening_koran"></div>