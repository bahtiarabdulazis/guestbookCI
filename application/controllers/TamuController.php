<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TamuController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Tamu'); // Inisialisasi model Tamu
        $this->load->model('PegawaiModel'); // Inisialisasi model Pegawai
        $this->load->helper('url');
    }

    public function formBukuTamu()  
    {
        // Ambil data pegawai dari model
        $data['pegawai'] = $this->PegawaiModel->getAllPegawai();
        
        // Kirim data ke view
        $this->load->view('form_buku_tamu', $data);
    }

    public function SimpanTamu()
    {
        $nama = $this->input->post('nama');
        $aslpt = $this->input->post('aslpt');
        $makkun = $this->input->post('makkun');
        $ygdituju = $this->input->post('ygdituju');

        $data = array(
            'nama' => $nama,
            'aslpt' => $aslpt,
            'makkun' => $makkun,
            'ygdituju' => $ygdituju,
            'password' => password_hash('rahasia', PASSWORD_DEFAULT)
        );

        $this->Tamu->simpanTamu($data); // Panggil method simpanTamu dari model Tamu

        $this->session->set_flashdata('status', 'Data berhasil disimpan!'); 
        redirect(base_url('index.php')); // atau redirect(''); jika sudah mengatur base_url di konfigurasi
    }
}
?>
