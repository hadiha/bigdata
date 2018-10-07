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
                                        <!-- <button class="btn btn-default" name="button" value="reset"><i class="fa  fa-refresh fa-fw" ></i> Reset</button> -->
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
                    <div id="inchart"><h2 style="text-align: center">309 Kwh Komulatif - Cari Data Terlebih Dahulu!</h2></div>
                    <div id="container" style="width: 100%; padding: 0px 30px 30px 30px">
                        <canvas id="canvas"></canvas>
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

var jInit = '<?php echo $init?>';
var texttitle = '';
if(jInit == 'akhir'){
    var rowsall = [];
    var rowsthbl = [];
}else{
    var rowsall =   [
                        <?php foreach ($dataall as $dt_rupiah) { 
                            echo $dt_rupiah['KWH_KOMULATIF'] . ',';
                        }?>
                    ];
    var rowsthbl =  [
                        <?php foreach ($dataall as $dt_rupiah) { 
                            echo $dt_rupiah['THBLLAP'] . ',';
                        }?>
                    ];
    texttitle = <?php if (!empty($unitupi) && !empty($unitap) && !empty($unitup)): ?>
                    '309 Kwh Komulatif <?php echo $jenislap ?> - Tahun <?php echo $tahun ?> (<?php echo $unitup ?>)'
                <?php elseif (!empty($unitupi) && !empty($unitap)): ?>
                    '309 Kwh Komulatif <?php echo $jenislap ?> - Tahun <?php echo $tahun ?> (<?php echo $unitap ?>)'
                <?php else: ?>
                    '309 Kwh Komulatif <?php echo $jenislap ?> - Tahun <?php echo $tahun ?> (<?php echo $unitupi ?>)'
                <?php endif ?>
}

var vunitupi='';
var vunitap='';
var vunitup='';

$(document).ready(function(){
    $("#bcari").click(function(){
        var tahun=$('#tahun').val();
        var jenislap=$('#jenislap').val();
        vunitupi=$('#unitupi').val();
        vunitap=$('#unitap').val();
        vunitup=$('#unitup').val();

        if (tahun == null || tahun == '') {
            show_failed_notification('WARNING!','Tahun Tidak Boleh Kosong');
        } else if(jenislap == null || jenislap == ''){
            show_failed_notification('WARNING!','Jenislap Tidak Boleh Kosong');
        }else{
            $.ajax({
            type: "post",
            url: "<?php echo site_url('Rupiah_309/get309all') ?>",
            cache: false,               
            data:{"tahun":tahun, "jenislap":jenislap, "unitupi":vunitupi, "unitap":vunitap, "unitup":vunitup},
            beforeSend: function () {
                $('#bcari').attr('disabled', 'disabled');
                $('#bcari').button('loading');
                // loading
                $('#loading_modal').modal({
                    backdrop: 'static', keyboard: false
                });
            },
            success: function(data){
                $('#loading_modal').modal('hide');
                $('#bcari').removeAttr('disabled');
                $('#bcari').button('reset');
                var obj = JSON.parse(data);
                var jsonrp = obj.dataall;
                var jtahun = obj.tahun;
                var jjenislap = obj.jenislap;
                var junitupi = obj.unitupi;
                var junitap = obj.unitap;
                var junitup = obj.unitup;
                var msg = obj.msg;
                var status = obj.status;
                jInit = obj.init;
                rowsall.splice(0, rowsall.length);
                rowsthbl.splice(0, rowsthbl.length);

                if (status == 'Kosong') {
                    show_failed_notification(status, msg);
                    myBar.destroy();
                    $('#inchart').show();
                }else{

                    $('#inchart').hide();

                    if (junitupi != "" && junitap != "" && junitup != "") {
                        texttitle = '309 Rupiah '+jenislap+' - Tahun '+jtahun+' ('+junitup+')'
                    } else if(junitupi != "" && junitap != ""){
                        texttitle = '309 Rupiah '+jenislap+' - Tahun '+jtahun+' ('+junitap+')'
                    } else {
                        texttitle = '309 Rupiah '+jenislap+' - Tahun '+jtahun+' ('+junitupi+')'
                    }

                    for (var i = 0; i < obj.dataall.length; i++) {
                        var KWH_KOMULATIF = obj.dataall[i].KWH_KOMULATIF;
                        var THBLLAP = obj.dataall[i].THBLLAP;

                        rowsall.push(
                            parseInt(KWH_KOMULATIF)     
                            );

                        rowsthbl.push(
                            parseInt(THBLLAP)           
                            );
                    };  
                    renderchart();
                    console.log(texttitle);
                }   
            }   

            }); 
            return false;
        }
    });
}); 


var barChartData = {
    labels:rowsthbl,
    datasets: [{
        label: 'Kwh',
        backgroundColor: window.chartColors.blue,
        borderColor: window.chartColors.blue,
        borderWidth: 1,
        data: rowsall
    }]

};

var dataY = [{
    ticks: {
        callback: function(label, index, labels) {
            if (vunitupi == '00') {
                 return label/1000000000+'M';
            }else{
                return label/1000000+'Jt';
            }
        },  
        min: 0
    }
}]

window.onload = function() {
    // renderchart();
};

function renderchart(){
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
                fontSize: 20,
                padding: 30,
                text: texttitle
            },
            scales: {
                yAxes: dataY
            }
        }
    });
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

                            var fontSize = 10;
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