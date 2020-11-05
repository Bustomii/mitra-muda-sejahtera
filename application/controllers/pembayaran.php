<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pembayaran extends CI_Controller
{
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if (!empty($cek) && $level == 'admin') {
			$id = $this->input->post('cari');

			$d['judul'] = $this->config->item('judul');
			$d['nama_perusahaan'] = $this->app_model->Nama_Perusahaan();
			$d['alamat_perusahaan'] = $this->app_model->Alamat();
			$d['hp'] = $this->app_model->Hp();
			$d['lisensi'] = $this->config->item('lisensi_app');

			$d['jam_now'] = $this->app_model->Jam_Now();
			$d['hari_now'] = $this->app_model->Hari_Bulan_Indo();
			$d['tgl_now'] = $this->app_model->tgl_now_indo();

			//inputan
			$d['nomor'] = array(
				'name' => 'nomor',
				'id' => 'nomor',
				'type' => 'text',
				'class' => 'easyui-validatebox',
				'size' => '10',
				'maxlength' => '10',
				'readonly' => true
			);
			$d['tgl'] = array(
				'name' => 'tgl',
				'id' => 'tgl',
				'type' => 'text',
				'size' => '12',
				'maxlength' => '12'
			);
			$d['anggota'] = array(
				'name' => 'anggota',
				'id' => 'anggota',
				'type' => 'text',
				'class' => 'easyui-validatebox',
				'size' => '12',
				'maxlength' => '12',
				'data-options' => 'required:true,validType:\'length[1,20]\''
			);
			$d['lama'] = array(
				'name' => 'lama',
				'id' => 'lama',
				'type' => 'text',
				'size' => '12',
				'maxlength' => '12',
				'disabled' => true
			);

			/*
			$jenis = $this->app_model->manualQuery("SELECT id_jenis,jenis_simpanan FROM jenis_simpan");
			$d['opt_jenis'][''] = '-Pilih-';
			foreach($jenis->result() as $db){
				$d['opt_jenis'][$db->id_jenis] = $db->jenis_simpanan;
			}
			*/
			$d['bunga'] = array(
				'name' => 'bunga',
				'id' => 'bunga',
				'type' => 'text',
				'size' => '5',
				'maxlength' => '5',
				'disabled' => true
			);
			$d['jumlah'] = array(
				'name' => 'jumlah',
				'id' => 'jumlah',
				'type' => 'text',
				'size' => '20',
				'maxlength' => '20',
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
				'size' => '50',
				'maxlength' => '50',
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
			$d['sisa_angsuran'] = array(
				'name' => 'sisa_angsuran',
				'id' => 'sisa_angsuran',
				'type' => 'text',
				'size' => '20',
				'maxlength' => '20',
				'disabled' => true
			);
			$d['angsuran'] = array(
				'name' => 'angsuran',
				'id' => 'angsuran',
				'type' => 'text',
				'size' => '20',
				'maxlength' => '20',
				'disabled' => true
			);

			//tombol bawah
			$d['simpan'] = array(
				'name' => 'simpan',
				'id' => 'simpan',
				'type' => 'submit',
				'class' => 'easyui-linkbutton',
				'data-options' => 'iconCls:\'icon-save\''
			);
			$d['cetak'] = array(
				'name' => 'cetak',
				'id' => 'cetak',
				'type' => 'submit',
				'class' => 'easyui-linkbutton',
				'data-options' => 'iconCls:\'icon-print\''
			);
			$d['kosong'] = array(
				'name' => 'kosong',
				'id' => 'kosong',
				'type' => 'submit',
				'class' => 'easyui-linkbutton',
				'data-options' => 'iconCls:\'icon-new\''
			);
			$d['tutup'] = array(
				'name' => 'tutup',
				'id' => 'tutup',
				'type' => 'submit',
				'class' => 'easyui-linkbutton',
				'data-options' => 'iconCls:\'icon-close\''
			);

			//tombol proses
			$d['cari'] = array(
				'name' => 'cari',
				'id' => 'cari',
				'type' => 'text',
				'size' => '50',
				'maxlength' => '50',
				'value' => $id,
				'placeholder' => 'Masukkan text.....'
			);
			$d['tambah'] = array(
				'name' => 'tambah',
				'id' => 'tambah',
				'type' => 'submit',
				'class' => 'easyui-linkbutton',
				'data-options' => 'iconCls:\'icon-add\''
			);
			$d['refresh'] = array(
				'name' => 'refresh',
				'id' => 'refresh',
				'type' => 'submit',
				'class' => 'easyui-linkbutton',
				'data-options' => 'iconCls:\'icon-reload\''
			);


			$d['isi'] = $this->load->view('pembayaran', $d, true);

			$this->load->view('media', $d);
		} else {
			redirect('/koperasi/logout/', 'refresh');
		}
	}


	public function simpan()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if (!empty($cek) && $level == 'admin') {
			$tgl = $this->input->post('tgl');
			$exp = explode("/", $this->input->post('angsuran'));
			$cicilan = $exp[0];
			$jumlah = str_replace(",", "", $exp[1]);

			$up['id_pinjam'] = $this->input->post('nomor');
			$up['tgl_bayar'] = $this->app_model->tgl_sql($tgl);
			$up['jumlah_bayar'] = $jumlah;

			$id['id_pinjam'] = $this->input->post('nomor');
			$id['cicilan'] = $cicilan;
			$hasil = $this->app_model->getSelectedData("pinjaman_detail", $id);
			$row = $hasil->num_rows();
			if ($row >= 0) {
				$this->app_model->updateData("pinjaman_detail", $up, $id);
				echo "Data sukses diupdate";
			} else {
				echo "Data sudah ada!!!";
			}
		} else {
			redirect('/koperasi/logout/', 'refresh');
		}
	}


	public function view_bayar()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if (!empty($cek) && $level == 'admin') {
			$id = $this->input->post('nomor');

			$text = "SELECT *
					FROM pinjaman_detail 
					WHERE id_pinjam='$id'
					ORDER BY cicilan";
			$d['dt_view_pinjaman'] = $this->app_model->manualQuery($text);

			$this->load->view('view_pembayaran', $d);
		} else {
			redirect('/koperasi/logout/', 'refresh');
		}
	}
	public function cetak()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if (!empty($cek) && $level == 'admin') {
			$id = $this->uri->segment(3); // $this->input->get('id');

			$text = "SELECT *
					FROM pinjaman_header as a
					JOIN pinjaman_detail as b
					JOIN anggota as c
					ON a.id_pinjam=b.id_pinjam AND a.noanggota=c.noanggota
					WHERE a.id_pinjam='$id'";

			//$hasil = $this->app_model->getSelectedData("anggota",$id);

			$hasil = $this->app_model->manualQuery($text);
			$row = $hasil->num_rows();
			if ($row > 0) {
				foreach ($hasil->result() as $db) {
					$d['kode'] = $id;
					$d['tgl'] = $this->app_model->tgl_str($db->tgl);
					$d['identitas'] = $db->noidentitas;
					$d['noanggota'] = $db->noanggota;
					$d['nama'] = $db->namaanggota;
					$d['alamat'] = $db->alamat;
					//$d['jenis'] = $db->jenis_simpanan;
					$d['jumlah'] = number_format($db->jumlah);
					//$d['terbilang'] = $this->app_model->terbilang($db->jumlah,4);
				}
			}
			//$d['kode'] = $id;

			$this->load->view('cetak-pembayaran', $d);
			//echo $text;

		} else {
			redirect('/koperasi/logout/', 'refresh');
		}
	}

	public function CariData()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if (!empty($cek) && $level == 'admin') {
			$id['id_pinjam'] = $this->input->post('id');

			$hasil = $this->app_model->getSelectedData("pinjaman_header", $id);
			$row = $hasil->num_rows();
			if ($row > 0) {
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
}

/* End of file anggota.php */
/* Location: ./application/controllers/anggota.php */
