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
										<select name="tahun1" id="tahun1" class="form-control">
											<option value="">--- Pilih Tahun Pembanding---</option>
											<?php foreach ($rs_tahun as $index => $tahun) { ?>
												<option value="<?php echo $tahun; ?>" <?php if ($filtertahun1 == $tahun) {
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
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-body">
					<div id="inchart"><h2 style="text-align: center">404 Saldo Delta - Cari Data Terlebih Dahulu!</h2></div>
					<div id="container" style="width: 100%; padding: 0px 30px 30px 30px">
						<canvas id="canvas"></canvas>
					</div>  
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-body">
					<div id="container" style="width: 100%; padding: 0px 30px 30px 30px">
						<canvas id="canvas2"></canvas>
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
	var texttitle = '';
	var texttitle2 = '';
	var datalabel = '';
	var datalabel2 = '';
	var rowslbr = [];
	var rowsrp = [];
	var rowslbr2 = [];
	var rowsrp2 = [];
	var rowsthbl = [];
	var vunitupi='';
	var vunitap='';
	var vunitup='';

	$(document).ready(function(){
		$("#bcari").click(function(){
			var tahun=$('#tahun').val();
			var tahun1=$('#tahun1').val();
			vunitupi=$('#unitupi').val();
			vunitap=$('#unitap').val();
			vunitup=$('#unitup').val();

			if (tahun == null || tahun == '') {
				show_failed_notification('WARNING!','Tahun Tidak Boleh Kosong');
			}else if(tahun1 == null || tahun1 == ''){
				show_failed_notification('WARNING!','Tahun Pembanding Tidak Boleh Kosong');
			}else{
				$.ajax({
					type: "post",
					url: "<?php echo site_url('data_404/getdata404delta/saldodelta') ?>",
					cache: false,               
					data:{"tahun":tahun, "tahun1":tahun1, "unitupi":vunitupi, "unitap":vunitap, "unitup":vunitup},
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
	                	var jsonrp = obj.data404delta;
	                	var jtahun = obj.datatahun;
	                	var jtahun1 = obj.tahun1;
	                	var junitupi = obj.unitupi;
	                	var junitap = obj.unitap;
	                	var junitup = obj.unitup;
	                	var msg = obj.msg;
	                	var status = obj.status;
	                	var RUPIAH_TOTAL = [];
	                	var LBR_TOTAL = [];
	                	var RUPIAH_TOTAL2 = [];
	               		var LBR_TOTAL2 = [];
	               		var THBLLAP = [];
	                	jInit = obj.init;
	                	rowsrp.splice(0, rowsrp.length);
	                	rowsrp2.splice(0, rowsrp2.length);
	                	rowslbr.splice(0, rowslbr.length);
	                	rowslbr2.splice(0, rowslbr2.length);
	                	rowsthbl.splice(0, rowsthbl.length);

	                	if (status == 'Kosong') {
	                		show_failed_notification(status, msg);
	                		$('#inchart').show();
	                	}else{
	                		$('#inchart').hide();
	                		if (junitupi != "" && junitap != "" && junitup != "") {
	                			texttitle = '404 Saldo Delta Rupiah - Tahun '+tahun+'/'+tahun1+' ('+junitup+')'
	                			texttitle2 = '404 Saldo Delta Lembar - Tahun '+tahun+'/'+tahun1+' ('+junitup+')'
	                		} else if(junitupi != "" && junitap != ""){
	                			texttitle = '404 Saldo Delta Rupiah - Tahun '+tahun+'/'+tahun1+' ('+junitap+')'
	                			texttitle2 = '404 Saldo Delta Lembar - Tahun '+tahun+'/'+tahun1+' ('+junitap+')'
	                		} else {
	                			texttitle = '404 Saldo Delta Rupiah - Tahun '+tahun+'/'+tahun1+' ('+junitupi+')'
	                			texttitle2 = '404 Saldo Delta Lembar - Tahun '+tahun+'/'+tahun1+' ('+junitupi+')'
	                		}

	                		datalabel = tahun
	                		datalabel2 = tahun1

	                		for (var i = 0; i < obj.data404delta.length; i++) {
	                			if (obj.data404delta[i].KET == 'GRAFIK1') {
	                				RUPIAH_TOTAL = obj.data404delta[i].RUPIAH_TOTAL;
	                				LBR_TOTAL = obj.data404delta[i].LBR_TOTAL;

	                				rowsrp.push(
	                					parseInt(RUPIAH_TOTAL)     
	                				);
	                				rowslbr.push(
	                					parseInt(LBR_TOTAL)     
	                				);
	                			} else {
	                				RUPIAH_TOTAL2 = obj.data404delta[i].RUPIAH_TOTAL;
	                				LBR_TOTAL2 = obj.data404delta[i].LBR_TOTAL;

	                				rowsrp2.push(
	                					parseInt(RUPIAH_TOTAL2)     
	                				);
	                				rowslbr2.push(
	                					parseInt(LBR_TOTAL2)     
	                				);
	                			}

	                			rowsthbl.push(
	                				parseInt(THBLLAP)           
	                			);
	                		};  
	                		renderchart();
	                		renderchart2();
	                	}
	                }   

	            });
				return false;
			}
		});
	});

	var dataY = [{
	    ticks: {
	        callback: function(label, index, labels) {
	            if (vunitupi == '00') {
	                 return label/1000000000000+'T';
	            }else{
	                return label/1000000000+'M';
	            }
	        },  
	        min: 0
	    }
	}]

	var dataY2 = [{
	    ticks: {
	        callback: function(label, index, labels) {
	            if (vunitupi == '00') {
	                 return label/1000000+'Jt';
	            }else{
	                return label/1000+'Rb';
	            }
	        },  
	        min: 0
	    }
	}]

	function renderchart(){
	    var ctx = document.getElementById('canvas').getContext('2d');
	    window.myBar = new Chart(ctx, {
	        type: 'bar',
	        data: {
	            labels: ['Januari', 'Febuari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
	            datasets: [{
	                type: 'line',
	                label: datalabel,
	                borderColor: window.chartColors.blue,
	                borderWidth: 2,
	                fill: false,
	                data: rowsrp
	            },{
	                type: 'line',
	                label: datalabel2,
	                borderColor: window.chartColors.red,
	                borderWidth: 2,
	                fill: false,
	                data: rowsrp2
	            },{
	                type: 'bar',
	                label: datalabel,
	                backgroundColor: window.chartColors.blue,
	                data: rowsrp,
	                borderColor: 'white',
	                borderWidth: 2
	            }, {
	                type: 'bar',
	                label: datalabel2,
	                backgroundColor: window.chartColors.red,
	                data: rowsrp2,
	                borderColor: 'white',
	                borderWidth: 2
	            }]

	        },
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

	function renderchart2(){
	    var ctx = document.getElementById('canvas2').getContext('2d');
	    window.myBar = new Chart(ctx, {
	        type: 'bar',
	        data: {
	            labels: ['Januari', 'Febuari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
	            datasets: [{
	                type: 'line',
	                label: datalabel,
	                borderColor: window.chartColors.blue,
	                borderWidth: 2,
	                fill: false,
	                data: rowslbr
	            },{
	                type: 'line',
	                label: datalabel2,
	                borderColor: window.chartColors.red,
	                borderWidth: 2,
	                fill: false,
	                data: rowslbr2
	            },{
	                type: 'bar',
	                label: datalabel,
	                backgroundColor: window.chartColors.blue,
	                data: rowslbr,
	                borderColor: 'white',
	                borderWidth: 2
	            }, {
	                type: 'bar',
	                label: datalabel2,
	                backgroundColor: window.chartColors.red,
	                data: rowslbr2,
	                borderColor: 'white',
	                borderWidth: 2
	            }]

	        },
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
	                fontSize: 20,
	                padding: 30,
	                text: texttitle2
	            },
	            scales: {
	                yAxes: dataY2
	            }
	        }
	    });
	}

</script>