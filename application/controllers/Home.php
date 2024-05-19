<?php 

class Home extends CI_Controller {
    public function index($nama = '') {
        $data['judul'] = 'Halaman Home';
        $data['nama'] = $nama;

        // Mengambil data dari API
        $api_url = 'https://api.aaslabs.com/web/Employes';
        $api_data = $this->fetch_api_data($api_url);

        // Debugging: Print data API untuk memastikan data diterima
        echo "<pre>";
        print_r($api_data);
        echo "</pre>";

        // Cek apakah data berhasil diambil dari API
        if ($api_data === null) {
            $data['error'] = "Failed to fetch data from API.";
        } elseif (empty($api_data['datapegawai'])) {
            $data['error'] = "Data from API is empty.";
        } else {
            // Ambil hanya nama dari data API
            $names = [];
            // Ambil hanya nama dari data API
            $names = [];
            foreach ($api_data['datapegawai'] as $employee) {
                $names[] = $employee['nama']; // Menambahkan nama ke dalam array $names
            }

            // Debugging: Print names array
            echo "<pre>";
            print_r($names);
            echo "</pre>";

            // Tambahkan data nama dari API ke dalam $data
            $data['names'] = $names;
        }

        $this->load->view('home/header', $data);
        $this->load->view('home/index', $data);
        $this->load->view('/home/modal', $data);
        $this->load->view('home/footer');
    }

    public function show_modal()
    {
        // Set sesi untuk menampilkan modal
        $this->session->set_userdata('show_modal', true);
        redirect(base_url());
    }

    // Fungsi untuk mengambil data dari API
    private function fetch_api_data($url)
    {
        // Buat permintaan HTTP GET ke URL API menggunakan cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        // Periksa jika respons berhasil diterima
        if ($response === false) {
            return null;
        }

        // Konversi respons JSON menjadi array PHP
        $data = json_decode($response, true);

        // Periksa jika respons bisa di-decode
        if ($data === null || !isset($data['datapegawai'])) {
            return null;
        }

        // Kembalikan data yang berhasil diambil
        return $data;
    }
}
?>
