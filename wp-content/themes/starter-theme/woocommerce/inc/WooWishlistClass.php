<?php
    class WooWishlistClass
    {
        protected int $product_id;
        public function __construct(int $product_id)
        {
            if ( ! class_exists('YITH_WCWL')) {
                return;
            }
            $this->product_id = $product_id;
        }

        public function add_product_to_wishlist()
        {
            $user_id    = get_current_user_id();
            $wishlist    = self::get_wishlist();
            $wishlist_id = $wishlist ? $wishlist->get_id() : 0;
            $atts        = array(
                'add_to_wishlist' => $this->product_id,
                'wishlist_id'     => $wishlist_id,
                'quantity'        => 1,
                'user_id'         => $user_id,
            );
            YITH_WCWL()->add($atts);

            return true;
        }

        public function remove_product_from_wishlist()
        {

            $user_id    = get_current_user_id();
            $wishlist    = self::get_wishlist();
            if ( ! $wishlist) {
                return false;
            }
            $wishlist_id = $wishlist->get_id();
            $atts        = array(
                'remove_from_wishlist' => $this->product_id,
                'wishlist_id'          => $wishlist_id,
                'user_id'              => $user_id,
            );
            YITH_WCWL()->remove($atts);

            return true;
        }


        public static function get_wishlist()
        {
            $wishlist = YITH_WCWL()->get_current_user_wishlists();
            if (empty($wishlist)) {
                return false;
            }

            return $wishlist[0];
        }

        public static function check_is_product_in_list(int $product_id):bool
        {
            $wishlist = self::get_wishlist();
            if(!$wishlist) {
                return false;
            }
            $wishlist_items = $wishlist->get_items();
            $product_ids = array_map(function ($item) {
                return $item['prod_id'];
            },$wishlist_items);

            return in_array($product_id,$product_ids);
        }
    }

