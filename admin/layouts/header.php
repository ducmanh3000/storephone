<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Công Ty Itop</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url() ?>public/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="<?php echo base_url() ?>public/admin/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url() ?>public/admin/css/sb-admin.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>public/admin/css/style-admin.css" rel="stylesheet">
    <script src="<?php echo base_url() ?>public/admin/vendor/jquery/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Lora&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}

    #customers {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
    }

    #customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
    }

    #customers tr:nth-child(even){background-color: #f2f2f2;}

    #customers tr:hover {background-color: #ddd;}

    #customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #343a40;
    color: white;
    }
}
    </style>
</head>

<body id="page-top" >
    <!-- Top container -->
    <nav class="navbar navbar-expand navbar-dark bg-dark static-top" style="padding: 0px;">
    <div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
        <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
        <span class="w3-bar-item w3-right">Phone store</span>
    </div>
    <!-- Navbar -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-circle fa-fw"></i> <?php echo $_SESSION['admin_name'] ?>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="/storephone/dang-xuat.php">Đăng xuất</a>
            </div>
        </li>
    </ul>

</nav>

    

<!-- <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="<?php echo base_url() ?>admin">Công Ty Itop</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->


    <!-- Navbar -->
    <!-- <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-circle fa-fw"></i> <?php echo $_SESSION['admin_name'] ?>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="/storephone/dang-xuat.php">Đăng xuất</a>
            </div>
        </li>
    </ul> -->

<!-- </nav> --> 

<div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
        <!-- Sidebar/menu -->
    <nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:200px;" id="mySidebar"><br>
    <div class="w3-container w3-row">
        <div class="w3-col s8 w3-bar" style="width: 200px;">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-circle fa-fw"></i> <?php echo $_SESSION['admin_name'] ?>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="/storephone/dang-xuat.php">Đăng xuất</a>
            </div><br>
        <a href="#" class="w3-bar-item w3-button" style="padding: 7px 21px; padding-top: 0px;"><i class="fa fa-envelope"></i></a>
        <a href="#" class="w3-bar-item w3-button" style="padding: 7px 21px; padding-top: 0px;"><i class="fa fa-user"></i></a>
        <a href="#" class="w3-bar-item w3-button" style="padding: 7px 21px; padding-top: 0px;"><i class="fa fa-cog"></i></a>
        </div>
    </div>
    <hr>
    <div class="w3-container">
        <h5><a href="http://localhost/storephone/admin/">Trang chủ</a></h5>
    </div>
    <div class="w3-bar-block">
        <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
        <a href="<?php echo modules("user") ?>" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i>  User</a>
        <a href="<?php echo modules("admin") ?>" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i>  Admin</a>
        <a href="<?php echo modules("product") ?>" class="w3-bar-item w3-button w3-padding"><i class="fa fa-eye fa-fw"></i>  Sản phẩm</a>
        <a href="<?php echo modules("transaction") ?>" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bank fa-fw"></i>  Quản lý đơn hàng</a>
        <a href="<?php echo modules("contact") ?>" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bullseye fa-fw"></i>  Liên hệ</a>
        <a href="<?php echo modules("comment") ?>" class="w3-bar-item w3-button w3-padding"><i class="fa fa-history fa-fw"></i>  Bình luận</a>
        <a href="<?php echo modules("post") ?>" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bell fa-fw"></i>  Tin tức</a>
    </div>
    </nav>
        <!-- <li class="nav-item active">
            <a class="nav-link" href="<?php echo base_url() ?>admin">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>
                    <strong>ADMIN - <?php echo $_SESSION['admin_name'] ?></strong>
                </span>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-fw fa-folder"></i>
                <span>Danh mục</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                <ul class="dropdowm-menu-list">
                    <li>
                        <a class="dropdown-item" href="<?php echo modules("categoryProduct") ?>">Sản phẩm</a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="<?php echo modules("categoryPost") ?>">Tin tức</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item <?php echo isset($open) && $open == 'product' ? 'active' : '' ?>">
            <a class="nav-link" href="<?php echo modules("product") ?>">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Sản phẩm</span>
            </a>
        </li>
        <li class="nav-item <?php echo isset($open) && $open == 'post' ? 'active' : '' ?>">
            <a class="nav-link" href="<?php echo modules("post") ?>">
                <i class="fas fa-fw fa-table"></i>
                <span>Tin tức</span></a>
        </li>
        <li class="nav-item <?php echo isset($open) && $open == 'admin' ? 'active' : '' ?>">
            <a class="nav-link" href="<?php echo modules("admin") ?>">
                <i class="fa fa-user"></i>
                <span>Admin</span></a>
        </li>

        <li class="nav-item <?php echo isset($open) && $open == 'user' ? 'active' : '' ?>">
            <a class="nav-link" href="<?php echo modules("user") ?>">
                <i class="fa fa-users"></i>
                <span>User</span></a>
        </li>

        <li class="nav-item <?php echo isset($open) && $open == 'transaction' ? 'active' : '' ?>">
            <a class="nav-link" href="<?php echo modules("transaction") ?>">
                <i class="fa fa-university"></i>
                <span>Quản lý đơn hàng</span></a>
        </li>

        <li class="nav-item <?php echo isset($open) && $open == 'comment' ? 'active' : '' ?>">
            <a class="nav-link" href="<?php echo modules("comment") ?>">
                <i class="fa fa-comment"></i>
                <span>Bình luận</span></a>
        </li>

        <li class="nav-item <?php echo isset($open) && $open == 'contact' ? 'active' : '' ?>">
            <a class="nav-link" href="<?php echo modules("contact") ?>">
                <i class="fa fa-address-book"></i>
                <span>Liên hệ</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="/storephone/dang-xuat.php">
                <i class="fas fa-user-circle fa-fw"></i>
                <span>Đăng xuất</span></a>
        </li> -->
    </ul>
    <div id="content-wrapper">
