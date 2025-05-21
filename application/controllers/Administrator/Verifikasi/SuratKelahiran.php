<?php
class SuratKelahiran extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Administrator/M_verifikasi');
		$this->load->model('Administrator/M_qr');
	}


	public function index()
	{
		$data = array(
			'title' => 'Verifikasi Surat Kelahiran',
			'datas'  => $this->M_verifikasi->getSpak()
		);

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('administrator/verifikasi/surat_kelahiran/surat_kelahiran', $data);
		$this->load->view('layout/footer');
	}

	public function spakverif()
{
    $id = $this->input->post('id');
    $id_warga = $this->input->post('id_warga');
    $status = $this->input->post('status');
    $data = array(
        'id_warga' => $id_warga,
        'status' => $status,
        'notifikasi' => ($status == 'Diterima') ? 1 : 0,
        'updated_at' => date('d-m-Y H:i:s')
    );
    if ($status == 'Diterima') {
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
		$this->M_qr->generateqr($id, 'spak');
    }
    $this->M_verifikasi->spakverif($data, $id);
    $this->session->set_flashdata('success', 'Status berhasil di update !');
    redirect('verifikasi-surat-kelahiran', 'refresh');
}

	public function spakkomentar($id)
	{
		$komentar = $this->input->post('komentar');

		$data = array(
			'komentar' => $komentar
		);
		$this->M_verifikasi->komentarspak($data, $id);
		$this->session->set_flashdata('success', 'Status berhasil di simpan !');
		redirect('verifikasi-surat-kelahiran', 'refresh');
	}

	public function preview($id)
	{
		$data = array(
			'title' => 'Preview Surat Kelahiran',
			'datas'  => $this->M_verifikasi->getPreviewSpak($id)
		);

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('administrator/verifikasi/surat_kelahiran/preview', $data);
		$this->load->view('layout/footer');
	}

	public function hapus($id)
	{
		$this->M_verifikasi->hKelahiran($id);
		$this->session->set_flashdata('success', 'Data berhasil di hapus !');
		redirect('verifikasi-surat-kelahiran', 'refresh');
	}
}
