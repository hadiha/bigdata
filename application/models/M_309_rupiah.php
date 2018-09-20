<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
  
class M_309_rupiah extends CI_Model {


    public function get_list_tahun() {
        $tahun_skrg = date('Y');
        $tahun_start = $tahun_skrg - 5 ;

        for ($i=$tahun_start; $i <= $tahun_skrg; $i++) { 
            $result[] = $i;
        }

        return $result;
    }

    // GET TOTAL UPI
    public function get_upi() {
        $sql = "SELECT UNITUPI UNIT_UPI,
                  UNITUPI || ' - ' || SATUAN || '  ' || NAMA UNITUPI
                FROM BILL52.UNITUPI
                ORDER BY UNITUPI";
         $query = $this->db->query($sql);

        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function get_ap($param) {
        $sql = "SELECT UNITAP UNIT_AP,
                  UNITAP || ' - ' || SATUAN || '  ' || NAMA AS UNITAP
                FROM BILL52.UNITAP
                WHERE UNITUPI = ?
                ORDER BY UNITAP";
         $query = $this->db->query($sql, $param);


        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function get_up($param) {
        $sql = "SELECT UNITUP UNIT_UP,
                  UNITUP || ' - ' || SATUAN || '  ' || NAMA AS UNITUP
                FROM BILL52.UNITUP
                WHERE UNITAP = ?
                ORDER BY UNITUP";
         $query = $this->db->query($sql, $param);

        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }


}
 