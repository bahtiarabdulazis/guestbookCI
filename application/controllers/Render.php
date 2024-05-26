<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Render extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('Ciqrcode');
        $this->load->database();
        $this->load->library('session');
    }

    public function index() {
        if (!$this->session->userdata('form_submitted')) {
            $this->session->set_flashdata('error', 'Anda harus mengisi form terlebih dahulu untuk melanjutkan.');
            redirect(base_url()); // Ganti 'form-url' dengan URL form Anda
        }

        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('users', 1);
        $data['data'] = $query->result();

        $this->load->view('home/render', $data);
    }

    public function QRcode($kodenya) {
        QRcode::png(
            $kodenya,
            $outfile = false,
            $level = QR_ECLEVEL_H,
            $size = 5,
            $margin = 1
        );
    }

    public function viewData($id) {
        if (!$this->session->userdata('form_submitted')) {
            $this->session->set_flashdata('error', 'Anda harus mengisi form terlebih dahulu untuk melanjutkan.');
            redirect(base_url()); // Ganti 'form-url' dengan URL form Anda
        }

        $this->db->where('id', $id);
        $query = $this->db->get('users');
    
        if ($query->num_rows() > 0) {
            $data['users'] = $query->row();
        } else {
            $data['users'] = null;
        }
    
        $this->load->view('home/data.php', $data);
    }
}
?>
