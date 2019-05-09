<?php
get_header();
//show_array(get_id_product_by_title('Laptop')) ;
//show_array($list_products);
?>
<div id="main-content-wp" class="home-page">
    <div id="slider-wp">
        <?php foreach ($list_slider as $item) { ?>
            <div class="item">
                <a href="#"><img src="<?php echo $item['link'] ?> " alt=""></a>
            </div>
        <?php } ?>
    </div>
    <div class="section" id="intro-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <p class="content fl-left">Free ship nội thành</p>
                        <div class="icon fl-right"><i class="fa fa-shopping-cart" aria-hidden="true"></i></div>
                    </li>
                    <li>
                        <p class="content fl-left">Tặng thẻ thành viên</p>
                        <div class="icon fl-right"><i class="fa fa-gift" aria-hidden="true"></i></i></div>
                    </li>
                    <li>
                        <p class="content fl-left">Giảm giá 25% cuối tuần</p>
                        <div class="icon fl-right"><i class="fa fa-paper-plane" aria-hidden="true"></i></div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="section" id="product-discount-wp">
        <div class="wp-inner">
            <div class="section-head">
                <h3 class="section-title">Sản phẩm khuyến mại</h3>
            </div>
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <?php foreach ($list_product_discount as $product_discount) { ?>
                        <li>
                            <a href="<?php echo $product_discount['url_detail']; ?>" title="" class="thumb">
                                <img src="<?php echo $product_discount['link']; ?>" alt="">
                            </a>
                            <div class="info">
                                <div class="discount-tag">-<?php echo $product_discount['sale_off'] . "%"; ?></div>
                                <a href="<?php echo $product_discount['url_detail']; ?>" title="" class="name-product"><?php ?></a>
                                <div class="price-wp">
                                    <span class="new"><?php echo $product_discount['price_affter_sale'] ?></span>
                                    <span class="old"><?php echo $product_discount['price']; ?></span>
                                </div>
                                <a href="<?php echo $product_discount['show_cart']; ?>" title="" class="buy-now">Mua ngay</a>
                            </div>
                        </li>
                    <?php } ?>

                </ul>
            </div>
        </div>
    </div>

    <?php
    if (!empty($list_products)) {
        foreach ($list_products as $title_page => $list_product) {
            if (!empty($list_product)) {
                ?>
                <div class="section" id="list-product-wp">
                    <div class="wp-inner">
                        <div class="section-head clearfix">
                            <h3 class="section-title fl-left"><?php echo $title_page; ?></h3>
                        </div>

                        <div class="section-detail">
                            <ul class="list-item clearfix">
                                <?php foreach ($list_product as $product) { ?>
                                    <li>
                                        <a href="<?php echo $product['url_detail']; ?>" title="" class="thumb">
                                            <img src="<?php echo $product['link'] ?>" alt="">
                                        </a>
                                        <div class="info">
                                            <a href="" title="" class="name-product"><?php echo $product['title'] ?></a>
                                            <div class="price-wp">
                                                <span class="new"><?php echo $product['price_affter_sale']; ?></span>
                                                <span class="old"><?php echo $product['price']; ?></span>
                                            </div>
                                            <a href="<?php echo $product['show_cart'] ?>" title="" class="buy-now">Mua ngay</a>
                                        </div>
                                    </li>
                                <?php } //end foreach 2   ?>
                            </ul>
                        </div>
                            <a href="?mod=product&controller=catagory_product&action=catagory_product&id=<?php echo get_id_product_by_title($title_page) ?>" title="" class="see-more fl-right">Xem thêm</a>
                    </div>
                </div>
            <?php
            } //end foreach 1  
        }
    } //end if 
    ?>

    
    <?php
//    show_array($list_posts);
    if (!empty($list_posts)) {
        foreach ($list_posts as $title_page => $list_post) {
            ?>
            <div class="section" id="blog-wp">
                <div class="wp-inner">
                    <div class="section-head">
                        <h3 class="section-title"><?php echo $title_page; ?></h3>
                    </div>
                    <div class="section-detail">
                        <div id="blog-list">
                            <ul class="list-item">
        <?php foreach ($list_post as $post) { ?>
                                    <li class="item">
                                        <a href="<?php echo $post['url_detail'] ;?>" title="" class="thumb">
                                            <img src="<?php echo $post['link']; ?>" alt="">
                                        </a>
                                        <a href="<?php echo $post['url_detail'] ;?>" title="" class="title"><?php echo $post['title']; ?></a>
                                        <p class="desc"><?php echo $post['excerpt'] ?></p>
                                    </li>
        <?php } ?>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>

    <div class="section" id="promotion-wp">
        <div class="wp-inner">
            <div class="section-head">
                <h3 class="section-title">Đăng ký để nhận khuyến mại</h3>
                <p class="section-desc">Đăng ký để nhận được thông tin khuyến mại mới nhất</p>
            </div>
            <div class="section-detail">
                <form method="POST">
                    <input type="email" name="email" id="email" placeholder="Nhập email của bạn">
                    <input type="submit" value="Đăng ký">
                </form>
            </div>
        </div>
    </div>
</div>

<?php get_footer() ?>