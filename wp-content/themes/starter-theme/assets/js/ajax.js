jQuery(document).ready(function($) {
    const postId = $('body').data('post-id'),
        ajaxUrl = data.ajax_url

    if (postId && ajaxUrl) {
        let data = {
            action : 'increment_post_view',
            post_id : postId
        }
        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: data,
            beforeSend: function( xhr ) {

            },
            success: function( data ) {
                console.log('Post views updated')
            }
        });
    }
    $('#ajax-search-input').on('keyup', function() {
        let keyword = $(this).val();

        if (keyword.length >= 2) {
            $.ajax({
                url: ajaxUrl,
                type: 'POST',
                data: {
                    action: 'zen_search_products',
                    search_value: keyword
                },
                success: function(response) {
                    $('#ajax-search-wrapper').html(response);
                }
            });
        } else {
            $('#ajax-search-wrapper').html('');
        }
    });
    $('.ajax-add-to-wishlist').on('click',function (e) {
        e.preventDefault();
        var btn = $(this)
        var productId = btn.data('product-id')
        var processTypes = [
            'add',
            'remove'
        ]
        var isInWishlist = btn.attr('data-in-wishlist') === 'true';
        var process = isInWishlist ? processTypes[1] : processTypes[0]
        var data = {
            action: 'custom_wishlist_handler',
            product_id : productId,
            process : process
        }
        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: data,
            beforeSend: function( xhr ) {
                btn.addClass('hold')
            },
            success: function( data ) {
                btn.attr('data-in-wishlist', (!isInWishlist).toString());
            },
            complete: function () {
                btn.removeClass('hold')
            }
        })
    });
    $('.single_add_to_cart_button,.buy-one-click-button').on('click',function (e) {
        e.preventDefault()
        var btn = $(this)
        var form = btn.closest('form')
        var data = {
            action : 'add_single_product_to_cart',
            product_id  : form.find('input[name=product_id]').val() || btn.val(),
            quantity : parseFloat(form.find('input.qty').val()) || 1,
            variation_id : parseFloat(form.find('input[name=variation_id]').val()) || 0,
            variations : form.attr('data-product_variations') ?? []
        }
        var isRedirect = $(this).is('.buy-one-click-button')
        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: data,
            beforeSend: function( xhr ) {
                btn.addClass('hold')
            },
            success: function( response ) {
                $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash]);
                if(isRedirect) {
                    window.location.href = btn.attr('data-href')
                }
            },
            complete: function () {
                btn.removeClass('hold')
                if(!isRedirect) {
                    $('#cart-modal').removeClass('hidden')
                    window.setTimeout(function () {
                        $('#cart-modal').attr('data-open','true')
                    },300)
                }
            }
        })
    })
    $(document).on('click', '.cart-plus-btn,.cart-minus-btn,.cart-item-remove', function () {
        var wrapper = $(this).closest('.woocommerce-mini-cart-item')
        var qty = wrapper.find('input[name=quantity]');
        var val = parseFloat(qty.val());
        var step = parseFloat(qty.attr('step'));
        var cartItemKey = qty.attr('data-cart-item-key')
        if(!cartItemKey || !val) {
            return
        }
        if ($(this).is('.cart-plus-btn')) {
            val = val + step
        }else if($(this).is('.cart-minus-btn')) {
            val = val - step
        } else {
            val = 0
        }
        var data = {
            action: 'zen_update_cart_item_qty',
            quantity: val,
            cart_item_key: cartItemKey,
        }
        $.ajax({
            method: 'POST',
            url: ajaxUrl,
            dataType: 'json',
            data: data,
            beforeSend: function (xhr) {
                wrapper.eq(0).css({
                    'opacity': '0.3',
                    'pointer-events': 'none'
                });
            },
            success: function (response) {
                $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash]);
                wrapper.eq(0).css({
                    'opacity': '1',
                    'pointer-events': 'auto'
                });
            },
            error: function () {
                console.error('Ошибка AJAX-запроса.');
                wrapper.eq(0).css({
                    'opacity': '1',
                    'pointer-events': 'auto'
                });
            }
        })
    });
});

