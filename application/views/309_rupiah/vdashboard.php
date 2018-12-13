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
                                <div class="form-group"></div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <select name="tahun" id="tahun" class="form-control">
                                            <option value="">--- Pilih Tahun ---</option>
                                            <?php foreach ($rs_tahun as $index => $tahun) { ?>
                                                <option value="<?php echo $tahun; ?>" <?php if (date('Y') == $tahun) {
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
                                        <select name="tahun1" id="tahun1" class="form-control">
                                            <option value="">--- Pilih Tahun ---</option>
                                            <?php foreach ($rs_tahun as $index => $tahun1) { ?>
                                                <option value="<?php echo $tahun1; ?>" <?php if (date('Y')-1 == $tahun1) {
                                                    echo " selected";
                                                } ?>><?php echo $tahun1; ?></option>   
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <select name="jenislap" id="jenislap" class="form-control" required="true">
                                            <option value="TOTAL">GABUNGAN</option>
                                            <option value="LPB">PRABAYAR</option>
                                            <option value="NORMAL">PASCA</option>
                                        </select>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-primary" id="bcari"  name="button" value="cari"><i class="fa fa-search fa-fw"></i> Cari</button>
                                        <!-- <button class="btn btn-default" name="button" value="reset"><i class="fa  fa-refresh fa-fw" ></i> Reset</button> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="inchart" hidden=""><h2 style="text-align: center;padding-bottom: 20px">Dashboard Utama - Cari Data Terlebih Dahulu!</h2></div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">
                    <div id="container" style="width: 100%; padding: 0px 30px 30px 30px">
                        <canvas id="canvas"></canvas>
                    </div>  
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">
                    <div id="container" style="width: 100%; padding: 0px 30px 30px 30px">
                        <canvas id="canvas2"></canvas>
                    </div>  
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">
                    <div id="container" style="width: 100%; padding: 0px 30px 30px 30px">
                        <canvas id="canvas3"></canvas>
                    </div>  
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">
                    <div id="container" style="width: 100%; padding: 0px 30px 30px 30px">
                        <canvas id="canvas4"></canvas>
                    </div>  
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">
                    <div id="container" style="width: 100%; padding: 0px 30px 30px 30px">
                        <canvas id="canvas5"></canvas>
                    </div>  
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">
                    <div id="container" style="width: 100%; padding: 0px 30px 30px 30px">
                        <canvas id="canvas6"></canvas>
                    </div>  
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">
                    <div id="container" style="width: 100%; padding: 0px 30px 30px 30px">
                        <canvas id="canvas7"></canvas>
                    </div>  
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">
                    <div id="container" style="width: 100%; padding: 0px 30px 30px 30px">
                        <canvas id="canvas8"></canvas>
                    </div>  
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">
                    <div id="container" style="width: 100%; padding: 0px 30px 30px 30px">
                        <canvas id="canvas9"></canvas>
                    </div>  
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">
                    <div id="container" style="width: 100%; padding: 0px 30px 30px 30px">
                        <canvas id="canvas10"></canvas>
                    </div>  
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">
                    <div id="container" style="width: 100%; padding: 0px 30px 30px 30px">
                        <canvas id="canvas11"></canvas>
                    </div>  
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">
                    <div id="container" style="width: 100%; padding: 0px 30px 30px 30px">
                        <canvas id="canvas12"></canvas>
                    </div>  
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">
                    <div id="container" style="width: 100%; padding: 0px 30px 30px 30px">
                        <canvas id="canvas13"></canvas>
                    </div>  
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">
                    <div id="container" style="width: 100%; padding: 0px 30px 30px 30px">
                        <canvas id="canvas14"></canvas>
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

// chart start
window.onload = function(){
    renderchart();
    renderchart2();
    renderchart3();
    renderchart4();
    renderchart5();
    renderchart6();
    renderchart7();
    renderchart8();
    renderchart9();
    renderchart10();
    renderchart11();
    renderchart12();
    renderchart13();
    renderchart14();
};

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

    if (level != 00) {
            $('#unitap').prop('disabled', false);
        } else {
            $("#unitup").find('option').remove();
            $("#unitap").find('option').remove();
            $("#unitap").append('<option value="">SEMUA</option>');
            $("#unitup").append('<option value="">SEMUA</option>');
            $('#unitap').prop('disabled', true);
            $('#unitup').prop('disabled', true);
        };
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
            $("#unitup").find('option').remove();
            $("#unitup").append('<option value="">SEMUA</option>');  
            $('#unitup').prop('disabled', true);
        };
})

    //chart start

    var texttitleall = '';
    var texttitlekwh = '';
    var texttitlekom = '';
    var texttitlekomkwh = '';
    var texttitledelta = '';
    var texttitledeltakwh = '';
    var texttitlesaldor = '';
    var texttitlesaldol = '';
    var texttitlelunas = '';
    var texttitlelunasl = '';
    var texttitlesaldod = '';
    var texttitlelunasd = '';
    var texttitledsaldo = '';
    var texttitledsaldol = '';
    var texttitledlunas = '';
    var texttitledlunasl = '';
    var datalabel = '';
    var datalabel2 = '';
    var rowslbr = [];
    var rowsrp = [];
    var rowskwh = [];
    var rowsdelta = [];
    var rowsdsaldo1 = [];
    var rowsdsaldo2 = [];
    var rowsdsaldoL1 = [];
    var rowsdsaldoL2 = [];
    var rowsdlunas1 = [];
    var rowsdlunas2 = [];
    var rowsdlunasL1 = [];
    var rowsdlunasL2 = [];
    var rowsdeltakwh = [];
    var rowsdelta2 = [];
    var rowsdeltakwh2 = [];
    var rowsrpkom = [];
    var rowskwhkom = [];
    var rowslbr2 = [];
    var rowsrrp = [];
    var rowsrrp2 = [];
    var rowsthbl = [];
    var rowsthbl2 = [];
    var rowsthbl3 = [];
    var rowsthbl4 = [];
    var rowsthbl5 = [];
    var rowsthbl6 = [];
    var vunitupi='';
    var vunitap='';
    var vunitup='';
    var nunitupi='';
    var nunitap='';
    var nunitup='';
    var inisial = '<?php echo $initial?>';

    if (inisial == 'awal') {
        texttitleall = '309 Rupiah Gabungan - Tahun '+<?php echo date('Y')?>+' (NASIONAL)';
        texttitlekwh = '309 Kwh Gabungan - Tahun '+<?php echo date('Y')?>+' (NASIONAL)';
        texttitlekom = '309 Rupiah Komulatif Gabungan - Tahun '+<?php echo date('Y')?>+' (NASIONAL)';
        texttitlekomkwh = '309 Kwh Komulatif Gabungan - Tahun '+<?php echo date('Y')?>+' (NASIONAL)';
        texttitledelta = '309 Rupiah Delta Gabungan - Tahun '+<?php echo date('Y')?>+'/'+<?php echo date('Y')-1?>+' (NASIONAL)';
        texttitledeltakwh = '309 Kwh Delta Gabungan - Tahun '+<?php echo date('Y')?>+'/'+<?php echo date('Y')-1?>+' (NASIONAL)';
        texttitlesaldor = '404 Saldo Rupiah - Tahun '+<?php echo date('Y')?>+' (NASIONAL)';
        texttitlesaldol = '404 Saldo Lembar - Tahun '+<?php echo date('Y')?>+' (NASIONAL)';
        texttitlelunas = '404 Lunas Rupiah - Tahun '+<?php echo date('Y')?>+' (NASIONAL)';
        texttitlelunasl = '404 Lunas Lembar - Tahun '+<?php echo date('Y')?>+' (NASIONAL)';
        texttitledsaldo = '404 Saldo Delta Rupiah - Tahun '+<?php echo date('Y')?>+'/'+<?php echo date('Y')-1?>+' (NASIONAL)';
        texttitledsaldol = '404 Saldo Delta Lembar - Tahun '+<?php echo date('Y')?>+'/'+<?php echo date('Y')-1?>+' (NASIONAL)';
        texttitledlunasd = '404 Lunas Delta Rupiah - Tahun '+<?php echo date('Y')?>+'/'+<?php echo date('Y')-1?>+' (NASIONAL)';
        texttitledlunasdl = '404 Lunas Delta Lembar - Tahun '+<?php echo date('Y')?>+'/'+<?php echo date('Y')-1?>+' (NASIONAL)';
        
        rowsrp = [ <?php foreach ($dataall as $dt_309) { 
            echo $dt_309['RPPTL'] . ',';
        }?>];
        rowskwh = [ <?php foreach ($dataall as $dt_309) { 
            echo $dt_309['JMLKWH'] . ',';
        }?>];
        rowsrpkom = [ <?php foreach ($dataall as $dt_309) { 
            echo $dt_309['RP_KOMULATIF'] . ',';
        }?>];
        rowskwhkom = [ <?php foreach ($dataall as $dt_309) { 
            echo $dt_309['KWH_KOMULATIF'] . ',';
        }?>];
        rowslbr = [ <?php foreach ($data404saldo as $dt_404) { 
            echo $dt_404['LBR_TOTAL'] . ',';
        }?>];
        rowsrrp = [ <?php foreach ($data404saldo as $dt_404) { 
            echo $dt_404['RUPIAH_TOTAL'] . ',';
        }?>];
        rowslbr2 = [ <?php foreach ($data404lunas as $dt_404) { 
            echo $dt_404['LBR_TOTAL'] . ',';
        }?>];
        rowsrrp2 = [ <?php foreach ($data404lunas as $dt_404) { 
            echo $dt_404['RUPIAH_TOTAL'] . ',';
        }?>];
        rowsdelta = [ <?php foreach ($datadelta as $dt_delta) { 
            echo $dt_delta['RPPTL'] . ',';
        }?>];
        rowsdelta2 = [ <?php foreach ($datadelta as $dt_delta) { 
            echo $dt_delta['RPPTL_2'] . ',';
        }?>];
        rowsdeltakwh = [ <?php foreach ($datadelta as $dt_delta) { 
            echo $dt_delta['JMLKWH'] . ',';
        }?>];
        rowsdeltakwh2 = [ <?php foreach ($datadelta as $dt_delta) { 
            echo $dt_delta['JMLKWH_2'] . ',';
        }?>];
        rowsdsaldo1 = [ <?php foreach ($data404delta as $dt_delta404) { 
            if ($dt_delta404['KET'] == 'GRAFIK1') {
                echo $dt_delta404['RUPIAH_TOTAL'] . ',';
            }
        }?>];
        rowsdsaldoL1 = [ <?php foreach ($data404delta as $dt_delta404) { 
            if ($dt_delta404['KET'] == 'GRAFIK1') {
                echo $dt_delta404['LBR_TOTAL'] . ',';
            }
        }?>];
        rowsdsaldo2 = [ <?php foreach ($data404delta as $dt_delta404) { 
            if ($dt_delta404['KET'] == 'GRAFIK2') {
                echo $dt_delta404['RUPIAH_TOTAL'] . ',';
            }
        }?>];
        rowsdsaldoL2 = [ <?php foreach ($data404delta as $dt_delta404) { 
            if ($dt_delta404['KET'] == 'GRAFIK2') {
                echo $dt_delta404['LBR_TOTAL'] . ',';
            }
        }?>];
        rowsdlunas1 = [ <?php foreach ($data404deltalunas as $dt_delta404) { 
            if ($dt_delta404['KET'] == 'GRAFIK1') {
                echo $dt_delta404['RUPIAH_TOTAL'] . ',';
            }
        }?>];
        rowsdlunasL1 = [ <?php foreach ($data404deltalunas as $dt_delta404) { 
            if ($dt_delta404['KET'] == 'GRAFIK1') {
                echo $dt_delta404['LBR_TOTAL'] . ',';
            }
        }?>];
        rowsdlunas2 = [ <?php foreach ($data404deltalunas as $dt_delta404) { 
            if ($dt_delta404['KET'] == 'GRAFIK2') {
                echo $dt_delta404['RUPIAH_TOTAL'] . ',';
            }
        }?>];
        rowsdlunasL2 = [ <?php foreach ($data404deltalunas as $dt_delta404) { 
            if ($dt_delta404['KET'] == 'GRAFIK2') {
                echo $dt_delta404['LBR_TOTAL'] . ',';
            }
        }?>];
    }
    
    var tahunini=<?php date('Y') ?>

    $(document).ready(function(){
        $("#bcari").click(function(){
            var tahun=$('#tahun').val();
            var tahun1=$('#tahun1').val();
            var jenislap=$('#jenislap').val();
            vunitupi=$('#unitupi').val();
            vunitap=$('#unitap').val();
            vunitup=$('#unitup').val();
            nunitupi=$("#unitupi option:selected").text();
            nunitap=$("#unitap option:selected").text();
            nunitup=$("#unitup option:selected").text();

            if (tahun == null || tahun == '') {
                show_failed_notification('WARNING!','Tahun Tidak Boleh Kosong');
            }else if(tahun1 == null || tahun1 == ''){
                show_failed_notification('WARNING!','Tahun Pembanding Tidak Boleh Kosong');
            }else if(tahun > tahunini){
                show_failed_notification('WARNING!','Tahun Tidak Boleh Lebih Dari Tahun Ini');
            }else{
                $.ajax({
                    type: "post",
                    url: "<?php echo site_url('Rupiah_309/getdashboard') ?>",
                    cache: false,               
                    data:{"tahun":tahun, "tahun1":tahun1, "jenislap":jenislap ,"unitupi":vunitupi, "unitap":vunitap, "unitup":vunitup,"nunitupi":nunitupi, "nunitap":nunitap, "nunitup":nunitup},
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
                        var jsonall = obj.dataall;
                        var jsondelta = obj.datadelta;
                        var jsonsaldo = obj.data404saldo;
                        var jsonlunas = obj.data404lunas;
                        var json404delta = obj.data404delta;
                        var json404deltalunas = obj.data404deltalunas;
                        var jtahun = obj.datatahun;
                        var jtahun1 = obj.tahun1;
                        var junitupi = obj.unitupi;
                        var junitap = obj.unitap;
                        var junitup = obj.unitup;
                        var jnunitupi = obj.nunitupi;
                        var jnunitap = obj.nunitap;
                        var jnunitup = obj.nunitup;
                        inisial = obj.initial;
                        var msg = obj.msg;
                        var status = obj.status;
                        var RUPIAH_TOTAL = [];
                        var LBR_TOTAL = [];
                        var RUPIAH_TOTAL2 = [];
                        var LBR_TOTAL2 = [];
                        var THBLLAP = [];
                        rowsrp.splice(0, rowsrp.length);
                        rowsrpkom.splice(0, rowsrpkom.length);
                        rowskwh.splice(0, rowskwh.length);
                        rowskwhkom.splice(0, rowskwhkom.length);
                        rowslbr.splice(0, rowslbr.length);
                        rowslbr2.splice(0, rowslbr2.length);
                        rowsthbl.splice(0, rowsthbl.length);
                        rowsdelta.splice(0, rowsdelta.length);
                        rowsdelta2.splice(0, rowsdelta2.length);
                        rowsdeltakwh.splice(0, rowsdeltakwh.length);
                        rowsdeltakwh2.splice(0, rowsdeltakwh2.length);
                        rowsthbl2.splice(0, rowsthbl2.length);
                        rowsrrp.splice(0, rowsrrp.length);
                        rowsthbl3.splice(0, rowsthbl3.length);
                        rowsrrp2.splice(0, rowsrrp2.length);
                        rowsthbl4.splice(0, rowsthbl4.length);
                        rowsdsaldo1.splice(0, rowsdsaldo1.length);
                        rowsdsaldo2.splice(0, rowsdsaldo2.length);
                        rowsdsaldoL1.splice(0, rowsdsaldoL1.length);
                        rowsdsaldoL2.splice(0, rowsdsaldoL2.length);
                        rowsdlunas1.splice(0, rowsdlunas1.length);
                        rowsdlunas2.splice(0, rowsdlunas2.length);
                        rowsdlunasL1.splice(0, rowsdlunasL1.length);
                        rowsdlunasL2.splice(0, rowsdlunasL2.length);

                        if (status == 'Kosong') {
                            show_failed_notification(status, msg);
                            $('#inchart').show();
                        }else{
                            $('#inchart').hide();
                            if (junitupi != "" && junitap != "" && junitup != "") {
                                texttitleall = '309 Rupiah '+jenislap+' - Tahun '+jtahun+' ('+jnunitup+')'
                                texttitlekwh = '309 Kwh '+jenislap+' - Tahun '+jtahun+' ('+jnunitup+')'
                                texttitlekom = '309 Rupiah Komulatif '+jenislap+' - Tahun '+jtahun+' ('+jnunitup+')'
                                texttitlekomkwh = '309 Kwh Komulatif '+jenislap+' - Tahun '+jtahun+' ('+jnunitup+')'
                                texttitledelta = '309 Rupiah Delta '+jenislap+' - Tahun '+jtahun+'/'+jtahun1+' ('+jnunitup+')'
                                texttitledeltakwh = '309 Kwh Delta '+jenislap+' - Tahun '+jtahun+'/'+jtahun1+' ('+jnunitup+')'
                                texttitlesaldor = '404 Saldo Rupiah - Tahun '+jtahun+' ('+jnunitup+')'
                                texttitlesaldol = '404 Saldo Lembar - Tahun '+jtahun+' ('+jnunitup+')'
                                texttitlelunas = '404 Lunas Rupiah - Tahun '+jtahun+' ('+jnunitup+')'
                                texttitlelunasl = '404 Lunas Lembar - Tahun '+jtahun+' ('+jnunitup+')'
                                texttitledsaldo = '404 Saldo Delta Rupiah - Tahun '+tahun+'/'+tahun1+' ('+jnunitup+')'
                                texttitledsaldol = '404 Saldo Delta Lembar - Tahun '+tahun+'/'+tahun1+' ('+jnunitup+')'
                                texttitledlunasd = '404 Lunas Delta Rupiah - Tahun '+tahun+'/'+tahun1+' ('+jnunitup+')'
                                texttitledlunasdl = '404 Lunas Delta Lembar - Tahun '+tahun+'/'+tahun1+' ('+jnunitup+')'
                            } else if(junitupi != "" && junitap != ""){
                                texttitleall = '309 Rupiah '+jenislap+' - Tahun '+jtahun+' ('+jnunitap+')'
                                texttitlekwh = '309 Kwh '+jenislap+' - Tahun '+jtahun+' ('+jnunitap+')'
                                texttitlekom = '309 Rupiah Komulatif '+jenislap+' - Tahun '+jtahun+' ('+jnunitap+')'
                                texttitlekomkwh = '309 Kwh Komulatif '+jenislap+' - Tahun '+jtahun+' ('+jnunitap+')'
                                texttitledelta = '309 Rupiah Delta '+jenislap+' - Tahun '+jtahun+'/'+jtahun1+' ('+jnunitap+')'
                                texttitledeltakwh = '309 Kwh Delta '+jenislap+' - Tahun '+jtahun+'/'+jtahun1+' ('+jnunitap+')'
                                texttitlesaldor = '404 Saldo Rupiah - Tahun '+jtahun+' ('+jnunitap+')'
                                texttitlesaldol = '404 Saldo Lembar - Tahun '+jtahun+' ('+jnunitap+')'
                                texttitlelunas = '404 Lunas Rupiah - Tahun '+jtahun+' ('+jnunitap+')'
                                texttitlelunasl = '404 Lunas Lembar - Tahun '+jtahun+' ('+jnunitap+')'
                                texttitledsaldo = '404 Saldo Delta Rupiah - Tahun '+tahun+'/'+tahun1+' ('+jnunitap+')'
                                texttitledsaldol = '404 Saldo Delta Lembar - Tahun '+tahun+'/'+tahun1+' ('+jnunitap+')'
                                texttitledlunasd = '404 Lunas Delta Rupiah - Tahun '+tahun+'/'+tahun1+' ('+jnunitap+')'
                                texttitledlunasdl = '404 Lunas Delta Lembar - Tahun '+tahun+'/'+tahun1+' ('+jnunitap+')'
                            } else {
                                texttitleall = '309 Rupiah '+jenislap+' - Tahun '+jtahun+' ('+jnunitupi+')'
                                texttitlekwh = '309 Kwh '+jenislap+' - Tahun '+jtahun+' ('+jnunitupi+')'
                                texttitlekom = '309 Rupiah Komulatif '+jenislap+' - Tahun '+jtahun+' ('+jnunitupi+')'
                                texttitlekomkwh = '309 Kwh Komulatif '+jenislap+' - Tahun '+jtahun+' ('+jnunitupi+')'
                                texttitledelta = '309 Rupiah Delta '+jenislap+' - Tahun '+jtahun+'/'+jtahun1+' ('+jnunitupi+')'
                                texttitledeltakwh = '309 Kwh Delta '+jenislap+' - Tahun '+jtahun+'/'+jtahun1+' ('+jnunitupi+')'
                                texttitlesaldor = '404 Saldo Rupiah - Tahun '+jtahun+' ('+jnunitupi+')'
                                texttitlesaldol = '404 Saldo Lembar - Tahun '+jtahun+' ('+jnunitupi+')'
                                texttitlelunas = '404 Lunas Rupiah - Tahun '+jtahun+' ('+jnunitupi+')'
                                texttitlelunasl = '404 Lunas Lembar - Tahun '+jtahun+' ('+jnunitupi+')'
                                texttitledsaldo = '404 Saldo Delta Rupiah - Tahun '+tahun+'/'+tahun1+' ('+jnunitupi+')'
                                texttitledsaldol = '404 Saldo Delta Lembar - Tahun '+tahun+'/'+tahun1+' ('+jnunitupi+')'
                                texttitledlunasd = '404 Lunas Delta Rupiah - Tahun '+tahun+'/'+tahun1+' ('+jnunitupi+')'
                                texttitledlunasdl = '404 Lunas Delta Lembar - Tahun '+tahun+'/'+tahun1+' ('+jnunitupi+')'
                            }

                            datalabel = tahun
                            datalabel2 = tahun1

                            for (var i = 0; i < obj.dataall.length; i++) {
                                var RPPTL = obj.dataall[i].RPPTL;
                                var JMLKWH = obj.dataall[i].JMLKWH;
                                var RP_KOMULATIF = obj.dataall[i].RP_KOMULATIF;
                                var KWH_KOMULATIF = obj.dataall[i].KWH_KOMULATIF;
                                var THBLLAP = obj.dataall[i].THBLLAP;

                                rowsrp.push(
                                    parseInt(RPPTL)     
                                    );
                                rowskwh.push(
                                    parseInt(JMLKWH)     
                                    );
                                rowsrpkom.push(
                                    parseInt(RP_KOMULATIF)     
                                    );
                                rowskwhkom.push(
                                    parseInt(KWH_KOMULATIF)     
                                    );
                                rowsthbl.push(
                                    parseInt(THBLLAP)           
                                    );
                            };  

                            for (var i = 0; i < obj.datadelta.length; i++) {
                                var RPPTL = obj.datadelta[i].RPPTL;
                                var RPPTL_2 = obj.datadelta[i].RPPTL_2;
                                var JMLKWH = obj.datadelta[i].JMLKWH;
                                var JMLKWH_2 = obj.datadelta[i].JMLKWH_2;
                                var THBLLAP = obj.datadelta[i].THBLLAP;
                                
                                rowsdelta.push(
                                    parseInt(RPPTL)     
                                    );
                                rowsdelta2.push(
                                    parseInt(RPPTL_2)     
                                    );
                                rowsdeltakwh.push(
                                    parseInt(JMLKWH)     
                                    );
                                rowsdeltakwh2.push(
                                    parseInt(JMLKWH_2)     
                                    );
                                rowsthbl2.push(
                                    parseInt(THBLLAP)           
                                    );
                            };      

                            for (var i = 0; i < obj.data404saldo.length; i++) {
                                var LBR_TOTAL = obj.data404saldo[i].LBR_TOTAL;
                                var RUPIAH_TOTAL = obj.data404saldo[i].RUPIAH_TOTAL;
                                var THBLLAP = obj.data404saldo[i].THBL;

                                rowsrrp.push(
                                    parseInt(RUPIAH_TOTAL)     
                                    );

                                rowslbr.push(
                                    parseInt(LBR_TOTAL)     
                                    );

                                rowsthbl3.push(
                                    parseInt(THBLLAP)           
                                    );
                            }; 

                            for (var i = 0; i < obj.data404lunas.length; i++) {
                                var LBR_TOTAL = obj.data404lunas[i].LBR_TOTAL;
                                var RUPIAH_TOTAL = obj.data404lunas[i].RUPIAH_TOTAL;
                                var THBL = obj.data404lunas[i].THBL;

                                rowslbr2.push(
                                    parseInt(LBR_TOTAL)     
                                    );

                                rowsrrp2.push(
                                    parseInt(RUPIAH_TOTAL)     
                                    );

                                rowsthbl4.push(
                                    parseInt(THBL)           
                                    );
                            };

                            for (var i = 0; i < obj.data404delta.length; i++) {
                                if (obj.data404delta[i].KET == 'GRAFIK1') {
                                    var RUPIAH_TOTAL = obj.data404delta[i].RUPIAH_TOTAL;
                                    var LBR_TOTAL = obj.data404delta[i].LBR_TOTAL;
                                    var THBLLAP = obj.data404delta[i].THBL;

                                    rowsdsaldo1.push(
                                        parseInt(RUPIAH_TOTAL)     
                                        );
                                    rowsdsaldoL1.push(
                                        parseInt(LBR_TOTAL)     
                                        );
                                } else if(obj.data404delta[i].KET == 'GRAFIK2'){
                                    var RUPIAH_TOTAL2 = obj.data404delta[i].RUPIAH_TOTAL;
                                    var LBR_TOTAL2 = obj.data404delta[i].LBR_TOTAL;

                                    rowsdsaldo2.push(
                                        parseInt(RUPIAH_TOTAL2)     
                                        );
                                    rowsdsaldoL2.push(
                                        parseInt(LBR_TOTAL2)     
                                        );
                                }
                            };

                            for (var i = 0; i < obj.data404deltalunas.length; i++) {
                                if (obj.data404deltalunas[i].KET == 'GRAFIK1') {
                                    var RUPIAH_TOTAL = obj.data404deltalunas[i].RUPIAH_TOTAL;
                                    var LBR_TOTAL = obj.data404deltalunas[i].LBR_TOTAL;
                                    var THBLLAP = obj.data404deltalunas[i].THBL;

                                    rowsdlunas1.push(
                                        parseInt(RUPIAH_TOTAL)     
                                        );
                                    rowsdlunasL1.push(
                                        parseInt(LBR_TOTAL)     
                                        );
                                } else if(obj.data404deltalunas[i].KET == 'GRAFIK2'){
                                    var RUPIAH_TOTAL2 = obj.data404deltalunas[i].RUPIAH_TOTAL;
                                    var LBR_TOTAL2 = obj.data404deltalunas[i].LBR_TOTAL;

                                    rowsdlunas2.push(
                                        parseInt(RUPIAH_TOTAL2)     
                                        );
                                    rowsdlunasL2.push(
                                        parseInt(LBR_TOTAL2)     
                                        );
                                }
                            };

                            renderchart();
                            renderchart2();
                            renderchart3();
                            renderchart4();
                            renderchart5();
                            renderchart6();
                            renderchart7();
                            renderchart8();
                            renderchart9();
                            renderchart10();
                            renderchart11();
                            renderchart12();
                            renderchart13();
                            renderchart14();
                        }
                    }   
                });
return false;
}
});
});

