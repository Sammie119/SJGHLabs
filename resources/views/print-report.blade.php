<!DOCTYPE>
<html>
    <title>SJGH-Laboratory | Monthly Report</title>
    <link rel="shortcut icon" href="{{ asset('public/img/logo_icon.ico') }}">
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

    <div class = "data">
        @if($dt == 'Microbiology' || $dt == 'Haematology' || $dt == 'Chemistries')
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
                    <tbody>
                        <tr>
                            <td style="text-align: left" nowrap>Urine (culture)</td>
                            <td>{{ $query['urine']->bacter_specimenm1 }}</td>
                            <td>{{ $query['urine']->bacter_specimenm2 }}</td>
                            <td>{{ $query['urine']->bacter_specimenm3 }}</td>
                            <td>{{ $query['urine']->bacter_specimenm4 }}</td>
                            <td>{{ $query['urine']->bacter_specimenm5 }}</td>
                            <td>{{ $query['urine']->bacter_specimenm6 }}</td>
                            <td>{{ $query['urine']->bacter_specimenm7 }}</td>
                            <td>{{ $query['urine']->bacter_specimenm8 }}</td>
                            <td>{{ $query['urine']->bacter_specimenm9 }}</td>
                            <td>{{ $query['urine']->bacter_specimenm10 }}</td>
                            <td>{{ $query['urine']->bacter_specimenm11 }}</td>
                            <td>{{ $query['urine']->bacter_specimenm12 }}</td>
                            <td>{{ $query['urine']->bacter_specimenf1 }}</td>
                            <td>{{ $query['urine']->bacter_specimenf2 }}</td>
                            <td>{{ $query['urine']->bacter_specimenf3 }}</td>
                            <td>{{ $query['urine']->bacter_specimenf4 }}</td>
                            <td>{{ $query['urine']->bacter_specimenf5 }}</td>
                            <td>{{ $query['urine']->bacter_specimenf6 }}</td>
                            <td>{{ $query['urine']->bacter_specimenf7 }}</td>
                            <td>{{ $query['urine']->bacter_specimenf8 }}</td>
                            <td>{{ $query['urine']->bacter_specimenf9 }}</td>
                            <td>{{ $query['urine']->bacter_specimenf10 }}</td>
                            <td>{{ $query['urine']->bacter_specimenf11 }}</td>
                            <td>{{ $query['urine']->bacter_specimenf12 }}</td>
                            <td>{{ $query['urine']->bacter_specimen }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>Stool (culture)</td>
                            <td>{{ $query['stool']->bacter_specimenm1 }}</td>
                            <td>{{ $query['stool']->bacter_specimenm2 }}</td>
                            <td>{{ $query['stool']->bacter_specimenm3 }}</td>
                            <td>{{ $query['stool']->bacter_specimenm4 }}</td>
                            <td>{{ $query['stool']->bacter_specimenm5 }}</td>
                            <td>{{ $query['stool']->bacter_specimenm6 }}</td>
                            <td>{{ $query['stool']->bacter_specimenm7 }}</td>
                            <td>{{ $query['stool']->bacter_specimenm8 }}</td>
                            <td>{{ $query['stool']->bacter_specimenm9 }}</td>
                            <td>{{ $query['stool']->bacter_specimenm10 }}</td>
                            <td>{{ $query['stool']->bacter_specimenm11 }}</td>
                            <td>{{ $query['stool']->bacter_specimenm12 }}</td>
                            <td>{{ $query['stool']->bacter_specimenf1 }}</td>
                            <td>{{ $query['stool']->bacter_specimenf2 }}</td>
                            <td>{{ $query['stool']->bacter_specimenf3 }}</td>
                            <td>{{ $query['stool']->bacter_specimenf4 }}</td>
                            <td>{{ $query['stool']->bacter_specimenf5 }}</td>
                            <td>{{ $query['stool']->bacter_specimenf6 }}</td>
                            <td>{{ $query['stool']->bacter_specimenf7 }}</td>
                            <td>{{ $query['stool']->bacter_specimenf8 }}</td>
                            <td>{{ $query['stool']->bacter_specimenf9 }}</td>
                            <td>{{ $query['stool']->bacter_specimenf10 }}</td>
                            <td>{{ $query['stool']->bacter_specimenf11 }}</td>
                            <td>{{ $query['stool']->bacter_specimenf12 }}</td>
                            <td>{{ $query['stool']->bacter_specimen }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>HVS (microscopy)</td>
                            <td>{{ $query['vaginal_epith']->vaginal_epithm1 }}</td>
                            <td>{{ $query['vaginal_epith']->vaginal_epithm2 }}</td>
                            <td>{{ $query['vaginal_epith']->vaginal_epithm3 }}</td>
                            <td>{{ $query['vaginal_epith']->vaginal_epithm4 }}</td>
                            <td>{{ $query['vaginal_epith']->vaginal_epithm5 }}</td>
                            <td>{{ $query['vaginal_epith']->vaginal_epithm6 }}</td>
                            <td>{{ $query['vaginal_epith']->vaginal_epithm7 }}</td>
                            <td>{{ $query['vaginal_epith']->vaginal_epithm8 }}</td>
                            <td>{{ $query['vaginal_epith']->vaginal_epithm9 }}</td>
                            <td>{{ $query['vaginal_epith']->vaginal_epithm10 }}</td>
                            <td>{{ $query['vaginal_epith']->vaginal_epithm11 }}</td>
                            <td>{{ $query['vaginal_epith']->vaginal_epithm12 }}</td>
                            <td>{{ $query['vaginal_epith']->vaginal_epithf1 }}</td>
                            <td>{{ $query['vaginal_epith']->vaginal_epithf2 }}</td>
                            <td>{{ $query['vaginal_epith']->vaginal_epithf3 }}</td>
                            <td>{{ $query['vaginal_epith']->vaginal_epithf4 }}</td>
                            <td>{{ $query['vaginal_epith']->vaginal_epithf5 }}</td>
                            <td>{{ $query['vaginal_epith']->vaginal_epithf6 }}</td>
                            <td>{{ $query['vaginal_epith']->vaginal_epithf7 }}</td>
                            <td>{{ $query['vaginal_epith']->vaginal_epithf8 }}</td>
                            <td>{{ $query['vaginal_epith']->vaginal_epithf9 }}</td>
                            <td>{{ $query['vaginal_epith']->vaginal_epithf10 }}</td>
                            <td>{{ $query['vaginal_epith']->vaginal_epithf11 }}</td>
                            <td>{{ $query['vaginal_epith']->vaginal_epithf12 }}</td>
                            <td>{{ $query['vaginal_epith']->vaginal_epith }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>HVS (culture)</td>
                            <td>{{ $query['vaginal']->bacter_specimenm1 }}</td>
                            <td>{{ $query['vaginal']->bacter_specimenm2 }}</td>
                            <td>{{ $query['vaginal']->bacter_specimenm3 }}</td>
                            <td>{{ $query['vaginal']->bacter_specimenm4 }}</td>
                            <td>{{ $query['vaginal']->bacter_specimenm5 }}</td>
                            <td>{{ $query['vaginal']->bacter_specimenm6 }}</td>
                            <td>{{ $query['vaginal']->bacter_specimenm7 }}</td>
                            <td>{{ $query['vaginal']->bacter_specimenm8 }}</td>
                            <td>{{ $query['vaginal']->bacter_specimenm9 }}</td>
                            <td>{{ $query['vaginal']->bacter_specimenm10 }}</td>
                            <td>{{ $query['vaginal']->bacter_specimenm11 }}</td>
                            <td>{{ $query['vaginal']->bacter_specimenm12 }}</td>
                            <td>{{ $query['vaginal']->bacter_specimenf1 }}</td>
                            <td>{{ $query['vaginal']->bacter_specimenf2 }}</td>
                            <td>{{ $query['vaginal']->bacter_specimenf3 }}</td>
                            <td>{{ $query['vaginal']->bacter_specimenf4 }}</td>
                            <td>{{ $query['vaginal']->bacter_specimenf5 }}</td>
                            <td>{{ $query['vaginal']->bacter_specimenf6 }}</td>
                            <td>{{ $query['vaginal']->bacter_specimenf7 }}</td>
                            <td>{{ $query['vaginal']->bacter_specimenf8 }}</td>
                            <td>{{ $query['vaginal']->bacter_specimenf9 }}</td>
                            <td>{{ $query['vaginal']->bacter_specimenf10 }}</td>
                            <td>{{ $query['vaginal']->bacter_specimenf11 }}</td>
                            <td>{{ $query['vaginal']->bacter_specimenf12 }}</td>
                            <td>{{ $query['vaginal']->bacter_specimen }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>Sputum (AFB)</td>
                            <td>{{ $query['sputum_afb']->bacter_specimenm1 }}</td>
                            <td>{{ $query['sputum_afb']->bacter_specimenm2 }}</td>
                            <td>{{ $query['sputum_afb']->bacter_specimenm3 }}</td>
                            <td>{{ $query['sputum_afb']->bacter_specimenm4 }}</td>
                            <td>{{ $query['sputum_afb']->bacter_specimenm5 }}</td>
                            <td>{{ $query['sputum_afb']->bacter_specimenm6 }}</td>
                            <td>{{ $query['sputum_afb']->bacter_specimenm7 }}</td>
                            <td>{{ $query['sputum_afb']->bacter_specimenm8 }}</td>
                            <td>{{ $query['sputum_afb']->bacter_specimenm9 }}</td>
                            <td>{{ $query['sputum_afb']->bacter_specimenm10 }}</td>
                            <td>{{ $query['sputum_afb']->bacter_specimenm11 }}</td>
                            <td>{{ $query['sputum_afb']->bacter_specimenm12 }}</td>
                            <td>{{ $query['sputum_afb']->bacter_specimenf1 }}</td>
                            <td>{{ $query['sputum_afb']->bacter_specimenf2 }}</td>
                            <td>{{ $query['sputum_afb']->bacter_specimenf3 }}</td>
                            <td>{{ $query['sputum_afb']->bacter_specimenf4 }}</td>
                            <td>{{ $query['sputum_afb']->bacter_specimenf5 }}</td>
                            <td>{{ $query['sputum_afb']->bacter_specimenf6 }}</td>
                            <td>{{ $query['sputum_afb']->bacter_specimenf7 }}</td>
                            <td>{{ $query['sputum_afb']->bacter_specimenf8 }}</td>
                            <td>{{ $query['sputum_afb']->bacter_specimenf9 }}</td>
                            <td>{{ $query['sputum_afb']->bacter_specimenf10 }}</td>
                            <td>{{ $query['sputum_afb']->bacter_specimenf11 }}</td>
                            <td>{{ $query['sputum_afb']->bacter_specimenf12 }}</td>
                            <td>{{ $query['sputum_afb']->bacter_specimen }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>Sputum (C/F)</td>
                            <td>{{ $query['sputum_cf']->bacter_specimenm1 }}</td>
                            <td>{{ $query['sputum_cf']->bacter_specimenm2 }}</td>
                            <td>{{ $query['sputum_cf']->bacter_specimenm3 }}</td>
                            <td>{{ $query['sputum_cf']->bacter_specimenm4 }}</td>
                            <td>{{ $query['sputum_cf']->bacter_specimenm5 }}</td>
                            <td>{{ $query['sputum_cf']->bacter_specimenm6 }}</td>
                            <td>{{ $query['sputum_cf']->bacter_specimenm7 }}</td>
                            <td>{{ $query['sputum_cf']->bacter_specimenm8 }}</td>
                            <td>{{ $query['sputum_cf']->bacter_specimenm9 }}</td>
                            <td>{{ $query['sputum_cf']->bacter_specimenm10 }}</td>
                            <td>{{ $query['sputum_cf']->bacter_specimenm11 }}</td>
                            <td>{{ $query['sputum_cf']->bacter_specimenm12 }}</td>
                            <td>{{ $query['sputum_cf']->bacter_specimenf1 }}</td>
                            <td>{{ $query['sputum_cf']->bacter_specimenf2 }}</td>
                            <td>{{ $query['sputum_cf']->bacter_specimenf3 }}</td>
                            <td>{{ $query['sputum_cf']->bacter_specimenf4 }}</td>
                            <td>{{ $query['sputum_cf']->bacter_specimenf5 }}</td>
                            <td>{{ $query['sputum_cf']->bacter_specimenf6 }}</td>
                            <td>{{ $query['sputum_cf']->bacter_specimenf7 }}</td>
                            <td>{{ $query['sputum_cf']->bacter_specimenf8 }}</td>
                            <td>{{ $query['sputum_cf']->bacter_specimenf9 }}</td>
                            <td>{{ $query['sputum_cf']->bacter_specimenf10 }}</td>
                            <td>{{ $query['sputum_cf']->bacter_specimenf11 }}</td>
                            <td>{{ $query['sputum_cf']->bacter_specimenf12 }}</td>
                            <td>{{ $query['sputum_cf']->bacter_specimen }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>Skin Snip</td>
                            <td>{{ $query['skin_snip']->bacter_specimenm1 }}</td>
                            <td>{{ $query['skin_snip']->bacter_specimenm2 }}</td>
                            <td>{{ $query['skin_snip']->bacter_specimenm3 }}</td>
                            <td>{{ $query['skin_snip']->bacter_specimenm4 }}</td>
                            <td>{{ $query['skin_snip']->bacter_specimenm5 }}</td>
                            <td>{{ $query['skin_snip']->bacter_specimenm6 }}</td>
                            <td>{{ $query['skin_snip']->bacter_specimenm7 }}</td>
                            <td>{{ $query['skin_snip']->bacter_specimenm8 }}</td>
                            <td>{{ $query['skin_snip']->bacter_specimenm9 }}</td>
                            <td>{{ $query['skin_snip']->bacter_specimenm10 }}</td>
                            <td>{{ $query['skin_snip']->bacter_specimenm11 }}</td>
                            <td>{{ $query['skin_snip']->bacter_specimenm12 }}</td>
                            <td>{{ $query['skin_snip']->bacter_specimenf1 }}</td>
                            <td>{{ $query['skin_snip']->bacter_specimenf2 }}</td>
                            <td>{{ $query['skin_snip']->bacter_specimenf3 }}</td>
                            <td>{{ $query['skin_snip']->bacter_specimenf4 }}</td>
                            <td>{{ $query['skin_snip']->bacter_specimenf5 }}</td>
                            <td>{{ $query['skin_snip']->bacter_specimenf6 }}</td>
                            <td>{{ $query['skin_snip']->bacter_specimenf7 }}</td>
                            <td>{{ $query['skin_snip']->bacter_specimenf8 }}</td>
                            <td>{{ $query['skin_snip']->bacter_specimenf9 }}</td>
                            <td>{{ $query['skin_snip']->bacter_specimenf10 }}</td>
                            <td>{{ $query['skin_snip']->bacter_specimenf11 }}</td>
                            <td>{{ $query['skin_snip']->bacter_specimenf12 }}</td>
                            <td>{{ $query['skin_snip']->bacter_specimen }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>CSF (microscopy)</td>
                            <td>{{ $query['csf_appear']->csf_appearm1 }}</td>
                            <td>{{ $query['csf_appear']->csf_appearm2 }}</td>
                            <td>{{ $query['csf_appear']->csf_appearm3 }}</td>
                            <td>{{ $query['csf_appear']->csf_appearm4 }}</td>
                            <td>{{ $query['csf_appear']->csf_appearm5 }}</td>
                            <td>{{ $query['csf_appear']->csf_appearm6 }}</td>
                            <td>{{ $query['csf_appear']->csf_appearm7 }}</td>
                            <td>{{ $query['csf_appear']->csf_appearm8 }}</td>
                            <td>{{ $query['csf_appear']->csf_appearm9 }}</td>
                            <td>{{ $query['csf_appear']->csf_appearm10 }}</td>
                            <td>{{ $query['csf_appear']->csf_appearm11 }}</td>
                            <td>{{ $query['csf_appear']->csf_appearm12 }}</td>
                            <td>{{ $query['csf_appear']->csf_appearf1 }}</td>
                            <td>{{ $query['csf_appear']->csf_appearf2 }}</td>
                            <td>{{ $query['csf_appear']->csf_appearf3 }}</td>
                            <td>{{ $query['csf_appear']->csf_appearf4 }}</td>
                            <td>{{ $query['csf_appear']->csf_appearf5 }}</td>
                            <td>{{ $query['csf_appear']->csf_appearf6 }}</td>
                            <td>{{ $query['csf_appear']->csf_appearf7 }}</td>
                            <td>{{ $query['csf_appear']->csf_appearf8 }}</td>
                            <td>{{ $query['csf_appear']->csf_appearf9 }}</td>
                            <td>{{ $query['csf_appear']->csf_appearf10 }}</td>
                            <td>{{ $query['csf_appear']->csf_appearf11 }}</td>
                            <td>{{ $query['csf_appear']->csf_appearf12 }}</td>
                            <td>{{ $query['csf_appear']->csf_appear }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>CSF (culture)</td>
                            <td>{{ $query['csf_cul']->csf_appearm1 }}</td>
                            <td>{{ $query['csf_cul']->csf_appearm2 }}</td>
                            <td>{{ $query['csf_cul']->csf_appearm3 }}</td>
                            <td>{{ $query['csf_cul']->csf_appearm4 }}</td>
                            <td>{{ $query['csf_cul']->csf_appearm5 }}</td>
                            <td>{{ $query['csf_cul']->csf_appearm6 }}</td>
                            <td>{{ $query['csf_cul']->csf_appearm7 }}</td>
                            <td>{{ $query['csf_cul']->csf_appearm8 }}</td>
                            <td>{{ $query['csf_cul']->csf_appearm9 }}</td>
                            <td>{{ $query['csf_cul']->csf_appearm10 }}</td>
                            <td>{{ $query['csf_cul']->csf_appearm11 }}</td>
                            <td>{{ $query['csf_cul']->csf_appearm12 }}</td>
                            <td>{{ $query['csf_cul']->csf_appearf1 }}</td>
                            <td>{{ $query['csf_cul']->csf_appearf2 }}</td>
                            <td>{{ $query['csf_cul']->csf_appearf3 }}</td>
                            <td>{{ $query['csf_cul']->csf_appearf4 }}</td>
                            <td>{{ $query['csf_cul']->csf_appearf5 }}</td>
                            <td>{{ $query['csf_cul']->csf_appearf6 }}</td>
                            <td>{{ $query['csf_cul']->csf_appearf7 }}</td>
                            <td>{{ $query['csf_cul']->csf_appearf8 }}</td>
                            <td>{{ $query['csf_cul']->csf_appearf9 }}</td>
                            <td>{{ $query['csf_cul']->csf_appearf10 }}</td>
                            <td>{{ $query['csf_cul']->csf_appearf11 }}</td>
                            <td>{{ $query['csf_cul']->csf_appearf12 }}</td>
                            <td>{{ $query['csf_cul']->csf_appear }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>Urethral Swab (microscopy)</td>
                            <td>{{ $query['urethral']->bacter_specimenm1 }}</td>
                            <td>{{ $query['urethral']->bacter_specimenm2 }}</td>
                            <td>{{ $query['urethral']->bacter_specimenm3 }}</td>
                            <td>{{ $query['urethral']->bacter_specimenm4 }}</td>
                            <td>{{ $query['urethral']->bacter_specimenm5 }}</td>
                            <td>{{ $query['urethral']->bacter_specimenm6 }}</td>
                            <td>{{ $query['urethral']->bacter_specimenm7 }}</td>
                            <td>{{ $query['urethral']->bacter_specimenm8 }}</td>
                            <td>{{ $query['urethral']->bacter_specimenm9 }}</td>
                            <td>{{ $query['urethral']->bacter_specimenm10 }}</td>
                            <td>{{ $query['urethral']->bacter_specimenm11 }}</td>
                            <td>{{ $query['urethral']->bacter_specimenm12 }}</td>
                            <td>{{ $query['urethral']->bacter_specimenf1 }}</td>
                            <td>{{ $query['urethral']->bacter_specimenf2 }}</td>
                            <td>{{ $query['urethral']->bacter_specimenf3 }}</td>
                            <td>{{ $query['urethral']->bacter_specimenf4 }}</td>
                            <td>{{ $query['urethral']->bacter_specimenf5 }}</td>
                            <td>{{ $query['urethral']->bacter_specimenf6 }}</td>
                            <td>{{ $query['urethral']->bacter_specimenf7 }}</td>
                            <td>{{ $query['urethral']->bacter_specimenf8 }}</td>
                            <td>{{ $query['urethral']->bacter_specimenf9 }}</td>
                            <td>{{ $query['urethral']->bacter_specimenf10 }}</td>
                            <td>{{ $query['urethral']->bacter_specimenf11 }}</td>
                            <td>{{ $query['urethral']->bacter_specimenf12 }}</td>
                            <td>{{ $query['urethral']->bacter_specimen }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>Urethral Swab (culture)</td>
                            <td>{{ $query['urethral_swab']->bacter_specimenm1 }}</td>
                            <td>{{ $query['urethral_swab']->bacter_specimenm2 }}</td>
                            <td>{{ $query['urethral_swab']->bacter_specimenm3 }}</td>
                            <td>{{ $query['urethral_swab']->bacter_specimenm4 }}</td>
                            <td>{{ $query['urethral_swab']->bacter_specimenm5 }}</td>
                            <td>{{ $query['urethral_swab']->bacter_specimenm6 }}</td>
                            <td>{{ $query['urethral_swab']->bacter_specimenm7 }}</td>
                            <td>{{ $query['urethral_swab']->bacter_specimenm8 }}</td>
                            <td>{{ $query['urethral_swab']->bacter_specimenm9 }}</td>
                            <td>{{ $query['urethral_swab']->bacter_specimenm10 }}</td>
                            <td>{{ $query['urethral_swab']->bacter_specimenm11 }}</td>
                            <td>{{ $query['urethral_swab']->bacter_specimenm12 }}</td>
                            <td>{{ $query['urethral_swab']->bacter_specimenf1 }}</td>
                            <td>{{ $query['urethral_swab']->bacter_specimenf2 }}</td>
                            <td>{{ $query['urethral_swab']->bacter_specimenf3 }}</td>
                            <td>{{ $query['urethral_swab']->bacter_specimenf4 }}</td>
                            <td>{{ $query['urethral_swab']->bacter_specimenf5 }}</td>
                            <td>{{ $query['urethral_swab']->bacter_specimenf6 }}</td>
                            <td>{{ $query['urethral_swab']->bacter_specimenf7 }}</td>
                            <td>{{ $query['urethral_swab']->bacter_specimenf8 }}</td>
                            <td>{{ $query['urethral_swab']->bacter_specimenf9 }}</td>
                            <td>{{ $query['urethral_swab']->bacter_specimenf10 }}</td>
                            <td>{{ $query['urethral_swab']->bacter_specimenf11 }}</td>
                            <td>{{ $query['urethral_swab']->bacter_specimenf12 }}</td>
                            <td>{{ $query['urethral_swab']->bacter_specimen }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>Wound Swab (culture)</td>
                            <td>{{ $query['wound']->bacter_specimenm1 }}</td>
                            <td>{{ $query['wound']->bacter_specimenm2 }}</td>
                            <td>{{ $query['wound']->bacter_specimenm3 }}</td>
                            <td>{{ $query['wound']->bacter_specimenm4 }}</td>
                            <td>{{ $query['wound']->bacter_specimenm5 }}</td>
                            <td>{{ $query['wound']->bacter_specimenm6 }}</td>
                            <td>{{ $query['wound']->bacter_specimenm7 }}</td>
                            <td>{{ $query['wound']->bacter_specimenm8 }}</td>
                            <td>{{ $query['wound']->bacter_specimenm9 }}</td>
                            <td>{{ $query['wound']->bacter_specimenm10 }}</td>
                            <td>{{ $query['wound']->bacter_specimenm11 }}</td>
                            <td>{{ $query['wound']->bacter_specimenm12 }}</td>
                            <td>{{ $query['wound']->bacter_specimenf1 }}</td>
                            <td>{{ $query['wound']->bacter_specimenf2 }}</td>
                            <td>{{ $query['wound']->bacter_specimenf3 }}</td>
                            <td>{{ $query['wound']->bacter_specimenf4 }}</td>
                            <td>{{ $query['wound']->bacter_specimenf5 }}</td>
                            <td>{{ $query['wound']->bacter_specimenf6 }}</td>
                            <td>{{ $query['wound']->bacter_specimenf7 }}</td>
                            <td>{{ $query['wound']->bacter_specimenf8 }}</td>
                            <td>{{ $query['wound']->bacter_specimenf9 }}</td>
                            <td>{{ $query['wound']->bacter_specimenf10 }}</td>
                            <td>{{ $query['wound']->bacter_specimenf11 }}</td>
                            <td>{{ $query['wound']->bacter_specimenf12 }}</td>
                            <td>{{ $query['wound']->bacter_specimen }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>Throat Swab (microscopy)</td>
                            <td>{{ $query['throat']->bacter_specimenm1 }}</td>
                            <td>{{ $query['throat']->bacter_specimenm2 }}</td>
                            <td>{{ $query['throat']->bacter_specimenm3 }}</td>
                            <td>{{ $query['throat']->bacter_specimenm4 }}</td>
                            <td>{{ $query['throat']->bacter_specimenm5 }}</td>
                            <td>{{ $query['throat']->bacter_specimenm6 }}</td>
                            <td>{{ $query['throat']->bacter_specimenm7 }}</td>
                            <td>{{ $query['throat']->bacter_specimenm8 }}</td>
                            <td>{{ $query['throat']->bacter_specimenm9 }}</td>
                            <td>{{ $query['throat']->bacter_specimenm10 }}</td>
                            <td>{{ $query['throat']->bacter_specimenm11 }}</td>
                            <td>{{ $query['throat']->bacter_specimenm12 }}</td>
                            <td>{{ $query['throat']->bacter_specimenf1 }}</td>
                            <td>{{ $query['throat']->bacter_specimenf2 }}</td>
                            <td>{{ $query['throat']->bacter_specimenf3 }}</td>
                            <td>{{ $query['throat']->bacter_specimenf4 }}</td>
                            <td>{{ $query['throat']->bacter_specimenf5 }}</td>
                            <td>{{ $query['throat']->bacter_specimenf6 }}</td>
                            <td>{{ $query['throat']->bacter_specimenf7 }}</td>
                            <td>{{ $query['throat']->bacter_specimenf8 }}</td>
                            <td>{{ $query['throat']->bacter_specimenf9 }}</td>
                            <td>{{ $query['throat']->bacter_specimenf10 }}</td>
                            <td>{{ $query['throat']->bacter_specimenf11 }}</td>
                            <td>{{ $query['throat']->bacter_specimenf12 }}</td>
                            <td>{{ $query['throat']->bacter_specimen }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>Throat Swab (culture)</td>
                            <td>{{ $query['throat_cul']->bacter_specimenm1 }}</td>
                            <td>{{ $query['throat_cul']->bacter_specimenm2 }}</td>
                            <td>{{ $query['throat_cul']->bacter_specimenm3 }}</td>
                            <td>{{ $query['throat_cul']->bacter_specimenm4 }}</td>
                            <td>{{ $query['throat_cul']->bacter_specimenm5 }}</td>
                            <td>{{ $query['throat_cul']->bacter_specimenm6 }}</td>
                            <td>{{ $query['throat_cul']->bacter_specimenm7 }}</td>
                            <td>{{ $query['throat_cul']->bacter_specimenm8 }}</td>
                            <td>{{ $query['throat_cul']->bacter_specimenm9 }}</td>
                            <td>{{ $query['throat_cul']->bacter_specimenm10 }}</td>
                            <td>{{ $query['throat_cul']->bacter_specimenm11 }}</td>
                            <td>{{ $query['throat_cul']->bacter_specimenm12 }}</td>
                            <td>{{ $query['throat_cul']->bacter_specimenf1 }}</td>
                            <td>{{ $query['throat_cul']->bacter_specimenf2 }}</td>
                            <td>{{ $query['throat_cul']->bacter_specimenf3 }}</td>
                            <td>{{ $query['throat_cul']->bacter_specimenf4 }}</td>
                            <td>{{ $query['throat_cul']->bacter_specimenf5 }}</td>
                            <td>{{ $query['throat_cul']->bacter_specimenf6 }}</td>
                            <td>{{ $query['throat_cul']->bacter_specimenf7 }}</td>
                            <td>{{ $query['throat_cul']->bacter_specimenf8 }}</td>
                            <td>{{ $query['throat_cul']->bacter_specimenf9 }}</td>
                            <td>{{ $query['throat_cul']->bacter_specimenf10 }}</td>
                            <td>{{ $query['throat_cul']->bacter_specimenf11 }}</td>
                            <td>{{ $query['throat_cul']->bacter_specimenf12 }}</td>
                            <td>{{ $query['throat_cul']->bacter_specimen }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>Aspirate (culture)</td>
                            <td>{{ $query['aspirate']->bacter_specimenm1 }}</td>
                            <td>{{ $query['aspirate']->bacter_specimenm2 }}</td>
                            <td>{{ $query['aspirate']->bacter_specimenm3 }}</td>
                            <td>{{ $query['aspirate']->bacter_specimenm4 }}</td>
                            <td>{{ $query['aspirate']->bacter_specimenm5 }}</td>
                            <td>{{ $query['aspirate']->bacter_specimenm6 }}</td>
                            <td>{{ $query['aspirate']->bacter_specimenm7 }}</td>
                            <td>{{ $query['aspirate']->bacter_specimenm8 }}</td>
                            <td>{{ $query['aspirate']->bacter_specimenm9 }}</td>
                            <td>{{ $query['aspirate']->bacter_specimenm10 }}</td>
                            <td>{{ $query['aspirate']->bacter_specimenm11 }}</td>
                            <td>{{ $query['aspirate']->bacter_specimenm12 }}</td>
                            <td>{{ $query['aspirate']->bacter_specimenf1 }}</td>
                            <td>{{ $query['aspirate']->bacter_specimenf2 }}</td>
                            <td>{{ $query['aspirate']->bacter_specimenf3 }}</td>
                            <td>{{ $query['aspirate']->bacter_specimenf4 }}</td>
                            <td>{{ $query['aspirate']->bacter_specimenf5 }}</td>
                            <td>{{ $query['aspirate']->bacter_specimenf6 }}</td>
                            <td>{{ $query['aspirate']->bacter_specimenf7 }}</td>
                            <td>{{ $query['aspirate']->bacter_specimenf8 }}</td>
                            <td>{{ $query['aspirate']->bacter_specimenf9 }}</td>
                            <td>{{ $query['aspirate']->bacter_specimenf10 }}</td>
                            <td>{{ $query['aspirate']->bacter_specimenf11 }}</td>
                            <td>{{ $query['aspirate']->bacter_specimenf12 }}</td>
                            <td>{{ $query['aspirate']->bacter_specimen }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>Synovial Fluid (culture)</td>
                            <td>{{ $query['synovial']->bacter_specimenm1 }}</td>
                            <td>{{ $query['synovial']->bacter_specimenm2 }}</td>
                            <td>{{ $query['synovial']->bacter_specimenm3 }}</td>
                            <td>{{ $query['synovial']->bacter_specimenm4 }}</td>
                            <td>{{ $query['synovial']->bacter_specimenm5 }}</td>
                            <td>{{ $query['synovial']->bacter_specimenm6 }}</td>
                            <td>{{ $query['synovial']->bacter_specimenm7 }}</td>
                            <td>{{ $query['synovial']->bacter_specimenm8 }}</td>
                            <td>{{ $query['synovial']->bacter_specimenm9 }}</td>
                            <td>{{ $query['synovial']->bacter_specimenm10 }}</td>
                            <td>{{ $query['synovial']->bacter_specimenm11 }}</td>
                            <td>{{ $query['synovial']->bacter_specimenm12 }}</td>
                            <td>{{ $query['synovial']->bacter_specimenf1 }}</td>
                            <td>{{ $query['synovial']->bacter_specimenf2 }}</td>
                            <td>{{ $query['synovial']->bacter_specimenf3 }}</td>
                            <td>{{ $query['synovial']->bacter_specimenf4 }}</td>
                            <td>{{ $query['synovial']->bacter_specimenf5 }}</td>
                            <td>{{ $query['synovial']->bacter_specimenf6 }}</td>
                            <td>{{ $query['synovial']->bacter_specimenf7 }}</td>
                            <td>{{ $query['synovial']->bacter_specimenf8 }}</td>
                            <td>{{ $query['synovial']->bacter_specimenf9 }}</td>
                            <td>{{ $query['synovial']->bacter_specimenf10 }}</td>
                            <td>{{ $query['synovial']->bacter_specimenf11 }}</td>
                            <td>{{ $query['synovial']->bacter_specimenf12 }}</td>
                            <td>{{ $query['synovial']->bacter_specimen }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>Breast Abscess</td>
                            <td>{{ $query['breast']->bacter_specimenm1 }}</td>
                            <td>{{ $query['breast']->bacter_specimenm2 }}</td>
                            <td>{{ $query['breast']->bacter_specimenm3 }}</td>
                            <td>{{ $query['breast']->bacter_specimenm4 }}</td>
                            <td>{{ $query['breast']->bacter_specimenm5 }}</td>
                            <td>{{ $query['breast']->bacter_specimenm6 }}</td>
                            <td>{{ $query['breast']->bacter_specimenm7 }}</td>
                            <td>{{ $query['breast']->bacter_specimenm8 }}</td>
                            <td>{{ $query['breast']->bacter_specimenm9 }}</td>
                            <td>{{ $query['breast']->bacter_specimenm10 }}</td>
                            <td>{{ $query['breast']->bacter_specimenm11 }}</td>
                            <td>{{ $query['breast']->bacter_specimenm12 }}</td>
                            <td>{{ $query['breast']->bacter_specimenf1 }}</td>
                            <td>{{ $query['breast']->bacter_specimenf2 }}</td>
                            <td>{{ $query['breast']->bacter_specimenf3 }}</td>
                            <td>{{ $query['breast']->bacter_specimenf4 }}</td>
                            <td>{{ $query['breast']->bacter_specimenf5 }}</td>
                            <td>{{ $query['breast']->bacter_specimenf6 }}</td>
                            <td>{{ $query['breast']->bacter_specimenf7 }}</td>
                            <td>{{ $query['breast']->bacter_specimenf8 }}</td>
                            <td>{{ $query['breast']->bacter_specimenf9 }}</td>
                            <td>{{ $query['breast']->bacter_specimenf10 }}</td>
                            <td>{{ $query['breast']->bacter_specimenf11 }}</td>
                            <td>{{ $query['breast']->bacter_specimenf12 }}</td>
                            <td>{{ $query['breast']->bacter_specimen }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>Semen (Culture)</td>
                            <td>{{ $query['semen_cul']->bacter_specimenm1 }}</td>
                            <td>{{ $query['semen_cul']->bacter_specimenm2 }}</td>
                            <td>{{ $query['semen_cul']->bacter_specimenm3 }}</td>
                            <td>{{ $query['semen_cul']->bacter_specimenm4 }}</td>
                            <td>{{ $query['semen_cul']->bacter_specimenm5 }}</td>
                            <td>{{ $query['semen_cul']->bacter_specimenm6 }}</td>
                            <td>{{ $query['semen_cul']->bacter_specimenm7 }}</td>
                            <td>{{ $query['semen_cul']->bacter_specimenm8 }}</td>
                            <td>{{ $query['semen_cul']->bacter_specimenm9 }}</td>
                            <td>{{ $query['semen_cul']->bacter_specimenm10 }}</td>
                            <td>{{ $query['semen_cul']->bacter_specimenm11 }}</td>
                            <td>{{ $query['semen_cul']->bacter_specimenm12 }}</td>
                            <td>{{ $query['semen_cul']->bacter_specimenf1 }}</td>
                            <td>{{ $query['semen_cul']->bacter_specimenf2 }}</td>
                            <td>{{ $query['semen_cul']->bacter_specimenf3 }}</td>
                            <td>{{ $query['semen_cul']->bacter_specimenf4 }}</td>
                            <td>{{ $query['semen_cul']->bacter_specimenf5 }}</td>
                            <td>{{ $query['semen_cul']->bacter_specimenf6 }}</td>
                            <td>{{ $query['semen_cul']->bacter_specimenf7 }}</td>
                            <td>{{ $query['semen_cul']->bacter_specimenf8 }}</td>
                            <td>{{ $query['semen_cul']->bacter_specimenf9 }}</td>
                            <td>{{ $query['semen_cul']->bacter_specimenf10 }}</td>
                            <td>{{ $query['semen_cul']->bacter_specimenf11 }}</td>
                            <td>{{ $query['semen_cul']->bacter_specimenf12 }}</td>
                            <td>{{ $query['semen_cul']->bacter_specimen }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>Hand Abscess</td>
                            <td>{{ $query['hand']->bacter_specimenm1 }}</td>
                            <td>{{ $query['hand']->bacter_specimenm2 }}</td>
                            <td>{{ $query['hand']->bacter_specimenm3 }}</td>
                            <td>{{ $query['hand']->bacter_specimenm4 }}</td>
                            <td>{{ $query['hand']->bacter_specimenm5 }}</td>
                            <td>{{ $query['hand']->bacter_specimenm6 }}</td>
                            <td>{{ $query['hand']->bacter_specimenm7 }}</td>
                            <td>{{ $query['hand']->bacter_specimenm8 }}</td>
                            <td>{{ $query['hand']->bacter_specimenm9 }}</td>
                            <td>{{ $query['hand']->bacter_specimenm10 }}</td>
                            <td>{{ $query['hand']->bacter_specimenm11 }}</td>
                            <td>{{ $query['hand']->bacter_specimenm12 }}</td>
                            <td>{{ $query['hand']->bacter_specimenf1 }}</td>
                            <td>{{ $query['hand']->bacter_specimenf2 }}</td>
                            <td>{{ $query['hand']->bacter_specimenf3 }}</td>
                            <td>{{ $query['hand']->bacter_specimenf4 }}</td>
                            <td>{{ $query['hand']->bacter_specimenf5 }}</td>
                            <td>{{ $query['hand']->bacter_specimenf6 }}</td>
                            <td>{{ $query['hand']->bacter_specimenf7 }}</td>
                            <td>{{ $query['hand']->bacter_specimenf8 }}</td>
                            <td>{{ $query['hand']->bacter_specimenf9 }}</td>
                            <td>{{ $query['hand']->bacter_specimenf10 }}</td>
                            <td>{{ $query['hand']->bacter_specimenf11 }}</td>
                            <td>{{ $query['hand']->bacter_specimenf12 }}</td>
                            <td>{{ $query['hand']->bacter_specimen }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>Pleural Fluid (culture)</td>
                            <td>{{ $query['pleural_appear']->pleural_appearm1 }}</td>
                            <td>{{ $query['pleural_appear']->pleural_appearm2 }}</td>
                            <td>{{ $query['pleural_appear']->pleural_appearm3 }}</td>
                            <td>{{ $query['pleural_appear']->pleural_appearm4 }}</td>
                            <td>{{ $query['pleural_appear']->pleural_appearm5 }}</td>
                            <td>{{ $query['pleural_appear']->pleural_appearm6 }}</td>
                            <td>{{ $query['pleural_appear']->pleural_appearm7 }}</td>
                            <td>{{ $query['pleural_appear']->pleural_appearm8 }}</td>
                            <td>{{ $query['pleural_appear']->pleural_appearm9 }}</td>
                            <td>{{ $query['pleural_appear']->pleural_appearm10 }}</td>
                            <td>{{ $query['pleural_appear']->pleural_appearm11 }}</td>
                            <td>{{ $query['pleural_appear']->pleural_appearm12 }}</td>
                            <td>{{ $query['pleural_appear']->pleural_appearf1 }}</td>
                            <td>{{ $query['pleural_appear']->pleural_appearf2 }}</td>
                            <td>{{ $query['pleural_appear']->pleural_appearf3 }}</td>
                            <td>{{ $query['pleural_appear']->pleural_appearf4 }}</td>
                            <td>{{ $query['pleural_appear']->pleural_appearf5 }}</td>
                            <td>{{ $query['pleural_appear']->pleural_appearf6 }}</td>
                            <td>{{ $query['pleural_appear']->pleural_appearf7 }}</td>
                            <td>{{ $query['pleural_appear']->pleural_appearf8 }}</td>
                            <td>{{ $query['pleural_appear']->pleural_appearf9 }}</td>
                            <td>{{ $query['pleural_appear']->pleural_appearf10 }}</td>
                            <td>{{ $query['pleural_appear']->pleural_appearf11 }}</td>
                            <td>{{ $query['pleural_appear']->pleural_appearf12 }}</td>
                            <td>{{ $query['pleural_appear']->pleural_appear }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>Peripheral Film Comment</td>
                            <td>{{ $query['per_rbc']->per_rbcm1 }}</td>
                            <td>{{ $query['per_rbc']->per_rbcm2 }}</td>
                            <td>{{ $query['per_rbc']->per_rbcm3 }}</td>
                            <td>{{ $query['per_rbc']->per_rbcm4 }}</td>
                            <td>{{ $query['per_rbc']->per_rbcm5 }}</td>
                            <td>{{ $query['per_rbc']->per_rbcm6 }}</td>
                            <td>{{ $query['per_rbc']->per_rbcm7 }}</td>
                            <td>{{ $query['per_rbc']->per_rbcm8 }}</td>
                            <td>{{ $query['per_rbc']->per_rbcm9 }}</td>
                            <td>{{ $query['per_rbc']->per_rbcm10 }}</td>
                            <td>{{ $query['per_rbc']->per_rbcm11 }}</td>
                            <td>{{ $query['per_rbc']->per_rbcm12 }}</td>
                            <td>{{ $query['per_rbc']->per_rbcf1 }}</td>
                            <td>{{ $query['per_rbc']->per_rbcf2 }}</td>
                            <td>{{ $query['per_rbc']->per_rbcf3 }}</td>
                            <td>{{ $query['per_rbc']->per_rbcf4 }}</td>
                            <td>{{ $query['per_rbc']->per_rbcf5 }}</td>
                            <td>{{ $query['per_rbc']->per_rbcf6 }}</td>
                            <td>{{ $query['per_rbc']->per_rbcf7 }}</td>
                            <td>{{ $query['per_rbc']->per_rbcf8 }}</td>
                            <td>{{ $query['per_rbc']->per_rbcf9 }}</td>
                            <td>{{ $query['per_rbc']->per_rbcf10 }}</td>
                            <td>{{ $query['per_rbc']->per_rbcf11 }}</td>
                            <td>{{ $query['per_rbc']->per_rbcf12 }}</td>
                            <td>{{ $query['per_rbc']->per_rbc }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>Semen Analysis</td>
                            <td>{{ $query['semen_date']->semen_datem1 }}</td>
                            <td>{{ $query['semen_date']->semen_datem2 }}</td>
                            <td>{{ $query['semen_date']->semen_datem3 }}</td>
                            <td>{{ $query['semen_date']->semen_datem4 }}</td>
                            <td>{{ $query['semen_date']->semen_datem5 }}</td>
                            <td>{{ $query['semen_date']->semen_datem6 }}</td>
                            <td>{{ $query['semen_date']->semen_datem7 }}</td>
                            <td>{{ $query['semen_date']->semen_datem8 }}</td>
                            <td>{{ $query['semen_date']->semen_datem9 }}</td>
                            <td>{{ $query['semen_date']->semen_datem10 }}</td>
                            <td>{{ $query['semen_date']->semen_datem11 }}</td>
                            <td>{{ $query['semen_date']->semen_datem12 }}</td>
                            <td>{{ $query['semen_date']->semen_datef1 }}</td>
                            <td>{{ $query['semen_date']->semen_datef2 }}</td>
                            <td>{{ $query['semen_date']->semen_datef3 }}</td>
                            <td>{{ $query['semen_date']->semen_datef4 }}</td>
                            <td>{{ $query['semen_date']->semen_datef5 }}</td>
                            <td>{{ $query['semen_date']->semen_datef6 }}</td>
                            <td>{{ $query['semen_date']->semen_datef7 }}</td>
                            <td>{{ $query['semen_date']->semen_datef8 }}</td>
                            <td>{{ $query['semen_date']->semen_datef9 }}</td>
                            <td>{{ $query['semen_date']->semen_datef10 }}</td>
                            <td>{{ $query['semen_date']->semen_datef11 }}</td>
                            <td>{{ $query['semen_date']->semen_datef12 }}</td>
                            <td>{{ $query['semen_date']->semen_date }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>OGTT</td>
                            <td>{{ $query['oral_glucose']->oral_glucosem1 }}</td>
                            <td>{{ $query['oral_glucose']->oral_glucosem2 }}</td>
                            <td>{{ $query['oral_glucose']->oral_glucosem3 }}</td>
                            <td>{{ $query['oral_glucose']->oral_glucosem4 }}</td>
                            <td>{{ $query['oral_glucose']->oral_glucosem5 }}</td>
                            <td>{{ $query['oral_glucose']->oral_glucosem6 }}</td>
                            <td>{{ $query['oral_glucose']->oral_glucosem7 }}</td>
                            <td>{{ $query['oral_glucose']->oral_glucosem8 }}</td>
                            <td>{{ $query['oral_glucose']->oral_glucosem9 }}</td>
                            <td>{{ $query['oral_glucose']->oral_glucosem10 }}</td>
                            <td>{{ $query['oral_glucose']->oral_glucosem11 }}</td>
                            <td>{{ $query['oral_glucose']->oral_glucosem12 }}</td>
                            <td>{{ $query['oral_glucose']->oral_glucosef1 }}</td>
                            <td>{{ $query['oral_glucose']->oral_glucosef2 }}</td>
                            <td>{{ $query['oral_glucose']->oral_glucosef3 }}</td>
                            <td>{{ $query['oral_glucose']->oral_glucosef4 }}</td>
                            <td>{{ $query['oral_glucose']->oral_glucosef5 }}</td>
                            <td>{{ $query['oral_glucose']->oral_glucosef6 }}</td>
                            <td>{{ $query['oral_glucose']->oral_glucosef7 }}</td>
                            <td>{{ $query['oral_glucose']->oral_glucosef8 }}</td>
                            <td>{{ $query['oral_glucose']->oral_glucosef9 }}</td>
                            <td>{{ $query['oral_glucose']->oral_glucosef10 }}</td>
                            <td>{{ $query['oral_glucose']->oral_glucosef11 }}</td>
                            <td>{{ $query['oral_glucose']->oral_glucosef12 }}</td>
                            <td>{{ $query['oral_glucose']->oral_glucose }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>PSA</td>
                            <td>{{ $query['psa']->psam1 }}</td>
                            <td>{{ $query['psa']->psam2 }}</td>
                            <td>{{ $query['psa']->psam3 }}</td>
                            <td>{{ $query['psa']->psam4 }}</td>
                            <td>{{ $query['psa']->psam5 }}</td>
                            <td>{{ $query['psa']->psam6 }}</td>
                            <td>{{ $query['psa']->psam7 }}</td>
                            <td>{{ $query['psa']->psam8 }}</td>
                            <td>{{ $query['psa']->psam9 }}</td>
                            <td>{{ $query['psa']->psam10 }}</td>
                            <td>{{ $query['psa']->psam11 }}</td>
                            <td>{{ $query['psa']->psam12 }}</td>
                            <td>{{ $query['psa']->psaf1 }}</td>
                            <td>{{ $query['psa']->psaf2 }}</td>
                            <td>{{ $query['psa']->psaf3 }}</td>
                            <td>{{ $query['psa']->psaf4 }}</td>
                            <td>{{ $query['psa']->psaf5 }}</td>
                            <td>{{ $query['psa']->psaf6 }}</td>
                            <td>{{ $query['psa']->psaf7 }}</td>
                            <td>{{ $query['psa']->psaf8 }}</td>
                            <td>{{ $query['psa']->psaf9 }}</td>
                            <td>{{ $query['psa']->psaf10 }}</td>
                            <td>{{ $query['psa']->psaf11 }}</td>
                            <td>{{ $query['psa']->psaf12 }}</td>
                            <td>{{ $query['psa']->psa }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>H-pylori Qualitative</td>
                            <td>{{ $query['pylori_qual']->pylori_qualm1 }}</td>
                            <td>{{ $query['pylori_qual']->pylori_qualm2 }}</td>
                            <td>{{ $query['pylori_qual']->pylori_qualm3 }}</td>
                            <td>{{ $query['pylori_qual']->pylori_qualm4 }}</td>
                            <td>{{ $query['pylori_qual']->pylori_qualm5 }}</td>
                            <td>{{ $query['pylori_qual']->pylori_qualm6 }}</td>
                            <td>{{ $query['pylori_qual']->pylori_qualm7 }}</td>
                            <td>{{ $query['pylori_qual']->pylori_qualm8 }}</td>
                            <td>{{ $query['pylori_qual']->pylori_qualm9 }}</td>
                            <td>{{ $query['pylori_qual']->pylori_qualm10 }}</td>
                            <td>{{ $query['pylori_qual']->pylori_qualm11 }}</td>
                            <td>{{ $query['pylori_qual']->pylori_qualm12 }}</td>
                            <td>{{ $query['pylori_qual']->pylori_qualf1 }}</td>
                            <td>{{ $query['pylori_qual']->pylori_qualf2 }}</td>
                            <td>{{ $query['pylori_qual']->pylori_qualf3 }}</td>
                            <td>{{ $query['pylori_qual']->pylori_qualf4 }}</td>
                            <td>{{ $query['pylori_qual']->pylori_qualf5 }}</td>
                            <td>{{ $query['pylori_qual']->pylori_qualf6 }}</td>
                            <td>{{ $query['pylori_qual']->pylori_qualf7 }}</td>
                            <td>{{ $query['pylori_qual']->pylori_qualf8 }}</td>
                            <td>{{ $query['pylori_qual']->pylori_qualf9 }}</td>
                            <td>{{ $query['pylori_qual']->pylori_qualf10 }}</td>
                            <td>{{ $query['pylori_qual']->pylori_qualf11 }}</td>
                            <td>{{ $query['pylori_qual']->pylori_qualf12 }}</td>
                            <td>{{ $query['pylori_qual']->pylori_qual }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>Peritoneal Fluid</td>
                            <td>{{ $query['peritoneal_appear']->peritoneal_appearm1 }}</td>
                            <td>{{ $query['peritoneal_appear']->peritoneal_appearm2 }}</td>
                            <td>{{ $query['peritoneal_appear']->peritoneal_appearm3 }}</td>
                            <td>{{ $query['peritoneal_appear']->peritoneal_appearm4 }}</td>
                            <td>{{ $query['peritoneal_appear']->peritoneal_appearm5 }}</td>
                            <td>{{ $query['peritoneal_appear']->peritoneal_appearm6 }}</td>
                            <td>{{ $query['peritoneal_appear']->peritoneal_appearm7 }}</td>
                            <td>{{ $query['peritoneal_appear']->peritoneal_appearm8 }}</td>
                            <td>{{ $query['peritoneal_appear']->peritoneal_appearm9 }}</td>
                            <td>{{ $query['peritoneal_appear']->peritoneal_appearm10 }}</td>
                            <td>{{ $query['peritoneal_appear']->peritoneal_appearm11 }}</td>
                            <td>{{ $query['peritoneal_appear']->peritoneal_appearm12 }}</td>
                            <td>{{ $query['peritoneal_appear']->peritoneal_appearf1 }}</td>
                            <td>{{ $query['peritoneal_appear']->peritoneal_appearf2 }}</td>
                            <td>{{ $query['peritoneal_appear']->peritoneal_appearf3 }}</td>
                            <td>{{ $query['peritoneal_appear']->peritoneal_appearf4 }}</td>
                            <td>{{ $query['peritoneal_appear']->peritoneal_appearf5 }}</td>
                            <td>{{ $query['peritoneal_appear']->peritoneal_appearf6 }}</td>
                            <td>{{ $query['peritoneal_appear']->peritoneal_appearf7 }}</td>
                            <td>{{ $query['peritoneal_appear']->peritoneal_appearf8 }}</td>
                            <td>{{ $query['peritoneal_appear']->peritoneal_appearf9 }}</td>
                            <td>{{ $query['peritoneal_appear']->peritoneal_appearf10 }}</td>
                            <td>{{ $query['peritoneal_appear']->peritoneal_appearf11 }}</td>
                            <td>{{ $query['peritoneal_appear']->peritoneal_appearf12 }}</td>
                            <td>{{ $query['peritoneal_appear']->peritoneal_appear }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>Hepatitis B Profile</td>
                            <td>{{ $query['hb_sag']->hb_sagm1 }}</td>
                            <td>{{ $query['hb_sag']->hb_sagm2 }}</td>
                            <td>{{ $query['hb_sag']->hb_sagm3 }}</td>
                            <td>{{ $query['hb_sag']->hb_sagm4 }}</td>
                            <td>{{ $query['hb_sag']->hb_sagm5 }}</td>
                            <td>{{ $query['hb_sag']->hb_sagm6 }}</td>
                            <td>{{ $query['hb_sag']->hb_sagm7 }}</td>
                            <td>{{ $query['hb_sag']->hb_sagm8 }}</td>
                            <td>{{ $query['hb_sag']->hb_sagm9 }}</td>
                            <td>{{ $query['hb_sag']->hb_sagm10 }}</td>
                            <td>{{ $query['hb_sag']->hb_sagm11 }}</td>
                            <td>{{ $query['hb_sag']->hb_sagm12 }}</td>
                            <td>{{ $query['hb_sag']->hb_sagf1 }}</td>
                            <td>{{ $query['hb_sag']->hb_sagf2 }}</td>
                            <td>{{ $query['hb_sag']->hb_sagf3 }}</td>
                            <td>{{ $query['hb_sag']->hb_sagf4 }}</td>
                            <td>{{ $query['hb_sag']->hb_sagf5 }}</td>
                            <td>{{ $query['hb_sag']->hb_sagf6 }}</td>
                            <td>{{ $query['hb_sag']->hb_sagf7 }}</td>
                            <td>{{ $query['hb_sag']->hb_sagf8 }}</td>
                            <td>{{ $query['hb_sag']->hb_sagf9 }}</td>
                            <td>{{ $query['hb_sag']->hb_sagf10 }}</td>
                            <td>{{ $query['hb_sag']->hb_sagf11 }}</td>
                            <td>{{ $query['hb_sag']->hb_sagf12 }}</td>
                            <td>{{ $query['hb_sag']->hb_sag }}</td>
                        </tr>
                    </tbody>
                @endif
                @if ($dt == 'Haematology')
                    <tbody>
                        <tr>
                            <td style="text-align: left" nowrap>ANTI TPHA/VDRL</td>
                            <td>{{ $query['anti_tpha']->anti_tpham1 }}</td>
                            <td>{{ $query['anti_tpha']->anti_tpham2 }}</td>
                            <td>{{ $query['anti_tpha']->anti_tpham3 }}</td>
                            <td>{{ $query['anti_tpha']->anti_tpham4 }}</td>
                            <td>{{ $query['anti_tpha']->anti_tpham5 }}</td>
                            <td>{{ $query['anti_tpha']->anti_tpham6 }}</td>
                            <td>{{ $query['anti_tpha']->anti_tpham7 }}</td>
                            <td>{{ $query['anti_tpha']->anti_tpham8 }}</td>
                            <td>{{ $query['anti_tpha']->anti_tpham9 }}</td>
                            <td>{{ $query['anti_tpha']->anti_tpham10 }}</td>
                            <td>{{ $query['anti_tpha']->anti_tpham11 }}</td>
                            <td>{{ $query['anti_tpha']->anti_tpham12 }}</td>
                            <td>{{ $query['anti_tpha']->anti_tphaf1 }}</td>
                            <td>{{ $query['anti_tpha']->anti_tphaf2 }}</td>
                            <td>{{ $query['anti_tpha']->anti_tphaf3 }}</td>
                            <td>{{ $query['anti_tpha']->anti_tphaf4 }}</td>
                            <td>{{ $query['anti_tpha']->anti_tphaf5 }}</td>
                            <td>{{ $query['anti_tpha']->anti_tphaf6 }}</td>
                            <td>{{ $query['anti_tpha']->anti_tphaf7 }}</td>
                            <td>{{ $query['anti_tpha']->anti_tphaf8 }}</td>
                            <td>{{ $query['anti_tpha']->anti_tphaf9 }}</td>
                            <td>{{ $query['anti_tpha']->anti_tphaf10 }}</td>
                            <td>{{ $query['anti_tpha']->anti_tphaf11 }}</td>
                            <td>{{ $query['anti_tpha']->anti_tphaf12 }}</td>
                            <td>{{ $query['anti_tpha']->anti_tpha }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>ANTI TPHA/VDRL (Positive)</td>
                            <td>{{ $query['anti_tpha_pos']->anti_tpham1 }}</td>
                            <td>{{ $query['anti_tpha_pos']->anti_tpham2 }}</td>
                            <td>{{ $query['anti_tpha_pos']->anti_tpham3 }}</td>
                            <td>{{ $query['anti_tpha_pos']->anti_tpham4 }}</td>
                            <td>{{ $query['anti_tpha_pos']->anti_tpham5 }}</td>
                            <td>{{ $query['anti_tpha_pos']->anti_tpham6 }}</td>
                            <td>{{ $query['anti_tpha_pos']->anti_tpham7 }}</td>
                            <td>{{ $query['anti_tpha_pos']->anti_tpham8 }}</td>
                            <td>{{ $query['anti_tpha_pos']->anti_tpham9 }}</td>
                            <td>{{ $query['anti_tpha_pos']->anti_tpham10 }}</td>
                            <td>{{ $query['anti_tpha_pos']->anti_tpham11 }}</td>
                            <td>{{ $query['anti_tpha_pos']->anti_tpham12 }}</td>
                            <td>{{ $query['anti_tpha_pos']->anti_tphaf1 }}</td>
                            <td>{{ $query['anti_tpha_pos']->anti_tphaf2 }}</td>
                            <td>{{ $query['anti_tpha_pos']->anti_tphaf3 }}</td>
                            <td>{{ $query['anti_tpha_pos']->anti_tphaf4 }}</td>
                            <td>{{ $query['anti_tpha_pos']->anti_tphaf5 }}</td>
                            <td>{{ $query['anti_tpha_pos']->anti_tphaf6 }}</td>
                            <td>{{ $query['anti_tpha_pos']->anti_tphaf7 }}</td>
                            <td>{{ $query['anti_tpha_pos']->anti_tphaf8 }}</td>
                            <td>{{ $query['anti_tpha_pos']->anti_tphaf9 }}</td>
                            <td>{{ $query['anti_tpha_pos']->anti_tphaf10 }}</td>
                            <td>{{ $query['anti_tpha_pos']->anti_tphaf11 }}</td>
                            <td>{{ $query['anti_tpha_pos']->anti_tphaf12 }}</td>
                            <td>{{ $query['anti_tpha_pos']->anti_tpha }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>HCV</td>
                            <td>{{ $query['hcv']->hcvm1 }}</td>
                            <td>{{ $query['hcv']->hcvm2 }}</td>
                            <td>{{ $query['hcv']->hcvm3 }}</td>
                            <td>{{ $query['hcv']->hcvm4 }}</td>
                            <td>{{ $query['hcv']->hcvm5 }}</td>
                            <td>{{ $query['hcv']->hcvm6 }}</td>
                            <td>{{ $query['hcv']->hcvm7 }}</td>
                            <td>{{ $query['hcv']->hcvm8 }}</td>
                            <td>{{ $query['hcv']->hcvm9 }}</td>
                            <td>{{ $query['hcv']->hcvm10 }}</td>
                            <td>{{ $query['hcv']->hcvm11 }}</td>
                            <td>{{ $query['hcv']->hcvm12 }}</td>
                            <td>{{ $query['hcv']->hcvf1 }}</td>
                            <td>{{ $query['hcv']->hcvf2 }}</td>
                            <td>{{ $query['hcv']->hcvf3 }}</td>
                            <td>{{ $query['hcv']->hcvf4 }}</td>
                            <td>{{ $query['hcv']->hcvf5 }}</td>
                            <td>{{ $query['hcv']->hcvf6 }}</td>
                            <td>{{ $query['hcv']->hcvf7 }}</td>
                            <td>{{ $query['hcv']->hcvf8 }}</td>
                            <td>{{ $query['hcv']->hcvf9 }}</td>
                            <td>{{ $query['hcv']->hcvf10 }}</td>
                            <td>{{ $query['hcv']->hcvf11 }}</td>
                            <td>{{ $query['hcv']->hcvf12 }}</td>
                            <td>{{ $query['hcv']->hcv }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>HCV (Positive)</td>
                            <td>{{ $query['hcv_pos']->hcvm1 }}</td>
                            <td>{{ $query['hcv_pos']->hcvm2 }}</td>
                            <td>{{ $query['hcv_pos']->hcvm3 }}</td>
                            <td>{{ $query['hcv_pos']->hcvm4 }}</td>
                            <td>{{ $query['hcv_pos']->hcvm5 }}</td>
                            <td>{{ $query['hcv_pos']->hcvm6 }}</td>
                            <td>{{ $query['hcv_pos']->hcvm7 }}</td>
                            <td>{{ $query['hcv_pos']->hcvm8 }}</td>
                            <td>{{ $query['hcv_pos']->hcvm9 }}</td>
                            <td>{{ $query['hcv_pos']->hcvm10 }}</td>
                            <td>{{ $query['hcv_pos']->hcvm11 }}</td>
                            <td>{{ $query['hcv_pos']->hcvm12 }}</td>
                            <td>{{ $query['hcv_pos']->hcvf1 }}</td>
                            <td>{{ $query['hcv_pos']->hcvf2 }}</td>
                            <td>{{ $query['hcv_pos']->hcvf3 }}</td>
                            <td>{{ $query['hcv_pos']->hcvf4 }}</td>
                            <td>{{ $query['hcv_pos']->hcvf5 }}</td>
                            <td>{{ $query['hcv_pos']->hcvf6 }}</td>
                            <td>{{ $query['hcv_pos']->hcvf7 }}</td>
                            <td>{{ $query['hcv_pos']->hcvf8 }}</td>
                            <td>{{ $query['hcv_pos']->hcvf9 }}</td>
                            <td>{{ $query['hcv_pos']->hcvf10 }}</td>
                            <td>{{ $query['hcv_pos']->hcvf11 }}</td>
                            <td>{{ $query['hcv_pos']->hcvf12 }}</td>
                            <td>{{ $query['hcv_pos']->hcv }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>HBsAg</td>
                            <td>{{ $query['hbsag']->hbsagm1 }}</td>
                            <td>{{ $query['hbsag']->hbsagm2 }}</td>
                            <td>{{ $query['hbsag']->hbsagm3 }}</td>
                            <td>{{ $query['hbsag']->hbsagm4 }}</td>
                            <td>{{ $query['hbsag']->hbsagm5 }}</td>
                            <td>{{ $query['hbsag']->hbsagm6 }}</td>
                            <td>{{ $query['hbsag']->hbsagm7 }}</td>
                            <td>{{ $query['hbsag']->hbsagm8 }}</td>
                            <td>{{ $query['hbsag']->hbsagm9 }}</td>
                            <td>{{ $query['hbsag']->hbsagm10 }}</td>
                            <td>{{ $query['hbsag']->hbsagm11 }}</td>
                            <td>{{ $query['hbsag']->hbsagm12 }}</td>
                            <td>{{ $query['hbsag']->hbsagf1 }}</td>
                            <td>{{ $query['hbsag']->hbsagf2 }}</td>
                            <td>{{ $query['hbsag']->hbsagf3 }}</td>
                            <td>{{ $query['hbsag']->hbsagf4 }}</td>
                            <td>{{ $query['hbsag']->hbsagf5 }}</td>
                            <td>{{ $query['hbsag']->hbsagf6 }}</td>
                            <td>{{ $query['hbsag']->hbsagf7 }}</td>
                            <td>{{ $query['hbsag']->hbsagf8 }}</td>
                            <td>{{ $query['hbsag']->hbsagf9 }}</td>
                            <td>{{ $query['hbsag']->hbsagf10 }}</td>
                            <td>{{ $query['hbsag']->hbsagf11 }}</td>
                            <td>{{ $query['hbsag']->hbsagf12 }}</td>
                            <td>{{ $query['hbsag']->hbsag }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>HBsAg (Positive)</td>
                            <td>{{ $query['hbsag_pos']->hbsagm1 }}</td>
                            <td>{{ $query['hbsag_pos']->hbsagm2 }}</td>
                            <td>{{ $query['hbsag_pos']->hbsagm3 }}</td>
                            <td>{{ $query['hbsag_pos']->hbsagm4 }}</td>
                            <td>{{ $query['hbsag_pos']->hbsagm5 }}</td>
                            <td>{{ $query['hbsag_pos']->hbsagm6 }}</td>
                            <td>{{ $query['hbsag_pos']->hbsagm7 }}</td>
                            <td>{{ $query['hbsag_pos']->hbsagm8 }}</td>
                            <td>{{ $query['hbsag_pos']->hbsagm9 }}</td>
                            <td>{{ $query['hbsag_pos']->hbsagm10 }}</td>
                            <td>{{ $query['hbsag_pos']->hbsagm11 }}</td>
                            <td>{{ $query['hbsag_pos']->hbsagm12 }}</td>
                            <td>{{ $query['hbsag_pos']->hbsagf1 }}</td>
                            <td>{{ $query['hbsag_pos']->hbsagf2 }}</td>
                            <td>{{ $query['hbsag_pos']->hbsagf3 }}</td>
                            <td>{{ $query['hbsag_pos']->hbsagf4 }}</td>
                            <td>{{ $query['hbsag_pos']->hbsagf5 }}</td>
                            <td>{{ $query['hbsag_pos']->hbsagf6 }}</td>
                            <td>{{ $query['hbsag_pos']->hbsagf7 }}</td>
                            <td>{{ $query['hbsag_pos']->hbsagf8 }}</td>
                            <td>{{ $query['hbsag_pos']->hbsagf9 }}</td>
                            <td>{{ $query['hbsag_pos']->hbsagf10 }}</td>
                            <td>{{ $query['hbsag_pos']->hbsagf11 }}</td>
                            <td>{{ $query['hbsag_pos']->hbsagf12 }}</td>
                            <td>{{ $query['hbsag_pos']->hbsag }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>FBS/RBS</td>
                            <td>{{ $query['fbs']->fbsm1 }}</td>
                            <td>{{ $query['fbs']->fbsm2 }}</td>
                            <td>{{ $query['fbs']->fbsm3 }}</td>
                            <td>{{ $query['fbs']->fbsm4 }}</td>
                            <td>{{ $query['fbs']->fbsm5 }}</td>
                            <td>{{ $query['fbs']->fbsm6 }}</td>
                            <td>{{ $query['fbs']->fbsm7 }}</td>
                            <td>{{ $query['fbs']->fbsm8 }}</td>
                            <td>{{ $query['fbs']->fbsm9 }}</td>
                            <td>{{ $query['fbs']->fbsm10 }}</td>
                            <td>{{ $query['fbs']->fbsm11 }}</td>
                            <td>{{ $query['fbs']->fbsm12 }}</td>
                            <td>{{ $query['fbs']->fbsf1 }}</td>
                            <td>{{ $query['fbs']->fbsf2 }}</td>
                            <td>{{ $query['fbs']->fbsf3 }}</td>
                            <td>{{ $query['fbs']->fbsf4 }}</td>
                            <td>{{ $query['fbs']->fbsf5 }}</td>
                            <td>{{ $query['fbs']->fbsf6 }}</td>
                            <td>{{ $query['fbs']->fbsf7 }}</td>
                            <td>{{ $query['fbs']->fbsf8 }}</td>
                            <td>{{ $query['fbs']->fbsf9 }}</td>
                            <td>{{ $query['fbs']->fbsf10 }}</td>
                            <td>{{ $query['fbs']->fbsf11 }}</td>
                            <td>{{ $query['fbs']->fbsf12 }}</td>
                            <td>{{ $query['fbs']->fbs }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>BLOOD GROUP</td>
                            <td>{{ $query['blood']->bloodm1 }}</td>
                            <td>{{ $query['blood']->bloodm2 }}</td>
                            <td>{{ $query['blood']->bloodm3 }}</td>
                            <td>{{ $query['blood']->bloodm4 }}</td>
                            <td>{{ $query['blood']->bloodm5 }}</td>
                            <td>{{ $query['blood']->bloodm6 }}</td>
                            <td>{{ $query['blood']->bloodm7 }}</td>
                            <td>{{ $query['blood']->bloodm8 }}</td>
                            <td>{{ $query['blood']->bloodm9 }}</td>
                            <td>{{ $query['blood']->bloodm10 }}</td>
                            <td>{{ $query['blood']->bloodm11 }}</td>
                            <td>{{ $query['blood']->bloodm12 }}</td>
                            <td>{{ $query['blood']->bloodf1 }}</td>
                            <td>{{ $query['blood']->bloodf2 }}</td>
                            <td>{{ $query['blood']->bloodf3 }}</td>
                            <td>{{ $query['blood']->bloodf4 }}</td>
                            <td>{{ $query['blood']->bloodf5 }}</td>
                            <td>{{ $query['blood']->bloodf6 }}</td>
                            <td>{{ $query['blood']->bloodf7 }}</td>
                            <td>{{ $query['blood']->bloodf8 }}</td>
                            <td>{{ $query['blood']->bloodf9 }}</td>
                            <td>{{ $query['blood']->bloodf10 }}</td>
                            <td>{{ $query['blood']->bloodf11 }}</td>
                            <td>{{ $query['blood']->bloodf12 }}</td>
                            <td>{{ $query['blood']->blood }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>G6PD (Normal Enzyme Activity)</td>
                            <td>{{ $query['g6pd_nor']->g6pdm1 }}</td>
                            <td>{{ $query['g6pd_nor']->g6pdm2 }}</td>
                            <td>{{ $query['g6pd_nor']->g6pdm3 }}</td>
                            <td>{{ $query['g6pd_nor']->g6pdm4 }}</td>
                            <td>{{ $query['g6pd_nor']->g6pdm5 }}</td>
                            <td>{{ $query['g6pd_nor']->g6pdm6 }}</td>
                            <td>{{ $query['g6pd_nor']->g6pdm7 }}</td>
                            <td>{{ $query['g6pd_nor']->g6pdm8 }}</td>
                            <td>{{ $query['g6pd_nor']->g6pdm9 }}</td>
                            <td>{{ $query['g6pd_nor']->g6pdm10 }}</td>
                            <td>{{ $query['g6pd_nor']->g6pdm11 }}</td>
                            <td>{{ $query['g6pd_nor']->g6pdm12 }}</td>
                            <td>{{ $query['g6pd_nor']->g6pdf1 }}</td>
                            <td>{{ $query['g6pd_nor']->g6pdf2 }}</td>
                            <td>{{ $query['g6pd_nor']->g6pdf3 }}</td>
                            <td>{{ $query['g6pd_nor']->g6pdf4 }}</td>
                            <td>{{ $query['g6pd_nor']->g6pdf5 }}</td>
                            <td>{{ $query['g6pd_nor']->g6pdf6 }}</td>
                            <td>{{ $query['g6pd_nor']->g6pdf7 }}</td>
                            <td>{{ $query['g6pd_nor']->g6pdf8 }}</td>
                            <td>{{ $query['g6pd_nor']->g6pdf9 }}</td>
                            <td>{{ $query['g6pd_nor']->g6pdf10 }}</td>
                            <td>{{ $query['g6pd_nor']->g6pdf11 }}</td>
                            <td>{{ $query['g6pd_nor']->g6pdf12 }}</td>
                            <td>{{ $query['g6pd_nor']->g6pd }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>G6PD (Partial Defect)</td>
                            <td>{{ $query['g6pd_par']->g6pdm1 }}</td>
                            <td>{{ $query['g6pd_par']->g6pdm2 }}</td>
                            <td>{{ $query['g6pd_par']->g6pdm3 }}</td>
                            <td>{{ $query['g6pd_par']->g6pdm4 }}</td>
                            <td>{{ $query['g6pd_par']->g6pdm5 }}</td>
                            <td>{{ $query['g6pd_par']->g6pdm6 }}</td>
                            <td>{{ $query['g6pd_par']->g6pdm7 }}</td>
                            <td>{{ $query['g6pd_par']->g6pdm8 }}</td>
                            <td>{{ $query['g6pd_par']->g6pdm9 }}</td>
                            <td>{{ $query['g6pd_par']->g6pdm10 }}</td>
                            <td>{{ $query['g6pd_par']->g6pdm11 }}</td>
                            <td>{{ $query['g6pd_par']->g6pdm12 }}</td>
                            <td>{{ $query['g6pd_par']->g6pdf1 }}</td>
                            <td>{{ $query['g6pd_par']->g6pdf2 }}</td>
                            <td>{{ $query['g6pd_par']->g6pdf3 }}</td>
                            <td>{{ $query['g6pd_par']->g6pdf4 }}</td>
                            <td>{{ $query['g6pd_par']->g6pdf5 }}</td>
                            <td>{{ $query['g6pd_par']->g6pdf6 }}</td>
                            <td>{{ $query['g6pd_par']->g6pdf7 }}</td>
                            <td>{{ $query['g6pd_par']->g6pdf8 }}</td>
                            <td>{{ $query['g6pd_par']->g6pdf9 }}</td>
                            <td>{{ $query['g6pd_par']->g6pdf10 }}</td>
                            <td>{{ $query['g6pd_par']->g6pdf11 }}</td>
                            <td>{{ $query['g6pd_par']->g6pdf12 }}</td>
                            <td>{{ $query['g6pd_par']->g6pd }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>G6PD (Full Defect)</td>
                            <td>{{ $query['g6pd_ful']->g6pdm1 }}</td>
                            <td>{{ $query['g6pd_ful']->g6pdm2 }}</td>
                            <td>{{ $query['g6pd_ful']->g6pdm3 }}</td>
                            <td>{{ $query['g6pd_ful']->g6pdm4 }}</td>
                            <td>{{ $query['g6pd_ful']->g6pdm5 }}</td>
                            <td>{{ $query['g6pd_ful']->g6pdm6 }}</td>
                            <td>{{ $query['g6pd_ful']->g6pdm7 }}</td>
                            <td>{{ $query['g6pd_ful']->g6pdm8 }}</td>
                            <td>{{ $query['g6pd_ful']->g6pdm9 }}</td>
                            <td>{{ $query['g6pd_ful']->g6pdm10 }}</td>
                            <td>{{ $query['g6pd_ful']->g6pdm11 }}</td>
                            <td>{{ $query['g6pd_ful']->g6pdm12 }}</td>
                            <td>{{ $query['g6pd_ful']->g6pdf1 }}</td>
                            <td>{{ $query['g6pd_ful']->g6pdf2 }}</td>
                            <td>{{ $query['g6pd_ful']->g6pdf3 }}</td>
                            <td>{{ $query['g6pd_ful']->g6pdf4 }}</td>
                            <td>{{ $query['g6pd_ful']->g6pdf5 }}</td>
                            <td>{{ $query['g6pd_ful']->g6pdf6 }}</td>
                            <td>{{ $query['g6pd_ful']->g6pdf7 }}</td>
                            <td>{{ $query['g6pd_ful']->g6pdf8 }}</td>
                            <td>{{ $query['g6pd_ful']->g6pdf9 }}</td>
                            <td>{{ $query['g6pd_ful']->g6pdf10 }}</td>
                            <td>{{ $query['g6pd_ful']->g6pdf11 }}</td>
                            <td>{{ $query['g6pd_ful']->g6pdf12 }}</td>
                            <td>{{ $query['g6pd_ful']->g6pd }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>URINE hCG</td>
                            <td>{{ $query['urine_hcg']->urine_hcgm1 }}</td>
                            <td>{{ $query['urine_hcg']->urine_hcgm2 }}</td>
                            <td>{{ $query['urine_hcg']->urine_hcgm3 }}</td>
                            <td>{{ $query['urine_hcg']->urine_hcgm4 }}</td>
                            <td>{{ $query['urine_hcg']->urine_hcgm5 }}</td>
                            <td>{{ $query['urine_hcg']->urine_hcgm6 }}</td>
                            <td>{{ $query['urine_hcg']->urine_hcgm7 }}</td>
                            <td>{{ $query['urine_hcg']->urine_hcgm8 }}</td>
                            <td>{{ $query['urine_hcg']->urine_hcgm9 }}</td>
                            <td>{{ $query['urine_hcg']->urine_hcgm10 }}</td>
                            <td>{{ $query['urine_hcg']->urine_hcgm11 }}</td>
                            <td>{{ $query['urine_hcg']->urine_hcgm12 }}</td>
                            <td>{{ $query['urine_hcg']->urine_hcgf1 }}</td>
                            <td>{{ $query['urine_hcg']->urine_hcgf2 }}</td>
                            <td>{{ $query['urine_hcg']->urine_hcgf3 }}</td>
                            <td>{{ $query['urine_hcg']->urine_hcgf4 }}</td>
                            <td>{{ $query['urine_hcg']->urine_hcgf5 }}</td>
                            <td>{{ $query['urine_hcg']->urine_hcgf6 }}</td>
                            <td>{{ $query['urine_hcg']->urine_hcgf7 }}</td>
                            <td>{{ $query['urine_hcg']->urine_hcgf8 }}</td>
                            <td>{{ $query['urine_hcg']->urine_hcgf9 }}</td>
                            <td>{{ $query['urine_hcg']->urine_hcgf10 }}</td>
                            <td>{{ $query['urine_hcg']->urine_hcgf11 }}</td>
                            <td>{{ $query['urine_hcg']->urine_hcgf12 }}</td>
                            <td>{{ $query['urine_hcg']->urine_hcg }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>BF (Positive)</td>
                            <td>{{ $query['bf_pos']->bfm1 }}</td>
                            <td>{{ $query['bf_pos']->bfm2 }}</td>
                            <td>{{ $query['bf_pos']->bfm3 }}</td>
                            <td>{{ $query['bf_pos']->bfm4 }}</td>
                            <td>{{ $query['bf_pos']->bfm5 }}</td>
                            <td>{{ $query['bf_pos']->bfm6 }}</td>
                            <td>{{ $query['bf_pos']->bfm7 }}</td>
                            <td>{{ $query['bf_pos']->bfm8 }}</td>
                            <td>{{ $query['bf_pos']->bfm9 }}</td>
                            <td>{{ $query['bf_pos']->bfm10 }}</td>
                            <td>{{ $query['bf_pos']->bfm11 }}</td>
                            <td>{{ $query['bf_pos']->bfm12 }}</td>
                            <td>{{ $query['bf_pos']->bff1 }}</td>
                            <td>{{ $query['bf_pos']->bff2 }}</td>
                            <td>{{ $query['bf_pos']->bff3 }}</td>
                            <td>{{ $query['bf_pos']->bff4 }}</td>
                            <td>{{ $query['bf_pos']->bff5 }}</td>
                            <td>{{ $query['bf_pos']->bff6 }}</td>
                            <td>{{ $query['bf_pos']->bff7 }}</td>
                            <td>{{ $query['bf_pos']->bff8 }}</td>
                            <td>{{ $query['bf_pos']->bff9 }}</td>
                            <td>{{ $query['bf_pos']->bff10 }}</td>
                            <td>{{ $query['bf_pos']->bff11 }}</td>
                            <td>{{ $query['bf_pos']->bff12 }}</td>
                            <td>{{ $query['bf_pos']->bf }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>BF (Negative)</td>
                            <td>{{ $query['bf_neg']->bfm1 }}</td>
                            <td>{{ $query['bf_neg']->bfm2 }}</td>
                            <td>{{ $query['bf_neg']->bfm3 }}</td>
                            <td>{{ $query['bf_neg']->bfm4 }}</td>
                            <td>{{ $query['bf_neg']->bfm5 }}</td>
                            <td>{{ $query['bf_neg']->bfm6 }}</td>
                            <td>{{ $query['bf_neg']->bfm7 }}</td>
                            <td>{{ $query['bf_neg']->bfm8 }}</td>
                            <td>{{ $query['bf_neg']->bfm9 }}</td>
                            <td>{{ $query['bf_neg']->bfm10 }}</td>
                            <td>{{ $query['bf_neg']->bfm11 }}</td>
                            <td>{{ $query['bf_neg']->bfm12 }}</td>
                            <td>{{ $query['bf_neg']->bff1 }}</td>
                            <td>{{ $query['bf_neg']->bff2 }}</td>
                            <td>{{ $query['bf_neg']->bff3 }}</td>
                            <td>{{ $query['bf_neg']->bff4 }}</td>
                            <td>{{ $query['bf_neg']->bff5 }}</td>
                            <td>{{ $query['bf_neg']->bff6 }}</td>
                            <td>{{ $query['bf_neg']->bff7 }}</td>
                            <td>{{ $query['bf_neg']->bff8 }}</td>
                            <td>{{ $query['bf_neg']->bff9 }}</td>
                            <td>{{ $query['bf_neg']->bff10 }}</td>
                            <td>{{ $query['bf_neg']->bff11 }}</td>
                            <td>{{ $query['bf_neg']->bff12 }}</td>
                            <td>{{ $query['bf_neg']->bf }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>BF (Negative - ANC)</td>
                            <td>{{ $query['bf_neg_anc']->bfm1 }}</td>
                            <td>{{ $query['bf_neg_anc']->bfm2 }}</td>
                            <td>{{ $query['bf_neg_anc']->bfm3 }}</td>
                            <td>{{ $query['bf_neg_anc']->bfm4 }}</td>
                            <td>{{ $query['bf_neg_anc']->bfm5 }}</td>
                            <td>{{ $query['bf_neg_anc']->bfm6 }}</td>
                            <td>{{ $query['bf_neg_anc']->bfm7 }}</td>
                            <td>{{ $query['bf_neg_anc']->bfm8 }}</td>
                            <td>{{ $query['bf_neg_anc']->bfm9 }}</td>
                            <td>{{ $query['bf_neg_anc']->bfm10 }}</td>
                            <td>{{ $query['bf_neg_anc']->bfm11 }}</td>
                            <td>{{ $query['bf_neg_anc']->bfm12 }}</td>
                            <td>{{ $query['bf_neg_anc']->bff1 }}</td>
                            <td>{{ $query['bf_neg_anc']->bff2 }}</td>
                            <td>{{ $query['bf_neg_anc']->bff3 }}</td>
                            <td>{{ $query['bf_neg_anc']->bff4 }}</td>
                            <td>{{ $query['bf_neg_anc']->bff5 }}</td>
                            <td>{{ $query['bf_neg_anc']->bff6 }}</td>
                            <td>{{ $query['bf_neg_anc']->bff7 }}</td>
                            <td>{{ $query['bf_neg_anc']->bff8 }}</td>
                            <td>{{ $query['bf_neg_anc']->bff9 }}</td>
                            <td>{{ $query['bf_neg_anc']->bff10 }}</td>
                            <td>{{ $query['bf_neg_anc']->bff11 }}</td>
                            <td>{{ $query['bf_neg_anc']->bff12 }}</td>
                            <td>{{ $query['bf_neg_anc']->bf }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>BF (Positve - ANC)</td>
                            <td>{{ $query['bf_pos_anc']->bfm1 }}</td>
                            <td>{{ $query['bf_pos_anc']->bfm2 }}</td>
                            <td>{{ $query['bf_pos_anc']->bfm3 }}</td>
                            <td>{{ $query['bf_pos_anc']->bfm4 }}</td>
                            <td>{{ $query['bf_pos_anc']->bfm5 }}</td>
                            <td>{{ $query['bf_pos_anc']->bfm6 }}</td>
                            <td>{{ $query['bf_pos_anc']->bfm7 }}</td>
                            <td>{{ $query['bf_pos_anc']->bfm8 }}</td>
                            <td>{{ $query['bf_pos_anc']->bfm9 }}</td>
                            <td>{{ $query['bf_pos_anc']->bfm10 }}</td>
                            <td>{{ $query['bf_pos_anc']->bfm11 }}</td>
                            <td>{{ $query['bf_pos_anc']->bfm12 }}</td>
                            <td>{{ $query['bf_pos_anc']->bff1 }}</td>
                            <td>{{ $query['bf_pos_anc']->bff2 }}</td>
                            <td>{{ $query['bf_pos_anc']->bff3 }}</td>
                            <td>{{ $query['bf_pos_anc']->bff4 }}</td>
                            <td>{{ $query['bf_pos_anc']->bff5 }}</td>
                            <td>{{ $query['bf_pos_anc']->bff6 }}</td>
                            <td>{{ $query['bf_pos_anc']->bff7 }}</td>
                            <td>{{ $query['bf_pos_anc']->bff8 }}</td>
                            <td>{{ $query['bf_pos_anc']->bff9 }}</td>
                            <td>{{ $query['bf_pos_anc']->bff10 }}</td>
                            <td>{{ $query['bf_pos_anc']->bff11 }}</td>
                            <td>{{ $query['bf_pos_anc']->bff12 }}</td>
                            <td>{{ $query['bf_pos_anc']->bf }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>BF (Negative - OPD)</td>
                            <td>{{ $query['bf_neg_opd']->bfm1 }}</td>
                            <td>{{ $query['bf_neg_opd']->bfm2 }}</td>
                            <td>{{ $query['bf_neg_opd']->bfm3 }}</td>
                            <td>{{ $query['bf_neg_opd']->bfm4 }}</td>
                            <td>{{ $query['bf_neg_opd']->bfm5 }}</td>
                            <td>{{ $query['bf_neg_opd']->bfm6 }}</td>
                            <td>{{ $query['bf_neg_opd']->bfm7 }}</td>
                            <td>{{ $query['bf_neg_opd']->bfm8 }}</td>
                            <td>{{ $query['bf_neg_opd']->bfm9 }}</td>
                            <td>{{ $query['bf_neg_opd']->bfm10 }}</td>
                            <td>{{ $query['bf_neg_opd']->bfm11 }}</td>
                            <td>{{ $query['bf_neg_opd']->bfm12 }}</td>
                            <td>{{ $query['bf_neg_opd']->bff1 }}</td>
                            <td>{{ $query['bf_neg_opd']->bff2 }}</td>
                            <td>{{ $query['bf_neg_opd']->bff3 }}</td>
                            <td>{{ $query['bf_neg_opd']->bff4 }}</td>
                            <td>{{ $query['bf_neg_opd']->bff5 }}</td>
                            <td>{{ $query['bf_neg_opd']->bff6 }}</td>
                            <td>{{ $query['bf_neg_opd']->bff7 }}</td>
                            <td>{{ $query['bf_neg_opd']->bff8 }}</td>
                            <td>{{ $query['bf_neg_opd']->bff9 }}</td>
                            <td>{{ $query['bf_neg_opd']->bff10 }}</td>
                            <td>{{ $query['bf_neg_opd']->bff11 }}</td>
                            <td>{{ $query['bf_neg_opd']->bff12 }}</td>
                            <td>{{ $query['bf_neg_opd']->bf }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>BF (Positive - OPD)</td>
                            <td>{{ $query['bf_pos_opd']->bfm1 }}</td>
                            <td>{{ $query['bf_pos_opd']->bfm2 }}</td>
                            <td>{{ $query['bf_pos_opd']->bfm3 }}</td>
                            <td>{{ $query['bf_pos_opd']->bfm4 }}</td>
                            <td>{{ $query['bf_pos_opd']->bfm5 }}</td>
                            <td>{{ $query['bf_pos_opd']->bfm6 }}</td>
                            <td>{{ $query['bf_pos_opd']->bfm7 }}</td>
                            <td>{{ $query['bf_pos_opd']->bfm8 }}</td>
                            <td>{{ $query['bf_pos_opd']->bfm9 }}</td>
                            <td>{{ $query['bf_pos_opd']->bfm10 }}</td>
                            <td>{{ $query['bf_pos_opd']->bfm11 }}</td>
                            <td>{{ $query['bf_pos_opd']->bfm12 }}</td>
                            <td>{{ $query['bf_pos_opd']->bff1 }}</td>
                            <td>{{ $query['bf_pos_opd']->bff2 }}</td>
                            <td>{{ $query['bf_pos_opd']->bff3 }}</td>
                            <td>{{ $query['bf_pos_opd']->bff4 }}</td>
                            <td>{{ $query['bf_pos_opd']->bff5 }}</td>
                            <td>{{ $query['bf_pos_opd']->bff6 }}</td>
                            <td>{{ $query['bf_pos_opd']->bff7 }}</td>
                            <td>{{ $query['bf_pos_opd']->bff8 }}</td>
                            <td>{{ $query['bf_pos_opd']->bff9 }}</td>
                            <td>{{ $query['bf_pos_opd']->bff10 }}</td>
                            <td>{{ $query['bf_pos_opd']->bff11 }}</td>
                            <td>{{ $query['bf_pos_opd']->bff12 }}</td>
                            <td>{{ $query['bf_pos_opd']->bf }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>BF (Negative - IPD)</td>
                            <td>{{ $query['bf_neg_ipd']->bfm1 }}</td>
                            <td>{{ $query['bf_neg_ipd']->bfm2 }}</td>
                            <td>{{ $query['bf_neg_ipd']->bfm3 }}</td>
                            <td>{{ $query['bf_neg_ipd']->bfm4 }}</td>
                            <td>{{ $query['bf_neg_ipd']->bfm5 }}</td>
                            <td>{{ $query['bf_neg_ipd']->bfm6 }}</td>
                            <td>{{ $query['bf_neg_ipd']->bfm7 }}</td>
                            <td>{{ $query['bf_neg_ipd']->bfm8 }}</td>
                            <td>{{ $query['bf_neg_ipd']->bfm9 }}</td>
                            <td>{{ $query['bf_neg_ipd']->bfm10 }}</td>
                            <td>{{ $query['bf_neg_ipd']->bfm11 }}</td>
                            <td>{{ $query['bf_neg_ipd']->bfm12 }}</td>
                            <td>{{ $query['bf_neg_ipd']->bff1 }}</td>
                            <td>{{ $query['bf_neg_ipd']->bff2 }}</td>
                            <td>{{ $query['bf_neg_ipd']->bff3 }}</td>
                            <td>{{ $query['bf_neg_ipd']->bff4 }}</td>
                            <td>{{ $query['bf_neg_ipd']->bff5 }}</td>
                            <td>{{ $query['bf_neg_ipd']->bff6 }}</td>
                            <td>{{ $query['bf_neg_ipd']->bff7 }}</td>
                            <td>{{ $query['bf_neg_ipd']->bff8 }}</td>
                            <td>{{ $query['bf_neg_ipd']->bff9 }}</td>
                            <td>{{ $query['bf_neg_ipd']->bff10 }}</td>
                            <td>{{ $query['bf_neg_ipd']->bff11 }}</td>
                            <td>{{ $query['bf_neg_ipd']->bff12 }}</td>
                            <td>{{ $query['bf_neg_ipd']->bf }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>BF (Positive - IPD)</td>
                            <td>{{ $query['bf_pos_ipd']->bfm1 }}</td>
                            <td>{{ $query['bf_pos_ipd']->bfm2 }}</td>
                            <td>{{ $query['bf_pos_ipd']->bfm3 }}</td>
                            <td>{{ $query['bf_pos_ipd']->bfm4 }}</td>
                            <td>{{ $query['bf_pos_ipd']->bfm5 }}</td>
                            <td>{{ $query['bf_pos_ipd']->bfm6 }}</td>
                            <td>{{ $query['bf_pos_ipd']->bfm7 }}</td>
                            <td>{{ $query['bf_pos_ipd']->bfm8 }}</td>
                            <td>{{ $query['bf_pos_ipd']->bfm9 }}</td>
                            <td>{{ $query['bf_pos_ipd']->bfm10 }}</td>
                            <td>{{ $query['bf_pos_ipd']->bfm11 }}</td>
                            <td>{{ $query['bf_pos_ipd']->bfm12 }}</td>
                            <td>{{ $query['bf_pos_ipd']->bff1 }}</td>
                            <td>{{ $query['bf_pos_ipd']->bff2 }}</td>
                            <td>{{ $query['bf_pos_ipd']->bff3 }}</td>
                            <td>{{ $query['bf_pos_ipd']->bff4 }}</td>
                            <td>{{ $query['bf_pos_ipd']->bff5 }}</td>
                            <td>{{ $query['bf_pos_ipd']->bff6 }}</td>
                            <td>{{ $query['bf_pos_ipd']->bff7 }}</td>
                            <td>{{ $query['bf_pos_ipd']->bff8 }}</td>
                            <td>{{ $query['bf_pos_ipd']->bff9 }}</td>
                            <td>{{ $query['bf_pos_ipd']->bff10 }}</td>
                            <td>{{ $query['bf_pos_ipd']->bff11 }}</td>
                            <td>{{ $query['bf_pos_ipd']->bff12 }}</td>
                            <td>{{ $query['bf_pos_ipd']->bf }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>Malaria RDT (Positive)</td>
                            <td>{{ $query['rdt_pf_pos']->rdt_pfm1 }}</td>
                            <td>{{ $query['rdt_pf_pos']->rdt_pfm2 }}</td>
                            <td>{{ $query['rdt_pf_pos']->rdt_pfm3 }}</td>
                            <td>{{ $query['rdt_pf_pos']->rdt_pfm4 }}</td>
                            <td>{{ $query['rdt_pf_pos']->rdt_pfm5 }}</td>
                            <td>{{ $query['rdt_pf_pos']->rdt_pfm6 }}</td>
                            <td>{{ $query['rdt_pf_pos']->rdt_pfm7 }}</td>
                            <td>{{ $query['rdt_pf_pos']->rdt_pfm8 }}</td>
                            <td>{{ $query['rdt_pf_pos']->rdt_pfm9 }}</td>
                            <td>{{ $query['rdt_pf_pos']->rdt_pfm10 }}</td>
                            <td>{{ $query['rdt_pf_pos']->rdt_pfm11 }}</td>
                            <td>{{ $query['rdt_pf_pos']->rdt_pfm12 }}</td>
                            <td>{{ $query['rdt_pf_pos']->rdt_pff1 }}</td>
                            <td>{{ $query['rdt_pf_pos']->rdt_pff2 }}</td>
                            <td>{{ $query['rdt_pf_pos']->rdt_pff3 }}</td>
                            <td>{{ $query['rdt_pf_pos']->rdt_pff4 }}</td>
                            <td>{{ $query['rdt_pf_pos']->rdt_pff5 }}</td>
                            <td>{{ $query['rdt_pf_pos']->rdt_pff6 }}</td>
                            <td>{{ $query['rdt_pf_pos']->rdt_pff7 }}</td>
                            <td>{{ $query['rdt_pf_pos']->rdt_pff8 }}</td>
                            <td>{{ $query['rdt_pf_pos']->rdt_pff9 }}</td>
                            <td>{{ $query['rdt_pf_pos']->rdt_pff10 }}</td>
                            <td>{{ $query['rdt_pf_pos']->rdt_pff11 }}</td>
                            <td>{{ $query['rdt_pf_pos']->rdt_pff12 }}</td>
                            <td>{{ $query['rdt_pf_pos']->rdt_pf }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>Malaria RDT (Negative)</td>
                            <td>{{ $query['rdt_pf_neg']->rdt_pfm1 }}</td>
                            <td>{{ $query['rdt_pf_neg']->rdt_pfm2 }}</td>
                            <td>{{ $query['rdt_pf_neg']->rdt_pfm3 }}</td>
                            <td>{{ $query['rdt_pf_neg']->rdt_pfm4 }}</td>
                            <td>{{ $query['rdt_pf_neg']->rdt_pfm5 }}</td>
                            <td>{{ $query['rdt_pf_neg']->rdt_pfm6 }}</td>
                            <td>{{ $query['rdt_pf_neg']->rdt_pfm7 }}</td>
                            <td>{{ $query['rdt_pf_neg']->rdt_pfm8 }}</td>
                            <td>{{ $query['rdt_pf_neg']->rdt_pfm9 }}</td>
                            <td>{{ $query['rdt_pf_neg']->rdt_pfm10 }}</td>
                            <td>{{ $query['rdt_pf_neg']->rdt_pfm11 }}</td>
                            <td>{{ $query['rdt_pf_neg']->rdt_pfm12 }}</td>
                            <td>{{ $query['rdt_pf_neg']->rdt_pff1 }}</td>
                            <td>{{ $query['rdt_pf_neg']->rdt_pff2 }}</td>
                            <td>{{ $query['rdt_pf_neg']->rdt_pff3 }}</td>
                            <td>{{ $query['rdt_pf_neg']->rdt_pff4 }}</td>
                            <td>{{ $query['rdt_pf_neg']->rdt_pff5 }}</td>
                            <td>{{ $query['rdt_pf_neg']->rdt_pff6 }}</td>
                            <td>{{ $query['rdt_pf_neg']->rdt_pff7 }}</td>
                            <td>{{ $query['rdt_pf_neg']->rdt_pff8 }}</td>
                            <td>{{ $query['rdt_pf_neg']->rdt_pff9 }}</td>
                            <td>{{ $query['rdt_pf_neg']->rdt_pff10 }}</td>
                            <td>{{ $query['rdt_pf_neg']->rdt_pff11 }}</td>
                            <td>{{ $query['rdt_pf_neg']->rdt_pff12 }}</td>
                            <td>{{ $query['rdt_pf_neg']->rdt_pf }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>ESR</td>
                            <td>{{ $query['esr']->esrm1 }}</td>
                            <td>{{ $query['esr']->esrm2 }}</td>
                            <td>{{ $query['esr']->esrm3 }}</td>
                            <td>{{ $query['esr']->esrm4 }}</td>
                            <td>{{ $query['esr']->esrm5 }}</td>
                            <td>{{ $query['esr']->esrm6 }}</td>
                            <td>{{ $query['esr']->esrm7 }}</td>
                            <td>{{ $query['esr']->esrm8 }}</td>
                            <td>{{ $query['esr']->esrm9 }}</td>
                            <td>{{ $query['esr']->esrm10 }}</td>
                            <td>{{ $query['esr']->esrm11 }}</td>
                            <td>{{ $query['esr']->esrm12 }}</td>
                            <td>{{ $query['esr']->esrf1 }}</td>
                            <td>{{ $query['esr']->esrf2 }}</td>
                            <td>{{ $query['esr']->esrf3 }}</td>
                            <td>{{ $query['esr']->esrf4 }}</td>
                            <td>{{ $query['esr']->esrf5 }}</td>
                            <td>{{ $query['esr']->esrf6 }}</td>
                            <td>{{ $query['esr']->esrf7 }}</td>
                            <td>{{ $query['esr']->esrf8 }}</td>
                            <td>{{ $query['esr']->esrf9 }}</td>
                            <td>{{ $query['esr']->esrf10 }}</td>
                            <td>{{ $query['esr']->esrf11 }}</td>
                            <td>{{ $query['esr']->esrf12 }}</td>
                            <td>{{ $query['esr']->esr }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>SICKLING (Positive)</td>
                            <td>{{ $query['sickling_pos']->sicklingm1 }}</td>
                            <td>{{ $query['sickling_pos']->sicklingm2 }}</td>
                            <td>{{ $query['sickling_pos']->sicklingm3 }}</td>
                            <td>{{ $query['sickling_pos']->sicklingm4 }}</td>
                            <td>{{ $query['sickling_pos']->sicklingm5 }}</td>
                            <td>{{ $query['sickling_pos']->sicklingm6 }}</td>
                            <td>{{ $query['sickling_pos']->sicklingm7 }}</td>
                            <td>{{ $query['sickling_pos']->sicklingm8 }}</td>
                            <td>{{ $query['sickling_pos']->sicklingm9 }}</td>
                            <td>{{ $query['sickling_pos']->sicklingm10 }}</td>
                            <td>{{ $query['sickling_pos']->sicklingm11 }}</td>
                            <td>{{ $query['sickling_pos']->sicklingm12 }}</td>
                            <td>{{ $query['sickling_pos']->sicklingf1 }}</td>
                            <td>{{ $query['sickling_pos']->sicklingf2 }}</td>
                            <td>{{ $query['sickling_pos']->sicklingf3 }}</td>
                            <td>{{ $query['sickling_pos']->sicklingf4 }}</td>
                            <td>{{ $query['sickling_pos']->sicklingf5 }}</td>
                            <td>{{ $query['sickling_pos']->sicklingf6 }}</td>
                            <td>{{ $query['sickling_pos']->sicklingf7 }}</td>
                            <td>{{ $query['sickling_pos']->sicklingf8 }}</td>
                            <td>{{ $query['sickling_pos']->sicklingf9 }}</td>
                            <td>{{ $query['sickling_pos']->sicklingf10 }}</td>
                            <td>{{ $query['sickling_pos']->sicklingf11 }}</td>
                            <td>{{ $query['sickling_pos']->sicklingf12 }}</td>
                            <td>{{ $query['sickling_pos']->sickling }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>SICKLING (Negative)</td>
                            <td>{{ $query['sickling_neg']->sicklingm1 }}</td>
                            <td>{{ $query['sickling_neg']->sicklingm2 }}</td>
                            <td>{{ $query['sickling_neg']->sicklingm3 }}</td>
                            <td>{{ $query['sickling_neg']->sicklingm4 }}</td>
                            <td>{{ $query['sickling_neg']->sicklingm5 }}</td>
                            <td>{{ $query['sickling_neg']->sicklingm6 }}</td>
                            <td>{{ $query['sickling_neg']->sicklingm7 }}</td>
                            <td>{{ $query['sickling_neg']->sicklingm8 }}</td>
                            <td>{{ $query['sickling_neg']->sicklingm9 }}</td>
                            <td>{{ $query['sickling_neg']->sicklingm10 }}</td>
                            <td>{{ $query['sickling_neg']->sicklingm11 }}</td>
                            <td>{{ $query['sickling_neg']->sicklingm12 }}</td>
                            <td>{{ $query['sickling_neg']->sicklingf1 }}</td>
                            <td>{{ $query['sickling_neg']->sicklingf2 }}</td>
                            <td>{{ $query['sickling_neg']->sicklingf3 }}</td>
                            <td>{{ $query['sickling_neg']->sicklingf4 }}</td>
                            <td>{{ $query['sickling_neg']->sicklingf5 }}</td>
                            <td>{{ $query['sickling_neg']->sicklingf6 }}</td>
                            <td>{{ $query['sickling_neg']->sicklingf7 }}</td>
                            <td>{{ $query['sickling_neg']->sicklingf8 }}</td>
                            <td>{{ $query['sickling_neg']->sicklingf9 }}</td>
                            <td>{{ $query['sickling_neg']->sicklingf10 }}</td>
                            <td>{{ $query['sickling_neg']->sicklingf11 }}</td>
                            <td>{{ $query['sickling_neg']->sicklingf12 }}</td>
                            <td>{{ $query['sickling_neg']->sickling }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>Hgb ELECTROPHORESIS</td>
                            <td>{{ $query['sickling_hb']->sickling_hbm1 }}</td>
                            <td>{{ $query['sickling_hb']->sickling_hbm2 }}</td>
                            <td>{{ $query['sickling_hb']->sickling_hbm3 }}</td>
                            <td>{{ $query['sickling_hb']->sickling_hbm4 }}</td>
                            <td>{{ $query['sickling_hb']->sickling_hbm5 }}</td>
                            <td>{{ $query['sickling_hb']->sickling_hbm6 }}</td>
                            <td>{{ $query['sickling_hb']->sickling_hbm7 }}</td>
                            <td>{{ $query['sickling_hb']->sickling_hbm8 }}</td>
                            <td>{{ $query['sickling_hb']->sickling_hbm9 }}</td>
                            <td>{{ $query['sickling_hb']->sickling_hbm10 }}</td>
                            <td>{{ $query['sickling_hb']->sickling_hbm11 }}</td>
                            <td>{{ $query['sickling_hb']->sickling_hbm12 }}</td>
                            <td>{{ $query['sickling_hb']->sickling_hbf1 }}</td>
                            <td>{{ $query['sickling_hb']->sickling_hbf2 }}</td>
                            <td>{{ $query['sickling_hb']->sickling_hbf3 }}</td>
                            <td>{{ $query['sickling_hb']->sickling_hbf4 }}</td>
                            <td>{{ $query['sickling_hb']->sickling_hbf5 }}</td>
                            <td>{{ $query['sickling_hb']->sickling_hbf6 }}</td>
                            <td>{{ $query['sickling_hb']->sickling_hbf7 }}</td>
                            <td>{{ $query['sickling_hb']->sickling_hbf8 }}</td>
                            <td>{{ $query['sickling_hb']->sickling_hbf9 }}</td>
                            <td>{{ $query['sickling_hb']->sickling_hbf10 }}</td>
                            <td>{{ $query['sickling_hb']->sickling_hbf11 }}</td>
                            <td>{{ $query['sickling_hb']->sickling_hbf12 }}</td>
                            <td>{{ $query['sickling_hb']->sickling_hb }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>WIDAL S. Typhi O</td>
                            <td>{{ $query['widal_o']->widal_om1 }}</td>
                            <td>{{ $query['widal_o']->widal_om2 }}</td>
                            <td>{{ $query['widal_o']->widal_om3 }}</td>
                            <td>{{ $query['widal_o']->widal_om4 }}</td>
                            <td>{{ $query['widal_o']->widal_om5 }}</td>
                            <td>{{ $query['widal_o']->widal_om6 }}</td>
                            <td>{{ $query['widal_o']->widal_om7 }}</td>
                            <td>{{ $query['widal_o']->widal_om8 }}</td>
                            <td>{{ $query['widal_o']->widal_om9 }}</td>
                            <td>{{ $query['widal_o']->widal_om10 }}</td>
                            <td>{{ $query['widal_o']->widal_om11 }}</td>
                            <td>{{ $query['widal_o']->widal_om12 }}</td>
                            <td>{{ $query['widal_o']->widal_of1 }}</td>
                            <td>{{ $query['widal_o']->widal_of2 }}</td>
                            <td>{{ $query['widal_o']->widal_of3 }}</td>
                            <td>{{ $query['widal_o']->widal_of4 }}</td>
                            <td>{{ $query['widal_o']->widal_of5 }}</td>
                            <td>{{ $query['widal_o']->widal_of6 }}</td>
                            <td>{{ $query['widal_o']->widal_of7 }}</td>
                            <td>{{ $query['widal_o']->widal_of8 }}</td>
                            <td>{{ $query['widal_o']->widal_of9 }}</td>
                            <td>{{ $query['widal_o']->widal_of10 }}</td>
                            <td>{{ $query['widal_o']->widal_of11 }}</td>
                            <td>{{ $query['widal_o']->widal_of12 }}</td>
                            <td>{{ $query['widal_o']->widal_o }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>WIDAL S. Typhi H</td>
                            <td>{{ $query['widal_h']->widal_hm1 }}</td>
                            <td>{{ $query['widal_h']->widal_hm2 }}</td>
                            <td>{{ $query['widal_h']->widal_hm3 }}</td>
                            <td>{{ $query['widal_h']->widal_hm4 }}</td>
                            <td>{{ $query['widal_h']->widal_hm5 }}</td>
                            <td>{{ $query['widal_h']->widal_hm6 }}</td>
                            <td>{{ $query['widal_h']->widal_hm7 }}</td>
                            <td>{{ $query['widal_h']->widal_hm8 }}</td>
                            <td>{{ $query['widal_h']->widal_hm9 }}</td>
                            <td>{{ $query['widal_h']->widal_hm10 }}</td>
                            <td>{{ $query['widal_h']->widal_hm11 }}</td>
                            <td>{{ $query['widal_h']->widal_hm12 }}</td>
                            <td>{{ $query['widal_h']->widal_hf1 }}</td>
                            <td>{{ $query['widal_h']->widal_hf2 }}</td>
                            <td>{{ $query['widal_h']->widal_hf3 }}</td>
                            <td>{{ $query['widal_h']->widal_hf4 }}</td>
                            <td>{{ $query['widal_h']->widal_hf5 }}</td>
                            <td>{{ $query['widal_h']->widal_hf6 }}</td>
                            <td>{{ $query['widal_h']->widal_hf7 }}</td>
                            <td>{{ $query['widal_h']->widal_hf8 }}</td>
                            <td>{{ $query['widal_h']->widal_hf9 }}</td>
                            <td>{{ $query['widal_h']->widal_hf10 }}</td>
                            <td>{{ $query['widal_h']->widal_hf11 }}</td>
                            <td>{{ $query['widal_h']->widal_hf12 }}</td>
                            <td>{{ $query['widal_h']->widal_h }}</td>
                        </tr>    
                        <tr>
                            <td style="text-align: left" nowrap>Urine R/E</td>
                            <td>{{ $query['urinalysis']->colorm1 }}</td>
                            <td>{{ $query['urinalysis']->colorm2 }}</td>
                            <td>{{ $query['urinalysis']->colorm3 }}</td>
                            <td>{{ $query['urinalysis']->colorm4 }}</td>
                            <td>{{ $query['urinalysis']->colorm5 }}</td>
                            <td>{{ $query['urinalysis']->colorm6 }}</td>
                            <td>{{ $query['urinalysis']->colorm7 }}</td>
                            <td>{{ $query['urinalysis']->colorm8 }}</td>
                            <td>{{ $query['urinalysis']->colorm9 }}</td>
                            <td>{{ $query['urinalysis']->colorm10 }}</td>
                            <td>{{ $query['urinalysis']->colorm11 }}</td>
                            <td>{{ $query['urinalysis']->colorm12 }}</td>
                            <td>{{ $query['urinalysis']->colorf1 }}</td>
                            <td>{{ $query['urinalysis']->colorf2 }}</td>
                            <td>{{ $query['urinalysis']->colorf3 }}</td>
                            <td>{{ $query['urinalysis']->colorf4 }}</td>
                            <td>{{ $query['urinalysis']->colorf5 }}</td>
                            <td>{{ $query['urinalysis']->colorf6 }}</td>
                            <td>{{ $query['urinalysis']->colorf7 }}</td>
                            <td>{{ $query['urinalysis']->colorf8 }}</td>
                            <td>{{ $query['urinalysis']->colorf9 }}</td>
                            <td>{{ $query['urinalysis']->colorf10 }}</td>
                            <td>{{ $query['urinalysis']->colorf11 }}</td>
                            <td>{{ $query['urinalysis']->colorf12 }}</td>
                            <td>{{ $query['urinalysis']->color }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>STOOL R/E</td>
                            <td>{{ $query['stool']->macrom1 }}</td>
                            <td>{{ $query['stool']->macrom2 }}</td>
                            <td>{{ $query['stool']->macrom3 }}</td>
                            <td>{{ $query['stool']->macrom4 }}</td>
                            <td>{{ $query['stool']->macrom5 }}</td>
                            <td>{{ $query['stool']->macrom6 }}</td>
                            <td>{{ $query['stool']->macrom7 }}</td>
                            <td>{{ $query['stool']->macrom8 }}</td>
                            <td>{{ $query['stool']->macrom9 }}</td>
                            <td>{{ $query['stool']->macrom10 }}</td>
                            <td>{{ $query['stool']->macrom11 }}</td>
                            <td>{{ $query['stool']->macrom12 }}</td>
                            <td>{{ $query['stool']->macrof1 }}</td>
                            <td>{{ $query['stool']->macrof2 }}</td>
                            <td>{{ $query['stool']->macrof3 }}</td>
                            <td>{{ $query['stool']->macrof4 }}</td>
                            <td>{{ $query['stool']->macrof5 }}</td>
                            <td>{{ $query['stool']->macrof6 }}</td>
                            <td>{{ $query['stool']->macrof7 }}</td>
                            <td>{{ $query['stool']->macrof8 }}</td>
                            <td>{{ $query['stool']->macrof9 }}</td>
                            <td>{{ $query['stool']->macrof10 }}</td>
                            <td>{{ $query['stool']->macrof11 }}</td>
                            <td>{{ $query['stool']->macrof12 }}</td>
                            <td>{{ $query['stool']->macro }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>FBC</td>
                            <td>{{ $query['fbc']->wbcm1 }}</td>
                            <td>{{ $query['fbc']->wbcm2 }}</td>
                            <td>{{ $query['fbc']->wbcm3 }}</td>
                            <td>{{ $query['fbc']->wbcm4 }}</td>
                            <td>{{ $query['fbc']->wbcm5 }}</td>
                            <td>{{ $query['fbc']->wbcm6 }}</td>
                            <td>{{ $query['fbc']->wbcm7 }}</td>
                            <td>{{ $query['fbc']->wbcm8 }}</td>
                            <td>{{ $query['fbc']->wbcm9 }}</td>
                            <td>{{ $query['fbc']->wbcm10 }}</td>
                            <td>{{ $query['fbc']->wbcm11 }}</td>
                            <td>{{ $query['fbc']->wbcm12 }}</td>
                            <td>{{ $query['fbc']->wbcf1 }}</td>
                            <td>{{ $query['fbc']->wbcf2 }}</td>
                            <td>{{ $query['fbc']->wbcf3 }}</td>
                            <td>{{ $query['fbc']->wbcf4 }}</td>
                            <td>{{ $query['fbc']->wbcf5 }}</td>
                            <td>{{ $query['fbc']->wbcf6 }}</td>
                            <td>{{ $query['fbc']->wbcf7 }}</td>
                            <td>{{ $query['fbc']->wbcf8 }}</td>
                            <td>{{ $query['fbc']->wbcf9 }}</td>
                            <td>{{ $query['fbc']->wbcf10 }}</td>
                            <td>{{ $query['fbc']->wbcf11 }}</td>
                            <td>{{ $query['fbc']->wbcf12 }}</td>
                            <td>{{ $query['fbc']->wbc }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>HIV</td>
                            <td>{{ $query['hiv']->first_respm1 }}</td>
                            <td>{{ $query['hiv']->first_respm2 }}</td>
                            <td>{{ $query['hiv']->first_respm3 }}</td>
                            <td>{{ $query['hiv']->first_respm4 }}</td>
                            <td>{{ $query['hiv']->first_respm5 }}</td>
                            <td>{{ $query['hiv']->first_respm6 }}</td>
                            <td>{{ $query['hiv']->first_respm7 }}</td>
                            <td>{{ $query['hiv']->first_respm8 }}</td>
                            <td>{{ $query['hiv']->first_respm9 }}</td>
                            <td>{{ $query['hiv']->first_respm10 }}</td>
                            <td>{{ $query['hiv']->first_respm11 }}</td>
                            <td>{{ $query['hiv']->first_respm12 }}</td>
                            <td>{{ $query['hiv']->first_respf1 }}</td>
                            <td>{{ $query['hiv']->first_respf2 }}</td>
                            <td>{{ $query['hiv']->first_respf3 }}</td>
                            <td>{{ $query['hiv']->first_respf4 }}</td>
                            <td>{{ $query['hiv']->first_respf5 }}</td>
                            <td>{{ $query['hiv']->first_respf6 }}</td>
                            <td>{{ $query['hiv']->first_respf7 }}</td>
                            <td>{{ $query['hiv']->first_respf8 }}</td>
                            <td>{{ $query['hiv']->first_respf9 }}</td>
                            <td>{{ $query['hiv']->first_respf10 }}</td>
                            <td>{{ $query['hiv']->first_respf11 }}</td>
                            <td>{{ $query['hiv']->first_respf12 }}</td>
                            <td>{{ $query['hiv']->first_resp }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>HIV (Positive)</td>
                            <td>{{ $query['hiv_pos']->sd_biolinem1 }}</td>
                            <td>{{ $query['hiv_pos']->sd_biolinem2 }}</td>
                            <td>{{ $query['hiv_pos']->sd_biolinem3 }}</td>
                            <td>{{ $query['hiv_pos']->sd_biolinem4 }}</td>
                            <td>{{ $query['hiv_pos']->sd_biolinem5 }}</td>
                            <td>{{ $query['hiv_pos']->sd_biolinem6 }}</td>
                            <td>{{ $query['hiv_pos']->sd_biolinem7 }}</td>
                            <td>{{ $query['hiv_pos']->sd_biolinem8 }}</td>
                            <td>{{ $query['hiv_pos']->sd_biolinem9 }}</td>
                            <td>{{ $query['hiv_pos']->sd_biolinem10 }}</td>
                            <td>{{ $query['hiv_pos']->sd_biolinem11 }}</td>
                            <td>{{ $query['hiv_pos']->sd_biolinem12 }}</td>
                            <td>{{ $query['hiv_pos']->sd_biolinef1 }}</td>
                            <td>{{ $query['hiv_pos']->sd_biolinef2 }}</td>
                            <td>{{ $query['hiv_pos']->sd_biolinef3 }}</td>
                            <td>{{ $query['hiv_pos']->sd_biolinef4 }}</td>
                            <td>{{ $query['hiv_pos']->sd_biolinef5 }}</td>
                            <td>{{ $query['hiv_pos']->sd_biolinef6 }}</td>
                            <td>{{ $query['hiv_pos']->sd_biolinef7 }}</td>
                            <td>{{ $query['hiv_pos']->sd_biolinef8 }}</td>
                            <td>{{ $query['hiv_pos']->sd_biolinef9 }}</td>
                            <td>{{ $query['hiv_pos']->sd_biolinef10 }}</td>
                            <td>{{ $query['hiv_pos']->sd_biolinef11 }}</td>
                            <td>{{ $query['hiv_pos']->sd_biolinef12 }}</td>
                            <td>{{ $query['hiv_pos']->sd_bioline }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>COOMB&#x27;S</td>
                            <td>{{ $query['coombs']->indirectm1 }}</td>
                            <td>{{ $query['coombs']->indirectm2 }}</td>
                            <td>{{ $query['coombs']->indirectm3 }}</td>
                            <td>{{ $query['coombs']->indirectm4 }}</td>
                            <td>{{ $query['coombs']->indirectm5 }}</td>
                            <td>{{ $query['coombs']->indirectm6 }}</td>
                            <td>{{ $query['coombs']->indirectm7 }}</td>
                            <td>{{ $query['coombs']->indirectm8 }}</td>
                            <td>{{ $query['coombs']->indirectm9 }}</td>
                            <td>{{ $query['coombs']->indirectm10 }}</td>
                            <td>{{ $query['coombs']->indirectm11 }}</td>
                            <td>{{ $query['coombs']->indirectm12 }}</td>
                            <td>{{ $query['coombs']->indirectf1 }}</td>
                            <td>{{ $query['coombs']->indirectf2 }}</td>
                            <td>{{ $query['coombs']->indirectf3 }}</td>
                            <td>{{ $query['coombs']->indirectf4 }}</td>
                            <td>{{ $query['coombs']->indirectf5 }}</td>
                            <td>{{ $query['coombs']->indirectf6 }}</td>
                            <td>{{ $query['coombs']->indirectf7 }}</td>
                            <td>{{ $query['coombs']->indirectf8 }}</td>
                            <td>{{ $query['coombs']->indirectf9 }}</td>
                            <td>{{ $query['coombs']->indirectf10 }}</td>
                            <td>{{ $query['coombs']->indirectf11 }}</td>
                            <td>{{ $query['coombs']->indirectf12 }}</td>
                            <td>{{ $query['coombs']->indirect }}</td>
                        </tr>
                    </tbody>
                @endif
                @if ($dt == 'Chemistries')
                    <tbody>
                        <tr>
                            <td style="text-align: left" nowrap>Liver Function Test</td>
                            <td>{{ $query['liver_protein']->liver_proteinm1 }}</td>
                            <td>{{ $query['liver_protein']->liver_proteinm2 }}</td>
                            <td>{{ $query['liver_protein']->liver_proteinm3 }}</td>
                            <td>{{ $query['liver_protein']->liver_proteinm4 }}</td>
                            <td>{{ $query['liver_protein']->liver_proteinm5 }}</td>
                            <td>{{ $query['liver_protein']->liver_proteinm6 }}</td>
                            <td>{{ $query['liver_protein']->liver_proteinm7 }}</td>
                            <td>{{ $query['liver_protein']->liver_proteinm8 }}</td>
                            <td>{{ $query['liver_protein']->liver_proteinm9 }}</td>
                            <td>{{ $query['liver_protein']->liver_proteinm10 }}</td>
                            <td>{{ $query['liver_protein']->liver_proteinm11 }}</td>
                            <td>{{ $query['liver_protein']->liver_proteinm12 }}</td>
                            <td>{{ $query['liver_protein']->liver_proteinf1 }}</td>
                            <td>{{ $query['liver_protein']->liver_proteinf2 }}</td>
                            <td>{{ $query['liver_protein']->liver_proteinf3 }}</td>
                            <td>{{ $query['liver_protein']->liver_proteinf4 }}</td>
                            <td>{{ $query['liver_protein']->liver_proteinf5 }}</td>
                            <td>{{ $query['liver_protein']->liver_proteinf6 }}</td>
                            <td>{{ $query['liver_protein']->liver_proteinf7 }}</td>
                            <td>{{ $query['liver_protein']->liver_proteinf8 }}</td>
                            <td>{{ $query['liver_protein']->liver_proteinf9 }}</td>
                            <td>{{ $query['liver_protein']->liver_proteinf10 }}</td>
                            <td>{{ $query['liver_protein']->liver_proteinf11 }}</td>
                            <td>{{ $query['liver_protein']->liver_proteinf12 }}</td>
                            <td>{{ $query['liver_protein']->liver_protein }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>Renal Function Test</td>
                            <td>{{ $query['renal_urea']->renal_uream1 }}</td>
                            <td>{{ $query['renal_urea']->renal_uream2 }}</td>
                            <td>{{ $query['renal_urea']->renal_uream3 }}</td>
                            <td>{{ $query['renal_urea']->renal_uream4 }}</td>
                            <td>{{ $query['renal_urea']->renal_uream5 }}</td>
                            <td>{{ $query['renal_urea']->renal_uream6 }}</td>
                            <td>{{ $query['renal_urea']->renal_uream7 }}</td>
                            <td>{{ $query['renal_urea']->renal_uream8 }}</td>
                            <td>{{ $query['renal_urea']->renal_uream9 }}</td>
                            <td>{{ $query['renal_urea']->renal_uream10 }}</td>
                            <td>{{ $query['renal_urea']->renal_uream11 }}</td>
                            <td>{{ $query['renal_urea']->renal_uream12 }}</td>
                            <td>{{ $query['renal_urea']->renal_ureaf1 }}</td>
                            <td>{{ $query['renal_urea']->renal_ureaf2 }}</td>
                            <td>{{ $query['renal_urea']->renal_ureaf3 }}</td>
                            <td>{{ $query['renal_urea']->renal_ureaf4 }}</td>
                            <td>{{ $query['renal_urea']->renal_ureaf5 }}</td>
                            <td>{{ $query['renal_urea']->renal_ureaf6 }}</td>
                            <td>{{ $query['renal_urea']->renal_ureaf7 }}</td>
                            <td>{{ $query['renal_urea']->renal_ureaf8 }}</td>
                            <td>{{ $query['renal_urea']->renal_ureaf9 }}</td>
                            <td>{{ $query['renal_urea']->renal_ureaf10 }}</td>
                            <td>{{ $query['renal_urea']->renal_ureaf11 }}</td>
                            <td>{{ $query['renal_urea']->renal_ureaf12 }}</td>
                            <td>{{ $query['renal_urea']->renal_urea }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>Lipid Profile</td>
                            <td>{{ $query['lipid_total']->lipid_totalm1 }}</td>
                            <td>{{ $query['lipid_total']->lipid_totalm2 }}</td>
                            <td>{{ $query['lipid_total']->lipid_totalm3 }}</td>
                            <td>{{ $query['lipid_total']->lipid_totalm4 }}</td>
                            <td>{{ $query['lipid_total']->lipid_totalm5 }}</td>
                            <td>{{ $query['lipid_total']->lipid_totalm6 }}</td>
                            <td>{{ $query['lipid_total']->lipid_totalm7 }}</td>
                            <td>{{ $query['lipid_total']->lipid_totalm8 }}</td>
                            <td>{{ $query['lipid_total']->lipid_totalm9 }}</td>
                            <td>{{ $query['lipid_total']->lipid_totalm10 }}</td>
                            <td>{{ $query['lipid_total']->lipid_totalm11 }}</td>
                            <td>{{ $query['lipid_total']->lipid_totalm12 }}</td>
                            <td>{{ $query['lipid_total']->lipid_totalf1 }}</td>
                            <td>{{ $query['lipid_total']->lipid_totalf2 }}</td>
                            <td>{{ $query['lipid_total']->lipid_totalf3 }}</td>
                            <td>{{ $query['lipid_total']->lipid_totalf4 }}</td>
                            <td>{{ $query['lipid_total']->lipid_totalf5 }}</td>
                            <td>{{ $query['lipid_total']->lipid_totalf6 }}</td>
                            <td>{{ $query['lipid_total']->lipid_totalf7 }}</td>
                            <td>{{ $query['lipid_total']->lipid_totalf8 }}</td>
                            <td>{{ $query['lipid_total']->lipid_totalf9 }}</td>
                            <td>{{ $query['lipid_total']->lipid_totalf10 }}</td>
                            <td>{{ $query['lipid_total']->lipid_totalf11 }}</td>
                            <td>{{ $query['lipid_total']->lipid_totalf12 }}</td>
                            <td>{{ $query['lipid_total']->lipid_total }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>Electrolytes</td>
                            <td>{{ $query['electro_potas']->electro_potasm1 }}</td>
                            <td>{{ $query['electro_potas']->electro_potasm2 }}</td>
                            <td>{{ $query['electro_potas']->electro_potasm3 }}</td>
                            <td>{{ $query['electro_potas']->electro_potasm4 }}</td>
                            <td>{{ $query['electro_potas']->electro_potasm5 }}</td>
                            <td>{{ $query['electro_potas']->electro_potasm6 }}</td>
                            <td>{{ $query['electro_potas']->electro_potasm7 }}</td>
                            <td>{{ $query['electro_potas']->electro_potasm8 }}</td>
                            <td>{{ $query['electro_potas']->electro_potasm9 }}</td>
                            <td>{{ $query['electro_potas']->electro_potasm10 }}</td>
                            <td>{{ $query['electro_potas']->electro_potasm11 }}</td>
                            <td>{{ $query['electro_potas']->electro_potasm12 }}</td>
                            <td>{{ $query['electro_potas']->electro_potasf1 }}</td>
                            <td>{{ $query['electro_potas']->electro_potasf2 }}</td>
                            <td>{{ $query['electro_potas']->electro_potasf3 }}</td>
                            <td>{{ $query['electro_potas']->electro_potasf4 }}</td>
                            <td>{{ $query['electro_potas']->electro_potasf5 }}</td>
                            <td>{{ $query['electro_potas']->electro_potasf6 }}</td>
                            <td>{{ $query['electro_potas']->electro_potasf7 }}</td>
                            <td>{{ $query['electro_potas']->electro_potasf8 }}</td>
                            <td>{{ $query['electro_potas']->electro_potasf9 }}</td>
                            <td>{{ $query['electro_potas']->electro_potasf10 }}</td>
                            <td>{{ $query['electro_potas']->electro_potasf11 }}</td>
                            <td>{{ $query['electro_potas']->electro_potasf12 }}</td>
                            <td>{{ $query['electro_potas']->electro_potas }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>Uric Acid</td>
                            <td>{{ $query['uric_acid']->uric_acidm1 }}</td>
                            <td>{{ $query['uric_acid']->uric_acidm2 }}</td>
                            <td>{{ $query['uric_acid']->uric_acidm3 }}</td>
                            <td>{{ $query['uric_acid']->uric_acidm4 }}</td>
                            <td>{{ $query['uric_acid']->uric_acidm5 }}</td>
                            <td>{{ $query['uric_acid']->uric_acidm6 }}</td>
                            <td>{{ $query['uric_acid']->uric_acidm7 }}</td>
                            <td>{{ $query['uric_acid']->uric_acidm8 }}</td>
                            <td>{{ $query['uric_acid']->uric_acidm9 }}</td>
                            <td>{{ $query['uric_acid']->uric_acidm10 }}</td>
                            <td>{{ $query['uric_acid']->uric_acidm11 }}</td>
                            <td>{{ $query['uric_acid']->uric_acidm12 }}</td>
                            <td>{{ $query['uric_acid']->uric_acidf1 }}</td>
                            <td>{{ $query['uric_acid']->uric_acidf2 }}</td>
                            <td>{{ $query['uric_acid']->uric_acidf3 }}</td>
                            <td>{{ $query['uric_acid']->uric_acidf4 }}</td>
                            <td>{{ $query['uric_acid']->uric_acidf5 }}</td>
                            <td>{{ $query['uric_acid']->uric_acidf6 }}</td>
                            <td>{{ $query['uric_acid']->uric_acidf7 }}</td>
                            <td>{{ $query['uric_acid']->uric_acidf8 }}</td>
                            <td>{{ $query['uric_acid']->uric_acidf9 }}</td>
                            <td>{{ $query['uric_acid']->uric_acidf10 }}</td>
                            <td>{{ $query['uric_acid']->uric_acidf11 }}</td>
                            <td>{{ $query['uric_acid']->uric_acidf12 }}</td>
                            <td>{{ $query['uric_acid']->uric_acid }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>Glycated Hemoglobin Report</td>
                            <td>{{ $query['glycated_hba1c']->glycated_hba1cm1 }}</td>
                            <td>{{ $query['glycated_hba1c']->glycated_hba1cm2 }}</td>
                            <td>{{ $query['glycated_hba1c']->glycated_hba1cm3 }}</td>
                            <td>{{ $query['glycated_hba1c']->glycated_hba1cm4 }}</td>
                            <td>{{ $query['glycated_hba1c']->glycated_hba1cm5 }}</td>
                            <td>{{ $query['glycated_hba1c']->glycated_hba1cm6 }}</td>
                            <td>{{ $query['glycated_hba1c']->glycated_hba1cm7 }}</td>
                            <td>{{ $query['glycated_hba1c']->glycated_hba1cm8 }}</td>
                            <td>{{ $query['glycated_hba1c']->glycated_hba1cm9 }}</td>
                            <td>{{ $query['glycated_hba1c']->glycated_hba1cm10 }}</td>
                            <td>{{ $query['glycated_hba1c']->glycated_hba1cm11 }}</td>
                            <td>{{ $query['glycated_hba1c']->glycated_hba1cm12 }}</td>
                            <td>{{ $query['glycated_hba1c']->glycated_hba1cf1 }}</td>
                            <td>{{ $query['glycated_hba1c']->glycated_hba1cf2 }}</td>
                            <td>{{ $query['glycated_hba1c']->glycated_hba1cf3 }}</td>
                            <td>{{ $query['glycated_hba1c']->glycated_hba1cf4 }}</td>
                            <td>{{ $query['glycated_hba1c']->glycated_hba1cf5 }}</td>
                            <td>{{ $query['glycated_hba1c']->glycated_hba1cf6 }}</td>
                            <td>{{ $query['glycated_hba1c']->glycated_hba1cf7 }}</td>
                            <td>{{ $query['glycated_hba1c']->glycated_hba1cf8 }}</td>
                            <td>{{ $query['glycated_hba1c']->glycated_hba1cf9 }}</td>
                            <td>{{ $query['glycated_hba1c']->glycated_hba1cf10 }}</td>
                            <td>{{ $query['glycated_hba1c']->glycated_hba1cf11 }}</td>
                            <td>{{ $query['glycated_hba1c']->glycated_hba1cf12 }}</td>
                            <td>{{ $query['glycated_hba1c']->glycated_hba1c }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left" nowrap>Serum Bilirubin</td>
                            <td>{{ $query['serum_total']->serum_totalm1 }}</td>
                            <td>{{ $query['serum_total']->serum_totalm2 }}</td>
                            <td>{{ $query['serum_total']->serum_totalm3 }}</td>
                            <td>{{ $query['serum_total']->serum_totalm4 }}</td>
                            <td>{{ $query['serum_total']->serum_totalm5 }}</td>
                            <td>{{ $query['serum_total']->serum_totalm6 }}</td>
                            <td>{{ $query['serum_total']->serum_totalm7 }}</td>
                            <td>{{ $query['serum_total']->serum_totalm8 }}</td>
                            <td>{{ $query['serum_total']->serum_totalm9 }}</td>
                            <td>{{ $query['serum_total']->serum_totalm10 }}</td>
                            <td>{{ $query['serum_total']->serum_totalm11 }}</td>
                            <td>{{ $query['serum_total']->serum_totalm12 }}</td>
                            <td>{{ $query['serum_total']->serum_totalf1 }}</td>
                            <td>{{ $query['serum_total']->serum_totalf2 }}</td>
                            <td>{{ $query['serum_total']->serum_totalf3 }}</td>
                            <td>{{ $query['serum_total']->serum_totalf4 }}</td>
                            <td>{{ $query['serum_total']->serum_totalf5 }}</td>
                            <td>{{ $query['serum_total']->serum_totalf6 }}</td>
                            <td>{{ $query['serum_total']->serum_totalf7 }}</td>
                            <td>{{ $query['serum_total']->serum_totalf8 }}</td>
                            <td>{{ $query['serum_total']->serum_totalf9 }}</td>
                            <td>{{ $query['serum_total']->serum_totalf10 }}</td>
                            <td>{{ $query['serum_total']->serum_totalf11 }}</td>
                            <td>{{ $query['serum_total']->serum_totalf12 }}</td>
                            <td>{{ $query['serum_total']->serum_total }}</td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <table style="break-inside: avoid;">
                    <caption>RECORD OF BLOOD DONATIONS AND TRANSFUSIONS</caption>
                    <tr>
                        <td colspan="3" style="text-align:start; font-size: 20px;"><b>BLOOD DONATIONS</b></td>
                    </tr>
                    <tr>
                        <td rowspan="2" style="padding-right: 25%">ANTI TPHA/VDRL</td>
                        <td style="padding-right: 25%">POSITIVE</td>
                        <td>{{ $query['bloodbank']->anti_tpha_pos }}</td>
                    </tr>
                    <tr>                        
                        <td style="padding-right: 25%">TOTAL</td>
                        <td>{{ $query['bloodbank']->anti_tpha }}</td>
                    </tr>
        
                    <tr>
                        <td rowspan="2" style="padding-right: 25%">HBsAg</td>
                        <td style="padding-right: 25%">POSITIVE</td>
                        <td>{{ $query['bloodbank']->hbs_ag_pos }}</td>
                    </tr>
                    <tr>
                        <td style="padding-right: 25%">TOTAL</td>
                        <td>{{ $query['bloodbank']->hbs_ag }}</td>
                    </tr>
        
                    <tr>
                        <td rowspan="2" style="padding-right: 25%">HCV</td>
                        <td style="padding-right: 25%">POSITIVE</td>
                        <td>{{ $query['bloodbank']->hcv_pos }}</td>
                    </tr>
                    <tr>
                        <td style="padding-right: 25%">TOTAL</td>
                        <td>{{ $query['bloodbank']->hcv }}</td>
                    </tr>
        
                    <tr>
                        <td style="padding-right: 25%">BLOOD GROUP</td>
                        <td style="padding-right: 25%">TOTAL</td>
                        <td>{{ $query['bloodbank']->blood }}</td>
                    </tr>
                    <tr>
                        <td rowspan="2" style="padding-right: 25%">HIV</td>
                        <td style="padding-right: 25%">REACTIVE</td>
                        <td>{{ $query['bloodbank']->retro_pos }}</td>
                    </tr>
                    <tr>
                        <td style="padding-right: 25%">TOTAL</td>
                        <td>{{ $query['bloodbank']->retro }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align:start; font-size: 20px;"><b>BLOOD TRANSFUSIONS</b></td>
                    </tr>
                    <tr>
                        <td rowspan="13" style="text-align:center; font-size: 20px;"><b>WARDS</b></td>
                    </tr>
                    <tr>
                        <td style="padding-right: 25%">Emergency</td>
                        <td>{{ $query['blood_transfus']->emerg }}</td>
                    </tr>
                    <tr>
                        <td style="padding-right: 25%">Maternity Ward</td>
                        <td>{{ $query['blood_transfus']->maternity }}</td>
                    </tr>
                    <tr>
                        <td style="padding-right: 25%">General Ward</td>
                        <td>{{ $query['blood_transfus']->general }}</td>
                    </tr>
                    <tr>
                        <td style="padding-right: 25%">Orthopaedic Ward</td>
                        <td>{{ $query['blood_transfus']->orthopaedic }}</td>
                    </tr>
                    <tr>
                        <td style="padding-right: 25%">Childrens Ward</td>
                        <td>{{ $query['blood_transfus']->childrens }}</td>
                    </tr>
                    <tr>
                        <td style="padding-right: 25%"><b>TOTAL</b></td>
                        <td><b>{{ $query['blood_transfus']->total }}</b></td>
                    </tr>
                    <tr>
                        <td style="padding-right: 25%">ADULT MALES</td>
                        <td>{{ $query['blood_transfus']->adult_male }}</td>
                    </tr>
                    <tr>
                        <td style="padding-right: 25%">ADULT FEMALES</td>
                        <td>{{ $query['blood_transfus']->adult_female }}</td>
                    </tr>
                    <tr>
                        <td style="padding-right: 25%">MALE CHILDREN</td>
                        <td>{{ $query['blood_transfus']->child_male }}</td>
                    </tr>
                    <tr>
                        <td style="padding-right: 25%">FEMALE CHILDREN</td>
                        <td>{{ $query['blood_transfus']->adult_female }}</td>
                    </tr>
                    <tr>
                        <td style="padding-right: 25%"><b>TOTAL</b></td>
                        <td><b>{{ $query['blood_transfus']->total }}</b></td>
                    </tr>
        
                </table>
                <br>
                <br>
                <br>
                <table>
                    <caption>ATTENDANCE</caption>
                    <tr>
                        <td style="width: 50%; padding-right: 25%; font-size: 20px;">Male</td>
                        <td style="padding-right: 25%; font-size: 20px;">{{ $query['attendance']->male }}</td>
                    </tr>
                    <tr>
                        <td style="width: 50%; padding-right: 25%; font-size: 20px;">Female</td>
                        <td style="padding-right: 25%; font-size: 20px;">{{ $query['attendance']->female }}</td>
                    </tr>
                    <tr>
                        <td style="width: 50%; padding-right: 25%; font-size: 20px;">OPD</td>
                        <td style="padding-right: 25%; font-size: 20px;">{{ $query['attendance']->opd }}</td>
                    </tr>
                    <tr>
                        <td style="width: 50%; padding-right: 25%; font-size: 20px;">IPD</td>
                        <td style="padding-right: 25%; font-size: 20px;">{{ $query['attendance']->ipd }}</td>
                    </tr>
                    <tr>
                        <td style="width: 50%; padding-right: 25%; font-size: 20px;">Blood Donation</td>
                        <td style="padding-right: 25%; font-size: 20px;">{{ $query['attendance']->blood_donors }}</td>
                    </tr>
                    <tr>
                        <td style="width: 50%; padding-right: 25%; font-size: 20px;">Total Attendance</td>
                        <td style="padding-right: 25%; font-size: 20px;">{{ $query['attendance']->total }}</td>
                    </tr>
                @endif
            </table> 
        @elseif ($dt == 'HIV') 
            <table>
                <caption>RECORD OF HIV POSITIVES</caption>
                <tr>
                    <th>#</th>
                    <th>OPD No</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Result</th>
                </tr>

                @foreach ($query as $key => $hiv)
                    <tr>
                        <td style="text-align: center">{{ ++$key }}</td>
                        <td style="text-align: left; padding-left: 20px;">{{ $hiv->opd_number }}</td>
                        <td style="text-align: left; padding-left: 20px;">{{ $hiv->name }}</td>
                        <td style="text-align: center">{{ $hiv->age }}</td>
                        <td style="text-align: center">{{ $hiv->gender }}</td>
                        <td style="text-align: center">{{ $hiv->sd_bioline }}</td>
                    </tr> 
                @endforeach
        
            </table>         
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
		
		
	