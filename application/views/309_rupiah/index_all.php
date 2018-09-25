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
                                        <select name="upi" id="upi" class="form-control" disabled="">
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
                                            <option value="">PASCA</option>
                                            <option value="">GABUNGAN</option>   
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
                    <div class="chart">
                    <canvas id="barChart" style="height:230px"></canvas>
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
<script src="<?php echo base_url('assets/plugins/chartjs/Chart.min.js');?>"></script>
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

// var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
// var color = Chart.helpers.color;
// var barChartData = {
//             labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
//             datasets: [{
//                 label: 'Rupiah',
//                 backgroundColor: window.chartColors.blue,
//                 borderColor: window.chartColors.blue,
//                 borderWidth: 1,
//                 data: [
//                     21168669541747,
//                     19404129616478,
//                     21639585845008,
//                     21798989183430,
//                     22690068441818,
//                     19619568735686,
//                     22177087303262,
//                     22326414019154
//                 ]
//             }]

//         };

// Chart.plugins.register({
//             afterDatasetsDraw: function(chart) {
//                 var ctx = chart.ctx;

//                 chart.data.datasets.forEach(function(dataset, i) {
//                     var meta = chart.getDatasetMeta(i);
//                     if (!meta.hidden) {
//                         meta.data.forEach(function(element, index) {
//                             // Draw the text in black, with the specified font
//                             ctx.fillStyle = 'rgb(0, 0, 0)';

//                             var fontSize = 9;
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

// window.onload = function() {
//     var ctx = document.getElementById('canvas').getContext('2d');
//     window.myBar = new Chart(ctx, {
//         type: 'bar',
//         data: barChartData,
//         options: {
//             responsive: true,
//             legend: {
//                 position: 'bottom',
//             },
//             title: {
//                 display: true,
//                 text: '309 (Rupiah)'
//             },
//             scales: {
//                 yAxes: [{
//                     ticks: {
//                         min: 0
//                     }
//                 }]
//             }
//         }
//     });

// };

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

  $(function () {
        /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         */
        var areaChartData = {
          labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
          datasets: [
            {
              label: "Electronics",
              fillColor: "rgba(210, 214, 222, 1)",
              strokeColor: "rgba(210, 214, 222, 1)",
              pointColor: "rgba(210, 214, 222, 1)",
              pointStrokeColor: "#c1c7d1",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(220,220,220,1)",
              data: [
                <?php foreach ($rs_tiket_bulanan as $dt_tiket) { 
                    echo $dt_tiket['TIKET_PERBULAN'] . ',';
                }?>
              ]
            }
          ]
        };



        //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
        var pieChart = new Chart(pieChartCanvas);
        var PieData = [
        <?php if(isset($rs_jml_pertransaksi[0]['TOTAL_PERTRANSAKSI'])){ ?>
        
          {
            value: <?php  echo $rs_jml_pertransaksi[0]['TOTAL_PERTRANSAKSI']; ?>,
            color: "#f56954",
            highlight: "#f56954",
            label: "<?php  echo $rs_jml_pertransaksi[0]['JENIS_TRANSAKSI']; ?>"
          },
          {
            value: <?php  echo $rs_jml_pertransaksi[1]['TOTAL_PERTRANSAKSI']; ?>,
            color: "#00a65a",
            highlight: "#00a65a",
            label: "<?php  echo $rs_jml_pertransaksi[1]['JENIS_TRANSAKSI']; ?>"
          },
          {
            value: <?php  echo $rs_jml_pertransaksi[2]['TOTAL_PERTRANSAKSI']; ?>,
            color: "#f39c12",
            highlight: "#f39c12",
            label: "<?php  echo $rs_jml_pertransaksi[2]['JENIS_TRANSAKSI']; ?>"
          },
          {
            value: <?php  echo $rs_jml_pertransaksi[3]['TOTAL_PERTRANSAKSI']; ?>,
            color: "#00c0ef",
            highlight: "#00c0ef",
            label: "<?php  echo $rs_jml_pertransaksi[3]['JENIS_TRANSAKSI']; ?>"
          },
          {
            value: <?php  echo $rs_jml_pertransaksi[4]['TOTAL_PERTRANSAKSI']; ?>,
            color: "#3c8dbc",
            highlight: "#3c8dbc",
            label: "<?php  echo $rs_jml_pertransaksi[4]['JENIS_TRANSAKSI']; ?>"
          },
          {
            value: <?php  echo $rs_jml_pertransaksi[5]['TOTAL_PERTRANSAKSI']; ?>,
            color: "#d2d6de",
            highlight: "#d2d6de",
            label: "<?php  echo $rs_jml_pertransaksi[5]['JENIS_TRANSAKSI']; ?>"
          }
          <?php }else{ ?> 

          {
            value: 1,
            color: "#d2d6de",
            highlight: "#d2d6de",
            label: "Data kosong."
          }

            <?php } ?>
        ];
        var pieOptions = {
          //Boolean - Whether we should show a stroke on each segment
          segmentShowStroke: true,
          //String - The colour of each segment stroke
          segmentStrokeColor: "#fff",
          //Number - The width of each segment stroke
          segmentStrokeWidth: 2,
          //Number - The percentage of the chart that we cut out of the middle
          percentageInnerCutout: 50, // This is 0 for Pie charts
          //Number - Amount of animation steps
          animationSteps: 100,
          //String - Animation easing effect
          animationEasing: "easeOutBounce",
          //Boolean - Whether we animate the rotation of the Doughnut
          animateRotate: true,
          //Boolean - Whether we animate scaling the Doughnut from the centre
          animateScale: false,
          //Boolean - whether to make the chart responsive to window resizing
          responsive: true,
          // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: true,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
        };
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        pieChart.Doughnut(PieData, pieOptions);

        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas = $("#barChart").get(0).getContext("2d");
        var barChart = new Chart(barChartCanvas);
        var barChartData = areaChartData;
        barChartData.datasets[0].fillColor = "#00a65a";
        barChartData.datasets[0].strokeColor = "#00a65a";
        barChartData.datasets[0].pointColor = "#00a65a";
        var barChartOptions = {
          //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
          scaleBeginAtZero: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: true,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - If there is a stroke on each bar
          barShowStroke: true,
          //Number - Pixel width of the bar stroke
          barStrokeWidth: 2,
          //Number - Spacing between each of the X value sets
          barValueSpacing: 5,
          //Number - Spacing between data sets within X values
          barDatasetSpacing: 1,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to make the chart responsive
          responsive: true,
          maintainAspectRatio: true
        };

        barChartOptions.datasetFill = false;
        barChart.Bar(barChartData, barChartOptions);
      });
// end chart
</script>