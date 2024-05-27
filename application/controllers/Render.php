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
        redirect(base_url()); // Redirect to form page
    }

    public function showQR() {
        if (!$this->session->userdata('form_submitted')) {
            $this->session->set_flashdata('error', 'Anda harus mengisi form terlebih dahulu untuk melanjutkan.');
            redirect(base_url()); // Ganti 'form-url' dengan URL form Anda
        }

        if (!$this->session->userdata('qr_scanned')) {
            $this->db->order_by('id', 'DESC');
            $query = $this->db->get('users', 1);
            $data['data'] = $query->result();

            $this->load->view('home/render', $data);
        } else {
            $this->session->unset_userdata('form_submitted');
            $this->session->unset_userdata('qr_scanned');
            redirect(base_url()); // Ganti 'form-url' dengan URL form Anda
        } 
    }

    public function QRcode($kodenya) {
        QRcode::png(
            $kodenya,
            $outfile = false,
            $level = QR_ECLEVEL_H,
            $size = 5,
            $margin = 1
        );

        // Assume QR code scanned successfully
        $this->session->set_userdata('qr_scanned', true);

        // Update database
        $data = array(
            'updated_at' => date('Y-m-d H:i:s'),
            'finished_at' => date('Y-m-d H:i:s')
        );
        $this->db->update('users', $data, array('id' => $kodenya));

        // Redirect back to form
        redirect(base_url()); // Ganti 'form-url' dengan URL form Anda
    }
}
?>
