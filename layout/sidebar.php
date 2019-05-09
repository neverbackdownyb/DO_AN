<?php
$product_new = get_list_product_new();
$data = get_list_menu('sidebar');
$side_bar = show_list_tree($data, "", "list-item");
?>


<div id="sidebar" class="fl-right">

    <div class="section" id="category-wp">
        <div class="section-head">
            <h3 class="section-title">Danh mục</h3>
        </div>
        <div class="section-detail">
            <?php echo $side_bar; ?>
        </div>
    </div>
    <div class="section" id="list-popular-wp">
        <div class="section-head">
            <h1 class="section-title">Sản phẩm mới</h1>
        </div>
        <div class="section-detail">
            <ul class="list-item">
                <?php foreach ($product_new as $k => $v) { ?>
                    <li class="clearfix">
                        <a href="<?php echo $v['detail_product'] ?>" title="" class="thumb fl-left">
                            <img src="<?php echo $v['link'] ?>" alt="">
                        </a>
                        <div class="info fl-right">
                            <a href="<?php echo $v['detail_product'] ?>" title="" class="product-name"><?php echo $v['title'] ?></a>
                            <span class="fee"><?php echo $v['price'] ?></span>
                            <a href="<?php echo $v['detail_product'] ?>" title="" class="more">Xem chi tiết</a>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <?php // get_sidebar()  ?>
    </div>
</div>

