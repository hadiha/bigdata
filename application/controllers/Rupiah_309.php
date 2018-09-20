<?php

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
defined('BASEPATH') OR exit('No direct script access allowed');

class Rupiah_309 extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_309_rupiah');
        // LOAD LIBRARY
        $sesi_login = $this->session->userdata('logged');
        if (!isset($sesi_login)) {
            redirect('auth/login');
        }
    }
    // <editor-fold defaultstate="collapsed" desc="Menu Dokumen - By Arif">

    public function all() {
        $data['title'] = "Data 309 Semua";
        $data['konten'] = "309_rupiah/index_all";

        // $data['rs_bulan'] = $this->datetimemanipulation->get_list_month();
        $data['rs_tahun'] = $this->M_309_rupiah->get_list_tahun();
        $data['total_upi'] = $this->M_309_rupiah->get_upi();
        // $data['total_up'] = $this->M_309_rupiah->get_up();

        // print_r($data['total_upi']); exit();
        $this->load->view('home', $data);
    }

    public function get_all_ap()
    {
        $param = $this->input->post($level);
        $data = $this->M_309_rupiah->get_ap($param);
        
        echo json_encode($data);
    }

    public function get_all_up()
    {
        $param = $this->input->post($level);
        $data = $this->M_309_rupiah->get_up($param);
        
        echo json_encode($data);
    }
}
