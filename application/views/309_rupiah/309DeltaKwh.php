<?php
$PESAN = $this->session->userdata('PESAN');
?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div align="center"><a href="#" id="klik">KLIK UNTUK FILTER</a></div>
                <form id="form_filter" class="form-horizontal" method="POST" enctype="multipart/form-data" hidden="">
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
                                        <select name="unitupi" id="unitupi" class="form-control">
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
                                    <select name="unitap" id="unitap" class="form-control" disabled="disabled">
                                        <option value="">--- Pilih AP ---</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <select name="unitup" id="unitup" class="form-control" disabled="disabled">
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
                                    <select name="tahun" id="tahun" class="form-control" required="true">
                                        <option value="">--- Pilih Tahun ---</option>
                                        <?php foreach ($rs_tahun as $index => $tahun) { ?>
                                            <option value="<?php echo $tahun; ?>" <?php if (date('Y') == $tahun) {
                                                echo " selected";
                                            } ?>><?php echo $tahun; ?></option>   
                                        <?php } ?>
                                    </select>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <select name="tahun1" id="tahun1" class="form-control" required="true">
                                    <option value="">--- Pilih Tahun ---</option>
                                    <?php foreach ($rs_tahun as $index => $tahun1) { ?>
                                        <option value="<?php echo $tahun1; ?>" <?php if (date('Y')-1 == $tahun1) {
                                            echo " selected";
                                        } ?>><?php echo $tahun1; ?></option>   
                                    <?php } ?>
                                </select>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <select name="jenislap" id="jenislap" class="form-control" required="true">
                                <option value="">--- Pilih Jenis Laporan ---</option>
                                <option value="LPB">PRABAYAR</option>
                                <option value="NORMAL">PASCA</option>
                                <option value="TOTAL" selected="">GABUNGAN</option>   
                            </select>
                        </div>
                    </div>
                </div>  
                <div class="col-md-2">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-primary" id="bcari"  name="button" value="cari"><i class="fa fa-search fa-fw"></i> Cari</button>
                            <!-- <button class="btn btn-default" name="button" value="reset"><i class="fa  fa-refresh fa-fw" ></i> Reset</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
</div>
<div class="col-md-12">
    <div class="box box-primary">
        <div class="box-body">
            <!-- <div id="inchart"><h2 style="text-align: center">309 Rupiah Delta - Cari Data Terlebih Dahulu!</h2></div> -->
            <div id="container" style="width: 100%; padding: 0px 30px 30px 30px;min-height: 75vh">
                <canvas id="canvas"></canvas>
            </div>  
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="loading_modal">
    <div class="modal-dialog modal-dialog-centered" role="document" style="margin-top: 300px; margin-left: 650px">
        <img src="<?php echo base_url('assets/dist/img/ajax-loader.gif');?>" alt=""/>
    </div>
</div>
<div id="notifikasi" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5><i id="font" class="fa"></i> <div style="display:inline" id="status"></div></h5>
            </div>
            <div class="modal-body">
                <p id="teks"></p>
            </div>
            <div class="modal-footer">
                <button id="button_close" type="button" class="btn" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</div>
</section>

