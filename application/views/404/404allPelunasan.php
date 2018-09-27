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
                            <h3 style="margin-top: 0px; margin-bottom: 30px"><b>404 LUNAS</b></h3>
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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-primary" id="bcari"  name="button" value="cari" ><i class="fa fa-search fa-fw"></i> Cari</button>
                                        <button class="btn btn-default" name="button" value="reset"><i class="fa  fa-refresh fa-fw" ></i> Reset</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row">
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
                          </div> -->
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="container" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="container2" style="width: 100%;"></div>
                    </div>
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
              url: "<?php echo site_url('data_404/get_all_ap') ?>",
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
              url: "<?php echo site_url('data_404/get_all_up') ?>",
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

    var barChartData = {
        labels: [
        <?php foreach ($data404lunas as $dt_404) { 
            echo $dt_404['THBL'] . ',';
        }?>     
        ],
        datasets: [{
            label: 'Lembar',
            backgroundColor: window.chartColors.red,
            borderColor: window.chartColors.red,
            data: [
            <?php foreach ($data404lunas as $dt_404) { 
                echo $dt_404['LBR_TOTAL'] . ',';
            }?>
            ],
            fill: false,
        }]

    };

    var barChartDataRupiah = {
        labels: [
        <?php foreach ($data404lunas as $dt_404) { 
            echo $dt_404['THBL'] . ',';
        }?>     
        ],
        datasets: [{
            label: 'Rupiah',
            backgroundColor: window.chartColors.blue,
            borderColor: window.chartColors.blue,
            data: [
            <?php foreach ($data404lunas as $dt_404) { 
                echo $dt_404['RUPIAH_TOTAL'] . ',';
            }?>
            ],
            fill: false,
        }]

    };

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
                        fontSize: 18,
                        fontStyle: 'bold',
                        text: title
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                callback: function(label, index, labels) {
                                    return label/1000000000000+'T';
                                },  
                                min: 0
                            }
                        }]
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
                        fontSize: 18,
                        fontStyle: 'bold',
                        text: title
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                callback: function(label, index, labels) {
                                    return label/1000000+'Jt';
                                },  
                                min: 0
                            }
                        }]
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
            var container = document.querySelector('.container');
            var container2 = document.querySelector('.container2');

            [{
                data: barChartData,
                title: '404 Lunas Lembar - <?php echo $tahun ?>'
            }, {
                data: barChartDataRupiah,
                title: '404 Lunas Rupiah - <?php echo $tahun ?>'
            }].forEach(function(details) {
                var div = document.createElement('div');
                div.classList.add('chart-container');

                var canvas = document.createElement('canvas');
                div.appendChild(canvas);
                if (details.data == barChartDataRupiah) {
                    container.appendChild(div); 
                    var config = createConfig(details.data,details.title);
                }else{
                    container2.appendChild(div)
                    var config = createConfig2(details.data,details.title);
                }

                var ctx = canvas.getContext('2d');
                new Chart(ctx, config);
            });
    };

function cari(){
    var tahun=$('#tahun').val();
    var upi=$('#upi').val();
    var ap=$('#ap').val();
    var up=$('#up').val();
    $('#form_filter').ajaxForm ({
        type: "POST",
        url: "<?php echo base_url('data_404/pelunasan'); ?>",
        data: {"tahun":tahun, "upi":upi, "ap":ap , "up":up},
        success: function(msg) {
            var data = $data
            console.log(data);
        }
    });
}
</script>