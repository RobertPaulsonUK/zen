( function ( $ ) {

    var publicObj = public_js_object,
        clicks = 0,
        productShare = function(){
            // Copy Product URL
            $( 'a[id=psfw-copy-link]' ).on( 'click', function( e ){

                e.preventDefault();

                var product_url;

                product_url = $(this).attr('data-url');

                // Callback function for copy product URL
                if(navigator.clipboard) {

                    navigator.clipboard.writeText(product_url);

                    $( '.psfw-clipboard' ).removeClass('fa-clipboard').addClass('fa-clipboard-check');
                    $( '.psfw-clipboard-text' ).text(publicObj.copied_to_clipboard_text);

                    setTimeout(function(){
                        $( '.psfw-clipboard' ).removeClass('fa-clipboard-check').addClass('fa-clipboard');
                        $( '.psfw-clipboard-text' ).text(publicObj.copy_to_clipboard_text);
                    }, 800);

                }

                else{

                    alert('Please make sure you have a secure connection. For example: https://example.com ');

                }

            } );

            // All Icon Button
            $( 'a[id=psfw-all-icon]' ).on( 'click', function( e ){

                e.preventDefault();

                if (clicks == 0) {
                    $( '.psfw-popup-container' ).addClass( 'open' );
                    clicks++;

                    var product_url;
                    // @Note: Try to find if data-main-product-url(for variable product) exists 
                    // if not then get the data-url(for other product type)
                    // Getting the all_icon product url
                    if( $(this).attr('data-main-product-url') ){
                        product_url = $(this).attr('data-main-product-url');
                    }
                    else{
                        product_url = $(this).attr('data-form-url');
                    }
                    // Assigning the product_url for popup social icon a href
                    $( '.psfw-popup-ul-container li a' ).attr( 'data-main-product-url', product_url );
                    // Changing the href value for each a tag on clicking all icon popup button.
                    $( '.psfw-popup-ul-container li a' ).each( function( i ) {
                        var social_url = $(this).attr('data-psfw-href'),
                            product_url = $(this).attr('data-main-product-url');
                        $(this).attr('href', social_url+product_url);
                    });
                }
            } );

            // Closing popup if clicking on the close button
            $('.psfw-popup-top a').on('click', function(e){
                e.preventDefault();

                if (clicks == 1) {
                    $( '.psfw-popup-container' ).removeClass( 'open' );
                    clicks--;
                }
            });

            // Closing popup if clicking on outside of the popup
            $('.psfw-popup-container').on('click', function( e ){

                var target = $(e.target);
                if(target.is('.psfw-popup-container') && !target.is('.psfw-all-icon')) {
                    if (clicks == 1) {
                        $( '.psfw-popup-container' ).removeClass( 'open' );
                        clicks--;
                    }
                }
                
            });

            // Regenerate variation data for YITH Quick View close
            // var quickViewClasses= '.yith-quick-view-overlay, .yith-quick-view-close';
            // $(document).find( quickViewClasses ).on('click', function(event){
            //     $('a[class=reset_variations]').click();
            // });
        };

    $(document).on('psfw_single_prduct_init', function(){
        productShare();
    });

    // YITH Quick View Support
    $(document).on('yith_quick_view_loaded', function(){
        $(document).trigger('psfw_single_prduct_init');
    });

    productShare();
    
} )( jQuery );