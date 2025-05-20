<?php
class SuratKeramaian extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Administrator/M_verifikasi');
	}


	public function index()
	{
		$data = array(
			'title' => 'Verifikasi Surat Keramaian',
			'datas' => $this->M_verifikasi->getSkrm()
		);

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('administrator/verifikasi/skrm/surat_keramaian', $data);
		$this->load->view('layout/footer');
	}

	public function skrmverif()
	{
		$id = $this->input->post('id');
		$id_warga = $this->input->post('id_warga');
		$status = $this->input->post('status');

		if ($status == 'Diterima') {
			$data = array(
				'id_warga' => $id_warga,
				'status' => $status,
				'notifikasi' => 1,
				'updated_at' => date('d-m-Y H:i:s')
			);
			$this->M_verifikasi->skrmverif($data, $id);
			$this->session->set_flashdata('success', 'Status berhasil di update !');
			redirect('verifikasi-surat-keramaian', 'refresh');
		} else if ($status == 'Ditolak') {
			$data = array(
				'id_warga' => $id_warga,
				'status' => $status,
				'notifikasi' => 0,
				'updated_at' => date('d-m-Y H:i:s')
			);
			$this->M_verifikasi->skrmverif($data, $id);
			$this->session->set_flashdata('success', 'Status berhasil di update !');
			redirect('verifikasi-surat-keramaian', 'refresh');
		} else {
			$data = array(
				'id_warga' => $id_warga,
				'status' => $status,
				'notifikasi' => 0,
				'updated_at' => date('d-m-Y H:i:s')
			);
			$this->M_verifikasi->skrmverif($data, $id);
			$this->session->set_flashdata('success', 'Status berhasil di update !');
			redirect('verifikasi-surat-keramaian', 'refresh');
		}
	}

	public function skrmkomentar($id)
	{
		$komentar = $this->input->post('komentar');

		$data = array(
			'komentar' => $komentar
		);
		$this->M_verifikasi->komentarskrm($data, $id);
		$this->session->set_flashdata('success', 'Status berhasil di simpan !');
		redirect('verifikasi-surat-keramaian', 'refresh');
	}

	public function preview($id)
	{
		$data = array(
			'title' => 'Preview Surat Keramaian',
			'datas' => $this->M_verifikasi->getPreviewSkrm($id)
		);

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('administrator/verifikasi/skrm/preview', $data);
		$this->load->view('layout/footer');
	}

	public function hapus($id)
	{
		$this->M_verifikasi->hKeramaian($id);
		$this->session->set_flashdata('success', 'Data berhasil di hapus !');
		redirect('verifikasi-surat-keramaian', 'refresh');
	}
}