var barChartData = { 
    labels:['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
    datasets: [{
        label: 'Rupiah',
        backgroundColor: window.chartColors.blue,
        borderColor: window.chartColors.blue,
        borderWidth: 1,
        data: rowsrp
    }]
};

var barChartDataKwh = {
    labels:['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
    datasets: [{
        label: 'Kwh',
        backgroundColor: window.chartColors.red,
        borderColor: window.chartColors.red,
        borderWidth: 1,
        data: rowskwh
    }]
};

var barChartDataKomulatif = {
    labels:['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
    datasets: [{
        label: 'Rupiah',
        backgroundColor: window.chartColors.blue,
        borderColor: window.chartColors.blue,
        borderWidth: 1,
        data: rowsrpkom
    }]
};

var barChartDataKomulatifKwh = {
    labels:['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
    datasets: [{
        label: 'Kwh',
        backgroundColor: window.chartColors.red,
        borderColor: window.chartColors.red,
        borderWidth: 1,
        data: rowskwhkom
    }]
};

var barChartDataLembar = {
    labels:['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
    datasets: [{
        label: 'Lembar',
        backgroundColor: window.chartColors.red,
        borderColor: window.chartColors.red,
        borderWidth: 1,
        data: rowslbr
    }]
};

var barChartDataSaldo = {
    labels:['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
    datasets: [{
        label: 'Rupiah',
        backgroundColor: window.chartColors.blue,
        borderColor: window.chartColors.blue,
        borderWidth: 1,
        data: rowsrrp
    }]
};

var barChartDataLembar2 = {
    labels:['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
    datasets: [{
        label: 'Lembar',
        backgroundColor: window.chartColors.red,
        borderColor: window.chartColors.red,
        borderWidth: 1,
        data: rowslbr2
    }]
};

var barChartDataSaldo2 = {
    labels:['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
    datasets: [{
        label: 'Rupiah',
        backgroundColor: window.chartColors.blue,
        borderColor: window.chartColors.blue,
        borderWidth: 1,
        data: rowsrrp2
    }]
};

function renderchart(){
    var ctx = document.getElementById('canvas').getContext('2d');
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartData,
        options: {
            responsive: true,
            legend: {
                position: '',
                display: false
            },
            title: {
                display: true,
                fontSize: 20,
                padding: 30,
                text: texttitleall
            },
            scales: {
                yAxes: [{
                    ticks: {
                        callback: function(label, index, labels) {
                            if (vunitupi == '00'|| vunitupi == '') {
                               return label/1000000000000+'T';
                           }else{
                            return label/1000000000+'M';
                        }
                    },  
                    min: 0
                }
            }]
        },
        tooltips: {
          callbacks: {
            label: function(tooltipItem, data) {
                var value = data.datasets[0].data[tooltipItem.index];
                value = value.toString();
                value = value.split(/(?=(?:...)*$)/);
                value = value.join('.');
                value = 'Rp ' + value;
                return value;
            }
                  } // end callbacks:
                }, //end tooltips
            }
        });
}

function renderchart2(){
    var ctx = document.getElementById('canvas2').getContext('2d');
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartDataKwh,
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
                display: false
            },
            title: {
                display: true,
                fontSize: 20,
                padding: 30,
                text: texttitlekwh
            },
            scales: {
                yAxes: [{
                    ticks: {
                        callback: function(label, index, labels) {
                            if (vunitupi == '00'|| vunitupi == '') {
                               return label/1000000000+'M';
                           }else{
                            return label/1000000+'Jt';
                        }
                    },  
                    min: 0
                }
            }]
        },
        tooltips: {
          callbacks: {
            label: function(tooltipItem, data) {
                var value = data.datasets[0].data[tooltipItem.index];
                value = value.toString();
                value = value.split(/(?=(?:...)*$)/);
                value = value.join('.');
                value = 'Rp ' + value;
                return value;
            }
                  } // end callbacks:
                }, //end tooltips
            }
        });
}

function renderchart3(){
    var ctx = document.getElementById('canvas3').getContext('2d');
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartDataKomulatif,
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
                display: false
            },
            title: {
                display: true,
                fontSize: 20,
                padding: 30,
                text: texttitlekom
            },
            scales: {
                yAxes: [{
                    ticks: {
                        callback: function(label, index, labels) {
                            if (vunitap == '00'|| vunitap == '') {
                               return label/1000000000000+'T';
                           }else{
                            return label/1000000000+'M';
                        }
                    },  
                    min: 0
                }
            }]
        },
        tooltips: {
          callbacks: {
            label: function(tooltipItem, data) {
                var value = data.datasets[0].data[tooltipItem.index];
                value = value.toString();
                value = value.split(/(?=(?:...)*$)/);
                value = value.join('.');
                value = 'Rp ' + value;
                return value;
            }
                  } // end callbacks:
                }, //end tooltips
            }
        });
}

