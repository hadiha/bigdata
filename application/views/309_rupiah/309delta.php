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
                            <div class="col-md-12">
                            <h3 style="margin-top: 0px; margin-bottom: 30px"><b>309 Perbulan All</b></h3>
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
                    <div style="width: 100%; padding: 0px 30px 30px 30px;">
                        <canvas id="canvas"></canvas>
                    </div>  
                </div>
            </div>
            <!-- <div class="box box-primary">
                <div class="box-body" style="height: 350px;">
                    <div id="chartContainer2" style="height: 320px; max-width: 920px; margin: 0px auto;"></div>
                </div>
            </div> -->
    </div>


</section>
<script type="text/javascript">

    // $('#upi').change(function () {
    //   var level = $(this).val();
    //     if(level){
    //       $.ajax ({
    //           type: "POST",
    //           url: "<?php echo site_url('Rupiah_309/get_all_ap') ?>",
    //           data: {'level': level},
    //           success : function(response) {
    //             var output = $.parseJSON(response);
    //             $("#ap").find('option').remove();
    //             $("#ap").append('<option value="">SEMUA</option>');
    //             $.each(output,function(key, value)
    //             {
    //                 $("#ap").append('<option value=' + value.UNIT_AP + '>' + value.UNITAP+ '</option>');
    //             });
    //           }
    //       });
    //     }

    //     if (level != 00) {
    //       $('#ap').prop('disabled', false);
    //     } else {
    //       $('#ap').prop('disabled', true);
    //       $('#up').prop('disabled', true);
    //     }
    //     ;
    // })


    // $('#ap').change(function () {
    //   var level_ap = $(this).val();
    //     if(level_ap){
    //       $.ajax ({
    //           type: "POST",
    //           url: "<?php echo site_url('Rupiah_309/get_all_up') ?>",
    //           data: {'level_ap': level_ap},
    //           success : function(response) {
    //             var rs = $.parseJSON(response);
    //             $("#up").find('option').remove();
    //             $("#up").append('<option value="">SEMUA</option>');
    //             $.each(rs,function(key, value)
    //             {
    //                 $("#up").append('<option value=' + value.UNIT_UP + '>' + value.UNITUP+ '</option>');
    //             });
    //           }
    //       });
    //     }

    //     if (level_ap != 00) {
    //       $('#up').prop('disabled', false);
    //     } else {
    //       $('#up').prop('disabled', true);
    //     }
    //     ;
    // })

// chart start

var chartData = {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    datasets: [{
        type: 'bar',
        label: '2017',
        backgroundColor: window.chartColors.blue,
        data: [
        19155138885833,
        17541448903849,
        20227438062873,
        19753473416446,
        21148304997972,
        19371284613957,
        20616446984580,
        21193551673230,
        20818843568606,
        22012136779321,
        21287024472178,
        20901069433923
        ],
        borderColor: 'white',
        borderWidth: 2
    }, {
        type: 'bar',
        label: '2018',
        backgroundColor: window.chartColors.red,
        data: [
        21168669541747,
        19404129616478,
        21639585845008,
        21798989183430,
        22690068441818,
        19619568735686,
        22177087303262,
        22326414019154,
        0,
        0,
        0,
        0
        ],
        borderColor: 'white',
        borderWidth: 2
    }]

};

// Chart.plugins.register({
//             afterDatasetsDraw: function(chart) {
//                 var ctx = chart.ctx;

//                 chart.data.datasets.forEach(function(dataset, i) {
//                     var meta = chart.getDatasetMeta(i);
//                     if (!meta.hidden) {
//                         meta.data.forEach(function(element, index) {
//                             // Draw the text in black, with the specified font
//                             ctx.fillStyle = 'rgb(0, 0, 0)';

//                             var fontSize = 10;
//                             var fontStyle = 'normal';
//                             var fontFamily = 'Helvetica Neue';
//                             ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);

//                             // Just naively convert to string for now
//                             var dataString = dataset.data[index].toString();

//                             // Make sure alignment settings are correct
//                             ctx.textAlign = 'center';
//                             ctx.textBaseline = 'middle';

//                             var padding = 5;
//                             var position = element.tooltipPosition();
//                             ctx.fillText(dataString, position.x, position.y - (fontSize / 2) - padding);
//                         });
//                     }
//                 });
//             }
//         });

window.onload = function() {
    var ctx = document.getElementById('canvas').getContext('2d');
    window.myMixedChart = new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
            },
            title: {
                display: true,
                text: 'Perbulan Delta 2018'
            },
            tooltips: {
                mode: 'index',
                intersect: true
            }
        }
    });
};

// window.onload = function () {

