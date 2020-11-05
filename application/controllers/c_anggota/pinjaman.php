<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pinjaman extends CI_Controller
{
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		if (!empty($cek)) {
			$id = $this->session->userdata('username');

			$d['judul'] = $this->config->item('judul');
			$d['nama_perusahaan'] = $this->app_model->Nama_Perusahaan();
			$d['alamat_perusahaan'] = $this->app_model->Alamat();
			$d['hp'] = $this->app_model->Hp();
			$d['lisensi'] = $this->config->item('lisensi_app');

			$d['jam_now'] = $this->app_model->Jam_Now();
			$d['hari_now'] = $this->app_model->Hari_Bulan_Indo();
			$d['tgl_now'] = $this->app_model->tgl_now_indo();


			//paging
			$page = $this->uri->segment(3);
			$limit = $this->config->item('limit_data');
			if (!$page) :
				$offset = 0;
			else :
				$offset = $page;
			endif;

			$text = "SELECT a.id_pinjam,a.noanggota,
					b.namaanggota
					FROM pinjaman_header as a
					JOIN anggota as b
					ON a.noanggota=b.noanggota
					WHERE a.noanggota ='$id'
					GROUP BY a.id_pinjam";
			$tot_hal = $this->app_model->manualQuery($text);

			$config['base_url'] = site_url() . '/pinjaman/index/';
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

			$text = "SELECT a.id_pinjam,a.tgl,a.noanggota,a.jumlah,a.lama,a.bunga,					
					b.namaanggota,b.jk,b.noidentitas
					FROM pinjaman_header as a
					JOIN anggota as b
					ON a.noanggota=b.noanggota
					WHERE a.noanggota='$id'
					GROUP BY a.id_pinjam
					LIMIT $limit OFFSET $offset";
			$d['dt_pinjaman'] = $this->app_model->manualQuery($text);

			$d['isi'] = $this->load->view('v_anggota/pinjaman', $d, true);

			$this->load->view('v_anggota/media', $d);
		} else {
			redirect('/c_anggota/home/logout/', 'refresh');
		}
	}
}

/* End of file anggota.php */
/* Location: ./application/controllers/anggota.php */
