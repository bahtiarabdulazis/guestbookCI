<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TamuController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->API = "https://api.aaslabs.com/web/Employes";
        $this->load->library('session');
        $this->load->library('curl');
        $this->load->model('Tamu'); // Inisialisasi model Tamu
        $this->load->helper('url');
    }

    public function simpanTamu()
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

    // public function ygDituju()
    // {
    //     $endpoint = 'https://api.aaslabs.com/web/Employes'; // Update URL endpoint sesuai dengan kebutuhan
    
    //     // Lakukan panggilan ke endpoint menggunakan cURL
    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL, $endpoint);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_HEADER, false);
    //     $response = curl_exec($ch);
    
    //     if ($response === FALSE) {
    //         log_message('error', 'Failed to fetch data using cURL');
    //         echo 'Failed to fetch data using cURL';
    //         return;
    //     }
    
    //     // Log dan kirim data ke view jika respons berhasil diterima
    //     log_message('debug', 'API Response: ' . $response);
    
    //     // Mengirim data ke view dalam bentuk array asosiatif
    //     $data['datapegawai'] = json_decode($response, true);
    
    //     log_message('debug', 'Decoded API Response: ' . print_r($data['datapegawai'], true));
    
    //     $this->load->view('home/index', $data);
    // }
    
}
?>
