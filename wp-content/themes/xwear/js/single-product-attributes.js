jQuery(document).ready(function($) {
    const submitButton = $('.single_add_to_cart_button')
    const counterInput = $('input[name="quantity"]')

    function setHiddenInputValue() {
        const productVariations = $('form.variations_form.cart').data('product_variations');
        let selectAttributes = {}
        const variationInput = $('.variation_id')
    
        $('.dropdown__attribute-input-hidden').each((index, el) => {
            let name = $(el).attr('name');
            selectAttributes['attribute_' + name] = $(el).val();
        })
    
        $(productVariations).each((index, el) => {
            let element = $(el)[0]
            if(JSON.stringify(selectAttributes) === JSON.stringify(element.attributes)) {
                variationInput.val(element.variation_id)
                counterInput.attr({
                    min: element.min_qty,
                    max: element.max_qty,
                })
                counterInput.val(element.min_qty)
            }
        })

        $('form.variations_form').trigger('show_variation', [, true])
    }
    setHiddenInputValue()
    
    $('.dropdown__list .dropdown__list--item').on('click', () => {
        setHiddenInputValue();
    })
    
})