<?php

defined( 'ABSPATH' ) or die( 'Keep Quit' );

class Product_Share_Icons{

	protected static $_instance = null;

	public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }


    /*
     * Construct of the Class.
     *
     */

    public function __construct(){

    	$this->init();

        do_action( 'product_share_icons_loaded', $this );

    }


    /**
     * Hooks for this class
     * 
     */

    public function init(){
        add_filter( 'psfw_icon_key', array( $this, 'icon_key_replace' ) );
    }

    public function get_facebook($icon_appearance, $btn_format, $text, $product_id){

    	echo sprintf(
    		'<li><a href="%1$s%2$s" data-psfw-href="%1$s" target="_blank" data-main-product-url="%2$s" data-form-url="%2$s" %3$s>%4$s</a></li>',
    		'https://www.facebook.com/sharer/sharer.php?u=',
    		( Product_Share::get_options()->encode_url === 'yes' ) ? urlencode( esc_url( get_permalink( $product_id ) ) ) : esc_url( get_permalink( $product_id ) ),
    		wp_kses_post( apply_filters('psfw_a_additional_attr', '', $text) ),
    		wp_kses_post( $btn_format ),
    	);
    }


    public function get_twitter($icon_appearance, $btn_format, $text, $product_id){

    	echo sprintf(
    		'<li><a href="%1$s%2$s" data-psfw-href="%1$s" target="_blank" data-main-product-url="%2$s" data-form-url="%2$s" %3$s>%4$s</a></li>',
    		'https://twitter.com/intent/tweet?url=',
    		( Product_Share::get_options()->encode_url === 'yes' ) ? urlencode( esc_url( get_permalink( $product_id ) ) ) : esc_url( get_permalink( $product_id ) ),
            wp_kses_post( apply_filters('psfw_a_additional_attr', '', $text) ),
            wp_kses_post( $btn_format ),
    	);
    }

    public function get_linkedin($icon_appearance, $btn_format, $text, $product_id){
    	echo sprintf(
    		'<li><a href="%1$s%2$s" data-psfw-href="%1$s" target="_blank" data-main-product-url="%2$s" data-form-url="%2$s" %3$s>%4$s</a></li>',
    		'https://www.linkedin.com/shareArticle?mini=true&url=',
    		( Product_Share::get_options()->encode_url === 'yes' ) ? urlencode( esc_url( get_permalink( $product_id ) ) ) : esc_url( get_permalink( $product_id ) ),
            wp_kses_post( apply_filters('psfw_a_additional_attr', '', $text) ),
            wp_kses_post( $btn_format ),
    	);
    }

    public function get_viber($icon_appearance, $btn_format, $text, $product_id){
    	echo sprintf(
    		'<li><a href="%1$s%2$s" data-psfw-href="%1$s" target="_blank" data-main-product-url="%2$s" data-form-url="%2$s" %3$s>%4$s</a></li>',
    		'viber://forward?text=',
    		( Product_Share::get_options()->encode_url === 'yes' ) ? urlencode( esc_url( get_permalink( $product_id ) ) ) : esc_url( get_permalink( $product_id ) ),
            wp_kses_post( apply_filters('psfw_a_additional_attr', '', $text) ),
            wp_kses_post( $btn_format ),
    	);
    }

    public function get_telegram($icon_appearance, $btn_format, $text, $product_id){
    	echo sprintf(
    		'<li><a href="%1$s%2$s" data-psfw-href="%1$s" target="_blank" data-main-product-url="%2$s" data-form-url="%2$s" %3$s>%4$s</a></li>',
    		'https://t.me/share/url?url=',
    		( Product_Share::get_options()->encode_url === 'yes' ) ? urlencode( esc_url( get_permalink( $product_id ) ) ) : esc_url( get_permalink( $product_id ) ),
            wp_kses_post( apply_filters('psfw_a_additional_attr', '', $text) ),
            wp_kses_post( $btn_format ),
    	);
    }

    public function get_whatsapp($icon_appearance, $btn_format, $text, $product_id){
    	echo sprintf(
    		'<li><a href="%1$s%2$s" data-psfw-href="%1$s" target="_blank" data-main-product-url="%2$s" data-form-url="%2$s" %3$s>%4$s</a></li>',
    		'https://api.whatsapp.com/send?text=',
    		( Product_Share::get_options()->encode_url === 'yes' ) ? urlencode( esc_url( get_permalink( $product_id ) ) ) : esc_url( get_permalink( $product_id ) ),
            wp_kses_post( apply_filters('psfw_a_additional_attr', '', $text) ),
            wp_kses_post( $btn_format ),
    	);
    }

    public function get_pinterest($icon_appearance, $btn_format, $text, $product_id){

        /**
         * @since 1.2.15
         * Pinterest has changed their share link structure
         * So we need to pass the product thumbnail and description
         */

        $product = wc_get_product( $product_id );

        $product_image = get_the_post_thumbnail_url( $product_id ) ? get_the_post_thumbnail_url( $product_id ) : wc_placeholder_img_src();
        $product_title = $product->get_title();


    	echo sprintf(
    		'<li><a href="%1$s%2$s" data-psfw-href="%1$s" target="_blank" data-main-product-url="%2$s" data-form-url="%2$s" %3$s>%4$s</a></li>',
    		sprintf( 'https://pinterest.com/pin/create/button/?media=%1$s&description=%2$s&url=',
                esc_url( $product_image ),
                wp_kses_post( $product_title )

            ),
    		( Product_Share::get_options()->encode_url === 'yes' ) ? urlencode( esc_url( get_permalink( $product_id ) ) ) : esc_url( get_permalink( $product_id ) ),
            wp_kses_post( apply_filters('psfw_a_additional_attr', '', $text) ),
            wp_kses_post( $btn_format ),
    	);
    }

    public function get_tumblr($icon_appearance, $btn_format, $text, $product_id){
    	echo sprintf(
    		'<li><a href="%1$s%2$s" data-psfw-href="%1$s" target="_blank" data-main-product-url="%2$s" data-form-url="%2$s" %3$s>%4$s</a></li>',
    		'https://www.tumblr.com/widgets/share/tool?posttype=link&canonicalUrl=',
    		( Product_Share::get_options()->encode_url === 'yes' ) ? urlencode( esc_url( get_permalink( $product_id ) ) ) : esc_url( get_permalink( $product_id ) ),
            wp_kses_post( apply_filters('psfw_a_additional_attr', '', $text) ),
            wp_kses_post( $btn_format ),
    	);
    }

    public function get_vk($icon_appearance, $btn_format, $text, $product_id){
    	echo sprintf(
    		'<li><a href="%1$s%2$s" data-psfw-href="%1$s" target="_blank" data-main-product-url="%2$s" data-form-url="%2$s" %3$s>%4$s</a></li>',
    		'https://vk.com/share.php?url=',
    		( Product_Share::get_options()->encode_url === 'yes' ) ? urlencode( esc_url( get_permalink( $product_id ) ) ) : esc_url( get_permalink( $product_id ) ),
            wp_kses_post( apply_filters('psfw_a_additional_attr', '', $text) ),
            wp_kses_post( $btn_format ),
    	);
    }

    public function get_reddit($icon_appearance, $btn_format, $text, $product_id){
        echo sprintf(
            '<li><a href="%1$s%2$s" data-psfw-href="%1$s" target="_blank" data-main-product-url="%2$s" data-form-url="%2$s" %3$s>%4$s</a></li>',
            'https://reddit.com/submit?url=',
            ( Product_Share::get_options()->encode_url === 'yes' ) ? urlencode( esc_url( get_permalink( $product_id ) ) ) : esc_url( get_permalink( $product_id ) ),
            wp_kses_post( apply_filters('psfw_a_additional_attr', '', $text) ),
            wp_kses_post( $btn_format ),
        );
    }

    public function get_xing($icon_appearance, $btn_format, $text, $product_id){
        echo sprintf(
            '<li><a href="%1$s%2$s" data-psfw-href="%1$s" target="_blank" data-main-product-url="%2$s" data-form-url="%2$s" %3$s>%4$s</a></li>',
            'https://www.xing.com/app/user?op=share&url=',
            ( Product_Share::get_options()->encode_url === 'yes' ) ? urlencode( esc_url( get_permalink( $product_id ) ) ) : esc_url( get_permalink( $product_id ) ),
            wp_kses_post( apply_filters('psfw_a_additional_attr', '', $text) ),
            wp_kses_post( $btn_format ),
        );
    }

    public function get_pocket($icon_appearance, $btn_format, $text, $product_id){
        echo sprintf(
            '<li><a href="%1$s%2$s" data-psfw-href="%1$s" target="_blank" data-main-product-url="%2$s" data-form-url="%2$s" %3$s>%4$s</a></li>',
            'https://getpocket.com/save?url=',
            ( Product_Share::get_options()->encode_url === 'yes' ) ? urlencode( esc_url( get_permalink( $product_id ) ) ) : esc_url( get_permalink( $product_id ) ),
            wp_kses_post( apply_filters('psfw_a_additional_attr', '', $text) ),
            wp_kses_post( $btn_format ),
        );
    }

    public function get_yahoo($icon_appearance, $btn_format, $text, $product_id){
        echo sprintf(
            '<li><a href="%1$s%2$s" data-psfw-href="%1$s" target="_blank" data-main-product-url="%2$s" data-form-url="%2$s" %3$s>%4$s</a></li>',
            'https://compose.mail.yahoo.com/?body=',
            ( Product_Share::get_options()->encode_url === 'yes' ) ? urlencode( esc_url( get_permalink( $product_id ) ) ) : esc_url( get_permalink( $product_id ) ),
            wp_kses_post( apply_filters('psfw_a_additional_attr', '', $text) ),
            wp_kses_post( $btn_format ),
        );
    }

    public function get_weibo($icon_appearance, $btn_format, $text, $product_id){
        echo sprintf(
            '<li><a href="%1$s%2$s" data-psfw-href="%1$s" target="_blank" data-main-product-url="%2$s" data-form-url="%2$s" %3$s>%4$s</a></li>',
            'https://service.weibo.com/share/share.php?url=',
            ( Product_Share::get_options()->encode_url === 'yes' ) ? urlencode( esc_url( get_permalink( $product_id ) ) ) : esc_url( get_permalink( $product_id ) ),
            wp_kses_post( apply_filters('psfw_a_additional_attr', '', $text) ),
            wp_kses_post( $btn_format ),
        );
    }

    public function get_evernote($icon_appearance, $btn_format, $text, $product_id){
        echo sprintf(
            '<li><a href="%1$s%2$s" data-psfw-href="%1$s" target="_blank" data-main-product-url="%2$s" data-form-url="%2$s" %3$s>%4$s</a></li>',
            'https://www.evernote.com/clip.action?url=',
            ( Product_Share::get_options()->encode_url === 'yes' ) ? urlencode( esc_url( get_permalink( $product_id ) ) ) : esc_url( get_permalink( $product_id ) ),
            wp_kses_post( apply_filters('psfw_a_additional_attr', '', $text) ),
            wp_kses_post( $btn_format ),
        );
    }

    public function get_mastodon($icon_appearance, $btn_format, $text, $product_id){
        echo sprintf(
            '<li><a href="%1$s%2$s" data-psfw-href="%1$s" target="_blank" data-main-product-url="%2$s" data-form-url="%2$s" %3$s>%4$s</a></li>',
            'https://mastodonshare.com/?url=',
            ( Product_Share::get_options()->encode_url === 'yes' ) ? urlencode( esc_url( get_permalink( $product_id ) ) ) : esc_url( get_permalink( $product_id ) ),
            wp_kses_post( apply_filters('psfw_a_additional_attr', '', $text) ),
            wp_kses_post( $btn_format ),
        );
    }

    public function get_bluesky($icon_appearance, $btn_format, $text, $product_id){
        echo sprintf(
            '<li><a href="%1$s%2$s" data-psfw-href="%1$s" target="_blank" data-main-product-url="%2$s" data-form-url="%2$s" %3$s>%4$s</a></li>',
            'https://bsky.app/intent/compose?text=',
            ( Product_Share::get_options()->encode_url === 'yes' ) ? urlencode( esc_url( get_permalink( $product_id ) ) ) : esc_url( get_permalink( $product_id ) ),
            wp_kses_post( apply_filters('psfw_a_additional_attr', '', $text) ),
            wp_kses_post( $btn_format ),
        );
    }


    public function get_email($icon_appearance, $btn_format, $text, $product_id){
    	echo sprintf(
    		'<li><a href="%1$s%2$s" data-psfw-href="%1$s" target="_blank" data-main-product-url="%2$s" data-form-url="%2$s" %3$s>%4$s</a></li>',
            /**
             * `psfw_mail_address` added to remove the email address 
             * 
             * @since 1.2.6 
             * 
             */
    		sprintf('mailto:%3$s?subject=%1$s&body=%2$s', 
    			wp_kses_post( get_the_title( $product_id ) ), 
    			esc_html( apply_filters( 'psfw_mail_body_text', __('Check this out: ', 'product-share') ) ),
                esc_html( apply_filters( 'psfw_mail_address', 'address@somemail.com' ) )
    		),
    		( Product_Share::get_options()->encode_url === 'yes' ) ? urlencode( esc_url( get_permalink( $product_id ) ) ) : esc_url( get_permalink( $product_id ) ),
            wp_kses_post( apply_filters('psfw_a_additional_attr', '', $text) ),
            wp_kses_post( $btn_format ),
    	);
    }

    public function get_copy_to_clipboard($icon_appearance, $text, $product_id){

    	if( 'only_icon' == $icon_appearance ){
    		$btn_format = '<i class="psfw-clipboard fa-solid fa-clipboard"></i>';
    	}
    	elseif( 'only_text' == $icon_appearance ){
    		
    		$btn_format = '<span class="psfw-clipboard-text">'.apply_filters( 'psfw_copy_to_clipboard_text', __('Copy to Clipboard', 'product-share') ).'</span>';
    		
    	}
    	else{
    		
    		$btn_format = '<i class="psfw-clipboard fa-solid fa-clipboard"></i> <span class="psfw-clipboard-text">'.apply_filters( 'psfw_copy_to_clipboard_text', __('Copy to Clipboard', 'product-share') ).'</span>';
    	}

    	echo sprintf(
    		'<li><a id="psfw-copy-link" data-url="%1$s" data-psfw-href="" href="#" data-form-url="%1$s" %2$s>%3$s</a></li>',
    		esc_url( get_permalink( $product_id ) ), //urlencode was not applied here for readable copy to clipboard link feature. Browsers can't read the encoded URL.
    		wp_kses_post( apply_filters('psfw_a_additional_attr', '', $text) ),
    		wp_kses_post( $btn_format )
    	);
    }

    public function get_all_icon( $icon_appearance, $text, $product_id ){

        if( 'only_icon' == $icon_appearance ){
                    $btn_format = '<i class="psfw-all-icon fa-solid fa-plus"></i>';
        }
        elseif( 'only_text' == $icon_appearance ){
            
            $btn_format = '<span class="psfw-all-icon-text">'.apply_filters( 'psfw_all_icon_button_text', __('All Icon', 'product-share') ).'</span>';
            
        }
        else{
            
            $btn_format = '<i class="psfw-all-icon fa-solid fa-plus"></i> <span class="psfw-all-icon-text">'.apply_filters( 'psfw_all_icon_button_text', __('All Icon', 'product-share') ).'</span>';
        }

        echo sprintf(
            '<li><a id="psfw-all-icon" data-url="%1$s" data-psfw-href="" href="#" data-form-url="%1$s" %2$s>%3$s</a></li>',
            ( Product_Share::get_options()->encode_url === 'yes' ) ? urlencode( esc_url( get_permalink( $product_id ) ) ) : esc_url( get_permalink( $product_id ) ), 
            wp_kses_post( apply_filters('psfw_a_additional_attr', '', $text) ),
            wp_kses_post( $btn_format )
        );

    }

    /**
     * Add Twitter X Icon
     * @since 1.2.6
     * 
     */
    public function icon_key_replace( $key ){ 

        // Added @version 1.2.7
        ('pocket' === $key ) ? $key = 'get-pocket' :  $key; 

        if( apply_filters( 'psfw_remove_twitter_x_icon', false ) ){
            return $key;
        }

        ('twitter' === $key ) ? $key = 'x-twitter' :  $key; 

        return $key; 
    }


}