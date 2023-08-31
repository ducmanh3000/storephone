<?php
require_once __DIR__."/autoload/autoload.php";
$user = $db->fetchID("users",intval($_SESSION['name_id']));
//_debug($user);

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $data =
    [
        "amount" => $_SESSION['total'],
        "users_id" => $_SESSION['name_id'],
        "note" => postInput("note")
    ];
    $idtran = $db->insert('transaction', $data);
    if ($idtran > 0)
    {
        foreach ($_SESSION['cart'] as $key => $value)
        {
            $data2 =
            [
                'transaction_id' => $idtran,
                'product_id' => $key,
                'qty' => $value['qty'],
                'qty' => $value['qty'],
                'price' => $value['price']
            ];

            $id_insert = $db->insert('orders', $data2);
        }

//        unset($_SESSION['cart']);
//        unset($_SESSION['total']);
        $_SESSION['success'] = "Đặt hàng thành công ! Chúng tôi sẽ liên hệ với bạn sớm nhất.";
        header("location: thong-bao.php");
    }
}

?>


<?php require_once __DIR__."/layouts/header.php"; ?>

<div class="col-md-9 bor">
    <link href="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.css" rel="stylesheet"/>
        <script src="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.js"></script>
        <script type="text/javascript">
            $("#btnPopup").click(function () {
                var postData = $("#create_form").serialize();
                var submitUrl = $("#create_form").attr("action");
                $.ajax({
                    type: "POST",
                    url: submitUrl,
                    data: postData,
                    dataType: 'JSON',
                    success: function (x) {
                        console.log(x.data)
                        if (x.code === '00') {
                            // if (window.vnpay) {
                            //     vnpay.open({width: 768, height: 600, url: x.data});
                            // } else {
                            //
                            // }
                            location.href = x.data;
                            return false;
                        } else {
                            alert(x.Message);
                        }
                    }
                });
                return false;
            });
        </script>
<script src="https://js.stripe.com/v3"></script>
    <section class="box-main1">
        <div class="product-title">
            <h2>
                <a href="#">
                    Thanh toán đơn hàng
                </a>
            </h2>
        </div>
        <div class="form-custom">
            <form action="" method="POST" class="form-horizontal" role="form">
                <div class="form-group">
                    <label for="name">Họ và tên khách hàng</label>
                    <input type="text" readonly="" name="name" class="form-control" id="exampleInputName" placeholder="Nhập họ và tên" value="<?php echo $user['name'] ?>">
                </div>

                <div class="form-group">
                    <label for="name">Email</label>
                    <input type="text" readonly="" name="email" class="form-control" id="exampleInputEmail" placeholder="Nhập email" value="<?php echo $user['email'] ?>">
                </div>

                <div class="form-group">
                    <label for="name">Số điện thoại</label>
                    <input type="number" readonly="" name="phone" class="form-control" id="exampleInputName" placeholder="Nhập số điện thoại" value="<?php echo $user['phone'] ?>">
                </div>

                <div class="form-group">
                    <label for="name">Địa chỉ</label>
                    <input type="text" readonly="" name="address" class="form-control" id="exampleInputName" placeholder="Nhập địa chỉ" value="<?php echo $user['address'] ?>">
                </div>

                <div class="form-group" required>
                        <label for="bank_code">Ngân hàng</label>
                        <select name="bank_code" id="bank_code" class="form-control">
                            <option value="">Không chọn</option>
                            <option value="NCB"> Ngan hang NCB</option>
                            <option value="AGRIBANK"> Ngan hang Agribank</option>
                            <option value="SCB"> Ngan hang SCB</option>
                            <option value="SACOMBANK">Ngan hang SacomBank</option>
                            <option value="EXIMBANK"> Ngan hang EximBank</option>
                            <option value="MSBANK"> Ngan hang MSBANK</option>
                            <option value="NAMABANK"> Ngan hang NamABank</option>
                            <option value="VNMART"> Vi dien tu VnMart</option>
                            <option value="VIETINBANK">Ngan hang Vietinbank</option>
                            <option value="VIETCOMBANK"> Ngan hang VCB</option>
                            <option value="HDBANK">Ngan hang HDBank</option>
                            <option value="DONGABANK"> Ngan hang Dong A</option>
                            <option value="TPBANK"> Ngân hàng TPBank</option>
                            <option value="OJB"> Ngân hàng OceanBank</option>
                            <option value="BIDV"> Ngân hàng BIDV</option>
                            <option value="TECHCOMBANK"> Ngân hàng Techcombank</option>
                            <option value="VPBANK"> Ngan hang VPBank</option>
                            <option value="MBBANK"> Ngan hang MBBank</option>
                            <option value="ACB"> Ngan hang ACB</option>
                            <option value="OCB"> Ngan hang OCB</option>
                            <option value="IVB"> Ngan hang IVB</option>
                            <option value="VISA"> Thanh toan qua VISA/MASTER</option>
                        </select>
                    </div>

                <div class="form-group">
                    <label for="name">Tổng tiền</label>
                    <input type="text" readonly="" name="price" class="form-control" id="exampleInputName" placeholder="" value="<?php echo formatPrice($_SESSION['total']) ?>">
                </div>

                <div class="form-group">
                    <label for="name">Nội dung thanh toán</label>
                    <textarea type="text" name="note" class="form-control" id="order_desc" placeholder="Nội dung thanh toán" value="" rows="4"></textarea>
                    <p class="note-text" style="color: red; font-style: italic; font-weight: bold; margin-top: 10px;">Chú ý: ND thanh toán quý khách vui lòng không ghi dấu. Xin chân thành cảm ơn !</p>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Đặt hàng</button>
                    <button class="stripe-button" id="payButton">
                        <div class="spinner hidden" id="spinner"></div>
                        <span id="buttonText">Pay Now</span>
                    </button>
                    <a type="submit" style="float: right" name="redirect" href="index1.php" class="btn btn-success">Thanh toán VNPAY</a>
                    <a type="submit" style="float: right" id="btnPopup" href="vnpay_create_payment.php" name="redirect" class="btn btn-success">Thanh toán</a>
                </div>
            </form>
        </div>

        <!-- Nội dung -->
    </section>
    
