<?php
$open = "categoryProduct";
require_once __DIR__."/../../autoload/autoload.php";

$id = intval(getInput('id'));
//_debug($id);

$EditCategory = $db->fetchID("category_product", $id);
if(empty($EditCategory))
{
    $_SESSION['error'] = "Dữ liệu không tồn tại";
    redirectAdmin("categoryProduct");
}
$num = $db->delete("category_product", $id);
if ($num > 0)
{
    $_SESSION['success'] = "Xóa thành công";
    redirectAdmin("categoryProduct");
}
else
{
    $_SESSION['error'] = "Xóa thất bại";
    redirectAdmin("categoryProduct");
}
?>
