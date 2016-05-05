$(function() {

$('a[rel="external"]').attr('target', '_blank');


var $body = $('body');

$body.on('click', '[data-toggle="offcanvas"]', function (el) {
  var d = new Date();
  d.setTime(d.getTime()+(24*3600*1000));
  if ($('body').hasClass('sidebar-collapse')) {
    document.cookie = "admin-sidebar-collapse=1;path=/;expires="+d.toUTCString();
  } else {
    document.cookie = "admin-sidebar-collapse=;path=/;expires="+d.toUTCString();
  }
});


$body.on('click', 'a[data-action]', function () {
  var $el = $(this),
    action = $el.data('action');
  if (action == 'back') {
    if (!document.referrer) return true;
    history.back();
    return false;
  }
  return true;
});


});