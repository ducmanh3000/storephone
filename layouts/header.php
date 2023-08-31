<?php
/*
 * Lấy ra tất cả các danh mục sản phẩm được active - hiển thị
 * */

$sqlHomecate = "SELECT name, id FROM category_product WHERE  home = 1 ORDER BY updated_at";
//$sqlHomecate = "SELECT * FROM category_product WHERE  home = 1 ORDER BY updated_at";
$CategoryProductHome = $db->fetchsql($sqlHomecate);
//_debug($CategoryProductHome);


?>
<!DOCTYPE html>
<html>
<head>
    <title>Công Ty Itop</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/frontend/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/frontend/css/bootstrap.min.css">

    <script  src="<?php echo base_url() ?>public/frontend/js/jquery-3.2.1.min.js"></script>
    <script  src="<?php echo base_url() ?>public/frontend/js/bootstrap.min.js"></script>
    <script  src="<?php echo base_url() ?>public/frontend/js/main.js"></script>
    <!---->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/frontend/css/slick.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/frontend/css/slick-theme.css"/>
    <!--slide-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/frontend/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>public/frontend/css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
    .w3-sidebar a {font-family: "Roboto", sans-serif}
    body,h1,h2,h3,h4,h5,h6,.w3-wide {font-family: "Montserrat", sans-serif;}
    </style>

    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.3&appId=387173625269621&autoLogAppEvents=1"></script>

</head>
<body class="w3-content" style="max-width:1200px">
    <!-- Sidebar/menu -->
    <nav class="w3-sidebar w3-bar-block w3-white w3-collapse w3-top" style="z-index:3;width:250px" id="mySidebar">
    <div class="w3-container w3-display-container w3-padding-16">
        <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
        <a href="index.php"><h3 class="w3-wide"><b>PHONE STORE </b></h3> </a>
    </div>
    <div class="w3-padding-64 w3-large w3-text-grey" style="font-weight:bold">
        <a href="<?php echo base_url() ?>" class="w3-bar-item w3-button">Trang chủ</a>
        <a onclick="myAccFunc()" href="javascript:void(0)" class="w3-button w3-block w3-white w3-left-align" >
        Sản phẩm </i>
        </a>
        <div id="demoAcc" class="w3-bar-block w3-hide w3-padding-large w3-medium">
            <ul>
                <?php foreach ($category_product as $item) : ?>
                    <li>
                        <a class="w3-bar-item w3-button" href="category-product.php?id=<?php echo $item['id'] ?>">
                            <?php echo $item['name'] ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <a onclick="myAccFunc1()" href="javascript:void(0)" class="w3-button w3-block w3-white w3-left-align" >
        Tin tức </i>
        </a>
        <div id="tintuc" class="w3-bar-block w3-hide w3-padding-large w3-medium">
            <ul>
                <?php foreach ($category_post as $item) : ?>
                    <li>
                        <a class="w3-bar-item w3-button"  href="category-post.php?id=<?php echo $item['id'] ?>">
                            <?php echo $item['name'] ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <a href="contact.php" class="w3-bar-item w3-button">Liên hệ</a>
        <a href="gio-hang.php" class="w3-bar-item w3-button">Giỏ hàng</a>
    </div>
    <a href="#footer" class="w3-bar-item w3-button w3-padding">Contact</a> 
    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding" onclick="document.getElementById('newsletter').style.display='block'">Newsletter</a> 
    <a href="#footer"  class="w3-bar-item w3-button w3-padding">Subscribe</a>
    </nav>

    <!-- Top menu on small screens -->
    <header class="w3-bar w3-top w3-hide-large w3-black w3-xlarge">
    <div class="w3-bar-item w3-padding-24 w3-wide">LOGO</div>
    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding-24 w3-right" onclick="w3_open()"><i class="fa fa-bars"></i></a>
    </header>

    <!-- Overlay effect when opening sidebar on small screens -->
    <div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>


    <div class="w3-main" style="margin-left:250px">

    <!-- Push down content on small screens -->
    <div class="w3-hide-large" style="margin-top:83px"></div>
    
    <!-- Top header -->
    
    <header class="w3-container w3-xlarge" style="padding-top: 22px; padding-bottom: 22px;">
        <i class="fa ">
            <form action="search.php" method="GET" class="form-inline" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="text" id="searchf" name="search" placeholder="Nhập tên sản phẩm tìm kiếm" class="form-control">
                    <button type="submit" name="btnsearch" id="searchbtn" value="Search" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </i>
        <a href="gio-hang.php"><i class="fa fa-shopping-cart w3-margin-right"></i></a>

        <p class="w3-right">
        <ul class="list-inline pull-right" id="headermenu" style="font-size: 18px!important">
            <!--Kiểm tra điều kiện nếu đăng nhâp tài khoản thì hiện nút thoát hoặc đăng xuất-->
            <?php if (isset($_SESSION['name_user'])): ?>
                <li>
                    Xin chào: <strong style="font-size: 15px!important; color: red"><?php echo $_SESSION['name_user'] ?></strong>
                </li>
                <li>
                    <a href=""><i class="fa fa-user"></i> Tài khoản <i class="fa fa-caret-down"></i></a>
                    <ul id="header-submenu" style="font-size: 15px!important">
                        <li><a href="">Thông tin</a></li>
                        <li><a href="gio-hang.php">Giỏ hàng</a></li>
                        <li><a href="logout.php">Đăng xuất</a></li>
                    </ul>
                </li>
                <li>
                    <a href="logout.php"><i class="fa fa-share-square-o"></i> Đăng xuất</a>
                </li>

            <!--Còn ngược lại sẽ hiển thị đăng ký - đăng nhập-->
            <?php else: ?>
            <li>
                <a href="dang-nhap.php"><i class="fa fa-unlock"></i> Đăng nhập</a>
            </li>
            <li>
                <a href="dang-ky.php"><i class="fa fa-users"></i> Đăng ký</a>
            </li>
            <?php endif; ?>
        </ul>
        </p>
    </header>
    

    </div>
    

    <!-- Image header -->
    <div class="w3-main" style="margin-left:250px">
        <div class="w3-display-container w3-container">
            <img src="<?php echo uploads() ?>/slider/21.jpg" alt="Jeans" style="width:100%">
            <div class="w3-display-topleft w3-text-white" style="padding:24px 48px">
            <h1 class="w3-jumbo w3-hide-small">New arrivals</h1>
            <h1 class="w3-hide-large w3-hide-medium">New arrivals</h1>
            <h1 class="w3-hide-small">COLLECTION 2023</h1>
            <p><a href="page-product.php" class="w3-button w3-black w3-padding-large w3-large">SHOP NOW</a></p>
            </div>
        </div>
    </div>

  


    


