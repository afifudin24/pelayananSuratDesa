<?php
class SuratKematian extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('Administrator/M_verifikasi');
		$this->load->model('Administrator/M_qr');
		$this->load->model('M_cetak');
	}


	public function index()
	{
		$data = array(
			'title' => 'Verifikasi Surat Keterangan Kematian',
			'datas'  => $this->M_verifikasi->getSkk()
		);

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('administrator/verifikasi/skk/surat_kematian', $data);
		$this->load->view('layout/footer');
	}
	public function listcetak(){

		$data = array(
			'title' => 'Cetak Surat Keterangan Kematian',
			'datas' => $this->M_cetak->getcetakskk()
		);
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('administrator/verifikasi/skk/surat_kematian', $data);
		$this->load->view('layout/footer');
	}

	public function skkverif()
	{
		$id =  $this->input->post('id');
		$id_warga = $this->input->post('id_warga');
		$status = $this->input->post('status');

		if ($status == 'Diterima') {
			$data = array(
				'id_warga'  => $id_warga,
				'status'    => $status,
				'notifikasi'  => 1,
				'updated_at'  => date('d-m-Y H:i:s')
			);
			  $dataToSignIn = (string)$id;
        $hash = hash('sha256', $dataToSignIn);
        
        // Load private key
        $privateKeyPath = APPPATH . 'key/private.pem';
        if (!file_exists($privateKeyPath)) {
            show_error('Private key tidak ditemukan.');
        }
        $privateKey = file_get_contents($privateKeyPath);
        // Create digital signature
        if (!openssl_sign($hash, $signature, $privateKey, OPENSSL_ALGO_SHA256)) {
            show_error('Gagal membuat signature.');
        }
        // Encode and save signature
        $encodedSignature = base64_encode($signature);
        $data['digital_signature'] = $encodedSignature;
		$this->M_qr->generateqr($id, 'skk');
			$this->M_verifikasi->skkverif($data, $id);
			$this->session->set_flashdata('success', 'Status berhasil di update !');
			redirect('verifikasi-surat-kematian', 'refresh');
		} else if ($status == 'Ditolak') {
			$data = array(
				'id_warga'  => $id_warga,
				'status'    => $status,
				'notifikasi'  => 0,
				'updated_at'  => date('d-m-Y H:i:s')
			);
			$this->M_verifikasi->skkverif($data, $id);
			$this->session->set_flashdata('success', 'Status berhasil di update !');
			redirect('verifikasi-surat-kematian', 'refresh');
		} else {
			$data = array(
				'id_warga'  => $id_warga,
				'status'    => $status,
				'notifikasi'  => 0,
				'updated_at'  => date('d-m-Y H:i:s')
			);
			$this->M_verifikasi->skkverif($data, $id);
			$this->session->set_flashdata('success', 'Status berhasil di update !');
			redirect('verifikasi-surat-kematian', 'refresh');
		}
	}

	public function skkkomentar($id)
	{
		$komentar = $this->input->post('komentar');

		$data = array(
			'komentar' => $komentar
		);
		$this->M_verifikasi->komentarskk($data, $id);
		$this->session->set_flashdata('success', 'Komentar berhasil di simpan !');
		redirect('verifikasi-surat-kematian', 'refresh');
	}

	public function preview($id)
	{
		$data = array(
			'title' => 'Preview Surat Kematian',
			'datas'  => $this->M_verifikasi->getPreviewSkk($id)
		);

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('administrator/verifikasi/skk/preview', $data);
		$this->load->view('layout/footer');
	}

	public function hapus($id)
	{
		$this->M_verifikasi->hKematian($id);
		$this->session->set_flashdata('success', 'Data berhasil di hapus !');
		redirect('verifikasi-surat-kematian', 'refresh');
	}
}
