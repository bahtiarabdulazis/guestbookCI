<?php  
defined('BASEPATH') or exit('No direct script access allowed');

class Form extends CI_Controller
{
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
            // log_message('debug', 'API Decoded Response: ' . print_r($api_response, true));

            $valid = false;
            $username = null;

            // Cek apakah username dan decrypt_password cocok dengan data dari API
            if (isset($api_response['datapegawai'])) {
                foreach ($api_response['datapegawai'] as $pegawai) {
                    if (isset($pegawai['username']) && isset($pegawai['decrypt_password'])) {
                        $valid = true;
                        $username = $pegawai['username'];
                        break;
                    }
                }
            }

            if ($valid) {
                // Ambil id terakhir dari database
                $this->db->select_max('id');
                $query = $this->db->get('users');
                $last_id = $query->row()->id;

                // Update kolom updated_at dan finished_at untuk pengguna dengan ID terakhir
                $this->db->set('updated_at', 'NOW()', FALSE);
                $this->db->set('finished_at', 'NOW()', FALSE);
                $this->db->where('id', $last_id); // Tentukan ID pengguna yang akan diupdate
                $this->db->update('users'); // Nama tabel adalah 'users' dalam database 'guestbook'

                // Debugging: Cetak query terakhir yang dijalankan
                // log_message('debug', 'Last Query: ' . $this->db->last_query());

                $this->session->unset_userdata('form_submitted');
                $this->session->unset_userdata('test_session');
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