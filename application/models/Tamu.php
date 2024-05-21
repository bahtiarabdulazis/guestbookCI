
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tamu extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Memuat database CodeIgniter
    }

    public function simpanTamu($data)
    {
        $this->db->insert('users', $data); 
    }
}