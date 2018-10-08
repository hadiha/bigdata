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

    public function getdata404($param) {
        $tahun = $this->input->post('tahun');
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
        if ($param == 'saldoall') {
            $data['data404all'] = $this->mdashboard->get404all($tahun, $unitupi, $unitap, $unitup); 
            if (empty($data['data404all']) || $data['data404all'] == '') {
                $data['status'] = 'Kosong';
                $data['msg'] = 'Data Tidak Ditemukan';
            }
        }else if($param == 'lunasall'){
            $data['data404all'] = $this->mdashboard->get404lunas($tahun, $unitupi, $unitap, $unitup); 
            if (empty($data['data404all']) || $data['data404all'] == '') {
                $data['status'] = 'Kosong';
                $data['msg'] = 'Data Tidak Ditemukan';
            }
        }
        $data['tahun'] = $tahun;
        $data['unitupi'] = $unitupi;
        $data['unitap'] = $unitap;
        $data['unitup'] = $unitup;
        echo json_encode($data);
    }

    public function saldo() {
        $data['title'] = "Data 404 Saldo";
        $data['konten'] = "404/404all";

        $data['rs_tahun'] = $this->M_309_rupiah->get_list_tahun();
        $data['total_upi'] = $this->M_309_rupiah->get_upi();

        $data['filterTahun'] = date('Y');
        $data['filterUpi'] = 'NASIONAL';
        $data['filterAp'] = NULL;
        $data['filterUp'] = NULL;
        $this->load->view('home', $data);
    }

    public function pelunasan() {
        $data['title'] = "Data 404 Lunas";
        $data['konten'] = "404/404allPelunasan";

        $data['rs_tahun'] = $this->M_309_rupiah->get_list_tahun();
        $data['total_upi'] = $this->M_309_rupiah->get_upi();

        $data['filterTahun'] = date('Y');
        $data['filterUpi'] = 'NASIONAL';
        $data['filterAp'] = NULL;
        $data['filterUp'] = NULL;
        $this->load->view('home', $data);
    }

     public function getdata404delta($param) {
        $tahun = $this->input->post('tahun');;
        $tahun1 = $this->input->post('tahun1');;
        $unitupi = $this->input->post('unitupi');
        $unitap = $this->input->post('unitap');
        $unitup = $this->input->post('unitup');

        if ($unitupi == '00') {
            $unitupi = NULL;
        }else if($unitap == '00') {
            $unitap = NULL;
        }else if($unitup == '00') {
            $unitup = NULL;
        }
        // parameter
        if ($param == 'saldodelta') {
            $data['data404delta'] = $this->mdashboard->get404deltasaldo($tahun, $tahun1, $unitupi, $unitap, $unitup); 
            if (empty($data['data404delta']) || $data['data404delta'] == '') {
                $data['status'] = 'Kosong';
                $data['msg'] = 'Data Tidak Ditemukan';
            }
        }else if($param == 'lunasdelta'){
            $data['data404delta'] = $this->mdashboard->get404deltalunas($tahun, $tahun1, $unitupi, $unitap, $unitup);  
            if (empty($data['data404delta']) || $data['data404delta'] == '') {
                $data['status'] = 'Kosong';
                $data['msg'] = 'Data Tidak Ditemukan';
            }
        }
        $data['datatahun'] = $tahun;
        $data['tahun1'] = $tahun;
        $data['unitupi'] = $unitupi;
        $data['unitap'] = $unitap;
        $data['unitup'] = $unitup;
        echo json_encode($data);
    }

    public function delta_saldo() {
        $data['title'] = "Data 404 Delta Saldo";
        $data['konten'] = "404/404delta";

        // $data['rs_bulan'] = $this->datetimemanipulation->get_list_month();
        $data['rs_tahun'] = $this->M_309_rupiah->get_list_tahun();
        $data['total_upi'] = $this->M_309_rupiah->get_upi();

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
        $tahun1 = $this->input->post('tahun1');;
        $unitupi = $this->input->post('unitupi');
        $unitap = $this->input->post('unitap');
        $unitup = $this->input->post('unitup');

        if (!empty($tahun) or !empty($tahun1) or !empty($unitupi) or !empty($unitap) or !empty($unitup)) {
            $data['data404deltalunas'] = $this->mdashboard->get404deltalunas($tahun, $tahun1, $unitupi, $unitap, $unitup); 
            $data['filterTahun'] = $tahun;
            $data['filtertahun1'] = $tahun1;
            $data['filterUpi'] = $unitupi;
            $data['filterAp'] = $unitap;
            $data['filterUp'] = $unitup;
        }else{
            // $data['data404deltalunas'] = $this->mdashboard->get404deltalunas(date('Y'), date('Y')-1, NULL, NULL, NULL);
            $data['filterTahun'] = date('Y');
            $data['filtertahun1'] = date('Y')-1;
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
