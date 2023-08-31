<?php
$open = "comment";
require_once __DIR__."/../../autoload/autoload.php";

$comment = $db->fetchAll("comment");

$sql = "SELECT comment.* FROM comment ORDER BY ID DESC ";

?>
<?php require_once __DIR__."/../../layouts/header.php"; ?>


    <!--Nội dụng-->
    <div class="container-fluid">
        <div class="admin-title-top">
            <h1 style="color: #1A1E28 !important; padding-bottom: 30px;">Bình luận sản phẩm</h1>
        </div>
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
                                <th>Tên khách hàng</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                            <tbody>
                            <?php $stt = 1; foreach ($comment as $item): ?>
                                <tr>
                                    <td><?php echo $stt ?></td>
                                    <td><?php echo $item['name'] ?></td>
                                    <td><?php echo $item['email'] ?></td>
                                    <td><?php echo $item['phone'] ?></td>
                                    <td>
                                        <ul class="list-action">
                                            <li class="item-edit" style="width: 35px; height: 35px;">
                                                <a href="view.php?id=<?php echo $item['id'] ?>" title="Xem chi tiết">
                                                    Xem
                                                </a>
                                            </li>
                                            <li class="item-delete" style="width: 35px; height: 35px;">
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
        </div>
        <!--End.admin-content-->
    </div>
    <!--End.container-fluid-->


<?php require_once __DIR__."/../../layouts/footer.php"; ?>