<?php
Class Kontak extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->API = "https://api.aaslabs.com/web/Employes";
        $this->load->library('session');
        $this->load->library('curl');
        $this->load->helper('form');
        $this->load->helper('url');
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

    // menampilkan data kontak
    function index() {
        $response = $this->curl->simple_get($this->API . '/nama');
        
        // Check if the response is not empty
        if ($response) {
            $data['datapegawai'] = json_decode($response);
        } else {
            // Handle the error, maybe set $data['datapegawai'] to an empty array or null
            $data['datapegawai'] = [];
            // Optionally log the error or display an error message
            log_message('error', 'Failed to fetch data from API');
        }
        
        // Load the view and pass the data
        $this->load->view('home/render', $data);
    }
}
