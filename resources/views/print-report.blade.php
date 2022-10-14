<!DOCTYPE>
<html>
    <title>SJGH-Laboratory | Monthly Report</title>
    <link rel="shortcut icon" href="{{ asset('public/img/smmie_logo.ico') }}">
<head>
	<style type="text/css">
	/*	body{

			background-image: url("../img/water.png");
			background-repeat: no-repeat;
			background-position: 50% 50%;
		} */

		#logo{
			text-align: center;
			border-bottom: 2px solid;
			margin-bottom: 10px;
			margin-right: 14px;
		}


		.sign{
			text-align: right;
			margin-left: 5%;
			margin-right: 5px;
			margin-top: 5%;

		}

		button {
			float: right;
			padding-top: 10px;
			padding-bottom: 10px;
			padding-right: 20px;
			padding-left: 20px;
			font-weight: bolder;
			border: solid 1px;
			border-radius: 20px;
			position: relative;
			margin-right: 5%;
		}

		table{
			border-collapse: collapse;
            margin-right: 30px;
			width: 99%;
			/* break-inside: avoid; */
		}

		table, th, td{
			border: 1px solid;
            text-align: center;
		}

        table, td{
			border: 1px solid;
            text-align: right;
		}

		caption{
			font-weight: bolder; 
			font-size: 20px;
		}

		th{
            text-align: center;
			vertical-align: center;
		}
	
       	tr:hover{
        		background-color: #A4A4A4;
        	}

        .noprint:hover{

        	background-color: #ff6c60;
        }
        

		@media print {
			.noprint, #back{
				visibility: hidden;
			}

			#myheader_opd {
			    position: fixed;
			    top: 0;
			    right: 0; 
			  }

			@page{
				size: landscape;
			}

			tfoot{
				page-break-before: always;
			}
		}

		@media screen {
		  #myheader_opd{
		    display: none;
		  }

          /* br {
              display: none;
          } */
		}

	</style>

	<script type="text/javascript">
		function print_1(){
			window.print();
			window.location = 'report';
		}
	</script>

</head>

<body style="width: 100%;" >

 	<div id="back"><a href="{{ route('report') }}">Back</a></div>
    <header id="header">
        <div id="logo"><img src="{{ asset('public/img/logo_banner.jpg') }}" height="96" width="768"> &nbsp;
            <div>
                <b style="float: left; margin-left: 10%;">DATE: <?php echo date('d/m/Y');?></b>
                <b style="font-size: 20px;">LABORATORY REPORT</b>
                <b style="float: right; margin-right: 10%; text-transform: uppercase;">REPORT: {{ $report_dt['month'] }}, {{ $report_dt['year'] }}</b>
            </div>
        </div>
    </header>
    @php
        $dt_array = ['Microbiology', 'Haematology', 'Chemistries'];
    @endphp
    <div class = "data">
        @if(in_array($dt, $dt_array))
            <table>
                <caption style="padding-top: 20px; text-transform: uppercase;">{{ $dt }}</caption>
                <thead>
                    <tr>
                        <th rowspan="2">TEST</th>
                        <th colspan="12">Male</th>
                        <th colspan="12">Female</th>
                        <th rowspan="2">Grand Total</th>
                    </tr>
                    <tr>
                        <th nowrap>< 1</th>
                        <th nowrap>1 - 4</th>
                        <th nowrap>5 - 9</th>
                        <th nowrap>10 - 14</th>
                        <th nowrap>15 - 17</th>
                        <th nowrap>18 - 19</th>
                        <th nowrap>20 - 34</th>
                        <th nowrap>35 - 49</th>
                        <th nowrap>50 - 59</th>
                        <th nowrap>60 - 69</th>
                        <th nowrap>70 + </th>
                        <th nowrap>Total</th>
                        <th nowrap>< 1</th>
                        <th nowrap>1 - 4</th>
                        <th nowrap>5 - 9</th>
                        <th nowrap>10 - 14</th>
                        <th nowrap>15 - 17</th>
                        <th nowrap>18 - 19</th>
                        <th nowrap>20 - 34</th>
                        <th nowrap>35 - 49</th>
                        <th nowrap>50 - 59</th>
                        <th nowrap>60 - 69</th>
                        <th nowrap>70 + </th>
                        <th nowrap>Total</th>
                    </tr>
                </thead>

                @if ($dt == 'Microbiology')
                    @include('report.microbiology')
                @endif

                @if ($dt == 'Haematology')
                    @include('report.haematology')
                @endif

                @if ($dt == 'Chemistries')
                    @include('report.chemistries')
                @endif
            </table>

        @elseif ($dt == 'Attendance')

            @include('report.attendance_bloodbank') 

        @elseif ($dt == 'HIV') 

            @include('report.hiv')
            
        @endif	
                
    </div>

	<div id="myheader_opd" style="text-transform: uppercase;">{{ $report_dt['month'] }}, {{ $report_dt['year'] }}</div>
	<div class = "sign">
		<div class="receipt" id="sig"><b>SIGN:</b>...............................................</div>
	</div>

	<button class="noprint" onclick="print_1()">Print</button>
</body>	
<?php 
	// set_time_limit(0);	
?>
</html>
		
		
	