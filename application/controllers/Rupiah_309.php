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

        $tahun = $this->input->post('tahun');
        $jenislap = $this->input->post('jenislap');
        $unitupi = $this->input->post('unitupi');
        $unitap = $this->input->post('unitap');
        $unitup =$this->input->post('unitup');
        if ($unitupi == '00') {
            $unitupi = NULL;
        }

        if (!empty($tahun) or !empty($jenislap) or !empty($unitupi) or !empty($unitap) or !empty($unitup)) {
            $data['dataall'] = $this->mdashboard->get309all($tahun, $jenislap, $unitupi, $unitap, $unitup);
            $data['tahun'] = $tahun;
            $data['jenislap'] = $jenislap;
            $data['unitupi'] = $unitupi;
            $data['unitap'] = $unitap;
            $data['unitup'] = $unitup;
        }else{
            $data['dataall'] = $this->mdashboard->get309all('2018', 'TOTAL', NULL, NULL, NULL);
            $data['tahun'] = '2018';
            $data['jenislap'] = 'GABUNGAN';
            $data['unitupi'] = NULL;
            $data['unitap'] = NULL;
            $data['unitup'] = NULL;
        }    
        // print_r($data['dataall']); exit();
        $this->load->view('home', $data);
    }

    public function allKwh() {
        $data['title'] = "Data 309 Kwh";
        $data['konten'] = "309_rupiah/309AllKwh";

        $data['rs_tahun'] = $this->M_309_rupiah->get_list_tahun();
        $data['total_upi'] = $this->M_309_rupiah->get_upi();

        $tahun = $this->input->post('tahun');
        $jenislap = $this->input->post('jenislap');
        $unitupi = $this->input->post('unitupi');
        $unitap = $this->input->post('unitap');
        $unitup =$this->input->post('unitup');
        if ($unitupi == '00') {
            $unitupi = NULL;
        }

        if (!empty($tahun) or !empty($jenislap) or !empty($unitupi) or !empty($unitap) or !empty($unitup)) {
            $data['dataall'] = $this->mdashboard->get309all($tahun, $jenislap, $unitupi, $unitap, $unitup);
            $data['tahun'] = $tahun;
            $data['jenislap'] = $jenislap;
            $data['unitupi'] = $unitupi;
            $data['unitap'] = $unitap;
            $data['unitup'] = $unitup;
        }else{
            $data['dataall'] = $this->mdashboard->get309all('2018', 'TOTAL', NULL, NULL, NULL);
            $data['tahun'] = '2018';
            $data['jenislap'] = 'GABUNGAN';
            $data['unitupi'] = NULL;
            $data['unitap'] = NULL;
            $data['unitup'] = NULL;
        }    
        // print_r($data['dataall']); exit();
        $this->load->view('home', $data);
    }

    public function kumulatif() {
        $data['title'] = "Data 309 Akumulasi";
        $data['konten'] = "309_rupiah/309kumulatif";

        $data['rs_tahun'] = $this->M_309_rupiah->get_list_tahun();
        $data['total_upi'] = $this->M_309_rupiah->get_upi();

        $tahun = $this->input->post('tahun');
        $jenislap = $this->input->post('jenislap');
        $unitupi = $this->input->post('unitupi');
        $unitap = $this->input->post('unitap');
        $unitup =$this->input->post('unitup');
        if ($unitupi == '00') {
            $unitupi = NULL;
        }

        if (!empty($tahun) or !empty($jenislap) or !empty($unitupi) or !empty($unitap) or !empty($unitup)) {
            $data['datakomulatif'] = $this->mdashboard->get309all($tahun, $jenislap, $unitupi, $unitap, $unitup);
            $data['tahun'] = $tahun;
            $data['jenislap'] = $jenislap;
            $data['unitupi'] = $unitupi;
            $data['unitap'] = $unitap;
            $data['unitup'] = $unitup;
        }else{
            $data['datakomulatif'] = $this->mdashboard->get309all('2018', 'TOTAL', NULL, NULL, NULL);
            $data['tahun'] = '2018';
            $data['jenislap'] = 'GABUNGAN';
            $data['unitupi'] = NULL;
            $data['unitap'] = NULL;
            $data['unitup'] = NULL;
        }    
        // print_r($data['dataall']); exit();
        $this->load->view('home', $data);
    }

    public function kumulatifKwh() {
        $data['title'] = "Data 309 Akumulasi";
        $data['konten'] = "309_rupiah/309KumulatifKwh";

        $data['rs_tahun'] = $this->M_309_rupiah->get_list_tahun();
        $data['total_upi'] = $this->M_309_rupiah->get_upi();

        $tahun = $this->input->post('tahun');
        $jenislap = $this->input->post('jenislap');
        $unitupi = $this->input->post('unitupi');
        $unitap = $this->input->post('unitap');
        $unitup =$this->input->post('unitup');
        if ($unitupi == '00') {
            $unitupi = NULL;
        }

        if (!empty($tahun) or !empty($jenislap) or !empty($unitupi) or !empty($unitap) or !empty($unitup)) {
            $data['datakomulatifkwh'] = $this->mdashboard->get309all($tahun, $jenislap, $unitupi, $unitap, $unitup);
            $data['tahun'] = $tahun;
            $data['jenislap'] = $jenislap;
            $data['unitupi'] = $unitupi;
            $data['unitap'] = $unitap;
            $data['unitup'] = $unitup;
        }else{
            $data['datakomulatifkwh'] = $this->mdashboard->get309all('2018', 'TOTAL', NULL, NULL, NULL);
            $data['tahun'] = '2018';
            $data['jenislap'] = 'GABUNGAN';
            $data['unitupi'] = NULL;
            $data['unitap'] = NULL;
            $data['unitup'] = NULL;
        }    
        // print_r($data['dataall']); exit();
        $this->load->view('home', $data);
    }

    public function delta() {
        $data['title'] = "Data 309 Delta";
        $data['konten'] = "309_rupiah/309delta";

        $data['rs_tahun'] = $this->M_309_rupiah->get_list_tahun();
        $data['total_upi'] = $this->M_309_rupiah->get_upi();
        
        $tahun = $this->input->post('tahun');
        $tahun1 = $this->input->post('tahun1');
        $jenislap = $this->input->post('jenislap');
        $unitupi = $this->input->post('unitupi');
        $unitap = $this->input->post('unitap');
        $unitup =$this->input->post('unitup');

        if ($unitupi == '00') {
            $unitupi = NULL;
        }

        if (!empty($tahun) or !empty($tahun1) or !empty($jenislap) or !empty($unitupi) or !empty($unitap) or !empty($unitup)) {
            $data['datadelta'] = $this->mdashboard->get309delta($tahun, $tahun1, $jenislap, $unitupi, $unitap, $unitup);
            $data['datatahun'] = $tahun;
            $data['tahun1'] = $tahun1;
            $data['jenislap'] = $jenislap;
            $data['unitupi'] = $unitupi;
            $data['unitap'] = $unitap;
            $data['unitup'] = $unitup;
        }else{
            $data['datadelta'] = $this->mdashboard->get309delta('2018', '2017', 'TOTAL', NULL, NULL, NULL);
            $data['datatahun'] = '2018';
            $data['tahun1'] = '2017';
            $data['jenislap'] = 'GABUNGAN';
            $data['unitupi'] = NULL;
            $data['unitap'] = NULL;
            $data['unitup'] = NULL;
        }    
        // print_r($data['datadelta']); exit();
        $this->load->view('home', $data);
    }

    public function deltaKwh() {
        $data['title'] = "Data 309 Delta";
        $data['konten'] = "309_rupiah/309DeltaKwh";

        $data['rs_tahun'] = $this->M_309_rupiah->get_list_tahun();
        $data['total_upi'] = $this->M_309_rupiah->get_upi();

        $tahun = $this->input->post('tahun');
        $tahun1 = $this->input->post('tahun1');
        $jenislap = $this->input->post('jenislap');
        $unitupi = $this->input->post('unitupi');
        $unitap = $this->input->post('unitap');
        $unitup =$this->input->post('unitup');

        if ($unitupi == '00') {
            $unitupi = NULL;
        }

        if (!empty($tahun) or !empty($tahun1) or !empty($jenislap) or !empty($unitupi) or !empty($unitap) or !empty($unitup)) {
            $data['datadeltakwh'] = $this->mdashboard->get309delta($tahun, $tahun1, $jenislap, $unitupi, $unitap, $unitup);
            $data['datatahun'] = $tahun;
            $data['tahun1'] = $tahun1;
            $data['jenislap'] = $jenislap;
            $data['unitupi'] = $unitupi;
            $data['unitap'] = $unitap;
            $data['unitup'] = $unitup;
        }else{
            $data['datadeltakwh'] = $this->mdashboard->get309delta('2018', '2017', 'TOTAL', NULL, NULL, NULL);
            $data['datatahun'] = '2018';
            $data['tahun1'] = '2017';
            $data['jenislap'] = 'GABUNGAN';
            $data['unitupi'] = NULL;
            $data['unitap'] = NULL;
            $data['unitup'] = NULL;
        }    
        // print_r($data['dataall']); exit();
        $this->load->view('home', $data);
    }

    public function all_404() {
        $data['title'] = "Data 404 Semua";
        $data['konten'] = "404/404all";

        // $data['rs_bulan'] = $this->datetimemanipulation->get_list_month();
        $data['rs_tahun'] = $this->M_309_rupiah->get_list_tahun();
        $data['total_upi'] = $this->M_309_rupiah->get_upi();

        $tahun = $this->input->post('tahun');;
        $upi = $this->input->post('upi');
        $ap = $this->input->post('ap');
        $up = $this->input->post('up');

        if (!empty($tahun) or !empty($upi) or !empty($ap) or !empty($up)) {
            $data['data404all'] = $this->mdashboard->get404all($tahun, $upi, $ap, $up); 
            $data['tahun'] = $tahun;
            $data['upi'] = $upi;
            $data['ap'] = $ap;
            $data['up'] = $up;
        }else{
            $data['data404all'] = $this->mdashboard->get404all('2018', NULL, NULL, NULL);
            $data['tahun'] = '2018';
            $data['upi'] = NULL;
            $data['ap'] = NULL;
            $data['up'] = NULL;
        }    
        // print_r($data['dataall']); exit();
        $this->load->view('home', $data);
    }

    public function all_404_pelunasan() {
        $data['title'] = "Data 404 Semua";
        $data['konten'] = "404/404allPelunasan";

        $data['rs_tahun'] = $this->M_309_rupiah->get_list_tahun();
        $data['total_upi'] = $this->M_309_rupiah->get_upi();

        $tahun = $this->input->post('tahun');;
        $upi = $this->input->post('upi');
        $ap = $this->input->post('ap');
        $up = $this->input->post('up');

        if (!empty($tahun) or !empty($upi) or !empty($ap) or !empty($up)) {
            $data['data404lunas'] = $this->mdashboard->get404lunas($tahun, $upi, $ap, $up); 
            $data['tahun'] = $tahun;
            $data['upi'] = $upi;
            $data['ap'] = $ap;
            $data['up'] = $up;
        }else{
            $data['data404lunas'] = $this->mdashboard->get404lunas('2018', NULL, NULL, NULL);
            $data['tahun'] = '2018';
            $data['upi'] = NULL;
            $data['ap'] = NULL;
            $data['up'] = NULL;
        }    
        // print_r($data['dataall']); exit();
        $this->load->view('home', $data);
    }

    public function delta_404() {
        $data['title'] = "Data 404 Delta Saldo";
        $data['konten'] = "404/404delta";

        // $data['rs_bulan'] = $this->datetimemanipulation->get_list_month();
        $data['rs_tahun'] = $this->M_309_rupiah->get_list_tahun();
        $data['total_upi'] = $this->M_309_rupiah->get_upi();

        $tahun = $this->input->post('tahun');;
        $tahun1 = $this->input->post('tahun1');;
        $upi = $this->input->post('upi');
        $ap = $this->input->post('ap');
        $up = $this->input->post('up');

        if (!empty($tahun) or !empty($tahun1) or !empty($upi) or !empty($ap) or !empty($up)) {
            $data['data404saldo'] = $this->mdashboard->get404deltasaldo($tahun, $tahun1, $upi, $ap, $up); 
            $data['tahun'] = '2017';
            $data['tahun1'] = '2018';
            $data['upi'] = $upi;
            $data['ap'] = $ap;
            $data['up'] = $up;
        }else{
            $data['data404saldo'] = $this->mdashboard->get404deltasaldo('2017', '2018', NULL, NULL, NULL);
            $data['tahun'] = '2017';
            $data['tahun1'] = '2018';
            $data['upi'] = NULL;
            $data['ap'] = NULL;
            $data['up'] = NULL;
        }

        // print_r($data['data404saldo']); exit();
        $this->load->view('home', $data);
    }

    public function delta_404_Pelunasan() {
        $data['title'] = "Data 404 Delta Lunas";
        $data['konten'] = "404/404deltaPelunasan";

        // $data['rs_bulan'] = $this->datetimemanipulation->get_list_month();
        $data['rs_tahun'] = $this->M_309_rupiah->get_list_tahun();
        $data['total_upi'] = $this->M_309_rupiah->get_upi();

        $tahun = $this->input->post('tahun');;
        $tahun1 = $this->input->post('tahun1');;
        $upi = $this->input->post('upi');
        $ap = $this->input->post('ap');
        $up = $this->input->post('up');

        if (!empty($tahun) or !empty($tahun1) or !empty($upi) or !empty($ap) or !empty($up)) {
            $data['data404lunas'] = $this->mdashboard->get404deltalunas($tahun, $tahun1, $upi, $ap, $up); 
            $data['tahun'] = '2017';
            $data['tahun1'] = '2018';
            $data['upi'] = $upi;
            $data['ap'] = $ap;
            $data['up'] = $up;
        }else{
            $data['data404lunas'] = $this->mdashboard->get404deltalunas('2017', '2018', NULL, NULL, NULL);
            $data['tahun'] = '2017';
            $data['tahun1'] = '2018';
            $data['upi'] = NULL;
            $data['ap'] = NULL;
            $data['up'] = NULL;
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
