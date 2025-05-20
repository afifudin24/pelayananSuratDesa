<?php
class M_signature extends CI_Model
{

    public function get()
    {
        $query = $this->db->query("SELECT * FROM signature_surat LIMIT 1");
        return $query->row_array();
    }

}