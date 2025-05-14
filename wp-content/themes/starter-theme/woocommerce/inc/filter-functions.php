<?php
    function robert_custom_filter_woocommerce_products($query) {
        if ((!is_admin() && $query->is_main_query()) && ( is_product_category() || is_shop()) ):
            $tax_query = array('relation' => 'AND');
            $meta_query = array('relation' => 'AND');

            if(isset($_REQUEST['colors'])) {
                $tax_query[] = array(
                    'taxonomy' => 'pa_color',
                    'field'    => 'term_id',
                    'terms'    => $_REQUEST['colors'],
                );
            }
            if(isset($_REQUEST['categories'])) {
                $tax_query[] = array(
                    'taxonomy' => 'product_cat',
                    'field' => 'term_id',
                    'terms' => $_REQUEST['categories']
                );
            }
            if(isset($_REQUEST['tags'])) {
                $tax_query[] = array(
                    'taxonomy' => 'product_tag',
                    'field' => 'term_id',
                    'terms' => $_REQUEST['tags']
                );
            }
            if (isset($_REQUEST['prices']) && is_array($_REQUEST['prices'])) {
                $prices = $_REQUEST['prices'];

                $price_filters = array_map(function ($range) {
                    $range = str_replace(' ', '', $range);

                    if (preg_match('/^<(\d+)$/', $range, $matches)) {
                        return [
                            'min' => 0,
                            'max' => (int)$matches[1]
                        ];
                    } elseif (preg_match('/^>(\d+)$/', $range, $matches)) {
                        return [
                            'min' => (int)$matches[1],
                            'max' => null
                        ];
                    } elseif (preg_match('/^>(\d+)&&<(\d+)$/', $range, $matches)) {
                        return [
                            'min' => (int)$matches[1],
                            'max' => (int)$matches[2]
                        ];
                    }

                    return null;
                }, $prices);

                $price_filters = array_filter($price_filters);

                if (!empty($price_filters)) {
                    $meta_query = ['relation' => 'OR'];

                    foreach ($price_filters as $filter) {
                        if (!is_null($filter['min']) && !is_null($filter['max'])) {
                            $meta_query[] = [
                                'key' => '_price',
                                'value' => [$filter['min'], $filter['max']],
                                'compare' => 'BETWEEN',
                                'type' => 'DECIMAL',
                            ];
                        } elseif (!is_null($filter['min'])) {
                            $meta_query[] = [
                                'key' => '_price',
                                'value' => $filter['min'],
                                'compare' => '>=',
                                'type' => 'DECIMAL',
                            ];
                        } elseif (!is_null($filter['max'])) {
                            $meta_query[] = [
                                'key' => '_price',
                                'value' => $filter['max'],
                                'compare' => '<=',
                                'type' => 'DECIMAL',
                            ];
                        }
                    }
                }
            }

            if (!empty($tax_query)) {
                $query->set('tax_query', $tax_query);
            }
            if (!empty($meta_query)) {
                $query->set('meta_query', $meta_query);
            }

        endif;
    }

    add_action('pre_get_posts', 'robert_custom_filter_woocommerce_products');