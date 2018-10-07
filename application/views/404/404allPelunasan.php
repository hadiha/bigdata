<?php
$PESAN = $this->session->userdata('PESAN');
?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <form id="form_filter" class="form-horizontal" method="POST" enctype="multipart/form-data" >
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
                                        <select name="tahun" id="tahun" class="form-control">
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
                    <div id="inchart"><h2 style="text-align: center">404 Lunas All - Cari Data Terlebih Dahulu!</h2></div>
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

        if (level != '') {
          $('#unitap').prop('disabled', false);
        } else {
          $('#unitap').prop('disabled', true);
          $('#unitup').prop('disabled', true);
        }
        ;
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

        if (level_ap != '') {
          $('#unitup').prop('disabled', false);
        } else {
          $('#unitup').prop('disabled', true);
        }
        ;
    })

    // chart start
    var texttitle = '';
    var texttitlerp = '';
    var vunitupi='';
    var vunitap='';
    var vunitup='';
    var rowslbr = [];
    var rowsrp = [];
    var rowsthbl = [];

    $(document).ready(function(){
        $("#bcari").click(function(){
            var tahun=$('#tahun').val();
            vunitupi=$('#unitupi').val();
            vunitap=$('#unitap').val();
            vunitup=$('#unitup').val();

            if (tahun == null || tahun == '') {
                show_failed_notification('WARNING!','Tahun Tidak Boleh Kosong');
            } else{
                $.ajax({
                type: "post",
                url: "<?php echo site_url('data_404/getdata404/lunasall') ?>",
                cache: false,               
                data:{"tahun":tahun, "unitupi":vunitupi, "unitap":vunitap, "unitup":vunitup},
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
                    var obj = JSON.parse(data);
                    var jsonrp = obj.data404all;
                    var jtahun = obj.tahun;
                    var junitupi = obj.unitupi;
                    var junitap = obj.unitap;
                    var junitup = obj.unitup;
                    var msg = obj.msg;
                    var status = obj.status;
                    rowslbr.splice(0, rowslbr.length);
                    rowsrp.splice(0, rowsrp.length);
                    rowsthbl.splice(0, rowsthbl.length);

                    if (status == 'Kosong') {
                        show_failed_notification(status, msg);
                        $('#inchart').show();
                    }else{

                        $('#inchart').hide();

                        if (junitupi != "" && junitap != "" && junitup != "") {
                            texttitlerp = '404 Lunas Rupiah - Tahun '+jtahun+' ('+junitup+')'
                            texttitle = '404 Lunas Lembar - Tahun '+jtahun+' ('+junitup+')'
                        } else if(junitupi != "" && junitap != ""){
                            texttitlerp = '404 Lunas Rupiah - Tahun '+jtahun+' ('+junitap+')'
                            texttitle = '404 Lunas Lembar - Tahun '+jtahun+' ('+junitap+')'
                        } else {
                            texttitlerp = '404 Lunas Rupiah - Tahun '+jtahun+' ('+junitupi+')'
                            texttitle = '404 Lunas Lembar - Tahun '+jtahun+' ('+junitupi+')'
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

                            rowsthbl.push(
                                parseInt(THBL)           
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
    });     

    var barChartData = {
        labels:rowsthbl,
        datasets: [{
            label: 'Lembar',
            backgroundColor: window.chartColors.blue,
            borderColor: window.chartColors.blue,
            borderWidth: 1,
            data: rowslbr
        }]

    };

    var barChartDataRupiah = {
        labels:rowsthbl,
        datasets: [{
            label: 'Rupiah',
            backgroundColor: window.chartColors.red,
            borderColor: window.chartColors.red,
            borderWidth: 1,
            data: rowsrp
        }]

    };

    var dataY = [{
        ticks: {
            callback: function(label, index, labels) {
                if (vunitupi == '00' || vunitupi == '') {
                     return label/1000000000000+'T';
                }else{
                    return label/1000000000+'M';
                }
            },  
            min: 0
        }
    }]

    var dataY2 = [{
        ticks: {
            callback: function(label, index, labels) {
                if (vunitupi == '00' || vunitupi == '') {
                     return label/1000000+'Jt';
                }else{
                    return label/1000+'Rb';
                }
            },  
            min: 0
        }
    }]

    function createConfig(data,title) {
            return {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    legend: {
                        position: 'bottom',
                    },  
                    title: {
                        display: true,
                        fontSize: 20,
                        padding: 30,
                        text: title
                    },
                    scales: {
                        yAxes: dataY
                    }
                }
            };
        }

    function createConfig2(data,title) {
            return {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    legend: {
                        position: 'bottom',
                    },  
                    title: {
                        display: true,
                        fontSize: 20,
                        padding: 30,
                        text: title
                    },
                    scales: {
                        yAxes: dataY2
                    }
                }
            };
        }

    Chart.plugins.register({
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

                                // Make sure alignment settings are correct
                                ctx.textAlign = 'center';
                                ctx.textBaseline = 'middle';

                                var padding = 5;
                                var position = element.tooltipPosition();
                                ctx.fillText(dataString, position.x, position.y - (fontSize / 2) - padding);
                            });
                }
            });
        }
    });

    function renderchart(){
        var ctx = document.getElementById('canvas').getContext('2d');
        window.myBar = new Chart(ctx, {
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
                    yAxes: dataY
                }
            }
        });
    }

    function renderchart2(){
        var ctx = document.getElementById('canvas2').getContext('2d');
        window.myBar = new Chart(ctx, {
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
                    yAxes: dataY2
                }
            }
        });
    }

</script>