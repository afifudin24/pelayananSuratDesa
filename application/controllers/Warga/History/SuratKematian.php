<?php
use Dompdf\Dompdf;
use Dompdf\Options;
class SuratKematian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('M_history');
        $this->load->model('M_cetak');
        $this->load->model('M_signature');
    }

    public function index()
    {
        $data = array(
            'title' => 'History Surat Keterangan Kematian',
            'datas' => $this->M_history->getSkk(),
        );

        $this->M_notifikasi->updateSk();
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('warga/history/skk/index', $data);
        $this->load->view('layout/footer', $data);
    }

    public function cetak($id)
    {
        $data = array(
            'title' => 'Cetak Surat Kematian',
            'data' => $this->M_cetak->cetakSkk($id),
            'signature' => $this->M_signature->get()
        );
          $qrPath = 'uploads/qrcode/skk/qr_surat_' . $id . '.png';

         $data['qr_image'] = base_url($qrPath); // QR path untuk ditampilkan di view
        $html = $this->load->view('warga/history/skk/print.php', $data, true);
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        // Inisialisasi Dompdf
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();



        // Output file PDF
        $dompdf->stream("Surat_Kelahiran_$id.pdf", array("Attachment" => false));
    }
}
