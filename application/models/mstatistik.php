<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
  
class mstatistik extends CI_Model {
    // function __construct()
    // {
    //     parent::__construct();
    // }

    // list tahun

    // get list yg terdaftar di spt
    public function get_list_tahun() {
        $tahun_skrg = date('Y');
        $tahun_start = $tahun_skrg - 5 ;

        for ($i=$tahun_start; $i <= $tahun_skrg; $i++) { 
            $result[] = $i;
        }

        return $result;
    }


    // GET TOTAL SUPPORT
    public function get_total_support($params) {
        $sql = "SELECT COUNT(*) AS TOTAL_SUPPORT
                FROM (SELECT ID_USER
                FROM LOG_PROSES_OPHARAPP 
                WHERE ID_USER IS NOT NULL AND TO_CHAR(TGL_CATAT,'YYYY') = ?
                GROUP BY  ID_USER)
                ";
        $query = $this->db->query($sql,$params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['TOTAL_SUPPORT'];
        } else {
            return NULL;
        }
    }

    // GET TOTAL SUPPORT
    public function get_total_tiket($params) {
        $sql = "SELECT COUNT(*) AS TOTAL_TIKET FROM LOG_PROSES_OPHARAPP
                WHERE TO_CHAR(TGL_CATAT,'YYYY') = ?
                ";
        $query = $this->db->query($sql,$params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['TOTAL_TIKET'];
        } else {
            return NULL;
        }
    }

    // GET TOTAL SUPPORT
    public function get_total_file($params) {
        $sql = "SELECT COUNT(*) AS TOTAL_FILE FROM UPLOAD_LOG WHERE SUBSTR(MDD, 0, 4) = ?";
        $query = $this->db->query($sql,$params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['TOTAL_FILE'];
        } else {
            return NULL;
        }
    }

