<?php
require_once __DIR__."/autoload/autoload.php";
unset($_SESSION['cart']);
unset($_SESSION['total']);

?>

<?php require_once __DIR__."/layouts/header.php"; ?>
<div class="col-md-9 bor">

    <section class="box-main1">
        <div class="product-title">
            <h2>
                <a href="#">
                    Thanh toán
                </a>
            </h2>
        </div>
        <div class="notification-text">
            <?php if (isset($_SESSION['success'])) :?>
                <div class="alert alert-success" style="background-color: #3c763dbd; color: #fff;">
                    <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>
        </div>
        <!--End.notification-text-->
        <div class="back-home" style="margin: 30px 0px;">
            <a href="<?php echo base_url() ?>" class="btn btn-danger" style="background-color: black;">Quay lại trang chủ</a>
        </div>

        <!-- Nội dung -->
    </section>
</div>
<?php require_once __DIR__."/layouts/footer.php"; ?>