<script type="text/javascript">
    function show_failed_notification(status, pesan){
        $('#notifikasi').modal('show');
        $('#notifikasi').addClass('modal-warning');
        $('#font').addClass('fa-warning fa-fw');
        $('#button_close').addClass('btn-warning');
        $('#status').html(status);
        $('#teks').html(pesan);
    }

    $('#unitupi').change(function () {
      var level = $(this).val();
      if(level){
          $.ajax ({
              type: "POST",
              url: "<?php echo site_url('Rupiah_309/get_all_ap') ?>",
              data: {'level': level},
              success : function(response) {
                var output = $.parseJSON(response);
                $("#unitap").find('option').remove();
                $("#unitap").append('<option value="">SEMUA</option>');
                $.each(output,function(key, value)
                {
                    $("#unitap").append('<option value=' + value.UNIT_AP + '>' + value.UNITAP+ '</option>');
                });
            }
        });
      }

      if (level != 00) {
            $('#unitap').prop('disabled', false);
        } else {
            $("#unitup").find('option').remove();
            $("#unitap").find('option').remove();
            $("#unitap").append('<option value="">SEMUA</option>');
            $("#unitup").append('<option value="">SEMUA</option>');
            $('#unitap').prop('disabled', true);
            $('#unitup').prop('disabled', true);
        };
  })


    $('#unitap').change(function () {
      var level_ap = $(this).val();
      if(level_ap){
          $.ajax ({
              type: "POST",
              url: "<?php echo site_url('Rupiah_309/get_all_up') ?>",
              data: {'level_ap': level_ap},
              success : function(response) {
                var rs = $.parseJSON(response);
                $("#unitup").find('option').remove();
                $("#unitup").append('<option value="">SEMUA</option>');
                $.each(rs,function(key, value)
                {
                    $("#unitup").append('<option value=' + value.UNIT_UP + '>' + value.UNITUP+ '</option>');
                });
            }
        });
      }

      if (level_ap != 00) {
            $('#unitup').prop('disabled', false);
        } else {
            $("#unitup").find('option').remove();
            $("#unitup").append('<option value="">SEMUA</option>');  
            $('#unitup').prop('disabled', true);
        };
  })

// chart start

var jInit = '<?php echo $init?>';
var texttitle = '';
var datalabel = '';
var datalabel2 = '';
if (jInit == 'awal') {
    datalabel = '<?php echo date('Y')?>';
    datalabel2 = '<?php echo date('Y')-1?>';
    texttitle = '309 Kwh Delta Gabungan - Tahun '+<?php echo date('Y')?>+'/'+<?php echo date('Y')-1?>+' (NASIONAL)';
    rowsall = [ <?php foreach ($datadelta as $dt_309) { 
        echo $dt_309['JMLKWH'] . ',';
    }?>];
    rowsall2 = [ <?php foreach ($datadelta as $dt_309) { 
        echo $dt_309['JMLKWH_2'] . ',';
    }?>];
}

var vunitupi='';
var vunitap='';
var vunitup='';
var nunitupi='';
var nunitap='';
var nunitup='';

