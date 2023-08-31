<?php
$open = "admin";
require_once __DIR__."/../../autoload/autoload.php";

$admin = $db->fetchAll("admin");

$sql = "SELECT admin.* FROM admin ORDER BY ID DESC ";

?>
<?php require_once __DIR__."/../../layouts/header.php"; ?>


    <!--Nội dụng-->
    <div class="container-fluid">
        
        
        <!--End.button-custom    -->
        <div class="clearfix"></div>
        <!--Thông báo lỗi    -->
        <?php require_once __DIR__."/../../../partials/notification.php"; ?>
        <div class="admin-title-top">
            <h1 style="color: #1A1E28 !important;">ADMIN</h1>
        </div>
        <div class="button-custom">
            <a class="btn-add" href="add.php"><i class="fa fa-plus"></i> Thêm mới</a>
        </div>
        <div class="admin-content">
            <!-- DataTables Example -->
            <div class="card mb-3">
                <div class="card-header">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr style="background-color: black; color: white;">
                                <th>STT</th>
                                <th>Admin - nhân viên</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Avata</th>
                                <th>Trạng thái</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $stt = 1; foreach ($admin as $item): ?>
                                <tr>
                                    <td><?php echo $stt ?></td>
                                    <td><?php echo $item['name'] ?></td>
                                    <td><?php echo $item['email'] ?></td>
                                    <td><?php echo $item['phone'] ?></td>
                                    <td>
                                        <img src="<?php echo uploads() ?>admin/<?php echo $item['avatar'] ?>" width="80px" height="80px" />
                                    </td>
                                    <td>
                                        <ul class="list-action">
                                            <li class="item-edit">
                                                <a href="edit.php?id=<?php echo $item['id'] ?>" title="Chỉnh sửa danh mục">
                                                    Sửa
                                                </a>
                                            </li>
                                            <li class="item-delete">
                                                <a href="delete.php?id=<?php echo $item['id'] ?>" title="Xóa danh mục">
                                                    Xóa
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <?php $stt++ ; endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--End.admin-content-->
    </div>
    <!--End.container-fluid-->


<?php require_once __DIR__."/../../layouts/footer.php"; ?>