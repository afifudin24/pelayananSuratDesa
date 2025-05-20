<?php

class M_signature extends CI_Model
{
    public function getData()
    {

        return $this->db->get('signature_surat')->result();
    }

    public function updateLurahName($name)
    {
        // update field namaLurah dari signature_surat data pertama
        return $this->db->update('signature_surat', array(
            'namaLurah' => $name
        ));


    }
    public function updateSignaturePath($filepath)
    {
        return $this->db->update('signature_surat', array(
            'pathSignature' => $filepath
        ));

    }
    public function updateStempelPath($filepath)
    {
        return $this->db->update('signature_surat', array(
            'pathStempel' => $filepath
        ));

    }
}