function renderchart4(){
    var ctx = document.getElementById('canvas4').getContext('2d');
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartDataKomulatifKwh,
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
                display: false
            },
            title: {
                display: true,
                fontSize: 20,
                padding: 30,
                text: texttitlekomkwh
            },
            scales: {
                yAxes: [{
                    ticks: {
                        callback: function(label, index, labels) {
                            if (vunitap == '00'|| vunitap == '') {
                               return label/1000000000+'M';
                           }else{
                            return label/1000000+'Jt';
                        }
                    },  
                    min: 0
                }
            }]
        },
        tooltips: {
          callbacks: {
            label: function(tooltipItem, data) {
                var value = data.datasets[0].data[tooltipItem.index];
                value = value.toString();
                value = value.split(/(?=(?:...)*$)/);
                value = value.join('.');
                value = 'Rp ' + value;
                return value;
            }
                  } // end callbacks:
                }, //end tooltips
            }
        });
}

function renderchart5(){
    var ctx = document.getElementById('canvas5').getContext('2d');
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: {
            labels:['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                type: 'line',
                label: datalabel,
                borderColor: window.chartColors.blue,
                borderWidth: 2,
                fill: false,
                data: rowsdelta
            },{
                type: 'line',
                label: datalabel2,
                borderColor: window.chartColors.red,
                borderWidth: 2,
                fill: false,
                data: rowsdelta2
            },{
                type: 'bar',
                label: datalabel,
                backgroundColor: window.chartColors.blue,
                data: rowsdelta,
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'bar',
                label: datalabel2,
                backgroundColor: window.chartColors.red,
                data: rowsdelta2,
                borderColor: 'white',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
                display: false,
                labels: {
                    usePointStyle: true
                }   
            },
            title: {
                display: true,
                fontSize: 20,
                padding: 30,
                text: texttitledelta
            },
            scales: {
                yAxes: [{
                    ticks: {
                        callback: function(label, index, labels) {
                            if (vunitupi == '00'|| vunitupi == '') {
                               return label/1000000000000+'T';
                           }else{
                            return label/1000000000+'M';
                        }
                    },  
                    min: 0
                }
            }]
        },
        tooltips: {
          callbacks: {
            label: function(tooltipItem, data) {
                var value = data.datasets[0].data[tooltipItem.index];
                value = value.toString();
                value = value.split(/(?=(?:...)*$)/);
                value = value.join('.');
                value = 'Rp ' + value;
                return value;
            }
                  } // end callbacks:
                }, //end tooltips
            }
        });
}

