// Blog
jQuery(document).on("click", "#load-more-btn", function() {
  jQuery("a.blogtile").show();
  jQuery(this).hide();

  return false;
});

// Header
jQuery(window).load(function() {
  jQuery(".pace").fadeOut(1000);
});

jQuery(window).scroll(function(){
  jQuery('header').toggleClass('smaller', jQuery(window).scrollTop() >= 5);
});

// Single-gallery
jQuery(".photo.simple-hover").removeClass("checked");

var items = [];

function image_show() {
  jQuery(".photo.simple-hover.checked").each(function() {
    var tempurl = extractUrl(jQuery(this).children("a.photo_link").attr('href'));
    var filename = tempurl.substring(tempurl.lastIndexOf('/') +1 );

    items.push("<p>"+filename+"</p>");

    jQuery("#text-area-img").val(items);
  });
};

jQuery(document).on('click','.proof-it',function(e) {
  setTimeout(function() {
    image_show();
  }, 3000);
});

jQuery('.tac').hide();

jQuery(".photo.simple-hover").click(function() {
  jQuery('.tac').toggle(jQuery(".photo.simple-hover.checked").length >=0);
});

function extractUrl(input) {
  return input.replace(/"/g,"").replace(/url\(|\)$/ig, "\n");
}
