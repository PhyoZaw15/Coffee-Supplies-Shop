$(document).ready(function(){
    // Delete form modal
    $(document).on('show.bs.modal','#deleteModal', function (e) {
        var button = $(e.relatedTarget);
        $('delete_id').val(button.data('id'));
        var url = button.data('url');
        $('#deleteModalFormAction').attr('action', url);
    });

    // Select Size form modal
    $(document).on('show.bs.modal','#selectSizeWhenAddToCart', function (e) {
        var button = $(e.relatedTarget);
        $('product_id').val(button.data('id'));
        var url = button.data('url');
        $('#selectSizeWhenAddToCartFormAction').attr('action', url);
    });

    // alert message timeout
    setTimeout(function(){
        $("div.alert").remove();
    }, 5000 ); // 5 secs

});