<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Jenis extends CI_Controller
{
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$akses = $this->session->userdata('akses');
		if (!empty($cek) && $level == 'admin' && $akses == 'super admin') {
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
			$d['id_jenis'] = array(
				'name' => 'id_jenis',
				'id' => 'id_jenis',
				'type' => 'text',
				'class' => 'easyui-validatebox',
				'size' => '10',
				'maxlength' => '10',
				'readonly' => true
			);
			$d['jenis'] = array(
				'name' => 'jenis',
				'id' => 'jenis',
				'type' => 'text',
				'class' => 'easyui-validatebox',
				'size' => '30',
				'maxlength' => '30',
				'data-options' => 'required:true,validType:\'length[1,50]\''
			);
			$d['jumlah'] = array(
				'name' => 'jumlah',
				'id' => 'jumlah',
				'type' => 'text',
				'size' => '20',
				'maxlength' => '20'
			);

			$d['kontrol_simpanan'] = array(
				'name' => 'kontrol_simpanan',
				'id' => 'kontrol_simpanan',
				'class' => 'easyui-checkbox'
			);
			$d['kontrol_penarikan'] = array(
				'name' => 'kontrol_penarikan',
				'id' => 'kontrol_penarikan',
				'class' => 'easyui-checkbox'
			);
			$d['kontrol_laporan'] = array(
				'name' => 'kontrol_laporan',
				'id' => 'kontrol_laporan',
				'class' => 'easyui-checkbox'
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

			//paging
			$page = $this->uri->segment(3);
			$limit = $this->config->item('limit_data');
			if (!$page) :
				$offset = 0;
			else :
				$offset = $page;
			endif;

			if (!empty($id)) {
				//$tot_hal = $this->app_model->getQueryData("jenis_simpan",$id);
				$text = "SELECT * FROM jenis_simpan WHERE jenis_simpanan LIKE '%" . $id . "%'";
				$tot_hal = $this->app_model->manualQuery($text);
			} else {
				$tot_hal = $this->app_model->getAllData("jenis_simpan");
			}
			$config['base_url'] = site_url() . '/jenis/index/';
			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			$config['first_link'] = 'Awal';
			$config['last_link'] = 'Akhir';
			$config['next_link'] = 'Selanjutnya';
			$config['prev_link'] = 'Sebelumnya';
			$this->pagination->initialize($config);
			$d["paginator"] = $this->pagination->create_links();
			$d['hal'] = $offset;

			if (!empty($id)) {
				//$d['dt_jenis'] = $this->app_model->getQueryDataLimited("jenis_simpan",$id,$limit,$offset);
				$text = "SELECT * FROM jenis_simpan WHERE jenis_simpanan LIKE '%" . $id . "%' LIMIT $limit OFFSET $offset";
				$d['dt_jenis'] = $this->app_model->manualQuery($text);
			} else {
				$d['dt_jenis'] = $this->app_model->getAllDataLimited("jenis_simpan", $limit, $offset);
			}

			$d['isi'] = $this->load->view('jenis', $d, true);

			$this->load->view('media', $d);
		} else {
			redirect('/koperasi/logout/', 'refresh');
		}
	}

	public function CariKode()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$akses = $this->session->userdata('akses');
		if (!empty($cek) && $level == 'admin' && $akses == 'super admin') {
			$data['id_jenis'] = $this->app_model->getMaxKodeJenis();
			echo json_encode($data);
		} else {
			redirect('/koperasi/logout/', 'refresh');
		}
	}

	public function simpan()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$akses = $this->session->userdata('akses');
		if (!empty($cek) && $level == 'admin' && $akses == 'super admin') {
			$up['id_jenis'] = $this->input->post('id_jenis');
			$up['jenis_simpanan'] = $this->input->post('jenis');
			$up['jumlah'] = str_replace(",", "", $this->input->post('jumlah'));
			$up['kontrol_simpanan'] = $this->input->post('kontrol_simpanan');
			$up['kontrol_penarikan'] = $this->input->post('kontrol_penarikan');
			$up['kontrol_laporan'] = $this->input->post('kontrol_laporan');
			$id['id_jenis'] = $this->input->post('id_jenis');

			$hasil = $this->app_model->getSelectedData("jenis_simpan", $id);
			$row = $hasil->num_rows();
			if ($row > 0) {
				$this->app_model->updateData("jenis_simpan", $up, $id);
				echo "Data sukses diubah";
			} else {
				$this->app_model->insertData("jenis_simpan", $up);
				echo "Data sukses disimpan";
			}
		} else {
			redirect('/koperasi/logout/', 'refresh');
		}
	}

	public function cari()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$akses = $this->session->userdata('akses');
		if (!empty($cek) && $level == 'admin' && $akses == 'super admin') {
			$id['id_jenis'] = $this->input->post('cari');

			$hasil = $this->app_model->getSelectedData("jenis_simpan", $id);
			$row = $hasil->num_rows();
			if ($row > 0) {
				foreach ($hasil->result() as $db) {
					$data['jenis'] = $db->jenis_simpanan;
					$data['jumlah'] = $db->jumlah;
					$data['kontrol_simpanan'] = $db->kontrol_simpanan;
					$data['kontrol_penarikan'] = $db->kontrol_penarikan;
					$data['kontrol_laporan'] = $db->kontrol_laporan;
					echo json_encode($data);
				}
			} else {
				$data['jenis'] = '';
				$data['jumlah'] = '';
				$data['kontrol_simpanan'] = '';
				$data['kontrol_penarikan'] = '';
				$data['kontrol_laporan'] = '';
				echo json_encode($data);
			}
		} else {
			redirect('/koperasi/logout/', 'refresh');
		}
	}

	public function hapus()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$akses = $this->session->userdata('akses');
		if (!empty($cek) && $level == 'admin' && $akses == 'super admin') {
			$id['id_jenis'] = $this->input->post('id');

			$hasil = $this->app_model->getSelectedData("jenis_simpan", $id);
			$row = $hasil->num_rows();
			if ($row > 0) {
				$this->app_model->deleteData("jenis_simpan", $id);
				echo "Data sukses dihapus";
			} else {
				echo "Tidak ada data yang dihapus";
			}
		} else {
			redirect('/koperasi/logout/', 'refresh');
		}
	}
}

/* End of file jenis.php */
/* Location: ./application/controllers/jenis.php */
