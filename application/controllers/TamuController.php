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

    public function ygDituju()
    {
        $getData = json_decode($this->curl->simple_get($this->API));
    
        // Print respons untuk memeriksanya
        echo "<pre>";
        print_r($getData);
        echo "</pre>";
    
        // Periksa apakah respons tidak kosong dan memiliki properti datapegawai
        if (!empty($getData) && property_exists($getData, 'datapegawai')) {
            $datapegawai = $getData->datapegawai;
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($datapegawai));
        } else {
            // Jika respons tidak sesuai, kirim respons kosong
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([]));
        }
    }   
}
?>
