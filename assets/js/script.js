$(function() {

    $("div.alert .btn-close").click(function() {
        $(this.parentElement).hide();
    });
    

    var $c = $(".grid");

    var masonryOptions = {
        itemSelector: '.grid-item',
        columnWidth: '.grid-sizer',
        gutter: '.gutter-sizer',
        horizontalOrder: true, //
        percentPosition: true
    }
    
    var $grid = $c.masonry( masonryOptions );

    if(!!$('input[name=is_admin]').val()){
    
        $c.sortable({
            start: function(event, ui) {
                console.log(ui); 
                ui.item.removeClass('grid-item');
                $grid.masonry('reloadItems');
                $grid.masonry('destroy'); // destroy
                $grid.masonry( masonryOptions );
            },

            change: function(event, ui) {
                $grid.masonry('reloadItems');
                $grid.masonry('destroy'); // destroy
                $grid.masonry( masonryOptions );
            },

            stop: function(event, ui) { 
                ui.item.addClass('grid-item');
                $grid.masonry('reloadItems');
                $grid.masonry('destroy'); // destroy
                $grid.masonry( masonryOptions );
            },

            update: function() {            
                var arr = [];
                $.each($('.grid .item'), function(index, el) {
                    var id = $(el).attr('itemid');
                    arr.push({"id": id, "order": index+1 });
                });
                $.ajax({
                    url: "/items/update_order",
                    type: 'POST',
                    data: {
                    'items': arr,
                    'cur_page': $('input[name=cur_page]').val(),
                    'per_page': $('input[name=per_page]').val()
                    }    
                });
            }

        }).disableSelection();
    }
});