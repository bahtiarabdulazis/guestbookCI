<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Render extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('Ciqrcode');
        $this->load->database();
    }

    public function index() {
        $data['data'] = $this->db->get('users')->result();
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
}