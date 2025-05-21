<?php
use Dompdf\Dompdf;
use Dompdf\Options;
class SuratDomisili extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('M_signature');
        $this->load->model('M_history');
        $this->load->model('M_cetak');
    }

    public function index()
    {
        $data = array(
            'title' => 'History Surat Domisili',
            'datas' => $this->M_history->getSkd(),
            'signature' => $this->M_signature->get()
        );
        $this->M_notifikasi->updateSd();
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('warga/history/skd/index', $data);
        $this->load->view('layout/footer', $data);
    }

    public function listcetak(){

        $data = array(
            'title' => 'Cetak Surat Domisili',
            'datas' => $this->M_history->getlistcetakskd()
        );
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('warga/history/skd/index', $data);
        $this->load->view('layout/footer');
    }

    public function cetak($id)
    {
        $data = array(
            'title' => 'Cetak Surat Domisili',
            'data' => $this->M_cetak->cetakSkd($id),
            'signature' => $this->M_signature->get()
        );

        // $this->load->view('warga/history/skd/print', $data);
        // Load view sebagai HTML string
          $qrPath = 'uploads/qrcode/skd/qr_surat_' . $id . '.png';

         $data['qr_image'] = base_url($qrPath); // QR path untuk ditampilkan di view
        $html = $this->load->view('warga/history/skd/print', $data, true);

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        // Inisialisasi Dompdf
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();



        // Output file PDF
        $dompdf->stream("Surat_Domisili_$id.pdf", array("Attachment" => false));
    }
}
