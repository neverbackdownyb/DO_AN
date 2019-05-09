<?php
get_header();
$message = get_flash_data();
?>
<div id="main-content-wp" class="list-cat-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?page=add_cat" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Danh sách danh mục</h3>
             <p><?php echo $message ?></p>
        </div>
       
    </div>
    <div class="wrap clearfix">
        <div id="sidebar" class="fl-left">
            <ul id="list-cat">
                <li>
                    <a href="?page=list_post" title="">Danh sách bài viết</a>
                </li>
                <li>
                    <a href="?page=list_cat" title="">Danh mục bài viết</a>
                </li>
            </ul>
        </div>
        <div id="content" class="fl-right">                       
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tiêu đề</span></td>
                                    <td><span class="thead-text">ID</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                    <td><span class="thead-text">Thao tác</span></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stt = 0;
                                foreach ($list_catagory as $item_select) {
                                    $stt++;
                                    ?>
                                    <tr>

                                        <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                        <td><span class="tbody-text"><?php echo $stt; ?></span>
                                        <td class="clearfix">
                                            <div class="tb-title fl-left">
                                                <a href="" title=""><?php echo str_repeat('----', $item_select['level']);
                                echo $item_select['catagory'];
                                    ?></a>
                                            </div> 
                                        </td>
                                        <td><span class="tbody-text"><?php echo $item_select['id']; ?></span></td>
                                        <td><span class="tbody-text">Hoạt động</span></td>
                                        <td><span class="tbody-text">admin</span></td>
                                        <td><span class="tbody-text"><?php echo $item_select['reg_at_fomat']; ?></span></td>
                                        <td>
                                            <ul>
                                                <li><a href="<?php echo $item_select['url_edit']; ?> " title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                <li><a href="<?php echo $item_select['url_delete']; ?> " title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                            </ul>
                                        </td>
                                    </tr>
<?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
                    <ul id="list-paging" class="fl-right">
                        <li>
                            <a href="" title=""><</a>
                        </li>
                        <li>
                            <a href="" title="">1</a>
                        </li>
                        <li>
                            <a href="" title="">2</a>
                        </li>
                        <li>
                            <a href="" title="">3</a>
                        </li>
                        <li>
                            <a href="" title="">></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>