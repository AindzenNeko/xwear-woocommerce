jQuery(document).ready(function($){


    function xwear_get_checked_terms() {
        let terms = []
        $('.filters__checkboxes input:checked').each(function() {
            terms.push($(this).val())
        })
        // $('.filters__radioboxes input:checked').each(function() {
        //     terms.push($(this).val())
        // })
        // $('.filters__color input:checked').each(function() {
        //     terms.push($(this).val())
        // })

        return terms;
    }

    function xwear_get_meta_query() {
        let prices = [];

        prices.push($('#input0').val());
        prices.push($('#input1').val());

        return prices;
    }

    function xwear_get_orderby() {
        let orderby = 'menu_order'

        $('.dropdown__list--item').each(function() {
            if($(this).attr('selected')){
                orderby = $(this).attr('data-value');
            }
        })

        orderby = $('.dropdown__input-hidden').val();

        return orderby;
    }

    function xwear_add_events_for_dropdown() {
        var selects = document.querySelectorAll('.dropdown');
        selects.forEach(function (dropdown) {
            var btn = dropdown.querySelector('.dropdown__btn');
            var list = dropdown.querySelector('.dropdown__list');
            var listItems = dropdown.querySelectorAll('.dropdown__list--item');
            var input = dropdown.querySelector('input.dropdown__input-hidden');
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                dropdown.classList.toggle('open');
            });
            listItems.forEach(function (listItem) {
                listItem.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                btn.innerHTML = e.target.innerHTML;
                input.value = e.target.dataset.value;
                btn.classList.add('value-is-selected');
                btn.focus();
                dropdown.classList.remove('open');
                });
            });
            document.addEventListener('click', function (e) {
                if (e.target !== btn) {
                dropdown.classList.remove('open');
                }
            });
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Tab' || e.key === 'Escape') {
                dropdown.classList.remove('open');
                }
            });

            listItems.forEach(function (listItem) {
                listItem.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                if(btn.classList.contains('value-is-selected')) {
                    xwear_get_posts();
                }
                });
            });
        });
    }

    function xwear_add_events_for_pagination() {
        $('.page-numbers[href]').each(function() {
            console.log($(this).attr('href'));
            $(this).on('click', (e) => {
                e.preventDefault();
                e.stopPropagation();

                let paged = 1;
                url = new URL($(this).attr('href'));
                if(url.searchParams.get('paged')) {
                    paged = url.searchParams.get('paged');
                } else {
                    let regex = /page\/\d/;
                    paged = url.href.match(regex)[0].split('/')[1];
                }

                xwear_get_posts(paged);
            })
        })
    }
    xwear_add_events_for_pagination();

    function xwear_get_posts(paged) {

        const paged_value = paged;
        const ajax_url = woocommerce_params.ajax_url; 

        $.ajax({
            type: 'GET',
            url: ajax_url,
            data: {
                action: 'shop_filter',
                terms_query: xwear_get_checked_terms,
                meta_query: xwear_get_meta_query,
                orderby: xwear_get_orderby,
                paged: paged_value,
            },
            beforeSend: function() {
                // catalog__products
                $('.catalog__section').html('Подождите...')
            },
            success: function(response) {
                $('.catalog__section').html(response)

                xwear_add_events_for_dropdown();


                const dropdownBtn = document.querySelector('.dropdown__btn');
                const dropdownItems = document.querySelectorAll('.dropdown__list--item');   
                dropdownItems.forEach(item => {
                    if(item.hasAttribute('selected')) {
                        dropdownBtn.textContent = item.textContent;
                    }
                })

                xwear_add_events_for_pagination();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('.catalog__section').html(textStatus)
                console.error('Error:', textStatus, errorThrown)
            },
        })
    }



    $('.filters__form').on('submit', (e) => {
        e.preventDefault();
        xwear_get_posts();
    })

    $('.dropdown__list--item').each(function() {
        $(this).on('click', (e) => {
            xwear_get_posts();
        })
    })

});