function renderchart6(){
    var ctx = document.getElementById('canvas6').getContext('2d');
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: {
            labels:['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                type: 'line',
                label: datalabel,
                borderColor: window.chartColors.blue,
                borderWidth: 2,
                fill: false,
                data: rowsdeltakwh
            },{
                type: 'line',
                label: datalabel2,
                borderColor: window.chartColors.red,
                borderWidth: 2,
                fill: false,
                data: rowsdeltakwh2
            },{
                type: 'bar',
                label: datalabel,
                backgroundColor: window.chartColors.blue,
                data: rowsdeltakwh,
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'bar',
                label: datalabel2,
                backgroundColor: window.chartColors.red,
                data: rowsdeltakwh2,
                borderColor: 'white',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            legend: {
                position: 'bottom', 
                display: false,
                labels: {
                    usePointStyle: true
                }  
            },
            title: {
                display: true,
                fontSize: 20,
                padding: 30,
                text: texttitledeltakwh
            },
            scales: {
                yAxes: [{
                    ticks: {
                        callback: function(label, index, labels) {
                            if (vunitupi == '00'|| vunitupi == '') {
                               return label/1000000000+'M';
                           }else{
                            return label/1000000+'Jt';
                        }
                    },  
                    min: 0
                }
            }]
        },
        tooltips: {
          callbacks: {
            label: function(tooltipItem, data) {
                var value = data.datasets[0].data[tooltipItem.index];
                value = value.toString();
                value = value.split(/(?=(?:...)*$)/);
                value = value.join('.');
                value = 'Rp ' + value;
                return value;
            }
                  } // end callbacks:
                }, //end tooltips
            }
        });
}

