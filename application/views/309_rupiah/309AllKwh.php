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
                            <h3 style="margin-top: 0px; margin-bottom: 30px">309 Perbulan All</h3>
                            </div>    
                        </div>
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
                    </div>
                </form>
            </div>
        </div>
            <!-- <div class="box box-primary">
                <div class="box-body"  style="height: 380px;">
                        <div id="309Rupiah" style="height: 350px; max-width: 920px; margin: 0px auto;"></div>
                </div>
            </div> -->
            <div class="box box-primary">
                <div class="box-body"  style="height: 380px;">
                        <div id="309Kwh" style="height: 350px; max-width: 920px; margin: 0px auto;"></div>
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

// chart start
window.onload = function () {

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

var chart = new CanvasJS.Chart("309Kwh", {
    animationEnabled: true,
    theme: "dark 2", // "light1", "light2", "dark1", "dark2"
    title:{
        text: "309 (Kwh)"
    },
    axisX: {
        valueFormatString: "MMM"
    },
    axisY: {
        title: "Kwh"
    },
     toolTip: {
        shared: true
    },
    data: [{        
        type: "column",  
        // showInLegend: true, 
        legendMarkerColor: "grey",
        legendText: "Bulan",
        xValueFormatString: "MMMM YYYY",
        yValueFormatString: "$#,##0",
        dataPoints: [      
            { x: new Date(2018, 0), y: 300878, indexLabel: "300878" },
            { x: new Date(2018, 1), y: 266455, indexLabel: "266455"},
            { x: new Date(2018, 2), y: 169709, indexLabel: "169709" },
            { x: new Date(2018, 3), y: 158400, indexLabel: "158400" },
            { x: new Date(2018, 4), y: 142503, indexLabel: "142503" },
            { x: new Date(2018, 5), y: 101500,indexLabel: "101500" },
            { x: new Date(2018, 6), y: 97800, indexLabel: "97800" },
            { x: new Date(2018, 7), y: 80000, indexLabel: "80000" },
            { x: new Date(2018, 8), y: 102350, indexLabel: "102350" },
            { x: new Date(2018, 9), y: 182800, indexLabel: "182800" },
            { x: new Date(2018, 10), y: 90280, indexLabel: "90280" },
            { x: new Date(2018, 11), y: 120340, indexLabel: "120340" },
        ]
    }]
});
chart.render();

}



// var chart = null;
// var dataPoints = [];

// window.onload = function() {

// chart = new CanvasJS.Chart("chartContainer", {
//     animationEnabled: true,
//     theme: "light2",
//     title: {
//         text: "Perbulan All"
//     },
//     axisY: {
//         title: "Units",
//         titleFontSize: 24
//     },
//     data: [{
//         type: "column",
//         yValueFormatString: "#,### Units",
//         dataPoints: dataPoints
//     }]
// });


// $.getJSON("https://canvasjs.com/data/gallery/javascript/daily-sales.json?callback=?", callback);    

// }

// function callback(data) {   
//     for (var i = 0; i < data.dps.length; i++) {
//         dataPoints.push({
//             x: new Date(data.dps[i].date),
//             y: data.dps[i].units
//         });
//     }
//     chart.render(); 
// }
// end chart
</script>