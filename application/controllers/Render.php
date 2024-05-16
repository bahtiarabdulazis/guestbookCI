<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Render extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('Ciqrcode');
        $this->load->database();
    }

    public function index() {
        // Mengambil entri terbaru dari tabel 'users'
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('users', 1);
        $data['data'] = $query->result();

        $this->load->view('home/render', $data);
    }

    public function QRcode($kodenya = '12345678') {
        QRcode::png(
            $kodenya,
            $outfile = false,
            $level = QR_ECLEVEL_H,
            $size = 5,
            $margin = 1
        );
    }

    public function viewData($id) {
        // Fetch data from the 'tamu' table based on ID
        $this->db->where('id', $id);
        $query = $this->db->get('users');
    
        if ($query->num_rows() > 0) {
            $data['users'] = $query->row();
        } else {
            $data['users'] = null;
        }
    
        // Load the view and pass the data
        $this->load->view('home/data.php', $data);
    }
    
}
