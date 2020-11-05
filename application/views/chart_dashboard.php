<?php
$tahun = '2013';

for($a=1 ; $a<=12; $a++){
	$total = $this->app_model->ChartSimpanan($a); //rand(500, 1800); //
	$data_simpanan[$a]= $total;
}
for($a=1 ; $a<=12; $a++){
	$total = $this->app_model->ChartPenarikan($a); //rand(500, 1800); //
	$data_penarikan[$a]= $total;
}
for($a=1 ; $a<=12; $a++){
	$total = $this->app_model->ChartBayarPinjaman($a); //rand(500, 1800); //
	$data_pembayaran[$a]= $total;
}


$tampil_data_simpanan = '';
$tampil_data_penarikan = '';
$tampil_data_pembayaran = '';

for ($i=1; $i<=12; $i++) {

	$tampil_data_simpanan .= $data_simpanan[$i];
	if($i < 12) $tampil_data_simpanan .= ',';
	
	$tampil_data_penarikan .= $data_penarikan[$i];
	if($i < 12) $tampil_data_penarikan .= ',';
	
	$tampil_data_pembayaran .= $data_pembayaran[$i];
	if($i < 12) $tampil_data_pembayaran .= ',';	
}

?>

<script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container_s',
                type: 'line',
				spacingTop: 0,				
				spacingBottom: 0
            },
            title: {
                text: 'Grafik Simpanan Bulanan',
				style: {
                        color: '#154C67',
                        fontSize: '14px',
                        fontFamily: 'Verdana, sans-serif'							
                    }
            },
            subtitle: {
                text: '<?php echo $judul;?>'
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
				labels: {
                    align: 'center',
                    style: {
                        fontSize: '8px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                title: {
                    text: 'Total',
                    style: {
                        color: '#154C67',
                        fontSize: '12px',
                        fontFamily: 'Verdana, sans-serif'						
                    }
                },
				lineColor:'#999',
				lineWidth:1,
				tickColor:'#666',
				tickWidth:1,
				tickLength:3,
				gridLineColor:'#ddd',				
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                enabled: true,
				formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        this.x +': '+ this.y;
                }
				/*
				headerFormat: '<b>{series.name}</b><br />',
                pointFormat: 'x = {point.x}, y = {point.y}'
				*/
            },
			legend: {
				enabled: true,
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'bottom',
                borderWidth: 0				
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: false
                    },
                    enableMouseTracking: true
                }
            },
            series: [{
                name: 'Simpanan Tahun <?php echo $tahun;?>',
                data: [<?php echo $tampil_data_simpanan;?>],
				color: '#AA4643'
            }
			]
        });
		chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container_p',
                type: 'line',
				spacingTop: 0,				
				spacingBottom: 0
            },
            title: {
                text: 'Grafik Penarikan Bulanan',
				style: {
                        color: '#154C67',
                        fontSize: '14px',
                        fontFamily: 'Verdana, sans-serif'							
                    }
            },
            subtitle: {
                text: '<?php echo $judul;?>'
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
				labels: {
                    align: 'center',
                    style: {
                        fontSize: '8px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                title: {
                    text: 'Total',
                    style: {
                        color: '#154C67',
                        fontSize: '12px',
                        fontFamily: 'Verdana, sans-serif'						
                    }
                },
				lineColor:'#999',
				lineWidth:1,
				tickColor:'#666',
				tickWidth:1,
				tickLength:3,
				gridLineColor:'#ddd',				
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        this.x +': '+ this.y;
                }
				/*
				headerFormat: '<b>{series.name}</b><br />',
                pointFormat: 'x = {point.x}, y = {point.y}'
				*/
            },
			legend: {
				enabled: true,
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'bottom',
                borderWidth: 0				
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: false
                    },
                    enableMouseTracking: true
                }
            },
            series: [{
                name: 'Penarikan Tahun <?php echo $tahun;?>',
                data: [<?php echo $tampil_data_penarikan;?>],
				color: '#AA4643'
            }
			]
        });
		
		chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                type: 'line',
				spacingTop: 0,				
				spacingBottom: 0
            },
            title: {
                text: 'Grafik Bulanan',
				style: {
                        color: '#154C67',
                        fontSize: '14px',
                        fontFamily: 'Verdana, sans-serif'							
                    }
            },
            subtitle: {
                text: '<?php echo $judul;?>'
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
				labels: {
                    align: 'center',
                    style: {
                        fontSize: '8px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                title: {
                    text: 'Total',
                    style: {
                        color: '#154C67',
                        fontSize: '12px',
                        fontFamily: 'Verdana, sans-serif'						
                    }
                },
				lineColor:'#999',
				lineWidth:1,
				tickColor:'#666',
				tickWidth:1,
				tickLength:3,
				gridLineColor:'#ddd',				
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        this.x +': '+ this.y;
                }
				/*
				headerFormat: '<b>{series.name}</b><br />',
                pointFormat: 'x = {point.x}, y = {point.y}'
				*/
            },
			legend: {
				enabled: true,
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'bottom',
                borderWidth: 0				
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: true
                }
            },
            series: [{
                name: 'Simpanan Tahun <?php echo $tahun;?>',
                data: [<?php echo $tampil_data_simpanan;?>],
				color: '#AA4643'
            },{
                name: 'Penarikan Tahun <?php echo $tahun;?>',
                data: [<?php echo $tampil_data_penarikan;?>],
				color: '#4572A7'
            },{
                name: 'Pembayaran Tahun <?php echo $tahun;?>',
                data: [<?php echo $tampil_data_pembayaran;?>],
				color: '#53b634'
            }
			]
        });
    });
    
});
</script>
<div id="container_s" style="float:left; width: 500px; height: 200px; margin: 0 auto"></div>
<div id="container_p" style="float:left; width: 500px; height: 200px; margin: 0 auto"></div>
<div id="container" style="float:left; width: 1000px; height: 330px; margin: 0 auto"></div>
	