function renderchart7(){
    var ctx = document.getElementById('canvas7').getContext('2d');
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartDataSaldo,
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
                display: false
            },
            title: {
                display: true,
                fontSize: 20,
                padding: 30,
                text: texttitlesaldor
            },
            scales: {
                yAxes: [{
                    ticks: {
                        callback: function(label, index, labels) {
                            if (vunitupi == '00'|| vunitupi == '') {
                             return label/1000000000000+'T';
                         }else{
                            return label/1000000000+'M';
                        }
                    },  
                    min: 0
                }
            }]
        },
        tooltips: {
          callbacks: {
            label: function(tooltipItem, data) {
                var value = data.datasets[0].data[tooltipItem.index];
                value = value.toString();
                value = value.split(/(?=(?:...)*$)/);
                value = value.join('.');
                value = 'Rp ' + value;
                return value;
            }
                  } // end callbacks:
                }, //end tooltips
            }
        });
}

function renderchart8(){
    var ctx = document.getElementById('canvas8').getContext('2d');
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartDataLembar,
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
                display: false
            },
            title: {
                display: true,
                fontSize: 20,
                padding: 30,
                text: texttitlesaldol
            },
            scales: {
                yAxes: [{
                    ticks: {
                        callback: function(label, index, labels) {
                            if (vunitap == '00' || vunitap == '') {
                               return label/1000000+'Jt';
                           }else{
                            return label/1000+'Rb';
                        }
                    },  
                    min: 0
                }
            }]
        },
        tooltips: {
          callbacks: {
            label: function(tooltipItem, data) {
                var value = data.datasets[0].data[tooltipItem.index];
                value = value.toString();
                value = value.split(/(?=(?:...)*$)/);
                value = value.join('.');
                value = value+'(Lembar)';
                return value;
            }
                  } // end callbacks:
                }, //end tooltips
            }
        });
}