</div>

<script>
    // Đặt khóa có thể xuất bản của Stripe để khởi tạo Stripe.js 
    const stripe = Stripe('<?php echo STRIPE_PUBLISHABLE_KEY; ?>');

    // Chọn nút thanh toán
    const payBtn = document.querySelector("#payButton");

    // Xử lý yêu cầu thanh toán 
    payBtn.addEventListener("click", function (evt) {
        setLoading(true);

        createCheckoutSession().then(function (data) {
            if(data.sessionId){
                stripe.redirectToCheckout({
                    sessionId: data.sessionId,
                }).then(handleResult);
            } else {
                handleResult(data);
            }
        });
    });

    // Tạo Phiên thanh toán với sản phẩm đã chọn
    const createCheckoutSession = function (stripe) {
        return fetch("payment_init.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                createCheckoutSession: 1,
            }),
        }).then(function (result) {
            return result.json();
        });
    };

    // Xử lý bất kỳ lỗi nào được trả về từ Checkout
    const handleResult = function (result) {
        if (result.error) {
            showMessage(result.error.message);
        }
        setLoading(false);
    }; // Hiển thị spinner khi xử lý thanh toán

    function setLoading(isLoading) {
    if (isLoading) {
        // Vô hiệu hóa nút và hiển thị spinner 
        payBtn.disabled = true;
        document.querySelector("#spinner").classList.remove("hidden");
        document.querySelector("#buttonText").classList.add("hidden");
    } else {
        // Kích hoạt nút và ẩn spinner
        payBtn.disabled = false;
        document.querySelector("#spinner").classList.add("hidden");
        document.querySelector("#buttonText").classList.remove("hidden");
    }
}

// Hiển thị tin nhắn
function showMessage(messageText) {
    const messageContainer = document.querySelector("#paymentResponse");
	
    messageContainer.classList.remove("hidden");
    messageContainer.textContent = messageText;
	
    setTimeout(function () {
        messageContainer.classList.add("hidden");
        messageText.textContent = "";
    }, 5000);
}
</script>
<?php require_once __DIR__."/layouts/footer.php"; ?>


