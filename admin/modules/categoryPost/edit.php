<?php
$open = "categoryPost";
require_once __DIR__."/../../autoload/autoload.php";

$id = intval(getInput('id'));
//_debug($id);

$EditCategory = $db->fetchID("category_post", $id);
if(empty($EditCategory))
{
    $_SESSION['error'] = "Dữ liệu không tồn tại";
    redirectAdmin("categoryPost");
}
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $data =
        [
            "name" => postInput('name'),
            "slug" => to_slug(postInput("name"))
        ];

    $error = [];

    if (postInput('name') == ''){
        $error['name'] = "Yêu cầu nhập đầy đủ thông tin";
    }

    // error trống có nghĩa là không có lỗi
    if(empty($error)){
        // Kiểm tra lỗi cập nhật
        if($EditCategory['name'] != $data['name'])
        {
            $isset = $db->fetchOne("category_post","name = '".$data['name']."' ");
            if (is_countable($isset) && count($isset) > 0)
            {
                $_SESSION['error'] = "Tên danh mục đã tồn tại !";
            }
            else
            {
                $id_update = $db->update("category_post", $data, array("id" => $id));
//        print_r($id_update);
                if($id_update > 0)
                {
                    $_SESSION['success'] = "Cập nhật thành công";
                    redirectAdmin("categoryPost");
                }
                else
                {
                    $_SESSION['error'] = "Dữ liệu không thay đổi";
                    redirectAdmin("categoryPost");
                }
            }
        }
        else
        {
            $id_update = $db->update("category_post", $data, array("id" => $id));
//        print_r($id_update);
            if($id_update > 0)
            {
                $_SESSION['success'] = "Cập nhật thành công";
                redirectAdmin("categoryPost");
            }
            else
            {
                $_SESSION['error'] = "Dữ liệu không thay đổi";
                redirectAdmin("categoryPost");
            }
        }


    }
}
?>
<?php require_once __DIR__."/../../layouts/header.php"; ?>


    <!--Nội dụng-->
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Trang chủ</a>
            </li>
            <li class="breadcrumb-item">
                <a href="index.php">Danh mục</a>
            </li>
            <li class="breadcrumb-item active">Thông tin danh mục tin tức</li>
        </ol>
        <!-- End.Breadcrumbs-->

        <div class="admin-title-top">
            <h1>Thông tin danh mục tin tức</h1>
        </div>
        <!-- End. admin-title-top   -->
        <div class="button-custom">
            <a class="btn-add" href="index.php"><i class="fa fa-angle-double-left"></i> Trở về</a>
        </div>
        <!--Thông báo lỗi-->
        <?php require_once __DIR__."/../../../partials/notification.php"; ?>

        <div class="admin-content">
            <div class="form-add-category form-category-product">
                <form action="" method="POST" role="form" class="form-horizontal">
                    <div class="form-group">
                        <label for="exampleInputCategory">Tên danh mục</label>
                        <input type="text" class="form-control" id="exampleInputCategory" name="name"
                               placeholder="Mời bạn nhập tên danh mục" value="<?php echo $EditCategory['name'] ?>">
                        <?php if (isset($error['name'])): ?>
                            <p class="text-danger">
                                <?php echo $error['name'] ?>
                            </p>
                        <?php endif ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </form>
            </div>
        </div>
        <!--End.admin-content-->
    </div>
    <!--End.container-fluid-->


<?php require_once __DIR__."/../../layouts/footer.php"; ?>