<?php
get_header();
// show_array($info_cart)
?>
<div id="main-content-wp" class="checkout-page">
    <form method="POST" action="">
        <div class="section" id="breadcrumb-wp">
            <div class="wp-inner">
                <div class="section-detail clearfix">
                    <h3 class="title fl-left">Thanh toán</h3>
                    <ul class="list-breadcrumb fl-right">
                        <li>
                            <a href="?page=home" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="" title="">Thanh toán</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="wrapper" class="wp-inner clearfix">
            <div class="section" id="customer-info-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin khách hàng</h1>
                </div>
                <div class="section-detail">
                    <form method="POST" action="" name="form-checkout">
                        <div class="form-row clearfix">
                            <div class="form-col fl-left">
                                <label for="fullname">Họ tên</label>
                                <p class="error"><?php form_error('fullname')?></p>
                                <input type="text" name="fullname" id="fullname">
                            </div>
                            <div class="form-col fl-right">
                                <label for="email">Email</label>
                                <p class="error"><?php form_error('email')?></p>
                                <input type="email" name="email" id="email">
                            </div>
                        </div>
                        <div class="form-row clearfix">
                            <div class="form-col fl-left">
                                <label for="address">Địa chỉ</label>
                                <p class="error"><?php form_error('address')?></p>
                                <input type="text" name="address" id="address">
                                
                            </div>
                            <div class="form-col fl-right">
                                <label for="">Số điện thoại</label>
                                <p class="error"><?php form_error('phone')?></p>
                                <input type="tel" name="phone" id="phone">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-col">
                                <label for="notes">Ghi chú</label>
                                <p class="error"><?php form_error('notes')?></p>
                                <textarea name="note"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="section" id="order-review-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin đơn hàng</h1>
                </div>
                <div class="section-detail">
                    <table class="shop-table">
                        <thead>
                            <tr>
                                <td>Sản phẩm</td>
                                <td>Tổng</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list_show_cart as $product) { ?>
                                <tr class="cart-item">
                                    <td class="product-name"><?php echo $product['title'] ?><strong class="product-quantity">x <?php echo $product['qty'] ?></strong></td>
                                    <td class="product-total"><?php echo currency_format($product['sub_total']) ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr class="order-total">
                                <td>Tổng đơn hàng: <?php echo $info_cart['qty'] ?></td>
                                <td><strong class="total-price"><?php echo currency_format($info_cart['total']); ?></strong></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div id="payment-checkout-wp">
                                <p class="error"><?php form_error('payment_methods')?></p>
                        <ul id="payment_methods">
                            <li>
                                <input type="radio" id="direct-payment" name="payment-method" value="direct-payment">
                                <label for="direct-payment">Thanh toán tại cửa hàng</label>
                            </li>
                            <li>
                                <input type="radio" id="payment-home" name="payment-method" value="payment-home">
                                <label for="payment-home">Thanh toán tại nhà</label>
                            </li>
                        </ul>
                    </div>
                    <div class="place-order-wp clearfix">
                        <input type="submit" id="order-now" value="Đặt hàng">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?php get_footer() ?>
