<?php
class SuratKeteranganPengantar extends CI_Controller
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
			'title' => 'Verifikasi Surat Keterangan Pengantar',
			'datas' => $this->M_verifikasi->getSkp(),
		);

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('administrator/verifikasi/skp/keterangan_pengantar', $data);
		$this->load->view('layout/footer');
	}

	public function listcetak()
	{

		$data = array(
			'title' => 'Cetak Surat Keterangan Pengantar',
			'datas' => $this->M_cetak->getcetakskp()
		);

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('administrator/verifikasi/skp/keterangan_pengantar', $data);
		$this->load->view('layout/footer');
	}


	public function skpverif()
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
		$this->M_qr->generateqr($id, 'skp');
			$this->M_verifikasi->skpverif($data, $id);
			$this->session->set_flashdata('success', 'Status berhasil di update !');
			redirect('verifikasi-surat-keterangan-pengantar', 'refresh');
		} else if ($status == 'Ditolak') {
			$data = array(
				'id_warga'  => $id_warga,
				'status'    => $status,
				'notifikasi'  => 0,
				'updated_at'  => date('d-m-Y H:i:s')
			);
			$this->M_verifikasi->skpverif($data, $id);
			$this->session->set_flashdata('success', 'Status berhasil di update !');
			redirect('verifikasi-surat-keterangan-pengantar', 'refresh');
		} else {
			$data = array(
				'id_warga'  => $id_warga,
				'status'    => $status,
				'notifikasi'  => 0,
				'updated_at'  => date('d-m-Y H:i:s')
			);
			$this->M_verifikasi->skpverif($data, $id);
			$this->session->set_flashdata('success', 'Status berhasil di update !');
			redirect('verifikasi-surat-keterangan-pengantar', 'refresh');
		}
	}

	public function skpkomentar($id)
	{
		$komentar = $this->input->post('komentar');

		$data = array(
			'komentar' => $komentar
		);
		$this->M_verifikasi->komentarskp($data, $id);
		$this->session->set_flashdata('success', 'Komentar berhasil di simpan !');
		redirect('verifikasi-surat-keterangan-pengantar', 'refresh');
	}

	public function preview($id)
	{
		$data = array(
			'title' => 'Preview Surat Keterangan Pengantar',
			'datas'  => $this->M_verifikasi->getPreviewSkp($id)
		);

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('administrator/verifikasi/skp/preview', $data);
		$this->load->view('layout/footer');
	}

	public function hapus($id)
	{
		$this->M_verifikasi->hKeteranganP($id);
		$this->session->set_flashdata('session', 'Data berhasil di hapus !');
		redirect('verifikasi-surat-keterangan-pengantar', 'refresh');
	}
}
