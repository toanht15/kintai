<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<?php if (extension_loaded ('newrelic')) {
	echo newrelic_get_browser_timing_header();
	} ?>
<!--	<link rel="shortcut icon" href="/ico/favicon.ico" />-->
<link rel="stylesheet"
	href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<link href="/lib/bootstrap/css/bootstrap-min-ex.css" rel="stylesheet"
	media="screen">
<link href="/lib/bootstrap/css/bootstrap-337.min.css" rel="stylesheet"
	media="screen">
<link rel="stylesheet" type="text/css"
	href="http://yui.yahooapis.com/3.13.0/build/cssreset/cssreset-min.css">
<link rel="stylesheet" href="/css/src/style.css">
<link rel="shortcut icon"
	href="https://gizi.aa-dev.com/sites/default/files/favicon.ico"
	type="image/x-icon" />
<script type="text/javascript" src="/js/src/html5shiv-printshiv.js"></script>
<script
	src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="/js/src/unit.js"></script>
<link href="/css/dest/all-min.css" rel="stylesheet">
<title>kintaiシステム</title>
</head>
<body>
	<header class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="wrap cf">
				<a class="brand" href="/index">ETMS</a>
				<!-- /.wrap -->
			</div>
		</div>
	</header>

	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<a class="navbar-brand" href="/index">ETMS</a>
			<ul class="nav navbar-nav pull-right">
				<li class="active">
					<a href="/index">Home</a>
				</li>
				<?php if(isset($_SESSION['login_id']) ): ?>
				<li>
					<a href="/report/index">All Report</a>
				</li>
				<li>
					<a href="#">Link</a>
				</li>
				<li>
					<a href="/user/logout">Logout</a>
				</li>
			<?php else: ?>
				<li><a href="/user/login">Login</a></li>
			<?php endif; ?>
			</ul>
		</div>
	</nav>

	<div class="wrap cf" id="wrap">
		<div style="margin-top: 20px;">