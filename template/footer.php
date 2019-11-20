</div>

  <!-- Footer Links -->
  <div class="container-fluid text-center text-md-left mt-2" style="color: white; background-color: #1B3409">

    <!-- Grid row -->
    <div class="row">

      <!-- Grid column -->
      <div class="col-md-3 mx-auto">

        <!-- Links -->
        <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Về chúng tôi</h5>
        <hr>
        <ul class="list-unstyled">
          <li>
            <a href="#!">Giới thiệu công ty</a>
          </li>
          <li>
            <a href="#!">Chính sách bảo mật thanh toán</a>
          </li>
          <li>
            <a href="#!">Chính sách giải quyết khiếu nại</a>
          </li>
          <li>
            <a href="#!">Khách hàng doanh nghiệp</a>
          </li>
        </ul>

      </div>
      <!-- Grid column -->

      <hr class="clearfix w-100 d-md-none">

      <!-- Grid column -->
      <div class="col-md-3 mx-auto">

        <!-- Links -->
        <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Hỗ trợ khách hàng</h5>
        <hr>
        <ul class="list-unstyled">
          <li>
            <a href="#!">Hotline đặt hàng</a>
          </li>
          <li>
            <a href="#!">Hotline chăm sóc khách hàng</a>
          </li>
          <li>
            <a href="#!">Câu hỏi thường gặp</a>
          </li>
          <li>
            <a href="#!">Hướng dẫn đặt hàng</a>
          </li>
        </ul>

      </div>
      <!-- Grid column -->

      <hr class="clearfix w-100 d-md-none">

      <!-- Grid column -->
      <div class="col-md-3 mx-auto">

        <!-- Links -->
        <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Thanh toán</h5><hr>

        <img class="img-fluid" src="images/thanh-toan.jpg">

      </div>
      <!-- Grid column -->

      <hr class="clearfix w-100 d-md-none">

      <!-- Grid column -->
      <div class="col-md-3 mx-auto">

        <!-- Links -->
        <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Kết nối với chúng tôi</h5>
        <hr>
        <ul class="list-unstyled">
          <li>
            <a href="#!">Link 1</a>
          </li>
          <li>
            <a href="#!">Link 2</a>
          </li>
          <li>
            <a href="#!">Link 3</a>
          </li>
          <li>
            <a href="#!">Link 4</a>
          </li>
        </ul>

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Links -->

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2019 Copyright:
    <a href="index.php">Mysite.com</a>
  </div>
  <!-- Copyright -->

<script>
$(document).ready(function(){
    // add to cart button listener
    $('.add-to-cart-form').on('submit', function(){
 
        // info is in the table / single product layout
        var id = $(this).find('.product-id').text();
        var quantity = $(this).find('.cart-quantity').val();
 
        // redirect to add_to_cart.php, with parameter values to process the request
        window.location.href = "add_to_cart.php?id=" + id + "&quantity=" + quantity;
        return false;
    });

    // update quantity button listener
	$('.update-quantity-form').on('submit', function(){
	 
	    // get basic information for updating the cart
	    var id = $(this).find('.product-id').text();
	    var quantity = $(this).find('.cart-quantity').val();
	    var price = $(this).find('.product-price').val();
	 
	    // redirect to update_quantity.php, with parameter values to process the request
	    window.location.href = "update_quantity.php?id=" + id + "&quantity=" + quantity+"&price=" + price;
	    return false;
	});
});
</script>
</body>
</html>