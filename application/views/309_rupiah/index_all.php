<?php
$PESAN = $this->session->userdata('PESAN');
?>
<section class="content">
<div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <form id="form_upload" class="form-horizontal" method="POST" enctype="multipart/form-data" >
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
                                        <select name="jenislap" id="jenislap" class="form-control" required="true">
                                            <option value="">--- Pilih Jenis Laporan ---</option>
                                            <option value="LPB">PRABAYAR</option>
                                            <option value="NORMAL">PASCA</option>
                                            <option value="TOTAL">GABUNGAN</option>   
                                        </select>
                                    </div>
                                </div>
                            </div>  
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-primary" id="bcari"  name="button" value="cari" onclick="cari()"><i class="fa fa-search fa-fw"></i> Cari</button>
                                        <button class="btn btn-default" name="button" value="reset"><i class="fa  fa-refresh fa-fw" ></i> Reset</button>
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
                    <div id="container" style="width: 100%; padding: 0px 30px 30px 30px">
                        <canvas id="canvas"></canvas>
                    </div>  
                </div>
            </div>
        </div>
</div>
</section>
<script type="text/javascript">

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

        if (level_ap != 00) {
          $('#unitup').prop('disabled', false);
        } else {
          $('#unitup').prop('disabled', true);
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
        label: 'Rupiah',
        backgroundColor: window.chartColors.blue,
        borderColor: window.chartColors.blue,
        borderWidth: 1,
        data: [
            <?php foreach ($dataall as $dt_rupiah) { 
                echo $dt_rupiah['RPPTL'] . ',';
            }?>
        ]
    }]

};

var dataY = [{
    ticks: {
        callback: function(label, index, labels) {
            <?php if (!empty($unitupi) or !empty($unitap) or !empty($unitup)): ?>
                return label/1000000000+'M';
            <?php else: ?>
                return label/1000000000000+'T';
            <?php endif ?>
        },  
        min: 0
    }
}]

var texttitle = <?php if (!empty($unitupi) && !empty($unitap) && !empty($unitup)): ?>
                    '309 Rupiah <?php echo $jenislap ?> - <?php echo $unitup ?> Tahun <?php echo $tahun ?>'
                <?php elseif (!empty($unitupi) && !empty($unitap)): ?>
                    '309 Rupiah <?php echo $jenislap ?> - <?php echo $unitap ?> Tahun <?php echo $tahun ?>'
                <?php else: ?>
                    '309 Rupiah <?php echo $jenislap ?> - <?php echo $unitupi ?> Tahun <?php echo $tahun ?>'
                <?php endif ?>

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
                fontSize: 18,
                fontStyle: 'bold',
                padding: 20,
                text: texttitle
            },
            scales: {
                yAxes: dataY
            }
        }
    });

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

                            var fontSize = 11;
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

function cari(){
    var tahun=$('#tahun').val();
    var jenislap=$('#jenislap').val();
    var unitupi=$('#unitupi').val();
    var unitap=$('#unitap').val();
    var unitup=$('#unitup').val();
    $('#form_filter').ajaxForm ({
        type: "POST",
        url: "<?php echo base_url('Rupiah_309/data309/perbulan'); ?>",
        data: {"tahun":tahun, "jenislap":jenislap, "unitupi":unitupi, "unitap":unitap, "unitup":unitup},
        success: function(msg) {
            var data = $data
            console.log(data);
        }
    });
}

</script>