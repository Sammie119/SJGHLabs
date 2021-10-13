<!DOCTYPE>
 <html>
	 <!-- Javascripts -->
	 <link href={{ asset("public/css/bootstrap.min.css")}} rel='stylesheet'>
	 <script src={{ asset("public/js/jquery-3.6.0.min.js") }}></script>
	 <script src={{ asset('public/js/bootstrap.min.js') }}></script>
	 <link rel="stylesheet" href={{ asset('public/font-awesome/css/font-awesome.min.css') }}>

 	<title>SJGH-Laboratory Report</title>
 		 
	<style type="text/css">

		#logo{
			margin-left: 0%;
			text-align: center;
			border-bottom: 2px solid;
		}

		.data{
			border-bottom: 2px solid;
			/* margin-left: 20%;
			margin-right: 10%; */
			font-size: 18px;
		}

		.sign{
			text-align: right;
			margin-left: 20%;
			margin-right: 10%;
			margin-top: 3%;
			font-size: 18px;
		}

		#tim{
			float: left;
			display: none;
		}

		label {
			text-transform: uppercase;
		}

		.noprint {
			float: right;
			padding-top: 10px;
			padding-bottom: 10px;
			padding-right: 20px;
			padding-left: 20px;
			font-weight: bolder;
			border: solid 1px;
			border-radius: 20px;
			position: relative;
		}
		
		 @media print {
			.noprint{
				visibility: hidden;
			}

			#tim{
				float: left;
				display: block;
			}

			table {break-inside: avoid;}

			#myheader_opd {
			    position: fixed;
			    top: 0;
			    right: 0;
			  }

			#myheader_lab {
			    position: fixed;
			    top: 0;
			    left: 0;
			  }

			div.divFooter {
				position: fixed;
				bottom: 0;
				left: 0;
			}

		  #watermark{
				margin-left: 10%;
				opacity: 0.5;
				position: fixed;
				background-image: url("{{ url('public/img/watermark2.png') }}");
				width: 80%;
				height: 110%;
				bottom: 5%;
				background-repeat: no-repeat;
				background-position: center;
			} 
		}

		@media screen {
		  div.divFooter, #myheader_opd, #myheader_lab{
		    display: none;
		  }
		}
		@page { size:8.5in 11in; margin: 1.5cm }

		.com{
			border: none; 
			font-family: Times New Roman;
			background: transparent;
			font-size: 17px;
		}
		
		.table1 tr td {
			padding: 5px;
			font-weight: 600;
			font-size: 18px;
		}

		.table1 {
			width: 60%;
			margin-left: 20%;
		}

		.results {
			width: 80%;
			margin-left: 20%;
			margin-bottom: 20px;
		}

		.tb_fbc {
			width: 70%;
			margin-left: 15%;
			margin-bottom: 20px;
		}

		.results tr td, .tb_fbc tr td,
		.tb_fbc tr th {
			padding-top: 10px;
			padding-bottom: 10px;
		}

	</style>

	<script type="text/javascript">
		function print_1(){
			window.print();
			window.close();
		}
	</script>