function renderchart9(){
    var ctx = document.getElementById('canvas9').getContext('2d');
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartDataSaldo2,
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
                display: false
            },
            title: {
                display: true,
                fontSize: 20,
                padding: 30,
                text: texttitlelunas
            },
            scales: {
                yAxes: [{
                    ticks: {
                        callback: function(label, index, labels) {
                            if (vunitupi == '00'|| vunitupi == '') {
                             return label/1000000000000+'T';
                         }else{
                            return label/1000000000+'M';
                        }
                    },  
                    min: 0
                }
            }]
        },
        tooltips: {
          callbacks: {
            label: function(tooltipItem, data) {
                var value = data.datasets[0].data[tooltipItem.index];
                value = value.toString();
                value = value.split(/(?=(?:...)*$)/);
                value = value.join('.');
                value = 'Rp ' + value;
                return value;
            }
                  } // end callbacks:
                }, //end tooltips
            }
        });
}

function renderchart10(){
    var ctx = document.getElementById('canvas10').getContext('2d');
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartDataLembar2,
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
                display: false
            },
            title: {
                display: true,
                fontSize: 20,
                padding: 30,
                text: texttitlelunasl
            },
            scales: {
                yAxes: [{
                    ticks: {
                        callback: function(label, index, labels) {
                            if (vunitupi == '00' || vunitupi == '') {
                               return label/1000000+'Jt';
                           }else{
                            return label/1000+'Rb';
                        }
                    },  
                    min: 0
                }
            }]
        },
        tooltips: {
          callbacks: {
            label: function(tooltipItem, data) {
                var value = data.datasets[0].data[tooltipItem.index];
                value = value.toString();
                value = value.split(/(?=(?:...)*$)/);
                value = value.join('.');
                value = value+'(Lembar)';
                return value;
            }
                  } // end callbacks:
                }, //end tooltips
            }
        });
}

