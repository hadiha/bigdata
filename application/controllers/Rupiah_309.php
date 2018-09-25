<?php

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
defined('BASEPATH') OR exit('No direct script access allowed');

class Rupiah_309 extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_309_rupiah');
        $this->load->model('mdashboard');
        // LOAD LIBRARY
        $sesi_login = $this->session->userdata('logged');
        if (!isset($sesi_login)) {
            redirect('auth/login');
        }
    }
    // <editor-fold defaultstate="collapsed" desc="Menu Dokumen - By Arif">

    public function all() {
        $data['title'] = "Data 309 Rupiah";
        $data['konten'] = "309_rupiah/index_all";

        // $data['rs_bulan'] = $this->datetimemanipulation->get_list_month();
        $data['rs_tahun'] = $this->M_309_rupiah->get_list_tahun();
        $data['total_upi'] = $this->M_309_rupiah->get_upi();

        $tahun = '2018';
        $jenislap = 'TOTAL';

        $data['dataall'] = $this->mdashboard->get309all($tahun, $jenislap);     
        // print_r($data['dataall']); exit();
        $this->load->view('home', $data);
    }

    public function allKwh() {
        $data['title'] = "Data 309 Kwh";
        $data['konten'] = "309_rupiah/309AllKwh";

        // $data['rs_bulan'] = $this->datetimemanipulation->get_list_month();
        $data['rs_tahun'] = $this->M_309_rupiah->get_list_tahun();
        $data['total_upi'] = $this->M_309_rupiah->get_upi();

        $tahun = '2018';
        $jenislap = 'TOTAL';

        $data['dataall'] = $this->mdashboard->get309all($tahun, $jenislap);     
        // print_r($data['dataall']); exit();
        $this->load->view('home', $data);
    }

    public function kumulatif() {
        $data['title'] = "Data 309 Akumulasi";
        $data['konten'] = "309_rupiah/309kumulatif";

        // $data['rs_bulan'] = $this->datetimemanipulation->get_list_month();
        $data['rs_tahun'] = $this->M_309_rupiah->get_list_tahun();
        $data['total_upi'] = $this->M_309_rupiah->get_upi();
        // $data['total_up'] = $this->M_309_rupiah->get_up();

        // print_r($data['total_upi']); exit();
        $this->load->view('home', $data);
    }

    public function kumulatifKwh() {
        $data['title'] = "Data 309 Akumulasi";
        $data['konten'] = "309_rupiah/309KumulatifKwh";

        // $data['rs_bulan'] = $this->datetimemanipulation->get_list_month();
        $data['rs_tahun'] = $this->M_309_rupiah->get_list_tahun();
        $data['total_upi'] = $this->M_309_rupiah->get_upi();
        // $data['total_up'] = $this->M_309_rupiah->get_up();

        // print_r($data['total_upi']); exit();
        $this->load->view('home', $data);
    }

    public function delta() {
        $data['title'] = "Data 309 Delta";
        $data['konten'] = "309_rupiah/309delta";

        // $data['rs_bulan'] = $this->datetimemanipulation->get_list_month();
        $data['rs_tahun'] = $this->M_309_rupiah->get_list_tahun();
        $data['total_upi'] = $this->M_309_rupiah->get_upi();
        // $data['total_up'] = $this->M_309_rupiah->get_up();

        // print_r($data['total_upi']); exit();
        $this->load->view('home', $data);
    }

    public function deltaKwh() {
        $data['title'] = "Data 309 Delta";
        $data['konten'] = "309_rupiah/309DeltaKwh";

        // $data['rs_bulan'] = $this->datetimemanipulation->get_list_month();
        $data['rs_tahun'] = $this->M_309_rupiah->get_list_tahun();
        $data['total_upi'] = $this->M_309_rupiah->get_upi();
        // $data['total_up'] = $this->M_309_rupiah->get_up();

        // print_r($data['total_upi']); exit();
        $this->load->view('home', $data);
    }

    public function all_404() {
        $data['title'] = "Data 404 Semua";
        $data['konten'] = "404/404all";

        // $data['rs_bulan'] = $this->datetimemanipulation->get_list_month();
        $data['rs_tahun'] = $this->M_309_rupiah->get_list_tahun();
        $data['total_upi'] = $this->M_309_rupiah->get_upi();

        $tahun = '2018';
        $unitupi = null;
        $unitap = null;
        $unitup = null;

        $data['data404all'] = $this->mdashboard->get404all($tahun, $unitupi, $unitap, $unitup);     
        // print_r($data['dataall']); exit();
        $this->load->view('home', $data);
    }

    public function all_404_pelunasan() {
        $data['title'] = "Data 404 Semua";
        $data['konten'] = "404/404allPelunasan";

        // $data['rs_bulan'] = $this->datetimemanipulation->get_list_month();
        $data['rs_tahun'] = $this->M_309_rupiah->get_list_tahun();
        $data['total_upi'] = $this->M_309_rupiah->get_upi();
        // $data['total_up'] = $this->M_309_rupiah->get_up();

        // print_r($data['total_upi']); exit();
        $this->load->view('home', $data);
    }

    public function delta_404() {
        $data['title'] = "Data 404 Delta";
        $data['konten'] = "404/404delta";

        // $data['rs_bulan'] = $this->datetimemanipulation->get_list_month();
        $data['rs_tahun'] = $this->M_309_rupiah->get_list_tahun();
        $data['total_upi'] = $this->M_309_rupiah->get_upi();
        // $data['total_up'] = $this->M_309_rupiah->get_up();

        // print_r($data['total_upi']); exit();
        $this->load->view('home', $data);
    }

    public function delta_404_Pelunasan() {
        $data['title'] = "Data 404 Delta";
        $data['konten'] = "404/404deltaPelunasan";

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
