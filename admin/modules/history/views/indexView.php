<?php
get_header();
?>
<div id="main-content-wp" class="list-product-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?page=add_cat" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Lịch sử </h3>
            <p> <?php echo $message; ?></p>
        </div>
       
    </div>
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">                       
            <!--<div class="section" id="detail-page">-->
            <div class="section-detail">
                <div class="filter-wp clearfix">
                    <form method="GET" class="form-s fl-right">
                        <input type="hidden" name="mod" value="history">
                        <input type="hidden" name="controller" value="index" >
                        <input type="hidden" name="action" value="index">
                        <input type="text" name="search" id="search">
                        <input type="submit" name="sm_s" value="Tìm kiếm">
                    </form>                  
                    <ul class="post-status fl-left">
                        <li class="all"><a href="?mod=history&controller=index&action=index">Tất cả <span class="count">(<?php echo get_num_history() ?>)</span></a></li>
                    </ul>
                </div>
                <div class="actions">
                    <form method="POST" action="?mod=history&controller=index&action=task" class="form-actions">
                        <select name="actions">
                            <option value="">Tác vụ</option>
                            <option value="delete">Xóa vĩnh viễn</option>
                        </select>
                        <input type="submit" name="sm_action" value="Áp dụng">

                        </div>
                        <div class="table-responsive">
                            <table class="table list-table-wp">
                                <thead>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Tên người sửa</span></td>
                                        <td><span class="thead-text">Thao tác</span></td>
                                        <td><span class="thead-text">Danh mục</span></td>
                                        <td><span class="thead-text">Tiêu đề</span></td>
                                        <td><span class="thead-text">Thời gian</span></td>
                                        <td><span class="thead-text">Xóa</span></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $stt = 0;
                                    foreach ($history as $k => $v) {
                                        $stt ++;
                                        ?>
                                   
                                        <tr>
                                            <td><input type="checkbox" name="item_check_box[]" class="checkItem" value="<?php echo $v['id']; ?>"></td>
                                            <td><span class="tbody-text"><?php echo $stt ?></h3></span>
                                            <td><span class="tbody-text"><?php echo $v['created_by'] ?></h3></span>
                                            <td>
                                                <div class="tb-title fl-left">
                                                    <a href="" title=""><?php echo $v['action'] ?></a>
                                                </div>
                                            </td>
                                            <td><span class="tbody-text"><?php echo $v['catagory'] ?></span></td>
                                            <td><span class="tbody-text"><?php echo $v['content'] ?></span></td>
                                            <td><span class="tbody-text"><?php echo $v['reg_at_fomat'] ?></span></td>
                                            <td>
                                                <ul >
                                                    <li><a href="<?php echo $v['delete']; ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
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
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <ul id="list-paging" class="fl-right">
                        <li>
                            <a href="" title=""><</a>
                        </li>
                        <li>
                            <?php echo $html_pagging;?>
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