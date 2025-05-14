<?php

defined( 'ABSPATH' ) or die( 'Keep Silent' );

/**
 * You can aslo call `$this` because it is included inside the class-product-share-front.php file
 */

if( function_exists( 'yith_wcqv_init' ) ){

	// YITH Quick View Plugin Support
    add_action( 'yith_wcqv_product_summary', array( $this, 'display_share_link' ), 31 );

}