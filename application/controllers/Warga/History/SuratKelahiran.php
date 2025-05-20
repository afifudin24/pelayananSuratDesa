<?php
use Dompdf\Dompdf;
use Dompdf\Options;
class SuratKelahiran extends CI_Controller
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
            'title' => 'History Surat Pengantar Akte Kelahiran',
            'datas' => $this->M_history->getSpak(),
        );

        $this->M_notifikasi->updateSpak();
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('warga/history/spak/index', $data);
        $this->load->view('layout/footer', $data);
    }

    public function cetak($id)
    {
        $data = array(
            'title' => 'Cetak Surat Pengantar Akte Kelahiran',
            'data' => $this->M_cetak->cetakSpak($id),
            'signature' => $this->M_signature->get()
        );

        $html = $this->load->view('warga/history/spak/print', $data, true);
        // / Konfigurasi Dompdf
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
