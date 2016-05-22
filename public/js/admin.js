$(function() {

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('a[rel="external"]').attr('target', '_blank');

  $('body').on('click', '[data-toggle="offcanvas"]', function (e) {
    e.preventDefault();
    var d = new Date();
    d.setTime(d.getTime()+(24*3600*1000));
    if ($('body').hasClass('sidebar-collapse')) {
      document.cookie = "admin-sidebar-collapse=1;path=/;expires="+d.toUTCString();
    } else {
      document.cookie = "admin-sidebar-collapse=;path=/;expires="+d.toUTCString();
    }
  })
  .on('click', '[data-action]', function (e) {
    var $el = $(this),
      action = $el.data('action');

    if (action == 'back') {
      if (!document.referrer) return true;
      history.back();
      return false;
    } else if (action == 'ajax-delete') {
      e.preventDefault();
      var $el = $(this),
        action = $el.attr('href'),
        msg = $el.parents('[data-confirm-delete]').data('confirm-delete');

      if (confirm(msg)) {
        $.ajax({
          url: action,
          type: "post",
          data: {'_method': 'DELETE'},
          error: function(xhr, status, error) {
            alert('Error: '+xhr.responseText);
          }
        }).done(function(data) {
          //location.reload();
          $.pjax.reload({container: 'section.content', timeout: 3000});
        });
      }
      return false;
    } else if (action == 'delete') {
      e.preventDefault();
      var $el = $(this),
        $form = $el.parents('form').first(),
        $method = $form.find('input[name="_method"]'),
        msg = $form.data('confirm-delete');
      if (confirm(msg)) {
        $method.val('DELETE');
        $form.submit();
      }
      return false;
    }
    return true;
  })
  .on('click', '.grid-view .labels a', function (e) {
    e.preventDefault();
    var $a = $(this),
        attr = $a.data('attr'),
        search = '?order['+attr+']='+($a.hasClass('asc')?'desc':'asc');
    //location.search = search;
    $.pjax({url: location.protocol+'//'+location.host+location.pathname+search, container: 'section.content'});
  }).on('submit', '.grid-view form[name="filters"]', function(e) {
    $.pjax.submit(e, 'section.content');
  });

  $(document).pjax('.pagination a, .grid-view .filters a', 'section.content');
});

// set grid view header classes (asc/desc)
$(document).on('ready pjax:success', function() {
  $('.grid-view .labels a').each(function () {
    var $a = $(this),
        attr = $a.data('attr'),
        $p = $a.parents('.labels'),
        order = $p.data('order'),
        direction = $p.data('direction');
    if (order == attr) {
        $a.addClass(direction == 'desc' ? 'desc' : 'asc');
    }
  });

});



function getUrlParam(name) {
  var half = location.search.split('&' + name + '=')[1];
  if (!half) half = location.search.split('?' + name + '=')[1];
  return half !== undefined ? decodeURIComponent(half.split('&')[0]) : null;
}