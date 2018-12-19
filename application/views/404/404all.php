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
                                            <option value="">NASIONAL</option>
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
                <!-- <div id="inchart"><h2 style="text-align: center">404 Saldo All - Cari Data Terlebih Dahulu!</h2></div> -->
                <div id="container" style="width: 100%; padding: 0px 30px 30px 30px">
                    <canvas id="canvas"></canvas>
                </div>  
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body">
                <div id="container" style="width: 100%; padding: 0px 30px 30px 30px">
                    <canvas id="canvas2"></canvas>
                </div>  
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="loading_modal">
        <div class="modal-dialog modal-dialog-centered" role="document" align="center" style="position: relative;top: 50%;-webkit-transform: translateY(-50%);-ms-transform: translateY(-50%);transform: translateY(-50%);">
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
    window.onload = function() {
        renderchart();
        renderchart2();
    };
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
                $("#unitup").find('option').remove();
                $("#unitap").append('<option value="">SEMUA</option>');
                $("#unitup").append('<option value="">-- Pilih UP --</option>');
                $('#unitup').prop('disabled', true);
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
    var texttitle = '';
    var texttitlerp = '';
    var vunitupi='';
    var vunitap='';
    var vunitup='';
    var nunitupi='';
    var nunitap='';
    var nunitup='';
    var rowslbr = [];
    var rowsrp = [];
    var jInit = '<?php echo $init?>';
    if (jInit == 'awal') {
        texttitle = '404 Saldo Lembar - Tahun '+<?php echo date('Y')?>+' (NASIONAL)';
        texttitlerp = '404 Saldo Rupiah - Tahun '+<?php echo date('Y')?>+' (NASIONAL)';
        rowslbr = [ <?php foreach ($data404all as $dt_309) { 
            echo $dt_309['LBR_TOTAL'] . ',';
        }?>];
        rowsrp = [ <?php foreach ($data404all as $dt_309) { 
            echo $dt_309['RUPIAH_TOTAL'] . ',';
        }?>];
    }

    $(document).ready(function(){
        $("#bcari").click(function(){
            var tahun=$('#tahun').val();
            vunitupi=$('#unitupi').val();
            vunitap=$('#unitap').val();
            vunitup=$('#unitup').val();
            vnunitupi=$("#unitupi option:selected").text();
            vnunitap=$("#unitap option:selected").text();
            vnunitup=$("#unitup option:selected").text();

            if (tahun == null || tahun == '') {
                show_failed_notification('WARNING!','Tahun Tidak Boleh Kosong');
            } else{
                $.ajax({
                    type: "post",
                    url: "<?php echo site_url('data_404/getdata404/saldoall') ?>",
                    cache: false,               
                    data:{"tahun":tahun, "unitupi":vunitupi, "unitap":vunitap, "unitup":vunitup, "nunitupi":vnunitupi, "nunitap":vnunitap, "nunitup":vnunitup},
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
                    var jsonrp = obj.data404all;
                    var jtahun = obj.tahun;
                    var junitupi = obj.unitupi;
                    var junitap = obj.unitap;
                    var junitup = obj.unitup;
                    var jnunitupi = obj.nunitupi;
                    var jnunitap = obj.nunitap;
                    var jnunitup = obj.nunitup;
                    var msg = obj.msg;
                    var status = obj.status;
                    texttitle = '';
                    texttitlerp = '';
                    jInit == 'akhir';
                    rowslbr.splice(0, rowslbr.length);
                    rowsrp.splice(0, rowsrp.length);

                    if (status == 'Kosong') {
                        show_failed_notification(status, msg);
                        $('#inchart').show();
                    }else{

                        $('#inchart').hide();

                        if (junitupi != "" && junitap != "" && junitup != "") {
                            texttitlerp = '404 Saldo Rupiah - Tahun '+jtahun+' ('+jnunitup+')'
                            texttitle = '404 Saldo Lembar - Tahun '+jtahun+' ('+jnunitup+')'
                        } else if(junitupi != "" && junitap != ""){
                            texttitlerp = '404 Saldo Rupiah - Tahun '+jtahun+' ('+jnunitap+')'
                            texttitle = '404 Saldo Lembar - Tahun '+jtahun+' ('+jnunitap+')'
                        } else {
                            texttitlerp = '404 Saldo Rupiah - Tahun '+jtahun+' ('+jnunitupi+')'
                            texttitle = '404 Saldo Lembar - Tahun '+jtahun+' ('+jnunitupi+')'
                        }

                        for (var i = 0; i < obj.data404all.length; i++) {
                            var LBR_TOTAL = obj.data404all[i].LBR_TOTAL;
                            var RUPIAH_TOTAL = obj.data404all[i].RUPIAH_TOTAL;
                            var THBL = obj.data404all[i].THBL;

                            rowslbr.push(
                                parseInt(LBR_TOTAL)     
                                );

                            rowsrp.push(
                                parseInt(RUPIAH_TOTAL)     
                                );
                        };  
                        renderchart();
                        renderchart2();
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

    var barChartData = {
        labels:['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        datasets: [{
            label: 'Lembar',
            backgroundColor: window.chartColors.blue,
            borderColor: window.chartColors.blue,
            borderWidth: 1,
            data: rowslbr
        }]

    };

    var barChartDataRupiah = {
        labels:['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        datasets: [{
            label: 'Rupiah',
            backgroundColor: window.chartColors.red,
            borderColor: window.chartColors.red,
            borderWidth: 1,
            data: rowsrp
        }]

    };

    function addCommas(nStr)
    {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + '.' + '$2');
        }
        return x1 + x2;
    }

    function renderchart(){
        var ctx = document.getElementById('canvas').getContext('2d');
        window.myBar = new Chart(ctx, {
            plugins:    [{
                            afterDatasetsDraw: function(chart) {
                                var ctx = chart.ctx;

                                chart.data.datasets.forEach(function(dataset, i) {
                                    var meta = chart.getDatasetMeta(i);
                                    if (!meta.hidden) {
                                        meta.data.forEach(function(element, index) {
                                                    // Draw the text in black, with the specified font
                                                    ctx.fillStyle = 'rgb(0, 0, 0)';

                                                    var fontSize = 8;
                                                    var fontStyle = 'normal';
                                                    var fontFamily = 'Helvetica Neue';
                                                    ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);

                                                    // Just naively convert to string for now
                                                    var dataString = dataset.data[index].toString();
                                                    dataString = 'Rp '+dataString;

                                                    // Make sure alignment settings are correct
                                                    ctx.textAlign = 'center';
                                                    ctx.textBaseline = 'middle';

                                                    var padding = 5;
                                                    var position = element.tooltipPosition();
                                                    ctx.fillText(addCommas(dataString), position.x, position.y - (fontSize / 2) - padding);
                                                });
                                    }
                                });
                            }
                        }],  
            type: 'bar',
            data: barChartDataRupiah,
            options: {
                responsive: true,
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: true,
                    fontSize: 20,
                    padding: 30,
                    text: texttitlerp
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            callback: function(label, index, labels) {
                                if (vunitap == '00'|| vunitap == '') {
                                   return label/1000000000000+'T';
                                   }else{
                                    return label/1000000000+'M';
                                }
                            },  
                            min: 0
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var value = data.datasets[0].data[tooltipItem.index];
                            value = value.toString();
                            value = value.split(/(?=(?:...)*$)/);
                            value = value.join('.');
                            value = 'Rp '+value;
                            return value;
                        }
                    } // end callbacks:
                }
            }
        });
    }

    function renderchart2(){
        var ctx = document.getElementById('canvas2').getContext('2d');
        window.myBar = new Chart(ctx, {
            plugins:    [{
                            afterDatasetsDraw: function(chart) {
                                var ctx = chart.ctx;

                                chart.data.datasets.forEach(function(dataset, i) {
                                    var meta = chart.getDatasetMeta(i);
                                    if (!meta.hidden) {
                                        meta.data.forEach(function(element, index) {
                                                    // Draw the text in black, with the specified font
                                                    ctx.fillStyle = 'rgb(0, 0, 0)';

                                                    var fontSize = 10;
                                                    var fontStyle = 'normal';
                                                    var fontFamily = 'Helvetica Neue';
                                                    ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);

                                                    // Just naively convert to string for now
                                                    var dataString = dataset.data[index].toString();
                                                    dataString = dataString+'(Lbr)';

                                                    // Make sure alignment settings are correct
                                                    ctx.textAlign = 'center';
                                                    ctx.textBaseline = 'middle';

                                                    var padding = 5;
                                                    var position = element.tooltipPosition();
                                                    ctx.fillText(addCommas(dataString), position.x, position.y - (fontSize / 2) - padding);
                                                });
                                    }
                                });
                            }
                        }],  
            type: 'bar',
            data: barChartData,
            options: {
                responsive: true,
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: true,
                    fontSize: 20,
                    padding: 30,
                    text: texttitle
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            callback: function(label, index, labels) {
                                if (vunitap == '00' || vunitap == '') {
                                 return label/1000000+'Jt';
                                }else{
                                    return label/1000+'Rb';
                                }
                            },  
                            min: 0
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var value = data.datasets[0].data[tooltipItem.index];
                            value = value.toString();
                            value = value.split(/(?=(?:...)*$)/);
                            value = value.join('.');
                            value = value + '(Lembar)';
                            return value;
                        }
                    } // end callbacks:
                }
            }
        });
    }

</script>