<?php 
	use App\Http\Controllers\PatientsController;

	$query = PatientsController::ageDependecy($haema->opd_number);

	$today = date("Y-m-d");

	$diff = date_diff(date_create($query), date_create($today));
	
	$myAge = $diff->format('%y'); 

	if($myAge < 1){

		$bday = new DateTime($query); // Your date of birth
		$today = new Datetime(date('m.d.y'));
		$diff = $today->diff($bday);
		$age_month = $diff->format('%m');

		if($age_month < 1){
			$age = $diff->format('%d')." Days";

		}
		else if($age_month > 1){
			$age = $diff->format('%m'). " Months";

		}
		else{
			$age = $diff->format('%m'). " Month";

		}
	}
	else if($myAge > 1){
		$age = $myAge." Years";
	}
	else{
		$age = $myAge." Year";
	}

	// FBC Age Dependencies.....................................

	if($myAge < 1){

		if($age_month < 1){

			//Limits for <30 days children
			$limt1 = '15.0 - 22.0';
			$limt2 = '0.6 - 4.1';
			$limt3 = '0.1 - 1.8';
			$limt4 = '2.0 - 7.8';
			$limt5 = '6.00 - 7.00';
			$limt6 = '17.0 - 22.0';
			$limt7 = '35.0 - 49.0';
			$limt8 = '80.0 - 99.0';
			$limt9 = '11.5 - 14.5';
			$limt10 = '100 - 300';
			$limt11 = '7.4 - 10.4';
			$limt12 = '0.20 - 0.90';
			$limt13 = '0.00 - 0.50';
			$limt14 = '0.00 - 0.10';

			if($haema->wbc < 15.0){
				$wbc1 = '<i class="fa fa-arrow-down"></i>';
			}else if($haema->wbc > 22.0){
				$wbc1 = '<i class="fa fa-arrow-up"></i>';
			}else{
				$wbc1 = '';
			}

			if($haema->lym < 0.6){
				$lym1 = '<i class="fa fa-arrow-down"></i>';
			}else if($haema->lym > 4.1){
				$lym1 = '<i class="fa fa-arrow-up"></i>';
			}else{
				$lym1 = '';
			}

			if($haema->mid < 0.1){
				$mid1 = '<i class="fa fa-arrow-down"></i>';
			}else if($haema->mid > 1.8){
				$mid1 = '<i class="fa fa-arrow-up"></i>';
			}else{
				$mid1 = '';
			}

			if($haema->mono < 0.2){
				$mono1 = '<i class="fa fa-arrow-down"></i>';
			}else if($haema->mono > 0.9){
				$mono1 = '<i class="fa fa-arrow-up"></i>';
			}else{
				$mono1 = '';
			}

			if($haema->eo < 0){
				$eo1 = '<i class="fa fa-arrow-down"></i>';
			}else if($haema->eo > 0.5){
				$eo1 = '<i class="fa fa-arrow-up"></i>';
			}else{
				$eo1 = '';
			}

			if($haema->baso < 0){
				$baso1 = '<i class="fa fa-arrow-down"></i>';
			}else if($haema->baso > 0.1){
				$baso1 = '<i class="fa fa-arrow-up"></i>';
			}else{
				$baso1 = '';
			}

			if($haema->neut < 2.0){
				$neut1 = '<i class="fa fa-arrow-down"></i>';
			}else if($haema->neut > 7.8){
				$neut1 = '<i class="fa fa-arrow-up"></i>';
			}else{
				$neut1 = '';
			}

			if($haema->rbc < 6.00){
				$rbc1 = '<i class="fa fa-arrow-down"></i>';
			}else if($haema->rbc > 7.00){
				$rbc1 = '<i class="fa fa-arrow-up"></i>';
			}else{
				$rbc1 = '';
			}

			if($haema->fbc_hgb < 17.0){
				$fbc_hgb1 = '<i class="fa fa-arrow-down"></i>';
			}else if($haema->fbc_hgb > 22.0){
				$fbc_hgb1 = '<i class="fa fa-arrow-up"></i>';
			}else{
				$fbc_hgb1 = '';
			}

			if($haema->hct < 35.0){
				$hct1 = '<i class="fa fa-arrow-down"></i>';
			}else if($haema->hct > 49.0){
				$hct1 = '<i class="fa fa-arrow-up"></i>';
			}else{
				$hct1 = '';
			}

			if($haema->mcv < 80.00){
				$mcv1 = '<i class="fa fa-arrow-down"></i>';
			}else if($haema->mcv > 99.0){
				$mcv1 = '<i class="fa fa-arrow-up"></i>';
			}else{
				$mcv1 = '';
			}

			if($haema->rdw_cv < 11.5){
				$rdw_cv1 = '<i class="fa fa-arrow-down"></i>';
			}else if($haema->rdw_cv > 14.5){
				$rdw_cv1 = '<i class="fa fa-arrow-up"></i>';
			}else{
				$rdw_cv1 = '';
			}

			if($haema->plt < 100){
				$plt1 = '<i class="fa fa-arrow-down"></i>';
			}else if($haema->plt > 300){
				$plt1 = '<i class="fa fa-arrow-up"></i>';
			}else{
				$plt1 = '';
			}

			if($haema->mpv < 7.4){
				$mpv1 = '<i class="fa fa-arrow-down"></i>';
			}else if($haema->mpv > 10.4){
				$mpv1 = '<i class="fa fa-arrow-up"></i>';
			}else{
				$mpv1 = '';
			}

		}
		else{

			//Limits for <1 year children
			$limt1 = '5.0 - 12.0';
			$limt2 = '0.6 - 4.1';
			$limt3 = '0.1 - 1.8';
			$limt4 = '2.0 - 7.8';
			$limt5 = '4.00 - 5.20';
			$limt6 = '12.0 - 15.0';
			$limt7 = '35.0 - 49.0';
			$limt8 = '80.0 - 99.0';
			$limt9 = '11.5 - 14.5';
			$limt10 = '100 - 300';
			$limt11 = '7.4 - 10.4';
			$limt12 = '0.20 - 0.90';
			$limt13 = '0.00 - 0.50';
			$limt14 = '0.00 - 0.10';

			if($haema->wbc < 5.0){
				$wbc1 = '<i class="fa fa-arrow-down"></i>';
			}else if($haema->wbc > 12.0){
				$wbc1 = '<i class="fa fa-arrow-up"></i>';
			}else{
				$wbc1 = '';
			}

			if($haema->lym < 0.6){
				$lym1 = '<i class="fa fa-arrow-down"></i>';
			}else if($haema->lym > 4.1){
				$lym1 = '<i class="fa fa-arrow-up"></i>';
			}else{
				$lym1 = '';
			}

			if($haema->mid < 0.1){
				$mid1 = '<i class="fa fa-arrow-down"></i>';
			}else if($haema->mid > 1.8){
				$mid1 = '<i class="fa fa-arrow-up"></i>';
			}else{
				$mid1 = '';
			}

			if($haema->mono < 0.2){
				$mono1 = '<i class="fa fa-arrow-down"></i>';
			}else if($haema->mono > 0.9){
				$mono1 = '<i class="fa fa-arrow-up"></i>';
			}else{
				$mono1 = '';
			}

			if($haema->eo < 0){
				$eo1 = '<i class="fa fa-arrow-down"></i>';
			}else if($haema->eo > 0.5){
				$eo1 = '<i class="fa fa-arrow-up"></i>';
			}else{
				$eo1 = '';
			}

			if($haema->baso < 0){
				$baso1 = '<i class="fa fa-arrow-down"></i>';
			}else if($haema->baso > 0.1){
				$baso1 = '<i class="fa fa-arrow-up"></i>';
			}else{
				$baso1 = '';
			}

			if($haema->neut < 2.0){
				$neut1 = '<i class="fa fa-arrow-down"></i>';
			}else if($haema->neut > 7.8){
				$neut1 = '<i class="fa fa-arrow-up"></i>';
			}else{
				$neut1 = '';
			}

			if($haema->rbc < 4.00){
				$rbc1 = '<i class="fa fa-arrow-down"></i>';
			}else if($haema->rbc > 5.00){
				$rbc1 = '<i class="fa fa-arrow-up"></i>';
			}else{
				$rbc1 = '';
			}

			if($haema->fbc_hgb < 12.0){
				$fbc_hgb1 = '<i class="fa fa-arrow-down"></i>';
			}else if($haema->fbc_hgb > 15.0){
				$fbc_hgb1 = '<i class="fa fa-arrow-up"></i>';
			}else{
				$fbc_hgb1 = '';
			}

			if($haema->hct < 35.0){
				$hct1 = '<i class="fa fa-arrow-down"></i>';
			}else if($haema->hct > 49.0){
				$hct1 = '<i class="fa fa-arrow-up"></i>';
			}else{
				$hct1 = '';
			}

			if($haema->mcv < 80.00){
				$mcv1 = '<i class="fa fa-arrow-down"></i>';
			}else if($haema->mcv > 99.0){
				$mcv1 = '<i class="fa fa-arrow-up"></i>';
			}else{
				$mcv1 = '';
			}

			if($haema->rdw_cv < 11.5){
				$rdw_cv1 = '<i class="fa fa-arrow-down"></i>';
			}else if($haema->rdw_cv > 14.5){
				$rdw_cv1 = '<i class="fa fa-arrow-up"></i>';
			}else{
				$rdw_cv1 = '';
			}

			if($haema->plt < 100){
				$plt1 = '<i class="fa fa-arrow-down"></i>';
			}else if($haema->plt > 300){
				$plt1 = '<i class="fa fa-arrow-up"></i>';
			}else{
				$plt1 = '';
			}

			if($haema->mpv < 7.4){
				$mpv1 = '<i class="fa fa-arrow-down"></i>';
			}else if($haema->mpv > 10.4){
				$mpv1 = '<i class="fa fa-arrow-up"></i>';
			}else{
				$mpv1 = '';
			}
		}
}
else if($myAge > 1){

	if($myAge <= 13){

		//Limits for <13 year children
		$limt1 = '5.0 - 12.0';
		$limt2 = '0.6 - 4.1';
		$limt3 = '0.1 - 1.8';
		$limt4 = '2.0 - 7.8';
		$limt5 = '4.00 - 5.20';
		$limt6 = '12.0 - 15.0';
		$limt7 = '35.0 - 49.0';
		$limt8 = '80.0 - 99.0';
		$limt9 = '11.5 - 14.5';
		$limt10 = '100 - 300';
		$limt11 = '7.4 - 10.4';
		$limt12 = '0.20 - 0.90';
		$limt13 = '0.00 - 0.50';
		$limt14 = '0.00 - 0.10';

		if($haema->wbc < 5.0){
			$wbc1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->wbc > 12.0){
			$wbc1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$wbc1 = '';
		}

		if($haema->lym < 0.6){
			$lym1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->lym > 4.1){
			$lym1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$lym1 = '';
		}

		if($haema->mid < 0.1){
			$mid1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->mid > 1.8){
			$mid1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$mid1 = '';
		}

		if($haema->mono < 0.2){
			$mono1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->mono > 0.9){
			$mono1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$mono1 = '';
		}

		if($haema->eo < 0){
			$eo1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->eo > 0.5){
			$eo1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$eo1 = '';
		}

		if($haema->baso < 0){
			$baso1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->baso > 0.1){
			$baso1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$baso1 = '';
		}

		if($haema->neut < 2.0){
			$neut1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->neut > 7.8){
			$neut1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$neut1 = '';
		}

		if($haema->rbc < 4.00){
			$rbc1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->rbc > 5.00){
			$rbc1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$rbc1 = '';
		}

		if($haema->fbc_hgb < 12.0){
			$fbc_hgb1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->fbc_hgb > 15.0){
			$fbc_hgb1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$fbc_hgb1 = '';
		}

		if($haema->hct < 35.0){
			$hct1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->hct > 49.0){
			$hct1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$hct1 = '';
		}

		if($haema->mcv < 80.00){
			$mcv1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->mcv > 99.0){
			$mcv1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$mcv1 = '';
		}

		if($haema->rdw_cv < 11.5){
			$rdw_cv1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->rdw_cv > 14.5){
			$rdw_cv1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$rdw_cv1 = '';
		}

		if($haema->plt < 100){
			$plt1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->plt > 300){
			$plt1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$plt1 = '';
		}

		if($haema->mpv < 7.4){
			$mpv1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->mpv > 10.4){
			$mpv1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$mpv1 = '';
		}
	}
	else if(($myAge > 13) && ($haema->gender == "Female")){
		
		//Adult Female..............................
		$limt1 = '4.0 - 10.0';
		$limt2 = '0.6 - 4.1';
		$limt3 = '0.1 - 1.8';
		$limt4 = '2.0 - 7.8';
		$limt5 = '3.50 - 5.50';
		$limt6 = '11.0 - 15.0';
		$limt7 = '36.0 - 48.0';
		$limt8 = '80.0 - 99.0';
		$limt9 = '11.5 - 14.5';
		$limt10 = '100 - 300';
		$limt11 = '7.4 - 10.4';
		$limt12 = '0.20 - 0.90';
		$limt13 = '0.00 - 0.50';
		$limt14 = '0.00 - 0.10';

		if($haema->wbc < 4.0){
			$wbc1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->wbc > 10.0){
			$wbc1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$wbc1 = '';
		}

		if($haema->lym < 0.6){
			$lym1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->lym > 4.1){
			$lym1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$lym1 = '';
		}

		if($haema->mid < 0.1){
			$mid1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->mid > 1.8){
			$mid1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$mid1 = '';
		}

		if($haema->mono < 0.2){
			$mono1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->mono > 0.9){
			$mono1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$mono1 = '';
		}

		if($haema->eo < 0){
			$eo1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->eo > 0.5){
			$eo1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$eo1 = '';
		}

		if($haema->baso < 0){
			$baso1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->baso > 0.1){
			$baso1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$baso1 = '';
		}

		if($haema->neut < 2.0){
			$neut1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->neut > 7.8){
			$neut1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$neut1 = '';
		}

		if($haema->rbc < 3.50){
			$rbc1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->rbc > 5.50){
			$rbc1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$rbc1 = '';
		}

		if($haema->fbc_hgb < 11.0){
			$fbc_hgb1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->fbc_hgb > 15.0){
			$fbc_hgb1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$fbc_hgb1 = '';
		}

		if($haema->hct < 36.0){
			$hct1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->hct > 48.0){
			$hct1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$hct1 = '';
		}

		if($haema->mcv < 80.00){
			$mcv1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->mcv > 99.0){
			$mcv1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$mcv1 = '';
		}

		if($haema->rdw_cv < 11.5){
			$rdw_cv1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->rdw_cv > 14.5){
			$rdw_cv1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$rdw_cv1 = '';
		}

		if($haema->plt < 100){
			$plt1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->plt > 300){
			$plt1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$plt1 = '';
		}

		if($haema->mpv < 7.4){
			$mpv1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->mpv > 10.4){
			$mpv1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$mpv1 = '';
		}
	}
	else if(($myAge > 13) && ($haema->gender == "Male")){
		
		//Adult Male..............................
		$limt1 = '4.0 - 10.0';
		$limt2 = '0.6 - 4.1';
		$limt3 = '0.1 - 1.8';
		$limt4 = '2.0 - 7.8';
		$limt5 = '4.00 - 5.50';
		$limt6 = '12.0 - 16.0';
		$limt7 = '40.0 - 48.0';
		$limt8 = '80.0 - 99.0';
		$limt9 = '11.5 - 14.5';
		$limt10 = '100 - 300';
		$limt11 = '7.4 - 10.4';
		$limt12 = '0.20 - 0.90';
		$limt13 = '0.00 - 0.50';
		$limt14 = '0.00 - 0.10';

		if($haema->wbc < 4.0){
			$wbc1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->wbc > 10.0){
			$wbc1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$wbc1 = '';
		}

		if($haema->lym < 0.6){
			$lym1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->lym > 4.1){
			$lym1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$lym1 = '';
		}

		if($haema->mid < 0.1){
			$mid1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->mid > 1.8){
			$mid1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$mid1 = '';
		}

		if($haema->mono < 0.2){
			$mono1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->mono > 0.9){
			$mono1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$mono1 = '';
		}

		if($haema->eo < 0){
			$eo1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->eo > 0.5){
			$eo1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$eo1 = '';
		}

		if($haema->baso < 0){
			$baso1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->baso > 0.1){
			$baso1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$baso1 = '';
		}

		if($haema->neut < 2.0){
			$neut1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->neut > 7.8){
			$neut1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$neut1 = '';
		}

		if($haema->rbc < 4.00){
			$rbc1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->rbc > 5.50){
			$rbc1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$rbc1 = '';
		}

		if($haema->fbc_hgb < 12.0){
			$fbc_hgb1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->fbc_hgb > 16.0){
			$fbc_hgb1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$fbc_hgb1 = '';
		}

		if($haema->hct < 40.0){
			$hct1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->hct > 48.0){
			$hct1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$hct1 = '';
		}

		if($haema->mcv < 80.00){
			$mcv1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->mcv > 99.0){
			$mcv1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$mcv1 = '';
		}

		if($haema->rdw_cv < 11.5){
			$rdw_cv1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->rdw_cv > 14.5){
			$rdw_cv1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$rdw_cv1 = '';
		}

		if($haema->plt < 100){
			$plt1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->plt > 300){
			$plt1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$plt1 = '';
		}

		if($haema->mpv < 7.4){
			$mpv1 = '<i class="fa fa-arrow-down"></i>';
		}else if($haema->mpv > 10.4){
			$mpv1 = '<i class="fa fa-arrow-up"></i>';
		}else{
			$mpv1 = '';
		}
	}
}
else{

//Limits for =1 year children
$limt1 = '5.0 - 12.0';
$limt2 = '0.6 - 4.1';
$limt3 = '0.1 - 1.8';
$limt4 = '2.0 - 7.8';
$limt5 = '4.00 - 5.20';
$limt6 = '12.0 - 15.0';
$limt7 = '35.0 - 49.0';
$limt8 = '80.0 - 99.0';
$limt9 = '11.5 - 14.5';
$limt10 = '100 - 300';
$limt11 = '7.4 - 10.4';
$limt12 = '0.20 - 0.90';
$limt13 = '0.00 - 0.50';
$limt14 = '0.00 - 0.10';

	if($haema->wbc < 5.0){
		$wbc1 = '<i class="fa fa-arrow-down"></i>';
	}else if($haema->wbc > 12.0){
		$wbc1 = '<i class="fa fa-arrow-up"></i>';
	}else{
		$wbc1 = '';
	}

	if($haema->lym < 0.6){
		$lym1 = '<i class="fa fa-arrow-down"></i>';
	}else if($haema->lym > 4.1){
		$lym1 = '<i class="fa fa-arrow-up"></i>';
	}else{
		$lym1 = '';
	}

	if($haema->mid < 0.1){
		$mid1 = '<i class="fa fa-arrow-down"></i>';
	}else if($haema->mid > 1.8){
		$mid1 = '<i class="fa fa-arrow-up"></i>';
	}else{
		$mid1 = '';
	}

	if($haema->mono < 0.2){
		$mono1 = '<i class="fa fa-arrow-down"></i>';
	}else if($haema->mono > 0.9){
		$mono1 = '<i class="fa fa-arrow-up"></i>';
	}else{
		$mono1 = '';
	}

	if($haema->eo < 0){
		$eo1 = '<i class="fa fa-arrow-down"></i>';
	}else if($haema->eo > 0.5){
		$eo1 = '<i class="fa fa-arrow-up"></i>';
	}else{
		$eo1 = '';
	}

	if($haema->baso < 0){
		$baso1 = '<i class="fa fa-arrow-down"></i>';
	}else if($haema->baso > 0.1){
		$baso1 = '<i class="fa fa-arrow-up"></i>';
	}else{
		$baso1 = '';
	}

	if($haema->neut < 2.0){
		$neut1 = '<i class="fa fa-arrow-down"></i>';
	}else if($haema->neut > 7.8){
		$neut1 = '<i class="fa fa-arrow-up"></i>';
	}else{
		$neut1 = '';
	}

	if($haema->rbc < 4.00){
		$rbc1 = '<i class="fa fa-arrow-down"></i>';
	}else if($haema->rbc > 5.00){
		$rbc1 = '<i class="fa fa-arrow-up"></i>';
	}else{
		$rbc1 = '';
	}

	if($haema->fbc_hgb < 12.0){
		$fbc_hgb1 = '<i class="fa fa-arrow-down"></i>';
	}else if($haema->fbc_hgb > 15.0){
		$fbc_hgb1 = '<i class="fa fa-arrow-up"></i>';
	}else{
		$fbc_hgb1 = '';
	}

	if($haema->hct < 35.0){
		$hct1 = '<i class="fa fa-arrow-down"></i>';
	}else if($haema->hct > 49.0){
		$hct1 = '<i class="fa fa-arrow-up"></i>';
	}else{
		$hct1 = '';
	}

	if($haema->mcv < 80.00){
		$mcv1 = '<i class="fa fa-arrow-down"></i>';
	}else if($haema->mcv > 99.0){
		$mcv1 = '<i class="fa fa-arrow-up"></i>';
	}else{
		$mcv1 = '';
	}

	if($haema->rdw_cv < 11.5){
		$rdw_cv1 = '<i class="fa fa-arrow-down"></i>';
	}else if($haema->rdw_cv > 14.5){
		$rdw_cv1 = '<i class="fa fa-arrow-up"></i>';
	}else{
		$rdw_cv1 = '';
	}

	if($haema->plt < 100){
		$plt1 = '<i class="fa fa-arrow-down"></i>';
	}else if($haema->plt > 300){
		$plt1 = '<i class="fa fa-arrow-up"></i>';
	}else{
		$plt1 = '';
	}

	if($haema->mpv < 7.4){
		$mpv1 = '<i class="fa fa-arrow-down"></i>';
	}else if($haema->mpv > 10.4){
		$mpv1 = '<i class="fa fa-arrow-up"></i>';
	}else{
		$mpv1 = '';
	}
}

