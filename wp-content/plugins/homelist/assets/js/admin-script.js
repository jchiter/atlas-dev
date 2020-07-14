var image_field;

jQuery(document).ready(function ($) {
    $(document).on('click', 'input.upload_button', function (evt) {
        image_field = $(this).siblings('#custom_term_image_meta');
        tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
        window.send_to_editor = function (html) {
            imgurl = $('img', html).attr('src');
            image_field.val(imgurl);
            tb_remove();
        }
        return false;
    });
});




