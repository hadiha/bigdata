<?php

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
defined('BASEPATH') OR exit('No direct script access allowed');

class data_404 extends CI_Controller {

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

    public function saldo() {
        $data['title'] = "Data 404 Saldo";
        $data['konten'] = "404/404all";

        // $data['rs_bulan'] = $this->datetimemanipulation->get_list_month();
        $data['rs_tahun'] = $this->M_309_rupiah->get_list_tahun();
        $data['total_upi'] = $this->M_309_rupiah->get_upi();

        $tahun = $this->input->post('tahun');;
        $unitupi = $this->input->post('unitupi');
        $unitap = $this->input->post('unitap');
        $unitup = $this->input->post('unitup');

        // print_r($tahun); exit();

        if (!empty($tahun) or !empty($unitupi) or !empty($unitap) or !empty($unitup)) {
            $data['data404all'] = $this->mdashboard->get404all($tahun, $unitupi, $unitap, $unitup); 
            $data['filterTahun'] = $tahun;
            $data['filterUpi'] = $unitupi;
            $data['filterAp'] = $unitap;
            $data['filterUp'] = $unitup;
            // print_r($data); exit();
        }else{
            $data['data404all'] = $this->mdashboard->get404all(date('Y'), NULL, NULL, NULL);
            $data['filterTahun'] = date('Y');
            $data['filterUpi'] = 'NASIONAL';
            $data['filterAp'] = NULL;
            $data['filterUp'] = NULL;
        }    
        // print_r($data['dataall']); exit();
        $this->load->view('home', $data);
    }

    public function pelunasan() {
        $data['title'] = "Data 404 Lunas";
        $data['konten'] = "404/404allPelunasan";

        $data['rs_tahun'] = $this->M_309_rupiah->get_list_tahun();
        $data['total_upi'] = $this->M_309_rupiah->get_upi();

        $tahun = $this->input->post('tahun');;
        $unitupi = $this->input->post('unitupi');
        $unitap = $this->input->post('unitap');
        $unitup = $this->input->post('unitup');

        if (!empty($tahun) or !empty($unitupi) or !empty($unitap) or !empty($unitup)) {
            $data['data404lunas'] = $this->mdashboard->get404lunas($tahun, $unitupi, $unitap, $unitup); 
            $data['filterTahun'] = $tahun;
            $data['filterUpi'] = $unitupi;
            $data['filterAp'] = $unitap;
            $data['filterUp'] = $unitup;
        }else{
            $data['data404lunas'] = $this->mdashboard->get404lunas(date('Y'), NULL, NULL, NULL);
            $data['filterTahun'] = date('Y');
            $data['filterUpi'] = 'NASIONAL';
            $data['filterAp'] = NULL;
            $data['filterUp'] = NULL;
        }    
        // print_r($data['dataall']); exit();
        $this->load->view('home', $data);
    }

    public function delta_saldo() {
        $data['title'] = "Data 404 Delta Saldo";
        $data['konten'] = "404/404delta";

        // $data['rs_bulan'] = $this->datetimemanipulation->get_list_month();
        $data['rs_tahun'] = $this->M_309_rupiah->get_list_tahun();
        $data['total_upi'] = $this->M_309_rupiah->get_upi();

        $tahun = $this->input->post('tahun');;
        $tahunBdg = $this->input->post('tahunBdg');;
        $unitupi = $this->input->post('unitupi');
        $unitap = $this->input->post('unitap');
        $unitup = $this->input->post('unitup');

        if (!empty($tahun) or !empty($tahunBdg) or !empty($unitupi) or !empty($unitap) or !empty($unitup)) {
            $data['data404deltasaldo'] = $this->mdashboard->get404deltasaldo($tahun, $tahunBdg, $unitupi, $unitap, $unitup); 
            $data['filterTahun'] = $tahun;
            $data['filterTahunBdg'] = $tahunBdg;
            $data['filterUpi'] = $unitupi;
            $data['filterAp'] = $unitap;
            $data['filterUp'] = $unitup;
        }else{
            $data['data404deltasaldo'] = $this->mdashboard->get404deltasaldo(date('Y'), date('Y')-1, NULL, NULL, NULL);
            $data['filterTahun'] = date('Y');
            $data['filterTahunBdg'] = date('Y') - 1;
            $data['filterUpi'] = 'NASIONAL';
            $data['filterAp'] = NULL;
            $data['filterUp'] = NULL;
        }

        // print_r($data['data404deltasaldo']); exit();
        $this->load->view('home', $data);
    }

    public function delta_pelunasan() {
        $data['title'] = "Data 404 Delta Lunas";
        $data['konten'] = "404/404deltaPelunasan";

        // $data['rs_bulan'] = $this->datetimemanipulation->get_list_month();
        $data['rs_tahun'] = $this->M_309_rupiah->get_list_tahun();
        $data['total_upi'] = $this->M_309_rupiah->get_upi();

        $tahun = $this->input->post('tahun');;
        $tahunBdg = $this->input->post('tahunBdg');;
        $unitupi = $this->input->post('unitupi');
        $unitap = $this->input->post('unitap');
        $unitup = $this->input->post('unitup');

        if (!empty($tahun) or !empty($tahunBdg) or !empty($unitupi) or !empty($unitap) or !empty($unitup)) {
            $data['data404deltalunas'] = $this->mdashboard->get404deltalunas($tahun, $tahunBdg, $unitupi, $unitap, $unitup); 
            $data['filterTahun'] = $tahun;
            $data['filterTahunBdg'] = $tahunBdg;
            $data['filterUpi'] = $unitupi;
            $data['filterAp'] = $unitap;
            $data['filterUp'] = $unitup;
        }else{
            $data['data404deltalunas'] = $this->mdashboard->get404deltalunas(date('Y'), date('Y')-1, NULL, NULL, NULL);
            $data['filterTahun'] = date('Y');
            $data['filterTahunBdg'] = date('Y')-1;
            $data['filterUpi'] = 'NASIONAL';
            $data['filterAp'] = NULL;
            $data['filterUp'] = NULL;
        }

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
