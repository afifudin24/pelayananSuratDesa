<?php
class SuratDomisili extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->model('Administrator/M_verifikasi');
		$this->load->model('Administrator/M_qr');
		$this->load->model('M_cetak');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		$data = array(
			'title' => 'Verifikasi Surat Domisili',
			'datas'  => $this->M_verifikasi->getSkd()
		);

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('administrator/verifikasi/surat_domisili/surat_domisili', $data);
		$this->load->view('layout/footer');
	}

	public function listcetak(){

		$data = array(
			'title' => 'Cetak Surat Domisili',
			'datas' => $this->M_cetak->getcetakskd()
		);
		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('administrator/verifikasi/surat_domisili/surat_domisili', $data);
		$this->load->view('layout/footer');
	}

	

	public function skdverif()
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
			$this->M_verifikasi->skdverif($data, $id);
			$this->M_qr->generateqr($id, 'skd');
			$this->session->set_flashdata('success', 'Status berhasil di update !');
			redirect('verifikasi-surat-domisili', 'refresh');
		} else if ($status == 'Ditolak') {
			$data = array(
				'id_warga'  => $id_warga,
				'status'    => $status,
				'notifikasi'  => 0,
				'updated_at'  => date('d-m-Y H:i:s')
			);
			$this->M_verifikasi->skdverif($data, $id);
			
			$this->session->set_flashdata('success', 'Status berhasil di update !');
			redirect('verifikasi-surat-domisili', 'refresh');
		} else {
			$data = array(
				'id_warga'  => $id_warga,
				'status'    => $status,
				'notifikasi'  => 0,
				'updated_at'  => date('d-m-Y H:i:s')
			);
			$this->M_verifikasi->skdverif($data, $id);
			$this->session->set_flashdata('success', 'Status berhasil di update !');
			redirect('verifikasi-surat-domisili', 'refresh');
		}
	}

	public function skdkomentar($id)
	{
		$komentar = $this->input->post('komentar');

		$data = array(
			'komentar' => $komentar
		);
		$this->M_verifikasi->komentarskd($data, $id);
		$this->session->set_flashdata('success', 'Status berhasil di simpan !');
		redirect('verifikasi-surat-domisili', 'refresh');
	}

	public function preview($id)
	{
		$data = array(
			'title' => 'Preview Surat Domisili',
			'datas'  => $this->M_verifikasi->getPreviewSkd($id)
		);

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('administrator/verifikasi/surat_domisili/preview', $data);
		$this->load->view('layout/footer');
	}

	public function hapus($id)
	{
		$this->M_verifikasi->hDomisili($id);
		$this->session->set_flashdata('success', 'Data berhasil di hapus !');
		redirect('verifikasi-surat-domisili', 'refresh');
	}
}
