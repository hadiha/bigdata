<?php
$PESAN = $this->session->userdata('PESAN');
?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary" style="padding-left: 10px; padding-top: 10px">
                <form id="form_upload" action="<?php echo site_url('#'); ?>" class="form-horizontal" method="POST" enctype="multipart/form-data" >
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                            <h3 style="margin-top: 0px; margin-bottom: 30px"><b>309 Kwh Perbulan All</b></h3>
                            </div>    
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="col-sm-12 control-label" style="text-align:left"> Wilayah : </label>
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
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="col-sm-12 control-label" style="text-align:left"> Tahun : </label>
                                </div>
                            </div>
                            <div class="col-md-2">
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
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="col-sm-12 control-label" style="text-align:left"> Jenis Laporan : </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <select name="jenislap" id="jenislap" class="form-control">
                                            <option value="">--- Pilih Jenis Laporan ---</option>
                                            <option value="">LPB</option>
                                            <option value="">Pasca</option>
                                            <option value="">Gabungan</option>   
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">  
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-primary" id="bcari"  name="button" value="cari" ><i class="fa fa-search fa-fw"></i> Cari</button>
                                        <button class="btn btn-default" name="button" value="reset"><i class="fa  fa-refresh fa-fw" ></i> Reset</button>
                                        <!-- <button id="randomizeData">Randomize Data</button> -->
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
            <div class="box box-primary">
                <div class="box-body">
                    <div id="container" style="width: 100%; padding: 0px 30px 30px 30px;">
                        <canvas id="canvas"></canvas>
                    </div>
                </div>
            </div>
            <!-- <div class="box box-primary">
                <div class="box-body"  style="height: 350px;">
                        <div id="309Kwh" style="height: 320px; max-width: 920px; margin: 0px auto;"></div>
                </div>
            </div> -->
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

// chart start

var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
var color = Chart.helpers.color;
var barChartData = {
            labels: [
                <?php foreach ($dataall as $dt_rupiah) { 
                    echo $dt_rupiah['THBLLAP'] . ',';
                }?>
            ],
            datasets: [{
                label: 'Kwh',
                backgroundColor: window.chartColors.green,
                borderColor: window.chartColors.green,
                borderWidth: 1,
                data: [
                    <?php foreach ($dataall as $dt_rupiah) { 
                        echo $dt_rupiah['JMLKWH'] . ',';
                    }?>
                ]
            }]

        };

Chart.plugins.register({
            afterDatasetsDraw: function(chart) {
                var ctx = chart.ctx;

                chart.data.datasets.forEach(function(dataset, i) {
                    var meta = chart.getDatasetMeta(i);
                    if (!meta.hidden) {
                        meta.data.forEach(function(element, index) {
                            // Draw the text in black, with the specified font
                            ctx.fillStyle = 'rgb(0, 0, 0)';

                            var fontSize = 9;
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

window.onload = function() {
    var ctx = document.getElementById('canvas').getContext('2d');
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
                text: '309 (Kwh)'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        min: 0
                    }
                }]
            }
        }
    });

};

// var chart = new CanvasJS.Chart("309Rupiah", {
//     animationEnabled: true,
//     theme: "dark 2", // "light1", "light2", "dark1", "dark2"
//     title:{
//         text: "309 (Rupiah)"
//     },
//     axisX: {
//         valueFormatString: "MMM"
//     },
//     axisY: {
//         title: "Rupiah"
//     },
//      toolTip: {
//         shared: true
//     },
//     data: [{        
//         type: "column",  
//         // showInLegend: true, 
//         legendMarkerColor: "grey",
//         legendText: "Bulan",
//         xValueFormatString: "MMMM YYYY",
//         yValueFormatString: "$#,##0",
//         dataPoints: [      
//             { x: new Date(2018, 0), y: 300878, indexLabel: "300878" },
//             { x: new Date(2018, 1), y: 266455, indexLabel: "266455"},
//             { x: new Date(2018, 2), y: 169709, indexLabel: "169709" },
//             { x: new Date(2018, 3), y: 158400, indexLabel: "158400" },
//             { x: new Date(2018, 4), y: 142503, indexLabel: "142503" },
//             { x: new Date(2018, 5), y: 101500,indexLabel: "101500" },
//             { x: new Date(2018, 6), y: 97800, indexLabel: "97800" },
//             { x: new Date(2018, 7), y: 80000, indexLabel: "80000" },
//             { x: new Date(2018, 8), y: 102350, indexLabel: "102350" },
//             { x: new Date(2018, 9), y: 182800, indexLabel: "182800" },
//             { x: new Date(2018, 10), y: 90280, indexLabel: "90280" },
//             { x: new Date(2018, 11), y: 120340, indexLabel: "120340" },
//         ]
//     }]
// });
// chart.render();


// end chart
</script>