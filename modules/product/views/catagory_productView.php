<?php
get_header();
//show_array($list_product) 
?>
<div id="main-content-wp" class="category-product-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail clearfix">
                <h3 class="title fl-left"><?php echo $catagory['catagory'] ?></h3>
                <ul class="list-breadcrumb fl-right">
                    <li>
                        <a href="?page=home" title="">Sản Phẩm</a>
                    </li>
                    <li>
                        <a href="" title=""><?php echo $catagory['catagory'] ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="section" id="filter-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <form method="GET" action="">
                            <input type="hidden" name="mod" value="product">
                            <input type="hidden" name="controller" value="catagory_product">
                            <input type="hidden" name="action" value="catagory_product">
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <input type="hidden" name="search" value="<?php echo $search ?>">
                            <select name="price">
                                <option value="">Lọc theo giá</option>
                                <?php foreach ($list_price as $k => $v) { ?>
                                    <option value="<?php echo $v['id'] ?>"><?php echo $v['title'] ?></option>
                                <?php } ?>
                            </select>
                            <button type="submit" name="btn-filter-price" id="btn-filter-price">Lọc</button>
                        </form>
                    </li>
                    <li>
                        <form method="GET" action="" id="form-s-product">
                            <input type="hidden" name="mod" value="product">
                            <input type="hidden" name="controller" value="catagory_product">
                            <input type="hidden" name="action" value="catagory_product">
                            <input type="hidden" name="price" value="<?php echo $price ?>">
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <input type="text" name="search" id="s-product" placeholder="Tìm kiếm">
                            <button type="submit" name="btn_search" id="btn-s-product"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </form>
                    </li>
                </ul>
            </div>
              </form>
        </div>
    </div>
    <div class="section" id="list-product-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <?php
                    foreach ($list_product as $product) {
                        if (!empty($product)) {
                            ?>
                            <li>
                                <a href="<?php echo $product['url_detail']; ?>" title="" class="thumb">
                                    <img src="<?php echo $product['link']; ?>" alt="">
                                </a>
                                <div class="info">
                                    <a href="<?php echo $product['url_detail']; ?>" title="" class="name-product"><?php echo $product['title']; ?></a>
                                    <div class="price-wp">
                                        <span class="new"><?php echo $product['price_affter_sale']; ?></span>
                                        <span class="old"><?php echo $product['price']; ?></span>
                                    </div>
                                    <a href="<?php echo $product['show_cart']; ?>" title="" class="buy-now">Mua ngay</a>
                                </div>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="section" id="pagination-wp">
        <div class="wp-inner">
            <div class="pagination">
                <strong>1</strong>
                <a href="" title="">2</a>
                <a href="" title>3</a>
                <a href="">&gt;</a>                    
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>