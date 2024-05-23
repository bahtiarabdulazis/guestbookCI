<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Render extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->API = "https://api.aaslabs.com/web/Employes";
        $this->load->library('Ciqrcode');
        $this->load->library('session');
        $this->load->library('curl');
        $this->load->helper('form');
        $this->load->helper('url');
    }

    public function index() {
        $response = $this->curl->simple_get($this->API);
        
        // Check if the response is not empty
        if ($response) {
            $data['datapegawai'] = json_decode($response);
            log_message('debug', 'API Response: ' . print_r($data['datapegawai'], true));
        } else {
            // Handle the error, maybe set $data['datapegawai'] to an empty array or null
            $data['datapegawai'] = [];
            // Optionally log the error or display an error message
            log_message('error', 'Failed to fetch data from API');
        }
        
        // Load the view and pass the data
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
?>
