<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class mdashboard extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }

    public function get309all($tahun, $jenislap){
        $results = '';
        $this->pblmig_db = $this->load->database('pblmig', true);
        if (!$this->pblmig_db) {
          $m = oci_error();
          trigger_error(htmlentities($m['message']), E_USER_ERROR);
      }

      $TAHUN = $tahun;
      $JENISLAP = $jenislap;

      $stid = oci_parse($this->pblmig_db->conn_id, 'begin  :RetVal := LKTAPP.PKG_INFO_LAPORAN.FUNC_309_NASIONAL ( :TAHUN, :JENISLAP ); end;');
      $RetVal = oci_new_cursor($this->pblmig_db->conn_id);

        //Send parameters variable  value  lenght
      oci_bind_by_name($stid, ':TAHUN', $tahun, 20) or die('Error binding tahun');
      oci_bind_by_name($stid, ':JENISLAP', $jenislap, 20) or die('Error binding jenislap');
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
