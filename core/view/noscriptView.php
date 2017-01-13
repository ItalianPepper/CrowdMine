<!DOCTYPE html>
<html lang="en">
<head>
	<title>CrowdMine</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="<?php echo STYLE_DIR; ?>bootstrap\css\bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\vendor.css">
	<link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\flat-admin.css">
	<link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\rating.css">


	<!-- Theme -->
	<link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\theme\blue-sky.css">
	<link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\theme\blue.css">
	<link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\theme\red.css">
	<link rel="stylesheet" type="text/css" href="<?php echo STYLE_DIR; ?>assets\css\theme\yellow.css">

	<!-- iCheck -->
	<link href="<?php echo STYLE_DIR; ?>plugins/toastr/toastr.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?php echo STYLE_DIR; ?>plugins/iCheck/all.css">

	<style>
		.form-box input {
			width: 100%;
		}

		.form-box {
			max-width: 400px;
			margin-top: 30px;
			margin-left: auto;
			margin-right: auto;
		}

		.form-box .form-line {
			width: 100%;
			position: relative;
			text-align: center;
			font-size: 0.9em;
			z-index: 2;
			margin-top: 20px;
			margin-bottom: 20px;
			color: #8d9293;
		}

		.form-box .form-line:after {
			content: '';
			position: absolute;
			width: 50%;
			bottom: 50%;
			left: 50%;
			transform: translate(-50%, 0);
			z-index: 1;
			border-bottom: 1px solid #dfe6e8;
		}

		.form-box .form-line .title {
			background-color: #FFF;
			position: relative;
			z-index: 2;
			width: 64px;
			margin: 0 auto;
		}

		.form-box-head {
			padding: 5px;
			margin-bottom: -5px;
		}

		.form-box.alert-box .card {
			color: #d73727;
			border-color: #f3b1ab;
			background-color: #fdc3bd;
			border-radius: 3px;
			border-width: 1px;
			border-style: solid;
		}

		.form-box.alert-box .form-line .title {
			color: #d73727;
			background-color: #fdc3bd;
		}

		.form-box.alert-box .form-line:after {
			content: '';
			position: absolute;
			width: 50%;
			bottom: 50%;
			left: 50%;
			transform: translate(-50%, 0);
			z-index: 1;
			border-bottom: 1px solid #f3b1ab;
		}

		.form-box.alert-box textarea {
			background: white;
		}

		body {
			overflow:hidden;
		}
	</style>

</head>

<body>
<div class="app app-default" style="position: fixed; top: 0px; left: 0px; z-index: 3000;
                height: 100%; width: 100%; background-color: #e7edee">
	<div class="row" style="margin-top: 10%">
		<div class="form-box">
			<div class="card text-center">
				<div class="form-box-head">
					<h2><i class="fa fa-warning"></i> Javascript disbilitato!</h2>
				</div>
				<div class="card-body">
					<div align="center" style="text-align:center">
						<p><strong>Ci scusiamo per il disagio ma se vuoi restare sul nostro sito per favore abilita javascript!</strong></p>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>

</div>
</body>
</html>