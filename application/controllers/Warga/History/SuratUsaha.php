<?php
use Dompdf\Dompdf;
use Dompdf\Options;
class SuratUsaha extends CI_Controller
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
            'title' => 'History Surat Keterangan Usaha',
            'datas' => $this->M_history->getSku()
        );

        $this->M_notifikasi->updateSu();
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('warga/history/sku/index', $data);
        $this->load->view('layout/footer', $data);
    }
    public function listcetak()
    {
        $data = array(
            'title' => 'Cetak Surat Kelahiran',
            'datas' => $this->M_history->getlistcetaksku()
        );
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('warga/history/spak/index', $data);
        $this->load->view('layout/footer');
    }

    public function cetak($id)
    {
        $data = array(
            'title' => 'Cetak Surat Keterangan Usaha',
            'data' => $this->M_cetak->cetakSku($id),
            'signature' => $this->M_signature->get()
        );
         $qrPath = 'uploads/qrcode/sku/qr_surat_' . $id . '.png';

         $data['qr_image'] = base_url($qrPath); // QR path untuk ditampilkan di view
        $html = $this->load->view('warga/history/sku/print', $data, true);
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        // Inisialisasi Dompdf
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();



        // Output file PDF
        $dompdf->stream("Surat_Usaha_$id.pdf", array("Attachment" => false));
    }
}