<!-- <section id="slide" class="text-center" >
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <!-- <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
            </ol> -->

            <!-- Wrapper for slides -->
            <!-- <div class="carousel-inner">

                <div class="item item-img active">
                    <img src="<?php echo uploads() ?>/slider/12.jpg" alt="Los Angeles" style="width:100%;">
                </div>

                <div class="item item-img">
                    <img src="<?php echo uploads() ?>/slider/2.jpg" alt="Chicago" style="width:100%;">
                </div>

                <div class="item item-img">
                    <img src="<?php echo uploads() ?>/slider/15.jpg" alt="New York" style="width:100%;">
                </div>

                <div class="item item-img">
                    <img src="<?php echo uploads() ?>/slider/5.webp" alt="New York" style="width:100%;">
                </div>

            </div> -->
            <!-- Left and right controls -->
            <!-- <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section> --> 



    
    


    

    <div id="maincontent">
        <div class="container">
            <div class="col-md-3  fixside" >
                

                
            </div>


            <script>
            // Accordion 
            function myAccFunc() {
            var x = document.getElementById("demoAcc");
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
            } else {
                x.className = x.className.replace(" w3-show", "");
            }
            }

            function myAccFunc1() {
            var x = document.getElementById("tintuc");
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
            } else {
                x.className = x.className.replace(" w3-show", "");
            }
            }

            // Click on the "Jeans" link on page load to open the accordion for demo purposes
            document.getElementById("myBtn").click();


            // Open and close sidebar
            function w3_open() {
            document.getElementById("mySidebar").style.display = "block";
            document.getElementById("myOverlay").style.display = "block";
            }
            
            function w3_close() {
            document.getElementById("mySidebar").style.display = "none";
            document.getElementById("myOverlay").style.display = "none";
            }
            </script>