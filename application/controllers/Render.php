<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Render extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('ciqrcode');
        $this->load->database();
        $this->load->library('session');
    }

    public function index() {
        redirect(base_url('form')); // Redirect to form page
    }

    public function showQR() {
        
        if (!$this->session->userdata('form_submitted')) {
            $this->session->set_flashdata('error', 'Anda harus mengisi form terlebih dahulu untuk melanjutkan.');
            redirect(base_url('')); // Redirect to form
        }

        if (!$this->session->userdata('qr_scanned')) {
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get('users', 1);
            $data['data'] = $query->result();


            $this->load->view('home/render', $data);
        } else {
            $this->session->unset_userdata('form_submitted');
            $this->session->unset_userdata('qr_scanned');
            redirect(base_url('form')); // Redirect to form
        }
    }

    public function QRcode($kodenya) {
        // Pastikan direktori ada
        $dir = FCPATH . 'uploads/qrcodes/';
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
    
        // Parameter untuk QR code
        $params['data'] = base_url('render/redirectForm/' . $kodenya); // URL untuk pemindaian
        $params['level'] = 'H';
        $params['size'] = 5;
        $params['savename'] = $dir . $kodenya . '.png';
    
        // Generate QR code
        $this->ciqrcode->generate($params);
    
        // Tampilkan gambar QR code
        if (file_exists($params['savename'])) {
            header('Content-Type: image/png');
            readfile($params['savename']);
        } else {
            echo 'Failed to generate QR code.';
        }
    }
    
}
?>