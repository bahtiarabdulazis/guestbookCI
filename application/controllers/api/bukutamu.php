<?php  
class EmployesController extends CI_Controller {

public function __construct() {
    parent::__construct();
    $this->load->helper('url');
}

public function getEmployesNames() {
    // URL API
    $url = "https://api.aaslabs.com/web/Employes";
    
    // Inisialisasi cURL
    $ch = curl_init();
    
    // Setel opsi cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    // Eksekusi cURL
    $response = curl_exec($ch);
    
    // Periksa kesalahan cURL
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
        curl_close($ch);
        return;
    }
    
    // Tutup cURL
    curl_close($ch);
    
    // Decode JSON response
    $data = json_decode($response, true);
    
    // Ambil nama-nama pegawai
    $names = [];
    if (isset($data['employes']) && is_array($data['employes'])) {
        foreach ($data['employes'] as $employe) {
            if (isset($employe['name'])) {
                $names[] = $employe['name'];
            }
        }
    }
    
    // Kembalikan nama-nama pegawai sebagai JSON
    echo json_encode($names);
}
}
