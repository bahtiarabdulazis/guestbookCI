<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TamuController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->API = "https://api.aaslabs.com/web/Employes";
        $this->load->library('session');
        $this->load->library('curl');
        $this->load->model('Tamu');
        $this->load->helper('url');
    }

    public function simpanTamu()
    {
        $nama = $this->input->post('nama');
        $aslpt = $this->input->post('aslpt');
        $makkun = $this->input->post('makkun');
        $ygdituju = $this->input->post('ygdituju');

        if (empty($nama) || empty($aslpt) || empty($makkun) || empty($ygdituju)) {
            $this->session->set_flashdata('error', 'All fields must be filled!');
            redirect(base_url()); // Change to your form URL
        } else {
            $data = array(
                'nama' => $nama,
                'aslpt' => $aslpt,
                'makkun' => $makkun,
                'ygdituju' => $ygdituju,
                'password' => password_hash('rahasia', PASSWORD_DEFAULT)
            );

            $this->Tamu->simpanTamu($data);

            $this->session->set_flashdata('status', 'Data successfully saved!');
            $this->session->set_userdata('form_submitted', true); // Mark form as submitted
            $this->session->set_userdata('qr_scanned', false); // QR not yet scanned
            redirect('render/showQR'); // Redirect to QR code page
        }
    }

    public function ygDituju()
    {
        $getData = json_decode($this->curl->simple_get($this->API));
    
        if (!empty($getData) && property_exists($getData, 'datapegawai')) {
            $datapegawai = $getData->datapegawai;
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($datapegawai));
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([]));
        }
    }
}
?>
