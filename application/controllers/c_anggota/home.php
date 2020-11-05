<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
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

			$d['isi'] = $this->load->view('v_anggota/home', $d, true);

			$this->load->view('v_anggota/media', $d);
		} else {
			redirect('/c_anggota/home/logout/', 'refresh');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		//header('location:'.base_url());
		redirect('/koperasi/', 'refresh');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/hone.php */
