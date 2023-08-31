<?php
require_once __DIR__."/autoload/autoload.php";
//unset($_SESSION['cart']);

/*
 * Lấy ra tất cả các danh mục sản phẩm được active - hiển thị
 * */
//_debug($_SESSION['name_user']);
$sqlHomecate = "SELECT name, id FROM category_product WHERE  home = 1 ORDER BY updated_at";
//$sqlHomecate = "SELECT * FROM category_product WHERE  home = 1 ORDER BY updated_at";
$CategoryProductHome = $db->fetchsql($sqlHomecate);
//_debug($CategoryProductHome);

/*
 * Lấy ra tất cả các danh mục tin tức được active - hiển thị
 * */
$sqlHomecateNew = "SELECT * FROM category_post WHERE  home = 1 ORDER BY updated_at";
$CategoryPostHome = $db->fetchsql($sqlHomecateNew);

/*
 * Lấy ra tất cả các sản phẩm được active - hiển thị
 * */
$sqlHomeProduct = "SELECT * FROM product WHERE  home = 1 ORDER BY updated_at";
$ProductHome = $db->fetchsql($sqlHomeProduct);

/*
 * Lấy ra tất cả các tin tức được active - hiển thị
 * */
$sqlHomePost = "SELECT * FROM product WHERE  home = 1 ORDER BY updated_at";
$PostHome = $db->fetchsql($sqlHomePost);


$data = [];

foreach ($CategoryProductHome as $item)
{
    $cateId = intval($item['id']);
    $sql = "SELECT * FROM product WHERE category_id = $cateId and home = 1";
    $productHome = $db->fetchsql($sql);
    $data[$item['name']] = $productHome;
}
//_debug($data);

?>

<?php require_once __DIR__."/layouts/header.php"; ?>
<div class="col-md-9 no-padding-left">
    <section id="slide" class="text-center" >
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">

                <div class="item item-imgg active">
                    <img src="<?php echo uploads() ?>/slider/1.png" alt="Los Angeles" style="width:100%;">
                </div>

                <div class="item item-imgg">
                    <img src="<?php echo uploads() ?>/slider/2.webp" alt="Chicago" style="width:100%;">
                </div>

                <div class="item item-imgg">
                    <img src="<?php echo uploads() ?>/slider/3.webp" alt="New York" style="width:100%;">
                </div>

                <div class="item item-imgg">
                    <img src="<?php echo uploads() ?>/slider/4.webp" alt="New York" style="width:100%;">
                </div>

            </div>
            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>

    <section class="box-main1">
        <div class="product-show product-hot">
            <div class="product-title" style="    margin-bottom: 30px; letter-spacing: 4px; font-family: 'Roboto', sans-serif;">
                <h2>
                    <a href="#">
                         sản phẩm nổi bật
                    </a>
                </h2>
               
            </div>
            
            <div class="showitem">
                <?php foreach ($productPay as $item): ?>
                    <div class="col-md-3 col-xs-12 item-product">
                        <div class="item-product-custom border bor">
                            <a href="product-detail.php?id=<?php echo $item['id'] ?>">
                                <img src="<?php echo uploads() ?>/product/<?php echo $item['thumbar'] ?>" class="" width="100%" height="180">
                            </a>
                            <div class="info-item" style="color: black;">
                                <h1 class="info-product-item" style="line-height: 0.75; color: black;">
                                    <a href="product-detail.php?id=<?php echo $item['id'] ?>" style="color: black;"><?php echo $item['name'] ?></a>
                                </h1>
                                <?php if ($item['sale'] > 0): ?>
                                    <p><strike class="sale"><?php echo formatPrice($item['price']) ?></strike>
                                        <br>
                                        <b class="price"><?php echo formatpricesale($item['price'],$item['sale']) ?></b></p>
                                <?php else: ?>
                                    <p><b style="color: #ea3a3c;"><?php echo formatPrice($item['price']) ?></b></p>
                                <?php endif;  ?>
                            </div>
                            <div class="hidenitem">
                                <p><a href="product-detail.php?id=<?php echo $item['id'] ?>"><i class="fa fa-search"></i></a></p>
                                <p><a href=""><i class="fa fa-heart"></i></a></p>
                                <p><a href="addcart.php?id=<?php echo $item['id'] ?>"><i class="fa fa-shopping-basket"></i></a></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php foreach ($data as $key => $value): ?>
        <div class="product-show">
            <div class="product-title" style="    margin-bottom: 30px; letter-spacing: 4px; font-family: 'Roboto', sans-serif;">
                <h2>
                    <a href="#">
                        <?php echo $key ?>
                    </a>
                </h2>
                
            </div>

            <div class="showitem">
                <?php foreach ($value as $item): ?>
                    <div class="col-md-3 col-xs-12 item-product">
                        <div class="item-product-custom border bor">
                            <a href="product-detail.php?id=<?php echo $item['id'] ?>">
                                <img src="<?php echo uploads() ?>/product/<?php echo $item['thumbar'] ?>" class="" width="100%" height="180">
                            </a>
                            <div class="info-item">
                                <h1 class="info-product-item" style="line-height: 0.75; color: black;">
                                    <a href="product-detail.php?id=<?php echo $item['id'] ?>" style="color: black;"><?php echo $item['name'] ?></a>
                                </h1>
                                <?php if ($item['sale'] > 0): ?>
                                    <p><strike class="sale"><?php echo formatPrice($item['price']) ?></strike>
                                        <br>
                                        <b class="price"><?php echo formatpricesale($item['price'],$item['sale']) ?></b></p>
                                <?php else: ?>
                                    <p><b style="color: #ea3a3c;"><?php echo formatPrice($item['price']) ?></b></p>
                                <?php endif;  ?>
                            </div>
                            <div class="hidenitem">
                                <p><a href="product-detail.php?id=<?php echo $item['id'] ?>"><i class="fa fa-search"></i></a></p>
                                <p><a href=""><i class="fa fa-heart"></i></a></p>
                                <p><a href="addcart.php?id=<?php echo $item['id'] ?>"><i class="fa fa-shopping-basket"></i></a></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>

        <div class="banner-motor">
            <div class="bannerBlock imageHover">
                <a href="">
                    <img src="<?php echo base_url() ?>public/frontend/images/2.jpg" alt="Kawasaki">
                </a>
            </div>
        </div>

        
<!--  End.page      -->

    </section>
</div>
<?php require_once __DIR__."/layouts/footer.php"; ?>


