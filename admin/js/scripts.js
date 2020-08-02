$(document).ready(function () {
  var user_href;
  var user_href_splitted;
  var user_id;
  var photo_src;
  var photo_src_splitted;
  var photo_name;
  var photo_id;

  /********************* Edit Phot Side BAr **********************/

  $(".info-box-header").click(function () {
    $(".inside").slideToggle("fast");
    $("#toggle").toggleClass(" glyphicon-menu-down glyphicon  , glyphicon-menu-up glyphicon");
  });

  /********************* Edit Phot Side BAr **********************/

/********************* Delete Photo **********************/
$(".delete_link").click(function(){
    return confirm("Are you sure you want to delete this Item");
})
/********************* Delete Photo **********************/



  $(".modal_thumbnails").click(function () {
    $("#set_user_image").prop("disabled", false);
    user_href = $("#user-id").prop("href");
    user_href_splitted = user_href.split("=");
    user_id = user_href_splitted[user_href_splitted.length - 1];

    photo_src = $(this).prop("src");
    photo_src_splitted = photo_src.split("/");
    photo_name = photo_src_splitted[photo_src_splitted.length - 1];
    photo_id = $(this).attr("data");
    $.ajax({
      url: "includes/ajax_code.php",
      data: { photo_id: photo_id, photo_src: photo_src },
      type: "POST",
      success: function (data) {
        if (!data.error) {
          $("#modal_sidebar").html(data);
        }
      },
    });
  });
  $("#set_user_image").click(function () {
    $.ajax({
      url: "includes/ajax_code.php",
      data: { photo_name: photo_name, user_id: user_id },
      type: "POST",
      success: function (data) {
        if (!data.error) {
          $(".user_image_box a img").prop("src", data);
        }
      },
    });
  });
  tinymce.init({ selector: "textarea" });
});
