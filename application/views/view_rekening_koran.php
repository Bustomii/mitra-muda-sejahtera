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
    });
</script>
<style type="text/css">
    .tengah .tampil_data {
        margin: 0px;
    }
</style>
<div class="tengah">
    <div class="tampil_data">
        <table id="theTable" class="detail" width="100%">
            <thead>
                <th align="center">Tanggal</th>
                <th align="center" width="5">Kode</th>
                <th align="center">Debet</th>
                <th align="center">Kredit</th>
                <th align="center">Admin</th>
                <th align="center">Saldo</th>
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