$limt15 = '27 - 32';

if($haema->mch < 27.0){
	$mch1 = '<i class="fa fa-arrow-down"></i>';
}else if($haema->mch > 32.0){
	$mch1 = '<i class="fa fa-arrow-up"></i>';
}else{
	$mch1 = '';
}

//Liver Function ...........................................
	if($chem->liver_protein < 60){
		$liver1 = '<i class="fa fa-arrow-down"></i>';
	}
	elseif ($chem->liver_protein > 83) {
		$liver1 = '<i class="fa fa-arrow-up"></i>';
	}
	else {
		$liver1 = '';
	}

	if($chem->liver_albumin < 37){
		$liver2 = '<i class="fa fa-arrow-down"></i>';
	}
	elseif ($chem->liver_albumin > 53) {
		$liver2 = '<i class="fa fa-arrow-up"></i>';
	}
	else {
		$liver2 = '';
	}

	if($chem->liver_globulin < 20){
		$liver3 = '<i class="fa fa-arrow-down"></i>';
	}
	elseif ($chem->liver_globulin > 40) {
		$liver3 = '<i class="fa fa-arrow-up"></i>';
	}
	else {
		$liver3 = '';
	} 

	if($chem->liver_alkaline < 40){
		$liver4 = '<i class="fa fa-arrow-down"></i>';
	}
	elseif ($chem->liver_alkaline > 150) {
		$liver4 = '<i class="fa fa-arrow-up"></i>';
	}
	else {
		$liver4 = '';
	} 

	if($chem->liver_alanine < 5){
		$liver5 = '<i class="fa fa-arrow-down"></i>';
	}
	elseif ($chem->liver_alanine > 40) {
		$liver5 = '<i class="fa fa-arrow-up"></i>';
	}
	else {
		$liver5 = '';
	}

	if($chem->liver_aspartate < 0){
		$liver6 = '<i class="fa fa-arrow-down"></i>';
	}
	elseif ($chem->liver_aspartate > 40) {
		$liver6 = '<i class="fa fa-arrow-up"></i>';
	}
	else {
		$liver6 = '';
	} 

	if($chem->liver_gamma < 0){
		$liver7 = '<i class="fa fa-arrow-down"></i>';
	}
	elseif ($chem->liver_gamma > 50) {
		$liver7 = '<i class="fa fa-arrow-up"></i>';
	}
	else {
		$liver7 = '';
	} 

	if($chem->liver_total < 1.7){
		$liver8 = '<i class="fa fa-arrow-down"></i>';
	}
	elseif ($chem->liver_total > 21) {
		$liver8 = '<i class="fa fa-arrow-up"></i>';
	}
	else {
		$liver8 = '';
	} 

	if($chem->liver_direct < 1.7){
		$liver9 = '<i class="fa fa-arrow-down"></i>';
	}
	elseif ($chem->liver_direct > 6.8) {
		$liver9 = '<i class="fa fa-arrow-up"></i>';
	}
	else {
		$liver9 = '';
	} 

	if($chem->liver_indirect < 1.7){
		$liver10 = '<i class="fa fa-arrow-down"></i>';
	}
	elseif ($chem->liver_indirect > 17.0) {
		$liver10 = '<i class="fa fa-arrow-up"></i>';
	}
	else {
		$liver10 = '';
	}

	//Renal
	if($chem->renal_urea < 2.82){
		$renal1 = '<i class="fa fa-arrow-down"></i>';
	}
	elseif ($chem->renal_urea > 8.2) {
		$renal1 = '<i class="fa fa-arrow-up"></i>';
	}
	else {
		$renal1 = '';
	} 

	if($chem->renal_creatinine < 53){
		$renal2 = '<i class="fa fa-arrow-down"></i>';
	}
	elseif ($chem->renal_creatinine > 115) {
		$renal2 = '<i class="fa fa-arrow-up"></i>';
	}
	else {
		$renal2 = '';
	}

	//Lipid ........................................
	if($chem->lipid_total < 3.1){
		$lipid1 = '<i class="fa fa-arrow-down"></i>';
	}
	elseif ($chem->lipid_total > 6.1) {
		$lipid1 = '<i class="fa fa-arrow-up"></i>';
	}
	else {
		$lipid1 = '';
	} 

	if($chem->lipid_trigly < 0.4){
		$lipid2 = '<i class="fa fa-arrow-down"></i>';
	}
	elseif ($chem->lipid_trigly > 1.81) {
		$lipid2 = '<i class="fa fa-arrow-up"></i>';
	}
	else {
		$lipid2 = '';
	} 

	if($chem->lipid_hdl < 1.07){
		$lipid3 = '<i class="fa fa-arrow-down"></i>';
	}
	elseif ($chem->lipid_hdl > 1.89) {
		$lipid3 = '<i class="fa fa-arrow-up"></i>';
	}
	else {
		$lipid3 = '';
	}

	if($chem->lipid_ldl < 0){
		$lipid4 = '<i class="fa fa-arrow-down"></i>';
	}
	elseif ($chem->lipid_ldl > 3.1) {
		$lipid4 = '<i class="fa fa-arrow-up"></i>';
	}
	else {
		$lipid4 = '';
	}

	if($chem->uric_acid < 0.12){
		$uric = '<i class="fa fa-arrow-down"></i>';
	}
	elseif ($chem->uric_acid > 0.43) {
		$uric = '<i class="fa fa-arrow-up"></i>';
	}
	else {
		$uric = '';
	} 

	//Glycated...............................
	if($chem->glycated_hba1c <= 5.6){
		$glycated = "(NORMAL)";
	}
	elseif ($chem->glycated_hba1c <= 6.4) {
		$glycated = "(PREDIABETES)";
	}
	elseif ($chem->glycated_hba1c >= 6.5 ) {
		$glycated = "(DIABETES)";
	}
	else {
		$glycated = '';
	} 

	//Electrolyt
	if($chem->electro_potas < 3.5){
		$electro1 = '<i class="fa fa-arrow-down"></i>';
	}
	elseif ($chem->electro_potas > 5.2) {
		$electro1 = '<i class="fa fa-arrow-up"></i>';
	}
	else {
		$electro1 = '';
	}  

	if($chem->electro_sodium < 136){
		$electro2 = '<i class="fa fa-arrow-down"></i>';
	}
	elseif ($chem->electro_sodium > 145) {
		$electro2 = '<i class="fa fa-arrow-up"></i>';
	}
	else {
		$electro2 = '';
	} 

	if($chem->electro_chloride < 96){
		$electro3 = '<i class="fa fa-arrow-down"></i>';
	}
	elseif ($chem->electro_chloride > 108) {
		$electro3 = '<i class="fa fa-arrow-up"></i>';
	}
	else {
		$electro3 = '';
	}  

	if($chem->electro_ica < 1.1){
		$electro4 = '<i class="fa fa-arrow-down"></i>';
	}
	elseif ($chem->electro_ica > 1.3) {
		$electro4 = '<i class="fa fa-arrow-up"></i>';
	}
	else {
		$electro4 = '';
	} 

	if($chem->electro_tca < 2.1){
		$electro5 = '<i class="fa fa-arrow-down"></i>';
	}
	elseif ($chem->electro_tca > 2.6) {
		$electro5 = '<i class="fa fa-arrow-up"></i>';
	}
	else {
		$electro5 = '';
	} 

	if($chem->electro_ph < 7.0){
		$electro6 = '<i class="fa fa-arrow-down"></i>';
	}
	elseif ($chem->electro_ph > 7.45) {
		$electro6 = '<i class="fa fa-arrow-up"></i>';
	}
	else {
		$electro6 = '';
	}


	if($chem->serum_total < 1.7){
		$serum_total1 = '<i class="fa fa-arrow-down"></i>';
	}
	elseif ($chem->serum_total > 21) {
		$serum_total1 = '<i class="fa fa-arrow-up"></i>';
	}
	else {
		$serum_total1 = '';
	}

	if($chem->serum_direct < 1.7){
		$serum_direct1 = '<i class="fa fa-arrow-down"></i>';
	}
	elseif ($chem->serum_direct > 6.8) {
		$serum_direct1 = '<i class="fa fa-arrow-up"></i>';
	}
	else {
		$serum_direct1 = '';
	}

	if($chem->serum_indirect < 1.7){
		$serum_indirect1 = '<i class="fa fa-arrow-down"></i>';
	}
	elseif ($chem->serum_indirect > 17.0) {
		$serum_indirect1 = '<i class="fa fa-arrow-up"></i>';
	}
	else {
		$serum_indirect1 = '';
	}