// var chart = new CanvasJS.Chart("chartContainer", {
//     animationEnabled: true,
//     title:{
//         text: "309 (Rupiah)"
//     },  
//     axisX: {
//         valueFormatString: "MMM"
//     },
//     axisY: {
//         title: "Rupiah Tahun Ini",
//         titleFontColor: "#4F81BC",
//         lineColor: "#4F81BC",
//         labelFontColor: "#4F81BC",
//         tickColor: "#4F81BC"
//     },
//     axisY2: {
//         title: "Rupiah Tahun Lalu",
//         titleFontColor: "#C0504E",
//         lineColor: "#C0504E",
//         labelFontColor: "#C0504E",
//         tickColor: "#C0504E"
//     },  
//     toolTip: {
//         shared: true
//     },
//     legend: {
//         cursor:"pointer",
//         itemclick: toggleDataSeries
//     },
//     data: [{
//         type: "column",
//         name: "Tahun Ini",
//         legendText: "Tahun Ini",
//         showInLegend: true, 
//         xValueFormatString: "MMMM YYYY",
//         yValueFormatString: "$#,##0",
//         dataPoints:[
//             { x: new Date(2016, 0), y: 266.21 },
//             { x: new Date(2016, 1), y: 302.25 },
//             { x: new Date(2016, 2), y: 157.20 },
//             { x: new Date(2016, 3), y: 148.77},
//             { x: new Date(2016, 4), y: 101.50 },
//             { x: new Date(2016, 5), y: 97.8 },
//             { x: new Date(2016, 6), y: 120.23 },
//             { x: new Date(2016, 7), y: 201.18 },
//             { x: new Date(2016, 8), y: 303.8 },
//             { x: new Date(2016, 9), y: 221.43},
//             { x: new Date(2016, 10), y: 123.8 },
//             { x: new Date(2016, 11), y: 97.8 }
//         ]
//     },
//     {
//         type: "column", 
//         name: "Tahun Lalu",
//         legendText: "Tahun Lalu",
//         axisYType: "secondary",
//         xValueFormatString: "MMMM YYYY",
//         yValueFormatString: "$#,##0",
//         showInLegend: true,
//         dataPoints:[
//             { x: new Date(2016, 0), y: 157.20 },
//             { x: new Date(2016, 1), y: 101.50 },
//             { x: new Date(2016, 2), y: 221.43 },
//             { x: new Date(2016, 3), y: 148.77},
//             { x: new Date(2016, 4), y: 266.21 },
//             { x: new Date(2016, 5), y: 97.8 },
//             { x: new Date(2016, 6), y: 120.23 },
//             { x: new Date(2016, 7), y: 201.18 },
//             { x: new Date(2016, 8), y: 157.20 },
//             { x: new Date(2016, 9), y: 123.8},
//             { x: new Date(2016, 10), y: 303.8 },
//             { x: new Date(2016, 11), y: 97.8 }
//         ]
//     },
//     {
//         type: "line",
//         name: "Tahun Ini",
//         showInLegend: true,
//         yValueFormatString: "$#,##0",
//         dataPoints: [
//             { x: new Date(2016, 0), y: 266.21 },
//             { x: new Date(2016, 1), y: 302.25 },
//             { x: new Date(2016, 2), y: 157.20 },
//             { x: new Date(2016, 3), y: 148.77},
//             { x: new Date(2016, 4), y: 101.50 },
//             { x: new Date(2016, 5), y: 97.8 },
//             { x: new Date(2016, 6), y: 120.23 },
//             { x: new Date(2016, 7), y: 201.18 },
//             { x: new Date(2016, 8), y: 303.8 },
//             { x: new Date(2016, 9), y: 221.43},
//             { x: new Date(2016, 10), y: 123.8 },
//             { x: new Date(2016, 11), y: 97.8 }
//         ]
//     },
//     {
//         type: "line",
//         name: "Tahun Lalu",
//         showInLegend: true,
//         axisYType: "secondary",
//         yValueFormatString: "$#,##0",
//         dataPoints: [
//             { x: new Date(2016, 0), y: 157.20 },
//             { x: new Date(2016, 1), y: 101.50 },
//             { x: new Date(2016, 2), y: 221.43 },
//             { x: new Date(2016, 3), y: 148.77},
//             { x: new Date(2016, 4), y: 266.21 },
//             { x: new Date(2016, 5), y: 97.8 },
//             { x: new Date(2016, 6), y: 120.23 },
//             { x: new Date(2016, 7), y: 201.18 },
//             { x: new Date(2016, 8), y: 157.20 },
//             { x: new Date(2016, 9), y: 123.8},
//             { x: new Date(2016, 10), y: 303.8 },
//             { x: new Date(2016, 11), y: 97.8 }
//         ]
//     },]
// });
// chart.render();

// function toggleDataSeries(e) {
//     if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
//         e.dataSeries.visible = false;
//     }
//     else {
//         e.dataSeries.visible = true;
//     }
//     chart.render();
// }

// }
</script>