function renderchart11(){
    var ctx = document.getElementById('canvas11').getContext('2d');
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: {
            labels:['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                type: 'line',
                label: datalabel,
                borderColor: window.chartColors.blue,
                borderWidth: 2,
                fill: false,
                data: rowsdsaldo1
            },{
                type: 'line',
                label: datalabel2,
                borderColor: window.chartColors.red,
                borderWidth: 2,
                fill: false,
                data: rowsdsaldo2
            },{
                type: 'bar',
                label: datalabel,
                backgroundColor: window.chartColors.blue,
                data: rowsdsaldo1,
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'bar',
                label: datalabel2,
                backgroundColor: window.chartColors.red,
                data: rowsdsaldo2,
                borderColor: 'white',
                borderWidth: 2
            }]

        },
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
                display: false,
                labels: {
                    usePointStyle: true
                }   
            },
            title: {
                display: true,
                fontSize: 20,
                padding: 30,
                text: texttitledsaldo
            },
            scales: {
                yAxes: [{
                    ticks: {
                        callback: function(label, index, labels) {
                            if (vunitupi == '00'|| vunitupi == '') {
                               return label/1000000000000+'T';
                           }else{
                            return label/1000000000+'M';
                        }
                    },  
                    min: 0
                }
            }]
        },
        tooltips: {
          callbacks: {
            label: function(tooltipItem, data) {
                var value = data.datasets[0].data[tooltipItem.index];
                value = value.toString();
                value = value.split(/(?=(?:...)*$)/);
                value = value.join('.');
                value = 'Rp ' + value;
                return value;
            }
                  } // end callbacks:
                }, //end tooltips
            }
        });
}

