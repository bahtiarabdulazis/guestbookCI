<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PegawaiModel extends CI_Model
{
    public function getAllPegawai()
    {
        // Contoh jika mengambil data dari database
        $query = $this->db->get('pegawai'); // Pastikan tabel Anda bernama 'pegawai'
        return $query->result();
        
        // Contoh jika mengambil data dari API
        /*
        $url = "https://api.aaslabs.com/web/Employes";
        $response = file_get_contents($url);
        return json_decode($response, true);
        */
    }
}
?>
