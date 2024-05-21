<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AppModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Memuat database CodeIgniter
    }

    // Fungsi untuk menyimpan data tamu
    public function simpanTamu($data)
    {
        $this->db->insert('users', $data); 
    }

    // Fungsi untuk mengambil semua data pegawai dari tabel 'yangdituju'
    public function getAllPegawai()
    {
        $query = $this->db->get('ygdituju'); // Pastikan tabel Anda bernama 'ygdituju'
        return $query->result();
    }

    // Fungsi untuk mengambil data pegawai dari API
    public function getPegawaiFromApi()
    {
        $url = "https://api.aaslabs.com/web/Employes";
        $response = file_get_contents($url);
        return json_decode($response, true);
    }
}
?>
