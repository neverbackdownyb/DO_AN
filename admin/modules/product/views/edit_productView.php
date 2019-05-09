<?php get_header();
// show_array($data)
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?page=add_post" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Chỉnh sửa bài viết</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">                       
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <!--<form method="POST" action=""  enctype="multipart/form-data" id="form-upload-single">-->
                    <form method="POST" action="" id="form-upload-single">
                        <label for="title" >Tiêu đề</label>
                        <p class="error"><?php form_error('title');?></p>
                        <input type="text" name="title" id="title" value="<?php echo $product['title'];?>">
                        
                        <label for="title">Mã sản phẩm</label>
                        <p class="error"><?php form_error('product_code');?></p>
                        <input type="text" name="product_code" id="slug" value="<?php echo $product['product_code'] ?>">
                          
                        <label for="qty">Số lượng</label>
                        <p class="error"><?php form_error('qty')?></p>
                        <input type="qty" name="qty" id="qty" value="<?php echo $product['qty_total'] ?>">
                   
                        <label>Khoảng giá</label>
                        <p class="error"><?php form_error('price_range') ?></p>
                        <select name ="price_range">
                            <option value="">Trạng thái</option>
                            <?php foreach ($list_price as $k => $v) {?>
                            <option <?php selected($product['price_range'], $v['id'])?> value="<?php echo $v['id']; ?>">--<?php echo $v['title'] ?></option>
                            <?php } ?>
                        </select>
                        
                        <label for="title">Giá sản phẩm</label>
                        <p class="error"><?php form_error('price');?></p>
                        <input type="text" name="price" id="price" value="<?php echo $product['price']  ?>">
                      
                        <label for="sale_off">Khuyến mại (%)</label>
                        <p class="error"><?php form_error('sale_off')?></p>
                        <input type="number" name="sale_off"  id="sale_off" value="<?php echo $product['sale_off'] ?>">
                        
                        <label for="title">Giá sản phẩm sau khuyến mại</label>
                        <p class="error"><?php form_error('price_affter_sale');?></p>
                        <input type="text" name="price_affter_sale" id="price_affter_sale" value="<?php echo $product['price_affter_sale']  ?>">
                      
                        <label for="disscount"> Giảm giá </label>
                        <p class="error"><?php form_error('disscount')?></p>
                        <input type="number" name="disscount" id="disscount" step="5" value="<?php echo $product['disscount'] ?>">
                     
                        <label for="excerpt">Mô tả ngắn</label>
                        <p class="error"><?php form_error('excerpt')?></p>
                        <textarea name="excerpt" id="excerpt" class="ckeditor"><?php echo $product['excerpt'] ?></textarea>
                        
                        <label for="desc">Chi tiết sản phẩm</label>
                        <p class="error"><?php form_error('desc')?></p>
                        <textarea name="desc" id="desc" class="ckeditor"><?php echo $product['description'] ?></textarea>
                        
                        <label>Hình ảnh</label>
                            <p class="error"><?php form_error('id_media');?></p>
                      <div id="result"></div>
                        <div id="uploadFile" class="clearfix">
                            <input type="file" name="file" id="file" data-uri="?mod=media&controller=index&action=upload_single">
                            <input type="hidden" name="id_media" value="<?php echo $product['id_media']; ?>" id="id_media">
                                 <input type="submit" name="Upload" value="Upload" id="upload_single_bt">
                            <img src="<?php echo $product['link'] ?>">
                        </div>
                      
                        <label>Danh mục cha</label>
                        <p class="error"><?php form_error('cat_product_id');?></p>
                        </label>
                         <select name="cat_product_id">
                            <option value="0">-- Chọn danh mục --</option>
                            <?php foreach ($list_catagory_product as $item_select) { ?>
                                <option <?php selected($product['cat_product_id'], $item_select['id'])?> value="<?php echo $item_select['id'] ?>"> <?php echo str_repeat('----', $item_select['level']) . $item_select['catagory'] ?></option>
                            <?php } ?>
                        </select>
                        <button type="submit" name="submit_add" id="btn-submit" value="Thêm mới">Cập Nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>