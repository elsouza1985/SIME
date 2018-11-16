<?php


// Initialize the session
if (! isset($_SESSION)) {
	session_start ();
}
// If session variable is not set it will redirect to login page
if (! isset ( $_SESSION ['username'] ) || empty ( $_SESSION ['username'] )) {
	header ( "location: login.php" );
	exit ();
}
?>
<!doctype html>
<html lang="en" dir="ltr">
<head>
<meta charset="UTF-8">
<meta name="viewport"
	content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta http-equiv="Content-Language" content="en" />
<meta name="msapplication-TileColor" content="#2d89ef">
<meta name="theme-color" content="#4188c9">
<meta name="apple-mobile-web-app-status-bar-style"
	content="black-translucent" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="mobile-web-app-capable" content="yes">
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<link rel="icon" href="./favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
<title>HomePage - Lucra+</title>
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet"
	href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">

	<link href="<?php echo BASEURL; ?>assets/css/jquery-ui.min.css"
	rel="stylesheet" />
	<script src="<?php echo BASEURL; ?>assets/js/jquery.js"></script>
	<script src="<?php echo BASEURL; ?>assets/js/jquery-ui.min.js"></script>
	<script src="<?php echo BASEURL; ?>assets/js/jquery.mask.min.js"></script>
<link href="<?php echo BASEURL; ?>assets/css/dashboard.css"
	rel="stylesheet" />
	<link href="<?php echo BASEURL; ?>assets/css/bootstrap.min.css"
	rel="stylesheet" />
	<link href="<?php echo BASEURL; ?>assets/css/style.css"
	rel="stylesheet" />
		<script src="<?php echo BASEURL; ?>assets/js/bootstrap.min.js"></script>

    <script src="<?php echo BASEURL; ?>assets/js/main.js"></script>
<script type="text/javascript">
var url = window.location.origin +"/SIME/";
</script>
</head>
<body class="">
	<div class="page">
		<div class="page-main">
			<div class="header py-4" style="border:none" >
			
				<div class="container">
					<div class="d-flex">
						<a class="header-brand" href="<?php echo BASEURL; ?>/index.php"> <img
							src="<?php echo BASEURL; ?>/assets/images/valor-logo.png"
							class="header-brand-img" alt="valor logo">
						</a>
						<div class="d-flex order-lg-2 ml-auto">

							<div class="dropdown d-none d-md-flex">
								<a class="nav-link icon" data-toggle="dropdown"> <i
									class="fe fe-bell"></i> <span class="nav-unread"></span>
								</a>
								<div
									class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
									<a href="#" class="dropdown-item d-flex"> 
									<span class="avatar">Adm</span>
										<div>
											<strong>Nathan</strong> pushed new commit: Fix page load
											performance issue.
											<div class="small text-muted">10 minutes ago</div>
										</div>
									</a> <a href="#" class="dropdown-item d-flex"> <span
										class="avatar mr-3 align-self-center"
										style="background-image: url(demo/faces/female/1.jpg)"></span>
										<div>
											<strong>Alice</strong> started new task: Tabler UI design.
											<div class="small text-muted">1 hour ago</div>
										</div>
									</a> <a href="#" class="dropdown-item d-flex"> <span
										class="avatar mr-3 align-self-center"
										style="background-image: url(demo/faces/female/18.jpg)"></span>
										<div>
											<strong>Rose</strong> deployed new version of NodeJS REST Api
											V3
											<div class="small text-muted">2 hours ago</div>
										</div>
									</a>
									<div class="dropdown-divider"></div>
									<a href="#" class="dropdown-item text-center text-muted-dark">Mark
										all as read</a>
								</div>
							</div>
							<div class="dropdown">
								<a href="#" class="nav-link pr-0 leading-none"
									data-toggle="dropdown"> <span class="avatar"
									style="background-image: url(./demo/faces/female/25.jpg)"></span>
									<span class="ml-2 d-none d-lg-block"> <span
										class="text-default"><?php echo $_SESSION['username'];?></span>
										<small class="text-muted d-block mt-1"><?php echo $_SESSION['Perfil'];?></small>
										<input type="hidden" id="txtLojaID" value="<?php echo $_SESSION['LojaID'];?>">
										<input type="hidden" id="txtUserID" value="<?php echo $_SESSION['UserID'];?>">
								</span>
								</a>
								<div
									class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
									<a class="dropdown-item" href="#"> <i
										class="dropdown-icon fe fe-user"></i> Profile
									</a> <a class="dropdown-item" href="#"> <i
										class="dropdown-icon fe fe-settings"></i> Settings
									</a> <a class="dropdown-item" href="#"> <span
										class="float-right"><span class="badge badge-primary">6</span></span>
										<i class="dropdown-icon fe fe-mail"></i> Inbox
									</a> <a class="dropdown-item" href="#"> <i
										class="dropdown-icon fe fe-send"></i> Message
									</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="#"> <i
										class="dropdown-icon fe fe-help-circle"></i> Need help?
									</a> <a class="dropdown-item" href="#"> <i
										class="dropdown-icon fe fe-log-out"></i> Sign out
									</a>
								</div>
							</div>
						</div>
						<a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0"
							data-toggle="collapse" data-target="#headerMenuCollapse"> <span
							class="header-toggler-icon"></span>
						</a>
					</div>
					<div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
						<div class="container">
							<div class="row align-items-center">
								<div class="col-lg-3 ml-auto" style="display:none" >
									<form class="input-icon my-3 my-lg-0">
										<input type="search" class="form-control header-search"
											placeholder="Search…" tabindex="1">
										<div class="input-icon-addon">
											<i class="fe fe-search"></i>
										</div>
									</form>
								</div>
								<div class="col-lg order-lg-first">
									<ul class="nav nav-tabs border-0 flex-column flex-lg-row">
										<li class="nav-item"><a href="../index.php" class="nav-link"><i
												class="fe fe-home"></i> Home</a></li>
										<li class="nav-item"><a href="../index.php" class="nav-link"
											data-toggle="dropdown"><i class="fe fe-box"></i>
												Configurações</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="my-3 my-md-5">
				<div class="container containerBody">