<?php
get_header();
//show_array($list_product)
?>
<div id="main-content-wp" class="category-product-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail clearfix">
                <?php // if(!empty($total_record)) { ?>
                <h3 class="title fl-left">Có <?php echo $total_record ?> sản phẩm được tìm thấy</h3>
                <?php // } ?>
            </div>
        </div>
    </div>
    <div class="section" id="filter-wp">
        <div class="wp-inner">
            <div class="section-detail">
            </div>

        </div>
    </div>

    <div class="section" id="list-product-wp" style="min-height: 200px">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <?php
                    if (!empty($list_product)) {
                        foreach ($list_product as $product) {
                            ?>
                            <li>
                                <a href="<?php echo $product['url_detail'] ?>" title="" class="thumb">
                                    <img src="<?php echo $product['url'] ?>" alt="">
                                </a>
                                <div class="info">
                                    <a href="" title="" class="name-product"><?php echo $product['title'] ?></a>
                                    <div class="price-wp">
                                        <span class="new"><?php echo $product['price_affter_sale'] ?></span>
                                        <span class="old"><?php echo $product['price'] ?></span>
                                    </div>
                                    <a href="<?php echo $product['url_add_cart'] ?>" title="" class="buy-now">Mua ngay</a>
                                </div>
                            </li>
                            <?php
                        }
                    } else {
                        echo 'Không có sản phẩm nào được tìm thấy';
                    }
                    ?>

                </ul>
            </div>
        </div>
    </div>
    <?php
    echo $html_pagination;
    ?>
</div>

<?php
get_footer()
?>