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
                                <h3 style="margin-top: 0px; margin-bottom: 30px"><b>309 Rupiah Perbulan All</b></h3>
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
        <div id="container" style="width: 100%; padding: 0px 30px 30px 30px">
            <canvas id="canvas"></canvas>
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

// chart start

var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
var color = Chart.helpers.color;
var barChartData = {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
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
                text: '309 Rupiah'
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


</script>