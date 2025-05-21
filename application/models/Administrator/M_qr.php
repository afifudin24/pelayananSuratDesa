<?php
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
class M_qr extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
  public  function custom_encode($number, $key = 7) {
    $chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $base = strlen($chars);
    $encoded = '';

    $number = ($number * $key) + $key; // Simple obfuscation

    while ($number > 0) {
        $remainder = $number % $base;
        $encoded = $chars[$remainder] . $encoded;
        $number = intdiv($number, $base);
    }

    return $encoded;
}

    public function generateqr($id, $surat) {
        $idencode = $this->custom_encode($id);
        if ($surat == 'skrm') {
            $url = base_url("verifikasi/skrm/$idencode");
        }else if($surat == 'skd'){
            $url = base_url("verifikasi/skd/$idencode");
        }else if($surat == 'sktm'){
            $url = base_url("verifikasi/sktm/$idencode");
        }else if($surat == 'skk'){
            $url = base_url("verifikasi/skk/$idencode");
        }else if($surat == 'skp'){
            $url = base_url("verifikasi/skp/$idencode");
        }else if($surat == 'sku'){
            $url = base_url("verifikasi/sku/$idencode");
        }else if($surat == 'spak'){
            $url = base_url("verifikasi/spak/$idencode");
        }
        
  $this->load->library('ciqrcode'); // load library

        $params['data'] = $url;
        $params['level'] = 'H'; // High error correction
        $params['size'] = 10;
        $params['savename'] = FCPATH . 'uploads/qrcode/'. $surat. '/qr_surat_' . $id . '.png';

        $this->ciqrcode->generate($params);

        echo "QR Code berhasil dibuat!";
    } 
}