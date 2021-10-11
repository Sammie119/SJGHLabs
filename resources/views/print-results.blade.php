<!DOCTYPE>
 <html>
	 <!-- Javascripts -->
	 <link href={{ asset("public/css/bootstrap.min.css")}} rel='stylesheet'>
	 <script src={{ asset("public/js/jquery-3.6.0.min.js") }}></script>
	 <script src={{ asset('public/js/bootstrap.min.js') }}></script>
	 <link rel="stylesheet" href={{ asset('public/font-awesome/css/font-awesome.min.css') }}>

 	<title>SJGH-Laboratory Report</title>
 		 
	<style type="text/css">
		
		img{
			margin-right: 0%;
		}

		#logo{
			margin-left: 0%;
			text-align: center;
			border-bottom: 2px solid;
		}

		.receiptNo{
			margin-left: 0%;
			padding: 0px;
			margin-top: 10px;
			font-weight: bold;
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
		}

		label {
			text-transform: uppercase;
		}
		/* button {
			float: right;
			padding-top: 10px;
			padding-bottom: 10px;
			padding-right: 20px;
			padding-left: 20px;
			font-weight: bolder;
			border: solid 1px;
			border-radius: 20px;
			position: relative;
		} */
		
		 @media print {
			.noprint{
				visibility: hidden;
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

	</style>

	<script type="text/javascript">
		function print_1(){
			window.print();
			window.close();
		}
	</script>

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
				<td>{{ $haema->age }}</td>
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
		<table class="table">
			<tr>
				<td>ANTI TPHA/VDRL:</td>
				<td>{{ $haema->anti_tpha }}</td>
			</tr>
		</table>
	</div>

</div>
		
</body>
</html>




