<!DOCTYPE>
 <html>

 		<title>SJGH-Laboratory Report</title>
 		 

	<style type="text/css">
		body{

			background-image: url("public/img/water.png");
			background-repeat: no-repeat;
			background-position: 50% 50%;
		} */
		

		/* img{
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
			margin-left: 20%;
			margin-right: 10%;
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
		}



		/* @media print {
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
*/
		#watermark{
			margin-left: 12%;
			opacity: 0.5;
		    position: fixed;
		    background-image: url("../img/watermark2.png");
		    width: 80%;
		    height: 110%;
		    bottom: 5%;
		    background-repeat: no-repeat;
			background-position: center;
		}/* ../img/water.png */

		


	</style>

	<script type="text/javascript">
		function print_1(){
			window.print();
			window.close();
		}
	</script>

</head>
	
    <body style="width: 80%; margin-left: 0%;" >

        <header id="header">
				<div id="logo"><img src="{{ asset('public/img/logo_banner.jpg') }}" height="96" width="768"> &nbsp;
				<div>
					<b style="float: left; margin-left: 10%; font-size: 17px;">OPD No.: <?php //echo $opd_number;?></b>
					<b style="font-size: 24px;">LABORATORY REPORT</b>
					<b style="float: right; margin-right: 10%; font-size: 17px;">LAB No.: <?php //echo $lab_number;?></b>
				</div>
					
				</div>

				
				<div style="clear: both;"></div>
		</header>

<div>
	<div class = "data">
		<div class="receiptNo">NAME: <label style="margin-left: 100px;"><?php //echo $full_name; ?></label></div>
		<div class="receiptNo">GENDER: <label style="margin-left: 78px;"><?php //echo $gender; ?></label></div>
		<div class="receiptNo">AGE: <label style="margin-left: 115px;"><?php //echo $age; ?></label></div>
		<div class="receiptNo">DEPARTMENT: <label style="margin-left: 30px;"><?php //echo $department; ?></label></div>
		<div class="receiptNo">DATE: <label style="margin-left: 105px;"><?php //echo $stamp_date; ?></label></div>
	</div>
			
<div id="watermark"></div>
	<div class = "data">
		
    </body>
</html>




