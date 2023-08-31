</div>

<!-- Footer -->
<footer class="w3-row-padding w3-padding-32" style="padding-left: 265px; padding-top: 65px!important; padding-bottom: 65px!important;">
    <div class="w3-third">
      <h3>CONTACT</h3>
      <p>HaNoi, VietNam</p>
      <p>Phone: 0868378580</p>
      <p>Email: manhdinh@gmail.com</p>
    </div>

    <div class="w3-third">
      <h3>BLOG POSTS</h3>
      <ul class="w3-ul w3-hoverable">
        <li class="w3-padding-16">
          <img src="<?php echo uploads() ?>/slider/21.jpg" class="w3-left w3-margin-right" style="width:50px">
          <span class="w3-large">iPhone</span><br>
          <span>Buy now</span>
        </li>
      </ul>
    </div>
  
    
    <div class="w3-third w3-serif">
      <h3>POPULAR TAGS</h3>
      <p>
        <span class="w3-tag w3-black w3-margin-bottom">Smartphone</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">iPhone</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">SamSung</span>
        <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Xiaomi</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">OPPO</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Vivo</span>
        <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Realme</span> <span class="w3-tag w3-dark-grey w3-small w3-margin-bottom">Nokia</span>
      </p>
    </div>
  </footer>

<!-- <div class="container-pluid footer" style="margin-left:250px">
    <section id="footer-button">
        <div class="container-pluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 no-padding-r">
                        <div class="footer-custom foooter-contact">
                            <h3 class="tittle-footer"> Liên hệ</h3>
                            <ul>
                                <li>

                                    <p><i class="fa fa-home" style="font-size: 16px;padding-right: 5px;"></i> Cự Đà - Cự Khê - Thanh Oai - Hà Nội </p>
                                    <p><i class="sp-ic fa fa-mobile" style="font-size: 22px;padding-right: 5px;"></i> 0971005069</p>
                                    <p><i class="sp-ic fa fa-envelope" style="font-size: 13px;padding-right: 5px;"></i> manhdinh@gmail.com</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 no-padding-l">
                        <h3 class="tittle-footer">Liên kết</h3>
                        <ul class="social-footer">
                            <li class="facebook-ft">
                                <a target="_blank" href="https://www.facebook.com/profile.php?id=100017009025619/">
                                    <i class="fa fa-facebook-f"></i>
                                </a>
                            </li>
                            <li class="youtube-ft">
                                <a target="_blank" href="#">
                                    <i class="fa fa-youtube"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <div class="chat-fb">
        <!-- WhatsHelp.io widget -->
        <script type="text/javascript">
            (function () {
                var options = {
                    facebook: "279937849074204", // Facebook page ID
                    call_to_action: "Message us", // Call to action
                    position: "right", // Position may be 'right' or 'left'
                };
                var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
                var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
                s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
                var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
            })();
        </script>
        <!-- /WhatsHelp.io widget -->

        

        <div class="scroll-top">
            <a href="javascript:" id="return-to-top"><i class="fa fa-arrow-up"></i></a>
            <script type="text/javascript">
                // ===== Scroll to Top ====
                $(window).scroll(function() {
                    if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
                        $('#return-to-top').fadeIn(200);    // Fade in the arrow
                    } else {
                        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
                    }
                });
                $('#return-to-top').click(function() {      // When arrow is clicked
                    $('body,html').animate({
                        scrollTop : 0                       // Scroll to top of body
                    }, 500);
                });
            </script>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
<script  src="<?php echo base_url() ?>public/frontend/js/slick.min.js"></script>

</body>

</html>

<script type="text/javascript">
    $(function() {
        $hidenitem = $(".hidenitem");
        $itemproduct = $(".item-product");
        $itemproduct.hover(function(){
            $(this).children(".hidenitem").show(100);
        },function(){
            $hidenitem.hide(500);
        })
    })


    // $(function () {
    //     $updatecart = $(".updatecart");
    //     $updatecart.click(function (e) {
    //         e.preventDefault();
    //         $qty = $(this).parents("tr").find(".qty").val();
    //         console.log($qty);
    //         $key = $(this).attr("data-key");
    //         $.ajax({
    //            url: 'cap-nhat-gio-hang.php',
    //             type: 'GET',
    //             data: {'qty':$qty, 'key':$key},
    //             success:function (data)
    //             {
    //                 if (data == 1)
    //                 {
    //                     alert("Cập nhật giỏ hàng thành công");
    //                     location.href = 'gio-hang.php';
    //                 }
    //             }
    //         });
    //     })
    // })


    $(function(){
        $updatecart = $(".updatecart");
        $updatecart.click(function(e) {
            e.preventDefault();
            $qty = $(this).parents("tr").find(".qty").val();

            $key = $(this).attr("data-key");

            console.log($key);
            $.ajax({
                url: 'cap-nhat-gio-hang.php',
                type: 'GET',
                data: {'qty': $qty, 'key':$key},
                success:function(data)
                {
                    if (data == 1)
                    {
                        alert('Bạn đã cập nhật giỏ hàng thành công!');
                        location.href='gio-hang.php';
                    }
                    else
                    {
                        alert('Xin lỗi! Số lượng bạn mua vượt quá số lượng hàng có trong kho!');
                        location.href='gio-hang.php';
                    }
                }
            });

        })
    })
</script>