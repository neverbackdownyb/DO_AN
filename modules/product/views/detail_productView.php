<?php
get_header();
//show_array($list_product_same_catagory)
//$product_new = get_list_product_new() 
$data = get_list_menu('sidebar');
//$data = show_tree($data);
//show_array($data);
$side_bar = show_list_tree($data, "", "list-item");
//show_array($data)
//echo get_side_bar_post();exit;
?>
<div id="main-content-wp" class="detail-product-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail clearfix">
                <h3 class="title fl-left"><?php echo $title_parent['title'] ?></h3>
                <ul class="list-breadcrumb fl-right">
                    <li>
                        <a href="?page=home" title=""><?php echo $title_parent['catagory'] ?></a>
                    </li>
                    <li>
                        <a href="" title=""><?php echo $title_parent['title'] ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <?php if (!empty($product)) { ?>
        <div id="wrapper" class="wp-inner clearfix">
            <div id="content" class="fl-left">
                <div class="section" id="info-product-wp">
                    <div class="section-detail clearfix">
                        <div class="thumb fl-left">
                            <img src="<?php echo $product['link']; ?>" data-zoom-image="<?php echo $product['link']; ?>"/>
                        </div>
                        <div class="thumb-respon fl-left">
                            <img src="<?php echo $product['link']; ?>">
                        </div>
                        <div class="info fl-right">
                            <h3 id="product-name"><?php echo $product['title']; ?></h3>
                            <span id="product-code"><?php echo $product['product_code']; ?></span>
                            <div class="price">
                                <span class="price-old"><?php echo $product['price_affter_sale']; ?></span>
                                <span class="price-new"><?php echo $product['price']; ?></span>
                            </div>
                            <p id="desc-short"><?php echo $product['excerpt']; ?></p>
                            <!--                            <div id="num-order-wp">
                                                            <span class="title">Số lượng: </span>
                                                            <input type="text" name="num-order" value="1" id="num-order">
                                                        </div>-->
                            <a href="<?php echo $product['add_cart']; ?>" title="" id="add-to-cart">Thêm giỏ hàng</a>
                            <a href="<?php echo $product['show_cart']; ?>" title="" id="buy-now">Mua ngay</a><br/>
                            <a href="" title="" id="support">Hình thức thanh toán</a>
                        </div>
                    </div>

                </div>
                <div class="section" id="detail-product-wp">
                    <div class="section-detail">
                        <div id="tab-wrapper">
                            <ul id="tab-menu" class="clearfix">
                                <li>
                                    <a href="#detail-product" title="">Thông tin sản phẩm</a>
                                </li>
                                <li>
                                    <a href="#comment-product" title="">Bình luận</a>
                                </li>
                            </ul>
                            <div id="tab-content">
                                <div id="detail-product" class="tabItem">
    <!--                                    <p>Lorem Ipsum chỉ đơn giản là một đoạn văn bản giả, được dùng vào việc trình bày và dàn trang phục vụ cho in ấn. Lorem Ipsum đã được sử dụng như một văn bản chuẩn cho ngành công nghiệp in ấn từ những năm 1500, khi một họa sĩ vô danh ghép nhiều đoạn văn bản với nhau để tạo thành một bản mẫu văn bản. Đoạn văn bản này không những đã tồn tại năm thế kỉ, mà khi được áp dụng vào tin học văn phòng, nội dung của nó vẫn không hề bị thay đổi. Nó đã được phổ biến trong những năm 1960 nhờ việc bán những bản giấy Letraset in những đoạn Lorem Ipsum, và gần đây hơn, được sử dụng trong các ứng dụng dàn trang, như Aldus PageMaker.</p>
                                    <p style="text-align: center">
                                        <img src="public/images/img-detail-s.png" alt="">
                                    </p>
                                    <p>Lorem Ipsum chỉ đơn giản là một đoạn văn bản giả, được dùng vào việc trình bày và dàn trang phục vụ cho in ấn. Lorem Ipsum đã được sử dụng như một văn bản chuẩn cho ngành công nghiệp in ấn từ những năm 1500, khi một họa sĩ vô danh ghép nhiều đoạn văn bản với nhau để tạo thành một bản mẫu văn bản. Đoạn văn bản này không những đã tồn tại năm thế kỉ, mà khi được áp dụng vào tin học văn phòng, nội dung của nó vẫn không hề bị thay đổi. Nó đã được phổ biến trong những năm 1960 nhờ việc bán những bản giấy Letraset in những đoạn Lorem Ipsum, và gần đây hơn, được sử dụng trong các ứng dụng dàn trang, như Aldus PageMaker.</p>-->
                                    <?php echo $product['description'] ?>
                                </div>
                                <div id="comment-product" class="tabItem">
                                    <div class="social-wp">
                                        <div class="fb-like" data-href="https://facebook.com/1707310909585150/" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                                        <div class="fb-comments" id="fb-comment" data-href="" data-numposts="5"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="section" id="same-category-wp">
                <div class="section-head">
                    <h3 class="section-title">Cùng chuyên mục</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php foreach ($list_product_same_catagory as $k => $product) { ?>
                            <li class="item">
                                <a href="<?php echo $product['detail_product'] ?>" title="" class="thumb">
                                    <img src="<?php echo $product['link'] ?>" alt="">
                                </a>
                                <div class="info">
                                    <a href="<?php echo $product['detail_product'] ?>" title="" class="name-product"><?php echo $product['title'] ?></a>
                                    <div class="price-wp">
                                        <span class="new"><?php echo $product['price_affter_sale'] ?></span>
                                        <span class="old"><?php echo $product['price'] ?></span>
                                    </div>
                                    <a href="<?php echo $product['show_cart'] ?>" title="" class="buy-now">Mua ngay</a>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php get_sidebar() ?>
    </div>
</div>
<?php get_footer() ?>