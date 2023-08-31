<?php
$open = "users";
require_once __DIR__."/../../autoload/autoload.php";

$id = intval(getInput('id'));
//_debug($id);

$Editadmin = $db->fetchID("users", $id);
if(empty($Editadmin))
{
    $_SESSION['error'] = "Dữ liệu không tồn tại";
    redirectAdmin("user");
}


if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $data =
        [
            "name" => postInput('name'),
            "email" => postInput('email'),
            "phone" => postInput('phone'),
            "address" => postInput('address')
        ];
    $error = [];

    if (postInput('name') == ''){
        $error['name'] = "Yêu cầu nhập đầy đủ thông tin";
    }

    if (postInput('email') == ''){
        $error['email'] = "Yêu cầu nhập đầy đủ thông tin";
    }
    else
    {
        if (postInput("email") != $Editadmin['email'])
        {
            $is_check = $db -> fetchOne("users", " email = '".$data['email']."' ");

            if ($is_check != NULL)
            {
                $error['email'] = "Email đã tồn tại";
            }
        }

    }

    if (postInput('phone') == ''){
        $error['phone'] = "Yêu cầu nhập đầy đủ thông tin";
    }

    if (postInput('address') == ''){
        $error['address'] = "Yêu cầu nhập đầy đủ thông tin";
    }

    if (postInput('password') != NULL && postInput("re_password") != NULL)
    {
        if (postInput('password') != postInput("re_password"))
        {
            $error['password'] = "Mật khẩu thay đổi không khớp";
        }
        else
        {
            $data['password'] = MD5(postInput("password"));
        }
    }

    // error trống có nghĩa là không có lỗi
    if(empty($error))
    {
        if (isset($_FILES['avatar']))
        {
            $file_name = $_FILES['avatar']['name'];
            $file_tmp = $_FILES['avatar']['tmp_name'];
            $file_erro = $_FILES['avatar']['error'];

            if ($file_erro == 0){
                $part = ROOT ."users/";
                $data['avatar'] = $file_name;
            }
        }
//        _debug($data);
        $id_update = $db->update("users", $data, array("id"=>$id));
        if ($id_update > 0)
        {
            move_uploaded_file($file_tmp, $part.$file_name);
            $_SESSION['success'] = "Cập nhật thành công";
            redirectAdmin("user");
        }
        else
        {
            $_SESSION['error'] = "Cập nhật thất bại";
            redirectAdmin("user");
        }

    }
}
?>
<?php require_once __DIR__."/../../layouts/header.php"; ?>

    <!--Nội dụng-->
    <div class="container-fluid">

        <div class="admin-title-top">
            <h1>Tài khoản khách hàng</h1>
        </div>
        <!-- End. admin-title-top   -->
        <div class="button-custom">
            <a class="btn-add" href="index.php">Quay lại</a>
        </div>
        <!--Thông báo lỗi-->
        <?php require_once __DIR__."/../../../partials/notification.php"; ?>

        <div class="admin-content">
            <div class="form-add-category form-product">
                <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-border-left">
                                <div class="form-group">
                                    <label for="exampleInputCategory">Họ và tên</label>
                                    <input type="text" class="form-control" id="exampleInputCategory" name="name" value="<?php  echo $Editadmin['name'] ?>" placeholder="Mời bạn nhập tên sản phẩm">
                                    <?php if (isset($error['name'])): ?>
                                        <p class="text-danger">
                                            <?php echo $error['name'] ?>
                                        </p>
                                    <?php endif ?>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputCategory">Email</label>
                                    <input type="email" class="form-control" id="exampleInputCategory" name="email" value="<?php  echo $Editadmin['email'] ?>" placeholder="Mời bạn nhập địa chỉ email">
                                    <?php if (isset($error['email'])): ?>
                                        <p class="text-danger">
                                            <?php echo $error['email'] ?>
                                        </p>
                                    <?php endif ?>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputCategory">Số điện thoại</label>
                                    <input type="number" class="form-control" id="exampleInputCategory" name="phone" value="<?php  echo $Editadmin['phone'] ?>" placeholder="Mời bạn nhập số điện thoại">
                                    <?php if (isset($error['phone'])): ?>
                                        <p class="text-danger">
                                            <?php echo $error['phone'] ?>
                                        </p>
                                    <?php endif ?>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputCategory">Địa chỉ</label>
                                    <input type="text" class="form-control" id="exampleInputCategory" name="address" value="<?php  echo $Editadmin['address'] ?>" placeholder="Mời bạn nhập địa chỉ">
                                    <?php if (isset($error['address'])): ?>
                                        <p class="text-danger">
                                            <?php echo $error['address'] ?>
                                        </p>
                                    <?php endif ?>
                                </div>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </div>
                        </div>
                        <!--End.col-md-6-->

                        <div class="col-md-6">
                            <div class="form-border-right">
                                <div class="form-group">
                                    <label for="exampleInputCategory">Mật khẩu</label>
                                    <input type="password" class="form-control" id="exampleInputCategory" name="password" placeholder="">
                                    <?php if (isset($error['password'])): ?>
                                        <p class="text-danger">
                                            <?php echo $error['password'] ?>
                                        </p>
                                    <?php endif ?>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputCategory">Nhập lại mật khẩu</label>
                                    <input type="password" class="form-control" id="exampleInputCategory" name="re_password" placeholder="Mời bạn nhập lại mật khẩu">
                                    <?php if (isset($error['re_password'])): ?>
                                        <p class="text-danger">
                                            <?php echo $error['re_password'] ?>
                                        </p>
                                    <?php endif ?>
                                </div>

                                

                            </div>
                        </div>
                        <!--End.col-md-6-->
                    </div>

                </form>
            </div>
        </div>
        <!--End.admin-content-->
    </div>
    <!--End.container-fluid-->

<?php require_once __DIR__."/../../layouts/footer.php"; ?>