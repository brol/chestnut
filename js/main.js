$(function() {

    // Slider - Cycle Plugin
    $('#slider').cycle({
        fx: 'fade', // choose your transition type, ex: fade, scrollUp, shuffle, etc...
        timeout: 8000
    });

    // Jquery - Autocomplete Plugin
    $('#q,#query').autocomplete({
        minLength: 2,
        source: website.ajaxsearch,
        select: function(event, ui) {
            $(this).val(ui.item.label);
            $(this).closest("form").submit();
        }
    });

    // Jquery - Tabs
    if($("#tabs").length > 0) {
        $("#tabs").tabs({ show: { effect: "fade", duration: 800 } });

        if(document.location.hash!='') {
                tabSelect = document.location.hash.substr(1,document.location.hash.length);
                if(tabSelect.match(/^comment/) != null) {
                  $("#tabs").tabs('enable','#comment');
                }

                if(tabSelect.match(/^c[1-9]/) != null) {
                  $("#tabs").tabs('enable','#comment');
                  $("#tabs").on('tabsactivate', function(event, ui) {
                    var $target = $(document.location.hash);
                    var targetOffset = $target.offset().top;
                    $("html,body").animate({scrollTop: targetOffset-100}, 1000);
                  });
                }

                if(tabSelect.match(/^pr/) != null) {
                  $("#tabs").tabs('enable','#comment');
                  $("#tabs").on('tabsactivate', function(event, ui) {
                    var $target = $(document.location.hash);
                    var targetOffset = $target.offset().top;
                    $("html,body").animate({scrollTop: targetOffset-100}, 1000);
                  });
                }
        }

        $("#linktocomment a").click(function() {
            $("#tabs").tabs('enable','#comment');
            var $target = $(document.location.hash);
            $("html,body").animate({scrollTop: $target-100}, 1000);
        });
    }

});