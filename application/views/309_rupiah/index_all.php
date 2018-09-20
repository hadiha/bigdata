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
            <div class="box box-primary">
                <div class="box-body"  style="height: 350px;">
                    <div class="col-sm-6">
                        <div id="309Rupiah" style="height: 320px; max-width: 920px; margin: 0px auto;"></div>
                    </div>
                    <div class="col-sm-6">
                        <div id="309Kwh" style="height: 320px; max-width: 920px; margin: 0px auto;"></div>
                    </div>
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

var chart = new CanvasJS.Chart("309Rupiah", {
    animationEnabled: true,
    theme: "dark 2", // "light1", "light2", "dark1", "dark2"
    title:{
        text: "309 (Rupiah)"
    },
    axisY: {
        title: "Rupiah"
    },
    data: [{        
        type: "column",  
        // showInLegend: true, 
        legendMarkerColor: "grey",
        legendText: "Bulan",
        dataPoints: [      
            { y: 300878, label: "Jan", indexLabel: "300878" },
            { y: 266455,  label: "Feb", indexLabel: "266455"},
            { y: 169709,  label: "Mar", indexLabel: "169709" },
            { y: 158400,  label: "Apr", indexLabel: "158400" },
            { y: 142503,  label: "Mei", indexLabel: "142503" },
            { y: 101500, label: "Jun", indexLabel: "101500" },
            { y: 97800,  label: "Jul", indexLabel: "97800" },
            { y: 80000,  label: "Agu", indexLabel: "80000" },
            { y: 102350,  label: "Sep", indexLabel: "102350" },
            { y: 182800,  label: "Okt", indexLabel: "182800" },
            { y: 90280,  label: "Nov", indexLabel: "90280" },
            { y: 120340,  label: "Des", indexLabel: "120340" },
        ]
    }]
});
chart.render();

var chart = new CanvasJS.Chart("309Kwh", {
    animationEnabled: true,
    theme: "dark 2", // "light1", "light2", "dark1", "dark2"
    title:{
        text: "309 (Kwh)"
    },
    axisY: {
        title: "Kwh"
    },
    data: [{        
        type: "column",  
        // showInLegend: true, 
        legendMarkerColor: "grey",
        legendText: "Bulan",
        dataPoints: [      
            { y: 300878, label: "Jan", indexLabel: "300878" },
            { y: 266455,  label: "Feb", indexLabel: "266455"},
            { y: 169709,  label: "Mar", indexLabel: "169709" },
            { y: 158400,  label: "Apr", indexLabel: "158400" },
            { y: 142503,  label: "Mei", indexLabel: "142503" },
            { y: 101500, label: "Jun", indexLabel: "101500" },
            { y: 97800,  label: "Jul", indexLabel: "97800" },
            { y: 80000,  label: "Agu", indexLabel: "80000" },
            { y: 102350,  label: "Sep", indexLabel: "102350" },
            { y: 182800,  label: "Okt", indexLabel: "182800" },
            { y: 90280,  label: "Nov", indexLabel: "90280" },
            { y: 120340,  label: "Des", indexLabel: "120340" },
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