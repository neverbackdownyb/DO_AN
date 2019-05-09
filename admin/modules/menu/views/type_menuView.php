<?php
get_header();
// show_array($list_menu)
//show_array($list_type_menu)
?>
<div id="main-content-wp" class="add-cat-page menu-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="#" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Menu</h3>
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
                            <label for="title">Loại menu</label>
                            <input type="text" name="title" id="title">
                            <p style="color: red"><?php form_error('title') ?></p>
                        </div>

                        <div class="form-group">
                            <label for="num_order">Thứ tự</label>
                            <input type="text" name="num_order" id="menu-order">
                            <p style="color: red"><?php form_error('num_order') ?></p>
                        </div>


                        <div class="form-group">
                            <button type="submit" name="sm_add" id="btn-save-list">Thêm mới</button>
                        </div>
                    </form>
                </div>
                <div id="category-menu" class="fl-right">
                    <div class="actions">
                        <form method="POST" action="?mod=menu&controller=type_menu&action=task" class="form-actions">
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
                                    <td><span class="thead-text">Tên menu</span></td>
                                    <td style="text-align: center;"><span class="thead-text">Người tạo</span></td>
                                    <td style="text-align: center;"><span class="thead-text">Thứ tự</span></td>
                                    <td style="text-align: center;"><span class="thead-text">Loại menu</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php  $stt =0;
                                    foreach ($list_type_menu as $item) { 
                                        
                                        $stt ++?>
                                    <tr>
                                        <td><input type="checkbox" name="item_check_box[]" class="checkItem" value="<?php echo $item['id'] ;?>"></td>
                                        <td><span class="tbody-text"><?php echo $stt ?></span>
                                        <td>
                                            <div class="tb-title fl-left">
                                                <a href="" title=""><?php echo $item['type_menu']; ?></a>
                                            </div>
                                        </td>
                                        <td style="text-align: center;"><span class="tbody-text"><?php echo $item['created_by']; ?></span></td>
                                        <td style="text-align: center;"><span class="tbody-text"><?php echo $item['order_num']; ?></span></td>
                                        <td style="text-align: center;"><span class="tbody-text"><?php echo $item['reg_at_fomat']; ?></span></td>
                                        <td>
                                            <ul class="list-operation fl-right">
                                                <li><a href="<?php echo $item['url_edit']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                <li><a href="<?php echo $item['url_delete'] ;?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                            </ul>
                                        </td>
                                    </tr>
<?php } ?>
                            </tbody>
                        </table>
                    </div>
</form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>