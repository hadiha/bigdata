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

    public function main() {
        $data['title'] = "Dashboard";
        $data['konten'] = "309_rupiah/vdashboard";

        $data['rs_tahun'] = $this->M_309_rupiah->get_list_tahun();
        $data['total_upi'] = $this->M_309_rupiah->get_upi();

        $data['dataall'] = $this->mdashboard->get309all(date('Y'), 'TOTAL', NULL, NULL, NULL);
        $data['datadelta'] = $this->mdashboard->get309delta(date('Y'), date('Y')-1, 'TOTAL', NULL, NULL, NULL);
        $data['data404saldo'] = $this->mdashboard->get404all(date('Y'), NULL, NULL, NULL); 
        $data['data404lunas'] = $this->mdashboard->get404lunas(date('Y'), NULL, NULL, NULL); 
        $data['data404delta'] = $this->mdashboard->get404deltasaldo(date('Y'), date('Y')-1, NULL, NULL, NULL); 
        $data['data404deltalunas'] = $this->mdashboard->get404deltalunas(date('Y'), date('Y')-1, NULL, NULL, NULL);  
        if (empty($data['dataall']) || empty($data['datadelta']) || empty($data['data404saldo']) || empty($data['data404lunas']) || empty($data['data404delta']) || empty($data['data404deltalunas'])) {
            $data['status'] = 'Kosong';
            $data['msg'] = 'Data Tidak Ditemukan';
        }
        $data['datatahun'] = date('Y');
        $data['datajenislap']= 'GABUNGAN';
        // print_r($data['dataall']); exit();
        $this->load->view('home', $data);
    }

    public function getdashboard() {
        $tahun = $this->input->post('tahun');
        $tahun1 = $this->input->post('tahun1');
        $jenislap = $this->input->post('jenislap');
        $unitupi = $this->input->post('unitupi');
        $unitap = $this->input->post('unitap');
        $unitup =$this->input->post('unitup');

        if ($unitupi == '00') {
            $unitupi = NULL;
        }else if($unitap == '00') {
            $unitap = NULL;
        }else if($unitup == '00') {
            $unitup = NULL;
        }
        // parameter
        $data['dataall'] = $this->mdashboard->get309all($tahun, $jenislap, $unitupi, $unitap, $unitup);
        $data['datadelta'] = $this->mdashboard->get309delta($tahun, $tahun1, $jenislap, $unitupi, $unitap, $unitup);
        $data['data404saldo'] = $this->mdashboard->get404all($tahun, $unitupi, $unitap, $unitup); 
        $data['data404lunas'] = $this->mdashboard->get404lunas($tahun, $unitupi, $unitap, $unitup); 
        $data['data404delta'] = $this->mdashboard->get404deltasaldo($tahun, $tahun1, $unitupi, $unitap, $unitup); 
        $data['data404deltalunas'] = $this->mdashboard->get404deltalunas($tahun, $tahun1, $unitupi, $unitap, $unitup);  
        if (empty($data['dataall']) || empty($data['datadelta']) || empty($data['data404saldo']) || empty($data['data404lunas']) || empty($data['data404delta']) || empty($data['data404deltalunas'])) {
            $data['status'] = 'Kosong';
            $data['msg'] = 'Data Tidak Ditemukan';
        }
        
        $data['init'] = 'akhir';
        $data['datatahun'] = $tahun;
        $data['tahun1'] = $tahun1;
        $data['jenislap'] = $jenislap;
        $data['unitupi'] = $unitupi;
        $data['unitap'] = $unitap;
        $data['unitup'] = $unitup;
        echo json_encode($data);
    }

    public function data309($titlemenu) {
        if ($titlemenu == 'perbulan') {
            $data['title'] = "Data 309 Rupiah";
            $data['konten'] = "309_rupiah/index_all";
        }else if($titlemenu == 'kumulatif'){
            $data['title'] = "Data 309 Akumulasi";
            $data['konten'] = "309_rupiah/309kumulatif";
        }else if($titlemenu == 'allKwh'){
            $data['title'] = "Data 309 Kwh";
            $data['konten'] = "309_rupiah/309AllKwh";
        }else if($titlemenu == 'kumulatifKwh'){
            $data['title'] = "Data 309 Akumulasi";
            $data['konten'] = "309_rupiah/309KumulatifKwh";
        }

        // $data['rs_bulan'] = $this->datetimemanipulation->get_list_month();
        $data['rs_tahun'] = $this->M_309_rupiah->get_list_tahun();
        $data['total_upi'] = $this->M_309_rupiah->get_upi();

        
        // $data['dataall'] = $this->mdashboard->get309all(date('Y'), 'TOTAL', '52', '52100', '52101');
        $data['tahun'] = date('Y');
        $data['jenislap'] = 'GABUNGAN';
        $data['unitupi'] = '';
        $data['unitap'] = '';
        $data['unitup'] = '';
        $data['init'] = 'awal';
        $this->load->view('home', $data);
    }

    public function get309all() {
        $tahun = $this->input->post('tahun');
        $jenislap = $this->input->post('jenislap');
        $unitupi = $this->input->post('unitupi');
        $unitap = $this->input->post('unitap');
        $unitup =$this->input->post('unitup');

        if ($unitupi == '00') {
            $unitupi = NULL;
        }else if($unitap == '00') {
            $unitap = NULL;
        }else if($unitup == '00') {
            $unitup = NULL;
        }
        // parameter
        $data['dataall'] = $this->mdashboard->get309all($tahun, $jenislap, $unitupi, $unitap, $unitup);
        if (empty($data['dataall']) || $data['dataall'] == '') {
            $data['status'] = 'Kosong';
            $data['msg'] = 'Data Tidak Ditemukan';
        }
        $data['init'] = 'akhir';
        $data['tahun'] = $tahun;
        $data['jenislap'] = $jenislap;
        $data['unitupi'] = $unitupi;
        $data['unitap'] = $unitap;
        $data['unitup'] = $unitup;
        echo json_encode($data);
    }


    public function delta309($titlemenu) {
        if ($titlemenu == 'delta') {
            $data['title'] = "Data 309 Delta";
            $data['konten'] = "309_rupiah/309delta";
        } else {
            $data['title'] = "Data 309 Delta";
            $data['konten'] = "309_rupiah/309DeltaKwh";
        }
        

        $data['rs_tahun'] = $this->M_309_rupiah->get_list_tahun();
        $data['total_upi'] = $this->M_309_rupiah->get_upi();
        
        
        // $data['datadelta'] = $this->mdashboard->get309delta(date('Y'), '2017', 'TOTAL', '52', '52100', '52101');
        $data['datatahun'] = date('Y');
        $data['tahun1'] = date('Y');
        $data['jenislap'] = 'GABUNGAN';
        $data['unitupi'] = '';
        $data['unitap'] = '';
        $data['unitup'] = '';
        $data['init'] = 'awal';
        // print_r($data['datadelta']); exit();
        $this->load->view('home', $data);
    }


    public function getdelta309() {
        $tahun = $this->input->post('tahun');
        $tahun1 = $this->input->post('tahun1');
        $jenislap = $this->input->post('jenislap');
        $unitupi = $this->input->post('unitupi');
        $unitap = $this->input->post('unitap');
        $unitup =$this->input->post('unitup');

        if ($unitupi == '00') {
            $unitupi = NULL;
        }else if($unitap == '00') {
            $unitap = NULL;
        }else if($unitup == '00') {
            $unitup = NULL;
        }
        // parameter
        $data['datadelta'] = $this->mdashboard->get309delta($tahun, $tahun1, $jenislap, $unitupi, $unitap, $unitup);
        if (empty($data['datadelta']) || $data['datadelta'] == '') {
            $data['status'] = 'Kosong';
            $data['msg'] = 'Data Tidak Ditemukan';
        }
        $data['init'] = 'akhir';
        $data['datatahun'] = $tahun;
        $data['tahun1'] = $tahun1;
        $data['jenislap'] = $jenislap;
        $data['unitupi'] = $unitupi;
        $data['unitap'] = $unitap;
        $data['unitup'] = $unitup;
        echo json_encode($data);
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
