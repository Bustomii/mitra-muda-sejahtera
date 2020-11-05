<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rekening_koran extends CI_Controller
{
    public function index()
    {
        $cek = $this->session->userdata('logged_in');
        $level = $this->session->userdata('level');
        $akses = $this->session->userdata('akses');
        if (!empty($cek) && $level == 'admin') {
            $d['judul'] = $this->config->item('judul');
            $d['nama_perusahaan'] = $this->app_model->Nama_Perusahaan();
            $d['alamat_perusahaan'] = $this->app_model->Alamat();
            $d['hp'] = $this->app_model->Hp();
            $d['lisensi'] = $this->config->item('lisensi_app');

            $d['jam_now'] = $this->app_model->Jam_Now();
            $d['hari_now'] = $this->app_model->Hari_Bulan_Indo();
            $d['tgl_now'] = $this->app_model->tgl_now_indo();

            $d['anggota'] = array(
                'name' => 'anggota',
                'id' => 'anggota',
                'type' => 'text',
                'class' => 'easyui-validatebox',
                'size' => '12',
                'maxlength' => '12',
                'data-options' => 'required:true,validType:\'length[1,20]\''
            );

            $d['jenis'] = 'id="jenis"';

            $jenis = $this->app_model->manualQuery("SELECT * FROM jenis_simpan");
            $d['opt_jenis'][''] = '-Pilih-';
            foreach ($jenis->result() as $db) {
                if ($akses == 'super admin') {
                    $d['header_jenis'] = $jenis;
                    $d['opt_jenis'][$db->id_jenis] = '| ' . $db->id_jenis . ' | ' . $db->jenis_simpanan;
                } else {
                    if ($db->kontrol_laporan != 1) {
                        $d['header_jenis'] = $this->app_model->manualQuery("SELECT * FROM jenis_simpan WHERE kontrol_laporan != '1'");
                    }
                    if ($db->kontrol_simpanan != 1) {
                        $d['opt_jenis'][$db->id_jenis] = '| ' . $db->id_jenis . ' | ' . $db->jenis_simpanan;
                    }
                }
            }
            $d['tgl_awal'] = array(
                'name' => 'tgl_awal',
                'id' => 'tgl_awal',
                'type' => 'text',
                'size' => '12',
                'value' => '01-01-2000',
                'maxlength' => '12',
                'disabled' => true
            );
            $d['tgl_akhir'] = array(
                'name' => 'tgl_akhir',
                'id' => 'tgl_akhir',
                'type' => 'text',
                'size' => '12',
                'value' => date('d-m-Y'),
                'maxlength' => '12',
                'disabled' => true
            );

            //view anggota
            $d['identitas'] = array(
                'name' => 'identitas',
                'id' => 'identitas',
                'type' => 'text',
                'size' => '20',
                'maxlength' => '20',
                'disabled' => true
            );
            $d['nama_anggota'] = array(
                'name' => 'nama_anggota',
                'id' => 'nama_anggota',
                'type' => 'text',
                'size' => '20',
                'maxlength' => '20',
                'disabled' => true
            );
            $d['jk'] = array(
                'name' => 'jk',
                'id' => 'jk',
                'type' => 'text',
                'size' => '20',
                'maxlength' => '20',
                'disabled' => true
            );
            $d['hp'] = array(
                'name' => 'hp',
                'id' => 'hp',
                'type' => 'text',
                'size' => '20',
                'maxlength' => '20',
                'disabled' => true
            );
            $d['ttl'] = array(
                'name' => 'ttl',
                'id' => 'ttl',
                'type' => 'text',
                'size' => '20',
                'maxlength' => '20',
                'disabled' => true
            );

            //tombol bawah
            $d['cetak'] = array(
                'name' => 'cetak',
                'id' => 'cetak',
                'type' => 'submit',
                'class' => 'easyui-linkbutton',
                'data-options' => 'iconCls:\'icon-print\''
            );
            $d['refresh'] = array(
                'name' => 'refresh',
                'id' => 'refresh',
                'type' => 'submit',
                'class' => 'easyui-linkbutton',
                'data-options' => 'iconCls:\'icon-reload\''
            );
            $d['tutup'] = array(
                'name' => 'tutup',
                'id' => 'tutup',
                'type' => 'submit',
                'class' => 'easyui-linkbutton',
                'data-options' => 'iconCls:\'icon-close\''
            );

            $d['isi'] = $this->load->view('rekening_koran', $d, true);

            $this->load->view('media', $d);
        } else {
            redirect('/koperasi/logout/', 'refresh');
        }
    }
    public function cetak()
    {
        $cek = $this->session->userdata('logged_in');
        $level = $this->session->userdata('level');
        if (!empty($cek) && $level == 'admin') {
            $id = $this->input->get('nomor');
            $jenis = $this->input->get('jenis');
            $tgl_awal = $this->input->get('tgl_awal');
            $tgl_akhir = $this->input->get('tgl_akhir');
            $d['id'] = $id;
            $d['jenis'] = $jenis;
            $d['tgl_awal'] = $this->app_model->tgl_sql($tgl_awal);
            $d['tgl_akhir'] = $this->app_model->tgl_sql($tgl_akhir);

            $qs = "SELECT a.*,
            b.jenis_simpanan
            FROM simpanan as a
            JOIN jenis_simpan as b
            ON a.id_jenis=b.id_jenis
            WHERE a.noanggota='$id' && a.id_jenis='$jenis'
            ORDER BY a.tgl ASC";
            $d['dt_view_simpanan'] = $this->app_model->manualQuery($qs);

            $qp = "SELECT a.*,
            b.jenis_simpanan
            FROM pengambilan as a
            JOIN jenis_simpan as b
            ON a.id_jenis=b.id_jenis
            WHERE a.noanggota='$id' && a.id_jenis='$jenis'
            ORDER BY a.tgl ASC";
            $d['dt_view_pengambilan'] = $this->app_model->manualQuery($qp);

            $this->load->view('cetak-rekening_koran', $d);
        } else {
            redirect('/koperasi/logout/', 'refresh');
        }
    }
    public function CariData()
    {
        $cek = $this->session->userdata('logged_in');
        $level = $this->session->userdata('level');
        if (!empty($cek) && $level == 'admin') {
            $id = $this->input->post('nomor');
            $jenis = $this->input->post('jenis');
            $tgl_awal = $this->input->post('tgl_awal');
            $tgl_akhir = $this->input->post('tgl_akhir');
            $d['tgl_awal'] = $this->app_model->tgl_sql($tgl_awal);
            $d['tgl_akhir'] = $this->app_model->tgl_sql($tgl_akhir);

            $qs = "SELECT a.*,
            b.jenis_simpanan
            FROM simpanan as a
            JOIN jenis_simpan as b
            ON a.id_jenis=b.id_jenis
            WHERE a.noanggota='$id' && a.id_jenis='$jenis'
            ORDER BY a.tgl ASC";
            $hasils = $this->app_model->manualQuery($qs);

            $qp = "SELECT a.*,
            b.jenis_simpanan
            FROM pengambilan as a
            JOIN jenis_simpan as b
            ON a.id_jenis=b.id_jenis
            WHERE a.noanggota='$id' && a.id_jenis='$jenis'
            ORDER BY a.tgl ASC";
            $hasilp = $this->app_model->manualQuery($qp);

            $rows = $hasils->num_rows();
            $rowp = $hasilp->num_rows();
            if ($rows > 0 || $rowp > 0) {
                $data['info'] = true;
                echo json_encode($data);
            } else {
                $data['info'] = false;
                echo json_encode($data);
            }
        } else {
            redirect('/koperasi/logout/', 'refresh');
        }
    }
    public function view_rekening_koran()
    {
        $cek = $this->session->userdata('logged_in');
        $level = $this->session->userdata('level');
        if (!empty($cek) && $level == 'admin') {
            $id = $this->input->post('nomor');
            $jenis = $this->input->post('jenis');
            $tgl_awal = $this->input->post('tgl_awal');
            $tgl_akhir = $this->input->post('tgl_akhir');
            $d['tgl_awal'] = $this->app_model->tgl_sql($tgl_awal);
            $d['tgl_akhir'] = $this->app_model->tgl_sql($tgl_akhir);
            /*
            $saldo = 0;
            $dt1 = strtotime("2000-01-02");
            $dt2 = strtotime(date('Y-m-d'));
            $diff = abs($dt2 - $dt1);
            $jarak = $diff / 86400; // 86400 detik sehari
            $i = 0;
            */
            $text = "SELECT a.*,
					b.jenis_simpanan
					FROM simpanan as a
					JOIN jenis_simpan as b
					ON a.id_jenis=b.id_jenis
					WHERE a.noanggota='$id' && a.id_jenis='$jenis'
					ORDER BY a.tgl ASC";
            $d['dt_view_simpanan'] = $this->app_model->manualQuery($text);

            $text2 = "SELECT a.*,
					b.jenis_simpanan
					FROM pengambilan as a
					JOIN jenis_simpan as b
					ON a.id_jenis=b.id_jenis
					WHERE a.noanggota='$id' && a.id_jenis='$jenis'
					ORDER BY a.tgl ASC";
            $d['dt_view_pengambilan'] = $this->app_model->manualQuery($text2);

            /*while ($i <= $jarak) {
                $besok = date('Y-m-d', strtotime('+' . $i . ' day', strtotime($tgl_awal)));
                $i++;
                $qs = "SELECT a.*,
					b.jenis_simpanan
					FROM simpanan as a
					JOIN jenis_simpan as b
					ON a.id_jenis=b.id_jenis
					WHERE a.noanggota='$id' && a.id_jenis='$jenis' && a.tgl='$besok'
					ORDER BY a.tgl ASC";
                $res_s = $this->app_model->manualQuery($qs);
                if ($res_s->num_row() > 0) {
                    foreach ($res_s->result_array() as $ds) {
                        $d['saldo'] = $saldo + $ds['jumlah'];
                    }
                }

                $qp = "SELECT a.*,
					b.jenis_simpanan
					FROM pengambilan as a
					JOIN jenis_simpan as b
					ON a.id_jenis=b.id_jenis
					WHERE a.noanggota='$id' && a.id_jenis='$jenis' && a.tgl='$besok'
					ORDER BY a.tgl ASC";
                $res_p = $this->app_model->manualQuery($qp);
                if ($res_p->num_row() > 0) {
                    foreach ($res_p->result_array() as $dp) {
                        $d['saldo'] = $saldo - $dp['jumlah'];
                    }
                }
            }*/

            //$d['isi'] = $this->load->view('view_pengambilan', $d, true);
            $this->load->view('view_rekening_koran', $d);
            //$this->load->view('media',$d);
        } else {
            redirect('/koperasi/logout/', 'refresh');
        }
    }
}
