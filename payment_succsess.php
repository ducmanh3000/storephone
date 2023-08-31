<?php 
// Bao gồm tệp cấu hình 
require_once 'config.php'; 
 
// Bao gồm tệp kết nối cơ sở dữ liệu    
include_once 'dbConnect.php'; 
 
$payment_id = $statusMsg = ''; 
$status = 'error'; 
 
// Kiểm tra xem phiên kiểm tra sọc có trống không 
if(!empty($_GET['session_id'])){ 
    $session_id = $_GET['session_id']; 
     
    // Lấy dữ liệu giao dịch từ cơ sở dữ liệu nếu đã tồn tại 
    $sqlQ = "SELECT * FROM transactions WHERE stripe_checkout_session_id = ?"; 
    $stmt = $db->prepare($sqlQ);  
    $stmt->bind_param("s", $db_session_id); 
    $db_session_id = $session_id; 
    $stmt->execute(); 
    $result = $stmt->get_result(); 
 
    if($result->num_rows > 0){ 
        // Chi tiết giao dịch 
        $transData = $result->fetch_assoc(); 
        $payment_id = $transData['id']; 
        $transactionID = $transData['txn_id']; 
        $paidAmount = $transData['paid_amount']; 
        $paidCurrency = $transData['paid_amount_currency']; 
        $payment_status = $transData['payment_status']; 
         
        $customer_name = $transData['customer_name']; 
        $customer_email = $transData['customer_email']; 
         
        $status = 'success'; 
        $statusMsg = 'Your Payment has been Successful!'; 
    }else{ 
        // Bao gồm thư viện Stripe PHP
        require_once 'stripe-php/init.php'; 
         
        //  Đặt khóa API  
        $stripe = new \Stripe\StripeClient(STRIPE_API_KEY); 
         
        // Tìm nạp Phiên thanh toán để hiển thị kết quả JSON trên trang thành công 
        try { 
            $checkout_session = $stripe->checkout->sessions->retrieve($session_id); 
        } catch(Exception $e) {  
            $api_error = $e->getMessage();  
        } 
         
        if(empty($api_error) && $checkout_session){ 
            // Nhận thông tin chi tiết về khách hàng 
            $customer_details = $checkout_session->customer_details; 
 
            // Truy xuất thông tin chi tiết của PaymentIntent 
            try { 
                $paymentIntent = $stripe->paymentIntents->retrieve($checkout_session->payment_intent); 
            } catch (\Stripe\Exception\ApiErrorException $e) { 
                $api_error = $e->getMessage(); 
            } 
             
            if(empty($api_error) && $paymentIntent){ 
                // Kiểm tra xem thanh toán có thành công hay không 
                if(!empty($paymentIntent) && $paymentIntent->status == 'succeeded'){ 
                    // Chi tiết giao dịch  
                    $transactionID = $paymentIntent->id; 
                    $paidAmount = $paymentIntent->amount; 
                    $paidAmount = ($paidAmount/100); 
                    $paidCurrency = $paymentIntent->currency; 
                    $payment_status = $paymentIntent->status; 
                     
                    // Thông tin khách hàng 
                    $customer_name = $customer_email = ''; 
                    if(!empty($customer_details)){ 
                        $customer_name = !empty($customer_details->name)?$customer_details->name:''; 
                        $customer_email = !empty($customer_details->email)?$customer_details->email:''; 
                    } 
                     
                    // Kiểm tra xem có bất kỳ dữ liệu giao dịch nào đã tồn tại với cùng ID TXN 
                    $sqlQ = "SELECT id FROM transactions WHERE txn_id = ?"; 
                    $stmt = $db->prepare($sqlQ);  
                    $stmt->bind_param("s", $transactionID); 
                    $stmt->execute(); 
                    $result = $stmt->get_result(); 
                    $prevRow = $result->fetch_assoc(); 
                     
                    if(!empty($prevRow)){ 
                        $payment_id = $prevRow['id']; 
                    }else{ 
                        // Chèn dữ liệu giao dịch vào cơ sở dữ liệu 
                        $sqlQ = "INSERT INTO transactions (customer_name,customer_email,item_name,item_number,item_price,item_price_currency,paid_amount,paid_amount_currency,txn_id,payment_status,stripe_checkout_session_id,created,modified) VALUES (?,?,?,?,?,?,?,?,?,?,?,NOW(),NOW())"; 
                        $stmt = $db->prepare($sqlQ); 
                        $stmt->bind_param("ssssdsdssss", $customer_name, $customer_email, $productName, $productID, $productPrice, $currency, $paidAmount, $paidCurrency, $transactionID, $payment_status, $session_id); 
                        $insert = $stmt->execute(); 
                         
                        if($insert){ 
                            $payment_id = $stmt->insert_id; 
                        } 
                    } 
                     
                    $status = 'Thành công'; 
                    $statusMsg = 'Bạn đã thanh toán thành công!'; 
                }else{ 
                    $statusMsg = "Thanh toán thất bại!"; 
                } 
            }else{ 
                $statusMsg = "Giao dịch lỗi! $api_error";  
            } 
        }else{ 
            $statusMsg = "Giao dịch không hợp lệ! $api_error";  
        } 
    } 
}else{ 
    $statusMsg = "Yêu cầu không hợp lệ!"; 
} 
?>

<?php if(!empty($payment_id)){ ?>
    <h1 class="<?php echo $status; ?>"><?php echo $statusMsg; ?></h1>
	
    <h4>Thông tin thanh toán</h4>
    <p><b>Số tham chiếu:</b> <?php echo $payment_id; ?></p>
    <p><b>ID giao dịch:</b> <?php echo $transactionID; ?></p>
    <p><b>Số tiền đã thanh toán:</b> <?php echo $paidAmount.' '.$paidCurrency; ?></p>
    <p><b>Trạng thái thanh toán:</b> <?php echo $payment_status; ?></p>
	
    <h4>Thông tin khách hàng</h4>
    <p><b>Tên: </b> <?php echo $customer_name; ?></p>
    <p><b>Email:</b> <?php echo $customer_email; ?></p>
	
    <h4>Thông tin sản phẩm</h4>
    <p><b>Tên:</b> <?php echo $productName; ?></p>
    <p><b>Giá:</b> <?php echo $productPrice.' '.$currency; ?></p>
<?php }else{ ?>
    <h1 class="error">Thanh toán thất bại!</h1>
    <p class="error"><?php echo $statusMsg; ?></p>
<?php } ?>