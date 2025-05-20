<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Signature extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Administrator/M_signature');
        date_default_timezone_set('Asia/Jakarta');
    }
    public function index()
    {
        $data = array(
            'title' => 'Data Admininstrator',
            'data' => $this->M_signature->getData()
        );

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('administrator/signature/index');
        $this->load->view('layout/footer');
    }
    public function updateLurahName()
    {
        $name = $this->input->post('namaLurah');
        $updateData = $this->M_signature->updateLurahName($name);
        if ($updateData) {
            // Mengembalikan respons sukses
            $response = array(
                'status' => 'success',
                'message' => 'Nama Lurah berhasil diperbarui.'
            );
        } else {
            // Mengembalikan respons gagal
            $response = array(
                'status' => 'error',
                'message' => 'Gagal memperbarui nama Lurah.'
            );
        }

        // Mengatur header respons sebagai JSON
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
    public function save()
    {
        $image = $this->input->post('image');
        $dataLama = $this->M_signature->getData();
        $pathLama = $dataLama[0]->pathSignature;

        // Pastikan $dataLama adalah objek atau array yang valid



        // // hapus file jika ditemukan
        if (file_exists($pathLama)) {
            unlink($pathLama);
        }
        // Menghapus bagian "data:image/png;base64," dari string
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $data = base64_decode($image);

        // Menyimpan gambar ke folder
        $filePath = 'assets/signatures/' . uniqid() . '.png';
        //update path tanda tangan terbaru dari filepath
        $this->M_signature->updateSignaturePath($filePath);
        $hasil = file_put_contents($filePath, $data);

        // Mengembalikan respons
        echo json_encode(['status' => 'success', 'path' => $filePath, 'hasil' => $hasil]);
    }
    // public function stempelsave()
    // {
    //     $image = $this->input->post('image');
    //     // echo $image;
    //     $dataLama = $this->M_signature->getData();
    //     $pathLama = $dataLama[0]->pathStempel;

    //     // Pastikan $dataLama adalah objek atau array yang valid




    //     // Menghapus bagian "data:image/png;base64," dari string
    //     $image = str_replace('data:image/png;base64,', '', $image);
    //     $imagenew = str_replace(' ', '+', $image);
    //     $data = base64_decode($imagenew);
        
    //     // if ($data === false) {
    //     //     echo json_encode(['status' => 'error', 'message' => 'Gagal decode base64']);
    //     //     return;
    //     // }
    //     // Cek ukuran file
    //     $fileSize = strlen($data); // Ukuran dalam byte
    //     if ($fileSize >= 100 * 1024) { // 100 KB
    //         echo json_encode(['status' => 'error', 'message' => 'File maksimal adalah 100 KB.']);
    //         return; // Hentikan eksekusi lebih lanjut
    //     }
    //     // Menyimpan gambar ke folder
    //     $filePath = 'assets/stamples/' . uniqid() . '.png';
    //     //update path tanda tangan terbaru dari filepath
    //     $this->M_signature->updateStempelPath($filePath);
    //     // // hapus file jika ditemukan
    //     if (file_exists($pathLama)) {
    //         unlink($pathLama);
    //     }
    //     $hasil = file_put_contents($filePath, $data);

    //     // Mengembalikan respons
    //     echo json_encode(['status' => 'success', 'path' => $filePath, 'hasil' => $hasil]);
    // }

    public function stempelsave(){
        $image = $this->input->post('image');

        if (!$image) {
            echo json_encode(['status' => 'error', 'message' => 'Tidak ada data gambar']);
            return;
        }
    
        // Pisahkan antara metadata dan base64
        if (preg_match('/^data:image\/(\w+);base64,/', $image, $type)) {
            $image = substr($image, strpos($image, ',') + 1); // ambil setelah koma
            $type = strtolower($type[1]); // jpg, png, gif, etc.
    
            if (!in_array($type, ['jpg', 'jpeg', 'png'])) {
                echo json_encode(['status' => 'error', 'message' => 'Format gambar tidak didukung']);
                return;
            }
    
            $image = str_replace(' ', '+', $image); // ganti spasi jadi +
            $data = base64_decode($image);
    
            if ($data === false) {
                echo json_encode(['status' => 'error', 'message' => 'Gagal decode base64']);
                return;
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data base64 tidak valid']);
            return;
        }
    
        // Simpan file
        $fileName = uniqid() . '.' . $type;
        $filePath = 'assets/stamples/' . $fileName;
               $this->M_signature->updateStempelPath($filePath);
    
        if (!is_dir('assets/stamples')) {
            mkdir('assets/stamples', 0755, true); // buat folder jika belum ada
        }
    
        if (file_put_contents($filePath, $data)) {
            echo json_encode(['status' => 'success', 'path' => $filePath]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan gambar']);
        }
    }
}