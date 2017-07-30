<?php
if(!isset($menu))
    $menu = 0;
if(!isset($submenu))
    $submenu = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <base href="<?=base_url()?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Christian Rosandhy">

    <title><?php echo isset($title) ? $title." - " : ""; echo get_setting("webname")?> Admin Page</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/alertify.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/jquery.fancybox.css">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <?=cms_register("header")?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="js/jquery.js"></script>
    <script src="js/alertify.min.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation no-print">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?=base_url("backend")?>"><?=get_setting("webname")?></a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?=$curr['name']?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="home/logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="<?=is_same(2,$menu,"active")?>">
                        <a href="javascript:;" data-toggle="collapse" data-target="#master"><i class="fa fa-fw fa-file-text-o"></i> Data Master <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="master"  class="<?=is_not_same(2,$menu,"collapse")?>">
                            <li class="<?=is_same(21,$submenu,"active")?>">
                                <a href="master/cc">Inventory</a>
                            </li>
                            <li class="<?=is_same(22,$submenu,"active")?>">
                                <a href="master/divisi">Divisi</a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?=is_same(3,$menu,"active")?>">
                        <a href="mutasi/penerimaan"><i class="fa fa-fw fa-bars"></i> Rekap Stok Inventory</a>
                    </li>
                    <li class="<?=is_same(4,$menu,"active")?>">
                        <a href="mutasi/pengiriman"><i class="fa fa-fw fa-picture-o"></i> Rekap Inventory per Divisi</a>
                    </li>
                    <li class="<?=is_same(5,$menu,"active")?>">
                        <a href="laporan"><i class="fa fa-fw fa-bookmark"></i> Laporan</a>
                    </li>
                    <li class="<?=is_same(6,$menu,"active")?>">
                        <a href="history"><i class="fa fa-fw fa-cog"></i> History</a>
                    </li>
                                      
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <?=$title?>
                        </h1>
                        <div class="divider"></div>