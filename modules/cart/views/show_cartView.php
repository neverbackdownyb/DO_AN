<?php
get_header();
//unset($_SESSION['cart']);
//show_array($_SESSION['cart']['info'])
//show_array($_SESSION)
?>
<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail clearfix">
                <h3 class="title fl-left">Giỏ hàng</h3>
                <ul class="list-breadcrumb fl-right">
                    <li>
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Giỏ hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
        <div id="wrapper" class="wp-inner clearfix">
            <form method="POST" action="?mod=cart&controller=index&action=update_cart">
            <div class="section" id="info-cart-wp">
                <div class="section-detail table-responsive">
                    <?php if (!empty($list_show_cart)) { ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>Mã sản phẩm</td>
                                    <td>Tên sản phẩm</td>
                                    <td>Ảnh sản phẩm</td>
                                    <td>Giá sản phẩm</td>
                                    <td>Số lượng</td>
                                    <td colspan="2">Thành tiền</td>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($list_show_cart as $product) { ?>
                                    <tr>
                                        <td><?php echo $product['code'] ?></td>
                                        <td>
                                            <a href="" title="" class="name-product"><?php echo $product['title'] ?></a>
                                        </td>
                                        <td>
                                            <a href="" title="" class="thumb">
                                                <img src="<?php echo $product['url_image'] ?>" alt="">
                                            </a>
                                        </td>
                                        <td><?php echo currency_format($product['price_affter_sale']) ;?></td>
                                        <td>
                                            <input type="text" name="num-order[<?php echo $product['id']?>]" value="<?php echo $product['qty'] ?>" class="num-order">
                                        </td>
                                        <td><?php echo currency_format($product['sub_total']) ?></td>
                                        <td>
                                            <a href="<?php echo $product['url_delete_cart']; ?>" title="" class="del-product"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "Không có sản phẩm trong giỏ hàng . Vui lòng bấm <a href='?'>vào đây </a>để quay lại trang chủ! ";
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <?php if(!empty($info_cart)){ ?>
                                <td colspan="7">
                                    <div class="clearfix">
                                        <p id="total-price" class="fl-right">Tổng giá: <span><?php echo currency_format($info_cart['total']) ;?></span></p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7">
                                    <div class="clearfix">
                                        <div class="fl-right">      
                                            <input type="submit" id="checkout-cart" value="Cập nhật giỏ hàng">
                                            <a href="?mod=cart&controller=index&action=check_out" title="" id="checkout-cart">Thanh toán</a>
                                        </div>
                                    </div>
                                </td>
                                
                                <?php } ?>
                            </tr>
                        </tfoot>

                    </table>
                </div>
            </div>
            <div class="section" id="action-cart-wp">
                <div class="section-detail">
                    <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhập vào số lượng <span>0</span> để xóa sản phẩm khỏi giỏ hàng. Nhấn vào thanh toán để hoàn tất mua hàng.</p>
                    <a href="?mod=home&controller=index&action=index" title="" id="buy-more">Mua tiếp</a><br/>
                    <a href="<?php echo "?mod=cart&controller=index&action=delete_cart"?>" title="" id="delete-cart">Xóa giỏ hàng</a>
                </div>
            </div>
        </div>
    </form>
</div>
<?php get_footer() ?>