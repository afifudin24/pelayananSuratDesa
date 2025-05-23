<?php
class M_history extends CI_Model
{
    public function getSktm()
    {
        $this->db->order_by('id', 'DESC');
        $this->db->where('id_warga', $this->session->userdata('id_warga'));
        return $this->db->get('surat_tidak_mampu')->result();
    }

    public function getSkd()
    {
        $this->db->order_by('id', 'DESC');
        $this->db->where('id_warga', $this->session->userdata('id_warga'));
        return $this->db->get('surat_domisili')->result();
    }

    public function getSkk()
    {
        $this->db->order_by('id', 'DESC');
        $this->db->where('id_warga', $this->session->userdata('id_warga'));
        return $this->db->get('surat_kematian')->result();
    }

    public function getStm()
    {
        $this->db->order_by('id', 'DESC');
        $this->db->where('id_warga', $this->session->userdata('id_warga'));
        return $this->db->get('surat_tidak_mampu')->result();
    }

    public function getSku()
    {
        $this->db->order_by('id', 'DESC');
        $this->db->where('id_warga', $this->session->userdata('id_warga'));
        return $this->db->get('surat_usaha')->result();
    }

    public function getSpak()
    {
        $this->db->order_by('id', 'DESC');
        $this->db->where('id_warga', $this->session->userdata('id_warga'));
        return $this->db->get('surat_kelahiran')->result();
    }

    public function getSkp()
    {
        $this->db->order_by('id', 'DESC');
        $this->db->where('id_warga', $this->session->userdata('id_warga'));
        return $this->db->get('surat_keterangan_pengantar')->result();
    }
    public function getSkrm()
    {
        $this->db->order_by('id', 'DESC');
        $this->db->where('id_warga', $this->session->userdata('id_warga'));
        return $this->db->get('surat_keramaian')->result();
    }

    public function getlistcetaksktm(){
        $this->db->order_by('id', 'DESC');
        $this->db->where('id_warga', $this->session->userdata('id_warga'));
        $this->db->where('status', 'Diterima');
        return $this->db->get('surat_tidak_mampu')->result();
    }

    public function getlistcetakskd(){
        $this->db->order_by('id', 'DESC');
        $this->db->where('id_warga', $this->session->userdata('id_warga'));
        $this->db->where('status', 'Diterima');
        return $this->db->get('surat_domisili')->result();
    }

    public function getlistcetakskk(){
        $this->db->order_by('id', 'DESC');
        $this->db->where('id_warga', $this->session->userdata('id_warga'));
        $this->db->where('status', 'Diterima');
        return $this->db->get('surat_kematian')->result();
    }

    public function getlistcetaksku(){
        $this->db->order_by('id', 'DESC');
        $this->db->where('id_warga', $this->session->userdata('id_warga'));
        $this->db->where('status', 'Diterima');
        return $this->db->get('surat_usaha')->result();
    }

    public function getlistcetakskrm(){
        $this->db->order_by('id', 'DESC');
        $this->db->where('id_warga', $this->session->userdata('id_warga'));
        $this->db->where('status', 'Diterima');
        return $this->db->get('surat_keramaian')->result();
    }

    public function getlistcetakspak(){
        $this->db->order_by('id', 'DESC');
        $this->db->where('id_warga', $this->session->userdata('id_warga'));
        $this->db->where('status', 'Diterima');
        return $this->db->get('surat_kelahiran')->result();
    }

    public function getlistcetakskp(){
        $this->db->order_by('id', 'DESC');
        $this->db->where('id_warga', $this->session->userdata('id_warga'));
        $this->db->where('status', 'Diterima');
        return $this->db->get('surat_keterangan_pengantar')->result();
    }
}
