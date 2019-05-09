<?php
get_header();
// show_array($list_menu)
//show_array($catagory_product)
?>
<div id="main-content-wp" class="add-cat-page menu-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="#" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Menu</h3>
            <p> <?php echo $message; ?></p>
        </div>

    </div>

    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">
            <div class="section-detail clearfix">
                <div id="list-menu" class="fl-left">
                    <form  method="POST" action="">
                        <div class="form-group">
                            <label for="title">Tiêu đề</label>
                            <p style="color: red"> <?php form_error('title') ?> </p>
                            <input type="text" name="title" id="title">
                        </div>

                       <div class="form-group clearfix">
                            <label>Danh mục sản phẩm</label>
                            <select name="product_id">
                                <option value="0">-- Chọn --</option>
                                <?php foreach ($catagory_product as $item) { ?>
                                    <option value="<?php echo $item['id']; ?>"><?php
                                        echo str_repeat('----', $item['level']);
                                        echo $item['catagory'];
                                        ?></option> 
<?php } ?>
                            </select>
                            <p style="color: red"> <?php form_error('product_id') ?> </p>
                            <p>Danh mục sản phẩm liên kết đến menu</p>
                        </div>
                        <div class="form-group clearfix">

                            <label>Danh mục bài viết</label>
                            <select name="post_id">
                                <option value="">-- Chọn --</option>
                                    <?php foreach ($catagory_post as $item) { ?>
                                    <option value="<?php echo $item['id']; ?>"><?php
                                        echo str_repeat('----', $item['level']);
                                        echo $item['catagory']
                                        ?></option>
<?php } ?>
                            </select>
                            <p style="color: red"> <?php form_error('post_id') ?> </p>
                            <p>Danh mục bài viết liên kết đến menu</p>
                        </div>


                        <div class="form-group clearfix">
                            <label>Trạng thái</label>
                            <select name="status">
                                <option value="">-- Chọn --</option>
                                <option value="public">Công Khai</option>
                                <option value="pendy">Chờ duyệt</option>
                                <option value="bin">Thùng rác</option>
                            </select>
                            <p style="color: red"><?php form_error('status') ?></p>
                        </div>

                        <div class="form-group">
                            <label for="menu-order">Thứ tự</label>
                            <input type="text" name="menu_order" id="menu-order">
                            <p style="color: red"><?php form_error('menu_order') ?></p>
                        </div>


                        <div class="form-group">
                            <button type="submit" name="sm_add" id="btn-save-list">Thêm mới</button>
                        </div>
                    </form>
                </div>
                <div id="category-menu" class="fl-right">
                    <div class="actions">
                        <form method="POST" action="?mod=menu&controller=index&action=task" class="form-actions">
                            <select name="post_status">
                                <option value="">Tác vụ</option>
                                <option value="destroy">Xóa vĩnh viễn</option>
                            </select>
                            <button type="submit" name="sm_block_status" id="sm-block-status">Áp dụng</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tiêu đề</span></td>
                                    <td style="text-align: center;"><span class="thead-text">Tên danh mục</span></td>
                                    <td style="text-align: center;"><span class="thead-text">Loại danh mục</span></td>
                                    <td style="text-align: center;"><span class="thead-text">Trạng thái</span></td>
                                    <td style="text-align: center;"><span class="thead-text">Thứ tự</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($list_show as $item) { ?>
                                <tr>
                                    <td><input type="checkbox" name="item_check_box[]" class="checkItem" value="<?php // echo $item['id'] ;    ?>"></td>
                                    <td><span class="tbody-text"><?php echo $item['stt']    ?></span>
                                    <td>
                                        <div class="tb-title fl-left">
                                            <a href="" title=""><?php echo $item['title'];     ?></a>
                                        </div>
                                    </td>
                                    <td style="text-align: center;"><span class="tbody-text"><?php echo $item['id_connect'];     ?></span></td>
                                    <td style="text-align: center;"><span class="tbody-text"><?php echo $item['type_connect'];     ?></span></td>
                                    <td style="text-align: center;"><span class="tbody-text"><?php echo $item['status'];     ?></span></td>
                                    <td style="text-align: center;"><span class="tbody-text"><?php echo $item['position'];     ?></span></td>
                                    <td>
                                        <ul class="list-operation fl-right">
                                            <li><a href="<?php echo $item['url_edit'];     ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a href="<?php echo $item['url_delete'] ;    ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>

                            </tfoot>
                        </table>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>