//OGTT Graph
$blood_glucose = [0, 0, 0, 0];

$time_mins = [0, 0, 0, 0];

?>

</head>
	
    <body style="margin-left: 0%;" >

        <header id="header">
				<div id="logo"><img src="{{ asset('public/img/logo_banner.jpg') }}" height="96" width="768"> &nbsp;
					<div>
						<b style="float: left; margin-left: 10%; font-size: 17px;">OPD No.: {{ $haema->opd_number }}</b>
						<b style="font-size: 24px;">LABORATORY REPORT</b>
						<b style="float: right; margin-right: 10%; font-size: 17px;">LAB No.: {{ $haema->lab_number }}</b>
					</div>
				</div>
		</header>

<div>
	<div class = "data">
		<table class="table1">
			<tr>
				<td width="200">NAME:</td>
				<td>{{ $haema->name }}</td>
			</tr>
			<tr>
				<td>GENDER:</td>
				<td>{{ $haema->gender }}</td>
			</tr>
			<tr>
				<td>AGE:</td>
				<td>{{ $age }}</td>
			</tr>
			<tr>
				<td>DEPARTMENT:</td>
				<td>{{ $haema->dropdown }}</td>
			</tr>
			<tr>
				<td>DATE:</td>
				<td>{{ $haema->updated_at->format('F j, Y') }}</td>
			</tr>
		</table>
	</div>			
