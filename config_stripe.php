<?php 
require_once __DIR__."/autoload/autoload.php";
$user = $db->fetchID("users",intval($_SESSION['name_id']));

$productName = $user['name'];
$productID = $_SESSION['cart'];
$productPrice = $_SESSION['total'];
$currency = "vnd";

define('STRIPE_API_KEY', 'sk_test_51N9kg6EoESZMtdqEV5MPFcCwV4seAcJ4mZRxgdwHZwL0zB29nP5IQM25EFzI5SLKNAnz0cdc0tTV8tkEeZWLk5TE005zNXrKVi');
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_51N9kg6EoESZMtdqEGKGMXKYCAPnbizKKHMixvLsMpJC4NVMq8PMOQ1yrs3HtPAkhmaP7sdAt5jVaywQSJ9suVqZo00ZewFHdgD');
define('STRIPE_SUCCSESS_URL', 'http://localhost/storephone/payment_succsess.php');
define('STRIPE_CANCEL_URL', 'http://localhost/storephone/payment_cancel.php');

define('DB_HOST', 'localhost')
define('DB_USERNAME', 'root')
define('DB_PASSWORD', 'root')
define('DB_NAME', 'storephone')
?>