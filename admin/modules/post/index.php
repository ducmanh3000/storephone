<?php
$open = "post";
require_once __DIR__."/../../autoload/autoload.php";

//// Lấy tên danh mục tin tức
//$post = $db->fetchAll("post");

$sql = "SELECT * FROM post ORDER BY id DESC";
$post = $db->fetchsql($sql);

?>
<?php require_once __DIR__."/../../layouts/header.php"; ?>


    <!--Nội dụng-->
    <div class="container-fluid">
        
        <div class="admin-title-top">
            <h1 style="color: #1A1E28 !important;">Tin tức</h1>
        </div>
        <div class="button-custom">
            <a class="btn-add" href="add.php"><i class="fa fa-plus"></i> Thêm mới</a>
        </div>
       
        <!--End.button-custom    -->
        <div class="clearfix"></div>
        <!--Thông báo lỗi    -->
        <?php require_once __DIR__."/../../../partials/notification.php"; ?>
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
                                <th>Mô tả</th>
                                <th>Ảnh</th>
                                <th>Ngày tạo</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>    
                            <tbody>
                            <?php $stt = 1; foreach ($post as $item): ?>
                                <tr>
                                    <td><?php echo $stt ?></td>
                                    <td><?php echo $item['name'] ?></td>
                                    <td>
                                        <img src="<?php echo uploads() ?>post/<?php echo $item['thumbar'] ?>" width="80px" height="80px" />
                                    </td>
                                    <td><?php echo $item['created_at'] ?></td>
                                    <td>
                                        <ul class="list-action">
                                            <li class="item-edit">
                                                <a href="edit.php?id=<?php echo $item['id'] ?>" title="Chỉnh sửa tin tức">
                                                    Sửa
                                                </a>
                                            </li>
                                            <li class="item-delete">
                                                <a href="delete.php?id=<?php echo $item['id'] ?>" title="Xóa tin tức">
                                                    Xóa
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <?php $stt++ ; endforeach ?>
                            </tbody>
                            <!-- End. admin-title-top   -->
                    </table>
                </div>
                </div>
                </div>
            </div>
        </div>
        <!--End.admin-content-->
    </div>
    <!--End.container-fluid-->


<?php require_once __DIR__."/../../layouts/footer.php"; ?>