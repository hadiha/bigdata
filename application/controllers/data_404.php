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
        $upi = $this->input->post('upi');
        $ap = $this->input->post('ap');
        $up = $this->input->post('up');

        // print_r($tahun); exit();

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

    public function pelunasan() {
        $data['title'] = "Data 404 Lunas";
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

    public function delta_saldo() {
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

    public function delta_pelunasan() {
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
