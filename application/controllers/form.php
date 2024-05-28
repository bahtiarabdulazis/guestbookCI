<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class form extends CI_Controller {

    public function index()
    {
        $data = array(); // Definisikan variabel $data sebelum digunakan

        // Jika ada data POST dari formulir
        if ($this->input->post()) {
            // Ambil data username dan password dari formulir
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            // Panggil API untuk memeriksa kevalidan username dan password
            $api_url = 'https://api.aaslabs.com/web/user';
            $ch = curl_init($api_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);

            // Ubah respons dari API menjadi array
            $api_response = json_decode($response, true);

            // Debugging: Cetak api_response
            log_message('debug', 'API Decoded Response: ' . print_r($api_response, true));

            $valid = false;

            // Cek apakah username dan decrypt_password cocok dengan data dari API
            if (isset($api_response['datapegawai'])) {
                foreach ($api_response['datapegawai'] as $pegawai) {
                    if ($pegawai['username'] === $username && $pegawai['decrypt_password'] === $password) {
                        $valid = true;
                        break;
                    }
                }
            }

            if ($valid) {
                // Update kolom updated_at dan finished_at
                $this->db->set('updated_at', 'NOW()', FALSE);
                $this->db->set('finished_at', 'NOW()', FALSE);
                $this->db->update('users'); // Nama tabel adalah 'users' dalam database 'guestbook'
                $this->session->unset_userdata('form_submitted'); //
                $this->session->unset_userdata('test_session'); //
                redirect(base_url('home'));
            } else {
                // Jika tidak valid, tampilkan pesan kesalahan
                $data['error'] = 'Username atau password salah';
            }
        }

        // Muat halaman dengan menampilkan pesan kesalahan jika ada
        $this->load->view('home/form', $data);
    }
}
?>