<?php
get_header();
?>
<div id="main-content-wp" class="list-product-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?page=add_cat" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Danh sách media</h3>
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
                        <input type="hidden" name="mod" value="media">
                        <input type="hidden" name="controller" value="index" >
                        <input type="hidden" name="action" value="index">
                        <input type="text" name="search" id="search">
                        <input type="submit" name="sm_s" value="Tìm kiếm">
                    </form>                  
                    <ul class="post-status fl-left">
                        <li class="all"><a href="?mod=media&controller=index&action=index">Tất cả <span class="count">(<?php echo get_num_media('ad') ?>)</span></a></li>
                        <li class="all"><a href="?mod=media&controller=index&action=index&status=bin">Ảnh rác<span class="count">(<?php echo get_num_media('bin') ?>)</span></a></li>
                    </ul>
                </div>
                <div class="actions">
                    <form method="POST" action="?mod=media&controller=index&action=task" class="form-actions">
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
                                        <td><span class="thead-text">Đường dẫn</span></td>
                                        <td><span class="thead-text">Danh mục</span></td>
                                        <td><span class="thead-text">Hình ảnh</span></td>
                                        <td><span class="thead-text">Thời gian</span></td>
                                        <td><span class="thead-text">Thao tác</span></td>
                                    </tr>
                                </thead>
                                <tbody>
                                            <?php
                                            $stt = 0;
                                            foreach ($list_media as $item) {
//                                    show_array($item);
                                                $stt ++;
                                                ?>
                                                <tr>
                                                    <td><input type="checkbox" name="item_check_box[]" value="<?php echo $item['id']; ?>"class="checkItem"></td>
                                                    <td><span class="tbody-text"><?php echo $stt ?></span>     </td>
                                                    <td><?php echo $item['link']; ?></td>
                                                    <td><?php echo $item['type']; ?></td>
                                                    <td>
                                                        <div class="tbody-thumb">
                                                            <img src="<?php echo $item['link']; ?>" alt="">
                                                        </div>
                                                    </td>
                                                    <td><?php echo $item['reg_at_fomat']; ?></td>

                                                    <td>
                                                        <ul class="list-operation">
                                                            <li><a href="<?php echo $item['url_delete']; ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
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