<?php
get_header();
// show_array($list_price)
?>
<div id="main-content-wp" class="add-cat-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?page=add_post" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Thêm mới sản phẩm</h3>
        </div>
    </div>
    <div class="wrap clearfix">
<?php get_sidebar() ?>
        <div id="content" class="fl-right">                       
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <!--<form method="POST" action=""  enctype="multipart/form-data" id="form-upload-single">-->
                    <form method="POST" action="" id="form-upload-single">
                        <label for="title">Tiêu đề</label>
                        <p class="error"><?php form_error('title') ?></p>
                        <input type="text" name="title" id="title" value="<?php set_value('title') ?>">

                        <label for="slug">Slug</label>
                        <p class="error"><?php form_error('slug') ?></p>
                        <input type="text" name="slug" id="slug" value="<?php set_value('slug') ?>">

                        <label for="code">Mã sản phẩm</label>
                        <p class="error"><?php form_error('code') ?></p>
                        <input type="text" name="code" id="code" value="<?php set_value('code') ?>">

                        <label for="qty">Số lượng</label>
                        <p class="error"><?php form_error('qty') ?></p>
                        <input type="number" name="qty" id="qty" value="<?php set_value('qty') ?>">

                       <label>Khoảng giá</label>
                        <p class="error"><?php form_error('price_range') ?></p>
                        <select name ="price_range">
                            <option value="">Trạng thái</option>
                            <?php foreach ($list_price as $k => $v) {?>
                            <option value="<?php echo $v['id']; ?>">--<?php echo $v['title'] ?></option>
                            <?php } ?>
                        </select>

                        <label for="price">Giá sản phẩm</label>
                        <p class="error"><?php form_error('price') ?></p>
                        <input type="text" name="price" id="price" value="<?php set_value('price') ?>">

                        <label for="sale_off">Khuyến mại (%)</label>
                        <p class="error"><?php form_error('sale_off') ?></p>
                        <input type="number" name="sale_off"  id="sale_off" step="1" min="0" max="50"  value="<?php set_value('sale_off') ?>">

                        <label for="price_affter_sale"  >Giá sản phẩm sau khuyến mại </label>
                        <input type="text" name="price_affter_sale"  id ="price_affter_sale" value="<?php set_value('price_affter_sale') ?>">

                        <label for="disscount"> Giảm giá </label>
                        <p class="error"><?php form_error('disscount') ?></p>
                        <input type="number" name="disscount" id="disscount" min="0" value="<?php set_value('disscount') ?>">


                        <label for="excerpt">Mô tả ngắn</label>
                        <p class="error"><?php form_error('excerpt') ?></p>
                        <textarea name="excerpt" id="excerpt" class="ckeditor"><?php echo set_value('excerpt') ?></textarea>

                        <label for="desc">Chi tiết sản phẩm</label>
                        <p class="error"><?php form_error('desc') ?></p>
                        <textarea name="desc" id="desc" class="ckeditor"><?php echo set_value('desc') ?></textarea>

                        <label>Hình ảnh</label>
                        <p class="error"><?php form_error('id_media') ?></p>
                        <div id="result"></div>
                        <div id="uploadFile" class="clearfix">
                            <input type="file" name="file" id="file" data-uri="?mod=media&controller=index&action=upload_single">
                            <input type="hidden" name="id_media" value="<?php set_value('id_media') ?>" id="id_media">
                            <input type="submit" name="Upload" value="Upload" id="upload_single_bt">
                            <img src="public/images/img-thumb.png">
                        </div>

                        <label>Danh mục cha</label>
                        <p class="error"><?php form_error('cat_id') ?></p>
                        </label>
                        <select name="cat_id">
                            <option value="">-- Chọn danh mục --</option>
                            <?php foreach ($list_catagory as $item_select) { ?>
                                <option <?php selected_form('cat_id', $item_select['id']) ?> value="<?php echo $item_select['id'] ?>"> <?php echo str_repeat('----', $item_select['level']) . $item_select['catagory'] ?></option>
                            <?php } ?>
                        </select>
                        <label> Trạng Thái</label>
                        <p class="error"><?php form_error('status') ?></p>
                        <select name ="status">
                            <option value="">Trạng thái</option>
                            <option value="pendy">Chờ duyệt</option>
                            <option value="active">Đã Đăng</option>
                            <option value="bin">Thùng rác</option>
                        </select>
                        <button type="submit" name="submit_add" id="btn-submit" value="Thêm mới">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>