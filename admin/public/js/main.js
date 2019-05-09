$(document).ready(function () {
     $("p.message_error").delay(3000).fadeOut(2000);
     $("p.message_success").delay(3000).fadeOut(2000);
    
    
//  SET HEIGHT CONTENT
    var height = $(window).height() - $('#footer-wp').outerHeight(true) - $('#header-wp').outerHeight(true) - $('#title-page').outerHeight(true);
    $('#content').css('min-height', height);


//  CHECK ALL
    $('input[name="checkAll"]').click(function () {
        var status = $(this).prop('checked');
        $('.list-table-wp tbody tr td input[type="checkbox"]').prop("checked", status);
    });

// EVENT SIDEBAR MENU
    $('#sidebar-menu .nav-item .nav-link .title').after('<span class="fa fa-angle-right arrow"></span>');
    var sidebar_menu = $('#sidebar-menu > .nav-item > .nav-link');
    sidebar_menu.on('click', function () {
        if (!$(this).parent('li').hasClass('active')) {
            $('.sub-menu').slideUp();
            $(this).parent('li').find('.sub-menu').slideDown();
            $('#sidebar-menu > .nav-item').removeClass('active');
            $(this).parent('li').addClass('active');
            return false;
        } else {
            $('.sub-menu').slideUp();
            $('#sidebar-menu > .nav-item').removeClass('active');
            return false;
        }
    });



//Upload ảnh bằng ajax
    var inputFile = $('#file');
    $('#uploadFile #upload_single_bt').click(function () {
        var URI_single = $('#form-upload-single #file').attr('data-uri');
        var fileToUpload = inputFile[0].files[0];
        var formData = new FormData();
        formData.append('file', fileToUpload);
        $.ajax({
            url: URI_single,
            data: formData,
            type: 'POST',
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                if (data.status == 'ok') {
                    $('#result').html(data.result);
                    $('#uploadFile img').attr('src', data.file_path);
                    $('#uploadFile #id_media').attr('value', data.id_media);

                } else {
                    $('#uploadFile #result').html(data.error);
////                    console.log(data.error);
                    alert(data.error);
                }
            },
        });
        return false;
    });

    // Đường dẫn thân thiện
    $('#title').keyup(function () {
        var str = $(this).val();
//        alert(str);
        $.ajax({
            url: "?mod=media&controller=index&action=to_slug",
            data: {title: str},
            type: 'POST',
            dataType: 'text',
            success: function (data) {
                console.log(data);
                $('#slug').val(data);
            },
        });
    });
//     Hiện tiền
    $('#sale_off').keyup(function () {
        var sale_off = $(this).val();
        var price = $('#price').val().split(',');
        price_value = price.join('');

        var price_sale = Math.round(price_value - sale_off * price_value / 100);
        var price_format = price_sale.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
        $('#price_affter_sale').val(price_format);



    });

//    Price Format Js
//    $(document).ready(function () {
    $('#price').keyup(function () {
        var price_value = $(this).val().split(',');
        var price_value = price_value.join('');
        var price_format = price_value.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
        $(this).val(price_format);
    });
    //Giá tiền sau sale 
    $('#price_affter_sale').keyup(function () {
        var price_value = $(this).val().split(',');
        var price_value = price_value.join('');
        var price_format = price_value.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
        $(this).val(price_format);
    });
//    });
    // Xác nhân xóa
    $('.delete i.fa.fa-trash').click(function () {
        return confirm("Bạn có chắc muốn xóa không?");
    });

});