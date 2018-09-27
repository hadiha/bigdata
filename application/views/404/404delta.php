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
                            <h3 style="margin-top: 0px; margin-bottom: 30px"><b>404 Delta Saldo</b></h3>
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
                                            <option value="">NASIONAL</option>
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
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <select name="tahun1" id="tahun1" class="form-control">
                                            <option value="">--- Pilih Tahun ---</option>
                                            <?php foreach ($rs_tahun as $index => $tahun) { ?>
                                                        <option value="<?php echo $tahun; ?>" <?php if ($search['tahun'] == $tahun) {
                                            echo " selected";
                                        } ?>><?php echo $tahun; ?></option>   
                                                    <?php } ?>
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

var barChartData = {
    labels: ['Januari', 'Febuari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
    datasets: [{
        type: 'bar',
        label: '2017',
        backgroundColor: window.chartColors.blue,
        data: [
            <?php 
                foreach ($data404saldo as $dt_404) { 
                    if (in_array('GRAFIK1', $dt_404)) {
                        echo $dt_404['LBR_TOTAL'] . ',';
                        }
            }; ?>
            
        ],
        borderColor: 'white',
        borderWidth: 2
    }, {
        type: 'bar',
        label: '2018',
        backgroundColor: window.chartColors.red,
        data: [
        <?php 
                foreach ($data404saldo as $dt_404) { 
                    if (in_array('GRAFIK2', $dt_404)) {
                        echo $dt_404['LBR_TOTAL'] . ',';
                        }
            }; ?>
        ],
        borderColor: 'white',
        borderWidth: 2
    }]

};  

var barChartDataRupiah = {
    labels: ['Januari', 'Febuari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
    datasets: [{
        type: 'bar',
        label: '2017',
        backgroundColor: window.chartColors.blue,
        data: [
            <?php 
                foreach ($data404saldo as $dt_404) { 
                    if (in_array('GRAFIK1', $dt_404)) {
                        echo $dt_404['RUPIAH_TOTAL'] . ',';
                        }
            }; ?>
            
        ],
        borderColor: 'white',
        borderWidth: 2
    }, {
        type: 'bar',
        label: '2018',
        backgroundColor: window.chartColors.red,
        data: [
        <?php 
                foreach ($data404saldo as $dt_404) { 
                    if (in_array('GRAFIK2', $dt_404)) {
                        echo $dt_404['RUPIAH_TOTAL'] . ',';
                        }
            }; ?>
        ],
        borderColor: 'white',
        borderWidth: 2
    }]

};

function createConfig(data,title) {
            return {
               type: 'bar',
                data: barChartDataRupiah,
                options: {
                    responsive: true,
                    legend: {
                        position: 'bottom',
                    },
                    title: {
                        display: true,
                        text: 'Saldo Rupiah'
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: true
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
                data: barChartData,
                options: {
                    responsive: true,
                    legend: {
                        position: 'bottom',
                    },
                    title: {
                        display: true,
                        text: 'Saldo Lembar'
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: true
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

window.onload = function() {
            var container = document.querySelector('.container');
            var container2 = document.querySelector('.container2');

            [{
                data: barChartData,
                title: '404 Saldo Lembar - <?php echo $tahun ?>'
            }, {
                data: barChartDataRupiah,
                title: '404 Saldo Rupiah - <?php echo $tahun ?>'
            }].forEach(function(details) {
                var div = document.createElement('div');
                div.classList.add('chart-container');

                var canvas = document.createElement('canvas');
                div.appendChild(canvas);
                if (details.data == barChartData) {
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


// window.onload = function() {
//     var ctx = document.getElementById('canvas').getContext('2d');
//     window.myMixedChart = new Chart(ctx, {
//         type: 'bar',
//         data: barChartData,
//         options: {
//             responsive: true,
//             legend: {
//                 position: 'bottom',
//             },
//             title: {
//                 display: true,
//                 text: 'Perbulan Delta'
//             },
//             tooltips: {
//                 mode: 'index',
//                 intersect: true
//             },
//             scales: {
//                         yAxes: [{
//                             ticks: {
//                                 callback: function(label, index, labels) {
//                                     return label/1000000+'Jt';
//                                 },  
//                                 min: 0
//                             }
//                         }]
//                     }
//         }
//     });
// };


</script>