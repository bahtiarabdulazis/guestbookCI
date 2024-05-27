<?php 

class Home extends CI_Controller {
    public function index($nama = '') {
        
        $data['judul'] = 'Halaman Home';
        $data['nama'] = $nama;
        $this->load->view('home/header', $data);
        $this->load->view('home/index', $data);
        $this->load->view('/home/modal', $data);
        // $this->load->view('/home/render', $data);
        $this->load->view('home/footer');
    }

    public function show_modal()
    {
        // Set sesi untuk menampilkan modal
        $this->session->set_userdata('show_modal', true);
        redirect(base_url());
    }
}

?>