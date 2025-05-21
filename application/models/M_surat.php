<?php
class M_surat extends CI_Model
{
	public function sktm($data)
	{
		$this->db->insert('surat_tidak_mampu', $data);
	}

	public function sku($data)
	{
		$this->db->insert('surat_usaha', $data);
	}

	public function skd($data)
	{
		$this->db->insert('surat_domisili', $data);
	}

	public function skUmum($data)
	{
		$this->db->insert('surat_keterangan)umum', $data);
	}

	public function skk($data)
	{
		$this->db->insert('surat_kematian', $data);
	}

	public function spak($data)
	{
		$this->db->insert('surat_kelahiran', $data);
	}

	public function skp($data)
	{
		$this->db->insert('surat_keterangan_pengantar', $data);
	}

	public function skrm($data)
	{
		$this->db->insert('surat_keramaian', $data);
	}

	public function cek_sktm()
	{
		$this->db->where('id_warga', $this->session->userdata('id_warga'));
		$this->db->where('status', 'Menunggu Verifikasi');
		return $this->db->get('surat_tidak_mampu')->row_array();
	}

	public function cek_sku()
	{
		$this->db->where('id_warga', $this->session->userdata('id_warga'));
		$this->db->where('status', 'Menunggu Verifikasi');
		return $this->db->get('surat_usaha')->row_array();
	}

	public function cek_spak()
	{
		$this->db->where('id_warga', $this->session->userdata('id_warga'));
		$this->db->where('status', 'Menunggu Verifikasi');
		return $this->db->get('surat_kelahiran')->row_array();
	}

	public function cek_skd()
	{
		$this->db->where('id_warga', $this->session->userdata('id_warga'));
		$this->db->where('status', 'Menunggu Verifikasi');
		return $this->db->get('surat_domisili')->row_array();
	}

	public function cek_skp()
	{
		$this->db->where('id_warga', $this->session->userdata('id_warga'));
		$this->db->where('status', 'Menunggu Verifikasi');
		return $this->db->get('surat_keterangan_pengantar')->row_array();
	}

	public function cek_skk()
	{
		$this->db->where('id_warga', $this->session->userdata('id_warga'));
		$this->db->where('status', 'Menunggu Verifikasi');
		return $this->db->get('surat_kematian')->row_array();
	}
	public function cek_skrm()
	{
		$this->db->where('id_warga', $this->session->userdata('id_warga'));
		$this->db->where('status', 'Menunggu Verifikasi');
		return $this->db->get('surat_keramaian')->row_array();
	}


public function get_skd($id){
    $this->db->select('surat_domisili.*, warga.*');
    $this->db->from('surat_domisili');
    $this->db->join('warga', 'surat_domisili.id_warga = warga.id_warga');
    $this->db->where('surat_domisili.id', $id);
    return $this->db->get()->row_array();
}

public function get_skp($id){
    $this->db->select('surat_keterangan_pengantar.*, warga.*');
    $this->db->from('surat_keterangan_pengantar');
    $this->db->join('warga', 'surat_keterangan_pengantar.id_warga = warga.id_warga');
    $this->db->where('surat_keterangan_pengantar.id', $id);
    return $this->db->get()->row_array();
}

public function get_skrm($id){
    $this->db->select('surat_keramaian.*, warga.*');
    $this->db->from('surat_keramaian');
    $this->db->join('warga', 'surat_keramaian.id_warga = warga.id_warga');
    $this->db->where('surat_keramaian.id', $id);
    return $this->db->get()->row_array();
}

public function get_skk($id){
    $this->db->select('surat_kematian.*, warga.*');
    $this->db->from('surat_kematian');
    $this->db->join('warga', 'surat_kematian.id_warga = warga.id_warga');
    $this->db->where('surat_kematian.id', $id);
    return $this->db->get()->row_array();
}

public function get_sktm($id){
    $this->db->select('surat_tidak_mampu.*, warga.*');
    $this->db->from('surat_tidak_mampu');
    $this->db->join('warga', 'surat_tidak_mampu.id_warga = warga.id_warga');
    $this->db->where('surat_tidak_mampu.id', $id);
    return $this->db->get()->row_array();
}

public function get_sku($id){
    $this->db->select('surat_usaha.*, warga.*');
    $this->db->from('surat_usaha');
    $this->db->join('warga', 'surat_usaha.id_warga = warga.id_warga');
    $this->db->where('surat_usaha.id', $id);
    return $this->db->get()->row_array();
}

public function get_spak($id){
    $this->db->select('surat_kelahiran.*, warga.*');
    $this->db->from('surat_kelahiran');
    $this->db->join('warga', 'surat_kelahiran.id_warga = warga.id_warga');
    $this->db->where('surat_kelahiran.id', $id);
    return $this->db->get()->row_array();
}

}