<div id="watermark"></div>
	<div class="data"></div>
	<div class = "data">
		{{-- General Labs --}}
		<table class="results">
			@if ($haema->anti_tpha != '')
				<tr>
					<td width="330">ANTI TPHA/VDRL:</td>
					<td>{{ $haema->anti_tpha }}</td>
				</tr>
			@endif

			@if ($haema->hbsag != '')
				<tr>
					<td width="330">HBsAg:</td>
					<td>{{ $haema->hbsag }}</td>
				</tr>
			@endif

			@if ($haema->hcv != '')
				<tr>
					<td width="330">HCV:</td>
					<td>{{ $haema->hcv }}</td>
				</tr>
			@endif

			@if ($haema->fbs != '')
				<tr>
					<td width="330">{{ $haema->sel_fbs_rbs }}</td>
					<td>{{ $haema->fbs }} mmol/L &nbsp
						@if ($haema->sel_fbs_rbs == 'FBS')
							(3.5 - 6.8 mmol/L)
						@else
							(3.6 - 7.8 mmol/L)
						@endif
					</td>
				</tr>
			@endif

			@if ($haema->blood != '')
				<tr>
					<td width="330">BLOOD GROUP:</td>
					<td>{{ $haema->blood }} &nbsp Rh(D) {{ $haema->blood_rh }}</td>
				</tr>
			@endif

			@if ($haema->g6pd != '')
				<tr>
					<td width="330">G6PD (Methemoglobin Reduction Test):</td>
					<td>{{ $haema->g6pd }}</td>
				</tr>
			@endif

			@if ($haema->urine_hcg != '')
				<tr>
					<td width="330">URINE hCG:</td>
					<td>{{ $haema->urine_hcg }}</td>
				</tr>
			@endif

			@if ($haema->bf != '')
				<tr>
					<td width="330">BF:</td>
					<td>{{ $haema->bf }}</td>
				</tr>
			@endif

			@if ($haema->bf_parasite != '')
				<tr>
					<td width="330">PARASITE DENSITY:</td>
					<td>{{ $haema->bf_parasite }} mps/ul</td>
				</tr>
			@endif

			@if ($haema->esr != '')
				<tr>
					<td width="330">ESR:</td>
					<td>{{ $haema->esr }} mmfall/hr &nbsp
						@if ($haema->gender == 'Male')
							(0 - 15 mmfall/hr)
						@else
							(0 - 20 mmfall/hr)
						@endif
					</td>
				</tr>
			@endif

			@if ($haema->sickling != '')
				<tr>
					<td width="330">SICKLING TEST:</td>
					<td>{{ $haema->sickling }}</td>
				</tr>
			@endif

			@if ($haema->sickling_hb != '')
				<tr>
					<td width="330">Hgb ELECTROPHORESIS (PHENOTYPE):</td>
					<td>{{ $haema->sickling_hb }}</td>
				</tr>
			@endif

			@if ($haema->widal_o != '')
				<tr>
					<td width="330">WIDAL S. Typhi O:</td>
					<td>{{ $haema->widal_o }}</td>
				</tr>
			@endif

			@if ($haema->widal_h != '')
				<tr>
					<td width="330">WIDAL S. Typhi H:</td>
					<td>{{ $haema->widal_h }}</td>
				</tr>
			@endif

			@if ($haema->rdt_pf != '')
				<tr>
					<td width="330">Malaria RDT (Pf):</td>
					<td>{{ $haema->rdt_pf }}</td>
				</tr>
			@endif

			@if ($haema->comment != '')
				<tr>
					<td width="330">GENERAL COMMENT:</td>
					<td>{{ $haema->comment }}</td>
				</tr>
			@endif
		</table>
		{{-- End General Labs --}}

		{{-- FBC TEST --}}
		
		@if ($haema->wbc != '' && $haema->neut != '')
			<table class="tb_fbc">
				<tr><th colspan="5" style="text-align: center; font-size: 20px;">FBC REPORT</th></tr>
				<tr>
					<th>Item</th>
					<th>Results</th>
					<th>Unit</th>
					<th>Limits</th>
					<th>Alert</th>
				</tr>
				<tr>
					<td>WBC</td>
					<td>{{ $haema->wbc }}</td>
					<td>x10<sup>9</sup>/L</td>
					<td>{{ $limt1 }}</td>
					<td><?php echo $wbc1;?></td>
				</tr>
				<tr>
					<td>NEUT#</td>
					<td>{{ $haema->neut }}</td>
					<td>x10<sup>9</sup>/L</td>
					<td>{{ $limt4 }}</td>
					<td><?php echo $neut1;?></td>
				</tr>
				<tr>
					<td>LYM#</td>
					<td>{{ $haema->lym }}</td>
					<td>x10<sup>9</sup>/L</td>
					<td>{{ $limt2 }}</td>
					<td><?php echo $lym1;?></td>
				</tr>
				@if ($haema->mid != '')
					<tr>
						<td>MID#</td>
						<td>{{ $haema->mid }}</td>
						<td>x10<sup>9</sup>/L</td>
						<td>{{ $limt3 }}</td>
						<td><?php echo $mid1;?></td>
					</tr>
				@endif
				@if ($haema->mid == '')
					<tr>
						<td>MONO#</td>
						<td>{{ $haema->mono }}</td>
						<td>x10<sup>3</sup>/uL</td>
						<td>{{ $limt12 }}</td>
						<td><?php echo $mono1;?></td>
					</tr>
					<tr>
						<td>EO#</td>
						<td>{{ $haema->eo }}</td>
						<td>x10<sup>3</sup>/uL</td>
						<td>{{ $limt13 }}</td>
						<td><?php echo $eo1;?></td>
					</tr>
					<tr>
						<td>BASO#</td>
						<td>{{ $haema->baso }}</td>
						<td>x10<sup>3</sup>/uL</td>
						<td>{{ $limt14 }}</td>
						<td><?php echo $baso1;?></td>
					</tr>
				@endif
				<tr>
					<td>RBC</td>
					<td>{{ $haema->rbc }}</td>
					<td>x10<sup>12</sup>/L</td>
					<td>{{ $limt5 }}</td>
					<td><?php echo $rbc1;?></td>
				</tr>
				<tr>
					<td>HGB</td>
					<td>{{ $haema->fbc_hgb }}</td>
					<td>g/dL</td>
					<td>{{ $limt6 }}</td>
					<td><?php echo $fbc_hgb1;?></td>
				</tr>
				<tr>
					<td>HCT</td>
					<td>{{ $haema->hct }}</td>
					<td>%</td>
					<td>{{ $limt7 }}</td>
					<td><?php echo $hct1;?></td>
				</tr>
				<tr>
					<td>MCV</td>
					<td>{{ $haema->mcv }}</td>
					<td>fL</td>
					<td>{{ $limt8 }}</td>
					<td><?php echo $mcv1;?></td>
				</tr>
				<tr>
					<td>MCH</td>
					<td>{{ $haema->mch }}</td>
					<td>pg</td>
					<td>{{ $limt15 }}</td>
					<td><?php echo $mch1;?></td>
				</tr>
				<tr>
					<td>RDW-CV</td>
					<td>{{ $haema->rdw_cv }}</td>
					<td>%</td>
					<td>{{ $limt9 }}</td>
					<td><?php echo $rdw_cv1;?></td>
				</tr>
				<tr>
					<td>PLT</td>
					<td>{{ $haema->plt }}</td>
					<td>x10<sup>9</sup>/L</td>
					<td>{{ $limt10 }}</td>
					<td><?php echo $plt1;?></td>
				</tr>
				<tr>
					<td>MPV</td>
					<td>{{ $haema->mpv }}</td>
					<td>fL</td>
					<td>{{ $limt11 }}</td>
					<td><?php echo $mpv1;?></td>
				</tr>
			</table>	
		@endif
		
		{{-- End FBC TEST --}}

		{{-- URINALYSIS TEST --}}

		@if ($haema->appear != '' && $haema->color != '')
			<table class="tb_fbc">
				<tr><th colspan="4" style="text-align: center; font-size: 20px;">URINALYSIS REPORT</th></tr>
				<tr>
					<td><b>Appearance:</b></td>
					<td>{{ $haema->appear }}</td>
					<td><b>Colour:</b></td>
					<td>{{ $haema->color }}</td>
				</tr>
				<tr>
					<td colspan="4"><b><i>CHEMISTRY</i></b></td>
				</tr>
				<tr>
					<td><b>Blood:</b></td>
					<td>
						@if ($haema->uri_blood == "Positive")
							{{ $haema->uri_blood }} ({{ $haema->blood_factor }})
						@else
							{{ $haema->uri_blood }}
						@endif
					</td>
					<td><b>Bilirubin:</b></td>
					<td>
						@if ($haema->bilirubin == "Positive")
							{{ $haema->bilirubin }} ({{ $haema->bilirubin_factor }})
						@else
							{{ $haema->bilirubin }}
						@endif
					</td>
				</tr>
				<tr>
					<td><b>Urobilnogen:</b></td>
					<td>
						@if ($haema->urobiln == "Increased")
							{{ $haema->urobiln }} ({{ $haema->urobiln_factor }})
						@else
							{{ $haema->urobiln }}	
						@endif
					</td>
					<td><b>Ketone:</b></td>
					<td>
						@if ($haema->ketone == "Positive")
							{{ $haema->ketone }} ({{ $haema->ketone_factor }})
						@else
							{{ $haema->ketone }}
						@endif
					</td>
				</tr>
				<tr>
					<td><b>Glucose:</b></td>
					<td>
						@if ($haema->glucose == "Positive")
							{{ $haema->glucose }} ({{ $haema->glucose_factor }})
						@else
							{{ $haema->glucose }}
						@endif
					</td>
					<td><b>Protein:</b></td>
					<td> 
						@if ($haema->protein == "Positive")
							{{ $haema->protein }} ({{ $haema->protein_factor }})
						@else
							{{ $haema->protein }}
						@endif
					</td>
				</tr>
				<tr>
					<td><b>Nitrite:</b></td>
					<td>{{ $haema->nitrite }}</td>
					<td><b>Leucocytes:</b></td>
					<td>
						@if ($haema->leuco == "Positive")
							{{ $haema->leuco }} ({{ $haema->leuco_factor }})
						@else
							{{ $haema->leuco }}
						@endif
					</td>
				</tr>
				<tr>
					<td><b>pH:</b></td>
					<td>{{ $haema->ph }}</td>
					<td><b>Specific Gravity:</b></td>
					<td>{{ $haema->spec_gra }}</td>
				</tr>
				<tr>
					<td colspan="4"><b><i>MICROSCOPY</i></b></td>
				</tr>
				<tr>
					<td><b>Pus cell:</b></td>
					<td>{{ $haema->pus_cell }} &nbsp /HPF</td>
					<td><b>Epithelial cell:</b></td>
					<td>{{ $haema->epi_cell }} &nbsp /HPF</td>
				</tr>
				<tr>
					<td><b>Red cells:</b></td>
					<td>{{ $haema->red_cell }} &nbsp /HPF</td>
				</tr>
				<tr>
					<td><b>Other:</b></td>
					<td colspan="3">{{ $haema->other }}</td>
				</tr>
			</table>
		@endif

		{{-- End URINALYSIS TEST --}}

		{{-- STOOL --}}

		@if ($haema->macro != '' && $haema->micro != '')
			<table class="tb_fbc">
				<tr><th colspan="2" style="text-align: center; font-size: 20px;">STOOL R/E</th></tr>
				<tr>
					<td width="150">MACROSCOPY: </td>
					<td>{{ $haema->macro }}</td>
				</tr>
				<tr>
					<td width="150">MICROSCOPY: </td>
					<td>{{ $haema->micro }}</td>
				</tr>
			</table>
		@endif

		{{-- End STOOL --}}

		{{-- ART REPORT --}}

		@if ($haema->first_resp != '' || $haema->ora_quick != '' || $haema->sd_bioline != '')
			<table class="tb_fbc">
				<tr><th colspan="2" style="text-align: center; font-size: 20px;">ART REPORT</th></tr>
				<tr>
					<td colspan="2"><b><i>Screening Test</i></b></td>
				</tr>
				@if ($haema->first_resp != '')
					<tr>
						<td>First Response:</td>
						<td>{{ $haema->first_resp }}</td>
					</tr>
				@endif
				@if ($haema->ora_quick != '')
					<tr>
						<td>Ora Quick:</td>
						<td>{{ $haema->ora_quick }}</td>
					</tr>
				@endif
				@if ($haema->sd_bioline != '')
					<tr>
						<td colspan="2"><b><i>Confirmation Test</i></b></td>
					</tr>
					<tr>
						<td>SD Bioline:</td>
						<td>{{ $haema->sd_bioline }}</td>
					</tr>
				@endif
			</table>
		@endif	

		{{-- End ART REPORT --}}

		{{-- COOMBS Test --}}

		@if ($haema->indirect != '' || $haema->direct != '')
			<table class="tb_fbc">
				<tr><th colspan="2" style="text-align: center; font-size: 20px;">COOMB&#x27;S Test</th></tr>
				@if ($haema->indirect != '')
					<tr>
						<td width="400">Indirect Agglutination Test (IAT):</td>
						<td>{{ $haema->indirect }}</td>
					</tr>
				@endif
				@if ($haema->direct != '')
					<tr>
						<td width="400">Direct Agglutination Test (DAT):</td>
						<td>{{ $haema->direct }}</td>
					</tr>
				@endif
			</table>
		@endif

		{{-- End COOMBS Test --}}

		{{-- HEPATITIS B TEST --}}

		@if ($haema->hb_sag != '' && $haema->hb_sab != '')
			<table class="tb_fbc">
				<tr><th colspan="2" style="text-align: center; font-size: 20px;">HEPATITIS B PROFILE REPORT</th></tr>
				<tr>
					<th>Hepatitis B Marker</th>
					<th>Results</th>
				</tr>
				<tr>
					<td>HBsAg</td>
					<td>{{ $haema->hb_sag }}</td>
				</tr>
				<tr>
					<td>HBsAb</td>
					<td>{{ $haema->hb_sab }}</td>
				</tr>
				<tr>
					<td>HBeAg</td>
					<td>{{ $haema->hb_eag }}</td>
				</tr>
				<tr>
					<td>HBeAb</td>
					<td>{{ $haema->hb_eab }}</td>
				</tr>
				<tr>
					<td>HBcAb</td>
					<td>{{ $haema->hb_cab }}</td>
				</tr>
				<tr>
				<td>COMMENT </td>
				<td>{{ $haema->hb_comment }}</td>
				</tr>
			</table>
		@endif

		{{-- End HEPATITIS B TEST --}}

		{{-- Perepheral Film Comment Report --}}

		@if ($haema->per_rbc != '' && $haema->per_wbc != '')
			<table class="tb_fbc">
				<tr><th colspan="2" style="text-align: center; font-size: 20px;">PERIPHERAL FILM COMMENT REPORT</th></tr>
				<tr>
					<td width="150">RBC</td>
					<td>{{ $haema->per_rbc }}</td>
				</tr>
				<tr>
					<td width="150">WBC</td>
					<td>{{ $haema->per_wbc }}</td>
				</tr>
				<tr>
					<td width="150">Platelet</td>
					<td>{{ $haema->per_plt }}</td>
				</tr>
				<tr>
					<td width="150">Impression</td>
					<td>{{ $haema->per_imp }}</td>
				</tr>
			</table>
		@endif

		{{-- End Perepheral Film Comment Report --}}

		{{-- Semen Analysis Report --}}

		@if ($haema->semen_date != '' && $haema->semen_dura != '')
			<table class="tb_fbc">
				<tr><th colspan="4" style="text-align: center; font-size: 20px;">SEMEN ANALYSIS REPORT</th></tr>
				<tr>
					<th colspan="2">ITEM</th>
					<th>RESULTS</th>
					<th>REFERENCE RANGE</th>
				</tr>
				<tr>
					<td colspan="2">Date of Sample</td>
					<td colspan="2">{{ $haema->semen_date }}</td>
				</tr>
				<tr>
					<td colspan="2">Duration of Abstinence</td>
					<td>{{ $haema->semen_dura }} DAY(S)</td>
					<td>2 - 5 Days</td>
				</tr>
				<tr>
					<td colspan="2">Difficulty in Producing Specimen</td>
					<td style="text-transform: uppercase;">{{ $haema->semen_diff }}</td>
					<td style="text-transform: uppercase;">{{ $haema->semen_diff }}</td>
				</tr>
				<tr>
					<td colspan="2">Was all the Sample Collected</td>
					<td style="text-transform: uppercase;">{{ $haema->semen_all }}</td>
					<td style="text-transform: uppercase;">{{ $haema->semen_all }}</td>
				</tr>
				<tr>
					<td colspan="2">Mode of Collection</td>
					<td>{{ $haema->semen_mode }}</td>
				</tr>
				<tr>
					<td colspan="2">Interval between Ejaculation and Start of Analysis (Min)</td>
					<td>{{ $haema->semen_inter }} mins</td>
					<td>Up to 120 mins</td>
				</tr>
				<tr>
					<td colspan="2">Volume (mL)</td>
					<td>{{ $haema->semen_vol }} mL</td>
					<td>&#8805; 2 mL</td>
				</tr>
				<tr>
					<td colspan="2">Appearance</td>
					<td>{{ $haema->semen_appear }}</td>
					<td>Normal</td>
				</tr>
				<tr>
					<td colspan="2">Liquefaction</td>
					<td>Complete within {{ $haema->semen_liquefaction }} mins</td>
					<td>Complete within 60 mins</td>
				</tr>
				<tr>
					<td colspan="2">Viscosity</td>
					<td>{{ $haema->semen_viscosity }}</td>
					<td>Normal</td>
				</tr>
				<tr>
					<td colspan="2">pH</td>
					<td>{{ $haema->semen_ph }}</td>
					<td>7.2 - 8.0</td>
				</tr>
				<tr>
					<td colspan="2"><b><i>MOTILITY (%)</i></b></td>
					<td></td>
					<td>50% or more (a + b)<br>25% or more (a)</td>
				</tr>
				<tr>
					<td>(a)</td>
					<td>Rapid Linear Progression</td>
					<td>{{ $haema->semen_rapid }}%</td>
					<td></td>
				</tr>
				<tr>
					<td>(b)</td>
					<td>None Progressive</td>
					<td>{{ $haema->semen_none }}%</td>
					<td></td>
				</tr>
				<tr>
					<td>(c)</td>
					<td>Immotile</td>
					<td>{{ $haema->semen_imm }}%</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2">VITALITY (%)</td>
					<td>{{ $haema->semen_vital }}%</td>
					<td>&#8805; 50%</td>
				</tr>
				<tr>
					<td colspan="2"><b><i>OTHER CELLS (*10<sup>6</sup>/ml)</i></b></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>&bull;</td>
					<td>WBC</td>
					<td>{{ $haema->semen_wbc }} X 10<sup>6</sup>/ml</td>
					<td>1 X 10<sup>6</sup>/ml</td>
				</tr>
				<tr>
					<td colspan="2"><b><i>CONCENTRATION (10<sup>6</sup>/ml)</i></b></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>&bull;</td>
					<td>Count/ml</td>
					<td>{{ $haema->semen_count }} X 10<sup>6</sup>/ml</td>
					<td>&#8805; 20 * 10<sup>6</sup>/ml</td>
				</tr>
				<tr>
					<td>&bull;</td>
					<td>Total Count in Ejaculation</td>
					<td>{{ $haema->semen_totalc }} X 10<sup>6</sup>/ml</td>
					<td>&#8805; 40 * 10<sup>6</sup>/ml</td>
				</tr>
				<tr>
					<td colspan="2"><b><i>MORPHOLOGY</i></b></td>
					<td></td>
					<td><b><i>&#8805; 15% Normal forms</i></b></td>
				</tr>
				<tr>
					<td>&bull;</td>
					<td>Normal</td>
					<td>{{ $haema->semen_normal }}%</td>
					<td></td>
				</tr>
				<tr>
					<td>&bull;</td>
					<td>Abnormal</td>
					<td>{{ $haema->semen_abn }}%</td>
					<td></td>
				</tr>
				<tr>
					<td>&bull;</td>
					<td>Head Defect</td>
					<td>{{ $haema->semen_head }}%</td>
					<td></td>
				</tr>
				<tr>
					<td>&bull;</td>
					<td>Mid - piece Defect</td>
					<td>{{ $haema->semen_mid }}%</td>
					<td></td>
				</tr>
				<tr>
					<td>&bull;</td>
					<td>Tail</td>
					<td>{{ $haema->semen_tail }}%</td>
					<td></td>
				</tr>
				<tr>
					<td colspan="2">COMMENTS</td>
					<td colspan="2">{{ $haema->semen_comment }}</td>
				</tr>
			</table>
		@endif

		{{-- End Semen Analysis Report --}}

		{{-- OGTT --}}
		
		@if ($haema->oral_glucose != '' && $haema->oral_1hpost != '')
			<table class="tb_fbc">
				<tr><th colspan="2" style="text-align: center; font-size: 20px;">ORAL GLUCOSE TOLERANCE TEST (OGTT)</th></tr>
				<tr>
					<th>TEST ITEM</th>
					<th>RESULTS</th>
				</tr>
				<tr>
					<td colspan = "2" style="text-align: center"><b><i>BLOOD</i></b></td>
				</tr>
				<tr>
					<td>Fasting Blood Glucose</td>
					<td>{{ $haema->oral_glucose }} mmol/l</td>
				</tr>
				<tr>
					<td>60mins Postprandial Glucose</td>
					<td>{{ $haema->oral_1hpost }} mmol/l</td>
				</tr>
				<tr>
					<td>90mins Postprandial Glucose</td>
					<td>{{ $haema->oral_1_30post }} mmol/l</td>
				</tr>
				<tr>
					<td >120mins Postprandial Glucose</td>
					<td>{{ $haema->oral_post }} mmol/l</td>
				</tr>
				<tr>
					<td colspan = "2" style="text-align: center"><b><i>URINE</i></b></td>
				</tr>
				<tr>
					<td>Fasting Urine Glucose</td>
					<td>{{ $haema->oral_glu }}
						@if ($haema->oglu_f != '')
						({{ $haema->oglu_f }})
						@endif
					</td>
				</tr>
				<tr>
					<td>60mins Postprandial Glucose</td>
					<td>{{ $haema->oral_pro }}
						@if ($haema->opro_f != '')
							({{ $haema->opro_f }})
						@endif
					</td>
				</tr>
				<tr>
					<td>120mins Postprandial Glucose</td>
					<td>{{ $haema->oral_ninpro }}
						@if ($haema->opro_ninf != '')
							({{ $haema->opro_ninf }})
						@endif
					</td>
				</tr>
			</table>
			{{-- OGTT Graph --}}
			@if ($haema->fst_min != '' && $haema->snd_min != '')
				<div class="graph" style="width:700px; margin-left: 15%;">
					
					<?php
						$blood_glucose = [(float)$haema->fst_min, (float)$haema->snd_min, (float)$haema->thd_min, (float)$haema->for_min];
						$time_mins = [$haema->time_mins1, $haema->time_mins2, $haema->time_mins3, $haema->time_mins4];	
					?>		
					<div id="chart-container"> </div>
					
				</div>
			@endif
			<table class="tb_fbc">
				<tr>
					<td>COMMENT</td>
					<td>{{ $haema->oral_comment }}</td>
				</tr>
			</table>
		@endif

		{{-- End OGTT --}}

		{{-- Chemistry --}}

		@if ($chem->liver_protein != '' || $chem->renal_urea != '' || $chem->lipid_total != '' || $chem->uric_acid != '' || $chem->glycated_hba1c != '' || $chem->electro_potas != '' || $chem->serum_total != '')
			<table class="tb_fbc">
				<tr><th style="text-align: center; font-size: 22px;">CLINICAL CHEMISTRY TEST</th></tr>
			</table>
		@endif

		{{-- Liver Function test --}}
		
		@if ($chem->liver_protein != '')
			<table class="tb_fbc">
				<tr><th colspan="6" style="text-align: center; font-size: 20px;">LIVER FUNCTION TEST</th></tr>
				<tr>
					<th>Test's Full Name</th>
					<th>Test Item</th>
					<th>Result</th>
					<th>Flag</th>
					<th>Unit</th>
					<th>Reference Range</th>
				</tr>
				<tr>
					<td>TOTAL PROTEIN</td>
					<td>TP</td>
					<td>{{ $chem->liver_protein }}</td>
					<td><?php echo $liver1; ?></td>
					<td>g/l</td>
					<td>60 - 83</td>
				</tr>
				<tr>
					<td>ALBUMIN</td>
					<td>ALB</td>
					<td>{{ $chem->liver_albumin }}</td>
					<td><?php echo $liver2;?></td>
					<td>g/l</td>
					<td>37 - 53</td>
				</tr>
				<tr>
					<td>GLOBULIN</td>
					<td>GLOB</td>
					<td>{{ $chem->liver_globulin }}</td>
					<td><?php echo $liver3;?></td>
					<td>g/l</td>
					<td>20 - 40</td>
				</tr>
				<tr>
					<td>ALKALINE PHOSPATASE</td>
					<td>ALP</td>
					<td>{{ $chem->liver_alkaline }}</td>
					<td><?php echo $liver4;?></td>
					<td>U/L</td>
					<td>40 - 150</td>
				</tr>
				<tr>
					<td>ALANINE AMINOTRANSFERASE</td>
					<td>ALT</td>
					<td>{{ $chem->liver_alanine }}</td>
					<td><?php echo $liver5;?></td>
					<td>U/L</td>
					<td>5 - 40</td>
				</tr>
				<tr>
					<td width="300">ASPARTATE AMINOTRANSFERASE</td>
					<td>AST</td>
					<td>{{ $chem->liver_aspartate }}</td>
					<td><?php echo $liver6;?></td>
					<td>U/L</td>
					<td>0 - 40</td>
				</tr>
				<tr>
					<td>GAMMA GT</td>
					<td>GGT</td>
					<td>{{ $chem->liver_gamma }}</td>
					<td><?php echo $liver7;?></td>
					<td>U/L</td>
					<td>0 - 50</td>
				</tr>
				<tr>
					<td>TOTAL BILIRUBIM</td>
					<td>T BIL</td>
					<td>{{ $chem->liver_total }}</td>
					<td><?php echo $liver8;?></td>
					<td>&mu;mol/l</td>
					<td>1.7 - 21</td>
				</tr>
				<tr>
					<td>DIRECT BILIRUBIM</td>
					<td>D BIL</td>
					<td>{{ $chem->liver_direct }}</td>
					<td><?php echo $liver9;?></td>
					<td>&mu;mol/l</td>
					<td>1.7 - 6.8</td>
				</tr>
				<tr>
					<td>INDIRECT BILIRUBIM</td>
					<td>I BIL</td>
					<td>{{ $chem->liver_indirect }}</td>
					<td><?php echo $liver10;?></td>
					<td>&mu;mol/l</td>
					<td>1.7 - 17.0</td>
				</tr>
				<tr>
					<td>COMMENT</td>
					<td colspan="5">{{ $chem->liver_comment }}</td>
				</tr>
			</table>	
		@endif
		
		{{-- End Liver Function test --}}

		{{-- Renal Function test --}}
		
		@if ($chem->renal_urea != '')
			<table class="tb_fbc">
				<tr><th colspan="6" style="text-align: center; font-size: 20px;">RENAL FUNCTION TEST</th></tr>
				<tr>
					<th>Test's Full Name</th>
					<th>Test Item</th>
					<th>Result</th>
					<th>Flag</th>
					<th>Unit</th>
					<th>Reference Range</th>
				</tr>
				<tr>
					<td>UREA</td>
					<td>BUN</td>
					<td>{{ $chem->renal_urea }}</td>
					<td><?php echo $renal1;?></td>
					<td>mmol/l</td>
					<td>2.82 - 8.2</td>
				</tr>
				<tr>
					<td>CREATININE</td>
					<td>CRE</td>
					<td>{{ $chem->renal_creatinine }}</td>
					<td><?php echo $renal2;?></td>
					<td>mmol/l</td>
					<td>53 - 115</td>
				</tr>
				<tr>
					<td>COMMENT</td>
					<td colspan="5">{{ $chem->renal_comment }}</td>
				</tr>
			</table>	
		@endif
		
		{{-- End Renal Function test --}}

		{{-- Lipid Profile test --}}
		
		@if ($chem->lipid_total != '')
			<table class="tb_fbc">
				<tr><th colspan="6" style="text-align: center; font-size: 20px;">LIPID PROFILE</th></tr>
				<tr>
					<th>Test's Full Name</th>
					<th>Test Item</th>
					<th>Result</th>
					<th>Flag</th>
					<th>Unit</th>
					<th>Reference Range</th>
				</tr>
				<tr>
					<td>TOTAL CHOLESTEROL</td>
					<td>TC</td>
					<td>{{ $chem->lipid_total }}</td>
					<td><?php echo $lipid1;?></td>
					<td>mmol/l</td>
					<td>3.1 - 6.1</td>
				</tr>
				<tr>
					<td>TRIGLYCERIDE</td>
					<td>TG</td>
					<td>{{ $chem->lipid_trigly }}</td>
					<td><?php echo $lipid2;?></td>
					<td>mmol/l</td>
					<td>0.4 - 1.81</td>
				</tr>
				<tr>
					<td>HDL-CHOLESTEROL</td>
					<td>HDL-C</td>
					<td>{{ $chem->lipid_hdl }}</td>
					<td><?php echo $lipid3;?></td>
					<td>mmol/l</td>
					<td>1.07 - 1.89</td>
				</tr>
				<tr>
					<td>LDL-CHOLESTEROL</td>
					<td>LDL-C</td>
					<td>{{ $chem->lipid_ldl }}</td>
					<td><?php echo $lipid4;?></td>
					<td>mmol/l</td>
					<td>0 - 3.1</td>
				</tr>
				<tr>
					<td>COMMENT</td>
					<td colspan="5">{{ $chem->lipid_comment }}</td>
				</tr>
			</table>	
		@endif
		
		{{-- End Lipid Profile test --}}

		{{-- Uric Acid test --}}

		@if ($chem->uric_acid != '')
			<table class="tb_fbc">
				<tr><th colspan="6" style="text-align: center; font-size: 20px;">URIC ACID</th></tr>
				<tr>
					<th>Test's Full Name</th>
					<th>Test Item</th>
					<th>Result</th>
					<th>Flag</th>
					<th>Unit</th>
					<th>Reference Range</th>
				</tr>
				<tr>
					<td>URIC ACID</td>
					<td>UA</td>
					<td>{{ $chem->uric_acid }}</td>
					<td><?php echo $uric;?></td>
					<td>mmol/l</td>
					<td>0.12 - 0.43</td>
				</tr>
				<tr>
					<td>COMMENT</td>
					<td colspan="5">{{ $chem->uric_comment }}</td>
				</tr>
			</table>	
		@endif

		{{-- End Uric Acid test --}}

		{{-- Glycated Hemoglobin Report --}}

		@if ($chem->glycated_hba1c != '')
			<table class="tb_fbc">
				<tr><th colspan="6" style="text-align: center; font-size: 20px;">GLYCATED HEMOGLOBIN (HbA1c) REPORT</th></tr>
				<tr>
					<td>HbA1c</td>
					<td></td>
					<td>{{ $chem->glycated_hba1c }} %</td>
					<td><?php echo $glycated?></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>COMMENT</td>
					<td colspan="5">{{ $chem->glycated_comment }}</td>
				</tr>
				<tr>
					<td colspan="6"><b>REFERENCE</b></td>
				</tr>
				<tr>
					<td colspan="6"><i>NORMAL - 4.0% - 5.6%</i></td>
				</tr>
				<tr>
					<td colspan="6"><i>PREDIABETES - 5.7% - 6.4%</i></td>
				</tr>
				<tr>
					<td colspan="6"><i>DIABETES - 6.5%</i></td>
				</tr>
			</table>	
		@endif

		{{-- End Glycated Hemoglobin Report --}}

		{{-- Electrolytes test --}}

		@if ($chem->electro_potas != '')
			<table class="tb_fbc">
				<tr><th colspan="6" style="text-align: center; font-size: 20px;">ELECTROLYTES</th></tr>
				<tr>
					<th>Test's Full Name</th>
					<th>Test Item</th>
					<th>Result</th>
					<th>Flag</th>
					<th>Unit</th>
					<th>Reference Range</th>
				</tr>
				<tr>
					<td>POTASSIUM</td>
					<td>K<sup>+</sup></td>
					<td>{{ $chem->electro_potas }}</td>
					<td><?php echo $electro1;?></td>
					<td>mmol/l</td>
					<td>3.5 - 5.2</td>
				</tr>
				<tr>
					<td>SODIUM</td>
					<td>Na<sup>+</sup></td>
					<td>{{ $chem->electro_sodium }}</td>
					<td><?php echo $electro2;?></td>
					<td>mmol/l</td>
					<td>136 - 145</td>
				</tr>
				<tr>
					<td>CHLORIDE</td>
					<td>Cl<sup>-</sup></td>
					<td>{{ $chem->electro_chloride }}</td>
					<td><?php echo $electro3;?></td>
					<td>mmol/l</td>
					<td>96 -108</td>
				</tr>
				<tr>
					<td>COMPLEXED CALCIUM</td>
					<td>iCa</td>
					<td>{{ $chem->electro_cca }}</td>
					<td></td>
					<td>mmol/l</td>
					<td></td>
				</tr>
				<tr>
					<td>IONIZED CALCIUM</td>
					<td>nCa</td>
					<td>{{ $chem->electro_ica }}</td>
					<td><?php echo $electro4;?></td>
					<td>mmol/l</td>
					<td>1.1 - 1.3</td>
				</tr>
				<tr>
					<td>TOTAL CALCIUM</td>
					<td>TCa</td>
					<td>{{ $chem->electro_tca }}</td>
					<td><?php echo $electro5;?></td>
					<td>mmol/l</td>
					<td>2.1 - 2.6</td>
				</tr>
				<tr>
					<td>PH</td>
					<td>pH</td>
					<td>{{ $chem->electro_ph }}</td>
					<td><?php echo $electro6;?></td>
					<td></td>
					<td>7.0 - 7.45</td>
				</tr>
				<tr>
					<td>COMMENT</td>
					<td colspan="5">{{ $chem->electro_comment }}</td>
				</tr>
			</table>
		@endif

		{{-- End Electrolytes test --}}

		{{-- Serum Bilirubin test --}}

		@if ($chem->serum_total != '')
			<table class="tb_fbc">
				<tr><th colspan="6" style="text-align: center; font-size: 20px;">SERUM BILIRUBIN TEST</th></tr>
				<tr>
					<th>Test's Full Name</th>
					<th>Test Item</th>
					<th>Result</th>
					<th>Flag</th>
					<th>Unit</th>
					<th>Reference Range</th>
				</tr>
				<tr>
					<td>TOTAL BILIRUBIN</td>
					<td>T BIL</td>
					<td>{{ $chem->serum_total }}</td>
					<td><?php echo $serum_total1;?></td>
					<td>&mu;mol/l</td>
					<td>1.7 - 21</td>
				</tr>
				<tr>
					<td>DIRECT BILIRUBIN</td>
					<td>D BIL</td>
					<td>{{ $chem->serum_direct }}</td>
					<td><?php echo $serum_direct1;?></td>
					<td>&mu;mol/l</td>
					<td>1.7 - 6.8</td>
				</tr>
				<tr>
					<td>INDIRECT BILIRUBIN</td>
					<td>I BIL</td>
					<td>{{ $chem->serum_indirect }}</td>
					<td><?php echo $serum_indirect1;?></td>
					<td>&mu;mol/l</td>
					<td>1.7 - 17.0</td>
				</tr>
				<tr>
					<td>COMMENT</td>
					<td colspan="5">{{ $chem->serum_comment }}</td>
				</tr>
			</table>
		@endif

		{{-- End Serum Bilirubin test --}}

		{{-- End Chemistry --}}

		{{-- Microbiology --}}

		@if ($micro->vaginal_epith != '' || $micro->pleural_appear != '' || $micro->peritoneal_appear != '' || $micro->csf_appear != '' || $micro->bacter_specimen != '')
			<table class="tb_fbc">
				<tr><th style="text-align: center; font-size: 22px;">MICROBIOLOGY</th></tr>
			</table>
		@endif

		{{-- High Vaginal Swab test --}}
		@if ($micro->vaginal_epith != '')
			<table class="tb_fbc">
				<tr><th colspan="4" style="text-align: center; font-size: 20px;">HIGH VAGINAL SWAB R/E REPORT</th></tr>
				<tr>
					<td><b>Epithelial Cells</b></td>
					<td>{{ $micro->vaginal_epith }} /HPF</td>
					<td><b>Pus Cells</b></td>
					<td>{{ $micro->vaginal_pus }} /HPF</td>
				</tr>
				<tr>
					<td><b>Red Cells</b></td>
					<td>{{ $micro->vaginal_red }} /HPF</td>
					<td><b>Clue Cells</b></td>
					<td>{{ $micro->vaginal_clue }} /HPF</td>
				</tr>
				<tr>
					<td><b>Whiff Test</b></td>
					<td>{{ $micro->vaginal_whiff }}</td>
					<td><b>KOH</b></td>
					<td>{{ $micro->vaginal_koh }}</td>
				</tr>
				<tr>
					<td><b>Trichomonas Vaginalis</b></td>
					<td>{{ $micro->vaginal_tricho }} /HPF</td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>Gram</td>
					<td colspan="3">{{ $micro->vaginal_gram }}</td>
				</tr>
				<tr>
					<td>Others</td>
					<td colspan="3">{{ $micro->vaginal_others }}</td>
				</tr>
			</table>
		@endif

		{{-- End High Vaginal Swab test --}}

		{{-- Pleural Fluid test --}}

		@if ($micro->pleural_appear != '')
			<table class="tb_fbc">
				<tr><th colspan="3" style="text-align: center; font-size: 20px;">PLEURAL FLUID REPORT</th></tr>
				<tr>
					<td><b><i>MACROSCOPY</i></b></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td><b>Appearance</b></td>
					<td>{{ $micro->pleural_appear }}</td>
					<td></td>
				</tr>
				<tr>
					<td><b>Colour</b></td>
					<td>{{ $micro->pleural_color }}</td>
					<td></td>
				</tr>
				<tr>
					<td><b>pH</b></td>
					<td>{{ $micro->pleural_ph }}</td>
					<td><b>(7.4 - 7.6)</b></td>
				</tr>
				<tr>
					<td><b>Specific Gravity</b></td>
					<td>{{ $micro->pleural_spec }}</td>
					<td><b>(< 1.016)</b></td>
					<td></td>
				</tr>
				<tr>
					<td><b><i>BIOCHEMISTRY</i></b></td>
					<td></td>
					<td><b><i>NORMAL RANGE</i></b></td>
				</tr>
				<tr>
					<td><b>Protein</b></td>
					<td>{{ $micro->pleural_protein }} g/l</td>
					<td><b>(< 30g/l)</b></td>
				</tr>
				<tr>
					<td><b>Glucose</b></td>
					<td>{{ $micro->pleural_glucose }} mmol/L</td>
					<td><b>(1.7 - 2.8mmol/L)</b></td>
				</tr>
				<tr>
					<td><b>Total Cholesterol</b></td>
					<td>{{ $micro->pleural_total }} mmol/L</td>
					<td><b>(2.5 - 3.3mmol/L)</b></td>
				</tr>
				<tr>
					<td><b><i>MICROSCOPY</i></b></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td><b>Cell Count</b></td>
					<td>{{ $micro->pleural_count }} Cells/L</td>
					<td><b>Cell Type:</b> &nbsp {{ $micro->pleural_type }}</td>
				</tr>
				<tr>
					<td><b>Gram Reaction</b></td>
					<td>{{ $micro->pleural_gram }}</td>
					<td></td>
				</tr>
				<tr>
					<td><b>Culture</b></td>
					<td>{{ $micro->pleural_culture }}</td>
					<td></td>
				</tr>
				<tr>
					<td>COMMENT</td>
					<td colspan="2">{{ $micro->pleural_comment }}</td>
				</tr>
			</table>
		@endif

		{{-- End Pleural Fluid test --}}

		{{-- Peritoneal Fluid test --}}
		
		@if ($micro->peritoneal_appear != '')
			<table class="tb_fbc">
				<tr><th colspan="3" style="text-align: center; font-size: 20px;">PERITONEAL FLUID REPORT</th></tr>
				<tr>
					<td><b><i>MACROSCOPY</i></b></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td><b>Appearance</b></td>
					<td>{{ $micro->peritoneal_appear }}</td>
					<td></td>
				</tr>
				<tr>
					<td><b>Colour</b></td>
					<td>{{ $micro->peritoneal_color }}</td>
					<td></td>
				</tr>
				<tr>
					<td><b>Specific Gravity</b></td>
					<td>{{ $micro->peritoneal_spec }}</td>
					<td><b>(< 1.016)</b></td>
				</tr>
				<tr>
					<td><b><i>BIOCHEMISTRY</i></b></td>
					<td></td>
					<td><b><i>NORMAL RANGE</i></b></td>
				</tr>
				<tr>
					<td><b>Protein</b></td>
					<td>{{ $micro->peritoneal_protein }} g/dl</td>
					<td><b>(1 - 2g/dl)</b></td>
				</tr>
				<tr>
					<td><b>Albumin</b></td>
					<td>{{ $micro->peritoneal_albumin }} g/l</td>
					<td><b>(1.0 - 2.1g/l)</b></td>
				</tr>
				<tr>
					<td><b>Glucose</b></td>
					<td>{{ $micro->peritoneal_glucose }} mmol/L</td>
					<td><b>(1.7 - 2.8mmol/L)</b></td>
				</tr>
				<tr>
					<td><b>Alkaline Phosphatase</b></td>
					<td>{{ $micro->peritoneal_alkaline }} U/L</td>
					<td><b>U/L</b></td>
				</tr>
				<tr>
					<td><b>Amylase</b></td>
					<td>{{ $micro->peritoneal_amylase }} U/L</td>
					<td><b>U/L</b></td>
				</tr>
				<tr>
					<td><b><i>MICROSCOPY</i></b></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td><b>Cell Count:</b></td>
					<td>{{ $micro->peritoneal_count }} Cells/L</td>
					<td><b>Cell Type:</b> &nbsp {{ $micro->peritoneal_type }}</td>
				</tr>
				<tr>
					<td><b>Gram Reaction</b></td>
					<td>{{ $micro->peritoneal_gram }}</td>
					<td></td>
				</tr>
				<tr>
					<td>COMMENT</td>
					<td colspan="2">{{ $micro->peritoneal_comment }}</td>
				</tr>
			</table>
		@endif

		{{-- End Peritoneal Fluid test --}}

		{{-- Cerebrospinal Fluid test --}}

		@if ($micro->csf_appear != '')
			<table class="tb_fbc">
				<tr><th colspan="3" style="text-align: center; font-size: 20px;">CEREBROSPINAL (CSF) FLUID REPORT</th></tr>
				<tr>
					<td><b><i>MACROSCOPY</i></b></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td><b>Appearance</b></td>
					<td>{{ $micro->csf_appear }}</td>
					<td></td>
				</tr>
				<tr>
					<td><b>Colour</b></td>
					<td>{{ $micro->csf_color }}</td>
					<td></td>
				</tr>
				<tr>
					<td><b><i>BIOCHEMISTRY</i></b></td>
					<td></td>
					<td><b><i>NORMAL RANGE</i></b></td>
				</tr>
				<tr>
					<td><b>Protein:</b></td>
					<td>{{ $micro->csf_protein }} g/dl</td>
					<td><b>(0.15 - 0.4g/L) (&#8804; 1.0g/L for neonates)</b></td>
				</tr>
				<tr>
					<td><b>Glucose:</b></td>
					<td>{{ $micro->csf_glucose }} mmol/L</td>
					<td><b>(2.5 - 4.0mmol/L)</b></td>
				</tr>
				<tr>
					<td><b>Globulin:</b></td>
					<td>{{ $micro->csf_globulin }} U/L</td>
					<td><b>(Positive or Negative by Pandy's Test)</b></td>
				</tr>
				<tr>
					<td><b><i>MICROSCOPY</i></b></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td><b>Cell Count:</b></td>
					<td>{{ $micro->csf_count }} Cells/L</td>
					<td><b>Cell Type:</b> &nbsp {{ $micro->csf_type }}</td>
				</tr>
				<tr>
					<td><b>Gram Reaction:</b></td>
					<td>{{ $micro->csf_gram }}</td>
					<td></td>
				</tr>
				<tr>
					<td>COMMENT</td>
					<td colspan="2">{{ $micro->csf_comment }}</td>
				</tr>
			</table>
		@endif

		{{-- End Cerebrospinal Fluid test --}}

		{{-- Bacteriology test --}}
		
		@if ($micro->bacter_specimen != '')
			<table class="tb_fbc">
				<tr><th colspan="3" style="text-align: center; font-size: 20px;">BACTERIOLOGY RESULTS</th></tr>
				<tr>
					<td><b>TYPE OF SPECIMEN</b></td>
					<td colspan="2" style="text-transform: uppercase;">{{ $micro->bacter_specimen }}</td>
				</tr>
				<tr>
					<td style="text-transform: uppercase;"><b>{{ $micro->bacter_growth }}</b></td>
					<td colspan="2" style="padding-bottom: 15px;">{{ $micro->bacter_type1 }} &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;{{ $micro->bacter_type2 }}</td>
				</tr>
				<tr>
					<th colspan="3" style="text-align: center;"><i>SENSITIVITY</i></th>
				</tr>
				<tr>
					<td><b>ANTIBIOTICS</b></td>
					<td><b>REACTION</b></td>
					<td><b>ZONE OF INHIBITION</b></td>
				</tr>
				<tr style="text-transform: uppercase;">
					<td>{{ $micro->bacter_anti1 }}</td>
					<td>{{ $micro->bacter_react1 }}</td>
					<td>{{ $micro->bacter_zone1 }}</td>
				</tr>
				<tr style="text-transform: uppercase;">
					<td>{{ $micro->bacter_anti2 }}</td>
					<td>{{ $micro->bacter_react2 }}</td>
					<td>{{ $micro->bacter_zone2 }}</td>
				</tr>
				<tr style="text-transform: uppercase;">
					<td>{{ $micro->bacter_anti3 }}</td>
					<td>{{ $micro->bacter_react3 }}</td>
					<td>{{ $micro->bacter_zone3 }}</td>
				</tr>
				<tr style="text-transform: uppercase;">
					<td>{{ $micro->bacter_anti4 }}</td>
					<td>{{ $micro->bacter_react4 }}</td>
					<td>{{ $micro->bacter_zone4 }}</td>
				</tr>
				<tr style="text-transform: uppercase;">
					<td>{{ $micro->bacter_anti5 }}</td>
					<td>{{ $micro->bacter_react5 }}</td>
					<td>{{ $micro->bacter_zone5 }}</td>
				</tr>
				<tr style="text-transform: uppercase;">
					<td>{{ $micro->bacter_anti6 }}</td>
					<td>{{ $micro->bacter_react6 }}</td>
					<td>{{ $micro->bacter_zone6 }}</td>
				</tr>
				<tr style="text-transform: uppercase;">
					<td>{{ $micro->bacter_anti7 }}</td>
					<td>{{ $micro->bacter_react7 }}</td>
					<td>{{ $micro->bacter_zone7 }}</td>
				</tr>
				<tr style="text-transform: uppercase;">
					<td>{{ $micro->bacter_anti8 }}</td>
					<td>{{ $micro->bacter_react8 }}</td>
					<td>{{ $micro->bacter_zone8 }}</td>
				</tr>
				<tr style="text-transform: uppercase;">
					<td>{{ $micro->bacter_anti9 }}</td>
					<td>{{ $micro->bacter_react9 }}</td>
					<td>{{ $micro->bacter_zone9 }}</td>
				</tr>
				<tr style="text-transform: uppercase;">
					<td>{{ $micro->bacter_anti10 }}</td>
					<td>{{ $micro->bacter_react10 }}</td>
					<td>{{ $micro->bacter_zone10 }}</td>
				</tr>
				<tr style="text-transform: uppercase;">
					<td>{{ $micro->bacter_anti11 }}</td>
					<td>{{ $micro->bacter_react11 }}</td>
					<td>{{ $micro->bacter_zone11 }}</td>
				</tr>
				<tr style="text-transform: uppercase;">
					<td>{{ $micro->bacter_anti12 }}</td>
					<td>{{ $micro->bacter_react12 }}</td>
					<td>{{ $micro->bacter_zone12 }}</td>
				</tr>
				<tr>
					<td>COMMENT</td>
					<td colspan="2">{{ $micro->becter_comment }}</td>
				</tr>
			</table>
		@endif

		{{-- End Bacteriology test --}}

		{{-- End Microbiology --}}

		{{-- PSA --}}

		@if ($haema->psa != '')
			<table class="tb_fbc">
				<tr><th colspan="3" style="text-align: center; font-size: 20px;">PROSTATE SPECIFIC ANTIGEN (PSA)<br>SEMI-QUANTITATIVE REPORT</th></tr>
				<tr>
					<td><b>{{ $haema->psa }}</b></td>
					<td>
						@if ($haema->psa == 'Positive')
							{{ $haema->psa_positive }}
						@elseif ($haema->psa == 'Negative')
							{{ $haema->psa_negative; }}
						@endif
					</td>
				</tr>
				<tr>
					<td>COMMENT</td>
					<td>{{ $haema->psa_comment }}</td>
				</tr>
			</table>
		@endif

		{{-- End PSA --}}

		{{-- H-pylori Qualitative Test --}}

		@if ($haema->pylori_qual != '')
			<table class="tb_fbc">
				<tr><th colspan="3" style="text-align: center; font-size: 20px; text-transform: uppercase;">H-pylori Qualitative Test Report</th></tr>
				<tr>
					<td><b>H-pylori Qualitative</b></td>
					<td>{{ $haema->pylori_qual }}</td>
				</tr>
				<tr>
					<td>COMMENT</td>
					<td>{{ $haema->pylori_comment }}</td>
				</tr>
			</table>
		@endif

		{{-- End H-pylori Qualitative Test --}}

	</div>

	{{-- Labs Footer --}}
	<div class = "sign">
		<div id="tim">
			<?php echo date('d/m/Y');?> &nbsp <label id="demo"></label>

			<script type="text/javascript">
				var d = new Date();
			    var n = d.toLocaleTimeString();
			    document.getElementById("demo").innerHTML = n;
			</script>
		</div>
		<div class="receipt" id="sig"><b>SIGN:</b> {{ $haema->user->name }} </div>
	</div>

	<div id="myheader_opd">OPD Number: {{ $haema->opd_number }}</div>
	<div id="myheader_lab">Lab Number: {{ $haema->lab_number }}</div>

	@if ((Session::get('user')['user_level'] === 'Admin') || (Session::get('user')['user_level'] === 'User'))
		<button class="noprint btn-primary" onclick="print_1()"><i class="fa fa-print"></i> Print...</button>
	@endif

</div>

{{-- Javascript graph --}}

<script src="{{ asset('public/js/highcharts.js') }}"></script>

<script>
	var datas = <?php echo json_encode($blood_glucose) ?>

	var time = <?php echo json_encode($time_mins) ?>

	Highcharts.chart('chart-container', {
		title: {
			text: 'Oral Glucose Tolerance Curve'
		},
		subtitle: {
			text: 'Source: SJGH Lab'
		},
		xAxis: {
			title: {
				text: 'Time (mins)'
			},
			categories: time
		},
		yAxis:{
			title: {
				text: 'Blood Glucose (mmol/l)'
			}
		},
		legend: {
			layout: 'vertical',
			align: 'right',
			verticalAlign: 'middle'
		},
		plotOptions: {
			series: {
				allowPointSelect:true
			}
		},
		series: [{
			name: 'Blood Glucose',
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
	})
</script>
		
</body>
</html>




