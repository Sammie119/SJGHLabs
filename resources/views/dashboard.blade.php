<?php 
    use App\Http\Controllers\GetdataController;

    $query = GetdataController::population();
?>

@extends('layouts.app')

@section('title', 'SJGH-LRMS | Dashboard')

<link rel="stylesheet" href="{{ asset('public/css/sjgh.main.css') }}">

<style>
    :root {
        --blue: #287bff;
        --white: #fff;
        --grey: #f5f5f5;
        --black1: #222;
        --black2: #999;
    }

/* cards */
    .cardBox {
        position: relative;
        width: 100%;
        padding: 0px 20px 20px 20px;
        display: grid;
        grid-template-columns: repeat(4,1fr);
        grid-gap: 30px;
        margin-left: 1.5%;
    }

    .cardBox .card {
        height: 130px;
        width: 250px;
        position: relative;
        background: var(--white);
        padding: 30px;
        border-radius: 20px;
        display: flex;
        justify-content: space-between;
        box-shadow: 0 7px 25px rgba(0, 0, 0, 0.1);
    }

    .graph {
        box-shadow: 0 7px 25px rgba(0, 0, 0, 0.1);
    }

    .cardBox .card .numbers {
        position: relative;
        font-weight: 600;
        font-size: 2.5em;
        color: var(--blue);
    }

    .cardBox .card .cardName {
        color: var(--black2);
        font-size: 1.1em;
        margin-top: 5px;
    } 

    .cardBox .card .iconBx {
        font-size: 3.5em;
        color: var(--black2);
    } 

    .cardBox .card:hover {
        background: var(--blue);
    }

    .cardBox .card:hover .numbers,
    .cardBox .card:hover .iconBx,
    .cardBox .card:hover .cardName {
        color: var(--white);
    }

    .iconBx {
        padding-left: 20px;
    }

    @media (max-width: 1200px) {
        .cardBox {
            grid-template-columns: repeat(2,1fr);
        }
    }

    @media (max-width: 991px) {
        .cardBox {
            grid-template-columns: repeat(2,1fr);
        }
    }

    @media (max-width: 680px) {
        .cardBox {
            grid-template-columns: repeat(1,1fr);
        }
    }
/* end card */
</style>

@section('content')
    <div style="width: 80%; margin-top: 8%">
        <div style="width: 100%; margin-left: 13%">
            @if (Session::has('success'))
                <div class="alert alert-success text-center" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><small>x</small></button>
                    <h4>{{ Session::get('success') }}</h4>
                </div>
            @endif
            {{-- <div class="text-center" style="font-weight: bolder; color: #191970; font-family: Times new roman; margin-top: 20px; line-height: 250%;">
                <b style="font-size: 50px;"> ST. JOHN OF GOD HOSPITAL</b><br>
                <b style="font-size: 30px;"> Duayaw Nkwanta, Ahafo Region</b> <br>
                <b style="font-size: 30px;"> Laboratory Report Management System</b>
            </div> --}}
        </div>

        {{-- Card --}}
        <div class="cardBox">
            <div class="card">
                <table>
                    <tr>
                        <td class="numbers">{{ $query['userlabs'] }}</td>
                        <td rowspan="2" class="iconBx"><i class="fa fa-user-md"></i></td>
                    </tr>
                    <tr>
                        <td class="cardName">{{ Session::get('user')['username'] }}, Labs Recorded</td>
                    </tr>
                </table>
            </div>
            <div class="card">
                <table>
                    <tr>
                        <td class="numbers">{{ $query['patient'] }}</td>
                        <td rowspan="2" class="iconBx"><i class="fa fa-male"></i></td>
                    </tr>
                    <tr>
                        <td class="cardName">Total Patients</td>
                    </tr>
                </table>
            </div>
            <div class="card">
                <table>
                    <tr>
                        <td class="numbers">{{ $query['labs'] }}</td>
                        <td rowspan="2" class="iconBx"><i class="fa fa-user-md"></i></td>
                    </tr>
                    <tr>
                        <td class="cardName">Total Labs</td>
                    </tr>
                </table>
            </div>
            <div class="card">
                <table>
                    <tr>
                        <td class="numbers">{{ $query['users'] }}</td>
                        <td rowspan="2" class="iconBx"><i class="fa fa-users"></i></td>
                    </tr>
                    <tr>
                        <td class="cardName">Users</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="container-fluid" style="margin-left: 10%">
            <div class="row" style="">
                <div class="col-6">
                    <div class="card graph mb-3 ml-4 col-12" style="border-radius: 20px">
                        <div class="card-body text-primary" id="pie-chart" style="height: 350px">
                            
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="card graph mb-3 ml-4 col-12" style="border-radius: 20px">
                        <div class="card-body text-primary" id="chart-container" style="height: 350px">
                            <?php
                                $results = [floatval($query['labsResults']->main + $query['labsResults']->blood), floatval($query['labsResults']->rch)];
                            ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Card --}}
    </div>
    
    <div class="text-center">
        <footer>Created and Designed by: <i><b>SAMMAV I.T</b> Services (0248376160 / 0556226864)</i> &nbsp &copy; <?php echo date('Y');?></footer>
    </div>

    {{-- Javascript graph --}}

<script src="{{ asset('public/js/highcharts.js') }}"></script>

<script>
    var datas = <?php echo json_encode($results) ?>
	
	Highcharts.chart('chart-container', {
		title: {
			text: 'Labs Department Distribution'
		},
		subtitle: {
			text: 'Source: SJGH Laboratory'
		},
		xAxis: {
			title: {
				text: 'Lab Departments'
			},
			categories: ['Main','RCH']
		},
		yAxis:{
			title: {
				text: 'Number of Labs Results'
			}
		},
		legend: {
			layout: 'vertical',
			align: 'right',
			verticalAlign: 'middle'
		},
		plotOptions: {
			series: {
				allowPointSelect:true,
                cursor: 'pointer'
			}
		},
		series: [{
			name: 'Number of Results',
			data: datas
		}],
		responsive: {
			rules: [
				{
					condition: {
						maxWidth: 500
					},
					chartOptions:{
						legend: {
							layout: 'horizontal',
							align: 'center',
							verticalAlign: 'bottom'
						}
					}
				}
			]
		}
	});

    $(function(){
        
        Highcharts.chart('pie-chart', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotshadow: false,
                type: 'pie'
            },
            title: {
                text: 'Labs Gender Distribution'
            },
            subtitle: {
                text: 'Source: SJGH Laboratory'
            },
            tooltip: {
                pointFormat: '{point.gender}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix:'%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enable: true,
                        format: '<b>{point.gender}</b>: {point.percentage:.1f}%'
                    }
                }
            },
            series: [{
                name: 'Results',
                colorByPoint: true,
                data: <?= $query['datagraph']?>
            }]
            
        });
	});
</script>

@endsection