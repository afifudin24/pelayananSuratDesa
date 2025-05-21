<?php
use Dompdf\Dompdf;
use Dompdf\Options;
class SuratKeteranganPengantar extends CI_Controller
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
            'title' => 'History Surat Keterangan Pengantar',
            'datas' => $this->M_history->getSkp()
        );

        $this->M_notifikasi->updateSkp();
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('warga/history/skp/index', $data);
        $this->load->view('layout/footer');
    }
    public function listcetak()
    {
        $data = array(
            'title' => 'Cetak Surat Kelahiran',
            'datas' => $this->M_history->getlistcetakskp()
        );
       $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('warga/history/skp/index', $data);
        $this->load->view('layout/footer');
    }

    public function cetak($id)
    {
        $data = array(
            'title' => 'Cetak Surat  Pengantar',
            'data' => $this->M_cetak->cetakSkp($id),
            'signature' => $this->M_signature->get()
        );
         $qrPath = 'uploads/qrcode/skp/qr_surat_' . $id . '.png';

         $data['qr_image'] = base_url($qrPath); // QR path untuk ditampilkan di view
        $html = $this->load->view('warga/history/skp/print', $data, true);
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        // Inisialisasi Dompdf
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();



        // Output file PDF
        $dompdf->stream("Surat_Keterangan_Pengantar_$id.pdf", array("Attachment" => false));
    }
}
