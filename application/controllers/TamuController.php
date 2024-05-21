<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TamuController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Tamu'); // Inisialisasi model Tamu
        $this->load->helper('url');
    }

    public function formBukuTamu()  
    {
        // Ambil data pegawai dari API melalui model Tamu
        $dataFromApi = $this->Tamu->getPegawaiFromApi();
        
        // Siapkan data untuk dikirim ke view
        $data['pegawai'] = [];
        if (isset($dataFromApi['employes']) && is_array($dataFromApi['employes'])) {
            foreach ($dataFromApi['employes'] as $employe) {
                if (isset($employe['name'])) {
                    $data['pegawai'][] = $employe['name'];
                }
            }
        }
        
        // Kirim data ke view
        $this->load->view('form_buku_tamu', $data);
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

    public function getEmployesNames() {
        // Mengambil data pegawai dari API
        $dataFromApi = $this->Tamu->getPegawaiFromApi();
        
        // Ambil nama-nama pegawai dari API response
        $names = [];
        if (isset($dataFromApi['employes']) && is_array($dataFromApi['employes'])) {
            foreach ($dataFromApi['employes'] as $employe) {
                if (isset($employe['name'])) {
                    $names[] = $employe['name'];
                }
            }
        }
        
        // Kembalikan nama-nama pegawai sebagai JSON
        header('Content-Type: application/json');
        echo json_encode($names);
    }
}
?>
