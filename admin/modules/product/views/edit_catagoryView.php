<?php get_header();
// show_array($list_catagory_product)
?>

<div id="main-content-wp" class="add-cat-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?page=add_post" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Chỉnh sửa danh mục</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">                       
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" action="" enctype="multipart/form-data" id="form-upload-single">
                        <label for="title">Tiêu đề</label>
                        <input type="text" name="title" id="title" value="<?php echo $catagory_product_by_id['catagory'] ;?>">
                        <label>Danh mục cha</label>
                        <select name="parent_cat">
                            <option value="0">-- Chọn danh mục --</option>
                            <?php foreach ($list_catagory_product as $item_select) { ?>
                            <option <?php selected($catagory_product_by_id['parent_id'], $item_select['id'])?>value="<?php echo $item_select['id'] ?>"> <?php echo str_repeat('----', $item_select['level']) . $item_select['catagory'] ?></option>
                            <?php } ?>
                        </select>
                        <button type="submit" name="submit_add" id="btn-submit" value="Cập nhật">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>