<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Chart_simpanan extends CI_Controller
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

			/*
			$text = "SELECT month(tgl) as bulan, sum(jumlah) as total FROM simpanan GROUP BY month(tgl)";
			$d['data'] = $this->app_model->manualQuery($text);
			*/
			/*
			for($a=1 ; $a<=12; $a++){
				$total = $this->app_model->chart_simpanan($a);
				//$data[$a]= $total;
				$d['data']= $total;
			}
			*/
			$d['isi'] = $this->load->view('chart_simpanan', $d, true);

			$this->load->view('media', $d);
		} else {
			redirect('/koperasi/logout/', 'refresh');
		}
	}
}

/* End of file anggota.php */
/* Location: ./application/controllers/anggota.php */
