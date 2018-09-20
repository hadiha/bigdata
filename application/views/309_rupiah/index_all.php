<?php
$PESAN = $this->session->userdata('PESAN');
?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <form id="form_upload" action="<?php echo site_url('#'); ?>" class="form-horizontal" method="POST" enctype="multipart/form-data" >
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="col-sm-12 control-label" style="text-align:left"> FILTER : </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <select name="upi" id="upi" class="form-control">
                                            <option value="00">NASIONAL</option>
                                              <?php foreach ($total_upi as $row) { ?>
                                              <option value="<?php echo $row['UNIT_UPI']; ?>" ><?php echo strtoupper($row['UNITUPI']); ?></option>   
                                              <?php } ?>
                                        </select>
                                    </div>
                                </div>                                  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <select name="ap" id="ap" class="form-control" disabled="disabled">
                                            <option value="">--- Pilih AP ---</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <select name="up" id="up" class="form-control" disabled="disabled">
                                            <option value="">--- Pilih UP ---</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="col-sm-12 control-label"> </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <select name="bulan" id="bulan" class="form-control">
                                            <option value="">--- Pilih Bulan ---</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <select name="tahun" id="tahun" class="form-control">
                                            <option value="">--- Pilih Tahun ---</option>
                                            <?php foreach ($rs_tahun as $index => $tahun) { ?>
                                                        <option value="<?php echo $tahun; ?>" <?php if ($search['tahun'] == $tahun) {
                                            echo " selected";
                                        } ?>><?php echo $tahun; ?></option>   
                                                    <?php } ?>
                                                </select>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-primary" id="bcari"  name="button" value="cari" ><i class="fa fa-search fa-fw"></i> Cari</button>
                                        <button class="btn btn-default" name="button" value="reset"><i class="fa  fa-refresh fa-fw" ></i> Reset</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


</section>
<script type="text/javascript">

    $('#upi').change(function () {
      var level = $(this).val();
        if(level){
          $.ajax ({
              type: "POST",
              url: "<?php echo site_url('Rupiah_309/get_all_ap') ?>",
              data: {'level': level},
              success : function(response) {
                var output = $.parseJSON(response);
                $("#ap").find('option').remove();
                $("#ap").append('<option value="">SEMUA</option>');
                $.each(output,function(key, value)
                {
                    $("#ap").append('<option value=' + value.UNIT_AP + '>' + value.UNITAP+ '</option>');
                });
              }
          });
        }

        if (level != 00) {
          $('#ap').prop('disabled', false);
        } else {
          $('#ap').prop('disabled', true);
          $('#up').prop('disabled', true);
        }
        ;
    })


    $('#ap').change(function () {
      var level_ap = $(this).val();
        if(level_ap){
          $.ajax ({
              type: "POST",
              url: "<?php echo site_url('Rupiah_309/get_all_up') ?>",
              data: {'level_ap': level_ap},
              success : function(response) {
                var rs = $.parseJSON(response);
                $("#up").find('option').remove();
                $("#up").append('<option value="">SEMUA</option>');
                $.each(rs,function(key, value)
                {
                    $("#up").append('<option value=' + value.UNIT_UP + '>' + value.UNITUP+ '</option>');
                });
              }
          });
        }

        if (level_ap != 00) {
          $('#up').prop('disabled', false);
        } else {
          $('#up').prop('disabled', true);
        }
        ;
    })

</script>