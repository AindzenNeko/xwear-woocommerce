jQuery(document).ready(function($) {
    $(document.body).on('updated_cart_totals', counters_init);

    let timeout;
    $('.woocommerce').on('change', 'input.qty', function(){
        if ( timeout !== undefined ) {
            clearTimeout( timeout );
        }
        timeout = setTimeout(function() {
            $("[name='update_cart']").trigger("click");
        }, 500 );
    });
    $('.woocommerce').on('click', '.counter__btn', function(){
        $("[name='update_cart']").prop('disabled', false)

        if ( timeout !== undefined ) {
            clearTimeout( timeout );
        }
        timeout = setTimeout(function() {
            $("[name='update_cart']").trigger("click");
        }, 500 );
        
    });
})