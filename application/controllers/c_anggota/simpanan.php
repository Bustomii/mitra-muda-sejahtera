<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Simpanan extends CI_Controller
{
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		if (!empty($cek)) {

			$d['judul'] = $this->config->item('judul');
			$d['nama_perusahaan'] = $this->app_model->Nama_Perusahaan();
			$d['alamat_perusahaan'] = $this->app_model->Alamat();
			$d['hp'] = $this->app_model->Hp();
			$d['lisensi'] = $this->config->item('lisensi_app');

			$d['jam_now'] = $this->app_model->Jam_Now();
			$d['hari_now'] = $this->app_model->Hari_Bulan_Indo();
			$d['tgl_now'] = $this->app_model->tgl_now_indo();

			$noanggota = $this->session->userdata('username');

			//paging
			$page = $this->uri->segment(3);
			$limit = $this->config->item('limit_data');
			if (!$page) :
				$offset = 0;
			else :
				$offset = $page;
			endif;

			$text = "SELECT a.noanggota,b.namaanggota
					FROM simpanan as a
					JOIN anggota as b
					ON a.noanggota=b.noanggota
					WHERE  a.noanggota='$noanggota'
					GROUP BY a.noanggota";
			$tot_hal = $this->app_model->manualQuery($text);

			$config['base_url'] = site_url() . '/simpanan/index/';
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

			$text = "SELECT a.id_simpanan,a.noanggota,
					sum(a.jumlah) as jumlah_simpanan,
					(select sum(jumlah) FROM pengambilan WHERE noanggota=a.noanggota) as jumlah_pengambilan,
					b.namaanggota,b.jk,b.noidentitas
					FROM simpanan as a
					JOIN anggota as b
					ON a.noanggota=b.noanggota
					WHERE  a.noanggota='$noanggota'
					GROUP BY a.noanggota
					LIMIT $limit OFFSET $offset";
			$d['dt_simpanan'] = $this->app_model->manualQuery($text);

			$d['isi'] = $this->load->view('v_anggota/simpanan', $d, true);

			$this->load->view('v_anggota/media', $d);
		} else {
			redirect('/c_anggota/home/logout/', 'refresh');
		}
	}

	public function detail()
	{
		$cek = $this->session->userdata('logged_in');
		if (!empty($cek)) {

			$d['judul'] = $this->config->item('judul');
			$d['nama_perusahaan'] = $this->config->item('nama_perusahaan');
			$d['alamat_perusahaan'] = $this->config->item('alamat_perusahaan');
			$d['lisensi'] = $this->config->item('lisensi_app');

			$d['jam_now'] = $this->app_model->Jam_Now();
			$d['hari_now'] = $this->app_model->Hari_Bulan_Indo();
			$d['tgl_now'] = $this->app_model->tgl_now_indo();

			$noanggota = $this->session->userdata('username');

			//paging
			$page = $this->uri->segment(4);
			$limit = $this->config->item('limit_data');
			if (!$page) :
				$offset = 0;
			else :
				$offset = $page;
			endif;

			$text = "SELECT noanggota,tgl,id_jenis,jumlah,'simpan' as ket FROM simpanan
					WHERE noanggota='$noanggota'
					UNION
					SELECT noanggota,tgl,id_jenis,jumlah,'ambil' as ket FROM `pengambilan`
					WHERE noanggota='$noanggota'
					ORDER BY tgl";
			$tot_hal = $this->app_model->manualQuery($text);

			$config['base_url'] = site_url() . '/simpanan/detail/';
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

			$text = "SELECT noanggota,tgl,id_jenis,jumlah,'simpan' as ket FROM simpanan
					WHERE noanggota='$noanggota'
					UNION
					SELECT noanggota,tgl,id_jenis,jumlah,'ambil' as ket FROM `pengambilan`
					WHERE noanggota='$noanggota'
					ORDER BY tgl
					LIMIT $limit OFFSET $offset";
			$d['dt_simpanan'] = $this->app_model->manualQuery($text);

			$d['jenis_simpan'] = $this->db->query("SELECT * FROM jenis_simpan");
			$d['isi'] = $this->load->view('v_anggota/detail_simpanan', $d, true);

			$this->load->view('v_anggota/media', $d);
		} else {
			redirect('/c_anggota/home/logout/', 'refresh');
		}
	}

	public function cari_detail()
	{
		$cek = $this->session->userdata('logged_in');
		if (!empty($cek)) {

			$d['judul'] = $this->config->item('judul');
			$d['nama_perusahaan'] = $this->config->item('nama_perusahaan');
			$d['alamat_perusahaan'] = $this->config->item('alamat_perusahaan');
			$d['lisensi'] = $this->config->item('lisensi_app');

			$d['jam_now'] = $this->app_model->Jam_Now();
			$d['hari_now'] = $this->app_model->Hari_Bulan_Indo();
			$d['tgl_now'] = $this->app_model->tgl_now_indo();

			$noanggota = $this->session->userdata('username');
			$jenis = $this->input->post('jenis');

			if (!empty($jenis)) {
				$and = " AND id_jenis='$jenis' ";
			} else {
				$and = " ";
			}
			//paging
			$page = $this->uri->segment(4);
			$limit = $this->config->item('limit_data');
			if (!$page) :
				$offset = 0;
			else :
				$offset = $page;
			endif;

			$text = "SELECT noanggota,tgl,id_jenis,jumlah,'simpan' as ket FROM simpanan
					WHERE noanggota='$noanggota' $and
					UNION
					SELECT noanggota,tgl,id_jenis,jumlah,'ambil' as ket FROM `pengambilan`
					WHERE noanggota='$noanggota' $and
					ORDER BY tgl";
			$tot_hal = $this->app_model->manualQuery($text);

			$config['base_url'] = site_url() . '/simpanan/detail/';
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

			$text = "SELECT noanggota,tgl,id_jenis,jumlah,'simpan' as ket FROM simpanan
					WHERE noanggota='$noanggota' $and
					UNION
					SELECT noanggota,tgl,id_jenis,jumlah,'ambil' as ket FROM `pengambilan`
					WHERE noanggota='$noanggota' $and
					ORDER BY tgl
					LIMIT $limit OFFSET $offset";
			$d['dt_simpanan'] = $this->app_model->manualQuery($text);

			$d['jenis_simpan'] = $this->db->query("SELECT * FROM jenis_simpan");
			$d['isi'] = $this->load->view('v_anggota/detail_simpanan', $d, true);

			//echo $text;
			$this->load->view('v_anggota/media', $d);
		} else {
			redirect('/c_anggota/home/logout/', 'refresh');
		}
	}
}

/* End of file anggota.php */
/* Location: ./application/controllers/anggota.php */