    // GET TOTAL SUPPORT
    public function get_jml_tiket_bulanan($params) {
        $sql = "SELECT TO_CHAR(TGL_CATAT, 'MM') AS BULAN, COUNT(*) AS TIKET_PERBULAN 
                FROM LOG_PROSES_OPHARAPP
                WHERE TO_CHAR(TGL_CATAT,'YYYY') = ?
                GROUP BY TO_CHAR(TGL_CATAT, 'MM')
                ORDER BY BULAN ASC
                ";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    // GET TOTAL SUPPORT
    public function get_jml_pertransaksi($params) {
        $sql = "SELECT * FROM (
                    SELECT JENIS_TRANSAKSI, COUNT(JENIS_TRANSAKSI) AS TOTAL_PERTRANSAKSI 
                    FROM LOG_PROSES_OPHARAPP 
                    WHERE STATUS='RESOLVED' AND  TO_CHAR(TGL_CATAT,'YYYY') = ?
                    GROUP BY JENIS_TRANSAKSI 
                    ORDER BY TOTAL_PERTRANSAKSI DESC 
                )
                WHERE ROWNUM <= 6
                ";
        $query = $this->db->query($sql,$params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }


    // GET TOP 5 SUPPORT THIS MONTH
    public function get_jml_tiket_support($params) {
        $sql = "SELECT * FROM 
                (
                SELECT ID_USER, COUNT(*) AS TIKET_BULAN_INI, TO_CHAR(SYSDATE,'YYYYMM') AS THBL
                                FROM LOG_PROSES_OPHARAPP
                                WHERE TO_CHAR(TGL_CATAT, 'YYYYMM') = ?
                                GROUP BY ID_USER
                                ORDER BY TIKET_BULAN_INI DESC
                )
                WHERE ROWNUM <= 5
                ";
        $query = $this->db->query($sql,$params);


        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            // set facebook id
            foreach ($result as $key => $data) {
                $result[$key]['fb_id'] = $this->get_list_fb_id($data['ID_USER']);
            }



            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    // get list yg terdaftar di spt
    public function get_list_fb_id($ID_USER) {
        $rs_fb = array(
            'PS.PUSAT.DEDESUPRIATNA' => '100009199784352', 
            'PS.PUSAT.DODO' => 'widodo.tama', 
            'PUSAT.ISKANDAR' => 'iskandar.zulqornain', 
            'PS.PUSAT.HERLANDANI' => 'herlandani', 
            'PS.PUSAT.DIANSEPTIANA' => 'dian.septiana', 
            'PUSAT.LUQMAN' => 'xxxx', 
            'PS.PUSAT.BAMBANG' => 'xxxx', 
            'PS.PUSAT.DODIK' => 'xxxx', 
            'PS.PUSAT.FAIZAL' => 'xxxx', 
            'SINTO' => 'xxxx', 
            );

        $result = isset($rs_fb[$ID_USER]) ? $rs_fb[$ID_USER] : null;
        return $result;
    }

    // list data
    public function get_list_top_tiket($params) {
        $sql = "SELECT NOAGENDA, JENIS_TRANSAKSI, NO_TIKET, NO_BA, TGL_PERMINTAAN, STATUS, TGL_CATAT, PERIHAL, PERMINTAAN_DARI, ID_USER
                FROM LOG_PROSES_OPHARAPP
                WHERE TO_CHAR(TGL_CATAT,'YYYYMM') = ?
                AND ROWNUM <= 8
                ORDER BY TGL_CATAT DESC";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }








    // update
    public function update($params, $where) {
        // set koneksi
        $this->pblmig_db = $this->load->database('pblmig', true);
        if (!$this->pblmig_db) {
            $m = oci_error();
            trigger_error(htmlentities($m['message']), E_USER_ERROR);
        }
        return $this->pblmig_db->update('UPLOAD_LOG', $params, $where);
    }
    
    // delete
    public function delete_data_ophar($where){
        $this->pblmig_db = $this->load->database('pblmig', true);
        if (!$this->pblmig_db) {
            $m = oci_error();
            trigger_error(htmlentities($m['message']), E_USER_ERROR);
        }
        return $this->pblmig_db->delete('LOG_PROSES_OPHARAPP', $where);
    }
    // detail data
    public function get_file_by_id($params) {
        $sql = "SELECT *
                FROM UPLOAD_LOG 
                WHERE ID_UPLOAD = ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    // list data
    public function get_list_jenis_transaksi() {
        $sql = "SELECT JENIS_TRANSAKSI FROM LOG_PROSES_OPHARAPP GROUP BY JENIS_TRANSAKSI
                ORDER BY JENIS_TRANSAKSI ASC";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    // list data
    public function get_list_nama_support() {
        $sql = "SELECT ID_USER, UNITUP, NAMA_USER FROM USERTAB ORDER BY NAMA_USER ASC";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    // list data
    public function get_list_opharapp_by_params($params) {
        $sql = "SELECT A.NOAGENDA, IDPEL, A.JENIS_TRANSAKSI, A.NO_TIKET, A.NO_BA, TGL_PERMINTAAN, ID_UPLOAD, B.NAMA_FILE, TGL_CATAT, PERIHAL, PERMINTAAN_DARI, ID_USER
				FROM LOG_PROSES_OPHARAPP A
                LEFT JOIN UPLOAD_LOG B ON A.NOAGENDA = B.NOAGENDA AND A.NO_BA = B.NO_BA AND A.NO_TIKET = B.NO_TIKET
                WHERE A.NOAGENDA LIKE ? 
                AND A.NO_BA LIKE ? 
                AND A.JENIS_TRANSAKSI LIKE ? 
                AND A.NO_TIKET LIKE ?
                AND NULLIF(TO_CHAR(TGL_CATAT, 'MM/DD/YYYY'), '')  LIKE ?
				AND PERIHAL LIKE ?
                ORDER BY TGL_CATAT DESC";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    // list data
    public function get_detail_opharappp($params) {
        $sql = "SELECT NO_TIKET, NOAGENDA, IDPEL, PERMINTAAN_DARI, JENIS_TRANSAKSI, PERIHAL, NO_BA, A.ID_USER, NAMA_USER, B.UNITUP, TGL_PERMINTAAN, RESULOTION,  TGL_CATAT, STATUS
                FROM LOG_PROSES_OPHARAPP A
                LEFT JOIN USERTAB B ON A.ID_USER = B.ID_USER
                WHERE NOAGENDA = ? 
                AND NO_BA = ? 
                AND NO_TIKET = ?
                ORDER BY TGL_CATAT DESC";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function get_list_dokumen_by_agenda($params) {
        // set koneksi
        $this->pblmig_db = $this->load->database('pblmig', true);
        if (!$this->pblmig_db) {
            $m = oci_error();
            trigger_error(htmlentities($m['message']), E_USER_ERROR);
        }
        $results = '';
        $stid = oci_parse($this->pblmig_db->conn_id, 'SELECT * FROM UPLOAD_LOG WHERE NOAGENDA = :NOAGENDA');
        oci_bind_by_name($stid, ':NOAGENDA', $params['noagenda']) or die('Error binding string1');
        if (oci_execute($stid)) {
            oci_fetch_all($stid, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);
            $results = $res;
        } else {
            $e = oci_error($stid);
            $results = $e['message'];
        }
        // return
        return $results;
    }
    

// </editor-fold>

}
 