function renderchart12(){
    var ctx = document.getElementById('canvas12').getContext('2d');
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: {
            labels:['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                type: 'line',
                label: datalabel,
                borderColor: window.chartColors.blue,
                borderWidth: 2,
                fill: false,
                data: rowsdsaldoL1
            },{
                type: 'line',
                label: datalabel2,
                borderColor: window.chartColors.red,
                borderWidth: 2,
                fill: false,
                data: rowsdsaldoL2
            },{
                type: 'bar',
                label: datalabel,
                backgroundColor: window.chartColors.blue,
                data: rowsdsaldoL1,
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'bar',
                label: datalabel2,
                backgroundColor: window.chartColors.red,
                data: rowsdsaldoL2,
                borderColor: 'white',
                borderWidth: 2
            }]

        },
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
                display: false,
                labels: {
                    usePointStyle: true
                }   
            },
            title: {
                display: true,
                fontSize: 20,
                padding: 30,
                text: texttitledsaldol
            },
            scales: {
                yAxes: [{
                    ticks: {
                        callback: function(label, index, labels) {
                            if (vunitupi == '00'|| vunitupi == '') {
                               return label/1000000+'Jt';
                           }else{
                            return label/1000+'Rb';
                        }
                    },  
                    min: 0
                }
            }]
        },
        tooltips: {
          callbacks: {
            label: function(tooltipItem, data) {
                var value = data.datasets[0].data[tooltipItem.index];
                value = value.toString();
                value = value.split(/(?=(?:...)*$)/);
                value = value.join('.');
                value = value+'(Lembar)';
                return value;
            }
                  } // end callbacks:
                }, //end tooltips
            }
        });
}

function renderchart13(){
    var ctx = document.getElementById('canvas13').getContext('2d');
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: {
            labels:['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                type: 'line',
                label: datalabel,
                borderColor: window.chartColors.blue,
                borderWidth: 2,
                fill: false,
                data: rowsdlunas1
            },{
                type: 'line',
                label: datalabel2,
                borderColor: window.chartColors.red,
                borderWidth: 2,
                fill: false,
                data: rowsdlunas2
            },{
                type: 'bar',
                label: datalabel,
                backgroundColor: window.chartColors.blue,
                data: rowsdlunas1,
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'bar',
                label: datalabel2,
                backgroundColor: window.chartColors.red,
                data: rowsdlunas2,
                borderColor: 'white',
                borderWidth: 2
            }]

        },
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
                display: false,
                labels: {
                    usePointStyle: true
                }   
            },
            title: {
                display: true,
                fontSize: 20,
                padding: 30,
                text: texttitledlunasd
            },
            scales: {
                yAxes: [{
                    ticks: {
                        callback: function(label, index, labels) {
                            if (vunitupi == '00'|| vunitupi == '') {
                               return label/1000000000000+'T';
                           }else{
                            return label/1000000000+'M';
                        }
                    },  
                    min: 0
                }
            }]
        },
        tooltips: {
          callbacks: {
            label: function(tooltipItem, data) {
                var value = data.datasets[0].data[tooltipItem.index];
                value = value.toString();
                value = value.split(/(?=(?:...)*$)/);
                value = value.join('.');
                value = 'Rp ' + value;
                return value;
            }
                  } // end callbacks:
                }, //end tooltips
            }
        });
}

function renderchart14(){
    var ctx = document.getElementById('canvas14').getContext('2d');
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: {
            labels:['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                type: 'line',
                label: datalabel,
                borderColor: window.chartColors.blue,
                borderWidth: 2,
                fill: false,
                data: rowsdlunasL1
            },{
                type: 'line',
                label: datalabel2,
                borderColor: window.chartColors.red,
                borderWidth: 2,
                fill: false,
                data: rowsdlunasL2
            },{
                type: 'bar',
                label: datalabel,
                backgroundColor: window.chartColors.blue,
                data: rowsdlunasL1,
                borderColor: 'white',
                borderWidth: 2
            }, {
                type: 'bar',
                label: datalabel2,
                backgroundColor: window.chartColors.red,
                data: rowsdlunasL2,
                borderColor: 'white',
                borderWidth: 2
            }]

        },
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
                display: false,
                labels: {
                    usePointStyle: true
                }   
            },
            title: {
                display: true,
                fontSize: 20,
                padding: 30,
                text: texttitledlunasdl
            },
            scales: {
                yAxes: [{
                    ticks: {
                        callback: function(label, index, labels) {
                            if (vunitupi == '00'|| vunitupi == '') {
                               return label/1000000+'Jt';
                           }else{
                            return label/1000+'Rb';
                        }
                    },  
                    min: 0
                }
            }]
        },
        tooltips: {
          callbacks: {
            label: function(tooltipItem, data) {
                var value = data.datasets[0].data[tooltipItem.index];
                value = value.toString();
                value = value.split(/(?=(?:...)*$)/);
                value = value.join('.');
                value = value+'(Lembar)';
                return value;
            }
            } // end callbacks:
        }, //end tooltips
    }
});
}

function addCommas(nStr)
{
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return x1 + x2;
}
</script>