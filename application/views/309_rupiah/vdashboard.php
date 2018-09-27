<?php
$PESAN = $this->session->userdata('PESAN');
?>
<section class="content">
<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <div class="container" style="width: 100%; height: 260px"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <div class="container2" style="width: 100%; height: 260px"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <div class="container3" style="width: 100%; height: 260px"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-body">
                <div class="container4" style="width: 100%; height: 260px"></div>
            </div>
        </div>
    </div>
</div>
</section>
<script type="text/javascript">

// chart start

    var barChartData = {
        labels: [
        <?php foreach ($data309all as $dt_309) { 
            echo $dt_309['THBLLAP'] . ',';
        }?>     
        ],
        datasets: [{
            label: 'Rupiah',
            backgroundColor: window.chartColors.red,
            borderColor: window.chartColors.red,
            data: [
            <?php foreach ($data309all as $dt_309) { 
                echo $dt_309['RPPTL'] . ',';
            }?>
            ],
            fill: false,
        }]

    };

    var barChartDataKwh = {
        labels: [
        <?php foreach ($data309all as $dt_309) { 
            echo $dt_309['THBLLAP'] . ',';
        }?>     
        ],
        datasets: [{
            label: 'Kwh',
            backgroundColor: window.chartColors.blue,
            borderColor: window.chartColors.blue,
            data: [
            <?php foreach ($data309all as $dt_309) { 
                echo $dt_309['JMLKWH'] . ',';
            }?>
            ],
            fill: false,
        }]

    };

    var barChartDataKomulatif = {
        labels: [
        <?php foreach ($data309all as $dt_309) { 
            echo $dt_309['THBLLAP'] . ',';
        }?>     
        ],
        datasets: [{
            label: 'Rupiah',
            backgroundColor: window.chartColors.red,
            borderColor: window.chartColors.red,
            data: [
            <?php foreach ($data309all as $dt_309) { 
                echo $dt_309['RP_KOMULATIF'] . ',';
            }?>
            ],
            fill: false,
        }]

    };

    var barChartDataKomulatifKwh = {
        labels: [
        <?php foreach ($data309all as $dt_309) { 
            echo $dt_309['THBLLAP'] . ',';
        }?>     
        ],
        datasets: [{
            label: 'Kwh',
            backgroundColor: window.chartColors.blue,
            borderColor: window.chartColors.blue,
            data: [
            <?php foreach ($data309all as $dt_309) { 
                echo $dt_309['KWH_KOMULATIF'] . ',';
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
                        fontSize: 16,
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
                        fontSize: 16,
                        fontStyle: 'bold',
                        text: title
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                callback: function(label, index, labels) {
                                        return label/1000000000+'M';
                                },  
                                min: 0
                            }
                        }]
                    }
                }
            };
        }


    var titleRp = '309 Rupiah <?php echo $datajenislap ?> - Tahun <?php echo $datatahun ?>'
    var titleKwh = '309 Kwh <?php echo $datajenislap ?> - Tahun <?php echo $datatahun ?>'
    var titleKomulatif = '309 Rupiah Komulatif <?php echo $datajenislap ?> - Tahun <?php echo $datatahun ?>'
    var titleKomulatifKwh = '309 Kwh Komulatif <?php echo $datajenislap ?> - Tahun <?php echo $datatahun ?>'


    window.onload = function() {
            var container = document.querySelector('.container');
            var container2 = document.querySelector('.container2');
            var container3 = document.querySelector('.container3');
            var container4 = document.querySelector('.container4');

            [{
                data: barChartData,
                title: titleRp
            }, {
                data: barChartDataKwh,
                title: titleKwh
            }, {
                data: barChartDataKomulatif,
                title: titleKomulatif
            }, {
                data: barChartDataKomulatifKwh,
                title: titleKomulatifKwh
            }].forEach(function(details) {
                var div = document.createElement('div');
                div.classList.add('chart-container');

                var canvas = document.createElement('canvas');
                div.appendChild(canvas);
                if (details.data == barChartData) {
                    container.appendChild(div); 
                    var config = createConfig(details.data,details.title);
                }else if(details.data == barChartDataKwh) {
                    container2.appendChild(div); 
                    var config = createConfig2(details.data,details.title);
                }else if(details.data == barChartDataKomulatif) {
                    container3.appendChild(div)
                    var config = createConfig(details.data,details.title);
                }else if(details.data == barChartDataKomulatifKwh) {
                    container4.appendChild(div)
                    var config = createConfig2(details.data,details.title);
                }

                var ctx = canvas.getContext('2d');
                new Chart(ctx, config);
            });
    };

</script>