<?php

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
defined('BASEPATH') OR exit('No direct script access allowed');

class statistik extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        ini_set('max_execution_time', 0);
        set_time_limit(0);
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('mdata');
        $this->load->model('mstatistik');
        $this->load->library('datetimemanipulation');
        // LOAD LIBRARY
        $sesi_login = $this->session->userdata('logged');
        if (!isset($sesi_login)) {
            redirect('auth/login');
        }
    }
    // <editor-fold defaultstate="collapsed" desc="Menu Dokumen - By Arif">

    public function index() {
        $data['title'] = "Statistik Data Support";
        $data['konten'] = "statistik/index";


        // get search parameter
        $search = $this->session->userdata('data_search');
        if (!empty($search)) {
            $data['search'] = $search;
        } else {
            $data['search']['bulan'] =  date('m');
            $data['search']['tahun'] =  date('Y');
        }
        // search parameters
        //$data['bulan'] = empty($data['bulan']) ? date('Y') : $data['bulan'];

        $data['total_support'] = $this->mstatistik->get_total_support($data['search']['tahun']);
        $data['total_tiket'] = $this->mstatistik->get_total_tiket($data['search']['tahun']);
        $data['total_file'] = $this->mstatistik->get_total_file($data['search']['tahun']);
        $data['rs_tiket_bulanan'] = $this->mstatistik->get_jml_tiket_bulanan($data['search']['tahun']);
        $data['rs_jml_pertransaksi'] = $this->mstatistik->get_jml_pertransaksi($data['search']['tahun']);
        $data['rs_jml_tiket_support'] = $this->mstatistik->get_jml_tiket_support($data['search']['tahun'].$data['search']['bulan']);
        $data['rs_tiket_terbaru'] = $this->mstatistik->get_list_top_tiket($data['search']['tahun'].$data['search']['bulan']);

        $data['rs_jenis_transaksi'] = $this->mdata->get_list_jenis_transaksi();
        $data['rs_bulan'] = $this->datetimemanipulation->get_list_month();
        $data['rs_tahun'] = $this->mstatistik->get_list_tahun();
        $data['waktu_sekarang'] = $this->datetimemanipulation->get_date_now();


       // print_r($data['rs_jml_pertransaksi']); exit();
        $this->load->view('home', $data);
    }

    // search process
    public function search_process() {
        // data
        if ($this->input->post('button') == "reset") {
            $this->session->unset_userdata('data_search');
        } else {
            $params = array(
                "bulan" => $this->input->post("bulan", TRUE),
                "tahun" => $this->input->post("tahun", TRUE),
            );
            $this->session->set_userdata("data_search", $params);
        }
        // redirect ke fungsi index
        redirect("statistik");
    }


    // </editor-fold>
}
