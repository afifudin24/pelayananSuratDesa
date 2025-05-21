<?php
class SuratKelahiran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_surat'); 
    }
   public function custom_decode($encoded, $key = 7) {
    $chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $base = strlen($chars);
    $number = 0;

    for ($i = 0; $i < strlen($encoded); $i++) {
        $number = $number * $base + strpos($chars, $encoded[$i]);
    }

    return intdiv(($number - $key), $key); // Reverse the obfuscation
}


   public function verifikasi($id)
{
    $iddecode = $this->custom_decode($id);
    $surat = $this->M_surat->get_spak($iddecode);
    if (!$surat) {
        show_error('Surat tidak ditemukan.');
    }
    $dataToVerify = (string)$surat['id'] ; 
    $hash = hash('sha256', $dataToVerify);
    // Load public key
    $publicKeyPath = APPPATH . 'key/public.pem';
    if (!file_exists($publicKeyPath)) {
        show_error('Public key tidak ditemukan.');
    }
    $publicKey = file_get_contents($publicKeyPath);
    // Decode digital signature
    $signature = base64_decode($surat['digital_signature']);
    // Verify
    $isValid = openssl_verify($hash, $signature, $publicKey, OPENSSL_ALGO_SHA256);
    $status = ($isValid === 1) ? '✅ Surat ASLI (Terverifikasi)' : '❌ Surat PALSU / Tidak valid';
    // Display view
    $this->load->view('warga/verifikasi_surat', [
        'surat' => $surat,
        'status' => $status
    ]);
}

}