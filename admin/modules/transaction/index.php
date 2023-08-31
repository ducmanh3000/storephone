<?php
$open = "transaction";
require_once __DIR__."/../../autoload/autoload.php";

//$transaction = $db->fetchAll("transaction");
//
//$sql = "SELECT transaction.* , users.name as nameuser , users.phone as phoneuer FROM transaction LEFT JOIN users ON
//       users.id = transaction.users_id ORDER BY ID DESC";

$sql = "SELECT * FROM transaction ORDER BY id DESC";
//$product = $db->fetchAll("product");
$transaction = $db->fetchsql($sql);

//_debug($sql);

?>
<?php require_once __DIR__."/../../layouts/header.php"; ?>


    <!--Nội dụng-->
    <div class="container-fluid">
    <div class="admin-title-top">
            <h1 style="color: #1A1E28 !important; padding-bottom: 30px;">Đơn hàng</h1>
        </div>
        <!--Thông báo lỗi    -->
        <?php require_once __DIR__."/../../../partials/notification.php"; ?>
        
        <!-- End. admin-title-top   -->

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
                                <th>Tên khách hàng</th>
                                <th>Số điện thoại</th>
                                <th>Tình trạng</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                            <tbody>
                            <?php $stt = 1; foreach ($transaction as $item): ?>
                                <?php
                                $user_id = intval($item['users_id']);
                                $sql = "SELECT * FROM `users` WHERE `id` = $user_id";
                                $user = $db->fetchsql($sql);

                                ?>
                                <tr>
                                    <td><?php echo $stt ?></td>
                                    <?php foreach ($user as $users):  ?>
                                        <td><?php echo $users['name']; ?></td>
                                        <td><?php echo $users['phone']; ?></td>
                                        <td>
                                            <a class="btn btn-xs <?php echo $item['status'] == 0 ? 'btn-danger' : 'btn-success' ?>" href="status.php?id=<?php echo $item['id'] ?>">
                                                <?php echo $item['status'] == 0 ? 'Chưa xử lý' : 'Đã xử lý' ?>
                                            </a>
                                        </td>
                                    <?php endforeach; ?>
                                    <td>
                                        <ul class="list-action" >
                                            <li class="item-edit" style="width: 35px; height: 35px;">
                                                <a href="view.php?id=<?php echo $item['id'] ?>" title="Xem chi tiết">
                                                    Xem
                                                </a>
                                            </li>
                                            <li class="item-print" style="width: 35px; height: 35px;">
                                                <a target="_blank" href="print.php?id=<?php echo $item['id'] ?>" title="In hóa đơn">
                                                    In
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