<?php
get_header();
//show_array($list_post);
//exit ;
?>

<div id="main-content-wp" class="list-post-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?page=add_cat" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Danh sách bài viết</h3>
            <p> <?php echo $message; ?></p>
        </div>

    </div>
    <div class="wrap clearfix">
        <?php get_sidebar() ?>
        <div id="content" class="fl-right">                       
            <div class="section" id="detail-page">
                <form method="GET" class="form-s fl-right">
                    <input type="hidden" name="mod" value="post"id="s">
                    <input type="hidden" name="controller" value="post" id="s">
                    <input type="hidden" name="action" value="index"id="s">
                    <input type="hidden" name="status" value="<?php echo $status; ?>"id="s">
                    <input type="text" name="search" id="s" placeholder="Tên bài viết">
                    <input type="submit" name="sm_s" value="Tìm kiếm">
                </form>
                <div class="section-detail">
                    <div class="filter-wp clearfix">

                        <ul class="post-status fl-left">
                            <li class="all"><a href="?mod=post&controller=post&action=index">Tất cả <span class="count">(<?php echo get_number_post(''); ?>)</span></a> |</li>
                            <li class="publish"><a href="?mod=post&controller=post&action=index&status=active">Đã đăng <span class="count">(<?php echo get_number_post('active'); ?>)</span></a> |</li>
                            <li class="pending"><a href="?mod=post&controller=post&action=index&status=pendy">Chờ xét duyệt <span class="count">(<?php echo get_number_post('pendy'); ?>)</span></a> |</li>
                            <li class="trash"><a href="?mod=post&controller=post&action=index&status=bin">Thùng rác <span class="count">(<?php echo get_number_post('bin'); ?>)</span></a></li>
                        </ul>


                    </div>

                    <div class="actions">
                        <form method="POST" action="?mod=post&controller=post&action=task" class="form-actions">
                            <select name="actions">
                                <option value="0">Tác vụ</option>
                                <?php foreach ($option as $k => $v) { ?>
                                    <option value="<?php echo $k ?>"><?php echo $v ?></option>
                                <?php } ?>
                            </select>
                            <input type="submit" name="sm_action" value="Áp dụng">

                            </div>
                            <div class="table-responsive">
                                <table class="table list-table-wp">
                                    <thead>
                                        <tr>
                                            <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                            <td><span class="thead-text">STT</span></td>
                                            <td><span class="thead-text">Tiêu đề</span></td>
                                            <td><span class="thead-text">Hình ảnh</span></td>
                                            <td><span class="thead-text">Danh mục</span></td>
                                            <td><span class="thead-text">Trạng thái</span></td>
                                            <td><span class="thead-text">Người tạo</span></td>
                                            <td><span class="thead-text">Thời gian</span></td>
                                            <td><span class="thead-text">Thao tác</span></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $stt = 0;
                                        foreach ($list_post as $item) {
//                                    show_array($item);
                                            $stt ++;
                                            ?>
                                            <tr>
                                                <td><input type="checkbox" name="item_check_box[]" value="<?php echo $item['id']; ?>"class="checkItem"></td>
                                                <td><span class="tbody-text"><?php echo $stt ?></span>
                                                <td class="clearfix">
                                                    <div class="tb-title fl-left">
                                                        <a href="" title=""><?php echo $item['title']; ?></a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="tbody-thumb">
                                                        <img src="<?php echo $item['link']; ?>" alt="">
                                                    </div>
                                                </td>
                                                <td><span class="tbody-text"><?php echo $item['catagory'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo $item['status']; ?></span></td>
                                                <td><span class="tbody-text"><?php echo $item['created_by']; ?></span></td>
                                                <td><span class="tbody-text"><?php echo $item['reg_at_fomat']; ?></span></td>
                                                <td>
                                                    <ul class="list-operation">
                                                        <li><a href="<?php echo $item['url_edit']; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
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
    <?php get_footer(); ?>