<?php
get_header();
// show_array($list_menu)
//show_array($list_price)
?>
<div id="main-content-wp" class="add-cat-page menu-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="#" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Khoảng giá </h3>
            <h3 id="index" style="text-align: center"><?php echo $message ?></h3>
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
                            <input type="text" name="title" id="title">
                            <p style="color: red"><?php form_error('title') ?></p>
                        </div>
                        
                        <div class="form-group">
                            <label for="menuorder_numorder">Thứ tự</label>
                            <input type="text" name="order_num" id="menu-order">
                            <p style="color: red"><?php form_error('order_num') ?></p>
                        </div>


                        <div class="form-group">
                            <button type="submit" name="sm_add" id="btn-save-list">Thêm mới</button>
                        </div>
                    </form>
                </div>
                <div id="category-menu" class="fl-right">
                    <div class="actions">
                        <form method="POST" action="?mod=product&controller=price&action=task" class="form-actions">
                        <select name="actions">
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
                                    <td style="text-align: center;"><span class="thead-text">Tổng sản phẩm</span></td>
                                    <td style="text-align: center;"><span class="thead-text">Thứ tự</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php
                                    foreach ($list_price as $item) { ?>
                                    <tr>
                                        <td><input type="checkbox" name="item_check_box[]" class="checkItem" value="<?php echo $item['id'] ;?>"></td>
                                        <td><span class="tbody-text"><?php echo $item['stt'] ?></span>
                                        <td>
                                            <div class="tb-title fl-left">
                                                <a href="" title=""><?php echo $item['title']; ?></a>
                                            </div>
                                        </td>
                                        <td style="text-align: center;"><span class="tbody-text"><?php echo $item['total_product'] ?></span></td>
                                        <td style="text-align: center;"><span class="tbody-text"><?php echo $item['order_num']; ?></span></td>
                                         <td>
                                            <ul class="list-operation fl-right">
                                                <li><a href="<?php echo $item['url_edit']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                <li><a href="<?php echo $item['url_delete'] ;?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                            </ul>
                                        </td>
                                    </tr>
<?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tên menu</span></td>
                                    <td style="text-align: center;"><span class="thead-text">Slug</span></td>
                                    <td style="text-align: center;"><span class="thead-text">Thứ tự</span></td>
                                </tr>
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