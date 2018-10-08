<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class mdashboard extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    public function get309all($tahun, $jenislap, $unitupi, $unitap, $unitup){
        $results = '';
        $this->pblmig_db = $this->load->database('pblmig', true);
        if (!$this->pblmig_db) {
          $m = oci_error();
          trigger_error(htmlentities($m['message']), E_USER_ERROR);
      }
      
      $TAHUN = $tahun;
      $JENISLAP = $jenislap;
      $UNITUPI = $unitupi;
      $UNITAP = $unitap;
      $UNITUP = $unitup;

      $stid = oci_parse($this->pblmig_db->conn_id, 'begin  :RetVal := LKTAPP.PKG_INFO_LAPORAN.FUNC_309_NASIONAL ( :TAHUN, :JENISLAP, :UNITUPI, :UNITAP, :UNITUP ); end;');
      $RetVal = oci_new_cursor($this->pblmig_db->conn_id);

        //Send parameters variable  value  lenght
      oci_bind_by_name($stid, ':TAHUN', $tahun, 20) or die('Error binding tahun');
      oci_bind_by_name($stid, ':JENISLAP', $jenislap, 20) or die('Error binding jenislap');
      oci_bind_by_name($stid, ':UNITUPI', $unitupi, 20) or die('Error binding unitupi');
      oci_bind_by_name($stid, ':UNITAP', $unitap, 20) or die('Error binding unitap');
      oci_bind_by_name($stid, ':UNITUP', $unitup, 20) or die('Error binding unitup');
      oci_bind_by_name($stid, ':RetVal', $RetVal,-1, OCI_B_CURSOR) or die('Error binding retval');
        //Bind Cursor     put -1

      if(oci_execute($stid)){
          oci_execute($RetVal, OCI_DEFAULT);
          oci_fetch_all($RetVal, $cursor, null, null, OCI_FETCHSTATEMENT_BY_ROW);
          //echo '<br>';
          $results = $cursor;
          //print_r($cursor);  
      }else{
          $e = oci_error($stid);
          $results =  $e['message'];
      } 
      oci_free_statement($stid);
      oci_close($this->pblmig_db->conn_id);

      return $results;

    }

    public function get309delta($tahun, $tahun1, $jenislap, $unitupi, $unitap, $unitup){
        $results = '';
        $this->pblmig_db = $this->load->database('pblmig', true);
        if (!$this->pblmig_db) {
          $m = oci_error();
          trigger_error(htmlentities($m['message']), E_USER_ERROR);
      }
      
      $TAHUN = $tahun;
      $TAHUN1 = $tahun1;
      $JENISLAP = $jenislap;
      $UNITUPI = $unitupi;
      $UNITAP = $unitap;
      $UNITUP = $unitup;

      $stid = oci_parse($this->pblmig_db->conn_id, 'begin  :RetVal := LKTAPP.PKG_INFO_LAPORAN.FUNC_309_DELTA ( :TAHUN, :TAHUN1, :JENISLAP, :UNITUPI, :UNITAP, :UNITUP ); end;');
      $RetVal = oci_new_cursor($this->pblmig_db->conn_id);

        //Send parameters variable  value  lenght
      oci_bind_by_name($stid, ':TAHUN', $tahun, 20) or die('Error binding tahun');
      oci_bind_by_name($stid, ':TAHUN1', $tahun1, 20) or die('Error binding tahun1');
      oci_bind_by_name($stid, ':JENISLAP', $jenislap, 20) or die('Error binding jenislap');
      oci_bind_by_name($stid, ':UNITUPI', $unitupi, 20) or die('Error binding unitupi');
      oci_bind_by_name($stid, ':UNITAP', $unitap, 20) or die('Error binding unitap');
      oci_bind_by_name($stid, ':UNITUP', $unitup, 20) or die('Error binding unitup');
      oci_bind_by_name($stid, ':RetVal', $RetVal,-1, OCI_B_CURSOR) or die('Error binding retval');
        //Bind Cursor     put -1

      if(oci_execute($stid)){
          oci_execute($RetVal, OCI_DEFAULT);
          oci_fetch_all($RetVal, $cursor, null, null, OCI_FETCHSTATEMENT_BY_ROW);
          //echo '<br>';
          $results = $cursor;
          //print_r($cursor);  
      }else{
          $e = oci_error($stid);
          $results =  $e['message'];
      } 
      oci_free_statement($stid);
      oci_close($this->pblmig_db->conn_id);

      return $results;

    }

    public function get404all($tahun, $unitupi, $unitap, $unitup){
        $results = '';
        $this->pblmig_db = $this->load->database('pblmig', true);
        if (!$this->pblmig_db) {
          $m = oci_error();
          trigger_error(htmlentities($m['message']), E_USER_ERROR);
      }

      $VTAHUN = $tahun;
      $V_UNITUPI = $unitupi;
      $V_UNITAP = $unitap;
      $V_UNITUP = $unitup;

      $stid = oci_parse($this->pblmig_db->conn_id, 'begin  :RetVal := LKTAPP.PKG_LAPORAN_404_GRAFIK.FUNC_AMBIL_SALDO ( :VTAHUN, :V_UNITUPI, :V_UNITAP, :V_UNITUP ); end;');
      $RetVal = oci_new_cursor($this->pblmig_db->conn_id);

        //Send parameters variable  value  lenght
      oci_bind_by_name($stid, ':VTAHUN', $tahun, 20) or die('Error binding tahun');
      oci_bind_by_name($stid, ':V_UNITUPI', $unitupi, 20) or die('Error binding unitupi');
      oci_bind_by_name($stid, ':V_UNITAP', $unitap, 20) or die('Error binding unitap');
      oci_bind_by_name($stid, ':V_UNITUP', $unitup, 20) or die('Error binding unitup');
      oci_bind_by_name($stid, ':RetVal', $RetVal,-1, OCI_B_CURSOR) or die('Error binding retval');
        //Bind Cursor     put -1

      if(oci_execute($stid)){
          oci_execute($RetVal, OCI_DEFAULT);
          oci_fetch_all($RetVal, $cursor, null, null, OCI_FETCHSTATEMENT_BY_ROW);
          //echo '<br>';
          $results = $cursor;
          //print_r($cursor);  
      }else{
          $e = oci_error($stid);
          $results =  $e['message'];
      } 
      oci_free_statement($stid);
      oci_close($this->pblmig_db->conn_id);

      return $results;

    }

    public function get404lunas($tahun, $unitupi, $unitap, $unitup){
        $results = '';
        $this->pblmig_db = $this->load->database('pblmig', true);
        if (!$this->pblmig_db) {
          $m = oci_error();
          trigger_error(htmlentities($m['message']), E_USER_ERROR);
      }

      $VTAHUN = $tahun;
      $V_UNITUPI = $unitupi;
      $V_UNITAP = $unitap;
      $V_UNITUP = $unitup;

      $stid = oci_parse($this->pblmig_db->conn_id, 'begin  :RetVal := LKTAPP.PKG_LAPORAN_404_GRAFIK.FUNC_AMBIL_LUNAS ( :VTAHUN, :V_UNITUPI, :V_UNITAP, :V_UNITUP ); end;');
      $RetVal = oci_new_cursor($this->pblmig_db->conn_id);

        //Send parameters variable  value  lenght
      oci_bind_by_name($stid, ':VTAHUN', $tahun, 20) or die('Error binding tahun');
      oci_bind_by_name($stid, ':V_UNITUPI', $unitupi, 20) or die('Error binding unitupi');
      oci_bind_by_name($stid, ':V_UNITAP', $unitap, 20) or die('Error binding unitap');
      oci_bind_by_name($stid, ':V_UNITUP', $unitup, 20) or die('Error binding unitup');
      oci_bind_by_name($stid, ':RetVal', $RetVal,-1, OCI_B_CURSOR) or die('Error binding retval');
        //Bind Cursor     put -1

      if(oci_execute($stid)){
          oci_execute($RetVal, OCI_DEFAULT);
          oci_fetch_all($RetVal, $cursor, null, null, OCI_FETCHSTATEMENT_BY_ROW);
          //echo '<br>';
          $results = $cursor;
          //print_r($cursor);  
      }else{
          $e = oci_error($stid);
          $results =  $e['message'];
      } 
      oci_free_statement($stid);
      oci_close($this->pblmig_db->conn_id);

      return $results;

    }

    public function get404deltasaldo($tahun, $tahun1, $unitupi, $unitap, $unitup){
        $results = '';
        $this->pblmig_db = $this->load->database('pblmig', true);
        if (!$this->pblmig_db) {
          $m = oci_error();
          trigger_error(htmlentities($m['message']), E_USER_ERROR);
      }

      $VTAHUN = $tahun;
      $VTAHUN1 = $tahun1;
      $V_UNITUPI = $unitupi;
      $V_UNITAP = $unitap;
      $V_UNITUP = $unitup;

      $stid = oci_parse($this->pblmig_db->conn_id, 'begin  :RetVal := LKTAPP.PKG_LAPORAN_404_GRAFIK.FUNC_DELTA_SALDO ( :VTAHUN, :VTAHUN1, :V_UNITUPI, :V_UNITAP, :V_UNITUP ); end;');
      $RetVal = oci_new_cursor($this->pblmig_db->conn_id);

        //Send parameters variable  value  lenght
      oci_bind_by_name($stid, ':VTAHUN', $tahun, 20) or die('Error binding tahun');
      oci_bind_by_name($stid, ':VTAHUN1', $tahun1, 20) or die('Error binding tahun 1');
      oci_bind_by_name($stid, ':V_UNITUPI', $unitupi, 20) or die('Error binding unitupi');
      oci_bind_by_name($stid, ':V_UNITAP', $unitap, 20) or die('Error binding unitap');
      oci_bind_by_name($stid, ':V_UNITUP', $unitup, 20) or die('Error binding unitup');
      oci_bind_by_name($stid, ':RetVal', $RetVal,-1, OCI_B_CURSOR) or die('Error binding retval');
        //Bind Cursor     put -1

      if(oci_execute($stid)){
          oci_execute($RetVal, OCI_DEFAULT);
          oci_fetch_all($RetVal, $cursor, null, null, OCI_FETCHSTATEMENT_BY_ROW);
          //echo '<br>';
          $results = $cursor;
          //print_r($cursor);  
      }else{
          $e = oci_error($stid);
          $results =  $e['message'];
      } 
      oci_free_statement($stid);
      oci_close($this->pblmig_db->conn_id);

      return $results;

    }

  public function get404deltalunas($tahun, $tahun1, $unitupi, $unitap, $unitup){
        $results = '';
        $this->pblmig_db = $this->load->database('pblmig', true);
        if (!$this->pblmig_db) {
          $m = oci_error();
          trigger_error(htmlentities($m['message']), E_USER_ERROR);
      }

      $VTAHUN = '2017';
      $VTAHUN1 = '2018';
      $V_UNITUPI = $unitupi;
      $V_UNITAP = $unitap;
      $V_UNITUP = $unitup;

      $stid = oci_parse($this->pblmig_db->conn_id, 'begin  :RetVal := LKTAPP.PKG_LAPORAN_404_GRAFIK.FUNC_DELTA_LUNAS ( :VTAHUN, :VTAHUN1, :V_UNITUPI, :V_UNITAP, :V_UNITUP ); end;');
      $RetVal = oci_new_cursor($this->pblmig_db->conn_id);

        //Send parameters variable  value  lenght
      oci_bind_by_name($stid, ':VTAHUN', $tahun, 20) or die('Error binding tahun');
      oci_bind_by_name($stid, ':VTAHUN1', $tahun1, 20) or die('Error binding tahun 1');
      oci_bind_by_name($stid, ':V_UNITUPI', $unitupi, 20) or die('Error binding unitupi');
      oci_bind_by_name($stid, ':V_UNITAP', $unitap, 20) or die('Error binding unitap');
      oci_bind_by_name($stid, ':V_UNITUP', $unitup, 20) or die('Error binding unitup');
      oci_bind_by_name($stid, ':RetVal', $RetVal,-1, OCI_B_CURSOR) or die('Error binding retval');
        //Bind Cursor     put -1

      if(oci_execute($stid)){
          oci_execute($RetVal, OCI_DEFAULT);
          oci_fetch_all($RetVal, $cursor, null, null, OCI_FETCHSTATEMENT_BY_ROW);
          //echo '<br>';
          $results = $cursor;
          //print_r($cursor);  
      }else{
          $e = oci_error($stid);
          $results =  $e['message'];
      } 
      oci_free_statement($stid);
      oci_close($this->pblmig_db->conn_id);

      return $results;

    }




// </editor-fold>

}
