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
                                    <label class="col-sm-12 control-label" style="text-align:left"> Tahun : </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <select name="tahun" id="tahun" class="form-control">
                                            <option value="">--- Pilih Tahun ---</option>
                                            <?php foreach ($rs_tahun as $index => $tahun) { ?>
                                                        <option value="<?php echo $tahun; ?>" <?php if ($filterTahun == $tahun) {
                                            echo " selected";
                                        } ?>><?php echo $tahun; ?></option>   
                                                    <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <select name="tahunBdg" id="tahunBdg" class="form-control">
                                            <option value="">--- Pilih Tahun Pembanding---</option>
                                            <?php foreach ($rs_tahun as $index => $tahun) { ?>
                                                        <option value="<?php echo $tahun; ?>" <?php if ($filterTahunBdg == $tahun) {
                                            echo " selected";
                                        } ?>><?php echo $tahun; ?></option>   
                                                    <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-primary" id="bcari"  name="button" value="cari" ><i class="fa fa-search fa-fw"></i> Cari</button>
                                        <!-- <button class="btn btn-default" name="button" value="reset"><i class="fa  fa-refresh fa-fw" ></i> Reset</button> -->
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
                        <!-- <div id="inchart"><h2 style="text-align: center">404 Saldo Delta - Cari Data Terlebih Dahulu!</h2></div> -->
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

var barChartData = {
    labels: ['Januari', 'Febuari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
    datasets: [{
        type: 'line',
        label: 'Line <?php echo $filterTahun ?>',
        borderColor: window.chartColors.blue,
        borderWidth: 2,
        fill: false,
        data: [
            <?php 
                foreach ($data404deltalunas as $dt_404) { 
                    if (in_array('GRAFIK1', $dt_404)) {
                        echo $dt_404['RUPIAH_TOTAL'] . ',';
                        }
            }; ?>
        ]
    },{
        type: 'line',
        label: 'Line <?php echo $filterTahunBdg ?>',
        borderColor: window.chartColors.red,
        borderWidth: 2,
        fill: false,
        data: [
            <?php 
                foreach ($data404deltalunas as $dt_404) { 
                    if (in_array('GRAFIK2', $dt_404)) {
                        echo $dt_404['RUPIAH_TOTAL'] . ',';
                        }
            }; ?>
        ]
    },{
        type: 'bar',
        label: <?php echo $filterTahun ?>,
        backgroundColor: window.chartColors.blue,
        data: [
            <?php 
                foreach ($data404deltalunas as $dt_404) { 
                    if (in_array('GRAFIK1', $dt_404)) {
                        echo $dt_404['RUPIAH_TOTAL'] . ',';
                        }
            }; ?>
            
        ],
        borderColor: 'white',
        borderWidth: 2
    }, {
        type: 'bar',
        label: <?php echo $filterTahunBdg ?>,
        backgroundColor: window.chartColors.red,
        data: [
        <?php 
                foreach ($data404deltalunas as $dt_404) { 
                    if (in_array('GRAFIK2', $dt_404)) {
                        echo $dt_404['RUPIAH_TOTAL'] . ',';
                        }
            }; ?>
        ],
        borderColor: 'white',
        borderWidth: 2
    }], 

};  

var barChartDataLb = {
    labels: ['Januari', 'Febuari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
    datasets: [{
        type: 'line',
        label: 'Line <?php echo $filterTahun ?>',
        borderColor: window.chartColors.blue,
        borderWidth: 2,
        fill: false,
        data: [
            <?php 
                foreach ($data404deltalunas as $dt_404) { 
                    if (in_array('GRAFIK1', $dt_404)) {
                        echo $dt_404['LBR_TOTAL'] . ',';
                        }
            }; ?>
        ]
    },{
        type: 'line',
        label: 'Line <?php echo $filterTahunBdg ?>',
        borderColor: window.chartColors.red,
        borderWidth: 2,
        fill: false,
        data: [
            <?php 
                foreach ($data404deltalunas as $dt_404) { 
                    if (in_array('GRAFIK2', $dt_404)) {
                        echo $dt_404['LBR_TOTAL'] . ',';
                        }
            }; ?>
        ]
    },{
        type: 'bar',
        label: <?php echo $filterTahun ?>,
        backgroundColor: window.chartColors.blue,
        data: [
            <?php 
                foreach ($data404deltalunas as $dt_404) { 
                    if (in_array('GRAFIK1', $dt_404)) {
                        echo $dt_404['LBR_TOTAL'] . ',';
                        }
            }; ?>
            
        ],
        borderColor: 'white',
        borderWidth: 2
    }, {
        type: 'bar',
        label: <?php echo $filterTahunBdg ?>,
        backgroundColor: window.chartColors.red,
        data: [
        <?php 
                foreach ($data404deltalunas as $dt_404) { 
                    if (in_array('GRAFIK2', $dt_404)) {
                        echo $dt_404['LBR_TOTAL'] . ',';
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
                data: barChartData,
                options: {
                    responsive: true,
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true
                        }
                    },
                    title: {
                        display: true,
                        text: title
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: true
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                callback: function(label, index, labels) {
                                    <?php if (!empty($filterAp) or !empty($filterUp)): ?>
                                        return label/1000000000+'M';
                                    <?php else: ?>
                                        return label/1000000000000+'T';
                                    <?php endif ?>
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
                data: barChartDataLb,
                options: {
                    responsive: true,
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true
                        }
                    },
                    title: {
                        display: true,
                        text: title
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: true
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                callback: function(label, index, labels) {
                                    <?php if (!empty($filterAp) or !empty($filterUp)): ?>
                                        return label/1000+'K';
                                    <?php else: ?>
                                        return label/1000000+'J';
                                    <?php endif ?>
                                },  
                                min: 0
                            }
                        }]
                    }
                }
            };
        }

        var titleRp = <?php if (!empty($filterUpi) && !empty($filterAp) && !empty($filterUp)): ?>
                    '404 Delta Rupiah - <?php echo $filterUp ?> Tahun <?php echo $filterTahunBdg ?>/<?php echo $filterTahun ?>'
                <?php elseif (!empty($filterUpi) && !empty($filterAp)): ?>
                    '404 Delta Rupiah - <?php echo $filterAp ?> Tahun <?php echo $filterTahunBdg ?>/<?php echo $filterTahun ?>'
                <?php else: ?>
                    '404 Delta Rupiah - <?php echo $filterUpi ?> Tahun <?php echo $filterTahunBdg ?>/<?php echo $filterTahun ?>'
                <?php endif ?>

        var titleLb = <?php if (!empty($filterUpi) && !empty($filterAp) && !empty($filterUp)): ?>
                    '404 Delta Lembar - <?php echo $filterUp ?> Tahun <?php echo $filterTahunBdg ?>/<?php echo $filterTahun ?>'
                <?php elseif (!empty($filterUpi) && !empty($filterAp)): ?>
                    '404 Delta Lembar - <?php echo $filterAp ?> Tahun <?php echo $filterTahunBdg ?>/<?php echo $filterTahun ?>'
                <?php else: ?>
                    '404 Delta Lembar - <?php echo $filterUpi ?> Tahun <?php echo $filterTahunBdg ?>/<?php echo $filterTahun ?>'
                <?php endif ?>

        window.onload = function() {
            var container = document.querySelector('.container');
            var container2 = document.querySelector('.container2');

            [{
                data: barChartData,
                title: titleRp
            }, {
                data: barChartDataLb,
                title: titleLb
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

    function cari(){
        var tahun=$('#tahun').val();
        var tahunBdg=$('#tahunBdg').val();
        var unitupi=$('#unitupi').val();
        var unitap=$('#unitap').val();
        var unitup=$('#unitup').val();
         $('#inchart').hide();
        $('#form_filter').ajaxForm({
            type: "POST",
            url: "<?php echo base_url('data_404/delta_saldo'); ?>",
            data: {"tahun":tahun, "tahunBdg":tahunBdg, "unitupi":unitupi, "unitap":unitap , "unitup":unitup},
            beforeSend: function () {
                $('#bcari').attr('disabled', 'disabled');
                $('#bcari').button('loading');
                // loading
                $('#loading_modal').modal({
                    backdrop: 'static', keyboard: false
                });
            },
            success: function(msg) {
                $('#inchart').hide();
                var data = $data
                console.log(data);
            }
        });
    }
</script>