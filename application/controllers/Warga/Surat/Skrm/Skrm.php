<?php
class Skrm extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_login();
		$this->load->Model('M_getData');
		$this->load->Model('M_surat');
	}

	public function index()
	{
		$data = array(
			'title' => 'Surat Keramaian',
			'data' => $this->M_getData->getDataId()
		);

		$this->load->view('layout/header', $data);
		$this->load->view('layout/sidebar', $data);
		$this->load->view('warga/surat/skrm/create', $data);
		$this->load->view('layout/footer', $data);
	}

	public function create()
	{
		$this->form_validation->set_rules('jenis_acara', 'Acara', 'required', array(
			'required' => 'Jenis acara harus diisi!'
		));

		$this->form_validation->set_rules('tanggal_acara', 'Tanggal Acara', 'required', array(
			'required' => 'Tanggal acara harus diisi!'
		));

		$this->form_validation->set_rules('kuantitas', 'Kuantitas Warga', 'required|numeric', array(
			'required' => 'Kuantitas warga harus diisi!',
			'numeric' => 'Kuantitas warga harus berupa angka!'
		));

		$this->form_validation->set_rules('waktu_mulai', 'Waktu Mulai', 'required', array(
			'required' => 'Waktu mulai harus diisi!'
		));

		$this->form_validation->set_rules('waktu_selesai', 'Waktu Selesai', 'required', array(
			'required' => 'Waktu selesai harus diisi!'
		));

		$this->form_validation->set_rules('menutup_jalan', 'Menutup Jalan', 'required', array(
			'required' => 'Pilihan apakah acara menutup jalan harus dipilih!'
		));

		$cek = $this->M_surat->cek_skrm();

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Data tidak lengkap !');
			$this->index();
		} else {

			if ($cek) {
				$this->session->set_flashdata('error', 'Maaf, anda tidak dapat melakukan permohonan surat <span class="font-bold">SKTM</span> karena masih ada yang belum terverivikasi !');
				redirect('list-surat', 'refresh');
			} else {

				$acara = $this->input->post('jenis_acara');
				$tanggal_acara = $this->input->post('tanggal_acara');
				$waktu_mulai = $this->input->post('waktu_mulai');
				$waktu_selesai = $this->input->post('waktu_selesai');
				$kuantitas = $this->input->post('kuantitas');
				$menutup_jalan = $this->input->post('menutup_jalan');

				$file_ktp = $_FILES['file_ktp']['name'];


				$date = date('Ymd-is');
				$d2 = trim($date);

				//acak nama gambar
				$extensi1 = explode('.', $file_ktp);
				$extensi = strtolower(end($extensi1));
				$acak_angka = rand(1, 999);
				$filektp = str_replace('', '', 'skrm-id-' . $this->session->userdata('id_warga') . '-tgl' . $d2 . '-' . $acak_angka . '.' . $extensi);



				if ($file_ktp == '') {
					$this->session->set_flashdata('error', 'File tidak lengkap !');
					redirect('skrm/create', 'refresh');
				} else {
					$noid = $this->M_getData->getSkrmId();
					$nomor = sprintf("%03s", abs(floatval($noid['id']) + 1)) . '/' . 'SKRM' . '/' . date('m') . '/' . date('Y');
					$data = array(
						'id_warga' => $this->session->userdata('id_warga'),
						'jenis_surat' => 'SURAT IZIN KERAMAIAN',
						'nomor_surat' => $nomor,
						'tanggal_surat' => date('d/m/Y'),
						'tanggal_kadaluarsa' => date('d/m/Y', strtotime('+1 month')),
						'jenis_acara' => $acara,
						'tanggal_acara' => $tanggal_acara,
						'waktu_mulai' => $waktu_mulai,
						'waktu_selesai' => $waktu_selesai,
						'kuantitas' => $kuantitas,
						'menutup_jalan' => $menutup_jalan,
						'file_ktp' => $filektp,
						'status' => 'Menunggu Verifikasi',
						'created_at' => date('Y-m-d H:i:s')
					);



					$config['upload_path'] = './assets/file_ktp/'; //folder penyimpanana gambar
					$config['file_name'] = $filektp;
					$config['allowed_types'] = 'jpeg|png|jpg|JPEG|PNG|JPG';
					$config['max_size'] = '3024';
					$config['remove_space'] = TRUE;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if (!$this->upload->do_upload('file_ktp')) {
						$this->session->set_flashdata('danger', $this->upload->display_errors());

						redirect('skrm/buat-surat', 'refresh');
					} else {
						$this->upload->data();
					}



					$this->M_surat->skrm($data);
					$this->session->set_flashdata('success', 'Permohonan surat berhasil dibuat !');
					redirect('list-surat', 'refresh');
				}
			}
		}
	}
}