$(document).ready(function(){
    $("#bcari").click(function(){
        var tahun=$('#tahun').val();
        var tahun1=$('#tahun1').val();
        var jenislap=$('#jenislap').val();
        vunitupi=$('#unitupi').val();
        vunitap=$('#unitap').val();
        vunitup=$('#unitup').val();
        vnunitupi=$("#unitupi option:selected").text();
        vnunitap=$("#unitap option:selected").text();
        vnunitup=$("#unitup option:selected").text();

        if (tahun == null || tahun == '') {
            show_failed_notification('WARNING!','Tahun Tidak Boleh Kosong');
        }else if(tahun1 == null || tahun1 == ''){
            show_failed_notification('WARNING!','Tahun Pembanding Tidak Boleh Kosong');
        }else if(jenislap == null || jenislap == ''){
            show_failed_notification('WARNING!','Jenislap Tidak Boleh Kosong');
        }else{
            $.ajax({
                type: "post",
                url: "<?php echo site_url('Rupiah_309/getdelta309') ?>",
                cache: false,               
                data:{"tahun":tahun, "tahun1":tahun1, "jenislap":jenislap, "unitupi":vunitupi, "unitap":vunitap, "unitup":vunitup, "nunitupi":vnunitupi, "nunitap":vnunitap, "nunitup":vnunitup},
                beforeSend: function () {
                    $('#bcari').attr('disabled', 'disabled');
                    $('#bcari').button('loading');
                    // loading
                    $('#loading_modal').modal({
                        backdrop: 'static', keyboard: false
                    });
                },
                success: function(data){
                    $('#loading_modal').modal('hide');
                    $('#bcari').removeAttr('disabled');
                    $('#bcari').button('reset');
                    $('#form_filter').hide();
                    $('#klik').show();
                    var obj = JSON.parse(data);
                    var jsonrp = obj.datadelta;
                    var jtahun = obj.datatahun;
                    var jtahun1 = obj.tahun1;
                    var jjenislap = obj.jenislap;
                    var junitupi = obj.unitupi;
                    var junitap = obj.unitap;
                    var junitup = obj.unitup;
                    var msg = obj.msg;
                    var status = obj.status;
                    texttitle = '';
                    jInit = 'akhir';
                    rowsall.splice(0, rowsall.length);
                    rowsall2.splice(0, rowsall2.length);

                    if (status == 'Kosong') {
                        show_failed_notification(status, msg);
                        myBar.destroy();
                        $('#inchart').show();
                    }else{

                        $('#inchart').hide();

                        if (junitupi != "" && junitap != "" && junitup != "") {
                            texttitle = '309 Kwh Delta '+jenislap+' - Tahun '+jtahun+'/'+jtahun1+' ('+junitup+')'
                        } else if(junitupi != "" && junitap != ""){
                            texttitle = '309 Kwh Delta '+jenislap+' - Tahun '+jtahun+'/'+jtahun1+' ('+junitap+')'
                        } else {
                            texttitle = '309 Kwh Delta '+jenislap+' - Tahun '+jtahun+'/'+jtahun1+' ('+junitupi+')'
                        }

                        datalabel = jtahun
                        datalabel2 = jtahun1

                        for (var i = 0; i < obj.datadelta.length; i++) {
                            var JMLKWH = obj.datadelta[i].JMLKWH;
                            var JMLKWH_2 = obj.datadelta[i].JMLKWH_2;
                            var THBLLAP = obj.datadelta[i].THBLLAP;
                            
                            rowsall.push(
                                parseInt(JMLKWH)     
                            );

                            rowsall2.push(
                                parseInt(JMLKWH_2)     
                            );
                        };  
                        renderchart();
                    }
                }   

            });
            return false;
        }
    });
    $("#klik").click(function(){
        $('#form_filter').show();
        $('#klik').hide();
    });
}); 

var dataY = [{
    ticks: {
        callback: function(label, index, labels) {
            if (vunitupi == '00' || vunitupi == '') {
                 return label/1000000000+'M';
            }else{
                return label/1000000+'Jt';
            }
        },  
        min: 0
    }
}]

window.onload = function() {
    renderchart();
};

function renderchart(){
    var ctx = document.getElementById('canvas').getContext('2d');
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: {
            labels:['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                type: 'line',
                label: datalabel,
                borderColor: window.chartColors.blue,
                borderWidth: 2,
                fill: false,
                data: rowsall
            },{
                type: 'line',
                label: datalabel2,
                borderColor: window.chartColors.red,
                borderWidth: 2,
                fill: false,
                data: rowsall2
            },{
                type: 'bar',
                label: datalabel,
                backgroundColor: window.chartColors.blue,
                data: rowsall,
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'bar',
                label: datalabel2,
                backgroundColor: window.chartColors.red,
                data: rowsall2,
                borderColor: 'white',
                borderWidth: 2
            }]

        },
        options: {
            // maintainAspectRatio: false,
            responsive: true,
            legend: {
                position: 'bottom',
                labels: {
                    usePointStyle: true
                }   
            },
            title: {
                display: true,
                fontSize: 20,
                padding: 30,
                text: texttitle
            },
            scales: {
                yAxes: dataY
            },
            tooltips: {
              callbacks: {
                label: function(tooltipItem, data) {
                    var value = data.datasets[0].data[tooltipItem.index];
                    value = value.toString();
                    value = value.split(/(?=(?:...)*$)/);
                    value = value.join('.');
                    value = value+'(Lembar)';
                    return value;
                }
                  } // end callbacks:
              },
        }
    });
}

</script>